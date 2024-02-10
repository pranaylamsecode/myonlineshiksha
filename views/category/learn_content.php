		
<?php // print_r($category); ?>

<style>

	section.learnContent {
    padding: 35px 0px;
}
.top-section h1 {
    text-align: center;
    margin: 0px;
    background: #061f57;
    color: #ffffff;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: 500;
    line-height: 1.2;
    font-size: 36px;
}
.categoryDes {
    padding: 20px 0px 10px 0px;
}
p {
    font-size: 17px;
    line-height: 1.7em;
}

.catLabel p {
    color: #4d4d4d;
    font-weight: bold;
    font-size: 20px;
}
.button-links li a {
    background-color: #ffffff;
    border-radius: 4px;
    box-shadow: 2px 2px 5px 1px #d5d5d580;
    font-size: 16px;
    min-width: 175px;
    border: 1px solid #061f57;
    color: #061f57;
    padding: 10px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s all ease;
}
.button-links li {
    display: inline-block;
     padding: 0px 10px;
}
.catLabel {
    margin-bottom: 17px;
}
.button-links li a:hover {
    background: #061f57;
    color: #fff;
}
.button-links {
    margin: 0px -10px;
}
@media (max-width:767px){
	section.learnContent {
    padding: 35px 0px;
    border-top: 1px solid #ddd;
}
.top-section h1 {
    font-size: 21px;
}
p {
    font-size: 15px;
    line-height: 1.7em;
}
.catLabel p {
    font-size: 18px;
}
.button-links li {
    display: inline-block;
    margin-top: 0px;
    width: 50%;
    float: left;
}
.button-links li a {
    font-size: 15px;
    min-width: unset;
    width: 100%;
}
}
</style>
<section class="learnContent">

	<div class="container">

        <?php  if($sub_cate){ ?>

		<div class="top-section">
	        <h1 class="font-white top-heading-page"><?php echo $category->name ?></h1>
	    </div>

	    <div class="page-data">

	        <div class="page-content-block">

	        	<div class="categoryDes">

	        		<p><?php echo $category->description ?></p>

	        	</div>


				<div class="catLabel">

					<p><?php echo $category->name ?> provided by us: </p>

				</div>

				<div class="button-links">
					<?php foreach ($sub_cate as $cate) { ?>
						<li class="linkButton"><a href="<?php echo base_url() ?>learns/<?php echo $category->slug ?>/<?php echo $cate->slug ?>/"><strong> <?php echo $cate->name ?></strong></a></li>
					<?php } ?>
				</div>

			</div>

		</div>
<?php } 
else{ ?>
<div class="button-links">
                    <?php
                     foreach ($category as $cate) {   
                            ?>
                          <li class="linkButton"><a href="<?php echo base_url() ?>learn/<?php echo $cate->slug ?>"><strong> <?php echo $cate->name ?></strong></a></li>  
                    <?php  } ?>
                </div>
<?php } ?>
	</div>

</section>

