<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('logged_in');
	$maccessarr=$this->session->userdata('maccessarr');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
  .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
.sidebar-collapse.sb-toggle-left {
  display: none;
}
</style>
<script>
function saveorder(n, task) 
{
	checkAll_button(n, task);
}
function checkAll_button(n, task) 
{
	if (!task) {
		task = 'saveorder';
	}
    document.orderform.submit();
}
</script>

<script>
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #fff;
  color: #333;
  text-transform: uppercase!important;
  font-size: 18px!important;
  line-height: 28px;
  font-weight: 400!important;
  font-family: 'AvenirNextLTPro-Regular'!important;
  text-align: center!important;
  padding: 4% 2% 2% 2% !important;
  border-bottom: 0px!important;
  height: 38px!important;
  font-family: inherit;
  border-radius: 6px;
}
.jconfirm .jconfirm-box .buttons {
  padding: 3% 15px 4%;
  border-top: 1px dotted #999;
}
/*.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 21px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 18px 30px 0 13px !important;
  border-bottom: 0px!important;
  height: 55px!important;
  font-family: inherit;
}*/
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 10px 0!important;
  text-align: center!important;
  font-weight: bold!important;
}
.breadcrumb{
	display: none;
}
@media(max-width:1999px){
.jconfirm .jconfirm-box div.title{
  height: 55px;	
}
}

@media (max-width: 991px){
.main-content .course_search {
	width: auto;
	float: right !important;
	right: -5px;
	left: auto;
}
}
@media (max-width: 768px){
.main-content .course_search {
	width: 100%;
	float: none !important;
	right: 0px;
	position: unset;
	margin-bottom: 10px !important;
}
.txt-pyara{
  padding: 0px;
}
.course_search{
  padding: 0px !important;
  margin: 0px !important;
}
}
/*end of css*/
</style>
<header>

<section class="breadcrumb">
<div class="container">

      <div class="page-title">
        Manage Questions Bank
      </div>

      <div class="bread-view">
	    <a href="http://create-online-academy.com/"><i class="entypo-home"></i></a>
	    <span class="ng-hide">/ </span>
	    <a href="#">Manage Questions Bank</a>
	</div>

</div>
</section>

</header>

<div class="page-container">
<div style="background-color: #F5F5F5">
<?php
  $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>   

<div class="main-content">
	<div class="row">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 12px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<div class=""><p class="right_course_txt"> Here you can create/edit question of different type. Once create they can be selected in exams for the  courses as many times as required.</p></div>

<div id="sticky-anchor"></div>
<div id="sticky">
<?php

if(!empty($maccessarr['quizzes']))
{
if(($maccessarr['quizzes']=='own') )
  {
	?>
    <a href="<?php echo base_url(); ?>questions/create/" onclick="Joomla.submitbutton('edit')"  class="btn btn-success" style="float: right;"><i class="entypo entypo-login"></i>
	New
	</a>	
	
<?php
 }
}
?>
</div>

<div class="clr"></div>

<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>


<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
// echo form_open_multipart('questions/',$attributes)
echo form_open_multipart(base_url().'questions/manage',$attributes)
?>



<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">

  
    <div class="course_search" style="float:right;">
	
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Search Question">

		<button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>

		<!-- <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: -2px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button> -->
  
    </div>

  
  
    <div class="course_search" style="float:right;">
    	<label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;">
       		Question Group :
              <select name="search_group" onchange="document.topform11.submit()" >
				<option value="">- select -</option>
				<option value='regular' <?php //if($status == '1') echo "selected"; ?>>Regular</option> 				
				<option value='match_the_pair' <?php //if($status == '1') echo "selected"; ?>>Match The Pair</option>
				<option value='true_false' <?php //if($status == '1') echo "selected"; ?>>True / False</option> 
				<!--<option value='fill_in_the_blanks' <?php //if($status == '1') echo "selected"; ?>>Fill In The Blanks</option>-->
				<option value='multiple_type' <?php //if($status == '0') echo "selected"; ?>>Multiple Type</option>								
				<option value='media_type' <?php //if($status == '1') echo "selected"; ?>>Media Type</option> 				
			</select>
		</label>
    </div>
    
 
</div>

<div class="clear"></div>



<?php echo form_close(); ?>
	



<div class="table-scroll-resp">
<table class="table table-bordered responsive inner_pages_table">
	<thead>
		<tr>
            <th>Question Tag</th>            
		    <th>Question Type</th>
			<th>Question Marks</th>
			<th>Question</th>            
            <th>Options</th>                  
        </tr>
	</thead>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
?>
<?php 
	$iii = 0;
	if ($questions): 
	echo form_open_multipart(base_url().'quizzes/',$attributes);

?>	


<tbody>
<?php $i=0;?>
<?php foreach ($questions as $quest): ?>
<tr class="odd camp<?php echo $i;?>">
			<?php         			
         		 	
           		 	$totalMarksOutOf =0;
           		 	$totalMarksObtained =0;
           		 	$CI = & get_instance();
					$CI->load->model('lessons_model');
					$quizzes_ids = $CI->lessons_model->getQuestionIds($quest->question_id);
				
						$data_right = $CI->lessons_model->getQuizMarks($quest->question_id);	
							// echo"<pre>";
							// print_r($data_right);
							// echo"</pre>";					
						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								// if($rights->is_correct_answer == 'True')
								// {
								 	$totalMarksOutOf = $rights->points;
								// }
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'subjective')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else 
							{
								$totalMarksOutOf = $rights->points;
							}

										
						}
					
					//echo $totalMarksOutOf;               	
           ?>
           
			<td class="product_name"><?php echo ucfirst($quest->question_tag);?></td>
	        <td class=" "><?php 
	        			if($quest->question_type == 'true_false') 
	        			{
	        				echo 'True/False';
	        			}
	        			elseif($quest->question_type == 'media_type')
	        			{
	        				echo 'Media Type';
	        			}
	        			elseif($quest->question_type == 'match_the_pair')
	        			{
	        				echo 'Match the Pair';
	        			}
	        			elseif($quest->question_type == 'multiple_type')
	        			{
	        				echo 'Multiple Type';
	        			}
	        			elseif($quest->question_type == 'subjective')
	        			{
	        				echo ucfirst($quest->question_type);
	        			}
	        			elseif($quest->question_type == 'regular')
	        			{
	        				echo ucfirst($quest->question_type);
	        			}

	        ?></td>
	        <td class=" "><?php echo $totalMarksOutOf;?></td>
	        <td class=" "><?php echo ucfirst($quest->question);?></td>  
            
			<td>
            
            <?php
            if(!empty($maccessarr['quizzes']))
            {
	if(($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
	{
?>
        
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>questions/edit/<?php echo $quest ->question_id?>'><i class="entypo-pencil"></i></a>
       
        <!--<a class='btn btn-default' href='<?php echo base_url(); ?>quizzes/editFinalQuiz/<?php echo $quiz->id?>'><?php echo lang('web_edit')?>
        </a>   onclick="return false"-->
     
<?php
	}


if(($maccessarr['quizzes']=='own'))
{
	?>
		<!-- <a class='btn btn-danger' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>questions/delete/<?php echo $quest->question_id?>/<?php echo $this->uri->segment(3)?>'><?php echo lang('web_delete')?></a> -->
		<a class='btn btn-danger btn-del' title="Delete" onClick="return deleteconfirm(<?php echo $quest->question_id?>,'<?php echo $this->uri->segment(3)?>')" ><!-- <?php echo lang('web_delete')?> --><i class="entypo entypo-trash"></i></a>
	<?php

	$quizzez_ids = $this->questions_model->getQuizzesids();

        $msg = 0;

        foreach($quizzez_ids as $quiz_id)
        {
            $quizid = explode(',', $quiz_id->quizzes_ids);

            if(in_array($quest->question_id, $quizid))
            {
               $msg = 'yes';
            }
        }
	?>
<input type="hidden" id="id_<?php echo $quest->question_id?>" value="<?php echo $msg ?>">
	<?php
}
}	
else
echo "No Access";
?>
            
			</td>
		</tr>
        <?php endforeach ?>
		<?php else: ?>

<tr>

    <td colspan="5">

<!-- <?=lang('web_no_elements');?> -->
No Question in the questions bank. <a href="<?php echo base_url(); ?>questions/create/">Create a one now !</a>
</td>

</tr>
<?php endif ?>
</tbody>
<?php echo form_close(); ?>
</table>
</div>
</div>
<div class="containerpg">

<div class="pagination">
    <?php echo $this->pagination->create_links();  ?>
</div>
</div>
</div>    
</div> 
</div>
</div> 
<div class="clr"></div>


<script>

jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $j =jQuery.noConflict();
	function deleteconfirm(id1,id2) 
	{   
		var isit = $j("#id_"+id1).val();
							if(isit == 'yes')
                                  {
                                          $j.alert({
                                           title: 'Sorry!',
                                   content: 'You cannot delete this question. This question must be assigned to any of the course(s).',
                                   confirm: function()
                                                   {
                                                           return true;
                                               //document.location.href = window.location.origin+'/admin/programs/';
                                                   }
                                               });
                                  }
                                  else
                                  { 
		$j.confirm({
    			title: 'Do you really want to delete questions ? ',
   				 content: ' ',
    			confirm: function(){
        			window.location.href = "<?php echo base_url(); ?>questions/delete/"+id1+"/"+id2;
    			},
    			cancel: function(){
       			 return true;
    			}
				});
	}
}
		
</script>