kingofthejungle/nette-opauth
============================

Requirements
------------

As it's an Opauth extension for Nette framework, it requires

- [Nette Framework 2.0.x](https://github.com/nette/nette)
- [Opauth](https://github.com/opauth/opauth)

Installation
------------

It's still in beta and still not a packagist package. Update composer.json:
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
$configurator->onCompile[] = function (\Nette\Config\Configurator $config, \Nette\Config\Compiler $compiler) {
	$compiler->addExtension('opauth', new NetteOpauth\DI\Extension());
};

// register routers
\NetteOpauth\NetteOpauth::register($container->router);
```
and update Auth presenter as shown in examples.

Then you can use:
```html
{if Nette\Config\Configurator::detectDebugMode()}
	<a href="{plink Auth:callback, strategy => 'fake'}">Fake login</a><br/>
{/if}
<a href="{plink Auth:google}">Sign-in with Google</a><br/>
<a href="{plink Auth:facebook}">Sign-in with Facebook</a><br/>
<a href="{plink Auth:twitter}">Sign-in with Twitter</a><br/>
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

