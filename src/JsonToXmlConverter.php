<?php

namespace Dliaropoulos\XmlJsonConverter;

class JsonToXmlConverter
{
    /**
     * Convert a JSON string to an XML string.
     *
     * @param string $json The input JSON string.
     * @return string The XML output.
     * @throws \Exception if the JSON is invalid.
     */
    public static function convert(string $json): string
    {
        $array = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON: ' . json_last_error_msg());
        }

        $xml = new \SimpleXMLElement('<root/>');
        self::arrayToXml($array, $xml);

        return $xml->asXML();
    }

    /**
     * Helper recursive method to convert an array to XML.
     *
     * @param array $data The input array.
     * @param \SimpleXMLElement $xmlElement The XML element to append data to.
     */
    private static function arrayToXml(array $data, \SimpleXMLElement &$xmlElement): void
    {
        foreach ($data as $key => $value) {
            $key = is_numeric($key) ? "item$key" : preg_replace('/[^a-z0-9\-_]/i', '', $key);

            if (is_array($value)) {
                $child = $xmlElement->addChild($key);
                self::arrayToXml($value, $child);
            } else {
                $xmlElement->addChild($key, htmlspecialchars((string) $value));
            }
        }
    }
}
