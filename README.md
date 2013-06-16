kingofthejungle/nette-opauth
============================


Requirements
------------

As it's an Opauth extension for Nette framework, it requires

- [Nette Framework 2.0.x](https://github.com/nette/nette)
- [Opauth](https://github.com/opauth/opauth)



Installation
------------

It's still in beta so it's not packagist package, so update composer.json with
```json
 "repositories": [
     { "type": "vcs", "url": "http://github.com/kingofthejungle/nette-opauth" }
 ],
 "require": {
     "kingofthejungle/nette-opauth": "*"
 },
```
and then

```sh
$ composer update
```

```php
// add compiler extension
$configurator->onCompile[] = function (Configurator $config, Compiler $compiler) {
    $compiler->addExtension('opauth', new NetteOpauth\DI\Extension());
};

// register routers
\NetteOpauth\NetteOpauth::register($container->router);
```

Configure in config.neon
------------
```
opauth:
	path: '/auth/'
	debug: true
	callback_url: '{path}callback'
	security_salt: '123abc456def'
	debug: true
	Strategy: [
		Facebook: [
			app_id: ''
			app_secret: ''
		],
		Google: [
			client_id: ''
			client_secret: ''
		],
		Twitter: [
			key: '',
			secret: ''
		]
	]
```

Roadmap
-------
- [ ] add more identities for various providers

