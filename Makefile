prepare-test:
	./bin/test-prepare.sh

test: prepare-test
	docker-compose exec app php bin/phpunit

post-test:
	docker-compose exec app php bin/console d:d:d --env=test --force
