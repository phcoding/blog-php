<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/23
 * Time: 16:01
 */
use ph\Input\Input;

include ("lib/Input.class.php");

$input = new Input();

$input->session_set('key','1');

echo $input->session('key');

$input->session_set('key');

echo gettype($input->session('key'));
