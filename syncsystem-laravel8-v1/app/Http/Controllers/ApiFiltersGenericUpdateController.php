<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\FiltersGenericUpdate;

class ApiFiltersGenericUpdateController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false]; // TODO: move this to method.
    private string $configAPIKey = '';

    private array|null $arrFiltersGenericUpdateParameters = [];
    private mixed $fguAPI;

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param Request $req
     */
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle filters generic update record and return data.
    // **************************************************************************************
    /**
     * Handle filters generic update record and return data.
     * @param Request $req
     * @return array
     */
    public function updateFiltersGeneric(Request $req): array
    {
        // Build parameters.
        // ----------------------
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericID'] = (float) $req->post('id');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericSortOrder'] = (float) $req->post('sort_order');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericFilterIndex'] = $req->post('filter_index');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericTableName'] = $req->post('table_name');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericTitle'] = $req->post('title');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericDescription'] = $req->post('description');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericURLAlias'] = $req->post('url_alias');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericKeywordsTags'] = $req->post('keywords_tags');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericMetaDescription'] = $req->post('meta_description');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericMetaTitle'] = $req->post('meta_title');
        // $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericMetaInfo'] = $req->post('meta_info');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericInfoSmall1'] = $req->post('info_small1');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericInfoSmall2'] = $req->post('info_small2');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericInfoSmall3'] = $req->post('info_small3');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericInfoSmall4'] = $req->post('info_small4');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericInfoSmall5'] = $req->post('info_small5');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNumberSmall1'] = (float) $req->post('number_small1');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNumberSmall2'] = (float) $req->post('number_small2');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNumberSmall3'] = (float) $req->post('number_small3');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNumberSmall4'] = (float) $req->post('number_small4');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNumberSmall5'] = (float) $req->post('number_small5');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation'] = (int) $req->post('activation');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation1'] = (int) $req->post('activation1');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation2'] = (int) $req->post('activation2');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation3'] = (int) $req->post('activation3');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation4'] = (int) $req->post('activation4');
        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericActivation5'] = (int) $req->post('activation5');

        $this->arrFiltersGenericUpdateParameters['_tblFiltersGenericNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->fguAPI = new FiltersGenericUpdate($this->arrFiltersGenericUpdateParameters);
            $this->arrReturn = $this->fguAPI->updateRecord();

            // Debug.
            //$this->arrReturn['debug'] = $this->arrFiltersGenericUpdateParameters;

            //echo 'this->arrFiltersGenericUpdateParameters=<pre>';
            //var_dump($this->arrFiltersGenericUpdateParameters);
            //echo '</pre><br />';
        } catch (\Exception $updateFiltersGenericError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('updateFiltersGenericError: ' . $updateFiltersGenericError->getMessage());
            }
        } finally {
            //
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
}
