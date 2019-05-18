<?php
class AdminTestResultList extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madmintestresult");
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $limit = 10;

    $currentPage =  $this->input->get('page');
    $perpage =  $this->input->get('per_page');
    if ($currentPage == 0)
      $currentPage = 1;
    if ($perpage == 0)
      $perpage = $limit;
    $results = $this->Madmintestresult->getListResults('en', $currentPage, $perpage);
    $allResults = $this->Madmintestresult->getAllListResults('en');
    // print("<pre>".print_r($results,true)."</pre>");

    $this->_data['results'] = $results;
    $this->_data['currentPage'] = $currentPage;
    $this->_data['pagesCount'] = sizeof($allResults);
    $this->_data['limit'] = $perpage;
    $this->load->view('/admin/test_result_list.php', $this->_data);
  }

  public function detail(){
    $this->load->model("Madminresult");
    $this->load->model("Madmintestresult");
    $this->load->model("Madminresultdetail");

    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $idCipher =  $this->input->get('id');
    $type_id =  $this->input->get('personal_type_id');

    $id = 0;
    if ($idCipher!=null) {
      $id = decrypted($idCipher);
    }

    $result = $this->Madmintestresult->getListResultsFromId($id, 'en');
    $personals = $this->Madminresult->getListPersonalsWithLang('en', $type_id);
    $answers = $this->Madminresultdetail->getListResultDetail('en', $result [0]['id']);

    // print("<pre>".print_r($answers,true)."</pre>");

    $this->_data['result'] = $result [0];
    $this->_data['personals'] = $personals;
    $this->_data['answers'] = $answers;

    $this->load->view('/admin/test_result_item.php', $this->_data);
  }

  public function graphCompare () {
    $this->load->model("Muserquestion");
    $this->load->model("Museranswer");
    $this->load->model("Muserresult");
    $this->load->model("Musertest");
    $this->load->model("Madminuser");

    $test_id =  $this->input->get('test');
    $type_id = $tests = $this->Musertest->getTestFromId('en', $test_id);
    $results = $this->Muserresult->getResultByLang('en', $type_id[0]['type']);

    // Result 1
    $result_id_1 =  $this->input->get('id_1');
    $points = $this->Muserresult->getPointFromResult($result_id_1);;
    $resultInit = $this->initResultListFromPoints($points[0], $results);
    // print("<pre>".print_r($resultInit,true)."</pre>");
    $this->_data['results_1'] = $resultInit;

    // Result 2
    $result_id_2 =  $this->input->get('id_2');
    $points = $this->Muserresult->getPointFromResult($result_id_2);
    $resultInit = $this->initResultListFromPoints($points[0], $results);
    // print("<pre>".print_r($resultInit,true)."</pre>");
    $this->_data['results_2'] = $resultInit;

    $this->load->view('/admin/compare_result.php', $this->_data);
  }

  private function initResultListFromPoints ($points, $resultDtb) {
    $resultArray = $resultDtb;
    $user = $this->Madminuser->getUserAtId($points['user_id']);
    for ($i = 0; $i < sizeof($resultDtb); $i++) {
      $resultArray [$i]['point'] = $points['point_'.($i + 1)];
    }
    $resultArray['updated_date'] = $points['updated_date'];
    $resultArray['user'] = $user[0]['first_name'].' '.$user[0]['last_name'];
    return $resultArray;
  }

}
?>
