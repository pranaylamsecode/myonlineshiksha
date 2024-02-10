<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reseller_Settlements extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
		$this->authenticate();
		error_reporting(0);
		$this->template->set_layout('backend');				
        $this->lang->load('tooltip', 'english');
		$this->load->model('admin/referrals_model');
		$this->load->model('reseller_model');
        $this->load->model('login_model');
        $this->load->model('Crud_model');
	}

	public function index()
	{
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){    // && !empty($auth['referral_code'])
			// $users = $this->Crud_model->get_single('mlms_users',"id ='".$auth['id']."'");
			$con1 = "user_id ='".$auth['id']."'";
			$payouts = $this->Crud_model->get_single('mlms_payout',$con1,'total_amount,paid_amount,balance_amount');
			
			$pay_history = $this->Crud_model->GetData('mlms_payout_log',"paid_date,paid_amount,pay_mode,memo",$con1);
		
			$paying_amount = $this->Crud_model->GetData('mlms_offline_payment','sum(amount) as offline_payment',"reseller_id =".$auth['id']." AND status ='Pending'",'','','',1);
			// $payout_log = $this->Crud_model->GetData('mlms_payout_log',"","user_id ='".$auth['id']."'",'','',10);

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
              if((intval($firstp)+intval(10)) > count($pay_history))
              {
                $startp = count($pay_history);
              }
              else{
                $startp = $firstp + 10;
              }
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','paid_date,paid_amount,pay_mode,memo',$con1,'','',10,'',$firstp);

            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','paid_date,paid_amount,pay_mode,memo',$con1,'','',10,'',$firstp);
            }
            $paying = '';
              $pagesp = ceil(count($pay_history)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'reseller_Settlements/index\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'reseller_Settlements/index\')"><a>&lt;</a></li>';

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
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'reseller_Settlements/index\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'reseller_Settlements/index\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getpayout('.(intval($currpage)+1).',\'reseller_Settlements/index\')" ><a> > </a></li>
                          <li onclick="getpayout('.$pagesp.',\'reseller_Settlements/index\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }

            if($this->input->post('pay_page'))
            {
              $output = "";
              foreach ($payout_data as $key)
              {
                $output .= '
                <tr class="camp0">
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.date("d-m-Y h:i A",strtotime($key->paid_date)).'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> '.$key->paid_amount.'</td>
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
				$data1['total_payout'] = count($pay_history);
				echo json_encode($data1);
            }
            else{
				$data = array(
							'upi_id' => $auth['email'],
							'paying_amount' =>round($paying_amount->offline_payment,2),
							'payouts' => $payouts,
							'pay_history' => $payout_data,
							'count_payout' => count($pay_history),
							'paying' => $paying,
							'firstp' => $firstp + 1,
							'startp' => $startp
				);
				$this->template->set_layout('backend');
				$this->template->build('reseller/payout',$data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function coupons()
	{
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$con1 = "user_id ='".$auth['id']."'";
			$courses = $this->Crud_model->GetData('mlms_program','id,name,fixedrate,author',"published = 1 AND trash = 0");
      
      $is_own_course = $this->Crud_model->GetData('mlms_program',"id","author = ".$auth['id']);
      if($is_own_course){
        foreach ($is_own_course as $key) {
          $is_buy = $this->Crud_model->get_single('mlms_buy_courses',"userid = ".$auth['id']." and course_id = ".$key->id,"id");
          if(!$is_buy){
            $data = array(
                  'userid' => $auth['id'],
                  'order_id' => 0,
                  'course_id' => $key->id,
                  'price' => 0,
                  'buy_date' => date('Y-m-d H:i:s'),  
                  'plan_id' => 0,
                  'email_send' => 1
            );
            $this->Crud_model->SaveData('mlms_buy_courses',$data);
          }
        }
      }
			$coupons_data = $this->Crud_model->GetData('mlms_reseller_coupon','id,course_id,status,coupon_code,student_name,created,modified',$con1);
			$total_unused = $this->Crud_model->get_single('mlms_reseller_coupon',"user_id ='".$auth['id']."' AND status = 'Unused'","count(status) as total_unused");
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
        if((intval($firstp)+intval(10)) > count($coupons_data))
        {
          $startp = count($coupons_data);
        }
        else{
          $startp = $firstp + 10;
        }
        $coupons = $this->Crud_model->GetData('mlms_reseller_coupon','id,course_id,status,coupon_code,student_name, created,modified',$con1,'',"id DESC",10,'',$firstp);
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 10;
        $coupons = $this->Crud_model->GetData('mlms_reseller_coupon','id,course_id,status,coupon_code,student_name, created,modified',$con1,'',"id DESC",10,'',$firstp);
      }
      $paying = '';
      $pagesp = ceil(count($coupons_data)/10);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $paying .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'reseller_Settlements/coupons\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'reseller_Settlements/coupons\')"><a>&lt;</a></li>';

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
            $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'reseller_Settlements/coupons\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $paying .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'reseller_Settlements/coupons\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $paying .= '<li onclick="getpayout('.(intval($currpage)+1).',\'reseller_Settlements/coupons\')" ><a> > </a></li>
                  <li onclick="getpayout('.$pagesp.',\'reseller_Settlements/coupons\')" ><a>Last &rsaquo;</a></li>';
        else        
          $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      if($this->input->post('pay_page'))
      {
        $output = "";
        foreach ($coupons as $key)
        {
          if(!empty($key->course_id) || $key->course_id != '')
          {
            $getcourse = $this->Crud_model->get_single('mlms_program',"id ='".$key->course_id."'",'name,fixedrate');
            $course_name = ucfirst($getcourse->name);
            $fixedrate = $getcourse->fixedrate;
          }
          else{
            $course_name = "-";
            $fixedrate = 0;
          }
          if(!empty($key->student_name) || $key->student_name !='')
          {
            if(is_numeric($key->student_name))
            {
              $std_data = $this->Crud_model->get_single('mlms_users',"id = ".$key->student_name,'first_name,last_name');
              if(!empty($std_data))
              {
                if(!empty($std_data->last_name)){
                  $student_name = $std_data->first_name.' '.$std_data->last_name;
                }  
                else{
                  $student_name = $std_data->first_name;
                }
              }
              else{
                $student_name = "-";  
              }
            }
            else{
              $student_name = $key->student_name;
            }
          }
          else
          {
            $student_name = "-";
          }

          if($key->status=='Redeemed')
            $status = $key->status." on ".date('d-m-Y h:i A',strtotime($key->modified));
          else
            $status = $key->status;

            $output .= '
            <tr class="camp0">
              <td class="field-title" style="color: #949494; text-align:center !important;">'.$key->coupon_code.'</td>
              <td class="field-title" style="text-transform: capitalize; color: #949494; text-align:center !important;">'.$student_name.'</td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$course_name.'</td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><i class="fa fa-inr"></i> '.number_format($fixedrate,2).'</td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.date('d-m-Y h:i A',strtotime($key->modified)).'</td>
              <td class="field-title" style="text-transform: capitalize; color: #949494; text-align:center !important;">'.$status.'</td>
            </tr>';
        }
				$data1['payoutdata'] = $output;
				$data1['lastpage'] = $pagesp;
				$data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $paying;
				$data1['total_payout'] = count($coupons_data);
				echo json_encode($data1);
      }
      else{
				$data = array(
      							'coupons' => $coupons,
      							'courses' => $courses,
      							'paying' => $paying,
      							'firstp' => $firstp + 1,
      							'startp' => $startp,
      							'count_payout' => count($coupons_data),
                    'total_unused' => $total_unused->total_unused
				);
				$this->template->set_layout('backend');
				$this->template->build('reseller/coupons',$data);              
      }
		}
		else
		{
			redirect(base_url());
		}
	}

	public function create_coupon()
	{
		$auth = $this->session->userdata('logged_in');
		for ($i=0; $i < 10; $i++)
    { 
      $coupon_code = $this->randomCouponcode();
      $data = array(
            'user_id' => $auth['id'],
            'coupon_code' => $coupon_code,
            'status' => 'Unused',
            'created' => date('Y-m-d H:i:s')
      );
      $this->Crud_model->SaveData('mlms_reseller_coupon',$data);
      if($i==0)
      {
        $last_id = $this->db->insert_id();
      }
    }
    $con = "status = 'Unused' AND id >= ".$last_id;
    $getdata = $this->Crud_model->GetData('mlms_reseller_coupon','',$con);
    // print_r($getdata);
    $data1 = array(
          'coupon_data' => $getdata,
    );
    $this->load->view('reseller/save_print',$data1);
		// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Coupon Generated.'));
		// redirect(base_url('partner/coupons'));
	}

	function randomCouponcode() {
	   $code = rand(10000,99999);
	   if($this->Crud_model->get_single('mlms_reseller_coupon',"coupon_code = '".$code."'"))
	   {
	       $this->randomCouponcode();
	   }
	   return $code; //turn the array into a string
	}

  public function printdata()
  {
    $last_id = $_POST['data1'];
    $con = "status = 'Unused' AND id >= ".$last_id;
    $getdata = $this->Crud_model->GetData('mlms_reseller_coupon','',$con);
    // print_r($getdata);
    $data = array(
          'coupon_data' => $getdata,
    );
    $this->load->view('reseller/save_print',$data);
  }

}