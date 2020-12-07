up:
	docker-compose up -d $(c)
stop:
	docker-compose stop -d $(c)
behat:
	docker-compose exec php ./vendor/bin/behat $(cmd)