# سامانه پیش ثبت نام و برنامه ریز چمران

Desktop                    |  Mobile
:-------------------------:|:-------------------------:
![alt text](https://raw.githubusercontent.com/SCU-CE/preregistration-and-scheduling/master/storage/app/screenshots/screenshot_2.png)  |  ![alt text](https://raw.githubusercontent.com/SCU-CE/preregistration-and-scheduling/master/storage/app/screenshots/screenshot_1.png)
 

## روش راه اندازی لوکال

1. `git clone https://github.com/SCU-CE/preregistration-and-scheduling.git`
2. run `composer install` in the root of project
3. copy `.env.example.dev` to `.env` and set values
4. run `php artisan key:generate` and `php artisan storage:link`
5. run `php artisan serve` and view on `http://127.0.0.1:8000`

## نقشه دیتابیس

![alt text](https://raw.githubusercontent.com/SCU-CE/preregistration-and-scheduling/master/storage/app/public/database.png)

این سند در حال تکامل می باشد!
