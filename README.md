**kveo**
====

  
[![Build Status](https://travis-ci.org/n0ni0/kveo.svg?branch=master)](https://travis-ci.org/n0ni0/kveo) 
[![Coverage Status](https://coveralls.io/repos/github/n0ni0/kveo/badge.svg?branch=master)](https://coveralls.io/github/n0ni0/kveo?branch=master)

This applications is created with the PHP Framework Symfony 3.  
kveo simulates a social network where users can rate and comments movies, series, documentaries, tv programms, etc..


Api [branch](https://github.com/n0ni0/kveo/tree/api) in progress
-----------------------

kveo use this bundles:
-----------------------

[FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) -- User management  
[KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) -- Paginate results  
[LiipImagineBundle](https://github.com/liip/LiipImagineBundle) -- Image manipulation  
[GravatarBundle](https://github.com/henrikbjorn/GravatarBundle) -- Wrapper to gravatar API  
[EasyAdminBundle](https://github.com/javiereguiluz/EasyAdminBundle) -- Admin generator  
[VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle) -- Ease file uploads attached to entities (Required to easyadmin upload files)  
[StarRatingBundle](https://github.com/blackknight467/StarRatingBundle/blob/master/composer.json) -- Star rating




**Installation**
------------

- Clone the repository from github

```
$ git clone git@github.com:n0ni0/kveo.git <your-path-to-install>
$ cd <your-path-to-install>
```

- Use Composer to get the dependencies

```
$ composer install
```

-  Set up the Database and load example dates

```
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create
$ php bin/console doctrine:fixtures:load
```

- Run a built-in web server

```
$ php bin/console server:run
```

- And type in your favourite browser:

```
http://127.0.0.1:8000
```

> **NOTE**
>
> To use built-in web server you need PHP 5.4 or higher
> http://http://symfony.com/doc/current/cookbook/web_server/built_in.html
>
> If you're using PHP 5.3, configure your web server to point at the web/ directory of the project.
> http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
>


**Users created in fixtures**  
   name: `username`  
   pass: `username`  

   name: `admin`  
   pass: `admin`  