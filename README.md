Repository to show a bug with PEST PHP in combination with PhpStorm. 

Reported here: https://github.com/pestphp/pest-intellij/issues/73

---

In one of my Laravel projects the directory structure is a bit different as the common 'standard'.  I ended up with the following error when running tests directly in PhpStorm.

### Error

> Testing started at 13.50 ...
> /usr/local/Cellar/php/7.4.11/bin/php /Users/username/Development/valet/projectX/libraries/vendor/pestphp/pest/bin/pest --teamcity --configuration /Users/username/Development/valet/projectX/libraries/phpunit.xml /Users/username/Development/valet/projectX/tests/Unit/ExamplePestTest.php --filter=/^P\\Tests\\Unit\\ExamplePestTest::it\sasserts\strue\sis\strue(\swith\s\(.*\)(\s#\d+)?)?$/
> 
>    Pest\Exceptions\FileOrFolderNotFound 
> 
>   The file or folder with the name `composer.json` not found.
> 
> Process finished with exit code 1

This seems to happen because `ValidatesEnvironment()` in `bin/pest` is searching for `composer.json in` in `/Users/username/Development/valet/projectX/` instead of `/Users/username/Development/valet/projectX/libraries/`

### Notes

- Running tests with PHPUnit trough Console works ✅
- Running tests with PHPUnit trough PhpStorm works ✅
- Running tests with PEST trough Console works ✅
- Running tests with PEST trough PhpStorm **works NOT** ❌

### Project structure

> \ Some Directories
> |        |
> |        |_  ///
> | 
> \ Laravel (libraries)
> |        |
> |        |_ app
> |        |_ config
> |        |_ database
> |        |_ storage
> |        **|_ vendor**
> |        **|_ composer.json**
> |        **|_ phpunit.xml**
> |
> \ Some Directories
> |        |
> |        |_  ///
> | 
> \ Tests (tests)
>          |
>          |_ Feature
>          |_ Unit
>          **|_ Helpers.php**
>          **|_ Pest.php**

### Composer.json

>     "autoload-dev": {
>         "psr-4": {
>             "Tests\\": "../tests/"
>         }
>     },

### phpunit.xml

>     <testsuites>
>         <testsuite name="Unit">
>             <directory suffix="Test.php">../tests/Unit/*</directory>
>         </testsuite>
>         <testsuite name="Feature">
>             <directory suffix="Test.php">../tests/Feature/*</directory>
>         </testsuite>
>     </testsuites>


### Setup

PhpStorm 2020.2.2
Pest Plugin 0.4.1
Laravel 8
PHP 7.4
