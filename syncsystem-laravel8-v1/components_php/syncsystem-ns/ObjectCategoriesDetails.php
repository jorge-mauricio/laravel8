<?php
namespace SyncSystemNS;

class ObjectCategoriesDetails
{
    // Properties.
    // ----------------------
    private float|null $idTbCategories = null;
    private array|null $arrSearchParameters = [];

    private float $terminal = 0; // terminal: 0 - backend | 1 - frontend
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = [];

    private array|null $resultsCategoryDetails = null;

    private string $tblCategoriesID = '';
    private float $tblCategoriesIdParent = 0;
    private float $tblCategoriesSortOrder = 0;
    private float $tblCategoriesSortOrder_print = 0;
    private float $tblCategoriesCategoryType = 0; // Review: check categories insert to see if 0 is default value

    private string $tblCategoriesDateCreation = ''; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string $tblCategoriesDateTimezone = '';
    private string $tblCategoriesDateEdit = '';

    private float $tblCategoriesIdRegisterUser = 0;
    private string $tblCategoriesIdRegisterUser_print = '';
    private float $tblCategoriesIdRegister1 = 0;
    private string $tblCategoriesIdRegister1_print = '';
    private float $tblCategoriesIdRegister2 = 0;
    private string $tblCategoriesIdRegister2_print = '';
    private float $tblCategoriesIdRegister3 = 0;
    private string $tblCategoriesIdRegister3_print = '';
    private float $tblCategoriesIdRegister4 = 0;
    private string $tblCategoriesIdRegister4_print = '';
    private float $tblCategoriesIdRegister5 = 0;
    private string $tblCategoriesIdRegister5_print = '';

    private string $tblCategoriesTitle = '';
    private string $tblCategoriesDescription = '';
    private string $tblCategoriesDescription_edit = '';

    private string $tblCategoriesURLAlias = '';
    private string $tblCategoriesKeywordsTags = '';
    private string $tblCategoriesMetaDescription = '';
    private string $tblCategoriesMetaDescription_edit = '';
    private string $tblCategoriesMetaTitle = '';
    private string $tblCategoriesMetaInfo = '';

    private string $tblCategoriesInfo1 = '';
    private string $tblCategoriesInfo1_edit = '';
    private string $tblCategoriesInfo2 = '';
    private string $tblCategoriesInfo2_edit = '';
    private string $tblCategoriesInfo3 = '';
    private string $tblCategoriesInfo3_edit = '';
    private string $tblCategoriesInfo4 = '';
    private string $tblCategoriesInfo4_edit = '';
    private string $tblCategoriesInfo5 = '';
    private string $tblCategoriesInfo5_edit = '';
    private string $tblCategoriesInfo6 = '';
    private string $tblCategoriesInfo6_edit = '';
    private string $tblCategoriesInfo7 = '';
    private string $tblCategoriesInfo7_edit = '';
    private string $tblCategoriesInfo8 = '';
    private string $tblCategoriesInfo8_edit = '';
    private string $tblCategoriesInfo9 = '';
    private string $tblCategoriesInfo9_edit = '';
    private string $tblCategoriesInfo10 = '';
    private string $tblCategoriesInfo10_edit = '';

    private string $tblCategoriesInfoSmall1 = '';
    private string $tblCategoriesInfoSmall1_edit = '';
    private string $tblCategoriesInfoSmall2 = '';
    private string $tblCategoriesInfoSmall2_edit = '';
    private string $tblCategoriesInfoSmall3 = '';
    private string $tblCategoriesInfoSmall3_edit = '';
    private string $tblCategoriesInfoSmall4 = '';
    private string $tblCategoriesInfoSmall4_edit = '';
    private string $tblCategoriesInfoSmall5 = '';
    private string $tblCategoriesInfoSmall5_edit = '';

    private float $tblCategoriesNumber1 = 0;
    private string $tblCategoriesNumber1_print = '';
    private float $tblCategoriesNumber2 = 0;
    private string $tblCategoriesNumber2_print = '';
    private float $tblCategoriesNumber3 = 0;
    private string $tblCategoriesNumber3_print = '';
    private float $tblCategoriesNumber4 = 0;
    private string $tblCategoriesNumber4_print = '';
    private float $tblCategoriesNumber5 = 0;
    private string $tblCategoriesNumber5_print = '';

    private float $tblCategoriesNumberSmall1 = 0;
    private string $tblCategoriesNumberSmall1_print = '';
    private float $tblCategoriesNumberSmall2 = 0;
    private string $tblCategoriesNumberSmall2_print = '';
    private float $tblCategoriesNumberSmall3 = 0;
    private string $tblCategoriesNumberSmall3_print = '';
    private float $tblCategoriesNumberSmall4 = 0;
    private string $tblCategoriesNumberSmall4_print = '';
    private float $tblCategoriesNumberSmall5 = 0;
    private string $tblCategoriesNumberSmall5_print = '';

    private string|null $tblCategoriesDate1 = null;
    private string $tblCategoriesDate1_print = '';
    //private DateTime $tblCategoriesDate1DateObj = new DateTime();
    private string|null $tblCategoriesDate1DateYear, $tblCategoriesDate1DateDay, $tblCategoriesDate1DateMonth;
    private string|null $tblCategoriesDate1DateHour, $tblCategoriesDate1DateHour_print, $tblCategoriesDate1DateMinute, $tblCategoriesDate1DateMinute_print, $tblCategoriesDate1DateSecond, $tblCategoriesDate1DateSecond_print;

    private string|null $tblCategoriesDate2 = null;
    private string $tblCategoriesDate2_print = '';
    //private DateTime $tblCategoriesDate2DateObj = new DateTime();
    private string|null $tblCategoriesDate2DateYear, $tblCategoriesDate2DateDay, $tblCategoriesDate2DateMonth;
    private string|null $tblCategoriesDate2DateHour, $tblCategoriesDate2DateHour_print, $tblCategoriesDate2DateMinute, $tblCategoriesDate2DateMinute_print, $tblCategoriesDate2DateSecond, $tblCategoriesDate2DateSecond_print;

    private string|null $tblCategoriesDate3 = null;
    private string $tblCategoriesDate3_print = '';
    //private DateTime $tblCategoriesDate3DateObj = new DateTime();
    private string|null $tblCategoriesDate3DateYear, $tblCategoriesDate3DateDay, $tblCategoriesDate3DateMonth;
    private string|null $tblCategoriesDate3DateHour, $tblCategoriesDate3DateHour_print, $tblCategoriesDate3DateMinute, $tblCategoriesDate3DateMinute_print, $tblCategoriesDate3DateSecond, $tblCategoriesDate3DateSecond_print;

    private string|null $tblCategoriesDate4 = null;
    private string $tblCategoriesDate4_print = '';
    //private DateTime $tblCategoriesDate4DateObj = new DateTime();
    private string|null $tblCategoriesDate4DateYear, $tblCategoriesDate4DateDay, $tblCategoriesDate4DateMonth;
    private string|null $tblCategoriesDate4DateHour, $tblCategoriesDate4DateHour_print, $tblCategoriesDate4DateMinute, $tblCategoriesDate4DateMinute_print, $tblCategoriesDate4DateSecond, $tblCategoriesDate4DateSecond_print;

    private string|null $tblCategoriesDate5 = null;
    private string $tblCategoriesDate5_print = '';
    //private DateTime $tblCategoriesDate5DateObj = new DateTime();
    private string|null $tblCategoriesDate5DateYear, $tblCategoriesDate5DateDay, $tblCategoriesDate5DateMonth;
    private string|null $tblCategoriesDate5DateHour, $tblCategoriesDate5DateHour_print, $tblCategoriesDate5DateMinute, $tblCategoriesDate5DateMinute_print, $tblCategoriesDate5DateSecond, $tblCategoriesDate5DateSecond_print;

    private float $tblCategoriesIdItem1 = 0;
    private float $tblCategoriesIdItem2 = 0;
    private float $tblCategoriesIdItem3 = 0;
    private float $tblCategoriesIdItem4 = 0;
    private float $tblCategoriesIdItem5 = 0;

    private string $tblCategoriesImageMain = '';

    private string $tblCategoriesFile1 = '';
    private string $tblCategoriesFile2 = '';
    private string $tblCategoriesFile3 = '';
    private string $tblCategoriesFile4 = '';
    private string $tblCategoriesFile5 = '';

    private float $tblCategoriesActivation = 1;
    private string $tblCategoriesActivation_print = '';
    private float $tblCategoriesActivation1 = 0;
    private string $tblCategoriesActivation1_print = '';
    private float $tblCategoriesActivation2 = 0;
    private string $tblCategoriesActivation2_print = '';
    private float $tblCategoriesActivation3 = 0;
    private string $tblCategoriesActivation3_print = '';
    private float $tblCategoriesActivation4 = 0;
    private string $tblCategoriesActivation4_print = '';
    private float $tblCategoriesActivation5 = 0;
    private string $tblCategoriesActivation5_print = '';

    private float $tblCategoriesIdStatus = 0;
    private float $tblCategoriesIdStatus_print = 0;

    private float $tblCategoriesRestrictedAccess = 0;
    private string $tblCategoriesRestrictedAccess_print = '';

    private string $tblCategoriesNotes = '';
    private string $tblCategoriesNotes_edit = '';

    private string $ofglRecords;

    private array $arrIdsCategoriesFiltersGeneric1 = [];
    private array $arrIdsCategoriesFiltersGeneric2 = [];
    private array $arrIdsCategoriesFiltersGeneric3 = [];
    private array $arrIdsCategoriesFiltersGeneric4 = [];
    private array $arrIdsCategoriesFiltersGeneric5 = [];
    private array $arrIdsCategoriesFiltersGeneric6 = [];
    private array $arrIdsCategoriesFiltersGeneric7 = [];
    private array $arrIdsCategoriesFiltersGeneric8 = [];
    private array $arrIdsCategoriesFiltersGeneric9 = [];
    private array $arrIdsCategoriesFiltersGeneric10 = [];

    private array|null $arrIdsCategoriesFiltersGenericBinding;

    private array|null $arrIdsCategoriesFiltersGeneric1Binding;
    private array|null $arrIdsCategoriesFiltersGeneric2Binding;
    private array|null $arrIdsCategoriesFiltersGeneric3Binding;
    private array|null $arrIdsCategoriesFiltersGeneric4Binding;
    private array|null $arrIdsCategoriesFiltersGeneric5Binding;
    private array|null $arrIdsCategoriesFiltersGeneric6Binding;
    private array|null $arrIdsCategoriesFiltersGeneric7Binding;
    private array|null $arrIdsCategoriesFiltersGeneric8Binding;
    private array|null $arrIdsCategoriesFiltersGeneric9Binding;
    private array|null $arrIdsCategoriesFiltersGeneric10Binding;

    private array|null $arrCategoriesFiltersGeneric1Binding_print;
    private array|null $arrCategoriesFiltersGeneric2Binding_print;
    private array|null $arrCategoriesFiltersGeneric3Binding_print;
    private array|null $arrCategoriesFiltersGeneric4Binding_print;
    private array|null $arrCategoriesFiltersGeneric5Binding_print;
    private array|null $arrCategoriesFiltersGeneric6Binding_print;
    private array|null $arrCategoriesFiltersGeneric7Binding_print;
    private array|null $arrCategoriesFiltersGeneric8Binding_print;
    private array|null $arrCategoriesFiltersGeneric9Binding_print;
    private array|null $arrCategoriesFiltersGeneric10Binding_print;

    private array $arrIdsCategoriesFiltersGeneric1BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric2BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric3BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric4BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric5BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric6BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric7BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric8BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric9BindingSelect = [];
    private array $arrIdsCategoriesFiltersGeneric10BindingSelect = [];
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(array|null $arrParameters = null)
    {
        // Value definition.
        // ----------------------
        $this->idTbCategories = array_key_exists('_idTbCategories', $arrParameters) && $arrParameters['_idTbCategories'] !== null ? $arrParameters['_idTbCategories'] : $this->idTbCategories;
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) && $arrParameters['_arrSearchParameters'] !== null ? $arrParameters['_arrSearchParameters'] : $this->arrSearchParameters;

        $this->terminal = array_key_exists('_terminal', $arrParameters) && $arrParameters['_terminal'] !== null ? $arrParameters['_terminal'] : $this->terminal;
        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }

        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) && $arrParameters['_arrSpecialParameters'] !== null ? $arrParameters['_arrSpecialParameters'] : $this->arrSpecialParameters;
        // ----------------------
    
    }
    // **************************************************************************************

    // Get category details according to search parameters.
    // **************************************************************************************
    // async recordsListingGet(idParent = null, terminal = 0, returnType = 1)
    /**
     * Get categories details according to search parameters.
     * @param float terminal 0 - backend | 1 - frontend
     * @param float returnType 1 - array | 3 - Json Object | 10 - html
     * @return array
     */
    public function recordDetailsGet(float $terminal = 0, float $returnType = 1): array
    {
        // Variables.
        // ----------------------
        $arrReturn['returnStatus'] = false;
        // ----------------------

        // Logic.
        try {
            $this->resultsCategoryDetails = \SyncSystemNS\FunctionsDB::genericTableGet02(
                $GLOBALS['configSystemDBTableCategories'], 
                $this->arrSearchParameters, 
                '', 
                '', 
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01($GLOBALS['configSystemDBTableCategories'], 'all', 'string'), 
                1, 
                $this->arrSpecialParameters
            );

            if ($this->resultsCategoryDetails['returnStatus'] === true) {
                // $arrReturn = ['returnStatus' => true, ...$this->resultsCategoriesListing]; // error - research
                // $arrReturn = array_merge(['returnStatus' => true], $this->resultsCategoryDetails); // working
                $arrReturn['returnStatus'] = true;

                // Define values.
                //$this->tblCategoriesID = $this->resultsCategoryDetails[0]['id'];
                $this->tblCategoriesID = $this->resultsCategoryDetails[0]->id;


                // Build return array.
                $arrReturn['tblCategoriesID'] = (float)$this->tblCategoriesID;
            }

            // Debug.
            //echo 'this->resultsCategoryDetails=<pre>';
            //var_dump($this->resultsCategoryDetails);
            //echo '</pre><br />';

            //return ['data' => 'testing recordDetailsGet'];
            return $arrReturn;
        } catch (Error $recordDetailsGetError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('recordDetailsGetError: ' . $recordDetailsGetError->message());
            }
        } finally {

        }

    }
    // **************************************************************************************
}
