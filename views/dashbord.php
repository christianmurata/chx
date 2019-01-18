<?php

function _get($args){
    print_r($_SESSION);

    $template = template('dashbord');
    print $template;
}