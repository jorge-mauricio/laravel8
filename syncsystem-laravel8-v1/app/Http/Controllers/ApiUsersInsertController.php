<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\UsersInsert;

class ApiUsersInsertController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    private string $configAPIKey = '';

    private array|null $arrUsersInsertParameters = [];
    private mixed $uiAPI;

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

    // Handle users insert record and return data.
    // **************************************************************************************
    /**
     * Handle users insert record and return data.
     * @param Request $req
     * @return array
     */
    public function insertUsers(Request $req): array
    {
        // Variables.
        //$uiAPI = null;
        //$addRecordResult = [];

        // Build parameters.
        // ----------------------
        $this->arrUsersInsertParameters['_tblUsersID'] = null;
        $this->arrUsersInsertParameters['_tblUsersIdParent'] = (float) $req->post('id_parent');
        $this->arrUsersInsertParameters['_tblUsersSortOrder'] = (float) $req->post('sort_order');

        $this->arrUsersInsertParameters['_tblUsersIdType'] = (int) $req->post('id_type');

        $this->arrUsersInsertParameters['_tblUsersNameTitle'] = $req->post('name_title');
        $this->arrUsersInsertParameters['_tblUsersNameFull'] = $req->post('name_full');
        $this->arrUsersInsertParameters['_tblUsersNameFirst'] = $req->post('name_first');
        $this->arrUsersInsertParameters['_tblUsersNameLast'] = $req->post('name_last');

        $this->arrUsersInsertParameters['_tblUsersDateBirth'] = $req->post('date_birth');
        $this->arrUsersInsertParameters['_tblUsersDateBirthHour'] = $req->post('date_birth_hour');
        $this->arrUsersInsertParameters['_tblUsersDateBirthMinute'] = $req->post('date_birth_minute');
        $this->arrUsersInsertParameters['_tblUsersDateBirthSeconds'] = $req->post('date_birth_seconds');
        $this->arrUsersInsertParameters['_tblUsersDateBirthDay'] = $req->post('date_birth_day');
        $this->arrUsersInsertParameters['_tblUsersDateBirthMonth'] = $req->post('date_birth_month');
        $this->arrUsersInsertParameters['_tblUsersDateBirthYear'] = $req->post('date_birth_year');
        // TODO: double check SyncSystemNS.FunctionsGeneric.dateMount logic (ref node version).
        $this->arrUsersInsertParameters['_tblUsersGender'] = (int) $req->post('gender');

        $this->arrUsersInsertParameters['_tblUsersDocument'] = $req->post('document');
        $this->arrUsersInsertParameters['_tblUsersAddressStreet'] = $req->post('address_street');
        $this->arrUsersInsertParameters['_tblUsersAddressNumber'] = $req->post('address_number');
        $this->arrUsersInsertParameters['_tblUsersAddressComplement'] = $req->post('address_complement');
        $this->arrUsersInsertParameters['_tblUsersNeighborhood'] = $req->post('neighborhood');
        $this->arrUsersInsertParameters['_tblUsersDistrict'] = $req->post('district');
        $this->arrUsersInsertParameters['_tblUsersCounty'] = $req->post('county');
        $this->arrUsersInsertParameters['_tblUsersCity'] = $req->post('city');
        $this->arrUsersInsertParameters['_tblUsersState'] = $req->post('state');
        $this->arrUsersInsertParameters['_tblUsersCountry'] = $req->post('country');
        $this->arrUsersInsertParameters['_tblUsersZipCode'] = $req->post('zip_code');

        $this->arrUsersInsertParameters['_tblUsersPhone1InternationalCode'] = $req->post('phone1_international_code');
        $this->arrUsersInsertParameters['_tblUsersPhone1AreaCode'] = $req->post('phone1_area_code');
        $this->arrUsersInsertParameters['_tblUsersPhone1'] = $req->post('phone1');

        $this->arrUsersInsertParameters['_tblUsersPhone2InternationalCode'] = $req->post('phone2_international_code');
        $this->arrUsersInsertParameters['_tblUsersPhone2AreaCode'] = $req->post('phone2_area_code');
        $this->arrUsersInsertParameters['_tblUsersPhone2'] = $req->post('phone2');

        $this->arrUsersInsertParameters['_tblUsersPhone3InternationalCode'] = $req->post('phone3_international_code');
        $this->arrUsersInsertParameters['_tblUsersPhone3AreaCode'] = $req->post('phone3_area_code');
        $this->arrUsersInsertParameters['_tblUsersPhone3'] = $req->post('phone3');

        $this->arrUsersInsertParameters['_tblUsersUsername'] = $req->post('username');
        $this->arrUsersInsertParameters['_tblUsersEmail'] = $req->post('email');
        $this->arrUsersInsertParameters['_tblUsersPassword'] = $req->post('password');
        $this->arrUsersInsertParameters['_tblUsersPasswordHint'] = $req->post('password_hint');
        $this->arrUsersInsertParameters['_tblUsersPasswordLength'] = $req->post('password_length');

        $this->arrUsersInsertParameters['_tblUsersInfo1'] = $req->post('info1');
        $this->arrUsersInsertParameters['_tblUsersInfo2'] = $req->post('info2');
        $this->arrUsersInsertParameters['_tblUsersInfo3'] = $req->post('info3');
        $this->arrUsersInsertParameters['_tblUsersInfo4'] = $req->post('info4');
        $this->arrUsersInsertParameters['_tblUsersInfo5'] = $req->post('info5');
        $this->arrUsersInsertParameters['_tblUsersInfo6'] = $req->post('info6');
        $this->arrUsersInsertParameters['_tblUsersInfo7'] = $req->post('info7');
        $this->arrUsersInsertParameters['_tblUsersInfo8'] = $req->post('info8');
        $this->arrUsersInsertParameters['_tblUsersInfo9'] = $req->post('info9');
        $this->arrUsersInsertParameters['_tblUsersInfo10'] = $req->post('info10');

        $this->arrUsersInsertParameters['_tblUsersActivation'] = (int) $req->post('activation');
        $this->arrUsersInsertParameters['_tblUsersActivation1'] = (int) $req->post('activation1');
        $this->arrUsersInsertParameters['_tblUsersActivation2'] = (int) $req->post('activation2');
        $this->arrUsersInsertParameters['_tblUsersActivation3'] = (int) $req->post('activation3');
        $this->arrUsersInsertParameters['_tblUsersActivation4'] = (int) $req->post('activation4');
        $this->arrUsersInsertParameters['_tblUsersActivation5'] = (int) $req->post('activation5');

        $this->arrUsersInsertParameters['_tblUsersIdStatus'] = (float) $req->post('id_status');
        $this->arrUsersInsertParameters['_tblUsersNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->uiAPI = new UsersInsert($this->arrUsersInsertParameters);
            $this->arrReturn = $this->uiAPI->addRecord();


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

            //echo 'uiAPI=<pre>';
            //var_dump($uiAPI);
            //echo '</pre><br />';
            //dump($uiAPI);

            //echo 'this->arrUsersInsertParameters=<pre>';
            //var_dump($this->arrUsersInsertParameters);
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
            // $this->arrReturn['debug'] = $this->arrUsersInsertParameters; //working
            //$this->arrReturn['uiAPI'] = $this->uiAPI;
            //$this->arrReturn['buildParameters'] = $this->uiAPI->buildParameters($this->arrUsersInsertParameters);
            //$this->arrReturn['addRecord'] = $this->uiAPI->addRecord($this->arrUsersInsertParameters);
            // $this->arrReturn['addRecord'] = $this->uiAPI->addRecord(); //working

            //\SyncSystemNS\FunctionsDB::counterUniversalUpdate();
            //$this->arrReturn['categoriesInsertBuildParameters'] = $this->uiAPI->categoriesInsertBuildParameters($this->arrUsersInsertParameters);

            //echo 'this->arrReturn=<pre>';
            //var_dump($this->arrReturn);
            //echo '</pre><br />';

            //exit();
        } catch (\Error $insertUsersError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('insertUsersError: ' . $insertUsersError->getMessage());
            }
        } finally {
            // Redirect
            // return redirect('/admin/categories/781')->with('status','Student Added Successfully');
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
}
