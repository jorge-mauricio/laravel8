<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Custom models.
use App\Models\CategoriesInsert;


class ApiCategoriesInsertController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = array('returnStatus' => false);
    private string $configAPIKey = '';

    private array|null $arrCategoriesInsertParameters = [];
    private mixed $ciAPI;
    //private CategoriesInsert $ciAPI;

    /*$tblCategoriesID = null;
    $tblCategoriesIdParent = null;
    $tblCategoriesSortOrder = 0;
    $tblCategoriesCategoryType = null;*/

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {

    }
    // **************************************************************************************

    public function insertCategories(Request $req): array
    {
        // Variables.
        //$ciAPI = null;

        // Build parameters.
        $this->arrCategoriesInsertParameters['_tblCategoriesID'] = null;
        $this->arrCategoriesInsertParameters['_tblCategoriesIdParent'] = (float)$req->post('id_parent');
        $this->arrCategoriesInsertParameters['_tblCategoriesSortOrder'] = (float)$req->post('sort_order');
        $this->arrCategoriesInsertParameters['_tblCategoriesCategoryType'] = (float)$req->post('category_type');

        // Logic.
        try {
            //$this->ciAPI = new CategoriesInsert($this->arrCategoriesInsertParameters);
            $this->ciAPI = new CategoriesInsert(['testing'=>'debug']);
            //$this->ciAPI = new CategoriesInsert();
            //$this->ciAPI->categoriesInsertBuildParameters($this->arrCategoriesInsertParameters);


            // Debug.
            //echo 'req->all() (inside api categories insert controller=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            //echo 'ciAPI=<pre>';
            //var_dump($ciAPI);
            //echo '</pre><br />';
            //dump($ciAPI);

            // $this->arrReturn['debug'] = $req->all(); // working
            $this->arrReturn['debug'] = $this->arrCategoriesInsertParameters;
            //$this->arrReturn['ciAPI'] = $this->ciAPI;
            $this->arrReturn['buildParameters'] = $this->ciAPI->buildParameters($this->arrCategoriesInsertParameters);
            $this->arrReturn['addRecord'] = $this->ciAPI->addRecord($this->arrCategoriesInsertParameters);
            //\SyncSystemNS\FunctionsDB::counterUniversalUpdate();
            //$this->arrReturn['categoriesInsertBuildParameters'] = $this->ciAPI->categoriesInsertBuildParameters($this->arrCategoriesInsertParameters);

            //exit();
        } catch (Error $insertCategoriesError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('insertCategoriesError: ' . $insertCategoriesError->message());
            }
        } finally {
            // Redirect
            // return redirect('/admin/categories/781')->with('status','Student Added Successfully');
        }

        return $this->arrReturn;
    }
}
