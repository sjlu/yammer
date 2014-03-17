<?php

/**
 * Default dev configuration
 * Steal this if you like, there's no one
 * important connected to these creds.
 */
$config['google_client_id'] = '163280412174.apps.googleusercontent.com';
$config['google_client_secret'] = '3_Zh-taIeyE238B5WSoQcso6';
$config['google_redirect_uri'] = 'authenticate/callback';

/**
 * Detect heroku environment
 */
if (isset($_SERVER['google_client_id']))  {
  $config['google_client_id'] = $_SERVER['google_client_id'];
}

if (isset($_SERVER['google_client_secret'])) {
  $config['google_client_secret'] = $_SERVER['google_client_secret'];
}

if (isset($_SERVER['google_redirect_uri'])) {
  $config['google_redirect_uri'] = $_SERVER['google_redirect_uri'];

}