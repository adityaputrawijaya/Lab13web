<?php

function base_url() {
    global $config;

    return $config['base_url'];
}

function site_url($url) {
    global $config;

    if ($url == '/')
        $url = null;

    if ($config['rewrite']) {
        return base_url() . $url;
    } else {
        return base_url() . '/index.php' . $url;
    } 
}