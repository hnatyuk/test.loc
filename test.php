<?php
$string ="Hello world"
$closure = function() use ($string) {
	echo $string;
};