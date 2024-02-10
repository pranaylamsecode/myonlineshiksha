<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends MLMS_Controller {

  	function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
		$this->load->model('Crud_model');
		$this->load->helper('text');		
		$this->load->helper('commonmethods');
		$this->load->model('admin/settings_model');	
		
	}

	public function index()
	{
		$demo_qr = $this->Crud_model->get_single('mlms_users',"id = 595","id, email,first_name,last_name,referral_code,referral_qr,url_link,mobile,business_name");
		$data = array(
					'name' => "Resellers Demo",
					'img'  => $demo_qr->referral_qr,
		);
		$this->load->view('onlineshiksha/demo',$data);
	}

	public function view()
	{
		$demo_qr = $this->Crud_model->get_single('mlms_users',"id = 595","id, email,first_name,last_name,referral_code,referral_qr,url_link,mobile,business_name");
		$data = array(
					'name' => $demo_qr->first_name." ".$demo_qr->last_name,
					'img'  => $demo_qr->referral_qr,
		);
		$this->load->view('onlineshiksha/reseller_vdo_demo',$data);
	}

	public function mySitemap()
	{
		$category = $this->Crud_model->allCat();
		$courses = $this->Crud_model->GetData('mlms_program','slug',"published = 1 AND trash = 0");
		$myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
		$txt = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc>https://myonlineshiksha.com/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>1.00</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/category/courses/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>';
		foreach ($category as $key) {
			$txt .= '<url>
	  	<loc>https://myonlineshiksha.com/category/courses/'.$key->slug.'/</loc>
	  	<lastmod>'.date('c',time()).'</lastmod>
	  	<priority>0.80</priority>
	</url>';
		}
		
		foreach ($courses as $key) {
			$txt .= '<url>
		<loc>https://myonlineshiksha.com/online-courses/'.$key->slug.'/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>';
		}

		$txt .= '
	<url>
		<loc>https://myonlineshiksha.com/become-a-teacher/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/blog/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/about/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/become-a-reseller/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/terms-of-use/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/privacy-policy/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/contact_us/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.80</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/agreement/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/category/teaching/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/blogs/blogDetailview/children-learn-better-in-their-mother-tongue/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/resellers-terms-of-use/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/testimonials/alltestimonials/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/testimonials/view/21/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.64</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/contact-us/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.51</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/users/forgot_password/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.41</priority>
	</url>
	<url>
		<loc>https://myonlineshiksha.com/category/donotpermission/</loc>
		<lastmod>'.date('c',time()).'</lastmod>
		<priority>0.41</priority>
	</url>
	<url>
  		<loc>https://myonlineshiksha.com/my-wishlists/</loc>
  		<lastmod>'.date('c',time()).'</lastmod>
  		<priority>0.41</priority>
	</url>
</urlset>';

		fwrite($myfile, $txt);
		fclose($myfile);
	}
}
