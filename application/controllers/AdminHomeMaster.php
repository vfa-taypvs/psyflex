<?php
class AdminHomeMaster extends MY_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Madminhome");
    // echo "print : " . encrypted("psyflex"); // Encrypt password
    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $home = $this->Madminhome->getHomeUrl();
    $this->_data['home'] = $home[0];
    $this->load->view('/admin/home.php', $this->_data);
  }


  public function update () {
    $this->load->model("Madminhome");

    $data_post = $this->input->post();

    $currentDate = date('Y-m-d');

    $data_insert = array(
      "url" => $data_post['url'],
      "updated_date" => $currentDate
    );

    $this->Madminhome->updateHome($data_insert);

    $this->session->set_flashdata($this->_flash_mess, "Video has been updated!");
    redirect('adminhome');
  }
}
?>
