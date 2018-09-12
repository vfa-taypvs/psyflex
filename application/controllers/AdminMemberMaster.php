<?php
class AdminMemberMaster extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madminteam");
    $this->load->model("Madminmembertag");

    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $idCipher =  $this->input->get('id');

    $isUpdate = 0;
    $id = 0;
    if ($idCipher!=null) {
      $id = decrypted($idCipher);
      $this->session->set_userdata('update', 1);
      $this->session->set_userdata('updateId', $id);
      $isUpdate = 1;
    }
    else {
      $this->session->unset_userdata('update');
    }

    $data_post = $this->input->post();

    if($data_post!=null) {
      $this->session->set_flashdata($this->_flash_post,$data_post);
      if (isset($data_post['add'])){
        // $this->checkValidationForm(); // Check Validation
        if ($this->form_validation->run() == TRUE) {
          // redirect('admincareeritem/add');
        }
      }
      if ($isUpdate == 0) {
        redirect('adminMemberMaster/add');
      } else {
        redirect('adminMemberMaster/update');
      }
    }

    if ($isUpdate == 1) {
      $member = $this->Madminteam->getMemberAtId($id);
      $tag = $this->Madminmembertag->getTagAtmemberId($id);
      $this->_data['member'] = $member[0];
      $this->_data['tag'] = $tag;
    }

    $this->load->view('/admin/member.php', $this->_data);
  }

  public function add () {
    $this->load->model("Madminteam");
    $this->load->model("Madminmembertag");

    $data = $this->input->post();

    $currentDate = date('Y-m-d');
    $active = isset($data['active']) ? $data['active'] : 0;

    $data_insert = array(
      "name" => $data['name'],
      "position" => $data['position'],
      "description" => trim($data['description']),
      "image" =>  $_FILES['file']['name'],
      "updated_date" => $currentDate,
      "active" => $active
    );

    // print("<pre>".print_r($data_insert,true)."</pre>");

    $this->Madminteam->insertNewMember($data_insert);

    $maxId = $this->Madminteam->selectMaxIdMember();

    $this->addTag($maxId[0]['id'], $data);

    if (isset ($_FILES['file'])) {
      $tmp_name = $_FILES['file']['tmp_name'];
      $filename = $_FILES['file']['name'];

      $uploadfile = $_SERVER['DOCUMENT_ROOT'] . '/files/team/'.$filename;
      // chmod('your-filename.ext',0755);

      if(file_exists($uploadfile)){
        unlink($uploadfile); //remove the file
      }else{
        // echo 'file not found';
      }
      if(move_uploaded_file($tmp_name, $uploadfile)){
  			// $this->Musercareerapplication->insertNewApplication($data_insert);
  		}
    }

    $this->session->set_flashdata($this->_flash_mess, "New Member Added!");

    redirect('adminteam');
  }

  public function update () {
    $this->load->model("Madminteam");
    $this->load->model("Madminmembertag");

    $data = $this->input->post();
    $updateId = $this->session->userdata("updateId");

    $currentDate = date('Y-m-d');
    $active = isset($data['active']) ? $data['active'] : 0;

    $image = "";

    if ($_FILES['file']['size'] > 0) {
      $image = $_FILES['file']['name'];
    } else {
      $image = $data['currentAvatar'];
    }

    $data_insert = array(
      "name" => $data['name'],
      "position" => $data['position'],
      "description" => trim($data['description']),
      "image" => $image,
      "updated_date" => $currentDate,
      "active" => $active
    );

    $this->Madminteam->updateMemberInfo($updateId, $data_insert);

    $this->Madminmembertag->removeTagAtMemberId($updateId);

    $this->addTag($updateId, $data);

    if ($_FILES['file']['size'] > 0) {
      $tmp_name = $_FILES['file']['tmp_name'];
      $filename = $_FILES['file']['name'];

      $uploadfile = $_SERVER['DOCUMENT_ROOT'] . '/files/team/'.$filename;
      // chmod('your-filename.ext',0755);

      if(file_exists($uploadfile)){
        unlink($uploadfile); //remove the file
      }else{
        // echo 'file not found';
      }
      if(move_uploaded_file($tmp_name, $uploadfile)){
        // $this->Musercareerapplication->insertNewApplication($data_insert);
      }
    }

    $this->session->set_flashdata($this->_flash_mess, "Member Updated!");

    redirect('adminteam');
  }

  public function remove () {
    $this->load->model("Madminteam");
    $this->load->model("Madminmembertag");

    $idCipher =  $this->input->get('id');
    $id = decrypted($idCipher);

    $this->Madminmembertag->removeTagAtMemberId($id);
    $this->Madminteam->removeMemberAtId($id);

    redirect('adminteam');
  }


  // Add List REQUIREMENT
  private function addTag ($maxId, $postData) {


    $countDe = $postData['tagCount'];
    $currentDate = date('Y-m-d');

    $data_insert = array ();

    for ($i = 0; $i < $countDe; $i++) {
      $param = 'tag_item_'.$i;
      if (isset ($postData[$param])) {
        $data_line = array(
          "member_id" => $maxId,
          "content" => $postData[$param],
          "updated_date" => $currentDate
        );
        array_push ($data_insert, $data_line);
      }
    }

    $this->Madminmembertag->insertListTagContent($data_insert);
  }

}
?>
