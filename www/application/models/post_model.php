<?php

class Post_model extends CI_Model {

  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->db->query("SET time_zone='+0:00'");
  }

  function add_tag($post_id, $tag_id) {
    $data = array(
      'post_id' => $post_id,
      'tag_id' => $tag_id
    );

    $this->db->insert('tags_posts', $data);
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

  function get_by_ids($posts_ids) {
    $this->db->select(array(
        'posts.id',
        'users.email',
        'posts.text',
        'posts.timestamp'
      ))
      ->join('users', 'posts.user_id = users.id')
      ->order_by("posts.id", "desc")
      ->where_in('posts.id', $posts_ids);

    $query = $this->db->get('posts');
    if (!$query->num_rows()) {
      return false;
    }

    return $query->result();
  }

  function get_all_by_tag($tag_id) {
    /**
     * First get all posts that are referenced
     * by the given tag Id.
     */
    $this->db->where('tag_id', $tag_id)
      ->select('post_id');

    $query = $this->db->get('tags_posts');
    if (!$query->num_rows()) {
      return false;
    }

    $posts_ids = array();
    foreach ($query->result() as $post) {
      $posts_ids[] = $post->post_id;
    }

    /**
     * Then get all the posts by the IDs
     * we have retrieved.
     */
    return $this->get_by_ids($posts_ids);
  }

}