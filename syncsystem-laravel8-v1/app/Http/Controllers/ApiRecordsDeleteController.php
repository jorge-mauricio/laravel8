<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiRecordsDeleteController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];

    private float|null $idParent = null;
    private float|null $fileType = null;
    private float|null $idQuizzes = null;

    private float|null $idForms = null;
    private float|null $idFormsFields = null;

    private float|null $filterIndex = null;

    private string|null $strTable = '';

    private string|null $pageReturn = '';
    private string|null $pageNumber = '';
    private string|null $masterPageSelect = 'layout-backend-main';

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';

    private array|null $idsRecordsDelete = [];

    private string|null $apiKey = ''; // TODO: double check if this is necessary


    private mixed $deleteRecordsGeneric10Result;
    private mixed $deleteRecordsFilesResult;
    private mixed $deleteRecordsFilesFields;

    private string $returnURL = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle record delete return data.
    // **************************************************************************************
    public function deleteRecords(Request $req): array
    {
        // Define values.
        //$this->idParent = $req->post('idParent');
        //$this->fileType = $req->post('fileType');
        //$this->idQuizzes = $req->post('idQuizzes');

        //$this->idForms = $req->post('idForms');
        //$this->idFormsFields = $req->post('idFormsFields');

        //$this->filterIndex = $req->post('filterIndex');

        $this->strTable = $req->post('strTable');

        //$this->pageReturn = $req->post('pageReturn');
        //$this->pageNumber = $req->post('pageNumber');
        //$this->masterPageSelect = $req->post('masterPageSelect');

        //$this->messageSuccess = $req->post('messageSuccess');
        //$this->messageError = $req->post('messageError');
        //$this->messageAlert = $req->post('messageAlert');


        //$this->idsRecordsDelete = explode(',', $req->post('idsRecordsDelete'));
        $this->idsRecordsDelete = $req->post('idsRecordsDelete');
        $this->apiKey = $req->post('apiKey'); // TODO: evaluate if this is necessary


        // Debug.
        //$this->arrReturn['strTable'] = $this->strTable;
        //$this->arrReturn['idsRecordsDelete'] = $this->idsRecordsDelete;

        // Logic.
        try {
            if (count($this->idsRecordsDelete) > 0) {
                $this->deleteRecordsFilesResult = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10($this->strTable, ['id;' . implode(',', $this->idsRecordsDelete) . ';ids']);

                // TODO: delete files
            }

            //$this->arrReturn['deleteRecordsFilesResult'] = $this->deleteRecordsFilesResult; // debug.
        } catch (Error $deleteRecordsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('deleteRecordsError: ' . $deleteRecordsError->message());
            }
        } finally {
            if ($this->deleteRecordsFilesResult['returnStatus'] === true) {
                $this->arrReturn['returnStatus'] = true;
                $this->arrReturn['nRecords'] = $this->deleteRecordsFilesResult['nRecords'];
            }
        }

        //$this->arrReturn['debug'] = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10('categories', ['id;238;i']); // debug
        //$this->arrReturn['debug'] = \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10($this->strTable, ['id;238;i']); // debug


        //return $this->arrRecordsPatchParameters; // debug
        //return $req; // debug
        return $this->arrReturn;
    }
    // **************************************************************************************
}
