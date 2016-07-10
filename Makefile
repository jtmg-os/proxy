install:
	wget https://getcomposer.org/composer.phar
	chmod +x composer.phar
	./composer.phar install
static:
	echo "Running Static Analysis"
	php -l server.php
	php vendor/bin/phpmd server.php text cleancode,codesize,controversial,design,naming,unusedcode
	php vendor/bin/phpcs server.php --report=full --standard=PHPCS
	php vendor/bin/phpcpd server.php
fix:
	php vendor/bin/phpcbf server.php --standard=PHPCS
	php vendor/bin/php-cs-fixer fix server.php
test:
	php vendor/bin/phpunit
