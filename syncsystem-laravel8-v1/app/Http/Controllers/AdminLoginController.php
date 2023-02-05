<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
     * @return RedirectResponse
     */
    public function adminLoginCheck(Request $req): RedirectResponse
    {
        // Variables.
        $returnURL = '/' . $GLOBALS['configRouteBackend'] . '/' . $GLOBALS['configRouteBackendDashboard'] . '/';

        // Logic.
        try {
            //
        } catch (Error $adminLoginEchckError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminLoginEchckError: ' . $adminLoginEchckError->message());
            }
        } finally {
            //
        }

        // Redirect.
        //if ($arrCategoriesInsertJson['returnStatus'] === true) {
            return redirect($returnURL)->with('messageSuccess', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin10'));
        //} else {
            //return redirect($returnURL)->with('messageError', \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'statusMessageLogin2e'));
                // User name
        //}
        
    }
    // **************************************************************************************
    
}
