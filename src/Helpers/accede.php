<?php

if (! function_exists('accedetercers')) {
	function accedetercers($options=false){
		return new \Ajtarragona\Accede\Models\AccedeTercersProvider($options);
	}
}

if (! function_exists('accedevialer')) {
	function accedevialer($options=false){
		return new \Ajtarragona\Accede\Models\AccedeVialerProvider($options);
	}
}