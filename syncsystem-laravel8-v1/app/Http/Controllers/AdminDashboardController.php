<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends AdminBaseController
{
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
        // Logic.
        try {
            // Title - content place holder.
            $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead($GLOBALS['configSystemClientName'], 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendDashboardTitleMain');

            // Title - current - content place holder.
            $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::appLabelsGet($GLOBALS['configLanguageBackend']->appLabels, 'backendDashboardTitleMain');
            
            // Body - content place holder.
            $this->templateData['cphBody'] = '';
        } catch(Exception $adminDashboardError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('adminDashboardError: ' . $adminDashboardError->message());
            }
        } finally {
            //
        }

        return view('admin.dashboard')->with('templateData', $this->templateData);
    }
    // **************************************************************************************
}
