<?php

$settings = array(
    'host' => 'localhost',
    'dbname' => 'squidtechs',
    'user' => 'xavi',
    'password' => 'xavi',
);

$con = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'], $settings['user'], $settings['password'], array(PDO::ATTR_PERSISTENT => true));