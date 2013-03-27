Allow Bots MediaWiki Extension
==============================

This extension allows to open up an access to a private mediawiki based on a IP and optionally a User-Agent string. This is especially useful if you're hosting a private Wiki installation within a corporate environment and you require all users to be authenticated, but you still want the Wiki to be accessible by an internal Search Engine (like [GSA](http://www.google.com/enterprise/search/) or [SearchBlox](http://www.searchblox.com/)).

## Installation

1. Download or checkout this repository into the extensions folder of your MediaWiki installation.
2. Add the following line to the `LocalSettings.php` file:

        require_once $IP . '/extensions/AllowBots/AllowBots.php';
    
3. Define which IPs/User-Agents you want to let through without authentication (see [Configuration](#configuration) below).


## Configuration

> **IMPORTANT NOTE**  
> Make sure that you load this extension **after** the default `$wgGroupPermissions` are set in your `LocalSettings.php` file.  
> Also be aware, that this extension doesn't use any hooks and therefore it is executed as soon as it is loaded (step 2 in the [installation](#installation)). This means that all the configuration settings have to be provided **above** the `require_once` command.

### $wgBotsIPs

The extensions uses `$wgBotsIPs` array to store the IPs which are allowed to access the Wiki without authentication. To add an IP simply add it as an array element:

```php
$wgBotsIPs[] = '12.34.56.78';
```

### $wgBotsCheckUA

If you additionally want to check the User-Agent string of the client you have to enable it by setting `$wgBotsCheckUA` to `true` and provide the IP as the array key and the User-Agent string as the value, e.g.:

```php
$wgBotsCheckUA = true;
$wgBotsIPs['12.34.56.78'] = 'A Crawler User-Agent String';
```

> **NOTE**  
> The User-Agent string is not checked for a perfect match, but using the [strpos() function](http://php.net/strpos), which means you can provide only a partial User-Agent string (e.g. without a software version number).

### $wgBotsEnforceSkin

If you want to enforce a particular MediaWiki Skin to be used when accessed by the Bot you can use `$wgBotsEnforceSkin` to replace the default skin used, e.g.:

```php
$wgBotsEnforceSkin = 'noCssSkin';
```


## Usage Example

```php
// AllowBots Extension
$wgBotsCheckUA = true;
$wgBotsEnforceSkin = 'noCssSkin';
$wgBotsIPs['12.34.56.78'] = 'A Crawler User-Agent String';
$wgBotsIPs['12.34.56.79'] = 'A Crawler User-Agent String';
require_once $IP . '/extensions/AllowBots/AllowBots.php';
```

## Compatibility

Although the extensions has only been tested on MediaWiki 1.16 it should be working just fine with newer versions, too.
