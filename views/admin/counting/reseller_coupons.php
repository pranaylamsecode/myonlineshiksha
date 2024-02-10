<style>
   .pt-15{
      padding-bottom: 15px!important;
   }
</style>

<div class="col-xs-12 col-sm-12">
   <div class="form-body">
      <div class="col-sm-12 col-xs-12">
         <h2 class="control-label text-center">Create Coupon-code for Reseller</h2>
         <div class="form-border">            
            <label class="control-label field-title">Reseller Name : </label>
            <select class="form-control field-title" id="user_id">
               <option value="">Select</option>
               <?php foreach ($users as $key) { ?>
               <option value="<?php echo $key->id;?>"><?php echo $key->first_name." ".$key->last_name; ?></option>
               <?php } ?>
            </select>
            <label class="control-label field-title">Quantity :</label>
            <input type="text" id="quantity" class="form-control field-title" maxlength="2" placeholder="Default 20 (if blank)">
            <b style="position:relative;top:-20px;">(if its blank, it will automatically generate 20 coupon codes.)</b>
            
            <button class="btn btn-success btn-md control-label" type="button" style="font-size: 18px;height: auto;margin-top: 15px;" onclick="return create_coupons()"> Generate Coupon Code </button>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">
function create_coupons()
{
   var user_id = $("#user_id").val();
   var quantity = $("#quantity").val();  
   $.ajax({
      type: 'post',
      cache: false,
      url: '<?php echo base_url(); ?>reseller/create_coupons',
      data: {
            user_id : user_id,
            quantity : quantity
      },
      success: function (returndata) {
         if (returndata) {
            $('<form action=\"<?php echo base_url();?>reseller/printdata/'+returndata+'\" method="POST" target="_blank" style="display:none">' +
            '<input type="hidden" name="data1" value="'+returndata+'" />'
            ).appendTo("body").submit().remove();
            window.location.href = '<?php echo base_url(); ?>admin/manage-coupon-code';
         }
      }
   });
}
</script>