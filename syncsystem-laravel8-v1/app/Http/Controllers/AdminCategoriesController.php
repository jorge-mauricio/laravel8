<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminCategoriesController extends AdminBaseController
{
    // Properties.
    // ----------------------
    // private float|string|null $_idParent = null;
    private float|string|null $idParentCategories = null;
    // private float|null $pageNumber = null;
    private int|null $pageNumber = null;
    // private string|null $pageNumber = null;
    protected string|null $masterPageSelect = 'layout-admin-main';
    private string|null $returnURL = null; // TODO: evaluate moving this to the method level.

    private array $cookiesData;
    private array $templateData;

    // private array|null $arrCategoriesListingJson = null;
    // private array|null $arrCategoriesDetails = null;
    // private array|null $arrCategoriesListing = null;

    //private array|null $arrCategoriesInsertJson = null;

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

    // Admin categories listing.
    // **************************************************************************************
    /**
     * Admin categories listing.
     * @param float|string $_idParentCategories
     * @param Request $req
     * @return View
     */
    // public function adminCategoriesListing(float|string $idParent = null): string //TODO: change to the right type
    public function adminCategoriesListing(float|string $_idParentCategories = null, Request $req): View
    {
        // Variables.
        // ----------------------
        // float|string $idParent = null;
        $apiCategoriesListingCurrentResponse = null;
        $arrCategoriesListingJson = null;

        $arrCategoriesDetails = null;
        $arrCategoriesListing = null;

        $apiFiltersGenericListingResponse = null; // TODO: evaluate changing these to properties, since they´re used in more the one method.
        $arrFiltersGenericListingJson = null;
        // ----------------------

        // Value definition.
        // ----------------------
        // $this->_idParent = $idParent;
        $this->idParentCategories = $_idParentCategories;
        // ----------------------

        // Logic.
        try {
            // Categories API call.
            // Debug: https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008
            // $apiCategoriesDetailsCurrentResponse = Http::get('https://backendnode.fullstackwebdesigner.com/api/categories/0/?apiKey=fswd@2008');
            // $apiCategoriesDetailsCurrentResponse = Http::withOptions(['verify' => false])->get('https://backendnode.fullstackwebdesigner.com/api/categories/' . $this->_idParentCategories . '/?apiKey=fswd@2008');

            // $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get('http://127.0.0.1:8000/api/categories/' . $this->idParentCategories . '/?apiKey=fswd@2008');
            // $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get('http://localhost:8001/api/categories/' . $this->idParentCategories . '/?apiKey=fswd@2008');
            /*
            $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])->get(env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPICategories'] . '/' . $this->idParentCategories . '/', [
                'apiKey' => env('CONFIG_API_KEY_SYSTEM')
            ]);
            */
            $apiCategoriesListingCurrentResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . $this->idParentCategories . '/', // phpcs:ignore
                    array_merge(
                        ['apiKey' => config('app.gSystemConfig.configAPIKeySystem')],
                        $req->all()
                    )
                );

            // Note / TODO: On production, set verify to true.
            //return $apiCategoriesDetailsCurrentResponse->json();
            $arrCategoriesListingJson = $apiCategoriesListingCurrentResponse->json();

            // Filters generic API call.
            $apiFiltersGenericListingResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' .
                    config('app.gSystemConfig.configRouteAPI') . '/' .
                    config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/',
                    array_merge(
                        [
                            'tableName' => config('app.gSystemConfig.configSystemDBTableCategories'),
                            // 'filterIndex' => $this->filterIndex,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ],
                        // $req->all()
                    )
                );

            // Note / TODO: On production, set verify to true.
            $arrFiltersGenericListingJson = $apiFiltersGenericListingResponse->json();

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


            if ($arrCategoriesListingJson['returnStatus'] === true) {
                $arrCategoriesDetails = $arrCategoriesListingJson['ocdRecord'];
                $arrCategoriesListing = $arrCategoriesListingJson['oclRecords'];
                // Note: array listing array comes with extra data ("returnStatus" => true), so needs data treatment to clean it.


                // Build template data.
                $this->templateData['idParentCategories'] = $this->idParentCategories;

                // Title - current - content place holder.
                //$this->idParentCategories = (float) $this->idParentCategories;
                // Debug.
                //echo 'idParentCategories=' . $this->idParentCategories . '<br />';
                //echo 'idParentCategories=<pre>';
                //var_dump((float) $this->idParentCategories);
                //echo '</pre><br />';

                // if (floatval($this->idParentCategories) !== 0) {
                if ((float) $this->idParentCategories > 0) {
                    $this->templateData['cphTitleCurrent'] = $arrCategoriesDetails['tblCategoriesTitle'];
                } else {
                    $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesTitleMain');
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

                $this->templateData['cphBody']['arrCategoriesDetails'] = $arrCategoriesDetails;
                $this->templateData['cphBody']['arrCategoriesListing'] = $arrCategoriesListing;
                unset($this->templateData['cphBody']['arrCategoriesListing']['returnStatus']); // Clean extra data.

                // TODO: pass _pagingTotalRecords and _pagingTotal values
                if (config('app.gSystemConfig.enableCategoriesBackendPagination') === 1) {
                    $this->templateData['_pagingTotalRecords'] = $arrCategoriesListingJson['_pagingTotalRecords'];
                }

                if ($arrFiltersGenericListingJson['returnStatus'] === true) {
                    $this->templateData['cphBody']['ofglRecords'] = $arrFiltersGenericListingJson['ofglRecords'];
                    unset($this->templateData['cphBody']['ofglRecords']['returnStatus']); // Clean extra data.
                } else {
                    $this->templateData['cphBody']['ofglRecords'] = [];
                    // TODO: test with empty results and optimize (deleting the else condition if returns empty array).
                }

                // Dynamic data.
                //$this->templateData['additionalData']['arrCategoriesDetails'] = $this->arrCategoriesDetails;
                //$this->templateData['additionalData']['arrCategoriesListing'] = $this->arrCategoriesListing;

                // Layout.
                //$this->templateData['masterPageSelect'] = $_GET['masterPageSelect']; // 'layout-admin-main'
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
        // return view('layout-backend-main', compact('templateData')); // working, as long as templateData is a variable, not a property
        // return View::make('layout-backend-main')->with('templateData', $this->templateData); // error
        // return view('layout-backend-main', compact(['templateData' => $this->templateData]));
        // return view('layout-backend-main', ['templateData' => $this->templateData]); // working
        // return view('layout-backend-main')->with('templateData', $this->templateData); // working
        // return view('admin.layout-admin-main')->with('templateData', $this->templateData); // working
        return view('admin.admin-categories-listing')->with('templateData', $this->templateData); // working
    }
    // **************************************************************************************

    // Handle categories insert.
    // **************************************************************************************
    /**
     * Handle categories insert.
     * @param Request $req
     * @return RedirectResponse
     */
    public function adminCategoriesInsert(Request $req): RedirectResponse
    {
        //TODO: create option for "load / architecture" method (api / monolithic).

        // Variables.
        // ----------------------
        $tblCategoriesImageMain = '';
        $tblCategoriesImageFile1 = '';
        $tblCategoriesImageFile2 = '';
        $tblCategoriesImageFile3 = '';
        $tblCategoriesImageFile4 = '';
        $tblCategoriesImageFile5 = '';

        $apiCategoriesInsertResponse = null;
        $arrCategoriesInsertJson = null;

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


        $this->idParentCategories = $req->post('idParent');
        $this->pageNumber = (int) $req->post('pageNumber');
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: think about using buildReturnURL method (base controller).
        $this->returnURL = '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . $this->idParentCategories . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            /**/
            // array_push($arrData, 'apiKey' => env('CONFIG_API_KEY_SYSTEM');
            // $arrData = array_merge($arrData, $req->all());
            // dd($req->post('idsCategoriesFiltersGeneric1'));
            /*
            withHeaders([
                    'Content-Type' => 'multipart/form-data'
                ])
                ->
            */
            // TODO: evaluate moving file upload before insert records (to eliminate update later).
            $apiCategoriesInsertResponse = Http::withOptions(['verify' => false])
                //->attach('image_main', $req->file('image_main'))
                //->attach('image_main', file_get_contents($req->file('image_main')), 'image.jpg') // working.
                //->attach('image_main', file_get_contents($req->file('image_main')), $req->file('image_main')['originalName'])
                ->post(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPICategories') . '/',
                    array_merge(
                        ['apiKey' => config('app.gSystemConfig.configAPIKeySystem')],
                        $req->all()
                    ) // ...$req->all() (splat only works on php 8.1 and up)
                    /*'tblCategoriesID' => $tblCategoriesID,
                    'tblCategoriesIdParent' => $tblCategoriesIdParent,
                    'tblCategoriesSortOrder' => $tblCategoriesSortOrder,
                    'tblCategoriesCategoryType' => $tblCategoriesCategoryType,
                    */
                );
            // Note: images can be sent through Http, but needs another architecture.
            // ref: https://stackoverflow.com/questions/63897164/laravel-http-client-how-to-send-file
            // ref: https://laracasts.com/discuss/channels/laravel/sending-uploaded-file-to-external-api-using-the-http-client
            $arrCategoriesInsertJson = $apiCategoriesInsertResponse->json();

            // Files upload (in frontend server).
            $resultsFunctionsFiles = null;
            $formfileFieldsReference = null;
            //$formfileFieldsReference = [];
            $tblCategoriesID = $arrCategoriesInsertJson['idRecordInsert'];

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

                // Set prefix.
                switch ($arrKey) {
                    case 'file1':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f1-';
                        break;
                    case 'file2':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f2-';
                        break;
                    case 'file3':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f3-';
                        break;
                    case 'file4':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f4-';
                        break;
                    case 'file5':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f5-';
                        break;
                    default:
                        break;
                }

                // Debug.
                //echo 'arrKey=' . $arrKey . '<br />';
                //echo 'fileObject=' . $fileObject->getClientOriginalName() . '<br />';
                //array_push($formfileFieldsReference);
            }

            // image_main field.
            //$imageMain = $req->file('image_main');
            //dump($imageMain);
            //$formfileFieldsReference['image_main'] = $req->file('image_main');
            //$formfileFieldsReference['image_main']['originalFileName'] = $req->file('image_main')['originalName']; // not working.
            //$formfileFieldsReference['image_main']['originalFileName'] = $req->file('image_main')->originalName; // not working.
            //$formfileFieldsReference['image_main']['originalFileName'] = $imageMain->originalName; // not working
            //$formfileFieldsReference['image_main']['originalFileName'] = $imageMain['originalName']; // not working

            /*
            $formfileFieldsReference['postedFile'] = ['image_main'];
            $formfileFieldsReference['image_main']['originalFileName'] = $req->file('image_main')->getClientOriginalName();
            $formfileFieldsReference['image_main']['temporaryFilePath'] = $req->file('image_main')->getPathname();

            if ($GLOBALS['enableCategoriesImageMain'] === 1) {

            }
            */

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
                $tblCategoriesID,
                $req,
                config('app.gSystemConfig.configDirectoryFilesUpload'),
                '',
                $formfileFieldsReference
            );

            if ($resultsFunctionsFiles['returnStatus'] === true) {
                $tblCategoriesArrDataFilesUpdate = null;
                $tblCategoriesImageMain = isset($resultsFunctionsFiles['image_main']) === true ? $resultsFunctionsFiles['image_main'] : $tblCategoriesImageMain;
                $tblCategoriesImageFile1 = isset($resultsFunctionsFiles['file1']) === true ? $resultsFunctionsFiles['file1'] : $tblCategoriesImageFile1;
                $tblCategoriesImageFile2 = isset($resultsFunctionsFiles['file2']) === true ? $resultsFunctionsFiles['file2'] : $tblCategoriesImageFile2;
                $tblCategoriesImageFile3 = isset($resultsFunctionsFiles['file3']) === true ? $resultsFunctionsFiles['file3'] : $tblCategoriesImageFile3;
                $tblCategoriesImageFile4 = isset($resultsFunctionsFiles['file4']) === true ? $resultsFunctionsFiles['file4'] : $tblCategoriesImageFile4;
                $tblCategoriesImageFile5 = isset($resultsFunctionsFiles['file5']) === true ? $resultsFunctionsFiles['file5'] : $tblCategoriesImageFile5;

                // Resize images.
                if ($tblCategoriesImageMain !== '') {
                    $tblCategoriesArrDataFilesUpdate['image_main'] = $tblCategoriesImageMain;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageMain
                    );
                }
                if ($tblCategoriesImageFile1 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file1'] = $tblCategoriesImageFile1;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile1
                    );
                }
                if ($tblCategoriesImageFile2 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file2'] = $tblCategoriesImageFile2;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile2
                    );
                }
                if ($tblCategoriesImageFile3 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file3'] = $tblCategoriesImageFile3;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile3
                    );
                }
                if ($tblCategoriesImageFile4 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file4'] = $tblCategoriesImageFile4;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile4
                    );
                }
                if ($tblCategoriesImageFile5 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file5'] = $tblCategoriesImageFile5;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile5
                    );
                }

                // TODO: error check for image upload and resize.
                // API call (edit).
                $apiCategoriesFilesUpdateResponse = Http::withOptions(['verify' => false])
                    ->put(
                        config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
                        [
                            'strTable' => config('app.gSystemConfig.configSystemDBTableCategories'),
                            'idRecord' => $tblCategoriesID,
                            'arrData' => $tblCategoriesArrDataFilesUpdate,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ]
                    );
                $arrCategoriesFilesUpdateJson = $apiCategoriesFilesUpdateResponse->json();
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
        } catch (\Exception $adminCategoriesInsertError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminCategoriesInsertError: ' . $adminCategoriesInsertError->getMessage());
            }
        } finally {
            //
        }

        // Redirect.
        if ($arrCategoriesInsertJson['returnStatus'] === true) {
            // $this->returnURL .= '&messageSuccess=statusMessage2';
            return redirect($this->returnURL)->with('messageSuccess', $arrCategoriesInsertJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage2'));
        } else {
            // $this->returnURL .= '&messageError=statusMessage3';
            return redirect($this->returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage3'));
        }
    }
    // **************************************************************************************

    // Admin Categories Edit.
    // **************************************************************************************
    /**
     * Admin Categories Listing Controller.
     * @param float|string $_idTbCategories
     * @return View
     */
    public function adminCategoriesEdit(float|string $_idTbCategories = null): View
    {
        // Variables.
        // ----------------------
        $idTbCategories = null;

        $arrCategoriesDetailsJson = null;
        $arrCategoriesDetails = null;

        $apiURLCategoriesDetailsCurrent = null;
        $apiCategoriesDetailsCurrentResponse = null;

        $apiFiltersGenericListingResponse = null;
        $arrFiltersGenericListingJson = null;
        // ----------------------

        // Value definition.
        // ----------------------
        $idTbCategories = $_idTbCategories;
        // ----------------------

        // Logic.
        try {
            // Categories details API call.
            $apiCategoriesDetailsCurrentResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/' . $idTbCategories . '/',
                    [
                        'apiKey' => config('app.gSystemConfig.configAPIKeySystem')
                    ]
                );
            $arrCategoriesDetailsJson = $apiCategoriesDetailsCurrentResponse->json();

            // Filters generic API call.
            $apiFiltersGenericListingResponse = Http::withOptions(['verify' => false])
                ->get(
                    config('app.gSystemConfig.configAPIURL') . '/' .
                    config('app.gSystemConfig.configRouteAPI') . '/' .
                    config('app.gSystemConfig.configRouteAPIFiltersGeneric') . '/',
                    array_merge(
                        [
                            'tableName' => config('app.gSystemConfig.configSystemDBTableCategories'),
                            // 'filterIndex' => $this->filterIndex,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ],
                        // $req->all()
                    )
                );

            // Note / TODO: On production, set verify to true.
            $arrFiltersGenericListingJson = $apiFiltersGenericListingResponse->json();

            if ($arrCategoriesDetailsJson['returnStatus'] === true) {
                //$arrCategoriesDetails = $arrCategoriesDetailsJson['ocdRecord'];

                // Build template data.
                //$this->templateData['idParentCategories'] = $this->idParentCategories;
                $this->templateData['idTbCategories'] = $idTbCategories;

                // Title - current - content place holder.
                $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendCategoriesTitleEdit');

                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'configSiteTile') . ' - ' . $this->templateData['cphTitleCurrent'];

                // Body - content place holder.
                $this->templateData['cphBody']['ocdRecord'] = $arrCategoriesDetailsJson['ocdRecord'];

                if ($arrFiltersGenericListingJson['returnStatus'] === true) {
                    $this->templateData['cphBody']['ofglRecords'] = $arrFiltersGenericListingJson['ofglRecords'];
                    unset($this->templateData['cphBody']['ofglRecords']['returnStatus']); // Clean extra data.
                    // TODO: optimize - this array can come from the ObjectCategoriesDetails.
                } else {
                    $this->templateData['cphBody']['ofglRecords'] = [];
                    // TODO: test with empty results and optimize (deleting the else condition if returns empty array).
                }
            }

            // Debug.
            /*
            echo 'idTbCategories=<pre>';
            var_dump($idTbCategories);
            echo '</pre><br />';
            */
        } catch (\Exception $adminCategoriesEditError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminCategoriesEditError: ' . $adminCategoriesEditError->getMessage());
            }
        } finally {
            //
        }

        // Return with view.
        return view('admin.admin-categories-edit')->with('templateData', $this->templateData);
            // TODO: replace route name with config variables.
    }
    // **************************************************************************************

    // Handle categories edit update.
    // **************************************************************************************
    /**
     * Handle categories edit update.
     * @param Request $req
     * @return RedirectResponse
     */
    public function adminCategoriesUpdate(Request $req): RedirectResponse
    {
        // Variables.
        // ----------------------
        $idTbCategories = null;

        $tblCategoriesImageMain = '';
        $tblCategoriesImageFile1 = '';
        $tblCategoriesImageFile2 = '';
        $tblCategoriesImageFile3 = '';
        $tblCategoriesImageFile4 = '';
        $tblCategoriesImageFile5 = '';

        $apiCategoriesUpdateResponse = null;
        $arrCategoriesUpdateJson = null;

        //$tblCategoriesID = null;
        //$tblCategoriesIdParent = null;
        //$tblCategoriesSortOrder = 0;
        //$tblCategoriesCategoryType = null;
        // ----------------------

        // Define values.
        // ----------------------
        $idTbCategories = $req->post('id');
        // $tblCategoriesID = null;
        //$tblCategoriesIdParent = $req->post('id_parent');
        //$tblCategoriesSortOrder = $req->post('sort_order');
        //$tblCategoriesCategoryType = $req->post('category_type');


        $this->idParentCategories = $req->post('idParent');
        $this->pageNumber = (int) $req->post('pageNumber'); // TODO: check why this variable is comming in as string
        $this->masterPageSelect = $req->post('masterPageSelect');
        // ----------------------

        // Return URL build.
        // ----------------------
        // TODO: think about using buildReturnURL method (base controller).
        $this->returnURL = '/' . config('app.gSystemConfig.configRouteBackend') . '/' . config('app.gSystemConfig.configRouteBackendCategories') . '/' . $this->idParentCategories . '/';
        $this->returnURL .= '?masterPageSelect=' . $this->masterPageSelect;
        if ($this->pageNumber) {
            $this->returnURL .= '&pageNumber=' . $this->pageNumber;
        }
        // ----------------------

        // Logic.
        try {
            // API call.
            // TODO: evaluate moving file upload before insert records (to eliminate update later).
            $apiCategoriesUpdateResponse = Http::withOptions(['verify' => false])
                //->attach('image_main', $req->file('image_main'))
                //->attach('image_main', file_get_contents($req->file('image_main')), 'image.jpg') // working.
                //->attach('image_main', file_get_contents($req->file('image_main')), $req->file('image_main')['originalName'])
                ->put(
                    config('app.gSystemConfig.configAPIURL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPICategories') . '/' . config('app.gSystemConfig.configRouteAPIActionEdit') . '/',
                    array_merge(
                        ['apiKey' => config('app.gSystemConfig.configAPIKeySystem')],
                        $req->all()
                    ) // ...$req->all() (splat only works on php 8.1 and up)
                    /*'tblCategoriesID' => $tblCategoriesID,
                    'tblCategoriesIdParent' => $tblCategoriesIdParent,
                    'tblCategoriesSortOrder' => $tblCategoriesSortOrder,
                    'tblCategoriesCategoryType' => $tblCategoriesCategoryType,
                    */
                );
            $arrCategoriesUpdateJson = $apiCategoriesUpdateResponse->json();

            // Files upload (in frontend server).
            $resultsFunctionsFiles = null;
            $formfileFieldsReference = null;
            $tblCategoriesID = $arrCategoriesUpdateJson['idRecordUpdate'];

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

                // Set prefix.
                switch ($arrKey) {
                    case 'file1':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f1-';
                        break;
                    case 'file2':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f2-';
                        break;
                    case 'file3':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f3-';
                        break;
                    case 'file4':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f4-';
                        break;
                    case 'file5':
                        $formfileFieldsReference[$arrKey]['fileNamePrefix'] = 'f5-';
                        break;
                    default:
                        break;
                }

                // Debug.
                //echo 'arrKey=' . $arrKey . '<br />';
                //echo 'fileObject=' . $fileObject->getClientOriginalName() . '<br />';
                //array_push($formfileFieldsReference);
            }

            $resultsFunctionsFiles = \SyncSystemNS\FunctionsFiles::filesUploadMultiple(
                $tblCategoriesID,
                $req,
                config('app.gSystemConfig.configDirectoryFilesUpload'),
                '',
                $formfileFieldsReference
            );

            if ($resultsFunctionsFiles['returnStatus'] === true) {
                $tblCategoriesArrDataFilesUpdate = null;
                $tblCategoriesImageMain = isset($resultsFunctionsFiles['image_main']) === true ? $resultsFunctionsFiles['image_main'] : $tblCategoriesImageMain;
                $tblCategoriesImageFile1 = isset($resultsFunctionsFiles['file1']) === true ? $resultsFunctionsFiles['file1'] : $tblCategoriesImageFile1;
                $tblCategoriesImageFile2 = isset($resultsFunctionsFiles['file2']) === true ? $resultsFunctionsFiles['file2'] : $tblCategoriesImageFile2;
                $tblCategoriesImageFile3 = isset($resultsFunctionsFiles['file3']) === true ? $resultsFunctionsFiles['file3'] : $tblCategoriesImageFile3;
                $tblCategoriesImageFile4 = isset($resultsFunctionsFiles['file4']) === true ? $resultsFunctionsFiles['file4'] : $tblCategoriesImageFile4;
                $tblCategoriesImageFile5 = isset($resultsFunctionsFiles['file5']) === true ? $resultsFunctionsFiles['file5'] : $tblCategoriesImageFile5;

                // Resize images.
                if ($tblCategoriesImageMain !== '') {
                    $tblCategoriesArrDataFilesUpdate['image_main'] = $tblCategoriesImageMain;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageMain
                    );
                }
                if ($tblCategoriesImageFile1 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file1'] = $tblCategoriesImageFile1;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile1
                    );
                }
                if ($tblCategoriesImageFile2 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file2'] = $tblCategoriesImageFile2;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile2
                    );
                }
                if ($tblCategoriesImageFile3 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file3'] = $tblCategoriesImageFile3;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile3
                    );
                }
                if ($tblCategoriesImageFile4 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file4'] = $tblCategoriesImageFile4;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile4
                    );
                }
                if ($tblCategoriesImageFile5 !== '') {
                    $tblCategoriesArrDataFilesUpdate['file5'] = $tblCategoriesImageFile5;
                    $resultsFunctionsImageResize01 = \SyncSystemNS\FunctionsImage::imageResize01(
                        config('app.gSystemConfig.configArrCategoriesImageSize'),
                        config('app.gSystemConfig.configDirectoryFiles'),
                        $tblCategoriesImageFile5
                    );
                }

                // TODO: error check for image upload and resize.
                // API call (edit).
                $apiCategoriesFilesUpdateResponse = Http::withOptions(['verify' => false])
                    ->put(
                        config('app.gSystemConfig.configAPIURL')  . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIRecords') . '/',
                        [
                            'strTable' => config('app.gSystemConfig.configSystemDBTableCategories'),
                            'idRecord' => $tblCategoriesID,
                            'arrData' => $tblCategoriesArrDataFilesUpdate,
                            'apiKey' => config('app.gSystemConfig.configAPIKeySystem'),
                        ]
                    );
                $arrCategoriesFilesUpdateJson = $apiCategoriesFilesUpdateResponse->json();
                // TODO: error check for update.

                // Debug.
                //echo 'arrCategoriesUpdateJson=<pre>';
                //var_dump($arrCategoriesUpdateJson);
                //echo '</pre><br />';
            }

            // Debug.
            /*
            echo 'idTbCategories=<pre>';
            var_dump($idTbCategories);
            echo '</pre><br />';

            echo 'arrCategoriesUpdateJson=<pre>';
            var_dump($arrCategoriesUpdateJson);
            echo '</pre><br />';
            */
            // exit();
        } catch (\Exception $adminCategoriesUpdateError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminCategoriesUpdateError: ' . $adminCategoriesUpdateError->getMessage());
            }
        } finally {
            //
        }

        // Redirect.
        $redirectParameters = [];
        if ($arrCategoriesUpdateJson['returnStatus'] === true) {
            $redirectParameters = [
                'messageSuccess' => $arrCategoriesUpdateJson['nRecords'] . ' ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage7')
            ];
        } else {
            $redirectParameters = [
                'messageError' => \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'statusMessage8')
            ];
        }

        return redirect($this->returnURL)->with($redirectParameters);
    }
    // **************************************************************************************
}
