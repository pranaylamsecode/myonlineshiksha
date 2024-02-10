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
    border: 1px solid #061f57;
    color: #061f57;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s all ease;
    flex-direction: column;
    font-size: 15px;
    min-width: unset;
    width: 100%;
}
.button-links li a strong {
	padding: 10px;
}
.button-links li a img {
	width: auto;
	max-width: 250px;
}
.button-links li {
    display: inline-block;
     padding: 10px 10px;
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
}
</style>


<section class="learnContent">

	<div class="container">
<div class="button-links">
					<?php foreach ($pages as $page) { ?>
						<li class="linkButton"><a href="<?php echo base_url() ?>learning/<?php echo $this->uri->segment(2) ?>/<?php echo $this->uri->segment(3) ?>/<?php echo $page->slug ?>/">
							<?php if($page->image){ ?>
							<img height="180px" src="<?php echo base_url().'public/LearnContent/images/'.$page->image ?>" />
							<?php } ?>
							<strong> <?php echo $page->heading ?></strong></a></li>
					<?php } ?>
				</div>

</section>

