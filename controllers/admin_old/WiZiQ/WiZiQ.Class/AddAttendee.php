<?php
class AddAttendee
{
	
	function AddAttendee($secretAcessKey,$access_key,$webServiceUrl,$webinarobj,$sessionarray, $dbname, $db_uname)
	{

		echo $db_uname;
		echo $dbname;
		exit('dsfg');
	  /* 
        $webinarobj	  
	  stdClass Object
		(
			[id] => 52
			[proid] => 244
			[type] => webinar
			[title] => java webinar
			[privacy] => private
			[fromdate] => 2015-02-19
			[fromtime] => 02:30PM
			[todate] => 2015-02-19
			[totime] => 03:30AM
			[allday] => 1
			[repeate] => never
			[untilldate] => 2015-02-19
			[start_recording] => 1
			[sharerecoringwithattempt] => 0
			[sharerecoringwithattendees] => 0
			[sharerecoringwithanyonewhoregister] => 0
			[status] => active
			[wiziq_class_id] => 3112244
			[wiziq_recording_url] => http://live.wiziq.com/aliveext/Recorded.aspx?SessionCode=tM1uikx3R%2fA%3d
			[wiziq_presenter_email] => manish.b@veerit.com
			[wiziq_presenter_url] => http://live.wiziq.com/aliveext/LoginToSession.aspx?SessionCode=s5O4qdBBKh1%2f0UinY1YUnQ%3d%3d
			[created_by] => 69
			[creator_email] => dineshkh@gmail.com
			[wiziq_attendee_id] => 101
			[wiziq_attendee_url] => http://live.wiziq.com/aliveext/LoginToSession.aspx?SessionCode=dNQdmUIeDm9i4I8hsJN6Z3KTESw40%2bWw
		) 
		
		Array $sessionarray
				(
					[id] => 57
					[groupid] => 2
					[user_name] => 
					[first_name] => Kunal
					[last_name] => Jain
					[email] => kunnal.jain@veerit.com
					[modper] => Array
						(
							[0] => Array
								(
									[modules] => quizzes
									[permission] => own
								)

							[1] => Array
								(
									[modules] => courses
									[permission] => own
								)

							[2] => Array
								(
									[modules] => users
									[permission] => own
								)

							[3] => Array
								(
									[modules] => media
									[permission] => own
								)

						)

					[validated] => 1
				)
		
		
		
		*/
	   
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$random = rand(10,1000);
		$XMLAttendee="<attendee_list>
			<attendee>
			  <attendee_id><![CDATA[".$random."]]></attendee_id>
			  <screen_name><![CDATA[john]]></screen_name>
                          <language_culture_name><![CDATA[en-us]]></language_culture_name>
			</attendee>
			
		  </attendee_list>";
		$method = "add_attendees";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $webinarobj->wiziq_class_id;//required
		$requestParameters["attendee_list"]=$XMLAttendee;
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_attendees',http_build_query($requestParameters, '', '&')); 
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
				$method=$methodTag->item(0)->nodeValue; // echo "<br>method=".$method=$methodTag->item(0)->nodeValue;
				
				$class_idTag=$objDOM->getElementsByTagName("class_id");
				$class_id=$class_idTag->item(0)->nodeValue; // echo "<br>class_id=".$class_id=$class_idTag->item(0)->nodeValue;
				
				$add_attendeesTag=$objDOM->getElementsByTagName("add_attendees")->item(0);
				$add_attendeesStatus = $add_attendeesTag->getAttribute("status"); // echo "<br>add_attendeesStatus=".$add_attendeesStatus = $add_attendeesTag->getAttribute("status");
				
				$attendeeTag=$objDOM->getElementsByTagName("attendee");
				$length=$attendeeTag->length;
				for($i=0;$i<$length;$i++)
				{
					$attendee_idTag=$objDOM->getElementsByTagName("attendee_id");
				    $attendee_id=$attendee_idTag->item($i)->nodeValue; // echo "<br>attendee_id=".$attendee_id=$attendee_idTag->item($i)->nodeValue;
					
					
					$attendee_urlTag=$objDOM->getElementsByTagName("attendee_url");
					$attendee_url=$attendee_urlTag->item($i)->nodeValue; // echo "<br>attendee_url=".$attendee_url=$attendee_urlTag->item($i)->nodeValue;
				}
				
				$attendeeurl = $sessionarray['id']."^".$attendee_url.","; // 57^http://live.wiziq.com/aliveext/LoginToSession.aspx?SessionCode=dNQdmUIeDm%2bsObnodtqkSGMSvo4r8MEeghfd
				$attendeeurl_field = $webinarobj->wiziq_attendee_url.$attendeeurl;
				
				
			  	$cxn = mysql_connect('localhost', $db_uname, 'VeerIT123');
			   if(mysql_select_db($dbname, $cxn))
				{		
					$sql_Select = "SELECT `id` FROM `mlms_buy_courses` WHERE course_id='".$webinarobj->proid."' and userid='".$sessionarray['id']."' ";
					$result_Select = mysql_query($sql_Select);
					$row_id = mysql_fetch_assoc($result_Select);
					
					if($row_id['id'])
					{					   
					   $sql_Select = "SELECT `wiziq_attendee_url` FROM `mlms_webinars` WHERE wiziq_class_id = '".$webinarobj->wiziq_class_id."' " ;
					   $result_Select = mysql_query($sql_Select) or die('Could not execute query');
					   $row_attendee_url = mysql_fetch_assoc($result_Select);
					   
					   if($row_attendee_url['wiziq_attendee_url'])
					   {
						  $url_field = explode(",",$row_attendee_url['wiziq_attendee_url']);	
						  
						  foreach($url_field as $url_value)
						  {
						    $users_id = explode("^",$url_value);
							$userid_array[] = $users_id;
						  }
						  
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {
								  $perfect_url = $userid_array[$i][1];
							   }						  
							   
						   }	

							if(empty($perfect_url))
							{
							   $sql = "UPDATE `mlms_webinars` set wiziq_attendee_url='".$attendeeurl_field."' WHERE wiziq_class_id = '".$webinarobj->wiziq_class_id."' " ;
					           $result = mysql_query($sql) or die('Could not execute query');
							}
						  
						  
					   } 					   
					}		

					
				} 
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