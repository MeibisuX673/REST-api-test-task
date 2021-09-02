.PHONY: help
.DEFAULT_GOAL = help

DOCKER_COMPOSE=@docker-compose
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) web
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) bin/console

start:
	$(DOCKER_COMPOSE) up --build -d

stop:
	$(DOCKER_COMPOSE) stop

db-create:
	$(SYMFONY_CONSOLE) doctrine:database:create

create-migration:
	$(SYMFONY_CONSOLE) make:migration

migration:
	$(SYMFONY_CONSOLE) doctrine:migrations:migrate

exec:
	$(DOCKER_COMPOSE_EXEC) $(SERVICE)

help: ## Liste des commandes
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
