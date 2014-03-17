<?php

class Welcome extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('google_auth');
  }

  function index() {
    if (!$email = $this->google_auth->get_session()) {
      return redirect(site_url('authenticate'));
    }

    $this->load->view('header');
    $this->load->view('pages/welcome');
    $this->load->view('footer');
  }

}
