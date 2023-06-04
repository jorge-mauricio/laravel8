<?php

declare(strict_types=1);

namespace SyncSystemNS;

class ObjectUsersListing
{
    // Properties.
    // ----------------------
    private array|null $arrSearchParameters = [];
    private string $configSortOrder = '';
    private string $strNRecords = '';
    private array|null $arrSpecialParameters = null;

    private array|null $resultsUsersListing = null;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor (TODO: update if object extends a base object).
     * @param array|null $arrParameters
     */
    public function __construct(array|null $arrParameters = null)
    {
        // TODO: create a base object and extend the construct.
        // Define values.
        // ----------------------
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) ? $arrParameters['_arrSearchParameters'] : [];
        $this->configSortOrder = array_key_exists('_configSortOrder', $arrParameters) ? $arrParameters['_configSortOrder'] : config('app.gSystemConfig.configCategoriesSort');
        $this->strNRecords = array_key_exists('_strNRecords', $arrParameters) ? $arrParameters['_strNRecords'] : '';
        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) ? $arrParameters['_arrSpecialParameters'] : [];
        // ----------------------
    }
    // **************************************************************************************

    // Get users listing according to search parameters.
    // **************************************************************************************
    /**
     * Get users listing according to search parameters.
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
            $this->resultsUsersListing = \SyncSystemNS\FunctionsDB::genericTableGet02(
                config('app.gSystemConfig.configSystemDBTableUsers'),
                $this->arrSearchParameters,
                $this->configSortOrder,
                $this->strNRecords,
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableUsers'), 'all', 'string'),
                1,
                $this->arrSpecialParameters
            );

            if ($this->resultsUsersListing['returnStatus'] === true) {
                $arrReturn = array_merge(['returnStatus' => true], $this->resultsUsersListing);
            }

            // Debug.
            //echo 'resultsUsersListing(inside recordsListingGet)=<pre>';
            //var_dump($this->resultsUsersListing);
            //echo '</pre><br />';
        } catch (\Exception $recordsListingGetError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('recordsListingGetError: ' . $recordsListingGetError->getMessage());
            }
        } finally {
            //
        }

        //return $arrReturn;
        return json_decode(json_encode($arrReturn), true);
    }
    // **************************************************************************************
}
