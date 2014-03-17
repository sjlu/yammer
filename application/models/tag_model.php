<?php

class Tag_model extends CI_Model {

  function get_or_create($tag) {
    if (!$row = $this->get($tag)) {
      $this->create($tag);
      $row = $this->get($tag);
    }

    return $row;
  }

  function get($tag) {
    $this->db->where('tag', $tag);

    $query = $this->db->get('tags');

    if (!$query->num_rows()) {
      return false;
    }

    return $query->row();
  }

  function create($tag) {
    $data = array(
      'tag' => $tag
    );

    $this->db->insert('tags', $data);
  }

}