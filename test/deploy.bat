mkdir mage
composer install
rem Actions after deploy (database creation, files copy, etc)
copy ..\src\app\etc\nmmlm mage\app\etc