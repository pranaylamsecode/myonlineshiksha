<section class="breadcrumb">
  <div class="container">

        <span class="page-title">
          <?php
                echo 'Blogs';
                ?>
        </span>

        <div class="bread-view">
      <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
      <span class="ng-hide">/ </span>
      <a href="#">Blogs</a>
  </div>
  </div>
</section>


<section class="container courses">
<div class="row-fluid ">
<div id="main" role="main">
<div class="holder" id="mrp-container2">
<div id="system-message-container"></div>

<?php
$CI =& get_instance();
$CI->load->model('admin/settings_model'); 
$attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile');
echo form_open('myinfo/myaccount', $attributes);
?>

<div class='content1'>
<div class="col-sm-8">
<?php 
if(!empty($blogs))
{
foreach($blogs as $eachblog)
{
?>
            <div class="blog-posts">
              <div class="blog-post">
                <div class="post-details" style="  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);">
                  <h3> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->slug; ?>">
                    <h3>
                      <?php  echo $eachblog->title;?>
                    </h3>
                    </a> </h3>
                  <div class="post-meta">
                    <div class="meta-info"> <?php echo "Written By ".$this->blogs_model->getNameById($eachblog->written_by); ?> </div>
                    <div class="meta-info"> <i class="entypo-calendar"></i> <?php echo "Posted ".date('d F Y',strtotime($eachblog->date)); ?> </div>
                    <div class="meta-info"> <i class="entypo-comment"></i> <?php echo count(getBlogComments($eachblog->id)); ?> Comments </div>
                  </div>
                  <p>
                    <?php

							 $blogdataarr=json_decode($eachblog->post);

							 $blogdataarr->description;

				 			 $little_excerpt = substr($blogdataarr->description,0,350);

                			 echo"<br/>";

                			 echo $little_excerpt ;

							?>
                    <br/>
                    <a style="font-weight: bold" href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->slug; ?>"><br/>
                    Read More..</a> </p>
                </div>
              </div>
            </div>
            <?php

	 }
}
else
{
?>

<div style="padding-top: 20px;font-size: -webkit-xxx-large;">No Blogs</div>
<?php
}
?>
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
                        
                   ?>
                  <li> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->slug; ?>"><?php  echo $eachblog->title;?></a> </li>
                    <?php
                       
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
            <div class="sidebar">
              <h3> <i class="entypo-chat"></i> Recent Comments </h3>
              <div class="sidebar-content">
                <ul class="discussion-list">
                  <?php
			//print_r($recentComments);
      if($blogs)
      {
       if($recentComments)
       {
  			foreach($recentComments as $comments)
  			{
  				$dataComment = json_decode($comments['comment_data']);			
  				$getImageMy = $CI->settings_model->getUserImage($comments['comment_by']);
  				$my_image = $getImageMy[0]->images;				
  				?>
                    <li> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $comments['slug']; ?>" class="thumb"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width="30"> </a>
                      <div class="details"> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $comments['slug']; ?>"><?php echo $comments['first_name'];?></a>
                        <!-- <div class="details"> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $comments['blog_id']; ?>"><?php echo $comments['first_name'];?></a>  Commented On  <?php echo $comments['title'];?> -->
                        <p><?php echo $dataComment->cdesc;?></p>
                      </div>
                    </li>
                    <?php
  			}
      }
      else
      {
			?>

      <li><div>No Recent Comments.</div></li>

      <?php
      }
    }
    else
    {

      ?>
     <li><div>No Blogs.</div></li>
    <?php
  }
    ?>
                </ul>
              </div>
            </div>
          </div>
          <?php echo form_close();?>
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

function post_comment(id,cby)
{
	var commentcontent=$('#comment_'+id).val();
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
function format_interval(DateInterval $interval) 
{
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
</section>
