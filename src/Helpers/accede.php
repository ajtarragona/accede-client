<?php

if (! function_exists('accede')) {
	function accede($options=false){
		return new \Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider($options);
	}
}