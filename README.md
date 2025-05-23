# XML-JSON Converter

A simple PHP library to convert XML to JSON and JSON to XML easily.  
Supports PSR-4 autoloading and works with any PHP project using Composer.

## Installation

Require the package via Composer:

```bash
composer require nikelioum/xml-json-converter:dev-main --with-all-dependencies

```


## Usage

require 'vendor/autoload.php';




```php
require 'vendor/autoload.php';

use Nikelioum\XmlJsonConverter\JsonToXmlConverter;
use Nikelioum\XmlJsonConverter\XmlToJsonConverter;

function convertJsonToXml(): string
{
    $json = '{"name": "John", "age": 30}';

    $jsonToXml = new JsonToXmlConverter();
    $xml = $jsonToXml->convert($json);

    return $xml;
}

function convertXmlToJson(): string
{
    $xmlInput = '<person><name>John</name><age>30</age></person>';

    $xmlToJson = new XmlToJsonConverter();
    $json = $xmlToJson->convert($xmlInput);

    return $json;
}

// Example usage:
$xmlOutput = convertJsonToXml();
$jsonOutput = convertXmlToJson();

// You can now return these in an API response, save to file, etc.
