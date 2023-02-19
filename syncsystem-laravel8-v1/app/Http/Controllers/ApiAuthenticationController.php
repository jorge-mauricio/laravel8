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
        //$email = '';
        $password = '';
        $loginVerification = false;

        $tblUsersID = '';
        $tblUsersIDCrypt = '';
        $tblUsersUsername = '';
        $tblUsersEmail = '';
        $tblUsersPassword = '';
        $tblUsersPasswordDecrypt = '';
      


        //$registerVerification = false;

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
            $resultsUsersListing = $objUsersLogin->recordsListingGet(0, 3);
            //$resultsUsersListing = (array) json_decode($objUsersLogin->recordsListingGet(0, 3), true);
            //$resultsUsersListing = json_decode(json_encode($objUsersLogin->recordsListingGet(0, 3)), true); // working
            
            // Loop through results.
            /**/
            if ($resultsUsersListing['returnStatus'] === true) {
                unset($resultsUsersListing['returnStatus']);
                for ($countArray = 0; count($resultsUsersListing) > $countArray; $countArray++) {
                    // Clean values.
                    $tblUsersUsername = '';
                    $tblUsersEmail = '';
                    $tblUsersPassword = '';
                    $tblUsersPasswordDecrypt = '';
            
                    // Value definition.
                    $tblUsersPassword = $resultsUsersListing[$countArray]['password'];
                    
                    $tblUsersPasswordDecrypt = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($tblUsersPassword, 'db'), SS_ENCRYPT_METHOD_DATA);
            /*
                    if ($tblUsersPasswordDecrypt === $password && $tblUsersPasswordDecrypt !== '') {
                    $loginVerification = true;
                    $tblUsersID = $resultsUsersListing[$countArray]['id'];
                    $tblUsersIDCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($tblUsersID, 'db_write_text'), 2);
                    }
                    */
            
                    // Debug.
                    // console.log('tblUsersID=', tblUsersID);
                    // console.log('tblUsersIDCrypt=', tblUsersIDCrypt);
                    // console.log('tblUsersPasswordDecrypt=', tblUsersPasswordDecrypt);
                    // console.log('objUsersLogin.resultsUsersListing[countArray].password=', objUsersLogin.resultsUsersListing[countArray].password);
                }              
            }
                          

            // Debug.
            $arrReturn['debug']['username'] = $username;
            $arrReturn['debug']['password'] = $password;
            $arrReturn['debug']['actionType'] = $actionType;
            $arrReturn['debug']['objUsersLogin'] = $objUsersLogin;
            $arrReturn['debug']['resultsUsersListing'] = $resultsUsersListing;
            $arrReturn['debug']['verificationType'] = $verificationType;
            $arrReturn['debug']['tblUsersUsername'] = $tblUsersUsername;
            $arrReturn['debug']['tblUsersEmail'] = $tblUsersEmail;
            $arrReturn['debug']['tblUsersPassword'] = $tblUsersPassword;
            $arrReturn['debug']['tblUsersPasswordDecrypt'] = $tblUsersPasswordDecrypt;

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
