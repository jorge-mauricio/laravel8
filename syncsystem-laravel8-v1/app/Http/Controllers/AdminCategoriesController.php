<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\CategoriesListing;


class AdminCategoriesController extends Controller
{
    // Properties.
    // ----------------------
    private float|string|null $idParent = null;
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
    public function adminCategoriesListing(float|string $idTbCategories = null): string //TODO: change to the right type
    {
        // Build template data.
        // Title - content place holder.
        $this->templateData['cphTitleCurrent'] = 'title categories listing';

        // Body - content place holder.
        // TODO: build content object.
        $this->templateData['cphBody'] = 'idTbCategories = ' . $idTbCategories;


        // Return with view.
        // return view('layout-backend-main', compact('templateData')); // working, as long as templateData is a variable, not a property
        // return View::make('layout-backend-main')->with('templateData', $this->templateData); // error
        // return view('layout-backend-main', compact(['templateData' => $this->templateData]));
        // return view('layout-backend-main', ['templateData' => $this->templateData]); // working
        return view('layout-backend-main')->with('templateData', $this->templateData); // working

        // Debug.
        // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;
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
        $this->idParent = $idParent;
        // ----------------------

        //$adminCategoriesListing = CategoriesListing::all();
        $clAdmin = new CategoriesListing($this->idParent);

        $adminCategoriesListing = $clAdmin->cphBodyBuild();
        
        return $adminCategoriesListing;
    }

}
