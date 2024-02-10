<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<style type="text/css">
iframe{
   width:100% !important;
   }
</style>
<div class='clear'></div>

<table class="adminlist" align="center" style="border:#ccc solid 2px; width:100%">
  <tr>
  <td>
  <?php
  // echo"<pre>";
  //  echo $media->type;
  //  print_r($media);
  //  print_r($type);     
  if($type == "Document")
  {  

                
    $media->code='<div class="contentpane">
    <iframe src="http://docs.google.com/viewer?url=http://rocks.createonlineacademy.com/public/uploads/documents/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
   
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  }
 else if($type == "Image")
 {         
                   
$media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/images/'.$media->media_title.'" width="100%"/>';
echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

 } 
 else if($type == "docs")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/documents/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
  else if($media->type == "file")
  {  
   // $ext = pathinfo($media->media_title, PATHINFO_EXTENSION);
   // echo $ext;                 
   // exit('anisha');           
   //  $media->code='<div class="contentpane">                     
   // <iframe src="'.base_url().'public/uploads/file/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   // </div>';
   //  echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
    $filename = $media->media_title;
   $ext = pathinfo($filename, PATHINFO_EXTENSION);
   
  if($ext=="pdf" || $ext=="docx" || $ext=="doc" || $ext=="ppt" || $ext=="pptx" || $ext=="txt")
   {       
   $media->code='<div class="contentpane">
   <iframe src="http://docs.google.com/viewer?url='.base_url().'/public/uploads/files/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
  
  </div>';
   echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
    }
    else if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="bmp") 
    {
       $media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/files/'.$media->media_title.'" width="100%"/>';
     echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

    }
    else if($ext=="mp4" || $ext=="avi") 
    {
     
     $media->code='<div class="contentpane">                     
		   <iframe src="'.base_url().'public/uploads/files/'.$media->media_title.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		    echo stripslashes($media->code.'<p><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');

    }
    else if($ext=="zip" || $ext=="rar") 
    {
       $media->code = '<div  style="text-align:center"><a href="'.base_url().'public/uploads/files/'.$media->media_title.'" download >';
     echo stripslashes($media->code.'<p><div style="text-align:center"><i>'.$media->alt_title.'</i><p /><img src="'.base_url().'/public/css/image/download-icon.png" width="30%"></a></div>');

    }
            
  } 
 else if(strtolower($type) == "video")
  {                      
     if(($media->mtype)== "local")
     { 

		     $media->code='<div class="contentpane">                     
		   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');

     } 
     else if (($media->mtype)== "url") { 
              $vedio_url = str_replace("watch?v=","embed/",$media->url);
			  $vedio_url = str_replace("youtu.be","www.youtube.com/embed/",$vedio_url);         
		     $media->code='<div class="contentpane">                     
		   <iframe src="'.$vedio_url.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		   //echo $vedio_url;
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');

    }  
     else if (($media->mtype)== "code"){
           	echo stripslashes($media->url.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
      }  

      else{

        	$media->code='<div class="contentpane">                     
		   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="560" height="315" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
		   </div>';
		    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
      }                       
  }

  else if($type == "Audio")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
  else if($type == "Flash")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
 
            
  else{
    // echo $media->type;
    // exit('anisha'); 
  }
?>
                
  </td>
  </tr>
</table>

            <script>
              
                $(document).ready(function() {
                  $("object,iframe").css("width","100%");
                  $("object,iframe").css("height","230px");
                });
             </script>