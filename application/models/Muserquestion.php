<?php
class Muserquestion extends CI_Model{
    protected $_table = 'questions';
    public function __construct(){
        parent::__construct();
    }

    public function getListQuestionsByTestid($testId, $lang){
      $this->db->where('lang',$lang);
      $this->db->where('test_id',$testId);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }


}
?>
