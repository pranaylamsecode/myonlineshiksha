<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>



<script type="text/javascript">
function addmedia (idu, img_type, name, published, ext, title) { 
console.log(name);
console.log(ext);   
        if ($('#tr'+idu,parent.document).length > 0) {
        parent.jQuery.fancybox.close();
        return true;
        }else{
        var myrow = parent.document.createElement('tr');
    myrow.id = 'tr'+idu;
    parent.document.getElementById('mediafiles').value = parent.document.getElementById('mediafiles').value+idu+',';
    parent.document.getElementById('rowsmedia').appendChild(myrow);

        var mycell = parent.document.createElement('td');
    mycell.style.textAlign = 'left';
    myrow.appendChild(mycell);
        var mycelltwo = parent.document.createElement('td');
    mycelltwo.style.textAlign = 'left';
    myrow.appendChild(mycelltwo);
    var mycellthree = parent.document.createElement('td');
    mycellthree.style.textAlign = 'left';
    myrow.appendChild(mycellthree);
    var mycellfour = parent.document.createElement('td');
        mycellfour.style.textAlign = 'left';
        mycellfour.setAttribute("id","tdpublish"+idu);
        mycellfour.setAttribute("name","tdpublish");
    myrow.appendChild(mycellfour);

  //       var mycellnine = parent.document.createElement('td');
  //       mycellnine.style.textAlign = 'left';
  //       mycellnine.setAttribute("id","tdunpublish"+idu);
  //       mycellnine.setAttribute("name","tdunpublish");
    // myrow.appendChild(mycellnine)

       // var mycellfive = parent.document.createElement('td');
  //  mycellfive.style.textAlign = 'left';
  //  myrow.appendChild(mycellfive);
  //  var mycellsix = parent.document.createElement('td');
  //  mycellsix.style.textAlign = 'left';
  //  myrow.appendChild(mycellsix);
  //       var mycellseven = parent.document.createElement('td');
    // mycellseven.style.textAlign = 'left';
    // myrow.appendChild(mycellseven);
        var mycelleight = parent.document.createElement('td');
    mycelleight.style.textAlign = 'left';
    mycelleight.style.display = 'none';
        // mycellnine.style.display = 'none';
    myrow.appendChild(mycelleight);
    yes_no = "publish";
           publish = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+idu+'" class = "publish" onclick="publishbutton(\'publish-'+idu+'\');">';
    // if(published==1){
    //    yes_no = "publish";
  //          publish = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+idu+'" class = "publish" onclick="publishbutton(\'publish-'+idu+'\');">';
    // }else{
    //    yes_no = "unpublish";
  //          publish = '<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" id="unpublish-'+idu+'" class="unpublish" onclick="publishbutton(\'unpublish-'+idu+'\');">';
  //        }
        var id_string = idu
        var name_string = name
        var publish_string = publish
      //  var order = 'order'
      //  var guest_access = '<select name="access[]"><option value="0">Students</option><option value="1">Members</option><option value="2">Guests</option></select>'

        var remove = '<a href="javascript:void(0);" onclick="deleteRow(this.parentNode.parentNode.rowIndex)" class="removeele" id="remove'+idu+'"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>';

        img_path = "<?php echo base_url(); ?>public/images/admin/doc.gif";
        img_type = '<img src="'+img_path+'" alt="doc type"/>';
        media_id = '<input type="hidden" value="'+idu+'" name="media_id[]"/>';
        //mycell.innerHTML = id_string;
        if(ext == 'gif'||ext == 'GIF'){
        mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/gif-icon.png" alt="doc type"/>';
        }
        else if(ext == 'rar'||ext == 'RAR'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/rar-icon.png" alt="doc type"/>';
        }
        else if(ext == 'zip'||ext == 'ZIP'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/zip-icon.png" alt="doc type"/>';
        }
        else if(ext == 'doc'||ext == 'DOC'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/doc-icon.png" alt="doc type"/>';
        }
        else if(ext == 'docx'||ext == 'DOCX'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/docx-icon.png" alt="doc type"/>';
        }
        else if(ext == 'jpg'||ext == 'JPG'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/jpg-icon.png" alt="doc type"/>';
        }
        else if(ext == 'png'||ext == 'PNG'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/png-icon.png" alt="doc type"/>';
        }
        else if(ext == 'bmp'||ext == 'BMP'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/bmp-icon.png" alt="doc type"/>';
        }
        else if(ext == 'ppt'||ext == 'PPT'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/ppt-icon.png" alt="doc type"/>';
        }
        else if(ext == 'pptx'||ext == 'PPTX'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/pptx-icon.png" alt="doc type"/>';
        }
        else if(ext == 'pdf'||ext == 'PDF'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/pdf-icon.png" alt="doc type"/>';
        }
        else if(ext == 'txt'||ext == 'TXT'){
         mycell.innerHTML= '<img src="<?php echo base_url(); ?>/public/css/image/txt-icon.png" alt="doc type"/>';
        }
        
    //mycellthree.innerHTML=name_string;
    mycelltwo.innerHTML=name_string;
    mycellthree.innerHTML='<a href="<?php echo base_url(); ?>public/uploads/files/'+title+'" class="" download><i class="entypo entypo-download" title="Download"></i></a>';
      mycellfour.innerHTML=remove;
     //   mycellfive.innerHTML=order;
//    mycellsix.innerHTML=guest_access;
       // mycellseven.innerHTML=remove;
        mycelleight.innerHTML=media_id;
       // parent.jQuery.fancybox.close();
       $("#cboxClose",parent.document).click();
        return true;
  }
   }
</script>
<base href="<?php echo $this->config->item('base_url') ?>/public/" />


<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/classic/css/bootstrap.css" media="screen" />
<style>
input[type="radio"], input[type="checkbox"] {
  margin: 0px 10px 0 0 !important;
  margin-top: 1px \9;
  line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
  margin: 0 10px !important;
}
table.scroll {
    /* width: 100%; */ /* Optional */
    /* border-collapse: collapse; */
    border-spacing: 0;
    /*border: 2px solid black;*/
  width: 100%;
}

table.scroll tbody,
table.scroll thead { display: block; }

table.scroll tbody {
      height: 330px;
  overflow-y: auto;
  overflow-x: hidden;
  border: 1px solid #ebebeb;    
}
legend{
  border-bottom:none!important;
}

tbody td:last-child, thead th:last-child {
    border-right: none; 
  
}
table {
  border-collapse: inherit;
  border:none !important;
}
/*css*/
a.btn.btn-success {
  background-color: #04A600!important;
  background-image: none!important;
  border: none!important;
}
input.btn.btn-success {
  background-color: #04A600;
  background-image: none!important;
  border: none!important;
}
input.btn.btn-danger {
  background-color: #cc2424;
  background-image: none!important;
  border: none!important;
}
.panel {
  border: none!important;
}
a {
  color: #000!important;
  text-decoration: none;
}
a:hover{
  color:#000!important;
}
/*end of css*/
</style>
<script type="application/javascript">
// Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler
</script>
<div class='clear'></div>


<div class="page-container">
  <div class="panel panel-primary">
    <div style="background-color:#f1f1f1; height:73px;">
      <legend style="color:#c42140; text-transform:uppercase; font-size:21px;text-align:center; font-weight:bold; padding: 10px 30px 0 30px;">Exercise file List</legend>
    </div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'medias/addmedia/',$attributes);
?>
    <div class="panel-heading"> 
      <div class="panel-title">
      <input placeholder="Media Title" type="text" value="" name="search_text">
        <input type="submit" value="Search" name="submit_search" class="btn btn-success">
                <input type="submit" value="Reset" name="reset" class="btn btn-danger">
         <select onchange="document.topform1.submit()" name="type" id="type">
          <option value="">- select -</option>
          <option value="docs">Documents</option>
          <option value="file">Files</option>
          </select>
      </div> 
      <div class="panel-options"> 
      </div> 
    </div>
    <div style="clear:both;"></div>
    <?php echo form_close(); ?>


 <div class="panel-body with-table">

<table style="font-size:15px" class="table table-bordered responsive scroll">
<thead>
   <tr>
    <!--<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>-->
    <th style="width: 5.8%;color:#000;"> Action </th>
      <th style="width: 6.6%;color:#000;">Sr.No. </th>
    <th style="width: 21%;color:#000;">Media Title</th>
    <th style="width: 10.9%;color:#000;">Type </th>
    <!-- <th style="width: 10%;color:#000;">Publish</th> -->
     </tr>
</thead>
<?php 

if ($medias): ?>
<tbody>
    <?php $i=0;?>
    <?php foreach ($medias as $media):
    $filenamebytype = $media->media_title;

    $ext = pathinfo($filenamebytype, PATHINFO_EXTENSION);
    $i++;
     //print_r($media);
    //$media_rel = $this->medias_model->getMediaExerciseFile($media->id);

    ?>

  <tr class="camp<?php echo $i;?>">
    <!--<td><?php //print_r($media);?><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="" value="2" name="cid[]" id="cb<?php echo $media->id?>"></td>-->
    <td style="width:10.8%"><a href="javascript:addmedia(<?php echo $media->id?>,'<?php echo $media->type?>','<?php echo $media->alt_title?>','<?php echo $media->publish?>','<?php echo $ext ?>','<?php echo $media->media_title?>','<?php echo $medfldgroup?>')">
      <img title="Select Media" style="width: 23px!important;display: block;margin: 0px auto;" alt="Published" src="http://create-online-academy.com/public/images/admin/Vote-512.png"></a></td>
    <td style="width:8.8%">
        <?php echo $i;?></td>
      <td style="width:28.3%">
            <?php //if(!$media_rel){   ?>
      <a href="javascript:addmedia(<?php echo $media->id?>,'<?php echo $media->type?>','<?php echo $media->alt_title?>','<?php echo $media->publish?>','<?php echo $ext ?>','<?php echo $media->media_title?>','<?php echo $medfldgroup?>')" class="a_lms">
      <?php echo $media->alt_title?></a>            
    </td>
    <td style="width:13%">
      <?php echo $ext;?>
    </td>

    <!-- <td style="width:11%" align="center">
            <?php if($media->publish){?>
            <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png">
            <?php }else{?>
            <img alt="Unpublished1" src="<?php echo base_url(); ?>public/images/admin/publish_x.png">
            <?php }?>
      </td> -->

   </tr>
     <?php endforeach ?>
   <?php else: ?>

<tr>
    <td colspan="8">
  <?php echo lang('web_no_elements');?>
  </td>
</tr>

<?php endif ?>
<?php if($this->pagination->create_links()) { ?>
   <tr>
     <td colspan="8"><div class="containerpg">
            <div class="pagination">
              <?php echo $this->pagination->create_links();  ?>
            </div>
            </div>
        </td>
      </tr>
<?php }  ?>
</tbody>
</table>
</div>
</div>
</div>