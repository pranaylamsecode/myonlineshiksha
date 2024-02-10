<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notification extends MLMS_Controller
{
    var $configarr;
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('cookie');
		$this->load->helper('commonmethods');
        $this->load->helper('text');
        $this->load->model('admin/settings_model');
		$this->load->model('admin/programs_model');
		$this->load->model('orders_model');
		$this->load->model('admin/medias_model');
		$this->load->model('medias_model');
        $configarr = $this->settings_model->getItems();	

		date_default_timezone_set($configarr[0]['time_zone']);

		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$this->template->set("configarr", $configarr);		
		$this->load->library('email');
		$this->load->library('form_validation');
        //$this->load->helper('unirowclient');
		//$longlife = 60*60*24*60; //60 days
		//$shortlife = 60*60*24*10; //10 days
		//$this->input->set_cookie('LongRemember', $user.'::'.$hashbrown, $longlife, '.example.com', '/');
	}

   function authenticate()
    {
        $session = $this->session->userdata('logged_in');
        if(!$this->session->userdata('logged_in'))
        {
         redirect('users/login');
        }
    } 


   function inbox($parent_id = NULL)
   { 
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
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
       $sess_orders = $this->session->userdata('sess_orders');
	   
	    if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_orders');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_orders['searchterm'];
       $search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_orders['searchstatus'];
       $search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_orders['searchtcate'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchstatus" => $search_status,
				 "searchtcate" => $search_cate
				 );
	   $this->session->set_userdata('sess_orders', $searchdata);
       }

       $path=base_url() . "orders/index/";

       $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "orders/index/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->orders_model->getOrdersCount($search_string,$search_status,$user_id);
       $this->template->title('Orders List');
       $this->pagination->initialize($config);        

      
       $this->template->set("message", $this->settings_model->getAllMessages($user_id));   
	  
       $this->template->build('notification/inbox');
    }
	
	function lists($parent_id = NULL)
   { 
     
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
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
       $sess_orders = $this->session->userdata('sess_orders');
	   
	    if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_orders');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_orders['searchterm'];
       $search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_orders['searchstatus'];
       $search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_orders['searchtcate'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchstatus" => $search_status,
				 "searchtcate" => $search_cate
				 );
	   $this->session->set_userdata('sess_orders', $searchdata);
       }

       $path=base_url() . "notification/lists/";

       $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "notification/lists/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->settings_model->countAllNotification($user_id);
       $this->template->title('Notification List');
       $this->pagination->initialize($config);        

     if((!empty($_POST['submit_search'])))
      {
      	$serachitem = $this->input->post('search_text');
      	$this->template->set("notification", $this->settings_model->getSearchNotification($user_id,$config['per_page'],$start,$serachitem)); 
      }
      else
      {
       $this->template->set("notification", $this->settings_model->getAllNotification($user_id,$config['per_page'],$start));  
      } 
	   $this->template->set("countNotify", $this->settings_model->countAllNotification($user_id));
       $this->template->build('notification/list');
    }
	
	
	function message($parent_id = NULL)
   { 
     
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
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
       $sess_orders = $this->session->userdata('sess_orders');
	   
	   
	   $message_id  = $this->uri->segment(3) ;       

      
       $this->template->set("message", $this->settings_model->getMessage($user_id,$message_id));   
	  
       $this->template->build('notification/view');
    }
	
	function delete_message($id = NULL)
    {
	
	  
    	//filter & Sanitize $id
    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
    	//redirect if it´s no correct
		
    	if (!$id){
    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
    		redirect('notification/inbox/');
    	}

        $isdelete = $this->settings_model->deleteMessage($id);

    	//delete the item
    	if ($isdelete)
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    		redirect('notification/inbox');
    }
	
	function delete_activity($id = NULL)
    {
	
	  
    	//filter & Sanitize $id
    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
    	//redirect if it´s no correct
		
    	if (!$id){
    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
    		redirect('notification/lists/');
    	}

        $isdelete = $this->settings_model->deleteactivity($id);

    	//delete the item
    	if ($isdelete)
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    		redirect('notification/lists');
    }
	
	public function send_mail()
    {
	 
	  $sender_id = $this->input->post('sender_id');
	  $pro_id = $this->input->post('program_id'); 
	  

      $reply_msg = $this->input->post('reply_msg'); 
	  
	   $sender_email = $this->input->post('sender_email');
	   
	 
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  $user_email = $sessionarray['email'];
	   $name = $this->settings_model->getName($user_id);
	  
	  $this->load->library('email');

		$this->email->from($user_email,$name);
		$this->email->to($sender_email); 
		   
		//$this->email->cc('prshah83@gmail.com'); 
		//$this->email->bcc('them@their-example.com'); 

			$this->email->subject('Reply of your Queries');
		$this->email->message($reply_msg);	
      
		//$this->email->send();
		
		if($reply_msg)
		{
		    $this->email->send(); // open it
			
			$data = array(
				'subject' => 'Queries',
				'message' => $reply_msg,
				'receiver_id' => $sender_id,
				'sender_id' => $user_id,
				'program_id' => $pro_id,
				'message_date' => date("Y-m-d h:i:s")				
			);
			
			$this->load->model('Program_model');
			$message_id = $this->Program_model->insertMessage($data); // open it
			
			$name = $this->settings_model->getName($user_id);
			
			if($user_id != $sender_id)
			{
			
				$data_activity = array(
				'activity' => $name.' replied to your message',
				'sender_id' => $user_id ,
				'receiver_id' => $sender_id ,
				'activity_type' => 'message',
				'activity_date' => date("Y-m-d"),
				'visit_id' => $message_id
			  );
		   }
		  
		    $this->load->model('Category_model');  
			$this->Category_model->insertActivity($data_activity);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Message Sent Successfully!' ));
			redirect('notification/lists/');
		}
		
        
	}
	
	function activity()
	{
		$activity_id = $this->uri->segment(3);
		
		$this->settings_model->updateActivityStatus($activity_id);
		
		$activity = $this->settings_model->getactivity($activity_id);
		
		switch($activity[0]['activity_type'])
		{
			case 'review':
							redirect('programs/programs/'.$activity[0]['visit_id']);
							break;
							
			case 'wishlist':
							redirect('myinfo/mywishlists');
							break;
							
			case 'question':
							redirect('programs/lectures/'.$activity[0]['visit_id']);
							break;
							
			case 'comment':
							redirect('programs/lectures/'.$activity[0]['visit_id']);
							break;
							
			case 'message':
							redirect('notification/message/'.$activity[0]['visit_id']);
							break;
							
			case 'like':
							redirect('programs/lectures/'.$activity[0]['visit_id']);
							break;

		    case 'Approval':
							redirect('my-certificates');
							break;
							
			default:
							redirect('notification/lists/');
							break;
		}
	}
	
	function edit($id = FALSE)

    {
      
        $this->authenticate();

    	$this->template->append_metadata(block_submit_button());

        $loggeduser_data=$this->session->userdata('loggedin');
		
		$this->template->set("order", $this->orders_model->getIndividualOrder(($id)));
		
		//$indi_order = $this->orders_model->getIndividualOrder(($uid));


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
			
			  
			
			$data = array(

            /*'username'		=>	$this->input->post('username'), */

            //'userid'		=>	$this->input->post('user_id'),

            //'courses'		=>	$this->input->post('course_id'),
			
			'order_date'    =>  date("Y-m-d h:i:s"),

            'amount' 	    =>  $this->input->post('price'),

            'status' 	    =>  $this->input->post('status_id'),

            'pending_reason' =>  trim($this->input->post('pending_reason')),

            'amount_paid'   	=>  $this->input->post('amount'),

            'processor' 	=>  $this->input->post('processor')           

          );

        		           
                

                $isupdated = $this->orders_model->updateOrder($id,$data);   

               

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
		
		$this->template->set("order", $this->orders_model->getIndividualOrder(($parent_id)));



    	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);

    	$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

    	$this->_set_rules(); //

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



      //  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');



       	if ($this->form_validation->run() === FALSE)

    	{
          // exit('if');
    	  	$this->template->build('admin/orders/create_order');



    	}

    	else

      	{

      	 /* Array
			(
				[user_id] => 81
				[course_id] => 251
				[plan] => Economy
				[price] => 2000
				[status_id] => Paid
				[pending_reason] => 
				[amount] => 3000
				[processor] => PayPal
				[submit] => Save
			) */

			 
          $data = array(

            /*'username'		=>	$this->input->post('username'), */

            'userid'		=>	$this->input->post('user_id'),

            'courses'		=>	$this->input->post('course_id'),
			
			'order_date'    =>  date("Y-m-d h:i:s"),

            'amount' 	    =>  $this->input->post('price'),

            'status' 	    =>  $this->input->post('status_id'),

            'pending_reason' =>  trim($this->input->post('pending_reason')),

            'amount_paid'   	=>  $this->input->post('amount'),

            'processor' 	=>  $this->input->post('processor')           

          );

         

      //  $usergroups = $this->input->post('group_id');
	 

        $order_id = $this->orders_model->insertOrder($data);	

		$data1 = array(

            /*'username'		=>	$this->input->post('username'), */

            'userid'		=>	$this->input->post('user_id'),

            'order_id'		=>	$order_id,
			
			'course_id'    =>  $this->input->post('course_id'),

            'price' 	    =>  $this->input->post('price'),

            'buy_date' 	    =>  date("Y-m-d h:i:s"),

            'status'        =>  $this->input->post('status_id')                    

          );
		  
		  $this->orders_model->insertBuyCourse($data1);

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

        $isdelete = $this->orders_model->deleteOrder($id);

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

       $paymentstatus=$this->orders_model->paid_unpaid($tid,$upd_data);

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

       $paymentstatus=$this->orders_model->paid_unpaid($tid,$upd_data);

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
	public function getUnreadNotific()
	{
		//$activity_id = $this->uri->segment(3);
		$unread = $this->settings_model->getunreadNotification();
		if($unread)
		{
		foreach($unread as $key)
		 {
			
			$this->settings_model->updateActivityStatus($key->activity_id);
		 }
		}
	
		echo"yes";
	}

}
