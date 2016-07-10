install:
	wget https://getcomposer.org/composer.phar
	chmod +x composer.phar
	./composer.phar install
static:
	echo "Running Static Analysis"
	php vendor/bin/phpmd server.php text cleancode,codesize,controversial,design,naming,unusedcode
	php vendor/bin/phpcs server.php --report=full --standard=PHPCS
fix:
	php vendor/bin/phpcbf server.php --standard=PHPCS
test:
	php vendor/bin/phpunit
