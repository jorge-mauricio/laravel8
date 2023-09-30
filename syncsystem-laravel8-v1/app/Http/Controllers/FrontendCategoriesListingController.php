<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontendCategoriesListingController extends Controller
{
    // Properties.
    private float|string|null $_idParentCategories = null;


    // Constructor.
    // **************************************************************************************
    public function __construct(?float $idParentCategories = null)
    {
        if ($idParentCategories !== null) {
            $this->_idParentCategories = $idParentCategories;
        }

        return $this->build();
    }
    // **************************************************************************************


    // Build object´s content.
    // **************************************************************************************
    public function build()
    {
        // Variables.
        // ----------------------
        $apiCategoriesDetailsCurrentResponse = null;
        // ----------------------


        // Debug.
        // echo '$this->_idParentCategories=' . $this->_idParentCategories . '<br />';


        try {
            // Debug: https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008
            //$apiCategoriesDetailsCurrentResponse = Http::get('https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008');
            $apiCategoriesDetailsCurrentResponse = Http::withOptions(
                [
                    'verify' => (
                        config('app.gSystemConfig.configSystemEnv') === 'production' ||
                        config('app.gSystemConfig.configDebug') === false
                    )
                ]
            )
                ->get('https://backendnode.fullstackwebdesigner.com/api/categories/' . $this->_idParentCategories . '/?apiKey=' . config('app.gSystemConfig.configAPIKeySystem'));

            return $apiCategoriesDetailsCurrentResponse->json();
        } catch (\Exception $apiError) {
            echo 'Error reading API: ' . $apiError->getMessage();
        } finally {
            //
        }
    }
    // **************************************************************************************
}
