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

    // extracting all tags from the post.
    preg_match_all("/\S*#(?:\[[^\]]+\]|\S+)/", $text, $tags);
    $tags_from_db = array();
    foreach ($tags[0] as $tag) {
      $tag = str_replace("#", "", trim(strtolower($tag)));
      $tag = $this->tag_model->get_or_create($tag);
      $tags_from_db[] = $tag;
    }

    // storing the post & approproiate tags
    $post = $this->post_model->create($user->id, $text);
    // creating relationship
    foreach ($tags_from_db as $tag) {
      $this->post_model->add_tag($post->id, $tag->id);
    }

    return $this->response($post);
  }

  function index_get() {
    $tag = $this->get('tag');

    // If we got a tag from the GET variables, then
    // we shall do a lookup by the tag. Obviously
    // this parameter is optional.
    if (!empty($tag)) {
      if (!$tag = $this->tag_model->get($tag)) {
        return $this->response(); // got nothing
      }

      $posts = $this->post_model->get_all_by_tag($tag->id);
    // If we receive no optional parameters, then we will
    // just grab an unfiltered list.
    } else {
      $posts = $this->post_model->get_all();
    }

    return $this->response($posts);
  }

}