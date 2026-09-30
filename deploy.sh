#!/usr/bin/env bash
set -euo pipefail

if [[ "${EUID}" -ne 0 ]]; then
  echo "This script must be run as root." >&2
  exit 1
fi

export DEBIAN_FRONTEND=noninteractive

APP_NAME=${APP_NAME:-laravel-portfolio}
REPO_URL=${REPO_URL:-https://github.com/shasabbir/laravel-portfolio.git}
BRANCH=${BRANCH:-master}
APP_DIR=${APP_DIR:-/var/www/${APP_NAME}}
SERVER_NAME=${SERVER_NAME:-example.com}
SERVER_ADMIN=${SERVER_ADMIN:-webmaster@localhost}
APACHE_CONF="/etc/apache2/sites-available/${APP_NAME}.conf"
APACHE_LOG_DIR="/var/log/apache2"

log() {
  echo "[deploy] $1"
}

log "Updating package index"
apt-get update

log "Installing system packages"
apt-get install -y apache2 libapache2-mod-php \
  php php-cli php-mysql php-sqlite3 php-mbstring php-xml php-curl php-zip php-bcmath php-gd php-intl \
  git curl unzip composer

log "Enabling Apache modules"
a2enmod rewrite headers >/dev/null

log "Creating application directory"
mkdir -p "${APP_DIR}"

if [[ -d "${APP_DIR}/.git" ]]; then
  log "Updating existing repository"
  git -C "${APP_DIR}" fetch origin
  git -C "${APP_DIR}" checkout "${BRANCH}"
  git -C "${APP_DIR}" reset --hard "origin/${BRANCH}"
else
  log "Cloning repository"
  rm -rf "${APP_DIR}"
  git clone --depth=1 --branch "${BRANCH}" "${REPO_URL}" "${APP_DIR}"
fi

log "Installing PHP dependencies"
cd "${APP_DIR}"
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --prefer-dist --optimize-autoloader

if [[ ! -f .env ]]; then
  log "Creating .env file from example"
  cp .env.example .env
fi

log "Generating application key"
php artisan key:generate --force

log "Setting application permissions"
chown -R www-data:www-data "${APP_DIR}"
find "${APP_DIR}/storage" -type d -exec chmod 775 {} \;
find "${APP_DIR}/bootstrap/cache" -type d -exec chmod 775 {} \;

log "Linking storage directory"
php artisan storage:link >/dev/null || true

log "Optimizing Laravel caches"
php artisan optimize || true

log "Writing Apache virtual host"
cat > "${APACHE_CONF}" <<EOF
<VirtualHost *:80>
    ServerName ${SERVER_NAME}
    ServerAdmin ${SERVER_ADMIN}
    DocumentRoot ${APP_DIR}/public

    <Directory ${APP_DIR}/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/${APP_NAME}_error.log
    CustomLog ${APACHE_LOG_DIR}/${APP_NAME}_access.log combined
</VirtualHost>
EOF

if [[ -f /etc/apache2/sites-enabled/000-default.conf ]]; then
  a2dissite 000-default.conf >/dev/null
fi

a2ensite "${APP_NAME}.conf" >/dev/null

log "Reloading Apache"
systemctl enable apache2 >/dev/null
systemctl reload apache2

log "Deployment complete"
cat <<EOF

Next steps:
- Update ${APP_DIR}/.env with correct database and app configuration.
- Point DNS for ${SERVER_NAME} to this server's IP.
EOF
