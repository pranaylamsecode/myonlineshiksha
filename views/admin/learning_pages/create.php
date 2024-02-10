<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
.col-sm-9 {
  width: 63%;
}

#msg {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 99999;
}
.delete_thumbs {
    position: absolute;
    right: -41px;
    top: 0px;
}
</style>
<script type="text/javascript">
	// jQuery(document).ready(
	// 	function()
	// 	{
	// 		// jQuery('#description').redactor({
	// 		//         focus: true,
	// 		//         imageUpload: window.location.origin+'/admin/pagecreator/getImage',
	                
	// 		// });
	// 		jQuery('#message').redactor({
	// 		        focus: true,
	// 		        imageUpload: window.location.origin+'/admin/pagecreator/getImage',
	                
	// 		});
			
	// 	}
	// );
</script>

<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
  //$this->session->flashdata('message');
?>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => 'proform');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/learningpage/createpage', $attributes) : form_open_multipart(base_url().'admin/learningpage/editPage/'.$id, $attributes);
?>

<input type="hidden" id="pg_id" name="id" value="<?php echo @$id ? @$id : '' ?>">

<div id="toolbar-box">
	<div class="m top_main_content">
		<div class="pagetitle icon-48-generic">
			<h2><?php echo ($updType == 'create') ? 'Create Learning Content page' : 'Edit "'.$page[0]['heading'].'" Page'?>
			</h2>
        </div>
		<div id="toolbar" class="toolbar-list">	
			<div class="clr"></div>
		</div>
		
	</div>
</div>


<div class="field_container">
 <div class="row tab-content">

					
				<form role="form" class="form-horizontal form-groups-bordered">	
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Title"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('heading',($this->input->post('heading')) ? $this->input->post('heading'):(isset($page[0]['heading']) ? $page[0]['heading']:''),'id="pg_title" class="form-control form-height"'); ?>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="heading-target" class="tooltipicon"></span>

						<span class="heading-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('page_fld_title');?>

                       

						</span>

						</span>-->
					<!-- tooltip area finish -->
					
			
                    <span class="error"><?php echo form_error('heading'); ?></span>
						</div>
					</div>
			<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Slug"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
					<input id="slug" type="text" class="form-control form-height" name="slug" maxlength="256" value="<?php echo set_value('slug', (isset($page[0]['slug'])) ? $page[0]['slug'] : ''); ?>"  title="Enter Slug"  onkeyup="return checkslug(<?php echo $page[0]['page_id'];?>,this.value)" onkeypress="return valid_escape()"/>
					<span id="avail" style="padding-left: 50px"></span>
				</div>
			</div>

			<div class="form-group form-border col-sm-4 ">
           
               <label class=' control-label field-title' >Add Image</label>
            
               <div class="imgBlog" style="width: 150px;position: relative;">
               	<img  id="blog_img" src="<?php echo base_url(); ?>public/LearnContent/images/<?php echo $page[0]['image'];?>" alt="" style="display: <?php echo $page[0]['image'] ? 'block' : 'none'; ?> height: 120px; width:150px;border: 1px solid;margin: 20px; ">
               	<button class="delete_thumbs" id="delete_thumbs" type="button" style="display: <?php echo $page[0]['image'] ? 'block' : 'none'; ?>"><i class="fa fa-times"></i></button>
               </div>
               
 				<input class="form-control" type="file" accept="image/*" name="image" value="<?php echo $page[0]['image'];?>" id="thumbnail">
 				<input type="hidden" name="blog_img" class="blog_img" value="<?php echo $page[0]['image'];?>">
            </div>


                    
					<div class="form-group form-border" style="padding-top:0!important;">
						
						<label class='col-sm-12 field-title control-label' for="name"><?php echo "Description"; ?><span class="required">*</span></label>

					<div class="col-sm-12">
					
                    <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''));?>
                    <textarea name="description"  id="description" class="form-control" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''); ?></textarea>
                    <input name="image" type="file" id="upload" class="hidden" onchange="">
                    <!-- tooltip area -->
						<!-- <span class="tooltipcontainer">

						<span type="text" id="desc-target" class="tooltipicon"></span>

						<span class="desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('page_fld_description');?>

						</span>

						</span> -->

					<!-- tooltip area finish -->
					
                     <span class="error"><?php echo form_error('description'); ?></span>
						</div>
					</div>
					<div class="form-group form-border select-form">
	        	
		          <label class='col-sm-12 control-label field-title' for='category_id'><?php echo lang('web_category'); echo $page[0]->catid?>  <span class="required">*</span>

		          </label>
		          <div class="col-sm-12" style="padding-right:0;">
		            <select class='form-control form-height' name='category_id' id='category_id' title="Select Course Category,category under which course comes"data-validation="required" data-validation-error-msg="Enter valid Question">
		              <option value=''>Select</option>
		              <?php				
									foreach ($categories as $category){ ?>
		              <optgroup label="<?php  echo $category->name?>">
		            
		             <!--  <option value='<?php echo $category->id?>' <?php if(isset($page[0]['catid'])) echo ($category->id == $page[0]['catid']) ? 'selected=selected' : '' ?>><?php  echo $category->name?></option> -->

		              <?php $subCate = $this->pcategories_model->getLearningChildCate($category->id);
		              		foreach ($subCate as $subcate){ ?>
		       		
		            
				              <option value='<?php echo $subcate->id?>' <?php if(isset($page[0]['catid'])) echo ($subcate->id == $page[0]['catid']) ? 'selected=selected' : '' ?>><?php  echo $subcate->name?></option>
				          <?php } ?>
				      </optgroup>
		              <?php } ?>
		            </select>
		             
		            
		            
		          </div>
		          <a href="<?php echo base_url(); ?>admin/learningpage/createcategory" id="cropcategory" class="newsect_pop btn btn-success btn-border-blue btn-style" style="margin-left: 20px;float: left;">Create New Category</a>
	        </div>


	        <div class="form-group form-border col-sm-4 ">
               <label class='control-label field-title' style="padding-top: 2px;" for='active'>Add PDF File</label>
               <div>
               <button class="delete_thumbs" id="delete_pdf" type="button" style="display: <?php echo $page[0]['doc_file'] ? 'block' : 'none'; ?>"><i class="fa fa-times"></i></button> 
       
                <?php echo $page[0]['doc_file'] ? '<p class="blog_pdf">'.$page[0]['doc_file'].'</p>' : ''; ?>
            	</div>
 				<input class="form-control form-height field-title"  type="file" accept="application/pdf"  name="doc_file" id="blog_pdf">
 				           		
 				<input type="hidden" id="docfile" name="docfile" value="<?php echo $page[0]['doc_file'];?>">
            </div>
                    

                    
                    
					<div class="form-group form-border" style="padding-top:0!important;">						
						<label class='col-sm-12 control-label field-title' for="name">Show this page in the “More” menu in the frontend<span class="required">*</span></label>
						<div class="col-sm-12">	                      
						<select name="show_in_menu" id="show_in_menu" class="form-control form-height" >
							<option value="show" <?php echo ($this->input->post('show_in_menu') == 'show' ?  'selected="selected"' :( @$page[0]['show_in_menu'] == 'show' )? 'selected="selected"' : '');?> >Show</option>
							<option value="hide" <?php echo ($this->input->post('show_in_menu') == 'hide' ?  'selected="selected"' :( @$page[0]['show_in_menu'] == 'hide' )? 'selected="selected"' : '');?> >Hide</option>
						</select>
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="menu-target" class="tooltipicon"></span>

						<span class="menu-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('page_fld_showmenu');?>

                        
						</span>

						</span> -->

						<!-- tooltip area finish -->
						</div>
					</div>
                    
                <!--new code start -->
<!--remove comment form here -->
               <div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "SEO title"; ?>
                        <p>Enter the course title as it will be shown in internet browsers.</p>
                        </label>
						
						<div class="col-sm-12">
							
                            
                     <?php //echo form_input('metaTitle',($this->input->post('metaTitle')) ? $this->input->post('metaTitle'):(isset($page[0]['meta_title']) ? $page[0]['meta_title']:''),'class="form-control form-height"', 'placeholder="Maximum 60 characters."'); ?>
                     <input type="text" name="metaTitle" class="form-control form-height" placeholder="Maximum 60 characters." value="<?php echo ($this->input->post('metaTitle')) ? $this->input->post('metaTitle'):(isset($page[0]['meta_title']) ? $page[0]['meta_title']:''); ?>" >

						<!-- <span class="tooltipcontainer">

						<span type="text" id="metatitle-target" class="tooltipicon"></span>

						<span class="metatitle-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('page_fld_metatitle');?>

                       

						</span>

						</span> -->


					
			
                    <span class="error"><?php echo form_error('metaTitle'); ?></span>
						</div>
						
					</div>
					
				<div class="form-group form-border" style="padding-top:0!important;">
						<label for="field-ta" class="col-sm-12 field-title control-label">SEO description
							<p>Enter the course description that will appear underneath the SEO title.</p>
						</label>
						
						<div class="col-sm-12">
                            <textarea placeholder="Maximum 320 characters." name="meta_descript" id="meta_descript" class="form-control select-box-border" rows="4"><?php echo ($this->input->post('meta_descript')) ? $this->input->post('meta_descript') : ((isset($page[0]['meta_desc'])) ? $page[0]['meta_desc'] : ''); ?></textarea>
                            

						<!-- <span class="tooltipcontainer">

						<span type="text" id="mdesc-target" class="tooltipicon"></span>

						<span class="mdesc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('page_fld_desc');?>

                        

						</span>

						</span> -->


						</div>

						
                     
					</div>
					
					<div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "SEO keyword"; ?><span class="required"></span>
                        	<p>To improve your site’s visibility in searches, enter keywords separated by commas.</p>
                        </label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('metaKword',($this->input->post('metaKword')) ? $this->input->post('metaKword'):(isset($page[0]['meta_keyword']) ? $page[0]['meta_keyword']:''),'class="form-control form-height"'); ?>

						<!-- <span class="tooltipcontainer">

						<span type="text" id="keyword-target" class="tooltipicon"></span>

						<span class="keyword-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>


						<?php echo lang('page_fld_keyword');?>


						</span>

						</span> -->


					
                    <span class="error"><?php echo form_error('metaKeyword'); ?></span>
						</div>

						
            
					</div>
					
                <!--new code end -->

					<div class="form-group">
						<div class="col-sm-5">    
                        <?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn '" : "id='submit' class='btn '")); ?>
						<a href='<?php echo base_url(); ?>admin/pagecreator<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
						
					</div>
					 <span id="msg" ></span>
				</form>				
	</div>
	</div>
</div>

<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$id) ?>
<?php endif ?>
<?php echo form_close(); ?>


<!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

//	jQuery(this).parent().css('display','none');

//	});

//	});

jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});

	</script>



<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){

                       $j(".newsect_pop").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"640px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,

                        })
                   });
               </script>

<script>

	jQuery(function () {
	var updType = "<?php echo $updType ?>";
	
	

        $('form').on('submit', function (e) {
           e.preventDefault();
          // var todo = $('#todolist').val().trim();
          //   var ele = todo.split('*');
          //   var todo_arr='';
          //   if(ele.length >1){
          //     $.each(ele, function(k, v){
          //       if(v.trim() !=''){
          //         todo_arr = todo_arr +'* '+v;
          //       // todo_arr.push('* '+v);
          //           }
          //       });
               
          //   }
          //   $('#todolist2').val(todo_arr);

    //     	if(updType =='edit'){
				// var url = '<?php echo base_url() ?>admin/learningpage/editPage/<?php echo $id;?>';
		  // } else{
		  //   	var url = '<?php echo base_url() ?>admin/learningpage/createPage';
		  //   }
          var slug = $("#slug").val().trim();
          if(slug)
          	var chk = checkslug('<?php echo $id;?>',slug);
          else var chk = true;
          if(chk != false){
          	// console.log('checkslug');
         var new_formdata = new FormData($('#proform')[0]);
         // new_formdata = ;

         var image = $("#thumbnail")[0].files[0];
         var pdf = $("#blog_pdf")[0].files[0];

         new_formdata.append('blog_pdf',pdf);
         new_formdata.append('image',image);
         var id = $('#pg_id').val();

          $.ajax({
            type: 'post',
            url: "<?php echo base_url() ?>admin/learningpage/ajaxCreate/"+id,
			contentType:false,
      		processData:false,
            data: new_formdata,
            before: function(){
               
            },
            success: function (response) {
            	console.log(response);
            	response = JSON.parse(response);
	            if(response[0]=="success")
	            {
	            	if(response[1]){
	            	$('form').attr('action', "<?php echo base_url() ?>admin/learningpage/editPage/"+response[1]);
	            	$('#pg_id').val(response[1]);
	            	}
                var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated the course.</div>';
			             var note = $(document).find('#msg');
			            note.html(str);
			            note.show();
			            note.fadeIn().delay(3000).fadeOut();
            	}
              else
              {
                var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-close" aria-hidden="true"></strong> Somethings went wrong..! </div>';
                  var note = $(document).find('#msg');
                  note.html(str);
                  note.show();
                  note.fadeIn().delay(3000).fadeOut();
                  // $("#slug").focus();
              }
            }

          });
    } else{
    	var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-close" aria-hidden="true"></strong> Slug already exists!</div>';
                  var note = $(document).find('#msg');
                  note.html(str);
                  note.show();
                  note.fadeIn().delay(3000).fadeOut();
                  $("#slug").focus();
    }
    

      });
    });


function checkslug(id,slug)
{
	if(!slug)
		slug = $('#slug').val();
	if(slug){
	  $.ajax({
	        type:"post",
	        cache:false,
	        url:"<?php echo base_url();?>admin/learningpage/check_slug",
	        data:{
	          id:id,
	          slug:slug
	        },
	        success:function(returndata)
	        {
	        	        	// console.log("returndata "+ returndata)

	          if(returndata==0)
	          {
	            $("#avail").html("already exists").css('color','red').fadeIn().delay(3000).fadeOut();;
	            return false;
	          }
	          else
	          {
	            $("#avail").html("available").css('color','green').fadeIn().delay(3000).fadeOut();
	            return true;
	          }
	        }
	  });
	} return true;
}

function valid_escape()
{
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 || x==45 || x==46 || x==95 || (x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ))
    {   
        return;
    }else{
      event.preventDefault();
    }
}

               </script>

 <script type="text/javascript">
 	 var $ = jQuery.noConflict();
              $(document).ready(function(){

              	 $("#delete_pdf").click(function(){
                  $('#docfile').val('');
                  $('#blog_pdf').val('');
                    $('.blog_pdf').css('display','none');
                    $('#delete_pdf').css('display','none');
                });


                $("#delete_thumbs").click(function(){
                  $('#blog_img').attr('src', '');
                  $('.blog_img').val('');
                    $('#blog_img').css('display','none');
                    $('#delete_thumbs').css('display','none');
                });

              $("#thumbnail").change(function() {
              	// console.log(this.files[0]);
                if (this.files && this.files[0]) {
                  var reader = new FileReader();
                  
                  reader.onload = function(e) {
                  	              	// console.log(e.target.result);

                    $('#blog_img').attr('src', e.target.result);
                    $('.blog_img').val(e.target.result);
                    $('#blog_img').css('display','block');
                    $('#delete_thumbs').css('display','block');
                  }
                  reader.readAsDataURL(this.files[0]); // convert to base64 string
                }
              });
              });

    $('#pg_title').change( function() {
       var title = $("#pg_title").val().toLowerCase().replace(/ /gi,"-");
       if(title)
       {
       		$('#slug').val(title);
       }
    });
  </script>


<!-- tool tip script finish -->
<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  		selector: '#description',
 		 height: 180,
 		// min_width: 400,
 		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
		image_title: true,
		automatic_uploads: true,
		images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
		file_picker_types: 'image',
		 image_advtab: true, 
		file_picker_callback: function(callback, value, meta) {
		      if (meta.filetype == 'image') {
		        $('#upload').trigger('click');
		        $('#upload').on('change', function() {
		          var file = this.files[0];
		          var reader = new FileReader();
		          reader.onload = function(e) {
		            callback(e.target.result, {
		              alt: ''
		            });
		          };
		          reader.readAsDataURL(file);
		        });
		      }
		    },

 		});
    });
  </script>