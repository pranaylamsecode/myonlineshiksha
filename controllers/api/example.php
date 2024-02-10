<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use \home\createon\public_html\myonlineshiksha\application\libraries\REST_Controller.php;
// defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
// require APPPATH . 'libraries/REST_Controller.php';
// require APPPATH . 'libraries/Format.php';
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
*/
require(APPPATH.'libraries/REST_Controller.php');

class Example extends REST_Controller {
   
    public function users_get()
    {
        echo "get_users";
      
    }
   
}

?>