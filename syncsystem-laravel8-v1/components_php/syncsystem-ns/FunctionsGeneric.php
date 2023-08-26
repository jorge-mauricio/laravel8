<?php

declare(strict_types=1);

namespace SyncSystemNS;

class FunctionsGeneric
{
    // Return the label in the right terminal.
    // **************************************************************************************
    /**
     * Return the label in the right terminal.
     * @static
     * @param object $objAppLabels
     * @param string $labelName
     * @return string
     * @example
     * \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'labelName')
     */
    public static function appLabelsGet(object $objAppLabels, string $labelName): string
    {
        // Variables.
        // ----------------------
        $strReturn = '';
        // $jsonAppLabels = null;
        // ----------------------

        // Logic.
        // ----------------------
        if ($labelName) {
            if ($objAppLabels->$labelName) {
                $strReturn = $objAppLabels->$labelName;
                $strReturn = preg_replace('/(?:\r\n|\r|\n)/', '<br />', $strReturn); // replace line breaks with tags
            }
        }
        // ----------------------

        // Debug.
        // Convert json file to php json.
        // TODO: put result in session or other temporary storage - configCache.
        // $jsonAppLabels = \SyncSystemNS\FunctionsJson::convertJSJsonToPHPJson($objAppLabels, ["'use strict';", "exports.", "appLabels = "], 'appLabels');

        // $strReturn = "testing";
        // $strReturn = $labelName;

        // echo 'jsonAppLabels=<pre>';
        // var_dump($jsonAppLabels);
        // echo '</pre><br />';

        // echo 'objAppLabels=<pre>';
        // var_dump($objAppLabels);
        // echo '</pre><br />';

        return $strReturn;
    }
    // **************************************************************************************

    // Date format for SQL write.
    // **************************************************************************************
    /**
     * Date format for SQL write.
     * @static
     * @param mixed $dateInput string|DateTime
     * @param int|null $configDateFormat 1 - PT | 2 - UK
     * @return mixed If `configDateFormat` is empty, will return Date string|DateTime
     * @example
     * \SyncSystemNS\FunctionsGeneric::dateSQLWrite($dateObjName)
     * \SyncSystemNS\FunctionsGeneric::dateSQLWrite('15/02/2020', config('app.gSystemConfig.configBackendDateFormat'))
     */
    public static function dateSQLWrite(mixed $dateInput, ?int $configDateFormat = null): mixed
    {
        // Variables.
        // ----------------------
        $strReturn = '';
        $dateObj = new \DateTime();
        $arrDateFull = [];
        $arrDate = [];
        $strDateTime = '';
        // ----------------------

        if ($dateInput) {
            // TODO: Detect input format (2000-30-01 or 01/30/2000).

            // Logic - returns yyyy-mm-dd hh:MM:ss.
            // ----------------------
            // ref: https:// blog.dotmaui.com/2017/10/17/javascript-current-date-with-format-yyyy-mm-dd-hhmmss/
            if ($configDateFormat === null) {
                // Variable value.
                // $dateObj = new \DateTime($dateInput);
                $dateObj = $dateInput;
                // TODO: double check this logic (syncsystem-laravel8-v1\\app\\Models\\CategoriesInsert.php(143): SyncSystemNS\\FunctionsGeneric::dateSQLWrite())

                // Variables.
                $dateYear = $dateObj->format('Y');
                $dateDay = $dateObj->format('d');
                $dateMonth = $dateObj->format('m');

                $dateHour = $dateObj->format('H');
                $dateMinute = $dateObj->format('i');
                $dateSecond = $dateObj->format('s');

                $dateFormatted = $dateYear . '-' . $dateMonth . '-' . $dateDay;

                // Adjustments.
                if ($dateDay < 10) {
                    $dateDay = '0' . $dateDay;
                }

                if ($dateMonth < 10) {
                    $dateMonth = '0' . $dateMonth;
                }

                if ($dateHour < 10) {
                    $dateHour = '0' . $dateHour;
                }

                if ($dateMinute < 10) {
                    $dateMinute = '0' . $dateMinute;
                }

                if ($dateSecond < 10) {
                    $dateSecond = '0' . $dateSecond;
                }

                $strReturn = $dateFormatted . ' ' . $dateHour . ':' . $dateMinute . ':' . $dateSecond;
            }
            // ----------------------

            // Forced format.
            // ----------------------
            if ($configDateFormat) {
                if (strpos($dateInput, '/') !== false) {
                    // Variables values definitions.
                    $arrDateFull = explode(' ', $dateInput);

                    $arrDate = explode('/', $arrDateFull[0]);

                    if (isset($arrDateFull[1])) {
                        $strDateTime = $arrDateFull[1];
                    }

                    // portuguese dd/mm/yyyy
                    if ($configDateFormat === 1) {
                        $strReturn = $arrDate[2] . '-' . $arrDate[1] . '-' . $arrDate[0];
                    }

                    // britanic mm/dd/yyyy
                    if ($configDateFormat == 2) {
                        $strReturn = $arrDate[2] . '-' . $arrDate[0] . '-' . $arrDate[1];
                    }

                    if ($strDateTime !== '') {
                        $strReturn = $strReturn . ' ' . $strDateTime;
                    }
                } else {
                    $strReturn = null;
                }
            }
            // ----------------------
        }

        return $strReturn;

        // Usage.
        // ----------------------
        // \SyncSystemNS\FunctionsGeneric::dateSQLWrite('15/02/2020', config('app.gSystemConfig.configBackendDateFormat'))
        // ----------------------
    }
    // **************************************************************************************

    // Function to return formatted date.
    // **************************************************************************************
    /**
     * Function to return formatted date.
     * @static
     * @param string $strDate 14/01/2016 | 01/14/2016
     * @param int $configDateFormat 1 - PT | 2 - UK | configBackendDateFormat | configFrontendDateFormat
     * @param int $dateFormatReturn 0 - deactivated (automatic from dateType) | 1 - (dd/mm/yyyy | mm/dd/yyyy) | 2 - (dd/mm/yyyy hh:mm:ss | mm/dd/yyyy hh:mm:ss) | 3 - yyyy-mm-dd hh:mm:ss | 10 - (yyyy-mm-dd) | 11 - yyyy-mm-ddThh:mm:ss | 22 - hh:mm:ss | 101 - written date (weekday, month day year)
     * @param int $dateType null - deactivated | 1 - simple date (year, month, day) | 2 -  complete date (year, month, day, hour, minute, seconds) | 3 - semi-complete date (year, month, day, hour, minute) | 4 - birth date (limited range) | 5 - task date (forward on) | 6 - history date (backwards on)  | 55 - task date with hour and minute (forward on) | 66 - history date with hour and minute (backwards on)
     * @return string
     */
    public static function dateRead01(
        ?string $strDate,
        int $configDateFormat,
        int $dateFormatReturn,
        int $dateType = null
    ): string { // TODO: double check if can be passed as null ?string $strDate
        // $configDateFormat: 1 - pt | 2 uk | configBackendDateFormat | configFrontendDateFormat
        // $dateFormatReturn: 0 - deactivated (automatic from dateType) | 1 - (dd/mm/yyyy | mm/dd/yyyy) | 2 - (dd/mm/yyyy hh:mm:ss | mm/dd/yyyy hh:mm:ss) | 3 - yyyy-mm-dd hh:mm:ss | 10 - (yyyy-mm-dd) | 11 - yyyy-mm-ddThh:mm:ss | 22 - hh:mm:ss | 101 - written date (weekday, month day year)
        // $dateType: null - deactivated | 1 - simple date (year, month, day) | 2 -  complete date (year, month, day, hour, minute, seconds) | 3 - semi-complete date (year, month, day, hour, minute) | 4 - birth date (limited range) | 5 - task date (forward on) | 6 - history date (backwards on)  | 55 - task date with hour and minute (forward on) | 66 - history date with hour and minute (backwards on)

        // Variables.
        // ----------------------
        $strReturn = '';
        // $dateObj = new Date();
        $dateObj = null;
        $dateYear = null;
        $dateDay = null;
        $dateMonth = null;
        $dateHour = null;
        $dateMinute = null;
        $dateSecond = null;
        // ----------------------

        if ($strDate) {
            // Variable value.
            // dateObj = strDate; // worked with node, but didn't work with react
            $dateObj = new \DateTime($strDate); // Y-m-d H:i:s

            $dateYear = $dateObj->format('Y');
            $dateDay = $dateObj->format('d');
            $dateMonth = $dateObj->format('m');

            $dateHour = $dateObj->format('H');

            $dateMinute = $dateObj->format('i');

            $dateSecond = $dateObj->format('s');

            // Automatic define dateFormatReturn.
            if ($dateType) {
                if ($dateType === 1 || $dateType === 4) {
                    $dateFormatReturn = 1;
                } else {
                    $dateFormatReturn = 2;
                }
            }

            // 1 - (dd/mm/yyyy | mm/dd/yyyy)
            if ($dateFormatReturn === 1) {
                // 1 - pt
                if ($configDateFormat === 1) {
                    // $strReturn = $dateDay + '/' + $dateMonth + '/' + $dateYear;
                    $strReturn = $dateObj->format('d/m/Y');
                }

                // 2 uk
                if ($configDateFormat === 2) {
                    // $strReturn = $dateMonth + '/' + $dateDay + '/' + $dateYear;
                    $strReturn = $dateObj->format('m/d/Y');
                }
            }

            // 2 - (dd/mm/yyyy hh:mm:ss | mm/dd/yyyy hh:mm:ss)
            if ($dateFormatReturn === 2) {
                // 1 - pt
                if ($configDateFormat === 1) {
                    // $strReturn = $dateDay + '/' + $dateMonth + '/' + $dateYear + ' ' + $dateHour + ':' + $dateMinute + ':' + $dateSecond;
                    $strReturn =  $dateObj->format('d/m/Y H:i:s');
                }

                // 2 uk
                if ($configDateFormat === 2) {
                    // $strReturn = $dateMonth + '/' + $dateDay + '/' + $dateYear + ' ' + $dateHour + ':' + $dateMinute + ':' + $dateSecond;
                    $strReturn =  $dateObj->format('m/d/Y H:i:s');
                }
            }

            // 3 - yyyy-mm-dd hh:mm:ss
            if ($dateFormatReturn === 3) {
                // $strReturn = $dateYear + '-' + $dateMonth + '-' + $dateDay + ' ' + $dateHour + ':' + $dateMinute + ':' + $dateSecond;
                $strReturn =  $dateObj->format('Y-m-d H:i:s');
            }
        }

        return $strReturn;

        // Usage.
        // ----------------------
        /*
            \SyncSystemNS\FunctionsGeneric::dateRead01(categoriesRow['date1'],
                                                    gSystemConfig.configBackendDateFormat,
                                                    0,
                                                    config('app.gSystemConfig.configCategoriesDate1Type'));
            */
        // ----------------------
    }
    // **************************************************************************************


    // Fill timetable values.
    // **************************************************************************************
    /**
     * Fill timetable values.
     * @static
     * @param string $timeTableType mm - months | d - day | y - year |  h - hour | m - minute | s - seconds
     * @param integer $fillType 1 - conventional interval
     * @return array
     */
    public static function timeTableFill01(string $timeTableType, int $fillType, $specialParameters = []): array
    {
        // timeTableType: mm - months | d - day | y - year |  h - hour | m - minute | s - seconds
        // fillType: 1 - conventional interval
        // specialParameters: [yearEndValue => 2050, dateType => 1]
            // dateType: 1 - simple date (year, month, day) | 2 -  complete date (year, month, day, hour, minute, seconds) | 3 - semi-complete date (year, month, day, hour, minute) | 4 - birth date (limited range) | 5 - task date (forward on) | 6 - history date (backwards on)  | 55 - task date with hour and minute (forward on) | 66 - history date with hour and minute (backwards on)

        // Variables.
        // ----------------------
        $strReturn = [];

        $dateNow = new \DateTime(); // Y-m-d H:i:s
        $dateNowDay = $dateNow->format('d');
        $dateNowMonth = $dateNow->format('m');
        $dateNowYear = $dateNow->format('Y');
        $dateNowMinute = $dateNow->format('i');
        $dateNowHour = $dateNow->format('H');
        $dateNowSecond = $dateNow->format('s');
        // ----------------------

        // Conventional interval.
        // ----------------------
        if ($fillType === 1) {
            // Months.
            if ($timeTableType === 'mm') {
                for ($countMonths = 1; $countMonths <= 12; $countMonths++) {
                    array_push($strReturn, $countMonths);
                }
            }

            // Days.
            if ($timeTableType === 'd') {
                for ($countDays = 1; $countDays <= 31; $countDays++) {
                    array_push($strReturn, $countDays);
                }
            }

            // Years.
            if ($timeTableType == 'y') {
                // 1 - simple date (year, month, day) | 2 -  complete date (year, month, day, hour, minute, seconds) | 3 - semi-complete date (year, month, day, hour, minute)
                if (!isset($specialParameters['dateType']) || $specialParameters['dateType'] === 1 || $specialParameters['dateType'] === 2 || $specialParameters['dateType'] === 3) {
                    for ($countYears = 1900; $countYears <= $dateNowYear + 20; $countYears++) {
                        array_push($strReturn, $countYears);
                    }
                }

                // 4 - birth date (limited range)
                if ($specialParameters['dateType'] === 4) {
                    for ($countYears = 1900; $countYears <= $dateNowYear; $countYears++) {
                        array_push($strReturn, $countYears);
                    }
                }

                // 5 - task date (forward on)
                if ($specialParameters['dateType'] === 5 || $specialParameters['dateType'] === 55) {
                    for ($countYears = $dateNowYear; $countYears <= $dateNowYear + 20; $countYears++) {
                        array_push($strReturn, $countYears);
                    }
                }

                // 6 - history date (backwards on)
                if ($specialParameters['dateType'] === 6 || $specialParameters['dateType'] === 66) {
                    for ($countYears = 1900; $countYears <= $dateNowYear; $countYears++) {
                        array_push($strReturn, $countYears);
                    }
                }
            }

            // Hours.
            if ($timeTableType === 'h') {
                for ($countHours = 0; $countHours <= 23; $countHours++) {
                    array_push($strReturn, $countHours);
                }
            }

            // Hours.
            if ($timeTableType === 'm') {
                for ($countMinutes = 0; $countMinutes <= 59; $countMinutes++) {
                    array_push($strReturn, $countMinutes);
                }
            }

            // Seconds.
            if ($timeTableType === 's') {
                for ($countSeconds = 0; $countSeconds <= 59; $countSeconds++) {
                    array_push($strReturn, $countSeconds);
                }
            }
        }
        // ----------------------

        return $strReturn;

        // Usage.
        // ----------------------
        /*
        foreach (\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1) as arrayRow) {
            <option value="{{ arrayRow }}">{{ arrayRow }}</option>
        }
            ${\SyncSystemNS\FunctionsGeneric::timeTableFill01('y', 1).map((arrayRow)=>{
                return `
                    <option value="${ arrayRow }">${ arrayRow }</option>
                `}).join(",") }
            */
        // ----------------------
    }
    // **************************************************************************************


    // Data treatment for displaying information.
    // **************************************************************************************
    /**
     * Data treatment for displaying information.
     * @static
     * @param string $strContent
     * @param string $specialInstructions db | utf8_encode | htmlentities | config-application | env (.env - environment variables) | pdf (convert to text) | json_encode (JavaScript String Encode) | url | linkStyle=ss-backend-links01
     * @return string
     * @example
     *
     */
    public static function contentMaskRead(?string $strContent, string $specialInstructions = ''): string
    {
        // specialInstructions: db | cookie | utf8_encode | htmlentities | config-application | env (.env - environment variables) | pdf (convert to text) | json_encode (JavaScript String Encode) | url | linkStyle=ss-backend-links01

        // Variables.
        // ----------------------
        $strReturn = $strContent;
        // ----------------------

        // Data treatment.
        // ----------------------
        if ($strReturn === null) {
            $strReturn = '';
        }
        // ----------------------

        // Logic.
        // ----------------------
        if ($specialInstructions) {
            // Detect edit field type.
            // ----------------------
            /*
            if (specialInstructions.includes('editTextBox=17') === true || specialInstructions.includes('editTextBox=18') === true) {
                specialInstructions += ', db'; // include especial instruction
            }
            */
            // ----------------------

            // DB data.
            // ----------------------
            if (strpos($specialInstructions, 'db') !== false) {
                //if ($strReturn) {
                    $strReturn = stripslashes($strReturn);
                    //$strReturn = preg_replace('/(?:\r\n|\r|\n)/g', '<br />', $strReturn);
                    $strReturn = preg_replace('/(?:\r\n|\r|\n)/', '<br />', $strReturn); // g is implicit

                    // strReturn = strContent;

                    // Convert line breaks to html br tags.
                    // ref: https:// stackoverflow.com/questions/784539/how-do-i-replace-all-line-breaks-in-a-string-with-br-tags
                    // strReturn = strContent.replace(/(?:\r\n|\r|\n)/g, "<br />");
                    //$strReturn = strReturn.replace(/(?:\r\n|\r|\n)/g, '<br />');
                //}
            }
            // ----------------------

            // DB data.
            // ----------------------
            if (strpos($specialInstructions, 'cookie') !== false) {
                $strReturn = $strReturn;
            }
            // ----------------------

            // Apply link style.
            // ----------------------
            /*
            if (specialInstructions.includes('linkStyle') == true) {
                // Variables.
                let arrSpecialInstructions = specialInstructions.split(',');
                let styleApply;

                // Value definition.
                arrSpecialInstructions.filter((array) => {
                if (array.includes('linkStyle')) {
                    styleApply = array;
                }
                });

                // Data treatment.
                styleApply = styleApply.replace('linkStyle=', '');

                // Logic.
                // strReturn = strReturn.replace('target="_blank"', 'target="_blank" class="' + styleApply + '"');
                strReturn = strReturn.replace('href="', 'class="' + styleApply + '" href="');

                // Debug.
                // console.log("arrSpecialInstructions[1]=", arrSpecialInstructions[1]);
                // console.log("styleApply=", styleApply);
            }
            */
            // ----------------------

            // config-application
            // ----------------------
            /*
            // if(specialInstructions == "config-application")
            if (specialInstructions.includes('config-application') === true) {
                // strReturn = strContent;
                strReturn = strReturn;
            }
            */
            // ----------------------

            // env (.env - environment variables)
            // ----------------------
            /*
            if (specialInstructions.includes('env') === true) {
                // strReturn = strContent;
                strReturn = strReturn;
            }
            */
            // ----------------------

            // URL data.
            // ----------------------
            /*
            // TODO: check and correct url links.
            if (specialInstructions.includes('url') === true) {
                // strReturn = strContent;
                strReturn = strReturn;
            }
            */
            // ----------------------
        }
        return $strReturn;
    }
    // **************************************************************************************


    // Data treatment for writing content.
    // **************************************************************************************
    /**
     * Data treatment for writing content.
     * @static
     * @param string $strContent
     * @param string $specialInstructions db_write_text | db_sanitize | utf8_encode | htmlentities | config-application | env (.env - environment variables) | pdf (convert to text) | json_encode (JavaScript String Encode)
     * @return string
     * @example
     * \SyncSystemNS\FunctionsGeneric::contentMaskWrite('testing contentMaskWrite', 'db_sanitize');
     */
    public static function contentMaskWrite(string $strContent, string $specialInstructions = ''): string
    {
        // specialInstructions: db_write_text | db_sanitize | utf8_encode | htmlentities | config-application | env (.env - environment variables) | pdf (convert to text) | json_encode (JavaScript String Encode)

        // Variables.
        // ----------------------
        (string) $strReturn = $strContent;
        // ----------------------

        // if(strReturn !== null && typeof(strReturn) !== 'undefined')
        // if ($strReturn) { error for when value (update db) is '0'
        if ($strReturn !== '') {
            // db_write_text
            // ----------------------
            /*
            if (specialInstructions == 'db_write_text') {
            // TODO: substitute condition with search in string.
            strReturn = strReturn;
            }
            */
            // ----------------------

            // db_sanitize
            // ----------------------
            if ($specialInstructions === 'db_sanitize') {
                $strReturn = $strReturn;
            }
            // ----------------------

            // env (.env - environment variables)
            // ----------------------
            /*
            if (specialInstructions == 'env') {
            strReturn = strReturn;
            }
            */
            // ----------------------
        } else {
            $strReturn = '';
        }

        return $strReturn;

        // Usage.
        // ----------------------
        // \SyncSystemNS\FunctionsGeneric::contentMaskWrite('testing contentMaskWrite', 'db_sanitize');
        // ----------------------
    }
    // **************************************************************************************


    // Data treatment for writing values.
    // **************************************************************************************
    /**
     * Data treatment for writing values.
     * @static
     * @param string $valueData
     * @param int $valueType valueType 1 - general number | 2 - system currency | 3 - decimal | 4 - system currency (decimal)
     * @param array|null $specialInstructions
     * @return float|int|string
     * @example
     * \SyncSystemNS\FunctionsGeneric::valueMaskRead(1000, '$', 2)
     */
    public static function valueMaskWrite(
        float $valueData,
        int $valueType = SS_VALUE_TYPE_SYSTEM_CURRENCY,
        ?array $specialInstructions = null
    ): mixed {
        // valueType: 1 - general number | 2 - system currency | 3 - decimal (maximum: 34 digits) | 4 - system currency (decimal)

        // Variables.
        // ----------------------
        $strReturn = (string) $valueData;
        // ----------------------

        // Logic.
        if ($strReturn) {
            // system currency
            if ($valueType === SS_VALUE_TYPE_SYSTEM_CURRENCY) {
                $strReturn = preg_replace('/\,/', '', $strReturn);
                $strReturn = preg_replace('/\./', '', $strReturn);
            }

            // decimal
            if ($valueType === SS_VALUE_TYPE_DECIMAL) {
                $strReturn = preg_replace('/\,/', '', $strReturn);
            }

            // system currency (decimals)
            if ($valueType === SS_VALUE_TYPE_SYSTEM_CURRENCY_DECIMAL) {
                // R$ - Real.
                if (config('app.gSystemConfig.configSystemCurrency') === 'R$') {
                    $strReturn = preg_replace('/\./', '', $strReturn);
                    $strReturn = preg_replace('/\,/', '.', $strReturn);
                }

                // $ - Dollar.
                if (config('app.gSystemConfig.configSystemCurrency') === '$') {
                    $strReturn = preg_replace('/\,/', '', $strReturn);
                }
            }
        }

        return $strReturn;
    }
    // **************************************************************************************

    // Data treatment to read values.
    // **************************************************************************************
    /**
     * Data treatment to read values.
     * @static
     * @param string $valueData
     * @param string $configCurrency '$' | 'R$'
     * @param int $valueType 1 - general number | 2 - system currency | 3 - decimal | 4 - system currency (with decimals)
     * @param array|null $specialInstructions
     * @return mixed
     * @example
     * \SyncSystemNS\FunctionsGeneric::valueMaskRead(1000, '$', 2)
     */
    //static function valueMaskRead($valueData, $configCurrency = '$', $valueType = 2, $specialInstructions = null): float
    public static function valueMaskRead(
        float $valueData,
        string $configCurrency = '$',
        int $valueType = SS_VALUE_TYPE_SYSTEM_CURRENCY,
        ?array $specialInstructions = null
    ): mixed {
        // TODO: unit test (decimals, system decimals (. / ,)).
        // Variables.
        // ----------------------
        $strReturn = '';
        $strValue = strval($valueData);
        // ----------------------

        // Logic.
        // ----------------------
        if ($valueData !== null) {
            // Generic number.
            if ($valueType === SS_VALUE_TYPE_GENERAL_NUMBER) {
                $strReturn = $valueData;
            }

            // System currency.
            if ($valueType === SS_VALUE_TYPE_SYSTEM_CURRENCY) {
                // Check if it´s a decimal.
                if (strpos($strValue, '.')) {
                    (string) $strValue = number_format((float) $strValue, 2, '.', '');
                    $strValue = preg_replace('/\./', '', $strValue);
                } else {
                    $strValue = $strValue . '00';
                }

                if (strlen($strValue) < 3) {
                    $strValue = '00' . $strValue;
                }

                $strDecimal = substr($strValue, (strlen($strValue) - 2), strlen($strValue));
                $strValue = substr($strValue, 0, strlen($strValue) - 2) . '.' . $strDecimal;

                // R$ (Real).
                if ($configCurrency === 'R$') {
                    $strReturn = number_format((float) $strValue, 2, ',', '.');
                }

                // $ (dolar).
                if ($configCurrency === '$') {
                    $strReturn = number_format((float) $strValue, 2, '.', ',');
                }

                // PagSeguro.
                if ($configCurrency === 'pagseguro') {
                    $strReturn = number_format((float) $strValue, 2, '.', ',');
                }

                // Paypal.
                if ($configCurrency === 'paypal') {
                    $strReturn = number_format((float) $strValue, 2, '.', '');
                }

                // Mercado Pago.
                if ($configCurrency === 'mercadopago') {
                    $strReturn = number_format((float) $strValue, 2, '.', '');
                }
            }

            // Decimals.
            if ($valueType === SS_VALUE_TYPE_DECIMAL) {
                $strReturn = $valueData;
            }

            // System currency.
            if ($valueType === SS_VALUE_TYPE_SYSTEM_CURRENCY_DECIMAL) {
                // TODO
            }
        }
        // ----------------------

        return $strReturn;
    }
    // **************************************************************************************

    // Configuration function for categories types.
    // **************************************************************************************
    /**
     * Configuration function for categories types.
     * @static
     * @param string|int $valueData
     * @param int $returnInfo 0 - Query String | 1 - pageLinkFrontend | 2 - variableFrontend | 3 - pageLinkBackend | 4 - variableBackend | 5 - function name | 11 - pageLinkDashboard | 12 - variableDashboard
     * @return string
     * @example
     * \SyncSystemNS\FunctionsGeneric::categoryConfigSelect($categoriesRow['category_type'], 1)
    */
    public static function categoryConfigSelect(string $categoryType, int $returnInfo): string
    {
        // Variables.
        // ----------------------
        $strReturn = '';

        $pageLinkFrontend = '';
        $variableFrontend = '';
        $pageLinkBackend = '';
        $variableBackend = '';
        $pageLinkDashboard = '';
        $variableDashboard = '';
        // ----------------------

        // Logic - category type definition.
        // ----------------------

        // Content.
        if ($categoryType === 1) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteBackendContent');
            $variableFrontend = 'idParentContent';

            $pageLinkBackend = config('app.gSystemConfig.configRouteFrontendContent');
            $variableBackend = 'idParentContent';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardContent');
            $variableDashboard = 'idParentContent';
        }

        // Products.
        if ($categoryType === 2) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendProducts');
            $variableFrontend = 'idParentProducts';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendProducts');
            $variableBackend = 'idParentProducts';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardProducts');
            $variableDashboard = 'idParentProducts';
        }

        // Publications - news.
        if ($categoryType === 3) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendPublications');
            $variableFrontend = 'idParentPublications';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendPublications');
            $variableBackend = 'idParentPublications';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardPublications');
            $variableDashboard = 'idParentPublications';
        }
        // Publications - photo gallery.
        if ($categoryType === 4) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendPublications');
            $variableFrontend = 'idParentPublications';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendPublications');
            $variableBackend = 'idParentPublications';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardPublications');
            $variableDashboard = 'idParentPublications';
        }
        // Publications - articles.
        if ($categoryType === 5) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendPublications');
            $variableFrontend = 'idParentPublications';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendPublications');
            $variableBackend = 'idParentPublications';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardPublications');
            $variableDashboard = 'idParentPublications';
        }
        // Publications - publications.
        if ($categoryType === 6) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendPublications');
            $variableFrontend = 'idParentPublications';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendPublications');
            $variableBackend = 'idParentPublications';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardPublications');
            $variableDashboard = 'idParentPublications';
        }

        // Polls.
        if ($categoryType === 7) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendQuizzes');
            $variableFrontend = 'idParentQuizzes';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendQuizzes');
            $variableBackend = 'idParentQuizzes';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardQuizzes');
            $variableDashboard = 'idParentQuizzes';
        }

        // Categories.
        if ($categoryType === 9) {
            // pageLinkFrontend = "categories";
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendCategories');
            $variableFrontend = 'idParentCategories';

            // pageLinkBackend = "categories";
            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendCategories');
            $variableBackend = 'idParentCategories';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardCategories');
            $variableDashboard = 'idParentCategories';
        }

        // Forms.
        if ($categoryType === 12) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteBackendForms');
            $variableFrontend = 'idParentForms';

            $pageLinkBackend = 'forms';
            $variableBackend = 'idParentForms';

            $pageLinkDashboard = 'dashboard-forms';
            $variableDashboard = 'idParentForms';
        }

        // Registers.
        if ($categoryType === 13) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendRegisters');
            $variableFrontend = 'idParentRegisters';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendRegisters');
            $variableBackend = 'idParentRegisters';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardRegisters');
            $variableDashboard = 'idParentRegisters';
        }

        // Quizzes.
        if ($categoryType === 17) {
            $pageLinkFrontend = config('app.gSystemConfig.configRouteFrontendQuizzes');
            $variableFrontend = 'idParentQuizzes';

            $pageLinkBackend = config('app.gSystemConfig.configRouteBackendQuizzes');
            $variableBackend = 'idParentQuizzes';

            $pageLinkDashboard = config('app.gSystemConfig.configRouteFrontendDashboardQuizzes');
            $variableDashboard = 'idParentQuizzes';
        }
        // ----------------------

        // Logic - return info definition.
        // ----------------------
        if ($returnInfo === 0) {
            for ($countObjArray = 0; $countObjArray < count(config('app.gSystemConfig.configCategoryType')); $countObjArray++) {
                $objCategoryType = config('app.gSystemConfig.configCategoryType')[$countObjArray];
                foreach ($objCategoryType as $key => $value) {
                    if ($objCategoryType[$key] === $categoryType) {
                        $strReturn = $objCategoryType['queryString'];
                    }
                }
            }
        }

        if ($returnInfo === 1) {
            $strReturn = $pageLinkFrontend;
        }
        if ($returnInfo === 2) {
            $strReturn = $variableFrontend;
        }

        if ($returnInfo === 3) {
            $strReturn = $pageLinkBackend;
        }
        if ($returnInfo === 4) {
            $strReturn = $variableBackend;
        }

        if ($returnInfo === 5) {
            for ($countObjArray = 0; $countObjArray < count(config('app.gSystemConfig.configCategoryType')); $countObjArray++) {
                $objCategoryType = config('app.gSystemConfig.configCategoryType')[$countObjArray];
                foreach ($objCategoryType as $key => $value) {
                    if ($objCategoryType[$key] === $categoryType) {
                        $strReturn = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $objCategoryType['category_type_function_label']);
                    }
                }
            }
        }

        if ($returnInfo === 11) {
            $strReturn = $pageLinkDashboard;
        }
        if ($returnInfo === 12) {
            $strReturn = $variableDashboard;
        }
        // ----------------------

        return $strReturn;
    }
    // **************************************************************************************

    // Remove HTML tags from string.
    // **************************************************************************************
    /**
     * Remove HTML tags from string.
     * @static
     * @param string $strHTML
     * @return string
     * @example
     * \SyncSystemNS\FunctionsGeneric::removeHTML01('string');
     */
    public static function removeHTML01(string $strHTML): string
    {
        // Variables.
        // ----------------------
        $strReturn = $strHTML;
        // ----------------------

        // Logic.
        if ($strReturn) {
            // $strReturn = strReturn.replace(/<[^>]*>?/gm, ''); // strip HTML (js)
            $strReturn = strip_tags($strReturn); // strip HTML
            // $strReturn = strReturn.replace(/\r?\n|\r/g, ' '); // strip all kinds of line breaks (js)
            $strReturn = preg_replace('/(?:\r\n|\r|\n)/', ' ', $strReturn); // strip all kinds of line breaks
        } else {
            $strReturn = '';
        }

        return $strReturn;

        // Usage.
        // ----------------------
        // \SyncSystemNS\FunctionsGeneric::removeHTML01('string');
        // ----------------------
    }
    // **************************************************************************************

    // Function to help build the SQL queries.
    // **************************************************************************************
    /**
     * Function to help build the SQL queries.
     * @param string $strTable categories (configSystemDBTableCategories) | files (configSystemDBTableFiles) | content (configSystemDBTableContent) | forms | filters_generic (configSystemDBTableFiltersGeneric) | filters_generic_binding (configSystemDBTableFiltersGenericBinding)
     * @param string $buildType all | backend_optimized | frontend_optimized
     * @param string $returnMethod array | string (separated by commas)
     * @return array|string
     */
    public static function tableFieldsQueryBuild01(string $strTable, string $buildType, string $returnMethod): array|string
    {
        // buildType: all | files
        // returnMethod: array | string (separated by commas)

        // Variables.
        // ----------------------
        $strReturn = null;
        $arrTableFieldsQueryBuild = [];
        // ----------------------

        // Build the field search array (to be converted to string).

        // Categories.
        // ----------------------
        // if(strTable == "categories")
        if ($strTable === config('app.gSystemConfig.configSystemDBTableCategories')) {
            if ($buildType === 'all') {
                $arrTableFieldsQueryBuild = ['id', 'id_parent'];
                config('app.gSystemConfig.enableCategoriesSortOrder') === 1 ? array_push($arrTableFieldsQueryBuild, 'sort_order') : '';
                array_push($arrTableFieldsQueryBuild, 'category_type', 'date_creation', 'date_timezone', 'date_edit');
                config('app.gSystemConfig.enableCategoriesBindRegisterUser') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register_user') : '';
                config('app.gSystemConfig.enableCategoriesBindRegister1') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register1') : '';
                config('app.gSystemConfig.enableCategoriesBindRegister2') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register2') : '';
                config('app.gSystemConfig.enableCategoriesBindRegister3') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register3') : '';
                config('app.gSystemConfig.enableCategoriesBindRegister4') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register4') : '';
                config('app.gSystemConfig.enableCategoriesBindRegister5') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_register5') : '';
                array_push($arrTableFieldsQueryBuild, 'title', 'url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info');

                config('app.gSystemConfig.enableCategoriesDescription') === 1 ? array_push($arrTableFieldsQueryBuild, 'description') : '';
                config('app.gSystemConfig.enableCategoriesInfo1') === 1 ? array_push($arrTableFieldsQueryBuild, 'info1') : '';
                config('app.gSystemConfig.enableCategoriesInfo2') === 1 ? array_push($arrTableFieldsQueryBuild, 'info2') : '';
                config('app.gSystemConfig.enableCategoriesInfo3') === 1 ? array_push($arrTableFieldsQueryBuild, 'info3') : '';
                config('app.gSystemConfig.enableCategoriesInfo4') === 1 ? array_push($arrTableFieldsQueryBuild, 'info4') : '';
                config('app.gSystemConfig.enableCategoriesInfo5') === 1 ? array_push($arrTableFieldsQueryBuild, 'info5') : '';
                config('app.gSystemConfig.enableCategoriesInfo6') === 1 ? array_push($arrTableFieldsQueryBuild, 'info6') : '';
                config('app.gSystemConfig.enableCategoriesInfo7') === 1 ? array_push($arrTableFieldsQueryBuild, 'info7') : '';
                config('app.gSystemConfig.enableCategoriesInfo8') === 1 ? array_push($arrTableFieldsQueryBuild, 'info8') : '';
                config('app.gSystemConfig.enableCategoriesInfo9') === 1 ? array_push($arrTableFieldsQueryBuild, 'info9') : '';
                config('app.gSystemConfig.enableCategoriesInfo10') === 1 ? array_push($arrTableFieldsQueryBuild, 'info10') : '';

                config('app.gSystemConfig.enableCategoriesInfoS1') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small1') : '';
                config('app.gSystemConfig.enableCategoriesInfoS2') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small2') : '';
                config('app.gSystemConfig.enableCategoriesInfoS3') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small3') : '';
                config('app.gSystemConfig.enableCategoriesInfoS4') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small4') : '';
                config('app.gSystemConfig.enableCategoriesInfoS5') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small5') : '';

                config('app.gSystemConfig.enableCategoriesNumber1') === 1 ? array_push($arrTableFieldsQueryBuild, 'number1') : '';
                config('app.gSystemConfig.enableCategoriesNumber2') === 1 ? array_push($arrTableFieldsQueryBuild, 'number2') : '';
                config('app.gSystemConfig.enableCategoriesNumber3') === 1 ? array_push($arrTableFieldsQueryBuild, 'number3') : '';
                config('app.gSystemConfig.enableCategoriesNumber4') === 1 ? array_push($arrTableFieldsQueryBuild, 'number4') : '';
                config('app.gSystemConfig.enableCategoriesNumber5') === 1 ? array_push($arrTableFieldsQueryBuild, 'number5') : '';

                config('app.gSystemConfig.enableCategoriesNumberS1') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small1') : '';
                config('app.gSystemConfig.enableCategoriesNumberS2') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small2') : '';
                config('app.gSystemConfig.enableCategoriesNumberS3') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small3') : '';
                config('app.gSystemConfig.enableCategoriesNumberS4') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small4') : '';
                config('app.gSystemConfig.enableCategoriesNumberS5') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small5') : '';

                config('app.gSystemConfig.enableCategoriesDate1') === 1 ? array_push($arrTableFieldsQueryBuild, 'date1') : '';
                config('app.gSystemConfig.enableCategoriesDate2') === 1 ? array_push($arrTableFieldsQueryBuild, 'date2') : '';
                config('app.gSystemConfig.enableCategoriesDate3') === 1 ? array_push($arrTableFieldsQueryBuild, 'date3') : '';
                config('app.gSystemConfig.enableCategoriesDate4') === 1 ? array_push($arrTableFieldsQueryBuild, 'date4') : '';
                config('app.gSystemConfig.enableCategoriesDate5') === 1 ? array_push($arrTableFieldsQueryBuild, 'date5') : '';

                // arrTableFieldsQueryBuild.push("image_main");
                config('app.gSystemConfig.enableCategoriesImageMain') === 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';

                config('app.gSystemConfig.enableCategoriesFile1') === 1 ? array_push($arrTableFieldsQueryBuild, 'file1') : '';
                config('app.gSystemConfig.enableCategoriesFile2') === 1 ? array_push($arrTableFieldsQueryBuild, 'file2') : '';
                config('app.gSystemConfig.enableCategoriesFile3') === 1 ? array_push($arrTableFieldsQueryBuild, 'file3') : '';
                config('app.gSystemConfig.enableCategoriesFile4') === 1 ? array_push($arrTableFieldsQueryBuild, 'file4') : '';
                config('app.gSystemConfig.enableCategoriesFile5') === 1 ? array_push($arrTableFieldsQueryBuild, 'file5') : '';

                array_push($arrTableFieldsQueryBuild, 'activation');
                config('app.gSystemConfig.enableCategoriesActivation1') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation1') : '';
                config('app.gSystemConfig.enableCategoriesActivation2') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation2') : '';
                config('app.gSystemConfig.enableCategoriesActivation3') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation3') : '';
                config('app.gSystemConfig.enableCategoriesActivation4') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation4') : '';
                config('app.gSystemConfig.enableCategoriesActivation5') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation5') : '';

                config('app.gSystemConfig.enableCategoriesStatus') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_status') : '';
                config('app.gSystemConfig.enableCategoriesRestrictedAccess') === 1 ? array_push($arrTableFieldsQueryBuild, 'restricted_access') : '';
                config('app.gSystemConfig.enableCategoriesNotes') === 1 ? array_push($arrTableFieldsQueryBuild, 'notes') : '';
            }

            // File fields.
            if ($buildType === 'files') {
                config('app.gSystemConfig.enableCategoriesImageMain') === 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';
                config('app.gSystemConfig.enableCategoriesFile1') === 1 ? array_push($arrTableFieldsQueryBuild, 'file1') : '';
                config('app.gSystemConfig.enableCategoriesFile2') === 1 ? array_push($arrTableFieldsQueryBuild, 'file2') : '';
                config('app.gSystemConfig.enableCategoriesFile3') === 1 ? array_push($arrTableFieldsQueryBuild, 'file3') : '';
                config('app.gSystemConfig.enableCategoriesFile4') === 1 ? array_push($arrTableFieldsQueryBuild, 'file4') : '';
                config('app.gSystemConfig.enableCategoriesFile5') === 1 ? array_push($arrTableFieldsQueryBuild, 'file5') : '';
            }
        }
        // ----------------------
        /*
        // Files.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableFiles) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableFilesSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // arrTableFieldsQueryBuild.push("file_type", "file_config", "date_creation", "date_timezone", "date_edit");
            arrTableFieldsQueryBuild.push('file_type', 'file_config', 'date_creation', 'date_edit');
            gSystemConfig.enableFilesTitle == 1 ? arrTableFieldsQueryBuild.push('title') : '';
            arrTableFieldsQueryBuild.push('caption');
            gSystemConfig.enableFilesDescription == 1 ? arrTableFieldsQueryBuild.push('description') : '';
            gSystemConfig.enableFilesHTMLCode == 1 ? arrTableFieldsQueryBuild.push('html_code') : '';
            arrTableFieldsQueryBuild.push('url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info');
            gSystemConfig.enableFilesInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enableFilesInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enableFilesInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enableFilesInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enableFilesInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';
            gSystemConfig.enableFilesInfoS1 == 1 ? arrTableFieldsQueryBuild.push('info_small1') : '';
            gSystemConfig.enableFilesInfoS2 == 1 ? arrTableFieldsQueryBuild.push('info_small2') : '';
            gSystemConfig.enableFilesInfoS3 == 1 ? arrTableFieldsQueryBuild.push('info_small3') : '';
            gSystemConfig.enableFilesInfoS4 == 1 ? arrTableFieldsQueryBuild.push('info_small4') : '';
            gSystemConfig.enableFilesInfoS5 == 1 ? arrTableFieldsQueryBuild.push('info_small5') : '';
            gSystemConfig.enableFilesNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enableFilesNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enableFilesNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enableFilesNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enableFilesNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';
            gSystemConfig.enableFilesNumberS1 == 1 ? arrTableFieldsQueryBuild.push('number_small1') : '';
            gSystemConfig.enableFilesNumberS2 == 1 ? arrTableFieldsQueryBuild.push('number_small2') : '';
            gSystemConfig.enableFilesNumberS3 == 1 ? arrTableFieldsQueryBuild.push('number_small3') : '';
            gSystemConfig.enableFilesNumberS4 == 1 ? arrTableFieldsQueryBuild.push('number_small4') : '';
            gSystemConfig.enableFilesNumberS5 == 1 ? arrTableFieldsQueryBuild.push('number_small5') : '';
            gSystemConfig.enableFilesDate1 == 1 ? arrTableFieldsQueryBuild.push('date1') : '';
            gSystemConfig.enableFilesDate2 == 1 ? arrTableFieldsQueryBuild.push('date2') : '';
            gSystemConfig.enableFilesDate3 == 1 ? arrTableFieldsQueryBuild.push('date3') : '';
            gSystemConfig.enableFilesDate4 == 1 ? arrTableFieldsQueryBuild.push('date4') : '';
            gSystemConfig.enableFilesDate5 == 1 ? arrTableFieldsQueryBuild.push('date5') : '';

            arrTableFieldsQueryBuild.push('file');
            gSystemConfig.enableFilesThumbnails == 1 ? arrTableFieldsQueryBuild.push('file_thumbnail') : '';
            arrTableFieldsQueryBuild.push('file_size', 'file_duration', 'file_dimensions', 'file_original_name');

            gSystemConfig.enableFilesFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableFilesFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableFilesFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableFilesFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableFilesFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';
            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableFilesActivation1 == 1 ? arrTableFieldsQueryBuild.push('activation1') : '';
            gSystemConfig.enableFilesActivation2 == 1 ? arrTableFieldsQueryBuild.push('activation2') : '';
            gSystemConfig.enableFilesActivation3 == 1 ? arrTableFieldsQueryBuild.push('activation3') : '';
            gSystemConfig.enableFilesActivation4 == 1 ? arrTableFieldsQueryBuild.push('activation4') : '';
            gSystemConfig.enableFilesActivation5 == 1 ? arrTableFieldsQueryBuild.push('activation5') : '';
            gSystemConfig.enableFilesNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }

        // File fields.
        if (buildType == 'files') {
            arrTableFieldsQueryBuild.push('file');
            gSystemConfig.enableFilesThumbnails == 1 ? arrTableFieldsQueryBuild.push('file_thumbnail') : '';
            gSystemConfig.enableFilesFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableFilesFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableFilesFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableFilesFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableFilesFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';
        }
        }
        // ----------------------

        // Content.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableContent) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableContentSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // arrTableFieldsQueryBuild.push("date_creation", "date_timezone", "date_edit");
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit');
            gSystemConfig.enableContentBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';
            arrTableFieldsQueryBuild.push('content_type');
            gSystemConfig.enableContentColumns == 1 ? arrTableFieldsQueryBuild.push('content_columns') : '';
            arrTableFieldsQueryBuild.push('align_text', 'align_image', 'content_text');
            gSystemConfig.enableContentURL == 1 ? arrTableFieldsQueryBuild.push('content_url') : '';
            arrTableFieldsQueryBuild.push('caption', 'file', 'file_size', 'file_duration', 'file_dimensions', 'file_original_name', 'file_config');
            gSystemConfig.enableContentFileThumbnail == 1 ? arrTableFieldsQueryBuild.push('file_thumbnail') : '';
            arrTableFieldsQueryBuild.push('activation');
        }

        // File fields.
        if (buildType == 'files') {
            arrTableFieldsQueryBuild.push('file');
            gSystemConfig.enableContentFileThumbnail == 1 ? arrTableFieldsQueryBuild.push('file_thumbnail') : '';
        }
        }
        // ----------------------

        // Products.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableProducts) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableProductsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            gSystemConfig.enableProductsType == 1 ? arrTableFieldsQueryBuild.push('id_type') : '';
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit');
            gSystemConfig.enableProductsCode == 1 ? arrTableFieldsQueryBuild.push('code') : '';

            gSystemConfig.enableProductsBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';
            gSystemConfig.enableProductsBindRegister1 == 1 ? arrTableFieldsQueryBuild.push('id_register1') : '';
            gSystemConfig.enableProductsBindRegister2 == 1 ? arrTableFieldsQueryBuild.push('id_register2') : '';
            gSystemConfig.enableProductsBindRegister3 == 1 ? arrTableFieldsQueryBuild.push('id_register3') : '';
            gSystemConfig.enableProductsBindRegister4 == 1 ? arrTableFieldsQueryBuild.push('id_register4') : '';
            gSystemConfig.enableProductsBindRegister5 == 1 ? arrTableFieldsQueryBuild.push('id_register5') : '';

            // arrTableFieldsQueryBuild.push("code", "title");
            arrTableFieldsQueryBuild.push('title');
            gSystemConfig.enableProductsDescription == 1 ? arrTableFieldsQueryBuild.push('description') : '';
            arrTableFieldsQueryBuild.push('url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info');

            gSystemConfig.enableProductsInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enableProductsInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enableProductsInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enableProductsInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enableProductsInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';
            gSystemConfig.enableProductsInfo6 == 1 ? arrTableFieldsQueryBuild.push('info6') : '';
            gSystemConfig.enableProductsInfo7 == 1 ? arrTableFieldsQueryBuild.push('info7') : '';
            gSystemConfig.enableProductsInfo8 == 1 ? arrTableFieldsQueryBuild.push('info8') : '';
            gSystemConfig.enableProductsInfo9 == 1 ? arrTableFieldsQueryBuild.push('info9') : '';
            gSystemConfig.enableProductsInfo10 == 1 ? arrTableFieldsQueryBuild.push('info10') : '';
            gSystemConfig.enableProductsInfo11 == 1 ? arrTableFieldsQueryBuild.push('info11') : '';
            gSystemConfig.enableProductsInfo12 == 1 ? arrTableFieldsQueryBuild.push('info12') : '';
            gSystemConfig.enableProductsInfo13 == 1 ? arrTableFieldsQueryBuild.push('info13') : '';
            gSystemConfig.enableProductsInfo14 == 1 ? arrTableFieldsQueryBuild.push('info14') : '';
            gSystemConfig.enableProductsInfo15 == 1 ? arrTableFieldsQueryBuild.push('info15') : '';
            gSystemConfig.enableProductsInfo16 == 1 ? arrTableFieldsQueryBuild.push('info16') : '';
            gSystemConfig.enableProductsInfo17 == 1 ? arrTableFieldsQueryBuild.push('info17') : '';
            gSystemConfig.enableProductsInfo18 == 1 ? arrTableFieldsQueryBuild.push('info18') : '';
            gSystemConfig.enableProductsInfo19 == 1 ? arrTableFieldsQueryBuild.push('info19') : '';
            gSystemConfig.enableProductsInfo20 == 1 ? arrTableFieldsQueryBuild.push('info20') : '';

            gSystemConfig.enableProductsInfoS1 == 1 ? arrTableFieldsQueryBuild.push('info_small1') : '';
            gSystemConfig.enableProductsInfoS2 == 1 ? arrTableFieldsQueryBuild.push('info_small2') : '';
            gSystemConfig.enableProductsInfoS3 == 1 ? arrTableFieldsQueryBuild.push('info_small3') : '';
            gSystemConfig.enableProductsInfoS4 == 1 ? arrTableFieldsQueryBuild.push('info_small4') : '';
            gSystemConfig.enableProductsInfoS5 == 1 ? arrTableFieldsQueryBuild.push('info_small5') : '';
            gSystemConfig.enableProductsInfoS6 == 1 ? arrTableFieldsQueryBuild.push('info_small6') : '';
            gSystemConfig.enableProductsInfoS7 == 1 ? arrTableFieldsQueryBuild.push('info_small7') : '';
            gSystemConfig.enableProductsInfoS8 == 1 ? arrTableFieldsQueryBuild.push('info_small8') : '';
            gSystemConfig.enableProductsInfoS9 == 1 ? arrTableFieldsQueryBuild.push('info_small9') : '';
            gSystemConfig.enableProductsInfoS10 == 1 ? arrTableFieldsQueryBuild.push('info_small10') : '';
            gSystemConfig.enableProductsInfoS11 == 1 ? arrTableFieldsQueryBuild.push('info_small11') : '';
            gSystemConfig.enableProductsInfoS12 == 1 ? arrTableFieldsQueryBuild.push('info_small12') : '';
            gSystemConfig.enableProductsInfoS13 == 1 ? arrTableFieldsQueryBuild.push('info_small13') : '';
            gSystemConfig.enableProductsInfoS14 == 1 ? arrTableFieldsQueryBuild.push('info_small14') : '';
            gSystemConfig.enableProductsInfoS15 == 1 ? arrTableFieldsQueryBuild.push('info_small15') : '';
            gSystemConfig.enableProductsInfoS16 == 1 ? arrTableFieldsQueryBuild.push('info_small16') : '';
            gSystemConfig.enableProductsInfoS17 == 1 ? arrTableFieldsQueryBuild.push('info_small17') : '';
            gSystemConfig.enableProductsInfoS18 == 1 ? arrTableFieldsQueryBuild.push('info_small18') : '';
            gSystemConfig.enableProductsInfoS19 == 1 ? arrTableFieldsQueryBuild.push('info_small19') : '';
            gSystemConfig.enableProductsInfoS20 == 1 ? arrTableFieldsQueryBuild.push('info_small20') : '';
            gSystemConfig.enableProductsInfoS21 == 1 ? arrTableFieldsQueryBuild.push('info_small21') : '';
            gSystemConfig.enableProductsInfoS22 == 1 ? arrTableFieldsQueryBuild.push('info_small22') : '';
            gSystemConfig.enableProductsInfoS23 == 1 ? arrTableFieldsQueryBuild.push('info_small23') : '';
            gSystemConfig.enableProductsInfoS24 == 1 ? arrTableFieldsQueryBuild.push('info_small24') : '';
            gSystemConfig.enableProductsInfoS25 == 1 ? arrTableFieldsQueryBuild.push('info_small25') : '';
            gSystemConfig.enableProductsInfoS26 == 1 ? arrTableFieldsQueryBuild.push('info_small26') : '';
            gSystemConfig.enableProductsInfoS27 == 1 ? arrTableFieldsQueryBuild.push('info_small27') : '';
            gSystemConfig.enableProductsInfoS28 == 1 ? arrTableFieldsQueryBuild.push('info_small28') : '';
            gSystemConfig.enableProductsInfoS29 == 1 ? arrTableFieldsQueryBuild.push('info_small29') : '';
            gSystemConfig.enableProductsInfoS30 == 1 ? arrTableFieldsQueryBuild.push('info_small30') : '';

            gSystemConfig.enableProductsValue == 1 ? arrTableFieldsQueryBuild.push('value') : '';
            gSystemConfig.enableProductsValue1 == 1 ? arrTableFieldsQueryBuild.push('value1') : '';
            gSystemConfig.enableProductsValue2 == 1 ? arrTableFieldsQueryBuild.push('value2') : '';
            gSystemConfig.enableProductsWeight == 1 ? arrTableFieldsQueryBuild.push('weight') : '';
            gSystemConfig.enableProductsCoefficient == 1 ? arrTableFieldsQueryBuild.push('coefficient') : '';

            gSystemConfig.enableProductsNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enableProductsNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enableProductsNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enableProductsNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enableProductsNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';

            gSystemConfig.enableProductsNumberS1 == 1 ? arrTableFieldsQueryBuild.push('number_small1') : '';
            gSystemConfig.enableProductsNumberS2 == 1 ? arrTableFieldsQueryBuild.push('number_small2') : '';
            gSystemConfig.enableProductsNumberS3 == 1 ? arrTableFieldsQueryBuild.push('number_small3') : '';
            gSystemConfig.enableProductsNumberS4 == 1 ? arrTableFieldsQueryBuild.push('number_small4') : '';
            gSystemConfig.enableProductsNumberS5 == 1 ? arrTableFieldsQueryBuild.push('number_small5') : '';

            gSystemConfig.enableProductsURL1 != 0 ? arrTableFieldsQueryBuild.push('url1') : '';
            gSystemConfig.enableProductsURL2 != 0 ? arrTableFieldsQueryBuild.push('url2') : '';
            gSystemConfig.enableProductsURL3 != 0 ? arrTableFieldsQueryBuild.push('url3') : '';
            gSystemConfig.enableProductsURL4 != 0 ? arrTableFieldsQueryBuild.push('url4') : '';
            gSystemConfig.enableProductsURL5 != 0 ? arrTableFieldsQueryBuild.push('url5') : '';

            gSystemConfig.enableProductsDate1 == 1 ? arrTableFieldsQueryBuild.push('date1') : '';
            gSystemConfig.enableProductsDate2 == 1 ? arrTableFieldsQueryBuild.push('date2') : '';
            gSystemConfig.enableProductsDate3 == 1 ? arrTableFieldsQueryBuild.push('date3') : '';
            gSystemConfig.enableProductsDate4 == 1 ? arrTableFieldsQueryBuild.push('date4') : '';
            gSystemConfig.enableProductsDate5 == 1 ? arrTableFieldsQueryBuild.push('date5') : '';

            gSystemConfig.enableProductsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableProductsImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';

            gSystemConfig.enableProductsFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableProductsFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableProductsFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableProductsFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableProductsFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';

            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableProductsActivation1 == 1 ? arrTableFieldsQueryBuild.push('activation1') : '';
            gSystemConfig.enableProductsActivation2 == 1 ? arrTableFieldsQueryBuild.push('activation2') : '';
            gSystemConfig.enableProductsActivation3 == 1 ? arrTableFieldsQueryBuild.push('activation3') : '';
            gSystemConfig.enableProductsActivation4 == 1 ? arrTableFieldsQueryBuild.push('activation4') : '';
            gSystemConfig.enableProductsActivation5 == 1 ? arrTableFieldsQueryBuild.push('activation5') : '';
            gSystemConfig.enableProductsStatus == 1 ? arrTableFieldsQueryBuild.push('id_status') : '';
            gSystemConfig.enableProductsRestrictedAccess == 1 ? arrTableFieldsQueryBuild.push('restricted_access') : '';
            gSystemConfig.enableProductsNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }

        // File fields.
        if (buildType == 'files') {
            gSystemConfig.enableProductsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableProductsFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableProductsFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableProductsFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableProductsFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableProductsFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';
        }
        }
        // ----------------------

        // Publications.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTablePublications) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enablePublicationsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            arrTableFieldsQueryBuild.push('id_type', 'date_creation', 'date_edit');
            gSystemConfig.enablePublicationsBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';
            gSystemConfig.enablePublicationsBindRegister1 == 1 ? arrTableFieldsQueryBuild.push('id_register1') : '';
            gSystemConfig.enablePublicationsBindRegister2 == 1 ? arrTableFieldsQueryBuild.push('id_register2') : '';
            gSystemConfig.enablePublicationsBindRegister3 == 1 ? arrTableFieldsQueryBuild.push('id_register3') : '';
            gSystemConfig.enablePublicationsBindRegister4 == 1 ? arrTableFieldsQueryBuild.push('id_register4') : '';
            gSystemConfig.enablePublicationsBindRegister5 == 1 ? arrTableFieldsQueryBuild.push('id_register5') : '';

            gSystemConfig.enablePublicationsDateStart == 1 ? arrTableFieldsQueryBuild.push('date_start') : '';
            gSystemConfig.enablePublicationsDateEnd == 1 ? arrTableFieldsQueryBuild.push('date_end') : '';

            arrTableFieldsQueryBuild.push('title');
            gSystemConfig.enablePublicationsDescription == 1 ? arrTableFieldsQueryBuild.push('description') : '';
            arrTableFieldsQueryBuild.push('url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info');

            gSystemConfig.enablePublicationsInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enablePublicationsInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enablePublicationsInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enablePublicationsInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enablePublicationsInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';
            gSystemConfig.enablePublicationsInfo6 == 1 ? arrTableFieldsQueryBuild.push('info6') : '';
            gSystemConfig.enablePublicationsInfo7 == 1 ? arrTableFieldsQueryBuild.push('info7') : '';
            gSystemConfig.enablePublicationsInfo8 == 1 ? arrTableFieldsQueryBuild.push('info8') : '';
            gSystemConfig.enablePublicationsInfo9 == 1 ? arrTableFieldsQueryBuild.push('info9') : '';
            gSystemConfig.enablePublicationsInfo10 == 1 ? arrTableFieldsQueryBuild.push('info10') : '';

            gSystemConfig.enablePublicationsSource == 1 ? arrTableFieldsQueryBuild.push('source') : '';
            gSystemConfig.enablePublicationsSourceURL == 1 ? arrTableFieldsQueryBuild.push('source_url') : '';

            gSystemConfig.enablePublicationsNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enablePublicationsNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enablePublicationsNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enablePublicationsNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enablePublicationsNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';

            gSystemConfig.enablePublicationsURL1 != 0 ? arrTableFieldsQueryBuild.push('url1') : '';
            gSystemConfig.enablePublicationsURL2 != 0 ? arrTableFieldsQueryBuild.push('url2') : '';
            gSystemConfig.enablePublicationsURL3 != 0 ? arrTableFieldsQueryBuild.push('url3') : '';
            gSystemConfig.enablePublicationsURL4 != 0 ? arrTableFieldsQueryBuild.push('url4') : '';
            gSystemConfig.enablePublicationsURL5 != 0 ? arrTableFieldsQueryBuild.push('url5') : '';

            gSystemConfig.enablePublicationsDate1 == 1 ? arrTableFieldsQueryBuild.push('date1') : '';
            gSystemConfig.enablePublicationsDate2 == 1 ? arrTableFieldsQueryBuild.push('date2') : '';
            gSystemConfig.enablePublicationsDate3 == 1 ? arrTableFieldsQueryBuild.push('date3') : '';
            gSystemConfig.enablePublicationsDate4 == 1 ? arrTableFieldsQueryBuild.push('date4') : '';
            gSystemConfig.enablePublicationsDate5 == 1 ? arrTableFieldsQueryBuild.push('date5') : '';

            gSystemConfig.enablePublicationsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enablePublicationsImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';

            gSystemConfig.enablePublicationsFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enablePublicationsFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enablePublicationsFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enablePublicationsFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enablePublicationsFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';

            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enablePublicationsActivation1 == 1 ? arrTableFieldsQueryBuild.push('activation1') : '';
            gSystemConfig.enablePublicationsActivation2 == 1 ? arrTableFieldsQueryBuild.push('activation2') : '';
            gSystemConfig.enablePublicationsActivation3 == 1 ? arrTableFieldsQueryBuild.push('activation3') : '';
            gSystemConfig.enablePublicationsActivation4 == 1 ? arrTableFieldsQueryBuild.push('activation4') : '';
            gSystemConfig.enablePublicationsActivation5 == 1 ? arrTableFieldsQueryBuild.push('activation5') : '';
            gSystemConfig.enablePublicationsStatus == 1 ? arrTableFieldsQueryBuild.push('id_status') : '';
            gSystemConfig.enablePublicationsRestrictedAccess == 1 ? arrTableFieldsQueryBuild.push('restricted_access') : '';
            gSystemConfig.enablePublicationsNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }

        // File fields.
        if (buildType == 'files') {
            gSystemConfig.enablePublicationsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enablePublicationsFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enablePublicationsFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enablePublicationsFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enablePublicationsFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enablePublicationsFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';
        }
        }
        // ----------------------

        // Registers.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableRegisters) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableRegistersSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // gSystemConfig.enableRegistersType == 1 ? arrTableFieldsQueryBuild.push("id_type") : '';
            arrTableFieldsQueryBuild.push('date_creation', 'date_timezone', 'date_edit', 'id_type');
            gSystemConfig.enableRegistersActivity == 1 ? arrTableFieldsQueryBuild.push('id_activity') : '';

            gSystemConfig.enableRegistersBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';
            gSystemConfig.enableRegistersBindRegister1 == 1 ? arrTableFieldsQueryBuild.push('id_register1') : '';
            gSystemConfig.enableRegistersBindRegister2 == 1 ? arrTableFieldsQueryBuild.push('id_register2') : '';
            gSystemConfig.enableRegistersBindRegister3 == 1 ? arrTableFieldsQueryBuild.push('id_register3') : '';
            gSystemConfig.enableRegistersBindRegister4 == 1 ? arrTableFieldsQueryBuild.push('id_register4') : '';
            gSystemConfig.enableRegistersBindRegister5 == 1 ? arrTableFieldsQueryBuild.push('id_register5') : '';

            gSystemConfig.enableRegistersRegisterType == 1 ? arrTableFieldsQueryBuild.push('register_type') : '';

            gSystemConfig.enableRegistersNameTitle == 1 ? arrTableFieldsQueryBuild.push('name_title') : '';
            gSystemConfig.enableRegistersNameFull == 1 ? arrTableFieldsQueryBuild.push('name_full') : '';
            gSystemConfig.enableRegistersNameFirst == 1 ? arrTableFieldsQueryBuild.push('name_first') : '';
            gSystemConfig.enableRegistersNameLast == 1 ? arrTableFieldsQueryBuild.push('name_last') : '';
            gSystemConfig.enableRegistersCompanyNameLegal == 1 ? arrTableFieldsQueryBuild.push('company_name_legal') : '';
            gSystemConfig.enableRegistersCompanyNameAlias == 1 ? arrTableFieldsQueryBuild.push('company_name_alias') : '';
            gSystemConfig.enableRegistersDescription == 1 ? arrTableFieldsQueryBuild.push('description') : '';

            arrTableFieldsQueryBuild.push('url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info'); // 27

            gSystemConfig.enableRegistersDateBirth != 0 ? arrTableFieldsQueryBuild.push('date_birth') : '';
            gSystemConfig.enableRegistersGender == 1 ? arrTableFieldsQueryBuild.push('gender') : '';
            gSystemConfig.enableRegistersHeight == 1 ? arrTableFieldsQueryBuild.push('height') : '';
            gSystemConfig.enableRegistersWeight == 1 ? arrTableFieldsQueryBuild.push('weight') : '';

            gSystemConfig.enableRegistersDocumentType == 1 ? arrTableFieldsQueryBuild.push('document_type') : '';
            gSystemConfig.enableRegistersDocument == 1 ? arrTableFieldsQueryBuild.push('document') : '';
            gSystemConfig.enableRegistersDocument1Type == 1 ? arrTableFieldsQueryBuild.push('document1_type') : '';
            gSystemConfig.enableRegistersDocument1 == 1 ? arrTableFieldsQueryBuild.push('document1') : '';
            gSystemConfig.enableRegistersDocument2Type == 1 ? arrTableFieldsQueryBuild.push('document2_type') : '';
            gSystemConfig.enableRegistersDocument2 == 1 ? arrTableFieldsQueryBuild.push('document2') : '';

            gSystemConfig.enableRegistersDocumentCompanyType == 1 ? arrTableFieldsQueryBuild.push('document_company_type') : '';
            gSystemConfig.enableRegistersDocumentCompany == 1 ? arrTableFieldsQueryBuild.push('document_company') : '';
            gSystemConfig.enableRegistersDocumentCompany1Type == 1 ? arrTableFieldsQueryBuild.push('document_company1_type') : '';
            gSystemConfig.enableRegistersDocumentCompany1 == 1 ? arrTableFieldsQueryBuild.push('document_company1') : '';
            gSystemConfig.enableRegistersDocumentCompany2Type == 1 ? arrTableFieldsQueryBuild.push('document_company2_type') : '';
            gSystemConfig.enableRegistersDocumentCompany2 == 1 ? arrTableFieldsQueryBuild.push('document_company2') : '';

            gSystemConfig.enableRegistersZIPCode == 1 ? arrTableFieldsQueryBuild.push('zip_code') : '';
            gSystemConfig.enableRegistersAddressStreet == 1 ? arrTableFieldsQueryBuild.push('address_street') : '';
            gSystemConfig.enableRegistersAddressNumber == 1 ? arrTableFieldsQueryBuild.push('address_number') : '';
            gSystemConfig.enableRegistersAddressComplement == 1 ? arrTableFieldsQueryBuild.push('address_complement') : '';
            gSystemConfig.enableRegistersNeighborhood == 1 ? arrTableFieldsQueryBuild.push('neighborhood') : '';
            gSystemConfig.enableRegistersDistrict == 1 ? arrTableFieldsQueryBuild.push('district') : '';
            gSystemConfig.enableRegistersCounty == 1 ? arrTableFieldsQueryBuild.push('county') : '';
            gSystemConfig.enableRegistersCity == 1 ? arrTableFieldsQueryBuild.push('city') : '';
            gSystemConfig.enableRegistersState == 1 ? arrTableFieldsQueryBuild.push('state') : '';
            gSystemConfig.enableRegistersCountry == 1 ? arrTableFieldsQueryBuild.push('country') : '';
            arrTableFieldsQueryBuild.push('id_street', 'id_neighborhood', 'id_district', 'id_county', 'id_city', 'id_state', 'id_country');

            gSystemConfig.enableRegistersLocationReference == 1 ? arrTableFieldsQueryBuild.push('location_reference') : '';
            gSystemConfig.enableRegistersLocationMap != 0 ? arrTableFieldsQueryBuild.push('location_map') : ''; // 62

            gSystemConfig.enableRegistersPhone1 == 1 ? arrTableFieldsQueryBuild.push('phone1_international_code', 'phone1_area_code', 'phone1') : '';
            gSystemConfig.enableRegistersPhone2 == 1 ? arrTableFieldsQueryBuild.push('phone2_international_code', 'phone2_area_code', 'phone2') : '';
            gSystemConfig.enableRegistersPhone3 == 1 ? arrTableFieldsQueryBuild.push('phone3_international_code', 'phone3_area_code', 'phone3') : '';
            gSystemConfig.enableRegistersWebsite == 1 ? arrTableFieldsQueryBuild.push('website') : '';

            gSystemConfig.enableRegistersUsername == 1 ? arrTableFieldsQueryBuild.push('username') : '';
            gSystemConfig.enableRegistersEmail == 1 ? arrTableFieldsQueryBuild.push('email') : '';
            // arrTableFieldsQueryBuild.push("password", "password_hint", "password_length");
            gSystemConfig.configRegistersPassword == 1 ? arrTableFieldsQueryBuild.push('password', 'password_hint', 'password_length') : ''; // 78

            gSystemConfig.enableRegistersInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enableRegistersInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enableRegistersInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enableRegistersInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enableRegistersInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';
            gSystemConfig.enableRegistersInfo6 == 1 ? arrTableFieldsQueryBuild.push('info6') : '';
            gSystemConfig.enableRegistersInfo7 == 1 ? arrTableFieldsQueryBuild.push('info7') : '';
            gSystemConfig.enableRegistersInfo8 == 1 ? arrTableFieldsQueryBuild.push('info8') : '';
            gSystemConfig.enableRegistersInfo9 == 1 ? arrTableFieldsQueryBuild.push('info9') : '';
            gSystemConfig.enableRegistersInfo10 == 1 ? arrTableFieldsQueryBuild.push('info10') : '';
            gSystemConfig.enableRegistersInfo11 == 1 ? arrTableFieldsQueryBuild.push('info11') : '';
            gSystemConfig.enableRegistersInfo12 == 1 ? arrTableFieldsQueryBuild.push('info12') : '';
            gSystemConfig.enableRegistersInfo13 == 1 ? arrTableFieldsQueryBuild.push('info13') : '';
            gSystemConfig.enableRegistersInfo14 == 1 ? arrTableFieldsQueryBuild.push('info14') : '';
            gSystemConfig.enableRegistersInfo15 == 1 ? arrTableFieldsQueryBuild.push('info15') : '';
            gSystemConfig.enableRegistersInfo16 == 1 ? arrTableFieldsQueryBuild.push('info16') : '';
            gSystemConfig.enableRegistersInfo17 == 1 ? arrTableFieldsQueryBuild.push('info17') : '';
            gSystemConfig.enableRegistersInfo18 == 1 ? arrTableFieldsQueryBuild.push('info18') : '';
            gSystemConfig.enableRegistersInfo19 == 1 ? arrTableFieldsQueryBuild.push('info19') : '';
            gSystemConfig.enableRegistersInfo20 == 1 ? arrTableFieldsQueryBuild.push('info20') : '';

            gSystemConfig.enableRegistersInfoS1 == 1 ? arrTableFieldsQueryBuild.push('info_small1') : '';
            gSystemConfig.enableRegistersInfoS2 == 1 ? arrTableFieldsQueryBuild.push('info_small2') : '';
            gSystemConfig.enableRegistersInfoS3 == 1 ? arrTableFieldsQueryBuild.push('info_small3') : '';
            gSystemConfig.enableRegistersInfoS4 == 1 ? arrTableFieldsQueryBuild.push('info_small4') : '';
            gSystemConfig.enableRegistersInfoS5 == 1 ? arrTableFieldsQueryBuild.push('info_small5') : '';
            gSystemConfig.enableRegistersInfoS6 == 1 ? arrTableFieldsQueryBuild.push('info_small6') : '';
            gSystemConfig.enableRegistersInfoS7 == 1 ? arrTableFieldsQueryBuild.push('info_small7') : '';
            gSystemConfig.enableRegistersInfoS8 == 1 ? arrTableFieldsQueryBuild.push('info_small8') : '';
            gSystemConfig.enableRegistersInfoS9 == 1 ? arrTableFieldsQueryBuild.push('info_small9') : '';
            gSystemConfig.enableRegistersInfoS10 == 1 ? arrTableFieldsQueryBuild.push('info_small10') : '';
            gSystemConfig.enableRegistersInfoS11 == 1 ? arrTableFieldsQueryBuild.push('info_small11') : '';
            gSystemConfig.enableRegistersInfoS12 == 1 ? arrTableFieldsQueryBuild.push('info_small12') : '';
            gSystemConfig.enableRegistersInfoS13 == 1 ? arrTableFieldsQueryBuild.push('info_small13') : '';
            gSystemConfig.enableRegistersInfoS14 == 1 ? arrTableFieldsQueryBuild.push('info_small14') : '';
            gSystemConfig.enableRegistersInfoS15 == 1 ? arrTableFieldsQueryBuild.push('info_small15') : '';
            gSystemConfig.enableRegistersInfoS16 == 1 ? arrTableFieldsQueryBuild.push('info_small16') : '';
            gSystemConfig.enableRegistersInfoS17 == 1 ? arrTableFieldsQueryBuild.push('info_small17') : '';
            gSystemConfig.enableRegistersInfoS18 == 1 ? arrTableFieldsQueryBuild.push('info_small18') : '';
            gSystemConfig.enableRegistersInfoS19 == 1 ? arrTableFieldsQueryBuild.push('info_small19') : '';
            gSystemConfig.enableRegistersInfoS20 == 1 ? arrTableFieldsQueryBuild.push('info_small20') : '';
            gSystemConfig.enableRegistersInfoS21 == 1 ? arrTableFieldsQueryBuild.push('info_small21') : '';
            gSystemConfig.enableRegistersInfoS22 == 1 ? arrTableFieldsQueryBuild.push('info_small22') : '';
            gSystemConfig.enableRegistersInfoS23 == 1 ? arrTableFieldsQueryBuild.push('info_small23') : '';
            gSystemConfig.enableRegistersInfoS24 == 1 ? arrTableFieldsQueryBuild.push('info_small24') : '';
            gSystemConfig.enableRegistersInfoS25 == 1 ? arrTableFieldsQueryBuild.push('info_small25') : '';
            gSystemConfig.enableRegistersInfoS26 == 1 ? arrTableFieldsQueryBuild.push('info_small26') : '';
            gSystemConfig.enableRegistersInfoS27 == 1 ? arrTableFieldsQueryBuild.push('info_small27') : '';
            gSystemConfig.enableRegistersInfoS28 == 1 ? arrTableFieldsQueryBuild.push('info_small28') : '';
            gSystemConfig.enableRegistersInfoS29 == 1 ? arrTableFieldsQueryBuild.push('info_small29') : '';
            gSystemConfig.enableRegistersInfoS30 == 1 ? arrTableFieldsQueryBuild.push('info_small30') : ''; // 127

            gSystemConfig.enableRegistersNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enableRegistersNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enableRegistersNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enableRegistersNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enableRegistersNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';

            gSystemConfig.enableRegistersNumberS1 == 1 ? arrTableFieldsQueryBuild.push('number_small1') : '';
            gSystemConfig.enableRegistersNumberS2 == 1 ? arrTableFieldsQueryBuild.push('number_small2') : '';
            gSystemConfig.enableRegistersNumberS3 == 1 ? arrTableFieldsQueryBuild.push('number_small3') : '';
            gSystemConfig.enableRegistersNumberS4 == 1 ? arrTableFieldsQueryBuild.push('number_small4') : '';
            gSystemConfig.enableRegistersNumberS5 == 1 ? arrTableFieldsQueryBuild.push('number_small5') : '';

            gSystemConfig.enableRegistersURL1 != 0 ? arrTableFieldsQueryBuild.push('url1') : '';
            gSystemConfig.enableRegistersURL2 != 0 ? arrTableFieldsQueryBuild.push('url2') : '';
            gSystemConfig.enableRegistersURL3 != 0 ? arrTableFieldsQueryBuild.push('url3') : '';
            gSystemConfig.enableRegistersURL4 != 0 ? arrTableFieldsQueryBuild.push('url4') : '';
            gSystemConfig.enableRegistersURL5 != 0 ? arrTableFieldsQueryBuild.push('url5') : '';

            gSystemConfig.enableRegistersDate1 == 1 ? arrTableFieldsQueryBuild.push('date1') : '';
            gSystemConfig.enableRegistersDate2 == 1 ? arrTableFieldsQueryBuild.push('date2') : '';
            gSystemConfig.enableRegistersDate3 == 1 ? arrTableFieldsQueryBuild.push('date3') : '';
            gSystemConfig.enableRegistersDate4 == 1 ? arrTableFieldsQueryBuild.push('date4') : '';
            gSystemConfig.enableRegistersDate5 == 1 ? arrTableFieldsQueryBuild.push('date5') : '';
            gSystemConfig.enableRegistersDate6 == 1 ? arrTableFieldsQueryBuild.push('date6') : '';
            gSystemConfig.enableRegistersDate7 == 1 ? arrTableFieldsQueryBuild.push('date7') : '';
            gSystemConfig.enableRegistersDate8 == 1 ? arrTableFieldsQueryBuild.push('date8') : '';
            gSystemConfig.enableRegistersDate9 == 1 ? arrTableFieldsQueryBuild.push('date9') : '';
            gSystemConfig.enableRegistersDate10 == 1 ? arrTableFieldsQueryBuild.push('date10') : ''; // 152

            gSystemConfig.enableRegistersImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableRegistersImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';
            gSystemConfig.enableRegistersImageLogo == 1 ? arrTableFieldsQueryBuild.push('image_logo') : '';
            gSystemConfig.enableRegistersImageBanner == 1 ? arrTableFieldsQueryBuild.push('image_banner') : '';

            gSystemConfig.enableRegistersFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableRegistersFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableRegistersFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableRegistersFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableRegistersFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';

            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableRegistersActivation1 == 1 ? arrTableFieldsQueryBuild.push('activation1') : '';
            gSystemConfig.enableRegistersActivation2 == 1 ? arrTableFieldsQueryBuild.push('activation2') : '';
            gSystemConfig.enableRegistersActivation3 == 1 ? arrTableFieldsQueryBuild.push('activation3') : '';
            gSystemConfig.enableRegistersActivation4 == 1 ? arrTableFieldsQueryBuild.push('activation4') : '';
            gSystemConfig.enableRegistersActivation5 == 1 ? arrTableFieldsQueryBuild.push('activation5') : '';
            gSystemConfig.enableRegistersStatus == 1 ? arrTableFieldsQueryBuild.push('id_status') : '';
            gSystemConfig.enableRegistersRestrictedAccess == 1 ? arrTableFieldsQueryBuild.push('restricted_access') : '';
            gSystemConfig.enableRegistersNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }

        // File fields.
        if (buildType == 'files') {
            gSystemConfig.enableRegistersImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableRegistersImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';
            gSystemConfig.enableRegistersImageLogo == 1 ? arrTableFieldsQueryBuild.push('image_logo') : '';
            gSystemConfig.enableRegistersImageBanner == 1 ? arrTableFieldsQueryBuild.push('image_banner') : '';
            gSystemConfig.enableRegistersFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableRegistersFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableRegistersFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableRegistersFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableRegistersFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';
        }
        }
        // ----------------------

        // Quizzes.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableQuizzes) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableQuizzesSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit', 'id_type');
            gSystemConfig.enableQuizzesBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';

            arrTableFieldsQueryBuild.push('title');
            gSystemConfig.enableQuizzesDescription == 1 ? arrTableFieldsQueryBuild.push('description') : '';
            arrTableFieldsQueryBuild.push('url_alias', 'keywords_tags', 'meta_description', 'meta_title', 'meta_info');

            gSystemConfig.enableQuizzesInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enableQuizzesInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enableQuizzesInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enableQuizzesInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enableQuizzesInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';

            gSystemConfig.enableQuizzesNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enableQuizzesNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enableQuizzesNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enableQuizzesNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enableQuizzesNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';

            gSystemConfig.enableQuizzesImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableQuizzesImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';

            gSystemConfig.enableQuizzesFile1 == 1 ? arrTableFieldsQueryBuild.push('file1') : '';
            gSystemConfig.enableQuizzesFile2 == 1 ? arrTableFieldsQueryBuild.push('file2') : '';
            gSystemConfig.enableQuizzesFile3 == 1 ? arrTableFieldsQueryBuild.push('file3') : '';
            gSystemConfig.enableQuizzesFile4 == 1 ? arrTableFieldsQueryBuild.push('file4') : '';
            gSystemConfig.enableQuizzesFile5 == 1 ? arrTableFieldsQueryBuild.push('file5') : '';

            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableQuizzesActivation1 == 1 ? arrTableFieldsQueryBuild.push('activation1') : '';
            gSystemConfig.enableQuizzesActivation2 == 1 ? arrTableFieldsQueryBuild.push('activation2') : '';
            gSystemConfig.enableQuizzesActivation3 == 1 ? arrTableFieldsQueryBuild.push('activation3') : '';
            gSystemConfig.enableQuizzesActivation4 == 1 ? arrTableFieldsQueryBuild.push('activation4') : '';
            gSystemConfig.enableQuizzesActivation5 == 1 ? arrTableFieldsQueryBuild.push('activation5') : '';
            gSystemConfig.enableQuizzesStatus == 1 ? arrTableFieldsQueryBuild.push('id_status') : '';
            arrTableFieldsQueryBuild.push('id_quizzes_options_answer');
            gSystemConfig.enableQuizzesNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }

        // File fields.
        if (buildType == 'files') {
            gSystemConfig.enableQuizzesImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            // gSystemConfig.enableQuizzesFile1 == 1 ? arrTableFieldsQueryBuild.push("file1") : '';
            // gSystemConfig.enableQuizzesFile2 == 1 ? arrTableFieldsQueryBuild.push("file2") : '';
            // gSystemConfig.enableQuizzesFile3 == 1 ? arrTableFieldsQueryBuild.push("file3") : '';
            // gSystemConfig.enableQuizzesFile4 == 1 ? arrTableFieldsQueryBuild.push("file4") : '';
            // gSystemConfig.enableQuizzesFile5 == 1 ? arrTableFieldsQueryBuild.push("file5") : '';
        }
        }
        // ----------------------

        // Quizzes Options.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableQuizzesOptions) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_quizzes'];
            gSystemConfig.enableQuizzesOptionsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit', 'title');
            // gSystemConfig.enableQuizzesOptionsDescription == 1 ? arrTableFieldsQueryBuild.push("description") : '';

            gSystemConfig.enableQuizzesOptionsInfo1 == 1 ? arrTableFieldsQueryBuild.push('info1') : '';
            gSystemConfig.enableQuizzesOptionsInfo2 == 1 ? arrTableFieldsQueryBuild.push('info2') : '';
            gSystemConfig.enableQuizzesOptionsInfo3 == 1 ? arrTableFieldsQueryBuild.push('info3') : '';
            gSystemConfig.enableQuizzesOptionsInfo4 == 1 ? arrTableFieldsQueryBuild.push('info4') : '';
            gSystemConfig.enableQuizzesOptionsInfo5 == 1 ? arrTableFieldsQueryBuild.push('info5') : '';

            gSystemConfig.enableQuizzesOptionsNumber1 == 1 ? arrTableFieldsQueryBuild.push('number1') : '';
            gSystemConfig.enableQuizzesOptionsNumber2 == 1 ? arrTableFieldsQueryBuild.push('number2') : '';
            gSystemConfig.enableQuizzesOptionsNumber3 == 1 ? arrTableFieldsQueryBuild.push('number3') : '';
            gSystemConfig.enableQuizzesOptionsNumber4 == 1 ? arrTableFieldsQueryBuild.push('number4') : '';
            gSystemConfig.enableQuizzesOptionsNumber5 == 1 ? arrTableFieldsQueryBuild.push('number5') : '';

            gSystemConfig.enableQuizzesOptionsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            gSystemConfig.enableQuizzesOptionsImageMainCaption == 1 ? arrTableFieldsQueryBuild.push('image_main_caption') : '';

            arrTableFieldsQueryBuild.push('activation');
        }

        // File fields.
        if (buildType == 'files') {
            gSystemConfig.enableQuizzesOptionsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
        }
        }
        // ----------------------

        // Forms.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableForms) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_parent'];
            gSystemConfig.enableFormsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // arrTableFieldsQueryBuild.push("date_creation", "date_timezone", "date_edit");
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit');
            gSystemConfig.enableFormBindRegisterUser == 1 ? arrTableFieldsQueryBuild.push('id_register_user') : '';
            arrTableFieldsQueryBuild.push('form_title', 'form_subject', 'recipient_name', 'recipient_email');
            gSystemConfig.enableFormsRecipientEmailCopy == 1 ? arrTableFieldsQueryBuild.push('recipient_email_copy') : '';
            gSystemConfig.enableFormsSender == 1 ? arrTableFieldsQueryBuild.push('sender_name', 'sender_email') : '';
            gSystemConfig.enableFormsSenderConfig == 1 ? arrTableFieldsQueryBuild.push('sender_config') : '';
            gSystemConfig.enableFormsEmailFormat == 1 ? arrTableFieldsQueryBuild.push('email_format') : '';
            gSystemConfig.enableFormsMessageSuccess == 1 ? arrTableFieldsQueryBuild.push('message_success') : '';
            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableFormsNotes == 1 ? arrTableFieldsQueryBuild.push('notes') : '';
        }
        }
        // ----------------------

        // Forms Fields.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableFormsFields) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_forms'];
            gSystemConfig.enableFormsFieldsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // arrTableFieldsQueryBuild.push("date_creation", "date_timezone", "date_edit", "field_type", "field_name", "field_name_formatted");
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit', 'field_type', 'field_name', 'field_name_formatted');
            gSystemConfig.enableFormsFieldsInstructions == 1 ? arrTableFieldsQueryBuild.push('field_instructions') : '';
            arrTableFieldsQueryBuild.push('field_size', 'field_height');
            gSystemConfig.enableFormsFieldsFieldFilter == 1 ? arrTableFieldsQueryBuild.push('field_filter') : '';
            gSystemConfig.enableFormsFieldsInfoS1 == 1 ? arrTableFieldsQueryBuild.push('info_small1') : '';
            gSystemConfig.enableFormsFieldsInfoS2 == 1 ? arrTableFieldsQueryBuild.push('info_small2') : '';
            gSystemConfig.enableFormsFieldsInfoS3 == 1 ? arrTableFieldsQueryBuild.push('info_small3') : '';
            gSystemConfig.enableFormsFieldsInfoS4 == 1 ? arrTableFieldsQueryBuild.push('info_small4') : '';
            gSystemConfig.enableFormsFieldsInfoS5 == 1 ? arrTableFieldsQueryBuild.push('info_small5') : '';
            arrTableFieldsQueryBuild.push('activation');
            gSystemConfig.enableFormsFieldsRequired == 1 ? arrTableFieldsQueryBuild.push('required') : '';
        }
        }
        // ----------------------

        // Forms Fields Options.
        // ----------------------
        if (strTable == gSystemConfig.configSystemDBTableFormsFieldsOptions) {
        if (buildType == 'all') {
            arrTableFieldsQueryBuild = ['id', 'id_forms_fields'];
            gSystemConfig.enableFormsFieldsOptionsSortOrder == 1 ? arrTableFieldsQueryBuild.push('sort_order') : '';
            // arrTableFieldsQueryBuild.push("date_creation", "date_timezone", "date_edit", "option_name", "option_name_formatted");
            arrTableFieldsQueryBuild.push('date_creation', 'date_edit', 'option_name', 'option_name_formatted');
            gSystemConfig.enableFormsFieldsOptionsConfigSelection == 1 ? arrTableFieldsQueryBuild.push('config_selection ') : '';
            gSystemConfig.enableFormsFieldsOptionsInfoS1 == 1 ? arrTableFieldsQueryBuild.push('info_small1') : '';
            gSystemConfig.enableFormsFieldsOptionsInfoS2 == 1 ? arrTableFieldsQueryBuild.push('info_small2') : '';
            gSystemConfig.enableFormsFieldsOptionsInfoS3 == 1 ? arrTableFieldsQueryBuild.push('info_small3') : '';
            gSystemConfig.enableFormsFieldsOptionsInfoS4 == 1 ? arrTableFieldsQueryBuild.push('info_small4') : '';
            gSystemConfig.enableFormsFieldsOptionsInfoS5 == 1 ? arrTableFieldsQueryBuild.push('info_small5') : '';
            gSystemConfig.enableFormsFieldsOptionsImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
            arrTableFieldsQueryBuild.push('activation');
        }
        }
        // ----------------------
        */
        // Filters generic.
        // ----------------------
        // if(strTable == "filters_generic")
        if ($strTable === config('app.gSystemConfig.configSystemDBTableFiltersGeneric')) {
            if ($buildType === 'all') {
                $arrTableFieldsQueryBuild = ['id'];
                config('app.gSystemConfig.enableFiltersGenericSortOrder') === 1 ? array_push($arrTableFieldsQueryBuild, 'sort_order') : '';
                array_push($arrTableFieldsQueryBuild, 'date_creation', 'date_edit', 'filter_index', 'table_name', 'title');
                config('app.gSystemConfig.enableFiltersGenericDescription') === 1 ? array_push($arrTableFieldsQueryBuild, 'description') : '';
                config('app.gSystemConfig.configFiltersGenericURLAlias') === 1 ? array_push($arrTableFieldsQueryBuild, 'url_alias') : '';
                config('app.gSystemConfig.enableFiltersGenericKeywordsTags') === 1 ? array_push($arrTableFieldsQueryBuild, 'keywords_tags') : '';
                config('app.gSystemConfig.enableFiltersGenericMetaDescription') === 1 ? array_push($arrTableFieldsQueryBuild, 'meta_description') : '';
                config('app.gSystemConfig.enableFiltersGenericMetaTitle') === 1 ? array_push($arrTableFieldsQueryBuild, 'meta_title') : '';
                array_push($arrTableFieldsQueryBuild, 'meta_info');
                config('app.gSystemConfig.enableFiltersGenericInfoS1') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small1') : '';
                config('app.gSystemConfig.enableFiltersGenericInfoS2') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small2') : '';
                config('app.gSystemConfig.enableFiltersGenericInfoS3') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small3') : '';
                config('app.gSystemConfig.enableFiltersGenericInfoS4') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small4') : '';
                config('app.gSystemConfig.enableFiltersGenericInfoS5') === 1 ? array_push($arrTableFieldsQueryBuild, 'info_small5') : '';
                config('app.gSystemConfig.enableFiltersGenericNumberS1') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small1') : '';
                config('app.gSystemConfig.enableFiltersGenericNumberS2') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small2') : '';
                config('app.gSystemConfig.enableFiltersGenericNumberS3') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small3') : '';
                config('app.gSystemConfig.enableFiltersGenericNumberS4') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small4') : '';
                config('app.gSystemConfig.enableFiltersGenericNumberS5') === 1 ? array_push($arrTableFieldsQueryBuild, 'number_small5') : '';
                config('app.gSystemConfig.enableFiltersGenericImageMain') === 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';
                config('app.gSystemConfig.enableFiltersGenericConfigSelection') === 1 ? array_push($arrTableFieldsQueryBuild, 'config_selection') : '';
                array_push($arrTableFieldsQueryBuild, 'activation');
                config('app.gSystemConfig.enableFiltersGenericActivation1') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation1') : '';
                config('app.gSystemConfig.enableFiltersGenericActivation2') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation2') : '';
                config('app.gSystemConfig.enableFiltersGenericActivation3') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation3') : '';
                config('app.gSystemConfig.enableFiltersGenericActivation4') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation4') : '';
                config('app.gSystemConfig.enableFiltersGenericActivation5') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation5') : '';
                config('app.gSystemConfig.enableFiltersGenericNotes') === 1 ? array_push($arrTableFieldsQueryBuild, 'notes') : '';
            }

            // File fields.
            if ($buildType === 'files') {
                config('app.gSystemConfig.enableFiltersGenericImageMain') === 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';
            }
        }
        // ----------------------

        // Filters generic binding.
        // ----------------------
        // if(strTable == "filters_generic_binding")
        if ($strTable === config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding')) {
            if ($buildType === 'all') {
                $arrTableFieldsQueryBuild = ['id', 'sort_order', 'date_creation', 'date_edit', 'id_filters_generic', 'id_filter_index', 'id_record', 'notes'];
            }
        }
        // ----------------------

        // Users.
        // ----------------------
        if ($strTable === config('app.gSystemConfig.configSystemDBTableUsers')) {
            if ($buildType === 'all') {
                $arrTableFieldsQueryBuild = ['id', 'id_parent'];
                config('app.gSystemConfig.enableUsersSortOrder') === 1 ? array_push($arrTableFieldsQueryBuild, 'sort_order') : '';
                array_push($arrTableFieldsQueryBuild, 'date_creation', 'date_timezone', 'date_edit');
                config('app.gSystemConfig.enableUsersType') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_type') : '';

                config('app.gSystemConfig.enableUsersNameTitle') === 1 ? array_push($arrTableFieldsQueryBuild, 'name_title') : '';
                config('app.gSystemConfig.enableUsersNameFull') === 1 ? array_push($arrTableFieldsQueryBuild, 'name_full') : '';
                config('app.gSystemConfig.enableUsersNameFirst') === 1 ? array_push($arrTableFieldsQueryBuild, 'name_first') : '';
                config('app.gSystemConfig.enableUsersNameLast') === 1 ? array_push($arrTableFieldsQueryBuild, 'name_last') : '';
                config('app.gSystemConfig.enableUsersDateBirth') !== 0 ? array_push($arrTableFieldsQueryBuild, 'date_birth') : '';
                config('app.gSystemConfig.enableUsersGender') === 1 ? array_push($arrTableFieldsQueryBuild, 'gender') : '';
                config('app.gSystemConfig.enableUsersDocument') === 1 ? array_push($arrTableFieldsQueryBuild, 'document') : '';
                config('app.gSystemConfig.enableUsersAddress') === 1 ? array_push($arrTableFieldsQueryBuild, 'address_street', 'address_number', 'address_complement', 'neighborhood', 'district', 'county', 'city', 'state', 'country', 'zip_code') : '';
                config('app.gSystemConfig.enableUsersPhone1') === 1 ? array_push($arrTableFieldsQueryBuild, 'phone1_international_code', 'phone1_area_code', 'phone1') : '';
                config('app.gSystemConfig.enableUsersPhone2') === 1 ? array_push($arrTableFieldsQueryBuild, 'phone2_international_code', 'phone2_area_code', 'phone2') : '';
                config('app.gSystemConfig.enableUsersPhone3') === 1 ? array_push($arrTableFieldsQueryBuild, 'phone3_international_code', 'phone3_area_code', 'phone3') : '';
                config('app.gSystemConfig.enableUsersUsername') === 1 ? array_push($arrTableFieldsQueryBuild, 'username') : '';
                config('app.gSystemConfig.enableUsersEmail') === 1 ? array_push($arrTableFieldsQueryBuild, 'email') : '';

                array_push($arrTableFieldsQueryBuild, 'password', 'password_hint', 'password_length');

                config('app.gSystemConfig.enableUsersInfo1') === 1 ? array_push($arrTableFieldsQueryBuild, 'info1') : '';
                config('app.gSystemConfig.enableUsersInfo2') === 1 ? array_push($arrTableFieldsQueryBuild, 'info2') : '';
                config('app.gSystemConfig.enableUsersInfo3') === 1 ? array_push($arrTableFieldsQueryBuild, 'info3') : '';
                config('app.gSystemConfig.enableUsersInfo4') === 1 ? array_push($arrTableFieldsQueryBuild, 'info4') : '';
                config('app.gSystemConfig.enableUsersInfo5') === 1 ? array_push($arrTableFieldsQueryBuild, 'info5') : '';
                config('app.gSystemConfig.enableUsersInfo6') === 1 ? array_push($arrTableFieldsQueryBuild, 'info6') : '';
                config('app.gSystemConfig.enableUsersInfo7') === 1 ? array_push($arrTableFieldsQueryBuild, 'info7') : '';
                config('app.gSystemConfig.enableUsersInfo8') === 1 ? array_push($arrTableFieldsQueryBuild, 'info8') : '';
                config('app.gSystemConfig.enableUsersInfo9') === 1 ? array_push($arrTableFieldsQueryBuild, 'info9') : '';
                config('app.gSystemConfig.enableUsersInfo10') === 1 ? array_push($arrTableFieldsQueryBuild, 'info10') : '';

                config('app.gSystemConfig.enableUsersImageMain') === 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';

                array_push($arrTableFieldsQueryBuild, 'activation');
                config('app.gSystemConfig.enableUsersActivation1') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation1') : '';
                config('app.gSystemConfig.enableUsersActivation2') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation2') : '';
                config('app.gSystemConfig.enableUsersActivation3') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation3') : '';
                config('app.gSystemConfig.enableUsersActivation4') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation4') : '';
                config('app.gSystemConfig.enableUsersActivation5') === 1 ? array_push($arrTableFieldsQueryBuild, 'activation5') : '';

                config('app.gSystemConfig.enableUsersStatus') === 1 ? array_push($arrTableFieldsQueryBuild, 'id_status') : '';
                config('app.gSystemConfig.enableUsersNotes') === 1 ? array_push($arrTableFieldsQueryBuild, 'notes') : '';
            }

            // File fields.
            if ($buildType === 'files') {
                config('app.gSystemConfig.enableUsersImageMain') == 1 ? array_push($arrTableFieldsQueryBuild, 'image_main') : '';
            }
        }

        /*
        // File fields.
        if (buildType == 'files') {
            // arrTableFieldsQueryBuild.push("image_main");
            gSystemConfig.enableUsersImageMain == 1 ? arrTableFieldsQueryBuild.push('image_main') : '';
        }
        }
        // ----------------------
        */
        // Data treatment.
        // ----------------------
        if ($returnMethod === 'array') {
            $strReturn = $arrTableFieldsQueryBuild;
        }
        if ($returnMethod === 'string') {
            $strReturn = implode(',', $arrTableFieldsQueryBuild);
        }
        // ----------------------

        return $strReturn;

        // Usage.
        // ----------------------
        // FunctionsGeneric.tableFieldsQueryBuild01("categories", "all", "string");
        // FunctionsGeneric.tableFieldsQueryBuild01(gSystemConfig.configSystemDBTableFiles, "all", "string");
        // ----------------------
    }
    // **************************************************************************************

    // Select image size array based on table.
    // **************************************************************************************
    /**
     * Select image size array based on table.
     * @static
     * @param string $strTable
     * @return array
     * @example \SyncSystemNS\FunctionsGeneric::arrImageSizeSelect($strTable)
     */
    public static function arrImageSizeSelect($strTable): array
    {
        // Variables.
        // ----------------------
        $arrReturn = config('app.gSystemConfig.configArrDefaultImageSize');
        // ----------------------

        // Logic.
        if ($strTable) {
            if (config('app.gSystemConfig.enableDefaultImageSize') === 0) {
                // Categories.
                if ($strTable == config('app.gSystemConfig.configSystemDBTableCategories')) {
                    $arrReturn = config('app.gSystemConfig.configArrCategoriesImageSize');
                }
                /*
                // Files.
                if (strTable == gSystemConfig.configSystemDBTableFiles) {
                    arrReturn = gSystemConfig.configArrFilesImageSize;
                }

                // Content.
                if (strTable == gSystemConfig.configSystemDBTableContent) {
                    arrReturn = gSystemConfig.configArrContentImageSize;
                }

                // Products.
                if (strTable == gSystemConfig.configSystemDBTableProducts) {
                    arrReturn = gSystemConfig.configArrProductsImageSize;
                }

                // Publications.
                if (strTable == gSystemConfig.configSystemDBTablePublications) {
                    arrReturn = gSystemConfig.configArrProductsImageSize;
                }

                // Registers.
                if (strTable == gSystemConfig.configSystemDBTableRegisters) {
                    arrReturn = gSystemConfig.configArrRegistersImageSize;
                }

                // Quizzes.
                if (strTable == gSystemConfig.configSystemDBTableQuizzes) {
                    arrReturn = gSystemConfig.configArrQuizzesImageSize;
                }

                // Quizzes options.
                if (strTable == gSystemConfig.configSystemDBTableQuizzesOptions) {
                    arrReturn = gSystemConfig.configArrQuizzesOptionsImageSize;
                }

                // Forms fields options.
                if (strTable == gSystemConfig.configSystemDBTableFormsFieldsOptions) {
                    arrReturn = gSystemConfig.configArrFormsFieldsOptionsImageSize;
                }
                */
                // Users.
                if ($strTable === config('app.gSystemConfig.configSystemDBTableUsers')) {
                    $arrReturn = config('app.gSystemConfig.configArrUsersImageSize');
                }
            }
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
