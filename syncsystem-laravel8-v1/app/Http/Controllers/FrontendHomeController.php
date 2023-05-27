<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendHomeController extends Controller
{
    // Properties.
    // ----------------------
    protected string|null $masterPageFrontendSelect = 'layout-admin-iframe';
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
    public function __construct(Request $req)
    {
        //parent::__construct();
        $this->build($req);
    }
    // **************************************************************************************

    // Admin login.
    // **************************************************************************************
    /**
     * Admin login.
     * @return void
     */
    private function build(Request $req): void
    {
        // Logic.
        try {
            // Title - content place holder.
            $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, 'frontendHomeTitleMain');

            // Title - current - content place holder.
            $this->templateData['cphTitleCurrent'] = '';

            // Body - content place holder.
            $this->templateData['cphBody'] = '';
        } catch (\Exception $frontendHomeError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('frontendHomeError: ' . $frontendHomeError->getMessage());
            }
        } finally {
            //
        }
    }
    // **************************************************************************************

    // Home.
    // **************************************************************************************
    /**
     * Home.
     * @return View
     */
    public function render(Request $req): View
    {
        return view('frontend.home')->with('templateData', $this->templateData);
    }
    // **************************************************************************************
}
