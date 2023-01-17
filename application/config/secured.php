<?php
defined('BASEPATH') || exit('No direct script access allowed');

CONST PASSWORD_SALT = 'siteuniteassiociative';
CONST SITE_CAPTCHA_KEY = '6LfohnAdAAAAAC_-gJyT9KV7Cj7HhoUUNkRVri51';
CONST SITE_CAPTCHA_SECRET_KEY = '6LfohnAdAAAAAKoutNnx4ipblUaFkA_JK7ndCIAF';
CONST SITE_CAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';

$config['captcha'] = FALSE;
$config['auto_create_family'] = FALSE;

