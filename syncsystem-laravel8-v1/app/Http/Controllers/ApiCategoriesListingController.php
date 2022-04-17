<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
//use Response;
//use Route;
use Illuminate\Support\Facades\Route;

// Custom models.
use App\Models\CategoriesListing;


class ApiCategoriesListingController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = array('returnStatus' => false);
    private string $configAPIKey = '';

    private object|null $ocdRecord = null;
    private array|null $ocdRecordParameters = null;

    private object|null $oclRecords = null;
    private array|null $oclRecordsParameters = null;
    private array|null $arrSearchParameters = [];
    private array|null $arrSpecialParameters = null;

    private float|null $activation = null;
    private float|null $activation1 = null;
    private float|null $activation2 = null;
    private float|null $activation3 = null;
    private float|null $activation4 = null;
    private float|null $activation5 = null;

    private float|string|null $idTbCategories = null;
    private float|null $pageNumber = null;
    private float|null $pagingNRecords = null;

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------
    // NOTE: maybe, delete this controller


    // Constructor.
    // **************************************************************************************
    //public function __construct(?float $idParent = null)
    //public function __construct(float|string $_idTbCategories = null)
    public function __construct(Request $request)
    {
        // Value definition.
        // ----------------------
        /*
        if ($idParent !== null) {
            $this->_idParent = $idParent;
        }
        
        if ($_idTbCategories !== null) {
            $this->idTbCategories = $_idTbCategories;
        }
        */
        //$this->idTbCategories = $request->route()->parameter('idTbCategories');
        // ----------------------

        //return $this->getCategoriesListing();
    }
    // **************************************************************************************



    //public function getCategoriesListing(float|string $idParent = null): string|array //TODO: change to the right type
    //public function getCategoriesListing(): array //TODO: change to the right type
    public function getCategoriesListing(Request $req, float|string $_idTbCategories = null): array //TODO: change to the right type
    //public function getCategoriesListing(Request $req, float|string $_idTbCategories = null): mixed //TODO: change to the right type
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        // ----------------------

        // Value definition.
        // ----------------------
        //$this->idParent = $idParent;
        $this->idTbCategories = $_idTbCategories;

        if ($req->query('activation') !== null) {
            $this->activation = $req->query('activation');
        }
        if ($req->query('activation1') !== null) {
            $this->activation1 = $req->query('activation1');
        }
        if ($req->query('activation2') !== null) {
            $this->activation2 = $req->query('activation2');
        }
        if ($req->query('activation3') !==null) {
            $this->activation3 = $req->query('activation3');
        }
        if ($req->query('activation4') !== null) {
            $this->activation4 = $req->query('activation4');
        }
        if ($req->query('activation5') !== null) {
            $this->activation5 = $req->query('activation5');
        }

        if ($req->query('pageNumber') !== null) {
            $this->pageNumber = $req->query('pageNumber');
        }
        if ($req->query('pagingNRecords') !== null) {
            $this->pagingNRecords = $req->query('pagingNRecords');
        }
        // ----------------------

        // Logic.
        try {
            // Parameters build - details.
            $this->ocdRecordParameters = [
                '_arrSearchParameters' => ['id;' . $this->idTbCategories . ';i'],
                '_idTbCategories' => $this->idTbCategories,
                '_terminal' => $this->terminal,
                '_arrSpecialParameters' => [
                    'returnType' => 1, 
                    'pageNumber' => $this->pageNumber, 
                    'pagingNRecords' => $this->pagingNRecords
                ],
            ];            


            // Parameters build - listing.
            array_push($this->arrSearchParameters, 'id_parent;' . $this->idTbCategories . ';i'); // 781
            // array_push($this->arrSearchParameters, 'activation;0;i'); // debug / test

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

            $this->oclRecordsParameters = [
                '_arrSearchParameters' => $this->arrSearchParameters,
                '_configSortOrder' => $GLOBALS['configCategoriesSort'],
                '_strNRecords' => '',
                // '_strNRecords' => '115', // debug
                //'_arrSpecialParameters' => ['returnType' => 1], // debug
                //'_arrSpecialParameters' => ['returnType' => 1, 'pageNumber' => 2, 'pagingNRecords' => 3], // debug
                '_arrSpecialParameters' => [
                    'returnType' => 1, 
                    'pageNumber' => $this->pageNumber, 
                    'pagingNRecords' => $this->pagingNRecords
                ],
            ];            

            //$adminCategoriesListing = CategoriesListing::all();
            //$clBackend = new CategoriesListing($this->idParent);
            $clBackend = new CategoriesListing($this->ocdRecordParameters, $this->oclRecordsParameters);

            $backendCategoriesListing = $clBackend->cphBodyBuild();

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

            //echo 'Route::current()->getParameter (inside getCategoriesListing)=<pre>';
            //var_dump(Route::current()->getParameter('idTbCategories'));
            //echo '</pre><br />'; // ref: https://stackoverflow.com/questions/40647661/laravel-route-get-controllers-construct-without-method
            
            
            return $backendCategoriesListing; // debug
            // return response()->json();
            // return Response::json($backendCategoriesListing); // worked - needs to change method´s return type to mixed
        } catch (Error $getCategoriesListingError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('getCategoriesListingError: ' . $getCategoriesListingError->message());
            }
        } finally {

        }
        
    }

}
