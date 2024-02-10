<div class="page-container">
<div class="sidebar-menu">
	<ul id="main-menu">
    <li class="root-level"><a href="<?php echo base_url(); ?>my-account">My Account</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-courses">My Courses</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-orders">My Orders</a></li> 
    <li class="root-level"><a href="<?php echo base_url(); ?>my-exams">My Exams</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-certificates">My Certificates</a></li>
  </ul>
</div>


<div class="main-content" style="min-height: 820px;">
	<div class="row">
    <div class="holder" id="mrp-container2">


<div id="system-message-container"></div>



<div class="content">

<?php


$attributes = array('class' => 'tform', 'name' => 'myquiz');


echo form_open_multipart(base_url().'myinfo/mycourses/',$attributes);


?>


	<div class="course_search" style="float:left; margin-top: 15px; margin-left: 20px;">


		<input type="text" value="" name="search_course" class="textbox" style="float:left; margin-right:10px; height:30px;">


		<button type="submit" name="Submit" value="Search" class="btn btn-info"><i class="entypo entypo-search"></i> Search</button>


	   	<button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: -2px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button>


	</div>


<?php echo form_close(); ?>


	<div class="clr"></div>

<hr />
    <?php


    if(isset($get_orders) && !empty($get_orders)){





    foreach($get_orders as $get_order){    ?>


        <div class="orders" id="orders">


              <ul>


                  <li class="order_row odd">


                      <ul>


                          <?php


                             $courses = $get_order->courses;


                             $courses = explode("|", $courses);


                             $date = $get_order->order_date;


                                 foreach($courses as $course){


                                 $course_id_array = explode("-", $course);


                                 $course_id = $course_id_array["0"];


                  			     $course_name = $this->Myinfo_model->getOrderCourses($course_id);


                                    if($course_name != NULL){


                                    $course_link = base_url()."programs/program/".$course_id;


                                    $course_link = '<a href="'.$course_link.'">'.$course_name->name.'</a>';


                                    $plan = "";


                                        if(isset($course_id_array["1"]) && trim($course_id_array["2"]) != ""){


                                          if(isset($all_plans[trim(@$course_id_array["2"])]["term"]) && @$all_plans[trim(@$course_id["2"])]["term"] != "Unlimited"){


                                          $period = $all_plans[trim(@$course_id_array["2"])]["period"];


                                              if($all_plans[trim($course_id_array["2"])]["term"] <= 1 && (substr($period, -1) == "s")){


                                                    $period = substr($period, 0, -1);


                                              }


                                              if($all_plans[trim($course_id_array["2"])]["term"] == "0"){


                                                    $plan = " - UNLIMITED";


                                              }


                                              else{


                                                    $plan = " - ".$all_plans[trim($course_id_array["2"])]["term"]." ".$period;


                                              }


                                          }


                                          else{


                                          $plan = " - UNLIMITED";


                                          }


                                       }


                                    echo '<li class="guru_product_name">'.$course_name->name.$plan.'</li>';


                                    }


                            	}


                                $edit_date = "";


                                $config = $get_config[0]['hour_format'];


                                $datetype = $get_config[0]['datetype'];


                                if($config == 24){


                                    //$edit_date = date('m-d-Y | H:i' , strtotime($date));





                                    $format = "m-d-Y";


                                    switch($datetype){


                                    case "d-m-Y H:i:s": $format = "d-m-Y H:i";


                                    break;


                                    case "d/m/Y H:i:s": $format = "d/m/Y H:i";


                                    break;


                                    case "m-d-Y H:i:s": $format = "m-d-Y H:i";


                                    break;


                                    case "m/d/Y H:i:s": $format = "m/d/Y H:i";


                                    break;


                                    case "Y-m-d H:i:s": $format = "Y-m-d H:i";


                                    break;


                                    case "Y/m/d H:i:s": $format = "Y/m/d H:i";


                                    break;


                                    case "d-m-Y": $format = "d-m-Y";


                                    break;


                                    case "d/m/Y": $format = "d/m/Y";


                                    break;


                                    case "m-d-Y": $format = "m-d-Y";


                                    break;


                                    case "m/d/Y": $format = "m/d/Y";


                                    break;


                                    case "Y-m-d": $format = "Y-m-d";


                                    break;


                                    case "Y/m/d": $format = "Y/m/d";


                                    break;


                                    }


                                    //$edit_date = JHTML::_('date', strtotime($date), $format);


                                    $edit_date = date($format, strtotime($date));


                                }


                                elseif($config == 12){


                                    //$edit_date = date('m-d-Y | h:i A' , strtotime($date));


                                    $format = " m-d-Y ";


                                    switch($datetype){


                                    case "d-m-Y H:i:s": $format = "d-m-Y h:i A";


                                    break;


                                    case "d/m/Y H:i:s": $format = "d/m/Y h:i A";


                                    break;


                                    case "m-d-Y H:i:s": $format = "m-d-Y h:i A";


                                    break;


                                    case "m/d/Y H:i:s": $format = "m/d/Y h:i A";


                                    break;


                                    case "Y-m-d H:i:s": $format = "Y-m-d h:i A";


                                    break;


                                    case "Y/m/d H:i:s": $format = "Y/m/d h:i A";


                                    break;


                                    case "d-m-Y": $format = "d-m-Y A";


                                    break;


                                    case "d/m/Y": $format = "d/m/Y A";


                                    break;


                                    case "m-d-Y": $format = "m-d-Y A";


                                    break;


                                    case "m/d/Y": $format = "m/d/Y A";


                                    break;


                                    case "Y-m-d": $format = "Y-m-d A";


                                    break;


                                    case "Y/m/d": $format = "Y/m/d A";


                                    break;


                                }


                                //$edit_date = JHTML::_('date', strtotime($date), $format);


                                $edit_date = date($format, strtotime($date));


                          }





                           echo '<li class="guru_details"><strong>Purchased on:</strong> '.$edit_date.' </li>';


                        ?>


                      </ul>


                      <span class="order_invoice">


                            <a href="<?php echo base_url();?>myinfo/orderdetails/<?php echo $get_order->id; ?>">View &amp; Print</a>


                      </span>


                     <div class="clr"></div>


                  </li>


              </ul>


        </div>


        <?php }


            }else{


            echo "there is no record in the database";





            }


        ?>


    <div>


</div>
    </div>
</div>



</div>










<div id="rich-text1">


<div class="weblet-inner">


<div class="steps-holder">


</div>


</div>


</div>


<div id="rich-text2">


<div class="weblet-inner">


</div>


</div>


<div id="rich-text3">


<div class="weblet-inner">


</div>


</div>


<div id="rich-text4">


<div class="weblet-inner">


</div>


</div>


</div>


<div class="holder2">





<div class="bottom-boxes">





<div class="frame">


</div>


</div>


</div>


</div>


