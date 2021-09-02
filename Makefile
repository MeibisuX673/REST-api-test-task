.PHONY: help
.DEFAULT_GOAL = help

DOCKER_COMPOSE=@docker-compose
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) php
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) bin/console

start:
	$(DOCKER_COMPOSE) up --build -d

stop:
	$(DOCKER_COMPOSE) stop

db-create:
	- $(SYMFONY_CONSOLE) doctrine:database:create
	$(SYMFONY_CONSOLE) doctine:schema:update --force

