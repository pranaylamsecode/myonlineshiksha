<div class="content">
	<div class="clr"></div>
    <div>

    <table class="adminlist" width="100%">
    <thead>

    </thead>
                <tbody>


                <?php

                $folderpath="public/uploads/webshotuploads/".$snapfoldername;
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


</div>
