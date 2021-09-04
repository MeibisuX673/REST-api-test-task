

DOCKER_COMPOSE=@docker-compose
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) web
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) php bin/console
DB_CREATE=$(SYMFONY_CONSOLE) doctrine:database:create

start:
	$(DOCKER_COMPOSE) up --build -d

stop:
	$(DOCKER_COMPOSE) stop

vendor-install:
	$(PHP_DOCKER_COMPOSE_EXEC) composer install

db_create:
	$(SYMFONY_CONSOLE) doctrine:database:create

create-migrations:
	$(SYMFONY_CONSOLE) make:migration

migration: create-migrations
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate

vendor-install:
	$(SYMFONY_CONSOLE) composer install

exec:
	$(DOCKER_COMPOSE_EXEC) $(SERVICE)
