<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#screenshot').on('click', function(e){
                e.preventDefault();
                html2canvas($('body'), {
                    onrendered: function(canvas){
                        var imgString = canvas.toDataURL();

                        $.ajax({
                                      type: "POST",
                                      url: "<?php echo base_url(); ?>index.php/lessons/demo_upload",
                                      data: {postData:imgString}, 
                                      success: function(data)
                                      {
                                          alert(data);
                                      }
                                    });
                       
                    }
                });
            });
        });
    </script>
</head>
<body>

<div style="width: 800px; margin: auto;">
    <input type="button" id="screenshot" value="Screenshot!"/>
    <div style="height: 100px;border: 1px solid #D8D8D8;">
        Big header!
    </div>
    <div style="height: 500px;border: 1px solid #D8D8D8;">
        Medium Content
    </div>
</div>

</body>
</html>