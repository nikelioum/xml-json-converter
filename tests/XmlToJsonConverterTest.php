<?php

use PHPUnit\Framework\TestCase;
use Dliaropoulos\XmlJsonConverter\XmlToJsonConverter;

class XmlToJsonConverterTest extends TestCase
{
    public function testConvertValidXml()
    {
        $xml = '<note><to>User</to><from>Me</from></note>';
        $json = XmlToJsonConverter::convert($xml);

        $this->assertJson($json);
        $this->assertStringContainsString('"to": "User"', $json);
        $this->assertStringContainsString('"from": "Me"', $json);
    }

    public function testConvertInvalidXmlThrowsException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Failed to parse XML');

        $invalidXml = '<note><to>User</from></note>'; // malformed XML
        XmlToJsonConverter::convert($invalidXml);
    }
}
