# Development and Testing

Development and testing environment is deployed into this location.

## Installation

### Linux

    $ git clone git@github.com:praxigento/mage_ext_log4php.git
    $ cd ./mage_ext_log4php/test/
    $ composer install
    $ ./vendor/bin/composerCommandIntegrator.php magento-module-deploy

### Windows

    > git clone git@github.com:praxigento/mage_ext_log4php.git
    > cd .\mage_ext_log4php\test\
    > composer install
    > vendor\bin\composerCommandIntegrator.php.bat magento-module-deploy


## Testing

### Linux

    $ phpunit -c mage/app/code/community/Praxigento/Log/Test/phpunit.xml

### Windows

    > php c:\...\phpunit.phar -c mage\app\code\community\Praxigento\Log\Test\phpunit.xml
