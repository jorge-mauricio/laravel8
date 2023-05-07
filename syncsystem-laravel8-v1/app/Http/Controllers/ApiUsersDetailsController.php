<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\UsersDetails;

class ApiUsersDetailsController extends Controller
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
        if ($req->post('pageNumber')) {
            $this->pageNumber = (int) $req->post('pageNumber');
        }

        if ($req->post('apiKey')) {
            $this->apiKey = $req->post('apiKey');
        }
        // ----------------------
    }
    // **************************************************************************************

    // Handle users details.
    // **************************************************************************************
    /**
     * Handle users details.
     * @param Request $req
     * @param float|string $_idTbUsers
     * @return ?array
     * @example TODO
     */
    public function getUsersDetails(Request $req, float|string $_idTbUsers = null): ?array
    {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];

        $oudRecord = null;
        $oudRecordParameters = null;
        $oudRecordDetails = null;

        $idTbUsers = '';
        $pageNumber = '';
        // ----------------------

        // Value definition.
        // ----------------------
        if ($_idTbUsers) {
            $idTbUsers = $_idTbUsers;
        }
        // ----------------------

        // Logic.
        try {
            // Parameters build.
            $oudRecordParameters = [
                //'_arrSearchParameters' => ['id;' + $idTbUsers + ';i', 'activation;1;i'],
                '_arrSearchParameters' => ['id;' . $idTbUsers . ';i'],
                '_idTbUsers' => $idTbUsers,
                '_terminal' => $this->terminal,
                '_arrSpecialParameters' => ['returnType' => 1],
            ];

            $oudRecord = new UsersDetails($oudRecordParameters);
            $arrReturn = $oudRecord->cphBodyBuild();

            // Debug.
            // $arrReturn['debug-idTbUsers'] = $idTbUsers;
        } catch (\Exception $getUsersDetailsError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('getUsersDetailsError: ' . $getUsersDetailsError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
