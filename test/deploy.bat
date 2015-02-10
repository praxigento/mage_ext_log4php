composer install
rem Actions after deploy (database creation, files copy, etc)
xcopy ..\src\app\etc\nmmlm mage\app\etc\nmmlm /E /Y /I