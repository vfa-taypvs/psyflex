<?php
class AdminloginMaster extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("MadminLogin");
    // echo "print : " . encrypted("psyflex"); // Encrypt password
    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);
    // Validate Input Rule

    $data_post = $this->input->post();
    if($data_post!=null) {
      $this->checkValidationForm(); // Check Validation
      if ($this->form_validation->run() == TRUE) {

        // Post data
        $login_id = $this->input->post("login_id");
        $login_pass = $this->input->post("login_pass");

        $result = $this->MadminLogin->getInfoAdmin($login_id);

        if ($result == null) {
          $this->session->set_flashdata($this->_flash_mess, "Wrong username or password!");
          redirect('adminlogin');
        } else  {
          $adInfo = $result[0];
          $login_pass_decode = decrypted($adInfo['password']);
          if ($login_pass != $login_pass_decode){
            $this->session->set_flashdata($this->_flash_mess, "Wrong username or password!");
            redirect('adminlogin');
          } else {
            $user = $this->session->set_userdata('userlogin', $login_id);
            redirect('admin-tests');
          }
        }

      }
    }
    $this->load->view('/admin/index.php', $this->_data);
  }


  private function checkValidationForm (){
    $this->form_validation->set_rules("login_id", "login_id", "required|xss_clean|trim");
    $this->form_validation->set_rules("login_pass", "login_pass", "required|xss_clean|trim");
  }


}
?>
