php-cif-parser
==============

A standalone PHP CIF parser for train/bus schedule files

Installation / Usage
--------------------

The easiest way to use php-cif-parser is to install it with composer. If you don't want to use composer, you can download the project and autoload it manually.

To include the parser in to your project using composer, add the following to your composer.json file:

    ``` json
    {
        "require": {
            "rb-cohen/php-cif-parser": "dev-master"
        }
    }
    ```

Installation from Source
------------------------

To run tests, or develop the library itself, you can clone this project and get everything running with composer:

1. Run `git clone https://github.com/rb-cohen/php-cif-parser.git`
2. Run Composer to get the dependencies: `cd php-cif-parser && php composer.phar install`

You can now run the examples or tests by executing the `examples/xxx.php` scripts: `php /path/to/examples/simple.php`