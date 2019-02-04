# ACCEDE (Tercers i Vialer) Client for Laravel 5.6

## Accede-Tercers

Paquet d'accés al WS de Accede (Aytos) per a Tercers i vialer


## Installation

```bash
composer require ajtarragona/accede-tercers:"@dev"
```

## Alias

For a simpler use of this package, you may register the alias in the alias array in your `config/app.php` file adding:

```php
'AccedeTercers' => Ajtarragona\AccedeTercers\Facades\AccedeTercers::class
```

## Configuration

You should config the module via your .env file. Theese are the available parameters:
```bash
ACCEDE_TOKEN_KEY 
ACCEDE_WS_URL 
ACCEDE_USER 
ACCEDE_PASSWORD 
ACCEDE_CLIENT 
ACCEDE_ENTITY 
ACCEDE_ORGANISM 
```

Also, you may publish the configuration file.

```bash
php artisan vendor:publish --tag=ajtarragona-accede-tercers
```

This will copy the configuration file to `config/accede-tercers.php`.



## Usage

After the configuration, the package will we ready to use. You can use it via Facade:

```bash
use AccedeTercers;
...
public function test(){
	$vies=AccedeTercers::getAllVies();
	...
}
```

Or via dependency injection in your controllers, helpers o model:

```bash
use Ajtarragona\AccedeTercers\Models\Accede\AccedeTercersProvider;
...
public function test(AccedeTercersProvider $accede){
	$vies=$accede->getAllVies();
	...
}
```