# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library


## Tampilan Web
Login Page
![Screen Shot 2023-10-15 at 21 13 50](https://github.com/afiifatuts/ci4-student-management/assets/32781700/790e162d-5b3e-4f72-b5f7-11e21527b3b3)

Tampilan Awal
![Screen Shot 2023-10-15 at 21 18 38](https://github.com/afiifatuts/ci4-student-management/assets/32781700/7ba4503b-af5a-4da4-9c91-a0fdc9d0e97f)

Menu Mahasiswa
![Screen Shot 2023-10-15 at 21 14 05](https://github.com/afiifatuts/ci4-student-management/assets/32781700/e430a23f-9e09-4001-bcd1-291f49fe98a1)

Tambah Data
![Screen Shot 2023-10-15 at 21 18 51](https://github.com/afiifatuts/ci4-student-management/assets/32781700/742b4398-7a37-4ef8-aee7-cbb1ebf20a9d)

Tambah Banyak Data
![Screen Shot 2023-10-15 at 21 19 06](https://github.com/afiifatuts/ci4-student-management/assets/32781700/465c237e-f5a4-4f64-8722-4a001e7f9e6c)





