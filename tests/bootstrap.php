<?php
// Command that starts the built-in web server
$command = 'php server.php';

// Execute the command and store the process ID

//shell_exec($command);

//echo "Starting server" . PHP_EOL;

// Kill the web server when the process ends
register_shutdown_function(function() {
//    exec('killall php ');
//    echo "killed server" . PHP_EOL;
});