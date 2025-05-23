<?php

namespace Dliaropoulos\XmlJsonConverter;

class JsonToXmlConverter
{
    /**
     * Convert a JSON string to an XML string.
     *
     * @param string $json The input JSON string.
     * @param array $excludeKeys Keys to exclude from the output.
     * @param string|null $rootElement Custom root element name. If null, will use top-level key.
     * @return string The XML output.
     * @throws \Exception if the JSON is invalid.
     */
    public static function convert(string $json, array $excludeKeys = [], ?string $rootElement = 'root'): string
    {
        $array = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON: ' . json_last_error_msg());
        }

        // Determine root element
        if ($rootElement === null && count($array) === 1 && is_array(reset($array))) {
            $firstKey = array_key_first($array);
            $xml = new \SimpleXMLElement("<$firstKey/>");
            self::arrayToXml($array[$firstKey], $xml, $excludeKeys);
        } else {
            $xml = new \SimpleXMLElement("<{$rootElement}/>");
            self::arrayToXml($array, $xml, $excludeKeys);
        }

        return $xml->asXML();
    }

    /**
     * Recursive method to convert an array to XML, skipping excluded keys.
     *
     * @param array $data
     * @param \SimpleXMLElement $xmlElement
     * @param array $excludeKeys
     */
    private static function arrayToXml(array $data, \SimpleXMLElement &$xmlElement, array $excludeKeys = []): void
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $excludeKeys)) {
                continue; // skip excluded keys
            }

            $tag = is_numeric($key) ? "item" : preg_replace('/[^a-z0-9\-_]/i', '', $key);

            if (is_array($value)) {
                $child = $xmlElement->addChild($tag);
                self::arrayToXml($value, $child, $excludeKeys);
            } else {
                $xmlElement->addChild($tag, htmlspecialchars((string) $value));
            }
        }
    }
}
