<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiAuthenticationController extends Controller
{
    // Properties.
    // ----------------------
    private float|null $terminal = 0;
    private string $apiKey = '';
    private string $configAPIKey = '';
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

    // Check authentication data.
    // **************************************************************************************
    /**
     * Check authentication data.
     * @param Request $req
     * @return array
     */
    public function authenticationCheck(Request $req): array
    {
        // Variables.
        // ----------------------
        $arrReturn = [
            'returnStatus' => false
        ];
        /*
        $arrReturn = [
            'returnStatus' => false,
            'registerVerification' => false,
            'loginVerification' => false,
            'loginActivation' => false,
            'tblRegistersIDCrypt' => '',
            'loginType' => []
        ];
        */

        $username = '';
        $email = '';
        $password = '';

        $loginVerification = false;
        $registerVerification = false;

        $arrSearchParameters = [];
        $arrUsersLoginParameters = [];
        $objUsersLogin = null;
        
        $actionType = '';
        $verificationType = '';
        // ----------------------

        // Define values.
        // ----------------------
        $username = $req->post('username');
        $password = $req->post('password');
        
        $actionType = $req->post('actionType');
        $verificationType = $req->post('verificationType');

        // Parameters build.
        array_push($arrSearchParameters, 'username;' . $username . ';s');
        array_push($arrSearchParameters, 'id;11;!i'); // exclude user - root
        array_push($arrSearchParameters, 'activation;1;i');

        $arrUsersLoginParameters = [
            '_arrSearchParameters' => $arrSearchParameters,
            '_configSortOrder' => $GLOBALS['configUsersSort'],
            '_strNRecords' => '',
            '_arrSpecialParameters' => ['returnType' => 1],
        ];
        // ----------------------

        // Logic.
        try {
            // Object build.
            $objUsersLogin = new \SyncSystemNS\ObjectUsersListing($arrUsersLoginParameters);
            $objUsersLogin->recordsListingGet(0, 3);
                  

            // Debug.
            $arrReturn['debug']['username'] = $username;
            $arrReturn['debug']['password'] = $password;
            $arrReturn['debug']['actionType'] = $actionType;
            $arrReturn['debug']['objUsersLogin'] = $objUsersLogin;
            $arrReturn['debug']['verificationType'] = $verificationType;

        } catch(Exception $apiAuthenticationCheckError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('apiAuthenticationCheckError: ' . $apiAuthenticationCheckError->message());
            }
        } finally {
            //
        }

        
        return $arrReturn;
    }
    // **************************************************************************************
}
