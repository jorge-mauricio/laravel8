<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AdminFiltersGenericController extends AdminBaseController
{
    // Properties.
    // ----------------------
    private int|null $filterIndex = null;
    private string|null $tableName = null;

    private string|null $filtersGenericLabelIndex = null;
    private string|null $filtersGenericLabelModule = null;


    private int|null $pageNumber = null;
    protected string|null $masterPageSelect = 'layout-admin-main';
    private string|null $returnURL = null; // TODO: evaluate moving this to the method level.

    private array|null $cookiesData = null;
    private array|null $templateData = null;

    private array|null $arrFiltersGenericListingJson = null;
    private array|null $arrFiltersGenericListing = null;

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';
    private float|null $nRecords = null;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    // **************************************************************************************

    // Admin filters generic listing.
    // **************************************************************************************
    /**
     * Admin filters generic listing.
     * @param float|string $_idParentCategories
     * @return View
     */
    public function adminFiltersGenericListing(Request $req): View
    {
        // Variables.
        // ----------------------
        $apiFiltersGenericListingCurrentResponse = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $this->filterIndex = (int) $req->post('filterIndex');
        $this->tableName = $req->post('tableName');
        // ----------------------

        // Logic.
        try {
            /*
            $apiFiltersGenericListingCurrentResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' .
                    config('app.gSystemConfig.configRouteAPI') . '/' .
                    config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/',
                    array_merge(
                        [
                            'tableName' => $this->tableName,
                            'filterIndex' => $this->filterIndex,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ],
                        $req->all()
                    )
                );

            // Note / TODO: On production, set verify to true.
            $this->arrFiltersGenericListingJson = $apiFiltersGenericListingCurrentResponse->json();

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


            if ($this->arrFiltersGenericListingJson['returnStatus'] === true) {
                $this->arrFiltersGenericListing = $this->arrFiltersGenericListingJson['ofglRecords'];
                // Note: array listing array comes with extra data ("returnStatus" => true), so needs data treatment to clean it.


                // Build template data.
                $this->templateData['filterIndex'] = $this->filterIndex;
                $this->templateData['tableName'] = $this->tableName;
                    // TODO: double-check if it´s necessary.

                // Title - current - content place holder.
                $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleMain');
                if ($this->tableName === config('app.gSystemConfig.configSystemDBTableCategories')) {
                    $this->templateData['cphTitleCurrent'] .= ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesTitleMain');
                }

                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Meta data.


                // Body - content place holder.
                // TODO: build content object.
                // $this->templateData['cphBody'] = 'idTbCategories = ' . $idParentCategories;
                // $this->templateData['cphBody'] = '_idParentCategories = ' . $_idParentCategories; // debug

                //$this->templateData['cphBody'] = 'partial-layout-admin-categories-listing';
                //NOTE: maybe change to dots in the blade layout to get the partial directly

                $this->templateData['cphBody']['arrFiltersGenericListing'] = $this->arrFiltersGenericListing;
                unset($this->templateData['cphBody']['arrFiltersGenericListing']['returnStatus']); // Clean extra data.

                // TODO: pass _pagingTotalRecords and _pagingTotal values
                if (config('app.gSystemConfig.enableFiltersGenericBackendPagination') === 1) {
                    $this->templateData['_pagingTotalRecords'] = $this->arrFiltersGenericListingJson['_pagingTotalRecords'];
                }
            }


            // Debug.
            // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;
            // $this->templateData['cphBody'] = $apiCategoriesListingCurrentResponse;
            // echo '_GET (inside controller)=' . $_GET['masterPageSelect'] . '<br />';
            */
        } catch (\Exception $adminFiltersGenericListingError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminFiltersGenericListingError: ' . $adminFiltersGenericListingError->getMessage());
            }
        } finally {
            //
        }

        // Return with view.
        return view('admin.admin-filters-generic-listing')->with('templateData', $this->templateData);
    }
    // **************************************************************************************
}
