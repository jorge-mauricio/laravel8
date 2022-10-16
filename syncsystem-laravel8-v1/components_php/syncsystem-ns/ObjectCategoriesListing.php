<?php
namespace SyncSystemNS;

class ObjectCategoriesListing
{
    // Properties.
    // ----------------------
    private array|null $arrSearchParameters = [];
    private string $configSortOrder = '';
    private string $strNRecords = '';
    private array|null $arrSpecialParameters = null;

    private array|null $resultsCategoriesListing = null;
    //private mixed $resultsCategoriesListing = null;
    // ----------------------
    
    // Constructor.
    // **************************************************************************************
    public function __construct(array|null $arrParameters = null)
    {
        // Define values.
        // ----------------------
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) ? $arrParameters['_arrSearchParameters'] : [];
        $this->configSortOrder = array_key_exists('_configSortOrder', $arrParameters) ? $arrParameters['_configSortOrder'] : $GLOBALS['configCategoriesSort'];
        $this->strNRecords = array_key_exists('_strNRecords', $arrParameters) ? $arrParameters['_strNRecords'] : '';
        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) ? $arrParameters['_arrSpecialParameters'] : [];
        // ----------------------

        // Debug.
        /*
        echo 'Testing arquitecture (ObjectCategoriesListing)' . '<br />';
        echo 'configSystemClientName=' . $GLOBALS['configSystemClientName'] . '<br />';

        echo 'arrParameters=<pre>';
        var_dump($arrParameters);
        echo '</pre><br />';
        
        echo 'arrSearchParameters=<pre>';
        var_dump($this->arrSearchParameters);
        echo '</pre><br />';

        echo 'configSortOrder=<pre>';
        var_dump($this->configSortOrder);
        echo '</pre><br />';

        echo 'strNRecords=<pre>';
        var_dump($this->strNRecords);
        echo '</pre><br />';

        echo 'arrSpecialParameters=<pre>';
        var_dump($this->arrSpecialParameters);
        echo '</pre><br />';

        echo 'resultsCategoriesListing=<pre>';
        var_dump($this->resultsCategoriesListing);
        echo '</pre><br />';
        */
    }
    // **************************************************************************************

    // Get categories listing according to search parameters.
    // **************************************************************************************
    /**
     * Get categories listing according to search parameters.
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
            $this->resultsCategoriesListing = \SyncSystemNS\FunctionsDB::genericTableGet02(
                $GLOBALS['configSystemDBTableCategories'],
                $this->arrSearchParameters,
                $this->configSortOrder,
                $this->strNRecords,
                // FunctionsGeneric.tableFieldsQueryBuild01("categories", "all", "string"),
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01($GLOBALS['configSystemDBTableCategories'], 'all', 'string'),
                // 'id,title,description', // debug
                1,
                $this->arrSpecialParameters
            );

            if ($this->resultsCategoriesListing['returnStatus'] === true) {
                // $arrReturn = ['returnStatus' => true, ...$this->resultsCategoriesListing]; // error - research
                $arrReturn = array_merge(['returnStatus' => true], $this->resultsCategoriesListing);
            }

            // Debug.
            //echo 'resultsCategoriesListing(inside recordsListingGet)=<pre>';
            //var_dump($this->resultsCategoriesListing);
            //echo '</pre><br />';

            //return $this->resultsCategoriesListing;
            return $arrReturn;
        } catch (Error $recordsListingGetError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('recordsListingGetError: ' . $recordsListingGetError->message());
            }
        } finally {

        }
    }
    // **************************************************************************************
}