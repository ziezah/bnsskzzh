<?php
defined('BASEPATH') OR exit('Please go out of here');

class Migration_Add_applicant extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'nik' => array(
        'type' => 'INT',
        'constraint' => '16'
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'job' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'birth_place' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'birth_day' => array(
        'type' => 'DATE'
      ),
      'address' => array(
        'type' => 'TEXT'
      ),
      'position' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'group_id' => array(
        'type' => 'INT',
        'constraint' => '255',
        'null' => TRUE
      ),
      'username' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
        'null' => TRUE
      ),
      'password' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('applicant');
  }

  public function down(){
    $this->dbforg->drop_table('applicant');
  }
}
