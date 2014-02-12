<?php

$opt = getopt("c::r");

// if this request isn't from the internal
// server assume they want to run the server
if (php_sapi_name() === 'cli' AND isset($opt['r'])) {
    $dir = realpath(__DIR__."/../vendor/sami/sami/sami.php");
    $conf = __DIR__."/api.php";
    $cmd = "$dir {$opt['c']} $conf";
    echo `$cmd`;
    exit;
}

require __DIR__."/../vendor/autoload.php";

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__.'/../../core/src')
;

return new Sami($iterator, array(
    'title'               => 'Bolt Dir',
    'theme'               => 'enhanced',
    'build_dir'           => __DIR__.'/../api/',
    'cache_dir'           => __DIR__.'/../api/cache',
    'include_parent_data' => false,
    'default_opened_level' => 2
));