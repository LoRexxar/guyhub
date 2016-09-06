<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'WebIndex';
$route['404_override'] = '';     //这个路由表示当用户请求了一个不存在的页面时该加载哪个控制器，它将会覆盖默认的 404 错误页面。
$route['translate_uri_dashes'] = FALSE;
