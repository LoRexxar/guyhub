<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

function check_isnull($val)
{
	if ($val === '') {
		return 1;
	}
}
function check_key($val = array(), $k = array())
{
	foreach ($k as $value) {
		if (! isset($val[$value])) {
			return "$k not set!";
		}
	}
	return 0;
}
