<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\FiltersGenericDetails;

class ApiFiltersGenericDetailsController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    // private float|null $pageNumber = null;
    private int|null $pageNumber = null;
    // private float|null $pagingNRecords = null;
    private int|null $pagingNRecords = null;

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
        // if ($req->post('pageNumber')) {
        //     $this->pageNumber = (int) $req->post('pageNumber');
        // }

        if ($req->post('apiKey')) {
            $this->apiKey = $req->post('apiKey');
        }
        // TODO: double check to see if parameters are being passed / received.
        // TODO: evaluate moving to base controller.
        // ----------------------
    }
    // **************************************************************************************

    // Handle filters generic details.
    // **************************************************************************************
    /**
     * Handle filters generic details.
     * @param Request $req
     * @param float|string $_idTbFiltersGeneric
     * @return ?array
     * @example TODO
     */
    public function getFiltersGenericDetails(Request $req, float|string $_idTbFiltersGeneric = null): ?array
    {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];

        $ofgdRecord = null;
        $ofgdRecordParameters = null;
        $ofgdRecordDetails = null;

        $idTbFiltersGeneric = '';
        $pageNumber = '';
        // ----------------------

        // Value definition.
        // ----------------------
        if ($_idTbFiltersGeneric) {
            $idTbFiltersGeneric = $_idTbFiltersGeneric;
        }
        // ----------------------

        // Logic.
        try {
            // Parameters build.
            $ofgdRecordParameters = [
                //'_arrSearchParameters' => ['id;' + $idTbFiltersGeneric + ';i', 'activation;1;i'],
                '_arrSearchParameters' => ['id;' . $idTbFiltersGeneric . ';i'],
                '_idTbFiltersGeneric' => $idTbFiltersGeneric,
                '_terminal' => $this->terminal,
                '_arrSpecialParameters' => ['returnType' => 1],
            ];

            $ofgdRecord = new FiltersGenericDetails($ofgdRecordParameters);
            //$ofgdRecordDetails = $ofgdRecord->cphBodyBuild();
            //$arrReturn['ofgdRecord'] = $ofgdRecord->cphBodyBuild();
            $arrReturn = $ofgdRecord->cphBodyBuild();

            // Debug.
            // $arrReturn['debug-idTbFiltersGeneric'] = $idTbFiltersGeneric;
        } catch (\Exception $getFiltersGenericDetailsError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('getFiltersGenericDetailsError: ' . $getFiltersGenericDetailsError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
