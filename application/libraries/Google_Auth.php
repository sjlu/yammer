<?php

class Google_Auth {

  private $ci;
  private $client;
  private $client_id;
  private $client_secret;
  private $redirect_uri;

  function __construct() {

    $this->ci =& get_instance();
    $this->ci->load->library('session');

    // Get configuration variables from
    // applicaiton/config/google.php
    $this->ci->config->load('google');
    $this->client_id = $this->ci->config->item('google_client_id');
    $this->secret_id = $this->ci->config->item('google_client_secret');
    $this->redirect_uri = $this->ci->config->item('google_redirect_uri');

    // Loading Google PHP Library.
    // Note that this is being loaded through
    // Composer.phar. Or PHP global libraries if
    // you want.
    require_once 'Google/Client.php';
    require_once 'Google/Service/Oauth2.php';

    $this->client = new Google_Client();

    // Load credentials and scope.
    $this->client->setClientId($this->client_id);
    $this->client->setClientSecret($this->secret_id);
    $this->client->setScopes("email");

    // So Google requires this to be set EVERYWHERE.
    // I don't understand why I need to specify the
    // redirect URI if I'm authenticating a token they
    // have passed to me? I guess it's part of their
    // encryption validation.
    $this->ci->load->helper('url');
    $redirect_url = site_url($this->redirect_uri);
    // This is confusing too because they actually want
    // a URL, not a URI...
    $this->client->setRedirectUri($redirect_url);
  }

  // This generates a auth URL to redirect to Google
  // so that they can login and authenticate our app.
  function create_auth_url() {
    return $this->client->createAuthUrl();
  }

  // After Google has handled their end, they redirect
  // back to us with a $_GET['code'] param. We then
  // need to authenticate that code with Google and finall
  // grab an access token.
  function handle_code($code) {
    try {
      $this->client->authenticate($code);
      $access_token = $this->client->getAccessToken();
    } catch (Exception $e) {
      return FALSE;
    }

    // set the access token to the session
    return $this->set_session($access_token);
  }

  // Lets store the session in a cookie.
  function set_session($access_token) {
    try {
      $this->client->setAccessToken($access_token);
    } catch (Exception $e) {
      $this->ci->session->unset_userdata('google_access_token');
      return FALSE;
    }

    $this->ci->session->set_userdata('google_access_token', $access_token);
    return TRUE;
  }

  // Check to see if we have a session
  function get_session() {
    $access_token = $this->ci->session->userdata('google_access_token');
    if (!empty($access_token)) {
      if (!$this->set_session($access_token)) {
        return FALSE;
      }
    }

    // Get the user email
    try {
      $oauth2 = new Google_Service_Oauth2($this->client);
      $email = $oauth2->userinfo->get()->email;
    } catch (Exception $e) {
      return FALSE;
    }

    if (empty($email)) {
      return FALSE;
    }

    return $email;
  }

}

