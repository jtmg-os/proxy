<?php

/**
 * PHP based Proxy
 *
 * This is small but fast and simple proxy server
 * based on React and Guzzle, use and modify / contribute at will
 *
 * PHP version 5,7
 *
 * @category Proxy
 *
 * @package Server
 *
 * @author Jacek Trefon <jack@trefon.com>
 *
 * @license GPL-3 https://www.gnu.org/licenses/gpl-3.0.en.html
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

    $destinationUrl = 'http://www.google.com';
    $cors = '*';

    $query = $request->getQuery();

    $path = $destinationUrl . $request->getPath();
    if (count($query) > 0) {
        $path = $destinationUrl
            . $request->getPath()
            . '?'
            . http_build_query($query);
    }

    $guzzleClient = new Client();
    $guzzleResponse = $guzzleClient->request($request->getMethod(), $path);

    $headers = array('Origin' => $cors,
        'Content-Type' => $guzzleResponse->getHeaderLine('content-type'));

    $response->writeHead($guzzleResponse->getStatusCode(), $headers);
    $response->end($guzzleResponse->getBody());
};

$loop = Factory::create();
$socket = new SocketServer($loop);
$http = new HttpServer($socket);

$http->on('request', $app);

$socket->listen(1337);
echo "server is now listening for calls..."
$loop->run();
