<?php 
include_once 'pregnancy_language.php';
$go = $_POST["g"];
if ($go =="1")
{
	$sday = $_POST["d"];
	$smonth = $_POST["m"];
	$syear = $_POST["y"];
	$today = mktime(0,0,0,date("n"),date('j'),date("Y"));
	$last = mktime (0,0,0,$smonth, $sday, $syear) ;
	$gest = 24192000; // 9 months
	$due = $last + $gest; 
	$conception = $last + 1209600; // + 14 days
	$test = $last + ( 5 * 7 * 24 * 60 * 60 ); // + 5 weeks (5weeks*7days*24hours*60minutes*60seconds)
	$secondtrimester = $last + ( 12 * 7 * 24 * 60 * 60 ); // + 12 weeks (12weeks*7days*24hours*60minutes*60seconds)
	$firstmove = $last + ( 18 * 7 * 24 * 60 * 60 );
	$firstheartbeat = $last + ( 6 * 7 * 24 * 60 * 60 );
	$thirdtrimester = $last + ( 27 * 7 * 24 * 60 * 60 ); // + 27 weeks (27weeks*7days*24hours*60minutes*60seconds)
	$day = intval(date("d", $due));
	$month = intval(date("n", $due));
	$year = intval(date("Y", $due));
	$pregnancy_weeks = number_format((($today - $last)/60/60/24/7),0);
	if ($due<$today) { $pregnancy_weeks = 0; }
	if ($pregnancy_weeks==1) { 
		$weeks = $lang['RESULT_PREGNANCY_WEEK']; 
	} else {
		$weeks = $lang['RESULT_PREGNANCY_WEEKS']; 
	}
	if(($month==1 && $day>20)||($month==2 && $day<20)){
		$zodiac = $lang['RESULT_ZODIAC_AQUARIUS'];
	}else if(($month==2 && $day>18 )||($month==3 && $day<21)){
		$zodiac = $lang['RESULT_ZODIAC_PISCES'];
	}else if(($month==3 && $day>20)||($month==4 && $day<21)){
		$zodiac = $lang['RESULT_ZODIAC_ARIES'];
	}else if(($month==4 && $day>20)||($month==5 && $day<22)){
		$zodiac = $lang['RESULT_ZODIAC_TAURUS'];
	}else if(($month==5 && $day>21)||($month==6 && $day<22)){
		$zodiac = $lang['RESULT_ZODIAC_GEMINI'];
	}else if(($month==6 && $day>21)||($month==7 && $day<24)){
		$zodiac = $lang['RESULT_ZODIAC_CANCER'];
	}else if(($month==7 && $day>23)||($month==8 && $day<24)){
		$zodiac = $lang['RESULT_ZODIAC_LEO'];
	}else if(($month==8 && $day>23)||($month==9 && $day<24)){
		$zodiac = $lang['RESULT_ZODIAC_VIRGIN'];
	}else if(($month==9 && $day>23)||($month==10 && $day<24)){
		$zodiac = $lang['RESULT_ZODIAC_BALANCE'];
	}else if(($month==10 && $day>23)||($month==11 && $day<23)){
		$zodiac = $lang['RESULT_ZODIAC_SCORPION'];
	}else if(($month==11 && $day>22)||($month==12 && $day<23)){
		$zodiac = $lang['RESULT_ZODIAC_SAGITTARIUS'];
	}else if(($month==12 && $day>22)||($month==1 && $day<21)){
		$zodiac = $lang['RESULT_ZODIAC_CAPRICORN'];
	}
	$html  = $lang['RESULT_LAST_CYCLE'].date("F d, Y", $last)."<br />";
	$html .= $lang['RESULT_NEW_BORN'].date("F d, Y", $due).$lang['RESULT_ZODIAC'].$zodiac.".<br />";
	$html .= $lang['RESULT_CONCEPTION'].date("F d, Y", $conception).$lang['RESULT_TEST'].date("F d, Y", $test)."<br /><br />";
	$html .= "<strong>".$lang['RESULT_EXTRA_INFO']."</strong><br />";
	if ($pregnancy_weeks==0) {
		$html .= $lang['RESULT_PREGNANCY_NOT']."<br />";
		$html .= $lang['RESULT_FIRST_TRIM_END_OLD'].date("F d, Y", $secondtrimester).".<br />";
		$html .= $lang['RESULT_SECOND_TRIM_END_OLD'].date("F d, Y", $thirdtrimester).".<br />";
	} else {
		$html .= $lang['RESULT_PREGNANCY'].$pregnancy_weeks.$weeks.$lang['RESULT_PREGNANCY_PREGNANT']."<br />";
		$html .= $lang['RESULT_FIRST_MOVE'].date("F d, Y", $firstmove).".<br />";
		$html .= $lang['RESULT_HEART_BEAT'].date("F d, Y", $firstheartbeat).".<br />";
		$html .= $lang['RESULT_FIRST_TRIM_END'].date("F d, Y", $secondtrimester).".<br />";
		$html .= $lang['RESULT_SECOND_TRIM_END'].date("F d, Y", $thirdtrimester).".<br />";
	}
	
	echo $html;
} ?>