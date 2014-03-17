<?php
require(APPPATH . 'libraries/REST_Controller.php');

class Posts extends REST_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model(array(
      'post_model',
      'tag_model'
    ));
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
    // get user
    if (!$user = $this->_get_user()) {
      return $this->response(array('error' => 'Not authenticated.'));
    }

    // get input text
    $input = $this->post();
    $text = $input['text'];

    // storing the post
    $post = $this->post_model->create($user->id, $text);

    // extracting all tags and storing
    // them in a many to many relationship
    preg_match_all("/\S*#(?:\[[^\]]+\]|\S+)/", $text, $tags);
    foreach ($tags[0] as $tag) {
      $tag = trim(strtolower($tag));
      $tag = $this->tag_model->get_or_create($tag);
      $this->post_model->add_tag($post->id, $tag->id);
    }

    return $this->response($post);
  }

  function index_get() {

    $posts = $this->post_model->get_all();
    return $this->response($posts);

  }

}