<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// Custom models.
//use App\Models\CategoriesListing; // DEV: check if this will be used.


// class AdminCategoriesController extends Controller
class AdminCategoriesController extends AdminBaseController
{
    // Properties.
    // ----------------------
    // private float|string|null $_idParent = null;
    private float|string|null $idParentCategories = null;
    private float|null $pageNumber = null;
    private string|null $masterPageSelect = 'layout-backend-main';
    private string|null $returnURL = null;

    private array $cookiesData;
    private array $templateData;

    private array|null $arrCategoriesListingJson = null;
    private array|null $arrCategoriesDetails = null;
    private array|null $arrCategoriesListing = null;

    private array|null $arrCategoriesInsertJson = null;

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';
    private float|null $nRecords = null;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct()
    {
        parent::__construct();
    }
    // **************************************************************************************

    // Admin Categories Listing Controller.
    // **************************************************************************************
    // public function adminCategoriesListing(float|string $idParent = null): string //TODO: change to the right type
    public function adminCategoriesListing(float|string $_idParentCategories = null): mixed //TODO: change to the right type
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        $apiCategoriesListingCurrentResponse = null;
        // ----------------------

        // Value definition.
        // ----------------------
        // $this->_idParent = $idParent;
        $this->idParentCategories = $_idParentCategories;
        // ----------------------

        try {
            // Debug: https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008
            //$apiCategoriesDetailsCurrentResponse = Http::get('https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008');
            //$apiCategoriesDetailsCurrentResponse = Http::withOptions(['verify' => false])->get('https://backendnode.fullstackwebdesigner.com/api/categories/' . $this->_idParentCategories . '/?apiKey=fswd@2008');

            // $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get('http://127.0.0.1:8000/api/categories/' . $this->idParentCategories . '/?apiKey=fswd@2008');
            // $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get('http://localhost:8001/api/categories/' . $this->idParentCategories . '/?apiKey=fswd@2008');
            $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get(env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPICategories'] . '/' . $this->idParentCategories . '/', [
                'apiKey' => env('CONFIG_API_KEY_SYSTEM')
            ]);
            // Note / TODO: On production, set verify to true.
            //return $apiCategoriesDetailsCurrentResponse->json();
            $this->arrCategoriesListingJson = $apiCategoriesListingCurrentResponse->json();
            
            // Debug.
            // dd($apiCategoriesListingCurrentResponse);
            // echo 'apiCategoriesListingCurrentResponse=<pre>';
            // var_dump($apiCategoriesListingCurrentResponse);
            // echo '</pre>';

            // echo 'apiCategoriesListingCurrentResponse->json()=<pre>';
            // var_dump($apiCategoriesListingCurrentResponse->json());
            // echo '</pre>';

            //echo 'arrCategoriesListingJson=<pre>';
            //var_dump($arrCategoriesListingJson);
            //echo '</pre>';
            
            //exit();

            // echo '$this->arrCategoriesListingJson[returnStatus]=<pre>';
            // var_dump($this->arrCategoriesListingJson['returnStatus']);
            // echo '</pre>';


            if ($this->arrCategoriesListingJson['returnStatus'] === true) {
                $this->arrCategoriesDetails = $this->arrCategoriesListingJson['ocdRecord'];
                $this->arrCategoriesListing = $this->arrCategoriesListingJson['oclRecords'];
                // Note: array listing array comes with extra data ("returnStatus" => true), so needs data treatment to clean it.


                // Build template data.
                $this->templateData['idParentCategories'] = $this->idParentCategories;

                // Title current - content place holder.
                $this->templateData['cphTitleCurrent'] = $this->arrCategoriesDetails['tblCategoriesTitle'];
                
                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Meta data.


                // Body - content place holder.
                // TODO: build content object.
                // $this->templateData['cphBody'] = 'idTbCategories = ' . $idParentCategories;
                // $this->templateData['cphBody'] = '_idParentCategories = ' . $_idParentCategories; // debug

                //$this->templateData['cphBody'] = 'partial-layout-admin-categories-listing';
                //NOTE: maybe change to dots in the blade layout to get the partial directly

                $this->templateData['cphBody']['arrCategoriesDetails'] = $this->arrCategoriesDetails;
                $this->templateData['cphBody']['arrCategoriesListing'] = $this->arrCategoriesListing;
                unset($this->templateData['cphBody']['arrCategoriesListing']['returnStatus']); // Clean extra data.

                // Dynamic data.
                //$this->templateData['additionalData']['arrCategoriesDetails'] = $this->arrCategoriesDetails;
                //$this->templateData['additionalData']['arrCategoriesListing'] = $this->arrCategoriesListing;


                // Layout.
                //$this->templateData['masterPageSelect'] = $_GET['masterPageSelect']; // 'layout-admin-main'
            }    



            // Debug.
            // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;
            // $this->templateData['cphBody'] = $apiCategoriesListingCurrentResponse;
            // echo '_GET (inside controller)=' . $_GET['masterPageSelect'] . '<br />';

        } catch(Exception $adminCategoriesListingError) {
            echo 'Error reading API: ' . $apiError->getMessage();     
            
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminCategoriesListingError: ' . $adminCategoriesListingError->message());
            }
        } finally {

        }

        // Return with view.
        // return view('layout-backend-main', compact('templateData')); // working, as long as templateData is a variable, not a property
        // return View::make('layout-backend-main')->with('templateData', $this->templateData); // error
        // return view('layout-backend-main', compact(['templateData' => $this->templateData]));
        // return view('layout-backend-main', ['templateData' => $this->templateData]); // working
        // return view('layout-backend-main')->with('templateData', $this->templateData); // working
        // return view('admin.layout-admin-main')->with('templateData', $this->templateData); // working
        return view('admin.admin-categories-listing')->with('templateData', $this->templateData); // working
    }
    // **************************************************************************************

    // Handle categories insert.
    // **************************************************************************************
    public function adminCategoriesInsert(Request $req): mixed //TODO: change to the right type (maybe void)
    {
        //TODO: create option for load method (api / monolithic)

        // Variables.
        // ----------------------
        $apiCategoriesInsertResponse = null;
        
        //$tblCategoriesID = null;
        //$tblCategoriesIdParent = null;
        //$tblCategoriesSortOrder = 0;
        //$tblCategoriesCategoryType = null;
        // ----------------------

        // Define values.
        // ----------------------
        // $tblCategoriesID = null;
        //$tblCategoriesIdParent = $req->post('id_parent');
        //$tblCategoriesSortOrder = $req->post('sort_order');
        //$tblCategoriesCategoryType = $req->post('category_type');


        $this->idParentCategories = $req->post('idParent');
        $this->pageNumber = $req->post('pageNumber');
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        $this->returnURL = '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $this->idParentCategories . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            /**/
            //array_push($arrData, 'apiKey' => env('CONFIG_API_KEY_SYSTEM');
            //$arrData = array_merge($arrData, $req->all());
            $apiCategoriesInsertResponse = Http::withOptions(['verify' => false])->post(env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPICategories'] . '/', 
                array_merge(
                    ['apiKey' => env('CONFIG_API_KEY_SYSTEM')], 
                    $req->all()
                ) // ...$req->all() (splat only works on php 8.1 and up)
                /*'tblCategoriesID' => $tblCategoriesID,
                'tblCategoriesIdParent' => $tblCategoriesIdParent,
                'tblCategoriesSortOrder' => $tblCategoriesSortOrder,
                'tblCategoriesCategoryType' => $tblCategoriesCategoryType,
                */
                
            );
            $this->arrCategoriesInsertJson = $apiCategoriesInsertResponse->json();

            // Files upload.



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

            //echo 'this->arrCategoriesInsertJson=<pre>';
            //var_dump($this->arrCategoriesInsertJson);
            //echo '</pre><br />'; // working (debug)

            //echo 'req->all()=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //echo 'tblCategoriesID=' . $tblCategoriesID . '<br />';
            //echo 'tblCategoriesIdParent=' . $tblCategoriesIdParent . '<br />';
            //echo 'tblCategoriesSortOrder=' . $tblCategoriesSortOrder . '<br />';
            //echo 'tblCategoriesCategoryType=' . $tblCategoriesCategoryType . '<br />';

            //echo 'idParentCategories=' . $this->idParentCategories . '<br />';
            //echo 'pageNumber=' . $this->pageNumber . '<br />';
            //echo 'masterPageSelect=' . $this->masterPageSelect . '<br />';
            //exit();

        } catch (Error $adminCategoriesInsertError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminCategoriesInsertError: ' . $adminCategoriesInsertError->message());
            }
        } finally {
            //
        }

        // Redirect.
        if ($this->arrCategoriesInsertJson['returnStatus'] === true) {
            // $this->returnURL .= '&messageSuccess=statusMessage2';
            return redirect($this->returnURL)->with('messageSuccess', $this->arrCategoriesInsertJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage2'));
        } else {
            // $this->returnURL .= '&messageError=statusMessage3';
            return redirect($this->returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessage3'));
        }
    }

    public function adminCategoriesDelete(Request $req): mixed //TODO: change to the right type
    {
        //TODO: move this to it´s own controller: ex: adminRecordsController

        // Variables.
        // ----------------------
        $apiCategoriesDeleteResponse = null;
        // ----------------------

        // Define values.
        // ----------------------
        // $tblCategoriesID = null;
        //$tblCategoriesIdParent = $req->post('id_parent');
        //$tblCategoriesSortOrder = $req->post('sort_order');
        //$tblCategoriesCategoryType = $req->post('category_type');


        $this->idParentCategories = $req->post('idParent');
        $this->pageNumber = $req->post('pageNumber');
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: create own method for page return URL build.
        $this->returnURL = '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendCategories'] . '/' . $this->idParentCategories . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            /**/
            //array_push($arrData, 'apiKey' => env('CONFIG_API_KEY_SYSTEM');
            //$arrData = array_merge($arrData, $req->all());
            $apiCategoriesDeleteResponse = Http::withOptions(['verify' => false])->delete(env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPIRecords'] . '/', 
                array_merge(
                    ['apiKey' => env('CONFIG_API_KEY_SYSTEM')], 
                    $req->all()
                ) // ...$req->all() (splat only works on php 8.1 and up)
                /*'tblCategoriesID' => $tblCategoriesID,
                'tblCategoriesIdParent' => $tblCategoriesIdParent,
                'tblCategoriesSortOrder' => $tblCategoriesSortOrder,
                'tblCategoriesCategoryType' => $tblCategoriesCategoryType,
                */
                
            );
            $this->arrCategoriesDeleteJson = $apiCategoriesDeleteResponse->json();

            // Files upload.



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

            echo 'this->arrCategoriesDeleteJson=<pre>';
            var_dump($this->arrCategoriesDeleteJson);
            echo '</pre><br />'; // working (debug)

            echo 'req->all()=<pre>';
            var_dump($req->all());
            echo '</pre><br />';

            //echo 'tblCategoriesID=' . $tblCategoriesID . '<br />';
            //echo 'tblCategoriesIdParent=' . $tblCategoriesIdParent . '<br />';
            //echo 'tblCategoriesSortOrder=' . $tblCategoriesSortOrder . '<br />';
            //echo 'tblCategoriesCategoryType=' . $tblCategoriesCategoryType . '<br />';

            //echo 'idParentCategories=' . $this->idParentCategories . '<br />';
            //echo 'pageNumber=' . $this->pageNumber . '<br />';
            //echo 'masterPageSelect=' . $this->masterPageSelect . '<br />';
            //exit();

        } catch (Error $adminCategoriesDeleteError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminCategoriesDeleteError: ' . $adminCategoriesDeleteError->message());
            }
        } finally {

        }

        return $this->arrCategoriesDeleteJson;
        
    }
}
