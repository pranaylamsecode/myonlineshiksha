<?php
class ModifyClass
{
	
	function ModifyClass($secretAcessKey,$access_key,$webServiceUrl,$data,$dbname,$db_uname,$class_id,$proid)
	{

		 $time = explode(":",$data['fromtime']);
		   $minutes = substr($time[1],0,2);
		   $ampm = substr($time[1],-2);
		   if($ampm == "PM")
		   {
		      $time[0] = $time[0]+12;
		   }
		   
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "modify";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["start_time"] = $data['fromdate'].' '.$time[0].':'.$minutes;
		$requestParameters["title"]= $data['title']; //Required
		$requestParameters["duration"]= $data['web_duration']; //optional
		$requestParameters["time_zone"]="GMT"; //optional
		$requestParameters["attendee_limit"]=""; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
		 $requestParameters["class_id"] = $class_id;
		// $requestParameters["presenter_id"] = "40";
		// $requestParameters["presenter_name"] = "vinugeorge";  
		// $requestParameters["start_time"] = "2011-05-30 21:00"; 
		// $requestParameters["title"]="my php-class Updated"; //Required
		// $requestParameters["duration"]=""; //optional
		// $requestParameters["time_zone"]=""; //optional
		// $requestParameters["attendee_limit"]=""; //optional
		// $requestParameters["control_category_id"]=""; //optional
		// $requestParameters["create_recording"]=""; //optional
		// $requestParameters["return_url"]=""; //optional
		// $requestParameters["status_ping_url"]=""; //optional
                $requestParameters["language_culture_name"]="en-us";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=modify',http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
			  echo $e->getMessage();
			}
			$status=$objDOM->getElementsByTagName("rsp")->item(0);
    		$attribNode = $status->getAttribute("status");
			if($attribNode=="ok")
			{
				$methodTag=$objDOM->getElementsByTagName("method");
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$modifyTag=$objDOM->getElementsByTagName("modify")->item(0);
				echo "<br>modify=".$modify = $modifyTag->getAttribute("status");
				$cxn = mysql_connect('localhost', $db_uname, 'VeerIT123');
			if(mysql_select_db($dbname, $cxn))
			{	

				//  $query = "INSERT into mlms_webinars (proid, type, title, privacy, fromdate, fromtime, allday, repeate, untilldate, web_duration, start_recording, status, created_by, creator_email) values('".$data['proid']."','".$data['type']."','".$data['title']."','".$data['privacy']."','".$data['fromdate']."','".$data['fromtime']."','".$data['allday']."','".$data['repeate']."','".$data['untilldate']."','".$data['web_duration']."','".$data['start_recording']."','".$data['status']."','".$data['created_by']."','".$data['creator_email']."') " ;		
			 //    $result1 = mysql_query($query);			   
				// $webinar_id =  mysql_insert_id();

				
				 // $sql = "UPDATE `mlms_webinars` set wiziq_class_id='".$Class_ID."',wiziq_recording_url='".$recording_url."',wiziq_presenter_email='".$presenter_email."',wiziq_presenter_url='".$presenter_url."' WHERE id = '".$webinar_id."' " ;
				 // $result = mysql_query($sql) or die('Could not execute query');

				 $sql = "UPDATE `mlms_webinars` set title='".$data['title']."',type='".$data['type']."',privacy='".$data['privacy']."',fromdate='".$data['fromdate']."',fromtime='".$data['fromtime']."',web_duration='".$data['web_duration']."',status='".$data['status']."' WHERE id = '".$data['id']."' " ;
				 $result = mysql_query($sql) or die('Could not execute query');		
			} 
		  
			
			echo "<script>document.location.href='edit/".$proid."/success"."'</script>";
			}
			else if($attribNode=="fail")
			{
				$error=$objDOM->getElementsByTagName("error")->item(0);
				echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
				echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
			}
	 	}//end if	
   }//end function
	
}
?>