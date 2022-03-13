<?php
namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;
// use PDO;

class FunctionsDB
{
    // Function to return results from any table.
    // **************************************************************************************
    /**
     * Function to return results from any table.
     * @static
     * @param string strTable categories | content | files | publications | products | registers | quizzes | forms | forms_fields | forms_fields_options
     * @param array arrSearchParameters ["fieldNameSearch1;fieldValueSearch1;fieldTypeSearch1", "fieldNameSearch2;fieldValueSearch2;fieldTypeSearch2", "fieldNameSearch3;fieldValueSearch3;fieldTypeSearch3"]
     * @param string configSortOrder
     * @param string strNRecords
     * @param string strReturnFields field names, separated by commas. Ex: id, id_parent
     * @param integer searchType 1 - all results | 2 - first result | 3 - count records
     * @param object arrSpecialParameters
     * @return array
     */
    static function genericTableGet02($strTable,
        $arrSearchParameters,
        $configSortOrder = '',
        $strNRecords = '',
        $strReturnFields = '',
        $searchType = 1,
        $arrSpecialParameters = [ 'returnType' => 1 ]
    ): array|null
    {
        // Variables.
        // ----------------------
        (array) $arrReturn = null;

        (string) $strSQLGenericTableSelect = '';
        (array) $strSQLGenericTableSelectParams = [];

        $resultsSQLGenericTable = null;

        $pageNumber = array_key_exists('_pageNumber', $arrSpecialParameters) ? $arrSpecialParameters['_pageNumber'] : '';
        $pagingNRecords = array_key_exists('_pagingNRecords', $arrSpecialParameters) ? $arrSpecialParameters['_pagingNRecords'] : '';

        $strOperator = '';
        // ----------------------

        // Logic.
        try {
            //DB::setFetchMode(PDO::FETCH_ASSOC);
            // $resultsSQLGenericTable = DB::table('posts')->where('id', $id);
            //->toArray()
            $resultsSQLGenericTable = DB::table(env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $strTable)
                ->where('id', '!=', 0)
                ->get()->toArray();
            if ($resultsSQLGenericTable !== null) {
                $arrReturn = $resultsSQLGenericTable;
                //$arrReturn = $resultsSQLGenericTable["items"];
            }
        } catch (Error $genericTableGet02Error) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('genericTableGet02Error: ' . $genericTableGet02Error->message());
            }
        } finally {

        }

        // Debug.
        echo 'CONFIG_SYSTEM_DB_TABLE_PREFIX=' . env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . '<br />';

        //echo 'arrReturn=' . $arrReturn . '<br />';
        echo 'strSQLGenericTableSelect=' . $strSQLGenericTableSelect . '<br />';

        echo 'strSQLGenericTableSelectParams=<pre>';
        var_dump($strSQLGenericTableSelectParams);
        echo '</pre><br />';

        //echo 'resultsSQLGenericTable=<pre>';
        //var_dump($resultsSQLGenericTable);
        //echo '</pre><br />';
        
        echo 'pageNumber=' . $pageNumber . '<br />';
        echo 'pagingNRecords=' . $pagingNRecords . '<br />';
        echo 'strOperator=' . $strOperator . '<br />';

        return $arrReturn;
    }
    // **************************************************************************************
}