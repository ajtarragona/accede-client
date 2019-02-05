# ACCEDE (Tercers i Vialer) Client for Laravel 5.6

## Accede-Client

Paquet d'accés al WS de Accede (Aytos) per a **Tercers** i **Vialer**


## Instalació

```bash
composer require ajtarragona/accede-client:"@dev"
```

## Configuració

Pots configurar el paquet a través de l'arxiu `.env` de l'aplicació. Aquests son els parámetres disponibles :
```bash
ACCEDE_TOKEN_KEY 
ACCEDE_WS_URL 
ACCEDE_USER 
ACCEDE_PASSWORD 
ACCEDE_CLIENT 
ACCEDE_ENTITY 
ACCEDE_ORGANISM 
```
Alternativament, pots publicar l'arxiu de configuració del paquet amb la comanda:

```bash
php artisan vendor:publish --tag=ajtarragona-accede
```

Això copiarà l'arxiu a `config/accede.php`.



## Ús

Un cop configurat, el paquet està a punt per fer-se servir. 

Ho pots fer de les següents maneres:

### A través d'una `Facade`:

```php
use AccedeTercers;
use AccedeVialer;
...
public function test(){
	$tercer=AccedeTercers::getTercerById(123456);
	$vies=AccedeVialer::getAllVies();
	...
}
```
En aquest cas, per facilitar-ne l'ús, es pot registrar l'alias de la Facade a l'arxiu `config/app.php` :

```php
'aliases' => [
	...
	'AccedeTercers' => Ajtarragona\AccedeTercers\Facades\AccedeTercers::class,
	'AccedeVialer' => Ajtarragona\AccedeTercers\Facades\AccedeVialer::class
]

```

### Vía Injecció de dependències:

Als teus controlladors, helpers, model:

```php
use Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;
use Ajtarragona\AccedeTercers\Models\Accede\AccedeVialerProvider;
...
public function test(AccedeTercersProvider $accedetercers, AccedeVialerProvider $accedevialer){
	$tercer=$accedetercers->getTercerById(123456);
	$vies=$accedevialer->getAllVies();
	...
}
```

### Vía funció `helper`:
```php
...
public function test(){
	$tercer=accedetercers()->getTercerById(123456);
	$vies=accedevialer()->getAllVies();
	...
}
```


## Funcions:

### AccedeTercers
##### getTercerById
Funció | Paràmetres | Retorn 
--- | --- | --- 
*getTercerById($id)* | `id`: codi del tercer| Un objecte `Tercer` .
*searchTercersByName($name)* | `name`: nom del tercer (que contingui) | Un array d'objectes `Tercer`
*searchTercersBySurname1($surname)* | `surname`: primer cognom del tercer (que contingui) | Un array d'objectes `Tercer`
*searchTercersBySurname2($surname)* | `surname`: segon cognom del tercer (que contingui) | Un array d'objectes `Tercer`
*searchTercersBySurnames($surname1, $surname2)* | `surname1`: primer cognom del tercer (que contingui) \\ `surname2`: segon cognom del tercer (que contingui)  | Un array d'objectes `Tercer`

> En tots els casos es retorna una excepció si falla o no es troba res.



```php
	getTercerById($id)
	searchTercersByName($name)
	searchTercersBySurname1($surname)
	searchTercersBySurname2($surname)
	searchTercersBySurnames($surname1, $surname2)
	searchTercersByFullName($filter)
	getTercerByPasaporte($pasaporte)
	getTercerByTarjetaResidencia($tresidencia)
	getTercerByCIF($cif)
	getTercerByDNI($dni)
	getTercerByNIF($nif)
	getDomicilisTercer($id)
	createTercer($tercer)
	updateTercer($tercer)
	deleteTercer($id)
```

### AccedeVialer
```php
	getPais($codigoPais)
	getAllPaisos()
	searchPaisosByName($filter)
	getProvincia($codigoProvincia)
	getAllProvincies()
	searchProvinciesByName($filter)
	getMunicipi($codigoMunicipio,$codigoProvincia=false)
	getAllMunicipis($codigoProvincia=false)
	searchMunicipisByName($filter,$codigoProvincia=false)
	getPortal($codigoPortal)
	getAllPortals( )
	getPorta($codigoPuerta) 
	getAllPortes( ) 
	getPlanta($codigoPlanta)
	getAllPlantes( )
	getEscala($codigoEscalera)
	getAllEscales( ) 
	getAllBlocs($codiProvincia=false, $codiMunicipi=false)
	getBloc($codigoBloque)
	getAllCodisPostals($codiProvincia=false, $codiMunicipi=false)
	getCodiPostal($codigoPostal, $codiProvincia=false, $codiMunicipi=false)
	searchViesByName($filter, $codiProvincia=false, $codiMunicipi=false )
	getAllVies($codiProvincia=false, $codiMunicipi=false )
	getAllTipusVia($codiProvincia=false, $codiMunicipi=false ) 
	getTipusVia($codigoTipoVia)
	searchDomicilis($params=[])
	getDomicilisByVia($codiVia,$numeroDesde=false,$numeroHasta=false)
```