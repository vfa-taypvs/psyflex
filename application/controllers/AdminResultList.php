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
    $this->_data['type_id'] = $type_id;

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

  public function addType () {
    $this->load->model("Madminpersonaltype");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $data = $this->input->post();

    if ($data!=null) {
      $currentDate = date('Y-m-d');

      $getMaxItemId = $this->Madminpersonaltype->getMaxItemId();
      $maxItemId = $getMaxItemId[0]['item_id'];
      echo $maxItemId;
      $maxItemId++;

      // Update English
      $data_insert = array(
        "item_id" => $maxItemId,
        "type_name" => $data['personal_name_en'],
        "lang" => 'en',
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->insertNewPersonalType($data_insert);

      // Update France
      $data_insert = array(
        "item_id" => $maxItemId,
        "type_name" => $data['personal_name_fr'],
        "lang" => 'fr',
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->insertNewPersonalType($data_insert);

      // Update Vietnamese
      $data_insert = array(
        "item_id" => $maxItemId,
        "type_name" => $data['personal_name_vi'],
        "lang" => 'vi',
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->insertNewPersonalType($data_insert);


      $this->session->set_flashdata($this->_flash_mess, "New Personal Type added!");
      redirect('admin-results?type_id='.$maxItemId);
    }
    $this->load->view('/admin/personal_type_add.php', $this->_data);
  }

}
?>
