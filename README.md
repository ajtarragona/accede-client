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
Funció | Paràmetres | Retorn 
--- | --- | --- 
*getTercerById* | `id`: codi del tercer| Un objecte `Tercer` 
*searchTercersByName* | `name`: que contingui el nom del tercer | Un array d'objectes `Tercer`
*searchTercersBySurname1* | `surname`: que contingui el primer cognom del tercer | Un array d'objectes `Tercer`
*searchTercersBySurname2* | `surname`: que contingui el segon cognom del tercer | Un array d'objectes `Tercer`
*searchTercersBySurnames* | `surname1`: que contingui el primer cognom del tercer<br/>`surname2`: que contingui el segon cognom del tercer | Un array d'objectes `Tercer`
*searchTercersByFullName* | `filter`: que es contingui a nom o cognoms | Un array d'objectes `Tercer`
*getTercerByPasaporte* | `pasaporte`: que el passaport sigui igual | Un array d'objectes `Tercer`
*getTercerByTarjetaResidencia* | `tresidencia`: que la tarjeta sigui igual | Un array d'objectes `Tercer`
*getTercerByCIF* | `cif`: que el cif sigui igual | Un array d'objectes `Tercer`
*getTercerByDNI* | `dni`: que el dni sigui igual | Un array d'objectes `Tercer`
*getTercerByNIF* | `nif`: que el cif sigui igual | Un array d'objectes `Tercer`
*createTercer* | `tercer`: objecte tercer | boolea
*updateTercer* | `tercer`: objecte tercer | boolea
*deleteTercer* | `id`: codi del tercer | boolea

> En tots els casos es retorna una excepció si falla o no es troba res.


### AccedeVialer
Funció | Paràmetres | Retorn 
--- | --- | --- 
*getPais* | `codigoPais` | Un objecte `Pais`
*getAllPaisos* | | Un array d'objectes `Pais`
*searchPaisosByName* | `filter` | Un array d'objectes `Pais` el nom dels quals contingui el filtre passat. És insensible a majúscules <br> > busqueda exacta
*getProvincia* | `codigoProvincia` |
*getAllProvincies* | |
*searchProvinciesByName* | `filter` |
*getMunicipi* | `codigoMunicipio`<br/>`codigoProvincia=false` |
*getAllMunicipis* | `codigoProvincia=false` |
*searchMunicipisByName* | `filter`<br/>`codigoProvincia=false` |
*getPortal* | `codigoPortal` |
*getAllPortals* | |
*getPorta* | `codigoPuerta` |
*getAllPortes* | |
*getPlanta* | `codigoPlanta` |
*getAllPlantes* | |
*getEscala* | `codigoEscalera` |
*getAllEscales* | |
*getAllBlocs* |  `codiProvincia=false`<br/>`codiMunicipi=false` |
*getBloc* | `codigoBloque` |
*getAllCodisPostals* | `codiProvincia=false`<br/> `codiMunicipi=false` |
*getCodiPostal* | `codigoPostal`<br/> `codiProvincia=false`<br/> `codiMunicipi=false` |
*searchViesByName* | `filter`<br/> `codiProvincia=false`<br/> `codiMunicipi=false` |
*getAllVies* | `codiProvincia=false`<br/> `codiMunicipi=false` |
*getAllTipusVia* | `codiProvincia=false`<br/> `codiMunicipi=false` |
*getTipusVia* |  `codigoTipoVia` |
*searchDomicilis* | `params=[]` |
*getDomicilisByVia* | `codiVia`<br/>`numeroDesde=false`<br/>`numeroHasta=false` |
