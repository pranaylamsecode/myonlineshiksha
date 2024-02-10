<script>
function post_comment(id,cby)
{
alert('111');
	var commentcontent=$('#comment_'+id).val();
	$.ajax({
        type: "post",

        url: "<?php echo base_url('admin/blogs/post_comment_process'); ?>",

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

<div id="main" role="main">

<div class="holder" id="mrp-container2">

<div id="system-message-container"></div>

<?php
$session_data = $this->session->userdata('loggedin');
$attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile','onclick' => 'return validateForm()');
echo form_open(base_url().'admin/blogs/post_comment_process', $attributes);

$user_id = $session_data['id'];
$CI =& get_instance();
$CI->load->model('admin/settings_model'); 
$getImageMy = $CI->settings_model->getUserImage($user_id);
$my_image = $getImageMy[0]->images;	
?>

<div class="content11">
<div id='ajax'></div>
<?php if(!empty($blogsDetail))
{	
$getImage = $CI->settings_model->getUserImage($blogsDetail->written_by);
$written_by = $getImage[0]->images;		

					
?>
<div class='blog_adminpanel'>

	<fieldset class="adminform">

       <div class="admintable">

               <div width="550" class="title"><a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $blogsDetail->id; ?>"><h2><?php  echo $blogsDetail->title;?></h2></a></div>



				  

<div class="profile-env">
<section class="profile-feed">
<div class="profile-stories">
<article class="story">
				
				<aside class="user-thumb">
					<a href="#">
						<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $written_by;?>" alt="" class="img-circle" width='44'>
					</a>
				</aside>
				
				<div class="story-content">
					
					<!-- story header -->
					<header>
						
						<div class="publisher">
							<a href="#"><?php echo "Written By ".$this->blogs_model->getNameById($blogsDetail->written_by); ?></a> 
							<em><?php echo "Posted ".date('d F Y',strtotime($blogsDetail->date)); ?></em>
						</div>
						
						<div class="story-type">
							<i class="entypo-feather"></i>
						</div>
						
					</header>
					
					<div class="story-main-content">
						<p>
                        <?php
						
						$blogdataarr=json_decode($blogsDetail->post);

						

                 		echo $blogdataarr->description;
						
						?>
                        </p>
					</div>
					
					<!-- story like and comment link -->
					<footer>
						
						
						<a href="#">
							<i class="entypo-comment"></i>
							Comment <span>(<?php echo count(getBlogComments($blogsDetail->id)); ?>)</span>
						</a>
						
						<!-- story comments -->
						<?php

$comments=getBlogComments($blogsDetail->id);

if(!empty($comments))

{

?>
<ul class="comments">
<?php

//$count=0;

foreach($comments as $eachcomment)

{  

?>
<br/>

	<?php

$fdate=date('Y-m-d H:i:s',$eachcomment->ts);

$sdate=date('Y-m-d H:i:s');

$first_date = new DateTime($fdate);

$second_date = new DateTime($sdate);

//print_r($first_date);

$difference = $first_date->diff($second_date);

$getImageComment = $CI->settings_model->getUserImage($eachcomment->comment_by);
$comment_by = $getImageComment[0]->images;		
?>
							<li>
								<div class="user-comment-thumb">
									<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $comment_by;?>" alt="" class="img-circle" width='30'>
								</div>
								
								<div class="user-comment-content">
								
									<a href="#" class="user-comment-name">
										By <?php echo getUserName($eachcomment->comment_by);?>
									</a>
									
									<?php $comment=json_decode($eachcomment->comment_data);

		echo $comment->cdesc;

		?>
									
									<div class="user-comment-meta">
										
										<a href="#" class="comment-date"><small><?php echo format_interval($difference);?> ago</small></a>
										-
										
																			
										<a href="#">
											<i class="entypo-comment"></i>
											Reply
										</a>
									</div>
									
								</div>
							</li>
							<?php

//$count++;

}
?>
</li>
<?php
}
?>
	<li class="comment-form" >
    	<div id='pc_<?php echo $blogsDetail->id; ?>'>
		<div class="user-comment-thumb">
			<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width="30">									
		</div>
		
		<div class="user-comment-content">			
			
        <!--<textarea name="comment_<?php echo $blogsDetail->id; ?>" id="comment_<?php echo $blogsDetail->id; ?>" placeholder="Write a comment..."  class="form-control autogrow" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 46px; width:800px;"></textarea>-->           
		<input type='hidden' name='bid' id='bid' value="<?php echo $blogsDetail->id; ?>">
		<textarea name="comment" id="comment" placeholder="Write a comment..."  class="form-control autogrow" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 46px; width:800px;"></textarea>
		
		<button class="btn" style='text-align:right' value='Post Comment' onclick='post_comment("<?php echo $blogsDetail->id; ?>","<?php echo $session_data['id']; ?>")'><i class="entypo-chat"></i></button>
		
		<!--<input type="submit" class="btn" style='text-align:right' value='Post Comment'>-->

		<button class="btn" style='text-align:right' onclick='close_post_comment(<?php echo $blogsDetail->id ?>);' value='Cancel'><i class="entypo-chat"></i></button>
		</div>
		</div>
	</li>
</ul>

<div style='clear:both'></div>
</footer>
</article>
</div>
</section>
</div>
</div>
</fieldset>		
<!---- End ------------------------------------>
</div>
<?php
} // End of each blog
?>
<?php echo form_close(); ?>
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