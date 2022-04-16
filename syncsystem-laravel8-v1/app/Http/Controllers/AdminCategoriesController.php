<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\CategoriesListing;


class AdminCategoriesController extends Controller
{
    // Properties.
    // ----------------------
    private float|string|null $_idParent = null;
    private float|null $pageNumber = null;
    private string|null $masterPageSelect = 'layout-backend-main';

    private array $cookiesData;
    private array $templateData;

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';
    private float|null $nRecords = null;
    // ----------------------

    // Admin Categories Listing Controller.
    public function adminCategoriesListing(float|string $idParent = null): string //TODO: change to the right type
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $this->_idParent = $idParent;
        // ----------------------

        try {
            // Debug: https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008
            //$apiCategoriesDetailsCurrentResponse = Http::get('https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008');
            //$apiCategoriesDetailsCurrentResponse = Http::withOptions(['verify' => false])->get('https://backendnode.fullstackwebdesigner.com/api/categories/' . $this->_idParentCategories . '/?apiKey=fswd@2008');

            $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get('http://127.0.0.1:8000/api/categories/' . $this->_idParentCategories . '/?apiKey=fswd@2008');

            // Note / TODO: On production, set verify to true.

            
            //return $apiCategoriesDetailsCurrentResponse->json();


            // Build template data.
            // Title - content place holder.
            $this->templateData['cphTitleCurrent'] = 'title categories listing';

            // Body - content place holder.
            // TODO: build content object.
            $this->templateData['cphBody'] = 'idTbCategories = ' . $idTbCategories;


            // Debug.
            // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;

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
