<?php
defined('BASEPATH') OR exit('Please go out of here');

class Migration_Add_group extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'noreg' => array(
        'type' => 'INT',
        'constraint' => '16'
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'registered_date' => array(
        'type' => 'DATE'
      ),
      'address' => array(
        'type' => 'TEXT'
      ),
      'part_of' => array(
        'type' => 'VARCHAR',
        'constraint' => '255'
      ),
      'membership' => array(
        'type' => 'INT',
        'constraint' => '16'
      ),
      'membership_list' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('group');
  }

  public function down(){
    $this->dbforg->drop_table('group');
  }
}
