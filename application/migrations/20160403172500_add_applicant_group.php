<?php
defined('BASEPATH') OR exit('Please go out of here');

class Migration_Add_applicant_group extends CI_Migration{
  public function up(){
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 10,
        'unsigned' => TRUE,
        'auto_increment' => TRUE,
      ),
      'no_reg' => array(
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
        'type' => 'varchar',
        'constraint' => '255'
      ),
      'activity' => array(
        'type' => 'varchar',
        'constraint' => '255'
      ),
      'chairman_nik' => array(
        'type' => 'INT',
        'constraint' => '10'
      ),
      'secretary_nik' => array(
        'type' => 'INT',
        'constraint' => '10'
      ),
      'finance_manager_nik' => array(
        'type' => 'INT',
        'constraint' => '10'
      ),
      'membership' => array(
        'type' => 'INT',
        'constraint' => '3'
      ),
      'applicant_id' => array(
        'type' => 'INT',
        'constraint' => '10'
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('applicant_group');
  }

  public function down(){
    $this->dbforg->drop_table('applicant_group');
  }
}
