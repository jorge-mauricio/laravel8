<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersListing;

class ApiUsersListingController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    private object|null $oulRecords = null;
    private array|null $oulRecordsParameters = null;
    private array|null $arrSearchParameters = [];
    private array|null $arrSpecialParameters = null;

    private int|null $activation = null;
    private int|null $activation1 = null;
    private int|null $activation2 = null;
    private int|null $activation3 = null;
    private int|null $activation4 = null;
    private int|null $activation5 = null;

    private float|string|null $idParent = null;
    private int|null $pageNumber = 1; // TODO: maybe, dele null
    private int|null $pagingNRecords = 0;

    private int|null $terminal = 0;
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
        //
    }
    // **************************************************************************************

    // Handle users listing.
    // **************************************************************************************
    /**
     * Handle users listing.
     * @param Request $req
     * @param float|string $_idParent
     * @return ?array
     */
    public function getUsersListing(Request $req, float|string $_idParent = null): ?array
    {
        // Variables.
        // ----------------------
        $backendUsersListing = null;
        // ----------------------

        // Define values.
        // ----------------------
        $this->idParent = $_idParent;

        if ($req->query('activation') !== null) {
            $this->activation = $req->query('activation');
        }
        if ($req->query('activation1') !== null) {
            $this->activation1 = $req->query('activation1');
        }
        if ($req->query('activation2') !== null) {
            $this->activation2 = $req->query('activation2');
        }
        if ($req->query('activation3') !== null) {
            $this->activation3 = $req->query('activation3');
        }
        if ($req->query('activation4') !== null) {
            $this->activation4 = $req->query('activation4');
        }
        if ($req->query('activation5') !== null) {
            $this->activation5 = $req->query('activation5');
        }

        if ($req->query('pageNumber') !== null) {
            $this->pageNumber = (int) $req->query('pageNumber');
        }
        /*
        if ($req->query('pagingNRecords') !== null) {
            $this->pagingNRecords = $req->query('pagingNRecords');
        }
        */
        $this->pagingNRecords = config('app.gSystemConfig.configUsersBackendPaginationNRecords');
        // ----------------------

        // Logic.
        try {
            // Parameters build - listing.
            array_push($this->arrSearchParameters, 'id_parent;' . $this->idParent . ';i');
            array_push($this->arrSearchParameters, 'id;11;!i'); // user - root (backend node)
            array_push($this->arrSearchParameters, 'id;12;!i'); // user - root (backend PHP Laravel - Data - MCrypt PHP)
            array_push($this->arrSearchParameters, 'id;14;!i'); // user - root (backend PHP Laravel - Data - Defuse php-encryption)
            // TODO: include laravel root user (and update DB setup file and update node code base - admin_node/users-listing.js)

            if ($this->activation !== null) {
                array_push($this->arrSearchParameters, 'activation;' . $this->activation . ';i');
            }
            if ($this->activation1 !== null) {
                array_push($this->arrSearchParameters, 'activation1;' . $this->activation1 . ';i');
            }
            if ($this->activation2 !== null) {
                array_push($this->arrSearchParameters, 'activation2;' . $this->activation2 . ';i');
            }
            if ($this->activation3 !== null) {
                array_push($this->arrSearchParameters, 'activation3;' . $this->activation3 . ';i');
            }
            if ($this->activation4 !== null) {
                array_push($this->arrSearchParameters, 'activation4;' . $this->activation4 . ';i');
            }
            if ($this->activation5 !== null) {
                array_push($this->arrSearchParameters, 'activation5;' . $this->activation5 . ';i');
            }

            $this->oulRecordsParameters = [
                '_arrSearchParameters' => $this->arrSearchParameters,
                '_configSortOrder' => config('app.gSystemConfig.configUsersSort'),
                '_strNRecords' => '',
                '_arrSpecialParameters' => [
                    'returnType' => 1,
                    'pageNumber' => $this->pageNumber,
                    'pagingNRecords' => $this->pagingNRecords
                ],
            ];

            $ulBackend = new UsersListing($this->oulRecordsParameters);

            $backendUsersListing = $ulBackend->cphBodyBuild();

            // Debug.
            //echo 'backendUsersListing (inside api users listing controller)=<pre>';
            //var_dump($backendUsersListing);
            //echo '</pre><br />';
        } catch (\Exception $getUsersListingError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('getUsersListingError: ' . $getUsersListingError->getMessage());
            }
        } finally {
            //
        }

        return $backendUsersListing;
    }
    // **************************************************************************************
}
