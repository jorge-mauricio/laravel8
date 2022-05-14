<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

// Custom models.
use App\Models\CategoriesListing; // DEV: check if this will be used.


class AdminCategoriesController extends Controller
{
    // Properties.
    // ----------------------
    // private float|string|null $_idParent = null;
    private float|string|null $idParentCategories = null;
    private float|null $pageNumber = null;
    private string|null $masterPageSelect = 'layout-backend-main';

    private array $cookiesData;
    private array $templateData;

    private array|null $arrCategoriesListingJson = null;
    private array|null $arrCategoriesDetails = null;
    private array|null $arrCategoriesListing = null;

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';
    private float|null $nRecords = null;
    // ----------------------

    // Admin Categories Listing Controller.
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
            $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get(env('CONFIG_API_URL') . '/api/categories/' . $this->idParentCategories . '/?apiKey=fswd@2008');
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
            // exit();

            // echo '$this->arrCategoriesListingJson[returnStatus]=<pre>';
            // var_dump($this->arrCategoriesListingJson['returnStatus']);
            // echo '</pre>';



            if ($this->arrCategoriesListingJson['returnStatus'] === true) {
                $this->arrCategoriesDetails = $this->arrCategoriesListingJson['ocdRecord'];
                $this->arrCategoriesListing = $this->arrCategoriesListingJson['oclRecords'];


                // Build template data.
                // Title current - content place holder.
                $this->templateData['cphTitleCurrent'] = $this->arrCategoriesDetails['tblCategoriesTitle'];
                
                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Meta data.


                // Body - content place holder.
                // TODO: build content object.
                // $this->templateData['cphBody'] = 'idTbCategories = ' . $idParentCategories;
                // $this->templateData['cphBody'] = '_idParentCategories = ' . $_idParentCategories; // debug
                $this->templateData['cphBody'] = 'partial-layout-admin-categories-listing';
                //NOTE: maybe change to dots in the blade layout to get the partial directly

                // Dynamic data.
                $this->templateData['additionalData']['arrCategoriesDetails'] = $this->arrCategoriesDetails;
                $this->templateData['additionalData']['arrCategoriesListing'] = $this->arrCategoriesListing;
            }    



            // Debug.
            // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;
            // $this->templateData['cphBody'] = $apiCategoriesListingCurrentResponse;


            // Return with view.
            // return view('layout-backend-main', compact('templateData')); // working, as long as templateData is a variable, not a property
            // return View::make('layout-backend-main')->with('templateData', $this->templateData); // error
            // return view('layout-backend-main', compact(['templateData' => $this->templateData]));
            // return view('layout-backend-main', ['templateData' => $this->templateData]); // working
            return view('layout-backend-main')->with('templateData', $this->templateData); // working

        } catch(Exception $adminCategoriesListingError) {
            echo 'Error reading API: ' . $apiError->getMessage();     
            
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminCategoriesListingError: ' . $adminCategoriesListingError->message());
            }
        } finally {

        }
        
    }


    //public function getCategoriesListing(float|string $idTbCategories = null): string //TODO: change to the right type
    public function getCategoriesListing(float|string $idParent = null): string //TODO: change to the right type
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $this->_idParent = $idParent;
        // ----------------------

        //$adminCategoriesListing = CategoriesListing::all();
        $clAdmin = new CategoriesListing($this->_idParent);

        $adminCategoriesListing = $clAdmin->cphBodyBuild();
        
        return $adminCategoriesListing;
    }
}
