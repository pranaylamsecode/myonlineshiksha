<?php
$u_data=$this->session->userdata('loggedin');
?>

<script>
    function isChecked(isitchecked) {
        if (isitchecked == true) {
        document.orderform.boxchecked.value++;
        } else {
        document.orderform.boxchecked.value--;
        }
    }
    function listItemTask(id, task) {
        var f = document.orderform;
        var cb = f[id];
        $("#tr"+id).remove();

        if (cb) {
        for (var i = 0; true; i++) {
        var cbx = f['cb'+i];
        if (!cbx)
        break;
        cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        var checkval = $('#'+id+':checked').val();
        document.orderform.checkval.value = checkval;
        submitbutton(task);
        }
        return false;
    }
    function submitbutton(pressbutton) {
        var form = document.orderform;

        submitform ( pressbutton );
    }
    function submitform(pressbutton) {

        if (pressbutton) {
        document.orderform.task.value = pressbutton;
        }
        if (typeof document.orderform.onsubmit == "function") {
        document.orderform.onsubmit();
        }
        if (typeof document.orderform.fireEvent == "function") {
        document.orderform.fireEvent('submit');
        }
        document.orderform.submit();
    }
    function saveorder(n, task) {
        checkAll_button(n, task);
    }
    function checkAll_button(n, task) {
        if (!task) {
        task = 'saveorder';
        }
        document.orderform.submit();
    }
</script>
<div id="toolbar-box">
    <div class="m">
        <div id="toolbar" class="toolbar-list">
          <?php
          if(($u_data['groupid']=='4'))
          {
          ?>
            <ul>
                <li id="toolbar-new" class="listbutton">
                    <a href="<?php echo base_url(); ?>admin/pcategories/create/" onclick="Joomla.submitbutton('edit')" class="toolbar">
                    <span class="icon-32-new">
                    </span>
                    New
                    </a>
                </li>
            </ul>
          <?php
          }
          ?>
        <div class="clr"></div>
        </div>
        <div class="pagetitle icon-48-generic"><h2><?php echo 'Course Categories Manager';?></h2></div>
    </div>
</div>
<div><h2><?php //echo lang('web_category_list')?></h2></div>
<div class='clear'></div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('admin/pcategories/',$attributes);
?>
<!--<form action="<?=site_url('admin/quizzes/')?>" method="post">-->
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width: 96%;">
      <tbody>
          <tr>
              <td>
                  <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">
                  <input type="submit" value="Search" name="submit_search">
                  <input type="submit" value="Reset" name="reset">
              </td>
          </tr>
          <tr>
          </tr>
      </tbody>
</table>
<?php echo form_close(); ?>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart('admin/pcategories/',$attributes);
?>
<?php if ($categories): ?>
<table class="adminlist">
    <thead>
        <th>ID</th>
        <th><?php echo lang('web_name')?></th>
        <th>Sub Categories</th>
        <th>Order<a class="saveorder" href="javascript: saveorder(<?php echo count($categories)-1; ?>, 'saveorder')">__</a></th>
        <th align="center">Published</th>
        <th colspan='2'><?php echo lang('web_options')?></th>
    </thead>

    <tbody>
    <?php $i=0; foreach ($categories as $category): ?>
        <tr id='<?php echo $category->id?>'>
            <td><?php echo $category->id?></td>
            <td width='400'>
                <?php echo $category->name; ?>
            </td>
            <td>
                <a title="Move Up" onclick="return listItemTask('cb<?php echo $i; ?>','orderup')" href="javascript:void(0);" class="jgrid" id="cb<?php echo $i ?>">
                <span class="state uparrow"></span>
                </a>
                <a title="Move Down" onclick="return listItemTask('cb<?php echo $i; ?>','orderdown')" href="javascript:void(0);" class="jgrid">
                <span class="state downarrow"></span></a>
            </td>
            <td width='150'>
                <input type="text" name="order[<?php echo $category->id; ?>]" size="5" value="<?php echo $category->ordering ; ?>" class="text_area" style="text-align: center" />
                <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $category->id;?>" class="text_area" style="text-align: center" />
            </td>
            <td width='150' align="center">
                <?php
                if(($u_data['groupid']=='4'))
                {
                ?>
                    <?php if($category->published){?>
                    <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/pcategories/unpublish/<?php echo $category ->id?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
                    <?php }else{?>
                    <a title="Publish Item" href="<?php echo base_url(); ?>admin/pcategories/publish/<?php echo $category ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
                    <?php }?>
                <?php
                }
                else
                echo "No Access";
                ?>
            </td>
            <td width="60">
                <?php
                if(($u_data['groupid']=='4'))
                {
                ?>
                    <a class='ledit' href='<?php echo base_url(); ?>admin/pcategories/edit/<?php echo $category->id?>/'><?php echo lang('web_edit')?></a>
                <?php
                }
                else
                     echo "Edit : No Access";
                ?>
            </td>
            <td width="60">
                <?php
                if(($u_data['groupid']=='4'))
                {
                ?>
                     <a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/pcategories/delete/<?php echo $category->id?>'><?php echo lang('web_delete')?></a>
                <?php
                }
                else
                    echo "Delete : No Access";
                ?>
            </td>

        </tr>

    <?php
    $i++;
    endforeach ?>
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="checkval" value=""/>
    </tbody>
</table>
<?php echo form_close(); ?>
<div class="containerpg">
    <div class="pagination">
         <?php echo $this->pagination->create_links();  ?>
    </div>
</div>
<?php else: ?>
<p class='text'><?php echo lang('web_no_elements');?></p>
<?php endif ?>