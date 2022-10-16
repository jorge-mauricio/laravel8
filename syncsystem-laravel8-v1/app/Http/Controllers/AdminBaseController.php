<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class AdminBaseController extends Controller
{
    // Properties.
    // ----------------------
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
        $masterPageSelect = 'layout-admin-main';
        if (!empty($_GET['masterPageSelect'])) {
            $masterPageSelect = $_GET['masterPageSelect'];
        } 
        if (!empty($_POST['masterPageSelect'])) {
            $masterPageSelect = $_POST['masterPageSelect'];
        } 

        $pageNumber = '';

        $messageSuccess = '';
        isset($_GET['messageSuccess']) ? $messageSuccess = $_GET['messageSuccess'] : $messageSuccess = '';
        $messageError = '';
        $messageAlert = '';

        // Current date values.
        $dateNow = new \DateTime(); // Y-m-d H:i:s
        $dateNowYear = $dateNow->format('Y');
        $dateNowMonth = $dateNow->format('m');
        $dateNowDay = $dateNow->format('d');
        
        $dateNowHour = $dateNow->format('H');
        $dateNowMinute = $dateNow->format('i');
        $dateNowSecond = $dateNow->format('s');
            
        // Shere between views.
        View::share('masterPageSelect', $masterPageSelect);
        View::share('pageNumber', $pageNumber);

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

    // Return URL build.
    // **************************************************************************************
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

        // Logic.
        // ----------------------
        $strReturn = '/' . $pageReturn;
        if ($idParent) {
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
