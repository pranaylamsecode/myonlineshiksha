<form id="search" method="post">
<div class="form-group col-md-3 col-md-offset-1 col-sm-12 col-xs-12">
    <div>
        <label >Race</label>
        <select id="admin-race">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
	
    <div>
        <label>Gender</label>
        <select id="CbGender" name="CbGender">
            <option value="N/A">N/A</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
	
    <div>
        <label>Entering Law School</label>
        <select id="admin-law-school">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
</div>

<input class="btn btn-color-primary pull-right" type="button" value="Submit" />

<a href="#" onclick="ajax_wishlist(111111111111)">WWW</a>

</form>
<div id="results1"></div>
<script>
   $(function(){
    $("#search").click(function(){
	
			dataString = parseInt(pro_id);
			alert(dataString);
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/blogs/search",
           data: dataString,
 
           success: function(data){
               alert(data);
			   $("#results1").html(data);
           }
 
         }); 
 
        // return false;  //stop the actual form post !important!
 
      });
   });
</script>						