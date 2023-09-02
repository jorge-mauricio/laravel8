<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\FiltersGenericListing;

class ApiFiltersGenericListingController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    private object|null $ofglRecords = null;
    private array|null $ofglRecordsParameters = null;
    private array|null $arrSearchParameters = [];
    private array|null $arrSpecialParameters = null;

    private string|null $filterIndex = null;
    private string|null $tableName = null;
    // private int|null $pageNumber = 1; // TODO: maybe, dele null
    // private int|null $pagingNRecords = 0;

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

    // Handle filters generic listing.
    // **************************************************************************************
    /**
     * Handle filters generic listing.
     * @param Request $req
     * @return ?array
     */
    public function getFiltersGenericListing(Request $req): ?array
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        $backendFiltersGenericListing = null;
        // ----------------------

        // Define values.
        // ----------------------
        /*
        if ($req->query('pageNumber') !== null) {
            $this->pageNumber = (int) $req->query('pageNumber');
        }
        */
        if ($req->query('filterIndex') !== null) {
            $this->filterIndex = $req->query('filterIndex');
        }
        if ($req->query('tableName') !== null) {
            $this->tableName = $req->query('tableName');
        }
        // $this->pagingNRecords = config('app.gSystemConfig.configFiltersGenericBackendPaginationNRecords');
        // ----------------------

        // Logic.
        try {
            // Parameters build - listing.
            if ($this->filterIndex !== null) {
                array_push($this->arrSearchParameters, 'filter_index;' . $this->filterIndex . ';s'); // debug: 101
            }
            if ($this->tableName !== null) {
                array_push($this->arrSearchParameters, 'table_name;' . $this->tableName . ';s'); // debug: categories
            }
            $this->ofglRecordsParameters = [
                '_arrSearchParameters' => $this->arrSearchParameters,
                '_configSortOrder' => config('app.gSystemConfig.configFiltersGenericSort'),
                '_strNRecords' => '',
                '_arrSpecialParameters' => [
                    'returnType' => 1,
                    //'pageNumber' => $this->pageNumber,
                    //'pagingNRecords' => $this->pagingNRecords
                ],
            ];

            $fglBackend = new FiltersGenericListing($this->ofglRecordsParameters);
            $backendFiltersGenericListing = $fglBackend->cphBodyBuild();

            // Debug.
            //echo 'req (inside getCategoriesListing)=<pre>';
            //var_dump($req);
            //echo '</pre><br />';

            //echo 'req->query("activation") (inside getCategoriesListing)=<pre>';
            //var_dump($req->query('activation'));
            //echo '</pre><br />';

            //echo 'eq->query (inside getCategoriesListing)=<pre>';
            //var_dump($req->path());
            //echo '</pre><br />'; // api/categories/781

            //echo 'eq->all (inside getCategoriesListing)=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //echo 'this->arrSearchParameters (inside getCategoriesListing)=<pre>';
            //var_dump($this->arrSearchParameters);
            //echo '</pre><br />';
            //Log::debug($this->oclRecordsParameters);
            //\SyncSystemNS\FunctionsLog::logLaravel($this->oclRecordsParameters, 'debug');


            //echo 'this->oclRecordsParameters (inside getCategoriesListing)=<pre>';
            //var_dump( $this->oclRecordsParameters);
            //echo '</pre><br />';

            //echo 'Route::current()->getParameter (inside getCategoriesListing)=<pre>';
            //var_dump(Route::current()->getParameter('idTbCategories'));
            //echo '</pre><br />'; // ref: https://stackoverflow.com/questions/40647661/laravel-route-get-controllers-construct-without-method
        } catch (\Exception $getFiltersGenericListingError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('getFiltersGenericListingError: ' . $getFiltersGenericListingError->getMessage());
            }
        } finally {
            //
        }

        return $backendFiltersGenericListing; // debug
        // return response()->json();
        // return Response::json($backendCategoriesListing); // worked - needs to change method´s return type to mixed
    }
    // **************************************************************************************
}
