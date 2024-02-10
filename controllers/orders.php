<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends MLMS_Controller
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
        $this->load->model('Pagecreator_model');
        $this->load->model('login_model');
        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
        $this->configarr = $configarr;
        $this->template->set_layout($configarr[0]['layout_template']);
        $this->template->set("configarr", $configarr);      
        $this->load->library('email');
        $this->load->library('form_validation');
    }

    function authenticate()
    {
        $session = $this->session->userdata('logged_in');
        if(!$this->session->userdata('logged_in'))
        {
            redirect('users/login');
        }
    } 

    function index($parent_id = NULL)
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
        // $this->template->title('Orders List');

        $configarr = $this->settings_model->getItems();
        $logoimage=$configarr[0]['logoimage'];
        // $this->template->set("configarr", $configarr); 
        $configarr = $this->settings_model->getItems();   
        $tmpl = $configarr[0]['layout_template'];      
        // $this->template->set("tmpl",$tmpl);
        // $this->template->set('updType', 'create');
        $data['tmpl'] = $tmpl;
        $data['title'] = 'Orders List';
        $data['configarr'] = $configarr;
        $data['updType'] = 'create';
        $data['signs'] = $this->settings_model->getCurrenciesign($configarr[0]['currency']);

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
        $this->pagination->initialize($config);
        $data['orders'] = $this->orders_model->getOrders($user_id,$config['per_page'],$start,$search_string);
        $data['countorders'] = $this->orders_model->getcountOrders($user_id);
        $this->load->view('new_template_design/header');
        $this->load->view('orders/list', $data);
        $this->load->view('new_template_design/footer');
    }

    function cart_list()
   { 
       
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
        
        
        $configarr = $this->settings_model->getItems();
        $logoimage=$configarr[0]['logoimage'];
        // $this->template->set("configarr", $configarr); 
        $configarr = $this->settings_model->getItems(); 
        $tmpl = $configarr[0]['layout_template'];      
        // $this->template->set("tmpl",$tmpl);
        // $this->template->set('updType', 'create');
        $data['signs'] = $this->settings_model->getCurrenciesign($configarr[0]['currency']);
        $data['tmpl'] = $tmpl;
        $data['title'] = 'Cart List';
        $data['configarr'] = $configarr;
        $data['updType'] = 'create';

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
        $path=base_url() . "orders/cart_list/";
        $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
        $baseurl = base_url() . "orders/cart_list/";
        $this->load->library('pagination');
        $config["base_url"] = $baseurl;
        $config['per_page'] = 10;
        $config['enable_query_strings'] = true;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->orders_model->getCartCount($search_string,$search_status,$user_id);
        $this->pagination->initialize($config);
        $data['total_rows'] = $config['total_rows'];
        $data['carts'] = $this->orders_model->getCarts($user_id,$config['per_page'],$start,$search_string);
        $data['countorders'] = '0'; //$this->orders_model->getcountOrders($user_id);
        $this->load->view('new_template_design/header');
        $this->load->view('orders/cart_list', $data);
        $this->load->view('new_template_design/footer');
    }
    
    function support()
    {
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $tmpl = $configarr[0]['layout_template'];      
        $this->template->set("tmpl",$tmpl);
        $this->template->title('Your Query & Support'); 
        $admin_email = '';
        $btnvalue = $this->input->post('send');
        if($btnvalue == 'send')
        {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $body = $this->input->post('body');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'subject', 'required');
            $this->form_validation->set_rules('body', 'body', 'required');
            if ($this->form_validation->run() === FALSE)
            {
                $this->template->build(getOverridePath($tmpl,'orders/support','views'));  
            }
            else
            {
                $info = array('user_name' => $name,'user_email' => $email,'query_subject' => $subject,'query_msg' => $body);
                $insertsupport = $this->orders_model->support($info);
                if($insertsupport) 
                {
                    if($configarr[0]['fromemail'])  
                    $urldomain = $configarr[0]['fromemail']; 
                    else $urldomain = 'noreply@'.$this->config->item('urldomain');

                    $fromemail=$urldomain;       
                    $admininfo = $this->login_model->getadminInfo(4);       
                    $admin_email= $admininfo->email;
                    $admininfo = $this->login_model->getadminInfo(4);
                    $configarr = $this->settings_model->getItems();
                    $this->load->library('email');
                    $subject1 = 'Enuiry received - '.$configarr[0]['institute_name'];
                    $toemail = $admin_email;
                    $content = '';
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
                                Enuiry received - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
                    $content .='There is a new Enquiry from customer Support. Here are the details:<br /><br />';
                    $content .='Email : <a style="color:#55c5eb" href="mailto:'.$email.'" target="_blank">'.$email.'</a><br/>';
                    $content .= 'Subject : '.$subject.'<br />';
                    $content .= 'Message : '.$body.'<br />';
                    $data['content'] = $content; 
             		$data['fromemail'] = $urldomain;
                    $message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail,$configarr[0]['fromname']);
                    $this->email->to($toemail);
                    $this->email->subject($subject1);
                    $this->email->message($message1);
                    $this->email->send();
                    $content2 = '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
                                Enuiry received - '.$configarr[0]['institute_name'].'</p>';
                    $content2 .= '<p>Dear '.trim(ucfirst($name)).',<br /><br />';
                    $content2 .= 'We are received your message. We will get back to you at the Earliest.<br /><br />';
                    $content2 .= 'Thank You for contacting us...';
                    $content2 .= $configarr[0]['signature'].'</p>';
                    $data2['content'] = $content2;
                    $message2 = $this->load->view('email_formates/admin_email_formate.php',$data2,true);
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail,$configarr[0]['fromname']);
                    $this->email->to($email);
                    $this->email->subject($subject1);
                    $this->email->message($message2);
                    $this->email->send();
                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest'));
                    redirect('orders/support');
                }
            }
        }
        $this->template->set("configarr", $configarr);
        $pagetype="contact";
        $contactpage=$this->Pagecreator_model->getPageByType($pagetype);
        if($contactpage[0]['status'] =='inactive')
        {
            redirect(base_url(),'location',301);
        }
        $this->template->set('contactpage',$contactpage);
        $this->template->build(getOverridePath($tmpl,'orders/support','views'));  
    }
    
    function view($parent_id = NULL)
    {      
        $orderid = $this->uri->segment(3);
        $u_data = $this->session->userdata('logged_in');
        $authorOf = $this->orders_model->courseCreatedBy($orderid);
        if((@$authorOf[0]->userid != $u_data['id'] && $u_data['groupid'] != '4') || empty($authorOf))
        {
          redirect('category/pagenotfound'); 
        }
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
        // $configarr = $this->settings_model->getItems();   
        // $tmpl = $configarr[0]['layout_template'];      
        // $this->template->set("tmpl",$tmpl);
        // $this->template->set('updType', 'create');
        $orders = $this->orders_model->viewOrder($user_id,$orderid);
        
        $data = array(
                'orders' =>$orders
        );
        $parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
        $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
        $sess_orders = $this->session->userdata('sess_orders');
        $order_id  = $this->uri->segment(3);
        // $this->template->set("orders", $this->orders_model->viewOrder($user_id,$order_id));   
        // $this->template->build('orders/view');
        $this->load->view('new_template_design/header');
        $this->load->view('orders/view',$data);
        $this->load->view('new_template_design/footer');
    }
    
    function edit($id = FALSE)
    {
        $this->authenticate();
        $this->template->append_metadata(block_submit_button());
        $loggeduser_data=$this->session->userdata('loggedin');
        $this->template->set("order", $this->orders_model->getIndividualOrder(($id)));
        $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
        $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $this->_set_rules(); //
        $this->template->set('title', lang('web_category_create'));
        $this->template->set('updType', 'edit');
        $this->template->set('id',$id);
        $this->template->set('username',$this->settings_model->getUsersName());
        $this->template->set('courses',$this->settings_model->getCourses());
        $this->form_validation->set_rules('status_id', 'status_id', 'required');
        $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        {
            $this->template->build('admin/orders/create_order');
        }
        else
        {
            $data = array(
                    'order_date'    => date("Y-m-d h:i:s"),
                    'amount'        => $this->input->post('price'),
                    'status'        => $this->input->post('status_id'),
                    'pending_reason'=> trim($this->input->post('pending_reason')),
                    'amount_paid'   => $this->input->post('amount'),
                    'processor'     => $this->input->post('processor')           
            );
            $isupdated = $this->orders_model->updateOrder($id,$data); 
            if ($isupdated) // the information has therefore been successfully saved in the db
            {
                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success')));
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
        $this->_set_rules();
        $this->template->set('title', lang('web_category_create'));
        $this->template->set('updType', 'create');
        $this->template->set('parent_id',$parent_id);
        $this->template->set('username',$this->settings_model->getUsersName());
        $this->template->set('courses',$this->settings_model->getCourses());
        $this->form_validation->set_rules('course_id', 'course_id', 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('status_id', 'status_id', 'required');
        $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');
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
                    'processor'     => $this->input->post('processor')           
            );
            $order_id = $this->orders_model->insertOrder($data);
            $data1 = array(
                    'userid'    => $this->input->post('user_id'),
                    'order_id'  => $order_id,
                    'course_id' => $this->input->post('course_id'),
                    'price'     => $this->input->post('price'),
                    'buy_date'  => date("Y-m-d h:i:s"),
                    'status'    => $this->input->post('status_id')                    
            );
            $this->orders_model->insertBuyCourse($data1);
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
            redirect('admin/orders');
       }
    }

    function delete($id = NULL)
    {
        $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        if (!$id){
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
            redirect('orders/');
        }
        $isdelete = $this->orders_model->deleteOrder($id);
        if ($isdelete)
        {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
        }
        redirect('orders');
    }

    public function paid($tid = FALSE)
    {
        $tid = ($this->uri->segment(3) != 0) ? filter_var($this->uri->segment(3), FILTER_VALIDATE_INT) : NULL;
        if (!$tid){
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
            redirect('orders/');
            }

        $upd_data = array(
                        'status'=>'Completed'
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
        redirect('orders');
    }

    public function pending($tid = FALSE)
    {
        $tid = ($this->uri->segment(3) != 0) ? filter_var($this->uri->segment(3), FILTER_VALIDATE_INT) : NULL;
        if (!$tid){
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
            redirect('orders/');
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
       redirect('orders');
    }

    function pdf()
    {  
        $this->load->helper('pdf_helper');
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
        $order_id  = $this->uri->segment(3) ;   
        $this->template->set("orders", $this->orders_model->viewOrder($user_id,$order_id));   
        $this->load->view('orders/pdfreport');  
    }

    function sendOrderMail()
    {
      $this->load->helper('pdf_helper');
      $this->load->view('orders/sendordermail');
    }

    function orderMail()
    {
          $sendto = $_POST['sendto'];
          $msgbody =$_POST['msgbody'];
          $orderno =$_POST['orderno'];
          $username =$_POST['username'];
          $coursename =$_POST['coursename'];
          $newFile  = FCPATH.'public/uploads/orderpdf/pdf_no_'.$orderno.'.pdf';
        if($configarr[0]['fromemail'])  
            $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
         
          $this->load->model('admin/settings_model');
          $configarr = $this->settings_model->getItems();
          $this->template->set("configarr", $configarr);
          $subject = 'ORDER INVOICE';  // to '.$configarr[0]['institute_name'];
          $toemail = $sendto;
          $content = '';
          $content .= '<p>Hi,<br /><br />';
          $content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
          $content .= "'".$msgbody."'.<br /><br />";
          $content .= "Please find Attachment for Order Invoice for course '".$coursename."'.<br /><br />";
          $content .= 'If you need help or have any questions, please contact us.<br />';
          $content .= '<br /><br />';
          $content .='...</p>';
          $content .= $configarr[0]['signature'].'</p>';
          $data['content'] = $content; 
		$data['fromemail'] = $urldomain;
          $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
          $fromemail=$urldomain;
          $config['charset'] = 'utf-8';
          $config['mailtype'] = 'html';
          $config['wordwrap'] = TRUE;
          $this->email->initialize($config);
          $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
          $this->email->subject($subject);
          $this->email->to($toemail);
          $this->email->message($message);
          $this->email->attach($newFile);
          $this->email->send();
          return true;
    }

    function email_template()
    {
        $this->load->view('email_formates/admin_email_formate');
    }

    function percentageOrders($parent_id = NULL)
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
        
    $configarr = $this->settings_model->getItems();
    $logoimage=$configarr[0]['logoimage'];
    $configarr = $this->settings_model->getItems();   
    $tmpl = $configarr[0]['layout_template']; 
        $data['configarr'] = $configarr;
        $data['tmpl'] = $tmpl;
        $data['title'] = 'Orders List';
        $data['updType'] = "create";
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
        $baseurl = base_url() . "orders/percentageOrders/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->orders_model->getOrdersCount($search_string,$search_status,$user_id);
       $this->pagination->initialize($config);
       $data['title'] = 'Courses Sale';
        $data['orders'] = $this->orders_model->getSell($user_id,$config['per_page'],$start,$search_string);
        $data['countorders'] = $this->orders_model->getcountOrders($user_id);
        $data['coursepercent'] = $this->orders_model->getUserDetails($user_id);
        $this->load->view('new_template_design/header', TRUE);
           $this->load->view('orders/orderpercentage', $data);
           $this->load->view('new_template_design/footer');
    }



    // payment process for vidyakul
    public function update_order(){
        $merchant_order_id = $this->input->post('merchant_order_id');
        $order = array(
                'status'        => 'FAILURE',
                'pending_reason'=> "Order cancel by User"
        );
        $this->Crud_model->SaveData("mlms_vidyakul_orders",$order,"transactionid = '".$merchant_order_id."'");
        $order = $this->Crud_model->get_single('mlms_vidyakul_orders','transactionid = "'.$merchant_order_id.'"');
        $users = $this->Crud_model->get_single('mlms_users',"id = ".$order->user_id,"id,email,mobile,first_name,last_name,name");
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else 
        $urldomain = 'noreply@mytonlineshiksha.com';

        $subject = 'Order #'.$order->id.' Failed';
        $toemail = 'borikarn153@gmail.com';
        // $toemail = 'prshah83@gmail.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order->id.' is cancelled by User.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($users->first_name.' '.$users->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($users->email).'<br/>';
        $content .= 'Customer Mobile : '.$users->mobile.'<br/>';
        $content .= 'Course Name : '.$order->course_name.'<br/>';
        $content .= 'Course Price : '.$order->amount.'<br/>';
        $content .= '<br/>';
        $data['content'] = $content; 
        $data['fromemail'] = $urldomain;
        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
        $fromemail = $urldomain;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject);
        $this->email->to($toemail);
        $this->email->message($message);
        $this->email->send();
        echo "0";
    }

    public function create_order(){
        $user_id = $this->input->post('user_id');
        $course_name = $this->input->post('course_name');
        $merchant_amount = $this->input->post('merchant_amount');
        $merchant_order_id = $this->input->post('merchant_order_id');
        $currency_code = $this->input->post('currency_code');

        $referred_code = get_cookie('referral_code');
        $order = array(
                'user_id'       => $user_id,
                'course_name'   => $course_name,
                'transactionid' => $merchant_order_id,
                'amount'        => $merchant_amount,
                'currency'      => $currency_code,
                'processor'     => 'Razorpay'
        );
        $this->Crud_model->SaveData("mlms_vidyakul_orders",$order);
        $order_id = $this->db->insert_id();
        // sending mail for pending request
        $this->load->library('email');
        $this->load->model('admin/settings_model');           
        $configarr = $this->settings_model->getItems();   

        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else 
        $urldomain = 'noreply@mytonlineshiksha.com';

        $userdata = $this->Crud_model->get_single('mlms_users','id = '.$user_id,'email,first_name,last_name,mobile');
        // $coursedetails =$this->Crud_model->get_single('mlms_program',"id = ".$course_id,"name,slug");
        $subject = 'Order #'.$order_id.' Pending';
        // $toemail = 'prashant@veerit.com';
        $toemail = 'borikarn153@gmail.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order_id.' is Pending.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
        $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
        $content .= 'Course Name : '.$course_name.'<br/>';
        $content .= 'Course Price : '.$merchant_amount.'<br/>';
        $content .= '<br/>';
        $data1['content'] = $content; 
        $data1['fromemail'] = $urldomain;
        $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
        $fromemail = $urldomain;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject);
        $this->email->to($toemail);
        $this->email->message($message);
        $this->email->send();
        // sending mail for pending request
    }
    private function curl_handler($payment_id, $amount)  {
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        // Live key details
        /*$key_id         = $this->config->item('keyId');
        $key_secret     = $this->config->item('keySecret');*/
        // Test keyn details
        $key_id         = 'rzp_test_6MFfxqebE6WWyY';
        $key_secret     = 'HDxBNOGr6y8ZCZJbhCqX1WDW';
        $fields_string  = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;
    }   
        
    // callback method
    public function callback()
    {
      $json['msg'] = '';
      if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $merchant_order_id = $this->input->post('merchant_order_id');
        $order_info = array('order_status_id' => $merchant_order_id);
        
        $this->session->set_flashdata('razorpay_payment_id', $razorpay_payment_id);
        $this->session->set_flashdata('merchant_order_id', $merchant_order_id);
        $amount = $this->input->post('merchant_total');
        try {
          $success = false;
          $error = '';
          $ch = $this->curl_handler($razorpay_payment_id, $amount);
          //execute post
          $result = curl_exec($ch);
          $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          if ($result === false) {
              $success = false;
              $error = 'Curl error: '.curl_error($ch);
          } else {
              $response_array = json_decode($result, true);
                  //Check success response
                  if ($http_status === 200 and isset($response_array['error']) === false) {
                      $success = true;
                  } else {
                      $success = false;
                      if (!empty($response_array['error']['code'])) {
                          $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                      } else {
                          $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                      }
                      header('Content-Type: application/json');
                      $json['msg'] = $error;
                      echo json_encode($json); exit;
                  }
                }
              //close curl connection
              curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                header('Content-Type: application/json');
                $json['msg'] = 'Request to Razorpay Failed';
                echo json_encode($json); exit;
            }
            if ($success === true) {
              if(!empty($this->session->userdata('ci_subscription_keys'))) {
                  $this->session->unset_userdata('ci_subscription_keys');
              }
              if (!$order_info['order_status_id']) {
                  $json['redirectURL'] = $_POST['merchant_surl_id'];
              } else {
                  $json['redirectURL'] = $_POST['merchant_surl_id'];
              }
              
          } else {
              $json['redirectURL'] = $_POST['merchant_furl_id'];
          }
      } else {
          $json['msg'] = 'An error occured. Contact site administrator, please!';
      }
      header('Content-Type: application/json');
      echo json_encode($json);
    }

    public function razor_success() {
        $order_id = $this->session->flashdata('merchant_order_id');
        $razorpay_payment_id = $this->session->flashdata('razorpay_payment_id');
        /*$url = 'https://api.razorpay.com/v1/payments/'.$razorpay_payment_id;
        // commission and assessment calculations and updations
      // $order_id = 'Txn63821209';
        $key_id = 'rzp_test_6MFfxqebE6WWyY';
        $key_secret = 'HDxBNOGr6y8ZCZJbhCqX1WDW';
        // $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, 0);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result);*/
        $order = array(
                'status'  => 'SUCCESS',
        );
        $this->Crud_model->SaveData("mlms_vidyakul_orders",$order,'transactionid = "'.$order_id.'"');
        $orders = $this->Crud_model->get_single('mlms_vidyakul_orders','transactionid = "'.$order_id.'"');
        $users = $this->Crud_model->get_single('mlms_users',"id = ".$orders->user_id,"id,email,mobile,first_name,last_name,name");
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])
            $urldomain = $configarr[0]['fromemail'];
        else
            $urldomain = 'noreply@mytonlineshiksha.com';
        
        $subject = 'Order #'.$orders->id.' SUCCESS';
        // $toemail = 'prshah83@gmail.com';
        $toemail = 'borikarn153@gmail.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$orders->id.' is Succeeded.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($users->first_name.' '.$users->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($users->email).'<br/>';
        $content .= 'Customer Mobile : '.$users->mobile.'<br/>';
        $content .= 'Course Name : '.$orders->course_name.'<br/>';
        $content .= 'Course Price : '.$orders->amount.'<br/>';
        $content .= '<br/>';
        $data['content'] = $content; 
        $data['fromemail'] = $urldomain;
        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
        $fromemail = $urldomain;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject);
        $this->email->to($toemail);
        // $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();


        // order mail to customer
        $subject1 = 'Order #'.$orders->id.' SUCCESS';
        $toemail111 = $users->email;
        // $toemail = 'prashant@veerit.com';
        // $toemail1 = 'ashish.gurao@veerit.com';
        $content1 = '';          
        $content1 .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
        $content1 .= '<p>Hi '.trim(ucfirst($users->first_name.' '.$users->last_name)).',<br /><br />';
        $content1 .= 'Thank you for your purchase. Here are your course purchase details:<br /><br />';
        $content1 .= ' Course Name: '.$orders->course_name.'<br />';
        $content1 .= ' Transaction Id: '.$order_id.'<br />';
        $content1 .= ' Status: Payment Success.<br />';
        $content1 .= ' Amount: '.$orders->amount.'<br /><br />';
        $content1 .= " Your purchase was successfull! <br/>Thank you for enrolling to the ".$orders->course_name.".
We will send instructions with the information to start accessing the content to your registered email.<br/>
For any query, you can contact Mr.Ashish at +91-9960912357.<br /><br />";
        $content1 .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';

        $data1['content'] = $content1; 
        $data1['fromemail'] = $urldomain;
        $message1 = $this->load->view('email_formates/common_email_formate.php',$data1,true);
        $fromemail = $urldomain;
        $config1['charset'] = 'utf-8';
        $config1['mailtype'] = 'html';
        $config1['wordwrap'] = TRUE;
        $this->email->initialize($config1);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject1);
        $this->email->to($toemail111);
        $this->email->message($message1);
        $this->email->send();
        echo "1";
    }

    public function razor_failed() {
        $order_id = $this->session->flashdata('merchant_order_id');
        $data = array(
                    'status' => "FAILURE",
        );
        $this->Crud_model->SaveData('mlms_vidyakul_orders',$data,'transactionid = "'.$order_id.'"');
        $order = $this->Crud_model->get_single('mlms_vidyakul_orders','transactionid = "'.$order_id.'"');
        $users = $this->Crud_model->get_single('mlms_users',"id = ".$order->user_id,"id,email,mobile,first_name,last_name,name");
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else 
        $urldomain = 'noreply@mytonlineshiksha.com';

        $subject = 'Order #'.$order->id.' Failed';
        $toemail = 'borikarn153@gmail.com';
        // $toemail = 'prshah83@gmail.com';
        // $toemail1 = 'ashish.gurao@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order->id.' is failed.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($users->first_name.' '.$users->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($users->email).'<br/>';
        $content .= 'Customer Mobile : '.$users->mobile.'<br/>';
        $content .= 'Course Name : '.$order->course_name.'<br/>';
        $content .= 'Course Price : '.$order->amount.'<br/>';
        $content .= '<br/>';
        $data['content'] = $content; 
        $data['fromemail'] = $urldomain;
        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
        $fromemail = $urldomain;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject);
        $this->email->to($toemail);
        // $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();
        echo "0";
    }

}