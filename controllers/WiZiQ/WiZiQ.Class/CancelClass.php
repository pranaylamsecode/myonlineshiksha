<?php
class CancelClass
{
	
	function CancelClass($secretAcessKey,$access_key,$webServiceUrl,$id,$class_id)
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "cancel";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $class_id;
		//$requestParameters["class_id"] = "11569";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=cancel',http_build_query($requestParameters, '', '&')); 
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
				$cancelTag=$objDOM->getElementsByTagName("cancel")->item(0);
				echo "<br>cancel=".$cancel = $cancelTag->getAttribute("status");
				// $cxn = mysql_connect('localhost', $db_uname, 'VeerIT123');
				// if(mysql_select_db($dbname, $cxn))
				// {
					
				// 	$sql = "DELETE FROM `mlms_webinars` WHERE id ='".$id."'" ;

				//  $result = mysql_query($sql) or die('Could not execute query');
				// }
				 echo "<script>document.location.href='webinars/listings/'</script>";
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