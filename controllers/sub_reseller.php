<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sub_reseller extends MLMS_Controller
{
	function __construct()
	{  
   		parent::__construct();
   		$this->authenticate();
   		error_reporting(0);
      $this->template->set_layout('backend');				
      $this->lang->load('tooltip', 'english');
      $this->load->model('reseller_model');
      $this->load->model('Crud_model');
      $this->load->library('phpqrcode/qrlib');    // QR-code library
	}

	public function index()
	{
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
        $gettype = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$auth['id'],'parent_id');
        if(!empty($gettype->parent_id))
            redirect('partner/coupons');
        
        $getchilds = $this->reseller_model->get_agents('a.parent_id = '.$auth['id'],1);
        $data = array(
                    'getchilds' => $getchilds
        );
        $this->template->set_layout('backend');
        $this->template->build('reseller/agent_list',$data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function create()
	{
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
        $getassess = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$auth['id'],'assessment');
        $data = array(
                    'button'        => "Create",
                    'heading'       => "Add Sub-Reseller Details",
                    'action_url'    => base_url()."sub_reseller/create_action/",
                    'first_name'    => set_value('first_name'),
                    'last_name'     => set_value('last_name'),
                    'email'         => set_value('email'),
                    'mobile'        => set_value('mobile'),
                    'commission'    => set_value('commission'),
                    'id'            => set_value('id'),
                    'maxcomm'       => $getassess->assessment
        );
        $this->template->set_layout('backend');
        $this->template->build('reseller/create_agent',$data);
    }
    else
    {
      redirect();
    }
	}

	public function create_action()
	{
      $auth = $this->session->userdata('logged_in');    
      if(!empty($auth)){
        $parent_id = $auth['id'];
      }
      else{
        redirect();exit;
      }
      $fname = $this->input->post('first_name');
      $lname = $this->input->post('last_name');
      $email = strtolower($this->input->post('email'));
      $contact_no = $this->input->post('mobile');
      $referred = $this->input->post('commission');
      $ref = $this->randomPassword(8);
      if($email == '')
      {
        $email = $ref."@mos.com";
      }
      $data = array(
                'username'      =>  $email,
                'email'         =>  strtolower($email),
                'first_name'    =>  $fname,
                'last_name'     =>  $lname,
                'images'        =>  '',
                'active'        =>  '1',
                'is_student'    =>  '0',//one is for yes
                'is_instructor' =>  '0',//zero is for no
                'created_at'    =>  date('Y-m-d H:i:s'),
                'password'      =>  md5($fname."@123!"),
                'group_id'      =>  '5',
                'referral_code' =>  $ref,
                'mobile'        =>  $contact_no
      );
      $this->Crud_model->SaveData('mlms_users',$data);
      $insertid = $this->db->insert_id();

      $text1234 = base_url()."category/courses?ref=".$ref;
      $SERVERFILEPATH = getcwd().'/public/uploads/resellers_QR/';
      $text1= $ref;
      $folder = $SERVERFILEPATH;
      $file_name1 = $text1."-Qrcode".rand(0,9999).".png";
      $file_name = $folder.$file_name1;
      QRcode::png($text1234,$file_name,8,8);
      $form_data = array(
                    'referral_qr' => $file_name1,
      );
      $this->Crud_model->SaveData('mlms_users',$form_data,"id = ".$insertid);
      if($insertid > 1)
      {
        $group_data = array(
                'user_id' => $insertid,
                'group_id' => 5
        );
        $this->Crud_model->SaveData('mlms_users_groups',$group_data);
        
        $pay_data = array(
                'user_id' => $insertid,
                'modified' => date('Y-m-d H:i:s')
        );
        $this->Crud_model->SaveData('mlms_payout',$pay_data);
        $assess_data = array(
                  'user_id' => $insertid,
                  'ass_type' => "2",
                  'assessment' => $referred,
                  'created' => date('Y-m-d H:i:s'),
                  'modified' => date('Y-m-d H:i:s'),
                  'parent_id' => $parent_id
        );
        $this->Crud_model->SaveData('mlms_assessment',$assess_data);
      }
      redirect('partner/sub-reseller-list');
	}

   function randomPassword($length) {
     $alphabet = "a9den7pqz01fghijko2bc83rstxy45uw6lm";
     $pass = array(); //remember to declare $pass as an array
     $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
     for ($i = 0; $i < $length; $i++) {
         $n = rand(0, $alphaLength);
         $pass[] = $alphabet[$n];
     }
     if($this->Crud_model->get_single('mlms_users',"referral_code = '".implode($pass)."'"))
     {
         $this->randomPassword(8);
     }
     return implode($pass); //turn the array into a string
  }
  function email_exists() 
  {
      $email = $this->input->post('email');
      $mobile = $this->input->post('mobile');
      $user_id = $this->input->post('agent_id');

      if(!empty($email))
      {
        $conemail = "email = '".$email."'";
        if(!empty($user_id))
        {
          $conemail .= " AND id != ".$user_id;
        }
        $check_email = $this->Crud_model->get_single('mlms_users',$conemail,'email');
      }
      $conmob = "mobile = '".$mobile."'";
      if(!empty($user_id))
      {
        $conmob .= " AND id != ".$user_id;
      }
      $checkmobile = $this->Crud_model->get_single('mlms_users',$conmob,'mobile');
      if(!empty($check_email)) 
      {
          echo "1";
      }
      else if(!empty($checkmobile))
      {
        echo "2";
      }
      else 
      {
          echo "0";
      }
  }

  public function edit($agent_id)
  {
    $auth = $this->session->userdata('logged_in');    
    if(!empty($auth)){
        $getuser = $this->reseller_model->get_agents('a.user_id = '.$agent_id,2);
        $getassess = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$auth['id'],'assessment');
        $data = array(
                    'button'        => "Update",
                    'heading'       => "Update Sub-Reseller Details",
                    'action_url'    => base_url()."sub_reseller/update_action/",
                    'first_name'    => $getuser->first_name,
                    'last_name'     => $getuser->last_name,
                    'email'         => $getuser->email,
                    'mobile'        => $getuser->mobile,
                    'commission'    => $getuser->assessment,
                    'id'            => $agent_id,
                    'maxcomm'       => $getassess->assessment
        );
        $this->template->set_layout('backend');
        $this->template->build('reseller/create_agent',$data);
    }
    else
    {
      redirect();
    }
  }

  public function update_action()
  {
      $commission = $this->input->post('commission');
      $agent_id = $this->input->post('agent_id');
      $data = array(
                  'assessment' => $commission,
      );
      $this->Crud_model->SaveData('mlms_assessment',$data,"user_id = ".$agent_id);
      redirect(base_url('partner/sub-reseller-list'));
  }
}