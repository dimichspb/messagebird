<?php

require_once (dirname(__DIR__) . '/vendor/autoload.php');


$default_opts = array(
    'https' => array(
        'proxy' => "spbsrv-proxy2.t-systems.ru:3128"
    )
);

$default = stream_context_set_default($default_opts);

