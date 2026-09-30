-- MySQL initialization for Laravel app
-- Adjust host and passwords as needed
CREATE DATABASE IF NOT EXISTS `portfolio` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'portfolio_user'@'%' IDENTIFIED BY 'portfolio_pass';
GRANT ALL PRIVILEGES ON `portfolio`.* TO 'portfolio_user'@'%';
FLUSH PRIVILEGES;

-- Optional: seed minimal data after running migrations
-- USE `portfolio`;
-- INSERT INTO blogs (slug,title,excerpt,image_url,image_hint,content,author_name,author_avatar,tags,date,created_at,updated_at)
-- VALUES (
--   'welcome-to-the-blog','Welcome to the Blog','Starter post','/images/blog/sample.jpg','sample','Hello world! This is a sample post migrated to Laravel.','GAZI SALAH UDDIN NUHASH','https://i.postimg.cc/50FkXX3x/nuhash.jpg','["New"]', NOW(), NOW(), NOW()
-- );
