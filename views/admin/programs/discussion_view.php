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
$auth = $this->session->userdata('logged_in');
?>

<style>
  #wrap{
border: 1px solid lightgray;
alignment-adjust: central;
width: 100%;
margin-left: 10px;
margin-top: 0px;
box-shadow: 0 5px 0 #e6e6e6;
padding-bottom: 50px;

}

h3.heading {
  margin-left: 20px;
  background-color: #fafafa;
  font-size: 25px;
  float: left;
  padding-left: 65px;
  position: relative;
  width: 405px;
  height: 40px;
  padding-top: 5px;
}
#upper_blank{
border-bottom: 7px solid steelblue;
margin-top: 40px;
margin-right: 485px;
width: 570px;
padding-right: 480px;
}
p{
margin-left: 5px;
padding: 8px;
padding-left: 20px;
}
#name{
margin-left: 20px;
box-shadow: 0 2px 0 #e6e6e6;
height: 40px;
padding-left: 10px;
width: 500px;
}
#email{
margin-left: 20px;
box-shadow: 0 2px 0 #e6e6e6;
height: 40px;
padding-left: 10px;
width: 500px;
}
#url{
margin-left: 20px;
box-shadow: 0 2px 0 #e6e6e6;
height: 40px;
padding-left: 10px;
width: 500px;
}
#comment{
margin-left: 20px;
box-shadow: 0 2px 0 #e6e6e6;
height: 40px;
padding-left: 10px;
width: 650px;
height: 200px;
}
#commentSubmit{
margin-left: 20px;
width: 250px;
height: 55px;
color: white;
font-size: 20px;
background-color: #2c95dc;
box-shadow: 0 3px 0 #09466f;
margin-bottom: 30px;
padding-left: 20px;
border-radius: 5px;
}
#commentSubmit:hover {
background-color: #09466f;

}
.message {
  padding-left: 75px;
}
p{
font-size: 18px;
color: gray;
padding-bottom: 15px;
padding-top: 15px;
}
p1{
font-size: 18px;
padding-top: 20px;
}

h3.second_heading {
  margin-left: 0;
  margin-top: 0px;
  font-size: 20px;
  width: 250px;
  height: 50px;
  padding-top: 10px;
  padding-left: 70px;
}
#comment_div1 ul {
  list-style: none;
}
#middle{
border: 1px solid lightgray;
width: 1000px;
height: 200px;
background-color: lightyellow;
margin-left: 45px;
text-align: left;
margin-top: 10px;
box-shadow: 0 2px 0 lightgray;
}
.blank{
border-bottom: 7px solid steelblue;
margin-top: 50px;
margin-left: 50px;
margin-right: 100px;
width: 800px;
}

#inner_reply{

margin-left: 800px;
margin-top: 160px;
width: 100px;
height: 30px;
background-color: #2c95dc;
text-align: center;
font-size: 18px;
color: white;
border-radius: 18px;
}
.no_discussion {
  padding: 0px 0px 0px 0px;
  margin: 0px;
}
.ans{
  color: green !important;
  float: right;
  padding-right: 10px;
}
.not_ans{
  color: #f21111 !important;
  float: right;
  padding-right: 10px;
}
.ans i,.not_ans i{
  font-size: 16px !important;
}
.comment-text{
  padding-left: 6%;
}
.topic_desc p{
  padding-right: 5% !important;
  text-align: justify !important;
  font-size: 16px !important;
}
/*.not_ans i{
  font-size: 16px !important;
  display: inline-block;
  transform: rotate(180deg);
}*/
</style>
<input type="hidden" id="tid" value="<?php echo $auth['id']; ?>">
<input type="hidden" id="t_id" value="<?php echo $programs->author; ?>">
<div class="" style="padding-bottom: 50px !important;">
<!--  <div class="breadcrumb" style="padding-bottom: 20px;">
    <h3><?php //echo $programs->name;?></h3>
</div> -->

<div id="toolbar-box">
  <div class="m">
     
    <div class="pagetitle icon-48-generic"><h2>Discussions</h2>
     <h6 class="pmaintitle main_subtitle"> <?php echo $programs->name;?><br>Ask questions and get answers.</h6></div>
    <div id="toolbar" class="toolbar-list">

  <div id="sticky-anchor"></div>
  <ul id="sticky" style="list-style: none; float: right;">
    <li id="toolbar-new" class="listbutton">
      <a href="#" class="btn ">
        <i class="entypo entypo-popup"></i>
         <span class="icon-32-new">
      </span>
        New topic
        </a>
    </li>
  </ul>

    </div>
   </div>
</div>
<div class="top-head-box">
    <div id="table-3_length">
    <span >
       <input type="text" class="form-control form-height" placeholder="Search course topic"></input>
    </span>
    
      <span>
          <button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" ></span></button>
      </span>
    </div>
  </div>

  
<!-------Wrap------------>
 <?php
          $CI = & get_instance();
          $CI->load->model('program_model');
          if($quizcomment){
           

          foreach ($quizcomment as $quizComment)
          {
            // echo '<pre>';
            // print_r($quizcomment);
            // echo '</pre>';
            $userData = $this->program_model->getStudentsInfo($quizComment['user_id']);
            if(!empty($userData))
            {
                $lessonName = NULL;
              if($quizComment['lesson_id'])
              {
                $lessonName = $this->program_model->getLessonName_new($quizComment['lesson_id']);
                //print_r($lessonName);
              }
            ?>
           
           <div class="discussion_block">
              <div class="topic_title_info">
                <div class="topic_title">
                  <p><?php echo $quizComment['query_title']?></p>
                </div>
                <div class="answered">
                  <a href="#" class="answered_button">
                    answered 
                  </a>
                </div>
              </div>
              <?php if(!empty($quizComment['query_text'])){ ?>
              <div class="topic_desc">
                <p><?php echo $quizComment['query_text'];?></p>
              </div>
            <?php } ?>
              <div class="topic_post_info">
                <ul>
                  <li class="comment_by"><span class="dot"></span>
                  <?php echo ucwords($quizComment['first_name']." ".$quizComment['last_name']." - ");
                  ?> 
                  <?php echo get_timeago(strtotime($quizComment['dateandtime']));?>
                  </li>
                  <li class="lecture">
                    <span class="dot"></span><span class="blue_text">Lecture:</span> <?php if(strlen($lessonName)>50){ echo substr($lessonName, 0,50)."...";}else{echo $lessonName;} ?>
                  </li>
                  <?php $lessonAns = $this->program_model->getLessonAnswer($quizComment['query_id']); ?>
                  <li style="cursor: pointer;color: #545454;font-weight: bold;font-size: 14px;" onclick="show_div(<?php echo $quizComment['query_id']; ?>)"><i class="fas fa-comments" ></i> Replies: <?php if(!empty($lessonAns)){echo count($lessonAns);}else{echo "0";} ?></li>
                  <?php //echo $programs->author;
                  $i=0;
                  foreach($lessonAns as $answer)
                  {
                    if($answer['user_id']==104)
                      $i++;
                  }
                  if($i >= 1){
                  ?>
                  <li class="ans" id="ans_<?php echo $quizComment['query_id']; ?>">
                    <i class="fa fa-smile"></i> Answered
                  </li>
                <?php }else{ ?>
                  <li class="not_ans" id="ans_<?php echo $quizComment['query_id']; ?>">
                    <i class="fa fa-meh"></i> Not Answered
                  </li>
                <? } ?>
                </ul>
              </div>
              
              <div id="comment_div<?php echo $quizComment['query_id']; ?>" style="display:none" class="comment_sec">                      
                <ul id="question_list<?php echo $quizComment['query_id']; ?>">
                  <?php
                  
                  foreach($lessonAns as $answer)
                  {
                    $userData = $this->program_model->getStudentsInfo($answer['user_id']);
                    ?>
                    <li id="li<?php echo $answer['ans_id'];?>" class="">
                      <div class="comment_author_det">
                        <div class="comment-thumb"> 
                          <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/<?php if(!empty($userData->images)){echo  $userData->images;}else{echo 'default.jpg';}?>" alt="" class="img-circle" width="44"> 
                          </a> 
                        </div>
                        <div class="comment-author">
                          <a href="#">   <?php echo @$userData->first_name.' '.@$userData->last_name;?>
                          </a>
                        </div>
                        <div class="commented_on">
                        <p>Commented On <?php $timeago=get_timeago(strtotime($answer['dateandtime']));echo $timeago;?>
                        </p>
                      </div>
                      </div>
                      <div class="comment-text">
                        <?php echo $answer['answer']?>
                      </div>                          
                    </li>
                  <?php
                  }                  
                  ?>                      
                </ul>
                <ul class="comment_box">
                  <li>
                    <div>
                      <textarea name="comment_box<?php echo $quizComment['query_id']; ?>" placeholder="Write Reply" id="comment_box<?php echo $quizComment['query_id']; ?>"></textarea>
                      <input class="btn btn-success reply_btn" type="button" onclick="add_comment(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['pro_id']; ?>);" name="replyBtn<?php echo $quizComment['query_id']; ?>" id="replyBtn<?php echo $quizComment['query_id']; ?>" value="Reply"/>
                    </div>
                  </li>                   
                </ul>                    
              </div> 
            </div>

          <!--    <div id="wrap" class="discussion_row"> -->
           <!--    <div id="main">
                <div class="row">
                  <div class="" style="display: inline-block;">
                    <div class="comment-thumb col-md-2"> <a href="#"> 
                      <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> 
                    </div>
                    <div class="comment-author col-md-10" style="font-size: 13px;"> <a href="#"><?php echo @$userData->first_name.' '.@$userData->last_name;?></a> posted a discussion <br><b><?php echo ucfirst($lessonName);?></b>  
                        <div class="comment-info">- Commented On <?php  $timeago=get_timeago(strtotime($quizComment['dateandtime']));echo $timeago;?></div>
                    </div>

                    <div class="comment-content">
                      
                    </div>

                    <h3 class="heading"><?php echo $quizComment['query_title']?></h3>
                  </div>
                </div>
                <div  class="message"><?php echo $quizComment['query_text']?></div>

                <div class="second_heading"><a href="javascript:void(0);" id="comment<?php echo $quizComment['query_id']; ?>" onclick="show_div(<?php echo $quizComment['query_id']; ?>)">
                  <?php  $countcomment = $CI->program_model->getLessonAnswer2($quizComment['query_id']); ?>
                  <h3 class="second_heading"><b>(<?php echo $countcomment->count1; ?>)Comments</b></h3>
                  </a>
                </div>
                <div id="comment_div<?php echo $quizComment['query_id']; ?>" style="display:none">                      
                      <ul id="question_list<?php echo $quizComment['query_id']; ?>">
                        <?php
                        $lessonAns = $this->program_model->getLessonAnswer($quizComment['query_id']);           
                        foreach($lessonAns as $answer)
                        {
                          $userData = $this->program_model->getStudentsInfo($answer['user_id']);
                          ?>
                          <li id="li<?php echo $answer['ans_id'];?>">
                            <div class="comment">
                              <!--<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>-->
                              <!-- <div class="comment-content">
                                <div class="comment-author" style="font-size: 13px;"><a href="#"><?php echo @$userData->first_name.' '.@$userData->last_name;?></a> - Commented On <?php $timeago=get_timeago(strtotime($answer['dateandtime']));echo $timeago;?></div> -->
                                <!--<div class="comment-head"><?php echo $quizComment['query_title']?></div>-->
                               <!--  <div class="comment-text"><?php echo $answer['answer']?></div>                              
                              </div>
                            </div>
                          </li>
                        <?php
                        }                  
                        ?>                      
                      </ul>
                      <ul>
                        <li>
                          <div>
                            <textarea name="comment_box<?php echo $quizComment['query_id']; ?>" placeholder="Write Reply" id="comment_box<?php echo $quizComment['query_id']; ?>"></textarea>
                            <input class="btn btn-success" type="button" onclick="add_comment(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['pro_id']; ?>);" name="replyBtn<?php echo $quizComment['query_id']; ?>" id="replyBtn<?php echo $quizComment['query_id']; ?>" value="Reply"  />
                          </div>
                        </li>                   
                      </ul>                    
                </div>   -->
             <!--  </div>  -->
      <!--      </div>  -->
            
          <?php }
          }
           ?>
          
         
<?php   }
            else{
          echo "<h4 class='no_discussion'>No discussions. Start a new one.</h4>";
        } ?>

<!-------------------Reply Section------->


</div>



<!-- **************** -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
 
function show_div(id) {
   //alert(id);
    $('#comment_div'+id).toggle();
    
    //$('#comment_box'+id).redactor();
  
}
</script>

<script>
function add_comment(query_id,pid)
  {
        var answer = $('#comment_box'+query_id).val();
        var listresult = '';
        var querylist = '';
        $("#replyBtn"+query_id).attr('disabled',true);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>programs/saveanswer",
            data    : {'query_id':query_id,'pid':pid,'answer':answer},
 
           success: function(data){
           $("#replyBtn"+query_id).attr('disabled',false);
        if(data=='error'){
        alert("Their was error while processing, try again!");
        }else{
          
        //listresult = $.parseJSON(data);
        
      //$.each(listresult, function(queryk, querydata){
          
        /*querylist += '<li'+querydata.ans_id+'>';
        querylist += '<div class="comment">';       
        querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';        
        querylist += '<div class="comment-content">';
        querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> - Commented On '+querydata.dateandtime+' </div>';
        querylist += '<div class="comment-text">'+querydata.answer+'</div>';
        querylist += '</div>';
        querylist += '</div>';
        querylist += '</li>';*/
        //});
          if(querylist == ''){
          querylist = 'No questions have been asked so far';
        }
        //$('#question_list'+querydata.query_id).html(querylist);
        $('#question_list'+query_id).html(data);
        countComment(query_id);
        $('#comment_box'+query_id).val('');
        if($("#tid").val() == $("#t_id").val())
        {
          if($("#ans_"+query_id).hasClass('not_ans'))
          {
            $("#ans_"+query_id).removeClass('not_ans');
            $("#ans_"+query_id).addClass('ans');
            $("#ans_"+query_id).html('<i class="fa fa-smile"></i>Answered');
          }   
        }
      }
    }
 
   });
 
        // return false;  //stop the actual form post !important!
 
}//);
  // });
</script>

<script>
  function countComment(qid)
  {
    $.ajax({
      type:"post",
      url:"<?php echo base_url(); ?>programs/countComment",
      data:{'qid':qid},
      success:function(data)
      {
        //alert(data);
        //$("#countComment").html(data);
        $("#countComment"+qid).text(data);
      }

    });
  }

</script>

<script>
  // $(function(){
    //   $("#search").click(function(){
  function like(query_id,questioner_id,pro_id)
  {
     
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
    
    
      
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>programs/like",
            data    : {'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id},
 
           success: function(data){
             
       $("#like"+query_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#query_text').redactor();
  });
</script>

<script type="text/javascript">
function unlike(like_id,query_id,questioner_id,pro_id)
  {
     
        var  like_id = like_id;
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
    
    
      
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>programs/unlike",
            data    : {'like_id':like_id,'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id},
 
           success: function(data){
             
       $("#like"+query_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.discuss_modal_close').click(function() {
        $("#discussion").hide();      
            
     });
});
</script>



<script type="text/javascript">
  function showDiscussdiv()
  {
    if (document.getElementById("discussion").style.display == 'block') {
               document.getElementById("discussion").style.display = 'none';
       }else{
               document.getElementById("discussion").style.display = 'block';
       }  
     
     if (document.getElementById("discussion_lean_overlay").style.display == 'block') {
               document.getElementById("discussion_lean_overlay").style.display = 'none';
       }else{
               document.getElementById("discussion_lean_overlay").style.display = 'block';
       }
  
  }

</script>

<script>
/************<start askquery code */
  function postDisscussion(){
    
      
    var querytitle_val = $('#query_title').val();
      var querycont_val = $('#query_text').val();
    

    if( querytitle_val =='' || querycont_val =='' ){
    return false;
    }
    var qpid_val = $('#lqprogid').val();
    
    
    var listresult = '';
    var querylist = '';
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>programs/SaveAndGetQueryList",
    data: { 'query_title': querytitle_val, 'query_text': querycont_val, 'qpid': qpid_val }
    }).success(function( data ) {
        if(data=='error'){
    alert('Teir was error while processing, try again!');
    }else{
    /*listresult = $.parseJSON(data);
    $.each(listresult, function(queryk, querydata){
    
    querylist += '<li>';
        querylist += '<div class="comment">';
        querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';
        querylist += '<div class="comment-content">';
        querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>  ';
        querylist += '<div class="comment-info">- Commented On '+querydata.dateandtime+'</div>';
        querylist += '</div>';
    querylist += '<div class="comment-head">'+querydata.query_title+'</div>';
        querylist += '<div class="comment-text">'+querydata.query_text+'</div>';
        querylist += '<a href="javascript:void(0);" class="liked" id="like'+querydata.query_id+'"  style="margin: 0 45px;"> <i class="entypo-heart"></i>';
        querylist += '</a>';
    querylist += '</li>';
      });     

      if(querylist == ''){
      querylist = 'No questions have been asked so far';
      }*/
      getDiscussion(qpid_val);
     $("#discussion").hide();
     $("#discussion_lean_overlay").hide();

    //$("#comments-list1").html(querylist);
    }


    });
  }
</script>
<script>
  $(document).ready(function() 
  {
    $('#txt_notes').keydown(function() 
    {
      
    var searchitem = $('#txt_notes').val();
    var course_id =<?php echo $this->uri->segment(3) ?>;
    if (event.keyCode == 13)
    {   
    
      $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/searchDiscuss",
      data: {searchitem:searchitem,course_id:course_id}, 
      success: function(response)
      { 
          
        $("#queAns").html(response);        
      }
          }); 
    
    
    $("#txt_notes").val('');
    return false;
    }
    });
  });
  
</script>
<script>
function getDiscussion(course_id)
{    
  $.ajax({
        type:"post",
        url:"<?php echo base_url();?>programs/getDiscussion",
        data:{course_id:course_id},
        success:function(data)
          {
            $("#queAns").html(data);
            $("#query_title").val("");
            $("#query_text").val("");
          }

      });
}
</script>
<script>

  $(document).ready(function()
  {
    $("#search_student").keydown(function()
    {
      var searchitem = $('#search_student').val();
      var course_id =<?php echo $this->uri->segment(3) ?>;
      if (event.keyCode == 13)
      {       
        $.ajax({
            type:"post",
            url:"<?php echo base_url();?>programs/getSearchStudent",
            data:{searchitem:searchitem,course_id:course_id},
            success:function(data)
            {
              //alert(data);
              $("#searchstudent").html(data);
            }
            });
    $('#search_student').val("");
    return false;
      }
    });

  });

</script>
<script>
  function showAllDiscuss()
  {
  var course_id =<?php echo $this->uri->segment(3) ?>;
  $.ajax({
        type:"post",
        url:"<?php echo base_url();?>programs/getAllDiscussion",
        data:{course_id:course_id},
        success:function(data)
          {
            //alert(data);
            $("#queAns").html(data);
            
          }

      });
    
  }
</script>
<script>
   $(document).ready(function(){
    var $lis = $('.comment_sec ul li');
    if ($lis.length > 1) {
      $lis.addClass("comment_row");
      $('.comment_sec ul li:first-child').css("padding-top","0px");
       $('.comment_sec ul li:last-child').css({"border": "0px", "padding-bottom": "0px"});
    }
  });
</script>



<!-- ///////////// -->
