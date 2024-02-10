<style type="text/css">
#message {
    position: fixed; 
  right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
</style>
<span id="message">
</span>
<div class="main-container">
   <div class="row">
      <div class="col-sm-10 form-body manageStudentCard">
       
               <h2>Manage Students Count</h2>
           
            <div class="form-inner-body row">            
               <div class="col-sm-12 form-group">
                  <label class="control-label field-title">Course Name : </label>
                  <select class="form-control field-title" id="course_id">
                        <option value="">Select Course</option>
                        <?php foreach ($coursess as $key) {
                        ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->name.' - ( '.$key->student_count.' )';?></option>
                        <?php } ?> 
                  </select>
                  <span class="error" id="err_course"></span>
               </div>
               <div class="col-sm-6">
                  <div class=" form-group">
                     <label class="control-label field-title">Students Count :</label>
                     <input type="text" class="form-control field-title" id="stud_count" onkeypress="only_number(event)">
                     <span class="error" id="err_scount"></span>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class=" form-group">
                     <label class="control-label field-title">Reviews Count :</label>
                     <input type="text" class="form-control field-title" id="rev_count" onkeypress="only_number(event)">

                     <!-- <select class="form-control field-title" id="rev_count">
                        <option value="">--- select ratings ---</option>
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                     </select> -->
                     <span class="error" id="err_rcount"></span>
                  </div>
               </div>
               <div class="form-group col-sm-12" >
                  <button class="btn btn-success btn-md control-label" type="button" onclick="check_error()" > Update </button>
               </div>
            </div>
         </div>
     

<!-- <div class="">
   <div class="form-body ">
      <div class="col-sm-12 col-xs-12"><label class="control-label field-title">Manage Reviews Count</label>
         <div class="form-inner-body">            
            <label class="control-label field-title">Course Name : </label>
            <select class="form-control field-title" id="course_id1">
                  <option value="">select Course</option>
                  <?php foreach ($coursess as $key) { 

                  ?>
                  <option value="<?php echo $key->id; ?>"><?php echo $key->name.' - ( '.$key->review_count.' )';?></option>
                  <?php } ?> 
            </select>
            <label class="control-label field-title">Count :</label>
            <input type="text" class="form-control field-title" id="rev_count">
            <button class="btn btn-success btn-md control-label" type="button" onclick="check_errors()" style="font-size: 18px;height: auto;margin-top: 10px;"> Update </button>
         </div>
      </div>
   </div>
</div> -->

   <div class="col-sm-10 form-body">
     
            <h2>Add New Reviews</h2>
            <div class="form-inner-body">
               <form action="<?php echo base_url('reseller/insert_reviews');?>" method="POST" enctype='multipart/form-data'>
               <div class="row">
                  <div class="col-md-6">
                     <label class="control-label field-title">Course Name : <span id="err_message" class="error"></span></label>
                     <select class="form-control field-title" name="course_id2" id="course_id2">
                        <option value="">Select Course</option>
                        <?php foreach ($coursess as $key) { ?>
                        <option value="<?php echo $key->id;?>"><?php echo $key->name;?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Review Rate :</label>
                     <!-- <input type="text" class="form-control field-title" name="review_rate" id="review_rate" onkeypress="only_number(event)" maxlength="1" onkeyup="return maxrev(this.value)"> -->
                     <select class="form-control field-title" name="review_rate" id="review_rate">
                        <option value="">--- Select Ratings ---</option>
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Customer Name :</label>
                     <input type="text" class="form-control field-title" name="customer_name">
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Customer Profile :</label>
                     <input type="file" class="form-control field-title" name="customer_profile">
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Title :</label>
                     <input type="text" class="form-control field-title" name="review_title">
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Description :</label>
                     <input type="text" class="form-control field-title" name="description">
                  </div>
                  <div class="col-md-6">
                     <label class="control-label field-title">Review Date :</label>
                     <input type="text" class="form-control field-title datepick" name="review_date" id="review_date" readonly="">
                  </div>
               </div>
               <button class="btn btn-success btn-md control-label" type="submit" > Update </button>
               </form>
            </div>
      
   </div>
</div>
</div>
<?php $msg = $this->session->userdata('message');
         $this->session->unset_userdata('message');
?>
<input type="hidden" id="sess_msg" value="<?php echo $msg;?>">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      var msg = $("#sess_msg").val().trim();
      if(msg != ''){
         $("#err_message").html('please select course');
         setTimeout(function(){$("#err_message").html('');},3000);
         $("#course_id2").focus();
      }
   });


   function check_error()
   {
      var course_id = $("#course_id").val();
      var stud_count = $("#stud_count").val().trim();
      var rev_count = $("#rev_count").val().trim();
      if(course_id == ''){
         $("#err_course").html('please select course');
         setTimeout(function(){$("#err_course").html('');},2000);
         $("#course_id").focus();
         return false;
      }
      if(stud_count == ''){
         $("#err_scount").html('please enter no. of student');
         setTimeout(function(){$("#err_scount").html('');},2000);
         $("#stud_count").focus();
         return false;
      }
      if(rev_count == ''){
         $("#err_rcount").html('please enter no. of reviews');
         setTimeout(function(){$("#err_rcount").html('');},2000);
         $("#rev_count").focus();
         return false;
      }
      $.ajax({
         type: "POST",
         cache: false,
         url : "<?php echo base_url();?>reseller/update_count/",
         data : {
            course_id : course_id,
            stud_count : stud_count,
            rev_count : rev_count,
         },
         success : function(data)
         {
            $("#message").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Updated.</span></div>');
            setTimeout(function(){$("#message").html('');},2000);
         }
      });
   }
   /*function check_errors()
   {
      var course_id1 = $("#course_id1").val();
      var rev_count = $("#rev_count").val().trim();

      $.ajax({
            type: "POST",
            cache: false,
            url : "<?php echo base_url();?>reseller/update_counts/",
            data : {
               course_id1 : course_id1,
               rev_count : rev_count
            },
            success : function(data)
            {
               $("#course_id1").html(data);
            }
      });
   }*/
   function only_number(event) {
      var x = event.which || event.keyCode;
      console.log(x);
      if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
         return;
      } else {
         event.preventDefault();
      }
   }
   function maxrev(val)
   {
      if(val > 5)
      {
         $("#review_rate").val('1');
         $("#review_rate").css('border',"1px solid red");
         $("#review_rate").focus();
      }
   }
   $(function () {
      $("#review_date").datepicker({ //<-- yea .. the id was not right
           format: "yyyy-mm-dd", // <-- format, not dateFormat
           showOtherMonths: true,
           selectOtherMonths: true,
           autoclose: true,
           changeMonth: true,
           changeYear: true,
       });
   });
</script>