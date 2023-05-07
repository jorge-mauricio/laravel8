<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminDashboardController extends AdminBaseController
{
    // Properties.
    // ----------------------
    private array $templateData;
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

    // Admin dashboard.
    // **************************************************************************************
    /**
     * Admin dashboard.
     * @return View
     */
    public function adminDashboard(Request $req): View
    {
        // Variables.
        // ----------------------
        $idTbUsersLogged = null;

        $arrUsersLoggedDetailsJson = null;
        $arrUsersLoggedDetails = null;

        $apiURLUsersLoggedDetailsCurrent = null;
        $apiUsersLoggedDetailsCurrentResponse = null;
        // ----------------------

        // Value definition.
        // ----------------------
        // $idTbUsersLogged = (float) \SyncSystemNS\FunctionsCrypto::decryptValue(
        //                         \SyncSystemNS\FunctionsGeneric::contentMaskRead(
        //                             \SyncSystemNS\FunctionsCookies::cookieRead(
        //                                 $GLOBALS['configCookiePrefix'] . '_' . $GLOBALS['configCookiePrefixUserAdmin']
        //                             ),
        //                             'cookie'
        //                         ),
        //                         SS_ENCRYPT_METHOD_DATA
        //                     );
        $idTbUsersLogged = $this->idTbUsersLogged; // AdminBaseController
            // Substitute with function (cookie / auth)
        // ----------------------

        // Logic.
        try {
            // Call user details API.
            $apiUsersLoggedDetailsCurrentResponse = Http::withOptions(['verify' => false])
                ->get(
                    env('CONFIG_API_URL') . '/' . config('app.gSystemConfig.configRouteAPI') . '/' . config('app.gSystemConfig.configRouteAPIUsers') . '/' . config('app.gSystemConfig.configRouteAPIDetails') . '/' . $idTbUsersLogged . '/',
                    [
                        'apiKey' => env('CONFIG_API_KEY_SYSTEM')
                    ]
                );
            $arrUsersLoggedDetailsJson = $apiUsersLoggedDetailsCurrentResponse->json();
                // TODO: move this to the base class.

            if ($arrUsersLoggedDetailsJson['returnStatus'] === true) {
                // Title - content place holder.
                $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendDashboardTitleMain');

                // Title - current - content place holder.
                $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'backendDashboardTitleMain');

                // Body - content place holder.
                $this->templateData['cphBody']['oudRecord'] = $arrUsersLoggedDetailsJson['oudRecord'];
            }

            // Debug.
            // echo 'idTbUsersLogged=<pre>';
            // var_dump($idTbUsersLogged);
            // echo '</pre><br />';

            // echo 'arrUsersLoggedDetailsJson=<pre>';
            // var_dump($arrUsersLoggedDetailsJson);
            // echo '</pre><br />';
        } catch (\Exception $adminDashboardError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('adminDashboardError: ' . $adminDashboardError->getMessage());
            }
        } finally {
            //
        }

        return view('admin.dashboard')->with('templateData', $this->templateData);
    }
    // **************************************************************************************
}
