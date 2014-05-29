<?php
function includeModules($arr){
	foreach ($arr as $value) {
		include_once 'include/'.$value.'/php';
	}
}

function includeLogic($x){
    include_once './application/logic/' . $x . '.php';
}

function includeView($x){
    include_once './application/view/' . $GLOBALS['app_setting']["header"] . '.php';
    include_once './application/view/' . $x . '.php';
    include_once './application/view/' . $GLOBALS['app_setting']["footer"] . '.php';
}