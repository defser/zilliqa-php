# Zilliqa-PHP

is a typed PHP-7.1+ interface to [Zilliqa JSON-RPC API](https://dev.zilliqa.com/docs/apis/api-introduction).

Check out the latest [API documentation](https://dev.zilliqa.com/).

Add library in a [composer.json](https://getcomposer.org/doc/01-basic-usage.md) file

```yaml
{
  "minimum-stability":"dev",
  "autoload": {
    "psr-4": {
      "Zilliqa\\": "src/"
    }
  },
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/defser/zilliqa-php.git"
    }
  ],
  "require": {
    "defser/zilliqa-php": "dev-master"
  }
}
```

### Usage


```sh
composer require defser/zilliqa-php
```

![architecture diagram](./architecture-diagramm.png "Zilliqa architecture")

### Documentation

The API documentation is available at [zilliqa-php.org](http://zilliqa-php.org/).

For reference see the [Zilliqa RPC documentation](https://dev.zilliqa.com/docs/apis/api-introduction/).