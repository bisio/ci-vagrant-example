<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_Posts extends CI_Migration
{
  public function up()
  {
    $field = array(
      'created_at' => array(
        'type' => 'timestamp',
      ),
    );
    $this->dbforge->add_column('posts', $field);
  }

  public function down()
  {
    $this->dbforge->drop_table('posts');
  }
}
