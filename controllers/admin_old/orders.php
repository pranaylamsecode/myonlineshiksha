<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends MLMS_Controller
{
    function __construct()
    {
          parent::__construct();
          // $this->load->helper(array('form', 'url'));
          $this->load->model('admin/users_model');			
          $this->load->model('Myinfo_model');
          $this->template->set_layout('backend');
          $this->load->library('ckeditor');
          $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->library('form_validation');		
          $this->lang->load('tooltip', 'english');
          $this->load->model('admin/settings_model');

    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);

          $this->load->model('admin/programs_model');
          $this->load->model('login_model');
    }

    function authenticate()
    {
        $session = $this->session->userdata('loggedin');
        if(!$this->session->userdata('loggedin'))
        {
         redirect('admin/users/login');
        }
    }


   function index($parent_id = NULL)
   { 
      error_reporting(0);
      $this->authenticate();
      $sess_orders = $this->session->userdata('sess_orders');

      if($this->input->post('reset') == 'Reset'){
	    $search_string = $this->input->post('search_text', TRUE);
	    $search_status = $this->input->post('status_id', TRUE);
		
		
	    $from_date = $this->input->post('from_date', TRUE);
	    $to_date = $this->input->post('to_date', TRUE);	
	   
		$search_period = $this->input->post('period', TRUE);			
	    $search_cate = $this->input->post('teacherid', TRUE);
		//$this->input->post('search_text')='';
		$this->session->unset_userdata('sess_orders');
		$search_string = '';
		//$search_status = '';
		//$search_type = '';
		}else{
      $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_orders['searchterm'];
      $search_status = ($this->input->post('status_id', TRUE)) ? $this->input->post('status_id', TRUE) : $sess_orders['searchstatus'];

      $from_date = ($this->input->post('from_date', TRUE)) ? $this->input->post('from_date', TRUE) :'';        //$sess_orders['searchfromdate'];
      $to_date = ($this->input->post('to_date', TRUE)) ? $this->input->post('to_date', TRUE) :'';               //$sess_orders['searchtodate'];

      $search_period = ($this->input->post('period', TRUE)) ? $this->input->post('period', TRUE) : '';          //$sess_orders['searchperiod'];
      $search_cate = ($this->input->post('teacherid', TRUE)) ? $this->input->post('teacherid', TRUE) : $sess_orders['searchtcate'];
      $searchdata = array(
      "searchterm" => $search_string,
      "searchstatus" => $search_status,
      "searchfromdate" => $from_date,
      "searchtodate" => $to_date,
      "searchtcate" => $search_cate,
      "searchperiod" => $search_period
      );
      $this->session->set_userdata('sess_orders', $searchdata);
      }

      $path=base_url() . "admin/orders/";
      $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;	   
      $baseurl = base_url() . "admin/orders/";
      $this->load->library('pagination');
      $config["base_url"] = $baseurl;
      $config['per_page'] = 10;
      $config['enable_query_strings'] = true;
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->users_model->getOrdersCount($search_string,$search_status,$search_cate,$search_period,$from_date,$to_date);	   
      //echo $this->users_model->getOrdersCount($search_string);
      $this->template->title('Orders List');
      $this->pagination->initialize($config);
      $this->template->set("orders", $this->users_model->getOrders($config['per_page'],$start,$search_string,$search_status,$search_cate,$search_period,$from_date,$to_date));	   
      $this->template->set("users", $this->users_model->getName());	   
      $this->template->set("countorders", $this->users_model->getcountOrders($search_string,$search_status,$search_cate,$search_period,$from_date,$to_date));
      $this->template->build('admin/orders/list');
    }
	
	  function edit($id = FALSE)
    {
        $this->authenticate();
    	  $this->template->append_metadata(block_submit_button()); 
        $loggeduser_data=$this->session->userdata('loggedin');
				$this->template->set("order", $this->users_model->getIndividualOrder(($id)));
				//$indi_order = $this->users_model->getIndividualOrder(($uid));
        $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
      	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
	    	$this->_set_rules(); //
       	$this->template->set('title', lang('web_category_create'));
       	$this->template->set('updType', 'edit');
       	$this->template->set('id',$id);
			
		$this->template->set('username',$this->settings_model->getUsersName());
		$this->template->set('courses',$this->settings_model->getCourses());
		
		

        //$this->form_validation->set_rules('course_id', 'course_id', 'required');
        //$this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('status_id', 'status_id', 'required');

        //$this->form_validation->set_rules('pending_reason', 'pending_reason', 'trim|required|xss_clean');

        $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');



      //  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');


        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

        	$this->template->build('admin/orders/create_order');

        }

        else

        	{
			       
             $userid = $this->input->post('user_id').'<br/>';
             $course_id = $this->input->post('course_id');
        			  
			$data = array(

            /*'username'		=>	$this->input->post('username'), */

            //'userid'		=>	$this->input->post('user_id'),

            //'courses'		=>	$this->input->post('course_id'),
			
			'order_date'    =>  date("Y-m-d h:i:s"),

            'amount' 	    =>  $this->input->post('price'),

            'status' 	    =>  $this->input->post('status_id'),

            'pending_reason' =>  trim($this->input->post('pending_reason')),

            'amount_paid'   	=>  $this->input->post('amount'),

            'processor' 	=>  $this->input->post('processor'),

            'note'   =>  $this->input->post('note')           

          );

        		           
                

          $isupdated = $this->users_model->updateOrder($id,$data);   

          if($this->input->post('status_id') == 'Completed')
          {
            
             $configarr = $this->settings_model->getItems();

             $urldomain = base_url();
            $urldomain = str_replace('http://', '', $urldomain);
            $urldomain = str_replace('/', '', $urldomain);
            $urldomain = str_replace('www.', '', $urldomain);

             $user_data = $this->programs_model->getUserInfo($userid);

             $pro_data = $this->programs_model->getProgramById($course_id);

              

             $subject = "Your Order for course '".$pro_data->name."' is Completed";
             $toemail =  $user_data->email; // $teacher_email
              
              $content = '';
              //$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($user_data->first_name)).',<br /><br />';
              $content .= "Your order for course '".$pro_data->name."' is completed.<br /><br />";
              $content .= 'The status of order is changed from pending to completed.<br /><br />';
              $content .='If you need help or have any questions, please contact us. <br /><br />';
              $content .= '<br /><br />';
              $content .='...</p>';
              $content .= $configarr[0]['signature'].'</p>';
              //$content .= 'Best regards,<br /><br />';
              //$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
              $data['content'] = $content;
              $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
              
              //$message = '<a href="'.$link.'">Click on link to reset password</a>';
              //$fromemail='admin@createonlineacademy.com';
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              //$this->email->cc('vikas.gorle@veerit.com');
              $this->email->message($message);
              $this->email->send();


               $admininfo = $this->login_model->getadminInfo(4);
              

              // Email to Admin 
              $subject = "Order for course '".$pro_data->name."' is Completed";
              $toemail = $admininfo->email; // $this->input->post('email')
              $content = '';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
              $content .= "Order for course '".$pro_data->name."' is completed.<br /><br />";
              $content .='This Order is placed by '.$user_data->first_name.' '.$user_data->last_name.'.<br /><br />';
              $content .='...';
              $content .= $configarr[0]['signature'];
              
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              $this->email->message($message);
              $this->email->send(); 

              $order = $this->users_model->getIndividualOrder($id);


              $plans = $this->programs_model->getSubscriptionPlans($course_id,$order->amount_paid);

              if($plans)
              {
                
                if($plans[0]['period'] == 'Month(s)')
                {        
                  $future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
                  $date=strtotime(date('Y-m-d'));  // if today :2013-05-23

                   $Expire_Date = date('Y-m-d',strtotime($future_date,$date));   
                            $plan_id = $plans[0]['plan_id']; 
                  
                    
                }
                elseif($plans[0]['period'] == 'Year(s)')
                {
                  $future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
                  $date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                   $Expire_Date = date('Y-m-d',strtotime($future_date,$date));
                   $plan_id = $plans[0]['plan_id']; 
                   
                }
              }
              else
              {
                $date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                 $Expire_Date = date('Y-m-d',strtotime('+5 year',$date)); 
                        $plan_id = 4; 
                            
              }

             $data = array(
                    'userid' => $userid,
                    'order_id' => $id,
                    'course_id' => $course_id,
                    'price' => $order->amount_paid,
                    'currency' => $order->currency,
                    'buy_date' => $order->order_date,
                    'expired_date' => $Expire_Date,
                    'plan_id' => $plan_id,
                    'email_send' => 0
                    );

              $this->users_model->insertBuyCourse($data);

          }

               

        		if ($isupdated) // the information has therefore been successfully saved in the db

        		{

        		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				  

        			redirect('admin/orders');

        		}

        		else{

        			redirect('admin/orders');

        		}

        	}

    }

    function vieworder($id = FALSE)

    {
      
        $this->authenticate();

      $this->template->append_metadata(block_submit_button());

        $loggeduser_data=$this->session->userdata('loggedin');
    
    $this->template->set("order", $this->users_model->getIndividualOrder(($id)));
    
    //$indi_order = $this->users_model->getIndividualOrder(($uid));


        $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
    

      $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
    

      $this->_set_rules(); //

      $this->template->set('title', lang('web_category_create'));

      $this->template->set('updType', 'edit');

      $this->template->set('id',$id);
    
    
    
    $this->template->set('username',$this->settings_model->getUsersName());
    $this->template->set('courses',$this->settings_model->getCourses());
    
    

        //$this->form_validation->set_rules('course_id', 'course_id', 'required');
        //$this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('status_id', 'status_id', 'required');

        //$this->form_validation->set_rules('pending_reason', 'pending_reason', 'trim|required|xss_clean');

        $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');



      //  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');


        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

          $this->template->build('admin/orders/vieworder');

        }

        else

          {
      
        
      $data = array(

            /*'username'    =>  $this->input->post('username'), */

            //'userid'    =>  $this->input->post('user_id'),

            //'courses'   =>  $this->input->post('course_id'),
      
      'order_date'    =>  date("Y-m-d h:i:s"),

            'amount'      =>  $this->input->post('price'),

            'status'      =>  $this->input->post('status_id'),

            'pending_reason' =>  trim($this->input->post('pending_reason')),

            'amount_paid'     =>  $this->input->post('amount'),

            'processor'   =>  $this->input->post('processor')           

          );

                       
                

                $isupdated = $this->users_model->updateOrder($id,$data);   

               

            if ($isupdated) // the information has therefore been successfully saved in the db

            {

            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
          

              redirect('admin/orders');

            }

            else{

              redirect('admin/orders');

            }

          }

    }
	
	function create($parent_id = FALSE)
	{
	  
	   $this->authenticate();

    	$this->template->append_metadata(block_submit_button());

        $loggeduser_data=$this->session->userdata('loggedin');
		
		$this->template->set("order", $this->users_model->getIndividualOrder(($parent_id)));



    	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);

    	$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

    	$this->_set_rules(); //
      $this->template->title("Create Order");
    	$this->template->set('title', lang('web_category_create'));
    	$this->template->set('updType', 'create');
    	$this->template->set('parent_id',$parent_id);		
  		$this->template->set('username',$this->settings_model->getUsersName());
  		$this->template->set('courses',$this->settings_model->getCourses());		

      $this->form_validation->set_rules('course_id', 'course_id', 'required');
      $this->form_validation->set_rules('user_id', 'user_id', 'required');
      $this->form_validation->set_rules('status_id', 'status_id', 'required');

      //$this->form_validation->set_rules('pending_reason', 'pending_reason', 'trim|required|xss_clean');

      $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

     	if ($this->form_validation->run() === FALSE)
    	{
    	  	$this->template->build('admin/orders/create_order');
    	}
    	else

      	{
	 
          $data = array(

            /*'username'		=>	$this->input->post('username'), */

            'userid'		=>	$this->input->post('user_id'),

            'courses'		=>	$this->input->post('course_id'),
			
			'order_date'    =>  date("Y-m-d h:i:s"),

            'amount' 	    =>  $this->input->post('price'),

            'status' 	    =>  $this->input->post('status_id'),

            'pending_reason' =>  trim($this->input->post('pending_reason')),

            'amount_paid'   	=>  $this->input->post('amount'),

            'processor' 	=>  $this->input->post('processor'), 

            'note'   =>  $this->input->post('note')          

          );

         

      //  $usergroups = $this->input->post('group_id');
	 

       $order_id = $this->users_model->insertOrder($data);	   
	   
	   $data1 = array(

            /*'username'		=>	$this->input->post('username'), */

            'userid'		=>	$this->input->post('user_id'),

            'order_id'		=>	$order_id,
			
			'course_id'    =>  $this->input->post('course_id'),

            'price' 	    =>  $this->input->post('price'),

            'buy_date' 	    =>  date("Y-m-d h:i:s"),

            'status'        =>  $this->input->post('status_id')                    

          );
		  
		  $this->users_model->insertBuyCourse($data1);

       $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

       redirect('admin/orders');

       }
	}
	
	

    function delete($id = NULL)
    {
	
	  
    	//filter & Sanitize $id
    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
    	//redirect if it´s no correct
    	if (!$id){
    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
    		redirect('admin/orders/');
    	}

        $isdelete = $this->users_model->deleteOrder($id);

    	//delete the item
    	if ($isdelete)
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    		redirect('admin/orders');
    }



     public function paid($tid = FALSE){

    	$tid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

        if (!$tid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/orders/');
			}

       $upd_data = array(
    					'status'=>'Paid'
    				);

       $paymentstatus=$this->users_model->paid_unpaid($tid,$upd_data);

       if ($paymentstatus)
       {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Updated successfully!' ));
       }
       else
       {
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Can not be Updated!' ) );
       }
       redirect('admin/orders');


	}
   /***&nbsp;E ***/
  /*** paid to pending ***/

  public function pending($tid = FALSE){

    	$tid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

        if (!$tid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/orders/');
			}

       $upd_data = array(
    					'status'=>'Pending'
    				);

       $paymentstatus=$this->users_model->paid_unpaid($tid,$upd_data);

       if ($paymentstatus)
       {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Updated successfully!' ));
       }
       else
       {
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Can not be Updated!' ) );
       }
       redirect('admin/orders');


	}

   function pdf()
    {  
  
    $this->load->helper('pdf_helper');
       
       $this->load->model('orders_model');   

     if(isset($_POST) && !empty($_POST))
    {
            if(isset($_POST['order']))
            {
             $this->reorder_fun($_POST);
            }
        }
    
    $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
    
        $parent_id = NULL;
        $this->session->unset_userdata('sess_orders');
        $this->template->title('Orders List');
      $configarr = $this->settings_model->getItems();
    $logoimage=$configarr[0]['logoimage'];
    $this->template->set("configarr", $configarr); 
    $configarr = $this->settings_model->getItems();   
    $tmpl = $configarr[0]['layout_template'];      
    $this->template->set("tmpl",$tmpl);
    $this->template->set('updType', 'create');
    $parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
    $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
       $sess_orders = $this->session->userdata('sess_orders');
     
     
     $order_id  = $this->uri->segment(4) ;       

      
       $this->template->set("orders", $this->orders_model->viewOrder($user_id,$order_id));   
    
       //$this->template->build('orders/pdfreport');
       $this->load->view('admin/orders/pdfreport');  
    
  }

  function sendOrderMail()
{
  //echo"yes";
    $this->load->model('orders_model');   
  $this->load->view('admin/orders/sendordermail');
}

function orderStatusUpdate()
{
      
      $orderStatus =$this->input->post('selectvalue');
      $orderId =$this->input->post('orderid');
      $userid =$this->input->post('userid');
      $course_id =$this->input->post('course_id');

      $this->load->model('admin/programs_model');

      $this->load->model('admin/settings_model');
      $this->load->model('admin/users_model');

      $this->load->model('login_model');

  $data = array( 
            'status'      =>  $orderStatus    

               );
        $isupdated = $this->users_model->updateOrder($orderId,$data);  



        if($isupdated)
        {
          if($orderStatus == 'Completed')
          {
            
             $configarr = $this->settings_model->getItems();

             $urldomain = base_url();
            $urldomain = str_replace('http://', '', $urldomain);
            $urldomain = str_replace('/', '', $urldomain);
            $urldomain = str_replace('www.', '', $urldomain);

             $user_data = $this->programs_model->getUserInfo($userid);

             $pro_data = $this->programs_model->getProgramById($course_id);

              

             $subject = "Your Order for course '".$pro_data->name."' is Completed";
             $toemail =  $user_data->email; // $teacher_email
              
              $content = '';
              //$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($user_data->first_name)).',<br /><br />';
              $content .= "Your order for course '".$pro_data->name."' is completed.<br /><br />";
              $content .= 'The status of order is changed from pending to completed.<br /><br />';
              $content .='If you need help or have any questions, please contact us. <br /><br />';
              $content .= '<br /><br />';
              $content .='...</p>';
              $content .= $configarr[0]['signature'].'</p>';
              //$content .= 'Best regards,<br /><br />';
              //$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
              $data['content'] = $content;
              $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
              
              //$message = '<a href="'.$link.'">Click on link to reset password</a>';
              //$fromemail='admin@createonlineacademy.com';
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              //$this->email->cc('vikas.gorle@veerit.com');
              $this->email->message($message);
              $this->email->send();


               $admininfo = $this->login_model->getadminInfo(4);
              

              // Email to Admin 
              $subject = "Order for course '".$pro_data->name."' is Completed";
              $toemail = $admininfo->email; // $this->input->post('email')
              $content = '';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
              $content .= "Order for course '".$pro_data->name."' is completed.<br /><br />";
              $content .='This Order is placed by '.$user_data->first_name.' '.$user_data->last_name.'.<br /><br />';
              $content .='...';
              $content .= $configarr[0]['signature'];
              
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              $this->email->message($message);
              $this->email->send(); 

              $order = $this->users_model->getIndividualOrder($orderId);


              $plans = $this->programs_model->getSubscriptionPlans($course_id,$order->amount_paid);

              if($plans)
              {
                
                if($plans[0]['period'] == 'Month(s)')
                {        
                  $future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
                  $date=strtotime(date('Y-m-d'));  // if today :2013-05-23

                   $Expire_Date = date('Y-m-d',strtotime($future_date,$date));   
                            $plan_id = $plans[0]['plan_id']; 
                  
                    
                }
                elseif($plans[0]['period'] == 'Year(s)')
                {
                  $future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
                  $date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                   $Expire_Date = date('Y-m-d',strtotime($future_date,$date));
                   $plan_id = $plans[0]['plan_id']; 
                   
                }
              }
              else
              {
                $date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                 $Expire_Date = date('Y-m-d',strtotime('+5 year',$date)); 
                        $plan_id = 4; 
                            
              }

             $data = array(
                    'userid' => $userid,
                    'order_id' => $orderId,
                    'course_id' => $course_id,
                    'price' => $order->amount_paid,
                    'currency' => $order->currency,
                    'buy_date' => $order->order_date,
                    'expired_date' => $Expire_Date,
                    'plan_id' => $plan_id,
                    'email_send' => 0
                    );

              $this->users_model->insertBuyCourse($data);

          }

          echo"success";
        }
        else
        {
          echo"Failed";
        }
  
  return true;
}



}
