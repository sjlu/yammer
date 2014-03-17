<?php

class Migration_posts extends CI_Migration {

  function up() {
    $fields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => TRUE
      ),
      'timestamp' => array(
        'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
      ),
      // fake foreign key
      'user_id' => array(
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => true,
      ),
      'text' => array(
        'type' => 'text'
      )
    );

    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('posts');
  }

  function down() {
    $this->dbforge->drop_table('posts');
  }

}