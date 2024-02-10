 <?php function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = floor( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
function renderStarRating($rating,$maxRating=5) {
    $fullStar = "<li style='display:inline-block' ><i class = 'fa fa-star checked'></i></li>";
    $halfStar = "<li style='display:inline-block' ><i class = 'fa fa-star-half-full checked'></i></li>";
    $emptyStar = "<li style='display:inline-block' ><i class = 'fa fa-star-o '></i></li>";
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
$auth = $this->session->userdata('logged_in');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.fa-star-o:before{
    content: "\f006";
  }
  .fa-star-half-full:before{
    content: "\f123";
  }
  .progress_rating .col-xs-4 {
    padding: 0px;
}
.stud_feedback_rating .col-sm-3 {
    padding: 0px;
}
#payment, #subs, #enroll, #preview, #status, #enrollend {
  width: 404px;
  padding-bottom: 2px;
  display: none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
.left_sec h3 {
    text-align: left!important;
    font-size: 22px;
    font-weight: 600;
}
.panel-group .panel+.panel {
    margin-top: 4px;
}
.std_feedback {
  padding-top: 50px;
  padding-left: 0px;
}
.std_feedback h3 {
    font-size: 22px;
    font-weight: bold;
    margin: 0px 0px 15px;
    text-align: left;
    font-family: inherit;
}
.stud_feedback_rating .col-sm-3{
    text-align:center;
}
.stud_feedback_rating ul {
  padding-left: 0px;
  margin-bottom: 7px;

}
.rating_num{
  margin-top: 20px;
}

.rating1 {
    font-size: 72px;
    margin-bottom: 0px;
    margin-top: 0px;
}
.description1 ul {
    list-style-type: disc;
}
.progress_rating span a{
  color: #007791;
}
form.navbar-form{
  margin-top:0px;
}
.reviews_bottom_sect {
    padding-top: 20px;
    padding-left: 0px;
}
.reviews_bottom_sect .add-on .input-group-btn button.btn.btn-default.search_btn {
  background-color: #007791 !important;
  background: #007791 !important;
  border: 0px;
  padding: 7px;
  border-radius: 0px;
   border-top-right-radius: 3px !important;
  border-bottom-right-radius: 3px !important;
}
.reviews_bottom_sect input {
  border-radius: 3px !important;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
}
button.btn.btn-default.search_btn {
    background-color: #cf1515!important;
    background: #cf1515!important;
    border:none;
}
.reviews_bottom_sect i.glyphicon.glyphicon-search {
    color: #fff;
}
.reviews_bottom_sect .add-on .input-group-btn {
    padding-left: 2px;
}

p.review_date {
    color: #686f7a;
    font-size: 15px;
    letter-spacing: 0.03em;
    margin-bottom: 0px;
}
p.review_name {
    color: #29303b;
    font-size: 15px;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    letter-spacing: 0.03em;
}
.progress_rating {
    padding: 0px;
}
.stud_feedback_rating {
    padding: 0px;
}
#payment, #subs, #enroll, #preview, #status, #enrollend {
  width: 404px;
  padding-bottom: 2px;
  display: none;
  background: #FFF;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
.left_sec h3 {
    text-align: left!important;
    font-size: 22px;
    font-weight: 600;
}
.panel-group .panel+.panel {
    margin-top: 4px;
}
.std_feedback {
  padding-top: 30px;
  padding-left: 0px;
}
.std_feedback h3, .reviews_bottom_sect h3 {
    font-size: 24px;
    font-weight: normal;
    margin: 0px 0px 15px;
    text-align: left;
    font-family: inherit;
}
.stud_feedback_rating{
    text-align:center;
}
.stud_feedback_rating ul {
  padding-left: 0px;
  margin-bottom: 7px;

}
.rating_num {
  margin-top: 20px;
  display: inline-block;
  float: left;
  margin-right: 30px;
  text-align: center;
}

.rating1 {
    font-size: 72px;
    margin-bottom: 0px;
    margin-top: 0px;
}
.description1 ul {
    list-style-type: disc;
}
.progress_rating span a{
  color: #007791;
}
form.navbar-form{
  margin-top:0px;
}
.reviews_bottom_sect {
  padding-top: 20px;
  padding-left: 0px;
  display: inline-block;
}
.review_page_bread h3{
  margin: 0px;
  font-size: 30px;
}
.review_page_bread{
  margin-bottom: 0px;
  padding-bottom: 0px;
  background: transparent;
}
.reviews_bottom_sect .add-on .input-group-btn button.btn.btn-default.search_btn {
  background-color: #007791 !important;
  background: #007791 !important;
  border: 0px;
  padding: 7px;
  border-radius: 0px;
   border-top-right-radius: 3px !important;
  border-bottom-right-radius: 3px !important;
}
.reviews_bottom_sect input {
  border-radius: 3px !important;
  border-top-right-radius: 0px !important;
  border-bottom-right-radius: 0px !important;
}
button.btn.btn-default.search_btn {
    background-color: #cf1515!important;
    background: #cf1515!important;
    border:none;
}
.reviews_bottom_sect i.glyphicon.glyphicon-search {
    color: #fff;
}
.reviews_bottom_sect .add-on .input-group-btn {
    padding-left: 2px;
}
p.review_date {
  color: #555;
  font-size: 13px;
  letter-spacing: unset;
  margin-bottom: 0px;
  margin-top: 2px;
}
p.review_name {
  color: #333;
  font-size: 15px;
  display: block;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  letter-spacing: 0;
  margin-bottom: 0px;
}
.progress_rating {
  display: inline-block;
  float: left;
}
.progress {
  width: 400px;
  display: inline-block;
  float: left;
  margin-right: 15px;
}
.rate-ex3-cnt {
  display: inline-block;
  float: left;
}
.avg_rating {
  font-size: 16px;
  color: #373e4a;
}
.stud_feedback_rating .fa-star-o {
    font-size: 20px!important;
    margin-right: 2px;
    margin-left: 2px;
}
.stud_feedback_rating .checked {
  color: #F4C150;
  font-size: 20px !important;
  margin-right: 2px;
  margin-left: 2px;
}
 .stud_feedback_rating ul {
  display: inline-block;
}
.stud_feedback_rating{
    text-align: left;
    padding-bottom: 10px;
}

.resposive_txt, .responsive-slider-sect .text-center.col-sm-12, form.navbar-form, .reviews_bottom_sect .col-sm-6, .rightbox, .reviews_bottom_sect .col-sm-8, .progress_rating, .progress_rating .col-xs-12, .stud_feedback_rating{
    padding-right: 0px;
    padding-left: 0px;
}
.cust_review{
  display: inline-block;
  width: 100%;
}
.img-circle.user_image {
  height: 45px;
  width: 45px;
  margin-right: 10px;
  float: left;
  border: 1px solid #dcdcdc;
}
.cust_review {
  display: inline-block;
  width: 100%;
  padding: 20px 0px;
  border-top: 1px solid #ddd;
}
.rate-ex3-cnt.rating_star{
  display: inline-block;
  float: left;
}
.delete_review {
  display: inline-block;
  float: right;
}
.delete_review a {
  padding: 15px 5px 5px 5px;
  background: #e12a3c;
  color: #fff;
  border-radius: 5px;
}
.delete_review .lnr{
  font-size: 20px;
}
.rev_content {
  font-size: 15px;
  color: #333;
  text-align: justify;
}
.avg_percent a{
  font-size: 16px;
}
.rate-ex3-cnt .rate-btn-active:before {
    font-family: FontAwesome !important;
    content: "\f005" !important;
    color: #F4C150;
    font-size: 16px;
    font-weight: bold;
  }
.rate-ex3-cnt .rate-btn{
  width: 20px; 
  height:20px;
  float: left;
  cursor: pointer;
}
.rate-ex3-cnt .rate-btn:before {
  font-family: FontAwesome;
  content: "\f006";
  font-size: 16px;
}
footer{
  clear: both;
}
#review_msg{
  padding-bottom: 100px;
  color: #6f6b6b;
  font-size: 16px;
}
.grey_bg{
  background-color: #A1A7B3 !important;
}
</style>
<div class="row">
  <div class="" style="padding-bottom: 50px !important;">
  <div class="review_page_bread breadcrumb" style="">
    <h3><?php echo $programs->name;?> - Reviews</h3>
  </div>
<?php
  $CI = & get_instance();
  $CI->load->model('customs_model');
  $avgreview = $CI->customs_model->getAvgReview($programs->id);
?>
</div>
</div>

<div class="row">
  <div class="col-sm-12 stud_feeback_main_sect">
  <div class="std_feedback stud123">
    <h3>Student Feedback</h3>
    <div class="col-sm-12 stud_feedback_rating">
      <div class="rating_num">
        <h1 class="rating1">
          <?php $avgreview = $CI->customs_model->getAvgReview($programs->id);
          $str1 = str_split($avgreview->avg_review, 3);
          echo $str1[0];?>
        </h1>
        <?php echo renderStarRating($avgreview->avg_review);?>
        <p class="avg_rating">Average Rating</p>
      </div>
      <div class="progress_rating">
        <?php $countUser = $CI->customs_model->countuser(); 
          /*$rate_arr = array();
          foreach ($reviews as $review) {
            array_push($rate_arr, $review->review_rate);
          }
          $vals = array_count_values($rate_arr);
          $counts_students = $this->programs_model->getEnrolledUser($programs->id);
          $en_count = count($counts_students);*/
          $get_reviews = $CI->customs_model->course_rating($programs->id);

$count_reviews = count($get_reviews);
$one = 0; $two = 0; $three = 0; $four = 0; $five = 0; $tot_review = 0;
foreach ($get_reviews as $key) {
  $tot_review = $tot_review + $key->review_rate;
  switch ($key->review_rate) {
              case 1:
                $one++;
                break;
              case 2:
                $two++;
                break;
              case 3:
                $three++;
                break;
              case 4:
                $four++;
                break;
              case 5:
                $five++;
                break;
              
            }
}
$one = $one>0 ? (100/$count_reviews) * $one : 0;
  $two = $two>0 ? (100/$count_reviews) * $two : 0;
  $three = $three>0 ? (100/$count_reviews) * $three : 0;
  $four = $four>0 ? (100/$count_reviews) * $four : 0;
  $five = $five>0 ? (100/$count_reviews) * $five : 0;
        ?>
        <div class="">
          <div class="progress" style="height: 20px;">
          <?php /*if(in_array('5', $rate_arr)){
            $Rpercent = ($vals[5] / $en_count)*100;
            $Rpercent = round($Rpercent);
            } else{ $Rpercent = 0; }*/
          ?> 
            <div class="progress-bar grey_bg" role="progressbar" style="width:<?php echo $five;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <div class="rate-ex3-cnt" >
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
            <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
            <div id="4" class="rate-btn-4 rate-btn rate-btn-active"></div>
            <div id="5" class="rate-btn-5 rate-btn rate-btn-active"></div> 
            &nbsp;&nbsp;&nbsp;<span class="avg_percent"><a><?php echo $five;?> %</a></span>
          </div>
        </div>
        <div class="">
          <div class="progress" style="height: 20px;">
            <?php /*if(in_array('4', $rate_arr)){
              $Rpercent = ($vals[4] / $en_count)*100;
              $Rpercent = round($Rpercent);
              } else{ $Rpercent = 0; }*/
            ?>  
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $four; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <div class="rate-ex3-cnt" >
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
            <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
            <div id="4" class="rate-btn-4 rate-btn rate-btn-active"></div>
            <div id="5" class="rate-btn-5 rate-btn"></div> 
            &nbsp;&nbsp;&nbsp;<span class="avg_percent"><a><?php echo $four; ?> %</a></span>
          </div>
        </div>
        <div class="">
          <div class="progress" style="height: 20px;">
            <?php /*if(in_array('3', $rate_arr)){
              $Rpercent = ($vals[3] / $en_count)*100;
              $Rpercent = round($Rpercent);
              } else{ $Rpercent = 0; }*/
            ?>  
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $three; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <div class="rate-ex3-cnt" >
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
            <div id="3" class="rate-btn-3 rate-btn rate-btn-active"></div>
            <div id="4" class="rate-btn-4 rate-btn"></div>
            <div id="5" class="rate-btn-5 rate-btn"></div> 
            &nbsp;&nbsp;&nbsp;<span class="avg_percent"><a><?php echo $three; ?> %</a></span>
          </div>
        </div>
        <div class="">
          <div class="progress" style="height: 20px;">
          <?php /*if(in_array('2', $rate_arr)){
            $Rpercent = ($vals[2] / $en_count)*100;
            $Rpercent = round($Rpercent);
            } else{ $Rpercent = 0; }*/
          ?>  
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $two; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <div class="rate-ex3-cnt" >
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <div id="2" class="rate-btn-2 rate-btn rate-btn-active"></div>
            <div id="3" class="rate-btn-3 rate-btn"></div>
            <div id="4" class="rate-btn-4 rate-btn"></div>
            <div id="5" class="rate-btn-5 rate-btn"></div> 
            &nbsp;&nbsp;&nbsp;<span class="avg_percent"><a><?php echo $two; ?> %</a></span>
          </div>
        </div>
        <div class="">
          <div class="progress" style="height: 20px;">
            <?php /*if(in_array('1', $rate_arr)){
            $Rpercent = ($vals[1] / $en_count)*100;
            $Rpercent = round($Rpercent);
            } else{ $Rpercent = 0; }*/
            ?>  
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $one; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <div class="rate-ex3-cnt" >
            <div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
            <div id="2" class="rate-btn-2 rate-btn"></div>
            <div id="3" class="rate-btn-3 rate-btn"></div>
            <div id="4" class="rate-btn-4 rate-btn"></div>
            <div id="5" class="rate-btn-5 rate-btn"></div> 
            &nbsp;&nbsp;&nbsp;<span class="avg_percent"><a><?php echo $one; ?> %</a></span>
          </div>
        </div>
      </div>             
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="reviews_bottom_sect col-sm-12">
    <div class="">
      <div class="col-sm-12">
        <div class="col-sm-6 col-xs-4">
          <h3 class="review">Reviews</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12" id="review_msg">
<?php 

$reviews = $CI->program_model->getAllReview($programs->id);
if(!empty($reviews)){
  $tot_reviews = $CI->program_model->countReviews($programs->id);
  foreach ($reviews as $rev){ ?>
  <div class="cust_review">
    <div class="col-sm-3">
      <img src="<?php echo base_url(); ?>public/uploads/users/img/<?php if(!empty($rev->images)){ echo $rev->images;}else{echo 'default.jpg';}?>" class="img-circle user_image">
      <div class="review_time_sect">
        <p class="review_name"><?php echo $rev->first_name.' '.$rev->last_name; ?></p>
        <p class="review_date">
          <?php echo get_timeago(strtotime($rev->review_date)); ?>
        </p>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="rate-ex3-cnt rating_star">
        <p class="star">
          <?php for ($i=1; $i <=5 ; $i++) { ?>
          <span class="rate-btn-3 rate-btn <?php echo $i<=$rev->review_rate ? 'rate-btn-active' : '' ?>"></span>
          <?php } ?>
        </p>
        <p class="rev_content"><?php echo $rev->title; ?><br><?php echo $rev->description; ?>
        </p>
      </div>
    </div>
    <?php if($auth['group_id']=='4'){ ?>
    <div class="col-sm-1">
      <div class="delete_review">
        <a style="cursor:pointer" title="Delete review" onClick="return deleteconfirm('<?php echo $rev->review_id;?>')"><span class="lnr lnr-trash"></span>
        </a>
      </div>
    </div>
  <?php } ?>
  </div>
  <?php }
  if($tot_reviews > 5){ ?>
  <div class="col-sm-8 cust_review_btn" align="center">
    <button class="btn btn-default" type="button" data-purpose="show-more-review-button" id="btn_rev">Show More Reviews</button>
  </div>
  <?php } 
}
else{ ?>
  <div class="col-sm-8">
    No Reviews found!
  </div>
<?php } ?>
</div>
</div>
<script>
  function deleteconfirm(id) 
  {
    alert('currently YOU are not authorized to change this!\nFor more details contact the developers.');
    /*$.confirm({
      title: 'Are you sure?',
      content: 'Do you want to delete this review?',
      confirm : function(){
                $.post("<?php echo base_url(); ?>admin/programs/review_delete/"+id,
                  function(response){ 
                    if(response == "success"){
                      $.alert({
                        title: 'The review has been deleted.',
                        content: ' ',
                      });
                      setTimeout(function(){
                        $(document).find('#s_'+id).remove();
                      }, 3000);
                    }
                    else{
                      $.alert({
                        title: response,
                        content: ' ',
                      });
                    }
            });
      },
      cancel: function(){        
            return true;
      }
    });*/
  }
</script>