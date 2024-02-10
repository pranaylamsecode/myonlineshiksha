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
<!--
<style type="text/css">
  .morecontent span {
    display: none;
}
.morelink {
    display: block;
}
</style>-->

<?php
$CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $getItemssetting = $CI->settings_model->getItems();

  //$callpages = $CI->settings_model->getAllPages();
  //$countpage = count($callpages);

  $currenttemplate = $getItemssetting[0]['layout_template'];
  $settings = $CI->settings_model->getTemplateById($currenttemplate);
  $data11 = $settings[0]['options'];
  $data = json_decode($data11);
  //$data_exp = explode(',' , $data->position_of_pages->middle_content);
  //$count = count($data_exp);
?>

<?php
$divstart = 0;
$this->db->select('id,title,description');
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
        <h3 class="iconset iconcommunity" style="font-family :<?php echo $data->widget_heading_font; ?>;font-size : <?php echo $data->widget_heading_size; ?>px;color: <?php echo $data->widget_heading_color; ?>;"><?php echo $row->title;?></h3>
        <p id="widget" >
        <?php 
             echo $row->description;
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