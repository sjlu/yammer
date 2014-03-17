<?php

class User_model extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function create($email) {
    $data = array(
      'email' => $email
    );

    $this->db->insert('users', $data);
  }

  function get($email) {
    $this->db->where('email', $email)
      ->from('users');

    $query = $this->db->get();

    if (!$query->num_rows()) {
      return false;
    }

    return $query->row();
  }

}