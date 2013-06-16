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
$configurator->onCompile[] = function (Configurator $config, Compiler $compiler) {
    $compiler->addExtension('opauth', new NetteOpauth\DI\Extension());
};
```

Roadmap
-------
- [ ] add more identities for various providers

