<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');

 echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings', $attributes) : form_open_multipart(base_url().'admin/settings');

?>

<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">

			<ul style="list-style:none; float:right;">

			<li id="toolbar-new" class="listbutton">

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo 'General Settings';?></h2></div>

	</div>

</div>

<div class="tab-content">

	<!--Main fieldset-->

<!--<form id="adminForm" name="adminForm" method="post" action="index.php">     -->

	<fieldset class="adminform">

	</fieldset>
</form>

</div>
<div class="field_container">
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="padding:0;width:100%;">
					<p>Manage the Display settings of your online courses.</p>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body main-table form-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border" style="padding-top:0!important;">
						<label class="col-sm-12 field-title control-label">Currency :</label>
						
						<div class="col-sm-12">
							
                            <select size="1" name="currency" id="currency" class="form-control form-height">



			<?php $currencies = (isset($currencies)) ? $currencies : array();



			foreach($currencies as $curr){?>



			<option value="<?php echo $curr->currency_name;?>" <?php echo (isset($curr->currency_name) && $curr->currency_name == $currency )? 'selected="selected"' : ''?> ><?php echo $curr->currency_full;?></option>



			<?php }?>



			</select>

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="currency-target" class="tooltipicon"></span>

						<span class="currency-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('general_fld_currency');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->

						</div>
					</div>
                    
                    <!--<div class="form-group">
						<label class="col-sm-3 control-label">Currency position :</label>
						
						<div class="col-sm-5">
							
                            <select name="currencypos" id="currencypos" class="form-control">



					<option value="0" <?php echo ( $currencypos == '0' )? 'selected="selected"' : ''?> >Before</option>



					<option value="1" <?php echo ( $currencypos == '1' )? 'selected="selected"' : ''?>>After</option>



				</select>



						<span class="tooltipcontainer">

						<span type="text" id="currencypos-target" class="tooltipicon"></span>

						<span class="currencypos-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('general_fld_currency-position');?>


						</span>

						</span>


						</div>
					</div>-->
                    
<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Time zone:

						</label>
<?php 
//echo $settings[0]['time_zone'];

$tmzone_array = array("GMT",
	"Africa/Abidjan",
"Africa/Accra",
"Africa/Addis_Ababa",
"Africa/Algiers",
"Africa/Asmara",
"Africa/Bamako",
"Africa/Bangui",
"Africa/Banjul",
"Africa/Bissau",
"Africa/Blantyre",
"Africa/Brazzaville",
"Africa/Bujumbura",
"Africa/Cairo",
"Africa/Casablanca",
"Africa/Ceuta",
"Africa/Conakry",
"Africa/Dakar",
"Africa/Dar_es_Salaam",
"Africa/Djibouti",
"Africa/Douala",
"Africa/El_Aaiun",
"Africa/Freetown",
"Africa/Gaborone",
"Africa/Harare",
"Africa/Johannesburg",
"Africa/Kampala",
"Africa/Khartoum",
"Africa/Kigali",
"Africa/Kinshasa",
"Africa/Lagos",
"Africa/Libreville",
"Africa/Lome",
"Africa/Luanda",
"Africa/Lubumbashi",
"Africa/Lusaka",
"Africa/Malabo",
"Africa/Maputo",
"Africa/Maseru",
"Africa/Mbabane",
"Africa/Mogadishu",
"Africa/Monrovia",
"Africa/Nairobi",
"Africa/Ndjamena",
"Africa/Niamey",
"Africa/Nouakchott",
"Africa/Ouagadougou",
"Africa/Porto-Novo",
"Africa/Sao_Tome",
"Africa/Tripoli",
"Africa/Tunis",
"Africa/Windhoek",
"America/Adak",
"America/Anchorage",
"America/Anguilla",
"America/Antigua",
"America/Araguaina",
"America/Argentina/Buenos_Aires",
"America/Argentina/Catamarca",
"America/Argentina/Cordoba",
"America/Argentina/Jujuy",
"America/Argentina/La_Rioja",
"America/Argentina/Mendoza",
"America/Argentina/Rio_Gallegos",
"America/Argentina/Salta",
"America/Argentina/San_Juan",
"America/Argentina/San_Luis",
"America/Argentina/Tucuman",
"America/Argentina/Ushuaia",
"America/Aruba",
"America/Asuncion",
"America/Atikokan",
"America/Bahia",
"America/Barbados",
"America/Belem",
"America/Belize",
"America/Blanc-Sablon",
"America/Boa_Vista",
"America/Bogota",
"America/Boise",
"America/Cambridge_Bay",
"America/Campo_Grande",
"America/Cancun",
"America/Caracas",
"America/Cayenne",
"America/Cayman",
"America/Chicago",
"America/Chihuahua",
"America/Costa_Rica",
"America/Cuiaba",
"America/Curacao",
"America/Danmarkshavn",
"America/Dawson",
"America/Dawson_Creek",
"America/Denver",
"America/Detroit",
"America/Dominica",
"America/Edmonton",
"America/Eirunepe",
"America/El_Salvador",
"America/Fortaleza",
"America/Glace_Bay",
"America/Godthab",
"America/Goose_Bay",
"America/Grand_Turk",
"America/Grenada",
"America/Guadeloupe",
"America/Guatemala",
"America/Guayaquil",
"America/Guyana",
"America/Halifax",
"America/Havana",
"America/Hermosillo",
"America/Indiana/Indianapolis",
"America/Indiana/Knox",
"America/Indiana/Marengo",
"America/Indiana/Petersburg",
"America/Indiana/Tell_City",
"America/Indiana/Vevay",
"America/Indiana/Vincennes",
"America/Indiana/Winamac",
"America/Inuvik",
"America/Iqaluit",
"America/Jamaica",
"America/Juneau",
"America/Kentucky/Louisville",
"America/Kentucky/Monticello",
"America/La_Paz",
"America/Lima",
"America/Los_Angeles",
"America/Maceio",
"America/Managua",
"America/Manaus",
"America/Marigot",
"America/Martinique",
"America/Matamoros",
"America/Mazatlan",
"America/Menominee",
"America/Merida",
"America/Mexico_City",
"America/Miquelon",
"America/Moncton",
"America/Monterrey",
"America/Montevideo",
"America/Montreal",
"America/Montserrat",
"America/Nassau",
"America/New_York",
"America/Nipigon",
"America/Nome",
"America/Noronha",
"America/North_Dakota/Center",
"America/North_Dakota/New_Salem",
"America/Ojinaga",
"America/Panama",
"America/Pangnirtung",
"America/Paramaribo",
"America/Phoenix",
"America/Port-au-Prince",
"America/Port_of_Spain",
"America/Porto_Velho",
"America/Puerto_Rico",
"America/Rainy_River",
"America/Rankin_Inlet",
"America/Recife",
"America/Regina",
"America/Resolute",
"America/Rio_Branco",
"America/Santa_Isabel",
"America/Santarem",
"America/Santiago",
"America/Santo_Domingo",
"America/Sao_Paulo",
"America/Scoresbysund",
"America/Shiprock",
"America/St_Barthelemy",
"America/St_Johns",
"America/St_Kitts",
"America/St_Lucia",
"America/St_Thomas",
"America/St_Vincent",
"America/Swift_Current",
"America/Tegucigalpa",
"America/Thule",
"America/Thunder_Bay",
"America/Tijuana",
"America/Toronto",
"America/Tortola",
"America/Vancouver",
"America/Whitehorse",
"America/Winnipeg",
"America/Yakutat",
"America/Yellowknife",
"Antarctica/Casey",
"Antarctica/Davis",
"Antarctica/DumontDUrville",
"Antarctica/Mawson",
"Antarctica/McMurdo",
"Antarctica/Palmer",
"Antarctica/Rothera",
"Antarctica/South_Pole",
"Antarctica/Syowa",
"Antarctica/Vostok",
"Arctic/Longyearbyen",
"Asia/Aden",
"Asia/Almaty",
"Asia/Amman",
"Asia/Anadyr",
"Asia/Aqtau",
"Asia/Aqtobe",
"Asia/Ashgabat",
"Asia/Baghdad",
"Asia/Bahrain",
"Asia/Baku",
"Asia/Bangkok",
"Asia/Beirut",
"Asia/Bishkek",
"Asia/Brunei",
"Asia/Choibalsan",
"Asia/Chongqing",
"Asia/Colombo",
"Asia/Damascus",
"Asia/Dhaka",
"Asia/Dili",
"Asia/Dubai",
"Asia/Dushanbe",
"Asia/Gaza",
"Asia/Harbin",
"Asia/Ho_Chi_Minh",
"Asia/Hong_Kong",
"Asia/Hovd",
"Asia/Irkutsk",
"Asia/Jakarta",
"Asia/Jayapura",
"Asia/Jerusalem",
"Asia/Kabul",
"Asia/Kamchatka",
"Asia/Karachi",
"Asia/Kashgar",
"Asia/Kathmandu",
"Asia/Kolkata",
"Asia/Krasnoyarsk",
"Asia/Kuala_Lumpur",
"Asia/Kuching",
"Asia/Kuwait",
"Asia/Macau",
"Asia/Magadan",
"Asia/Makassar",
"Asia/Manila",
"Asia/Muscat",
"Asia/Nicosia",
"Asia/Novokuznetsk",
"Asia/Novosibirsk",
"Asia/Omsk",
"Asia/Oral",
"Asia/Phnom_Penh",
"Asia/Pontianak",
"Asia/Pyongyang",
"Asia/Qatar",
"Asia/Qyzylorda",
"Asia/Rangoon",
"Asia/Riyadh",
"Asia/Sakhalin",
"Asia/Samarkand",
"Asia/Seoul",
"Asia/Shanghai",
"Asia/Singapore",
"Asia/Taipei",
"Asia/Tashkent",
"Asia/Tbilisi",
"Asia/Tehran",
"Asia/Thimphu",
"Asia/Tokyo",
"Asia/Ulaanbaatar",
"Asia/Urumqi",
"Asia/Vientiane",
"Asia/Vladivostok",
"Asia/Yakutsk",
"Asia/Yekaterinburg",
"Asia/Yerevan",
"Atlantic/Azores",
"Atlantic/Bermuda",
"Atlantic/Canary",
"Atlantic/Cape_Verde",
"Atlantic/Faroe",
"Atlantic/Madeira",
"Atlantic/Reykjavik",
"Atlantic/South_Georgia",
"Atlantic/St_Helena",
"Atlantic/Stanley",
"Australia/Adelaide",
"Australia/Brisbane",
"Australia/Broken_Hill",
"Australia/Currie",
"Australia/Darwin",
"Australia/Hobart",
"Australia/Lindeman",
"Australia/Melbourne",
"Australia/Perth",
"Australia/Sydney",
"Europe/Amsterdam",
"Europe/Andorra",
"Europe/Athens",
"Europe/Belgrade",
"Europe/Berlin",
"Europe/Bratislava",
"Europe/Brussels",
"Europe/Bucharest",
"Europe/Budapest",
"Europe/Chisinau",
"Europe/Copenhagen",
"Europe/Dublin",
"Europe/Gibraltar",
"Europe/Guernsey",
"Europe/Helsinki",
"Europe/Isle_of_Man",
"Europe/Istanbul",
"Europe/Jersey",
"Europe/Kaliningrad",
"Europe/Kiev",
"Europe/Lisbon",
"Europe/Ljubljana",
"Europe/London",
"Europe/Luxembourg",
"Europe/Madrid",
"Europe/Malta",
"Europe/Mariehamn",
"Europe/Minsk",
"Europe/Monaco",
"Europe/Moscow",
"Europe/Oslo",
"Europe/Paris",
"Europe/Podgorica",
"Europe/Prague",
"Europe/Riga",
"Europe/Rome",
"Europe/Samara",
"Europe/San_Marino",
"Europe/Sarajevo",
"Europe/Simferopol",
"Europe/Skopje",
"Europe/Sofia",
"Europe/Stockholm",
"Europe/Tallinn",
"Europe/Tirane",
"Europe/Uzhgorod",
"Europe/Vaduz",
"Europe/Vatican",
"Europe/Vienna",
"Europe/Vilnius",
"Europe/Volgograd",
"Europe/Warsaw",
"Europe/Zagreb",
"Europe/Zaporozhye",
"Europe/Zurich",
"Indian/Antananarivo",
"Indian/Chagos",
"Indian/Christmas",
"Indian/Cocos",
"Indian/Comoro",
"Indian/Kerguelen",
"Indian/Mahe",
"Indian/Maldives",
"Indian/Mauritius",
"Indian/Mayotte",
"Indian/Reunion",
"Pacific/Apia",
"Pacific/Auckland",
"Pacific/Easter",
"Pacific/Efate",
"Pacific/Enderbury",
"Pacific/Fakaofo",
"Pacific/Fiji",
"Pacific/Funafuti",
"Pacific/Galapagos",
"Pacific/Gambier",
"Pacific/Guadalcanal",
"Pacific/Guam",
"Pacific/Honolulu",
"Pacific/Johnston",
"Pacific/Kosrae",
"Pacific/Kwajalein",
"Pacific/Majuro",
"Pacific/Midway",
"Pacific/Nauru",
"Pacific/Niue",
"Pacific/Norfolk",
"Pacific/Noumea",
"Pacific/Pago_Pago",
"Pacific/Palau",
"Pacific/Pitcairn",
"Pacific/Ponape",
"Pacific/Port_Moresby",
"Pacific/Rarotonga",
"Pacific/Saipan",
"Pacific/Tahiti",
"Pacific/Tarawa",
"Pacific/Tongatapu",
"Pacific/Truk",
"Pacific/Wake",
"Pacific/Wallis");

?>						
<div class="col-sm-12">
	
    <select name="time_zone" id="time_zone" class="form-control form-height">

<?php
for ($i=0; $i < sizeof($tmzone_array) ; $i++) { 
	?>
	<option value="<?php echo $tmzone_array[$i]; ?>" <?php echo (isset($settings[0]['time_zone']) && 
	 $settings[0]['time_zone'] == $tmzone_array[$i] )? 'selected="selected"' : (!isset($settings[0]['time_zone']) && $tmzone_array[$i] =='Asia/Kolkata')? 'selected="selected"' : '' ?>  ><?php echo $tmzone_array[$i]; ?></option>

<?php

}?>
</select>

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="time_zone-target" class="tooltipicon"></span>

						<span class="show_bradcrumbs-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('general_fld_show-breadcrumbs');?>

                        
						</span>

						</span> -->

					<!-- tooltip area finish -->
						</div>
						
					</div>


                    
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Date/Time Format :</label>
						
						<div class="col-sm-12">
							
                            <select size="1" class="form-control form-height" name="datetype" id="datetype">



					<option value="d-m-Y H:i:s" <?php echo ( $datetype == 'd-m-Y H:i:s' )? 'selected="selected"' : ''?>>dd-mm-yyyy hh:mm:ss</option>



					<option value="d/m/Y H:i:s" <?php echo ( $datetype == 'd/m/Y H:i:s' )? 'selected="selected"' : ''?>>dd/mm/yyyy hh:mm:ss</option>



					<option value="m-d-Y H:i:s" <?php echo ( $datetype == 'm-d-Y H:i:s' )? 'selected="selected"' : ''?>>mm-dd-yyyy hh:mm:ss</option>



					<option value="m/d/Y H:i:s" <?php echo ( $datetype == 'm/d/Y H:i:s' )? 'selected="selected"' : ''?>>mm/dd/yyyy hh:mm:ss</option>



					<option value="Y-m-d H:i:s" <?php echo ( $datetype == 'Y-m-d H:i:s' )? 'selected="selected"' : ''?>>yyyy-mm-dd hh:mm:ss</option>



					<option value="Y/m/d H:i:s" <?php echo ( $datetype == 'Y/m/d H:i:s' )? 'selected="selected"' : ''?>>yyyy/mm/dd hh:mm:ss</option>



					<option value="d-m-Y" <?php echo ( $datetype == 'd-m-Y' )? 'selected="selected"' : ''?>>dd-mm-yyyy</option>



					<option value="d/m/Y" <?php echo ( $datetype == 'd/m/Y' )? 'selected="selected"' : ''?>>dd/mm/yyyy</option>



					<option value="m-d-Y" <?php echo ( $datetype == 'm-d-Y' )? 'selected="selected"' : ''?>>mm-dd-yyyy</option>



					<option value="m/d/Y" <?php echo ( $datetype == 'm/d/Y' )? 'selected="selected"' : ''?>>mm/dd/yyyy</option>



					<option value="Y-m-d" <?php echo ( $datetype == 'Y-m-d' )? 'selected="selected"' : ''?>>yyyy-mm-dd</option>



					<option value="Y/m/d" <?php echo ( $datetype == 'Y/m/d' )? 'selected="selected"' : ''?>>yyyy/mm/dd</option>



				</select>			

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="datetype-target" class="tooltipicon"></span>

						<span class="datetype-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('general_fld_date-format');?>

						</span>

						</span>
 -->
					<!-- tooltip area finish -->
						</div>
					</div>
                    
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Hour format :</label>
						
						<div class="col-sm-12">
							
                            
                            <select size="1" class="form-control form-height" name="hour_format" id="hour_format">



				<option selected="selected" value="12" <?php echo ( $hour_format == '12' )? 'selected="selected"' : ''?>>12-hour clock (AM/PM)</option>



				<option value="24" <?php echo ( $hour_format == '24' )? 'selected="selected"' : ''?>>24-hour clock</option>



				</select>

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="hour_format-target" class="tooltipicon"></span>

						<span class="hour_format-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('general_fld_hour-format');?>

						</span>

						</span> -->

<!-- tooltip area finish -->

						</div>
					</div>
                    
                 <!--   <div class="form-group">
						<label class="col-sm-3 control-label">Open lesson in :</label>
						
						<div class="col-sm-5">
							
                            <select size="1" class="form-control" name="open_target" id="open_target">



					<option value="0" <?php echo ( $hour_format == '0' )? 'selected="selected"' : ''?>>Same window</option>



					<option value="1" <?php echo ( $hour_format == '1' )? 'selected="selected"' : ''?>>New window</option>



				</select>



						<span class="tooltipcontainer">

						<span type="text" id="open_window-target" class="tooltipicon"></span>

						<span class="open_window-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('general_fld_open-lesson');?>

                        

						</span>

						</span>


						</div>
					</div>-->
                    
                    <!--<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Lesson window size (front-end) :</label>
						
					
                            <?php list($lwinwidth,$lwinheight)=explode('x',$lesson_window_size);?>		



		<div class="col-sm-5">



			<div style="float:left;">



				<input type="text" style="width:200px;" class="form-control" value="<?php echo $lwinwidth;?>" name="lesson_window_size_width" size="5">



			</div>



			<div style="float:left; margin-left:8px;">



				x &nbsp;



			</div>



			<div style="float:left;">



				<input type="text" style="width:200px;" class="form-control" value="<?php echo $lwinheight;?>" name="lesson_window_size_height" size="5">



			</div>



			<div style="text-align:center;">



				(Width x Height)&nbsp;



			</div>





						<span class="tooltipcontainer">

						<span type="text" id="lesson_window_size-target" class="tooltipicon"></span>

						<span class="lesson_window_size-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('general_fld_window-size');?>

                      

						</span>

						</span>



		</div>

						
                        <div class="clear"></div>
					</div>-->
										
					<!--<div class="form-group">
						<label class="col-sm-3 control-label">Show notification :</label>
						
						<div class="col-sm-5">
							
                            <select name="notification" id="notification" class="form-control">



					<option value="0" <?php echo ( $notification == '0' )? 'selected="selected"' : ''?>>Yes</option>



					<option value="1" <?php echo ( $notification == '1' )? 'selected="selected"' : ''?>>No</option>



				</select>





						<span class="tooltipcontainer">

						<span type="text" id="notification-target" class="tooltipicon"></span>

						<span class="notification-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('general_fld_show-notification');?>

                        

						</span>

						</span>


						</div>
					</div>-->
					
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Show bread crumbs :
						<p><a href="http://en.wikipedia.org/wiki/Breadcrumb(navigation)"> What is this? </a></p>
						</label>
						
						<div class="col-sm-12">
							
                            <select name="show_bradcrumbs" id="show_bradcrumbs" class="form-control form-height">



					<option value="1" <?php echo ( $show_bradcrumbs == '1' )? 'selected="selected"' : ''?>>Yes</option>



					<option value="0" <?php echo ( $show_bradcrumbs == '1' )? 'selected="selected"' : ''?>>No</option>



				</select>

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="show_bradcrumbs-target" class="tooltipicon"></span>

						<span class="show_bradcrumbs-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('general_fld_show-breadcrumbs');?>

                        
						</span>

						</span> -->

					<!-- tooltip area finish -->
						</div>
						
					</div>
					
                   <!-- <div class="form-group">
						<label for="field-1"  class="col-sm-3 control-label">Default video size :</label>
						
                        <?php list($dvidwidth,$dvidheight)=explode('x',$default_video_size);?>			



		<div class="col-sm-5">



			<div style="float:left;">



				<input type="text" style="width:200px;" class="form-control" value="<?php echo $dvidwidth;?>" name="default_video_size_width" size="5">



			</div>



			<div style="float:left; margin-left:8px;">



				x &nbsp;



			</div>



			<div style="float:left;">



				<input type="text" style="width:200px;" class="form-control" value="<?php echo $dvidheight;?>" name="default_video_size_height" size="5">



			</div>



			<div style="text-align:center;">



				(Width x Height) &nbsp;



			</div>



		</div>





						<span class="tooltipcontainer">

						<span type="text" id="default_video_size-target" class="tooltipicon"></span>

						<span class="default_video_size-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>


						<?php echo lang('general_fld_video-size');?>

                       

						</span>

						</span>


                        
                        <div class="clear"></div>
					</div>-->
                    
					<div class="form-group form-border" style="padding-top:2.5%!important">
						<div class="col-sm-12">
							
                            
                            <?php echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
						</div>
					</div>
				</form>
				
			</div>
		  </div>
		</div>
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

<!-- tool tip script finish -->