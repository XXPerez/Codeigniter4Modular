# CodeIgniter 4 Modular Structure Application Starter

## What is CodeIgniter Modular ?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).
The modular structure allows to separate each module from other, having each one, controllers, filters, libraries, languages, models, routes, validations and views.   

| app | Modules | Module | Structure |
| --- | ------- | ------ | --------- | 
| app/ | Modules/ | Dashboard/ | Config/ | 
| app/ | Modules/ | Dashboard/ | Controllers/ | 
| app/ | Modules/ | Dashboard/ | Language/ | 
| app/ | Modules/ | Dashboard/ | Views/ | 
| app/ | Modules/ | Users/ | Config/ | 
| app/ | Modules/ | Users/ | Controllers/ | 
| app/ | Modules/ | Users/ | Filters/ | 
| app/ | Modules/ | Users/ | Language/ | 
| app/ | Modules/ | Users/ | Libraries/ | 
| app/ | Modules/ | Users/ | Models/ | 
| app/ | Modules/ | Users/ | Validation/ | 
| app/ | Modules/ | Users/ | Views/ | 

This repository holds a composer-installable app starter, with jQuery, Bootstrap4, and Login/Register fully working module examples
It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 

## Installation & updates

```sh
composer create-project xxperez/codeigniter4-modular codeigniter4-modular
```
then 
```sh
cd codeigniter4-modular
composer update
``` 
whenever there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Go to codeigniter4-modular directory.
Copy `env` to `.env` and tailor for your app, specifically the baseURL
and default database settings:

```sh
app.baseURL = 'http://localhost'

database.default.hostname = localhost
database.default.database = database
database.default.username = username
database.default.password = password
database.default.DBDriver = MySQLi
database.default.port = 3306
```

After database configuration, check migrations to ensure the table users are created:
Run : 
```sh
php spark migrate
```

## Modular configuration
Add this lines to your .env, and adapt as necessary. The example files have english and spanish translations:

```sh
#--------------------------------------------------------------------
# LANGUAGE
#--------------------------------------------------------------------
app.defaultLocale = 'en'
app.supportedLocales = ['en','es','fr','de']
app.negotiateLocale = true
app.appTimezone = 'America/Chicago'
```


## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script. 
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)


