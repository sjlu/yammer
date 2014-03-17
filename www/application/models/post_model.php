<?php

class Post_model extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function create($user_id, $text) {
    $data = array(
      'user_id' => $user_id,
      'text' => $text
    );

    $this->db->insert('posts', $data);

    return $this->get($this->db->insert_id());
  }

  function get($id) {
    $this->db->select(array(
        'posts.id',
        'users.email',
        'posts.text',
        'posts.timestamp'
      ))
      ->where('posts.id', $id)
      ->join('users', 'posts.user_id = users.id');

    $query = $this->db->get('posts');

    if (!$query->num_rows()) {
      return false;
    }

    return $query->row();
  }

  function get_all() {
    $this->db->select(array(
        'posts.id',
        'users.email',
        'posts.text',
        'posts.timestamp'
      ))
      ->join('users', 'posts.user_id = users.id')
      ->order_by("posts.id", "desc");

    $query = $this->db->get('posts');

    if (!$query->num_rows()) {
      return false;
    }

    return $query->result();
  }

}