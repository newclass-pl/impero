README
======

![license](https://img.shields.io/packagist/l/bafs/via.svg?style=flat-square)
![PHP 5.6+](https://img.shields.io/badge/PHP-5.6+-brightgreen.svg?style=flat-square)

What is Impero?
-----------------

Impero is command line manager.

Installation
------------

The best way to install is to use the composer by command:

    composer require newclass/impero
    composer install

Use example
-------------
    use Impero\CommandExecutor;
    
    $executor = new CommandExecutor();
    $executor->register(new MyCommand()); //class implemented Impero\CommandInterface
    $executor->register(new MySecondCommand());  //class implemented Impero\CommandInterface
    $executor->execute($argv);
    
Run test
-------------
    php ./vendor/bin/phpunit
