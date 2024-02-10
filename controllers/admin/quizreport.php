<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Quizreport extends MLMS_Controller
{
  function __construct()
  {  
    parent::__construct();
    $this->authenticate();
    $this->template->set_layout('backend');
    $this->load->model('admin/settings_model'); 
    /*$this->load->model('category_model');
    $this->load->model('program_model');
    $this->load->model('customs_model');*/
    $this->load->library('email');
  }

  public function index($msg = '')
  {
    $auth = $this->session->userdata('logged_in');    
    if(!empty($auth)){
      $lectures = $this->Crud_model->GetData('mlms_lectures',"p_id,id,name,is_exam,release_date","is_exam > 0 and published = 1");
      /*$con1 = "user_id = '".$auth['id']."' and conf_type = 'regular' and is_delete = 'no'";
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
      $pagesp = ceil(intval($total_meetings->total)/5);*/
      /*if($pagesp>1) {
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
            $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'conference/index\')"><a>'.$pagesp.'</a></li>';
        }
        
        if(intval($currpage) < $pagesp)
          $pagination .= '<li onclick="getpayout('.(intval($currpage)+1).',\'conference/index\')" ><a> > </a></li>
                  <li onclick="getpayout('.$pagesp.',\'conference/index\')" ><a>Last &rsaquo;</a></li>';
        else        
          $pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
      }*/
      // print_r($pagination);exit;
      if($this->input->post('pay_page'))
      {
        /*$output = "";
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
        echo json_encode($data1);*/
      }
      else{
        $data = array(
              'heading' => "Quiz Reports"
              /*'meetings' => $meetings,
              'paying' => $pagination,
              'firstp' => $firstp + 1,
              'startp' => $startp,
              'total_payout' => $total_meetings->total,
              'msg' => $msg*/
        );
        $this->template->set_layout('backend');
        $this->template->build('admin/quiz_report/list',$data);            
      }
    }
    else
    {
      redirect(base_url());
    }
  }
}