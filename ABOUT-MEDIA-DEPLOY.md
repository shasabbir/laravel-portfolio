# About media deployment

Methods & tools, Manuscripts and Selected highlights also support inline editing, adding, removing and reordering entries. Highlight groups use one item per line. The additional content migration preserves the original content without changing existing research, education or media. Run `php artisan migrate --force` and deploy the rebuilt assets for this update.

Signed-in administrators edit directly on `/about`: expand the Edit control beside each image, résumé, Research & work or Academic path, then save. Section saves preserve the other section. Cancel discards unsaved changes. These controls are hidden from visitors.

Research & work and Academic path are managed directly on `/about`. The previous `/admin/about-content` and `/admin/about-media` URLs redirect to the relevant About editor; their save endpoints remain active. The content migration preserves the original four experience entries, two education entries and additional experience note. Entries can be added, removed and reordered before saving. Back up the `about_content` table along with media metadata. Run migrations before serving the updated About page.

Deploy the updated application and run from the project root:

```sh
php artisan migrate --force
npm ci --include=dev
npm run build
php artisan view:clear
```

If building locally, upload the entire `public/build` directory, including its manifest, to the server's public document root.

Sign in with an existing administrator account and open `/about` and click Edit beside the relevant image or PDF. Upload a profile image, research illustration and résumé PDF, then save. Empty fields keep their existing files. Replacing a file removes the previous uploaded copy after the database update succeeds.

Images accept JPG, PNG and WebP up to 5 MB each; résumés accept PDF up to 10 MB. Configure PHP `upload_max_filesize` to at least `10M` and `post_max_size` to at least `24M`, and allow that request size in the web server.

Uploads are stored on Laravel's local disk (`storage/app/private/about` by default); metadata is in the `about_media` database table. Keep both database and storage persistent across deployments and include them in backups. The PHP process needs write access to storage. Public media routes serve the files directly, so these uploads do not need `storage:link`.

Before an upload, the existing files under `public/images` and the original public résumé PDF are used when available. Upload missing files through the About page after deployment. Access follows the existing blog/publication management policy: authenticated accounts can manage media; there is no separate administrator role in this application.
