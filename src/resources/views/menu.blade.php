
<div id="main-menu">

@nav([
	"navigation"=> 'drilldown',
	'class'=>'nav-dark',
	'fullwidth'=>true,
	"items"=> [
		[
			"title" => __('Vialer' ) ,
			"icon" => 'map-marker-alt',
			"route" => 'accede.home',
		],
		[
			"title" => __('Registre E/S' ) ,
			"icon" => 'book',
			"route" => 'accede.register.search',
		],
		[
			"title" => __('Domicilis' ) ,
			"icon" => 'map-marked',
			"route" => 'accede.domicili.search',
			"activeroute" => 'accede.domicili.*'
		],
		[
			"title" => __('Tercers' ) ,
			"icon" => 'users',
			"route" => 'accede.tercer.search',
			"activeroute" => 'accede.tercer.*'
		],
	]
	
])

</div>