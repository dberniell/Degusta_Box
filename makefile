.PHONY: start
start: erase build up db ## clean current environment, recreate dependencies and spin up again

.PHONY: rebuild
rebuild: start ## same as start

.PHONY: erase
erase: ## stop and delete containers, clean volumes.
		docker-compose stop
		docker-compose rm -v -f

.PHONY: stop
stop: ## stop environment
		docker-compose stop

.PHONY: build
build: ## build environment and initialize composer and project dependencies
		docker-compose build --parallel
		docker-compose run --rm php-fpm sh -lc 'COMPOSER_MEMORY_LIMIT=-1 composer install'
		docker-compose run --rm ionic sh -lc 'echo n | npm install && ionic build'

.PHONY: up
up: ## spin up environment
		docker-compose up -d

.PHONY: composer-update
composer-update: ## Update project dependencies
		docker-compose run --rm php-fpm sh -lc 'COMPOSER_MEMORY_LIMIT=-1 composer update'

.PHONY: phpunit
phpunit: ## execute project unit tests
		docker-compose exec php-fpm sh -lc "./bin/phpunit $(conf)"

.PHONY: db
db: ## recreate database
		docker-compose exec php-fpm sh -lc 'php ./bin/console d:d:d --force'
		docker-compose exec php-fpm sh -lc 'php ./bin/console d:d:c'
		docker-compose exec php-fpm sh -lc 'php ./bin/console d:m:m -n'
