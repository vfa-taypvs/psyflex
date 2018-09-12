<?php
class Register extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('name')){
      redirect('dashboard');
    }

    // Load linkedin config
    $this->load->config('linkedin');

    // Load facebook library
    $this->load->library('facebook');
  }

  public function index(){
    $this->load->model("Musertest");
    $this->_data['title'] = 'Register';
    $this->_data['id_page'] = "";

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "vi";
    }

    $this->lang->load('register',$lang);
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Social Network
    $this->_data['authURL_FB'] = $this->facebook->login_url();
    $this->_data['authURL_Twitter'] = $this->getTwitterAuth();
    $this->_data['authURL_linkedin'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
    $this->_data['authURL_google'] = $this->getGoogleAuth();

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------

    $this->load->view('user/register.php', $this->_data);
  }

  private function getTwitterAuth () {
    //Twitter API Configuration
    $consumerKey = 'OkxmkjQ4oXiukr467VuDaN1B7';
    $consumerSecret = 'GCFqUIHBvLXctm03XKFVshdqhYERvEtUfbq9NzHHsLSYMxYARR';
    $oauthCallback = base_url().'login/twitter_auth';
    //Include the twitter oauth php libraries
    include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";

    //unset token and token secret from session
    $this->session->unset_userdata('token');
    $this->session->unset_userdata('token_secret');

    //Fresh authentication
    $connection = new TwitterOAuth($consumerKey, $consumerSecret,'2477966881-1wO5QyQ89aTD1OReXdsP8fU4ZLSI3k3zB4G1UTK', 'BnpFvO5TOEtp5djJ95A5u2Ytt1KAZ2h4bOW1zuUcJKX2N');
    $requestToken = $connection->getRequestToken($oauthCallback);

    //Received token info from twitter
    $this->session->set_userdata('token',$requestToken['oauth_token']);
    $this->session->set_userdata('token_secret',$requestToken['oauth_token_secret']);

    //Any value other than 200 is failure, so continue only if http code is 200
    if($connection->http_code == '200'){
        //Get twitter oauth url
        $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
        $data['oauthURL'] = $twitterUrl;
    }else{
        $data['oauthURL'] = base_url().'user_authentication/twitter';
        $data['error_msg'] = 'Error connecting to twitter! try again later!';
    }
    return $data['oauthURL'];
  }

  private function getGoogleAuth () {
    // Include two files from google-php-client library in controller
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

    // Store values in variables from project created in Google Developer Console
    $client_id = '885009573118-l1rf1lnked9jpv9o6d9rqd8g81rfuquv.apps.googleusercontent.com';
    $client_secret = 'DoZkp8WsXh1DXxaD-9Pg61Kd';
    $redirect_uri = 'http://localhost/psyflex/login/google_auth';
    $simple_api_key = 'AIzaSyChrdsTRcYJ3GCzE9s7uFSxV7_RCL6Laeo';

    // Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName("Psyflex Google OAuth Login Example");
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->setDeveloperKey($simple_api_key);
    $client->addScope("https://www.googleapis.com/auth/userinfo.email");

    $authUrl = $client->createAuthUrl();
    return $authUrl;
  }

  public function doRegister () {
    $this->load->model("Muserregister");

    $data = $this->input->post();
    $dataUser = $this->session->all_userdata();

    $currentDate = date('Y-m-d');
    $login_pass_decode = encrypted($data['password']);
    $email = $data['email'];
    $firstName = $data['first-name'];
    $lastName = $data['last-name'];

    $data_insert = array(
      "oauth_provider" => "psyflex",
      "email" => $email,
      "password" => $login_pass_decode,
      "first_name" => $firstName,
      "last_name" => $lastName,
      "created" => $currentDate
    );

    $this->Muserregister->addNewUser($data_insert);
    $this->session->set_userdata('user', $email);
    redirect(base_url());
  }


}
 ?>
