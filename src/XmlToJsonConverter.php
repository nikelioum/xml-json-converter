<?php

namespace Dliaropoulos\XmlJsonConverter;

class XmlToJsonConverter
{
    /**
     * Convert an XML string to a JSON string.
     *
     * @param string $xml The input XML string.
     * @return string The JSON output.
     * @throws \Exception if the XML is invalid or cannot be parsed.
     */
    public static function convert(string $xml): string
    {
        libxml_use_internal_errors(true);

        $xmlElement = simplexml_load_string($xml);

        if ($xmlElement === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new \Exception('Failed to parse XML: ' . ($errors[0]->message ?? 'Unknown error'));
        }

        $json = json_encode($xmlElement, JSON_PRETTY_PRINT);

        if ($json === false) {
            throw new \Exception('Failed to encode JSON.');
        }

        return $json;
    }
}
