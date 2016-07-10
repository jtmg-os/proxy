PHP based URI proxy
================================================
###Status
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c6ab12c647154b61bf6ef18fcfdbd252)](https://www.codacy.com/app/j-trefon/proxy?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jtmg-os/proxy&amp;utm_campaign=Badge_Grade)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7490a8ab-c205-433d-858b-1cd8860f9a15/mini.png)](https://insight.sensiolabs.com/projects/7490a8ab-c205-433d-858b-1cd8860f9a15)
[![Build Status](https://travis-ci.org/jtmg-os/proxy.svg?branch=master)](https://travis-ci.org/jtmg-os/proxy)

# What
It's a simple local proxy server to avoid CORS issues while developing locally, should work out of the box ;)

# Why

for all those who are fed up with CORS, when they develop thier project and dont have influence of the Origin flag this is their salvation.

# How
It's React based local server that listens on a specified port and proxies out all incoming requests to configured endpoint and outputs remote response.

## Installing via Composer

```bash
# Install Composer
git clone https://github.com/jtmg-os/proxy.git
cd proxy

curl -sS https://getcomposer.org/installer | php

php composer.phar install
php server.php
```

After installing, you need to configure it a bit, its messy at this point but this is first draft ;-)

```php
destinationUrl => 'http://www.google.com' //clearly your destination url
corsOrigin => '*' // CORS overwrite, feel free to leave it open like this or set to your specific or even mess around
port => '1337' // this is where you can overwrite the default port, go nuts ;)

```
## Known Issues

1. Even tough verbs are being mapped across for full CRUD, body is not passed over as i never needed it (feel free to contribute if you need this feature)
