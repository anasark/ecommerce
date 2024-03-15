.SILENT:

DOCKER_COMPOSE = docker compose
DOCKER_PHP_CONTAINER_EXEC = $(DOCKER_COMPOSE) exec php

DOCKER_PHP_EXECUTABLE_CMD = php -dmemory_limit=1G

CMD_ARTISAN = $(DOCKER_PHP_EXECUTABLE_CMD) artisan
CMD_COMPOSER = $(DOCKER_PHP_EXECUTABLE_CMD) /usr/bin/composer

start:
	$(DOCKER_COMPOSE) up -d

stop:
	$(DOCKER_COMPOSE) stop

logs:
	$(DOCKER_COMPOSE) logs -ft --tail=50

install:
ifeq (,$(wildcard ./.env))
	cp .env.example .env
endif
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_COMPOSER) install
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN) key:generate
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN) migrate:fresh --seed
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN)  storage:link

clear-cache:
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN) optimize:clear

reset:
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN) migrate:fresh

route-list:
	$(DOCKER_PHP_CONTAINER_EXEC) $(CMD_ARTISAN) route:list

bash:
	$(DOCKER_PHP_CONTAINER_EXEC) bash
