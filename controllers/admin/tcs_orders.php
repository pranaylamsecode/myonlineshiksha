<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tcs_orders extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
		$this->template->set_layout('backend');				
		$this->load->model('admin/settings_model');	
    $this->load->model('admin/Pagecreator_model'); 
		/*$this->lang->load('tooltip', 'english');
		$this->load->model('category_model');
		$this->load->model('program_model');
		$this->load->model('customs_model');
		$this->load->library('email');*/
		error_reporting(0);
    $configarr = $this->settings_model->getItems();
		date_default_timezone_set($configarr[0]['time_zone']);
	}

  public function index(){
    $auth = $this->session->userdata('logged_in');
    
    if(!empty($auth) && $auth['groupid'] == 4){
      $con1 = "";
      $total_orders = $this->Crud_model->get_single('mlms_tcs_orders',$con1,'count(id) as total');
      if($this->input->post('pay_page'))
      {
        $con = '';
        $currpage = $this->input->post('pay_page');
        if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
        {
          $firstp = 0;
        }
        else{
          $firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
        }
        if((intval($firstp)+intval(10)) > $total_orders->total)
        {
          $startp = $total_orders->total;
        }
        else{
          $startp = $firstp + 10;
        }
        $orders = $this->Crud_model->GetData('mlms_tcs_orders','',$con1,'',"id DESC",10,'',$firstp);
      }
      else{
        $currpage = 1;
        $firstp = 0;
        $startp = 10;
        $orders = $this->Crud_model->GetData('mlms_tcs_orders','',$con1,'',"id DESC",10,'',$firstp);
      }
      $pagination = '';
      $pagesp = ceil(intval($total_orders->total)/10);
      if($pagesp>1) {
        if(intval($currpage) == 1) 
          $pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                      <li class="disabled"><a>&lt;</a></li>';
        else  
          $pagination .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'admin/tcs_orders/index\')"><a>&lsaquo; First</a></li>
              <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'admin/tcs_orders/index\')"><a>&lt;</a></li>';

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
            $pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'admin/tcs_orders/index\')"><a>'.$i.'</a></li>';
        }
        
        if(($pagesp-(intval($currpage)+2))>1) {
            $pagination .= '<li><a>...</a></li>';
        }
        if(($pagesp-(intval($currpage)+2))>0) {
          if(intval($currpage) == $pagesp)
            $pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
          else        
            $pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'admin/tcs_orders/index\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="getpayout('.(intval($currpage)+1).',\'tcs_orders/index\')" ><a> > </a></li>
                  <li onclick="getpayout('.$pagesp.',\'admin/tcs_orders/index\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }
      if($this->input->post('pay_page'))
      {
        $output = "";
        $i= (intval($this->input->post('pay_page')) - 1) * 10;
        $i++;
        foreach ($orders as $key)
        {
          $output .= '
          <tr class="camp0">
            <td class="field-title" style="color: #949494;font-weight:bold;">'.$i++.'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->course_name.'</td>
            <td class="field-title" style="color: #949494; text-align:center !important;">'.ucwords($key->full_name).'<br>( '.$key->email.' )</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->contact_no.'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.number_format($key->amount,2).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.date('d M Y h:i A',strtotime($key->created)).'</td>
            <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;">'.$key->status.'</td>
            <td class="field-title active-'.$key->id.'" style="text-transform: capitalize;color: #949494;text-align:center !important;">';
            if($key->status == 'SUCCESS'){
              if(!empty($key->activation_code)){
                $output .= $key->activation_code;
              }else{
            $output .= '<a href="javascript:void(0)" class="btn btn-green" onclick="return open_popup('.$key->id.')">
              <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Activate
            </a>';
            } }else{
              $output .= "N/A";
            }
          $output .= '</td></tr>';
        }
        $data1['payoutdata'] = $output;
        $data1['lastpage'] = $pagesp;
        $data1['links'] = $this->input->post('pay_page');
        $data1['firstp'] = $firstp + 1;
        $data1['startp'] = $startp;
        $data1['paying'] = $pagination;
        $data1['total_payout'] = $total_orders->total;
        echo json_encode($data1);
      }
      else{
        $data = array(
                    'orders' => $orders,
                    'paying' => $pagination,
                    'firstp' => $firstp + 1,
                    'startp' => $startp,
                    'total_payout' => $total_orders->total
        );
        $this->template->set_layout('backend');
        $this->template->build('admin/orders/tcs_order_list',$data);            
      }
    }
    else
    {
      redirect(base_url());
    }
  }

  public function activate(){
    $activation_code = $this->input->post('activation_code');
    $id = $this->input->post('order_id');
    $data = array(
        'activation_code' => $activation_code
    );
    $this->Crud_model->SaveData('mlms_tcs_orders',$data,"id = ".$id);
    echo '0';
  }
}