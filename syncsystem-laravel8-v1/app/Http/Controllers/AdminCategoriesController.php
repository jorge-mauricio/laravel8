<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\CategoriesListing;


class AdminCategoriesController extends Controller
{
    // Properties.
    private array $templateData;


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


    public function getCategoriesListing(float|string $idTbCategories = null): string //TODO: change to the right type
    {
        //$adminCategoriesListing = CategoriesListing::all();
        $clAdmin = new CategoriesListing();

        $adminCategoriesListing = $clAdmin->cphBodyBuild();
        
        return $adminCategoriesListing;
    }

}
