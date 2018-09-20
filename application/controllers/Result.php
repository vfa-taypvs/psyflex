<?php
class Result extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Muserquestion");
    $this->load->model("Museranswer");
    $this->load->model("Muserresult");
    $this->load->model("Musertest");

    $this->_data['title'] = 'Result';
    $this->_data['id_page'] = "l_result";

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "vi";
    }
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------
    // UserLogin
    $user = $this->session->userdata('user');
    $this->_data['user'] = $user;
    if (!isset($user)) {
      // Have to Login for doing Test
      $this->session->set_flashdata($this->_flash_mess, "Please login to do the test!");
      redirect('login');
    }

    $testIdCipher =  $this->input->get('id');
    $type_id =  $this->input->get('type_id');
    $testId = 0;
    if ($testIdCipher!=null) {
      $testId = decrypted($testIdCipher);
    }

    // Get Data From The Tests
    $answers = $this->session->userdata('answers_result_'.$testId);

    // print("<pre>".print_r($answers,true)."</pre>");

    $results = $this->Muserresult->getResultByLang($lang, $type_id);

    $resultInit = $this->initResultList($answers, $results);

    // print("<pre>".print_r($resultInit,true)."</pre>");

    $this->_data['results'] = $resultInit;
    $this->_data['testId'] = $testId;
    $this->load->view('/user/result.php', $this->_data);
  }

  private function initResultList ($answers, $resultDtb) {
    $points = $answers['point'];

    $resultArray = $resultDtb;
    for ($i = 0; $i < sizeof($resultDtb); $i++) {
      $colorDtb = $resultDtb[$i]['color'];
      $point = 0;
      if (isset($points[$colorDtb]))
        $point = $points[$colorDtb];
      $resultArray [$i]['point'] = $point;
    }

    return $resultArray;
  }


}
?>
