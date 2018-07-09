<?php

// Set the full path to the docroot
define('DOCROOT', realpath('./') . DIRECTORY_SEPARATOR);

$t = '  ';
$n = "\n";
$application = 'application';
$ske_home = DOCROOT . 'vendor/seth-network/ske/modules/ske-core/';
$koseven_home = DOCROOT . 'vendor/koseven/koseven/';


echo "Checking for required directory structure..." . $n. $n;
if (!file_exists(DOCROOT . $application)) {
    echo $t . 'Creating directory ' . DOCROOT . $application . $n;
    mkdir(DOCROOT . $application);
} else {
    echo $t . "Application directory '" . DOCROOT . $application . "' already exists" . $n;
}
define('APPPATH', realpath($application) . DIRECTORY_SEPARATOR);

foreach (array('cache', 'classes', 'config', 'l18n', 'messages', 'logs', 'view') as $dir) {
    if (!file_exists(APPPATH . $dir)) {
        echo $t . 'Creating directory ' . APPPATH . $dir . $n;
        mkdir(APPPATH . $dir, 0777, true);
    } else {
        echo $t . "Directory '" . APPPATH . $dir . "' already exists." . $n;
    }
}
$files_to_patch = array(
	$koseven_home .'public/install.php' => DOCROOT .'public/install.php',
	$koseven_home .'public/example.htaccess' => DOCROOT .'public/example.htaccess',
	$koseven_home .'modules/minion/miniond' => DOCROOT .'miniond',
);

echo $n . "Patching " . count($files_to_patch) . " files..." . $n. $n;
foreach ($files_to_patch as $src => $dest) {
    if (!file_exists(dirname($dest))) {
        echo $t . 'Creating directory ' . dirname($dest) . $n;
        mkdir(dirname($dest), 0777, true);
    }
    echo $t . "Copy '" . $src . "' -> '" . $dest . "'" . $n;
    copy($src, $dest);
}



$files_to_patch = include($ske_home . 'assets/data/ske_files.php');

echo $n . "Patching " . count($files_to_patch) . " files, based on '" . $ske_home . 'assets/data/ske_files.php' . "'..." . $n. $n;
foreach ($files_to_patch as $src => $dest) {
    if (!file_exists(dirname($dest))) {
        echo $t . 'Creating directory ' . dirname($dest) . $n;
        mkdir(dirname($dest), 0777, true);
    }
    echo $t . "Copy '" . $ske_home . $src . "' -> '" . $dest . "'" . $n;
    copy($ske_home . $src, $dest);
}

echo $n;
echo "# SKE init done, you may now proceed with checking the installation by calling public/index.php in a browser" . $n;
echo "# or use minion CLI for further configuration. Use command to list available minions:" . $n . $n;
echo $t . $t . "./minion" . $n;
