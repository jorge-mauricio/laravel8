<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; // TODO: delete this import and test.

// Custom models.
use App\Models\CategoriesInsert;

class ApiCategoriesInsertController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
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
    /**
     * Constructor.
     */
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle category insert record and return data.
    // **************************************************************************************
    /**
     * Handle category insert record and return data.
     * @param Request $req
     * @return array
     */
    public function insertCategories(Request $req): array
    //public function insertCategories(Request $req): mixed
    {
        // Variables.
        //$ciAPI = null;
        //$addRecordResult = [];

        // Build parameters.
        // ----------------------
        $this->arrCategoriesInsertParameters['_tblCategoriesID'] = null;
        $this->arrCategoriesInsertParameters['_tblCategoriesIdParent'] = (float)$req->post('id_parent');
        $this->arrCategoriesInsertParameters['_tblCategoriesSortOrder'] = (float)$req->post('sort_order');
        $this->arrCategoriesInsertParameters['_tblCategoriesCategoryType'] = (float)$req->post('category_type');

        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegisterUser'] = (float)$req->post('id_register_user');
        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegister1'] = (float)$req->post('id_register1');
        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegister2'] = (float)$req->post('id_register2');
        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegister3'] = (float)$req->post('id_register3');
        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegister4'] = (float)$req->post('id_register4');
        $this->arrCategoriesInsertParameters['_tblCategoriesIdRegister5'] = (float)$req->post('id_register5');

        $this->arrCategoriesInsertParameters['_tblCategoriesTitle'] = $req->post('title');
        $this->arrCategoriesInsertParameters['_tblCategoriesDescription'] = $req->post('description');

        $this->arrCategoriesInsertParameters['_tblCategoriesURLAlias'] = $req->post('url_alias');
        $this->arrCategoriesInsertParameters['_tblCategoriesKeywordsTags'] = $req->post('keywords_tags');
        $this->arrCategoriesInsertParameters['_tblCategoriesMetaDescription'] = $req->post('meta_description');
        $this->arrCategoriesInsertParameters['_tblCategoriesMetaTitle'] = $req->post('meta_title');
        $this->arrCategoriesInsertParameters['_tblCategoriesMetaInfo'] = $req->post('meta_info');

        $this->arrCategoriesInsertParameters['_tblCategoriesInfo1'] = $req->post('info1');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo2'] = $req->post('info2');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo3'] = $req->post('info3');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo4'] = $req->post('info4');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo5'] = $req->post('info5');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo6'] = $req->post('info6');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo7'] = $req->post('info7');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo8'] = $req->post('info8');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo9'] = $req->post('info9');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfo10'] = $req->post('info10');

        $this->arrCategoriesInsertParameters['_tblCategoriesInfoSmall1'] = $req->post('info_small1');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfoSmall2'] = $req->post('info_small2');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfoSmall3'] = $req->post('info_small3');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfoSmall4'] = $req->post('info_small4');
        $this->arrCategoriesInsertParameters['_tblCategoriesInfoSmall5'] = $req->post('info_small5');

        $this->arrCategoriesInsertParameters['_tblCategoriesNumber1'] = (float)$req->post('number1');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumber2'] = (float)$req->post('number2');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumber3'] = (float)$req->post('number3');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumber4'] = (float)$req->post('number4');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumber5'] = (float)$req->post('number5');

        $this->arrCategoriesInsertParameters['_tblCategoriesNumberSmall1'] = (float)$req->post('number_small1');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumberSmall2'] = (float)$req->post('number_small2');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumberSmall3'] = (float)$req->post('number_small3');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumberSmall4'] = (float)$req->post('number_small4');
        $this->arrCategoriesInsertParameters['_tblCategoriesNumberSmall5'] = (float)$req->post('number_small5');

        $this->arrCategoriesInsertParameters['_tblCategoriesDate1'] = $req->post('date1');
        $this->arrCategoriesInsertParameters['_tblCategoriesDate2'] = $req->post('date2');
        $this->arrCategoriesInsertParameters['_tblCategoriesDate3'] = $req->post('date3');
        $this->arrCategoriesInsertParameters['_tblCategoriesDate4'] = $req->post('date4');
        $this->arrCategoriesInsertParameters['_tblCategoriesDate5'] = $req->post('date5');

        $this->arrCategoriesInsertParameters['_tblCategoriesActivation'] = (int)$req->post('activation');
        $this->arrCategoriesInsertParameters['_tblCategoriesActivation1'] = (int)$req->post('activation1');
        $this->arrCategoriesInsertParameters['_tblCategoriesActivation2'] = (int)$req->post('activation2');
        $this->arrCategoriesInsertParameters['_tblCategoriesActivation3'] = (int)$req->post('activation3');
        $this->arrCategoriesInsertParameters['_tblCategoriesActivation4'] = (int)$req->post('activation4');
        $this->arrCategoriesInsertParameters['_tblCategoriesActivation5'] = (int)$req->post('activation5');

        $this->arrCategoriesInsertParameters['_tblCategoriesIdStatus'] = (float)$req->post('id_status');
        $this->arrCategoriesInsertParameters['_tblCategoriesRestrictedAccess'] = (int)$req->post('restricted_access');

        $this->arrCategoriesInsertParameters['_tblCategoriesNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->ciAPI = new CategoriesInsert($this->arrCategoriesInsertParameters);
            //$this->ciAPI = new CategoriesInsert(['testing'=>'debug']);
            //$this->ciAPI = new CategoriesInsert(); // working
            //$this->ciAPI->categoriesInsertBuildParameters($this->arrCategoriesInsertParameters);
            //$addRecordResult = $this->ciAPI->addRecord();
            /*
            if ($addRecordResult['returnStatus'] === true) {
                $this->arrReturn['returnStatus'] = true;
            }
            */
            $this->arrReturn = $this->ciAPI->addRecord();


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

            //echo 'this->arrCategoriesInsertParameters=<pre>';
            //var_dump($this->arrCategoriesInsertParameters);
            //echo '</pre><br />';

            //echo 'genericFieldGet01 (filters)=<pre>';
            //var_dump(\SyncSystemNS\FunctionsGeneric::contentMaskRead(\SyncSystemNS\FunctionsDB::genericFieldGet01(948, $GLOBALS['configSystemDBTableFiltersGeneric'], 'title'), 'db'));
            //echo '</pre><br />';

            //echo 'genericFieldGet01=<pre>';
            //var_dump(\SyncSystemNS\FunctionsDB::genericFieldGet01(1, $GLOBALS['configSystemDBTableCounter'], 'counter_global'));
            //echo '</pre><br />';         

            /*
            echo 'counterUniversalUpdate()=<pre>';
            var_dump(\SyncSystemNS\FunctionsDB::counterUniversalUpdate());
            echo '</pre><br />';
            exit();
            */

            /*echo 'updateRecordGeneric10=' . \SyncSystemNS\FunctionsDBUpdate::updateRecordGeneric10('counter', 
            'counter_global', 
            '330',
            ["id;" . 2 . ";i"]) . '<br />';
            */

            /*
            echo 'updateRecordGeneric10=<pre>';
            var_dump(\SyncSystemNS\FunctionsDBUpdate::updateRecordGeneric10('counter', 
            'counter_global', 
            '320',
            ["id;" . 2 . ";i"]));
            echo '</pre><br />'; //working
            */

            // $this->arrReturn['debug'] = $req->all(); // working
            // $this->arrReturn['debug'] = $this->arrCategoriesInsertParameters; //working
            //$this->arrReturn['ciAPI'] = $this->ciAPI;
            //$this->arrReturn['buildParameters'] = $this->ciAPI->buildParameters($this->arrCategoriesInsertParameters);
            //$this->arrReturn['addRecord'] = $this->ciAPI->addRecord($this->arrCategoriesInsertParameters);
            // $this->arrReturn['addRecord'] = $this->ciAPI->addRecord(); //working

            //\SyncSystemNS\FunctionsDB::counterUniversalUpdate();
            //$this->arrReturn['categoriesInsertBuildParameters'] = $this->ciAPI->categoriesInsertBuildParameters($this->arrCategoriesInsertParameters);

            //echo 'this->arrReturn=<pre>';
            //var_dump($this->arrReturn);
            //echo '</pre><br />';

            //exit();
        } catch (Error $insertCategoriesError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('insertCategoriesError: ' . $insertCategoriesError->message());
            }
        } finally {
            // Redirect
            // return redirect('/admin/categories/781')->with('status','Student Added Successfully');
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
