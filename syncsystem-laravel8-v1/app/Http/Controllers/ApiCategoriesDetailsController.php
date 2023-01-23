<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\CategoriesDetails;

class ApiCategoriesDetailsController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = array('returnStatus' => false);
    private string $configAPIKey = '';

    private float|null $pageNumber = null;
    private float|null $pagingNRecords = null;

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param Request $req
     */
    public function __construct(Request $req)
    {
        // Value definition.
        // ----------------------
        if ($req->post('pageNumber')) {
            $this->pageNumber = $req->post('pageNumber');
        }

        if ($req->post('apiKey')) {
            $this->apiKey = $req->post('apiKey');
        }
        // TODO: double check to see if parameters are being passed / received.
        // ----------------------
    }
    // **************************************************************************************

    // Handle categories details.
    // **************************************************************************************
    /**
     * Handle categories details.
     * @param Request $req
     * @param float|string $_idTbCategories
     * @return ?array
     */
    public function getCategoriesDetails(Request $req, float|string $_idTbCategories = null): ?array
    {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];

        $ocdRecord = null;
        $ocdRecordParameters = null;
        $ocdRecordDetails = null;

        $idTbCategories = '';
        $pageNumber = '';
        // ----------------------

        // Value definition.
        // ----------------------
        if ($_idTbCategories) {
            $idTbCategories = $_idTbCategories;
        }
        // ----------------------

        // Logic.
        try {
            // Parameters build.
            $ocdRecordParameters = [
                //'_arrSearchParameters' => ['id;' + $idTbCategories + ';i', 'activation;1;i'],
                '_arrSearchParameters' => ['id;' . $idTbCategories . ';i'],
                '_idTbCategories' => $idTbCategories,
                '_terminal' => $this->terminal,
                '_arrSpecialParameters' => ['returnType' => 1],
            ];

            $ocdRecord = new CategoriesDetails($ocdRecordParameters);
            //$ocdRecordDetails = $ocdRecord->cphBodyBuild();
            //$arrReturn['ocdRecord'] = $ocdRecord->cphBodyBuild();
            $arrReturn = $ocdRecord->cphBodyBuild();

            // Debug.
            // $arrReturn['debug-idTbCategories'] = $idTbCategories;
        } catch (Error $getCategoriesDetailsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('getCategoriesDetailsError: ' . $getCategoriesDetailsError->message());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
