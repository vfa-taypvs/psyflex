<?php
class Muserresult extends CI_Model{
    protected $_table_personal = 'personals';
    protected $_table_result = 'result';
    public function __construct(){
        parent::__construct();
    }

    public function getResultByLang($lang, $type_id){
      $this->db->where('lang',$lang);
      $this->db->select('*');
      $this->db->where('type',$type_id);
      $this->db->order_by("item_id", "asc");
      return $this->db->get($this->_table_personal)->result_array();
    }

    public function getTestFromResult($result_id) {
      $this->db->where('id',$result_id);
      $this->db->select('id, test_id');
      return $this->db->get($this->$_table_result)->result_array();
    }

    public function getPointFromResult($result_id) {
      $this->db->where('id',$result_id);
      $this->db->select('user_id, point_1, point_2, point_3, point_4, point_5, point_6, updated_date');
      return $this->db->get($this->_table_result)->result_array();
    }

}
?>
