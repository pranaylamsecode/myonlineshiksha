<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<style type="text/css">
.contentpane iframe{
   width:100% !important;
   height: 270px !important;
   }
</style>
<div class='clear'></div>

<table class="adminlist" align="center" style="border:#ccc solid 2px; width:100%">
	<tr>
  <td>
  <?php       
  if($type == "Document")
  {  

                
  	$media->code='<div class="contentpane">
    <iframe src="http://docs.google.com/viewer?url='.base_url().'/public/uploads/documents/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
   
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  }
 else if($type == "Image")
 {         
                   
$media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/images/'.$media->media_title.'" width="400px" id="imgid"/>';
echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

 } 
 else if($type == "Video")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/videos/'.$media->media_title.'" width="100%" height="200px" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  }
  else if($type == "Audio")
  {                       
                
    $media->code='<div class="contentpane">                     
   <iframe src="'.base_url().'public/uploads/audio/'.$media->media_title.'" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
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
  else if($type == "docs")
  {        
                
    $media->code='<div class="contentpane">
    <iframe src="http://docs.google.com/viewer?url='.base_url().'/public/uploads/documents/'.$media->media_title.'&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe>                                          
   
   </div>';
    echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p />');
                
  } 
  else if($type == "file")
  {  
      // $file = new SplFileInfo($path);
      // $ext  = $file->getExtension();

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
         $media->code = '<div  style="text-align:center"><img src="'.base_url().'/public/uploads/files/'.$media->media_title.'"/>';
         echo stripslashes($media->code.'<p /><div style="text-align:center"><i>'.$media->alt_title.'</i><p /></div>');

     }          
  }             

?>
                
  </td>
	</tr>
</table>

            <script>
              
                $(document).ready(function() {
                  $("object,iframe").css("height","450px");
                });
             </script>