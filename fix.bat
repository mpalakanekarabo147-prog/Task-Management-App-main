@echo off
set PATH=C:\Users\Andile~1\.config\herd\bin\php84;%PATH%
echo Using PHP:
php -v
echo.
echo Clearing config...
php artisan config:clear
php artisan cache:clear
echo Running migrations...
php artisan migrate --force
echo Seeding database...
php artisan db:seed --force
echo Creating storage link...
php artisan storage:link
echo.
echo All done! Open http://task-management-app.test
pause
