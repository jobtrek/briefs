# Configuration

## Fichier `.env`

Le fichier `.env` contient toutes les configurations spécifiques à l'environnement. Voici les principales variables à configurer :

- `APP_NAME` : Nom de l'application
- `APP_ENV` : Environnement d'exécution (local, production, etc.)
- `APP_DEBUG` : Activer/désactiver le mode debug
- `DB_CONNECTION` : Type de connexion à la base de données
- `DB_HOST` : Hôte de la base de données
- `DB_PORT` : Port de la base de données
- `DB_DATABASE` : Nom de la base de données
- `DB_USERNAME` : Nom d'utilisateur de la base de données
- `DB_PASSWORD` : Mot de passe de la base de données

## Configuration Docker

Le fichier `docker-compose.yml` contient la configuration des services Docker. Vous pouvez ajuster les paramètres en fonction de vos besoins spécifiques.

```yaml
services:
    laravel.test:
        build:
            context: ./vendor/laravel/sail/runtimes/8.3
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: sail-8.3/app
        extra_hosts:
            - 'host.docker.internal:host-gateway'
        ports:
            - '${APP_PORT:-80}:80'
            - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
        environment:
            WWWUSER: '${WWWUSER}'
            LARAVEL_SAIL: 1
            XDEBUG_MODE: '${SAIL_XDEBUG_MODE:-off}'
            XDEBUG_CONFIG: '${SAIL_XDEBUG_CONFIG:-client_host=host.docker.internal}'
            IGNITION_LOCAL_SITES_PATH: '${PWD}'
        volumes:
            - '.:/var/www/html'
        networks:
            - sail
        depends_on:
            - pgsql
            - redis
            - meilisearch
            - mailpit
    pgsql:
        image: 'postgres:15'
        ports:
            - '${FORWARD_DB_PORT:-5432}:5432'
        environment:
            PGPASSWORD: '${DB_PASSWORD:-secret}'
            POSTGRES_DB: '${DB_DATABASE}'
            POSTGRES_USER: '${DB_USERNAME}'
            POSTGRES_PASSWORD: '${DB_PASSWORD:-secret}'
        volumes:
            - 'sail-pgsql:/var/lib/postgresql/data'
            - './vendor/laravel/sail/database/pgsql/create-testing-database.sql:/docker-entrypoint-initdb.d/10-create-testing-database.sql'
        networks:
            - sail
        healthcheck:
            test:
                - CMD
                - pg_isready
                - '-q'
                - '-d'
                - '${DB_DATABASE}'
                - '-U'
                - '${DB_USERNAME}'
            retries: 3
            timeout: 5s
    redis:
        image: 'redis:alpine'
        ports:
            - '${FORWARD_REDIS_PORT:-6379}:6379'
        volumes:
            - 'sail-redis:/data'
        networks:
            - sail
        healthcheck:
            test:
                - CMD
                - redis-cli
                - ping
            retries: 3
            timeout: 5s
    meilisearch:
        image: 'getmeili/meilisearch:latest'
        ports:
            - '${FORWARD_MEILISEARCH_PORT:-7700}:7700'
        environment:
            MEILI_NO_ANALYTICS: '${MEILISEARCH_NO_ANALYTICS:-false}'
        volumes:
            - 'sail-meilisearch:/meili_data'
        networks:
            - sail
        healthcheck:
            test:
                - CMD
                - wget
                - '--no-verbose'
                - '--spider'
                - 'http://localhost:7700/health'
            retries: 3
            timeout: 5s
    mailpit:
        image: 'axllent/mailpit:latest'
        ports:
            - '${FORWARD_MAILPIT_PORT:-1025}:1025'
            - '${FORWARD_MAILPIT_DASHBOARD_PORT:-8025}:8025'
        networks:
            - sail
networks:
    sail:
        driver: bridge
volumes:
    sail-pgsql:
        driver: local
    sail-redis:
        driver: local
    sail-meilisearch:
        driver: local