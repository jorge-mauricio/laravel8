<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    private array|null $arrSearchParameters = null;
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