<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medias extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
		//$this->authenticate();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('media');
		$this->load->model('medias_model');
		$this->load->model('quizzes_model');
		$this->load->model('admin/programs_model');
		$this->load->model('program_model');
		$this->load->model('admin/settings_model');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
		$this->lang->load('tooltip', 'english');


		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		
		
	}

	/*function authenticate()
    {
		$session = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in'))
		{
		redirect('users/login');
		}
    }*/
	
	public function getVimeoInfo($vimeo)
	{
		$url = parse_url($vimeo);
		if($url['host'] !== 'vimeo.com' && $url['host'] !== 'www.vimeo.com')
			return false;
		if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $vimeo, $match)) 
		{
			$id = $match[1];
		}
		else
		{
			$id = substr($link,10,strlen($link));
		}

		if (!function_exists('curl_init')) die('CURL is not installed!');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = unserialize(curl_exec($ch));
		$output = $output[0];
		curl_close($ch);
		return $output['id'];
	}
	
	public function addcourse()
	{				
	   $parent_id = NULL;
	   
	   $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
       $this->template->title('Courses List');
       $sess_programs = $this->session->userdata('sess_programs');
       if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_programs');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_programs['searchterm'];
       $search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_programs['searchstatus'];
       $search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_programs['searchtcate'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchstatus" => $search_status,
				 "searchtcate" => $search_cate
				 );
	   $this->session->set_userdata('sess_programs', $searchdata);
       }
       $path=base_url() . "programs/addcourse/";

       $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
       $baseurl = base_url() . "programs/addcourse/";
       $this->load->library('pagination');
       //$config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->programs_model->getprogramcount($search_string,$search_status,$search_cate);
       $this->template->title('Courses List');
       $this->pagination->initialize($config);
       $this->template->set("programs", $this->programs_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$user_id));
       $this->template->set('categories',$this->programs_model->getcategories());
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/addcourse');
	}
	

	
	public function copy()
	{
	  $u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($maccessarr['media'] == 'modify_all') || ($maccessarr['media']=='own'))
		{
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CbMedia', 'CbMedia', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('medias/copy');
		}
		else
		{		
			$media_id = $this->input->post('CbMedia');
			$select_media = $this->medias_model->getMediaCopy($media_id);
			
			$data = array(
				'name' => $select_media->name.' '.'Copy',
				'instructions' => $select_media->instructions,
				'type' => $select_media->type,
				'source' => $select_media->source,
				
				'uploaded' => $select_media->uploaded,
				'code' => $select_media->code,
				'url' => $select_media->url,
				'local' => $select_media->local,
				
				'width' => $select_media->width,
				'height' => $select_media->height,
				'published' => $select_media->published,
				'option_video_size' => $select_media->option_video_size,
				
				'category_id' => $select_media->category_id,
				'auto_play' => $select_media->auto_play,
				'show_instruction' => $select_media->show_instruction,				
				'created_by' => $select_media->created_by
			);
			
			$this->medias_model->insertItems($data);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			//$this->template->build('admin/quizzes/list');
			// redirect('medias');
			redirect('course-media/manage');
		}
	  }
      else 
		{
		   //$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_create_success') ));
			//$this->template->build('admin/quizzes/list');
			redirect('category/pagenotfound');
		}
	}

	public function ajaxmediaview($media_id = NULL) 
	{
		$sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
	error_reporting(0);
	$media_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : '' ;
	//echo '<br>';
   	$frame_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
	
	$media = $this->medias_model->getItems1_New($media_id,$user_id,$perpage,$start,$search_term,$search_cat,$search_type);	
	
	// echo"<pre>";
	// print_r($media);
	?>
		<div id="movieframe<?php echo $frame_id;?>">
		<?php
		if($media->type == "docs"){
		if($media->local)
		 {
           
			$pdffile = base_url().'public/uploads/documents/'.$media->local;
		 }
		 else
		 {
		 	$pdffile = $media->url;
		 }

			echo '<div style="max-width:930px; max-height:900px; overflow:scroll;align:center">'; // 

			//echo '<iframe src="http://docs.google.com/gview?url='.$pdffile.'" frameborder="0"></iframe>';

			//echo read_file('public/uploads/documents/'.$media->local);

			//echo file_get_contents(base_url().'public/uploads/documents/'.$media->local);

			//New code start by sachin
			//echo '<a href="'.base_url().'public/uploads/documents/'.$media->local.'" target="_blank">'.base_url().'public/uploads/documents/'.$media->local."</a><br>The selected element is a text file that can't have a preview";
			//echo"<object data='".base_url()."public/uploads/documents/".$media->local."' type='application/vnd.ms-word.document.macroEnabled.12' width='1000px' height='500px'></object>";
			echo"<iframe src=http://docs.google.com/viewer?url=".$pdffile."&embedded=true width='400px' height='300px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
			//new code end 
		 
		 
		 exit;
		}elseif($media->type == "url"){
		echo $media->url;
		exit;
		}elseif($media->type == "text"){
		echo $media->code;
		exit;
		}elseif($media->type == "file"){
		echo "This file can't have a preview";
		exit;
		}elseif($media->type == "image"){
		echo "<img align=\"center\" style=\"width: 400px;\" src=\"".base_url()."public/uploads/images/".$media->local."\">";
		exit;
		}else{?>
				<?php
				if($media->mtype == 'url'){
				?>
					<?php if(preg_match('/http:\/\/(www\.)*vimeo\.com\/.*/',$media->url)){
					$vimeoid = $this->getVimeoInfo($media->url);
					$this->callvimeoplayer($vimeoid,100,100);
					}else{
					$this->calljwplayer($media->url,'url',$media->type,$frame_id);
					}
				}elseif($media->mtype == 'local' || $media->type == "Video"){

					if($media->mtype == "local" && $media->type == 'video')
					{
						?>
						<video width="400" height="300" controls>
 						 <source src="<?php echo base_url()."public/uploads/videos/".$media->media_title;?>" type="video/mp4">
  						<source src="movie.ogg" type="video/ogg">  
						</video> 
					<?php
					}
					else if($media->type == "Video")
					{
						?>
						<video width="400" height="300" controls>
 						 <source src="<?php echo base_url()."public/uploads/videos/".$media->media_title;?>" type="video/mp4">
  						<source src="movie.ogg" type="video/ogg">  
						</video> 
						<?php
					}
					else
					{
				     $this->calljwplayer($media->local,'local',$media->type,$frame_id);
				   	}
				?>
				<?php }elseif($media->mtype == 'code'){    //changes by sachin add only elseif condition
					echo $media->url;
				}
				?>
		</div>
		<?php
		}
   }

public function ajaxmediaview_new($media_id = NULL){
		
	// error_reporting(0);
	// $media_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
 //    $frame_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '' ;
	// $media = $this->medias_model->getItems($media_id);	
   
   $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
	error_reporting(0);
	$media_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : '' ;
	//echo '<br>';
   	$frame_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
	
	$media = $this->medias_model->getItems1_New($media_id,$user_id,$perpage,$start,$search_term,$search_cat,$search_type);	
	
    // echo"<pre>";
    // print_r($media);
	?>
		<div id="movieframe<?php echo $frame_id;?>">
		<?php
  if($media->type == "Document")
  {  

                
    $media->code='<div class="contentpane">
    <iframe src="http://docs.google.com/viewer?url='.base_url().'public/uploads/documents/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
   
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  }
 else if($media->type == "Image")
 {         
                   
$media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/images/'.$media->media_title.'" width="100%"/>';
echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

 } 
 else if($media->type == "docs")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/documents/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
  else if($media->type == "file")
  {  
   
    $filename = $media->media_title;
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   
   if($ext=="pdf" || $ext=="docx")
   {       
   $media->code='<div class="contentpane">
   <iframe src="http://docs.google.com/viewer?url='.base_url().'/public/uploads/files/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
  
  </div>';
   echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
    }
    else if($ext=="jpg" || $ext=="png") 
    {
       $media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/files/'.$media->media_title.'" width="100%"/>';
     echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

    }
            
  } 
 else if(strtolower($media->type) == "video")
  {                      
     if(($media->mtype)== "local")
     { 

		     $media->code='<div class="contentpane">                     
		   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');

     } 
     else if (($media->mtype)== "url") { 
              $vedio_url = str_replace("watch?v=","embed/",$media->url);
			  $vedio_url = str_replace("youtu.be","www.youtube.com/embed/",$vedio_url);         
		     $media->code='<div class="contentpane">                     
		   <iframe src="'.$vedio_url.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		   //echo $vedio_url;
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');

    }  
     else if (($media->mtype)== "code"){
           	echo stripslashes($media->url.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
      }  

      else{

        	$media->code='<div class="contentpane">                     
		   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
      }                       
  }

  else if($media->type == "Audio")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
  else if($media->type == "Flash")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
 
            
  else{
   
  }
				?>
		</div>
		<?php
		//}
   }


   		public function ajaxmediaview_Preview($media_id = NULL) 
	{
		$sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
	error_reporting(0);
	$media_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : '' ;
	//echo '<br>';
   	$frame_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
	
	$media = $this->medias_model->getItems1_New($media_id,$user_id,$perpage,$start,$search_term,$search_cat,$search_type);	
	
	//echo"<pre>";
	//print_r($media);
	?>
		<div id="movieframe<?php echo $frame_id;?>">
		<?php
		if($media->type == "docs"){
		if($media->local)
		 {
           
			$pdffile = base_url().'public/uploads/documents/'.$media->local;
		 }
		 else
		 {
		 	$pdffile = $media->url;
		 }

			echo '<div style="max-width:930px; max-height:900px; overflow:scroll;align:center">'; // 

			//echo '<iframe src="http://docs.google.com/gview?url='.$pdffile.'" frameborder="0"></iframe>';

			//echo read_file('public/uploads/documents/'.$media->local);

			//echo file_get_contents(base_url().'public/uploads/documents/'.$media->local);

			//New code start by sachin
			//echo '<a href="'.base_url().'public/uploads/documents/'.$media->local.'" target="_blank">'.base_url().'public/uploads/documents/'.$media->local."</a><br>The selected element is a text file that can't have a preview";
			//echo"<object data='".base_url()."public/uploads/documents/".$media->local."' type='application/vnd.ms-word.document.macroEnabled.12' width='1000px' height='500px'></object>";
			echo"<iframe src=http://docs.google.com/viewer?url=".$pdffile."&embedded=true width='400px' height='300px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
			//new code end 
		 
		 
		 exit;
		}elseif($media->type == "url"){
		echo $media->url;
		exit;
		}elseif($media->type == "text"){
		echo $media->code;
		exit;
		}elseif($media->type == "file"){
		echo "This file can't have a preview";
		exit;
		}elseif($media->type == "image"){
		echo "<img align=\"center\" style=\"width: 400px;\" src=\"".base_url()."public/uploads/images/".$media->local."\">";
		exit;
		}else{?>
				<?php
				if($media->mtype == 'url'){
				?>
					<?php 
					// if(preg_match('/http:\/\/(www\.)*vimeo\.com\/.*/',$media->url)){
					// $vimeoid = $this->getVimeoInfo($media->url);
					// $this->callvimeoplayer($vimeoid,100,100);
					// }else{
					// $this->calljwplayer($media->url,'url',$media->type,$frame_id);
					// }
					       //  $abc="https://www.youtube.com/watch?v=Vd4iNPuRlx4";
					  $urlpath =  str_replace("watch?v=","embed/", $media->url);
					  $urlpath =  str_replace("youtu.be","www.youtube.com/embed", $urlpath);
					 
					echo"<iframe src=".$urlpath." width='540px' height='270px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
				}elseif($media->mtype == 'local' || $media->type == 'Video'){

					if($media->mtype == "local" && $media->type == 'video')
					{

						echo"<iframe src=".base_url()."public/uploads/videos/".$media->media_title." width='540px' height='270px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
						?>
						<!-- <video width="400" height="300" controls>
 						 <source src="<?php echo base_url()."public/uploads/videos/".$media->media_title;?>" type="video/mp4">
  						<source src="movie.ogg" type="video/ogg">  
						</video>  -->
					<?php
					}
					else if($media->type == 'Video')
					{
						echo"<iframe src=".base_url()."public/uploads/videos/".$media->media_title." width='540px' height='270px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
					}
					else
					{
				     $this->calljwplayer($media->local,'local',$media->type,$frame_id);
				   	}
				?>
				<?php }elseif($media->mtype == 'code'){    //changes by sachin add only elseif condition
					echo "<div id='codediv'>".$media->url."</div>";
				}
				?>
		</div>
		<?php
		}
   }


	public function callvimeoplayer($vimeoid,$width,$height)
	{
	?>
	<object width="<?php echo $width;?>%" height="<?php echo $height;?>%">
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
					<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />
					<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"
						type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" width="<?php echo $width;?>%" height="<?php echo $height;?>%"></embed>
	</object>
	<?php
	}
	
	function calljwplayer($jwurl,$source,$type,$frame_id)

	{

	  //echo $frame_id;

   /*   echo $jwurl;

      echo "<br />";

      echo $source;

      echo "<br />";

      echo $type;

      echo "<br />";

      echo $frame_id;

      echo "<br />";    */



      //echo base_url()."public/uploads/videos/".$jwurl;



	?>

	<script type="text/javascript" src="<?php echo base_url();?>public/jwplayer/vimeojwplayer.js"></script>



				<div id="mediaspace<?php echo $frame_id;?>" style='width:640px;height:480px;'></div>

					<script type='text/javascript'>

						jwplayer('mediaspace<?php echo $frame_id;?>').setup({

							flashplayer: '<?php echo base_url();?>public/jwplayer/player.swf',

							<?php if($source == "local" && $type == 'audio'){?>

							file: '<?php echo base_url()."public/uploads/audio/".$jwurl;?>',

                            <?php } elseif($source == "local" && $type == 'video'){ ?>

                        	file: '<?php echo base_url()."public/uploads/videos/".$jwurl;?>',

                            <?php }else{ ?>

							file: '<?php echo $jwurl;?>',

							<?php }?>

							controlbar: 'bottom',

                            primary: "flash",
							
							autostart: false,
							
							skin: "bekle",

							width: '400',

							height: '300'

						});

					</script>



	<?php

	}

	public function calljwplayer1($jwurl,$source,$type,$frame_id)
	{
        if($type == 'video'){
          $vtype = 'videos';
        }
        if($type == 'audio'){
          $vtype = 'audio';
        }

	?>
   <!--	<script type="text/javascript" src="<?php echo base_url();?>public/jwplayer/vimeojwplayer.js"></script>  --><script src="<?php echo base_url();?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://player.longtailvideo.com/jwplayer.js"></script>

				<div id="mediaspace<?php echo $frame_id;?>" style='width:640px;height:480px;'></div>
                  <script type='text/javascript'>
						jwplayer('mediaspace<?php echo $frame_id;?>').setup({
							'flashplayer': '<?php echo base_url();?>public/jwplayer/player.swf',
                            'file': '<?php echo base_url()."public/uploads/".$vtype."/".$jwurl;?>',
							'controlbar': 'bottom',
							'width': '400',
							'height': '300',
                            'events': {
                               //onPlay: function() { alert("Player is playing"); }
                            }
						});

					</script>

	<?php
	}

	public function index($parent_id = NULL)
	{	  
	    $u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(!empty($maccessarr['media']))
		{
		if(($maccessarr['media'] == 'view_all') || ($maccessarr['media']=='own') || ($maccessarr['media']=='modify_all'))
	    {
        $this->session->unset_userdata('sess_media');
	    //$this->template->set_layout('backend');
	  	$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		// $this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		// $this->template->set("tmpl", $tmpl);
	    $data['tmpl'] = $tmpl;
	    $parent_id = NULL;
        $sess_media = $this->session->userdata('sess_media');


      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_media');
      $search_string = '';
      $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_media['searchterm'];
       $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_media['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_media['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_media', $searchdata);
        }

		$sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
		
       $path=base_url() . "medias/index";
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "medias/index";
       $this->load->library('pagination');
	   $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $term = NULL;
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type,$user_id);
      
       
    //    $this->pagination->initialize($config);
    //    $this->template->title('Media List');
    //    $this->template->set("search_string", $search_string);
    //    $this->template->set("medias", $this->medias_model->getItemsNew($parent_id, $user_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   // $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   // $this->template->set('mediatype',$this->medias_model->getMediaType());
	   // $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   // $this->template->build('medias/list');
	   $data['title'] = 'Media List';
	   $data['search_string'] = $search_string;
	   $data['medias'] = $this->medias_model->getItemsNew($parent_id, $user_id,$config['per_page'],$start,$search_string,$search_cat,$search_type);
	   $data['categories'] = $this->medias_model->get_formatted_combo($parent_id);
	   $data['mediatype'] = $this->medias_model->getMediaType();

	   $this->load->view('new_template_design/header', TRUE);
     $this->load->view('medias/list', $data);
     $this->load->view('new_template_design/footer');

	  }
	  else
	  {
	     //$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to Copy any course' ));
		
			redirect('category/pagenotfound');
	  }

	   }
	  else
	  {
	     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission' ));
		
			redirect('category/donotpermission');
	  }
	}
	
	//Function to Edit Questions
	function editque($queid = false ,$qid = false)
	{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
		//Rules for validation
		$this->_set_rules('edit');
		//get the parent id and sanitize
		$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
		$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;

		//get the $queid and sanitize
		$queid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('queid', TRUE);
		$queid = ($queid != 0) ? filter_var($queid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$queid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
		   	redirect('days/'.$qid);
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Lesson");
		$this->template->set('question', $this->quizzes_model->getQuestion($queid));
		$this->template->set('updType', 'edit');
		$this->template->set('qid',$qid);
		$this->template->set('queid',$queid);

		$this->form_validation->set_rules('text', 'text', 'required');
        //$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('category_id', 'category_id', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('medias/createque');
		}
		else
		{
			$icarray = array();
			for($ic=1;$ic<=10;$ic++){
				if($this->input->post($ic.'a')){
				$icarray[] = $ic.'a';
				}
			}
			$icstring = implode('|||',$icarray);

			$form_data = array(
				'qid' => ($qid != NULL) ? filter_var($qid, FILTER_VALIDATE_INT) : 0,
				'text' => $this->input->post('text'),
				'a1' => $this->input->post('a1'),
				'a2' => $this->input->post('a2'),
				'a3' => $this->input->post('a3'),
				'a4' => $this->input->post('a4'),
				'a5' => $this->input->post('a5'),
				'a6' => $this->input->post('a6'),
				'a7' => $this->input->post('a7'),
				'a8' => $this->input->post('a8'),
				'a9' => $this->input->post('a9'),
				'a10' => $this->input->post('a10'),
				'answers' => $icstring,
				'published' => $this->input->post('published'),
				'reorder' => $this->quizzes_model->quemaxorder($qid)
			);
			$isupdated=$this->quizzes_model->updateQuestion($queid,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') )); ?>
                <?php if($qid){ ?>
				<script type="text/javascript">
            	//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/quizzes/edit/<?php echo $qid?>";
				</script>
				<?php //redirect('quizzes/edit/'.$qid);
				}else{ ?>
				<script type="text/javascript">
            	//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/quizzes/create/";
				</script>
				<?php
        		//redirect('quizzes/create');
				}
			}
			else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				if($qid){
				redirect('quizzes/edit/'.$qid);
				}else{
				redirect('quizzes/create');
				}
			}
	  	}
	}

	
	//Function to Add Questions
	function createque($qid = false)
	{
		$this->template->append_metadata(block_submit_button());

		$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
	   	$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;

		$queid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('queid', TRUE);
		$queid = ($queid != 0) ? filter_var($queid, FILTER_VALIDATE_INT) : NULL;

		$this->template->set('title', 'Create Question');//lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('qid',$qid);
		$this->template->set('queid',$queid);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'text', 'required');
		//$this->form_validation->set_rules('a1', 'a1', 'required');
		//$this->form_validation->set_rules('1a', '1a', 'required');
		if ($this->form_validation->run() === false)
		{
			$this->template->build('medias/createque');
		}
		else
		{
		$icarray = array();
		for($ic=1;$ic<=10;$ic++){
			if($this->input->post($ic.'a')){
			$icarray[] = $ic.'a';
			}
		}
		$icstring = implode('|||',$icarray);
			$data = array(
				'qid' => ($qid != NULL) ? filter_var($qid, FILTER_VALIDATE_INT) : 0,
				'text' => $this->input->post('text'),
				'a1' => $this->input->post('a1'),
				'a2' => $this->input->post('a2'),
				'a3' => $this->input->post('a3'),
				'a4' => $this->input->post('a4'),
				'a5' => $this->input->post('a5'),
				'a6' => $this->input->post('a6'),
				'a7' => $this->input->post('a7'),
				'a8' => $this->input->post('a8'),
				'a9' => $this->input->post('a9'),
				'a10' => $this->input->post('a10'),
				'answers' => $icstring,
				'published' => $this->input->post('published'),
				'reorder' => $this->quizzes_model->quemaxorder($qid)
			);

			if($this->quizzes_model->insertQuestion($data))
			{
				//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') )); ?>
				<?php if($qid)
				{ 
					?>
					<script type="text/javascript">
					//parent.jQuery.fancybox.close();
					window.parent.location.href = "<?php echo base_url(); ?>/quizzes/edit/<?php echo $qid?>";
					</script>
					<?php 
				}
				else
				{
					?>
					<script type="text/javascript">
					//parent.jQuery.fancybox.close();
					window.parent.location.href = "<?php echo base_url(); ?>/quizzes/create/";
					</script><?php
					//redirect('quizzes/create');
				}
			}
		}
	}


	function checkname()
	{		

		if($this->medias_model->getMediaName($_POST['name']))
		{
			echo 'success';
		}

		else
		{
			echo 'fail';
		}
	}

	function checknamedit()
	{
		$iid =$this->uri->segment(3);
		
		$nm = $this->medias_model->getMediaNamefromid($iid);

		//echo $nm->alt_title;
		  $nm1 = $this->medias_model->getMediaName($_POST['name']);

		if($this->medias_model->getMediaName($_POST['name']))		
		{
			//echo $nm->alt_title."==".$nm1->alt_title;
			if($nm->alt_title == $nm1->alt_title)
			{
				echo 'fail';
			}
			else
			{
				echo 'success';
			}
			
		}
		else
		{
			echo 'fail';
		}
	}

   public function ajaxaddmedia($medlay = NULL,$medid = NULL)
	{
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  
	  $maccessarr = $this->session->userdata('maccessarr');
	  
	  
	  
	  $this->session->unset_userdata('sess_ajaxmedia');
	  echo $parent_id = NULL;
      $medlay = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $medlay;
      $medid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medid;
      $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
      $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
       $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_ajaxmedia['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }

       $path=base_url() . "medias/ajaxaddmedia/".$medlay."/".$medid;

       $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $baseurl = base_url() . "medias/ajaxaddmedia/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term = "type != 'text' and type != 'docs'";      
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 5;
       
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type,$user_id);
     $this->pagination->initialize($config);
       $this->template->title('Media List');
	   //	if($parent_id){
      //$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   //	}else{
	   //	$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$config['uri_segment']));
        

	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type,$user_id,$maccessarr['course media']));
      
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmedia');
	}
    //Add module media
    public function ajaxaddmodulemedia($medlay = NULL,$medid = NULL)
	{
	  $this->session->unset_userdata('sess_ajaxmedia');
	  $maccessarr=$this->session->userdata('maccessarr');	
	  
	  $parent_id = NULL;
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
      $medlay = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $medlay;
      $medid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medid;
      $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
      $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
       $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_ajaxmedia['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
       $path=base_url() . "medias/ajaxaddmodulemedia/".$medlay."/".$medid;
      $config["base_url"] = base_url() . "medias/ajaxaddmedia/".$medlay."/".$medid;
      // $this->load->library('pagination');
       $term = "type != 'text'";
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type,$user_id);
       //$config["base_url"] = $baseurl;
       $config['per_page'] =10;
       $config['enable_query_strings'] = true;
        $config['uri_segment'] = 5;
       $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $this->pagination->initialize($config);
       $this->template->title('Media List');
	   //	if($parent_id){
      //$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   //	}else{
	   //	$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$config['uri_segment']));
       

	   $this->template->set("medias", $this->medias_model->getajaxMedia_New($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type,$user_id,$maccessarr['course media']));

	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmodulemedia');
	}
	


	public function ajaxaddmedia_org($medlay = NULL,$medid = NULL)
	{

	   $parent_id = NULL;
       $this->load->library('pagination');
       $config["base_url"] = base_url() . "medias/ajaxaddmedia_org/".$medlay."/".$medid;
       $config['total_rows'] = $this->medias_model->getmediacount();

       //$config['total_rows'] = 8;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
       $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
       $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

	  // if($parent_id){
	   $this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //else{
	   //	$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$config['uri_segment']));
	   $term ="type != 'text'";
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start));
      //  }
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmedia');
	}

    public function ajaxaddmediatext($medlay = NULL,$medid = NULL)
	{
      $this->session->unset_userdata('sess_ajaxmedia');
      $parent_id = NULL;
	  
	  $maccessarr = $this->session->userdata('maccessarr');
	 
	  
	   $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
      $medlay = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $medlay;
      $medid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medid;
      $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
      $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
       $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_ajaxmedia['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
       $path=base_url() . "medias/ajaxaddmediatext/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "medias/ajaxaddmediatext/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term ="type = 'text' or type = 'docs'";
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type,$user_id);
      // $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 5;
       $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		//if($parent_id){
	   //$this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //	}else{

        //$term = "type != 'text'";
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type,$user_id,$maccessarr['course media']));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmediatext');
	}
	
    public function ajaxaddmodulemediatext($medlay = NULL,$medid = NULL)
	{
	  $sessionarray = $this->session->userdata('logged_in');	
	  $maccessarr=$this->session->userdata('maccessarr');	
	 
	  $user_id = $sessionarray['id'];
      $this->session->unset_userdata('sess_ajaxmedia');
      $parent_id = NULL;
      $medlay = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $medlay;
      $medid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medid;
      $start = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
      $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
       $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_ajaxmedia['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
       $path=base_url() . "medias/ajaxaddmodulemedia/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "medias/ajaxaddmodulemedia/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term ="type = 'text'";
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type,$user_id);
      // $config["base_url"] = $baseurl;
       $config['per_page'] = 4;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		//if($parent_id){
	   //$this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //	}else{

        //$term = "type != 'text'";
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type,$user_id,$maccessarr['course media']));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmodulemediatext');
	}

     public function addmedia($medlay = NULL,$medid = NULL)
	{
		// if($_POST){
		// 	print_r($_POST);
		// 	exit('anisha');
		// }

		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');		
		
		//echo $maccessarr['course media'];
		error_reporting(0);
		$sessionarray = $this->session->userdata('logged_in');		
		
	    $user_id = $sessionarray['id'];
		
		$parent_id = NULL;
		//$medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
		// $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
		// $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
		// $pid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;
		$sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
		if($this->input->post('reset') == 'Reset')
		{
			$search_string = $this->input->post('search_text', TRUE);
			$search_type = $this->input->post('type', TRUE);
			$this->session->unset_userdata('sess_ajaxmedia');
			$search_string = '';
			$search_type = '';
		}else
		{
		$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
		$search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
		$searchdata = array(
				 "searchterm" => $search_string,
				 "searchtype" => $search_type
				 );
		$this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
		$path=base_url() . "medias/addmedia/";
		$config["base_url"] = base_url() . "medias/addmedia/";
		$this->load->library('pagination');
		$term ="type = 'text'";

		// $config["base_url"] = $baseurl;
       $config['per_page'] = 4;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		//if($parent_id){
	   //$this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //	}else{

        //$term = "type != 'text'";
	  // $this->template->set("medias", $this->medias_model->getMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_type));
	   $this->template->set("medias", $this->medias_model->getMediaNew($parent_id,$search_string,$search_type,$user_id,$maccessarr['course media']));
     
	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	 //  $this->template->set('pid',$pid);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   
	   $this->template->build('medias/addmedia');
	}

    public function addmedia_org($medlay = NULL,$medid = NULL)
	{
       $parent_id = NULL;
      $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
      $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
      $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
    //  $search_cat = $this->input->post('catid', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
     // $search_cat = '';
      $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];
      // $search_cat = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_ajaxmedia['searchcat'];
       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
			   	 //"searchcat" => $search_cat,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
       $path=base_url() . "medias/ajaxaddmedia/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "medias/ajaxaddmedia/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term ="type = 'text'";
       //$config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
      // $config["base_url"] = $baseurl;
       $config['per_page'] = 4;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		//if($parent_id){
	   //$this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //	}else{

        //$term = "type != 'text'";
	  // $this->template->set("medias", $this->medias_model->getMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_type));
	   $this->template->set("medias", $this->medias_model->getMedia($parent_id,$search_string,$search_type));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/addmedia');
	}


	public function ajaxaddmediatext_ORG($medlay = NULL,$medid = NULL)
	{
	   $parent_id = NULL;
       $this->load->library('pagination');
       $config["base_url"] = base_url() . "ajaxaddmedia/".$medlay."/".$medid;
       $config['total_rows'] = $this->medias_model->getmediacount();
       //$config['total_rows'] = 8;
       $config['per_page'] = 4;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $$medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
       $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
       $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		if($parent_id){
	   $this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
		}else{
		$term ="type = 'text'";
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start));
		}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('medias/ajaxaddmediatext');
	}
	
	function create($parent_id = FALSE)
	{
	  
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');

		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];		
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	    $this->template->title("Create Media");
		$this->template->set('title', 'Create Media');
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);		
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		

		$this->load->helper('form');
		$this->load->library('form_validation');		
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
				
		
		//$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');		
		$this->form_validation->set_rules('category_id', 'category', 'required');

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{

		    $this->template->build('medias/create');
						
		}
		else
		{   
			$mediastype ="";
        error_reporting(0);
        $type = 'file';//$this->input->post('type');
			switch ($type):
			case 'video':

				if($_FILES['file_v']['name'])
						{
							$video_param  = $this->upload_file_v();

							if($video_param['filename'])
							{
								$filenamebytype = $video_param['filename'];
							}
							else {
								$filenamebytype = $this->input->post('localfile_v');
							}
						}
						 if($video_param['status'] == 'error')
						   {
								$this->template->set('upload_error',  $video_param['msg']);
								
								$this->template->build('medias/create');
								return FALSE;
						   }
						   else
						    {
					
							}
					$mediastype ="Video";
				break;
			case 'audio':
			if($_FILES['file_a']['name'])
						{
							$audio_param  = $this->upload_file_a();
							if($audio_param['filename'])
							{
								$filenamebytype = $audio_param['filename'];
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_a');
							}
						}
						if($audio_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $audio_param['msg']);

							
							$this->template->build('medias/create');
							return FALSE;
					   }
					   else
						  {
					     }
					 $mediastype ="Audio";
				break;
            case 'docs':
            if($_FILES['file_d']['name'])
						{
							$doc_param = $this->upload_file_d();
							if($doc_param['filename'])
							{
								$filenamebytype = $doc_param['filename'];
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_d');
							}

						}
						if($doc_param['status'] == 'error')
						{
							$this->template->set('upload_error',$doc_param['msg']);
							$this->template->build('medias/createsectiontext');
							return FALSE;
						}
						else {
           					 }
           			$mediastype ="Document";
				break;            
			case 'file':

				if($_FILES['file_f']['name'])
					{
						$file_param = $this->upload_file_f();

						if($file_param['filename'])
							{
								$filenamebytype = $file_param['filename']; 
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_f');
							}
					}
					
				
					if($file_param['status'] == 'error')
					{
						  
						$this->template->set('upload_error',$file_param['msg']);
						$this->template->build('medias/createsectiontext');
						return FALSE;
					}
					else {
                
						}
					$mediastype ="Flash";	
				break;
            case 'image':

            if($_FILES['file_i']['name'])
						{
							$image_param  = $this->upload_file_i();

							if($image_param['filename'])
							{
								$filenamebytype = $image_param['filename'];
							}
							else {
								$filenamebytype = 'no_images.jpg';
							} 
						}
						if($image_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $image_param['msg']);

							//load the view and the layout
							$this->template->build('medias/createsectionmedia');

							return FALSE;
					   }
					   else{ 

				
					   }
					   $mediastype ="Image";
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		// $data = array(
		// 	'type' => $this->input->post('type'),
		// 	'name' => $this->input->post('name'),
		// 	'category_id' => $this->input->post('category_id'),
		// 	'published' => $this->input->post('published'),
		// 	'instructions' => $this->input->post('instructions'),
		// 	'source' => $sourcebytype,
		// 	'uploaded' => $this->input->post('uploaded'),
		// 	'code' => $codebytype,
		// 	'url' => $urlbytype,
		// 	'local' => $filenamebytype,
  //           'width' => $widthbytype,
		// 	'height' => $heightbytype,			
		// 	'option_video_size' => $this->input->post('option_video_size'),
		// 	'auto_play' => $this->input->post('autoplay'),
  //           'created_by' => $user_id,
		// 	'show_instruction' => $this->input->post('show_instruction'),

		// );

			$data = array(
			'media_title' => $filenamebytype,
			'alt_title' => $this->input->post('name'),
			'type' => 'file',//$mediastype,			
			'category_id' => $this->input->post('category_id'),
			'publish' => '1',//$this->input->post('published'),
			'created_by' => $user_id,
		);
		
				 $inserted_id = $this->medias_model->insertItemsNew($data);
				
			if($inserted_id){
				//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);			
				
				// redirect('medias/'.$parent_id);
				redirect('course-media/manage');
			}
		}
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}

	function createexercisefile1()
    {    
    	
    	$insertid = 0;
    	$newfilename =0;	 
    	$media_type = $_POST['file_f'];
    	
		$output_dir = FCPATH."public/uploads/files/";
		$whitelist = array('jpeg', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'txt', 'jpg', 'png', 'gif', 'bmp');

					$name      = null;
					$error     = 'No file uploaded.';

					if(isset($_FILES)) 
					{
						if(isset($_FILES['file_f'])) {
							$tmp_name = $_FILES['file_f']['tmp_name'];
							$name     = basename($_FILES['file_f']['name']);
							$newfilename = basename($_FILES['file_f']['name']);
							$error    = $_FILES['file_f']['error'];
						    $file_type = $_FILES['file_f']['type'];
						    $file_size = $_FILES['file_f']['size'];

							if ($error === UPLOAD_ERR_OK) {
								$extension = pathinfo($name, PATHINFO_EXTENSION);

								if (!in_array($extension, $whitelist)) 
								 {
									$error = 'Invalid file type uploaded.';
								 }
								 else if($file_size == 104857600)
								 {	
								 	$error = 'Invalid file size uploaded.';
								 } 
								else
								 {
									//move_uploaded_file($tmp_name, $name);
									$date = date('d');
							  		$month = date('m');
							  		$year = date('Y');
							  		$random_no = rand(1000,5000);
							  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
							  		
							  		$temp = explode(".", $_FILES["file_f"]["name"]);
									$newfilename = round(microtime(true)).'-'.$generate.'.'.end($temp);
							  		move_uploaded_file($tmp_name,$output_dir.$newfilename);
									//move_uploaded_file($tmp_name,$output_dir.$_FILES["file_i"]["name"]);
								
									$insertid = $this->createexercisefile2($newfilename);
								}
							}
						}
					}
					else
					{
						$error ="Plz select or upload file";
					}

					$ext=0;
					if($newfilename)
					{
					  $ext = pathinfo($newfilename, PATHINFO_EXTENSION);
					}
					echo '<span id="message" style="display: block;"><div class="alert alert-success alert-dismissible fade in"><strong class="fa fa-check" aria-hidden="true"></strong> Media file uploaded successfully. </div></span>
                        <script type="text/javascript">
                            $(document).ready(function(){
                            setTimeout(function(){
                            $("#colorbox").css("display","none");
                            $("#cboxOverlay").css("visibility","hidden");
                            },2000);
                            });
                        </script>';
					/*echo json_encode(
						array(
							'name'  => $newfilename,
							'error' => $error,
							'rowid' =>$insertid,
							'ext' =>$ext,
					         )
						);
					die();*/   

    }

    function createexercisefile2($newfilename)
	{
				
		$u_data = $this->session->userdata('logged_in');
	   
	    if(($u_data['groupid']=='4'))
		{
			$sessionarray = $this->session->userdata('logged_in');
            $user_id = $sessionarray['id'];
		
			$dataNew = array(
				'type' => 'file',
				'alt_title' => $this->input->post('name'),
				'category_id' => $this->input->post('category_id'),
				'publish' => '1',
				'mtype' => "pmed",
				'url' => $urlbytype,
				'media_title' => $newfilename,
				'created_by' => $user_id,			
			    );
			
			$inserted_id = $this->medias_model->insertItemsNew($dataNew);
			
			if($inserted_id)
			{
				$resultData = array(
				'type' => 'file',
				'alt_title' => $this->input->post('name'),
				'category_id' => $this->input->post('category_id'),
				'publish' => '1',
				'mtype' => "pmed",
				'url' => $urlbytype,
				'media_title' => $newfilename,
				'created_by' => $user_id,
				'inserted_id' =>$inserted_id,			
			    );

			    return $resultData;
			}

		}

	}

	function createexercisefile($parent_id = FALSE)
	{

		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{

        	$sessionarray = $this->session->userdata('logged_in');
        	$user_id = $sessionarray['id'];	

            $this->template->append_metadata(block_submit_button());
			$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
			$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	    
			$this->template->set('title', 'Create Media');
			$this->template->set('updType', 'create');
			$this->template->set('parent_id',$parent_id);
		
			$this->template->set('mediatype',$this->medias_model->getMediaType());
			$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));

            $this->template->build('medias/createexercisefile');
        }
	}

	function createexercisefile_old($parent_id = FALSE)
	{
	   
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];		
		
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	    
		$this->template->set('title', 'Create Media');
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
				
		
		$this->form_validation->set_rules('type', 'type', 'required');
		
		$this->form_validation->set_rules('category_id', 'category', 'required');
		
		//$this->form_validation->set_rules('source_d', 'source_d', 'required');
		
       //  if($this->input->post('width_v'))
	      //   $this->form_validation->set_rules('width_v', 'width', 'integer');
       //  if($this->input->post('height_v'))
	   	  //   $this->form_validation->set_rules('height_v', 'height', 'integer');
       //  if($this->input->post('width_a'))
	  	   // // $this->form_validation->set_rules('width_a', 'width', 'integer');
       //  if($this->input->post('width'))
	 	    // $this->form_validation->set_rules('width', 'width', 'integer');
       //  if($this->input->post('height'))
	  	   //  $this->form_validation->set_rules('height', 'height', 'integer');
       //  if($this->input->post('media_fullpx'))
	  	   //  $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
		    $this->template->build('medias/createexercisefile');
						
		}
		else
		{   			


 $type = $this->input->post('type');
			switch ($type):
			case 'video':
				$codebytype = $this->input->post('code_v');
				$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $this->input->post('localfile_v');
				break;
			case 'audio':
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
				$widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $this->input->post('localfile_a');
				break;
            case 'docs':
            		if($_FILES['file_d']['name'])
						{    $urlbytype =NULL;
							$doc_param = $this->upload_file_d();
							if($doc_param['status'] == 'error')
							{ 
								$this->template->set('upload_error',$doc_param['msg']);
								$this->template->build('medias/createexercisefile');
								return FALSE;
							}
							else 
							{ 

								if($doc_param['filename'])
									{
										$filenamebytype = $doc_param['filename'];
									}
									else
									{
										$filenamebytype = $this->input->post('localfile_d');
									}
							}

						}
						else
						{
						
            				$urlbytype = $this->input->post('url_d');
            				$filenamebytype ="";
						}               
				break;
            case 'url':
				$urlbytype = $this->input->post('url');
                $widthbytype = ($this->input->post('display_as2')=='wrapper') ? '0' : '1';
			   	$heightbytype = '200';
				$sourcebytype = NULL;
				$codebytype = NULL;
                $filenamebytype = NULL;

				break;
			case 'text':

                $widthbytype = '0';
			   	$heightbytype = '0';
				$sourcebytype = NULL;
				$urlbytype = NULL;
				$filenamebytype = NULL;
                $codebytype = $this->input->post('description');

				break;
			case 'file':
					
					if($_FILES['file_f']['name'])
						{   $urlbytype =null;
							$file_param = $this->upload_exerfile_f();				
				
							if($file_param['status'] == 'error')
							{
								  
								$this->template->set('upload_error',$file_param['msg']);
								$this->template->build('medias/createexercisefile');
								return FALSE;
							}
							else 
							{
								if($file_param['filename'])
									{
										$filenamebytype = $file_param['filename']; 
									}
									else
									{
										$filenamebytype = $this->input->post('localfile_f');
									}
					 		}
						}else{
								
								$urlbytype = $this->input->post('url_f');
								$filenamebytype="";
						}
				break;
            case 'image':
                $codebytype = NULL;
				$urlbytype = NULL;
                $widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
                $heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
                //$widthbytype = $urldisplay;
			    //$heightbytype = $this->input->post('media_fullpx');
                $mediaprop = $this->input->post('media_prop');
				//$widthbytype = $this->input->post('width_v');
				//$heightbytype = $this->input->post('height_v');
				$sourcebytype = NULL;
				$filenamebytype = $this->input->post('imagename');
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'published' => $this->input->post('published'),
			'instructions' => $this->input->post('instructions'),
			'source' => $sourcebytype,
			'uploaded' => $this->input->post('uploaded'),
			'code' => $codebytype,
			'url' => $urlbytype,
			'local' => $filenamebytype,
            'width' => $widthbytype,
			'height' => $heightbytype,
			/*'width' => $this->input->post('width'),
			'height' => $this->input->post('height'),*/
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
            'created_by' => $user_id,
			'show_instruction' => $this->input->post('show_instruction'),

		);
		   
		   
		   //$inserted_id = $this->medias_model->insertItems($data);

		   $dataNew = array(
			'type' => $this->input->post('type'),
			'alt_title' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'publish' => $this->input->post('published'),
			'mtype' => "pmed",
			'url' => $urlbytype,
			'media_title' => $filenamebytype,
			'created_by' => $user_id,			
		    );

			$inserted_id = $this->medias_model->insertItemsNew($dataNew);
			// print_r($dataNew);
			// echo $inserted_id;  
			if($inserted_id){
				//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);


				error_reporting(0);
				$medianame = trim(str_replace(' ', '_', $media->alt_title));
				$ext = pathinfo($filenamebytype, PATHINFO_EXTENSION);
			?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
					<script type="text/javascript">						
					  
							var myrow = parent.document.createElement('tr');
							myrow.id = 'tr'+<?php echo $media->id; ?>;
							parent.document.getElementById('mediafiles').value = parent.document.getElementById('mediafiles').value+<?php echo $media->id; ?>+',';
							parent.document.getElementById('rowsmedia').appendChild(myrow);

							var mycell = parent.document.createElement('td');
							mycell.style.textAlign = 'left';
							myrow.appendChild(mycell);
							var mycelltwo = parent.document.createElement('td');
							mycelltwo.style.textAlign = 'left';
							myrow.appendChild(mycelltwo);
							var mycellthree = parent.document.createElement('td');
							mycellthree.style.textAlign = 'left';
							myrow.appendChild(mycellthree);
							var mycellfour = parent.document.createElement('td');
							mycellfour.style.textAlign = 'left';
							mycellfour.setAttribute("id","tdpublish"+<?php echo $media->id; ?>);
							mycellfour.setAttribute("<?php echo $medianame;  ?>","tdpublish");
							myrow.appendChild(mycellfour);

							//var mycellnine = parent.document.createElement('td');
							// mycellnine.style.textAlign = 'left';
							// mycellnine.setAttribute("id","tdunpublish"+<?php echo $media->id; ?>);
							// mycellnine.setAttribute("<?php echo $medianame;  ?>","tdunpublish");
							// myrow.appendChild(mycellnine)

						//	var mycellfive = parent.document.createElement('td');
						//	mycellfive.style.textAlign = 'left';
						//	myrow.appendChild(mycellfive);
						//	var mycellsix = parent.document.createElement('td');
						//	mycellsix.style.textAlign = 'left';
						//	myrow.appendChild(mycellsix);
							
							//var mycellseven = parent.document.createElement('td');
							//mycellseven.style.textAlign = 'left';
							//myrow.appendChild(mycellseven);
							var mycelleight = parent.document.createElement('td');
							mycelleight.style.textAlign = 'left';
							mycelleight.style.display = 'none';
							//mycellnine.style.display = 'none';
							myrow.appendChild(mycelleight);
							yes_no = "publish";
							   publish = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+<?php echo $media->id; ?>+'" class = "publish" onclick="publishbutton(\'publish-'+<?php echo $media->id; ?>+'\');">';
							// if( <?php echo $media->publish;  ?>==1){
							//    yes_no = "publish";
							//    publish = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+<?php echo $media->id; ?>+'" class = "publish" onclick="publishbutton(\'publish-'+<?php echo $media->id; ?>+'\');">';
							// }else{
							//    yes_no = "unpublish";
							//    publish = '<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" id="unpublish-'+<?php echo $media->id; ?>+'" class="unpublish" onclick="publishbutton(\'unpublish-'+<?php echo $media->id; ?>+'\');">';
							// }
							//var id_string = <?php echo $media->id; ?>;
							//var name_string = <?php echo $media->name;  ?>;
							//var publish_string = <?php echo $media->published;  ?>;
							//var order = 'order';
							//var guest_access = '<select name="access[]"><option value="0">Students</option><option value="1">Members</option><option value="2">Guests</option></select>'

							var remove = '<a href="javascript:void(0);" onclick="deleteRow(this.parentNode.parentNode.rowIndex)" class="removeele" id="remove'+<?php echo $media->id; ?>+'"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>';

							img_path = "<?php echo base_url(); ?>public/images/admin/doc.gif";
							img_type = '<img src="'+img_path+'" alt="doc type"/>';
							media_id = '<input type="hidden" value="'+<?php echo $media->id; ?>+'" name="media_id[]"/>';
							mycell.innerHTML = <?php echo $media->id; ?>;
							mycelltwo.innerHTML='<?php 
							if($ext == 'gif'||$ext == 'GIF'){
							echo $ftype = '<img src="'.base_url().'public/css/image/gif-icon.png" alt="File type">';
							} 
							elseif($ext == 'rar'||$ext == 'RAR'){
							echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
							}
							elseif($ext == 'zip'||$ext == 'ZIP'){
							echo $ftype = '<img src="'.base_url().'public/css/image/zip-icon.png" alt="File type">';
							}
							elseif($ext == 'rar'||$ext == 'RAR'){
							echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
							}
							elseif($ext == 'doc'||$ext == 'DOC'){
							echo $ftype = '<img src="'.base_url().'public/css/image/doc-icon.png" alt="File type">';
							}
							elseif($ext == 'docx'||$ext == 'DOCX'){
							echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
							}
							elseif($ext == 'docx'||$ext == 'DOCX'){
							echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
							}
							elseif($ext == 'jpg'||$ext == 'JPG'){
							echo $ftype = '<img src="'.base_url().'public/css/image/jpg-icon.png" alt="File type">';
							}
							elseif($ext == 'png'||$ext == 'PNG'){
							echo $ftype = '<img src="'.base_url().'public/css/image/png-icon.png" alt="File type">';
							}
							elseif($ext == 'bmp'||$ext == 'BMP'){
							echo $ftype = '<img src="'.base_url().'public/css/image/bmp-icon.png" alt="File type">';
							}
							elseif($ext == 'ppt'||$ext == 'PPT'){
							echo $ftype = '<img src="'.base_url().'public/css/image/ppt-icon.png" alt="File type">';
							}
							elseif($ext == 'pptx'||$ext == 'PPTX'){
							echo $ftype = '<img src="'.base_url().'public/css/image/pptx-icon.png" alt="File type">';
							}
							elseif($ext == 'pdf'||$ext == 'PDF'){
						echo $ftype = '<img src="'.base_url().'public/css/image/pdf-icon.png" alt="File type">';
						}
						elseif($ext == 'txt'||$ext == 'TXT'){
						echo $ftype = '<img src="'.base_url().'public/css/image/txt-icon.png" alt="File type">';
						}
							?>';
							mycellthree.innerHTML= '<?php echo $media->alt_title;  ?>';
							mycellfour.innerHTML=remove;
						//	mycellfive.innerHTML=order;
						//	mycellsix.innerHTML=guest_access;
							//mycellseven.innerHTML=remove;
							mycelleight.innerHTML=media_id;
							//parent.jQuery.fancybox.close();
							$("#cboxClose",parent.document).click();
							
						 //  window.location.href = '<?php echo base_url();?>medias/createexercisefile';
					  
					</script>
			<?
				
				
				//redirect('medias/create'.$parent_id);
			}
		}
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	function createsectionmedia($parent_id = FALSE)
	{
	   
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		//$this->template->set_layout('backend');
		/*$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);*/
		
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	    //$this->_set_rules();
		//$form_data_aux			= array();
		$this->template->set('title', 'Create Media');
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		//$this->template->set('media',(object) array());
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getMediaType(3));

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$map = directory_map('./mydirectory/', FALSE, TRUE);
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
		//$this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/images', 'image'));
		/*print_r($filelist['image']);
		foreach($filelist['image'] as $imagelist):
		endforeach;*/
		//$ftpfiles = get_file_info('public/uploads/files/'.$ftpfiles[0]);		
		//$ftpfiles = get_mime_by_extension('public/uploads/files/'.$ftpfiles[2]);		
		//$arrar = explode('/',$ftpfiles);print_r($arrar);
		//get_mime_by_extension('file')
		//$ftpfiles = get_dir_file_info('public/uploads/files', $top_level_only = TRUE);		
		
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		// $this->form_validation->set_rules('category_id', 'category', 'required');

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
		    $this->template->build('medias/createsectionmedia');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{   
			/*foreach ($_FILES as $index => $value)
			{
			  	if ($value['name'] != '')
				{
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('medias'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
						$this->template->build('medias/createsectionmedia');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();
                       // print_r($info_upload);
						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];
                       // print_r($form_data_aux[$index]); exit;
						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'medias'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('medias/createsectionmedia');

							return FALSE;
						}
					}
				}
			}*/
		//$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
		//print_r($form_data_aux[$index]);
		//$orderingval = $this->medias_model->maxorder();
     	//$imagename=($form_data_aux[$index])?$form_data_aux[$index]:'blank.png';
		//$urldisplay = ($this->input->post('display_as2') == 'wrapper') ? 0 : 1;
		//echo $url_display;
		/*if($type == 'docs'){
        if($this->input->post('display_as') == 'wrapper'){
            $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
        }else{
            $width_by_type = '0';
			$height_by_type = '0';
        }
        }*/
        error_reporting(0);
        $type = $this->input->post('type');
			switch ($type):
			case 'video':
						if($_FILES['file_v']['name'])
						{
							$video_param  = $this->upload_file_v();
						}
						
			           if($video_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $video_param['msg']);

							//load the view and the layout
							$this->template->build('medias/createsectionmedia');

							return FALSE;
					   }
					   else {
								$codebytype = $this->input->post('code_v');

								$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

						$urlbytype = $this->input->post('url_v');
						$widthbytype = $this->input->post('width_v');
						$heightbytype = $this->input->post('height_v');
						$sourcebytype = $this->input->post('source_v');
						if($video_param['filename'])
						{
							$filenamebytype = $video_param['filename'];
						}
						else {
							$filenamebytype = $this->input->post('localfile_v');
						}
					   }
				
				break;
			case 'audio':
						if($_FILES['file_a']['name'])
						{
							$audio_param  = $this->upload_file_a();
						}
						if($audio_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $audio_param['msg']);

							//load the view and the layout
							$this->template->build('medias/createsectionmedia');

							return FALSE;
					   }
					   else
						  {
							$codebytype = $this->input->post('code_a');
							$urlbytype = $this->input->post('url_a');
							$widthbytype = $this->input->post('width_a');
							$heightbytype = $this->input->post('height_a');
							$sourcebytype = $this->input->post('source_a');
							if($audio_param['filename'])
							{
								$filenamebytype = $audio_param['filename'];
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_a');
							}
					   }
				
				break;
            
            case 'image':
						if($_FILES['file_i']['name'])
						{
							$image_param  = $this->upload_file_i();
						}
						if($image_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $image_param['msg']);

							//load the view and the layout
							$this->template->build('medias/createsectionmedia');

							return FALSE;
					   }
					   else {
						    $codebytype = NULL;
							$urlbytype = NULL;
							$widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
							$heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
							//$widthbytype = $urldisplay;
							//$heightbytype = $this->input->post('media_fullpx');
							$mediaprop = $this->input->post('media_prop');
							//$widthbytype = $this->input->post('width_v');
							//$heightbytype = $this->input->post('height_v');
							$sourcebytype = NULL;
							if($image_param['filename'])
							{
								$filenamebytype = $image_param['filename'];
							}
							else {
								$filenamebytype = 'no_images.jpg';
							}
					   }
               
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'published' => $this->input->post('published'),
			'instructions' => $this->input->post('instructions'),
			'source' => $sourcebytype,
			'uploaded' => $this->input->post('uploaded'),
			'code' => $codebytype,
			'url' => $urlbytype,
			'local' => $filenamebytype,
            'width' => $widthbytype,
			'height' => $heightbytype,
			/*'width' => $this->input->post('width'),
			'height' => $this->input->post('height'),*/
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
            'created_by' => $user_id,
			'show_instruction' => $this->input->post('show_instruction'),

		);	

			$urlcode ="";
			if($sourcebytype =="url")
			{
				$urlcode = $urlbytype;
			}
			else if($sourcebytype =="code")
			{
				$urlcode = $codebytype;
			}
			else
			{
				$sourcebytype="local";
			}


		   $dataNew = array(
		   			 'media_title' => $filenamebytype,
		   			 'alt_title' => $this->input->post('name'),
					 'type' => $this->input->post('type'),					
					 'category_id' => $this->input->post('category_id'),
					 'publish' => $this->input->post('published'),					 
					 'instructions' => $this->input->post('instructions'),
					 'mtype' => $sourcebytype,
					 'url' => $urlcode, 
					 'created_by' => $user_id,
				   );
			
				 //$inserted_id = $this->medias_model->insertItems($data);
				 $inserted_id = $this->medias_model->insertItemsNew($dataNew);
				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);
			?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script>
				    var mediaid = '<?php echo $media->id; ?>';
					parent.jQuery('#media_1').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_2').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_4').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_5').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_7').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_8').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_9').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_11').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_12').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_14').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#media_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
					parent.jQuery('#media_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
					parent.jQuery('#media_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
					parent.jQuery('#media_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
					parent.jQuery('#media_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
					parent.jQuery('#media_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
					parent.jQuery('#media_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
					parent.jQuery('#media_11').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/11");
					parent.jQuery('#media_12').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/12");
					parent.jQuery('#media_14').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/14");

					window.parent.document.getElementById("db_media_1").value = mediaid;
				    
				    jQuery("#cboxClose",parent.document).click();
					
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		}
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	
	function createsectiontext($parent_id = FALSE)
	{
	   
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		//$this->template->set_layout('backend');
		/*$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);*/
		
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	    //$this->_set_rules();
		//$form_data_aux			= array();
		$this->template->set('title', 'Create Media');
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		//$this->template->set('media',(object) array());
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getMediaType(3));

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$map = directory_map('./mydirectory/', FALSE, TRUE);
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
		//$this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/images', 'image'));
		/*print_r($filelist['image']);
		foreach($filelist['image'] as $imagelist):
		endforeach;*/
		//$ftpfiles = get_file_info('public/uploads/files/'.$ftpfiles[0]);		
		//$ftpfiles = get_mime_by_extension('public/uploads/files/'.$ftpfiles[2]);		
		//$arrar = explode('/',$ftpfiles);print_r($arrar);
		//get_mime_by_extension('file')
		//$ftpfiles = get_dir_file_info('public/uploads/files', $top_level_only = TRUE);		
		
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
		    $this->template->build('medias/createsectiontext');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{   
			/*foreach ($_FILES as $index => $value)
			{
			  	if ($value['name'] != '')
				{
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('medias'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
						$this->template->build('medias/createsectiontext');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();
                       // print_r($info_upload);
						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];
                       // print_r($form_data_aux[$index]); exit;
						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'medias'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('medias/createsectiontext');

							return FALSE;
						}
					}
				}
			}*/
		//$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
		//print_r($form_data_aux[$index]);
		//$orderingval = $this->medias_model->maxorder();
     	//$imagename=($form_data_aux[$index])?$form_data_aux[$index]:'blank.png';
		//$urldisplay = ($this->input->post('display_as2') == 'wrapper') ? 0 : 1;
		//echo $url_display;
		/*if($type == 'docs'){
        if($this->input->post('display_as') == 'wrapper'){
            $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
        }else{
            $width_by_type = '0';
			$height_by_type = '0';
        }
        }*/
		error_reporting(0);
       $type = $this->input->post('type');
			switch ($type):
			case 'video':
				$codebytype = $this->input->post('code_v');

				$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $this->input->post('localfile_v');
				break;
			case 'audio':
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
				$widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $this->input->post('localfile_a');
				break;
            case 'docs':
						if($_FILES['file_d']['name'])
						{
							$doc_param = $this->upload_file_d();
							
						}
						if($doc_param['status'] == 'error')
						{
							$this->template->set('upload_error',$doc_param['msg']);
							$this->template->build('medias/createsectiontext');
							return FALSE;
						}
						else {
							 if($this->input->post('display_as') == 'wrapper'){
                    $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
        			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
                 }else{
                    $width_by_type = '0';
        			$height_by_type = '0';
                 }
                $urlbytype = $this->input->post('url_d');
				/*$widthbytype = $this->input->post('width_d');
				$heightbytype = $this->input->post('height_d'); */
                $widthbytype = $width_by_type;
				$heightbytype = $height_by_type;
				if($doc_param['filename'])
				{
					$filenamebytype = $doc_param['filename'];
				}
				else
				{
					$filenamebytype = $this->input->post('localfile_d');
				}
				$sourcebytype = $this->input->post('source_d');
				$codebytype = NULL;
                $urlbytype = $this->input->post('url_d');
						}
               
				break;
            case 'url':
				$urlbytype = $this->input->post('url');
                $widthbytype = ($this->input->post('display_as2')=='wrapper') ? '0' : '1';
			   	$heightbytype = '200';
				$sourcebytype = NULL;
				$codebytype = NULL;
                $filenamebytype = NULL;

				break;
			case 'text':

                $widthbytype = '0';
			   	$heightbytype = '0';
				$sourcebytype = NULL;
				$urlbytype = NULL;
				$filenamebytype = NULL;
                $codebytype = $this->input->post('description');

				break;
			case 'file':
					if($_FILES['file_f']['name'])
					{
						$file_param = $this->upload_file_f();
					}
					
				
					if($file_param['status'] == 'error')
					{
						  
						$this->template->set('upload_error',$file_param['msg']);
						$this->template->build('medias/createsectiontext');
						return FALSE;
					}
					else {
							$codebytype = NULL;
							$sourcebytype = $this->input->post('source_f');
							$widthbytype = '0';
							$heightbytype = '0';
							$urlbytype = $this->input->post('url_f');
							if($file_param['filename'])
							{
								$filenamebytype = $file_param['filename']; 
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_f');
							}
					}
				break;
            case 'image':
                $codebytype = NULL;
				$urlbytype = NULL;
                $widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
                $heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
                //$widthbytype = $urldisplay;
			    //$heightbytype = $this->input->post('media_fullpx');
                $mediaprop = $this->input->post('media_prop');
				//$widthbytype = $this->input->post('width_v');
				//$heightbytype = $this->input->post('height_v');
				$sourcebytype = NULL;
				$filenamebytype = $this->input->post('imagename');
				break;
			default:

			endswitch;
			
			
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'published' => $this->input->post('published'),
			'instructions' => $this->input->post('instructions'),
			'source' => $sourcebytype,
			'uploaded' => $this->input->post('uploaded'),
			'code' => $codebytype,
			'url' => $urlbytype,
			'local' => $filenamebytype,
            'width' => $widthbytype,
			'height' => $heightbytype,
			/*'width' => $this->input->post('width'),
			'height' => $this->input->post('height'),*/
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
            'created_by' => $user_id,
			'show_instruction' => $this->input->post('show_instruction'),

		);
		    
			
				 $inserted_id = $this->medias_model->insertItems($data);
				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);
			?>
			<script>
				    var mediaid = '<?php echo $media->id; ?>';
					parent.jQuery('#text_1').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_2').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_3').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_4').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_5').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_6').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_7').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_8').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_9').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
					parent.jQuery('#text_10').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
	
					parent.jQuery('#text_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
					parent.jQuery('#text_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
					parent.jQuery('#text_3').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/3");
					parent.jQuery('#text_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
					parent.jQuery('#text_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
					parent.jQuery('#text_6').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/6");
					parent.jQuery('#text_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
					parent.jQuery('#text_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
					parent.jQuery('#text_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
					parent.jQuery('#text_10').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/10");
					window.parent.document.getElementById("db_text_1").value = mediaid;
				    parent.jQuery.fancybox.close();					
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		  }
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	
	function createlecturetext($parent_id = FALSE)
	{
	   
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		//$this->template->set_layout('backend');
		/*$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);*/
		
		$this->template->append_metadata(block_submit_button());
		//$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		//$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		$mediagroup = $this->uri->segment(3);

          $t_type = $this->uri->segment(5); 

		$this->template->set('mediagroup', $mediagroup);
	    //$this->_set_rules();
		//$form_data_aux			= array();
		$this->template->set('title', 'Create Media');
		$this->template->set('t_type', $t_type);

		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		//$this->template->set('media',(object) array());
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getMediaType(3));

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$map = directory_map('./mydirectory/', FALSE, TRUE);
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
		//$this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/images', 'image'));
		/*print_r($filelist['image']);
		foreach($filelist['image'] as $imagelist):
		endforeach;*/
		//$ftpfiles = get_file_info('public/uploads/files/'.$ftpfiles[0]);		
		//$ftpfiles = get_mime_by_extension('public/uploads/files/'.$ftpfiles[2]);		
		//$arrar = explode('/',$ftpfiles);print_r($arrar);
		//get_mime_by_extension('file')
		//$ftpfiles = get_dir_file_info('public/uploads/files', $top_level_only = TRUE);		
		
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
		    $this->template->build('medias/createlecturetext');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{ 
			
			
		error_reporting(0);
         $type = $this->input->post('type');
			switch ($type):
			case 'video':
				$codebytype = $this->input->post('code_v');
				$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $this->input->post('localfile_v');
				break;
			case 'audio':
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
				$widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $this->input->post('localfile_a');
				break;
            case 'docs':
						if($_FILES['file_d']['name'])
						{
							$doc_param = $this->upload_file_d();
						}
						if($doc_param['status'] == 'error')
						{
							$this->template->set('upload_error',$doc_param['msg']);
							$this->template->build('medias/createlecturetext');
							return FALSE;
						}
						else {
							 if($this->input->post('display_as') == 'wrapper'){
                    $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
        			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
                 }else{
                    $width_by_type = '0';
        			$height_by_type = '0';
                 }
                $urlbytype = $this->input->post('url_d');
				/*$widthbytype = $this->input->post('width_d');
				$heightbytype = $this->input->post('height_d'); */
                $widthbytype = $width_by_type;
				$heightbytype = $height_by_type;
				if($doc_param['filename'])
				{
					$filenamebytype = $doc_param['filename'];
				}
				else
				{
					$filenamebytype = $this->input->post('localfile_d');
				}
				$sourcebytype = $this->input->post('source_d');
				$codebytype = NULL;
                $urlbytype = $this->input->post('url_d');
						}
               
				break;
            case 'url':
				$urlbytype = $this->input->post('url');
                $widthbytype = ($this->input->post('display_as2')=='wrapper') ? '0' : '1';
			   	$heightbytype = '200';
				$sourcebytype = NULL;
				$codebytype = NULL;
                $filenamebytype = NULL;

				break;
			case 'text':

                $widthbytype = '0';
			   	$heightbytype = '0';
				$sourcebytype = NULL;
				$urlbytype = NULL;
				$filenamebytype = NULL;
                $codebytype = $this->input->post('description');

				break;
			case 'file':
					if($_FILES['file_v']['name'])
					{
						$file_param = $this->upload_file_f();
					}
					
				
					if($file_param['status'] == 'error')
					{
						  
						$this->template->set('upload_error',$file_param['msg']);
						$this->template->build('medias/createlecturetext');
						return FALSE;
					}
					else {
							$codebytype = NULL;
							$sourcebytype = $this->input->post('source_f');
							$widthbytype = '0';
							$heightbytype = '0';
							$urlbytype = $this->input->post('url_f');
							if($file_param['filename'])
							{
								$filenamebytype = $file_param['filename']; 
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_f');
							}
					}
				break;
            case 'image':
                $codebytype = NULL;
				$urlbytype = NULL;
                $widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
                $heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
                //$widthbytype = $urldisplay;
			    //$heightbytype = $this->input->post('media_fullpx');
                $mediaprop = $this->input->post('media_prop');
				//$widthbytype = $this->input->post('width_v');
				//$heightbytype = $this->input->post('height_v');
				$sourcebytype = NULL;
				$filenamebytype = $this->input->post('imagename');
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'published' => $this->input->post('published'),
			'instructions' => $this->input->post('instructions'),
			'source' => $sourcebytype,
			'uploaded' => $this->input->post('uploaded'),
			'code' => $codebytype,
			'url' => $urlbytype,
			'local' => $filenamebytype,
            'width' => $widthbytype,
			'height' => $heightbytype,
			/*'width' => $this->input->post('width'),
			'height' => $this->input->post('height'),*/
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
            'created_by' => $user_id,
			'show_instruction' => $this->input->post('show_instruction'),

		);
		    
		   
				 $inserted_id = $this->medias_model->insertItems($data);
				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			 $media = $this->medias_model->getMediaExeFile($inserted_id);
			
			?>
			<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
			<script>
					$(document).ready(function(){
				    var mediaid = '<?php echo $media->id; ?>'; 
				    var mediagroup = 'firsttext';
					if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>') {
						parent.jQuery('#text_11').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/11");
						window.parent.document.getElementById("db_text_11").value = mediaid;
						window.parent.document.getElementById("before_menu_txt_11").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_11").style.display = "";
						}
						if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>'){
						parent.jQuery('#text_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
						parent.jQuery('#text_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
						parent.jQuery('#text_3').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/3");
						parent.jQuery('#text_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
						parent.jQuery('#text_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
						parent.jQuery('#text_6').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/6");
						parent.jQuery('#text_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
						parent.jQuery('#text_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
						parent.jQuery('#text_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
						parent.jQuery('#text_10').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/10");
						
						window.parent.document.getElementById("db_text_1").value = mediaid;
						window.parent.document.getElementById("db_text_2").value = mediaid;
						window.parent.document.getElementById("db_text_3").value = mediaid;
						
						window.parent.document.getElementById("db_text_4").value = mediaid;
						window.parent.document.getElementById("db_text_5").value = mediaid;
						
						window.parent.document.getElementById("db_text_6").value = mediaid;
						window.parent.document.getElementById("db_text_7").value = mediaid;
						
						window.parent.document.getElementById("db_text_8").value = mediaid;
						window.parent.document.getElementById("db_text_9").value = mediaid;
						
						window.parent.document.getElementById("db_text_10").value = mediaid;
						
						window.parent.document.getElementById("before_menu_txt_1").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_1").style.display = "";
						window.parent.document.getElementById("before_menu_txt_2").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_2").style.display = "";
						window.parent.document.getElementById("before_menu_txt_3").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_3").style.display = "";
						window.parent.document.getElementById("before_menu_txt_4").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_4").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_5").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_5").style.display = "";
						window.parent.document.getElementById("before_menu_txt_6").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_6").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_7").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_7").style.display = "";
						window.parent.document.getElementById("before_menu_txt_8").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_8").style.display = "";
						window.parent.document.getElementById("before_menu_txt_9").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_9").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_10").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_10").style.display = "";
						}
					// parent.jQuery.colorbox.close();
					$("#cboxClose",parent.document).click();
					});				
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		  }
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}

	function updatelecturetext($parent_id = FALSE)
	{
		
	   
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		//$this->template->set_layout('backend');
		/*$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);*/
		
		$this->template->append_metadata(block_submit_button());
		//$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		//$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
	
	    $id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;	
		
        $this->template->set('id',$id);
 	    $this->template->set('media', $this->medias_model->getItems($id, $user_id));
		$this->template->set('updType', 'edit');

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$map = directory_map('./mydirectory/', FALSE, TRUE);
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
	
		
		
		$this->form_validation->set_rules('name', 'name', 'required');
	

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
		    $this->template->build('medias/updatetext');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{ 
			
			
			
		error_reporting(0);
         $type = $this->input->post('type');
			switch ($type):
			case 'video':
				$codebytype = $this->input->post('code_v');
				$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $this->input->post('localfile_v');
				break;
			case 'audio':
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
				$widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $this->input->post('localfile_a');
				break;
            case 'docs':
						if($_FILES['file_d']['name'])
						{
							$doc_param = $this->upload_file_d();
						}
						if($doc_param['status'] == 'error')
						{
							$this->template->set('upload_error',$doc_param['msg']);
							$this->template->build('medias/updatetext');
							return FALSE;
						}
						else {
							 if($this->input->post('display_as') == 'wrapper'){
                    $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
        			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
                 }else{
                    $width_by_type = '0';
        			$height_by_type = '0';
                 }
                $urlbytype = $this->input->post('url_d');
				/*$widthbytype = $this->input->post('width_d');
				$heightbytype = $this->input->post('height_d'); */
                $widthbytype = $width_by_type;
				$heightbytype = $height_by_type;
				if($doc_param['filename'])
				{
					$filenamebytype = $doc_param['filename'];
				}
				else
				{
					$filenamebytype = $this->input->post('localfile_d');
				}
				$sourcebytype = $this->input->post('source_d');
				$codebytype = NULL;
                $urlbytype = $this->input->post('url_d');
						}
               
				break;
            case 'url':
				$urlbytype = $this->input->post('url');
                $widthbytype = ($this->input->post('display_as2')=='wrapper') ? '0' : '1';
			   	$heightbytype = '200';
				$sourcebytype = NULL;
				$codebytype = NULL;
                $filenamebytype = NULL;

				break;
			case 'text':

                $widthbytype = '0';
			   	$heightbytype = '0';
				$sourcebytype = NULL;
				$urlbytype = NULL;
				$filenamebytype = NULL;
                $codebytype = $this->input->post('description');

				break;
			case 'file':
					if($_FILES['file_v']['name'])
					{
						$file_param = $this->upload_file_f();
					}
					
				
					if($file_param['status'] == 'error')
					{
						  
						$this->template->set('upload_error',$file_param['msg']);
						$this->template->build('medias/createlecturetext');
						return FALSE;
					}
					else {
							$codebytype = NULL;
							$sourcebytype = $this->input->post('source_f');
							$widthbytype = '0';
							$heightbytype = '0';
							$urlbytype = $this->input->post('url_f');
							if($file_param['filename'])
							{
								$filenamebytype = $file_param['filename']; 
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_f');
							}
					}
				break;
            case 'image':
                $codebytype = NULL;
				$urlbytype = NULL;
                $widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
                $heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
                //$widthbytype = $urldisplay;
			    //$heightbytype = $this->input->post('media_fullpx');
                $mediaprop = $this->input->post('media_prop');
				//$widthbytype = $this->input->post('width_v');
				//$heightbytype = $this->input->post('height_v');
				$sourcebytype = NULL;
				$filenamebytype = $this->input->post('imagename');
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => 'text',
			'name' => $this->input->post('name'),			
			'code' => $codebytype
			

		);
		    
		  echo '<pre>';
			print_r($data);
			exit('dgd');
	        $inserted_id = $this->medias_model->updateItem($id,$data);

				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			 $media = $this->medias_model->getMediaExeFile($id);

			echo '<pre>';
			print_r($media);
			exit('dgd');
			
			?>
			<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
			<script>
					$(document).ready(function(){
				    var mediaid = '<?php echo $media->id; ?>'; 
				    var mediagroup = 'firsttext';
					if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>') {
						parent.jQuery('#text_11').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/11");
						window.parent.document.getElementById("db_text_11").value = mediaid;
						window.parent.document.getElementById("before_menu_txt_11").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_11").style.display = "";
						}
						if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>'){
						parent.jQuery('#text_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
						parent.jQuery('#text_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
						parent.jQuery('#text_3').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/3");
						parent.jQuery('#text_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
						parent.jQuery('#text_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
						parent.jQuery('#text_6').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/6");
						parent.jQuery('#text_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
						parent.jQuery('#text_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
						parent.jQuery('#text_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
						parent.jQuery('#text_10').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/10");
						
						window.parent.document.getElementById("db_text_1").value = mediaid;
						window.parent.document.getElementById("db_text_2").value = mediaid;
						window.parent.document.getElementById("db_text_3").value = mediaid;
						
						window.parent.document.getElementById("db_text_4").value = mediaid;
						window.parent.document.getElementById("db_text_5").value = mediaid;
						
						window.parent.document.getElementById("db_text_6").value = mediaid;
						window.parent.document.getElementById("db_text_7").value = mediaid;
						
						window.parent.document.getElementById("db_text_8").value = mediaid;
						window.parent.document.getElementById("db_text_9").value = mediaid;
						
						window.parent.document.getElementById("db_text_10").value = mediaid;
						
						window.parent.document.getElementById("before_menu_txt_1").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_1").style.display = "";
						window.parent.document.getElementById("before_menu_txt_2").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_2").style.display = "";
						window.parent.document.getElementById("before_menu_txt_3").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_3").style.display = "";
						window.parent.document.getElementById("before_menu_txt_4").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_4").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_5").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_5").style.display = "";
						window.parent.document.getElementById("before_menu_txt_6").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_6").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_7").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_7").style.display = "";
						window.parent.document.getElementById("before_menu_txt_8").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_8").style.display = "";
						window.parent.document.getElementById("before_menu_txt_9").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_9").style.display = "";
						
						window.parent.document.getElementById("before_menu_txt_10").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_10").style.display = "";
						}
					// parent.jQuery.colorbox.close();
					$("#cboxClose",parent.document).click();
					});				
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		  }
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	function createlecturemedia($parent_id = FALSE)
	{

		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid'] == 4) || ($u_data['groupid'] == 2) || ($u_data['groupid'] == 5) || ($maccessarr['media']=='own'))
		{
        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		//$this->template->set_layout('backend');
		/*$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);*/
		
		$this->template->append_metadata(block_submit_button());
		//$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		//$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		$mediagroup = $this->uri->segment(3);

		$m_type = $this->uri->segment(5);
		
	    //$this->_set_rules();
		//$form_data_aux			= array();
		$this->template->set('title', 'Create Media');
		$this->template->set('m_type', $m_type);
		
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		//$this->template->set('media',(object) array());
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getMediaType(3));

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$map = directory_map('./mydirectory/', FALSE, TRUE);
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
		//$this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/images', 'image'));
		/*print_r($filelist['image']);
		foreach($filelist['image'] as $imagelist):
		endforeach;*/
		//$ftpfiles = get_file_info('public/uploads/files/'.$ftpfiles[0]);		
		//$ftpfiles = get_mime_by_extension('public/uploads/files/'.$ftpfiles[2]);		
		//$arrar = explode('/',$ftpfiles);print_r($arrar);
		//get_mime_by_extension('file')
		//$ftpfiles = get_dir_file_info('public/uploads/files', $top_level_only = TRUE);		
		
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');

        if($this->input->post('width_v'))
	        $this->form_validation->set_rules('width_v', 'width', 'integer');
        if($this->input->post('height_v'))
	   	    $this->form_validation->set_rules('height_v', 'height', 'integer');
        if($this->input->post('width_a'))
	  	   // $this->form_validation->set_rules('width_a', 'width', 'integer');
        if($this->input->post('width'))
	 	    $this->form_validation->set_rules('width', 'width', 'integer');
        if($this->input->post('height'))
	  	    $this->form_validation->set_rules('height', 'height', 'integer');
        if($this->input->post('media_fullpx'))
	  	    $this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');


        if($this->input->post('url')&& $this->input->post('url')!='http://')
        {

                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
		}

		//$this->form_validation->set_rules('url', 'url', 'url_checking');
		if ($this->form_validation->run() === FALSE)
		{
			
		    $this->template->build('medias/createlecturemedia');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{  
	       
	       
     
		error_reporting(0);
        $type = $this->input->post('type');
			switch ($type):
			case 'video':
						if($_FILES['file_v']['name'])
						{
							$video_param  = $this->upload_file_v();
						}
			           if($video_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $video_param['msg']);

							//load the view and the layout
							$this->template->set('m_type', 'video');
							$this->template->build('medias/createlecturemedia');

							return FALSE;
					   }
					   else {
								$codebytype = $this->input->post('code_v');

								$newWidth = '100%';
                $newHeight = 'auto';

			    $codebytype = preg_replace(
				   array('/width="\d+"/i', '/height="\d+"/i'),
				   array(sprintf('width="%s"', $newWidth), sprintf('height="%s"', $newHeight)),
				   $codebytype);

						$urlbytype = $this->input->post('url_v');
						$widthbytype = $this->input->post('width_v');
						$heightbytype = $this->input->post('height_v');
						$sourcebytype = $this->input->post('source_v');
						if($video_param['filename'])
						{
							$filenamebytype = $video_param['filename'];
						}
						else {
							$filenamebytype = $this->input->post('localfile_v');
						}
					   }
				
				break;
			case 'audio':
						if($_FILES['file_a']['name'])
						{
							$audio_param  = $this->upload_file_a();
						}
						if($audio_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $audio_param['msg']);

							//load the view and the layout
                             $this->template->set('m_type', 'audio');
							$this->template->build('medias/createlecturemedia');

							return FALSE;
					   }
					   else
						  {
							$codebytype = $this->input->post('code_a');
							$urlbytype = $this->input->post('url_a');
							$widthbytype = $this->input->post('width_a');
							$heightbytype = $this->input->post('height_a');
							$sourcebytype = $this->input->post('source_a');
							if($audio_param['filename'])
							{
								$filenamebytype = $audio_param['filename'];
							}
							else
							{
								$filenamebytype = $this->input->post('localfile_a');
							}
					   }
				
				break;
            
            case 'image':
						if($_FILES['file_i']['name'])
						{
							$image_param  = $this->upload_file_i();
						}
						if($image_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $image_param['msg']);
                            
                            $this->template->set('m_type', 'image');
							//load the view and the layout
							$this->template->build('medias/createlecturemedia');

							return FALSE;
					   }
					   else {
						    $codebytype = NULL;
							$urlbytype = NULL;
							$widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
							$heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
							//$widthbytype = $urldisplay;
							//$heightbytype = $this->input->post('media_fullpx');
							$mediaprop = $this->input->post('media_prop');
							//$widthbytype = $this->input->post('width_v');
							//$heightbytype = $this->input->post('height_v');
							$sourcebytype = NULL;
							 if($image_param['filename'])
							 {
							 	$filenamebytype = $image_param['filename'];
							 }
							 else {
							 	$filenamebytype = 'no_images.jpg';
							 }

						  /*	if($this->input->post('cropimagemedia'))
							{
								$filenamebytype = $this->input->post('cropimagemedia');     //$image_param['filename'];
							}
							else {
								$filenamebytype = 'no_images.jpg';
							} */
					   }
               
				break;
			default:

			endswitch;
        
		// $url_display = ($this->input->post('display_as2')=='wrapper' ? 0 : 1);
		$data = array(
			'type' => $this->input->post('type'),
			'name' => $this->input->post('name'),
			'category_id' => $this->input->post('category_id'),
			'published' => $this->input->post('published'),
			'instructions' => $this->input->post('instructions'),
			'source' => $sourcebytype,
			'uploaded' => $this->input->post('uploaded'),
			'code' => $codebytype,
			'url' => $urlbytype,
			'local' => $filenamebytype,
            'width' => $widthbytype,
			'height' => $heightbytype,
			/*'width' => $this->input->post('width'),
			'height' => $this->input->post('height'),*/
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
            'created_by' => $user_id,
			'show_instruction' => $this->input->post('show_instruction'),

		);
		    
          

			$inserted_id = $this->medias_model->insertItems($data);
				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);
			?>
			<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
			<script>
			$(document).ready(function(){
				    var mediaid = '<?php echo $media->id; ?>';
				   // var mediagroup = 'firstmedia';
					if('<?php echo $this->input->post('parent_id'); ?>' == 'secondmedia' ) 
						{
							parent.jQuery('#media_3').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_6').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_10').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_13').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_3').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/3");
							parent.jQuery('#media_6').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/6");
							parent.jQuery('#media_10').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/10");
							parent.jQuery('#media_13').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/13");
							window.parent.document.getElementById("db_media_3").value = mediaid;
							window.parent.document.getElementById("db_media_6").value = mediaid;
							window.parent.document.getElementById("db_media_10").value = mediaid;
							window.parent.document.getElementById("db_media_13").value = mediaid;
							window.parent.document.getElementById("before_menu_med_3").style.display = "none";
							window.parent.document.getElementById("after_menu_med_3").style.display = "";
							window.parent.document.getElementById("before_menu_med_6").style.display = "none";
							window.parent.document.getElementById("after_menu_med_6").style.display = "	";
							window.parent.document.getElementById("before_menu_med_10").style.display = "none";
							window.parent.document.getElementById("after_menu_med_10").style.display = "";
							window.parent.document.getElementById("before_menu_med_13").style.display = "none";
							window.parent.document.getElementById("after_menu_med_13").style.display = "";
						}
						if('<?php echo $this->input->post('parent_id'); ?>' == 'firstmedia' )
						{
							parent.jQuery('#media_1').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_2').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_4').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_5').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_7').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_8').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_9').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_11').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_12').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_14').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
							parent.jQuery('#media_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
							parent.jQuery('#media_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
							parent.jQuery('#media_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
							parent.jQuery('#media_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
							parent.jQuery('#media_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
							parent.jQuery('#media_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
							parent.jQuery('#media_11').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/11");
							parent.jQuery('#media_12').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/12");
							parent.jQuery('#media_14').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/14");
							
							window.parent.document.getElementById("db_media_1").value = mediaid;
							window.parent.document.getElementById("db_media_2").value = mediaid;

							window.parent.document.getElementById("db_media_4").value = mediaid;
							window.parent.document.getElementById("db_media_5").value = mediaid;

							window.parent.document.getElementById("db_media_7").value = mediaid;
							window.parent.document.getElementById("db_media_8").value = mediaid;
							window.parent.document.getElementById("db_media_9").value = mediaid;

							window.parent.document.getElementById("db_media_11").value = mediaid;
							window.parent.document.getElementById("db_media_12").value = mediaid;

							window.parent.document.getElementById("db_media_14").value = mediaid;

							window.parent.document.getElementById("before_menu_med_7").style.display = "none";
							window.parent.document.getElementById("after_menu_med_7").style.display = "";
							window.parent.document.getElementById("before_menu_med_8").style.display = "none";
							window.parent.document.getElementById("after_menu_med_8").style.display = "";
							window.parent.document.getElementById("before_menu_med_9").style.display = "none";
							window.parent.document.getElementById("after_menu_med_9").style.display = "";

							window.parent.document.getElementById("before_menu_med_11").style.display = "none";
							window.parent.document.getElementById("after_menu_med_11").style.display = "";
							window.parent.document.getElementById("before_menu_med_12").style.display = "none";
							window.parent.document.getElementById("after_menu_med_12").style.display = "";

							window.parent.document.getElementById("before_menu_med_14").style.display = "none";
							window.parent.document.getElementById("after_menu_med_14").style.display = "";
							window.parent.document.getElementById("before_menu_med_1").style.display = "none";
							window.parent.document.getElementById("after_menu_med_1").style.display = "";
							window.parent.document.getElementById("before_menu_med_2").style.display = "none";
							window.parent.document.getElementById("after_menu_med_2").style.display = "";

							window.parent.document.getElementById("before_menu_med_4").style.display = "none";
							window.parent.document.getElementById("after_menu_med_4").style.display = "";
							window.parent.document.getElementById("before_menu_med_5").style.display = "none";
							window.parent.document.getElementById("after_menu_med_5").style.display = "";
						}
						//parent.jQuery.colorbox.close();
						$("#cboxClose",parent.document).click();
					});
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		}
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	function edit($id = FALSE, $parent_id = FALSE) 
	{
		$u_data = $this->session->userdata('logged_in');
	    $m_id = $this->uri->segment(3);
	    $createdBy = $this->medias_model->mediasCreatedBy($m_id);
	    if((@$createdBy[0]->created_by != $u_data['id'] && $u_data['groupid'] != '4') || empty($createdBy))
        {
          redirect('category/pagenotfound'); 
        }

		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($maccessarr['media']=='own') || ($maccessarr['media']=='modify_all'))    
		{
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
				
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		$id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('medias/');
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];

		$this->template->title("Edit Media");
		$this->template->set('media', $this->medias_model->getItems($id, $user_id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id', $id);
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo());
		//$this->template->set('teachers',$this->medias_model->getUsers(3));
        $this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));

		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));

		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');
		$this->form_validation->set_rules('type', '-', 'required');
       // $this->form_validation->set_rules('width_v', 'width', 'integer');
		$this->form_validation->set_rules('height_v', 'height', 'integer');
		//$this->form_validation->set_rules('width_a', 'width', 'integer');
	   //	$this->form_validation->set_rules('width', 'width', 'integer');
		$this->form_validation->set_rules('height', 'height', 'integer');
		$this->form_validation->set_rules('media_fullpx', 'Image size', 'integer');
        if($this->input->post('url')&& $this->input->post('url')!='http://') 
        {
                    $rules = array(
                    array
                    (
                     'field'   => 'url',
                     'label'   => 'url',
                     'rules'   => 'trim|required|callback_url_checking',
                     )
            );
        $this->form_validation->set_rules($rules);
        }
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('medias/create');
			//$this->template->build('medias/edit/'.$id);
            // http://192.168.1.13/mlms_wp/wallmart3/admin/medias/edit/128
		}
		else
		{
			$data['medias'] = $this->medias_model->getItems($id,$user_id);  //$this->input->post('id', TRUE)
			$this->template->set('medias',$data['medias']);			
		   
			// $alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$type = $this->input->post('type');
			$mediastype ="";
            $filenameby_type = ($this->input->post('imagename')) ? $this->input->post('imagename') : $data['medias']->local;
			$filenamebytype ="";

			switch ($type):
			case 'video':

				if($_FILES['file_v']['name'])
						{
							$video_param  = $this->upload_file_v();

							if($video_param['filename'])
							{
								$filenamebytype = $video_param['filename'];
							}
							
						}
						 if($video_param['status'] == 'error')
						   {
								$this->template->set('upload_error',  $video_param['msg']);

								$this->template->build('medias/create');
								return FALSE;
						   }
						   else
						    {
					
							}
					$mediastype ="Video";
				break;
			case 'audio':

					if($_FILES['file_a']['name'])
						{
							$audio_param  = $this->upload_file_a();
							if($audio_param['filename'])
							{
								$filenamebytype = $audio_param['filename'];
							}
							
						}
						if($audio_param['status'] == 'error')
					   {
							$this->template->set('upload_error',  $audio_param['msg']);

							
							$this->template->build('medias/create');
							return FALSE;
					   }
					   else
						  {
					     }
					    $mediastype ="Audio";

				break;
			case 'docs':
                 if($_FILES['file_d']['name'])
						{
							$doc_param = $this->upload_file_d();
							if($doc_param['filename'])
							{
								$filenamebytype = $doc_param['filename'];
							}
							

						}
						if($doc_param['status'] == 'error')
						{
							$this->template->set('upload_error',$doc_param['msg']);
							$this->template->build('medias/create');
							return FALSE;
						}
						else 
						{
           			   }
           			   $mediastype ="Document";
				break;            
			case 'image':				
					
					if($_FILES['file_i']['name'])
						{
							$image_param  = $this->upload_file_i();
						}
					if($image_param)
					{
						$filenamebytype = $image_param['filename'];

					}
					$mediastype ="Image";						

				break;
            
			case 'file':

                if($_FILES['file_f']['name'])
					{
						$file_param = $this->upload_file_f();

						if($file_param['filename'])
							{
								$filenamebytype = $file_param['filename']; 
							}
							
					}
					
				
					if($file_param['status'] == 'error')
					{
						  
						$this->template->set('upload_error',$file_param['msg']);
						$this->template->build('medias/createsectiontext');
						return FALSE;
					}
					else 
					{
                
					}
					$mediastype ="Flash";
				break;
			default:

			endswitch;

		// 	$form_data = array(
		// 	'type' => $type,
		// 	'name' => $this->input->post('name'),
		// 	'category_id' => $this->input->post('category_id'),
		// 	'published' => $this->input->post('published'),
		// 	'instructions' => $this->input->post('instructions'),
		// 	'source' => $sourcebytype,
		// 	'uploaded' => $this->input->post('uploaded'),
		// 	'code' => $codebytype,
		// 	'url' => $urlbytype,
		// 	'local' => $filenamebytype,
  //           'width' => $widthbytype,
		// 	'height' => $heightbytype,
		// 	'option_video_size' => $this->input->post('option_video_size'),
		// 	'auto_play' => $this->input->post('autoplay'),
		// 	'show_instruction' => $this->input->post('show_instruction'),

		// );
			if($filenamebytype)
			{
				$form_data = array(
			'media_title' => $filenamebytype,
			'alt_title' => $this->input->post('name'),
			'type' => $mediastype,			
			'category_id' => $this->input->post('category_id'),
			'publish' => $this->input->post('published'),
			'created_by' => $user_id,
				);
			}
			else
			{
			$form_data = array(			
			'alt_title' => $this->input->post('name'),
			'type' => $mediastype,			
			'category_id' => $this->input->post('category_id'),
			'publish' => $this->input->post('published'),
			'created_by' => $user_id,
				);
		  }


       //  print_r($form_data);exit;
			$isupdated=$this->medias_model->updateItem($id,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				foreach ($files_to_delete as $index)
				{
					if ( is_file(FCPATH.'public/uploads/medias/img/'.$index) )
						unlink(FCPATH.'public/uploads/medias/img/'.$index);
					
					if ( is_file(FCPATH.'public/uploads/medias/img/thumbs/'.$index) )
						unlink(FCPATH.'public/uploads/medias/img/thumbs/'.$index);
				}
				//redirect('medias/'.$parent_id);
				redirect('course-media/manage');
			}

			//if ($category->is_invalid())
			else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				//redirect('medias/'.$parent_id);
				redirect('course-media/manage');	
			}	
	  	} 
		}
		else
		{
			//echo "<script type='text/javascript'>alert('You have not Permission to edit');</script>";
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to edit' ) );
			redirect('category/pagenotfound');
		}
	}



	function preview($id = FALSE, $parent_id = FALSE)
	{
		//load block submit helper and append in the head
        //error_reporting(0);
        //parent_id is media id
        //echo $id."_".$parent_id.
        $this->load->library('upload');
		$this->template->append_metadata(block_submit_button());
       // $this->load->helper('file');


       // $this->load->helper('file');
/*$extensions = array('txt', 'jpeg', 'png','gif');
$filenames = get_filenames_by_extension(base_url().'public/uploads/documents/', $extensions);
print_r($filenames);  exit;*/
       /*
        $filename = base_url().'public/uploads/documents/demotext.txt';
$handle = fopen($filename, "r");
print_r($handle);
print_r(filesize($filename));
$contents = fread($handle, filesize($filename));
print_r($contents);
fclose($handle);   exit;

*/
//$file_info = $this->medias_model->fileslist('public/uploads/files', 'file');
//$file_info[0]->filename;
            // echo filesize($file_info[0]->filename);

       // print_r($this->medias_model->fileslist('public/uploads/files', 'file'));
         //$file_info = get_file_info(base_url().'public/uploads/documents/', 'size');
         //echo base_url().'public/uploads/documents/';
         //$file_info = get_dir_file_info(base_url().'public/uploads/documents/', $top_level_only = TRUE);
          //print_r($file_info);
       // $imgsize = getimagesize(base_url().'public/uploads/documents/demotext.txt');

		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		//echo $parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		//$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
        $type = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : '';
		$id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('medias/');
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));

		$sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
		$this->template->title("Edit Program");
		$this->template->set('media', $this->medias_model->getItemsNew($id,$user_id));
		$this->template->set('updType', 'edit');
		$this->template->set('type', $type);
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getUsers(3));
        $this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));

		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));

		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('medias/preview');
		}
	}

	function delete($id = NULL)
	{
		$mediarel_id = $this->medias_model->getmediarelProgram($id);

	    if($mediarel_id)
	    {
	    ?>
	    <script>
	    //alert('This media must be assigned to any of the course. You cannot delete it.');
	    document.location.href = window.location.origin+'/medias/';
	    </script>
	    <?php
	    }
	    else
	    {
	    		//filter & Sanitize $id
				$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
				//redirect if it´s no correct
				if (!$id){
					$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
					redirect('medias/');
				}
				
				
				
				$isdelete=$this->medias_model->deleteItem($id);	
				
				//delete the item
				if ($isdelete) 
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
				}	

				//if ($category->category_id)
				//redirect('medias/'.$category->category_id);
				//else
				 // redirect('medias');
				redirect('course-media/manage');
			    }
	}
	
 /*	function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('medias/');
		}
		
		
		
		$isdelete=$this->medias_model->deleteItem($id);	
		
		//delete the item
		if ($isdelete) 
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}	

		//if ($category->category_id)
		//redirect('medias/'.$category->category_id);
		//else
		 redirect('medias');

	} */

    function delete_from_course($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('medias/');
		}
		$isdelete=$this->medias_model->deleteItem($id);

		//delete the item
		if ($isdelete)
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}

        if($mid){
           redirect('medias/edit/'.$mid);
        }
			redirect('medias/create');

	}
	
	public function activation($action = FALSE, $pid = FALSE)
	{
	$this->uri->segment(5);
	$pid = ($this->uri->segment(5) != 0) ? filter_var($this->uri->segment(5), FILTER_VALIDATE_INT) : NULL;
	$action = ($this->uri->segment(4) != '') ? filter_var($this->uri->segment(4), FILTER_SANITIZE_STRING) : NULL;
		//redirect if it´s no correct
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('medias/');
			}
		if($action=='deactivate'){
		$action=0;
		}else if($action=='activate'){
		$action=1;
		}else{
		$action=NULL;
		}
		
	$activation=$this->medias_model->activationItem($pid,$action);
	//print_r($activation);
		//delete the item
		if ($activation) 
		{
            if($action==1){
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Media activated successfully!' ));
            }else{
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Media deactivated successfully!' ));
            }
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Media activation fail!' ) );
		}
		redirect('medias');		
	}
	
	private function set_upload_options($controller)
	{	
		//upload an image options
		$config = array();
		$config['upload_path'] = FCPATH.'public/uploads/'.$controller.'/img/';
		$config['allowed_types'] = 'gif|jpg|png|3gpp';
		$config['encrypt_name']	= TRUE;
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		//create controller upload folder if not exists
		if (!is_dir($config['upload_path']))
		{
			mkdir(FCPATH."public/uploads/$controller/");
			mkdir($config['upload_path']);
			mkdir($config['upload_path']."thumbs/");
		}
			
		return $config;
	}


	private function set_thumbnail_options($info_upload, $controller)
	{
		$config = array();
		$config['image_library'] = 'gd2';
		$config['source_image'] = FCPATH.'public/uploads/'.$controller.'/img/'.$info_upload["file_name"];
		$config['new_image'] = FCPATH.'public/uploads/'.$controller.'/img/thumbs/'.$info_upload["file_name"];
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['master_dim'] = 'width';
		$config['width'] = 100;
		$config['height'] = 100;
		$config['thumb_marker'] = '';

		return $config;
	}
	
	

	

	
	

	/* file uploading */
	
	public function upload_file_i()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
       $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file_i';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }
	   
	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/images';
		  $config['allowed_types'] = 'gif|jpg|png';
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $generate.$_FILES['orig_name'];
	      //print_r($config);
		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
			 $file_id = true;
             $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
                $status = "success";
				$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/images/'.$data['file_name'];
        		$config['new_image'] = FCPATH.'public/uploads/images/thumbs/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                //$config['width'] = 232;
                //$config['height'] = 216;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                //$this->image_lib->resize();
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   return array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}
	
	public function upload_file_v()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
	   error_reporting(0);
       $status = "";
	   $msg = "";
	   $ftpfiles_v = array();
	   $file_element_name = 'file_v';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/videos';
		  $config['allowed_types'] = 'mp4';  //'ax|amv|asf|gif|3gp|avi|mp4|fla|swf|mov|mpg|mpeg|rm|wma';
		  /*ax, amv, asf, gif, 3gp, avi, mp4, fla, swf, mov, mpg, mpeg, rm*/
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
	      $fl_name = $config['file_name'];
		  
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
             $ftpfiles_v = $this->medias_model->fileslist('public/uploads/videos', 'video');
			 $file_id = true;
			 $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	    return  array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}
	public function upload_file_a()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
	 error_reporting(0);
       $status = "";
	   $msg = "";
	   $ftpfiles_a = array();
	   $file_element_name = 'file_a';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }
	   
	   if ($status != "error")
	   {
	      $config['upload_path'] = 'public/uploads/audio';
		  $config['allowed_types'] = 'aac|aob|ada|au|mid|midi|mp3|ogg|wav';
		  /*aac, aob, ada, au, mid, midi, mp3, ogg, wav*/
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];

		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
			 $data = $this->upload->data();
			 $ftpfiles_a = $this->medias_model->fileslist('public/uploads/audio', 'audio');
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($ftpfiles_a)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	    return array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}
	public function upload_file_d()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
	   error_reporting(0);
       $status = "";
	   $msg = "";
	   $ftpfiles_d = array();
	   $file_element_name = 'file_d';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }
	   
	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/documents';
		  //$config['allowed_types'] = 'doc|docx|txt|pdf|csv|htm|html|xhtml|xml|sxw|rtf|odt|css|odp|pps|ppt|sxi';
		  /*doc, docx, txt, pdf, csv, htm, html, xhtml, xml, sxw, rtf, odt, css, odp, pps, ppt, sxi*/
		  $config['allowed_types'] = 'rar|zip|doc|docx|ppt|pptx|pdf|txt';
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
	 
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
             $ftpfiles_d = $this->medias_model->fileslist('public/uploads/documents', 'document');
			 $file_id = true;
			 $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	    return array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}
	
	public function upload_file_f()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
		error_reporting(0);

       $status = "";
	   $msg = "";
	   $ftpfiles_f = array();
	   $file_element_name = 'file_f';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/videos';
		  $config['allowed_types'] = 'jpg|png|gif|bmp|rar|zip|doc|docx|ppt|pptx|pdf|txt|swf|mp3|avi|mp4|mpeg';
		  /* exe, zip*/
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
	 
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
             $ftpfiles_d = $this->medias_model->fileslist('public/uploads/files', 'file');
			 $file_id = true;
             $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	   return array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}

	public function upload_exerfile_f()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
		error_reporting(0);

       $status = "";
	   $msg = "";
	   $ftpfiles_f = array();
	   $file_element_name = 'file_f';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/files';
		  $config['allowed_types'] = 'jpg|png|gif|bmp|rar|zip|doc|docx|ppt|pptx|pdf|txt';
		  /* exe, zip*/
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
	 
		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
             $ftpfiles_d = $this->medias_model->fileslist('public/uploads/files', 'file');
			 $file_id = true;
             $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	   return array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']);
	}



    public function publish($pid = FALSE){
    	$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('medias/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $pid;
				$publish=$this->medias_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Medias published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Medias publish action fail or already published!' ) );
				}
                if($mid){
                 redirect('medias/edit/'.$mid);
                }
				redirect('medias/create/');

			}
	}

	public function unpublish($pid = FALSE){
		$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('medias/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $pid;
				$unpublish=$this->medias_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Medias unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Medias unpublish action fail or already unpublished!' ) );
				}
                if($mid){
                 redirect('medias/edit/'.$mid);
                }
				redirect('medias/create/');

			}
	}


   public function url_checking($str){
         $this->form_validation->set_message('url','That %s already exists.');
         $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
         if (!preg_match($pattern, $str))
         {
         $this->form_validation->set_message('url_checking', 'Invalid Url');
         return FALSE;

          }

         return TRUE;
	}

	public function removeToPublish()
   {
	//$this->load->model('admin/programs_model');

    $publishID = $_POST['id'];
	$result = $this->medias_model->removetopublish_model($publishID);
	if($result)
	{
		echo"remove";
		return true;
	}
	return false;
  }

  public function addToPublish()
{
	//$this->load->model('admin/programs_model');

    $publishID = $_POST['id'];
	$result = $this->medias_model->addtopublish_model($publishID);
	if($result)
	{
		echo"add";
		return true;
	}
	return false;
}


function cropmediaimg()
	{
		$this->template->build('medias/cropmediaimg');
	}

	public function uploadmadiaimg()
    {			  
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		
		
		
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];

		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'-'.$month.'-'.$date.'-'.$year;

  		echo $generate1 . '.png';

		
		$file1 = FCPATH.'public/uploads/images/'. $generate1 . '.png';
		if(file_put_contents($file1, $data))//for upload file to the server
		{
			//executed
			$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/images/'.$generate1 . '.png';
        		$config['new_image'] = FCPATH.'public/uploads/images/thumbs/'.$generate1 . '.png';
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 430;
                $config['height'] = 430;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';//executed
		}
		$course_id = $this->uri->segment(3);
		
		// if($this->uri->segment(5) == 'courseedit')
		// {

		// $form_data =  array(						
		// 			'local' => $generate1.".png"											
		// 			);
 	// 	$isupdated=$this->medias_model->updateItem($id,$form_data);

 	//    } 
 	   
		
    }

    function cropmediaimgsec()
	{
		$this->template->build('medias/cropmediaimgsec');
	}

	function createmediacategorypop()
	{
		$this->load->view('medias/createmediacategories');
	}

	function savemediacategory()
	{
		$this->load->model('mcategories_model');
	 $program_name = $this->input->post('name');
	 $program_description = $this->input->post('description');
	 $program_category_id = $this->input->post('category_id');
	 $program_published = $this->input->post('published');	
	   
	   // echo"-".$program_name;
	   // echo"-".$program_description;
	   // echo"-".$program_category_id;
	   // echo"-".$program_published;

	 	$sessionarray = $this->session->userdata('logged_in');		
	    $user_id = $sessionarray['id'];	   
		   $alias = $this->input->post('name');
	   		$maxrow=null;
           $orderingval = 0;
		   $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
           $data = array(
			'name' => $program_name,
			'description' => $program_description,
			'parent_id' => $program_category_id,
			'child_id' => $alias,
			'metatitle' => $alias,
			'metakey' => $alias,
			'metadesc' => $alias,
            'created_by' => $user_id,
			'published' => $program_published
			);
			$rs = $this->mcategories_model->insertItems($data);
	   echo $rs; 
	   //echo $program_published;
	}
	function create_exe_cat(){
		$this->template->build('medias/create_exercise_cat');
	}
	function saveexecategory()
	{
      $program_name = $this->input->post('name');
     //  $sessionarray = $this->session->userdata('logged_in');		
	    // $user_id = $sessionarray['id'];
      //echo $program_name;
	    $data = array(
			'name' => $program_name       
		);

		$this->program_model->insertExeCategory($data);
		print_r($data);
		
	}
	
}