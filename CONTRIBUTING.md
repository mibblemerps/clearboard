# Clearboard Contributing

## Setting up Development Environment
Homestead is the recommended way to develop with Laravel, although Laravel's internal webserver or an existing webserver are totally fine options too.

### Using Homestead
A `Homestead.yaml` and `Vagrantfile` is provided within the project, so setting up Homestead should be as easy as
installing [Vagrant](http://vagrantup.com) and running `vagrant up` from within the project's root directory.

You will be required to add the following entry to your hosts file to access the webserver inside Homestead:

```
192.168.10.10 clearboard.app
```

If you need help setting up your hosts file, [click here](http://lmgtfy.com/?q=how+to+add+a+hosts+file+entry).

### Using Integrated Server
Simply setup your `.env` file to use SQLite and run:

```
php artisan serve
```

Clearboard will now be running on `localhost:8000`.

## Coding Style
Clearboard inherits most of Laravel's coding style guidelines, which are defined in [PSR-2](http://www.php-fig.org/psr/psr-2/).

This is the coding style that *should* be followed.

## Staging Server
Clearboard has a publicly accessible staging server. It can be accessed at [staging.clearboard.pw](http://staging.clearboard.pw/).

Whenever a commit is made to *master*, the staging server will automatically...

* Pull the latest source code
* Run Composer to get the latest dependencies
* Run database migrations
 
Whilst the staging server is updating (which typically takes about 10 seconds), the staging server will display a message saying "Be right back".