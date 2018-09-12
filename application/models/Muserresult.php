<?php
class Muserresult extends CI_Model{
    protected $_table = 'personals';
    public function __construct(){
        parent::__construct();
    }

    public function getResultByLang($lang){
      $this->db->where('lang',$lang);
      $this->db->select('*');
      $this->db->order_by("item_id", "asc");
      return $this->db->get($this->_table)->result_array();
    }


}
?>
