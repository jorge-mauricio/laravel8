<?php

declare(strict_types=1);

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
            'usersVerification' => false, // users table
            'registerVerification' => false, // registers table
            'loginVerification' => false,
            'loginActivation' => false,
            'loginToken' => '',
            'tblUsersIDCrypt' => '', // users table
            'tblRegistersIDCrypt' => '', // registers table
            'loginType' => []
        ];

        $username = '';
        //$email = '';
        $password = '';

        $usersVerification = false;
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
        // ----------------------

        // Logic.
        try {
            // TODO: Evaluate moving this to a function level.
            // User - Admin.
            // ----------------------
            if ($verificationType === 'user_admin') {
                $arrReturn['returnStatus'] = true;

                // Parameters build.
                array_push($arrSearchParameters, 'username;' . $username . ';s');
                array_push($arrSearchParameters, 'id;11;!i'); // exclude user - root (backend node)
                array_push($arrSearchParameters, 'id;12;!i'); // exclude user - root (backend PHP Laravel - Data - MCrypt PHP)
                array_push($arrSearchParameters, 'id;14;!i'); // exclude user - root (backend PHP Laravel - Data - Defuse php-encryption)
                array_push($arrSearchParameters, 'activation;1;i');

                $arrUsersLoginParameters = [
                    '_arrSearchParameters' => $arrSearchParameters,
                    '_configSortOrder' => config('app.gSystemConfig.configUsersSort'),
                    '_strNRecords' => '',
                    '_arrSpecialParameters' => ['returnType' => 1],
                ];

                // Object build.
                $objUsersLogin = new \SyncSystemNS\ObjectUsersListing($arrUsersLoginParameters);
                $resultsUsersListing = $objUsersLogin->recordsListingGet(0, 1);
                //$resultsUsersListing = (array) json_decode($objUsersLogin->recordsListingGet(0, 3), true);
                //$resultsUsersListing = json_decode(json_encode($objUsersLogin->recordsListingGet(0, 3)), true); // working

                // Loop through results.
                if ($resultsUsersListing['returnStatus'] === true) {
                    unset($resultsUsersListing['returnStatus']);
                    // $arrReturn['debug']['resultsUsersListing'] = $resultsUsersListing;
                    for ($countArray = 0; count($resultsUsersListing) > $countArray; $countArray++) {
                        // $registerVerification = true;
                        $usersVerification = true;

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
                        // TODO: adapt function to differentiate between info encryption and password encryption.
                        $tblUsersPasswordHint = '';
                        $tblUsersPasswordLength = '';
                        // $arrReturn['debug']['tblUsersPassword'] = $tblUsersPassword;
                        // $arrReturn['debug']['tblUsersPasswordDecrypt'] = $tblUsersPasswordDecrypt;
                        // $arrReturn['debug']['password'] = $password;

                        // Verification method (SS_ENCRYPT_METHOD_DATA).
                        // TODO: Include other verification methods (hash).
                        if ($tblUsersPasswordDecrypt === $password && $tblUsersPasswordDecrypt !== '') {
                            $loginVerification = true;

                            // Check activation.
                            if ($resultsUsersListing[$countArray]['activation'] === 1) {
                                $loginActivation = true;
                            }

                            $tblUsersID = $resultsUsersListing[$countArray]['id'];
                            $tblUsersIDCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $tblUsersID, 'db_write_text'), SS_ENCRYPT_METHOD_DATA);
                            $tblUsersUsername = '';
                            $tblUsersEmail = '';
                            $tblUsersPassword = $resultsUsersListing[$countArray]['password'];
                            $tblUsersPasswordHint = '';
                            $tblUsersPasswordLength = '';
                            // $arrReturn['debug']['tblUsersID'] = $tblUsersID;

                            // Parameters build.
                            $arrRecordSearchParameters = ['id;' . $tblUsersID . ';i'];
                            $oudRecordParameters = [
                                '_arrSearchParameters' => $arrRecordSearchParameters,
                                '_idTbUsers' => $tblUsersID,
                                '_terminal' => $this->terminal,
                                '_arrSpecialParameters' => ['returnType' => 1],
                            ];

                            if (config('app.gSystemConfig.configUsersAuthenticationType') === SS_AUTHENTICATION_TYPE_SANCTUM) {
                                // Object method.
                                //$oudRecord = new \SyncSystemNS\ObjectUsersDetails($oudRecordParameters);
                                // $arrReturn['debug']['users_recordDetailsGet'] = $oudRecord->recordDetailsGet(0, 1);

                                // Model method (Sanctum).
                                $oudRecord = new UsersDetails($oudRecordParameters);
                                $oudRecordData = $oudRecord->cphBodyBuild();
                                $arrReturn['debug']['oudRecord'] = $oudRecord;

                                $oudRecord->tokens()->where('tokenable_id', $tblUsersID)->where('name', $verificationType)->delete(); // Delete all previous tokens.
                                $oudRecordToken = $oudRecord->createToken($verificationType)->plainTextToken; // table: personal_access_tokens
                                $arrReturn['loginToken'] = $oudRecordToken; // TODO: evaluate cryptography for passing the token via API.
                            }

                            // Login type.
                            // TODO: develop for register login.
                            $arrReturn['loginType'] = [];

                            // Debug.
                            // $arrReturn['debug']['users_recordDetailsGet'] = $oudRecord->cphBodyBuild();
                            // $arrReturn['debug']['users_token'] = $oudRecordToken;
                        }


                        // Debug.
                        // console.log('tblUsersID=', tblUsersID);
                        // console.log('tblUsersIDCrypt=', tblUsersIDCrypt);
                        // console.log('tblUsersPasswordDecrypt=', tblUsersPasswordDecrypt);
                        // console.log('objUsersLogin.resultsUsersListing[countArray].password=', objUsersLogin.resultsUsersListing[countArray].password);
                    }

                    // Build return data.
                    $arrReturn['registerVerification'] = $registerVerification; // TODO: maybe, this would be the sanctum verification
                    $arrReturn['loginVerification'] = $loginVerification;
                    $arrReturn['loginActivation'] = $loginActivation;
                    // TODO: review this - register / user / etc.
                    if (config('app.gSystemConfig.configRegistersAuthenticationType') === SS_AUTHENTICATION_TYPE_CUSTOM) {
                        // $arrReturn['tblRegistersIDCrypt'] = $tblUsersIDCrypt; // TODO: Change to tblIDCrypt // May not need, as the sanctum token is linked to an ID
                        $arrReturn['tblIDCrypt'] = $tblUsersIDCrypt; // May not need, as the sanctum token is linked to an ID
                    }
                        // TODO: maybe, the sanctum token authentication can be a salt and grabbed at the other end
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
            // ----------------------

            // User - Root.
            // ----------------------
            if ($verificationType === 'user_root') {
                $arrReturn['returnStatus'] = true;

                // Parameters build.
                array_push($arrSearchParameters, 'username;' . $username . ';s');
                // TODO: condition based on the config file.
                // array_push($arrSearchParameters, 'id;12;i'); // exclude user - root (backend PHP Laravel - Data - MCrypt PHP)
                array_push($arrSearchParameters, 'id;14;i'); // exclude user - root (backend PHP Laravel - Data - Defuse php-encryption)
                array_push($arrSearchParameters, 'activation;1;i');

                $arrUsersLoginParameters = [
                    '_arrSearchParameters' => $arrSearchParameters,
                    '_configSortOrder' => config('app.gSystemConfig.configUsersSort'),
                    '_strNRecords' => '',
                    '_arrSpecialParameters' => ['returnType' => 1],
                ];

                // Object build.
                $objUsersLogin = new \SyncSystemNS\ObjectUsersListing($arrUsersLoginParameters);
                $resultsUsersListing = $objUsersLogin->recordsListingGet(0, 1);

                // Loop through results.
                if ($resultsUsersListing['returnStatus'] === true) {
                    unset($resultsUsersListing['returnStatus']);
                    for ($countArray = 0; count($resultsUsersListing) > $countArray; $countArray++) {
                        // $registerVerification = true;
                        $usersVerification = true;

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
                        // TODO: adapt function to differentiate between info encryption and password encryption.
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
                            $tblUsersIDCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $tblUsersID, 'db_write_text'), SS_ENCRYPT_METHOD_DATA);
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

                            if (config('app.gSystemConfig.configUsersAuthenticationType') === SS_AUTHENTICATION_TYPE_SANCTUM) {
                                // Object method.
                                //$oudRecord = new \SyncSystemNS\ObjectUsersDetails($oudRecordParameters);
                                //$arrReturn['debug']['users_recordDetailsGet'] = $oudRecord->recordDetailsGet(0, 1);

                                // Model method (Sanctum).
                                $oudRecord = new UsersDetails($oudRecordParameters);
                                $oudRecordData = $oudRecord->cphBodyBuild();

                                $oudRecord->tokens()->where('tokenable_id', $tblUsersID)->where('name', $verificationType)->delete(); // Delete all previous tokens.
                                $oudRecordToken = $oudRecord->createToken($verificationType)->plainTextToken; // table: personal_access_tokens
                                $arrReturn['loginToken'] = $oudRecordToken; // TODO: evaluate cryptography for passing the token via API.
                            }

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
                    $arrReturn['registerVerification'] = $registerVerification; // TODO: maybe, this would be the sanctum verification
                    $arrReturn['loginVerification'] = $loginVerification;
                    $arrReturn['loginActivation'] = $loginActivation;
                    // TODO: review this - register / user / etc.
                    if (config('app.gSystemConfig.configRegistersAuthenticationType') === SS_AUTHENTICATION_TYPE_CUSTOM) {
                        // $arrReturn['tblRegistersIDCrypt'] = $tblUsersIDCrypt; // TODO: Change to tblIDCrypt // May not need, as the sanctum token is linked to an ID
                        $arrReturn['tblIDCrypt'] = $tblUsersIDCrypt; // May not need, as the sanctum token is linked to an ID
                    }
                        // TODO: maybe, the sanctum token authentication can be a salt and grabbed at the other end
                    //$arrReturn['loginType'] = [];
                }
            }
            // ----------------------
        } catch (\Exception $apiAuthenticationCheckError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('apiAuthenticationCheckError: ' . $apiAuthenticationCheckError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************

    // Delete authentication data.
    // **************************************************************************************
    /**
     * Delete authentication data.
     * @param Request $req
     * @return array
     */
    public function authenticationDelete(Request $req): array
    {
        // Variables.
        // ----------------------
        $arrReturn = [
            'returnStatus' => false,
        ];

        $tblUsersID = null;
        $tblUsersIDCrypt = null;

        $actionType = null;
        $verificationType = null;
        $authenticationDeleteResult = null;
        // ----------------------

        // Define values.
        // ----------------------
        $tblUsersIDCrypt = $req->post('idTbUsersLoggedCrypt');
        $idTbUsersRootLoggedCrypt = $req->post('idTbUsersRootLoggedCrypt');

        $actionType = $req->post('actionType');
        $verificationType = $req->post('verificationType');
        // ----------------------

        // Logic.
        try {
            // User - Admin
            // ----------------------
            if ($verificationType === config('app.gSystemConfig.configCookiePrefixUserAdmin')) {
                $tblUsersID = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($tblUsersIDCrypt, 'db'), SS_ENCRYPT_METHOD_DATA);

                // Parameters build.
                $arrRecordSearchParameters = ['id;' . $tblUsersID . ';i'];
                $oudRecordParameters = [
                    '_arrSearchParameters' => $arrRecordSearchParameters,
                    '_idTbUsers' => $tblUsersID,
                    '_terminal' => $this->terminal,
                    '_arrSpecialParameters' => ['returnType' => 1],
                ];

                // Model method (Sanctum).
                $oudRecord = new UsersDetails($oudRecordParameters);
                $oudRecordData = $oudRecord->cphBodyBuild();
                $authenticationDeleteResult = $oudRecord->tokens()->where('tokenable_id', $tblUsersID)->where('name', $verificationType)->delete();

                if ($authenticationDeleteResult > 0) {
                    $arrReturn['returnStatus'] = true;
                }
            }

            if ($verificationType === config('app.gSystemConfig.configCookiePrefixUserRoot')) {
                $tblUsersID = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($idTbUsersRootLoggedCrypt, 'db'), SS_ENCRYPT_METHOD_DATA);

                // Parameters build.
                $arrRecordSearchParameters = ['id;' . $tblUsersID . ';i'];
                $oudRecordParameters = [
                    '_arrSearchParameters' => $arrRecordSearchParameters,
                    '_idTbUsers' => $tblUsersID,
                    '_terminal' => $this->terminal,
                    '_arrSpecialParameters' => ['returnType' => 1],
                ];

                // Model method (Sanctum).
                $oudRecord = new UsersDetails($oudRecordParameters);
                $oudRecordData = $oudRecord->cphBodyBuild();
                $authenticationDeleteResult = $oudRecord->tokens()->where('tokenable_id', $tblUsersID)->where('name', $verificationType)->delete();

                if ($authenticationDeleteResult > 0) {
                    $arrReturn['returnStatus'] = true;
                }
            }

            // Debug.
            // $arrReturn['debug']['authenticationDeleteResult'] = $authenticationDeleteResult;
            // $arrReturn['debug']['tblUsersID'] = $tblUsersID;
            // $arrReturn['debug']['tblUsersIDCrypt'] = $tblUsersIDCrypt;
            // $arrReturn['debug']['actionType'] = $actionType;
            // $arrReturn['debug']['verificationType'] = $verificationType;
        } catch (\Exception $authenticationDeleteError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('authenticationDeleteError: ' . $authenticationDeleteError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
