<?php defined('BASEPATH') OR exit('No direct script access allowed');
class SalesTeam extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
		$this->authenticate();
		$this->template->set_layout('backend');	
		$this->load->model('SalesTeam_model');
	}

	public function users()
	{
		$con = '(group_id = 1 or is_student = 1)';
		$search_text = '';
		if($this->input->post('search_text'))
		{
			$search_text = $this->input->post('search_text');
			$con .= " and (first_name like '%".$search_text."%' or mobile like '%".$search_text."%' or email like '%".$search_text."%' or last_name like '%".$search_text."%')";
		}
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){
			$tot_users = $this->Crud_model->get_single('mlms_users',$con,"count(id) as total_users");
			$total_users = $tot_users->total_users;

			// apyout pagination
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
              if((intval($firstp)+intval(10)) > intval($total_users))
              {
                $startp = intval($total_users);
              }
              else{
                $startp = $firstp + 10;
              }
              $users = $this->Crud_model->GetData('mlms_users',"email,first_name,last_name, mobile, created_at",$con,'','id DESC',10,'',$firstp);
            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              $users = $this->Crud_model->GetData('mlms_users',"email,first_name,last_name, mobile, created_at",$con,'','id DESC',10,'',$firstp);
            }
            $paying = '';
              $pagesp = ceil(intval($total_users)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getusers(1,\'SalesTeam/users\',\''.$search_text.'\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getusers('.(intval($currpage)-1).',\'SalesTeam/users\',\''.$search_text.'\')"><a>&lt;</a></li>';

                if((intval($currpage)-3)>0) {
                  if($currpage == 1)
                    $paying .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                  
                }
                if((intval($currpage)-3)>1) {
                    $paying .= '<li>...</li>';
                }
                
                for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pagesp) break;
                  if(intval($currpage) == $i)
                    $paying .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getusers('.$i.',\'SalesTeam/users\',\''.$search_text.'\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getusers('.$pagesp.',\'SalesTeam/users\',\''.$search_text.'\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getusers('.(intval($currpage)+1).',\'SalesTeam/users\',\''.$search_text.'\')" ><a> > </a></li>
                          <li onclick="getusers('.$pagesp.',\'SalesTeam/users\',\''.$search_text.'\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }

            if($this->input->post('pay_page'))
            {
              $output = "";

              $i= (intval($this->input->post('pay_page')) - 1) * 10;
              $i++;
              foreach ($users as $key)
              {
              	$email = '---';
              	$mobile = '---';
              	if(!empty($key->email)){$email = $key->email;}
              	if(!empty($key->mobile)){$mobile = $key->mobile;}
                $output .= '
                <tr class="camp0">
                  <td class="field-title" style="color: #949494;text-align:center!important;">'.$i++ .'</td>
                  <td class="field-title" style="color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> '.ucwords($key->first_name." ".$key->last_name).'</td>
                  <td class="field-title" style="color: #949494;text-align:center!important;">'.$email.'</td>
                  <td class="field-title" style="color: #949494;text-align:center!important;">'.$mobile.'</td>
                  <td class="field-title" style="color: #949494;text-align:center!important;">'.date('Y-m-d h:i A',strtotime($key->created_at)).'</td>
                </tr>';
              }
              
				$data1['payoutdata'] = $output;
				$data1['lastpage'] = $pagesp;
				$data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $paying;
				$data1['total_payout'] = intval($total_users);
				echo json_encode($data1);
            }
            else{
				$data = array(
							'users' => $users,
							'count_payout' => intval($total_users),
							'paying' => $paying,
							'firstp' => $firstp + 1,
							'startp' => $startp,
							'search_text' => $search_text
				);
				$this->template->set_layout('backend');
				$this->template->build('salesTeam/users_list',$data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function orders()
	{
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth) && $auth['groupid'] == 6){
			$con = '';
			$search_text = '';
			if($this->input->post('search_text'))
			{
				$search_text = $this->input->post('search_text');
				$con .= "(mu.first_name like '%".$search_text."%' or mp.name like '%".$search_text."%' or mo.order_date like '%".$search_text."%' or mo.status like '%".$search_text."%')";
			}
			$tot_orders = $this->SalesTeam_model->get_orders($con);
			$total_orders = count($tot_orders);
			// apyout pagination
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
              if((intval($firstp)+intval(10)) > intval($total_orders))
              {
                $startp = intval($total_orders);
              }
              else{
                $startp = $firstp + 10;
              }
              $orders = $this->SalesTeam_model->get_orders($con,10,$firstp);
            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              $orders = $this->SalesTeam_model->get_orders($con,10,$firstp);
            }
            $paying = '';
              $pagesp = ceil(intval($total_orders)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getorders(1,\'SalesTeam/orders\',\''.$search_text.'\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getorders('.(intval($currpage)-1).',\'SalesTeam/orders\',\''.$search_text.'\')"><a>&lt;</a></li>';

                if((intval($currpage)-3)>0) {
                  if($currpage == 1)
                    $paying .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                  
                }
                if((intval($currpage)-3)>1) {
                    $paying .= '<li>...</li>';
                }
                
                for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pagesp) break;
                  if(intval($currpage) == $i)
                    $paying .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getorders('.$i.',\'SalesTeam/orders\',\''.$search_text.'\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getorders('.$pagesp.',\'SalesTeam/orders\',\''.$search_text.'\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getorders('.(intval($currpage)+1).',\'SalesTeam/orders\',\''.$search_text.'\')" ><a> > </a></li>
                          <li onclick="getorders('.$pagesp.',\'SalesTeam/orders\',\''.$search_text.'\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }

            if($this->input->post('pay_page'))
            {
              $output = "";

              $i= (intval($this->input->post('pay_page')) - 1) * 10;
              $i++;
              foreach ($orders as $key)
              {
                $contact_details = '';
                if(!empty($key->mobile)){
                  $contact_details = 'Mo. No. &nbsp;'.$key->mobile;
                }else if(!empty($key->email)){
                  $contact_details = 'Email &nbsp; '.$key->email;
                }
                $output .= '
                <tr class="camp0">
                  <td class="field-title" style="color: #949494;text-align:center!important;">'.$key->id.'</td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">
                    <span class="popup" onclick="myFunction('.$key->id.')">'.ucwords($key->first_name." ".$key->last_name).'
                <span class="popuptext" id="myPopup_'.$key->id.'">'.$contact_details.'</span></span>
                </td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">'.ucwords($key->name).'</td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">'.number_format($key->amount_paid,2).'</td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">'.date('Y-m-d h:i A',strtotime($key->order_date)).'</td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">'.ucwords($key->processor).'</td>
          		  <td class="field-title" style="color: #949494;text-align:center!important;">'.$key->status.'</td>
                </tr>';
              }
              
				$data1['payoutdata'] = $output;
				$data1['lastpage'] = $pagesp;
				$data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $paying;
				$data1['total_payout'] = intval($total_orders);
				echo json_encode($data1);
            }
            else{
				$data = array(
							'orders' => $orders,
							'count_payout' => intval($total_orders),
							'paying' => $paying,
							'firstp' => $firstp + 1,
							'startp' => $startp,
							'search_text' => $search_text
				);
				$this->template->set_layout('backend');
				$this->template->build('salesTeam/orders_list',$data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function createuser(){
	    $data = array(
            'heading'   => "Create new User",
            'action_url'=> base_url('salesTeam/create_action'),
            'first_name'=> set_value('first_name'),
            'last_name' => set_value('last_name'),
            'email'     => set_value('email'),
            'mobile'    => set_value('mobile'),
            'password'  => set_value('password'),
      );
      $this->template->set_layout('backend');
      $this->template->build('salesTeam/create_user',$data);
	}

  	public function create_action()
  	{
		$fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');
		if(!empty($email)){
			$checkmail= $this->Crud_model->get_single('mlms_users',"email = '".$email."'","id");
			if(!empty($checkmail))
			{
				echo "2";exit;
			}
		}
		if(!empty($mobile)){
			$checkmobile= $this->Crud_model->get_single('mlms_users',"mobile = '".$mobile."'","id");
			if(!empty($checkmobile))
			{
				echo "3";exit;
			}
		}
		$data = array(
  			'username'		=>	$email,
  			'email'			=>	$email,
  			'mobile'		=>	$mobile,
  			'first_name' 	=> 	$fname,
  			'last_name' 	=> 	$lname,
  			'name' 			=> 	$fname.' '.$lname,
  			'images'        =>  '',
            'active' 	    =>  '1',
            'status' 	    =>  '1',
			'is_student' 	=>  '1',//one is for yes
			'is_instructor'	=>  '0',//zero is for no
            'created_at' 	=>  date('Y-m-d H:i:s'),
            'password' 		=>  md5($password),
            'group_id' 		=>  '1',
        );
        $this->Crud_model->SaveData('mlms_users',$data);
        $lastid = $this->db->insert_id();
        $data1 = array(
        		'user_id' => $lastid,
        		'group_id'=> 1
        );
        $this->Crud_model->SaveData('mlms_users_groups',$data1);
        echo "1";
  	}

  	public function createorder(){
  		$users = $this->Crud_model->GetData('mlms_users',"first_name, last_name, id","(is_student = 1 or group_id = 1) and active = 1 and trash = 0",'',"first_name ASC");
  		$programs = $this->Crud_model->GetData('mlms_program',"id, name, fixedrate","published = 1 and trash = 0");
	    $data = array(
	            'heading'   => "Create new Order",
	            'action_url'=> base_url('salesTeam/order_action'),
	            'users' 	=> $users,
	            'programs' 	=> $programs
      	);
      	$this->template->set_layout('backend');
      	$this->template->build('salesTeam/create_order',$data);
	}

	public function filter_users(){
		$text = $this->input->post('searchtext');
		$con = "(is_student = 1 or group_id = 1) and active = 1 and trash = 0";
		if(!empty($text))
		{
			$con .= " and (first_name like '%".$text."%' or last_name like '%".$text."%')";
		}
		$users = $this->Crud_model->GetData('mlms_users',"first_name, last_name, id",$con,'',"first_name ASC");
		$output = '';
		foreach ($users as $key) {
			$output .= "<option value='".$key->id."'>".ucwords($key->first_name." ".$key->last_name)."</option>";
		}
		echo $output;
	}

	public function filter_programs(){
		$text = $this->input->post('searchtext');
		$con = "published = 1 and trash = 0 ";
		if(!empty($text))
		{
			$con .= " and name like '%".$text."%'";
		}
		$programs = $this->Crud_model->GetData('mlms_program',"name, fixedrate, id",$con);
		$output = '';
		foreach ($programs as $key) {
			$output .= "<option value='".$key->id."'>".ucwords($key->name). " - (".number_format($key->fixedrate,2)."</option>";
		}
		echo $output;
	}

	public function get_userdetails()
	{
		$user = $this->Crud_model->get_single('mlms_users',"id = ".$this->input->post('id'));
		$data = array(
				'email' => $user->email,
				'mobile' => $user->mobile,
		);
		echo json_encode($data);
	}

	public function order_action()
	{
		$auth = $this->session->userdata('logged_in');
		$user_id = $this->input->post('user_id');
		$course_id = $this->input->post('course_id');
		$con = 'p.id = '.$course_id;
		$getauthor = $this->SalesTeam_model->getauthor($con);
		$checkbuy = $this->Crud_model->get_single('mlms_buy_courses',"userid = ".$user_id." and course_id = ".$course_id);
		if(!empty($checkbuy)){
			echo "0";exit;
		}
		$order = array(
				'userid' 		=> $user_id,
				'order_date' 	=> date('Y-m-d H:i:s'),
				'courses' 		=> $course_id,
				'status' 		=> 'SUCCESS',
				'pending_reason'=> "New Order",
				'amount' 		=> $getauthor->fixedrate,
				'amount_paid' 	=> $getauthor->fixedrate,
				'processor' 	=> 'SalesTeam',
				'currency' 		=> 'INR',
				'published' 	=> 1,
				'transactionid' => 'sales123',
				'order_status'  => 'New Order',
		);
		$this->Crud_model->SaveData('mlms_order',$order);
		$order_id = $this->db->insert_id();

		$buy_course = array(
				'userid' 	=> $user_id,
				'order_id' 	=> $order_id,
				'course_id' => $course_id,
				'price' 	=> $getauthor->fixedrate,
				'currency' 	=> 'INR',
				'buy_date' 	=> date('Y-m-d H:i:s'),
				'status'	=> 1
		);
		$this->Crud_model->SaveData('mlms_buy_courses',$buy_course);

		$salesTeam_orders = array(
				'user_id' 	=> $user_id,
				'order_id' 	=> $order_id,
				'course_id' => $course_id,
				'salesT_id' => $auth['id'],
				'created' 	=> date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('salesTeam_orders',$salesTeam_orders);

		$payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getauthor->author);
		$total = $payout->total_amount;
		$balance = $payout->balance_amount;
		
		$com = intval($getauthor->fixedrate) * intval($getauthor->coursepercent) / 100;
		$total = floatval($total) + floatval($com);
		$balance = floatval($balance) + floatval($com);
		
		$paydata = array(
				'total_amount'	=> round($total,2),
				'balance_amount'=> round($balance,2),
				'modified'		=> date('Y-m-d H:i:s')
		);
		$this->Crud_model->SaveData('mlms_payout',$paydata,"user_id = ".$getauthor->author);

		$comm_log = array(
				'order_id'		=> $order_id,
				'reseller_id'	=> $getauthor->author,
				'commission'	=> round($com,2),
				'comm_percent'	=> $getauthor->coursepercent,
				'created'		=> date('Y-m-d H:i:s')
		);
		$this->Crud_model->SaveData('mlms_commission_log',$comm_log);
		echo "1";
	}
}