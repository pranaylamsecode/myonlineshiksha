<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MLMS_Controller {

  function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
		
		$this->load->helper('text');		
		$this->load->helper('commonmethods');
        $this->load->model('admin/settings_model');	
		$this->load->model('admin/programs_model');
		$this->load->model('customs_model');
		$this->load->model('category_model');
		$this->load->model('Category_model');
		$this->load->model('blogs_model');

		$this->load->model('program_model');
		$this->load->model('Program_model');
        $configarr = $this->settings_model->getItems();	
	    $this->template->set_layout($configarr[0]['layout_template']);
		$this->load->model('admin/Pagecreator_model');
        
		$this->template->set("configarr", $configarr);

		date_default_timezone_set($configarr[0]['time_zone']);
		 error_reporting(E_ALL);
error_reporting(0);
$db['default']['db_debug'] = FALSE; 


	}

	public function getlist()
	{

		if($_POST['input']){
		$searchData = $this->customs_model->getsearch($_POST['input']);
		// print_r($searchData); exit('44');
		foreach ($searchData as $searchlist) {
			if($searchlist){
				 	 // echo sizeof($searchlist);

				 foreach ($searchlist as $searchitem) {
					$total = count((array)$searchitem);
					$search_key = $searchitem->slug ? $searchitem->slug : $searchitem->id;
				 	if($total == 4){
				 		// echo "<li><a class='menu_course' href='".base_url()."category/course_detail/".$search_key."/".@$searchitem->catid."'>".$searchitem->name."</a></li>";

				 		echo "<li><a class='menu_course' href='".base_url()."".@$searchitem->catid."/category/".$search_key."'>".$searchitem->name."</a></li>";
					}
					else{
						echo "<li><a class='menu_cat' href='".base_url()."category/course/".$search_key."'>".$searchitem->name."</a></li>";
				 	}
				 }
			}

		}
		}
	}

	public function getlistforcoupon()
	{

		if($_POST['input']){
		$searchlist = $this->customs_model->getsearchforcoupon($_POST['input']);
	
			if($searchlist){

				 foreach ($searchlist as $searchitem) {					
				 	
				 		echo "<li class='coup_course' value='".$searchitem->id."' >".$searchitem->name."</li>";				
				 }
			}

		}
	}

	public function getCourseSlider()
	{


	}


	public function getFrontCourses()
	{ 	
		$course_id = $this->customs_model->getFrontIds();
		$list = json_decode($course_id); 
		
		$courses = $this->customs_model->getFrontCourses($list, $startlimit);
		print_r($courses); 
		exit('ff');
	}

	public function getAuthSlider()
	{
		// echo @$_POST['coursetype'];
		$teacher_id = @$_POST['techid'];
		$catid = @$_POST['catid'];
		$startlimit = $_POST['start'];
		if($startlimit>=0 && $startlimit!=''){
		if($teacher_id){
			$courses = $this->customs_model->getUserCourses1($teacher_id, $startlimit);
		
			$teacher_info = $this->program_model->getTeacherInfo($teacher_id);

		}
		else if($catid)
		{
			if( @$_POST['coursetype'] =='top')
			{
				$courses = $this->customs_model->toprateCourse1($catid, $startlimit);
			
			}
			else if( @$_POST['coursetype'] =='new')
			{
				$courses = $this->customs_model->getcategories1($catid, $startlimit);
			
			}
			


		}
		else{
			$courses = $this->customs_model->toprateCourse1($startlimit);
				

		}
	}
 // print_r($courses);
		if($courses){
		$rows = count($courses);
		// echo $rows;
		if($rows < 4){ $rows = ''; }
		else{ $rows = $startlimit + $rows; }

		echo "<input type='hidden' class='startlimit' name='startlimit' value='".$rows."'>";

		$currency = $this->settings_model->getItems();
		$currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
		if($currencysign)
		{
			$currency_symbol = $currencysign->sign;
		}
		else
		{
		$currency_symbol = " ";	
		}
		echo "<div class='item active'>";
		// print_r($courses);
		foreach ($courses as $othercourse) { 
			//if(!$teacher_info){
			$teacher_info = $this->program_model->getTeacherInfo($othercourse->author);
		// 	print_r($teacher_info);
		// }
			$catid = $this->category_model->getCatSlugbyId($othercourse->catid);
			?>

			 <div class="item-item col-sm-3 col-xs-12  res_col no-padding1"> 
			 <a href="<?php echo base_url() ?><?php echo $catid ?>/category/<?php echo $othercourse->slug ?>">
			 <div class="card">
                                <div class="cardhover">
                                   <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%" >
                                    <div class="overlay">
                                      <div class="text">
                                        <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $teacher_info->images; ?>" width="50px" height="50px" class="img-thumbnail">
                                        <br>
    <?php  $alllecture = $this->customs_model->countalllecture($othercourse->id);
                      echo "<p>".$alllecture->no_lect." Lectures </p>"; 
                     // echo "<p>".$alllecture->tot_duration." Hours Video  </p>";  ?>

                                     
                                      </div>
                                    </div>
                </div>
                <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
<p class="jonas"><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>

<?php 
       $reviews = $this->program_model->getAllReview($othercourse->id);
       // print_r($reviews);
       $rcount = 0;
     foreach ($reviews as $review) {

  $rcount = $rcount + $review->review_rate;     }
?> <p class="star">
 <?php  for ($i=1; $i <=5 ; $i++) { 
                    echo "<span class='fa fa-star ";
                    if($i<= @$reviews[0]->review_rate) echo 'checked'; 
                    echo "'></span>";
                  } 
  ?>
 <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
              </p>
                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
            <?php if($othercourse->demoprice >0){ ?>
      <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                </span>
        <?php } ?>
</p>

              </div>
                          </a>
                        </div>

			 <?php
		} echo "</div>";

}
		// print_r($courses);
	}


function getMore(){

	$teacher_id = @$_POST['techid'];
			$catid = @$_POST['catid'];
	if($teacher_id){
		$courses = $this->customs_model->getUserCourses2($teacher_id);
	
		$teacher_info = $this->program_model->getTeacherInfo($teacher_id);

	}
	
		else if($catid)
		{
			if(@$_POST['coursetype'] =='top')
			{
				$courses = $this->customs_model->toprateCourse2($catid);
			}
			else if(@$_POST['coursetype'] =='new')
			{
				$courses = $this->customs_model->getcategories2($catid);
			}
			
		}
		else{
			$courses = $this->customs_model->toprateCourse2();

		}
		// print_r($courses);
	if($courses){
	  foreach ($courses as $othercourse) {     ?>
       <div class="responsive-main-slider-sect col-sm-12">
          <div class="resposive_txt">
            <div class="cardhover">
              <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%" >
              <div class="overlay"></div>
            </div>
            <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
            <?php if(!$teacher_info){
			$teacher_info = $this->program_model->getTeacherInfo($othercourse->author);
		} ?>
            <p class="jonas"><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>
            <?php 
       $reviews = $this->program_model->getAllReview($othercourse->id);
       // print_r($reviews);
       $rcount = 0;
     foreach ($reviews as $review) {

  $rcount = $rcount + $review->review_rate;     }
?> <p class="star">
 <?php  for ($i=1; $i <=5 ; $i++) { 
                    echo "<span class='fa fa-star ";
                    if($i<= @$reviews[0]->review_rate) echo 'checked'; 
                    echo "'></span>";
                  } 
  ?>
 <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
              </p>
                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
            <?php if($othercourse->demoprice >0){ ?>
      <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                </span>
        <?php } ?>
</p>
            
        </div>
       </div>
     <?php } 

	}

}

		/*$actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$actual_link = str_replace('ref=', '', $actual_link);
		$days = 1;
		$date_of_expiry = time() + 60 * 60 * 24 * $days ;
		$cookie = array(
		    'name'   => 'referral_code',
		    'value'  => $actual_link['query'],
		    'expire' => $date_of_expiry,
		    'secure' => TRUE
		    );
        
        $this->input->set_cookie($cookie); */
	/*public function courses()
	{
		
		$searchCourse = "";
        if($this->input->post('searchtext'))
		{
			$searchCourse = $this->input->post('searchtext');
		}
		 else{
		$searchCourse = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('searchtext');
			if(!is_numeric($searchCourse))
			{
				$searchCourse = $this->category_model->getCatIdbySlug($searchCourse);
			}
			else{
				$searchCourse = $this->category_model->getCatSlugbyId($searchCourse);
				redirect('category/course/'.$searchCourse);
			}

		}

        $actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$days = 1;

		$date_of_expiry = time() + 60 * 60 * 24 * $days ;
		if($actual_link['query']){
		$actual_link['query'] = str_replace('ref=', '', $actual_link['query']);
		// $this->session->set_userdata('referral_code', $actual_link['query']);
		setcookie("referral_code", $actual_link['query'],$date_of_expiry,'TRUE');
		}
		// print_r($_COOKIE['referral_code']);exit;
		$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;

		$baseurl = base_url() . "category/courses";
		$this->load->library('pagination');

		$config["base_url"] = $baseurl;

		$config['per_page'] = 12;

		$config['enable_query_strings'] = true;

		$config['uri_segment'] = 3;


	    $config['total_rows'] = $this->program_model->getAllProgramCount();	

		$this->pagination->initialize($config);

		$this->load->view('new_template_design/header');
		$data['countprograms'] = $config['total_rows'];
		// echo $start .' - ' .$config['per_page'].' - '. $searchCourse;
		$data['courses'] = $this->program_model->getAllProgram($start, $config['per_page']);
		$this->load->view('new_template_design/courses', $data);	
		$this->load->view('new_template_design/footer');
		}*/
	// new template

	public function course_detail($catid,$pro_id)
	{
		$actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$days = 1;

		$date_of_expiry = time() + 60 * 60 * 24 * $days ;
		if($actual_link['query']){
		$actual_link['query'] = str_replace('ref=', '', $actual_link['query']);
		// $this->session->set_userdata('referral_code', $actual_link['query']);
		setcookie("referral_code", $actual_link['query'],$date_of_expiry,'TRUE');
		}
		if($this->uri->segment(2)=="course_detail")
		{
			redirect($this->uri->segment(4).'/'.$this->uri->segment(3));
		}
		$sessionarray = $this->session->userdata('logged_in');		
	    $user_id = $sessionarray['id'];
	    $group_id = $sessionarray['groupid'];
	    if(!is_numeric($catid))
		{
			$catid = $this->category_model->getCatIdbySlug($catid);
		}
		else{
			$catid = $this->category_model->getCatSlugbyId($catid);
			redirect($catid.'/category/'.$pro_id);
		}
		 if(!is_numeric($pro_id))
		{
			$pro_id = $this->category_model->getCourseIdbySlug($pro_id);
		}
		else{
			$pro_id = $this->category_model->getCourseSlugbyId($pro_id);
			redirect($catid.'/category/'.$pro_id);
		}
		 $program = $this->program_model->getProgram($pro_id);

	     $programs['assigned'] = $this->program_model->getAssignUser($program->selected_course,$user_id);
	    $allcategory = $this->customs_model->getAllCateg_new($catid);
     	$category = $this->customs_model->getcate($catid);

     	$programs['allcategory'] = $allcategory;
     	$programs['category'] = $category;
     	$programs['program_plans'] = $this->Program_model->getProgramPlans($pro_id);

     	$count_program_plans = $this->program_model->getCountProgramPlans($pro_id);
     	$programs['count_program_plans'] = $count_program_plans;

     	$programs['days'] = $this->program_model->getlistDays($pro_id);
		$programs['user_id'] = $user_id;
		$programs['getBuyCoursesUser'] = $this->program_model->getBuyCoursesUser($user_id,$pro_id);
// print_r($category);
// $data111 = $this->template->set("webinars", $this->program_model->getWebinarsNewAll($pro_id));
//        $this->template->set('webinars', $this->programs_model->getWebinar($pro_id));
//        $this->template->set('webinars2', $this->programs_model->getWebinar2($pro_id));
// $this->template->set("exercise", $this->program_model->getExercise($pro_id));
// $this->template->set("wishlist", $this->category_model->getProgramWishlist($user_id,$pro_id));
// $this->template->set("configsetting", $this->program_model->getConfigSettings());
 $currency = $this->settings_model->getItems();

$currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
if($currencysign)
		{
			$currency_symbol = $currencysign->sign;
		}
		else
		{

		$currency_symbol = " ";	
		
		}
$date_enrolled = $this->program_model->datebuynow($pro_id, $user_id);
		// $programs['date_enrolled'] = $date_enrolled;
		$isEnrolled =  count($date_enrolled);

		$block_enrolled1 = $this->program_model->checkblockenroll($pro_id, $user_id);
$block_enrolled =count($block_enrolled1);

// print_r($date_enrolled);
		 $programs['exp_date'] = @$date_enrolled->expired_date;
		// $course_days = $this->Program_model->getlistDaysarray($pro_id);		

		// $hasaccess = $this->haveAccess($pro_id, $program, $course_days);

		// $hasaccess = (in_array('hasaccess',$hasaccess))? TRUE : FALSE;
		// $programs['hasaccess'] = $hasaccess;
		// $this->template->set("block_enrolled", $block_enrolled);

if(isset($program->author))
		{
			$teacher_id = (isset($program->author)) ? $program->author : '';
			$teacher_info = $this->program_model->getTeacherInfo($teacher_id);
			$teachercourse = $this->program_model->getTeacherCourse($teacher_id);
			
		}
		else
		{
			$teacher_info = '';
			$teachercourse = '';
		}
		$programs['days'] = $this->Program_model->getlistDays($pro_id);
		$price = $this->Program_model->getPrice($pro_id);
		$programs['pay_setting'] = $this->settings_model->getAccountMode();
		$programs['pro_price'] = $price;

		$programs['teacher_info'] = $teacher_info;
		$programs['currency_symbol'] = $currency_symbol;
		$programs['isEnrolled'] = $isEnrolled;
		// $program = $this->customs_model->getcourse11($id,$catid);
	$programs['block_enrolled'] = $block_enrolled;
		$programs['programs'] = $program;
		// $this->load->view('new_template_design/header');

		echo $this->load->view('new_template_design/course_detail', $programs, TRUE);	
		// $this->load->view('new_template_design/footer');
	}
	public function course($course=null,$catid=null)
	{
		// $this->load->view('new_template_design/header');
		
		if($this->input->post('searchtext'))
		{
			$searchCourse = $this->input->post('searchtext');
		}
		 else{
		$searchCourse = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('searchtext');
			if(!is_numeric($searchCourse))
			{
				$searchCourse = $this->category_model->getCatIdbySlug($searchCourse);
			}
			else{
				$searchCourse = $this->category_model->getCatSlugbyId($searchCourse);
				redirect('category/course/'.$searchCourse);
			}

		}
		if($searchCourse){
		//$searchCourse = $this->input->post('searchtext');
		if($_POST)
		{
			$searchCourse = $this->input->post('searchtext');
			$getProgram = $this->customs_model->getcourse($searchCourse);
			
			$getProgramCategory = $this->category_model->getcategory1($searchCourse);
			 $categories['programCategory'] = $getProgramCategory;
			$getcate = $this->customs_model->getcate(@$getProgram->catid);

			 $categories['Pcategory'] = $getcate;

		}
		else{
			// $searchCourse = $this->uri->segment(3);
			$getProgram = $this->customs_model->getcourse11($searchCourse,$this->uri->segment(4));
			$getProgramCategory = $this->category_model->getcategory2($searchCourse);
			$categories['Pcategory'] = $getProgramCategory;

			// print_r($getProgram);

		}


         
          $subcategory = $this->category_model->subcategory(@$getProgram->catid);
     

		$categories1 = $this->customs_model->getcategories(@$getProgram->catid);
		 $categories['cate'] = $categories1;
		 $categories['program'] = $getProgram;
		 $categories['subcategory'] = $subcategory;
		}
		 $categories['searchCourse'] = $searchCourse;
		
		// $topcourse = $this->customs_model->getopcourse($getProgram->catid,$getProgram->id);
		// print_r($topcourse); exit('222');

	echo $this->load->view('new_template_design/course', $categories, TRUE);
	}
	
	public function about()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/about_us');	
		$this->load->view('new_template_design/footer');
	}
	public function press()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/press');	
		$this->load->view('new_template_design/footer');
	}
	public function terms_of_use()
	{
		$page_id = '12' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	//$this->template->build(getOverridePath($tmpl,'resourcepages/resourcepage','views'));
	  	echo $this->load->view('new_template_design/terms_of_use', $data, TRUE);
		//$this->load->view('new_template_design/header');
		//$this->load->view('new_template_design/terms_of_use');	
		//$this->load->view('new_template_design/footer');
	}
	public function partnership()
	{
		$this->session->set_userdata('page_tab','terms');
		$page_id = '13' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	echo $this->load->view('new_template_design/terms', $data, TRUE);
	}
	public function privacy_policy()
	{
		$this->session->set_userdata('page_tab','privacy');
		$page_id = '14' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	echo $this->load->view('new_template_design/terms', $data, TRUE);
	}
	public function trust_safety()
	{
		$this->session->set_userdata('page_tab','trust_safety');
		$page_id = '15' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	echo $this->load->view('new_template_design/terms', $data, TRUE);
	}
	public function agreement()
	{
		$this->session->set_userdata('page_tab','agreement');
		$page_id = '16' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	echo $this->load->view('new_template_design/terms', $data, TRUE);
	}

	public function contact_us()
	{
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		
		// $tmpl = $configarr[0]['layout_template'];      
		// $this->template->set("tmpl",$tmpl);
		// $this->template->title('Contact Us');      
		//$fromname = $configarr[0]->fromname;
		$admin_email = '';
		//$admin_email = $configarr[0]['fromemail'];
	  
        $btnvalue = $this->input->post('send');
        if($btnvalue == 'send')
	    {
	    	//exit('yes');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $body = $this->input->post('body');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
		//$this->form_validation->set_rules('mailto', 'mailto', 'required');
		
		
            if ($this->form_validation->run() === FALSE)
            {
				echo $this->load->view('new_template_design/contact_us');	

            }
			else
			{

				/* $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'myusername@gmail.com',
                'smtp_pass' => 'mypassword',
				);*/
				//$this->load->library(‘email’, $config);
				//$this->load->library('email',$config);
				// $mailto = $this->input->post('mailto');
				// if($mailto == 'Enquiry')
				// {	
				// 	//$admin_email = 'enquiry@createonlineacademy.com';
				// 	//Attached 3 mail for tasks 1. Ticket Generated Email to Student and Ticket Email to Admin
				// 	// i.e f a student sends an enquiry then it will generate an email and sends to support team of the institutes
				// 	$admin_email = 'enquiry@createonlineacademy.com, support@createonlineacademy.com, admin@createonlineacademy.com';
				// //$admin_email =""; 
				// }
				// if($mailto == 'Support')
				// {	
				// 	$admin_email = 'support@createonlineacademy.com';
				// }
				// if($mailto == 'Billing')
				// {	
				// 	$admin_email = 'billing@createonlineacademy.com';
				// }
				// if($mailto == 'Technical')
				// {	
				// 	$admin_email = 'technical@createonlineacademy.com';
				// }
				// if($mailto == 'Sales')
				// {	
				// 	$admin_email = 'sales@createonlineacademy.com';
				// }
				
				// $urldomain = base_url();
				// $urldomain = str_replace('http://', '', $urldomain);
				// $urldomain = str_replace('/', '', $urldomain);
				// $urldomain = str_replace('www.', '', $urldomain);
				$urldomain = $this->config->item('urldomain');

				$fromemail='noreply@'.$urldomain;		 		

				$admininfo = $this->login_model->getadminInfo(4);				


				$admin_email= $admininfo->email;

				$admininfo = $this->login_model->getadminInfo(4);
				$configarr = $this->settings_model->getItems();
				$this->load->library('email');
				//$subject1 = 'New Enquiry for '.$configarr[0]['institute_name'];
				$subject1 = 'Enuiry received - '.$configarr[0]['institute_name'];
				$toemail = $admin_email;
				
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
                    Enuiry received - '.$configarr[0]['institute_name'].'</p>';
				$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
				$content .='There is a new Enquiry. Here are the details:<br /><br />';
				$content .= 'Email : <a style="color:#55c5eb" href="mailto:'.$email.'" target="_blank">'.$email.'</a><br />';
				$content .= 'Subject : '.$subject.'<br />';
				$content .= 'Message : '.$body.'<br />';
				// $content .='<br /><br />';
				// $content .='...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				$data['content'] = $content;
				$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail,$configarr[0]['fromname']);
				$this->email->to($toemail);
				$this->email->subject($subject1);
				$this->email->message($message1);
				
				$this->email->send();
				//$this->session->set_userdata('contactmail', 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest');
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest'));
            	redirect('contact_us');
            }
		}
		$data['configarr'] = $configarr;
		$pagetype="contact";
		$contactpage=$this->Pagecreator_model->getPageByType($pagetype);
		 if($contactpage[0]['status'] =='inactive')
        {
        	redirect(base_url(),'location',301);
        }
		$data['contactpage'] = $contactpage;
		echo $this->load->view('new_template_design/contact_us', $data, TRUE);	
		//print_r($configarr[0]->fromname;$configarr[0]->fromemail);
		
		// $this->load->view('new_template_design/header');
		// $this->load->view('new_template_design/contact_us');	
		// $this->load->view('new_template_design/footer');
	}
	public function blog()
	{
		$data = $this->blogs_model->blog_list();
  	 	$comments = $this->blogs_model->latestCommentsnew();
  	 	//print_r($data);exit('eee');
  	 	$blog['blogs']=$data;
  	 	$blog['recentComments'] = $comments;
		//$this->load->view('new_template_design/header');
		echo $this->load->view('new_template_design/blog', $blog, TRUE);
		//$this->load->view('new_template_design/footer');
	}
	public function career_detail()
	{
		$this->load->view('new_template_design/career_detail');	
	}
	public function career()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/career');	
		$this->load->view('new_template_design/footer');
	}
	public function teaching()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/teaching');	
		$this->load->view('new_template_design/footer');
	}
	public function profile($id)
	{
		
	 $sessionarray = $this->session->userdata('logged_in');
	 
	   $user_id = $id ? $id : $sessionarray['id'];
	   
	   $name = $sessionarray['first_name'].' '.$sessionarray['last_name'];
		
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $configarr[0]['layout_template'];		
		$this->template->set("tmpl", $tmpl);
		$this->template->append_metadata(block_submit_button());
		$this->load->helper('form');
		
		
		 $this->load->model('Program_model');
		 $this->load->model('Myinfo_model');
		 $this->load->model('Category_model');
	    $teacher_id = $this->uri->segment(3);
        $teacher_info = $this->Program_model->getTeacherInfo($teacher_id);
		//$this->template->set("wishlist", $this->Category_model->getWishlist($user_id));
	    $this->template->set("teachingcourses", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    $this->template->set("teachingcourses1", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    $data['teacher_info'] = $teacher_info;
	    $data['user_id'] = $user_id;
	    $data['name'] = $name;
	    $data['teachingcourses'] = $this->Myinfo_model->getTeachingCourses($teacher_id);
	    // $data['teachingcourses1'] = $this->Myinfo_model->getTeachingCourses($teacher_id);
		//$this->template->build('programsnew_template_design/profile');
		
		//redirect('programs/information');	
		//$this->load->view('new_template_design/header');
		 echo $this->load->view('new_template_design/profile', $data, TRUE);
			
		//$this->load->view('new_template_design/footer');
	  	//$this->template->build(getOverridePath($tmpl,'resourcepages/resourcepage','views'));
	  	
	}

	// end

    public function index($parent_id = NULL)
	{
	   
        $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();

		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('category_model');
        $this->template->set("tmpl", $tmpl);
        $this->template->set("categories", $this->category_model->getAllCateg_new());
	    $auth = $this->session->userdata('logged_in');
	    
        $this->load->model('program_model');
        $result = $this->settings_model->getItems();
        extract($result[0]);
        $this->template->set('category_list', json_decode($ctgspage));
	    $this->template->build(getOverridePath($tmpl,'category/list','views'));	

	}
	
	public function pagenotfound()
	{
	   $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('category_model');
        $this->template->set("tmpl", $tmpl);
	   $this->template->build('category/pagenotfound');
	}

	public function donotpermission()
	{
	   $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		//$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('category_model');
       // $this->template->set("tmpl", $tmpl);
        $this->load->view('new_template_design/header');
        $this->load->view('category/donotpermission', $data);
        $this->load->view('new_template_design/footer');
	   // $this->template->build('category/donotpermission');
	}
	
	public function add_wishlist()
	{
	  	if($this->session->userdata('logged_in'))
	  	{
			$sessionarray = $this->session->userdata('logged_in');
			$user_id = $sessionarray['id'];
			$program_id = $this->input->post('pro_id');
			$hover_id = $this->input->post('hover_id');

			$this->load->model('category_model');

			$data = array(
			'user_id' => $user_id,
			'program_id' => $program_id,
			'wishlist_date' => date("Y-m-d")
			);
				
			$wishlist_id = $this->category_model->getInsertWishlist($data);

			$Program_name = $this->settings_model->getCourseName($program_id);
			$data_activity = array(
				'activity' => $Program_name.' course added to your wishlist',
				'sender_id' => $user_id ,
				'receiver_id' => $user_id ,
				'activity_type' => 'wishlist',
				'activity_date' => date("Y-m-d"),
			    'visit_id' => '0'
			  );

			$this->category_model->insertActivity($data_activity);


			$author = $this->settings_model->getTeacherId($program_id);


			if($user_id == $author)
			{
				$name = 'You';
			}
			else
			{
				$name = $this->settings_model->getName($user_id);
			}

			$data_activity = array(
				'activity' => $name.' wishlisted course '.$Program_name,
				'sender_id' => $user_id ,
				'receiver_id' => $author ,
				'activity_type' => 'wishlist',
				'activity_date' => date("Y-m-d"),
			    'visit_id' => $user_id
			);

			$this->category_model->insertActivity($data_activity);

			if($wishlist_id)
			{
			echo "<i class='entypo-heart' style='color:#D04D66;'></i><span class='in-wishlist none' onclick='ajax_deletewishlist($program_id,$wishlist_id,$hover_id)'>Wishlisted</span>";
			return;	  
			}
	  	}
	}
	
	public function delete_wishlist()
	{	  
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$wishlist_id = $this->input->post('wishlist_id');  
		$program_id = $this->input->post('pro_id');	  
		$hover_id = $this->input->post('hover_id');	  

		$this->load->model('category_model');	  

		$Program_name = $this->settings_model->getCourseName($program_id);

		$data_activity = array(
		'activity' => $Program_name.' course remove from your wishlist',
		'sender_id' => $user_id ,
		'receiver_id' => $user_id ,
		'activity_type' => 'wishlist',
		'activity_date' => date("Y-m-d"),
		'visit_id' => '0'
		);

		$this->category_model->insertActivity($data_activity);

		$this->category_model->deleteWishlist($wishlist_id);
		echo "<i class='entypo-heart' style='color:#D04D66;'></i> <span class='in-wishlist' onclick='ajax_addwishlist($program_id,$hover_id)'>Wishlist</span>";
		return;		  
	}	
	
	public function view($cat_id = NULL)
	{
	    $sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
		
        $this->load->model('admin/settings_model');     
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];     
		$this->load->model('category_model');
		$cat_data = $this->category_model->getCateg($cat_id);
		if($cat_data)
		{
		$this->template->title($cat_data->name); 
		}    
        $cat_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
        if(!isset($cat_id) && $cat_id == '')
		{
			redirect('category');
	    }
		$currency = $this->settings_model->getItems();
		$currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
		//if($currency[0]['currency'] == 'USD')
		if($currencysign)
		{
			$currency_symbol = $currencysign->sign;
		}
		else
		{

		$currency_symbol = " ";	
		
		}
		$this->template->set("currency_symbol", $currency_symbol);
        $this->template->set("wishlist", $this->category_model->getWishlist($user_id));
        $getProgram = $this->category_model->getProgram($cat_id);
        
		$this->template->set("tmpl", $tmpl);
		//$this->template->set("category", $this->category_model->getCateg($cat_id));
		$this->template->set("category1", $this->category_model->getCateg($cat_id));
		$this->template->set("subcategory", $this->category_model->subcategory($cat_id));
		$this->template->set("programs", $getProgram);
		$this->template->build(getOverridePath($tmpl,'category/courses','views'));
	}

	public function search()
	{
		$searchCourse = $this->input->post('searchtext');

	    $sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
		
        $this->load->model('admin/settings_model');     
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];     
		$this->load->model('category_model');
		//$cat_data = $this->category_model->getCateg($cat_id);
		// if($cat_data)
		// {
		// $this->template->title($cat_data->name); 
		// }    
        //$cat_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
  //       if(!isset($cat_id) && $cat_id == '')
		// {
		// 	redirect('category');
	 //    }
		$cat_id = NULL;
		$currency = $this->settings_model->getItems();
		$currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
		if($currencysign)
		{
			$currency_symbol = $currencysign->sign;
		}
		else
		{
		$currency_symbol = " ";	
		}
		$this->template->set("currency_symbol", $currency_symbol);
        $this->template->set("wishlist", $this->category_model->getWishlist($user_id));
        $getProgram = $this->category_model->getprogram1($searchCourse);

        $getProgramCategory = $this->category_model->getcategory1($searchCourse);

		$this->template->set("tmpl", $tmpl);
		$this->template->set("category", $this->category_model->getCateg($cat_id));
		$this->template->set("programs", $getProgram);

		$this->template->set("programCategory", $getProgramCategory);

		$this->template->build(getOverridePath($tmpl,'category/searchcourses','views'));
	}

	public function courses()
	{
		$searchCourse = "";
        if($this->input->post('searchtext'))
		{
			$searchCourse = $this->input->post('searchtext');
		}
		else{
			$searchCourse = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('searchtext');
			if(!is_numeric($searchCourse))
			{
				$searchCourse = $this->category_model->getCatIdbySlug($searchCourse);
			}
			else{
				$searchCourse = $this->category_model->getCatSlugbyId($searchCourse);
				redirect('category/course/'.$searchCourse);
			}
			$searchCourse ="";
		}
		if(!empty($searchCourse))
		{
			$con = "slug like '%".$searchCourse."%'";
		}
		else
		{
			$con = "";
		}

		$actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$days = 1;
		$date_of_expiry = time() + 60 * 60 * 24 * $days ;
		if($actual_link['query']){
			$actual_link['query'] = str_replace('ref=', '', $actual_link['query']);
			setcookie("referral_code", $actual_link['query'],$date_of_expiry,'TRUE');
		}
		$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
		$baseurl = base_url() . "category/courses";
		$this->load->library('pagination');
		$config["base_url"] = $baseurl;
		$config['per_page'] = 12;
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
	    // $config['total_rows'] = $this->program_model->getAllProgramCount();	
	    $con = "slug like '%".$searchCourse."%'";
	    $config['total_rows'] = $this->program_model->getAllProgramCountnew($con);	

		$this->pagination->initialize($config);
		$this->load->view('new_template_design/header');
		$data['countprograms'] = $config['total_rows'];
		// $data['courses'] = $this->program_model->getAllProgram($start, $config['per_page']);
		
		$data['courses'] = $this->program_model->getAllProgramnew($start, $config['per_page'],$con);
		$this->load->view('new_template_design/courses', $data);	
		$this->load->view('new_template_design/footer');
	}
}
?>