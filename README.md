PHP based URI proxy
================================================
# What
It's a simple local proxy server to avoid CORS issues while developing locally, should work out of the box ;)

# Why

for all those who are fed up with CORS, when they develop thier project and dont have influence of the Origin flag this is their salvation.

# How
It's React based local server that listens on a specified port and proxies out all incoming requests to configured endpoint and outputs remote response.

## Installing via Composer

```bash
# Install Composer
git clone

curl -sS https://getcomposer.org/installer | php
cd proxy
php composer.phar install
php server.php
```

After installing, you need to configure it a bit, its messy at this point but this is first draft ;-)

```php
$destinationUrl = 'http://www.google.com'; //clearly your destination url
$cors = '*'; // CORS overwrite, feel free to leave it open like this or set to your specific or even mess around
$socket->listen(1337); // this is where you can overwrite the default port, go nuts ;)

```
## Known Issues

1. Even tough verbs are being mapped across for full CRUD, body is not passed over as i never needed it (feel free to contribute if you need this feature)
