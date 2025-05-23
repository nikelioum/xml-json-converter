<?php

use PHPUnit\Framework\TestCase;
use Dliaropoulos\XmlJsonConverter\Converter;

class ConverterTest extends TestCase
{
    public function testXmlToJsonAndBack()
    {
        $xml = '<note><to>User</to><from>Me</from></note>';
        $json = Converter::xmlToJson($xml);

        $this->assertJson($json);
        $this->assertStringContainsString('"to": "User"', $json);

        $xmlBack = Converter::jsonToXml($json);
        $this->assertStringContainsString('<to>User</to>', $xmlBack);
    }
}
