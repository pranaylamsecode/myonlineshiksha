<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Resellers extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();
            
        $this->load->model('program_model'); 
        $this->load->model('Sub_reseller_model'); 
        $this->load->model('admin/settings_model');
        $this->load->library('phpqrcode/qrlib');    // QR-code library
        $this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
        $this->lang->load('tooltip', 'english');
        $this->session->keep_flashdata('message');
	      $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
        error_reporting(0);
        ob_start();
    }

  public function index()
  {
      $this->authenticate();
      $this->template->set_layout('backend');
      $this->template->title('Resellers List');
      $sess_usersgroup = $this->session->userdata('sess_usersgroup');       
      $search_string = $sess_usersgroup['searchterm'];
      if(isset($_POST['submit_search']))
          $search_string = $this->input->post('search_text');

      $searchdata = array(
          "searchterm" => $search_string,
      );
      $this->session->set_userdata('sess_usersgroup', $searchdata);
      $start = ( $this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $baseurl = base_url() . "admin/resellers/";
      $this->load->library('pagination');
      $config["base_url"] = $baseurl;
      $config['per_page'] = 10;
      $config['enable_query_strings'] = true;
      $config['uri_segment'] = 3;
      $con = "trash = 0 AND 1=1 AND group_id = 5";
      if(!empty(trim($search_string)))
          $con .= " AND (first_name like '%".$search_string."%' OR last_name like '%".$search_string."%')";
      
      $rcount = $this->Crud_model->GetData("mlms_users","id",$con);
      $config['total_rows'] = count($rcount);
      $this->template->title('Resellers List');
      $this->pagination->initialize($config);
    $resellers = $this->Crud_model->GetData("mlms_users","id, first_name, last_name, email, mobile, referral_code, active, group_id",$con,'','id DESC',10,'',$start);
    $this->template->set("resellers", $resellers);
    $this->template->set("countusers", count($rcount));
    $this->template->set("search_string", $search_string);  
    $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
    $this->template->build('admin/resellers/list');

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
      $user_id = $this->input->post('user_id');

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

    function create()
    {
      $parent_reseller = $this->Sub_reseller_model->parent_reseller();
      $this->template->set('parent_reseller', $parent_reseller);
      $this->template->set('updType', 'Create');
      $this->template->set('type', 'Reseller');
      $this->template->set('btnAction', 'create_action');
      $this->template->build('admin/resellers/create_resellers');
    }

    public function create_action()
    {
      $fname = $this->input->post('fname');
      $lname = $this->input->post('lname');
      $email = strtolower($this->input->post('email'));
      $contact_no = $this->input->post('contact_no');
      $partner_type = $this->input->post('partner_type');
      $referred = $this->input->post('referred');
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
                  'ass_type' => $partner_type,
                  'assessment' => $referred,
                  'created' => date('Y-m-d H:i:s'),
                  'modified' => date('Y-m-d H:i:s'),
        );
        $this->Crud_model->SaveData('mlms_assessment',$assess_data);
      }
    }

    function edit($uid = FALSE)
    {
        $this->authenticate();
        $u_data = $this->session->userdata('loggedin');
        if(($u_data['groupid']=='4'))   
        {   
            $con = "trash = 0 AND id = ".$uid;
            $reff_info = $this->Crud_model->get_single('mlms_users',$con,"id,first_name,last_name,email,mobile,referral_code,active,group_id");
            $assess_info = $this->Crud_model->get_single("mlms_assessment","user_id = ".$uid,"ass_type,assessment");
            
            $con = "referred_code = '".$reff_info->referral_code."' AND referred_code !='' AND referred_code is NOT NULL";
            $total_data = $this->Crud_model->GetData('mlms_order','',$con);

            $con1 = "user_id = '".$uid."'";
            $total_payout = $this->Crud_model->get_single('mlms_payout',$con1);
            $offline_payment = $this->Crud_model->GetData("mlms_offline_payment","sum(amount) as total_pending","reseller_id =".$uid." AND status ='Pending'",'','','',1);
            
            $payout_log = $this->Crud_model->GetData('mlms_payout_log','',$con1);

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
              if((intval($firstp)+intval(10)) > count($payout_log))
              {
                $startp = count($payout_log);
              }
              else{
                $startp = $firstp + 10;
              }
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);

            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);
            }


            // resellers orders data
            if($this->input->post('pageno'))
            {
              $curpage = $this->input->post('pageno');
              if(empty($this->input->post('pageno')) || $this->input->post('pageno')==1)
              {
                $first = 0;
              }
              else{
                $first = intval(intval($this->input->post('pageno'))-1) * 10 ;
              }
              if((intval($first)+intval(10)) > count($total_data))
              {
                $start = count($total_data);
              }
              else{
                $start = $first + 10;
              }
              $ref_data = $this->Crud_model->GetData('mlms_order','',$con,'','',10,'',$first);

            }
            else{
              $curpage = 1;
              $first = 0;
              $start = 10;
              $ref_data = $this->Crud_model->GetData('mlms_order','',$con,'','',10,'',$first);
            }

            // pagination orders
            $paging = '';
              $pages = ceil(count($total_data)/10);
              if($pages>1) {
                if(intval($curpage) == 1) 
                  $paging .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paging .= '<li data-ci-pagination-page="1" onclick="getresult(1)"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($curpage)-1).'" onclick="getresult('.(intval($curpage)-1).')"><a>&lt;</a></li>';

                if((intval($curpage)-3)>0) {
                  if($curpage == 1)
                    $paging .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                }
                if((intval($this->curpage)-3)>1) {
                    $paging .= '<li>...</li>';
                }
                
                for($i=(intval($curpage)-2); $i<=(intval($curpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pages) break;
                  if(intval($curpage) == $i)
                    $paging .= '<li class="active" data-ci-pagination-page="'.$curpage.'"><a>'.$curpage.'</a></li>';
                  else        
                    $paging .= '<li data-ci-pagination-page="'.$i.'" onclick="getresult('.$i.')"><a>'.$i.'</a></li>';
                }
                
                if(($pages-(intval($curpage)+2))>1) {
                    $paging .= '<li><a>...</a></li>';
                }
                if(($pages-(intval($curpage)+2))>0) {
                  if(intval($curpage) == $pages)
                    $paging .= '<li id=' .$pages.' class="active" data-ci-pagination-page="'.$pages.'" ><a>'.$pages.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pages.'" onclick="getresult('.$pages.')"><a>'.$pages.'</a></li>';
                }
                
                if(intval($curpage) < $pages)
                  $paging .= '<li onclick="getresult('.(intval($curpage)+1).')" ><a> > </a></li>
                          <li onclick="getresult('.$pages.')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paging .= '<li class="disabled" data-ci-pagination-page="'.$pages.'"><a> > </a></li><li data-ci-pagination-page="'.$pages.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }
            // end of pagination orders
              
              // payouts pagination
              $paying = '';
              $pagesp = ceil(count($payout_log)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getpayoutadmin(1,\'resellers\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayoutadmin('.(intval($currpage)-1).',\'resellers\')"><a>&lt;</a></li>';

                if((intval($currpage)-3)>0) {
                  if($currpage == 1)
                    $paying .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                  
                }
                if((intval($this->currpage)-3)>1) {
                    $paying .= '<li>...</li>';
                }
                
                for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pagesp) break;
                  if(intval($currpage) == $i)
                    $paying .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayoutadmin('.$i.',\'resellers\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayoutadmin('.$pagesp.',\'resellers\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getpayoutadmin('.(intval($currpage)+1).',\'resellers\')" ><a> > </a></li>
                          <li onclick="getpayoutadmin('.$pagesp.',\'resellers\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }
              // payouts pagination ends here

            
            if($this->input->post('pageno'))
            {
              $output = "";
              foreach ($ref_data as $key)
              { 
                 $students = $this->Crud_model->get_single('mlms_users',"id ='".$key->userid."'");
                 $course = $this->Crud_model->get_single('mlms_program',"id ='".$key->courses."'");
                 if(!empty($students->last_name)){ $stud_name = $students->first_name." ".$students->last_name;} else{ $stud_name =  $students->first_name;}
                 $output .= '<tr class="camp0">
                  <td class="field-title" style="text-transform: capitalize;text-align:center!important;">'.$key->id.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$stud_name .'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$course->name.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->amount.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->order_date.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->status.'</td>
              </tr>';
              }
              
              $data1['pagedata'] = $output;
              $data1['lastpage'] = ceil(count($total_data)/10);
              $data1['links'] = $this->input->post('pageno');
              $data1['first'] = $first + 1;
              $data1['start'] = $start;
              $data1['paging'] = $paging;
              $data1['total_data'] = count($total_data);
              echo json_encode($data1);
            }
            else if($this->input->post('pay_page'))
            {
              $output = "";
              foreach ($payout_data as $key)
              {
                $output .= '
                <tr class="camp0">
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->paid_amount.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->paid_date.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->pay_mode.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->memo.'</td>
                </tr>';
              }
              
              $data1['payoutdata'] = $output;
              $data1['lastpage'] = $pagesp;
              $data1['links'] = $this->input->post('pay_page');
              $data1['firstp'] = $firstp + 1;
              $data1['startp'] = $startp;
              $data1['paying'] = $paying;
              $data1['total_payout'] = count($payout_log);

              echo json_encode($data1);
            }
            else{
              $type = "Reseller";
              if($assess_info->ass_type == 2)
              {
                $type = "Sub-Reseller";
              }
              $data = array(
                        'type' => $type,
                        'updType' => "Update",
                        'btnAction' => "update_action",
                        'btn_access' => "update_assess",
                        'reff_info' =>$reff_info,
                        "assess_info" =>$assess_info,
                        'ref_data' => $ref_data,
                        'total_data' => count($total_data),
                        'first' => $first,
                        'start' => $start,
                        'paging' => $paging,
                        
                        'firstp' => $firstp,
                        'startp' => $startp,
                        'paying' => $paying,
                        'total_payout' => $total_payout,
                        'payout_data' => $payout_data,
                        'count_payout' => count($payout_log),
                        'offline_payment' => round($offline_payment->total_pending,2),
              );
              $this->template->build('admin/resellers/create_resellers',$data);
            }
    	}
	    else
	    {
	      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
	      redirect('admin');
	    }   
    }

  	function tabActive($tabname=NULL)
	{
		$tabname = $_POST['tabname'] ? $_POST['tabname'] :'tab2';
		$this->session->set_userdata('Active_tab',$tabname);
		$Active_tab =$this->session->userdata('Active_tab');
		switch ($tabname) {
			case 'tab1':
				$this->load->view('admin/resellers/info');
			break;
			case 'tab2':
        $this->load->view('admin/resellers/assessment');
      break;
      case 'tab3':
        $this->load->view('admin/resellers/resellers_orders');
      break;
      case 'tab4':
				$this->load->view('admin/resellers/resellers_payout');
			break;

		}
	}

	public function update_action()
	{	
		$id = $this->input->post('user_id');
    $data = array(
    					'username' => $this->input->post('email'),
    					'email' => $this->input->post('email'),
    					'first_name' => $this->input->post('fname'),
    					'last_name' => $this->input->post('lname'),
    					'active' => $this->input->post('status'),
              'mobile' => $this->input->post('mobile'),
		);
    $this->Crud_model->SaveData('mlms_users',$data,"id = ".$id);
    echo "Updated Successfully.";
	}

	public function update_assess()
	{	
		$id = $this->input->post('user_id');
		$getdata = $this->Crud_model->get_single("mlms_assessment","user_id = ".$id,"ass_type,assessment");;
		if(empty($getdata))
		{
			$data = array(
      					'user_id' => $id,
      					'ass_type' => $this->input->post('partner_type'),
      					'assessment' => $this->input->post('referred'),
      					'created' => date('Y-m-d H:i:s'),
      					'modified' => date('Y-m-d H:i:s'),
			);
			$this->Crud_model->SaveData('mlms_assessment',$data);
		  echo "Assessment Created Successfully.";
		}
		else{
			$data = array(
    						'ass_type' => $this->input->post('partner_type'),
    						'assessment' => $this->input->post('referred'),
    						'modified' =>date('Y-m-d H:i:s'),
			);
			 $this->Crud_model->SaveData('mlms_assessment',$data,"user_id = ".$id);
      echo "Assessment Updated Successfully.";
		}
	}
	
	public function changeStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if($status==1)
		{
			$active = 0;
		}
		else
		{
			$active = 1;
		}
		$data = array(
					     'active' => $active,
		);
		$this->Crud_model->SaveData('mlms_users',$data,"id = ".$id);
		if($active==0)
		{
			echo "Reseller deactivated Successfully";
		}
		else
		{
			echo "Reseller activated Successfully";
		}
	}

    function getAllPageLinks() {
    if ($this->total_rows == 0 OR $this->per_page == 0)
    {
      return '';
    }
    $output = '';
    if($this->per_page != 0)
      $pages = ceil($this->total_rows / $this->per_page);
    if($pages>1) {
      if(intval($this->curpage) == 1) 
        $output .= '<li data-ci-pagination-page="1">'.$this->$first_link.'</a></li>';
      else  
        $output .= '<li data-ci-pagination-page="1" class="disabled" onclick="getresult(1)"><a>&#8810;</a></li>
              <li data-ci-pagination-page="'.$this->curpage.'" onclick="getresult('.$this->curpage.')"><a>'.$this->prev_link.'</a></li>';
      
      
      if((intval($this->curpage)-3)>0) {
        if($this->curpage == 1)
          $output .= '<li data-ci-pagination-page="1"><a>'.$this->$first_link.'</a></li>';
        else
          $output .= '<li data-ci-pagination-page="1" onclick="getresult(1)">'.$this->$first_link.'</a></li>';
      }
      if((intval($this->curpage)-3)>1) {
          $output .= '<span class="dot">...</span>';
      }
      
      for($i=(intval($this->curpage)-2); $i<=(intval($this->curpage)+2); $i++)  {
        if($i<1) continue;
        if($i>$pages) break;
        if(intval($this->curpage) == $i)
          $output .= '<span id='.$i.' class="link current">'.$i.'</span>';
        else        
          $output .= '<a class="link" onclick="getresult('.$this->curpage.')" >'.$this->curpage.'</a>';
      }
      
      if(($pages-(intval($this->curpage)+2))>1) {
        $output = $output . '<span class="dot">...</span>';
      }
      if(($pages-(intval($this->curpage)+2))>0) {
        if(intval($this->curpage) == $pages)
          $output .= '<span id=' .$pages.' class="link current">'.$pages.'</span>';
        else        
          $output .= '<a class="link" onclick="getresult('.$pages.'" >'.$pages.'</a>';
      }
      
      if(intval($this->curpage) < $pages)
        $output .= '<a  class="link" onclick="getresult('.(intval($this->curpage)+1).')" >></a><a class="link" onclick="getresult('.$pages.')" >&#8811;</a>';
      else        
        $output .= '<span class="link disabled">></span><span class="link disabled">&#8811;</span>';
    }
    return $output;
  }

  public function offline_payment()
  {
    $remark = $this->input->post('remark');
    $amount = $this->input->post('amount');
    $reseller_id = $this->input->post("reseller_id");
    $data = array(
              'status' => "Settled",
              'remark' => $remark,
              'modified' => date('Y-m-d H:i:s')
    );
    $con = "reseller_id =".$reseller_id." AND status ='Pending'";
    $this->Crud_model->SaveData("mlms_offline_payment",$data,$con);
    
    $offline_payment = $this->Crud_model->GetData("mlms_offline_payment","sum(amount) as total_pending","reseller_id =".$reseller_id." AND status ='Pending'",'','','',1);
    echo "0";exit;
  }

  public function online_payment()
  {
    $amount = $this->input->post('on_amount');
    $payment_mode = $this->input->post('pay_mode');
    $memo = $this->input->post("memo");
    $reseller_id = $this->input->post("reseller_id");
    
    $con = "user_id =".$reseller_id;
    $offline_payment = $this->Crud_model->get_single("mlms_payout",$con);
    $paid_amount = floatval($offline_payment->paid_amount) + floatval($amount);
    $balance_amount = floatval($offline_payment->balance_amount) - floatval($amount);
    $data = array(
                'paid_amount' => $paid_amount,
                'balance_amount' => $balance_amount,
                'modified' => date('Y-m-d H:i:s'),
    );
    $this->Crud_model->SaveData('mlms_payout',$data,$con);

    $pay_log = array(
          'payout_id' => $offline_payment->id,
          'user_id' => $reseller_id,
          'pay_mode' => $payment_mode,
          'paid_amount' => $amount,
          'paid_date' => date('Y-m-d H:i:s'),
          'memo' => $memo,
    );
    $this->Crud_model->SaveData('mlms_payout_log',$pay_log);
    $d = array(
            'paid_amount' => floatval($paid_amount),
            'balance_amount' => floatval($balance_amount)
    );
    echo json_encode($d);
  }

  public function delete()
  {
    $data = array(
                'trash' => 1,
                'active' => 0,
                'status' => 0
    );
    $this->Crud_model->SaveData('mlms_users',$data,"id = ".$this->input->post('id'));
    echo "User deleted Successfully";
  }
}