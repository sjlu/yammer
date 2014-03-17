<?php

class Migration_tags extends CI_Migration {

  function up() {
    $fields = array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => TRUE
      ),
      'tag' => array(
        'type' => 'VARCHAR',
        'constraint' => 255
      )
    );

    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->add_key('tag', TRUE);
    $this->dbforge->create_table('tags');
  }

  function down() {
    $this->dbforge->drop_table('tags');
  }

}