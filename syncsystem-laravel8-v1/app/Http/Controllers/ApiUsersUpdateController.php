<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Custom models.
use App\Models\UsersUpdate;

class ApiUsersUpdateController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false]; // TODO: move this to method.
    private string $configAPIKey = '';

    private array|null $arrUsersUpdateParameters = [];
    private mixed $uuAPI;

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

    // Handle user update record and return data.
    // **************************************************************************************
    /**
     * Handle user update record and return data.
     * @param Request $req
     * @return array
     */
    public function updateUsers(Request $req): array
    {
        // Build parameters.
        // ----------------------
        $this->arrUsersUpdateParameters['_tblUsersID'] = (float) $req->post('id');
        $this->arrUsersUpdateParameters['_tblUsersIdParent'] = (float) $req->post('id_parent');
        $this->arrUsersUpdateParameters['_tblUsersSortOrder'] = (float) $req->post('sort_order');

        $this->arrUsersUpdateParameters['_tblUsersIdType'] = (int) $req->post('id_type');

        $this->arrUsersUpdateParameters['_tblUsersNameTitle'] = $req->post('name_title');
        $this->arrUsersUpdateParameters['_tblUsersNameFull'] = $req->post('name_full');
        $this->arrUsersUpdateParameters['_tblUsersNameFirst'] = $req->post('name_first');
        $this->arrUsersUpdateParameters['_tblUsersNameLast'] = $req->post('name_last');

        $this->arrUsersUpdateParameters['_tblUsersDateBirth'] = $req->post('date_birth');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthHour'] = $req->post('date_birth_hour');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthMinute'] = $req->post('date_birth_minute');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthSeconds'] = $req->post('date_birth_seconds');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthDay'] = $req->post('date_birth_day');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthMonth'] = $req->post('date_birth_month');
        $this->arrUsersUpdateParameters['_tblUsersDateBirthYear'] = $req->post('date_birth_year');
        // TODO: double check SyncSystemNS.FunctionsGeneric.dateMount logic (ref node version).
        $this->arrUsersUpdateParameters['_tblUsersGender'] = (int) $req->post('gender');

        $this->arrUsersUpdateParameters['_tblUsersDocument'] = $req->post('document');
        $this->arrUsersUpdateParameters['_tblUsersAddressStreet'] = $req->post('address_street');
        $this->arrUsersUpdateParameters['_tblUsersAddressNumber'] = $req->post('address_number');
        $this->arrUsersUpdateParameters['_tblUsersAddressComplement'] = $req->post('address_complement');
        $this->arrUsersUpdateParameters['_tblUsersNeighborhood'] = $req->post('neighborhood');
        $this->arrUsersUpdateParameters['_tblUsersDistrict'] = $req->post('district');
        $this->arrUsersUpdateParameters['_tblUsersCounty'] = $req->post('county');
        $this->arrUsersUpdateParameters['_tblUsersCity'] = $req->post('city');
        $this->arrUsersUpdateParameters['_tblUsersState'] = $req->post('state');
        $this->arrUsersUpdateParameters['_tblUsersCountry'] = $req->post('country');
        $this->arrUsersUpdateParameters['_tblUsersZipCode'] = $req->post('zip_code');

        $this->arrUsersUpdateParameters['_tblUsersPhone1InternationalCode'] = $req->post('phone1_international_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone1AreaCode'] = $req->post('phone1_area_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone1'] = $req->post('phone1');

        $this->arrUsersUpdateParameters['_tblUsersPhone2InternationalCode'] = $req->post('phone2_international_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone2AreaCode'] = $req->post('phone2_area_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone2'] = $req->post('phone2');

        $this->arrUsersUpdateParameters['_tblUsersPhone3InternationalCode'] = $req->post('phone3_international_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone3AreaCode'] = $req->post('phone3_area_code');
        $this->arrUsersUpdateParameters['_tblUsersPhone3'] = $req->post('phone3');

        $this->arrUsersUpdateParameters['_tblUsersUsername'] = $req->post('username');
        $this->arrUsersUpdateParameters['_tblUsersEmail'] = $req->post('email');
        $this->arrUsersUpdateParameters['_tblUsersPassword'] = $req->post('password');
        $this->arrUsersUpdateParameters['_tblUsersPasswordHint'] = $req->post('password_hint');
        $this->arrUsersUpdateParameters['_tblUsersPasswordLength'] = $req->post('password_length');

        $this->arrUsersUpdateParameters['_tblUsersInfo1'] = $req->post('info1');
        $this->arrUsersUpdateParameters['_tblUsersInfo2'] = $req->post('info2');
        $this->arrUsersUpdateParameters['_tblUsersInfo3'] = $req->post('info3');
        $this->arrUsersUpdateParameters['_tblUsersInfo4'] = $req->post('info4');
        $this->arrUsersUpdateParameters['_tblUsersInfo5'] = $req->post('info5');
        $this->arrUsersUpdateParameters['_tblUsersInfo6'] = $req->post('info6');
        $this->arrUsersUpdateParameters['_tblUsersInfo7'] = $req->post('info7');
        $this->arrUsersUpdateParameters['_tblUsersInfo8'] = $req->post('info8');
        $this->arrUsersUpdateParameters['_tblUsersInfo9'] = $req->post('info9');
        $this->arrUsersUpdateParameters['_tblUsersInfo10'] = $req->post('info10');

        $this->arrUsersUpdateParameters['_tblUsersActivation'] = (int) $req->post('activation');
        $this->arrUsersUpdateParameters['_tblUsersActivation1'] = (int) $req->post('activation1');
        $this->arrUsersUpdateParameters['_tblUsersActivation2'] = (int) $req->post('activation2');
        $this->arrUsersUpdateParameters['_tblUsersActivation3'] = (int) $req->post('activation3');
        $this->arrUsersUpdateParameters['_tblUsersActivation4'] = (int) $req->post('activation4');
        $this->arrUsersUpdateParameters['_tblUsersActivation5'] = (int) $req->post('activation5');

        $this->arrUsersUpdateParameters['_tblUsersIdStatus'] = (float) $req->post('id_status');
        $this->arrUsersUpdateParameters['_tblUsersNotes'] = $req->post('notes');
        // ----------------------

        // Logic.
        try {
            $this->uuAPI = new UsersUpdate($this->arrUsersUpdateParameters);
            $this->arrReturn = $this->uuAPI->updateRecord();

            // Debug.
            //$this->arrReturn['debug'] = $this->arrUsersUpdateParameters;

            //echo 'this->arrUsersUpdateParameters=<pre>';
            //var_dump($this->arrUsersUpdateParameters);
            //echo '</pre><br />';
        } catch (\Exception $updateUsersError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('updateUsersError: ' . $updateUsersError->getMessage());
            }
        } finally {
            //
        }

        return $this->arrReturn;
    }
    // **************************************************************************************
}
