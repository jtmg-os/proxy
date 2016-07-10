<?php

/**
 * PHP based Proxy.
 *
 * This is small but fast and simple proxy server
 * based on React and Guzzle, use and modify / contribute at will
 *
 * PHP version 5,7
 *
 * @category Proxy
 *
 * @copyright 2016 Jack Trefon Media Group
 * @author    Jacek Trefon <jack@trefon.com>
 * @license   GPL-3 https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/jtrefon
 */
require_once 'vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\Server as SocketServer;
use React\Http\Server as HttpServer;
use React\Http\Request;
use React\Http\Response;
use GuzzleHttp\Client;

$app = function (Request $request, Response $response) {
    $config = include 'config.php';
    $query  = $request->getQuery();

    $path = $config['destinationUrl'].$request->getPath();
    if (count($query) > 0) {
        $param = http_build_query($query);
        $path  = $config['destinationUrl'].$request->getPath().'?'.$param;
    }

    try {
        $guzzleClient   = new Client();
        $guzzleResponse = $guzzleClient->request(
            $request->getMethod(),
            $path,
            $request->getHeaders()
        );

        $headers = $guzzleResponse->getHeaders();
        $headers['Access-Control-Allow-Origin'] = $config['corsOrigin'];

        $response->writeHead($guzzleResponse->getStatusCode(), $headers);
        $response->end($guzzleResponse->getBody());
    } catch (\Exception $e) {
        echo "\nError: ".$e->getMessage();
    }

};

$loop   = Factory::create();
$socket = new SocketServer($loop);
$http   = new HttpServer($socket);

$http->on('request', $app);
$config = include 'config.php';
$socket->listen($config['port']);
echo 'server is now listening for calls on port: '.$config['port'];
$loop->run();
