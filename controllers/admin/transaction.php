<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Transaction extends MLMS_Controller {



	function __construct()

	{

		parent::__construct();

        $this->load->model('admin/Transaction_model');

        $this->load->helper('form');

		$this->lang->load('tooltip', 'english');
    
    $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
    error_reporting(0);


	}





	public function index()

	{

        $this->load->library('pagination');



        $this->template->set_layout('backend');



        $page =($this->uri->segment(3))  ? $this->uri->segment(3) : 0;



        $alltrans=$this->Transaction_model->getAllTrans();

        $this->template->set("alltrans",$alltrans);



        $baseurl = base_url() . "admin/transaction/";

        $c['base_url'] =$baseurl;

        $c['total_rows'] = count($alltrans);

        $c['per_page'] = 10;

        $config['uri_segment'] = 3;



        $this->pagination->initialize($c);



        $pagedNames = $this->get_transdata($page,$alltrans);



        $this->template->set("alltrans1",$pagedNames);

        $this->template->set("pages",$this->pagination->create_links());

        $this->template->set("offset",$page);

         $data = array(

              'names'=> $pagedNames,

              'pages'=> $this->pagination->create_links()

              );

        //$this->template->set("alltrans",$data);

        $this->template->build('admin/transaction/viewtransaction');





	}



     function get_transdata($offset=0,$alltrans)

    {

    /* Clear the return variable */

    $return = "";



    /* Ensure we don't retrieve more names from the array than the number that is available

       when accounting for the $offset passed. */

    $count = count($alltrans)-$offset;

    $num = ($count > 9) ? 10 : $count;



    /* Collect the users in the $return variable after surrounding with <li> tags */

    for ($i=0; $i<$num; $i++)

    {



      $return[]=$alltrans[$i+$offset];



    }



    /* Return the names */

    return $return;

  }







  /*** pending to paid ***/



   public function paid($tid = FALSE){



    	$tid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;



        if (!$tid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/transaction/');

			}



       $upd_data = array(

    					'status'=>'Paid'

    				);



       $paymentstatus=$this->Transaction_model->paid_unpaid($tid,$upd_data);



       if ($paymentstatus)

       {

            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Updated successfully!' ));

       }

       else

       {

            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Can not be Updated!' ) );

       }

       redirect('admin/transaction');





	}

   /***&nbsp;E ***/

  /*** paid to pending ***/



  public function pending($tid = FALSE){



    	$tid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;



        if (!$tid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/transaction/');

			}



       $upd_data = array(

    					'status'=>'Pending'

    				);



       $paymentstatus=$this->Transaction_model->paid_unpaid($tid,$upd_data);



       if ($paymentstatus)

       {

            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Updated successfully!' ));

       }

       else

       {

            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Can not be Updated!' ) );

       }

       redirect('admin/transaction');





	}

 /***** E *******/





}

?>