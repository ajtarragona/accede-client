<?php

return [
	
	'debug' => env('ACCEDE_DEBUG',false),
	"token_key" => env('ACCEDE_TOKEN_KEY','***') ,
	"ws_url" => env('ACCEDE_WS_URL','***'),
	"ws_sec_user" => env('ACCEDE_USER',"***"),
	"ws_sec_pwd" => env('ACCEDE_PASSWORD',"***"),
	"ws_sec_cli" => env('ACCEDE_CLIENT',"***"),
	"ws_sec_ent" => env('ACCEDE_ENTITY',0),
	"ws_sec_org" => env('ACCEDE_ORGANISM',0),
	"codigo_pais_espana" => 108,
	"codigo_provincia_tarragona" => 43,
	"codigo_municipio_tarragona" => 148,
	"backend" => env('ACCEDE_BACKEND',false),
	
];

