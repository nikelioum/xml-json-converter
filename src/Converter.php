<?php

namespace Dliaropoulos\XmlJsonConverter;

class Converter
{
    /**
     * Convert XML string to JSON string.
     *
     * @param string $xml
     * @return string
     * @throws \Exception
     */
    public static function xmlToJson(string $xml): string
    {
        return XmlToJsonConverter::convert($xml);
    }

    /**
     * Convert JSON string to XML string.
     *
     * @param string $json
     * @return string
     * @throws \Exception
     */
    public static function jsonToXml(string $json): string
    {
        return JsonToXmlConverter::convert($json);
    }
}
