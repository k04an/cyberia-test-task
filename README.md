# Реестр книг для Cyberia
## Установка
Склонируйте этот репозиторий
```bash
git clone https://github.com/k04an/cyberia-test-task.git
```

Устновите зависимости
```bash
composer install
```

Создайте MySQL базу данных. Затем скопируйте `.env.example` и назовите его `.env`.

Измините следующие строчки в файле `.env`
```bash
DB_CONNECTION=mysql
DB_HOST=      # Хост сервера БД
DB_PORT=3306  # Смена порта при необходимости
DB_DATABASE=  # Имя БД
DB_USERNAME=  # Имя бользователя для доступа к БД
DB_PASSWORD=  # Пароль от польователя
```

Проведите миграцию и выполните заполнение БД тестовыми данными
```bash
php artisan migrate:fresh --seed
```

Сгенерируйте ключ приложения
```bash
php artisan key:generate
```

Запустете веб-сервер PHP или испольуйте другой веб сервер сославшись на директорию `public`
```bash
php artisan serve
```

## Данные для входа
Для входа в администраторскую панель управления создается пользователь `k04an` с паролем `rosebud`

Данные аутентификации авторов через API можно изменить в панели управления. Пароли авторов не могут быть просмотренны, так как они хранятся в хешированном виде, поэтому для теста API нужно создать нового автора с заранее известным паролем или изменить пароль у существующего автора.

## Логирование
Создание, изменение и удаление книг записыватся в файл `storage/logs/laravel.log`

## Точки доступа API
В репозитории приложен файл `insomnia_collection.json` содержащий коллекцию всех API запросов для [Insomnia v4](https://insomnia.rest/). Файл содержит переменные среды `url` и `token` для конфигурации.
### Аутентификация
| Маршрут      | Метод | Описание                                                                                                                                                           |
|--------------|-------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `/api/login` | POST  | Аутентификация под автором. Необходимо предоставить ключи `login` и `password` в теле запроса Form URL Encoded или Multi-form data. Возвращает JSON с ключем token |

Для дальнейшей аутентификации запросов необходимо сообщать серверу полученный токен в заголовке `Authorization` с префиксом `Bearer`

### Взамодействие с книгами
| Маршрут          | Метод  | Описание                                                                                                                                                                                                                                                 | Аутентификация |
|------------------|--------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------|
| `/api/books`     | GET    | Получить список книг разбитый по страницам. Необходимо предоставить URL query `page` с числовым значением страницы. Возвращает JSON объект с ключами текущей страницы `page`, общего числа страниц `pageNumber`, и массива `data` с информацией о книгах | Нет            |
| `/api/book/{id}` | GET    | Получить информацию о книге по `id`.                                                                                                                                                                                                                     | Нет            |
| `/api/book/{id}` | PUT    | Обновить информацию о книге. Необходимо предоставить данные в теле запроса Form URL encoded. Обязательные данные: `name`, `edition` может быть числом от 0 до 2, массив `genres[]` содержащий id жанров. Возвращает измененный экземпляр книги           | Да             |
| `/api/book/{id}` | DELETE | Удалить книгу по `id`.                                                                                                                                                                                                                                   | Да             |

### Взаимодействие с авторами
| Маршрут            | Метод | Описание                                                                                                                                                                                                                                                                            | Аутентификация |
|--------------------|-------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------|
| `/api/authors`     | GET   | Получить список авторов разбитый по страницам. Данные о страницах предоставляются в том же формате что и для книг. В ключе ответа `data` содержится массив с данными об авторах с указанием кол-ва их книг.                                                                         | Нет            |
| `/api/author/{id}` | GET   | Получить данные об авторе по `id`. В ключе `books` вложен массив со всеми книгами указанного автора                                                                                                                                                                                 | Нет            |
| `/api/author/{id}` | PUT   | Изменить данные об авторе. Изменять можно только свои данные. Необходимо предоставить данные в теле запроса Form URL encoded: `first_name`, `second_name`, `login`, `password`. После изменения данных отзываются все api токены, по этому необходимо пройти аутентификацию заново. | Да             |

### Взаимодействие с жанрами
| Маршрут       | Метод | Описание                                                                                                                                                                                                                       | Аутентификация |
|---------------|-------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------|
| `/api/genres` | GET   | Получить список жанров разбитый по страницам. Данные предоставляются в том же формате что и для книг и авторов. В ключе ответа `data` содержится массив жанров с вложенным массивом `books` со списком книг имеющий этот жанр. | Нет            |

# Послесловие
Надеюсь на ответ с вашей строны 💖.