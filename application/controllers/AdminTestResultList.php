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
    if ($currentPage == 0)
      $currentPage = 1;
    $results = $this->Madmintestresult->getListResults('en', $currentPage, $limit);
    $allResults = $this->Madmintestresult->getAllListResults('en');
    // print("<pre>".print_r($results,true)."</pre>");

    $this->_data['results'] = $results;
    $this->_data['currentPage'] = $currentPage;
    $this->_data['pagesCount'] = sizeof($allResults);
    $this->_data['limit'] = $limit;
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


}
?>
