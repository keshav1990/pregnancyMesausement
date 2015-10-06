<?php 
    /* 
	 Plugin Name: Pregnancy Measurement Kit
    Plugin URI: http://www.neowebsolutions.com 
    Description: This PHP script will be used for getting the pregnancy period and suggesstion for the doctors. 
    Author: Keshav Kalra
    Version: 1.0
    Author URI: http://www.neowebsolutions.com 
    */  
$pluginURL =  plugins_url()."/pregnancy/";

include_once 'pregnancy_language.php';
function pragnencey_meters( $atts ) {
	

 ?>
<html>
<head>

<script > if(typeof jQuery == 'undefined'){
        document.write('<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></'+'script>');
  }
  </script>
<link href="<?php echo $pluginURL; ?>pregnancy.css" media="screen" rel="stylesheet" type="text/css" />
<script type='text/javascript'>
function getdetails(){
	var sday = jQuery('#sday').val();
	var smonth = jQuery('#smonth').val();
	var syear = jQuery('#syear').val();
	
	// Date validation start
	if ((smonth==4 || smonth==6 || smonth==9 || smonth==11) && sday ==31) {
		jQuery('#pregnancyContent').html('<?php echo $lang['HTML_WRONG_DATE']; ?>');
		return false;
	}
	else if (smonth == 2) {
		var checkYear = (syear % 4 == 0 && (syear % 100 != 0 || syear % 400 == 0));
		if (sday> 29 || (sday ==29 && !checkYear)) {
			jQuery('#pregnancyContent').html('<?php echo $lang['HTML_WRONG_DATE']; ?>');
			return false;
		}
	}
	else if (syear == <?php echo date('Y'); ?> && smonth == <?php echo date('n'); ?> && sday > <?php echo date('j'); ?>) {
			jQuery('#pregnancyContent').html('<?php echo $lang['HTML_WRONG_DATE_FAR']; ?>');
			return false;
	}
	else if (syear == <?php echo date('Y'); ?> && smonth > <?php echo date('n'); ?>) {
			jQuery('#pregnancyContent').html('<?php echo $lang['HTML_WRONG_DATE_FAR']; ?>');
			return false;
	}
	else if (syear == '<?php echo $lang['HTML_SELECT_YEAR']; ?>'  ||  smonth == '<?php echo $lang['HTML_SELECT_MONTH']; ?>'  ||  sday == '<?php echo $lang['HTML_SELECT_DAY']; ?>') {
			jQuery('#pregnancyContent').html('<?php echo $lang['HTML_WRONG_DATE_SELECT']; ?>');
			return false;
	}
	// Date validation end
	var go = jQuery('#go').val();
	jQuery.ajax({
		type: 'POST',
		url: 'pregnancy_class.php',
		data: {d:sday, m:smonth, y:syear, g:go}
	}).done(function(pregnancy) {
		jQuery('#pregnancyContent').html(pregnancy);
	});
}
</script>
</head>
<body>
<div class="container">
<h1><?php echo $lang['HTML_TITLE']; ?></h1>
<p><?php echo $lang['HTML_INTRO']; ?></p>
<div class="selector">
<select id="sday">
	<option><?php echo $lang['HTML_SELECT_DAY']; ?></option>
	<?php for ($i=1;$i<=31;$i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
</select>
<select id="smonth">
	<option><?php echo $lang['HTML_SELECT_MONTH']; ?></option>
	<?php for ($i=1;$i<=12;$i++) { echo '<option value="'.$i.'">'.$lang['HTML_MONTH_'.$i].'</option>'; } ?>
</select>
<select id="syear">
	<option><?php echo $lang['HTML_SELECT_YEAR']; ?></option>
	<?php for ($i=date("Y")-1;$i<=date("Y");$i++) { echo '<option value="'.$i.'">'.$i.'</option>'; } ?>
</select>
<input type="hidden" id="go" name="go" value="1" />
<input type="submit" value="<?php echo $lang['HTML_CALCULATE']; ?>" onClick = "getdetails()" />
</div>
<div id="pregnancyContent"></div>
</div>
</body>
<?php

}
add_shortcode( 'pregnancymeter', 'pragnencey_meters' );
 ?>
