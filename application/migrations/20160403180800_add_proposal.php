<?php
defined('BASEPATH') OR exit('Please go out of here');

class Migration_Add_proposal extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'title' => array(
        'type' => 'TEXT',
        'null' => TRUE
      ),
      'purpose' => array(
        'type' => 'TEXT',
        'null' => TRUE 
      ),
      'needed_amount' => array(
        'type' => 'INT',
        'constraint' => '16'
      ),
      'needs' => array(
        'type' => 'TEXT'
      ),
      'pic' => array(
        'type' => 'VARCHAR',
        'constraint' => 255
      ),
      'applicant_id' => array(
        'type' => 'INT',
        'constraint' => '16'
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('proposal');
  }

  public function down(){
    $this->dbforg->drop_table('proposal');
  }
}
