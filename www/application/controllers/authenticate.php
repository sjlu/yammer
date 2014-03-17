<?php

class Authenticate extends MY_Controller {

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
    if (!$auth_code = $this->google_auth->handle_code($this->input->get('code'))) {
      return show_error('Failed to authenticate callback code with Google.', 500);
    }

    if (!$email = $this->google_auth->get_session()) {
      return show_error('Could not retrieve account from Google.', 500);
    }

    $this->load->model('user_model');
    $this->user_model->create($email);

    return redirect(site_url('/'));
  }

}