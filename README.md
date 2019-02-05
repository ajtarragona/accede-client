# ACCEDE (Tercers i Vialer) Client for Laravel 5.6

## Accede-Client

Paquet d'accés al WS de Accede (Aytos) per a **Tercers** i **Vialer**


## Instalació

```bash
composer require ajtarragona/accede-tercers:"@dev"
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

### Tercers
```php
	public function getTercerById($id){
	public function searchTercersByName($name){
	public function searchTercersBySurname1($surname){
	public function searchTercersBySurname2($surname){
	public function searchTercersBySurnames($surname1, $surname2){
	public function searchTercersByFullName($filter){
	public function getTercerByPasaporte($pasaporte){
	public function getTercerByTarjetaResidencia($tresidencia){
	public function getTercerByCIF($cif){
	public function getTercerByDNI($dni){
	public function getTercerByNIF($nif){
	public function getDomicilisTercer($id){
	public function getDomicilisByVia($codiVia,$numeroDesde=false,$numeroHasta=false) {	
	public function createTercer($tercer){
	public function updateTercer($tercer){}
	public function deleteTercer($id){}
```

### Vialer
```php
	public function searchViesByName($filter, $codiProvincia=false, $codiMunicipi=false ) {	
	public function getAllVies($codiProvincia=false, $codiMunicipi=false ) {	
```

## Objectes

### \Ajtarragona\Accede\Models\Beans\Tercer
```php
$codigoTercero;
$codigoTipoDocumento;
$nombreTipoDocumento;
$documento;
$nombre;
$apellido1;
$apellido2;
$telefono;
$usuarioAlta;
$fechaAlta;
$situacionTercero;
```

### \Ajtarragona\Accede\Models\Beans\Via
```php
$codigoVia;
$codigoIneVia;
$nombreVia;
$nombreLargoVia;
$nombreAntiguoVia;
$situacionVia;
$codigoTipoVia;
$nombreTipoVia;
$codigoIneEntidadColectiva;
$nombreEntidadColectiva;
$codigoIneEntidadSingular;
$nombreEntidadSingular;
$codigoIneNucleo;
$nombreNucleo;
```

### \Ajtarragona\Accede\Models\Beans\Domicili
```php
$codigoDomicilio;
$codigoDireccionSuelo;
$codigoTipoOcupacion;
$nombreTipoOcupacion;
$normalizadoDomicilio;
$codigoProvincia;
$nombreProvincia;
$codigoMunicipio;
$nombreMunicipio;
$codigoEntidadSingular;
$codigoIneEntidadSingular;
$nombreEntidadSingular;
$codigoNucleo;
$codigoIneNucleo;
$nombreNucleo;
$distrito;
$seccion;
$letraSeccion;
$codigoTipoVia;
$codigoIneTipoVia;
$nombreTipoVia;
$codigoVia;
$codigoIneVia;
$nombreVia;
$numeroDesde;
$codigoPlanta;
$nombrePlanta;
$codigoPuerta;
$codigoPostal;
$codigoTipoVivienda;
$nombreTipoVivienda;
$codigoTipoNumeracion;
$nombreTipoNumeracion;
$situacionTramo;
$cadenaDomicilio;
$cadenaDomicilioCompleta;
$usuarioAlta;
$fechaAlta;
```