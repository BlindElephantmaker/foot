DOCKER_COMPOSE = docker-compose -f docker/docker-compose.yml -f docker/docker-compose.local.yml --env-file=docker/.env

### Docker
docker-build:
	${DOCKER_COMPOSE} build

docker-up:
	${DOCKER_COMPOSE} up -d --remove-orphans

docker-down:
	${DOCKER_COMPOSE} down

docker-restart:
	${DOCKER_COMPOSE} restart

docker-ps:
	${DOCKER_COMPOSE} ps

docker-exec:
	${DOCKER_COMPOSE} exec php /bin/sh


### Migrations
migrate-diff:
	${DOCKER_COMPOSE} exec php /bin/sh -c "php bin/console doctrine:migrations:diff --no-interaction"

migrate-up:
	${DOCKER_COMPOSE} exec php /bin/sh -c "php bin/console doctrine:migrations:migrate --no-interaction"

migrate-down: # example: ``` make migrate-down name=Version20221018215600 ```
	${DOCKER_COMPOSE} exec php /bin/sh -c "php bin/console doc:migrations:execute --down 'App\Shared\Database\Migration\$(name)' -n"