

<?php

if($aboutpage[0]['settings'])
{
  $settingarr=json_decode($aboutpage[0]['settings']);
  $address=$settingarr->address;
  $phone=$settingarr->phone;
  $email=$settingarr->email;
  $weburl=$settingarr->weburl;
  $mapcode=$settingarr->mapcode;
}
else
{
    $address="";
    $phone="";
    $email="";
    $weburl="";
    $mapcode="";
}
?>


<div class="leftcontent">
    <h1><?php echo $aboutpage[0]['heading']?></h1>
    <?php echo $aboutpage[0]['content']?>
</div>
<div class="rightsidebar">
right sidebar content goes here...
</div>


