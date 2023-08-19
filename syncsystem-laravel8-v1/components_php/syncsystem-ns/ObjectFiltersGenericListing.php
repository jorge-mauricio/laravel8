<?php

declare(strict_types=1);

namespace SyncSystemNS;

class ObjectFiltersGenericListing
{
    // Properties.
    // ----------------------
    private array|null $arrSearchParameters = [];
    private string $configSortOrder = '';
    // private string $strNRecords = '';
    private array|null $arrSpecialParameters = null;

    private array|null $resultsFiltersGenericListing = null;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param array|null $arrParameters
     */
    public function __construct(array|null $arrParameters = null)
    {
        // Define values.
        // ----------------------
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) ? $arrParameters['_arrSearchParameters'] : [];
        $this->configSortOrder = array_key_exists('_configSortOrder', $arrParameters) ? $arrParameters['_configSortOrder'] : config('app.gSystemConfig.configFiltersGenericSort');
        // $this->strNRecords = array_key_exists('_strNRecords', $arrParameters) ? $arrParameters['_strNRecords'] : '';
        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) ? $arrParameters['_arrSpecialParameters'] : [];
        // ----------------------
    }
    // **************************************************************************************

    // Get filters generic listing according to search parameters.
    // **************************************************************************************
    /**
     * Get filters generic listing according to search parameters.
     * @param float $terminal 0 - backend | 1 - frontend
     * @param float $returnType 1 - array | 3 - Json Object | 10 - html
     * @return array
     */
    public function recordsListingGet(float $terminal = 0, float $returnType = 1): array|null
    {
        // terminal: 0 - backend | 1 - frontend
        // returnType: 1 - array | 3 - Json Object | 10 - html

        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];
        // ----------------------

        // Logic.
        try {
            $this->resultsFiltersGenericListing = \SyncSystemNS\FunctionsDB::genericTableGet02(
                config('app.gSystemConfig.configSystemDBTableFiltersGeneric'),
                $this->arrSearchParameters,
                $this->configSortOrder,
                '',
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableFiltersGeneric'), 'all', 'string'),
                1,
                $this->arrSpecialParameters
            );

            if ($this->resultsFiltersGenericListing['returnStatus'] === true) {
                $arrReturn = array_merge(['returnStatus' => true], $this->resultsFiltersGenericListing);
            }

            // Debug.
            //echo 'resultsFiltersGenericListing(inside recordsListingGet)=<pre>';
            //var_dump($this->resultsFiltersGenericListing);
            //echo '</pre><br />';

            // echo 'configSystemDBTableFiltersGeneric (inside recordsListingGet)=<pre>';
            // var_dump(\SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableFiltersGeneric'), 'all', 'string'));
            // echo '</pre><br />';

            // echo 'enableFiltersGenericSortOrder (inside recordsListingGet)=<pre>';
            // var_dump(config('app.gSystemConfig.enableFiltersGenericSortOrder'));
            // echo '</pre><br />';

            //return $this->resultsFiltersGenericListing;
            //return $arrReturn;
        } catch (\Exception $recordsListingGetError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new \Error('recordsListingGetError: ' . $recordsListingGetError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
