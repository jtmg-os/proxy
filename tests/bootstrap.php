<?php
// Command that starts the built-in web server
$command = 'php server.php &';

// Execute the command and store the process ID
$output = array();
system($command, $output);
$pid = (int) $output[0];
echo "\n we are in: ".getcwd();
echo sprintf(
        '%s - Web server started with PID %d',
        date('r'),
        $pid
    ) . PHP_EOL;

// Kill the web server when the process ends
register_shutdown_function(function() use ($pid) {
    echo sprintf('%s - Killing process with ID %d', date('r'), $pid) . PHP_EOL;
    exec('kill ' . $pid);
});