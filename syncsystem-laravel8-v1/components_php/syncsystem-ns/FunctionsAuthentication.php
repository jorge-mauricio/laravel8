<?php
namespace SyncSystemNS;

use Illuminate\Support\Facades\DB;

class FunctionsAuthentication
{
    // Function to verify authentication.
    // **************************************************************************************
    /**
     * Function to verify authentication.
     * @static
     * @param string $strData
     * @param string $verificationType user_root | user_backend | user_frontend
     * @param string $_returnURL
     * @param array $arrSearchParameters
     * @return array|null
     * @example
     * \SyncSystemNS\FunctionsAuthentication::authenticationVerification() 
     */
    static function authenticationVerification(
        string $strData, 
        string $verificationType, 
        string $_returnURL = '', 
        ?array $specialParameters = null
    )
    {
        // Variables.
        // ----------------------
        $arrReturn = ['statusReturn' => false];
        $strDataDecrypt = '';
        $returnURL = '';

        $arrSearchParametersUsersDetailsAuthentication = [];
        $arrUsersDetailsAuthentication = null;
        $arrUsersDetailsAuthenticationParameters = null;

        $resultUsersDetailsAuthentication = null;
        // ----------------------

        if ($strData) {
            // user_root.
            // ----------------------
            if ($verificationType === 'user_root') {
                // Define values.
                if ($_returnURL) {
                    $returnURL = $_returnURL;
                } else {
                    // Default return URL.
                    $returnURL = '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendUsers'] . '/';
                }

                $strDataDecrypt = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($strData, 'db'), 2);
                // strDataDecrypt = '12'; // debug

                // Logic.
                // TODO: Make this part optional by configuration (real time check).

                // Parameters build.
                push($arrSearchParametersUsersDetailsAuthentication, 'id;' . $strDataDecrypt . ';i');
                push($arrSearchParametersUsersDetailsAuthentication, 'activation;1;i');

                $resultUsersDetailsAuthentication = \SyncSystemNS\FunctionsDB::genericTableGet02(
                    $GLOBALS['configSystemDBTableUsers'],
                    $arrSearchParametersUsersDetailsAuthentication,
                    '',
                    '',
                    'id, username, password, activation',
                    1
                );

                if (count($resultUsersDetailsAuthentication) > 0) {
                    // Root user found.
                    $arrReturn['statusReturn'] = true;
                } else {
                    // Not found / not activated.

                    // Redirect.
                    header('Location: ' . $returnURL);
                }

                // Debug.
                $arrReturn['debug'] = $strData; // TODO: comment out.
                // console.log("strDataDecrypt=", strDataDecrypt);
                // console.log("objUsersDetailsAuthentication=", objUsersDetailsAuthentication);
                // console.log("resultUsersDetailsAuthentication=", resultUsersDetailsAuthentication);
                // console.log("resultUsersDetailsAuthentication.length=", resultUsersDetailsAuthentication.length);
                // console.log("globalCookies (inside function)=", globalCookies);
            }
            // ----------------------
        }

        return $arrReturn;        
    }
    // **************************************************************************************
}
