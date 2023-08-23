exec-php:
	docker exec php-slotegrator-test-task-php-1 ${CMD}

migrations-status:
	make exec-php CMD="php bin/console doctrine:migrations:status"

migrations-diff:
	make exec-php CMD="php bin/console doctrine:migrations:diff"

migrations-migrate:
	make exec-php CMD="php bin/console doctrine:migrations:migrate"

migrations-generate:
	make exec-php CMD="php bin/console doctrine:migrations:generate"

migrations-list:
	make exec-php CMD="php bin/console doctrine:migrations:list"

migrations-execute-up:
	make exec-php CMD="php bin/console doctrine:migrations:execute DoctrineMigrations'\'${VERSION}"

migrations-execute-down:
	make exec-php CMD="php bin/console doctrine:migrations:execute DoctrineMigrations'\'${VERSION} --down"

migrations-help:
	make exec-php CMD="php bin/console doctrine:migrations"
