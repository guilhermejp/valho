<?php

function justUcwords($text){
	$text = strtolower(convert_accented_characters($text));
	$text = ucwords($text);

	return $text;
}
?>