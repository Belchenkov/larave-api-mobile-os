## Workflow Server

Сервернай часть для МБ Основа. Использован фреймворк laravel <a href="https://laravel.com/docs/5.8">https://laravel.com/docs/5.8</a>
                                                     
## Установка

1. ```git clone project```

1. ```cd directory ```

1. ```composer install```

1. ```cp .env.example .env```

1. ```php artisan key:generate```

1. Настройка .env

1. ```php artisan migrate```

1. ```php artisan db:seed``` 

В качестве БД используется MSSQL Server. Для корректной рабой с БД использовать следующие расширения для php
- sqlsrv
- pdo_sqlsrv 
> <a href="https://docs.microsoft.com/ru-ru/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-2017">https://docs.microsoft.com/ru-ru/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-2017

