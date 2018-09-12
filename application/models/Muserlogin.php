<?php
class Muserlogin extends CI_Model{
    protected $_table = 'users';
    public function __construct(){
        parent::__construct();
    }

    public function getInfoUser($id, $authType){
      $this->db->where('email',$id);
      $this->db->where('oauth_provider',$authType);
      return $this->db->get($this->_table)->result_array();
    }

    public function getUserAtAuthID ($authId) {
      $this->db->where('oauth_uid',$authId);
      return $this->db->get($this->_table)->result_array();
    }

}
?>
