<?php
class Musertest extends CI_Model{
    protected $_table = 'tests';
    public function __construct(){
        parent::__construct();
    }

    public function getListTestByLang($lang){
      $this->db->where('lang',$lang);
      $this->db->where('delete',0);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertResult ($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

}
?>
