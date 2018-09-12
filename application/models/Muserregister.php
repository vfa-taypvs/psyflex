<?php
class Muserregister extends CI_Model{
    protected $_table = 'users';
    public function __construct(){
        parent::__construct();
    }

    public function addNewUser($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

}
?>
