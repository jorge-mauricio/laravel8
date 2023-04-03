<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Sanctum\PersonalAccessToken;

class AdminLoginController extends AdminBaseController
{
    // Properties.
    // ----------------------
    protected string|null $masterPageSelect = 'layout-admin-iframe';
    private string|null $returnURL = null;

    private array $cookiesData;
    private array $templateData;

    private string|null $messageSuccess = '';
    private string|null $messageError = '';
    private string|null $messageAlert = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    // **************************************************************************************

    // Admin login.
    // **************************************************************************************
    /**
     * Admin login.
     * @return View
     */
    public function adminLogin(Request $req): View
    {
        // Logic.
        try {
            // Title - content place holder.
            $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendLoginTitleMain');

            // Title - current - content place holder.
            $this->templateData['cphTitleCurrent'] = '';
            
            // Body - content place holder.
            $this->templateData['cphBody'] = '';
        } catch(Exception $adminLoginError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminLoginError: ' . $adminLoginError->message());
            }
        } finally {
            //
        }

        return view('admin.login')->with('templateData', $this->templateData);
    }
    // **************************************************************************************

    // Admin login post data and check credentials.
    // **************************************************************************************
    /**
     * Admin login post data and check credentials.
     * @param Request $req
     * @param Response $req
     * @return RedirectResponse
     */
    public function adminLoginCheck(Request $req, Response $res): RedirectResponse | Response
    {
        // Variables.
        // ----------------------
        $returnURL = '/' . $GLOBALS['configRouteBackend'] . '/';
        $apiAuthenticationCheckResponse = null;
        $arrAuthenticationCheckJson = null;

        $loginToken = '';
        $sanctumToken = null;

        $objUsersLogin = null;
        $tblUsersID = null;
        $tblUsersIDCrypt = null;
        // ----------------------

        // Logic.
        try {
            // API call.
            $apiAuthenticationCheckResponse = Http::withOptions(['verify' => false])
                ->post(
                    env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPIAuthentication'] . '/', 
                    array_merge(
                        [
                            'verificationType' => 'user_admin', // Changed from user_backend
                            'apiKey' => env('CONFIG_API_KEY_SYSTEM'),
                        ], 
                        $req->all()
                    )
            );
            $arrAuthenticationCheckJson = $apiAuthenticationCheckResponse->json();

            // TODO: Use FunctionsAuthentication to store id crypt cookie, token, etc.
            if ($arrAuthenticationCheckJson['returnStatus'] === true && $arrAuthenticationCheckJson['loginVerification'] === true) {
                $returnURL .= $GLOBALS['configRouteBackendDashboard'] . '/';

                if ($GLOBALS['configUsersAuthenticationType'] === 11) {
                    $loginToken = $arrAuthenticationCheckJson['loginToken'];
                    // Store token in session.
                    // TODO: evaluate cookie / cache (redis).
                    //Session::set('user_admin_login_token', $loginToken);
                    session(
                        [
                            $GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin'] . '_login_token' => $loginToken
                        ]
                    );
                    session()->save();

                    // Get id from token.
                    // TODO: evaluate moving to a function and grabbing the ID from it.
                    $sanctumToken = PersonalAccessToken::findToken($loginToken);
                    if ($sanctumToken) {
                        $objUsersLogin = $sanctumToken->tokenable;
                        $objUsersLoginData = json_decode($objUsersLogin, true);
                        $tblUsersID = (float) $objUsersLoginData['id'];
                        $tblUsersIDCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $tblUsersID, 'db_write_text'), SS_ENCRYPT_METHOD_DATA);
                    }
                }

                // Store encrypted user ID.
                if ($GLOBALS['configUsersAuthenticationStore'] === 1) {
                    \SyncSystemNS\FunctionsCookies::cookieCreate($GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin'], $tblUsersIDCrypt);
                }
            } else {
                $returnURL .= '?username=' . $req->post('username');
                // TODO: verify why it´s returning http://localhost:8000/system?username= (without slash)
            }


            // Get current Sanctum auth
            //Auth::user()->currentAccessToken();

            // Revoke access token.
            //Auth::user()->currentAccessToken()->delete();

            // Debug.
            //echo 'apiAuthenticationCheckResponse=<pre>';
            //var_dump($apiAuthenticationCheckResponse);
            //echo '</pre><br />';

            // echo 'arrAuthenticationCheckJson=<pre>';
            // var_dump($arrAuthenticationCheckJson);
            // echo '</pre><br />';

            // echo 'objUsersLogin=<pre>';
            // var_dump($objUsersLogin);
            // echo '</pre><br />';

            // echo 'objUsersLoginData=<pre>';
            // var_dump($objUsersLoginData);
            // echo '</pre><br />';

            // echo 'tblUsersID=<pre>';
            // var_dump($tblUsersID);
            // echo '</pre><br />';

            // echo 'tblUsersIDCrypt=<pre>';
            // var_dump($tblUsersIDCrypt);
            // echo '</pre><br />';

            // echo 'cookieRead=<pre>';
            // var_dump(\SyncSystemNS\FunctionsCookies::cookieRead($GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserRoot']));
            // echo '</pre><br />';

            // echo 'decryptValue=<pre>';
            // var_dump(
            //     \SyncSystemNS\FunctionsCrypto::decryptValue(
            //         \SyncSystemNS\FunctionsGeneric::contentMaskRead(
            //             \SyncSystemNS\FunctionsCookies::cookieRead(
            //                 $GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin']
            //             ), 
            //             'cookie'
            //         ), 
            //         SS_ENCRYPT_METHOD_DATA
            //     )
            // ); // successful
            // echo '</pre><br />';
            // exit();

        } catch (Error $adminLoginCheckError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminLoginCheckError: ' . $adminLoginCheckError->message());
            }
        } finally {
            //
        }

        // Redirect.
        // TODO: eveluate loading views or moving to the route function (and load the views).
        //if ($arrAuthenticationCheckJson['returnStatus'] === true) {
        if (
            $arrAuthenticationCheckJson['returnStatus'] === true && 
            $arrAuthenticationCheckJson['loginVerification'] === true && 
            $arrAuthenticationCheckJson['loginActivation'] === true
        ) {
            
            // echo 'redirect dashboard=true';
            // echo 'user_admin_login_token=' . Session::get('user_admin_login_token');
            // echo 'user_admin_login_token=' . session('user_admin_login_token');

            // exit();

            return redirect($returnURL)
                //->header('Authorization', 'Bearer ' . $loginToken)
                //->header('Accept', 'application/json')
                //->header('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7')
                ->with('messageSuccess', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin10'));
                //->header('Accept', 'application/json,text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7');
                
            /*, 200, [
                'Authorization' => 'Bearer ' . $loginToken,
                'Accept' => 'application/json',
            ]*/
            // TODO: header secure option.

            // $contents = View::make('embedded')->with('messageSuccess', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin10'));
            // $response = Response::make($contents, $statusCode);
            // $response->header('Authorization', 'Bearer ' . $loginToken);
            // return $response;


            // return response()
            //     ->view('admin.dashboard', [
            //         'messageSuccess' => \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin10')
            //         ])
            //     ->header('Authorization', 'Bearer ' . $loginToken)
            //     ->header('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7');

        } else {
            return redirect($returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin2e'));
            // TODO: Other error messages (connection, password, activation, etc).
        }
        
    }
    // **************************************************************************************

    // Admin logoff (delete cookies / sessions / tokens).
    // **************************************************************************************
    /**
     * Admin logoff (delete cookies / sessions / tokens).
     * @param Request $req
     * @param Response $req
     * @return RedirectResponse
     */
    public function adminLogoff(Request $req, Response $res): RedirectResponse | Response
    {
        // Variables.
        // ----------------------
        $returnURL = '/' . $GLOBALS['configRouteBackend'] . '/';
        $apiAuthenticationDeleteResponse = null;
        $arrAuthenticationDeleteJson = null;

        $idTbUsersLogged = null;
        $idTbUsersLoggedCrypt = null;
        // ----------------------
        
        // Logic.
        try {
            // Define values.
            // TODO: check which variable contains data to redirect to the right page (user / root).
            $idTbUsersLogged = $this->idTbUsersLogged;
            $idTbUsersLoggedCrypt = \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($idTbUsersLogged, 'db_write_text'), SS_ENCRYPT_METHOD_DATA);
                // TODO: encrypt

            // API call.
            // TODO: evaluate getting token data from header
            $apiAuthenticationDeleteResponse = Http::withOptions(['verify' => false])
                ->delete(
                    env('CONFIG_API_URL') . '/' . $GLOBALS['configRouteAPI'] . '/' . $GLOBALS['configRouteAPIAuthentication'] . '/', 
                    array_merge(
                        [
                            // 'idTbUsers' => $idTbUsersLogged,
                            'idTbUsersLoggedCrypt' => $idTbUsersLoggedCrypt,
                            'verificationType' => 'user_admin', // Changed from user_backend
                            'apiKey' => env('CONFIG_API_KEY_SYSTEM'),
                        ], 
                        $req->all()
                    )
            );
            $arrAuthenticationDeleteJson = $apiAuthenticationDeleteResponse->json();

            if ($arrAuthenticationDeleteJson['returnStatus'] === true) {
                // Delete cookies / sessions.
                if ($GLOBALS['configUsersAuthenticationStore'] === 1) {
                    \SyncSystemNS\FunctionsCookies::cookieDelete($GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin']);
                }
            } else {
                $returnURL .= $GLOBALS['configRouteBackendDashboard'] . '/';
            }

            // Debug.
            // echo 'arrAuthenticationDeleteJson=<pre>';
            // var_dump($arrAuthenticationDeleteJson);
            // echo '</pre><br />';

            // echo '_COOKIE=<pre>';
            // var_dump($_COOKIE);
            // echo '</pre><br />';
            // exit();
        } catch (Error $adminLogoffError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminLogoffError: ' . $adminLogoffError->message());
            }
        } finally {
            //
        }

        // Redirect.
        if ($arrAuthenticationDeleteJson['returnStatus'] === true) {
            return redirect($returnURL)
                ->with('messageSuccess', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin2'));
        } else {
            return redirect($returnURL)
                ->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageAPI1e'));
        }
    }
    // **************************************************************************************
}
