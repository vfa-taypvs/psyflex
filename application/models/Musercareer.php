<?php
class Musercareer extends CI_Model{
    protected $_table = 'Career';
    public function __construct(){
        parent::__construct();
    }

    public function getlistCareer(){
      $this->db->select('*');
      $this->db->where('active', 1);
      return $this->db->get($this->_table)->result_array();
    }

    public function getCareerAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListFromIndex ($page) {
      $sql = "select * from Career limit 4 offset ".$page;
      $query = $this->db->query($sql);
      // print("<pre>".print_r($query,true)."</pre>");
      return $query->result_array();
    }

    public function getlistCareerFromKeyword($kw){
      $this->db->select('*');
      $this->db->where('active', 1);
      $this->db->like('title', $kw);
      return $this->db->get($this->_table)->result_array();
    }
}
?>
