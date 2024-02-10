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
				<?php }
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
	}
	public function calljwplayer($jwurl,$source,$type,$frame_id)
	{
        if($type == 'video'){
          $vtype = 'videos';
        }
        if($type == 'audio'){
          $vtype = 'audio';
        }

	?>
   <!--	<script type="text/javascript" src="<?php echo base_url();?>public/jwplayer/vimeojwplayer.js"></script>  -->
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

     //  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "admin/medias/";
       $this->load->library('pagination');
       $term = NULL;
       $config['total_rows'] = $this->medias_model->getmediacount($term,$search_string,$search_cat,$search_type);
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media List');
       $this->template->set("search_string", $search_string);
       $this->template->set("medias", $this->medias_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_cat,$search_type));
	   $this->template->set('categories',$this->medias_model->get_formatted_combo($parent_id));
	   $this->template->set('mediatype',$this->medias_model->getMediaType());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/medias/list');
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
       $path=base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
       $config["base_url"] = base_url() . "admin/medias/ajaxaddmedia/".$medlay."/".$medid;
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

			foreach ($_FILES as $index => $value)
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
			}
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
				$filenamebytype = $this->input->post('localfile_d');
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
                $codebytype = NULL;
                $sourcebytype = $this->input->post('source_f');
                $widthbytype = '0';
			   	$heightbytype = '0';
				$urlbytype = $this->input->post('url_f');
				$filenamebytype = $this->input->post('localfile_f');
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
        // print_r($_POST); exit;

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
	 // print_r($data);exit;
			if($this->medias_model->insertItems($data)){
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			redirect('admin/medias/'.$parent_id);
			}
		}
	}
	
	function edit($id = FALSE, $parent_id = FALSE) 
	{
	  //print_r($_POST);
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
			
			foreach ($_FILES as $index => $value)
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
			}	
		   //	$imagename = ($form_data_aux['image']) ? $form_data_aux['image'] : $data['medias']->$index;
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$type = $this->input->post('type');
            $filenameby_type = ($this->input->post('imagename')) ? $this->input->post('imagename') : $data['medias']->local;
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
				$filenamebytype = $this->input->post('localfile_d');
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
				//$filenamebytype = $this->input->post('file_i');
               // $filenamebytype = $this->input->post('imagename');
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
                $codebytype = NULL;
				$sourcebytype = $this->input->post('source_f');
                $widthbytype = '0';
			   	$heightbytype = '0';
				$urlbytype = $this->input->post('url_f');
				$filenamebytype = $this->input->post('localfile_f');
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
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
        $mid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
		}
		
		//search the item to delete
		
		/*if ( $this->medias_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
			redirect('admin/medias/');
		}
		elseif ( $this->medias_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/medias/');
		}
		*/
		
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
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	}
	
	public function upload_file_v()
	{
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
		  $config['file_name'] = $_FILES['orig_name'];
	 
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
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_v));
	}
	public function upload_file_a()
	{
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
		  $config['file_name'] = $_FILES['orig_name'];

		  $this->load->library('upload', $config);
	 
		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
			 //$data = $this->upload->data();
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
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_a));
	}
	public function upload_file_d()
	{
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
		  $config['file_name'] = $_FILES['orig_name'];
	 
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
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_d));
	}
	
	public function upload_file_f()
	{
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
		  $config['allowed_types'] = 'exe|zip';
		  /* exe, zip*/
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
	 
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
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_f));
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
}