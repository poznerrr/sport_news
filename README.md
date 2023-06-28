<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



Для корректной работы приложения необходимы предустановленный PHP >= 8.1.0 , composer

## Установка и первый запуск

После того, как вы скопировали данный проект на свой сервер, необходимо:

#### 1. Установить зависимости (composer install)
#### 2. Установить зависимости фронт-енда (npm install)
#### 3. В корневом каталоге создать и настроить .env файл, пример - файл .env.example
#### 4. Произвести миграции (команда php artisan migrate), если бд не создана, согласиться на создание
#### 5. (OPTIONAL)  Заполнить таблицы тестовыми данными (команда php artisan db:seed)
#### 6. (OPTIONAL) Для работы на встроенном сервере запустить командой php artisan serve
#### 7. Запустить командой npm run dev фронт-енд часть приложения
#### 8. Для обработки картинок загружаемых новостей необходима работа очередей командой php artisan queue:work

## Заполнение базы данных информацией с сайта slamdunk.ru

#### Для работы парсера необходимо, чтобы в таблице users присутстовало поле с name => Administrator, в таблице categories присутсвтовало поле с name => Basketball
#### (данные поля создаются с помощью дефолтного сидинга или вручную)

#### Консольная команда парсинга запускается командой php artisan app:parse-news <linksPath>, где <linksPath> - полный путь до файла .csv с ссылками на новости с сайта slamdunk.ru
#### (дефолтный файл со ссылками /resources/data/links.csv)
