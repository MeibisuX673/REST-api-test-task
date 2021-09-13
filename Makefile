

DOCKER_COMPOSE=@docker-compose
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) web
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) php bin/console
DB_CREATE=$(SYMFONY_CONSOLE) doctrine:database:create

start:
	$(DOCKER_COMPOSE) up --build -d

stop:
	$(DOCKER_COMPOSE) stop

db-create:
	$(SYMFONY_CONSOLE) doctrine:database:create

create-migrations:
	$(SYMFONY_CONSOLE) make:migration

migration: create-migrations
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate

exec:
	$(DOCKER_COMPOSE_EXEC) $(SERVICE)

generate-keys:
	$(SYMFONY_CONSOLE) lexik:jwt:generate-keypair
