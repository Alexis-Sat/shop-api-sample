#### Как запустить проект

1. Склонируйте на локальный компьютер.
   ```bash
   git clone ссылка на проект
   ```
2. Скопируйте файл `.env.example` в `.env` и настройте его для своего окружения:
   ```bash
   cp .env.example .env
   ```
3. Запустите контейнеры Docker:
    ```bash
    docker-compose up -d --build
    ```
4. Установите зависимости composer:

 ```bash
    docker-compose exec shop-api composer install
 ```

5. Выполните миграции базы данных и заполните их данными:

```bash
    docker-compose exec shop-api php artisan migrate --seed
```

6. Выполните проверку конкурентных запросов:

```bash
    docker-compose exec shop-api php artisan order:send
```


