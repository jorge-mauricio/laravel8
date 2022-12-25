<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\CategoriesUpdate;

class ApiCategoriesUpdateController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    private array|null $arrCategoriesUpdateParameters = [];
    private mixed $cuAPI;

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle category update record and return data.
    // **************************************************************************************
    /**
     * Handle category update record and return data.
     * @param Request $req
     * @return array
     */
    public function updateCategories(Request $req): array
    {

        // Build parameters.
        // ----------------------
        $this->arrCategoriesUpdateParameters['_tblCategoriesID'] = (float)$req->post('id');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdParent'] = (float)$req->post('id_parent');
        $this->arrCategoriesUpdateParameters['_tblCategoriesSortOrder'] = (float)$req->post('sort_order');
        $this->arrCategoriesUpdateParameters['_tblCategoriesCategoryType'] = (float)$req->post('category_type');

        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegisterUser'] = (float)$req->post('id_register_user');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegister1'] = (float)$req->post('id_register1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegister2'] = (float)$req->post('id_register2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegister3'] = (float)$req->post('id_register3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegister4'] = (float)$req->post('id_register4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesIdRegister5'] = (float)$req->post('id_register5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesTitle'] = $req->post('title');
        $this->arrCategoriesUpdateParameters['_tblCategoriesDescription'] = $req->post('description');

        $this->arrCategoriesUpdateParameters['_tblCategoriesURLAlias'] = $req->post('url_alias');
        $this->arrCategoriesUpdateParameters['_tblCategoriesKeywordsTags'] = $req->post('keywords_tags');
        $this->arrCategoriesUpdateParameters['_tblCategoriesMetaDescription'] = $req->post('meta_description');
        $this->arrCategoriesUpdateParameters['_tblCategoriesMetaTitle'] = $req->post('meta_title');
        $this->arrCategoriesUpdateParameters['_tblCategoriesMetaInfo'] = $req->post('meta_info');

        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo1'] = $req->post('info1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo2'] = $req->post('info2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo3'] = $req->post('info3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo4'] = $req->post('info4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo5'] = $req->post('info5');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo6'] = $req->post('info6');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo7'] = $req->post('info7');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo8'] = $req->post('info8');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo9'] = $req->post('info9');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfo10'] = $req->post('info10');

        $this->arrCategoriesUpdateParameters['_tblCategoriesInfoSmall1'] = $req->post('info_small1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfoSmall2'] = $req->post('info_small2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfoSmall3'] = $req->post('info_small3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfoSmall4'] = $req->post('info_small4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesInfoSmall5'] = $req->post('info_small5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesNumber1'] = (float)$req->post('number1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumber2'] = (float)$req->post('number2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumber3'] = (float)$req->post('number3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumber4'] = (float)$req->post('number4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumber5'] = (float)$req->post('number5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesNumberSmall1'] = (float)$req->post('number_small1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumberSmall2'] = (float)$req->post('number_small2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumberSmall3'] = (float)$req->post('number_small3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumberSmall4'] = (float)$req->post('number_small4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesNumberSmall5'] = (float)$req->post('number_small5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesDate1'] = $req->post('date1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesDate2'] = $req->post('date2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesDate3'] = $req->post('date3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesDate4'] = $req->post('date4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesDate5'] = $req->post('date5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation'] = (int)$req->post('activation');
        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation1'] = (int)$req->post('activation1');
        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation2'] = (int)$req->post('activation2');
        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation3'] = (int)$req->post('activation3');
        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation4'] = (int)$req->post('activation4');
        $this->arrCategoriesUpdateParameters['_tblCategoriesActivation5'] = (int)$req->post('activation5');

        $this->arrCategoriesUpdateParameters['_tblCategoriesIdStatus'] = (float)$req->post('id_status');
        $this->arrCategoriesUpdateParameters['_tblCategoriesRestrictedAccess'] = (int)$req->post('restricted_access');

        $this->arrCategoriesUpdateParameters['_tblCategoriesNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->cuAPI = new CategoriesUpdate($this->arrCategoriesUpdateParameters);
            $this->arrReturn = $this->cuAPI->updateRecord();

            // Debug.
            //$this->arrReturn['debug'] = $this->arrCategoriesUpdateParameters;

            //echo 'this->arrCategoriesUpdateParameters=<pre>';
            //var_dump($this->arrCategoriesUpdateParameters);
            //echo '</pre><br />';

        } catch (Error $updateCategoriesError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('updateCategoriesError: ' . $updateCategoriesError->message());
            }
        } finally {
            //
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
        
}
