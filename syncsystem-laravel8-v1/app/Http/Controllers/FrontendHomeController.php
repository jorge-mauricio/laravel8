<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendHomeController extends FrontendBaseController
{
    // Properties.
    // ----------------------
    //protected string|null $masterPageFrontendSelect = 'layout-frontend-main';

    private array $templateData;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     */
    public function __construct(Request $req)
    {
        parent::__construct();
        $this->build($req);
    }
    // **************************************************************************************

    // Frontend home.
    // **************************************************************************************
    /**
     * Frontend home.
     * @return void
     */
    private function build(Request $req): void
    {
        // Logic.
        try {
            // Title - content place holder.
            $this->templateData['cphTitle'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'frontendHomeTitleMain');

            // Title - current - content place holder.
            $this->templateData['cphTitleCurrent'] = \SyncSystemNS\FunctionsGeneric::contentMaskRead(config('app.gSystemConfig.configSystemClientName'), 'config-application') . ' - ' . \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageFrontend')->appLabels, 'frontendHomeTitleMain');

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

    // Render view.
    // **************************************************************************************
    /**
     * Render view.
     * @return View
     */
    public function render(Request $req): View
    {
        return view('frontend.home')->with('templateData', $this->templateData);
    }
    // **************************************************************************************
}
