.PHONY: helpers
helpers:
	php artisan ide-helper:generate
	php artisan ide-helper:models -F helpers/ModelHelper.php -M
	php artisan ide-helper:meta

.PHONY: format
format:
	./vendor/bin/pint
	prettier --write resources/js

.PHONY: lint
lint:
	./vendor/bin/phpstan analyse
	eslint --ext .js,.vue --ignore-path .gitignore --fix resources/js

.PHONY: test
test:
	./vendor/bin/pest

.PHONY: security
security:
	./vendor/bin/security-checker security:check
	npm audit
