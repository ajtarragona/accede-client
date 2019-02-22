# ACCEDE (Tercers i Vialer) Client for Laravel 5.6


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
php artisan vendor:publish --tag=ajtarragona-accede-config
```

Això copiarà l'arxiu a `config/accede.php`.

Publicar configuració Laroute
php artisan vendor:publish --provider='Lord\Laroute\LarouteServiceProvider'
posar rutes absolutes a app/config/laroute.php
Publicar scripts laroute cada vegada que canviem una ruta
php artisan laroute:generate




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
	'AccedeTercers' => Ajtarragona\Accede\Facades\AccedeTercers::class,
	'AccedeVialer' => Ajtarragona\Accede\Facades\AccedeVialer::class
]

```

### Vía Injecció de dependències:

Als teus controlladors, helpers, model:

```php
use Ajtarragona\Accede\Models\AccedeTercersProvider;
use Ajtarragona\Accede\Models\AccedeVialerProvider;
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


## Funcions

### AccedeTercers
Funció | Paràmetres | Retorn 
--- | --- | --- 
**getTercerById** | `id`: codi del tercer| Un objecte `Tercer` 
**searchTercersByName** | `name`: que contingui el nom del tercer | Un array d'objectes `Tercer`
**searchTercersBySurname1** | `surname`: que contingui el primer cognom del tercer | Un array d'objectes `Tercer`
**searchTercersBySurname2** | `surname`: que contingui el segon cognom del tercer | Un array d'objectes `Tercer`
**searchTercersBySurnames** | `surname1`: que contingui el primer cognom del tercer<br/>`surname2`: que contingui el segon cognom del tercer | Un array d'objectes `Tercer`
**searchTercersByFullName** | `filter`: que es contingui a nom o cognoms | Un array d'objectes `Tercer`
**getTercerByPasaporte** | `pasaporte`: que el passaport sigui igual | Un array d'objectes `Tercer`
**getTercerByTarjetaResidencia** | `tresidencia`: que la tarjeta sigui igual | Un array d'objectes `Tercer`
**getTercerByCIF** | `cif`: que el cif sigui igual | Un array d'objectes `Tercer`
**getTercerByDNI** | `dni`: que el dni sigui igual | Un array d'objectes `Tercer`
**getTercerByNIF** | `nif`: que el cif sigui igual | Un array d'objectes `Tercer`
**getDomicilisTercer** | `id`: codi del tercer | Array d'objectes `Domicili`
**createTercer** | `tercer`: objecte tercer | boolea
**updateTercer** | `tercer`: objecte tercer | boolea
**deleteTercer** | `id`: codi del tercer | boolea

> En tots els casos es retorna una excepció si falla o no es troba res.


### AccedeVialer
Funció | Paràmetres | Retorn 
--- | --- | --- 
**getPais** | `codigoPais` | Un objecte `Pais`
**getAllPaisos** | | Un array d'objectes `Pais`
**searchPaisosByName** | `filter` | Un array d'objectes `Pais` el nom dels quals sigui igual al filtre passat. <br/><small>És insensible a majúscules</small> <br> <small>Busqueda exacta</small>
**getProvincia** | `codigoProvincia` | Un objecte `Provincia` segons el codi passat
**getAllProvincies** | | Un array d'objectes `Provincia`
**searchProvinciesByName** | `filter` | Un array d'objectes `Provincia`  el nom dels quals sigui igual al filtre passat. <br/><small>És insensible a majúscules</small> <br> <small>Busqueda exacta</small>
**getMunicipi** | `codigoMunicipio`<br/>`codigoProvincia=false` |
**getAllMunicipis** | `codigoProvincia=false` |
**searchMunicipisByName** | `filter`<br/>`codigoProvincia=false` |
**getPortal** | `codigoPortal` |
**getAllPortals** | |
**getPorta** | `codigoPuerta` |
**getAllPortes** | |
**getPlanta** | `codigoPlanta` |
**getAllPlantes** | |
**getEscala** | `codigoEscalera` |
**getAllEscales** | |
**getAllBlocs** |  `codiProvincia=false`<br/>`codiMunicipi=false` |
**getBloc** | `codigoBloque` |
**getAllCodisPostals** | `codiProvincia=false`<br/> `codiMunicipi=false` |
**getCodiPostal** | `codigoPostal`<br/> `codiProvincia=false`<br/> `codiMunicipi=false` |
**getCodisPostalsVia** | `codigoIneVia`<br/> `numero=false` |
**searchViesByName** | `filter`<br/> `codiProvincia=false`<br/> `codiMunicipi=false` |
**getAllVies** | `codiProvincia=false`<br/> `codiMunicipi=false` |
**getVia** | `codigoIneVia` |
**getAllTipusVia** |  |
**getTipusVia** |  `codigoTipoVia` |
**searchDomicilis** | `params=[]` |
**getDomicilisByVia** | `codiVia`<br/>`numeroDesde=false`<br/>`numeroHasta=false` |

> En tots els casos es retorna una excepció si falla o no es troba res.


## API Json
```php

	//Paisos

	/ajtarragona/accede/api/paisos
	/ajtarragona/accede/api/paisos/{codigoPais}
	
	//Provincies
	/ajtarragona/accede/api/provincies
	/ajtarragona/accede/api/provincies/{codigoProvincia}
	
	//Municipis
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis/{codigoMunicipio}


	//Vies
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/search/{filter}
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/combo
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies
	/ajtarragona/accede/api/provincies/{codigoProvincia}/municipis/{codigoMunicipio}/vies/{codigoIneVia}


	//Numeros de la via
	/ajtarragona/accede/api/numeros/combo/{codigoIneVia}
	/ajtarragona/accede/api/numeros/{codigoIneVia}

	//Blocs de la via
	/ajtarragona/accede/api/blocs/combo/{codigoIneVia}
	/ajtarragona/accede/api/blocs/{codigoIneVia}

	//Escales de la via
	/ajtarragona/accede/api/escales/combo/{codigoIneVia}/{numero?}
	/ajtarragona/accede/api/escales/{codigoIneVia}/{numero?}

	//Lletres de la via
	/ajtarragona/accede/api/lletres/combo/{codigoIneVia}/{numero?}
	/ajtarragona/accede/api/lletres/{codigoIneVia}/{numero?}

	//Plantes de la via
	/ajtarragona/accede/api/plantes/combo/{codigoIneVia}/{numero?}
	/ajtarragona/accede/api/plantes/{codigoIneVia}/{numero?}

	//Codis postals de la via
	/ajtarragona/accede/api/codispostals/combo/{codigoIneVia}/{numero?}
	/ajtarragona/accede/api/codispostals/{codigoIneVia}/{numero?}
	
	//Portes de la via
	/ajtarragona/accede/api/portes/combo/{codigoIneVia}/{numero?}/{nombrePlanta?}
	/ajtarragona/accede/api/portes/{codigoIneVia}/{numero?}/{nombrePlanta?}
```

## Component Web

```bash
php artisan vendor:publish --tag=ajtarragona-accede-assets --force
```
