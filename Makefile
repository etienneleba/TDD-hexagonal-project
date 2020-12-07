up:
	docker-compose up -d $(c)
stop:
	docker-compose stop -d $(c)
behat:
	docker-compose exec php ./vendor/bin/behat $(cmd)
composer-require:
	docker-compose exec php composer require $(req)
composer-install:
	docker-compose exec php composer install
composer-update:
	docker-compose exec php composer update


