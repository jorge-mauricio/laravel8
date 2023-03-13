<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Custom models.
use App\Models\UsersDetails;

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
        /*
        $arrReturn = [
            'returnStatus' => false
        ];
        */
        $arrReturn = [
            'returnStatus' => false,
            'registerVerification' => false,
            'loginVerification' => false,
            'loginActivation' => false,
            'loginToken' => '',
            'tblRegistersIDCrypt' => '',
            'loginType' => []
        ];

        $username = '';
        //$email = '';
        $password = '';

        $registerVerification = false;
        $loginVerification = false;
        $loginActivation = false;

        $tblUsersID = '';
        $tblUsersIDCrypt = '';
        $tblUsersUsername = '';
        $tblUsersEmail = '';
        $tblUsersPassword = '';
        $tblUsersPasswordDecrypt = '';
        $tblUsersPasswordHint = '';
        $tblUsersPasswordLength = '';

        //$registerVerification = false;

        $arrSearchParameters = [];
        $arrUsersLoginParameters = [];
        $objUsersLogin = null;

        $arrRecordSearchParameters = [];
        $oudRecordParameters = [];
        $oudRecord = null;
        
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
            // TODO: Evaluate moving this to a function level.
            // User - Admin
            // ----------------------
            if ($verificationType === 'user_admin') {
                $arrReturn['returnStatus'] = true;

                // Object build.
                $objUsersLogin = new \SyncSystemNS\ObjectUsersListing($arrUsersLoginParameters);
                $resultsUsersListing = $objUsersLogin->recordsListingGet(0, 3);
                //$resultsUsersListing = (array) json_decode($objUsersLogin->recordsListingGet(0, 3), true);
                //$resultsUsersListing = json_decode(json_encode($objUsersLogin->recordsListingGet(0, 3)), true); // working
                
                // Loop through results.
                if ($resultsUsersListing['returnStatus'] === true) {
                    unset($resultsUsersListing['returnStatus']);
                    for ($countArray = 0; count($resultsUsersListing) > $countArray; $countArray++) {
                        $registerVerification = true;

                        // Clean values.
                        $tblUsersUsername = '';
                        $tblUsersEmail = '';
                        $tblUsersPassword = '';
                        $tblUsersPasswordDecrypt = '';
                        $tblUsersPasswordHint = '';
                        $tblUsersPasswordLength = '';

                        // Value definition.
                        $tblUsersPassword = $resultsUsersListing[$countArray]['password'];
                        $tblUsersPasswordDecrypt = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($tblUsersPassword, 'db'), SS_ENCRYPT_METHOD_DATA);
                        // TODO: adapt function to differentiate between info encryption and pasword encryption.
                        $tblUsersPasswordHint = '';
                        $tblUsersPasswordLength = '';
                    
                        // Verification method (SS_ENCRYPT_METHOD_DATA).
                        // TODO: Include other verification methods (hash).
                        if ($tblUsersPasswordDecrypt === $password && $tblUsersPasswordDecrypt !== '') {
                            $loginVerification = true;

                            // Check activation.
                            if ($resultsUsersListing[$countArray]['activation'] === 1) {
                                $loginActivation = true;
                            }                        

                            $tblUsersID = $resultsUsersListing[$countArray]['id'];
                            $tblUsersIDCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($tblUsersID, 'db_write_text'), SS_ENCRYPT_METHOD_DATA);
                            $tblUsersUsername = '';
                            $tblUsersEmail = '';
                            $tblUsersPassword = $resultsUsersListing[$countArray]['password'];
                            $tblUsersPasswordHint = '';
                            $tblUsersPasswordLength = '';
                                            
                            // Parameters build.
                            $arrRecordSearchParameters = ['id;' . $tblUsersID . ';i'];
                            $oudRecordParameters = [
                                '_arrSearchParameters' => $arrRecordSearchParameters,
                                '_idTbUsers' => $tblUsersID,
                                '_terminal' => $this->terminal,
                                '_arrSpecialParameters' => ['returnType' => 1],
                            ];
                                                
                            // Object method.
                            //$oudRecord = new \SyncSystemNS\ObjectUsersDetails($oudRecordParameters);
                            //$arrReturn['debug']['users_recordDetailsGet'] = $oudRecord->recordDetailsGet(0, 1);

                            // Model method (Sanctum).
                            $oudRecord = new UsersDetails($oudRecordParameters);
                            $oudRecordData = $oudRecord->cphBodyBuild();

                            // TODO: delete previous tokens from the user.
                            $oudRecordToken = $oudRecord->createToken($verificationType)->plainTextToken; // table: personal_access_tokens
                            $arrReturn['loginToken'] = $oudRecordToken; // TODO: evaluate cryptography for passing the token via API.

                            // Login type.
                            // TODO: develop for register login.
                            $arrReturn['loginType'] = [];

                            // Debug.
                            // $arrReturn['debug']['users_recordDetailsGet'] = $oudRecord->cphBodyBuild();
                            //$arrReturn['debug']['users_token'] = $oudRecordToken; 
                        }

                
                        // Debug.
                        // console.log('tblUsersID=', tblUsersID);
                        // console.log('tblUsersIDCrypt=', tblUsersIDCrypt);
                        // console.log('tblUsersPasswordDecrypt=', tblUsersPasswordDecrypt);
                        // console.log('objUsersLogin.resultsUsersListing[countArray].password=', objUsersLogin.resultsUsersListing[countArray].password);
                    }
                    
                    // Build return data.
                    $arrReturn['registerVerification'] = $registerVerification; // TODO: maybe, this would be the santum verification
                    $arrReturn['loginVerification'] = $loginVerification;
                    $arrReturn['loginActivation'] = $loginActivation;
                    $arrReturn['tblRegistersIDCrypt'] = $tblUsersIDCrypt; // TODO: Change to tblIDCrypt
                        // TODO: maybe, the sanctum authentication can be a salt and grabbed at the other end
                    //$arrReturn['loginType'] = [];
                }
                            

                // Debug.
                /*
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

                //$arrReturn['debug']['encryptValue'] = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite('laravel', 'db_write_text'), 2); // working
                //$arrReturn['debug']['decryptValue'] = \SyncSystemNS\FunctionsCrypto::decryptValue('def50200ea49abaef476566979ea1e5a2670d0d03593da608d8db650acad38741926caad9ac9a9e55574629c475e04271166ceebc297423b48a5bae5322f7450da6094e70e3c7e2593193a37a1ed0fe9b2346fe42375f10b9b7633', SS_ENCRYPT_METHOD_DATA); // debug - laravel Defused Encrypted // working
                //$arrReturn['debug']['decryptValue - contentMaskRead'] = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead('def50200ea49abaef476566979ea1e5a2670d0d03593da608d8db650acad38741926caad9ac9a9e55574629c475e04271166ceebc297423b48a5bae5322f7450da6094e70e3c7e2593193a37a1ed0fe9b2346fe42375f10b9b7633', 'db'), SS_ENCRYPT_METHOD_DATA) ; // debug - laravel Defused Encrypted // working

                $arrReturn['debug']['loginVerification'] = $loginVerification;
                $arrReturn['debug']['tblUsersID'] = $tblUsersID;
                $arrReturn['debug']['tblUsersIDCrypt'] = $tblUsersIDCrypt;
                */
                


            }
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
