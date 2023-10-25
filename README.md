# Link Shortener
![PHP](https://img.shields.io/badge/PHP-8.1.17-brightgreen)
![Symfony](https://img.shields.io/badge/Symfony-6-yellow)
![POSTGRESQL](https://img.shields.io/badge/postgres-14.7-blue)
![REDIS](https://img.shields.io/badge/redis-7.0.10-yellowgreen)
![NGINX](https://img.shields.io/badge/nginx-1.23.4-brightgreen)


## Обзор
Данный сервис предназначен для предоставления сокращенных ссылок.

---

## Структура проекта по директория:
```
├── bin
├── config
│   ├── packages
│   └── routes
├── docker
│   ├── nginx
│   ├── php-fpm
│   ├── postgres
│   └── redis
├── migrations
├── public
└── src
├── Command
├── Controller
├── Entity
│   ├── Base
│   ├── Interface
│   ├── Main
│   └── Platform
├── Model
│   ├── Command
│   ├── Entity
│   │   └── Interface
│   ├── Factory
│   │   └── Interface
│   ├── Handler
│   │   └── Error
│   ├── Helper
│   └── Service
│       ├── Interface
│       └── Redis
│           └── Interface
└── Repository
├── Main
└── Platform
```

- **docker** - контейнеры докер и docker-compose.yml
- **src** - директория с кодом проекта
  - **Command** - консольные команды
    - AddUserCommand - добавить пользователя в систему
    - GenLinksCommand - генерация сокращенных ссылок в БД по частям (по 30000)
    - GetLinksForRedisCommand - перенос сокращенных ссылок в redis, чтобы сократить время запроса на создание ссылки.
    Количество ссылок в редисе = .env -> CACHED_LINKS_QTY 
    - RegistryDomainCommand - регистрация нового домена(клиента) в системе. Занесение его информации в БД
    - ReplaceLinksCommand - добавление original_url к линку в БД
    - SendWithTimeoutCommand - отправка Response по таймауту
  - **Controller** - контроллеры сервиса
    - DispatcherController - редирект на настоящий URL
    - RestController - выдача short_url и запрос на бэк
  - **Entity** - сущности сервиса
  - **Repository** - репозитории сервиса/системы
  - **Model** - папка с основной логикой сервиса/системы
    - Command - ООП. Команды
    - Entity - сущности
    - Factory - ООП. Фабрика
    - Handler - обработчики 
      - Error - обработчики ошибок
    - Helper - Помощники
    - Service - Сервисы и процессоры системы

## Раскатка сервиса

### Настройка окружения /PROJECT_ROOT/.env
Для настройки окружения, необходимо:
1) дописать в файл .env настройки окружения

### Настройка докер окружения /PROJECT_ROOT/docker/.env
1) дописать в файл .env настройки окружения

! В продовой версии xdebug должен быть выключен 
#### Описание en

### Докер-сборка
Сервис обёрнут в докер-контейнеры.

Для того, чтобы собрать сервис достаточно выполнить команду:

```make dc_duild```

Для запуска проекта необходимо выполнить команду:

```make dc_up```

### Миграции
#### Создание БД
```php bin/console doctrine:database:create```

#### Создание миграции
```php bin/console make:migration```

#### Выполнение миграции
```php bin/console doctrine:migrations:migrate```

---
**All rights reserved**