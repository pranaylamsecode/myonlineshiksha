<div id="content-top">
	<h2>Select User </h2>
    <span class="clearFix">&nbsp;</span>
</div>
<form name="adminForm" method="post">
	<input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>/admin/users/create_newuser.php/';" value="0">Add a student who doesn't exist in the user database
	<br>
	<input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>/admin/users/create_user.php/';" value="1">Add a student who already exists in the user database
</form>