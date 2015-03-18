<?php
ini_set('error_reporting', E_ALL); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$autoload = require dirname(dirname(__FILE__)) . '/vendor/autoload.php';
$autoload->add('AnalogueTest', __DIR__);

// Date setup
date_default_timezone_set('Europe/Berlin');

// Copy DB Template to a temp db
copy(__DIR__.'/test.sqlite', __DIR__.'/temp.sqlite');


use Analogue\ORM\Plugins\Timestamps\TimestampsPlugin;
use Analogue\ORM\Plugins\SoftDeletes\SoftDeletesPlugin;

// Some shortcut function
function get_analogue()
{
    $testDb = [
        'driver'   => 'sqlite',
        'database' => __DIR__.'/temp.sqlite',
        'prefix'   => '',
    ];

    $analogue = new Analogue\ORM\Analogue($testDb);

    $analogue->registerPlugin(new TimestampsPlugin);
    $analogue->registerPlugin(new SoftDeletesPlugin);

    return $analogue;
}

function get_mapper($entity)
{
    return get_analogue()->mapper($entity);
}

function tdd($value)
{
    echo var_dump($value);
    die;
}
