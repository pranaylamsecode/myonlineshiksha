<style type="text/css">
	.form-group {
    margin-bottom: 15px!important;
}
</style>
<!-- 				<div class="panel panel-primary primary-border" data-collapsed="0">
 -->		
			<div class="panel-heading">
				<div class="panel-title mb_20" style="padding: 0;width:100%;">
					<h2 class="tab_heading">General settings</h2>
					<p>Manage the Display settings of your online courses.</p>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="row">
				<?php
				$attributes = array('class' => 'tform', 'id' => 'form_general');

				echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings', $attributes) : form_open_multipart(base_url().'admin/settings'.$id, $attributes);

				?>
				<!-- <form role="form" class="form-horizontal form-groups-bordered"> -->
	
					<div class="form-group form-border" style="padding-top:0!important;">
						<label class="col-sm-12 field-title control-label">Currency :</label>
						
						<div class="col-sm-12">
							
                            <select size="1" name="currency" id="currency" class="form-control form-height">



			<?php $currencies = (isset($currencies)) ? $currencies : array();



			foreach($currencies as $curr){?>



			<option value="<?php echo $curr->currency_name;?>" <?php echo (isset($curr->currency_name) && $curr->currency_name == $currency )? 'selected="selected"' : ''?> ><?php echo $curr->currency_full;?></option>



			<?php }?>



			</select>

				

						</div>
					</div>
                    
                  
                    
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

					
						</div>
					</div>
                    
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Hour format :</label>
						
						<div class="col-sm-12">
							
                            
                            <select size="1" class="form-control form-height" name="hour_format" id="hour_format">



				<option selected="selected" value="12" <?php echo ( $hour_format == '12' )? 'selected="selected"' : ''?>>12-hour clock (AM/PM)</option>



				<option value="24" <?php echo ( $hour_format == '24' )? 'selected="selected"' : ''?>>24-hour clock</option>



				</select>


						</div>
					</div>
                
					
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Show bread crumbs :
						<p><a href="http://en.wikipedia.org/wiki/Breadcrumb(navigation)"> What is this? </a></p>
						</label>
						
						<div class="col-sm-12">
							
                            <select name="show_bradcrumbs" id="show_bradcrumbs" class="form-control form-height">



					<option value="1" <?php echo ( $show_bradcrumbs == '1' )? 'selected="selected"' : ''?>>Yes</option>



					<option value="0" <?php echo ( $show_bradcrumbs == '1' )? 'selected="selected"' : ''?>>No</option>



				</select>

					
						</div>
						
					</div>
					
                 
                    
					<div class="form-group form-border" >
						<div class="col-sm-12">
							
                            <button type="button" id="btnsubmit" class='btn '>Update</button>
                            <?php //echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
						</div>
					</div>
				</form>
				
			</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> 
	
<script>

	 $(document).on('click', '#btnsubmit', function(){
		$.ajax({
		type: 'POST',
		data: $("#form_general").serialize(),
		url: "<?php echo base_url(); ?>admin/settings/general_post",
		beforeSend: function(){
			window.scrollTo(0,0);
		},
		success: function(msg){
			var alt_msg = $(document).find('#message');
			 if(msg)
            {
               var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated. </div>';         
            }
            else{
              var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong> Fail to updated, Please try again! </div>';
            } 

            alt_msg.html(str);
            alt_msg.show();
            alt_msg.fadeIn().delay(3000).fadeOut();
            // $('#lecture_save').prop('disabled', false);

        
			
		}
			// $.alert({
			// 		title: '',
			// 	    content: '<h4 style="text-align:center">'+msg+'</h4>',
			// });
			
		
	});
	});

</script>

