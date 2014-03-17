<?php
require(APPPATH . 'libraries/REST_Controller.php');

class Posts extends REST_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('post_model');
  }

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

    $post = $this->post_model->create($user->id, $text);

    return $this->response($post);
  }

  function index_get() {

    $posts = $this->post_model->get_all();
    return $this->response($posts);

  }

}