<?php

function connect()
{
    $settings = array(
        'host' => 'ezdev2',
        'dbname' => 'ayurame',
        'user' => 'ayurame',
        'password' => 'mb34dev',
    );

    $con = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'], $settings['user'], $settings['password'], array(PDO::ATTR_PERSISTENT => true));

    return $con;
}

function closeCon($conn)
{
    $conn->close();
}