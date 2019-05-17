<?php
class AdminQuestionsList extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madmintest");
    $this->load->model("Madminquestion");
    $this->load->model("Madminanswer");
    $this->load->model("Madminresult");
    // echo "print : " . encrypted("kantana"); // Encrypt password
    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $idCipher =  $this->input->get('id');
    $type_id =  $this->input->get('type_id');
    if (!isset($type_id))
      $type_id = 1;

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
        redirect('adminQuestionsList/add');
      } else {
        redirect('adminQuestionsList/update');
      }
    }

    if ($isUpdate == 1) {
      $test = $this->Madmintest->getTestsAtId($id);
      $questions = $this->Madminquestion->getQuestionsAtTestId($id);
      $questionsData = $this->questionsSort ($questions);
      // print("<pre>".print_r($questionsData,true)."</pre>");
      $this->_data['questions'] = $questionsData;
      $this->_data['tests'] = $test;
    }
    $colors = $this->Madminresult->getListResultsNameColor($type_id);
    $this->_data['colors'] = $colors;
    $this->_data['type_id'] = $type_id;

    $this->load->view('/admin/question_list.php', $this->_data);
  }

  private function questionsSort ($questions) {
    $counter = 0;
    $index = 0;
    $questionArray = array ();
    for ($i = 0; $i < sizeof($questions); $i++) {
      if ($counter==0)
        $questionArray[$index]['en'] = $questions[$i]['title'];
      else if ($counter==1)
        $questionArray[$index]['fr'] = $questions[$i]['title'];
      else if ($counter==2)
        $questionArray[$index]['vi'] = $questions[$i]['title'];

      $counter ++;

      if ($counter == 3) {
        $questionsId = $questions[$i]['item_id'];
        $answers = $this->Madminanswer->getAnswerAtQuestionId($questionsId);
        $questionArray[$index]['answers'] = $answers;
        $index++;
        $counter = 0;
      }
    }

    return $questionArray;
  }

  public function add () {
    $this->load->model("Madmintest");

    $data = $this->session->flashdata($this->_flash_post);
    // $dataUser = $this->session->all_userdata();

    // $master_id = $dataUser['id'];
    $currentDate = date('Y-m-d');
    $date = new DateTime();
    $currentTimestamp = $date->getTimestamp();

    // Insert Test for English
    $data_insert_en = array(
      "item_id" => $currentTimestamp,
      "title" => $data['test_name_en'],
      "lang" => 'en',
      "type" => $data['type_id'],
      "position" => $data['position'],
      "updated_date" => $currentDate,
      "delete" => $data['status']
    );
    $this->Madmintest->insertNewTest($data_insert_en);

    // Insert Test for France
    $data_insert_fr = array(
      "item_id" => $currentTimestamp,
      "title" => $data['test_name_fr'],
      "lang" => 'fr',
      "type" => $data['type_id'],
      "position" => $data['position'],
      "updated_date" => $currentDate,
      "delete" => $data['status']
    );
    $this->Madmintest->insertNewTest($data_insert_fr);

    // Insert Test for vn
    $data_insert_vn = array(
      "item_id" => $currentTimestamp,
      "title" => $data['test_name_vn'],
      "lang" => 'vi',
      "type" => $data['type_id'],
      "position" => $data['position'],
      "updated_date" => $currentDate,
      "delete" => $data['status']
    );
    $this->Madmintest->insertNewTest($data_insert_vn);

    $this->session->set_flashdata($this->_flash_mess, "Test has added");

    $this->addQuestions ($currentTimestamp, $data);

    redirect('admin-tests');
  }

  public function addQuestions ($test_id, $postData) {
    $this->load->model("Madminquestion");
    $this->load->model("Madminanswer");

    $countQe = $postData['qeCount'];
    $currentDate = date('Y-m-d');

    $question_insert = array ();
    $answer_insert = array ();

    $list_new_item_ids = array ();
    for ($i = 0; $i < $countQe; $i++) {
      $date = new DateTime();
      $currentTimestamp = $date->getTimestamp();

      // ------------ Question -----------
      // English
      $data_line = array(
        "item_id" => $currentTimestamp.'_'.$i,
        "title" => $postData['questions_'.$i.'_en'],
        "test_id" => $test_id,
        "lang" => 'en',
        "position" => $i,
        "type" => $postData['type_id'],
        "updated_date" => $currentDate,
        "delete" => '0'
      );

      array_push ($question_insert, $data_line);

      // France
      $data_line = array(
        "item_id" => $currentTimestamp.'_'.$i,
        "title" => $postData['questions_'.$i.'_fr'],
        "test_id" => $test_id,
        "lang" => 'fr',
        "position" => $i,
        "type" => $postData['type_id'],
        "updated_date" => $currentDate,
        "delete" => '0'
      );

      array_push ($question_insert, $data_line);

      // vn
      $data_line = array(
        "item_id" => $currentTimestamp.'_'.$i,
        "title" => $postData['questions_'.$i.'_vn'],
        "test_id" => $test_id,
        "lang" => 'vi',
        "position" => $i,
        "type" => $postData['type_id'],
        "updated_date" => $currentDate,
        "delete" => '0'
      );

      array_push ($question_insert, $data_line);
      // ------------ End Question ----------

      // ------------ Answer 1 -------------
      //English
      $data_line = array(
        "item_id" => $currentTimestamp.'_type1_'.$i,
        "title" => $postData['answer_1_'.$i.'_en'],
        "lang" => 'en',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_1_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //France
      $data_line = array(
        "item_id" => $currentTimestamp.'_type1_'.$i,
        "title" => $postData['answer_1_'.$i.'_fr'],
        "lang" => 'fr',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_1_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //vn
      $data_line = array(
        "item_id" => $currentTimestamp.'_type1_'.$i,
        "title" => $postData['answer_1_'.$i.'_vn'],
        "lang" => 'vi',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_1_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      // Add item_id for syncing with personal id
      array_push ($list_new_item_ids, $currentTimestamp.'_type1_'.$i);
      // ------------ ENd Answer 1 -------------

      // ------------ Answer 2 -------------
      //English
      $data_line = array(
        "item_id" => $currentTimestamp.'_type2_'.$i,
        "title" => $postData['answer_2_'.$i.'_en'],
        "lang" => 'en',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_2_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //France
      $data_line = array(
        "item_id" => $currentTimestamp.'_type2_'.$i,
        "title" => $postData['answer_2_'.$i.'_fr'],
        "lang" => 'fr',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_2_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //vn
      $data_line = array(
        "item_id" => $currentTimestamp.'_type2_'.$i,
        "title" => $postData['answer_2_'.$i.'_vn'],
        "lang" => 'vi',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        "color" => $postData['answer_color_2_'.$i],
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);
      array_push ($list_new_item_ids, $currentTimestamp.'_type2_'.$i);

      // ------------ Answer 3 -------------
      //English
      $data_line = array(
        "item_id" => $currentTimestamp.'_type3_'.$i,
        // "title" => $postData['answer_3_'.$i.'_en'],
        "title" => 'Not sure',
        "lang" => 'en',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        // "color" => $postData['answer_color_3_'.$i],
        "color" => '#bdbdbd',
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //France
      $data_line = array(
        "item_id" => $currentTimestamp.'_type3_'.$i,
        // "title" => $postData['answer_3_'.$i.'_fr'],
        "title" => 'Pas certain',
        "lang" => 'fr',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        // "color" => $postData['answer_color_3_'.$i],
        "color" => '#bdbdbd',
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);

      //vn
      $data_line = array(
        "item_id" => $currentTimestamp.'_type3_'.$i,
        // "title" => $postData['answer_3_'.$i.'_vn'],
        "title" => 'Tôi không chắc',
        "lang" => 'vi',
        "questions" => $currentTimestamp.'_'.$i, // add questions ID
        "test_id" => $test_id,
        // "color" => $postData['answer_color_3_'.$i],
        "color" => '#bdbdbd',
        "type" => $postData['type_id'],
        "updated_date" => $currentDate
      );

      array_push ($answer_insert, $data_line);
      array_push ($list_new_item_ids, $currentTimestamp.'_type3_'.$i);
      // ------------ ENd Answer 3 -------------

    }

    $this->Madminquestion->insertListQuestions($question_insert);
    $this->Madminanswer->insertListAnswers($answer_insert);
    $this->Madminanswer->syncPersonalId($list_new_item_ids);

  }

  public function update () {
    $this->load->model("Madminanswer");
    $this->load->model("Madminquestion");
    $this->load->model("Madmintest");

    $data = $this->session->flashdata($this->_flash_post);
    $updateId = $this->session->userdata("updateId");

    $currentDate = date('Y-m-d');
    $active = isset($data['active']) ? $data['active'] : 0;

    // Insert Test for English
    $data_insert_en = array(
      "title" => $data['test_name_en'],
      "type" => $data['type_id'],
      "updated_date" => $currentDate,
      "position" => $data['position'],
      "delete" => $data['status']
    );
    $this->Madmintest->updateTestInfo($updateId, $data_insert_en, 'en');

    // Insert Test for France
    $data_insert_fr = array(
      "title" => $data['test_name_fr'],
      "type" => $data['type_id'],
      "updated_date" => $currentDate,
      "position" => $data['position'],
      "delete" => $data['status']
    );
    $this->Madmintest->updateTestInfo($updateId, $data_insert_fr, 'fr');

    // Insert Test for vn
    $data_insert_vn = array(
      "title" => $data['test_name_vn'],
      "type" => $data['type_id'],
      "updated_date" => $currentDate,
      "position" => $data['position'],
      "delete" => $data['status']
    );

    $this->Madmintest->updateTestInfo($updateId, $data_insert_vn, 'vi');

    $this->Madminquestion->removeQuestionsAtTestId($updateId);
    $this->Madminanswer->removeAnswersAtTestId($updateId);

    $this->addQuestions($updateId, $data);

    $this->session->set_flashdata($this->_flash_mess, "Questions is updated!");

    redirect('admin-tests');
  }

  public function remove () {
    $this->load->model("Madminanswer");
    $this->load->model("Madminquestion");
    $this->load->model("Madmintest");

    $idCipher =  $this->input->get('id');

    $isUpdate = 0;
    $id = 0;
    if ($idCipher!=null) {
      $id = decrypted($idCipher);
    }

    $this->Madminanswer->removeAnswersAtTestId ($id);
    $this->Madminquestion->removeQuestionsAtTestId ($id);
    $this->Madmintest->removeTestAtId ($id);

    $this->session->set_flashdata($this->_flash_mess, "Test Deleted!");

    redirect('admin-tests');
  }

  public function renew () {
    redirect('companymaster');
  }

  private function checkValidationForm (){
    $this->form_validation->set_rules("login_id", "login_id", "required|xss_clean|trim");
    $this->form_validation->set_rules("login_pass", "login_pass", "required|xss_clean|trim");
  }

  public function close(){
    redirect('dashboard');
  }


}
?>
