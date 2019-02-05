# ACCEDE (Tercers i Vialer) Client for Laravel 5.6

## Accede-Tercers

Paquet d'accés al WS de Accede (Aytos) per a Tercers i vialer


## Instalació

```bash
composer require ajtarragona/accede-tercers:"@dev"
```

## Configuració

Pots configurar el paquet a través de l'arxiu .env de l'aplicació. Aquests son els parámetres disponibles :
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
php artisan vendor:publish --tag=ajtarragona-accede-tercers
```

Això copiarà l'arxiu a `config/accede-tercers.php`.



## Ús

Un cop configurat, el paquet està a punt per fer-se servir. 

Ho pots fer de les següents maneres:

### A través d'una `Facade`:

```bash
use AccedeTercers;
...
public function test(){
	$vies=AccedeTercers::getAllVies();
	...
}
```
En aquest cas caldria, per au n ús més simple, pots registrar l'alias de la Facade a l'arxiu `config/app.php` :

```php
'AccedeTercers' => Ajtarragona\AccedeTercers\Facades\AccedeTercers::class
```

### Vía Injecció de dependències:

Als teus controlladors, helpers, model:

```bash
use Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;
...
public function test(AccedeTercersProvider $accede){
	$vies=$accede->getAllVies();
	...
}
```

### Vía funció `helper`:
```bash
...
public function test(AccedeTercersProvider $accede){
	$vies=accede()->getAllVies();
	...
}
```


## Funcions:

in progress...