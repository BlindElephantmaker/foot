DOCKER_COMPOSE = docker-compose -f docker/docker-compose.yml -f docker/docker-compose.local.yml --env-file=docker/.env

### Docker
docker-build:
	${DOCKER_COMPOSE} build

docker-up:
	${DOCKER_COMPOSE} up -d

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

migrate-down:
	${DOCKER_COMPOSE} exec php /bin/sh -c "php bin/console doc:migrations:execute --down 'DoctrineMigrations\$(name)' -n"