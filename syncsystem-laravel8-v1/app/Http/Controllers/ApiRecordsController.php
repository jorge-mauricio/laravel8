<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\RecordsUpdate;

class ApiRecordsController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $apiKey = ''; // TODO: double check if this is necessary
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param Request $req
     */
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle record delete return data.
    // **************************************************************************************
    /**
     * Handle record delete return data.
     * @param Request $req
     * @return array
     */
    public function deleteRecords(Request $req): array
    {
        // Variables.
        // ----------------------
        $strTable = '';
        $idsRecordsDelete = null;
        $deleteRecordsFilesResult = null;
        // ----------------------

        // Define values.
        // ----------------------
        $strTable = $req->post('strTable');
        $idsRecordsDelete = $req->post('idsRecordsDelete');
        $apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary
        // ----------------------

        // Debug.
        //$this->arrReturn['strTable'] = $this->strTable;
        //$this->arrReturn['idsRecordsDelete'] = $this->idsRecordsDelete;

        // Logic.
        try {
            if (count($idsRecordsDelete) > 0) {
                $deleteRecordsFilesResult = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10($strTable, ['id;' . implode(',', $idsRecordsDelete) . ';ids']);

                // TODO: delete files
            }

            //$this->arrReturn['deleteRecordsFilesResult'] = $this->deleteRecordsFilesResult; // debug.
        } catch (Error $deleteRecordsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('deleteRecordsError: ' . $deleteRecordsError->message());
            }
        } finally {
            if ($deleteRecordsFilesResult['returnStatus'] === true) {
                $this->arrReturn['returnStatus'] = true;
                $this->arrReturn['nRecords'] = $deleteRecordsFilesResult['nRecords'];
            }
        }

        //$this->arrReturn['debug'] = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10('categories', ['id;238;i']); // debug
        //$this->arrReturn['debug'] = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10($this->strTable, ['id;238;i']); // debug


        //return $this->arrRecordsPatchParameters; // debug
        //return $req; // debug
        return $this->arrReturn;
    }
    // **************************************************************************************

    // Handle record edit (single field) and return data.
    // TODO: move to AdminRecordsController (evaluate).
    // **************************************************************************************
    /**
     * Handle record edit (single field) and return data.
     * @param Request $req
     * @return array
     */
    public function patchRecords(Request $req): array
    {
        // Variables.
        // ----------------------
        $strTable = '';
        $idRecord = null;
        $strField = '';
        $patchType = '';
        $ajaxFunction = '';
        $recordValue = null;
        // $arrRecordsPatchParameters = [];
        $resultsSQLRecordsUpdate = null;
        // ----------------------

        // Build parameters.
        /*
        $this->arrRecordsPatchParameters['_strTable'] = $req->post('strTable');
        $this->arrRecordsPatchParameters['_idRecord'] = (float)$req->post('idRecord');
        //$this->arrRecordsPatchParameters['_idRecord'] = (float)$req->input('idRecord');
        //$this->arrRecordsPatchParameters['_idRecord'] = (float)$req->idRecord;
        $this->arrRecordsPatchParameters['_strField'] = $req->post('strField');
        $this->arrRecordsPatchParameters['_recordValue'] = $req->post('recordValue');
        $this->arrRecordsPatchParameters['_patchType'] = $req->post('patchType');
        $this->arrRecordsPatchParameters['_ajaxFunction'] = (bool)$req->post('ajaxFunction');
        $this->arrRecordsPatchParameters['_apiKey'] = $req->post('apiKey'); // TODO: evaluate if this is necessary
        */

        // Define values.
        // ----------------------
        $strTable = $req->post('strTable');
        $idRecord = (float)$req->post('idRecord');
        $strField = $req->post('strField');
        $recordValue = $req->post('recordValue');
        $patchType = $req->post('patchType');
        $ajaxFunction = (bool)$req->post('ajaxFunction');
        $this->apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary
        // ----------------------

        // Debug.
        //echo 'req->all() (inside api records patch controller=<pre>';
        //var_dump($req->all());
        //var_dump($req);
        //echo '</pre><br />';

        // Logic.
        try {
            // toggleValue
            //if ($this->arrRecordsPatchParameters['_patchType'] === 'toggleValue') {
            //if ($this->patchType === 'toggleValue') {
            if ($patchType === 'toggleValue') {
                // Variables.
                $valueCurrent = '';
                $valueUpdate = '';

                // Get current value.
                //$valueCurrent = \SyncSystemNS\FunctionsDB::genericFieldGet01($this->arrRecordsPatchParameters['_idRecord'], $GLOBALS['configSystemDBTableCategories'], $this->arrRecordsPatchParameters['_strField']);
                $valueCurrent = \SyncSystemNS\FunctionsDB::genericFieldGet01($idRecord, $GLOBALS['configSystemDBTableCategories'], $strField);

                // Define update value.
                if ($valueCurrent === '1') {
                    $valueUpdate = '0';
                } else {
                    $valueUpdate = '1';
                }

                // Update parameters.
                //$this->arrRecordsPatchParameters['_recordValue'] = $valueUpdate;

                // update record.
                $resultsSQLRecordsUpdate = \SyncSystemNS\FunctionsDBUpdate::updateRecordGeneric10($strTable, $strField, $valueUpdate, ['id;' . $idRecord . ';i']);
                if ($resultsSQLRecordsUpdate['returnStatus'] === true) {
                    $this->arrReturn['returnStatus'] = $resultsSQLRecordsUpdate['returnStatus'];
                    $this->arrReturn['nRecords'] = $resultsSQLRecordsUpdate['nRecords'];
                    $this->arrReturn['recordUpdatedValue'] = $valueUpdate;
                    
                } else {
                    $this->arrReturn['errorMessage'] = 'statusMessageAPI2e';
                }
                //$this->ruAPI = new RecordsUpdate($this->arrRecordsPatchParameters);
                //$this->arrReturn = $this->ruAPI->updateRecord();
            }
        } catch (Error $patchRecordsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('patchRecordsError: ' . $patchRecordsError->message());
            }
        } finally {
            //
        }

        //return $this->arrRecordsPatchParameters; // debug
        //return $req; // debug
        return $this->arrReturn;
    }
    // **************************************************************************************

    // Handle record edit (multiple fields) and return data.
    // TODO: move to AdminRecordsController (evaluate).
    // **************************************************************************************
    /**
     * Handle record edit (multiple fields) and return data.
     * @param Request $req
     * @return array
     */
    public function editRecords(Request $req): array
    {
        // Variables.
        // ----------------------
        $strTable = '';
        $idRecord = null;
        // $strField = '';
        // $recordValue = null;
        $arrData = null;
        $patchType = '';
        $ajaxFunction = '';
        // $arrRecordsPatchParameters = [];
        $resultsSQLRecordsUpdate = null;
        // ----------------------

        // Define values.
        // ----------------------
        $strTable = $req->post('strTable');
        $idRecord = (float)$req->post('idRecord');
        // $strField = $req->post('strField');
        // $recordValue = $req->post('recordValue');
        $arrData = $req->post('arrData');
        $patchType = $req->post('patchType');
        $ajaxFunction = (bool)$req->post('ajaxFunction');
        $this->apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary
        // ----------------------

        // Debug.
        //echo '$arrData (inside api records patch controller=<pre>';
        //var_dump($arrData);
        //echo '</pre><br />';
        //exit();

        // Logic.
        try {
            // Update parameters.
            //$this->arrRecordsPatchParameters['_recordValue'] = $valueUpdate;

            // update record.
            $resultsSQLRecordsUpdate = \SyncSystemNS\FunctionsDBUpdate::updateRecordMultipleGeneric($strTable, $arrData, ['id;' . $idRecord . ';i']);
            if ($resultsSQLRecordsUpdate['returnStatus'] === true) {
                $this->arrReturn['returnStatus'] = $resultsSQLRecordsUpdate['returnStatus'];
                $this->arrReturn['nRecords'] = $resultsSQLRecordsUpdate['nRecords'];
                //$this->arrReturn['recordUpdatedValue'] = $valueUpdate;
                
            } else {
                $this->arrReturn['errorMessage'] = 'statusMessageAPI2e';
            }
        } catch (Error $patchRecordsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('patchRecordsError: ' . $patchRecordsError->message());
            }
        } finally {
            //
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
}
