<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ADMIN
$route['login/super'] = 'admin/login';

// FRONT
$route['home'] = 'front/home';

// SCHOOL
$route['login/sch'] = 'school/login';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
