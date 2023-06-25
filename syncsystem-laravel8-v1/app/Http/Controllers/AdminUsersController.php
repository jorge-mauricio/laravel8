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
            // TODO: replace with config variables
    }
    // **************************************************************************************

    // Handle users insert.
    // **************************************************************************************
    /**
     * Handle users insert.
     * @param Request $req
     * @return RedirectResponse
     */
    public function adminUsersInsert(Request $req): RedirectResponse
    {
        // Variables.
        // ----------------------
        $tblUsersImageMain = '';

        $apiUsersInsertResponse = null;
        $arrUsersInsertJson = null;

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


        $this->idParent = $req->post('idParent');
        $this->pageNumber = (int) $req->post('pageNumber');
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: think about using buildReturnURL method (base controller).
        $this->returnURL = '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendUsers') . '/' . $this->idParent . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            $apiUsersInsertResponse = Http::withOptions(['verify' => false])
                ->post(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/',
                    array_merge(
                        ['apiKey' => config('app.gSystemConfig.configAPIKeySystem')],
                        $req->all()
                    ) // ...$req->all() (splat only works on php 8.1 and up)
                );
            $arrUsersInsertJson = $apiUsersInsertResponse->json();

            // Files upload (in frontend server).
            $resultsFunctionsFiles = null;
            $formfileFieldsReference = null;
            $tblUsersID = $arrUsersInsertJson['idRecordInsert'];

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

            $resultsFunctionsFiles = \SyncSystemNS\FunctionsFiles::filesUploadMultiple(
                $tblUsersID,
                $req,
                config('app.gSystemConfig.configDirectoryFilesUpload'),
                '',
                $formfileFieldsReference
            );

            if ($resultsFunctionsFiles['returnStatus'] === true) {
                $tblUsersArrDataFilesUpdate = null;
                $tblUsersImageMain = isset($resultsFunctionsFiles['image_main']) === true ? $resultsFunctionsFiles['image_main'] : $tblUsersImageMain;

                // Resize images.
                if ($tblUsersImageMain !== '') {
                    $tblUsersArrDataFilesUpdate['image_main'] = $tblUsersImageMain;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrUsersImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblUsersImageMain
                    );
                }

                // TODO: error check for image upload and resize.
                // API call (edit).
                $apiUsersFilesUpdateResponse = Http::withOptions(['verify' => false])
                    ->put(
                        config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
                        [
                            'strTable' => config('app.gSystemConfig.configSystemDBTableUsers'),
                            'idRecord' => $tblUsersID,
                            'arrData' => $tblUsersArrDataFilesUpdate,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ]
                    );
                $arrUsersFilesUpdateJson = $apiUsersFilesUpdateResponse->json();
                // TODO: error check for update.

                // Debug.
                //echo 'arrCategoriesUpdateJson=<pre>';
                //var_dump($arrCategoriesUpdateJson);
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

            //echo 'tblCategoriesID=' . $tblCategoriesID . '<br />';
            //echo 'tblCategoriesIdParent=' . $tblCategoriesIdParent . '<br />';
            //echo 'tblCategoriesSortOrder=' . $tblCategoriesSortOrder . '<br />';
            //echo 'tblCategoriesCategoryType=' . $tblCategoriesCategoryType . '<br />';

            //echo 'idParentCategories=' . $this->idParentCategories . '<br />';
            //echo 'pageNumber=' . $this->pageNumber . '<br />';
            //echo 'masterPageSelect=' . $this->masterPageSelect . '<br />';

            //echo 'image_main=<pre>';
            //var_dump($req->file('image_main'));
            // '</pre><br />';

            //echo 'originalFileName=<pre>';
            //var_dump($formfileFieldsReference['image_main']['originalFileName']);
            //echo '</pre><br />';

            //echo 'temporaryFilePath=<pre>';
            //var_dump($formfileFieldsReference['image_main']['temporaryFilePath']);
            //echo '</pre><br />';

            //echo 'configDirectoryFilesUpload=<pre>';
            //var_dump($GLOBALS['configDirectoryFilesUpload']);
            //echo '</pre><br />';

            //echo 'configDirectoryFilesUpload=<pre>';
            //var_dump($GLOBALS['configDirectoryFilesUpload']);
            //echo '</pre><br />';

            //echo 'resultsFunctionsFiles=<pre>';
            //var_dump($resultsFunctionsFiles);
            //echo '</pre><br />';
            /*
            echo 'tblCategoriesImageMain=<pre>';
            var_dump($tblCategoriesImageMain);
            echo '</pre><br />';

            echo 'tblCategoriesImageFile1=<pre>';
            var_dump($tblCategoriesImageFile1);
            echo '</pre><br />';

            echo 'tblCategoriesImageFile2=<pre>';
            var_dump($tblCategoriesImageFile2);
            echo '</pre><br />';

            echo 'tblCategoriesImageFile3=<pre>';
            var_dump($tblCategoriesImageFile3);
            echo '</pre><br />';

            echo 'tblCategoriesImageFile4=<pre>';
            var_dump($tblCategoriesImageFile4);
            echo '</pre><br />';

            echo 'tblCategoriesImageFile5=<pre>';
            var_dump($tblCategoriesImageFile5);
            echo '</pre><br />';
            */

            //exit();
        } catch (\Exception $adminUsersInsertError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminUsersInsertError: ' . $adminUsersInsertError->getMessage());
            }
        } finally {
            //
        }

        // Redirect.
        if ($arrUsersInsertJson['returnStatus'] === true) {
            return redirect($this->returnURL)->with('messageSuccess', $arrUsersInsertJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage2'));
        } else {
            return redirect($this->returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage3'));
        }
    }
    // **************************************************************************************
}
