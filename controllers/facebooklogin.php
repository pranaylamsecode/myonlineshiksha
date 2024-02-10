<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebooklogin extends MLMS_Controller {

public $user = "";

public function __construct() {
parent::__construct();

// Load facebook library and pass associative array which contains appId and secret key
$this->load->library('facebook', array('appId' => '1920297004858564', 'secret' => '363918b42b9d857eb71f081778b7c30c'));

// Get user's login information
$this->user = $this->facebook->getUser();
$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		
print_r("<pre>");
print_r($this->user);
}

// Store user information and send to profile page
public function index() {
if ($this->user) {
$data['user_profile'] = $this->facebook->api('/me/');

// Get logout url of facebook
$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'index.php/Facebooklogin/logout'));

// Send data to profile page
$this->load->view('flogin/profile', $data);
} else {

// Store users facebook login url
$data['login_url'] = $this->facebook->getLoginUrl();
$this->load->view('flogin/login', $data);
}
}

// Logout from facebook
public function logout() {

// Destroy session
session_destroy();

// Redirect to baseurl
redirect(base_url());
}

}