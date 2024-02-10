<style type="text/css">
.listbutton .btn-green{
    background-color: #11ca15 !important;
    border-color: #11ca15 !important;
    border-radius: 20px !important;  
}

.meeting_section {
   margin: 50px 0px 50px 0px;
}
.meeting_section ul li {
   display: inline-block;
   width: 20%;
   float: left;
   border: 1px solid #eee;
}
.meeting_label li {
   background: #f5f5f6;
   padding: 12px 10px;
   color: #000;
   font-size: 16px;
   text-align: center;
}
.meeting_value li {
   background: #f8f8f8;
   color: #000;
   font-size: 16px;
   text-align: center;
   padding: 10px 10px;
   min-height: 62px;
}
.meeting_label {
   display: inline-block;
   width: 100%;
}
.meeting_label ul, .meeting_value ul {
   width: 100%;
   margin: 0px;
   padding: 0px;
   display: flex;
   height: 100%;
}
.meeting_value {
   display: inline-block;
   width: 100%;
}
.meeting_section ul li a {
   background: #11ca15;
   color: #fff;
   padding: 7px 30px;
   border-radius: 50px;
}

.meeting_section ul li:first-child {
    width: 30%;
}
.meeting_section ul li:nth-child(2) {
    width: 25%;
}
.meeting_section ul li:nth-child(3), .meeting_section ul li:nth-child(4) {
    width: 15%;
}
.meeting_section ul li:nth-child(5) {
    width: 15%;
}
.meeting_value ul li:first-child {
    justify-content: flex-start;
    font-weight: bold;
}
}
.meeting_section ul li a {
    background: #11ca15;
    color: #fff;
    padding: 9px 45px;
    border-radius: 50px;
    font-size: 15px;
}
.meeting_value li {
    background: #f8f8f8;
    color: #888888;
    font-size: 16px;
    text-align: center;
    display: flex !important;
    padding: 7px 10px;
    min-height: 55px;
    justify-content: center;
    align-items: center;
}
.meeting_value ul li span {
    display: none;
}
@media (max-width: 767px){
    .meeting_label {
    display: none;
}
.meeting_value ul {
    display: inline-block !important;
}
.meeting_value ul {
    display: inline-block !important;
    background: #f8f8f8;
    border-bottom: 1px solid #eee;
    padding: 15px 0px 18px 0px;
}
.meeting_value ul:last-child {
    border-bottom: 0px;
}
.meeting_value ul li span {
    display: inline-block;
    padding-right: 5px;
}
.meeting_section ul li:first-child {
    width: 100%;
}
.meeting_section ul li:nth-child(2) {
    width: 100%;
}
.meeting_section ul li {
    border: 0px !important;
    text-align: left !important;
    justify-content: flex-start;
    height: auto;
    min-height: unset;
   
}
.meeting_section ul li:nth-child(3), .meeting_section ul li:nth-child(4) {
    width: auto;
    padding-right: 20px;
}
.meeting_section ul li:nth-child(5) {
    width: 100%;
}
.meeting_section ul li a {
    background: #11ca15;
    color: #fff;
    padding: 6px 35px 8px 35px;
    border-radius: 50px;
    line-height: 1.3em;
    font-size: 14px;
}
}
</style>
<div class="container-fluid course_dark-bg dark-bg">
    <div class="container second_section1">
        <div class="col-sm-12">
            <h1 class="big_head">Conferences</h1>
        </div>
    </div>
</div>

<div class="meeting_section">
  <div class="container">
    <div class="meeting_label">
   		<ul>
				<li>Title</li>
				<li>Start Time</li>
				<li>Duration</li>
				<li>ID</li>
				<li>Options</li>
   		</ul>
    </div>
    <div class="meeting_value">
   		<?php if (!empty($meetings)) {
   			foreach ($meetings as $key) {
          $end_time = date('Y-m-d H:i:s',strtotime($key->start_time . " +".$key->duration." minutes"));
          if($end_time > date('Y-m-d H:i:s')){
   				$join_url = urlencode($key->join_url);
   		?>
   		<ul>
				<li><?php echo ucwords($key->topic); if($key->status == 'started'){echo "<br>(meeting started join now)";}?></li>
				<li>Start time: <?php echo date('M d Y, h:i A',strtotime($key->start_time)); ?></li>
				<li><?php echo $key->duration; ?> Minutes</li>
				<li><span>ID: </span> <?php echo $key->meeting_id; ?></li>
        <?php if($key->status == 'started'){ ?>
        <li><a href="<?php echo base_url().'live-meeting/0/'.$join_url;?>" target="_blank">Join</a></li>
   		 <?php }else{ ?>
			 	<li><a href="#" id="wait">Wait</a></li>
       <?php } ?>
      </ul>
   		<?php } } }else{ ?>
    	<ul>
    		<li style="width: 100% !important;"><div>No Upcoming meetings found.</div></li>
			</ul>
   		<?php } ?>

    </div> 
  </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
	/*function get_login(){
		alert();return false;
	}*/
</script>