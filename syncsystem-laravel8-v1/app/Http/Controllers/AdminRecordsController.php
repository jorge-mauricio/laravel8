<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class AdminRecordsController extends AdminBaseController
{
    // Properties.
    // ----------------------
    /*
    private float|null $idParent = null;
    private float|null $fileType = null;
    private float|null $idQuizzes = null;

    private float|null $idForms = null;
    private float|null $idFormsFields = null;

    private float|null $filterIndex = null;

    private string $tableName = '';

    private string $pageReturn = '';
    private float|null $pageNumber = null;
    private string|null $masterPageSelect = 'layout-backend-main';
    */

    private string $messageSuccess = '';
    private string $messageError = '';
    private string $messageAlert = '';

    private string|null $apiKey = ''; // TODO: double check if this is necessary
    private string $returnURL = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct()
    {
        parent::__construct();
    }
    // **************************************************************************************

    // Handle records delete.
    // **************************************************************************************
    /**
     * Handle records delete.
     * @param Request $req
     * @return RedirectResponse
     */
    public function adminRecordsDelete(Request $req): RedirectResponse
    {
        //TODO: move this to it´s own controller: ex: adminRecordsController

        // Variables.
        // ----------------------
        $apiRecordsDeleteResponse = null;
        $arrRecordsDeleteJson = null;
        // ----------------------

        // Define values.
        // ----------------------
        // $tblRecordsID = null;
        //$tblRecordsIdParent = $req->post('id_parent');
        //$tblRecordsSortOrder = $req->post('sort_order');
        //$tblRecordsCategoryType = $req->post('category_type');

        //$this->idParent = $req->post('idParent');

        //$this->pageReturn = $req->post('pageReturn');
        //$this->pageNumber = $req->post('pageNumber');
        //$this->masterPageSelect = $req->post('masterPageSelect');

        $this->apiKey = $req->post('apiKey');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: create own method for page return URL build.
        /*
        $this->returnURL = '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendRecords'] . '/' . $this->idParentRecords . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        */

        /*
        $this->returnURL = '/' . $this->pageReturn;
        if ($this->idParent) {
            $this->returnURL .= '/' . $this->idParent;
        }
        if ($this->idQuizzes) {
            $this->returnURL .= '/' . $this->idQuizzes;
        }
        if ($this->idForms) {
            $this->returnURL .= '/' . $this->idForms;
        }
        if ($this->idFormsFields) {
            $this->returnURL .= '/' . $this->idFormsFields;
        }
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        if ($this->fileType) {
            $this->returnURL .= '&fileType=' . $this->fileType;
        }

        if ($this->tableName) {
            $this->returnURL .= '&tableName=' . $this->tableName;
        }
        if ($this->filterIndex) {
            $this->returnURL .= '&filterIndex=' . $this->filterIndex;
        }
        */

        $this->returnURL = $this->returnURLBuild($req);

        // Debug.
        //var_dump($this->returnURLBuild($req));
        //exit();
        // ----------------------

        // Logic.
        try {
            // API call.
            /**/
            //array_push($arrData, 'apiKey' => env('CONFIG_API_KEY_SYSTEM');
            //$arrData = array_merge($arrData, $req->all());
            $apiRecordsDeleteResponse = Http::withOptions(['verify' => false])->delete(env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPIRecords'] . '/', 
                array_merge(
                    ['apiKey' => env('CONFIG_API_KEY_SYSTEM')], 
                    $req->all()
                ) // ...$req->all() (splat only works on php 8.1 and up)
                /*'tblRecordsID' => $tblRecordsID,
                'tblRecordsIdParent' => $tblRecordsIdParent,
                'tblRecordsSortOrder' => $tblRecordsSortOrder,
                'tblRecordsCategoryType' => $tblRecordsCategoryType,
                */
                
            );
            $arrRecordsDeleteJson = $apiRecordsDeleteResponse->json();

            // Debug.
            //echo 'req=<pre>';
            //var_dump($req);
            //echo '</pre><br />';

            //echo 'req->input=<pre>';
            //var_dump($req->post('id_parent'));
            //echo '</pre><br />';
            //echo 'method=' . $method . '<br />';

            //echo 'req->post=<pre>';
            //var_dump($req->post('date1'));
            //echo '</pre><br />';

            //echo 'req->post(dateSQLWrite)=<pre>';
            //var_dump(\SyncSystemNS\FunctionsGeneric::dateSQLWrite($req->post('date1'), $GLOBALS['configBackendDateFormat']));
            //echo '</pre><br />';

            /*
            echo 'arrRecordsDeleteJson=<pre>';
            var_dump($arrRecordsDeleteJson);
            echo '</pre><br />'; // working (debug)
            */

            //echo 'req->all()=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //echo 'this->returnURL=<pre>';
            //var_dump($this->returnURL);
            //echo '</pre><br />';
            

            //echo 'pageNumber=' . $this->pageNumber . '<br />';
            //echo 'masterPageSelect=' . $this->masterPageSelect . '<br />';
            //exit();

        } catch (Error $adminRecordsDeleteError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminRecordsDeleteError: ' . $adminRecordsDeleteError->message());
            }
        } finally {
            //
        }

        //return $objRecordsDeleteJson; //debug.
        // Redirect.
        if ($arrRecordsDeleteJson['returnStatus'] === true) {
            return redirect($this->returnURL)->with('messageSuccess', $arrRecordsDeleteJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage10'));
        } else {
            return redirect($this->returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage10e'));
        }
    }
    // **************************************************************************************
}
