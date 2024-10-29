# git-lfs-php-server

A simple PHP server to serve Git LFS requests.

- No DBs are needed. Just using local file system.
- No extensions or libralies are needed. Minimal and plain PHP.
- Created for traditional apache-like (non-root or not VPS) PHP web server.
- Tested on PHP 7-8, but probably work on older version.

## WARNING

- Do not use this in production. Security is not guaranteed.
- Please consider [Rudolfs](https://github.com/jasonwhite/rudolfs) or [Gitea](https://github.com/go-gitea/gitea) if you have root permission or installation rights on web server. This php server will work well if you only have limited permission on traditional apache(-like) server.

## Install (on web server)

### Configure

- create `config.inc.php` using `default-config.inc.php` as a template
- Please edit `server_url`

### Change permissions

- make sure `data` folder is writable by the web server user
  - for example:
    - `sudo chown -R www-data:www-data data`
    - or `sudo chwon -R apache:apache data`
    - or `sudo chown -R nginx:nginx data`

### Rewrite rule and concept

- `$_SERVER['REQUEST_URI']` in `index.php` is used to determine the endpoint
  - ex: `http://localhost:8080/<repository-name>/locks/verify`
  - on nginx, you can redirect all requests to `index.php` like below:
    ```
    location / {
        try_files $uri /index.php;
    }
    ```
  - on apache, like below:
    ```
    <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
    </IfModule>
    ```
- data will be stored in `data/`. The structure is as follows:
  - `data/<repository-name>/objects/<oid>`
- (note): `/locks/verify`, `/objects/batch`, `/upload`, `/download` are the endpoints that Git LFS client will request
  - treat as dir path before the endpoint as the repository name
    - ex: `<repository-name>/locks/verify`

### Authentication

- you can use Basic Auth using nginx or apache (.htaccess) settings.
- detailed and segmented auth is not implemented. If you want, please create another server or modify php code as you like.

## Usage (on git client)

- write your `.lfsconfig` file on your repository
  - ex: `git config -f .lfsconfig lfs.url http://localhost:8080/<repository-name>`

- then, `.lfsconfig` will be like this:
    ```
    [lfs]
        url = http://localhost:8080/<repository-name>
    ```

- please commit `.lfsconfig` to your repository
- then, you can use `git lfs` commands. enjoy!

## TODOs (Missing Features)

- Token Authentication
- Auth per repository (or owner)
- Security

## License

At this time, the copyright is held by the original owner of [the forked source](https://github.com/takashiro/git-lfs-server). The fork source is in archived status and is currently confirming owner's intentions.

(Note: with the current "No License", anyone can use GitHub functions such as fork, PR, code browsing, and download, but not allowed to copy or modify outside of GitHub.)
