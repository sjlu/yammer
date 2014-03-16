<?php

class Authenticate extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('google_auth');
  }

  function index() {
    $email = $this->google_auth->get_session();
    if (empty($email)) {
      return redirect($this->google_auth->create_auth_url(), 'refresh');
    }

    return redirect(site_url('/'));
  }

  function callback() {
    $auth_code = $this->google_auth->handle_code($this->input->get('code'));
    $email = $this->google_auth->get_session();

    return redirect(site_url('/'));
  }

}