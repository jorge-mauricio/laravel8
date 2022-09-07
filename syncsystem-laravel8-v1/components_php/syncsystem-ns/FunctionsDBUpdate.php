<?php
namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;

class FunctionsDBUpdate
{

    // Function to update a generic record field.
    // **************************************************************************************
    /**
     * Function to update a generic record field.
     * @static
     * @param string strTable
     * @param string strField
     * @param string recordValue
     * @param array arrSearchParameters
     * @return array|null
     * @example
     * $updateRecordsGeneric10Result = \SyncSystemNS\FunctionsDBUpdate::updateRecordGeneric10(strTable, 
     * strField, 
     * recordValue, 
     * ['id;' . idRecord . ';i']);
     */
    static function updateRecordGeneric10(string $strTable, 
    string $strField, 
    string $recordValue, 
    ?array $arrSearchParameters): array|null
    {
        // $arrSearchParameters: ['fieldNameSearch1;fieldValueSearch1;fieldTypeSearch1', 'fieldNameSearch2;fieldValueSearch2;fieldTypeSearch2', 'fieldNameSearch3;fieldValueSearch3;fieldTypeSearch3']
        // $typeFieldSearch1: s (string) | i (integer) | d (date) | dif (initial date and final date) | ids (id IN)

        // Variables.
        // ----------------------
        // let strReturn = false;
        $arrReturn = [ 'returnStatus' => false, 'nRecords' => 0 ];
        $objSQLRecordsGenericUpdate = '';
        $arrSQLRecordsGenericUpdateParams = [];
        $resultsSQLRecordsGenericUpdate = null;

        $strOperator = '';
        // ----------------------

        // Logic.
        try {
            $objSQLRecordsGenericUpdate = DB::table(env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $strTable);

            // Parameters.
            if (count($arrSearchParameters) > 0) {
                // Loop through parameters.
                for ($countArray = 0; $countArray < count($arrSearchParameters); $countArray++) {
                    $arrSearchParametersInfo = explode(';', $arrSearchParameters[$countArray]);
                    $searchParametersFieldName = $arrSearchParametersInfo[0];
                    $searchParametersFieldValue = $arrSearchParametersInfo[1];
                    $searchParametersFieldType = $arrSearchParametersInfo[2];
    
                    // Integer.
                    if ($searchParametersFieldType === 'i') {
                        $objSQLRecordsGenericUpdate = $objSQLRecordsGenericUpdate->where($searchParametersFieldName, '=', (float)\SyncSystemNS\FunctionsGeneric::contentMaskWrite($searchParametersFieldValue, 'db_sanitize'));
                    }
                }
            }

            $arrSQLRecordsGenericUpdateParams = [$strField => $recordValue];

            $objSQLRecordsGenericUpdate = $objSQLRecordsGenericUpdate->update($arrSQLRecordsGenericUpdateParams);

            // Debug.
            // dd($apiCategoriesListingCurrentResponse);
            // echo 'objSQLRecordsGenericUpdate=<pre>';
            // var_dump($objSQLRecordsGenericUpdate);
            // echo '</pre>';

            //echo 'updateRecordGeneric10=' . $objSQLRecordsGenericUpdate . '<br />';

        } catch (Error $updateRecordGeneric10Error) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('updateRecordGeneric10Error: ' . $updateRecordGeneric10Error->message());
            }
        } finally {
            // Build return array.
            if ($objSQLRecordsGenericUpdate >= 0) {
                // Note: If values are the same, it will return 0 and not update DB.
                if ($objSQLRecordsGenericUpdate === 0) {
                    $arrReturn = ['returnStatus' => true, 'nRecords' => 1];
                } else {
                    $arrReturn = ['returnStatus' => true, 'nRecords' => $objSQLRecordsGenericUpdate];
                }
            }
        }

        return $arrReturn;
        // Usage.
        // ----------------------
        /*
            $updateRecordsGeneric10Result = \SyncSystemNS\FunctionsDBUpdate::deleteRecordsGeneric10(strTable, 
                strField, 
                recordValue, 
                ["id;"+ idRecord + ";i"]);
            */
        // ----------------------
    }
    // **************************************************************************************

}
