<?php
require(APPPATH . 'libraries/REST_Controller.php');

class Posts extends REST_Controller {

  function _get_user() {
    $this->load->library('google_auth');
    $this->load->model('user_model');

    $email = $this->google_auth->get_session();
    return $this->user_model->get($email);
  }

  function index_post() {
    $input = $this->post();
    $text = $input['text'];
  }

}