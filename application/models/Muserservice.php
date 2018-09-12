<?php
class Muserservice extends CI_Model{
    protected $_table = 'Services';
    public function __construct(){
        parent::__construct();
    }

    public function getListSerivices(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getServiceAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAllServicesAtRow($row){
      $this->db->where('row',$row);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

}
?>
