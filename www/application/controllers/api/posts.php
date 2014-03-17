<?php
require(APPPATH . 'libraries/REST_Controller.php');

class Posts extends REST_Controller {

  function _get_user() {
    $this->load->library('google_auth');
    $this->load->model('user_model');

    if (!$email = $this->google_auth->get_session()) {
      return FALSE;
    }

    return $this->user_model->get($email);
  }

  function index_post() {
    // get input text
    $input = $this->post();
    $text = $input['text'];

    // get user
    if (!$user = $this->_get_user()) {
      return $this->response(array('error' => 'Not authenticated.'));
    }

    $this->load->model('post_model');
    $post = $this->post_model->create($user->id, $text);

    return $this->response($post);
  }

}