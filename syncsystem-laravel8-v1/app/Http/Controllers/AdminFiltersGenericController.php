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
     * @param Request $req
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
            /**/
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
            // dd($apiFiltersGenericListingCurrentResponse);
            // echo 'apiFiltersGenericListingCurrentResponse=<pre>';
            // var_dump($apiFiltersGenericListingCurrentResponse);
            // echo '</pre>';

            // echo 'apiFiltersGenericListingCurrentResponse->json()=<pre>';
            // var_dump($apiFiltersGenericListingCurrentResponse->json());
            // echo '</pre>';

            //echo 'arrFiltersGenericListingJson=<pre>';
            //var_dump($arrFiltersGenericListingJson);
            //echo '</pre>';

            //exit();

            // echo '$this->arrFiltersGenericListingJson[returnStatus]=<pre>';
            // var_dump($this->arrFiltersGenericListingJson['returnStatus']);
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
                if ($this->tableName === config('app.gSystemConfig.configSystemDBTableFiltersGeneric')) {
                    $this->templateData['cphTitleCurrent'] .= ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleMain');
                }

                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Meta data.


                // Body - content place holder.
                // TODO: build content object.
                // $this->templateData['cphBody'] = 'idTbFiltersGeneric = ' . $idParentFiltersGeneric;
                // $this->templateData['cphBody'] = '_idParentFiltersGeneric = ' . $_idParentFiltersGeneric; // debug

                //$this->templateData['cphBody'] = 'partial-layout-admin-categories-listing';
                //NOTE: maybe change to dots in the blade layout to get the partial directly

                $this->templateData['cphBody']['arrFiltersGenericListing'] = $this->arrFiltersGenericListing;
                unset($this->templateData['cphBody']['arrFiltersGenericListing']['returnStatus']); // Clean extra data.

                // TODO: pass _pagingTotalRecords and _pagingTotal values
                // if (config('app.gSystemConfig.enableFiltersGenericBackendPagination') === 1) {
                    // $this->templateData['_pagingTotalRecords'] = $this->arrFiltersGenericListingJson['_pagingTotalRecords'];
                // }
            }

            // Debug.
            // return 'admin categories listing (controller) idTbFiltersGeneric = ' . $idTbFiltersGeneric;
            // $this->templateData['cphBody'] = $apiFiltersGenericListingCurrentResponse;
            // echo '_GET (inside controller)=' . $_GET['masterPageSelect'] . '<br />';
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

    // Handle filters generic insert.
    // **************************************************************************************
    /**
     * Handle filters generic insert.
     * @param Request $req
     * @return RedirectResponse
     */
    public function adminFiltersGenericInsert(Request $req): RedirectResponse
    {
        // Variables.
        // ----------------------
        $tblFiltersGenericImageMain = '';

        $apiFiltersGenericInsertResponse = null;
        $arrFiltersGenericInsertJson = null;
        // ----------------------

        // Define values.
        // ----------------------
        $this->filterIndex = (int) $req->post('filterIndex');
        $this->tableName = $req->post('tableName');
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: think about using buildReturnURL method (base controller).
        // $this->returnURL = $this->buildReturnURL($req); // Double check how the initial part of the address will be concatenated with the query strings.
        $this->returnURL = '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendFiltersGeneric') . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->filterIndex) {
            $this->returnURL .= '&filterIndex=' . $this->filterIndex;
        }
        if ($this->tableName) {
            $this->returnURL .= '&tableName=' . $this->tableName;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            // TODO: evaluate moving file upload before insert records (to eliminate update later).
            $apiFiltersGenericInsertResponse = Http::withOptions(['verify' => false])
                ->post(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/',
                    array_merge(
                        [
                            'filterIndex' => $this->filterIndex,
                            'tableName' => $this->tableName,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem')
                        ],
                        $req->all()
                    ) // ...$req->all() (splat only works on php 8.1 and up)
                );
            $arrFiltersGenericInsertJson = $apiFiltersGenericInsertResponse->json();

            // Files upload (in frontend server).
            $resultsFunctionsFiles = null;
            $formfileFieldsReference = null;
            $tblFiltersGenericID = $arrFiltersGenericInsertJson['idRecordInsert'];

            // Build file fields references.
            foreach (request()->allFiles() as $arrKey => $fileObject) {
                $formfileFieldsReference[$arrKey] = [
                    'originalFileName' => $fileObject->getClientOriginalName(),
                    'fileSize' => $fileObject->getSize(),
                    'temporaryFilePath' => $fileObject->getPathname(),
                    'fileExtension' => $fileObject->extension(),
                    'fileNamePrefix' => '',
                    'fileNameSufix' => '',
                    'fileDirectoryUpload' => '',
                ];

                // Debug.
                //echo 'arrKey=' . $arrKey . '<br />';
                //echo 'fileObject=' . $fileObject->getClientOriginalName() . '<br />';
                //array_push($formfileFieldsReference);
            }

            // image_main field.

            // Debug.
            /**/
            //echo 'allFiles=<pre>';
            //var_dump(request()->allFiles());
            //echo '</pre><br />';

            //echo 'formfileFieldsReference=<pre>';
            //var_dump($formfileFieldsReference);
            //echo '</pre><br />';
            //exit();

            // TODO: move upload to backend.
            $resultsFunctionsFiles = \SyncSystemNS\FunctionsFiles::filesUploadMultiple(
                $tblFiltersGenericID,
                $req,
                config('app.gSystemConfig.configDirectoryFilesUpload'),
                '',
                $formfileFieldsReference
            );

            if ($resultsFunctionsFiles['returnStatus'] === true) {
                $tblFiltersGenericArrDataFilesUpdate = null;
                $tblFiltersGenericImageMain = isset($resultsFunctionsFiles['image_main']) === true ? $resultsFunctionsFiles['image_main'] : $tblFiltersGenericImageMain;

                // Resize images.
                if ($tblFiltersGenericImageMain !== '') {
                    $tblFiltersGenericArrDataFilesUpdate['image_main'] = $tblFiltersGenericImageMain;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrFiltersGenericImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblFiltersGenericImageMain
                    );
                }

                // TODO: error check for image upload and resize.
                // API call (edit).
                $apiFiltersGenericFilesUpdateResponse = Http::withOptions(['verify' => false])
                    ->put(
                        config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
                        [
                            'strTable' => config('app.gSystemConfig.configSystemDBTableFiltersGeneric'),
                            'idRecord' => $tblFiltersGenericID,
                            'arrData' => $tblFiltersGenericArrDataFilesUpdate,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ]
                    );
                $arrFiltersGenericFilesUpdateJson = $apiFiltersGenericFilesUpdateResponse->json();
                // TODO: error check for update.

                // Debug.
                //echo 'arrFiltersGenericUpdateJson=<pre>';
                //var_dump($arrFiltersGenericUpdateJson);
                //echo '</pre><br />';
            }

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

            //echo 'req->all()=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //exit();
        } catch (\Exception $adminFiltersGenericInsertError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminFiltersGenericInsertError: ' . $adminFiltersGenericInsertError->getMessage());
            }
        } finally {
            //
        }

        // Redirect.
        if ($arrFiltersGenericInsertJson['returnStatus'] === true) {
            return redirect($this->returnURL)->with('messageSuccess', $arrFiltersGenericInsertJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage2'));
        } else {
            return redirect($this->returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage3'));
        }
    }
    // **************************************************************************************

    // Admin Filters Generic Edit.
    // **************************************************************************************
    /**
     * Admin Filters Generic Listing Controller.
     * @param float|string $_idTbFiltersGeneric
     * @return View
     */
    public function adminFiltersGenericEdit(float|string $_idTbFiltersGeneric = null): View
    {
        // Variables.
        // ----------------------
        $idTbFiltersGeneric = null;

        $arrFiltersGenericDetailsJson = null;
        $apiFiltersGenericDetailsResponse = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $idTbFiltersGeneric = $_idTbFiltersGeneric;
        // ----------------------

        // Logic.
        try {
            $apiFiltersGenericDetailsResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/' . $idTbFiltersGeneric . '/',
                    [
                        'apiKey' => config('app.gSystemConfig.configAPIKeySystem')
                    ]
                );
            $arrFiltersGenericDetailsJson = $apiFiltersGenericDetailsResponse->json();

            if ($arrFiltersGenericDetailsJson['returnStatus'] === true) {
                //$arrFiltersGenericDetails = $arrFiltersGenericDetailsJson['ofgdRecord'];

                // Build template data.
                //$this->templateData['idParentFiltersGeneric'] = $this->idParentFiltersGeneric;
                $this->templateData['idTbFiltersGeneric'] = $idTbFiltersGeneric;

                // Title - current - content place holder.
                $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendFiltersGenericTitleEdit');

                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Body - content place holder.
                $this->templateData['cphBody']['ofgdRecord'] = $arrFiltersGenericDetailsJson['ofgdRecord'];
            }

            // Debug.
            /*
            echo 'idTbFiltersGeneric=<pre>';
            var_dump($idTbFiltersGeneric);
            echo '</pre><br />';
            */
        } catch (\Exception $adminFiltersGenericEditError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminFiltersGenericEditError: ' . $adminFiltersGenericEditError->getMessage());
            }
        } finally {
            //
        }

        // Return with view.
        return view('admin.admin-filters-generic-edit')->with('templateData', $this->templateData);
            // TODO: replace route name with config variables.
    }
    // **************************************************************************************
}
