# car_api
## Описание
___
    Реализовано:

    1. Миграции для создания необходимого количества таблиц в базе данных, 
        установить связи между ними;

    2. Реализовать API метод получения списка доступных текущему пользователю 
        на запланированное время автомобилей с возможностью фильтрации по модели автомобиля, 
        по категории комфорта;
    
    - Каждая модель автомобиля имеет определенную категорию комфорта (первая, вторая, третья);
    - Для каждого сотрудника доступны автомобили, которые соответствуют его должности и на 1 класс
    комфорта ниже (для работника с типом должности 3 будут соответсвовать автомобили 2 и 3 категории)

## Установка
___
### Docker
    Перед тем как начать, убедитесь, что у вас установлен Docker. Вы можете скачать 
    Docker с официального сайта 
[Docker](https://www.docker.com/get-started)


### Проверка установки Docker
___
    Для проверки, установлен ли Docker, выполните следующую команду в терминале:
```bash
    docker --version
```
    Если Docker установлен правильно, вы увидите сообщение с версией Docker, например:
    Docker version 20.10.7, build f0df350
___
### Запуск
___
    1. Клонируйте репозиторий 
    2. Соберите контейнеры Docker
```bash
    docker compose up --build
```
    3.Проверьте статус контейнеров

```bash
    docker ps
``` 
    Eсли контейнеры запущены правильно, вы увидите сообщение с информацией о контейнерах, например:
    mfo-php-1           mfo-php       "docker-php-entrypoi…"   php           13 hours ago   Up 13 hours   0.0.0.0:8000->8000/tcp, 9000/tcp
    mfo-postgres_db-1   postgres:16   "docker-entrypoint.s…"   postgres_db   13 hours ago   Up 13 hours   0.0.0.0:5432->5432/tcp

    4. Установите и обновите все зависимости composer (В контейнере PHP)
```bash
    docker compose exec php bash -c "composer update"
    
```
    5.Cоздайте файл .env 
```bash
touch .env 

```
    6. Заполните .env содержимым .env.example
```bash
cat .env.example > .env

```
    6. Выполните миграцию
```bash
    docker compose exec php bash -c "php artisan migrate"
```
    7. Наполните БД тестовыми данными.
    !!! Расписание поездок заполняется на текущую неделю, за искоючением выходных !!!
```bash
    docker compose exec php bash -c "php artisan db:seed"
    
``` 
___
    Документация к провекту
[/api/documentation](http://localhost/api/documentation#/)
___

