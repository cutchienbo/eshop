<?php
$configs['app'] = [
    'providers' => array(
        JD\Cloudder\CloudderServiceProvider::class,
    ),

    'aliases' => array(
        'Cloudder' => JD\Cloudder\Facades\Cloudder::class,
    ),
];
