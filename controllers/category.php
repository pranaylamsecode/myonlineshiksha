<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MLMS_Controller {
	public $rest;
	public $rest_format;
	public $methods;
  	function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
        $this->load->library('phpqrcode/qrlib');
		$this->load->helper('text');
		$this->load->helper('commonmethods');
        $this->load->model('admin/settings_model');	
		$this->load->model('admin/programs_model');
		$this->load->model('customs_model');
		$this->load->model('category_model');
		$this->load->model('Category_model');
		$this->load->model('blogs_model');
		$this->load->model('Crud_model');
		$this->load->library('PHPExcel');
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
		$this->load->helper('cookie');
	}

	public function getlist()
	{
		if($_POST['input']){
			$searchData = $this->customs_model->getsearch($_POST['input']);
			// print_r($searchData); exit('44');
			foreach ($searchData as $searchlist) {
				if($searchlist){
					foreach ($searchlist as $searchitem) {
						$total = count((array)$searchitem);
						$search_key = $searchitem->slug ? $searchitem->slug : $searchitem->id;
					 	if($total == 4){
					 		echo "<li><a class='menu_course' href='".base_url()."online-courses/".$search_key."'>".$searchitem->name."</a></li>";
						}
						else{
							echo "<li><a class='menu_cat' href='".base_url()."category/courses/".$searchitem->name."'>".$searchitem->name."</a></li>";
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
		$courses = '';
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
				$courses = $this->customs_model->toprateCourse($startlimit);
			}
		}
		if($courses){
		$rows = count($courses);
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
		foreach ($courses as $othercourse) { 
			$teacher_info = $this->program_model->getTeacherInfo($othercourse->author);
			$catid = $this->category_model->getCatSlugbyId($othercourse->catid);
			?>
			 <div class="item-item col-sm-3 col-xs-12  res_col no-padding1">
			 <a href="<?php echo base_url().'online-courses/'.$othercourse->slug ?>">
			 <div class="card">
                <div class="cardhover">
                   <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%" >
                </div>
                <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
		<p class="jonas"><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>
		<?php $avgreview = $this->customs_model->getAvgReview($othercourse->id);?>
		<p class="star">
 		<?php echo $this->renderStarRating($avgreview->avg_review);?>
 			<span class="small_card"><?php if($avgreview->avg_review>0) echo "( ".number_format($avgreview->avg_review,1)." ratings )" ?> </span>
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

function renderStarRating($rating,$maxRating=5) {
    $fullStar = "<li style='display:inline-block' ><i class = 'fa fa-star checked'></i></li>";
    $halfStar = "<li style='display:inline-block' ><i class = 'fa fa-star-half-full checked'></i></li>";
    $emptyStar = "<li style='display:inline-block' ><i class = 'fa fa-star-o checked'></i></li>";
    $rating = $rating <= $maxRating?$rating:$maxRating;
    $fullStarCount = (int)$rating;
    $halfStarCount = ceil($rating)-$fullStarCount;
    $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;
    $html = str_repeat($fullStar,$fullStarCount);
    $html .= str_repeat($halfStar,$halfStarCount);
    $html .= str_repeat($emptyStar,$emptyStarCount);
    $html = '<ul>'.$html.'</ul>';
    return $html;
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
            <?php $avgreview = $this->customs_model->getAvgReview($othercourse->id);
?> <p class="star">
 <?php  
        echo $this->renderStarRating($avgreview->avg_review);
  ?>
 <span class="small_card"><?php if($avgreview->avg_review>0) echo "( ".$avgreview->avg_review." ratings )" ?> </span>
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
	public function courses($search)
	{
		$teacher = $this->program_model->getall_teacher();
		$searchCourse = "";
		$data['popular_Cat']='';
		$data['searchCourse']='';
		if(!empty($search))
		{
			$getcat = $this->Crud_model->get_single('mlms_category',"slug = '".$search."'");
			if(empty($getcat))
			{
				echo "<script>window.location.href = '".base_url()."category/courses';</script>";exit;
			}
			$search = $getcat->id;
			if(!is_numeric($search))
			{	
				$con = "slug like '%".$search."%'";
			}else
			{
				$con = "catid = '".$search."'";
			}
			$data['popular_Cat'] = $search;
		}
		else if($this->input->post('searchtext')){
			$searchCourse = $this->input->post('searchtext');
			$con = "name like '%".$searchCourse."%'";
		}
		else
		{
			$con = "";
		}
        $actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$data['demo_cookie'] = '';
		if(strpos($_SERVER['REQUEST_URI'],'ref')){
			if($actual_link['query']){
				$actual_link['query'] = str_replace('ref=', '', substr($actual_link['query'],0,12));
			    $data['demo_cookie'] = $actual_link['query'];
			}
		}
		$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
		$config['per_page'] = 12;
		$tot_array = array();
		if($this->input->post('searchtext')){
	    	$total_rows = $this->program_model->getAllProgramCountnew($con);	
			$data['searchCourse'] = $this->input->post('searchtext');
			$courses = $this->program_model->getAllProgramnew($start, $config['per_page'],$con);
			if(empty($courses)){
// ADDING GOOGLE SEARCH BEHAVIOR
			$name = $this->input->post('searchtext');
			$shuffle = explode(" ",$name);
			if(count($shuffle)==3){
				$tot_array = array
				(
					array(0,1,2),
					array(0,2,1),
					array(1,2,0),
					array(1,0,2),
					array(2,0,1),
					array(2,1,0)
				);
			}
			else if(count($shuffle)==2){
				$tot_array = array
				(
					array(0,1),
					array(1,0)
				);
			}
			if(count($shuffle)!=1 || count($shuffle) <= 3)
			{
				$n1 ="";
				if (empty($courses)) {
					for ($i=0; $i < count($tot_array); $i++) { 
						for ($j=0; $j < count($tot_array[$i]); $j++) { 
							$n1 .= $shuffle[$tot_array[$i][$j]];
							if($j != count($tot_array[$i])-1)
								$n1 .=" ";
						}
						$con = "name like '%".$n1."%'";
						$total_rows = $this->program_model->getAllProgramCountnew($con);
						$courses = $this->program_model->getAllProgramnew($start, $config['per_page'],$con);
						$n1 ="";
						if(!empty($courses))
						{
							break;
						}	
					}
				}
			}
		}
// ADDING GOOGLE SEARCH BEHAVIOR
		$data['total_rows'] = $total_rows;
	    }
	    /*else{
			$courses = $this->program_model->getAllProgramnew($start, $config['per_page'],$con);
			if(empty($courses))
			{
				echo "<script>window.location.href = '".base_url()."category/courses/';</script>";exit;
			}
	    }*/
		$this->load->view('new_template_design/header',$data);
		$data['teacher'] = $teacher;
		$data['searchtextt'] = $search;
		$this->load->view('new_template_design/courses', $data);
	}

	// new template
	public function demo()
	{	
		/*$data = array(
					'userid' 		=> 2968,
					'order_id'		=> 0,
					'course_id'		=> 233,
					'price'			=> 0,
					'currency'		=> 'INR',
					'buy_date'		=> date('Y-m-d H:i:s'),
					'expired_date'	=> '0000-00-00 00:00:00'
		);
		$this->Crud_model->SaveData('mlms_buy_courses',$data);*/
		/*$url='https://vimeoapi2.createonlineacademy.com/vendor/example/demo_test.php';
		$data= array('project_id'=>'628460','page'=> 1,"video_id"=>'348612963'); // Add parameters in key value
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$result=curl_exec ($ch);
		curl_close ($ch);
		echo  substr($result,strpos($result,'https://vimeo.com/'),39);
		// echo  substr(substr($result,strpos($result,'https://vimeo.com/'),39),28);
		exit;

		exit;*/
		/*$url='https://vimeoapi2.createonlineacademy.com/vendor/example/demo_test.php';
		$data= array('project_id'=>'628460','page'=> 1,"video_id" => '340378452'); // Add parameters in key value
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$result=curl_exec ($ch);
		curl_close ($ch);
		echo $result;*/
		echo "You are not AUTHORISED to open this page!  <a href='".base_url()."'>HOME</a><br>";
		exit;
		// echo  substr($result,strpos($result,'https://vimeo.com/'),39);
		$data['video_hash'] = trim(substr(substr($result,strpos($result,'https://vimeo.com/'),39),28));
		$data['video_id'] = '348612963';
		$this->load->view('new_template_design/header');
		$this->load->view('resourcepages/upload_demo',$data);
		$this->load->view('new_template_design/footer');
	}
	public function doitas()
	{
		$url='https://vimeoapi2.createonlineacademy.com/vendor/example/demo_test.php';
		$data= array('project_id'=>'628460','page'=> 1,"video_id" => $this->input->post('video_id')); // Add parameters in key value
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$result=curl_exec ($ch);
		curl_close ($ch);
		echo trim(substr(substr($result,strpos($result,'https://vimeo.com/'),39),28));
		/*$file = $_FILES['table_file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
        $n=1;
        for($i=1; $i<=$arrayCount; $i++)
        {                   
            $url = $allDataInSheet[$i]["A"];
            $title = $allDataInSheet[$i]["B"];
            $metadesc = $allDataInSheet[$i]["C"];
            $content = $allDataInSheet[$i]["D"];
            $getcourse = $this->Crud_model->get_single('mlms_program',"slug = '".$url."'","id,name,slug,metatitle,metadesc,author");
            if(!empty($getcourse))
            {
                $teacher = $this->Crud_model->get_single('mlms_users',"id = ".$getcourse->author);
                $fname = $teacher->first_name;
                $lname = $teacher->last_name;
                $desc = '<p><strong><span style="font-family: Arial, sans-serif;"><span style="font-size: medium;">';
                $desc1 = '</span></span></strong></p>';
                $data = array(
                            'description'   => $desc.$content.$desc1,
                            'metatitle'     => $title.' by '.ucfirst($fname)." ".ucfirst($lname),
                            'metadesc'      => $metadesc,
                );
                $this->Crud_model->SaveData('mlms_program',$data,"slug = '".$url."'");
            }
        }*/
	}

	public function course_detail($catid,$pro_id)
	{
		
		$actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$days = 3;

		$date_of_expiry = time() + 60 * 60 * 24 * $days ;
		if($actual_link['query']){
			$actual_link['query'] = str_replace('ref=', '', $actual_link['query']);
			// $this->session->set_userdata('referral_code', $actual_link['query']);
			// setcookie("referral_code", $actual_link['query'],$date_of_expiry,'TRUE');
			$cookie = array(
				        'name'   => 'referral_code',
				        'value'  => $actual_link['query'],
				        'expire' => $date_of_expiry, //time in sec
				        // 'domain' => 'myonlineshiksha.com',
				        'path'   => '/',
				        'secure' => true
		    );
		    $this->input->set_cookie($cookie);
		}

		redirect('online-courses/'.$pro_id);
		exit;

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
if(empty($date_enrolled))
{
	if($user_id == $program->author)
	{
		$data = array(
					'userid' => $user_id,
					'order_id' => 0,
					'course_id' => $pro_id,
					'price' => 0,
					'buy_date' => date('Y-m-d H:i:s'),	
					'plan_id' => 0,
					'email_send' => 1
		);
		$this->Crud_model->SaveData('mlms_buy_courses',$data);
		
		$date_enrolled = $this->program_model->datebuynow($pro_id, $user_id);
	}
}
// print_r($date_enrolled);exit;
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

		// breadcrumbs code start here
		$id= $program->catid;
		$con = 'child_id = '.$id;
		for ($i=0; $i < 10; $i++) { 
			$getrecords = $this->Crud_model->demo_records($con);
			if($getrecords->parent_id !=0)
			{
				if($getrecords->child_id == $id)
				{
					$last_Cat = $getrecords->name;
				}else
				{
					$bread_cat[] = $getrecords->name;
					$bread_id[] = $getrecords->child_id;
				}
				$con = 'child_id = '.$getrecords->parent_id;
			}
			else{
				$base = $getrecords->name;
				$base_id = $getrecords->child_id;
				break;
			}
		}
		$programs['last_Cat'] = $last_Cat;
		$programs['bread_cat'] = $bread_cat;
		$programs['bread_id'] = $bread_id;
		$programs['base'] = $base;
		$programs['base_id'] = $base_id;
		// breadcrumbs code ends here

		echo $this->load->view('new_template_design/course_detail', $programs, TRUE);	
		// $this->load->view('new_template_design/footer');
	}
	public function course($course=null,$catid=null)
	{
		// $this->load->view('new_template_design/header');
		
		echo "<script>window.location.href = '".base_url()."category/courses';</script>";exit;
		// redirect('category/courses/');exit;
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
	public function mentors()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/mentors');	
		$this->load->view('new_template_design/footer');
	}
	public function liveclass($class='')
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/liveclass/'.$class);	
		$this->load->view('new_template_design/footer');
	}
	public function termsofuse()
	{
		// echo "<script>window.location.href = '".base_url()."terms-of-use/';</script>";exit;
		$page_id = '12' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;

	  	//$this->template->build(getOverridePath($tmpl,'resourcepages/resourcepage','views'));
	  	echo $this->load->view('new_template_design/terms_app', $data, TRUE);
		//$this->load->view('new_template_design/header');
		//$this->load->view('new_template_design/terms_of_use');	
		//$this->load->view('new_template_design/footer');
	}
	public function partnership()
	{
		// $auth = $this->session->userdata('logged_in');
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

	public function tcs_terms()
	{
		$this->session->set_userdata('page_tab','terms-for-remote-internships');
		$page_id = '18' ;
		$resourcepage=$this->Pagecreator_model->getPageById($page_id);
      	$data['resourcepage'] = $resourcepage;
	  	echo $this->load->view('new_template_design/terms', $data, TRUE);
	}

	public function resellers_terms_of_use()
	{
		$this->session->set_userdata('page_tab','resellers-terms-of-use');
		$page_id = '17' ;
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
		// print_r($contactpage);exit;
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
		echo "<script>window.location.href = '".base_url()."careers/';</script>";
/*		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/career');	
		$this->load->view('new_template_design/footer');*/
	}
	public function careers()
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
	public function partner()
	{
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/partner');	
		$this->load->view('new_template_design/footer');
	}

	public function inauguration_page()
	{
		$this->load->view('onlineshiksha/index');
	}
	
	public function profile($id)
	{
		if(empty($id))
		{
			redirect();exit;
		}
		// $id = $this->input->post('tid');
	 	$sessionarray = $this->session->userdata('logged_in');
	 
	   	$user_id = $id ? $id : $sessionarray['id'];
	   
	   	$name = $sessionarray['first_name'].' '.$sessionarray['last_name'];
		
		
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $configarr[0]['layout_template'];		
		$this->template->set("tmpl", $tmpl);
		$this->template->append_metadata(block_submit_button());
		$this->load->helper('form');
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
		 $this->load->model('Program_model');
		 $this->load->model('Myinfo_model');
	    // $teacher_id = $this->uri->segment(3);
		$tslug = $this->Crud_model->get_single('mlms_users',"slug = '".strtolower($id)."'");
	    $teacher_id = $tslug->id;
	    if(is_numeric($id))
	    {
			$tslug = $this->Crud_model->get_single('mlms_users',"id = '".$id."'");
	    	redirect('teacher-profile/'.$tslug->slug);
	    }
	    if(empty($tslug)){
	    	redirect();
	    }
        $teacher_info = $this->Program_model->getTeacherInfo($teacher_id);
	    $this->template->set("teachingcourses", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    // $this->template->set("teachingcourses1", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    $data['teacher_info'] = $teacher_info;
	    $data['user_id'] = $user_id;
	    $data['name'] = $name;
	    // $data['teachingcourses'] = $this->Myinfo_model->getTeachingCourses($teacher_id);
	    // $data['teachingcourses1'] = $this->Myinfo_model->getTeachingCourses($teacher_id);
		//$this->template->build('programsnew_template_design/profile');
		$get_reviews = $this->customs_model->teacher_rating($teacher_id);
        $count_reviews = $one = $two = $three = $four = $five = $tot_review = 0;
		if (!empty($get_reviews))
        	$count_reviews = count($get_reviews);

        foreach ($get_reviews as $key) {
          $tot_review = $tot_review + $key->review_rate;
          if($key->review_rate == 1){
            $one++;
          }
          if($key->review_rate == 2){
            $two++;
          }
          if($key->review_rate == 3){
            $three++;
          }
          if($key->review_rate == 4){
            $four++;
          }
          if($key->review_rate == 5){
            $five++;
          }
        }

        // get demo data
        $dc = $this->Crud_model->GetData('mlms_program',"id","author = ".$teacher_id." and published = 1 and trash = 0");
        foreach ($dc as $key) {
        	$rating = $this->Crud_model->get_single('demo_data',"course_id = ".$key->id,"ratings");
        	if(!empty($rating)){
	        	$tot_review += floatval($rating->ratings);
	        	$count_reviews++;
	        	if(floatval($rating->ratings) >= 4 && floatval($rating->ratings) < 5){
		        	$four++;
		        }
		        if(floatval($rating->ratings) == 5){
		            $five++;
		        }
		    }
        }
        // demo data ends here
        if($one>0){
          $one = (100/$count_reviews) * $one;
        }
        else{
          $one = 0;
        }
        if($two>0){
          $two = (100/$count_reviews) * $two;
        }
        else{
          $two = 0;
        }
        if($three>0){
          $three = (100/$count_reviews) * $three;
        }
        else{
          $three = 0;
        }
        if($four>0){
          $four = (100/$count_reviews) * $four;
        }
        else{
          $four = 0;
        }
        if($five>0){
          $five = (100/$count_reviews) * $five;
        }
        else{
          $five = 0;
        }
        $rates = $tot_review / $count_reviews;
		$data['one'] = round($one);
		$data['two'] = round($two);
		$data['three'] = round($three);
		$data['four'] = round($four);
		$data['five'] = round($five);
		$data['rates'] = $rates;
		$data['currency_symbol'] = $currency_symbol;
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
		redirect();exit;
	   $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('category_model');
        $this->template->set("tmpl", $tmpl);
	   $this->template->build('category/pagenotfound');
	}

	public function donotpermission()
	{
	   	echo "<script>window.location.href = '".base_url()."donotpermission/';</script>";
	}

	public function donotpermission1()
	{
		$this->load->view('new_template_design/header');
        $this->load->view('category/donotpermission');
        $this->load->view('new_template_design/footer');
	}
	
	public function thank_you()
	{
	   	$this->load->view('new_template_design/header');
        $this->load->view('category/thankyou');
        $this->load->view('new_template_design/footer');
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
		// redirect('category/courses');exit;
		echo "<script>window.location.href = '".base_url()."category/courses/".$cat_id."/';</script>";exit;
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

	function fetch()
	{
		$output = '';
		if($this->input->post('teacher_id') && $this->input->post('teacher_id') != '' && $this->input->post('teacher_id') != '0' && $this->input->post('teacher_id') != null)
		{
			$con = "author = ".$this->input->post('teacher_id');
		}else{
			if($this->input->post('search')){
				$searchCourse = $this->input->post('search');
				$con = "name like '%".$searchCourse."%'";
			}
			else if($this->input->post('popular_Cat'))
			{
				if(!is_numeric($this->input->post('popular_Cat')))
				{	
					$con = "name like '%".$this->input->post('popular_Cat')."%'";
				}else
				{
					$is_parent = $this->Crud_model->get_single('mlms_categoryrel',"parent_id = ".$this->input->post('popular_Cat'));
					if($is_parent)
					{
						$categories = $this->customs_model->getAllcategory111($this->input->post('popular_Cat'));
						$subcat_arr = array();
						$subcat = '';
						$i = 1;
						foreach ($categories as $key) {
							$is_parent1 = $this->Crud_model->get_single('mlms_categoryrel',"parent_id = ".$key->id);
							if($is_parent1)
							{
								$categories1 = $this->customs_model->getAllcategory111($key->id);
								foreach ($categories1 as $key1) {
									array_push($subcat_arr, $key1->id);
								}
							}
							array_push($subcat_arr, $key->id);
						}
						foreach ($subcat_arr as $key) {
							$subcat .= $key;
							if($i < count($subcat_arr))
								$subcat .= ",";
							$i++;
						}
					}
					else{
						$subcat = $this->input->post('popular_Cat');
					}
					
					$con = "catid IN(".$subcat.")";	
				}
			}
			else
			{
				$con = "";
			}
		}
		$total_rows = $this->program_model->getAllProgramCountnew($con);
		$data = $this->program_model->getAllProgramnew($this->input->post('start'),$this->input->post('limit'),$con);
		if (empty($data)){
		// ADDING GOOGLE SEARCH BEHAVIOR
			$name = $this->input->post('search');
			$shuffle = explode(" ",$name);
			if(count($shuffle)==3){
				$tot_array = array
				(
					array(0,1,2),
					array(0,2,1),
					array(1,2,0),
					array(1,0,2),
					array(2,0,1),
					array(2,1,0)
				);
			}
			else if(count($shuffle)==2){
				$tot_array = array
				(
					array(0,1),
					array(1,0)
				);
			}
			if(count($shuffle)!=1 || count($shuffle) <= 3)
			{
				$n1 ="";
				if (empty($data)) {
					for ($i=0; $i < count($tot_array); $i++) { 
						for ($j=0; $j < count($tot_array[$i]); $j++) { 
							$n1 .= $shuffle[$tot_array[$i][$j]];
							if($j != count($tot_array[$i])-1)
								$n1 .=" ";
						}
						// print_r($n1);
						$con = "name like '%".$n1."%'";
						$total_rows = $this->program_model->getAllProgramCountnew($con);
						$data = $this->program_model->getAllProgramnew($this->input->post('start'), $this->input->post('limit'),$con);
						$n1 ="";
						if(!empty($data))
						{
							break;
						}	
					}
				}
			}
// ADDING GOOGLE SEARCH BEHAVIOR
		}
     	$currency = $this->Crud_model->get_single('mlms_config','id = 1',"currency");
        $currencysign = $this->Crud_model->get_single('mlms_currencies',"currency_name = '".$currency->currency."'","sign");
    	if($currencysign)
        {
          	$currency_symbol = $currencysign->sign;
        }
        else
        {
        	$currency_symbol = " "; 
        }
        foreach ($data as $othercourse) { 
          	$teacher_info = $this->Crud_model->get_single('mlms_users',"id = ".$othercourse->author,"first_name,last_name");
          	if($othercourse->image)
          	{
          		$image = $othercourse->image;
          	}
          	else
          	{
          		$image = "no_images_course.png";
          	}
        $output .= '
        <div class="item-item col-md-3 col-sm-4 col-xs-6 res_col no-padding1">
            <a href="'.base_url().'online-courses/'.$othercourse->slug.'">
                <div class="card">
                    <div class="cardhover">
                        <img src="'.base_url().'public/uploads/programs/img/thumb_232_216/'.$image.'" width="100%">';
                       $output .= ' </div>
                    <h5 class="card_heading2">'.$othercourse->name.'</h5>
                    <p class="jonas">'.ucwords($teacher_info->first_name.' '.$teacher_info->last_name).'</p>';
                    $reviews = $this->program_model->getAvgReview($othercourse->id);
					$rcount = floatval($reviews->avg_rate);
					if($rcount == 0)
		            {
		              $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$othercourse->id,"ratings");
		              $rcount = floatval($getextras->ratings);
		            }
                    $output .= '<p class="star">';
                    for ($i=1; $i <=5 ; $i++) { 
                    	$output .= '<i class="fa';
                        if(floatval($i) <= floatval($rcount))
                        	$output .= ' fa-star checked">';
                        else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                        	$output .= ' fa-star-half-full checked">';
                        else if(floatval($i) > floatval($rcount))
                        	$output .= ' fa-star-o checked">';
                        $output .= '</i>';
                    } 
                    $output .= '<span class="small_card">';
                    if($rcount>0) 
                    	$output .= ' ( '.number_format($rcount,1).' ratings )';
                    $output .= '</span>
                    </p>
                    <p class="rupees" align="right">
                        <span class="del_price"> ';
                    if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ $output .= $currency_symbol.' '.$othercourse->demoprice.' '; 
                    }
                    else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { $output .= 'Free ';}
                    else{ $output .= $currency_symbol.' '.$othercourse->fixedrate.' '; 
                	}

                	if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){
                        $output .= '<span class="del_price2">';
                        $output .= $currency_symbol.' '.$othercourse->demoprice;
                        $output .= '</span>';
                    }
                    $output .= '</span>
                        </p>
	                </div>
	            </a>
	        </div>';
	    }
		echo $output;
	}

	//  demo testing for re-routing of course with new url and data sending
	public function course_details($pro_id)
	{
		if(!is_numeric($pro_id))
		{
			$program = $this->Crud_model->get_single('mlms_program',"slug = '".$pro_id."' and published = 1 and trash = 0",'slug,selected_course,author,catid,fixedrate,demoprice,course_type,webstatus,name,level,description,preview,image,is_drip_course,certificate_term,slug,qr_image,learn_points,pre_req,pre_req_books,reqmts,id,is_live_class,is_plans');
			if(empty($program))
			{
				redirect('category/courses');exit;
			}
			else
			{
				$catid = $program->catid;
				$pro_id = $program->id;
			}
		}
		else{
			$program = $this->Crud_model->get_single('mlms_program',"id = ".$pro_id." and published = 1","slug");
			if(empty($program))
			{
				redirect('category/courses');exit;
			}
			else{
				$pro_id = $program->slug;
				redirect('online-courses/'.$pro_id.'');exit;
			}
		}

		$actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$programs['demo_cookie'] = '';
		if(strpos($_SERVER['REQUEST_URI'],'ref')){
			if($actual_link['query']){
				$actual_link['query'] = str_replace('ref=', '', substr($actual_link['query'],0,12));
			    $programs['demo_cookie'] = $actual_link['query'];
			}
		}

		if($this->uri->segment(2)=="course_details")
		{
			redirect($this->uri->segment(3));
		}
		$sessionarray = $this->session->userdata('logged_in');
		$isEnrolled = 0;
		$programs['assigned'] = '';
		$programs['user_id'] = '';
		$programs['getBuyCoursesUser'] = '';
		$programs['block_enrolled'] = '';
		$programs['program_plans'] = '';
		$programs['exp_date'] = '';
		$programs['subscription_plan_id'] = '';
		$programs['subscribed_batch_id'] = '';
	    if(!empty($sessionarray))
		{
		    $user_id = $sessionarray['id'];
		    $group_id = $sessionarray['groupid'];
	    	$programs['assigned'] = $this->program_model->getAssignUser($program->selected_course,$user_id);
			$programs['user_id'] = $user_id;
			$date_enrolled = $this->program_model->datebuynow($pro_id,$user_id);
			if(empty($date_enrolled))
			{
				if($user_id == $program->author)
				{
					$data = array(
								'userid' => $user_id,
								'order_id' => 0,
								'course_id' => $pro_id,
								'price' => 0,
								'buy_date' => date('Y-m-d H:i:s'),	
								'plan_id' => 0,
								'email_send' => 1
					);
					$this->Crud_model->SaveData('mlms_buy_courses',$data);
					
					$date_enrolled = $this->program_model->datebuynow($pro_id, $user_id);
					$isEnrolled =  count($date_enrolled);
				}
			}
			else{
				$programs['getBuyCoursesUser'] = $date_enrolled->plan_id;
				$isEnrolled =  count($date_enrolled);
			}
			$block_enrolled1 = $this->program_model->checkblockenroll($pro_id, $user_id);
			$block_enrolled =count($block_enrolled1);
			$programs['date_enrolled'] = $date_enrolled;
			$programs['exp_date'] = $date_enrolled->expired_date;
			$programs['block_enrolled'] = $block_enrolled;
			
			$getplans = $this->Crud_model->get_single('mlms_buy_courses',"course_id = ".$pro_id." and userid = ".$user_id,'plan_id,batch_id');
			if(!empty($getplans)){
				$programs['subscription_plan_id'] = $getplans->plan_id;
				$programs['subscribed_batch_id'] = $getplans->batch_id;
				if($getplans->plan_id != 0)
				{
					$programs['program_plans'] = $this->Program_model->getProgramRenewalPlans($pro_id);
				}
			}
		}
 		$currency = $this->Crud_model->get_single('mlms_config','id = 1',"currency");
        $currencysign = $this->Crud_model->get_single('mlms_currencies',"currency_name = '".$currency->currency."'","sign");
    	if($currencysign)
        {
          	$currency_symbol = $currencysign->sign;
        }
        else
        {
        	$currency_symbol = " "; 
        }
		if(isset($program->author))
		{
			$teacher_id = (isset($program->author)) ? $program->author : '';
			$teacher_info = $this->program_model->getTeacherInfo($teacher_id);
		}
		else
		{
			$teacher_info = '';
		}
		$programs['days'] = $this->Program_model->getlistDays($pro_id);
		$programs['teacher_info'] = $teacher_info;
		$programs['currency_symbol'] = $currency_symbol;
		$programs['isEnrolled'] = $isEnrolled;
		
		$programs['programs'] = $program;

		// breadcrumbs code start here
		$last_Cat = "";
		$bread_cat = "";
		$bread_id = "";
		$id= $program->catid;
		$con = 'child_id = '.$id;
		for ($i=0; $i < 10; $i++) { 
			$getrecords = $this->Crud_model->demo_records($con);
			
			if($getrecords->parent_id !=0)
			{
				if($getrecords->child_id == $id)
				{
					$last_Cat = $getrecords->name;
				}else
				{
					$bread_cat[] = $getrecords->name;
					$bread_id[] = $getrecords->child_id;
				}
				$con = 'child_id = '.$getrecords->parent_id;
			}
			else{
				$base = $getrecords->name;
				$base_id = $getrecords->child_id;
				break;
			}
		}
		// for live classes and batches
		$batches = '';
		if($program->is_live_class == 1){
			$batches = $this->Crud_model->GetData('mlms_batches','id, batch_from, batch_name, batch_start_time, batch_end_time, enroll_limit',"course_id = ".$pro_id);
		}
		$add_count = $this->Crud_model->get_single('demo_data',"course_id = ".$pro_id);
		$programs['add_count'] = $add_count;
		
		$programs['last_Cat'] = $last_Cat;
		$programs['bread_cat'] = $bread_cat;
		$programs['bread_id'] = $bread_id;
		$programs['base'] = $base;
		$programs['base_id'] = $base_id;
		$programs['pro_id'] = $pro_id;
		$programs['batches'] = $batches;
		// breadcrumbs code ends here
		if(!empty($sessionarray) && $sessionarray['id'] == '1')
		{
			echo $this->load->view('new_template_design/course_detail22', $programs, TRUE);exit;		
		}
		echo $this->load->view('new_template_design/course_detail', $programs, TRUE);		
	}
	// if tested successfully
	public function getcourses()
	{
		$output = '';
		$con = "p.published = 1 AND p.trash = 0 AND p.id != ".$this->input->post('course_id');
		if($this->input->post('techid') && $this->input->post('techid') != '' && $this->input->post('techid') != '0' && $this->input->post('techid') != null)
		{
			$con .= " AND p.author = ".$this->input->post('techid');
			$val = '';
		}
		else
		{
			$con .= " AND r.review_rate > 3";
			$val = 1;
		}
		$data = $this->program_model->getrelatedCourse($this->input->post('start'),$con,$val);
		$data1 = $this->program_model->getrelatedCourseCount($con,$val);

     	$currency = $this->Crud_model->get_single('mlms_config','id = 1',"currency");
        $currencysign = $this->Crud_model->get_single('mlms_currencies',"currency_name = '".$currency->currency."'","sign");
    	if($currencysign)
        {
          	$currency_symbol = $currencysign->sign;
        }
        else
        {
        	$currency_symbol = " "; 
        }
        foreach ($data as $othercourse) { 
        	if($othercourse->image)
          	{
          		$image = $othercourse->image;
          	}
          	else
          	{
          		$image = "no_images_course.png";
          	}
        $output .= '
        <div class="item-item col-md-3 col-sm-4 col-xs-6 res_col no-padding1">
            <a href="'.base_url().'online-courses/'.$othercourse->slug.'">
                <div class="card">
                    <div class="cardhover" style="height:149px; overflow:hidden">
                        <img src="'.base_url().'public/uploads/programs/img/thumb_232_216/'.$image.'" width="100%">';
                       $output .= ' </div>
                    <h5 class="card_heading2">'.$othercourse->name.'</h5>
                    <p class="jonas">'.ucwords($othercourse->first_name.' '.$othercourse->last_name).'</p>';
                    $reviews = $this->program_model->getAvgReview($othercourse->id);
					$rcount = floatval($reviews->avg_rate);
					if($rcount == 0)
		            {
		              $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$othercourse->id,"ratings");
		              $rcount = floatval($getextras->ratings);
		            }
                    $output .= '<p class="star">';
                    for ($i=1; $i <=5 ; $i++) { 
                    	$output .= '<i class="fa';
                        if(floatval($i) <= floatval($rcount))
                        	$output .= ' fa-star checked">';
                        else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                        	$output .= ' fa-star-half-full checked">';
                        else if(floatval($i) > floatval($rcount))
                        	$output .= ' fa-star-o checked">';
                        $output .= '</i>';
                    } 
                    $output .= '<span class="small_card">';
                    if($rcount>0) 
                    	$output .= ' ( '.number_format($rcount,1).' ratings )';
                    $output .= '</span>
                    </p>
                    <p class="rupees" align="right">
                        <span class="del_price"> ';
                    if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ $output .= $currency_symbol.' '.$othercourse->demoprice.' '; 
                    }
                    else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { $output .= 'Free ';}
                    else{ $output .= $currency_symbol.' '.$othercourse->fixedrate.' '; 
                	}

                	if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){
                        $output .= '<span class="del_price2">';
                        $output .= $currency_symbol.' '.$othercourse->demoprice;
                        $output .= '</span>';
                    }
                    $output .= '</span>
                        </p>
	                </div>
	            </a>
	        </div>';
	    }
	    $djson = array('output'=> $output,'totalc'=>$data1);
		echo json_encode($djson);
	}

	public function notify(){
		$this->load->library('email');
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		// admin mail
		$fromemail = 'noreply@myonlineshiksha.com';

		$subject1 = 'Digital Marketing Course Launch';
		// $toemail = 'nikhil.b@veerit.com';
		$toemail = 'info@createonlineacademy.com';
		
		$content = '';
		
		$content .= 'Digital Marketing Course Launching ceremony :<br><br>';
		$content .= 'Name : '.$name.'<br />';
		$content .= 'Email : '.$email.'<br>';
		$content .= 'phone : '.$phone.'<br />';
		// $content .='<br /><br />';
		// $content .='...</p>';
		// $content .= $configarr[0]['signature'].'</p>';
		$data['content'] = $content;
		$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail,'Myonlineshiksha');
		$this->email->to($toemail);
		$this->email->subject($subject1);
		$this->email->message($message1);
		$this->email->send();

		// user mail
		$fromemail = 'noreply@myonlineshiksha.com';

		$subject1 = 'Login Link: Digital Marketing Course Launch Ceremony on MyOnlineShiksha || Thu, 24th Dec || 12:00 afternoon';
		// $toemail = 'nikhil.b@veerit.com';
		$toemail = $email;
		
		$content = '';
		
		$content .= '
<img src="'.base_url().'public/launch/assets/img/ceremony.jpg"><br><br>
		<table style="width: 75%;border: 1px solid black;border-collapse: collapse;font-size: 16px;" cellspacing="0" cellpadding="10">
	<thead>
	<tr><th style="border: 1px solid black;font-weight:bold;" width="30%">Session Title</th>
	<th style="border: 1px solid black;font-weight:bold;" width="30%">Date and Time</th>
	<th style="border: 1px solid black;font-weight:bold;" width="40%">Login URL</th>
	</tr></thead>
	<tbody>
		<tr>
		<td style="border: 1px solid black;font-weight:bold;">Digital Marketing Course Launching Ceremony on MyOnlineShiksha</td>
		<td style="border: 1px solid black;font-weight:bold;">Thursday, 24th Dec 2020<br>
		12:00 PM </td>
		<td style="border: 1px solid black;"><a href="https://zoom.us/j/95152726510?pwd=UmQ1RjZuUG1LQUUxckxBQ2pqcEo5UT09">Click here to join the live event</a></td>
		</tr>
	</tbody>
</table>
<br>
<br>
<p style="color: orange;font-size: 16px;">Instructions to join the webinar:</p>
<p style="font-size: 16px;"><b>Step 1:</b> To get started click  <a href="https://zoom.us/j/95152726510?pwd=UmQ1RjZuUG1LQUUxckxBQ2pqcEo5UT09">Click here to join the meeting</a> <b>Please log in 10 minutes before the webinar start time)</b><br><br>
<b>Step 2:</b> Once the link opens enter your name and join in.<br><br>
<b>For any queries, you can call on:</b>  <span style="color:rgb(31,73,125)">7738331541</span><br><br>
<b>Look forward to see you at the ceremony!  <br><br><br>
Yours Sincerely, <br>
MyOnlineShiksha Team<br><br></b>
</p>';
		
		$data['content'] = $content;
		$message1 = $content;
		// $message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail,'Myonlineshiksha');
		$this->email->to($toemail);
		$this->email->subject($subject1);
		$this->email->message($message1);
		$this->email->send();
	}

	
	public function blog_preview($id = null)
	{
		$blog = $this->Crud_model->get_single('mlms_pagecreater',"page_id = ".$id);
		/*$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->template->set("tmpl", $tmpl);
        $this->template->set("content", $blog->content);
	   	$this->template->build('category/demo_blog');*/

	   	$data = array(
        		'content' => $blog->content
        );
	   	$this->load->view('new_template_design/header');
        $this->load->view('category/demo_blog',$data);
        $this->load->view('new_template_design/footer');	
	}

	public function preview_template(){
	   	/*$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->template->set("tmpl", $tmpl);
        $this->template->set("content", $this->input->post('prev_data'));
        $this->template->set("edpage_id", $this->input->post('pageid'));*/
        if($this->input->post('pageid') == 1){
        	$this->template->set("address", $this->input->post('address'));
        	$this->template->set("phone", $this->input->post('phone'));
        	$this->template->set("email", $this->input->post('email'));
        	$this->template->set("weburl", $this->input->post('weburl'));
        	$this->template->set("mapcode", $this->input->post('mapcode'));
		   	$data = array(
	        		'content' =>$this->input->post('prev_data'),
	        		"edpage_id" => $this->input->post('pageid'),
	        		"address" => $this->input->post('address'),
					"phone" => $this->input->post('phone'),
					"email" => $this->input->post('email'),
					"weburl" => $this->input->post('weburl'),
					"mapcode"  => $this->input->post('mapcode'),
	        );
        }else{
		   	// $this->template->build('category/demo_blog');	
	        $data = array(
	        		'content' =>$this->input->post('prev_data'),
	        		"edpage_id" => $this->input->post('pageid'),
	        );
	    }
        $this->load->view('new_template_design/header');
        $this->load->view('category/demo_blog',$data);
        $this->load->view('new_template_design/footer');
	}

	public function update_page(){
		$edpage_id = $this->input->post('edpage_id');
		$data = array(
				"content" => $this->input->post('preview_html')
		);
		$this->Crud_model->SaveData('mlms_pagecreater',$data,"page_id = ".$edpage_id);
		echo "updated";
	}

	public function live_courses(){
		$this->load->view('new_template_design/header');
        $this->load->view('onlineshiksha/live_courses');
        $this->load->view('new_template_design/footer');
	}



	// vidyakul pages
	public function append_pages($data1,$data,$page){
		$this->load->view('new_template_design/header');
        $this->load->view('vidyakul/'.$page,$data1);
        $this->load->view('new_template_design/footer');
        $this->load->view('vidyakul/payment_process',$data);
	}

	public function vid_9_class_mp(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th mp master batches' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th mp master batches',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-mp-master-batches');
	}

	public function vid_9_class_gujrat(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th gujarat board gujarati medium' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th gujarat board gujarati medium',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-gujarat-board-gujarati-medium');
	}
	
	public function vid_9_class_cbse(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th cbse master batches' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th cbse master batches',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-cbse-master-batches');
	}
	
	public function vid_9_class_bihar(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th bihar master batches' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th bihar master batches',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-bihar-master-batches');
	}
	
	public function vid_9_class_beii_uttarakhand(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii uthrakhand board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii uthrakhand board',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-uthrakhand-board');
	}
	
	public function vid_9_class_beii_up(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii up board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii up board',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-up-board');
	}
	
	public function vid_9_class_beii_rajasthan(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii rajsathan board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii rajsathan board',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-rajsathan-board');
	}
	
	public function vid_9_class_beii_mp(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii mp board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii mp board',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-mp-board');
	}

	public function vid_9_class_beii_cbse(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii cbse' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii cbse',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-cbse');
	}

	public function vid_9_class_beii_bihar(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 9th beii bihar board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 9th beii bihar board',
					'price'			=> 1499,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-9th-beii-bihar-board');
	}

	public function vid_10_class_beii_bihar(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 10th beii bihar board' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 10th beii bihar board',
					'price'			=> 999,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-10th-beii-bihar-board');
	}

	public function vid_10_class_beii_cbse(){
		$auth = $this->session->userdata('logged_in');
		$getorder = '';
		if(!empty($auth))
		{
			$getorder = $this->Crud_model->get_single('mlms_vidyakul_orders',"user_id = ".$auth['id']." and course_name = 'class 10th beii cbse' and status = 'SUCCESS'","id");
		}
		$data = array(
					'course_name'	=> 'class 10th beii cbse',
					'price'			=> 999,
		);
		$data1 = array('getorder' => $getorder);
		$this->append_pages($data1,$data,'class-10th-beii-cbse');
	}

}
?>