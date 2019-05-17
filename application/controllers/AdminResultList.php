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
    $list_results = $this->Madminresult->getListPersonalsWithLang('en', $type_id);
    $list_character = $this->Madminresult->getListCharacterWithLang('en');
    $this->_data['list_results'] = $list_results;
    $this->_data['list_character'] = $list_character;
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
    $this->load->model("Madminresult");
    $this->load->model("Madminpersonaltype");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $data = $this->input->post();

    if ($data!=null) {
      $currentDate = date('Y-m-d');

      $getMaxItemId = $this->Madminpersonaltype->getMaxItemId();
      $maxItemId = $getMaxItemId[0]['item_id'];
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

      // Add new Personal for new Type
      $personal_insert = array ();
      $defaultColor = '#111111';
      $actionType = ['thinking', 'behavior'];
      $getPersonalItemId = $this->Madminresult->getMaxItemId();
      $maxPersonalItemId = $getPersonalItemId[0]['item_id'];
      for ($i = 0; $i < sizeof ($actionType); $i++) {
        $personal = ['Positive', 'Negative', 'Normal'];

        for ($j = 0; $j < sizeof($personal); $j ++) {
          $maxPersonalItemId ++ ;
          // insert English
          $data_insert = array(
            "name" => 'New '.$personal[$j].' '.$actionType[$i].' - English',
            "item_id" => $maxPersonalItemId,
            "type" => $maxItemId,
            "explanation" => 'New description',
            "color" => $defaultColor,
            "lang" => 'en',
            "updated_date" => $currentDate
          );
          array_push ($personal_insert, $data_insert);
          // insert France
          $data_insert = array(
            "name" => 'New '.$personal[$j].' '.$actionType[$i].' - France',
            "item_id" => $maxPersonalItemId,
            "type" => $maxItemId,
            "explanation" => 'New description',
            "color" => $defaultColor,
            "lang" => 'fr',
            "updated_date" => $currentDate
          );
          array_push ($personal_insert, $data_insert);

          // Insert Vietnamese
          $data_insert = array(
            "name" => 'New '.$personal[$j].' '.$actionType[$i].' - Vietnamese',
            "item_id" => $maxPersonalItemId,
            "type" => $maxItemId,
            "explanation" => 'New description',
            "color" => $defaultColor,
            "lang" => 'vi',
            "updated_date" => $currentDate
          );
          array_push ($personal_insert, $data_insert);
        }

      }

      $this->Madminresult->insertListPersonals($personal_insert);

      $this->session->set_flashdata($this->_flash_mess, "New Personal Type added!");
      redirect('admin-results?type_id='.$maxItemId);
    }
    $this->load->view('/admin/personal_type_add.php', $this->_data);
  }


  public function updateType () {
    $this->load->model("Madminpersonaltype");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $type_id =  $this->input->get('type_id');
    $data = $this->input->post();
    $currentDate = date('Y-m-d');
    if ($type_id!=null) {

      $personalType = $this->Madminpersonaltype->getPersonalTypeAtId($type_id);
      $this->_data['type'] = $personalType;
      $this->load->view('/admin/personal_type_add.php', $this->_data);

    } else if ($data!=null) {
      $item_id = $data['item_id'];
      // Update English
      $data_update = array(
        "type_name" => $data['personal_name_en'],
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->updatePersonalTypeInfo($item_id, $data_update, 'en');

      // Update France
      $data_update = array(
        "type_name" => $data['personal_name_fr'],
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->updatePersonalTypeInfo($item_id, $data_update, 'fr');

      // Update Vietnamese
      $data_update = array(
        "type_name" => $data['personal_name_vi'],
        "updated_date" => $currentDate
      );
      $this->Madminpersonaltype->updatePersonalTypeInfo($item_id, $data_update, 'vi');

      $this->session->set_flashdata($this->_flash_mess, "Personal Type updated!");
      redirect('admin-results?type_id='.$item_id);
    }

  }

  public function ajaxChangeCharacter () {
    $this->load->model("Madminresult");
    $this->load->model("Madminanswer");

    $item_id = $this->input->post('item_id');
    $character_id = $this->input->post('character_id');
    $old_color = $this->input->post('old_color');

    $color = $this->getColorWithCharacter($character_id);
    $data_update = array(
      "character_id" => $character_id,
      "color" => $color
    );
    $this->Madminresult->updateCharacterAtPersonal($item_id, $data_update);

    $this->Madminanswer->updateAnswerColorAtType($item_id, $color);

    $data = array(
            'result'      => "success"
            );
    echo json_encode($data);
  }

  private function getColorWithCharacter ($character_id) {
    if ($character_id == 1)
      return "#6548E0";
    else if ($character_id == 2)
      return "#FFC000";
    else if ($character_id == 3)
      return "#119F18";
    else if ($character_id == 4)
        return "#FF0000";

  }
}
?>
