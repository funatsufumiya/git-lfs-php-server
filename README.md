# git-lfs-php-server

A simple PHP server to serve Git LFS requests.

(Do not use this in production. Security is not guaranteed.)

## Configuration

- create `config.inc.php` using `default-config.inc.php` as a template

## Concept

- you can pass `dir` as a http query parameter to specify the directory to store the files (`dir` is relative to the `data/objects` directory)
- if not specified, the files (= `oid`) will be stored in `data/objects`