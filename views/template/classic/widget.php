<script type="text/javascript">
$(window).resize(function() 
{
  if($(window).width() < 980)
  {
    $('.screenres').removeClass("row-fluid");  
  }
  else
  {
    $('.screenres').addClass("row-fluid");
  }
});
</script>

<style type="text/css">
iframe{
  width:280px !important; 
  height:180px !important;
}
.ytp-title-link {
  autostart:0 !important;
}
  .media{
  width:280px; 
  height:180px; 
  position:relative;
  overflow:hidden;
}
.media img{
  position:absolute; 
  top:0; 
  bottom:0; 
/*  margin: auto;
*/  width:100%;
}

</style>

<?php
$CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $getItemssetting = $CI->settings_model->getItems();
  $currenttemplate = $getItemssetting[0]['layout_template'];
  $settings = $CI->settings_model->getTemplateById($currenttemplate);
  $data11 = $settings[0]['options'];
  $data = json_decode($data11);
?>

<?php
$divstart = 0;
$this->db->select('*');
$this->db->where('area', 'middle');
$this->db->where('status', '1');
$query = $this->db->get('mlms_widgets');
$result = $query->result_object();

foreach($result as $key=>$row)
{   

  if($divstart ==0)
  {    
    ?>
    <div class='screenres row-fluid' >
    <?php   
  }
  ?>
  
  <div class="span4">
    <div class="top-item">
        <div class='sprite icon-community'></div>
        <h3 class="iconset iconcommunity" style="position: unset;line-height:1;font-family :<?php echo $data->widget_heading_font; ?>;font-size : <?php echo $data->widget_heading_size; ?>px;color: <?php echo $data->widget_heading_color; ?>;"><?php echo $row->title;?></h3>
        <?php if($row->media) { ?>
                <div class="media">

          <img width src="<?php echo base_url().'public/uploads/'.$row->media; ?> ">
              </div>

        <?php } ?>

        <p id="widget" >
        <?php 
        // preg_match('/(<img[^>]+>)/i', $row->description, $matches);
        // print_r($matches); exit('44');

         $xpath = new DOMXPath(@DOMDocument::loadHTML($row->description));

        $base64 = $xpath->evaluate("string(//img/@src)");
        $newarray = explode(' ', $base64); 
        //echo $newarray[0]; ?>
        <?php $arr_url = explode(':', $newarray[0]);
            if($arr_url[0] == "http")
            {
                   $newarray[0] = str_replace("http","https",$newarray[0]);
            } ?>
        <img width='341' height='auto' alt='' src="<?php echo $newarray[0]; ?>">
        <?php //echo $row->description;

              echo str_replace("<img","<img style='display:none' ",$row->description);      
             $divstart = 1;
        ?>
        </p>
    </div>
  </div>
<?php
if(($key+1) % 3 == 0)
{
    ?>
    </div>
    <?php
    $divstart = 0;
  }
}
?>