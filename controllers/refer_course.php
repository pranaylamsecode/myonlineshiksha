<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Refer_course extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
		$this->authenticate();
		error_reporting(0);
		$this->template->set_layout('backend');				
        $this->lang->load('tooltip', 'english');
		$this->load->model('admin/referrals_model');
		$this->load->model('Sub_reseller_model');
		$this->load->helper('cookie');
		$this->load->model('reseller_model');
        $this->load->library('phpqrcode/qrlib');
        $this->load->model('login_model');
        $this->load->model('Crud_model');
	}

	public function index()
	{
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){    // && !empty($auth['referral_code'])
			$getdata = $this->Crud_model->GetData('mlms_users','referral_qr,referral_code',"id =".$auth['id'],'','','',1);
			$get_comm = $this->Crud_model->GetData('mlms_assessment','assessment,ass_type',"user_id ='".$auth['id']."'",'','','',1);
			$url = base_url()."category/courses?ref=".$getdata->referral_code;
			if($auth['groupid']=='5')
			{
				$totalref_data = $this->referrals_model->get_orders($getdata->referral_code);
			}
			else if($auth['groupid']=='2'){
				$totalref_data = $this->referrals_model->get_Torders('mu.id ="'.$auth['id'].'" OR referred_code = "'.$getdata->referral_code.'"');
			}

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
              if((intval($firstp)+intval(10)) > count($totalref_data))
              {
                $startp = count($totalref_data);
              }
              else{
                $startp = $firstp + 10;
              }
              // $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);
            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              // $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);
            }
            if($auth['groupid']=='5')
			{
				$ref_data = $this->referrals_model->get_orders($auth['referral_code'],10,$firstp);
				$success_count = $this->referrals_model->count_Orders($auth['referral_code'],'SUCCESS');
				$pending_count = $this->referrals_model->count_Orders($auth['referral_code'],'PENDING');
				$failure_count = $this->referrals_model->count_Orders($auth['referral_code'],'FAILURE');
			}
			else if($auth['groupid']=='2'){
				$ref_data = $this->referrals_model->get_Torders('mu.id ="'.$auth['id'].'" OR referred_code ="'.$auth['referral_code'].'"',10,$firstp);
				$success_count = $this->referrals_model->count_TOrders('mo.referred_code ="'.$auth['referral_code'].'" AND mo.status ="SUCCESS" OR mu.id ="'.$auth['id'].'" AND mo.status ="SUCCESS"');
				$pending_count = $this->referrals_model->count_TOrders('mo.referred_code ="'.$auth['referral_code'].'" AND mo.status ="PENDING" OR mu.id ="'.$auth['id'].'" AND mo.status ="PENDING"');
				$failure_count = $this->referrals_model->count_TOrders('mo.referred_code ="'.$auth['referral_code'].'" AND mo.status ="FAILURE" OR mu.id ="'.$auth['id'].'" AND mo.status ="FAILURE"');

			}

            $paying = '';
              $pagesp = ceil(count($totalref_data)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'refer_course\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'refer_course\')"><a>&lt;</a></li>';

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
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'refer_course\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'refer_course\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getpayout('.(intval($currpage)+1).',\'refer_course\')" ><a> > </a></li>
                          <li onclick="getpayout('.$pagesp.',\'refer_course\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }

            if($this->input->post('pay_page'))
            {
              $output = "";
              foreach ($ref_data as $key)
              {
              	if($auth['groupid']!='5'){

              		if(!empty($key->referred_code)){if($auth['referral_code']!=$key->referred_code){$type = "Self";}else{$type = "Others";}} else{$type = "Self";}

              		$con1 = "id =".$key->userid;
              		$getcustomer = $this->Crud_model->GetData('mlms_users',"last_name,first_name",$con1,'','','',1);
              		if(!empty($getcustomer->last_name)){ $uname = $getcustomer->first_name." ".$getcustomer->last_name;} else{ $uname = $getcustomer->first_name;}
              	}
              	else
              	{
              		if(!empty($key->last_name)){ $uname = $key->first_name." ".$key->last_name;} else{ $uname = $key->first_name;}
              	}

              	if($key->status=="SUCCESS")
              	{
			        $get_comm = $this->Crud_model->GetData('mlms_commission_log','commission,comm_percent',"reseller_id =".$auth['id']." AND order_id =".$key->id,'','','',1);
			        $comm = number_format($get_comm->commission,2);
			        if($com_per!=0 || $com_per !='')
		              $com_per = " (@".$get_comm->comm_percent."%)";
		            else
		              $com_per = "";
			    }
			    else{
			    	$comm ='0.00';
			    }
                $output .= '
            	<tr class="camp0">
			        <td class="field-title" style="text-transform: capitalize;text-align:center!important;">'.$key->id.'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$uname.'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->name.'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> '.number_format($key->amount_paid,2).'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> '.number_format($comm,2).$com_per.'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.date("d-m-Y h:i A",strtotime($key->order_date)).'</td>';
			        if($auth['groupid']!='5'){
			        $output .= '<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$type.'</td>';
			         }
			        $output .= '<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->processor.'</td>
			        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->status.'</td>
			    </tr>';
              }
              
				$data1['payoutdata'] = $output;
				// $data1['lastpage'] = $pagesp;
				// $data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $paying;
				$data1['total_payout'] = count($totalref_data);
				echo json_encode($data1);
            }
            else{
            	$sub_resale_count = 0;
            	if($get_comm->ass_type == 1)
            	{
            		$sub_sale = $this->sub_reseller_order($auth['id'],1);
            		$sub_resale_count = count($sub_sale);
            	}
				$data = array(
							'url' => $url,
							'ref_data' => $ref_data,
							'success_count' => $success_count,
							'pending_count' => $pending_count,
							'failure_count' => $failure_count,
							'qr_image' => $getdata->referral_qr,
							'referral_code' => $getdata->referral_code,
							'commission' => $get_comm->assessment,
							'ass_type' => $get_comm->ass_type,
							'count_payout' => count($totalref_data),
							'paying' => $paying,
							'firstp' => $firstp + 1,
							'startp' => $startp,
							'sub_resale_count' => $sub_resale_count
				);
				$this->template->set_layout('backend');
				$this->template->build('reseller/refer',$data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function generate_QR()
	{
		$url = base_url()."category/courses?ref=";
		$auth = $this->session->userdata('logged_in');
		$getdata = $this->Crud_model->GetData('mlms_users','referral_code',"id = ".$auth['id'],'','','',1);
		if(!empty($getdata->referral_code))
		{
	      	$text1234 = $url.$getdata->referral_code;
	      	// echo $text1234;exit;
	      	$SERVERFILEPATH = getcwd().'/public/uploads/resellers_QR/';
	       
	      	$text1= $getdata->referral_code;
	      
	      	$folder = $SERVERFILEPATH;
	      	$file_name1 = $text1."-Qrcode".rand(0,9999).".png";
	      	$file_name = $folder.$file_name1;
	      	QRcode::png($text1234,$file_name,8,8);
	      	$form_data = array(
	                'referral_qr' => $file_name1,
	                // 'url_link' => $text1234,
			);
			$this->reseller_model->updateItem($auth['id'],$form_data);
			echo $file_name1;
		}
		else
		{
			echo '0';
		}
	}

	public function generate()
	{
		$auth = $this->session->userdata('logged_in');
        
		$ref = $this->randomPassword(8);
		$form_data = array(
					'referral_code' => $ref,
		);
		$getd = $this->reseller_model->updateItem($auth['id'],$form_data);
		$url = base_url()."category/courses?ref=".$ref;
		echo $url;
	}

	function randomPassword($length) {
	   	$alphabet = "a9den7pqz01fghijko2bc83rstxy45uw6lm";
	   //$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	  	$pass = array(); //remember to declare $pass as an array
	   	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	   	for ($i = 0; $i < $length; $i++) {
	       	$n = rand(0, $alphaLength);
	       	$pass[] = $alphabet[$n];
	   	}
	   	if($this->login_model->getReffCode(implode($pass)))
	   	{
	       	$this->randomPassword(8);
	   	}
	   	return implode($pass); //turn the array into a string
	}

	public function print_qr($img)
	{
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth['last_name']))
		{
			$name = $auth['first_name']." ".$auth['last_name'];
		}
		else
		{
			$name = $auth['first_name'];
		}
		$data = array(
					'img' => $img,
					'name' => $name
		);
		$this->load->view('reseller/print_qr',$data);
	}

	public function sub_reseller_order($id,$callb = "")
	{
		$con = "up.parent_id = ".$id;
		$sub_sale = $this->Sub_reseller_model->get_all_orders($con);
		if($callb == 1)
		{
			return $sub_sale;
		}	
		else
		{
			$data = array(
						'url' => $url,
						'ref_data' => $sub_sale,
						'success_count' => $success_count,
						'pending_count' => $pending_count,
						'failure_count' => $failure_count,
						'qr_image' => $getdata->referral_qr,
						'referral_code' => $getdata->referral_code,
						'commission' => $get_comm->assessment,
						'ass_type' => $get_comm->ass_type,
						'count_payout' => count($totalref_data),
						'paying' => $paying,
						'firstp' => $firstp + 1,
						'startp' => $startp,
						'sub_resale_count' => $sub_resale_count
			);
			$this->template->set_layout('backend');
			$this->template->build('reseller/sub_refer',$data);
		}
	}
}