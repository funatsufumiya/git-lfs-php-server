# git-lfs-php-server

A simple PHP server to serve Git LFS requests.

(Do not use this in production. Security is not guaranteed.)

## Install (on web server)

### Configure

- create `config.inc.php` using `default-config.inc.php` as a template

### Change permissions

- make sure `data` folder is writable by the web server user
  - for example:
    - `sudo chown -R www-data:www-data data`
    - or `sudo chwon -R apache:apache data`
    - or `sudo chown -R nginx:nginx data`)

### Rewrite rule and concept

- `$_SERVER['REQUEST_URI']` in `index.php` will be used to determine the endpoint
  - ex: `http://localhost:8080/<repository-name>/locks/verify`
  - for example nginx, you can use `try_files $uri /index.php;` to redirect all requests to `index.php`
- data will be stored in `data/objects`. The structure is as follows:
  - `data/<repository-name>/objects/<oid>`
- `/locks/verify`, `/objects/batch`, `/upload`, `/download` are the endpoints that Git LFS client will request
  - treat as dir path before the endpoint as the repository name
    - ex: `<repository-name>/locks/verify`

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

## TODOs

- Authentication (HTTP Basic auth can probably be used now, so this means token verification or something)
- Security
