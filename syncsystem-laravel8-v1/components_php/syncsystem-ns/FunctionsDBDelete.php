<?php

declare(strict_types=1);

namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;

class FunctionsDBDelete
{
    // Function to delete generic records.
    // **************************************************************************************
    /**
     * Function to delete generic records.
     * @static
     * @param string $strTable
     * @param array $arrSearchParameters
     * @return array|null
     * @example
     * $deleteRecordsGeneric10Result = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(strTable,
     * ['id;' . $idRecord . ';i']);
     */
    public static function deleteRecordsGeneric10(string $strTable, ?array $arrSearchParameters): array|null
    {
        // Variables.
        // ----------------------
        // let strReturn = false;
        $arrReturn = ['returnStatus' => false, 'nRecords' => 0];

        $objSQLRecordsGenericDelete = '';
        $arrSQLRecordsGenericDeleteParams = [];
        $resultsSQLRecordsGenericDelete = null;

        $strOperator = '';
        // ----------------------

        // Logic.
        try {
            $objSQLRecordsGenericDelete = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . $strTable);

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
                        $objSQLRecordsGenericDelete = $objSQLRecordsGenericDelete->where($searchParametersFieldName, '=', (float)\SyncSystemNS\FunctionsGeneric::contentMaskWrite($searchParametersFieldValue, 'db_sanitize'));
                    }

                    // ids.
                    if ($searchParametersFieldType === 'ids') {
                        //$arrIds = explode(',', $searchParametersFieldValue);
                        //$objSQLRecordsGenericDelete = $objSQLRecordsGenericDelete->whereIn($searchParametersFieldName, '=', $arrIds);
                        $objSQLRecordsGenericDelete = $objSQLRecordsGenericDelete->whereIn($searchParametersFieldName, explode(',', $searchParametersFieldValue));
                    }
                }
            }

            //$arrSQLRecordsGenericDeleteParams = [$strField => $recordValue];

            //$objSQLRecordsGenericDelete = $objSQLRecordsGenericDelete->delete($arrSQLRecordsGenericDeleteParams);
            $objSQLRecordsGenericDelete = $objSQLRecordsGenericDelete->delete();

            // Debug.
            // dd($apiCategoriesListingCurrentResponse);
            //echo 'arrSQLRecordsGenericDeleteParams=<pre>';
            //var_dump($arrSQLRecordsGenericDeleteParams);
            //echo '</pre>';

            //echo 'objSQLRecordsGenericDelete=<pre>';
            //var_dump($objSQLRecordsGenericDelete);
            //echo '</pre>';

            //echo 'updateRecordGeneric10=' . $objSQLRecordsGenericDelete . '<br />';

            // Build return array.
            if ($objSQLRecordsGenericDelete >= 0) {
                // Note: If values are the same, it will return 0 and not update DB.
                if ($objSQLRecordsGenericDelete === 0) {
                    $arrReturn = ['returnStatus' => true, 'nRecords' => 1];
                } else {
                    $arrReturn = ['returnStatus' => true, 'nRecords' => $objSQLRecordsGenericDelete];
                }
            }
        } catch (\Exception $updateRecordGeneric10Error) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('updateRecordGeneric10Error: ' . $updateRecordGeneric10Error->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
        // Usage.
        // ----------------------
        /*
            $updateRecordsGeneric10Result = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10('strTable',
                ["id;". idRecord . ";i"]);
            */
        // ----------------------
    }
    // **************************************************************************************
}
