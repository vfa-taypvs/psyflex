<?php
class Muserhome extends CI_Model{
  protected $_table = 'Home';
  public function __construct(){
      parent::__construct();
  }

  public function getHomeUrl(){
    $this->db->select('*');
    return $this->db->get($this->_table)->result_array();
  }
}
?>
