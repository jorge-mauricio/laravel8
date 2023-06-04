<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUsersController extends AdminBaseController
{
    // Properties.
    // ----------------------
    private float|string|null $idParent = null;
    private int|null $pageNumber = null;
    protected string|null $masterPageSelect = 'layout-admin-main';
    private string|null $returnURL = null; // TODO: evaluate moving this to the method level.

    private array $cookiesData;
    private array $templateData;

    private array|null $arrUsersListingJson = null;
    private array|null $arrUsersDetails = null;
    private array|null $arrUsersListing = null;

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

    // Admin users listing.
    // **************************************************************************************
    /**
     * Admin users listing.
     * @param float|string $_idParent
     * @return View
     */
    public function adminUsersListing(float|string $_idParent = null, Request $req): View
    {
        // Variables.
        // ----------------------
         $apiUsersListingResponse = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $this->idParent = $_idParent;
        // ----------------------

        // Logic.
        try {
            $apiUsersListingResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/' . $this->idParent . '/', // phpcs:ignore
                    array_merge(
                        ['apiKey' => config('app.gSystemConfig.configAPIKeySystem')],
                        $req->all()
                    )
                );

            // Note / TODO: On production, set verify to true.
            $this->arrUsersListingJson = $apiUsersListingResponse->json();

            // Debug.
            // dd($apiCategoriesListingCurrentResponse);
            // echo 'apiCategoriesListingCurrentResponse=<pre>';
            // var_dump($apiCategoriesListingCurrentResponse);
            // echo '</pre>';

            // echo 'apiCategoriesListingCurrentResponse->json()=<pre>';
            // var_dump($apiCategoriesListingCurrentResponse->json());
            // echo '</pre>';


            //exit();

            if ($this->arrUsersListingJson['returnStatus'] === true) {
                $this->arrUsersListing = $this->arrUsersListingJson['oulRecords'];
                // Note: array listing array comes with extra data ("returnStatus" => true), so needs data treatment to clean it.


                // Build template data.
                $this->templateData['idParent'] = $this->idParent;

                // Title - current - content place holder.
                //$this->idParentCategories = (float) $this->idParentCategories;
                // Debug.
                //echo 'idParentCategories=' . $this->idParentCategories . '<br />';
                //echo 'idParentCategories=<pre>';
                //var_dump((float) $this->idParentCategories);
                //echo '</pre><br />';

                $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendUsersTitleMain');

                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Meta data.

                // Body - content place holder.
                $this->templateData['cphBody']['arrUsersListing'] = $this->arrUsersListing;
                unset($this->templateData['cphBody']['arrUsersListing']['returnStatus']); // Clean extra data.

                // TODO: pass _pagingTotalRecords and _pagingTotal values
                if (config('app.gSystemConfig.enableUsersBackendPagination') === 1) {
                    $this->templateData['_pagingTotalRecords'] = $this->arrUsersListingJson['_pagingTotalRecords'];
                }
            }

            // Debug.
            // return 'admin categories listing (controller) idTbCategories = ' . $idTbCategories;
            // $this->templateData['cphBody'] = $apiCategoriesListingCurrentResponse;
            // echo '_GET (inside controller)=' . $_GET['masterPageSelect'] . '<br />';
        } catch (\Exception $adminCategoriesListingError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminCategoriesListingError: ' . $adminCategoriesListingError->getMessage());
            }
        } finally {
            //
        }

        // Return with view.
        return view('admin.admin-users-listing')->with('templateData', $this->templateData); // working
    }
    // **************************************************************************************
}
