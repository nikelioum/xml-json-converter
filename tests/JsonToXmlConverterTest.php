<?php

use PHPUnit\Framework\TestCase;
use Dliaropoulos\XmlJsonConverter\JsonToXmlConverter;

class JsonToXmlConverterTest extends TestCase
{
    public function testConvertValidJson()
    {
        $json = '{"to":"User","from":"Me"}';
        $xml = JsonToXmlConverter::convert($json);

        $this->assertStringContainsString('<to>User</to>', $xml);
        $this->assertStringContainsString('<from>Me</from>', $xml);
    }

    public function testConvertInvalidJsonThrowsException()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid JSON');

        $invalidJson = '{"to":"User", "from":}'; // malformed JSON
        JsonToXmlConverter::convert($invalidJson);
    }
}
