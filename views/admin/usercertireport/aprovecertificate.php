
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
            <ul>
			<li id="toolbar-new" class="listbutton">

			<?php
            $attributes = array('class' => 'tform', 'id' => '');
            echo form_open(base_url().'/admin/usercertireport/approvecerti/', $attributes);
            ?>
            <input type="hidden" name="qtid" value="<?php echo $quizdetail->id; ?>" />
            <a>
            <?php
            echo form_submit('submit','',"id='submit' class='save_btn'");
            echo "<br />Approve";
            ?>
            </a>
            <?php
            echo form_close();
            ?>

			</li>
            <li id="toolbar-new" class="listbutton">
			<a href='<?php echo base_url(); ?>admin/usercertireport/' class='bforward'><span class="icon-32-cancel"> </span>Cancel</a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Certificate Report</h2></div>
	</div>
</div>


<div class="content">
	<div class="clr"></div>
    <div>

	<table class="adminlist" width="100%">
    <thead>

    </thead>
                <tbody>


                <?php
                //echo "<pre>";
                //print_r($quizdetail);
                //echo "</pre>";

                $folderpath="public/uploads/webshotuploads/".$quizdetail->snapfoldername;
                $files=glob($folderpath."/*.png");

                if(count($files)>0)
                {
                    $noofrows=ceil(count($files)/4);
                ?>

                <?php
                $k=0;
                  for($i=0;$i<$noofrows;$i++)
                  {
                ?>
                   <tr>
                        <?php

                         for($j=1;$j<5;$j++)
                         {
                           if(array_key_exists($k,$files))
                           {
                        ?>
                          <td><img src="<?php echo base_url()."/".$files[$k] ?>" width='100%' height='100px' /></td>
                        <?php
                        $k++;
                        }
                        else
                        {
                          break;
                        }
                         }
                        ?>

                   </tr>
                <?php

                  }
                }
                ?>

			   </tbody>
    </table>
    </div>
    <div class="clr"></div>
    <div>

        <table class="adminlist" width="100%" align="center">
    <thead>

    </thead>
                <tbody>
                <?php
                  $this->load->model('admin/Userreport_model');
                ?>
                 <tr>
                    <td><b>Course Name</b></td><td><?php echo $this->Userreport_model->getProgramName($quizdetail->pid);?></td>
                 </tr>
                 <tr>
                    <td><b>User Name</b></td><td><?php echo $this->Userreport_model->getUserName($quizdetail->user_id);?></td>
                 </tr>

                 <tr>
                    <td><b>Passing Score</b></td><td>
                        <?php
                            $quizinfo=$this->Userreport_model->getQuiz($quizdetail->quiz_id);
                            echo $quizinfo->max_score;?>%
                        </td>
                 </tr>


                 <tr>
                    <td><b>Final Exam Score</b></td><td><?php
                    list($hms,$tques)=explode('|',$quizdetail->score_quiz);
                    echo $scoreobtained=($hms/$tques)*100;
                    ?>%</td>
                 </tr>

                 <tr>
                    <td><b>Result</b></td><td><?php
                    if($scoreobtained>=$quizinfo->max_score)
                    {
                          echo "Pass";
                    }
                    else
                    {
                      echo "Fail";
                    }
                    ?></td>
                 </tr>

                 <tr>
                    <td><b>Exam Date</b></td><td><?php echo $quizdetail->date_taken_quiz;?></td>
                 </tr>
			   </tbody>
    </table>

    </div>

</div>
