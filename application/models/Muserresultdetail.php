<?php
class Muserresultdetail extends CI_Model{
    protected $_table = 'result_detail';
    public function __construct(){
        parent::__construct();
    }

    public function insertListResult ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

}
?>
