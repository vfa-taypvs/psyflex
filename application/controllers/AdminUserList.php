<?php
class AdminUserList extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madminuser");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);


    $this->_data['list_users'] = $this->Madminuser->getListUsers();
    $this->load->view('/admin/user_list.php', $this->_data);
  }

  public function detail(){
    $this->load->model("Madminuser");
    $this->load->model("Madmintestresult");

    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $idCipher =  $this->input->get('id');

    $id = 0;
    if ($idCipher!=null) {
      $id = decrypted($idCipher);
    }

    $users = $this->Madminuser->getUserAtId($id);
    $tests = $this->Madmintestresult->getListResultsFromUser($id, 'en');
    $this->_data['user'] = $users[0];
    $this->_data['tests'] = $tests;

    $this->load->view('/admin/user_item.php', $this->_data);
  }

  public function update () {
    $this->load->model("Madminresult");

    $data = $this->input->post();

    $currentDate = date('Y-m-d');

    // Update English
    $data_insert = array(
      "name" => $data['result_name_en'],
      "explanation" => $data['result_expl_en'],
      "color" => $data['color'],
      "updated_date" => $currentDate
    );
    $this->Madminresult->updatePersonalInfo($data['item_id'], $data_insert, "en");

    // Update France
    $data_insert = array(
      "name" => $data['result_name_fr'],
      "explanation" => $data['result_expl_fr'],
      "color" => $data['color'],
      "updated_date" => $currentDate
    );
    $this->Madminresult->updatePersonalInfo($data['item_id'], $data_insert, "fr");

    // Update Vietnamese
    $data_insert = array(
      "name" => $data['result_name_vi'],
      "explanation" => $data['result_expl_vi'],
      "color" => $data['color'],
      "updated_date" => $currentDate
    );
    $this->Madminresult->updatePersonalInfo($data['item_id'], $data_insert, "vi");

    $this->session->set_flashdata($this->_flash_mess, "Result updated!");
    redirect('admin-results');
  }

}
?>
