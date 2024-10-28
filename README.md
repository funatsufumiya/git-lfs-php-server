# git-lfs-php-server

A simple PHP server to serve Git LFS requests.

(Do not use this in production. Security is not guaranteed.)

## Configuration

- create `config.inc.php` using `default-config.inc.php` as a template

## Concept

- `$_SERVER['REQUEST_URI']` in `index.php` will be used to determine the endpoint
  - ex: `http://localhost:8080/<repository-name>/locks/verify`
  - for example nginx, you can use `try_files $uri /index.php;` to redirect all requests to `index.php`
- `/locks/verify`, `/objects/batch`, `/upload`, `/download` are the endpoints that Git LFS client will request
  - treat as dir path before the endpoint as the repository name
    - ex: `<repository-name>/locks/verify`
- data will be stored in `data/objects`. The structure is as follows:
  - `data/<repository-name>/objects/<oid>`

## Notes

- make sure `data` is writable by the web server user (for example, `sudo chown -R www-data:www-data data` or `sudo chwon -R apache:apache data` or `sudo chown -R nginx:nginx data`)