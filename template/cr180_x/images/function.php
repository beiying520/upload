<?php
/**
 *      [Discuz!-cr180]
 *
 *      
 */
$mod = $_GET['mod'];
if($mod =='forumlist'){
	
	define('APPTYPEID', 180);
	define('CURSCRIPT', 'cr180');
	require './../../../source/class/class_core.php';
	$discuz = & discuz_core::instance();
	$discuz->cachelist = $cachelist;
	$discuz->init();
	if(!isset($_G['cache']['forums'])) {
		loadcache('forums');
	}
	$forumcache = &$_G['cache']['forums'];
	
	foreach($forumcache as $key => $value){
		if(!$value['status']) unset($forumcache[$key]);
	}
	
	include template('common/cr180_forum_list');
	
}elseif(!defined('IN_DISCUZ')) {
	exit('Access Deined');
}

function cr180fidthreaddata($fid){
	$fid = intval($fid);
	if($fid){
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE fid='".$fid."' AND displayorder >=0 ORDER BY dateline DESC LIMIT 5");
		while($value = DB::fetch($query)){
			$data[$value['tid']] = $value;
		}
	}
	return $data;
}
function cr180forumdisplaydata($dt=array()){
	$data = $tids = array();
	foreach($dt as $value){
		$tids[] = intval($value['tid']);
	}
	require_once libfile('function/discuzcode');
	$query = DB::query("SELECT tid, message FROM ".DB::table('forum_post')." WHERE first=1 AND tid IN(".dimplode($tids).")");

	while($value = DB::fetch($query)){
		$data[$value['tid']] = cr180_messagegetstr($value['message'], 200);
	}
	
	return $data;
}
function cr180_messagegetstr($string, $length) {
	global $_G;
	$string = trim(strip_tags($string));
	$string = preg_replace(array(
	"/\[hide=?\d*\](.*?)\[\/hide\]/i",
	"/\[img]([\s\S]*?)\[\/img\]/ie",
	"/\[url]([\s\S]*?)\[\/url\]/i",
	"/\[attachimg]([\s\S]*?)\[\/attachimg\]/i",
	"/\[attach]([\s\S]*?)\[\/attach\]/i",
	),'cr180_messagefilterstr("\\1")', $string);
	$string = dhtmlspecialchars($string);
	$string = preg_replace("/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", ' ', $string);
	if($length) {
		$string = cutstr($string, $length);
	}
	return trim($string);

}

function cr180_messagefilterstr($string) {
	global $_G;
	$search = array(
	"/<script[^>]*?>.*?</script>/is",
	"/<[/!]*?[^<>]*?>/is",
	"/([rn])[s]+/",
	"/&(quot|#34);/i",
	"/&(amp|#38);/i",
	"/&(lt|#60);/i",
	"/&(gt|#62);/i",
	"/&(nbsp|#160);/i",
	"/&(iexcl|#161);/i",
	"/&(cent|#162);/i",
	"/&(pound|#163);/i",
	"/&(copy|#169);/i",
	);
	$replace = array ("", "", "1", "", "&", "<", ">", " ", chr(161), chr(162), chr(163), chr(169));
	$string = preg_replace($search, $replace, $string);
	return $string;
	
}

?>
