<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'artikel';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['masuk']            = 'auth';

$route['artikel/(:any)']    = 'Artikel/read/$1';

$route['about-us']   = 'Artikel/page/about';
$route['contact-us'] = 'Artikel/page/contact';