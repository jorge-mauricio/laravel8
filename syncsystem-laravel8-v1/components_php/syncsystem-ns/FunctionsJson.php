<?php
namespace SyncSystemNS;

class FunctionsJson
{
    // Convert JavaScript Json object/string to PHP json object.
    // **************************************************************************************
    /**
     * Convert JavaScript Json object/string to PHP json object.
     * @static
     * @param string $strData 
     * @param array $arrStripElements 
     * @param string $strRootNode 
     * @return string
     * @example
     * $jsonAppLabels = \SyncSystemNS\FunctionsJson::convertJSJsonToPHPJson($objAppLabels, ["'use strict';", "exports.", "appLabels = "], 'appLabels');
     */
    static function convertJSJsonToPHPJson(string $strData, array $arrStripElements = [], string $strRootNode = ''): object|null
    {
        // int $type = 1, $type: 1 - exports.

        // Variables.
        // ----------------------
        $strReturn = null;
        // ----------------------

        // Logic.
        // ----------------------
        if ($strData) {
            // $strData = str_replace("'use strict';", '', $strData);
            // $strData = str_replace('exports.', '', $strData);
            // $strData = str_replace('appLabels = ', '', $strData);

            // Strip elements.
            if (count($arrStripElements) > 0) {
                $strData = str_replace($arrStripElements, '', $strData);
            } 

            // Format PHP json.
            // $strData = preg_replace('!/\*.*?\*/!s', '', $strData); // Strip comment blocks.
            // $patternStripComments = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/'; // Strip single and multiline comments. ref: https://stackoverflow.com/questions/19509863/how-to-remove-js-comments-using-php
            $strData = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/', '', $strData); // Strip single and multiline comments. ref: https://stackoverflow.com/questions/19509863/how-to-remove-js-comments-using-php
            //$strData = preg_replace('#/\*[^*]*\*+([^/][^*]*\*+)*/#', '', $strData); // multiline comments
            //$strData = preg_replace('(\s+)\/\*([^\/]*)\*/\n*', '', $strData); // multiline comments
            // $strData = preg_replace('/\n\s*\n/', "\n", $strData); // delete empty line breaks
            $strData = str_replace(array("\r", "\n"), '', $strData); // delete all line breaks
            $strData = preg_replace('!\s+!', ' ', $strData); // convert extra spaces to one

            // Add root node.
            if ($strRootNode !== '') {
                $strData = '{ ' . $strRootNode . ': ' . $strData . ' }';
            }

            //$strData = str_replace('"', "'", $strData);
            $strData = str_replace(": '", ': "', $strData);
            $strData = str_replace(": '", ': "', $strData);
            $strData = str_replace("',", '",', $strData);
            //$strData = preg_replace('/(\w+): \"/i', '"\1": "', $strData); // fix key format wrapping in double quotes
            $strData = preg_replace('/("(.*?)"|(\w+))(\s*:\s*(".*?"|.))/s', '"$2$3"$4', $strData); // fix key format wrapping in double quotes ref: https://stackoverflow.com/questions/6941642/php-json-decode-fails-without-quotes-on-key
            $strData = str_replace('", };', '" }', $strData);

            $strData = json_decode($strData);
            //$strData = json_decode(stripslashes($strData));
        }
        // ----------------------

        // Debug.
        // echo 'strData=<pre>';
        // var_dump($strData);
        // echo '</pre><br />'; 
        
        $strReturn = $strData;

        return $strReturn;
    }
}
