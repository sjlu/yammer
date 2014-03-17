<?php

class Migration_tags_posts extends CI_Migration {

  function up() {
    $fields = array(
      'tag_id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true
      ),
      'post_id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true
      )
    );

    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('tag_id');
    $this->dbforge->create_table('tags_posts');
  }

  function down() {
    $this->dbforge->drop_table('tags_posts');
  }

}