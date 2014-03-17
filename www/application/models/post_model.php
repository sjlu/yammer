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
    $this->db->where('id', $id);

    $query = $this->db->get('posts');

    if (!$query->num_rows()) {
      return false;
    }

    return $query->row();
  }

}