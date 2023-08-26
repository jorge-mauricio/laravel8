<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\FiltersGenericInsert;

class ApiFiltersGenericInsertController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    private array|null $arrFiltersGenericInsertParameters = [];
    private array|null|FiltersGenericInsert $fgiAPI = null;

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     */
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle filters generic insert record and return data.
    // **************************************************************************************
    /**
     * Handle filters generic insert record and return data.
     * @param Request $req
     * @return array
     */
    public function insertFiltersGeneric(Request $req): array
    {
        // Build parameters.
        // ----------------------
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericID'] = null;
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericSortOrder'] = (float) $req->post('sort_order');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericFilterIndex'] = (int) $req->post('filter_index');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericTableName'] = $req->post('table_name');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericTitle'] = $req->post('title');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericDescription'] = $req->post('description');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericURLAlias'] = $req->post('url_alias');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericKeywordsTags'] = $req->post('keywords_tags');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericMetaDescription'] = $req->post('meta_description');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericMetaTitle'] = $req->post('meta_title');
        // $this->arrFiltersGenericInsertParameters['_tblFiltersGenericMetaInfo'] = $req->post('meta_info');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericInfoSmall1'] = $req->post('info_small1');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericInfoSmall2'] = $req->post('info_small2');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericInfoSmall3'] = $req->post('info_small3');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericInfoSmall4'] = $req->post('info_small4');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericInfoSmall5'] = $req->post('info_small5');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNumberSmall1'] = (float) $req->post('number_small1');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNumberSmall2'] = (float) $req->post('number_small2');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNumberSmall3'] = (float) $req->post('number_small3');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNumberSmall4'] = (float) $req->post('number_small4');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNumberSmall5'] = (float) $req->post('number_small5');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation'] = (int) $req->post('activation');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation1'] = (int) $req->post('activation1');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation2'] = (int) $req->post('activation2');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation3'] = (int) $req->post('activation3');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation4'] = (int) $req->post('activation4');
        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericActivation5'] = (int) $req->post('activation5');

        $this->arrFiltersGenericInsertParameters['_tblFiltersGenericNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->fgiAPI = new FiltersGenericInsert($this->arrFiltersGenericInsertParameters);
            $this->arrReturn = $this->fgiAPI->addRecord();

            // Image upload (backend server).
            //$imageMain = $req->file('image_main');
            //$this->arrReturn['imageMain'] = $imageMain;
            //$this->arrReturn['req_image_main'] = $req->image_main;
            //$this->arrReturn['image_main'] = $req->post('image_main'); // working (TODO: test how it´s going to behave once it´s in an online server)
            //$this->arrReturn['req_all'] = $req->post();
            //$this->arrReturn['req_postid_parent'] = $req->post('id_parent');

            // Debug.
            //echo 'req->all() (inside api categories insert controller=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //echo 'ciAPI=<pre>';
            //var_dump($ciAPI);
            //echo '</pre><br />';
            //dump($ciAPI);

            //echo 'this->arrFiltersGenericInsertParameters=<pre>';
            //var_dump($this->arrFiltersGenericInsertParameters);
            //echo '</pre><br />';

            // $this->arrReturn['debug'] = $req->all(); // working
            // $this->arrReturn['debug'] = $this->arrFiltersGenericInsertParameters; //working
            //$this->arrReturn['ciAPI'] = $this->ciAPI;
            //$this->arrReturn['buildParameters'] = $this->ciAPI->buildParameters($this->arrFiltersGenericInsertParameters);
            //$this->arrReturn['addRecord'] = $this->ciAPI->addRecord($this->arrFiltersGenericInsertParameters);
            // $this->arrReturn['addRecord'] = $this->ciAPI->addRecord(); //working

            //echo 'this->arrReturn=<pre>';
            //var_dump($this->arrReturn);
            //echo '</pre><br />';

            //exit();
        } catch (\Exception $insertFiltersGenericError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('insertFiltersGenericError: ' . $insertFiltersGenericError->getMessage());
            }
        } finally {
            //
        }

        /*
        if ($this->arrReturn['returnStatus'] === true) {
            return redirect('/system/categories/781')->with('status','Record Added Successfully');
        }
        */

        return $this->arrReturn;
    }
    // **************************************************************************************
}
