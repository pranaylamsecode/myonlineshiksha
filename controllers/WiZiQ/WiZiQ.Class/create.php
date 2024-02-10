<?php
class ScheduleClass
{
	function ScheduleClass($secretAcessKey,$access_key,$webServiceUrl,$data,$dbname,$db_uname)
	{	   

	  /* $data
			(
				[proid] => 252
				[title] => Javac
				[type] => webinar
				[privacy] => private
				[fromdate] => 2015-01-22
				[fromtime] => 0
				[todate] => 2015-01-30
				[totime] => 0
				[allday] => 1
				[repeate] => never
				[untilldate] => 2015-01-30
				[start_recording] => 1
				[status] => active
			) */
			
			
		   $time = explode(":",$data['fromtime']);
		   $minutes = substr($time[1],0,2);
		   $ampm = substr($time[1],-2);
		   if($ampm == "PM")
		   {
		      $time[0] = $time[0]+12;
		   }
		   
		  // echo $data['fromdate'].' '.$time[0].':'.$minutes;
		
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization’s teacher account. ’ For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters["presenter_email"]="manish.b@veerit.com";
		#for room based account pass parameters 'presenter_id', 'presenter_name'
		//$requestParameters["presenter_id"] = "40";
		//$requestParameters["presenter_name"] = "vinugeorge";  
		$requestParameters["start_time"] = $data['fromdate'].' '.$time[0].':'.$minutes;
		$requestParameters["title"]= $data['title']; //Required
		$requestParameters["duration"]= $data['web_duration']; //optional
		$requestParameters["time_zone"]="GMT"; //optional
		$requestParameters["attendee_limit"]=""; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
        $requestParameters["language_culture_name"]="en-us";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&')); 
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
		    $method = $method=$methodTag->item(0)->nodeValue; //echo "method=".$method=$methodTag->item(0)->nodeValue; //
			 
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			$Class_ID = $class_id=$class_idTag->item(0)->nodeValue; //  echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue; //
			
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			$recording_url = $recording_urlTag->item(0)->nodeValue; //  echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue; //

			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			$presenter_email = $presenter_emailTag->item(0)->nodeValue; //  echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue; //
			
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			$presenter_url = $presenter_urlTag->item(0)->nodeValue; //  echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue; //
			
			/*$data2 = array('Class_ID'=>$Class_ID,
						   'recording_url'=>$recording_url,
						   'presenter_email'=>$presenter_email,
						   'presenter_url'=>$presenter_url);
			$data = array_merge($data,$data2); */
			//return $webinar_param = array('webinar_msg'=>$attribNode,'method'=>$method,'class_id'=>$Class_ID,'recording_url'=>$recording_url,'presenter_email'=>$presenter_email,'presenter_url'=>$presenter_url);
		
		   	//$dbname = 'createon_e422y9mfa3bus';
			$cxn = mysql_connect('localhost', $db_uname, 'VeerIT123');
			if(mysql_select_db($dbname, $cxn))
			{	

				 $query = "INSERT into mlms_webinars (proid, type, title, privacy, fromdate, fromtime, allday, repeate, untilldate, web_duration, start_recording, status, created_by, creator_email) values('".$data['proid']."','".$data['type']."','".$data['title']."','".$data['privacy']."','".$data['fromdate']."','".$data['fromtime']."','".$data['allday']."','".$data['repeate']."','".$data['untilldate']."','".$data['web_duration']."','".$data['start_recording']."','".$data['status']."','".$data['created_by']."','".$data['creator_email']."') " ;		
			    $result1 = mysql_query($query);			   
				$webinar_id =  mysql_insert_id();

				
				$sql = "UPDATE `mlms_webinars` set wiziq_class_id='".$Class_ID."',wiziq_recording_url='".$recording_url."',wiziq_presenter_email='".$presenter_email."',wiziq_presenter_url='".$presenter_url."' WHERE id = '".$webinar_id."' " ;
				$result = mysql_query($sql) or die('Could not execute query');			
			} 
		  
			
			echo "<script>document.location.href='create/".$data['proid']."/success"."'</script>";
			
		}
		else if($attribNode=="fail")
		{
			
			$error=$objDOM->getElementsByTagName("error")->item(0);
   				 $errorcode = $error->getAttribute("code"); // echo "<br>errorcode=".$errorcode = $error->getAttribute("code");
   				 $errormsg = $error->getAttribute("msg");	// echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");
				
				echo "<script>document.location.href='create/".$data['proid']."?msg=".$errorcode."'</script>";
		    // return $webinar_param = array('webinar_msg'=>$attribNode,'errorcode'=>$errorcode,'errormsg'=>$errormsg);
		}
	 }//end if	
   }//end function
	
}
?>