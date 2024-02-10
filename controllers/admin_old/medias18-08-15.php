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
		$this->authenticate();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->model('admin/medias_model');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
		$this->lang->load('tooltip', 'english');
	}

	function authenticate()
    {
      $session = $this->session->userdata('loggedin');
     // print_r($session);
      if(!$this->session->userdata('loggedin'))
      {
       redirect('admin/users/login');
      }
    }
	
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

	public function ajaxmediaview($media_id = NULL){
	error_reporting(0);
	$media_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
   	$frame_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '' ;
	$media = $this->medias_model->getItems($media_id);	
   // print_r($media);
	?>
		<div id="movieframe<?php echo $frame_id;?>">
		<?php
		if($media->type == "docs"){
		echo "The selected element is a text file that can't have a preview";
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
		echo "<img style=\"max-width: 400px;\" src=\"".base_url()."public/uploads/images/".$media->local."\">";
		exit;
		}else{?>
				<?php
				if($media->source == 'url'){
				?>
					<?php if(preg_match('/http:\/\/(www\.)*vimeo\.com\/.*/',$media->url)){
					$vimeoid = $this->getVimeoInfo($media->url);
					$this->callvimeoplayer($vimeoid,400,300);
					}else{
					$this->calljwplayer($media->url,'url',$type);
					}
				}elseif($media->source == 'local'){
				$this->calljwplayer($media->local,'local',$media->type,$frame_id);

				?>
				<?php }elseif($media->source == 'code'){    //changes by sachin add only elseif condition
					echo $media->code;
				}
				?>
		</div>
		<?php
		}
   }


	public function callvimeoplayer($vimeoid,$width,$height)
	{
	?>
	<object width="<?php echo $width;?>" height="<?php echo $height;?>">
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
					<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />
					<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"
						type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" width="<?php echo $width;?>" height="<?php echo $height;?>"></embed>
	</object>
	<?php
	}function calljwplayer($jwurl,$source,$type,$frame_id)	{	  //echo $frame_id;   /*   echo $jwurl;      echo "<br />";      echo $source;      echo "<br />";      echo $type;      echo "<br />";      echo $frame_id;      echo "<br />";    */      //echo base_url()."public/uploads/videos/".$jwurl;	?>	<script type="text/javascript" src="<?php echo base_url();?>public/jwplayer/vimeojwplayer.js"></script>				<div id="mediaspace<?php echo $frame_id;?>" style='width:640px;height:480px;'></div>					<script type='text/javascript'>						jwplayer('mediaspace<?php echo $frame_id;?>').setup({							flashplayer: '<?php echo base_url();?>public/jwplayer/player.swf',							<?php if($source == "local" && $type == 'audio'){?>							file: '<?php echo base_url()."public/uploads/audio/".$jwurl;?>',                            <?php } elseif($source == "local" && $type == 'video'){ ?>                        	file: '<?php echo base_url()."public/uploads/videos/".$jwurl;?>',                            <?php }else{ ?>							file: '<?php echo $jwurl;?>',							<?php }?>							controlbar: 'bottom',                            primary: "flash",							width: '400',							height: '300'						});					</script>	<?php	}
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
	  //print_r($_POST);
      $this->session->unset_userdata('sess_media');
	  $this->template->set_layout('backend');
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


       $path=base_url() . "admin/medias/";

      $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "admin/medias/";
       $this->load->library('pagination');
       $term = NULL;
       
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
	   $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');
       $this->template->set("search_string", $search_string);
       $this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('mediatype',$this->medias_model->getMediaType());	   	    $this->template->set("countusers", $this->medias_model->getcountUsers());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/list');
	}


	function createlecturemedia($parent_id = FALSE)
	{
	   
		
        $sessionarray = $this->session->userdata('loggedin');
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

		$mediagroup = $this->uri->segment(4);
		
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
			
		    $this->template->build('admin/medias/createlecturemedia');
			//$this->load->view('templates/header', $data);
			//$this->load->view('medias/create');
			//$this->load->view('templates/footer');			
		}
		else
		{  
	       
	       
			/* foreach ($_FILES as $index => $value)
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
						$this->template->build('medias/createlecturemedia');

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
							$this->template->build('medias/createlecturemedia');

							return FALSE;
						}
					}
				}
			} */
			
			   

			  
				
			 
			   
				
				
				
			
			
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
							$this->template->build('admin/medias/createlecturemedia');

							return FALSE;
					   }
					   else {
								$codebytype = $this->input->post('code_v');
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
							$this->template->build('admin/medias/createlecturemedia');

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
							$this->template->build('admin/medias/createlecturemedia');

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
							if($image_param['ftpfilearray'])
							{
								$filenamebytype = $image_param['ftpfilearray'];
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


			$inserted_id = $this->medias_model->insertItems($data);
				
			if($inserted_id){
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);
			?>
			<script>
				    var mediaid = '<?php echo $media->id; ?>';
				    var mediagroup = 'firstmedia';
					if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>' ) 
						{
							parent.jQuery('#media_3').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_6').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_10').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_13').html('<img src="<?php echo base_url(); ?>public/images/loading.gif" />');	
							parent.jQuery('#media_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/3");
							parent.jQuery('#media_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/6");
							parent.jQuery('#media_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/10");
							parent.jQuery('#media_13').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/13");
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
						if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>' )
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
							parent.jQuery('#media_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/1");
							parent.jQuery('#media_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/2");
							parent.jQuery('#media_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/4");
							parent.jQuery('#media_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/5");
							parent.jQuery('#media_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/7");
							parent.jQuery('#media_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/8");
							parent.jQuery('#media_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/9");
							parent.jQuery('#media_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/11");
							parent.jQuery('#media_12').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/12");
							parent.jQuery('#media_14').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/14");
							
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
						parent.jQuery.fancybox.close();
					
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		}
		
	}


   public function ajaxaddmedia($medlay = NULL,$medid = NULL)
	{
	  $this->session->unset_userdata('sess_ajaxmedia');
	  $parent_id = NULL;
      $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
      $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
      $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
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
       $path=base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
        $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
       $baseurl = base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
     
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $term = "type != 'text'";
      $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
      
     
       $this->pagination->initialize($config);
       $this->template->title('Media List');
	   //	if($parent_id){
      //$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   //	}else{
	   //	$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$config['uri_segment']));
       // $config['per_page']='';
       // $start='';

     
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   $this->template->set("countmedias", $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type));

	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/ajaxaddmedia');
	}
    //Add module media
    public function ajaxaddmodulemedia($medlay = NULL,$medid = NULL)
	{
	  $this->session->unset_userdata('sess_ajaxmedia');
	  $parent_id = NULL;
      $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
      $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
      $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
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
       $path=base_url() . "admin/medias/ajaxaddmodulemedia/".$medlay."/".$medid;
      //$config["base_url"] = base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
      // $this->load->library('pagination');
       $term = "type != 'text'";
       //$config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
      // $config["base_url"] = $baseurl;
      // $config['per_page'] = 4;
      // $config['enable_query_strings'] = true;
      // $config['uri_segment'] = 6;
    //   $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
     //  $this->pagination->initialize($config);
       $this->template->title('Media List');
	   //	if($parent_id){
      //$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   //	}else{
	   //	$this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$config['uri_segment']));
        $config['per_page']='';
        $start='';

	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type));

	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/ajaxaddmodulemedia');
	}


	public function ajaxaddmedia_org($medlay = NULL,$medid = NULL)
	{

	   $parent_id = NULL;
       $this->load->library('pagination');
       $config["base_url"] = base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
       $config['total_rows'] = $this->medias_model->getmediacount();

       //$config['total_rows'] = 8;
       $config['per_page'] = 4;
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
	   $this->template->build('admin/medias/ajaxaddmedia');
	}

    public function ajaxaddmediatext($medlay = NULL,$medid = NULL)
	{
      $this->session->unset_userdata('sess_ajaxmedia');
      $parent_id = NULL;
      $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
      $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
      $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
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
       $path=base_url() . "admin/medias/ajaxaddmediatext/".$medlay."/".$medid;
       $start = ( $this->uri->segment(6))  ? $this->uri->segment(6) : 0;
       $baseurl = base_url() . "admin/medias/ajaxaddmediatext/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term ="type = 'text'";
      
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 6;
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
       
       $this->pagination->initialize($config);
       $this->template->title('Media List');

		//if($parent_id){
	   //$this->template->set("media", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$type));
	   //	}else{

        //$term = "type != 'text'";
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	    $this->template->set("countmedias", $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/ajaxaddmediatext');
	}
    public function ajaxaddmodulemediatext($medlay = NULL,$medid = NULL)
	{
      $this->session->unset_userdata('sess_ajaxmedia');
      $parent_id = NULL;
      $medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
      $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
      $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
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
       $path=base_url() . "admin/medias/ajaxaddmodulemedia/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "admin/medias/ajaxaddmodulemedia/".$medlay."/".$medid;
       $this->load->library('pagination');
       $term ="type = 'text'";
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
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
	   $this->template->set("medias", $this->medias_model->getajaxMedia($parent_id,$term,$config['per_page'],$start,$search_string,$search_cat,$search_type));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/ajaxaddmodulemediatext');
	}

     public function addmedia($medlay = NULL,$medid = NULL)
	{
     //print_r($_POST);
    $parent_id = NULL;
      //$medlay = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $medlay;
     // $medid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $medid;
     // $start = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : 0;
     // $pid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;
      $sess_ajaxmedia = $this->session->userdata('sess_ajaxmedia');
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_ajaxmedia');
      $search_string = '';
      $search_type = '';
      }else{
      $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_ajaxmedia['searchterm'];

       $search_type = ($this->input->post('type', TRUE)) ? $this->input->post('type', TRUE) : $sess_ajaxmedia['searchtype'];
       $searchdata = array(
				 "searchterm" => $search_string,
				 "searchtype" => $search_type
				 );
	   $this->session->set_userdata('sess_ajaxmedia', $searchdata);
        }
       $path=base_url() . "admin/medias/addmedia/";
       $config["base_url"] = base_url() . "admin/medias/addmedia/";
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
	   $this->template->set("medias", $this->medias_model->getMedia($parent_id,$search_string,$search_type));

	  //	}
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('medfldgroup',$medlay);
	 //  $this->template->set('pid',$pid);
	   $this->template->set('medfldid',$medid);
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/addmedia');
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
       $path=base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
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
	   $this->template->build('admin/medias/addmedia');
	}


	public function ajaxaddmediatext_ORG($medlay = NULL,$medid = NULL)
	{
	   $parent_id = NULL;
       $this->load->library('pagination');
       $config["base_url"] = base_url() . "admin/ajaxaddmedia/".$medlay."/".$medid;
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
	   $this->template->build('admin/medias/ajaxaddmediatext');
	}

	function create($parent_id = FALSE)
	{
	  //print_r($_FILES);exit;
	  $u_data=$this->session->userdata('loggedin');
	  if(($u_data['groupid']=='4'))
	  {
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
		$this->template->set_layout('backend');
		$this->template->append_metadata(block_submit_button());

		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

	   //	$this->_set_rules();


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
		//echo base_url().'public/';
		$this->medias_model->fileslist('public/uploads/audio', 'audio');
		//echo $this->fileslist('public/uploads/audio', 'audio');
		$this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));
		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));
	//$this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/images', 'image'));
		

		/*print_r($filelist['image']);
		foreach($filelist['image'] as $imagelist):
		//print_r($imagelist);
		echo $imagelist->filename;
		echo '<br>';
			endforeach;*/
		//print_r($ftpfiles);echo '<br>';
		
		//echo 'public/uploads/files/'.$ftpfiles[0];
		//$ftpfiles = get_file_info('public/uploads/files/'.$ftpfiles[0]);
		
		//$ftpfiles = get_mime_by_extension('public/uploads/files/'.$ftpfiles[2]);
		
		//$arrar = explode('/',$ftpfiles);print_r($arrar);
		//echo $filetype; 
		//print_r($filetype);
		//exit;
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
		    //echo "error";
			$this->template->build('admin/medias/create');
			//$this->load->view('templates/header', $data);
			//$this->load->view('admin/medias/create');
			//$this->load->view('templates/footer');
			
		}
		else
		{   //print_r($_FILES);

		  /*	foreach ($_FILES as $index => $value)
			{
			   //print_r($index);
			   //print_r($value);

				if ($value['name'] != '')
				{
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('medias'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
						$this->template->build('admin/medias/create');

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
							$this->template->build('admin/medias/create');

							return FALSE;
						}
					}
				}
			} */
		//$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
		 //print_r($form_data_aux[$index]);
		//$orderingval = $this->medias_model->maxorder();
     	//$imagename=($form_data_aux[$index])?$form_data_aux[$index]:'blank.png';
      // $urldisplay = ($this->input->post('display_as2') == 'wrapper') ? 0 : 1;
       // echo $url_display;
       /*if($type == 'docs'){
         if($this->input->post('display_as') == 'wrapper'){
            $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '200'; ;
         }else{
            $width_by_type = '0';
			$height_by_type = '0';
         }
        }*/
		
		
		//$this->upload_file_f();
		
        // $archivename = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : '';
		
	
		
		
		
		
		
        $type = $this->input->post('type');
			switch ($type):
			case 'video':
			
			         $this->upload_file_v();				    
				    
			    if($_FILES['file_v']['name'])
				{
				   $videoname = ($_FILES['file_v']['name']) ? $_FILES['file_v']['name'] : '';	
				   //$videoname = ($videorename['filename']) ? $videorename['filename'] : '';				
				}
				else
				{
				   $videoname = $this->input->post('localfile_v');
				}
			    	
                
				$codebytype = $this->input->post('code_v');
				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $videoname;
				break;
			case 'audio':
			    
			    $filedata = $this->upload_file_a();


				 if($filedata['filename'])
				{
				   $audioname = ($filedata['filename']) ? $filedata['filename'] : '';					
				}
				else
				{
					if($this->input->post('code_a'))
				    {
				   		$audioname = $this->input->post('code_a');
				   	}
				   	if($this->input->post('url_a'))
				   	{
				   		$audioname = $this->input->post('url_a');
				   	}
				}

				
               // $audioname = ($_FILES['file_a']['name']) ? $_FILES['file_a']['name'] : ''; 
			    
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
				$widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $audioname;
				break;
				
            case 'docs':
			    $this->upload_file_d();
				
				if($_FILES['file_d']['name'])
				{
				   $docname = ($_FILES['file_d']['name']) ? $_FILES['file_d']['name'] : '';					
				}
				else
				{
				   $docname = $this->input->post('localfile_d');
				}
		
              // $docname = ($_FILES['file_d']['name']) ? $_FILES['file_d']['name'] : '';
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
				$filenamebytype = $docname;
				$sourcebytype = $this->input->post('source_d');
				$codebytype = NULL;
                $urlbytype = $this->input->post('url_d');
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
			    $this->upload_file_f();
				
				if($_FILES['file_f']['name'])
				{
				   $archivename = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : '';					
				}
				else
				{
				   $archivename = $this->input->post('localfile_f');
				}
		
                //$archivename = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : '';
				
                $codebytype = NULL;
                $sourcebytype = $this->input->post('source_f');
                $widthbytype = '0';
			   	$heightbytype = '0';
				$urlbytype = $this->input->post('url_f');
				$filenamebytype = $archivename;
				//$filenamebytype = $this->input->post('localfile_f');
				break;
            case 'image':
			      $remaneImage = $this->upload_file_i();

				 
				// if($remaneImage['ftpfilearray'])
				// {
				   
				//    $imagename = ($remaneImage['ftpfilearray']) ? $remaneImage['ftpfilearray'] : 'no_image.jpg';					
				// }
				if($this->input->post('cropmedia'))
			      {
			      	$imagename = $this->input->post('cropmedia');
			      }
				else{
						$imagename = 'no_image.jpg';
				  // $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => $remaneImage['msg'] ));
			   //     redirect('admin/medias/create');
				}
		
               // $imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : 'no_image.jpg';
				
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
				$filenamebytype = $imagename;
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
	  //echo '<pre>'; print_r($data); echo '</pre>'; exit;
			if($this->medias_model->insertItems($data)){
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			redirect('admin/medias/'.$parent_id);
			}
		}
	   }
      else {
         $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
			redirect('admin');
      }	  
	}
	
	public function upload_image()

    {
	
	    $this->authenticate();

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

        $config['upload_path'] = FCPATH.'public/uploads/imgages/thumbs/';

        $config['allowed_types'] = 'gif|jpg|png';

        $config['max_size']  = 1024 * 8;

        $config['encrypt_name'] = TRUE;

        $config['overwrite'] = TRUE;

        $config['file_name'] = $_FILES['orig_name'];

              $ftpfiles_i = $_FILES['orig_name'];

           //print_r($config);

        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($file_element_name))

        {

      	 $status = 'error';

      	 $msg = $this->upload->display_errors('', '');

        }

        else

        {

      	$file_id = true;

        $data = $this->upload->data();

      	$file_id = true;

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

            $config['width'] = 75;

            $config['height'] = 50;

    		$config['thumb_marker'] = '';



            $this->load->library('image_lib', $config);



            $this->image_lib->resize();

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

         echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));

    }
	
	function createexercisefile($parent_id = FALSE)
	{
	   
		$u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))
		{
			$sessionarray = $this->session->userdata('loggedin');
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
		    $this->template->build('admin/medias/createexercisefile');
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
						$this->template->build('medias/createexercisefile');

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
							$this->template->build('medias/createexercisefile');

							return FALSE;
						}
					}
				}
			}
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
							$this->template->build('admin/medias/createexercisefile');
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
						$this->template->build('admin/medias/createexercisefile');
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
				//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				$media = $this->medias_model->getMediaExeFile($inserted_id);
				error_reporting(0);
				$medianame = trim(str_replace(' ', '_', $media->name));
			?>
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

							var mycellnine = parent.document.createElement('td');
							mycellnine.style.textAlign = 'left';
							mycellnine.setAttribute("id","tdunpublish"+<?php echo $media->id; ?>);
							mycellnine.setAttribute("<?php echo $medianame;  ?>","tdunpublish");
							myrow.appendChild(mycellnine)

							var mycellfive = parent.document.createElement('td');
							mycellfive.style.textAlign = 'left';
							myrow.appendChild(mycellfive);
							var mycellsix = parent.document.createElement('td');
							mycellsix.style.textAlign = 'left';
							myrow.appendChild(mycellsix);
							var mycellseven = parent.document.createElement('td');
							mycellseven.style.textAlign = 'left';
							myrow.appendChild(mycellseven);
							var mycelleight = parent.document.createElement('td');
							mycelleight.style.textAlign = 'left';
							mycellnine.style.display = 'none';
							myrow.appendChild(mycelleight);

							if( <?php echo $media->published;  ?>==1){
							   yes_no = "publish";
							   publish = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+<?php echo $media->id; ?>+'" class = "publish" onclick="publishbutton(\'publish-'+<?php echo $media->id; ?>+'\');">';
							}else{
							   yes_no = "unpublish";
							   publish = '<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" id="unpublish-'+<?php echo $media->id; ?>+'" class="unpublish" onclick="publishbutton(\'unpublish-'+<?php echo $media->id; ?>+'\');">';
							}
							//var id_string = <?php echo $media->id; ?>;
							//var name_string = <?php echo $media->name;  ?>;
							//var publish_string = <?php echo $media->published;  ?>;
							var order = 'order';
							var guest_access = '<select name="access[]"><option value="0">Students</option><option value="1">Members</option><option value="2">Guests</option></select>'

							var remove = '<a href="javascript:void(0);" onclick="deleteRow(this.parentNode.parentNode.rowIndex)" class="removeele" id="remove'+<?php echo $media->id; ?>+'"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>';

							img_path = "<?php echo base_url(); ?>public/images/admin/doc.gif";
							img_type = '<img src="'+img_path+'" alt="doc type"/>';
							media_id = '<input type="hidden" value="'+<?php echo $media->id; ?>+'" name="media_id[]"/>';
							mycell.innerHTML = <?php echo $media->id; ?>;
							mycelltwo.innerHTML=img_type;
							mycellthree.innerHTML= '<?php echo $media->name;  ?>';
							mycellfour.innerHTML=<?php echo $media->published;  ?>;
							mycellfive.innerHTML=order;
							mycellsix.innerHTML=guest_access;
							mycellseven.innerHTML=remove;
							mycelleight.innerHTML=media_id;
							//parent.jQuery.fancybox.close();
							//return true;
						   window.location.href = '<?php echo base_url();?>admin/medias/createexercisefile';
					  
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
	
	function edit($id = FALSE, $parent_id = FALSE) 
	{
	    $u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))
		{
		$this->template->set_layout('backend');
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
				
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		$id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Program");
		$this->template->set('media', $this->medias_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id', $id);
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
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
        //print_r(validation_errors());
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
           // print_r(validation_errors());
			$this->template->build('admin/medias/create');
			//$this->template->build('admin/medias/edit/'.$id);
           // http://192.168.1.13/mlms_wp/wallmart3/admin/medias/edit/128
		}
		else
		{
			$data['medias'] = $this->medias_model->getItems($this->input->post('id', TRUE));
			
			
		  
			
			$this->template->set('medias',$data['medias']);
			
			
			
			//$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');

			
			
			/*foreach ($_FILES as $index => $value)
			{
				if ($value['name'] != '')
				{
					//initializing the upload library
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('medias'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						
						//load the view and the layout
						$this->template->build('admin/medias/create');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();

						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];

						//Save the name of old files to delete
						array_push($files_to_delete, $data['medias']->$index);

						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'medias'));
						
						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('admin/medias/create');

							return FALSE;
						}
					}
				}
			}	*/
			
			
		   //	$imagename = ($form_data_aux['image']) ? $form_data_aux['image'] : $data['medias']->$index;
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$type = $this->input->post('type');
			
			
			//$this->upload_file_f();
            //$filenameby_type = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : $this->input->post('archpath');
			
		   
			
			
			switch ($type):
			case 'video':
			    $this->upload_file_v();
				if($_FILES['file_v']['name'])
				{
                     $filenameby_type = ($_FILES['file_v']['name']) ? $_FILES['file_v']['name'] : $this->input->post('videopath');
			    }
				elseif($this->input->post('localfile_v'))
				{
				     $filenameby_type = $this->input->post('localfile_v');
				}
				else{
				   $filenameby_type = $this->input->post('videopath');
				}
				$codebytype = $this->input->post('code_v');
				$urlbytype = $this->input->post('url_v');
				$widthbytype = $this->input->post('width_v');
				$heightbytype = $this->input->post('height_v');
				$sourcebytype = $this->input->post('source_v');
				$filenamebytype = $filenameby_type;
				//$filenamebytype = $this->input->post('localfile_v');
				break;
			case 'audio':
			     $filedata = $this->upload_file_a();

				
				if($filedata['filename'])
				{
                     $filenameby_type = ($filedata['filename']) ? $filedata['filename'] : $this->input->post('audiopath');
			    }
				elseif($this->input->post('localfile_a'))
				{
				     $filenameby_type = $this->input->post('localfile_a');
				}
				else{
				   $filenameby_type = $this->input->post('audiopath');
				}
                //$filenameby_type = ($_FILES['file_a']['name']) ? $_FILES['file_a']['name'] : $this->input->post('audiopath');
				$codebytype = $this->input->post('code_a');
				$urlbytype = $this->input->post('url_a');
			    $widthbytype = $this->input->post('width_a');
                $heightbytype = $this->input->post('height_a');
				$sourcebytype = $this->input->post('source_a');
				$filenamebytype = $filenameby_type;
				break;
			case 'docs':
			    $this->upload_file_d();
				
				if($_FILES['file_d']['name'])
				{
                      $filenameby_type = ($_FILES['file_d']['name']) ? $_FILES['file_d']['name'] : $this->input->post('docpath');
			    }
				elseif($this->input->post('localfile_d'))
				{
				     $filenameby_type = $this->input->post('localfile_d');
				}
				else{
				   $filenameby_type = $this->input->post('docpath');
				}
               //$filenameby_type = ($_FILES['file_d']['name']) ? $_FILES['file_d']['name'] : $this->input->post('docpath');
                if($this->input->post('display_as') == 'wrapper'){
                    $width_by_type =($this->input->post('width')) ? $this->input->post('width') : '600';
        			$height_by_type =($this->input->post('height')) ? $this->input->post('height') : '800'; ;
                 }else{
                    $width_by_type = '0';
        			$height_by_type = '0';
                 }
				$urlbytype = $this->input->post('url_d');
                /*$widthbytype = $this->input->post('width_d');
				$heightbytype = $this->input->post('height_d'); */
                $widthbytype = $width_by_type;
				$heightbytype = $height_by_type;
				$filenamebytype = $filenameby_type;
				//$filenamebytype = $this->input->post('localfile_d');
                $sourcebytype = $this->input->post('source_d');
				$codebytype = NULL;
                $urlbytype = $this->input->post('url_d');
				break;
            case 'url':
				$urlbytype = $this->input->post('url');
                $widthbytype = ($this->input->post('display_as2')=='wrapper') ? '0' : '1';
			   	$heightbytype = '200';
				$sourcebytype = NULL;
				$codebytype = NULL;
                $filenamebytype = NULL;

			break;
			case 'art':
				//echo "i equals 1";
				break;
			case 'image':
			     $remaneImage = $this->upload_file_i();
			    
				 
				//  if($remaneImage['ftpfilearray'])
				// {
    //                   $filenameby_type = ($remaneImage['ftpfilearray']) ? $remaneImage['ftpfilearray'] : $this->input->post('imagename');
			 //    }

				
				// else{
				//    $filenameby_type = $this->input->post('imagename');
				// }
			     if($this->input->post('cropmedia'))
					{
						$filenameby_type = $this->input->post('cropmedia');
					}
					else
					{
						$filenameby_type = $this->input->post('cropmediacopy');
					}

				 
                
                $widthbytype = ($this->input->post('media_prop')=='w') ? $this->input->post('media_fullpx') : '0';
                $heightbytype = ($this->input->post('media_prop')=='h') ? $this->input->post('media_fullpx') : '0';
                $codebytype = NULL;
				$urlbytype = NULL;
                $mediaprop = $this->input->post('media_prop');
				$sourcebytype = NULL;
				$filenamebytype = $filenameby_type;


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
			    $this->upload_file_f();
				
				if($_FILES['file_f']['name'])
				{
                      $filenameby_type = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : $this->input->post('archpath');
			    }
				elseif($this->input->post('localfile_f'))
				{
				     $filenameby_type = $this->input->post('localfile_f');
				}
				else{
				   $filenameby_type = $this->input->post('imagename');
				}
                //$filenameby_type = ($_FILES['file_f']['name']) ? $_FILES['file_f']['name'] : $this->input->post('archpath');
                $codebytype = NULL;
				$sourcebytype = $this->input->post('source_f');
                $widthbytype = '0';
			   	$heightbytype = '0';
				$urlbytype = $this->input->post('url_f');
				$filenamebytype = $filenameby_type;
				//$filenamebytype = $this->input->post('localfile_f');
				//$urlbytype = $this->input->post('url_f');
				//$filenamebytype = $this->input->post('localfile_f');
				break;
			default:

			endswitch;

			$form_data = array(
			'type' => $type,
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
			'option_video_size' => $this->input->post('option_video_size'),
			'auto_play' => $this->input->post('autoplay'),
			'show_instruction' => $this->input->post('show_instruction'),

		);
		
		

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
				redirect('admin/medias/'.$parent_id);
			}

			//if ($category->is_invalid())
			else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/medias/'.$parent_id);	
			}	
	  	} 
	   }
      else {
          $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to Edit' ) );
				redirect('admin');
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
        $type = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '';
		$id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Program");
		$this->template->set('media', $this->medias_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('type', $type);
		$this->template->set('mediatype',$this->medias_model->getMediaType());
		//$this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
		//$this->template->set('teachers',$this->medias_model->getUsers(3));
        $this->template->set('ftpfiles',$this->medias_model->fileslist('public/uploads/files', 'file'));
		$this->template->set('ftpaudio',$this->medias_model->fileslist('public/uploads/audio', 'audio'));
		$this->template->set('ftpvideos',$this->medias_model->fileslist('public/uploads/videos', 'video'));

		$this->template->set('ftpdocuments',$this->medias_model->fileslist('public/uploads/documents', 'document'));

		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/medias/preview');
		}
	}

	function delete($id = NULL)
	{
		$mediarel_id = $this->medias_model->getmediarelProgram($id);

	    if($mediarel_id)
	    {
	    ?>
	    <script>
	    alert('This media must be assigned to any of the course. You cannot delete it.');
	    document.location.href = window.location.origin+'/admin/medias/';
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
				redirect('admin/medias/');
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
			//redirect('admin/medias/'.$category->category_id);
			//else
			 redirect('admin/medias');
	    }
	}
	
	/*function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
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
		//redirect('admin/medias/'.$category->category_id);
		//else
		 redirect('admin/medias');

	} */

    function delete_from_course($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
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
           redirect('admin/medias/edit/'.$mid);
        }
			redirect('admin/medias/create');

	}

	function createlecturetext($parent_id = FALSE)
	{
	   
		
        $sessionarray = $this->session->userdata('loggedin');
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

		$mediagroup = $this->uri->segment(4);


		$this->template->set('mediagroup', $mediagroup);
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
		    $this->template->build('admin/medias/createlecturetext');
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
							$this->template->build('admin/medias/createlecturetext');
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
						$this->template->build('admin/medias/createlecturetext');
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
				    var mediagroup = 'firsttext';
					if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>') {
						parent.jQuery('#text_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/11");
						window.parent.document.getElementById("db_text_11").value = mediaid;
						window.parent.document.getElementById("before_menu_txt_11").style.display = "none";
						window.parent.document.getElementById("after_menu_txt_11").style.display = "";
						}
						if(mediagroup == '<?php echo $this->input->post('parent_id'); ?>'){
						parent.jQuery('#text_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/1");
						parent.jQuery('#text_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/2");
						parent.jQuery('#text_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/3");
						parent.jQuery('#text_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/4");
						parent.jQuery('#text_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/5");
						parent.jQuery('#text_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/6");
						parent.jQuery('#text_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/7");
						parent.jQuery('#text_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/8");
						parent.jQuery('#text_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/9");
						parent.jQuery('#text_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/"+mediaid+"/10");
						
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
					 parent.jQuery.fancybox.close();				
			</script>
			<?php
						
				
				//redirect('medias/create'.$parent_id);
			}
		  }
		
	}
	
	public function activation($action = FALSE, $pid = FALSE)
	{
	$this->uri->segment(5);
	$pid = ($this->uri->segment(5) != 0) ? filter_var($this->uri->segment(5), FILTER_VALIDATE_INT) : NULL;
	$action = ($this->uri->segment(4) != '') ? filter_var($this->uri->segment(4), FILTER_SANITIZE_STRING) : NULL;
		//redirect if it´s no correct
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/medias/');
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
		redirect('admin/medias');		
	}
	
	private function set_upload_options($controller)
	{	
		//upload an image options
		$config = array();
		$config['upload_path'] = FCPATH.'public/uploads/'.$controller.'/img/';
		$config['allowed_types'] = 'gif|jpg|png';
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
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['upload_path'] = 'public/uploads/images/';
		  $config['allowed_types'] = 'gif|jpg|png';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] =$generate.$_FILES['orig_name'];
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
                $config['width'] = 232;
                $config['height'] = 216;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
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
	   //json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	   return array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']);
	}
	
	public function upload_file_v()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['allowed_types'] = 'ax|amv|asf|gif|3gp|avi|mp4|fla|swf|mov|mpg|mpeg|rm|wma';
		  /*ax, amv, asf, gif, 3gp, avi, mp4, fla, swf, mov, mpg, mpeg, rm*/
		  $config['max_size']  = 1024 * 8;
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
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['max_size']  = 1024 * 8;
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
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['allowed_types'] = 'doc|docx|txt|pdf|csv|htm|html|xhtml|xml|sxw|rtf|odt|css|odp|pps|ppt|sxi';
		  /*doc, docx, txt, pdf, csv, htm, html, xhtml, xml, sxw, rtf, odt, css, odp, pps, ppt, sxi*/
		  $config['max_size']  = 1024 * 8;
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
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['allowed_types'] = 'zip';
		  /* exe, zip*/
		  $config['max_size']  = 1024 * 8;
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
			redirect('admin/medias/');
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
                 redirect('admin/medias/edit/'.$mid);
                }
				redirect('admin/medias/create/');

			}
	}

	public function unpublish($pid = FALSE){
		$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/medias/');
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
                 redirect('admin/medias/edit/'.$mid);
                }
				redirect('admin/medias/create/');

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

		public function getImage()
	{
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file';
	   if(empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/default/images';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
          $ftpfiles_i = $_FILES['orig_name'];
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
        		$config['source_image'] = base_url().'public/default/images/'.$data['file_name'];
        		$config['new_image'] =  FCPATH.'public/default/images/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 251;
                $config['height'] = 142;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';

				//$this->image_lib->resize();
				// if ( ! $this->image_lib->crop())
				// {
				//    echo $this->image_lib->display_errors();
				// }	

                //$this->load->library('md_image');
                //$config = array();
                /*$this->load->library('upload', $config);
		        $source=FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
		        $width=250;
		        $height=140;
		        $size = getimagesize($source);
		        $resize_height=($size[1]*250)/$size[0];
		        $dest = FALSE;
	            $config['image_library'] = 'gd2';//imagemagik
	            //$config['source_image'] = 'assets/img/hotellist/'.$data1['hotel_pictures'];
	            $config['source_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
	            $config['create_thumb'] = FALSE;
	            $config['maintain_ratio'] = TRUE;
	            $config['width']     = 250;
	            $config['height']   = $resize_height;
	            //$config['height']   = 141;
	            $config['quality']   = 75;
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;
	            $img =$config['source_image'];
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();*/
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
	    echo json_encode(array('filelink' => $config['source_image']));
	}


	function cropmediaimg()
	{
		$this->template->build('admin/medias/cropmediaimg');
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
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;

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
		$course_id = $this->uri->segment(4);
		
		// if($this->uri->segment(5) == 'courseedit')
		// {

		// $form_data =  array(						
		// 			'local' => $generate1.".png"											
		// 			);
 	// 	$isupdated=$this->medias_model->updateItem($id,$form_data);

 	//    } 
 	   
		
    }

}