<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class AdminBaseController extends Controller
{
    // Properties.
    // ----------------------
    protected string|null $masterPageSelect = 'layout-admin-main';
    /*
    protected float|null $idParent = null;
    protected float|null $fileType = null;
    protected float|null $idQuizzes = null;

    protected float|null $idForms = null;
    protected float|null $idFormsFields = null;

    protected float|null $filterIndex = null;

    protected string $tableName = '';
    */
    // ----------------------

    // Constructor.
    // **************************************************************************************
    protected function __construct() {
        // Admin master page select priority.
        //$masterPageSelect = 'layout-admin-main';
        if (!empty($_GET['masterPageSelect'])) {
            $this->masterPageSelect = $_GET['masterPageSelect'];
        } 
        if (!empty($_POST['masterPageSelect'])) {
            $this->masterPageSelect = $_POST['masterPageSelect'];
        } 

        $pageNumber = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : '';
        $queryDefault = ''; // TODO: evaluate if it will remain in base controller or move to blade template.
        $cacheClear = '';

        //$messageSuccess = '';
        //isset($_GET['messageSuccess']) ? $messageSuccess = $_GET['messageSuccess'] : $messageSuccess = '';
        $messageSuccess = isset($_GET['messageSuccess']) ? $_GET['messageSuccess'] : '';
        $messageError = isset($_GET['messageError']) ? $_GET['messageError'] : '';
        $messageAlert = isset($_GET['messageAlert']) ? $_GET['messageAlert'] : '';

        // Current date values.
        $dateNow = new \DateTime(); // Y-m-d H:i:s
        $dateNowYear = $dateNow->format('Y');
        $dateNowMonth = $dateNow->format('m');
        $dateNowDay = $dateNow->format('d');
        
        $dateNowHour = $dateNow->format('H');
        $dateNowMinute = $dateNow->format('i');
        $dateNowSecond = $dateNow->format('s');

        // Build default return query.
        $queryDefault .= 'masterPageSelect=' . $this->masterPageSelect;
        if ($pageNumber !== '') {
            $queryDefault .= '&pageNumber=' . $pageNumber;
        }

        // Define values.
        $cacheClear = $dateNow->format('YmdHis'); // TODO: create a config option to enable.
            
        // Shere between views.
        // TODO: check if can be changed to array.
        View::share('masterPageSelect', $this->masterPageSelect);
        View::share('pageNumber', $pageNumber);
        View::share('cacheClear', $cacheClear);
        View::share('queryDefault', $queryDefault);

        View::share('messageSuccess', $messageSuccess);
        View::share('messageError', $messageError);
        View::share('messageAlert', $messageAlert);

        View::share('dateNow', $dateNow);
        View::share('dateNowDay', $dateNowDay);
        View::share('dateNowMonth', $dateNowMonth);
        View::share('dateNowYear', $dateNowYear);
        View::share('dateNowMinute', $dateNowMinute);
        View::share('dateNowHour', $dateNowHour);
        View::share('dateNowSecond', $dateNowSecond);
    }
    // **************************************************************************************

    // Build return URL for redirect.
    // **************************************************************************************
    /**
     * Build return URL for redirect.
     * @param Request $req
     * @return string
     */
    protected function returnURLBuild(Request $req): string
    {
        // Variables.
        // ----------------------
        $strReturn = '';

        $idParent = null;
        $fileType = null;
        $idQuizzes = null;
    
        $idForms = null;
        $idFormsFields = null;
    
        $filterIndex = null;
    
        $tableName = '';

        $pageReturn = '';
        $pageNumber = null;
        $masterPageSelect = 'layout-backend-main';
        // ----------------------

        // Define values.
        // ----------------------
        // $tblRecordsID = null;
        //$tblRecordsIdParent = $req->post('id_parent');
        //$tblRecordsSortOrder = $req->post('sort_order');
        //$tblRecordsCategoryType = $req->post('category_type');

        //$this->idParent = $req->post('idParent');
        $idParent = $req->idParent;

        //$this->pageReturn = $req->post('pageReturn');
        //$this->pageNumber = $req->post('pageNumber');
        //$this->masterPageSelect = $req->post('masterPageSelect');

        $pageReturn = $req->pageReturn;
        $pageNumber = $req->pageNumber;
        $masterPageSelect = $req->masterPageSelect;
        // ----------------------

        // Debug.
        /*
        echo 'idParent=<pre>';
        var_dump($idParent);
        echo '</pre><br />';
        if ($idParent) {
            echo 'idParent = true';
        } else {
            echo 'idParent = false';
        }
        exit();
        */

        // Logic.
        // ----------------------
        $strReturn = '/' . $pageReturn;
        if ($idParent !== null) {
            $strReturn .= '/' . $idParent;
        }
        if ($idQuizzes) {
            $strReturn .= '/' . $idQuizzes;
        }
        if ($idForms) {
            $strReturn .= '/' . $idForms;
        }
        if ($idFormsFields) {
            $strReturn .= '/' . $idFormsFields;
        }
        $strReturn .= '?masterPageSelect=' . $masterPageSelect;
        if ($pageNumber) {
            $strReturn .= '&pageNumber=' . $pageNumber;
        }
        if ($fileType) {
            $strReturn .= '&fileType=' . $fileType;
        }

        if ($tableName) {
            $strReturn .= '&tableName=' . $tableName;
        }
        if ($filterIndex) {
            $strReturn .= '&filterIndex=' . $filterIndex;
        }
        // ----------------------

        return $strReturn;
    }
    // **************************************************************************************
}
