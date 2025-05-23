# XML-JSON Converter

A simple PHP library to convert XML to JSON and JSON to XML easily.  
Supports PSR-4 autoloading and works with any PHP project using Composer.

## Installation

Require the package via Composer:

```bash
composer require dliaropoulos/xml-json-converter
```


## Installation Usage

require 'vendor/autoload.php';

## Usage

```php
require 'vendor/autoload.php';

use Nikelioum\XmlJsonConverter\JsonToXmlConverter;
use Nikelioum\XmlJsonConverter\XmlToJsonConverter;

// Convert JSON to XML
$json = '{"name": "John", "age": 30}';

$converter = new JsonToXmlConverter();
$xml = $converter->convert($json);

echo $xml;

echo "\n----------------\n";

// Convert XML to JSON
$xml = '<person><name>John</name><age>30</age></person>';

$converter = new XmlToJsonConverter();
$json = $converter->convert($xml);

echo $json;
