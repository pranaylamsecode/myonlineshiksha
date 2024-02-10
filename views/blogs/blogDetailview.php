<section class="breadcrumb">
  <div class="container">

        <span class="page-title">
          	<?php if(!empty($blogsDetail))
			{
			  echo $blogsDetail->title;
            }
            ?>
        </span>

        <div class="bread-view">
	      <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
	      <span class="ng-hide">/ </span>
	      <a href="<?php echo base_url();?>blogs">Blogs</a>
	      <span class="ng-hide">/ </span>
	      <a href="#"><?php if(!empty($blogsDetail))
			{
			  echo $blogsDetail->title;
            }
            ?></a>
  </div>
  </div>
</section>

<?php
	$blogs = $this->blogs_model->blog_list();
?>
<section class="container courses">
<div class="row-fluid ">
<div id="main" role="main">
<div class="holder" id="mrp-container2">
<div id="system-message-container"></div>
<?php
$userdata=$this->session->userdata('logged_in') ;
$CI =& get_instance();
$CI->load->model('admin/settings_model'); 

$attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile');
echo form_open('myinfo/myaccount', $attributes);
?>
<div class="content11">
<div class="col-sm-8">
<div class="blog-post-single">
<div id='ajax'></div>
<?php if(!empty($blogsDetail))
{
?>
<div class='blogDetailview' style="  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);">
	<div class="post-details">            
      <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $blogsDetail->slug; ?>">
      	<h3>
	  		<?php  echo $blogsDetail->title;?>
      	</h3>
      </a>
                
                 <div class="post-meta">								
                                <div class="meta-info">
									<?php echo "Written By ".$this->blogs_model->getNameById($blogsDetail->written_by); ?>
                                </div>
                                
								<div class="meta-info">
									<i class="entypo-calendar"></i> <?php echo "Posted ".date('d F Y',strtotime($blogsDetail->date)); ?>
                                </div>
								
								<div class="meta-info">
									<i class="entypo-comment"></i>
									(<?php echo count(getBlogComments($blogsDetail->id)); ?>) Comments
								</div>								
							</div>

					<div>
					
                    
               	<div class="post-content">
				<?php
				 $blogdataarr=json_decode($blogsDetail->post);
				 echo "<br/>";
                 echo $blogdataarr->description;
				?>
			</div>
</div>

<!--- Blogs Comment -->

<?php
	$comments=getBlogComments($blogsDetail->id);
	if(!empty($comments))
	{
	?>

    <div class='maincommentblock'>
	<h4>Comments (<?php echo count(getBlogComments($blogsDetail->id)); ?>)</h4>
	<hr />	
	<?php
    //$count=0;

	foreach($comments as $eachcomment)
	{  //echo $count;
	?>

    <div class='commentblock'>

         <?php

		 $fdate=date('Y-m-d H:i:s',$eachcomment->ts);

		 $sdate=date('Y-m-d H:i:s');

		$first_date = new DateTime($fdate);

		$second_date = new DateTime($sdate);

		$difference = $first_date->diff($second_date);
			
		$getImageMy = $CI->settings_model->getUserImage($eachcomment->comment_by);

		$my_image = @$getImageMy[0]->images;	
        ?>
                                          
<ul class="comments-list">
<li>

<div class="comment">
	<div class="comment-thumb">
		<a href="#">
			<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width="44">									
		</a>
	</div>
	
	<div class="comment-content">
		
		<div class="comment-author">
			<a href="#">By <?php echo ucfirst(getUserName($eachcomment->comment_by));?></a>
		
		<?php
		if($groupid == 4)
		{
			$comment=json_decode($eachcomment->comment_data);
			?>	
			<div class="comment-info">
				<span class="time"><?php echo format_interval($difference);?> ago</span>
				<div class='btnComment'>
					<button class="btn btn-success cmmsave" name="edit_btn_<?php echo $eachcomment->id; ?>" id='edit_btn_<?php echo $eachcomment->id; ?>' value="Edit" style='text-align:right'  onclick='editComment(<?php echo $eachcomment->id; ?>)'><i class="entypo-pencil"></i></button>					
					<button class="btn btn-danger cmmsave" name="delete_btn_<?php echo $eachcomment->id; ?>" id='delete_btn_<?php echo $eachcomment->id; ?>' value="Delete" style='text-align:right'  onclick='deleteComment("<?php echo $eachcomment->id; ?>","<?php echo $eachcomment->blog_id; ?>")' ><i class="entypo-trash"></i></button>
				</div>
			</div>
		</div>
		
		
			<div class="comment-text" id="div_<?php echo $eachcomment->id;?>">
				<p id="para_<?php echo $eachcomment->id;?>"><?php echo $comment->cdesc;?></p>			
			</div>
		<?php
		}
		else
		{
			?>
			<div class="comment-text">
			<?php $comment=json_decode($eachcomment->comment_data);
			echo $comment->cdesc;
			?>
			</div>
			<?php
			}
		?>
		
	</div>
</div>

</li>
</ul>
                            
</div>                                    
                            
                            

                           

                          

                    	<?php

                         	//$count++;

                            }

                        ?>

                        </div>

                        <?php



                        }



						?>



                        <?php if($this->session->userdata('logged_in')){ ?>

						<div class='last_comment_div'>
						<input type="button" class="btn-primary_red" name="comment_btn_<?php echo $blogsDetail->id; ?>" id='comment_btn_<?php echo $blogsDetail->id; ?>' value="Comment" style='text-align:right' title='<?php echo $blogsDetail->id; ?>' onclick='post_comment_win(this)' />
						</div>

                         <?php } ?>

						<div style='clear:both'></div>





						<div>

							<div style='display:none;' id="pc_<?php echo $blogsDetail->id; ?>">

							<textarea id="comment_<?php echo $blogsDetail->id; ?>"  style="width: 692px; height: 108px;" required="required" ></textarea>

							<div>

							<input type="button"  class="btn btn-success" style='text-align:right; margin-right:10px;' value='Post Comment' onclick='post_comment("<?php echo $blogsDetail->id;?>","<?php echo $userdata['id']; ?>")' />

							<?php

							//}

							//else

							//{

							?>

							<!--<button class="btn btn-success" style='text-align:right' onclick='post_comment(<?php //echo $eachblog->id; ?>,'')'>Post Comment</button> -->

							<?php

							//}

							?>





							<input type="button" class="btn btn-danger" style='text-align:right' onclick='close_post_comment(<?php echo $blogsDetail->id ?>);' value='Cancel' />

							</div>

							</div>

						</div>

</div>

<?php

	} // End of each blog
?>
</div>

<?php echo form_close(); ?>
</div>
</div>

<div class="col-sm-4 bp" style="  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);">			
<div class="sidebar">
  <h3> <i class="entypo-list"></i> Blog List </h3>
  <div class="sidebar-content">
    <ul>
       <?php
          if(!empty($blogs))
            {
            // echo "<pre>";  print_r($blogs);  echo "</pre>";
            foreach($blogs as $eachblog)
            {
             if($eachblog->status!=0)
             {
				?>
				<li> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->slug; ?>"><?php  echo $eachblog->title;?></a> </li>
				<?php
            }
            else
            {
        ?>
         <li> No Blogs </li>
        <?php
            }
          }
        }
        else
        {
        ?>
         <li> No Blogs </li>
        <?php
          }
        ?>
    </ul>
  </div>
</div>
</div>
</div>
</div>

<script>
function post_comment_win(ele)
{
	var id1=ele.title;
	$(ele).css('display','none');
	$('#pc_'+id1).css('display','block');
}

function close_post_comment(id)
{
	$('#pc_'+id).css('display','none');
	$('#comment_btn_'+id).css('display','block');
}

function editComment(id)
{

	var data_comment = $('#para_'+id).html();
	var data = "<textarea id='comment_"+id+"'>"+data_comment+"</textarea><input type='button' style='margin-top:0px;' class='btn btn-success' value='Save' onclick='editComment_save("+id+")'>";
	$('#div_'+id).html(data);
	$('#edit_btn_'+id).css('display','none');
}

function editComment_save(id)
{
	var commentcontent = $('#comment_'+id).val();   

	$.ajax({
        type: "post",
        url: "<?php echo base_url('blogs/edit_comment_process'); ?>",
        data: {comment:commentcontent,cid:id},
        success: function(msg)
        {
			/*$('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg == 'success')
            {
            	$('#div_'+id).html("<p id='para_"+id+"'>"+commentcontent+"</p>");
                //$("#updateMsg_"+id).html('Updated');
                //$("#updateMsg_"+id).fadeOut(2000);
               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */
            $('#edit_btn_'+id).show();
            }
            else
            {
                $("#ajax").html(msg);

            }

        }



    });

} 

</script>
<script>

//function deleteComment(cid,bid)
//{
	// var value = confirm('Are You really want to delete?');
	// if(value == true)
	// {
	// 	$.ajax({
 //        type: "post",
 //        url: "<?php echo base_url('blogs/delete_comment_process'); ?>",
 //        data: {bid:bid,cid:cid},
 //        success: function(msg)
 //        {
 //           location.reload();
 //        }
 //    	});
	// }
//}
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
function deleteComment(cid,bid)
{
	
	$j.confirm({
    		title: 'Do you really want to delete Comment ?',
    		content: ' ',
    		confirm: function(){
        		//window.location.href = "<?php echo base_url(); ?>programs/trash/";

									$.ajax({
								type: "post",
								url: "<?php echo base_url('blogs/delete_comment_process'); ?>",
								data: {bid:bid,cid:cid},
								success: function(msg)
								{
								location.reload();
								}
								});
   				 },
    		cancel: function(){
        return true;
    }
}); 
}

function alertComment()
{
	
	$j.alert({
    		title: 'Please write comment before submit',
    		content: ' ',
    		alert: function(){
        	

									
   				 },
    		cancel: function(){
        return true;
    }
}); 
}
</script>
<script>
function post_comment(id,cby)
{
	var commentcontent=$('#comment_'+id).val();

	if(commentcontent == '')
	{
		alertComment();
		exit();
	}
	$.ajax({
        type: "post",
        url: "<?php echo base_url('blogs/post_comment_process'); ?>",
        data: {comment:commentcontent,bid:id,cby:cby},
        success: function(msg)
        {
			/*$('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {
                $("#ajax").html(msg);
               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */
            }
            else
            {
                $("#ajax").html(msg);
            }
        }
    });
}
</script>
<?php
function format_interval(DateInterval $interval) {

    $result = "";

    if ($interval->y) { $result .= $interval->format("%y years "); }

    if ($interval->m) { $result .= $interval->format("%m months "); }

    if ($interval->d) { $result .= $interval->format("%d days "); }

    if ($interval->h) { $result .= $interval->format("%h hours "); }

    if ($interval->i) { $result .= $interval->format("%i minutes "); }

    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
}
?>
</div>
</div>
</section>