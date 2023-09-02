<?php

declare(strict_types=1);

namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;

class FunctionsDBInsert
{
    // Filters Generic Binding - insert record.
    // **************************************************************************************
    /**
     * Filters Generic Binding - insert record.
     * @static
     * @param array _tblFiltersGenericBindingDataArray
     * @param int returnMethod 1 - boolean | 2 - object
     * @return bool true - successful | false - error
     * @example
     * \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
     *      '_tblFiltersGenericBindingID' => '',
     *      '_tblFiltersGenericBindingSortOrder' => '',
     *      '_tblFiltersGenericBindingDateCreation' => '',
     *      '_tblFiltersGenericBindingDateEdit' => '',
     *      '_tblFiltersGenericBindingIdFiltersGeneric' => $arrIdsCategoriesFiltersGeneric1[$countArray],
     *      '_tblFiltersGenericBindingIdFilterIndex' => 101,
     *      '_tblFiltersGenericBindingIdRecord' => $tblCategoriesID,
     *      '_tblFiltersGenericBindingNotes' => ''
     *  ]);
     */
    public static function filtersGenericBindingInsert(
        array $_tblFiltersGenericBindingDataArray,
        int $returnMethod = 1
    ): bool {
        // Variables.
        // ----------------------
        $boolReturn = false;
        $arrReturn = [];

        $tblFiltersGenericBindingDataArray = [];

        // Details - default values.
        $tblFiltersGenericBindingID = '';
        $tblFiltersGenericBindingSortOrder = 0;
        $tblFiltersGenericBindingDateCreation = ''; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
        $tblFiltersGenericBindingDateEdit = '';
        $tblFiltersGenericBindingIdFiltersGeneric = 0;
        $tblFiltersGenericBindingIdFilterIndex = 0;
        $tblFiltersGenericBindingIdRecord = 0;
        $tblFiltersGenericBindingNotes = '';

        $strSQLFiltersGenericBindingInsert = '';
        $strSQLFiltersGenericBindingInsertParams = [];
        $resultsSQLFiltersGenericBindingInsert = null;
        // ----------------------

        // Logic.
        try {
            // Define variables.
            // ----------------------
            $tblFiltersGenericBindingDataArray = $_tblFiltersGenericBindingDataArray;

            $tblFiltersGenericBindingID = isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingID']) && $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingID'] !== '' ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingID'] : \SyncSystemNS\FunctionsDB::counterUniversalUpdate();

            $tblFiltersGenericBindingSortOrder = isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingSortOrder'])  && $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingSortOrder'] !== '' ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingSortOrder'] : $tblFiltersGenericBindingSortOrder;

            $tblFiltersGenericBindingDateCreation = isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingDateCreation']) ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingDateCreation'] : $tblFiltersGenericBindingDateCreation;
            if ($tblFiltersGenericBindingDateCreation === '') {
                $tblFiltersGenericBindingDateCreation_dateObj = new \DateTime();
                $tblFiltersGenericBindingDateCreation = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblFiltersGenericBindingDateCreation_dateObj);
            }

            $tblFiltersGenericBindingDateEdit = isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingDateEdit']) ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingDateEdit'] : $tblFiltersGenericBindingDateEdit;
            if ($tblFiltersGenericBindingDateEdit === '') {
                $tblFiltersGenericBindingDateEdit_dateObj = new \DateTime();
                $tblFiltersGenericBindingDateEdit = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblFiltersGenericBindingDateEdit_dateObj);
            }

            $tblFiltersGenericBindingIdFiltersGeneric = (isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFiltersGeneric']) && $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFiltersGeneric'] !== null) ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFiltersGeneric'] : $tblFiltersGenericBindingIdFiltersGeneric;
            $tblFiltersGenericBindingIdFilterIndex = (isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFilterIndex']) && $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFilterIndex'] !== null) ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdFilterIndex'] : $tblFiltersGenericBindingIdFilterIndex;
            $tblFiltersGenericBindingIdRecord = (isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdRecord']) && $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdRecord'] !== null) ? $tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingIdRecord'] : $tblFiltersGenericBindingIdRecord;
            $tblFiltersGenericBindingNotes = isset($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingNotes']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($tblFiltersGenericBindingDataArray['_tblFiltersGenericBindingNotes'], 'db_write_text') : $tblFiltersGenericBindingNotes;
            // ----------------------

            // Query.
            // ----------------------
            $strSQLFiltersGenericBindingInsert = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'));
            // ----------------------

            // Parameters.
            // ----------------------
            $strSQLFiltersGenericBindingInsertParams['id'] = $tblFiltersGenericBindingID;
            $strSQLFiltersGenericBindingInsertParams['sort_order'] = $tblFiltersGenericBindingSortOrder;
            $strSQLFiltersGenericBindingInsertParams['date_creation'] = $tblFiltersGenericBindingDateCreation;
            $strSQLFiltersGenericBindingInsertParams['date_edit'] = $tblFiltersGenericBindingDateEdit;
            $strSQLFiltersGenericBindingInsertParams['id_filters_generic'] = $tblFiltersGenericBindingIdFiltersGeneric;
            $strSQLFiltersGenericBindingInsertParams['id_filter_index'] = $tblFiltersGenericBindingIdFilterIndex;
            $strSQLFiltersGenericBindingInsertParams['id_record'] = $tblFiltersGenericBindingIdRecord;
            $strSQLFiltersGenericBindingInsertParams['notes'] = $tblFiltersGenericBindingNotes;
            // ----------------------

            // Execute query.
            // ----------------------
            $resultsSQLFiltersGenericBindingInsert = $strSQLFiltersGenericBindingInsert->insert($strSQLFiltersGenericBindingInsertParams);
            if ($resultsSQLFiltersGenericBindingInsert === true) {
                $boolReturn = true;
            }
            // ----------------------
        } catch (\Exception $filtersGenericBindingInsertError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('filtersGenericBindingInsertError: ' . $filtersGenericBindingInsertError->getMessage());
            }
        } finally {
            //
        }

        return $boolReturn;

        // Usage
        // ----------------------
        /*
            \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                '_tblFiltersGenericBindingID' => '',
                '_tblFiltersGenericBindingSortOrder' => '',
                '_tblFiltersGenericBindingDateCreation' => '',
                '_tblFiltersGenericBindingDateEdit' => '',
                '_tblFiltersGenericBindingIdFiltersGeneric' => $arrIdsCategoriesFiltersGeneric1[$countArray],
                '_tblFiltersGenericBindingIdFilterIndex' => 101,
                '_tblFiltersGenericBindingIdRecord' => $tblCategoriesID,
                '_tblFiltersGenericBindingNotes' => ''
            ]);
        */
        // ----------------------
    }
    // **************************************************************************************
}
