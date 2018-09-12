<?php
class AdminResultList extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madminresult");
    $this->load->model("Madminpersonaltype");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $type_id =  $this->input->get('type_id');
    if (!isset($type_id))
      $type_id = 1;
    $personalType = $this->Madminpersonaltype->getListPersonalType();

    $this->_data['list_results'] = $this->Madminresult->getListPersonalsWithLang('en', $type_id);
    $this->_data['types'] = $personalType;

    $this->load->view('/admin/result_list.php', $this->_data);
  }

  public function change(){
    $this->load->model("Madminresult");

    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $idCipher =  $this->input->get('id');

    $id = 0;
    if ($idCipher!=null) {
      $id = decrypted($idCipher);
    }

    $results = $this->Madminresult->getPersonalsAtId($id);
    $this->_data['results'] = $results;

    $this->load->view('/admin/result_item.php', $this->_data);
  }

  public function update () {
    $this->load->model("Madminresult");
    $this->load->model("Madminanswer");

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

    $color_update = array(
      "color" => $data['color']
    );

    $this->Madminanswer->updateAnswerColor($data['old_color'], $color_update);

    $this->session->set_flashdata($this->_flash_mess, "Result updated!");
    redirect('admin-results');
  }

  public function add () {

  }

}
?>
