<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_cr180_x {

	function common() {
		global $_G;
		$_G['cr180x'] = $_G['cache']['plugin']['cr180_x'];
		$_G['cr180x']['forum_view_endyestyle'] = unserialize($_G['cr180x']['forum_view_endyestyle']);
		$_G['cr180x']['forum_view_newsstyle'] = unserialize($_G['cr180x']['forum_view_newsstyle']);
		$_G['cr180x']['forum_list_style'] = unserialize($_G['cr180x']['forum_list_style']);
		$_G['cr180x']['forum_displaystyle'] = unserialize($_G['cr180x']['forum_displaystyle']);
		return $_G['cr180x'];
	}
}
function cr180_dnumber($number) {
	return abs($number) > 10000 ? '<span title="'.$number.'">'.intval($number / 10000).'<em>'.lang('core', '10k').'</em></span>' : $number;
}
?>