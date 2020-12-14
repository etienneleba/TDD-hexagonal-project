up:
	docker-compose up -d $(c)
stop:
	docker-compose stop $(c)
behat:
	docker-compose exec php ./vendor/bin/behat --config behat.yml $(cmd)
phpunit-watcher:
	docker-compose exec php ./vendor/bin/phpunit-watcher watch
composer-require:
	docker-compose exec php composer require $(req)
composer-install:
	docker-compose exec php composer install
composer-update:
	docker-compose exec php composer update
composer-remove:
	docker-compose exec php composer remove $(cmd)
composer-dump-autoload:
	docker-compose exec php composer dump-autoload


