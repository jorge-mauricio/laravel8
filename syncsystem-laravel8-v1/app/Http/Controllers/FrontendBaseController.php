<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontendBaseController extends Controller
{
    // Properties.
    // ----------------------
    protected ?string $masterPageFrontendSelect = 'layout-frontend-main';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    protected function __construct()
    {
        // Admin master page select priority.
        //$masterPageSelect = 'layout-admin-main';
        if (!empty($_GET['masterPageFrontendSelect'])) {
            $this->masterPageFrontendSelect = $_GET['masterPageFrontendSelect'];
        }
        if (!empty($_POST['masterPageFrontendSelect'])) {
            $this->masterPageFrontendSelect = $_POST['masterPageFrontendSelect'];
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
        $queryDefault .= 'masterPageFrontendSelect=' . $this->masterPageFrontendSelect;
        if ($pageNumber !== '') {
            $queryDefault .= '&pageNumber=' . $pageNumber;
        }

        // Define values.
        $cacheClear = $dateNow->format('YmdHis'); // TODO: create a config option to enable.

        // Share between views.
        View::share([
            'masterPageFrontendSelect' => $this->masterPageFrontendSelect,
            'pageNumber' => (int) $pageNumber,
            'cacheClear' => $cacheClear,
            'queryDefault' => $queryDefault,

            'messageSuccess' => $messageSuccess,
            'messageError' => $messageError,
            'messageAlert' => $messageAlert,

            'dateNow' => $dateNow,
            'dateNowDay' => $dateNowDay,
            'dateNowMonth' => $dateNowMonth,
            'dateNowYear' => $dateNowYear,
            'dateNowMinute' => $dateNowMinute,
            'dateNowHour' => $dateNowHour,
            'dateNowSecond' => $dateNowSecond,
        ]);
    }
    // **************************************************************************************

    // Build return URL for redirect.
    // **************************************************************************************
    /**
     * Build return URL for redirect.
     * @param Request $req
     * @return string
     */
    protected function buildReturnURL(Request $req): string
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
        $masterPageSelect = 'layout-frontend-main';
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
