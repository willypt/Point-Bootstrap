<?php
function includeModules($arr){
	foreach ($arr as $value) {
		include_once 'include/'.$value.'/php';
	}
}