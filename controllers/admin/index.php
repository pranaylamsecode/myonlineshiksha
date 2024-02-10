<?php



class Index extends MLMS_Controller

{

	function __construct()

	{
exit('me');
		parent::__construct();		

		$this->config->load('installation_config');

        $this->load->model('admin/settings_model');	

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		error_reporting(0);	

	}





	public function index()

	{

        $this->template->build('/index/index');

	}





	public function contact($result = NULL)

	{

		$data['title']  = "Contacto";



		$this->load->library('form_validation');



		$this->_set_rules();





		if ($this->form_validation->run() == FALSE)

		{

			$this->template->build('/index/contact');

		}

		else

		{



			$form_data = array(

		       	'name' 		=> $this->input->post('name', TRUE ), 

		       	'lastname' 	=> $this->input->post('lastname', TRUE ), 

		       	'email' 	=> $this->input->post('email', TRUE ), 

		       	'phone' 	=> $this->input->post('phone', TRUE ), 

		       	'comments'	=> $this->input->post('comments', TRUE)

			);





			$this->load->library('email');



			$this->email->from('sangar1982@gmail.com', 'Contacto Codeigniter');

			$this->email->to('sangar1982@gmail.com');



			$this->email->subject('Formulario de Contacto Codeigniter');



			$message = $this->load->view('index/email/formcontact.tpl.php', $form_data, TRUE);



			$this->email->message($message);



			if ( $this->email->send() )

			{

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_mail_ok') ));

				redirect('contact');

			}

			else

			{

				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_mail_ko') ) );

				redirect('contact');				

			}

		}

	}





	 /**

     * Set rules for form

     * @return void

     */

	private function _set_rules()

	{

		/*validate form input*/

		$this->form_validation->set_rules('name', 'lang:web_name', 'required|trim|xss_clean|min_length[2]|max_length[100]');

		$this->form_validation->set_rules('lastname', 'lang:web_lastname', 'required|trim|xss_clean|min_length[2]|max_length[100]');

		$this->form_validation->set_rules('email', 'lang:web_email', 'required|trim|valid_email|xss_clean');

		$this->form_validation->set_rules('phone', 'lang:web_phone', 'required|trim|numeric|xss_clean');

		$this->form_validation->set_rules('comments', 'lang:web_comments', 'required|trim|xss_clean');



		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

	}

	



}