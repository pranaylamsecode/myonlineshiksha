		
<?php // print_r($category); ?>

<style >
	.top-heading-page{
		background: #061F57;
		width: 100%;
		text-align: center;
		padding: 5px;
		color: #ffffff;
	}
	.link-button{
		width: 80px;
		padding: 10px;
		text-align: center;
		border: 1px solid #061F57;
		border-radius: 10px;
	}
    .border-class {
        padding: 30px 10px 5px 10px;
        border-radius: 5px;
        background-color: #ffffff;
        border: solid 1px #0b0b0b4d;
        margin: 10px;
    }
    .border-class .sidebar-heading {
        font-size: 18px;
        font-weight: 600;
        margin: -31px -11px 30px -11px;
        color: #ffffff;
        background: #061f57;
        border-radius: 5px 5px 0 0;
        padding: 10px 0 10px 30px;
    }
    .flex-container ul{
        list-style-type: circle!important;
    }
</style>
<div class="hero--homepages col-sm-12">
    <div class="top-section">
        <div class="container">
            <h1 class="font-white top-heading-page"><?php echo $page->heading ?></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row page-data">
        <div class="col-sm-12 col-md-8 font-family-change page-content-block">
            <div class="entry-content" style="box-sizing:border-box;margin:0px;padding:0px;"><h2 style="font-size:28px;box-sizing:border-box;margin:20px 0px 10px;padding:0px;font-weight:400;color:#333333;line-height:1.6em;"><span style="color:#000000;"><strong><?php echo $page->heading ?> - PDF Download</strong></span></h2>
                <?php if($page->image){ ?>
            	   <p><span style="color:#000000;"><img width="100%" src="<?php echo base_url() ?>public/LearnContent/images/<?php echo $page->image ?>" alt="<?php echo $page->heading ?>" /></span></p>
                <?php } ?>
            	<div class="more">
            	</div>
            </div>
            <div class="font-family-change page-content-block">
            <?php echo $page->content ?>
            </div>
            <?php if($page->doc_file){ ?>
            <div>
                <h3 style="box-sizing:border-box;margin:20px 0px 10px;padding:0px;font-weight:400;color:#333333;font-size:24px;line-height:1.6em;"><span style="box-sizing:inherit;font-size:16px;background-color:#ffffff;color:#000000;font-family:'Open Sans', sans-serif;text-align:center;">Download this solution for&nbsp;</span><span style="box-sizing:border-box;font-size:16px;background-color:#ffffff;color:#000000;font-family:'Open Sans', sans-serif;text-align:center;font-weight:700;">FREE</span><span style="box-sizing:border-box;font-size:16px;background-color:#ffffff;color:#333333;font-family:'Open Sans', sans-serif;text-align:center;font-weight:700;">&nbsp;

                <a 
                <?php //$auth = $this->session->username('logged_in');
                    if($auth)
                        echo ' class="btn btn-round pdf-btn" ';
                    else echo ' class="btn btn-round " id="go" data="pdf-btn" rel="leanModal" href="#signup"';


                 ?>

                  >Download PDF</a></span></h3>
            </div>
            <div>
                 <iframe class ="test-1" width="100%" height="600"  src="<?php echo base_url() ?>public/js/pdfjs-2.5.207-es5-dist/web/viewer.html?file=<?php echo base_url() ?>public/LearnContent/pdf_file/<?php echo $page->doc_file ?>"></iframe>
            </div>
            <?php } ?>
        </div>

        <div class="col-sm-12 col-md-4 flex-container form-col-padding-for-phone">
            <div class="border-class related-links">
                <p class="sidebar-heading">Related Links</p>
                            <div style="font-size:11.0pt;">
                                <ul>
                                <?php foreach ($related_pg as $rel_pg) {
                                   echo "<li><a href='".base_url()."learning/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$rel_pg->slug."'>". $rel_pg->heading."</a></li>";
                                } ?>
                                                             
                            </ul></div>
                        </div>
                                       


            </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 


<script>
    $(document).ready( function(){
        var yetVisited = localStorage['loadpdf'];
        if(yetVisited == "yes"){
           loadpdf();
        }
        localStorage['loadpdf']='';
        
                                // var page_content_block = $('.pdf-download-btn');
$(document).on('click', '.pdf-btn', function () {
    loadpdf();
});
                    

     function loadpdf() {
        
            // var download = sessionStorage.getItem("logged_in");
            $.ajax({
                type: 'post',
                url: "https://mos.veerit.com/learn-pdf",
                dataType: "json",
                data: {
                    // slug: "ncert-solutions/ncert-solution-class-9-maths-chapter-1-number-system",
                    catid: "<?php echo $page->catid ?>",
                    page_id: "<?php echo $page->page_id ?>",
                },
                success: function (response) {
                   console.log(response);
                    if (response.success) {
                        if (response.download) {
                           /* if ("1") {
                                window.open(response.pdf, '_self');
                            } else {
                                JSBridge.call('openInBrowser', {
                                    url: response.pdf
                                });
                            }*/
                var w = window.open("", "popupWindow", "width=800, height=600, scrollbars=yes");
                var $w = $(w.document.body);
                $w.html('<iframe class ="test-1" width="100%" height="600"  src="'+response.pdf+'"></iframe>');

                        } else {
                            // $("#lead-modal").modal('show');
                        }
                    } else {
                        console.log("response error" + response.error);

                        // toastr["error"](response.error);
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                     // toastr["error"](data.responseText);
                    alert("Something went wrong.Please try again later.");
                },
                complete: function (data) {
                }
            });
        }
});

</script>