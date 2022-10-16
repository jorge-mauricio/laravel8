<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\RecordsUpdate;

class ApiRecordsPatchController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    //private mixed $ruAPI;

    private string $strTable = '';
    private float|null $idRecord = null;
    private string $strField = '';
    private string|null $recordValue = null;
    private string $patchType = ''; // setValue | toggleValue | fileDelete
    private bool $ajaxFunction = false; // true - using ajax | false - not using ajax (using redirection)
    private string $apiKey = ''; // TODO: double check if this is necessary

    private array|null $arrRecordsPatchParameters = [];
    private mixed $resultsSQLRecordsUpdate;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle record edit and return data.
    // TODO: move to AdminRecordsController.
    // **************************************************************************************
    public function patchRecords(Request $req): array
    {
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
        $this->strTable = $req->post('strTable');
        $this->idRecord = (float)$req->post('idRecord');
        $this->strField = $req->post('strField');
        $this->recordValue = $req->post('recordValue');
        $this->patchType = $req->post('patchType');
        $this->ajaxFunction = (bool)$req->post('ajaxFunction');
        $this->apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary

        // Debug.
        //echo 'req->all() (inside api records patch controller=<pre>';
        //var_dump($req->all());
        //var_dump($req);
        //echo '</pre><br />';


        // Logic.
        try {

            // toggleValue
            //if ($this->arrRecordsPatchParameters['_patchType'] === 'toggleValue') {
            if ($this->patchType === 'toggleValue') {
                    // Variables.
                $valueCurrent = '';
                $valueUpdate = '';

                // Get current value.
                //$valueCurrent = \SyncSystemNS\FunctionsDB::genericFieldGet01($this->arrRecordsPatchParameters['_idRecord'], $GLOBALS['configSystemDBTableCategories'], $this->arrRecordsPatchParameters['_strField']);
                $valueCurrent = \SyncSystemNS\FunctionsDB::genericFieldGet01($this->idRecord, $GLOBALS['configSystemDBTableCategories'], $this->strField);

                // Define update value.
                if ($valueCurrent === '1') {
                    $valueUpdate = '0';
                } else {
                    $valueUpdate = '1';
                }

                // Update parameters.
                //$this->arrRecordsPatchParameters['_recordValue'] = $valueUpdate;

                // update record.
                $this->resultsSQLRecordsUpdate = \SyncSystemNS\FunctionsDBUpdate::updateRecordGeneric10($this->strTable, $this->strField, $valueUpdate, ['id;' . $this->idRecord . ';i']);
                if ($this->resultsSQLRecordsUpdate['returnStatus'] === true) {
                    $this->arrReturn['returnStatus'] = $this->resultsSQLRecordsUpdate['returnStatus'];
                    $this->arrReturn['nRecords'] = $this->resultsSQLRecordsUpdate['nRecords'];
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
}
