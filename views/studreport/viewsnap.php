<link rel="stylesheet" href="http://create-online-academy.com/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-theme.css">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/custom.css">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-core.css">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/skins/white.css">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-forms.css">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/bootstrap-min.css" id="style-resource-4">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-core-min.css" id="style-resource-5">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-theme-min.css" id="style-resource-6">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/neon-forms-min.css" id="style-resource-7">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/custom-min.css" id="style-resource-8">
<link rel="stylesheet" href="http://create-online-academy.com/assets/css/skins/white.css" id="style-resource-9">
<style>
.page-container.horizontal-menu header.navbar .navbar-brand {
  padding: 0px!important;
  text-align: center!important;
  width: 100%!important;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
  padding: 7px;
  line-height: 1.42857143;
  vertical-align: top;
  border-top: 1px solid #ebebeb;
}
</style>
<div class="page-container horizontal-menu sidebar-collapsed">
<header class="navbar">
    <div class="navbar-inner" style="background: whitesmoke;"> 
      <div class="navbar-brand logo"> 
        <a href="http://demo.neontheme.com/dashboard/main/"> 
        <?php
              $this->load->model('admin/settings_model');
              $configarr = $this->settings_model->getItems();             
              
        ?>
          <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $configarr[0]['logoimage']; ?>" width="100%" alt=""> 
        </a> 
      </div>     
    </div> 
</header>

<div class="clr"></div>
<div class="main-content" style="margin-top: 30px;">
<h2 style="text-align:center;">Webcam And Screen Shots</h2>
<hr>
<div> 
    <div class="col-md-6">   
          <table class="table table-bordered responsive" style="font-size:15px;">
                <thead>
                    <tr class="guru_orderhead">
                        <th style="color:#000;font-weight:bold;" width="10%">Question No.</th>
                         <th style="color:#000;font-weight:bold;" width="25%">Question</th>
                        <th style="color:#000;font-weight:bold;" width="15%">Question Type</th>
                        <th style="color:#000;font-weight:bold;" width="15%">Time spent on Question(min:sec)</th>
                        <th style="color:#000;font-weight:bold;" width="20%">Time spent on outside of window(min:sec)</th>                    
           
                    </tr>
                </thead>
                <tbody> 
                 <?php
                      $iii = 1;
                      $previous_time = 0;
                   //  echo '<pre>';
                  //   print_r($activeData);
                     foreach($activeData as $examinfo)
                     {


                 ?>
                  <tr>
                    <td><?php echo $iii;   ?></td>
                    <td><?php echo $examinfo->question; ?></td>
                    <td><?php echo $examinfo->question_type; ?></td>
                    <td><?php  $total_time = $examinfo->total_time_spent - $previous_time; 
                          echo gmdate("i:s", $total_time); ?>
                    </td>
                    <td><?php echo  gmdate("i:s",$examinfo->total_time_out_of_window); ?></td>
                  </tr>
                  <?php
                         $previous_time =  $total_time;
                      $iii++;
                    }
                  ?>
                </tbody>
        
      </table>
    <?php      
                //for webcam shots          
                $folderpath="public/uploads/webshotuploads/".$snapfoldername.'/attempt_'.$attempt_no  ;
                $files=glob($folderpath."/*.png");
                usort($files, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));

                if(count($files)>0)
                {
                    $noofrows=ceil(count($files));
                    $k=0;
                    for($i=0;$i<$noofrows;$i++)
                    {
                    ?>
                          <?php
                           for($j=1;$j<5;$j++)
                           {
                              if(array_key_exists($k,$files))
                              {       
                                $filename = explode('_', basename($files[$k]));  
                                $dateTime = $filename[1].' '.substr($filename[2],0,8);                         
                                ?>
                                <div class="panel panel-primary" data-collapsed="0"> 
                                    <div class="panel-heading"> 
                                      <div class="panel-title"><?php echo 'Date Time:- '.$dateTime;?></div> 
                                    </div>

                                    <div class="panel-body">
                                        <div class="panel-body">
                                              <!--<span class='head_tit'></span>-->
                                                  <img class="img-responsive" src="<?php echo base_url()."/".$files[$k] ?>" width='100%' height='100%' />
                                              <!--<span class='foot_tit'></span>-->                                    
                                          </div>  
                                     </div>  
                                  </div> 

                                <?php
                                $k++;
                              }
                              else
                              {
                                  break;
                              }
                           }
                          ?>
                    <?php
                    }
                }                
                ?>
      
  </div>
</div>
</div>
</div>
<div>

<!--
<?php      
                //for webcam shots          
                $folderpath="public/uploads/webshotuploads/".$snapfoldername.'/attempt_'.$attempt_no;
                $files=glob($folderpath."/*.png");
                usort($files, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));

                if(count($files)>0)
                {
                    $noofrows=ceil(count($files));
                    $k=0;
                    for($i=0;$i<$noofrows;$i++)
                    {
                    ?>
                          <?php
                           for($j=1;$j<5;$j++)
                           {
                              if(array_key_exists($k,$files))
                              {       
                                $filename = explode('_', basename($files[$k]));  
                                $dateTime = $filename[1].' '.substr($filename[2],0,8);                         
                                ?>
                                  <div class="row"> 
                                        <div class="col-md-6">   
                                        <div class="panel panel-primary" data-collapsed="0"> 
                                          <div class="panel-heading"> 
                                            <div class="panel-title">Left Panel</div> 
                                          </div>

                                          <div class="panel-body">
                                              <span class='head_tit'>Webcam Shots</span>
                                                  <img class="img-responsive" src="<?php echo base_url()."/".$files[$k] ?>" width='100%' height='100%' />
                                              <span class='foot_tit'><?php echo 'Date Time:- '.$dateTime;?></span>                                    
                                          </div>  
                                        </div>
                                        </div>
                                  </div>                                    
                                <?php
                                $k++;
                              }
                              else
                              {
                                  break;
                              }
                           }
                          ?>
                    <?php
                    }
                }                
                ?>
    </div>
</div>
</div>
-->