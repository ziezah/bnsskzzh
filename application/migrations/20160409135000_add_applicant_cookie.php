<?php
defined('BASEPATH') OR exit('Please go out of here');

class Migration_Add_applicant_cookie extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'cookie_id' => array(
        'type' => 'varchar',
        'constraint' => 16,
      ),
      'applicant_id' => array(
        'type' => 'INT',
        'constraint' => 10,
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('applicant_cookie');
  }

  public function down(){
    $this->dbforg->drop_table('applicant_cookie');
  }
}

