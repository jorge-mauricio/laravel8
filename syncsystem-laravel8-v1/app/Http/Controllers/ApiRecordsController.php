<?php

declare(strict_types=1);

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
        } catch (\Exception $deleteRecordsError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('deleteRecordsError: ' . $deleteRecordsError->getMessage());
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

        // Debug.

        // echo 'req() (inside api records patch controller)=<pre>';
        // var_dump(json_last_error());
        // var_dump($req->all());
        // var_dump($req->strField);
        // var_dump($req);
        // var_dump($req->post());
        // var_dump($req->getContent()); // working
        // var_dump(json_decode($req->getContent(), true)); // working
        // var_dump(json_encode($req->getContent()));
        // var_dump($req->json()->all()['strTable']); // working
        // var_dump($req->json()); // working

        // var_dump($req->all('strTable'));
        // echo '</pre><br />';
        // exit();


        // Define values.
        // ----------------------
        /* not working with $req->post() method
        $strTable = $req->post('strTable');
        $idRecord = (float) $req->post('idRecord');
        $strField = $req->post('strField');
        $recordValue = $req->post('recordValue');
        $patchType = $req->post('patchType');
        $ajaxFunction = (bool) $req->post('ajaxFunction');
        $this->apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary
        */

        $strTable = $req->json()->all()['strTable'];
        $idRecord = (float) $req->json()->all()['idRecord'];
        $strField = $req->json()->all()['strField'];
        $recordValue = $req->json()->all()['recordValue'];
        $patchType = $req->json()->all()['patchType'];
        $ajaxFunction = (bool) $req->json()->all()['ajaxFunction'];
        $this->apiKey = $req->json()->all()['apiKey']; // TODO: evaluate if this is necessary
        // ----------------------

        // Debug.
        // echo 'req->all() (inside api records patch controller=<pre>';
        // var_dump($req->all());
        // var_dump($req);
        // var_dump($req->post('patchType'));
        // echo '</pre><br />';
        // exit();

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
                $valueCurrent = \SyncSystemNS\FunctionsDB::genericFieldGet01($idRecord, config('app.gSystemConfig.configSystemDBTableCategories'), $strField);

                // Define update value.
                if ($valueCurrent === '1') {
                    $valueUpdate = '0';
                } else {
                    $valueUpdate = '1';
                }

                // Update parameters.
                //$this->arrRecordsPatchParameters['_recordValue'] = $valueUpdate;

                // Debug.
                // echo 'strTable=<pre>';
                // var_dump($strTable);
                // echo '</pre>';
                // echo 'strField=<pre>';
                // var_dump($strField);
                // echo '</pre>';
                // echo 'valueUpdate=<pre>';
                // var_dump($valueUpdate);
                // echo '</pre>';
                //exit();

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
        } catch (\Exception $patchRecordsError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('patchRecordsError: ' . $patchRecordsError->getMessage());
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
        } catch (\Exception $patchRecordsError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('patchRecordsError: ' . $patchRecordsError->getMessage());
            }
        } finally {
            //
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
}
