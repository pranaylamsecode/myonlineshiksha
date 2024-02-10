<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Conference extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
		$this->authenticate();
		$this->template->set_layout('backend');				
  		$this->lang->load('tooltip', 'english');
  		$this->load->model('admin/settings_model');	
  		$this->load->model('category_model');
		$this->load->model('program_model');
		$this->load->model('customs_model');
		$this->load->library('email');
	}

	public function settings(){
		$auth = $this->session->userdata('logged_in');	
		$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'token,status,merchant_id');	
		if(!empty($auth)){
			$data = array(
						'heading' 			=> "Zoom Meeting Settings",
						'zoom_token'		=> $zoom->token,
						'merchant_id'		=> $zoom->merchant_id,
						'status'			=> $zoom->status,
			);
			$this->template->set_layout('backend');
			$this->template->build('conference/zoom_help',$data);
		}
	}

	public function update_settings(){
		$merchant_id = $this->input->post('merchant_id');
		$token = $this->input->post('zoom_token');
		$chk_zoom = $this->input->post('chk_zoom');
		$status = 'inactive';
		if($chk_zoom == 1)
		{
			$status = 'active';
		}
		$data = array(
					'status' 		=> $status,
					'token'	 		=> $token,
					'merchant_id'	=> $merchant_id
		);
		$this->Crud_model->SaveData('mlms_live_credentials',$data,"account ='zoom'");
		echo $status;
	}

	public function index($msg = '')
	{
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$con1 = "user_id = '".$auth['id']."' and conf_type = 'regular' and is_delete = 'no'";
			$total_meetings = $this->Crud_model->get_single('zoom_meeting_list',$con1,'count(id) as total');
			if($this->input->post('pay_page'))
      {
        $currpage = $this->input->post('pay_page');
        if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
        {
          $firstp = 0;
        }
        else{
          $firstp = intval(intval($this->input->post('pay_page'))-1) * 5 ;
        }
        if((intval($firstp)+intval(5)) > $total_meetings->total)
        {
          $startp = $total_meetings->total;
        }
        else{
          $startp = $firstp + 5;
        }
        $meetings = $this->Crud_model->GetData('zoom_meeting_list','',$con1,'',"start_time DESC",5,'',$firstp);
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 5;
        $meetings = $this->Crud_model->GetData('zoom_meeting_list','',$con1,'',"start_time DESC",5,'',$firstp);
      }
      $pagination = '';
      $pagesp = ceil(intval($total_meetings->total)/5);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $pagination .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'conference/index\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'conference/index\')"><a>&lt;</a></li>';

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
            $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'conference/index\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $pagination .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'conference/index\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="getpayout('.(intval($currpage)+1).',\'conference/index\')" ><a> > </a></li>
                  <li onclick="getpayout('.$pagesp.',\'conference/index\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      // print_r($pagination);exit;
      if($this->input->post('pay_page'))
      {
        $output = "";
        foreach ($meetings as $key)
        {
          $output .= '
          <tr class="camp0">
            <td class="field-title" style="text-transform: capitalize; color: #949494;font-weight:bold; padding-left:2%">'.ucwords($key->topic).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">
            start time: '.date('M d Y, h:i A',strtotime($key->start_time)).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->duration.' Minutes</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->meeting_id.'</td>';
            /*if($key->id == 7){
            	$output .= '<td class="field-title" style="text-transform: capitalize; color: #949494;">
            	<a class="btn btn-black btn-md" href="'.$key->join_url.'" style="margin-right: 10px;"> show Recording </a> (Meeting Finished)
            	</td>';
            }else{*/
            $output .= '<td class="field-title" style="text-transform: capitalize; color: #949494;">
            	<a class="btn btn-warning btn-md btn-start-meeting" href="'.base_url().'live-meeting/'.$key->meeting_id.'/0" target="_blank">Start Meeting</a>
            	<a href="'.base_url().'invite/'.$key->meeting_id.'" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;"> Invite Users </a>
            </td>';
        	// }
          $output .= '</tr>';
        }
		$data1['payoutdata'] = $output;
		$data1['lastpage'] = $pagesp;
		$data1['links'] = $this->input->post('pay_page');
		$data1['firstp'] = $firstp + 1;
		$data1['startp'] = $startp;
		$data1['paying'] = $pagination;
		$data1['total_payout'] = $total_meetings->total;
		echo json_encode($data1);
      }
      else{
				$data = array(
      							'meetings' => $meetings,
      							'paying' => $pagination,
      							'firstp' => $firstp + 1,
      							'startp' => $startp,
      							'total_payout' => $total_meetings->total,
      							'msg' => $msg
				);
				$this->template->set_layout('backend');
				$this->template->build('conference/list',$data);            
      		}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function create($batch_id = '')
	{	
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){
		$batch = '';
		$heading = "Schedule a Meeting";
		$teacher = '';
		$txt_topic = "Topic";
		$txt_schdl = "Schedule on";
		$txt_duration = "Duration (in Minutes)";
		$meet_date = '';
		$min_date = '';
		$duration = '';
		if(is_numeric($batch_id)){
			$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id);
			if (!empty($batch))
			{
				$heading = 'Schedule an event for '.ucwords($batch->batch_name);
				if(!empty($batch->teacher_id)){
					$teacher = $this->Crud_model->get_single('mlms_users', "id = ".$batch->teacher_id,"first_name,last_name");
				}
				$txt_topic = "Topic (eg. Lecture 1 )";
				$txt_schdl = "Schedule on";
				$txt_duration = "Duration (in Minutes)";
				// $curdate = date('Y-m-d');batch_from
				$ddate = $batch->batch_from.' '.$batch->batch_start_time;
				$min_date = $ddate;
				$meet_date = date('m-d-Y h:i A',strtotime($ddate));
				$duration = strtotime($batch->batch_start_time) - strtotime($batch->batch_end_time);
				$duration = abs($duration) / 60;
			}else{
				$batch_id = '';
			}
		}else{
			$batch_id = '';
		}
		$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'merchant_id');

			$data = array(
						'heading' 		=> $heading,
						'action_url' 	=> base_url().'create_meeting',
						'meeting_topic'	=> set_value(''),
						'meet_date' 	=> $meet_date,
						'duration' 		=> $duration,
						'id' 			=> set_value(''),
						'meeting_id' 	=> set_value(''),
						'button'		=> 'Create',
						'merchant_id'	=> $zoom->merchant_id,
						'batch'			=> $batch,
						'teacher'		=> $teacher,
						'batch_id'		=> $batch_id,
						'txt_topic'		=> $txt_topic,
						'txt_schdl'		=> $txt_schdl,
						'txt_duration'	=> $txt_duration,
						'min_date'		=> $min_date

			);
			$this->template->set_layout('backend');
			$this->template->build('conference/create',$data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function edit($id,$type='')
  	{
  		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'merchant_id');

			$meeting = $this->Crud_model->get_single('zoom_meeting_list',"id = ".$id);
			if(!empty($meeting)){
				$topic = $meeting->topic;
				$start_time = date('m-d-Y h:i A',strtotime($meeting->start_time));
				$duration = $meeting->duration;
				$meeting_id = $meeting->meeting_id;
				$id = $meeting->id;
				$batch = '';
				$batch_id = $meeting->batch_id;
				$heading = "Update a scheduled Meeting";
				$teacher = '';
				$min_date = $meeting->start_time;
				$txt_topic = "Topic";
				$txt_schdl = "Schedule on";
				$txt_duration = "Duration (in Minutes)";
				if(!empty($type) && $type == 'batch' && !empty($batch_id)){
					$con = "z.id = ".$id;
					$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id);
					if(!empty($batch->teacher_id)){
						$teacher = $this->Crud_model->get_single('mlms_users', "id = ".$batch->teacher_id,"first_name,last_name");
					}
					$heading = "Update a scheduled event for ".ucwords($batch->batch_name);
					$txt_topic = "Topic (eg. Lecture 1 )";
					$txt_schdl = "Schedule on";
					$txt_duration = "Duration (in Minutes)";
				}
				$data = array(
							'heading' 		=> $heading,
							'action_url' 	=> base_url().'update_meeting',
							'meeting_topic'	=> $topic,
							'meet_date' 	=> $start_time,
							'duration' 		=> $duration,
							'id' 			=> $id,
							'meeting_id' 	=> $meeting_id,
							'merchant_id'	=> $zoom->merchant_id,
							'button'		=> 'Update',
							'batch'			=> $batch,
							'teacher'		=> $teacher,
							'batch_id'		=> $batch_id,
							'txt_topic'		=> $txt_topic,
							'txt_schdl'		=> $txt_schdl,
							'txt_duration'	=> $txt_duration,
							'min_date'		=> $min_date,
							'join_url'		=> $meeting->join_url,
							'password'		=> $meeting->password,
							
				);
				$this->template->set_layout('backend');
				$this->template->build('conference/create',$data);
			}else{
				redirect('admin');
			}
		}
		else
		{
			redirect(base_url());
		}
  	}

  	public function create_meeting()
  	{
  		$auth = $this->session->userdata('logged_in');
  		if(!empty($auth)){
  			$conf_type = 'regular';
  			$batch_id = $this->input->post('batch_id');
  			if(empty($batch_id)){
  				$batch_id = null;
  			}else{
  				$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id,"course_id");
  				$conf_type = 'batch';
  			}
	  		$meeting_topic = $this->input->post('meeting_topic');
	  		$duration = $this->input->post('duration');
	  		$md = date('Y-m-d',strtotime($this->input->post('meet_date')));
	  		$mt = date('H:i:s',strtotime($this->input->post('meet_date')));
	  		
	  		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		  	$pass = array(); //remember to declare $pass as an array
		   	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		   	for ($i = 0; $i < 8; $i++) {
		       	$n = rand(0, $alphaLength);
		       	$pass[] = $alphabet[$n];
		   	}
	  		$password = implode($pass);

		  	$postData = array(
		    	"topic"			=> ucwords($meeting_topic),
				"type"			=> 2,
				"start_time"	=> $md.'T'.$mt,
				"duration"		=> $duration,
				"timezone"		=> "Asia/Culcutta",
				"password"		=> $password,
				"recurrence"	=> array(
						"type" 	=> 2,
				),
				"settings"	=> array(
					"host_video" => "true",
				    "participant_video" => "true",
				    "cn_meeting" => "false",
				    "in_meeting" => "true",
				    "join_before_host" => "true",
				    "mute_upon_entry" => "true",
				    "approval_type" => 0,
				    "registration_type" => 1,
				    "audio" => "voip",
				    "auto_recording" => "local",
				    "enforce_login" => "false",
				    "registrants_email_notification" => "true"
				)
			);
			$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'token,status,merchant_id');
			// print_r($postData);exit;    eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImNiWmN2WGhvUXFDcTVfRkZZQS01MkEiLCJleHAiOjE2MzI2NTE3ODAsImlhdCI6MTYwMTExMDQ2MX0._oHKA-piyDl7jqCdpM-GhVhc2S18zmSoTLHmKKE_S64
			$merchant_id = $zoom->merchant_id;
			$token = $zoom->token;

			/*if($zoom->status =='inactive' || empty($merchant_id) || empty($token)){
				redirect('conference/0');exit;
			}*/

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.zoom.us/v2/users/".$merchant_id."/meetings", //edubaseinstitute@gmail.com add username 
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 300,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$token,
					"content-type: application/json"
				),
				CURLOPT_POSTFIELDS => json_encode($postData)
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  	echo "cURL Error #:" . $err;
			} else {
			  	$data = json_decode($response);
			  	if(!isset($data->id))
			  	{
			  		if(!empty($batch_id)){
			  			$this->session->set_flashdata('message',array( 'type' => 'warning', 'text' => 'Failed to create Event.'));
						$this->session->set_userdata('webmsg',$batch_id);
						redirect('admin/edit/courses/'.$batch->course_id);exit;
			  		}
			  		redirect('conference/0');exit;
			  	} else {
				  	$form_data  = array(
				  					'user_id' => $auth['id'],
				  					'meeting_id' => $data->id,
				  					'batch_id' => $batch_id,
				  					'conf_type' => $conf_type,
				  					'topic' => ucwords($meeting_topic),
				  					'status' => $data->status,
				  					'start_time' => date('Y-m-d H:i:s',strtotime($this->input->post('meet_date'))),
				  					'duration' => $duration,
				  					'start_url' => $data->start_url,
				  					'join_url' => $data->join_url,
				  					'created_at' => date('Y-m-d H:i:s'),
				  					'password' => base64_encode($password),
				  					'modified' => date('Y-m-d H:i:s')
			  		);
			  		$this->Crud_model->SaveData('zoom_meeting_list',$form_data);
			  		if(!empty($batch_id)){
			  			$this->session->set_flashdata('message',array('type'=>'success', 'text'=>'Event Created.'));
						$this->session->set_userdata('webmsg',$batch_id);
						redirect('admin/edit/courses/'.$batch->course_id);exit;
			  		}
			  		redirect('conference/1');exit;
			  	}
			}
		}else{
			redirect(base_url());
		}
  	}

  	public function start_meeting($start_url='',$join_url='')
  	{
  		$getdata = $this->Crud_model->get_single('mlms_config','id = 1','logoimage');
  		$data = array(
  			'start_url' => $start_url,
  			'join_url' 	=> urldecode($join_url),
  			'logo'		=> $getdata->logoimage
  		);
  		if(!empty($start_url) || $start_url !=''){
			// echo $current_meeting;
			$data1 = array(
						'status' => 'started'
			);
			$this->Crud_model->SaveData('zoom_meeting_list',$data1,"meeting_id = ".$start_url);
		}
		$this->load->view('conference/meetings',$data);

  	}

  	public function invite($id = '')
  	{
  		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$meetings = $this->Crud_model->get_single('zoom_meeting_list',"meeting_id = ".$id,"topic,start_time,duration,join_url,password");
			
			$users = $this->Crud_model->GetData('mlms_users',"first_name,last_name,email");
			$data = array(
						'heading' 		=> "Meeting Invitation",
						'action_url'	=> base_url().'send-invitation',
						'meeting_topic'	=> $meetings->topic,
						'start_time'	=> $meetings->start_time,
						'duration'		=> $meetings->duration,
						'join_url'		=> $meetings->join_url,
						'password'		=> base64_decode($meetings->password),
						'id'			=> $id,
						'users'			=> $users
			);
			$this->template->set_layout('backend');
			$this->template->build('conference/invite',$data);
		}
		else
		{
			redirect(base_url());
		}
  	}

  	public function send_invitation()
  	{
  		$auth = $this->session->userdata('logged_in');
  		if(!empty($auth)){
			$attendees = $this->input->post('attendees');
			$attendees_name = $this->input->post('attendees_name');
			$meeting_topic = $this->input->post('meeting_topic');
			$start_time = $this->input->post('start_time');
			$duration = $this->input->post('duration');
			$join_url = $this->input->post('join_url');
			$id = $this->input->post('id');
			$password = $this->input->post('password');
			$name = explode(',', $attendees_name);
			$subject = 'Meeting Invitation';
			$i = 0;
			foreach ($attendees as $key) {
				$configarr = $this->settings_model->getItems();
				if($configarr[0]['fromemail'])  
		        $urldomain = $configarr[0]['fromemail']; 
		    else $urldomain = 'noreply@'.$this->config->item('urldomain');

				$toemail = $key;
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Welcome to <b>'.str_replace(" ",'',ucwords($configarr[0]['institute_name'])).'</b></p>';
				$content .= '<p>Dear '.$name[$i].',<br/><br/>';
				$content .= ucwords($auth['first_name'].' '.$auth['last_name']).' is inviting you to join a scheduled conference on '.base_url().'. Details related to the meeting are given below : <br /><br />';
				$content .= 'Topic : <b>'.$meeting_topic.'</b><br/>';
				$content .= 'Time: <b>'.date('M d, Y h:i A',strtotime($start_time)).'</b><br/>';							
				$content .= 'Conference Link : <b>'.$join_url.'</b><br/>';
				$content .= 'Meeting ID : <b>'.$id.'</b><br/>';
				$content .= 'Password : <b>'.$password.'</b><br/><br/>';
				$content .= 'If you need help or have any questions, please contact us.<br/>';
				// echo $content;
				 $data['content'] = $content; 
				$data['fromemail'] = $urldomain;
				$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
				// echo $message;exit;		//$fromemail=$configarr[0]['fromemail'];// admin mail	
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
				$i++;	
			}
		}
  	}

  	public function update_meeting(){
  		$duration = $this->input->post('duration');
  		$md = date('Y-m-d',strtotime($this->input->post('meet_date')));
  		$mt = date('H:i:s',strtotime($this->input->post('meet_date')));
  		$id = $this->input->post('id');
  		$meeting_id = $this->input->post('meeting_id');
		$meeting_topic = $this->input->post('meeting_topic');
		$batch_id = $this->input->post('batch_id');
	  	$postData = array(
	  			"topic"		=> $meeting_topic,
		    	"start_time"=> $md.'T'.$mt,
				"duration"	=> $duration,
		);
		$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'token,status,merchant_id');
			// print_r($postData);exit;    eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImNiWmN2WGhvUXFDcTVfRkZZQS01MkEiLCJleHAiOjE2MzI2NTE3ODAsImlhdCI6MTYwMTExMDQ2MX0._oHKA-piyDl7jqCdpM-GhVhc2S18zmSoTLHmKKE_S64
			$merchant_id = $zoom->merchant_id;
			$token = $zoom->token;

			/*if($zoom->status =='inactive' || empty($merchant_id) || empty($token)){
				redirect('conference/0');exit;
			}*/
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.zoom.us/v2/meetings/".$meeting_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PATCH",
			CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$token,
					"content-type: application/json"
			),
			CURLOPT_POSTFIELDS => json_encode($postData)
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  	echo "cURL Error #:" . $err;
		} else {
			
		  	$form_data  = array(
	  					'topic' => ucwords($meeting_topic),
	  					'start_time' => date('Y-m-d H:i:s',strtotime($this->input->post('meet_date'))),
	  					'duration' => $duration,
	  					'modified' => date('Y-m-d H:i:s')
	  		);
	  		$this->Crud_model->SaveData('zoom_meeting_list',$form_data,"meeting_id = ".$meeting_id);
	  		if(!empty($batch_id)){
	  			$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id,"course_id");
				$this->session->set_flashdata('message',array('type'=>'success', 'text'=>'Event Updated.'));
				$this->session->set_userdata('webmsg',$batch_id);
				redirect('admin/edit/courses/'.$batch->course_id);exit;
	  		}
	  		redirect('conference/2');
		}
  	}

  	function generate_signature ( $api_key, $api_secret, $meeting_number, $role){
		$time = time() * 1000 - 30000;//time in milliseconds (or close enough)
		$data = base64_encode($api_key . $meeting_number . $time . $role);
		$hash = hash_hmac('sha256', $data, $api_secret, true);
		$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
		//return signature, url safe base64 encoded
		return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
	}

	/*public function delete_event(){
		$id = $this->input->post('id');
		$data = array(
					'is_delete' => 'yes',
		);
		$this->Crud_model->SaveData('zoom_meeting_list',$data,"id = ".$id);
		echo "1";
	}*/

	public function upcoming_events()
	{
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){
			$arr = array();
			if($auth['groupid'] == 2){
			$assisted = $this->settings_model->get_assisted_course("pa.teacher_id = ".$auth['id']." and p.author != pa.teacher_id");

			$course = $this->Crud_model->GetData('mlms_program',"id","author = ".$auth['id']);
			$batch_ids = '';
			foreach ($course as $key) {
				$batch = $this->Crud_model->GetData('mlms_batches',"id","course_id = ".$key->id);
				foreach ($batch as $key1) {
					$batch_ids .= $key1->id.",";
				}
			}
			foreach ($assisted as $key) {
				$batch = $this->Crud_model->GetData('mlms_batches',"id","course_id = ".$key->id);
				foreach ($batch as $key1) {
					$batch_ids .= $key1->id.",";
					array_push($arr,$key1->id);
				}
			}
			$bids = explode(",", $batch_ids);
			$i= 1;

			$batch_ids = '';
			foreach ($bids as $key) {
				$batch_ids .= $key;
				$i++;
				if($i < count($bids))
					$batch_ids .=",";
			}
			$con1 = "is_delete = 'no' and conf_type = 'batch' and left(start_time,10) >= '".date('Y-m-d')."' and (";
			if(!empty($batch_ids))
				$con1 .= "batch_id in (".$batch_ids.") OR ";
			
			$con1 .= "user_id = ".$auth['id'].")";
		}else{
			$con1 = "is_delete = 'no' and conf_type = 'batch' and left(start_time,10) >= '".date('Y-m-d')."'";
		}
			// $con1 = " left(start_time,10) >= '".date('Y-m-d')."'";
			$total_meetings = $this->Crud_model->get_single('zoom_meeting_list',$con1,'count(id) as total');
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
        if((intval($firstp)+intval(10)) > $total_meetings->total)
        {
          $startp = $total_meetings->total;
        }
        else{
          $startp = $firstp + 10;
        }
        $meetings = $this->Crud_model->GetData('zoom_meeting_list','',$con1,'',"start_time ASC",10,'',$firstp);
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 10;
        $meetings = $this->Crud_model->GetData('zoom_meeting_list','',$con1,'',"start_time ASC",10,'',$firstp);
      }

      $pagination = '';
      $pagesp = ceil(intval($total_meetings->total)/10);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $pagination .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'upcoming-events\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'upcoming-events\')"><a>&lt;</a></li>';

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
            $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'upcoming-events\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $pagination .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'upcoming-events\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="getpayout('.(intval($currpage)+1).',\'upcoming-events\')" ><a> > </a></li>
                  <li onclick="getpayout('.$pagesp.',\'upcoming-events\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      // print_r($pagination);exit;
      if($this->input->post('pay_page'))
      {
        $output = "";
        foreach ($meetings as $key)
        {
          $output .= '
          <tr class="camp0">
            <td class="field-title" style="text-transform: capitalize; color: #949494;font-weight:bold; padding-left:2%">'.ucwords($key->topic).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">
            start time: '.date('M d Y, h:i A',strtotime($key->start_time)).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->duration.' Minutes</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->meeting_id.'</td>';
            $output .= '<td class="field-title" style="text-transform: capitalize; color: #949494;">
            	<a class="btn btn-warning btn-md" href="'.$key->start_url.'" target="_blank">Start Meeting</a>
            	<a href="'.base_url().'invite/'.$key->meeting_id.'" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;"> Invite Users </a>
            </td>';
          $output .= '</tr>';
        }
				$data1['payoutdata'] = $output;
				$data1['lastpage'] = $pagesp;
				$data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $pagination;
				$data1['total_payout'] = $total_meetings->total;
				echo json_encode($data1);
      }
      else{
				$data = array(
      							'meetings' => $meetings,
      							'paying' => $pagination,
      							'firstp' => $firstp + 1,
      							'startp' => $startp,
      							'total_payout' => $total_meetings->total,
      							'assisted'	=> $arr
				);
				$this->template->set_layout('backend');
				$this->template->build('conference/upcoming_list',$data);        
      }
		}
		else
		{
			redirect(base_url());
		}
	}


	public function delete_event(){
		$id = $this->input->post('id');
		$meeting = $this->Crud_model->get_single('zoom_meeting_list',"id = ".$id,"meeting_id");
		$zoom = $this->Crud_model->get_single('mlms_live_credentials',"account = 'zoom'",'token,status,merchant_id');
			// print_r($postData);exit;    eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6ImNiWmN2WGhvUXFDcTVfRkZZQS01MkEiLCJleHAiOjE2MzI2NTE3ODAsImlhdCI6MTYwMTExMDQ2MX0._oHKA-piyDl7jqCdpM-GhVhc2S18zmSoTLHmKKE_S64
		$merchant_id = $zoom->merchant_id;
		$token = $zoom->token;
		$occurrence_id = "02MQWmjdQGC8dbjdGGqRuQ";
		$postData = array(
					'occurrence_id' => $occurrence_id,
					'schedule_for_reminder'	=> false,
					'cancel_meeting_reminder'	=> 'false',
		);
		$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.zoom.us/v2/meetings/".$meeting->meeting_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$token, //token JWT
					"content-type: application/json"
				),
				CURLOPT_POSTFIELDS => json_encode($postData)
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  	echo "cURL Error #:" . $err;
			} else {
			  	$result = json_decode($response);
			  	$data = array(
								'is_delete' => 'yes',
					);
					$this->Crud_model->SaveData('zoom_meeting_list',$data,"id = ".$id);
					echo "1";
			}
	}

	/*public function get_meeting_byID()
  	{
  		$occurrence_id = "mqY748yqQmC_1LU9Tco1Kg";
  		$postData = array('occurrence_id' => $occurrence_id);
  		$meeting_id = $this->input->post('meetingid');
  
  		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.zoom.us/v2/meetings/".$meeting_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6Im1xWTc0OHlxUW1DXzFMVTlUY28xS2ciLCJleHAiOjE2MjE3Nzc1NjAsImlhdCI6MTU5MDIzNjI5NH0.GQrba5iKDP8aZ_2XnyRfohC7A8DO3AXLXWf5kvi2wTE", //token JWT
				"content-type: application/json"
			),
			CURLOPT_POSTFIELDS => json_encode($postData)
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  	echo "cURL Error #:" . $err;
		} else {
		  	echo $response;
		}
  }

  public function get_zoomUserID()
  	{
  		$api_key = "mqY748yqQmC_1LU9Tco1Kg";
  		$api_secret = "hflP6gDdAbK0iBaRZGNKbqVVYnGQrf0Rnd0x";
  		$meeting_number = "8635748122";
  		$role = "1";
  		$signature = $this->generate_signature($api_key, $api_secret, $meeting_number, $role);
  		$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.zoom.us/v2/users?status=active&page_size=30&page_number=1",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6Im1xWTc0OHlxUW1DXzFMVTlUY28xS2ciLCJleHAiOjE2MjE3Nzc1NjAsImlhdCI6MTU5MDIzNjI5NH0.GQrba5iKDP8aZ_2XnyRfohC7A8DO3AXLXWf5kvi2wTE", //token JWT
					"content-type: application/json"
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			  	echo "cURL Error #:" . $err;
			} else {
			  	echo $response;
			}
  	}
  */
}