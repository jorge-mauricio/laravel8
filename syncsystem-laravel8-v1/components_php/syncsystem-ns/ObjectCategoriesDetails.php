<?php

declare(strict_types=1);

namespace SyncSystemNS;

class ObjectCategoriesDetails
{
    // Properties.
    // ----------------------
    private float|null $idTbCategories = null;
    private array|null $arrSearchParameters = [];

    private int $terminal = 0; // terminal: 0 - backend | 1 - frontend
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = [];

    private array|null $resultsCategoryDetails = null;

    private float|null $tblCategoriesID = null;
    private float $tblCategoriesIdParent = 0;
    private float $tblCategoriesSortOrder = 0;
    private string $tblCategoriesSortOrder_print = '0';
    private int $tblCategoriesCategoryType = 0; // Review: check categories insert to see if 0 is default value

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
    // private DateTime $tblCategoriesDate2DateObj = new DateTime();
    // private object $tblCategoriesDate1DateObj = new DateTime();
    private object|null $tblCategoriesDate1DateObj = null;
    private string|null $tblCategoriesDate1DateYear = null;
    private string|null $tblCategoriesDate1DateDay = null;
    private string|null $tblCategoriesDate1DateMonth = null;
    private string|null $tblCategoriesDate1DateHour = null;
    private string $tblCategoriesDate1DateHour_print = '';
    private string|null $tblCategoriesDate1DateMinute = null;
    private string|null $tblCategoriesDate1DateMinute_print = '';
    private string|null $tblCategoriesDate1DateSecond = null;
    private string $tblCategoriesDate1DateSecond_print = '';
    // TODO: linting - vs code phpcs single_class_element_per_statement equivalent (ex: Generic.Formatting.DisallowMultipleStatements)

    private string|null $tblCategoriesDate2 = null;
    private string $tblCategoriesDate2_print = '';
    private object|null $tblCategoriesDate2DateObj = null;
    private string|null $tblCategoriesDate2DateYear = null;
    private string|null $tblCategoriesDate2DateDay = null;
    private string|null $tblCategoriesDate2DateMonth = null;
    private string|null $tblCategoriesDate2DateHour = null;
    private string $tblCategoriesDate2DateHour_print = '';
    private string|null $tblCategoriesDate2DateMinute = null;
    private string $tblCategoriesDate2DateMinute_print = '';
    private string|null $tblCategoriesDate2DateSecond = null;
    private string $tblCategoriesDate2DateSecond_print = '';

    private string|null $tblCategoriesDate3 = null;
    private string $tblCategoriesDate3_print = '';
    private object|null $tblCategoriesDate3DateObj = null;
    private string|null $tblCategoriesDate3DateYear = null;
    private string|null $tblCategoriesDate3DateDay = null;
    private string|null $tblCategoriesDate3DateMonth = null;
    private string|null $tblCategoriesDate3DateHour = null;
    private string $tblCategoriesDate3DateHour_print = '';
    private string|null $tblCategoriesDate3DateMinute = null;
    private string $tblCategoriesDate3DateMinute_print = '';
    private string|null $tblCategoriesDate3DateSecond = null;
    private string $tblCategoriesDate3DateSecond_print = '';

    private string|null $tblCategoriesDate4 = null;
    private string $tblCategoriesDate4_print = '';
    private object|null $tblCategoriesDate4DateObj = null;
    private string|null $tblCategoriesDate4DateYear = null;
    private string|null $tblCategoriesDate4DateDay = null;
    private string|null $tblCategoriesDate4DateMonth = null;
    private string|null $tblCategoriesDate4DateHour = null;
    private string $tblCategoriesDate4DateHour_print = '';
    private string|null $tblCategoriesDate4DateMinute = null;
    private string $tblCategoriesDate4DateMinute_print = '';
    private string|null $tblCategoriesDate4DateSecond = null;
    private string $tblCategoriesDate4DateSecond_print = '';

    private string|null $tblCategoriesDate5 = null;
    private string $tblCategoriesDate5_print = '';
    private object|null $tblCategoriesDate5DateObj = null;
    private string|null $tblCategoriesDate5DateYear = null;
    private string|null $tblCategoriesDate5DateDay = null;
    private string|null $tblCategoriesDate5DateMonth = null;
    private string|null $tblCategoriesDate5DateHour = null;
    private string $tblCategoriesDate5DateHour_print = '';
    private string|null $tblCategoriesDate5DateMinute = null;
    private string $tblCategoriesDate5DateMinute_print = '';
    private string|null $tblCategoriesDate5DateSecond = null;
    private string $tblCategoriesDate5DateSecond_print = '';

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

    private int $tblCategoriesActivation = 1;
    private string $tblCategoriesActivation_print = '';
    private int $tblCategoriesActivation1 = 0;
    private string $tblCategoriesActivation1_print = '';
    private int $tblCategoriesActivation2 = 0;
    private string $tblCategoriesActivation2_print = '';
    private int $tblCategoriesActivation3 = 0;
    private string $tblCategoriesActivation3_print = '';
    private int $tblCategoriesActivation4 = 0;
    private string $tblCategoriesActivation4_print = '';
    private int $tblCategoriesActivation5 = 0;
    private string $tblCategoriesActivation5_print = '';

    private float $tblCategoriesIdStatus = 0;
    private string $tblCategoriesIdStatus_print = '';

    private int $tblCategoriesRestrictedAccess = 0;
    private string $tblCategoriesRestrictedAccess_print = '';

    private string $tblCategoriesNotes = '';
    private string $tblCategoriesNotes_edit = '';

    private \SyncSystemNS\ObjectFiltersGenericListing|null $ofglRecords = null;

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

    private array|null $arrIdsCategoriesFiltersGenericBinding = null;

    private array|null $arrIdsCategoriesFiltersGeneric1Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric2Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric3Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric4Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric5Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric6Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric7Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric8Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric9Binding = [];
    private array|null $arrIdsCategoriesFiltersGeneric10Binding = [];

    private array|null $arrCategoriesFiltersGeneric1Binding_print = [];
    private array|null $arrCategoriesFiltersGeneric2Binding_print;
    private array|null $arrCategoriesFiltersGeneric3Binding_print;
    private array|null $arrCategoriesFiltersGeneric4Binding_print;
    private array|null $arrCategoriesFiltersGeneric5Binding_print;
    private array|null $arrCategoriesFiltersGeneric6Binding_print;
    private array|null $arrCategoriesFiltersGeneric7Binding_print;
    private array|null $arrCategoriesFiltersGeneric8Binding_print;
    private array|null $arrCategoriesFiltersGeneric9Binding_print;
    private array|null $arrCategoriesFiltersGeneric10Binding_print;

    /*
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
    */
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $arrParameters
     */
    public function __construct(array|null $arrParameters = null)
    {
        // Value definition.
        // ----------------------
        $this->idTbCategories = array_key_exists('_idTbCategories', $arrParameters) && $arrParameters['_idTbCategories'] !== null ? (float) $arrParameters['_idTbCategories'] : $this->idTbCategories;
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) && $arrParameters['_arrSearchParameters'] !== null ? $arrParameters['_arrSearchParameters'] : $this->arrSearchParameters;

        $this->terminal = array_key_exists('_terminal', $arrParameters) && $arrParameters['_terminal'] !== null ? (int) $arrParameters['_terminal'] : $this->terminal;
        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }

        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) && $arrParameters['_arrSpecialParameters'] !== null ? $arrParameters['_arrSpecialParameters'] : $this->arrSpecialParameters;
        // ----------------------
    }
    // **************************************************************************************

    // Get category details according to search parameters.
    // **************************************************************************************
    /**
     * Get categories details according to search parameters.
     * @param float $terminal 0 - backend | 1 - frontend
     * @param float $returnType 1 - array | 3 - Json Object | 10 - html
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
                config('app.gSystemConfig.configSystemDBTableCategories'),
                $this->arrSearchParameters,
                '',
                '',
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableCategories'), 'all', 'string'),
                1,
                $this->arrSpecialParameters
            );

            // Debug.
            //echo 'resultsCategoryDetails=<pre>';
            //var_dump($this->resultsCategoryDetails);
            //echo '</pre><br />';

            // if ($this->resultsCategoryDetails['returnStatus'] === true) {
            if ($this->resultsCategoryDetails['returnStatus'] === true && isset($this->resultsCategoryDetails[0])) {
                // $arrReturn = ['returnStatus' => true, ...$this->resultsCategoriesListing]; // error - research
                // $arrReturn = array_merge(['returnStatus' => true], $this->resultsCategoryDetails); // working
                $arrReturn['returnStatus'] = true;

                // Filters generic.
                $this->ofglRecords = new \SyncSystemNS\ObjectFiltersGenericListing([
                    '_arrSearchParameters' => ['table_name;' . config('app.gSystemConfig.configSystemDBTableCategories') . ';s'],
                    '_configSortOrder' => 'title',
                    '_strNRecords' => '',
                    '_arrSpecialParameters' => [
                        'returnType' => 1,
                        // 'pageNumber' => $this->pageNumber,
                        // 'pagingNRecords' => $this->pagingNRecords
                    ],
                ]);
                $resultsFiltersGenericListing = $this->ofglRecords->recordsListingGet(0, 1);
                if (count($resultsFiltersGenericListing)) {
                    // Strip arrays that has string as keys.
                    $resultsFiltersGenericListing = array_filter($resultsFiltersGenericListing, function ($value, $key) {
                        return !is_string($key);
                    }, ARRAY_FILTER_USE_BOTH);

                    // Force to array (for some reason, it's converting to an object).
                    $resultsFiltersGenericListing = json_decode(json_encode($resultsFiltersGenericListing), true);
                }

                // Filters generic bindings.
                $this->arrIdsCategoriesFiltersGenericBinding = \SyncSystemNS\FunctionsDB::genericTableGet02(
                    config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                    ['id_record;' . $this->idTbCategories . ';i'], // TODO: swap for $this->tblCategoriesID (and sync with other versions).
                    '',
                    '',
                    \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'), 'all', 'string'),
                    1,
                    ['returnType' => 1]
                );

                if ($this->arrIdsCategoriesFiltersGenericBinding['returnStatus'] === true) {
                    // Strip arrays that has string as keys.
                    // unset($this->arrIdsCategoriesFiltersGenericBinding['returnStatus']);
                    $this->arrIdsCategoriesFiltersGenericBinding = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($value, $key) {
                        // return is_string($key) === false;
                        return !is_string($key);
                        // return is_array($value) === false;
                        // return array_key_exists('filter_index', $arr);
                    }, ARRAY_FILTER_USE_BOTH);

                    // Filters generic - separation.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') !== 0) {
                        // $this->arrIdsCategoriesFiltersGeneric1Binding = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($value, $key) {
                        //     return $value['id_filter_index'] === 101;
                        // }, ARRAY_FILTER_USE_BOTH);

                        $this->arrIdsCategoriesFiltersGeneric1Binding = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) {
                            // return $arr->id_filter_index === 101; // Working. For some reason, the $arr is an object.
                            $arr = json_decode(json_encode($arr), true); // Force converting to array.
                            return $arr['id_filter_index'] === 101 && isset($arr['id_filter_index']);

                            // \SyncSystemNS\FunctionsLog::logLaravel($arr);
                            // return $arr['id_filter_index'] === 101;
                            // return $arr->id_filter_index === 101; // for some reason, the $arr is an object.
                            // return ($arr['filter_index'] === 101);

                            // Debug.
                            // echo 'arr=<pre>';
                            // var_dump($arr);
                            // echo '</pre><br/>';
                        });
                        $this->arrIdsCategoriesFiltersGeneric1Binding = json_decode(json_encode($this->arrIdsCategoriesFiltersGeneric1Binding), true);

                        // Debug.
                        // echo 'arrIdsCategoriesFiltersGeneric1Binding=<pre>';
                        // var_dump($this->arrIdsCategoriesFiltersGeneric1Binding);
                        // echo '</pre><br/>';

                        // $this->arrIdsCategoriesFiltersGeneric1Binding = array_search(101, array_column($this->arrIdsCategoriesFiltersGenericBinding, 'filter_index'));

                        // foreach ($this->arrIdsCategoriesFiltersGeneric1Binding as $arrFilterGeneric) {
                        //     if (array_search($arrFilterGeneric['id_filters_generic'], array_column($resultsFiltersGenericListing, 'id'))) {

                        //     }
                        // }
                        if (count($this->arrIdsCategoriesFiltersGeneric1Binding)) {
                            // $this->arrCategoriesFiltersGeneric1Binding_print = '';
                            $this->arrCategoriesFiltersGeneric1Binding_print = array_map(function ($arr) use ($resultsFiltersGenericListing) {
                                $filtersGenericKeyMatch = array_search($arr['id_filters_generic'], array_column($resultsFiltersGenericListing, 'id'));
                                return $resultsFiltersGenericListing[$filtersGenericKeyMatch]['title'];

                                // Debug.
                                // echo 'filtersGenericKeyMatch=<pre>';
                                // var_dump($filtersGenericKeyMatch);
                                // echo '</pre><br/>';

                                // echo 'filtersGenericKeyMatch=<pre>';
                                // var_dump($resultsFiltersGenericListing[$filtersGenericKeyMatch]);
                                // echo '</pre><br/>';

                                // return array_search($arr['id_filters_generic'], array_column($resultsFiltersGenericListing, 'id'));
                            }, $this->arrIdsCategoriesFiltersGeneric1Binding);
                        }
                        // TODO: refactor so the out put would be the id key and the title, for optimization.
                        // Example: $arr['id_filters_generic'] => $resultsFiltersGenericListing[$filtersGenericKeyMatch]['title']
                        // Sync to other frameworks.
                    }
                } else {
                    // Condition for error.
                }


                // Debug.
                $arrReturn['arrIdsCategoriesFiltersGenericBinding'] = $this->arrIdsCategoriesFiltersGenericBinding;

                $arrReturn['ofglRecordsDebug'] = $this->ofglRecords;
                $arrReturn['resultsFiltersGenericListing'] = $resultsFiltersGenericListing;

                // exit();




                // Define values.
                //$this->tblCategoriesID = $this->resultsCategoryDetails[0]['id'];
                $this->tblCategoriesID = $this->resultsCategoryDetails[0]->id;
                $this->tblCategoriesIdParent = $this->resultsCategoryDetails[0]->id_parent;

                $this->tblCategoriesSortOrder = (float) $this->resultsCategoryDetails[0]->sort_order;
                $this->tblCategoriesSortOrder_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesSortOrder, config('app.gSystemConfig.configSystemCurrency'), SS_VALUE_TYPE_DECIMAL);

                $this->tblCategoriesCategoryType = $this->resultsCategoryDetails[0]->category_type;

                $this->tblCategoriesDateCreation = $this->resultsCategoryDetails[0]->date_creation; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
                $this->tblCategoriesDateTimezone = $this->resultsCategoryDetails[0]->date_timezone;
                $this->tblCategoriesDateEdit = $this->resultsCategoryDetails[0]->date_edit;

                $this->tblCategoriesIdRegisterUser = $this->resultsCategoryDetails[0]->id_register_user;
                if ($this->tblCategoriesIdRegisterUser !== 0) {
                    $this->tblCategoriesIdRegisterUser_print = '';
                }
                $this->tblCategoriesIdRegister1 = $this->resultsCategoryDetails[0]->id_register1;
                if ($this->tblCategoriesIdRegister1 !== 0) {
                    $this->tblCategoriesIdRegister1_print = '';
                }
                $this->tblCategoriesIdRegister2 = $this->resultsCategoryDetails[0]->id_register2;
                if ($this->tblCategoriesIdRegister2 !== 0) {
                    $this->tblCategoriesIdRegister2_print = '';
                }
                $this->tblCategoriesIdRegister3 = $this->resultsCategoryDetails[0]->id_register3;
                if ($this->tblCategoriesIdRegister3 !== 0) {
                    $this->tblCategoriesIdRegister3_print = '';
                }
                $this->tblCategoriesIdRegister4 = $this->resultsCategoryDetails[0]->id_register4;
                if ($this->tblCategoriesIdRegister4 !== 0) {
                    $this->tblCategoriesIdRegister4_print = '';
                }
                $this->tblCategoriesIdRegister5 = $this->resultsCategoryDetails[0]->id_register5;
                if ($this->tblCategoriesIdRegister5 !== 0) {
                    $this->tblCategoriesIdRegister5_print = '';
                }

                $this->tblCategoriesTitle = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->title, 'db');
                $this->tblCategoriesDescription = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->description, 'db');
                $this->tblCategoriesDescription_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->description, 'editTextBox=' . config('app.gSystemConfig.configBackendTextBox'));
                $this->tblCategoriesURLAlias = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->url_alias, 'db');
                $this->tblCategoriesKeywordsTags = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->keywords_tags, 'db');
                $this->tblCategoriesMetaDescription = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->meta_description, 'db');
                $this->tblCategoriesMetaDescription_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->meta_description, 'db');
                $this->tblCategoriesMetaTitle = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->meta_title, 'db');
                $this->tblCategoriesMetaInfo = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->meta_info, 'db');

                if (config('app.gSystemConfig.enableCategoriesInfo1') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo1FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo1 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info1, 'db');
                        $this->tblCategoriesInfo1_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info1, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo1FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo1 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info1, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo1_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info1, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo2') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo2FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo2 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info2, 'db');
                        $this->tblCategoriesInfo2_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info2, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo2FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo2 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info2, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo2_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info2, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo3') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo3FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo3 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info3, 'db');
                        $this->tblCategoriesInfo3_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info3, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo3FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo3 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info3, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo3_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info3, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo4') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo4FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo4 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info4, 'db');
                        $this->tblCategoriesInfo4_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info4, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo4FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo4 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info4, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo4_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info4, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo5') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo5FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo5 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info5, 'db');
                        $this->tblCategoriesInfo5_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info5, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo5FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo5 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info5, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo5_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info5, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo6') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo6FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo6 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info6, 'db');
                        $this->tblCategoriesInfo6_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info6, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo6FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo6 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info6, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo6_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info6, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo7') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo7FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo7 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info7, 'db');
                        $this->tblCategoriesInfo7_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info7, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo7FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo7 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info7, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo7_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info7, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo8') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo8FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo8 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info8, 'db');
                        $this->tblCategoriesInfo8_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info8, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo8FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo8 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info8, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo8_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info8, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo9') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo9FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo9 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info9, 'db');
                        $this->tblCategoriesInfo9_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info9, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo9FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo9 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info9, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo9_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info9, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableCategoriesInfo10') === 1) {
                    if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configCategoriesInfo10FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblCategoriesInfo10 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info10, 'db');
                        $this->tblCategoriesInfo10_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info10, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configCategoriesInfo10FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblCategoriesInfo10 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info10, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblCategoriesInfo10_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info10, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }

                $this->tblCategoriesInfoSmall1 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small1, 'db');
                $this->tblCategoriesInfoSmall1_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small1, 'db');
                $this->tblCategoriesInfoSmall2 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small2, 'db');
                $this->tblCategoriesInfoSmall2_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small2, 'db');
                $this->tblCategoriesInfoSmall3 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small3, 'db');
                $this->tblCategoriesInfoSmall3_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small3, 'db');
                $this->tblCategoriesInfoSmall4 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small4, 'db');
                $this->tblCategoriesInfoSmall4_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small4, 'db');
                $this->tblCategoriesInfoSmall5 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small5, 'db');
                $this->tblCategoriesInfoSmall5_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->info_small5, 'db');

                $this->tblCategoriesNumber1 = (float) $this->resultsCategoryDetails[0]->number1;
                $this->tblCategoriesNumber1_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber1, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumber1FieldType'));
                //$this->tblCategoriesNumber1_print = \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber1, config('app.gSystemConfig.configSystemCurrency'], 1);
                $this->tblCategoriesNumber2 = (float) $this->resultsCategoryDetails[0]->number2;
                $this->tblCategoriesNumber2_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber2, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumber2FieldType'));
                $this->tblCategoriesNumber3 = (float) $this->resultsCategoryDetails[0]->number3;
                $this->tblCategoriesNumber3_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber3, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumber3FieldType'));
                $this->tblCategoriesNumber4 = (float) $this->resultsCategoryDetails[0]->number4;
                $this->tblCategoriesNumber4_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber4, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumber4FieldType'));
                $this->tblCategoriesNumber5 = (float) $this->resultsCategoryDetails[0]->number5;
                $this->tblCategoriesNumber5_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumber5, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumber5FieldType'));

                $this->tblCategoriesNumberSmall1 = (float) $this->resultsCategoryDetails[0]->number_small1;
                $this->tblCategoriesNumberSmall1_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumberSmall1, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumberS1FieldType'));
                $this->tblCategoriesNumberSmall2 = (float) $this->resultsCategoryDetails[0]->number_small2;
                $this->tblCategoriesNumberSmall2_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumberSmall2, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumberS2FieldType'));
                $this->tblCategoriesNumberSmall3 = (float) $this->resultsCategoryDetails[0]->number_small3;
                $this->tblCategoriesNumberSmall3_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumberSmall3, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumberS3FieldType'));
                $this->tblCategoriesNumberSmall4 = (float) $this->resultsCategoryDetails[0]->number_small4;
                $this->tblCategoriesNumberSmall4_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumberSmall4, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumberS4FieldType'));
                $this->tblCategoriesNumberSmall5 = (float) $this->resultsCategoryDetails[0]->number_small5;
                $this->tblCategoriesNumberSmall5_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblCategoriesNumberSmall5, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configCategoriesNumberS5FieldType'));

                // Dates
                $this->tblCategoriesDate1 = $this->resultsCategoryDetails[0]->date1;
                if ($this->tblCategoriesDate1) {
                    $this->tblCategoriesDate1DateObj = new \DateTime($this->tblCategoriesDate1);

                    $this->tblCategoriesDate1DateYear = $this->tblCategoriesDate1DateObj->format('Y');
                    $this->tblCategoriesDate1DateDay = $this->tblCategoriesDate1DateObj->format('d');
                    $this->tblCategoriesDate1DateMonth = $this->tblCategoriesDate1DateObj->format('m');

                    $this->tblCategoriesDate1DateHour = $this->tblCategoriesDate1DateObj->format('H');
                    $this->tblCategoriesDate1DateHour_print = $this->tblCategoriesDate1DateHour;

                    $this->tblCategoriesDate1DateMinute = $this->tblCategoriesDate1DateObj->format('i');
                    $this->tblCategoriesDate1DateMinute_print = $this->tblCategoriesDate1DateMinute;

                    $this->tblCategoriesDate1DateSecond = $this->tblCategoriesDate1DateObj->format('s');
                    $this->tblCategoriesDate1DateSecond_print = $this->tblCategoriesDate1DateSecond;

                    $this->tblCategoriesDate1_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblCategoriesDate1, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configCategoriesDate1Type'));
                }
                $this->tblCategoriesDate2 = $this->resultsCategoryDetails[0]->date2;
                if ($this->tblCategoriesDate2) {
                    $this->tblCategoriesDate2DateObj = new \DateTime($this->tblCategoriesDate2);

                    $this->tblCategoriesDate2DateYear = $this->tblCategoriesDate2DateObj->format('Y');
                    $this->tblCategoriesDate2DateDay = $this->tblCategoriesDate2DateObj->format('d');
                    $this->tblCategoriesDate2DateMonth = $this->tblCategoriesDate2DateObj->format('m');

                    $this->tblCategoriesDate2DateHour = $this->tblCategoriesDate2DateObj->format('H');
                    $this->tblCategoriesDate2DateHour_print = $this->tblCategoriesDate2DateHour;

                    $this->tblCategoriesDate2DateMinute = $this->tblCategoriesDate2DateObj->format('i');
                    $this->tblCategoriesDate2DateMinute_print = $this->tblCategoriesDate2DateMinute;

                    $this->tblCategoriesDate2DateSecond = $this->tblCategoriesDate2DateObj->format('s');
                    $this->tblCategoriesDate2DateSecond_print = $this->tblCategoriesDate2DateSecond;

                    $this->tblCategoriesDate2_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblCategoriesDate2, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configCategoriesDate2Type'));
                }
                $this->tblCategoriesDate3 = $this->resultsCategoryDetails[0]->date3;
                if ($this->tblCategoriesDate3) {
                    $this->tblCategoriesDate3DateObj = new \DateTime($this->tblCategoriesDate3);

                    $this->tblCategoriesDate3DateYear = $this->tblCategoriesDate3DateObj->format('Y');
                    $this->tblCategoriesDate3DateDay = $this->tblCategoriesDate3DateObj->format('d');
                    $this->tblCategoriesDate3DateMonth = $this->tblCategoriesDate3DateObj->format('m');

                    $this->tblCategoriesDate3DateHour = $this->tblCategoriesDate3DateObj->format('H');
                    $this->tblCategoriesDate3DateHour_print = $this->tblCategoriesDate3DateHour;

                    $this->tblCategoriesDate3DateMinute = $this->tblCategoriesDate3DateObj->format('i');
                    $this->tblCategoriesDate3DateMinute_print = $this->tblCategoriesDate3DateMinute;

                    $this->tblCategoriesDate3DateSecond = $this->tblCategoriesDate3DateObj->format('s');
                    $this->tblCategoriesDate3DateSecond_print = $this->tblCategoriesDate3DateSecond;

                    $this->tblCategoriesDate3_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblCategoriesDate3, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configCategoriesDate3Type'));
                }
                $this->tblCategoriesDate4 = $this->resultsCategoryDetails[0]->date4;
                if ($this->tblCategoriesDate4) {
                    $this->tblCategoriesDate4DateObj = new \DateTime($this->tblCategoriesDate4);

                    $this->tblCategoriesDate4DateYear = $this->tblCategoriesDate4DateObj->format('Y');
                    $this->tblCategoriesDate4DateDay = $this->tblCategoriesDate4DateObj->format('d');
                    $this->tblCategoriesDate4DateMonth = $this->tblCategoriesDate4DateObj->format('m');

                    $this->tblCategoriesDate4DateHour = $this->tblCategoriesDate4DateObj->format('H');
                    $this->tblCategoriesDate4DateHour_print = $this->tblCategoriesDate4DateHour;

                    $this->tblCategoriesDate4DateMinute = $this->tblCategoriesDate4DateObj->format('i');
                    $this->tblCategoriesDate4DateMinute_print = $this->tblCategoriesDate4DateMinute;

                    $this->tblCategoriesDate4DateSecond = $this->tblCategoriesDate4DateObj->format('s');
                    $this->tblCategoriesDate4DateSecond_print = $this->tblCategoriesDate4DateSecond;

                    $this->tblCategoriesDate4_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblCategoriesDate4, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configCategoriesDate4Type'));
                }
                $this->tblCategoriesDate5 = $this->resultsCategoryDetails[0]->date5;
                if ($this->tblCategoriesDate5) {
                    $this->tblCategoriesDate5DateObj = new \DateTime($this->tblCategoriesDate5);

                    $this->tblCategoriesDate5DateYear = $this->tblCategoriesDate5DateObj->format('Y');
                    $this->tblCategoriesDate5DateDay = $this->tblCategoriesDate5DateObj->format('d');
                    $this->tblCategoriesDate5DateMonth = $this->tblCategoriesDate5DateObj->format('m');

                    $this->tblCategoriesDate5DateHour = $this->tblCategoriesDate5DateObj->format('H');
                    $this->tblCategoriesDate5DateHour_print = $this->tblCategoriesDate5DateHour;

                    $this->tblCategoriesDate5DateMinute = $this->tblCategoriesDate5DateObj->format('i');
                    $this->tblCategoriesDate5DateMinute_print = $this->tblCategoriesDate5DateMinute;

                    $this->tblCategoriesDate5DateSecond = $this->tblCategoriesDate5DateObj->format('s');
                    $this->tblCategoriesDate5DateSecond_print = $this->tblCategoriesDate5DateSecond;

                    $this->tblCategoriesDate5_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblCategoriesDate5, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configCategoriesDate5Type'));
                }

                /*
                TODO: check the select statement in this part
                $this->tblCategoriesIdItem1 = $this->resultsCategoryDetails[0]->id_item1;
                $this->tblCategoriesIdItem2 = $this->resultsCategoryDetails[0]->id_item2;
                $this->tblCategoriesIdItem3 = $this->resultsCategoryDetails[0]->id_item3;
                $this->tblCategoriesIdItem4 = $this->resultsCategoryDetails[0]->id_item4;
                $this->tblCategoriesIdItem5 = $this->resultsCategoryDetails[0]->id_item5;
                */

                $this->tblCategoriesImageMain = (string)$this->resultsCategoryDetails[0]->image_main;
                $this->tblCategoriesFile1 = (string)$this->resultsCategoryDetails[0]->file1;
                $this->tblCategoriesFile2 = (string)$this->resultsCategoryDetails[0]->file2;
                $this->tblCategoriesFile3 = (string)$this->resultsCategoryDetails[0]->file3;
                $this->tblCategoriesFile4 = (string)$this->resultsCategoryDetails[0]->file4;
                $this->tblCategoriesFile5 = (string)$this->resultsCategoryDetails[0]->file5;

                $this->tblCategoriesActivation = $this->resultsCategoryDetails[0]->activation;
                $this->tblCategoriesActivation_print = $this->tblCategoriesActivation === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblCategoriesActivation1 = $this->resultsCategoryDetails[0]->activation1;
                $this->tblCategoriesActivation1_print = $this->tblCategoriesActivation1 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblCategoriesActivation2 = $this->resultsCategoryDetails[0]->activation2;
                $this->tblCategoriesActivation2_print = $this->tblCategoriesActivation2 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                // Debug.
                //dd('this->tblCategoriesActivation2=' . $this->tblCategoriesActivation2 === 0);
                //dd('gettype=' . gettype($this->tblCategoriesActivation2));

                $this->tblCategoriesActivation3 = $this->resultsCategoryDetails[0]->activation3;
                $this->tblCategoriesActivation3_print = $this->tblCategoriesActivation3 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblCategoriesActivation4 = $this->resultsCategoryDetails[0]->activation4;
                $this->tblCategoriesActivation4_print = $this->tblCategoriesActivation4 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblCategoriesActivation5 = $this->resultsCategoryDetails[0]->activation5;
                $this->tblCategoriesActivation5_print = $this->tblCategoriesActivation5 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                // Debug.
                // echo 'appLabelsGet=<pre>';
                // var_dump(\SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0'));
                // echo '</pre><br />';

                $this->tblCategoriesIdStatus = $this->resultsCategoryDetails[0]->id_status;
                $this->tblCategoriesIdStatus_print = $this->tblCategoriesIdStatus === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemDropDownSelectNone')
                :
                    \SyncSystemNS\FunctionsGeneric::contentMaskRead(\SyncSystemNS\FunctionsDB::genericFieldGet01($this->tblCategoriesIdStatus, config('app.gSystemConfig.configSystemDBTableFiltersGeneric'), 'title'), 'db')
                ;

                /*
                if (this.tblCategoriesIdStatus == 0) {
                    this.tblCategoriesIdStatus_print = FunctionsGeneric.appLabelsGet(gSystemConfig.configLanguageBackend.appLabels, this.labelPrefix + 'ItemDropDownSelectNone');
                } else {
                    this.tblCategoriesIdStatus_print = FunctionsGeneric.contentMaskRead(await FunctionsDB.genericFieldGet01(this.tblCategoriesIdStatus, gSystemConfig.configSystemDBTableFiltersGeneric, 'title'), 'db');
                }
                */

                $this->tblCategoriesRestrictedAccess = $this->resultsCategoryDetails[0]->restricted_access;
                $this->tblCategoriesRestrictedAccess_print = $this->tblCategoriesRestrictedAccess === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemRestrictedAccess0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemRestrictedAccess1')
                ;

                $this->tblCategoriesNotes = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->notes, 'db');
                $this->tblCategoriesNotes_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsCategoryDetails[0]->notes, 'db');

                // Build return array.
                $arrReturn['tblCategoriesID'] = $this->tblCategoriesID;
                $arrReturn['tblCategoriesIdParent'] = $this->tblCategoriesIdParent;

                $arrReturn['tblCategoriesSortOrder'] = $this->tblCategoriesSortOrder;
                $arrReturn['tblCategoriesSortOrder_print'] = $this->tblCategoriesSortOrder_print;

                $arrReturn['tblCategoriesCategoryType'] = $this->tblCategoriesCategoryType;

                $arrReturn['tblCategoriesDateCreation'] = $this->tblCategoriesDateCreation;
                $arrReturn['tblCategoriesDateTimezone'] = $this->tblCategoriesDateTimezone;
                $arrReturn['tblCategoriesDateEdit'] = $this->tblCategoriesDateEdit;

                $arrReturn['tblCategoriesIdRegisterUser'] = $this->tblCategoriesIdRegisterUser;
                $arrReturn['tblCategoriesIdRegisterUser_print'] = $this->tblCategoriesIdRegisterUser_print;
                $arrReturn['tblCategoriesIdRegister1'] = $this->tblCategoriesIdRegister1;
                $arrReturn['tblCategoriesIdRegister1_print'] = $this->tblCategoriesIdRegister1_print;
                $arrReturn['tblCategoriesIdRegister2'] = $this->tblCategoriesIdRegister2;
                $arrReturn['tblCategoriesIdRegister2_print'] = $this->tblCategoriesIdRegister1_print;
                $arrReturn['tblCategoriesIdRegister3'] = $this->tblCategoriesIdRegister3;
                $arrReturn['tblCategoriesIdRegister3_print'] = $this->tblCategoriesIdRegister1_print;
                $arrReturn['tblCategoriesIdRegister4'] = $this->tblCategoriesIdRegister4;
                $arrReturn['tblCategoriesIdRegister4_print'] = $this->tblCategoriesIdRegister1_print;
                $arrReturn['tblCategoriesIdRegister5'] = $this->tblCategoriesIdRegister5;
                $arrReturn['tblCategoriesIdRegister5_print'] = $this->tblCategoriesIdRegister1_print;

                $arrReturn['tblCategoriesTitle'] = $this->tblCategoriesTitle;
                $arrReturn['tblCategoriesDescription'] = $this->tblCategoriesDescription;
                $arrReturn['tblCategoriesDescription_edit'] = $this->tblCategoriesDescription_edit;
                $arrReturn['tblCategoriesURLAlias'] = $this->tblCategoriesURLAlias;
                $arrReturn['tblCategoriesKeywordsTags'] = $this->tblCategoriesKeywordsTags;
                $arrReturn['tblCategoriesMetaDescription'] = $this->tblCategoriesMetaDescription;
                $arrReturn['tblCategoriesMetaDescription_edit'] = $this->tblCategoriesMetaDescription_edit;
                $arrReturn['tblCategoriesMetaTitle'] = $this->tblCategoriesMetaTitle;
                $arrReturn['tblCategoriesMetaInfo'] = $this->tblCategoriesMetaInfo;

                $arrReturn['tblCategoriesInfo1'] = $this->tblCategoriesInfo1;
                $arrReturn['tblCategoriesInfo1_edit'] = $this->tblCategoriesInfo1_edit;
                $arrReturn['tblCategoriesInfo2'] = $this->tblCategoriesInfo2;
                $arrReturn['tblCategoriesInfo2_edit'] = $this->tblCategoriesInfo2_edit;
                $arrReturn['tblCategoriesInfo3'] = $this->tblCategoriesInfo3;
                $arrReturn['tblCategoriesInfo3_edit'] = $this->tblCategoriesInfo3_edit;
                $arrReturn['tblCategoriesInfo4'] = $this->tblCategoriesInfo4;
                $arrReturn['tblCategoriesInfo4_edit'] = $this->tblCategoriesInfo4_edit;
                $arrReturn['tblCategoriesInfo5'] = $this->tblCategoriesInfo5;
                $arrReturn['tblCategoriesInfo5_edit'] = $this->tblCategoriesInfo5_edit;
                $arrReturn['tblCategoriesInfo6'] = $this->tblCategoriesInfo6;
                $arrReturn['tblCategoriesInfo6_edit'] = $this->tblCategoriesInfo6_edit;
                $arrReturn['tblCategoriesInfo7'] = $this->tblCategoriesInfo7;
                $arrReturn['tblCategoriesInfo7_edit'] = $this->tblCategoriesInfo7_edit;
                $arrReturn['tblCategoriesInfo8'] = $this->tblCategoriesInfo8;
                $arrReturn['tblCategoriesInfo8_edit'] = $this->tblCategoriesInfo8_edit;
                $arrReturn['tblCategoriesInfo9'] = $this->tblCategoriesInfo9;
                $arrReturn['tblCategoriesInfo9_edit'] = $this->tblCategoriesInfo9_edit;
                $arrReturn['tblCategoriesInfo10'] = $this->tblCategoriesInfo10;
                $arrReturn['tblCategoriesInfo10_edit'] = $this->tblCategoriesInfo10_edit;

                $arrReturn['tblCategoriesInfoSmall1'] = $this->tblCategoriesInfoSmall1;
                $arrReturn['tblCategoriesInfoSmall1_edit'] = $this->tblCategoriesInfoSmall1_edit;
                $arrReturn['tblCategoriesInfoSmall2'] = $this->tblCategoriesInfoSmall2;
                $arrReturn['tblCategoriesInfoSmall2_edit'] = $this->tblCategoriesInfoSmall2_edit;
                $arrReturn['tblCategoriesInfoSmall3'] = $this->tblCategoriesInfoSmall3;
                $arrReturn['tblCategoriesInfoSmall3_edit'] = $this->tblCategoriesInfoSmall3_edit;
                $arrReturn['tblCategoriesInfoSmall4'] = $this->tblCategoriesInfoSmall4;
                $arrReturn['tblCategoriesInfoSmall4_edit'] = $this->tblCategoriesInfoSmall4_edit;
                $arrReturn['tblCategoriesInfoSmall5'] = $this->tblCategoriesInfoSmall5;
                $arrReturn['tblCategoriesInfoSmall5_edit'] = $this->tblCategoriesInfoSmall5_edit;

                $arrReturn['tblCategoriesNumber1'] = $this->tblCategoriesNumber1;
                $arrReturn['tblCategoriesNumber1_print'] = $this->tblCategoriesNumber1_print;
                $arrReturn['tblCategoriesNumber2'] = $this->tblCategoriesNumber2;
                $arrReturn['tblCategoriesNumber2_print'] = $this->tblCategoriesNumber2_print;
                $arrReturn['tblCategoriesNumber3'] = $this->tblCategoriesNumber3;
                $arrReturn['tblCategoriesNumber3_print'] = $this->tblCategoriesNumber3_print;
                $arrReturn['tblCategoriesNumber4'] = $this->tblCategoriesNumber4;
                $arrReturn['tblCategoriesNumber4_print'] = $this->tblCategoriesNumber4_print;
                $arrReturn['tblCategoriesNumber5'] = $this->tblCategoriesNumber5;
                $arrReturn['tblCategoriesNumber5_print'] = $this->tblCategoriesNumber5_print;

                $arrReturn['tblCategoriesNumberSmall1'] = $this->tblCategoriesNumberSmall1;
                $arrReturn['tblCategoriesNumberSmall1_print'] = $this->tblCategoriesNumberSmall1_print;
                $arrReturn['tblCategoriesNumberSmall2'] = $this->tblCategoriesNumberSmall2;
                $arrReturn['tblCategoriesNumberSmall2_print'] = $this->tblCategoriesNumberSmall2_print;
                $arrReturn['tblCategoriesNumberSmall3'] = $this->tblCategoriesNumberSmall3;
                $arrReturn['tblCategoriesNumberSmall3_print'] = $this->tblCategoriesNumberSmall3_print;
                $arrReturn['tblCategoriesNumberSmall4'] = $this->tblCategoriesNumberSmall4;
                $arrReturn['tblCategoriesNumberSmall4_print'] = $this->tblCategoriesNumberSmall4_print;
                $arrReturn['tblCategoriesNumberSmall5'] = $this->tblCategoriesNumberSmall5;
                $arrReturn['tblCategoriesNumberSmall5_print'] = $this->tblCategoriesNumberSmall5_print;

                $arrReturn['tblCategoriesDate1'] = $this->tblCategoriesDate1;
                $arrReturn['tblCategoriesDate1DateObj'] = $this->tblCategoriesDate1DateObj;
                $arrReturn['tblCategoriesDate1DateYear'] = $this->tblCategoriesDate1DateYear;
                $arrReturn['tblCategoriesDate1DateDay'] = $this->tblCategoriesDate1DateDay;
                $arrReturn['tblCategoriesDate1DateMonth'] = $this->tblCategoriesDate1DateMonth;
                $arrReturn['tblCategoriesDate1DateHour'] = $this->tblCategoriesDate1DateHour;
                $arrReturn['tblCategoriesDate1DateHour_print'] = $this->tblCategoriesDate1DateHour;
                $arrReturn['tblCategoriesDate1DateMinute'] = $this->tblCategoriesDate1DateMinute;
                $arrReturn['tblCategoriesDate1DateMinute_print'] = $this->tblCategoriesDate1DateMinute;
                $arrReturn['tblCategoriesDate1DateSecond'] = $this->tblCategoriesDate1DateSecond;
                $arrReturn['tblCategoriesDate1DateSecond_print'] = $this->tblCategoriesDate1DateSecond;
                $arrReturn['tblCategoriesDate1_print'] = $this->tblCategoriesDate1_print;

                $arrReturn['tblCategoriesDate2'] = $this->tblCategoriesDate2;
                $arrReturn['tblCategoriesDate2DateObj'] = $this->tblCategoriesDate2DateObj;
                $arrReturn['tblCategoriesDate2DateYear'] = $this->tblCategoriesDate2DateYear;
                $arrReturn['tblCategoriesDate2DateDay'] = $this->tblCategoriesDate2DateDay;
                $arrReturn['tblCategoriesDate2DateMonth'] = $this->tblCategoriesDate2DateMonth;
                $arrReturn['tblCategoriesDate2DateHour'] = $this->tblCategoriesDate2DateHour;
                $arrReturn['tblCategoriesDate2DateHour_print'] = $this->tblCategoriesDate2DateHour;
                $arrReturn['tblCategoriesDate2DateMinute'] = $this->tblCategoriesDate2DateMinute;
                $arrReturn['tblCategoriesDate2DateMinute_print'] = $this->tblCategoriesDate2DateMinute;
                $arrReturn['tblCategoriesDate2DateSecond'] = $this->tblCategoriesDate2DateSecond;
                $arrReturn['tblCategoriesDate2DateSecond_print'] = $this->tblCategoriesDate2DateSecond;
                $arrReturn['tblCategoriesDate2_print'] = $this->tblCategoriesDate2_print;

                $arrReturn['tblCategoriesDate3'] = $this->tblCategoriesDate3;
                $arrReturn['tblCategoriesDate3DateObj'] = $this->tblCategoriesDate3DateObj;
                $arrReturn['tblCategoriesDate3DateYear'] = $this->tblCategoriesDate3DateYear;
                $arrReturn['tblCategoriesDate3DateDay'] = $this->tblCategoriesDate3DateDay;
                $arrReturn['tblCategoriesDate3DateMonth'] = $this->tblCategoriesDate3DateMonth;
                $arrReturn['tblCategoriesDate3DateHour'] = $this->tblCategoriesDate3DateHour;
                $arrReturn['tblCategoriesDate3DateHour_print'] = $this->tblCategoriesDate3DateHour;
                $arrReturn['tblCategoriesDate3DateMinute'] = $this->tblCategoriesDate3DateMinute;
                $arrReturn['tblCategoriesDate3DateMinute_print'] = $this->tblCategoriesDate3DateMinute;
                $arrReturn['tblCategoriesDate3DateSecond'] = $this->tblCategoriesDate3DateSecond;
                $arrReturn['tblCategoriesDate3DateSecond_print'] = $this->tblCategoriesDate3DateSecond;
                $arrReturn['tblCategoriesDate3_print'] = $this->tblCategoriesDate3_print;

                $arrReturn['tblCategoriesDate4'] = $this->tblCategoriesDate4;
                $arrReturn['tblCategoriesDate4DateObj'] = $this->tblCategoriesDate4DateObj;
                $arrReturn['tblCategoriesDate4DateYear'] = $this->tblCategoriesDate4DateYear;
                $arrReturn['tblCategoriesDate4DateDay'] = $this->tblCategoriesDate4DateDay;
                $arrReturn['tblCategoriesDate4DateMonth'] = $this->tblCategoriesDate4DateMonth;
                $arrReturn['tblCategoriesDate4DateHour'] = $this->tblCategoriesDate4DateHour;
                $arrReturn['tblCategoriesDate4DateHour_print'] = $this->tblCategoriesDate4DateHour;
                $arrReturn['tblCategoriesDate4DateMinute'] = $this->tblCategoriesDate4DateMinute;
                $arrReturn['tblCategoriesDate4DateMinute_print'] = $this->tblCategoriesDate4DateMinute;
                $arrReturn['tblCategoriesDate4DateSecond'] = $this->tblCategoriesDate4DateSecond;
                $arrReturn['tblCategoriesDate4DateSecond_print'] = $this->tblCategoriesDate4DateSecond;
                $arrReturn['tblCategoriesDate4_print'] = $this->tblCategoriesDate4_print;

                $arrReturn['tblCategoriesDate5'] = $this->tblCategoriesDate5;
                $arrReturn['tblCategoriesDate5DateObj'] = $this->tblCategoriesDate5DateObj;
                $arrReturn['tblCategoriesDate5DateYear'] = $this->tblCategoriesDate5DateYear;
                $arrReturn['tblCategoriesDate5DateDay'] = $this->tblCategoriesDate5DateDay;
                $arrReturn['tblCategoriesDate5DateMonth'] = $this->tblCategoriesDate5DateMonth;
                $arrReturn['tblCategoriesDate5DateHour'] = $this->tblCategoriesDate5DateHour;
                $arrReturn['tblCategoriesDate5DateHour_print'] = $this->tblCategoriesDate5DateHour;
                $arrReturn['tblCategoriesDate5DateMinute'] = $this->tblCategoriesDate5DateMinute;
                $arrReturn['tblCategoriesDate5DateMinute_print'] = $this->tblCategoriesDate5DateMinute;
                $arrReturn['tblCategoriesDate5DateSecond'] = $this->tblCategoriesDate5DateSecond;
                $arrReturn['tblCategoriesDate5DateSecond_print'] = $this->tblCategoriesDate5DateSecond;
                $arrReturn['tblCategoriesDate5_print'] = $this->tblCategoriesDate5_print;

                $arrReturn['tblCategoriesImageMain'] = $this->tblCategoriesImageMain;
                $arrReturn['tblCategoriesFile1'] = $this->tblCategoriesFile1;
                $arrReturn['tblCategoriesFile2'] = $this->tblCategoriesFile2;
                $arrReturn['tblCategoriesFile3'] = $this->tblCategoriesFile3;
                $arrReturn['tblCategoriesFile4'] = $this->tblCategoriesFile4;
                $arrReturn['tblCategoriesFile5'] = $this->tblCategoriesFile5;

                $arrReturn['tblCategoriesActivation'] = $this->tblCategoriesActivation;
                $arrReturn['tblCategoriesActivation_print'] = $this->tblCategoriesActivation_print;
                $arrReturn['tblCategoriesActivation1'] = $this->tblCategoriesActivation1;
                $arrReturn['tblCategoriesActivation1_print'] = $this->tblCategoriesActivation1_print;
                $arrReturn['tblCategoriesActivation2'] = $this->tblCategoriesActivation2;
                $arrReturn['tblCategoriesActivation2_print'] = $this->tblCategoriesActivation2_print;
                $arrReturn['tblCategoriesActivation3'] = $this->tblCategoriesActivation3;
                $arrReturn['tblCategoriesActivation3_print'] = $this->tblCategoriesActivation3_print;
                $arrReturn['tblCategoriesActivation4'] = $this->tblCategoriesActivation4;
                $arrReturn['tblCategoriesActivation4_print'] = $this->tblCategoriesActivation4_print;
                $arrReturn['tblCategoriesActivation5'] = $this->tblCategoriesActivation5;
                $arrReturn['tblCategoriesActivation5_print'] = $this->tblCategoriesActivation5_print;

                $arrReturn['tblCategoriesIdStatus'] = $this->tblCategoriesIdStatus;
                $arrReturn['tblCategoriesIdStatus_print'] = $this->tblCategoriesIdStatus_print;

                $arrReturn['tblCategoriesRestrictedAccess'] = $this->tblCategoriesRestrictedAccess;
                $arrReturn['tblCategoriesRestrictedAccess_print'] = $this->tblCategoriesRestrictedAccess_print;

                $arrReturn['tblCategoriesNotes'] = $this->tblCategoriesNotes;
                $arrReturn['tblCategoriesNotes_edit'] = $this->tblCategoriesNotes_edit;

                $arrReturn['arrIdsCategoriesFiltersGeneric1Binding'] = $this->arrIdsCategoriesFiltersGeneric1Binding;
                $arrReturn['arrCategoriesFiltersGeneric1Binding_print'] = $this->arrCategoriesFiltersGeneric1Binding_print;
            }

            // Debug.
            //echo 'this->resultsCategoryDetails=<pre>';
            //var_dump($this->resultsCategoryDetails);
            //echo '</pre><br />';

            //return ['data' => 'testing recordDetailsGet'];
            //return $arrReturn;
        } catch (\Exception $recordDetailsGetError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('recordDetailsGetError: ' . $recordDetailsGetError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
