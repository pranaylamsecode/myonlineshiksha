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
          $this->load->model('admin/programs_model');
          $this->load->model('login_model');

    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
    error_reporting(0);
    }

    function authenticate()
    {      
  $session = $this->session->userdata('loggedin');
      if(!$session)
      {
       redirect('admin/users/login');
      }
      else if($session['groupid'] == 4 || $session['groupid'] == 2)
      {
      }
      else{
        $this->session->unset_userdata("loggedin");
        redirect('admin/users/login');
      }
    }



   function index($parent_id = NULL)
    {
      $auth = $this->session->userdata('logged_in');
      if(!empty($auth)){
        $userid = NULL;
        if($auth['groupid'] != 4)
        {
          $userid = $auth['id'];
        }
        $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : '';
        $search_status = ($this->input->post('status_id', TRUE)) ? $this->input->post('status_id', TRUE) : '';

        $from_date = ($this->input->post('from_date', TRUE)) ? $this->input->post('from_date', TRUE) :'';        //$sess_orders['searchfromdate'];
        $to_date = ($this->input->post('to_date', TRUE)) ? $this->input->post('to_date', TRUE) :'';               //$sess_orders['searchtodate'];

        $search_period = ($this->input->post('period', TRUE)) ? $this->input->post('period', TRUE) : '';          //$sess_orders['searchperiod'];
        $search_cate = ($this->input->post('teacher_id', TRUE)) ? $this->input->post('teacher_id', TRUE) : '';
        if($auth['groupid'] != 4)
        {
          $search_cate = $auth['id'];
        }

        $total_rows = $this->users_model->getOrdersCount($search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);
        if($this->input->post('pay_page'))
        {
          $currpage = $this->input->post('pay_page');
          if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
          {
            $firstp = 0;
          }
          else{
            $firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
          }
          if((intval($firstp)+intval(10)) > $total_rows)
          {
            $startp = $total_rows;
          }
          else{
            $startp = $firstp + 10;
          }
          $orders = $this->users_model->getOrders(10,$firstp,$search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);     
        }
        else{
          $currpage = 1;
          $firstp = 0;
          $startp = 10;
          $orders = $this->users_model->getOrders(10,$firstp,$search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);     
        }
        $pagination = '';
        $pagesp = ceil(intval($total_rows)/10);
        if($pagesp>1) {
          if(intval($currpage) == 1) 
            $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                        <li class="disabled"><a>&lt;</a></li>';
          else  
            $pagination .= '<li data-ci-pagination-page="1" onclick="get_payout(1,\'admin/orders\')"><a>&lsaquo; First</a></li>
                <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="get_payout('.(intval($currpage)-1).',\'admin/orders\')"><a>&lt;</a></li>';

          if((intval($currpage)-3)>0) {
            if($currpage == 1)
              $pagination .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
          }
          if((intval($currpage)-3)>1) {
              $pagination .= '<li>...</li>';
          }
          
          for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
            if($i<1) continue;
            if($i>$pagesp) break;
            if(intval($currpage) == $i)
              $pagination .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
            else        
              $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="get_payout('.$i.',\'admin/orders\')"><a>'.$i.'</a></li>';
          }
          
          if(($pagesp-(intval($currpage)+2))>1) {
              $pagination .= '<li><a>...</a></li>';
          }
          if(($pagesp-(intval($currpage)+2))>0) {
            if(intval($currpage) == $pagesp)
              $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
            else        
              $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="get_payout('.$pagesp.',\'admin/orders\')"><a>'.$pagesp.'</a></li>';
          }
          
          if(intval($currpage) < $pagesp)
            $pagination .= '<li onclick="get_payout('.(intval($currpage)+1).',\'admin/orders\')" ><a> > </a></li>
                    <li onclick="get_payout('.$pagesp.',\'admin/orders\')" ><a>Last &rsaquo;</a></li>';
          else        
            $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
        }
        if($this->input->post('pay_page'))
        {
          $output = "";
          if(!empty($orders)){
            $firstp = $firstp + 1;
            foreach ($orders as $key)
            {
              $coursearr=explode('-',$key->courses);
              $plan_id = $this->users_model->getPlanId(@$coursearr[0]);
              $output .= '
              <tr class="camp0 parent_'.$key->id.'">
                <td class="field-title" style="font-weight:bold;">'.$key->id.'</td>
                <td class="field-title">'.ucwords($key->first_name.' '.$key->last_name).'</td>
                <td class="field-title">'.ucwords($key->program_name).'</td>
                <td class="field-title"> '.$key->amount.' </td>
                <td class="field-title"> '.$this->users_model->getPlanName(@$plan_id).' </td>
                <td class="field-title"> '.$key->order_date.' GMT'.' </td>
                <td class="field-title"> '.$key->amount_paid.' </td>
                <td class="field-title"> '.$key->processor.' </td>
                <td class="field-title"> '.$key->status.' </td>
                <td class="field-title">
                  <a class="col-sm-offset-3 col-sm-4 no-padding" href="'.base_url().'admin/orders/edit/'.$key->id.'/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit"></div></a>
                <a class="col-sm-4" onclick="return delete_order('.$key->id.')"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                </td>
              </tr>';
            }
          }else{
            $firstp = 0;
            $output .= '<tr class="camp0">
              <td class="field-title" colspan="10" style="color: #949494; text-align:center !important;">No orders yet.</td>
            </tr>';
          }
          $data1['payoutdata'] = $output;
          $data1['lastpage'] = $pagesp;
          $data1['links'] = $this->input->post('pay_page');
          $data1['firstp'] = $firstp;
          $data1['startp'] = $startp;
          $data1['paying'] = $pagination;
          $data1['currpage'] = $currpage;
          $data1['total_payout'] = $total_rows;
          echo json_encode($data1);
        }
        else{
          $teachers = $this->Crud_model->GetData('mlms_users',"id,first_name,last_name","group_id = 2 and active = 1 and trash = 0","","first_name ASC");
          $data = array(
                'orders' => $orders,
                'paying' => $pagination,
                'currpage' => $currpage,
                'firstp' => $firstp + 1,
                'startp' => $startp,
                'teachers' => $teachers,
                'total_payout' => $total_rows,
          );
          $this->template->set_layout('backend');
          $this->template->build('admin/orders/list',$data);
        }
      }
      else
      {
        redirect(base_url());
      }
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

            //  $urldomain = base_url();
            // $urldomain = str_replace('http://', '', $urldomain);
            // $urldomain = str_replace('/', '', $urldomain);
            // $urldomain = str_replace('www.', '', $urldomain);
             if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain');


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
 $data['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
              
              //$message = '<a href="'.$link.'">Click on link to reset password</a>';
              //$fromemail='admin@createonlineacademy.com';
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
                'userid'        => $this->input->post('user_id'),
                'courses'       => $this->input->post('course_id'),
                'order_date'    => date("Y-m-d h:i:s"),
                'amount'        => $this->input->post('price'),
                'status'        => $this->input->post('status_id'),
                'pending_reason'=> trim($this->input->post('pending_reason')),
                'amount_paid'   => $this->input->post('amount'),
                'processor'     => $this->input->post('processor'),
                'note'          => $this->input->post('note'),
                'currency'      => "INR",
                'batch_id'      => $this->input->post('batch_id')

          );
          $order_id = $this->users_model->insertOrder($data);    
        if($this->input->post('status_id') == 'SUCCESS'){
          $checkenroll = $this->Crud_model->get_single('mlms_buy_courses',"userid = ".$this->input->post('user_id')." and course_id = ".$this->input->post('course_id'),"id");
          $data1 = array(
            'userid'    => $this->input->post('user_id'),
            'order_id'  => $order_id,
            'course_id' => $this->input->post('course_id'),
            'price'     => $this->input->post('price'),
            'buy_date'  => date("Y-m-d h:i:s"),
            'status'    => $this->input->post('status_id'),
            'currency'  => "INR",
            'batch_id'  => $this->input->post('batch_id'),
            'criteria'  => 'paid',
            'is_delete' => 'no'
          );
          if(!empty($checkenroll)){
            $this->Crud_model->SaveData('mlms_buy_courses',$data1,"userid = ".$this->input->post('user_id')." and course_id = ".$this->input->post('course_id'));
          }else{
            $this->Crud_model->SaveData('mlms_buy_courses',$data1);
          }
          $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
        }else{
          $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Course not assigned'));
        }

       redirect('admin/orders');

       }
  }
	
    function delete()
    {
      $id = $this->input->post('id');
        // $isdelete = $this->users_model->deleteOrder($id);
      $data = array(
          'is_delete' => "yes"
      );
      $this->Crud_model->SaveData('mlms_order',$data,"id = ".$id);
      $isdelete = $this->db->affected_rows();
      $this->Crud_model->SaveData('mlms_buy_courses',$data,"order_id = ".$id);
      echo '1';
    }

    /*function delete($id = NULL)
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
    }*/



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

            //  $urldomain = base_url();
            // $urldomain = str_replace('http://', '', $urldomain);
            // $urldomain = str_replace('/', '', $urldomain);
            // $urldomain = str_replace('www.', '', $urldomain);
             if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain');

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
 $data['fromemail'] = $urldomain;
              $message = $this->load->view('email/email_formates/common_email_formate.php',$data,true);
              
              //$message = '<a href="'.$link.'">Click on link to reset password</a>';
              //$fromemail='admin@createonlineacademy.com';
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
  

  public function enrolled_users(){

    $auth = $this->session->userdata('logged_in');
    // print_r($auth);exit;
    if(!empty($auth)){
      $con1 = "b.userid != p.author and b.is_delete = 'no' ";
      if($auth['groupid'] == 2)
        $con1 .= " and p.author = ".$auth['id'];

      if($this->input->post('teacher_id'))
      {
        $con1 .= " and p.author = ".$this->input->post('teacher_id');
      }
      if($this->input->post('search_text'))
      {
        $con1 .= " and (p.name like '%".$this->input->post('search_text')."%' OR u.first_name like '%".$this->input->post('search_text')."%' OR u.last_name like '%".$this->input->post('search_text')."%')";
      }
      $total_enrolled = $this->users_model->getTotal_enrolled($con1);
      if($this->input->post('pay_page'))
      {

        $currpage = $this->input->post('pay_page');
        if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
        {
          $firstp = 0;
        }
        else{
          $firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
        }
        if((intval($firstp)+intval(10)) > $total_enrolled->total)
        {
          $startp = $total_enrolled->total;
        }
        else{
          $startp = $firstp + 10;
        }
        $enrolled_users = $this->users_model->getEnrolled_users($con1,"b.id DESC",10,$firstp);
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 10;
        $enrolled_users = $this->users_model->getEnrolled_users($con1,"b.id DESC",10,$firstp);
      }

      $pagination = '';
      $pagesp = ceil(intval($total_enrolled->total)/10);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $pagination .= '<li data-ci-pagination-page="1" onclick="get_payout(1,\'enrolled-users\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="get_payout('.(intval($currpage)-1).',\'enrolled-users\')"><a>&lt;</a></li>';

        if((intval($currpage)-3)>0) {
          if($currpage == 1)
            $pagination .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
        }
        if((intval($currpage)-3)>1) {
            $pagination .= '<li>...</li>';
        }
        
        for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
          if($i<1) continue;
          if($i>$pagesp) break;
          if(intval($currpage) == $i)
            $pagination .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="get_payout('.$i.',\'enrolled-users\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $pagination .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="get_payout('.$pagesp.',\'enrolled-users\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="get_payout('.(intval($currpage)+1).',\'enrolled-users\')" ><a> > </a></li>
                  <li onclick="get_payout('.$pagesp.',\'enrolled-users\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      if($this->input->post('pay_page'))
      {
        $output = "";
        $i= (intval($this->input->post('pay_page')) - 1) * 10;
        $i++;
        if(!empty($enrolled_users)){
          foreach ($enrolled_users as $key)
          {
            if(!empty($key->first_name))
              $stud_name = ucwords($key->first_name.' '.$key->last_name);
            else
              $stud_name = ucwords($key->name);
            
            if(!empty($key->t_fname))
              $teacher_name = ucwords($key->t_fname.' '.$key->t_lname);
            else
              $teacher_name = ucwords($key->t_name);

            $batch_name = 'N/A';
            if(!empty($key->batch_id)){
              $batch = $this->Crud_model->get_single('mlms_batches',"id = ".$key->batch_id,"batch_name");
              $batch_name = ucwords($batch->batch_name);
            }
            $criteria = $key->criteria;
            if($key->criteria == 'paid')
              $criteria = "subscribed";
            $output .= '
            <tr class="camp0">
              <td class="field-title" style="font-weight:bold;">'.$i++.'</td>
              <td class="field-title">'.ucwords($stud_name).'</td>
              <td class="field-title">'.ucwords($key->course_name).'</td>
              <td class="field-title"> '.$batch_name.' </td>
              <td class="field-title"> '.$teacher_name.' </td>
              <td class="field-title"> '.date('Y-m-d h:i A',strtotime($key->buy_date)).' </td>
              <td class="field-title"> '.ucwords($criteria).' </td>
              <td class="field-title">
                <a class="col-sm-4" href="'.base_url().'admin/orders/edit_enrolled/'.$key->id.'">
                  <div class="sprite 2edit" style="background-position: -32px 0;" title="update Enrollment"></div>
                </a>
              </td>
              ';
            $output .= '</tr>';
          }
        }else{
          $output .= '<tr class="camp0"><td class="field-title" colspan="8">No users enrolled. </td></tr>';
        }
        $data1['payoutdata'] = $output;
        $data1['lastpage'] = $pagesp;
        $data1['links'] = $this->input->post('pay_page');
        $data1['firstp'] = $firstp + 1;
        $data1['startp'] = $startp;
        $data1['paying'] = $pagination;
        $data1['currpage'] = $currpage;
        $data1['total_payout'] = $total_enrolled->total;
        echo json_encode($data1);
      }
      else{
        $teachers = $this->Crud_model->GetData('mlms_users',"id,name,first_name,last_name","group_id = 2 and active = 1 and trash = 0","","first_name ASC");
        $data = array(
              'enrolled_users' => $enrolled_users,
              'paying' => $pagination,
              'currpage' => $currpage,
              'firstp' => $firstp + 1,
              'startp' => $startp,
              'teachers' => $teachers,
              'groupid' => $auth['groupid'],
              'total_payout' => $total_enrolled->total,
        );
        $this->template->set_layout('backend');
        $this->template->build('admin/orders/enrolled_list',$data);            
      }
    }
    else
    {
      redirect(base_url());
    }
  }

  public function edit_enrolled($id = ''){
    $get_enrolled = $this->users_model->getEnrolled_details("b.id = ".$id);
    $batches = $this->Crud_model->GetData('mlms_batches',"id,batch_name,batch_from,batch_start_time,batch_end_time","course_id = ".$get_enrolled->course_id." and is_delete = 'no'");
    if(!empty($get_enrolled->first_name))
      $name = $get_enrolled->first_name.' '.$get_enrolled->last_name;
    else
      $name = $get_enrolled->name;

    $data = array(
            'course_name' => ucwords($get_enrolled->course_name),
            'name'        => ucwords($name),
            'batch_id'    => $get_enrolled->batch_id,
            'buy_date'    => $get_enrolled->buy_date,
            'criteria'    => $get_enrolled->criteria,
            'id'          => $get_enrolled->id,
            'batches'     => $batches,
    );
    $this->template->set_layout('backend');
    $this->template->build('admin/orders/edit_enrolled',$data);
  }

  public function update_enroll(){
    $batch_id = $this->input->post('batch_id');
    $id = $this->input->post('id');
    $data = array(
            'batch_id' => $batch_id
    );
    $this->Crud_model->SaveData('mlms_buy_courses',$data,"id = ".$id);
    echo "updated";
  }

  public function get_batch(){
    $id = $this->input->post('id');
    $batches = $this->Crud_model->GetData('mlms_batches',"id, batch_name","course_id = ".$id." and is_delete = 'no' and status = 'active'");
    $output = '';
    if(!empty($batches)){
      foreach ($batches as $key) {
        $output .= "<option value='".$key->id."'>".ucwords($key->batch_name)."</option>";
      }
    }else{
      $output = "<option value=''>Select</option>";
    }
    echo $output;
  }

  public function demo_order_list(){
    $auth = $this->session->userdata('logged_in');
    if(!empty($auth)){
      $userid = NULL;
      if($auth['groupid'] != 4)
      {
        $userid = $auth['id'];
      }
      $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : '';
      $search_status = ($this->input->post('status_id', TRUE)) ? $this->input->post('status_id', TRUE) : '';

      $from_date = ($this->input->post('from_date', TRUE)) ? $this->input->post('from_date', TRUE) :'';        //$sess_orders['searchfromdate'];
      $to_date = ($this->input->post('to_date', TRUE)) ? $this->input->post('to_date', TRUE) :'';               //$sess_orders['searchtodate'];

      $search_period = ($this->input->post('period', TRUE)) ? $this->input->post('period', TRUE) : '';          //$sess_orders['searchperiod'];
      $search_cate = ($this->input->post('teacher_id', TRUE)) ? $this->input->post('teacher_id', TRUE) : '';
      if($auth['groupid'] != 4)
      {
        $search_cate = $auth['id'];
      }

      $total_rows = $this->users_model->getOrdersCount($search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);
      if($this->input->post('pay_page'))
      {
        $currpage = $this->input->post('pay_page');
        if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
        {
          $firstp = 0;
        }
        else{
          $firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
        }
        if((intval($firstp)+intval(10)) > $total_rows)
        {
          $startp = $total_rows;
        }
        else{
          $startp = $firstp + 10;
        }
        $orders = $this->users_model->getOrders(10,$firstp,$search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);     
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 10;
        $orders = $this->users_model->getOrders(10,$firstp,$search_string,$search_status,$search_cate,$search_period,$from_date,$to_date,$userid);     
      }
      $pagination = '';
      $pagesp = ceil(intval($total_rows)/10);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $pagination .= '<li data-ci-pagination-page="1" onclick="get_payout(1,\'admin/orders/demo_order_list\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="get_payout('.(intval($currpage)-1).',\'admin/orders/demo_order_list\')"><a>&lt;</a></li>';

        if((intval($currpage)-3)>0) {
          if($currpage == 1)
            $pagination .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
        }
        if((intval($currpage)-3)>1) {
            $pagination .= '<li>...</li>';
        }
        
        for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
          if($i<1) continue;
          if($i>$pagesp) break;
          if(intval($currpage) == $i)
            $pagination .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="get_payout('.$i.',\'admin/orders/demo_order_list\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $pagination .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="get_payout('.$pagesp.',\'admin/orders/demo_order_list\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="get_payout('.(intval($currpage)+1).',\'admin/orders/demo_order_list\')" ><a> > </a></li>
                  <li onclick="get_payout('.$pagesp.',\'admin/orders/demo_order_list\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      if($this->input->post('pay_page'))
      {
        $output = "";
        if(!empty($orders)){
          $firstp = $firstp + 1;
          foreach ($orders as $key)
          {
            $coursearr=explode('-',$key->courses);
            $plan_id = $this->users_model->getPlanId(@$coursearr[0]);
            $output .= '
            <tr class="camp0">
              <td class="field-title" style="font-weight:bold;">'.$key->id.'</td>
              <td class="field-title">'.ucwords($key->first_name.' '.$key->last_name).'</td>
              <td class="field-title">'.ucwords($key->program_name).'</td>
              <td class="field-title"> '.$key->amount.' </td>
              <td class="field-title"> '.$this->users_model->getPlanName(@$plan_id).' </td>
              <td class="field-title"> '.$key->order_date.' GMT'.' </td>
              <td class="field-title"> '.$key->amount_paid.' </td>
              <td class="field-title"> '.$key->processor.' </td>
              <td class="field-title"> '.$key->status.' </td>
              <td class="field-title">
                <a class="col-sm-offset-3 col-sm-4 no-padding" href="'.base_url().'admin/orders/edit/'.$key->id.'/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit"></div></a>
              <a class="col-sm-4" onclick="return delete_order('.$key->id.')"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
              </td>
            </tr>';
          }
        }else{
          $firstp = 0;
          $output .= '<tr class="camp0">
            <td class="field-title" colspan="10" style="color: #949494; text-align:center !important;">No orders yet.</td>
          </tr>';
        }
        $data1['payoutdata'] = $output;
        $data1['lastpage'] = $pagesp;
        $data1['links'] = $this->input->post('pay_page');
        $data1['firstp'] = $firstp;
        $data1['startp'] = $startp;
        $data1['paying'] = $pagination;
        $data1['currpage'] = $currpage;
        $data1['total_payout'] = $total_rows;
        echo json_encode($data1);
      }
      else{
        $teachers = $this->Crud_model->GetData('mlms_users',"id,first_name,last_name","group_id = 2 and active = 1 and trash = 0","","first_name ASC");
        $data = array(
              'orders' => $orders,
              'paying' => $pagination,
              'currpage' => $currpage,
              'firstp' => $firstp + 1,
              'startp' => $startp,
              'teachers' => $teachers,
              'total_payout' => $total_rows,
        );
        $this->template->set_layout('backend');
        $this->template->build('admin/orders/list',$data);
      }
    }
    else
    {
      redirect(base_url());
    }
  }


}
