<?php
/**
 * Created by PhpStorm.
 * User: Jarne
 * Date: 19.05.16
 * Time: 12:16
 */

// Name of the .phar file
$name = "Worlds";

// Files and folders to pack in the phar
$files = array("resources", "src", "plugin.yml");

// Functions
function run($command) {
    exec($command, $output, $status);

    if($status < 1) {
        return $output;
    } else {
        return false;
    }
}

// Run
echo ' ____        _ _     _ _____         _   
| __ ) _   _(_) | __| |_   _|__  ___| |_ 
|  _ \| | | | | |/ _` | | |/ _ \/ __| __|
| |_) | |_| | | | (_| | | |  __/\__ \ |_ 
|____/ \__,_|_|_|\__,_| |_|\___||___/\__|';
echo "\n\n";
echo "(C) 2016 by jjplaying\n";
echo "https://github.com/jjplaying\n\n";


echo "Setting up environment ...\n\n";
run("mkdir build");

foreach($files as $file) {
    if(file_exists($file) OR is_dir($file)) {
        exec("mv " . $file . " build/" . $file);
    }
}

echo "Building phar file ...\n";
if(run("php -dphar.readonly=0 DevTools.phar --make build --out " . $name . ".phar") AND file_exists($name . ".phar")) {
    echo "Success!\n\n";
} else {
    echo "Failed!";
    exit(1);
}

echo "Collecting artifacts ...\n";
run("mkdir output");
run("mv " . $name . ".phar output/" . $name . ".phar");