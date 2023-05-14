<?php

declare(strict_types=1);

namespace SyncSystemNS;

class ObjectUsersDetails
{
    // Properties.
    // ----------------------
    private float|null $idTbUsers = null;
    private array|null $arrSearchParameters = [];

    private int $terminal = 0; // terminal: 0 - backend | 1 - frontend
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = [];

    private array|null $resultsUsersDetails = null;

    private float|null $tblUsersID = null;
    private float $tblUsersIdParent = 0;
    private float $tblUsersSortOrder = 0;
    private string $tblUsersSortOrder_print = '0';

    private string $tblUsersDateCreation = ''; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string $tblUsersDateTimezone = '';
    private string $tblUsersDateEdit = '';

    private float $tblUsersIdType = 0;
    private string $tblUsersIdType_print = '';

    private string $tblUsersNameTitle = '';
    private string $tblUsersNameFull = '';
    private string $tblUsersNameFirst = '';
    private string $tblUsersNameLast = '';

    private string|null $tblUsersDateBirth = null;
    private string $tblUsersDateBirth_print = '';
    private object|null $tblUsersDateBirthDateObj = null;
    private string|null $tblUsersDateBirthDateYear = null, $tblUsersDateBirthDateDay = null, $tblUsersDateBirthDateMonth = null;
    private string|null $tblUsersDateBirthDateHour = null, $tblUsersDateBirthDateHour_print = '', $tblUsersDateBirthDateMinute = null, $tblUsersDateBirthDateMinute_print = '', $tblUsersDateBirthDateSecond = null, $tblUsersDateBirthDateSecond_print = '';

    private int $tblUsersGender = 0;
    private string $tblUsersGender_print = '';
    private string $tblUsersDocument = '';

    private string $tblUsersAddressStreet = '';
    private string $tblUsersAddressNumber = '';
    private string $tblUsersAddressComplement = '';
    private string $tblUsersNeighborhood = '';
    private string $tblUsersDistrict = '';
    private string $tblUsersCounty = '';
    private string $tblUsersCity = '';
    private string $tblUsersState = '';
    private string $tblUsersCountry = '';
    private string $tblUsersZipCode = '';
    private string $tblUsersZipCode_print = '';

    private string $tblUsersPhone1InternationalCode = '';
    private string $tblUsersPhone1AreaCode = '';
    private string $tblUsersPhone1 = '';
    private string $tblUsersPhone1_print = '';

    private string $tblUsersPhone2InternationalCode = '';
    private string $tblUsersPhone2AreaCode = '';
    private string $tblUsersPhone2 = '';
    private string $tblUsersPhone2_print = '';

    private string $tblUsersPhone3InternationalCode = '';
    private string $tblUsersPhone3AreaCode = '';
    private string $tblUsersPhone3 = '';
    private string $tblUsersPhone3_print = '';

    private string $tblUsersUsername = '';
    private string $tblUsersEmail = '';
    private string $tblUsersPassword = '';
    private string $tblUsersPassword_edit = '';
    private string $tblUsersPasswordHint = '';
    private string $tblUsersPasswordLength = '';

    private string $tblUsersInfo1 = '';
    private string $tblUsersInfo1_edit = '';
    private string $tblUsersInfo2 = '';
    private string $tblUsersInfo2_edit = '';
    private string $tblUsersInfo3 = '';
    private string $tblUsersInfo3_edit = '';
    private string $tblUsersInfo4 = '';
    private string $tblUsersInfo4_edit = '';
    private string $tblUsersInfo5 = '';
    private string $tblUsersInfo5_edit = '';
    private string $tblUsersInfo6 = '';
    private string $tblUsersInfo6_edit = '';
    private string $tblUsersInfo7 = '';
    private string $tblUsersInfo7_edit = '';
    private string $tblUsersInfo8 = '';
    private string $tblUsersInfo8_edit = '';
    private string $tblUsersInfo9 = '';
    private string $tblUsersInfo9_edit = '';
    private string $tblUsersInfo10 = '';
    private string $tblUsersInfo10_edit = '';

    private string $tblUsersImageMain = '';

    private int $tblUsersActivation = 1;
    private string $tblUsersActivation_print = '';
    private int $tblUsersActivation1 = 0;
    private string $tblUsersActivation1_print = '';
    private int $tblUsersActivation2 = 0;
    private string $tblUsersActivation2_print = '';
    private int $tblUsersActivation3 = 0;
    private string $tblUsersActivation3_print = '';
    private int $tblUsersActivation4 = 0;
    private string $tblUsersActivation4_print = '';
    private int $tblUsersActivation5 = 0;
    private string $tblUsersActivation5_print = '';

    private float $tblUsersIdStatus = 0;
    private string $tblUsersIdStatus_print = '';

    private string $tblUsersNotes = '';
    private string $tblUsersNotes_edit = '';

    private string $ofglRecords;

    private array $arrIdsUsersFiltersGeneric1 = [];
    private array $arrIdsUsersFiltersGeneric2 = [];
    private array $arrIdsUsersFiltersGeneric3 = [];
    private array $arrIdsUsersFiltersGeneric4 = [];
    private array $arrIdsUsersFiltersGeneric5 = [];
    private array $arrIdsUsersFiltersGeneric6 = [];
    private array $arrIdsUsersFiltersGeneric7 = [];
    private array $arrIdsUsersFiltersGeneric8 = [];
    private array $arrIdsUsersFiltersGeneric9 = [];
    private array $arrIdsUsersFiltersGeneric10 = [];

    private array|null $arrIdsUsersFiltersGenericBinding;

    private array|null $arrIdsUsersFiltersGeneric1Binding;
    private array|null $arrIdsUsersFiltersGeneric2Binding;
    private array|null $arrIdsUsersFiltersGeneric3Binding;
    private array|null $arrIdsUsersFiltersGeneric4Binding;
    private array|null $arrIdsUsersFiltersGeneric5Binding;
    private array|null $arrIdsUsersFiltersGeneric6Binding;
    private array|null $arrIdsUsersFiltersGeneric7Binding;
    private array|null $arrIdsUsersFiltersGeneric8Binding;
    private array|null $arrIdsUsersFiltersGeneric9Binding;
    private array|null $arrIdsUsersFiltersGeneric10Binding;

    private array|null $arrUsersFiltersGeneric1Binding_print;
    private array|null $arrUsersFiltersGeneric2Binding_print;
    private array|null $arrUsersFiltersGeneric3Binding_print;
    private array|null $arrUsersFiltersGeneric4Binding_print;
    private array|null $arrUsersFiltersGeneric5Binding_print;
    private array|null $arrUsersFiltersGeneric6Binding_print;
    private array|null $arrUsersFiltersGeneric7Binding_print;
    private array|null $arrUsersFiltersGeneric8Binding_print;
    private array|null $arrUsersFiltersGeneric9Binding_print;
    private array|null $arrUsersFiltersGeneric10Binding_print;

    private array $arrIdsUsersFiltersGeneric1BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric2BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric3BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric4BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric5BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric6BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric7BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric8BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric9BindingSelect = [];
    private array $arrIdsUsersFiltersGeneric10BindingSelect = [];
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
        $this->idTbUsers = array_key_exists('_idTbUsers', $arrParameters) && $arrParameters['_idTbUsers'] !== null ? (float) $arrParameters['_idTbUsers'] : $this->idTbUsers;
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) && $arrParameters['_arrSearchParameters'] !== null ? $arrParameters['_arrSearchParameters'] : $this->arrSearchParameters;

        $this->terminal = array_key_exists('_terminal', $arrParameters) && $arrParameters['_terminal'] !== null ? (int) $arrParameters['_terminal'] : $this->terminal;
        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }

        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) && $arrParameters['_arrSpecialParameters'] !== null ? $arrParameters['_arrSpecialParameters'] : $this->arrSpecialParameters;
        // ----------------------
    }
    // **************************************************************************************

    // Get Users details according to search parameters.
    // **************************************************************************************
    /**
     * Get Users details according to search parameters.
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
            $this->resultsUsersDetails = \SyncSystemNS\FunctionsDB::genericTableGet02(
                config('app.gSystemConfig.configSystemDBTableUsers'),
                $this->arrSearchParameters,
                '',
                '',
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableUsers'), 'all', 'string'),
                1,
                $this->arrSpecialParameters
            );

            if ($this->resultsUsersDetails['returnStatus'] === true && isset($this->resultsUsersDetails[0])) {
                $arrReturn['returnStatus'] = true;

                // Define values.
                $this->tblUsersID = $this->resultsUsersDetails[0]->id;
                $this->tblUsersIdParent = $this->resultsUsersDetails[0]->id_parent;

                $this->tblUsersSortOrder = (float) $this->resultsUsersDetails[0]->sort_order;
                $this->tblUsersSortOrder_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblUsersSortOrder, config('app.gSystemConfig.configSystemCurrency'), SS_VALUE_TYPE_DECIMAL);


                $this->tblUsersDateCreation = $this->resultsUsersDetails[0]->date_creation; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
                // $this->tblUsersDateTimezone = $this->resultsUsersDetails[0]->date_timezone;
                $this->tblUsersDateEdit = $this->resultsUsersDetails[0]->date_edit;

                $this->tblUsersIdType = $this->resultsUsersDetails[0]->id_type;
                $this->tblUsersNameTitle = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->name_title, 'db');
                $this->tblUsersNameFull = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->name_full, 'db');
                $this->tblUsersNameFirst = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->name_first, 'db');
                $this->tblUsersNameLast = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->name_last, 'editTextBox=' . config('app.gSystemConfig.configBackendTextBox')); // TODO: condition detect terminal

                $this->tblUsersDateBirth = $this->resultsUsersDetails[0]->date_birth;
                if ($this->tblUsersDateBirth) {
                    $this->tblUsersDateBirthDateObj = new \DateTime($this->tblUsersDateBirth);

                    $this->tblUsersDateBirthDateYear = $this->tblUsersDateBirthDateObj->format('Y');
                    $this->tblUsersDateBirthDateDay = $this->tblUsersDateBirthDateObj->format('d');
                    $this->tblUsersDateBirthDateMonth = $this->tblUsersDateBirthDateObj->format('m');

                    $this->tblUsersDateBirthDateHour = $this->tblUsersDateBirthDateObj->format('H');
                    $this->tblUsersDateBirthDateHour_print = $this->tblUsersDateBirthDateHour;

                    $this->tblUsersDateBirthDateMinute = $this->tblUsersDateBirthDateObj->format('i');
                    $this->tblUsersDateBirthDateMinute_print = $this->tblUsersDateBirthDateMinute;

                    $this->tblUsersDateBirthDateSecond = $this->tblUsersDateBirthDateObj->format('s');
                    $this->tblUsersDateBirthDateSecond_print = $this->tblUsersDateBirthDateSecond;

                    $this->tblUsersDateBirth_print = \SyncSystemNS\FunctionsGeneric::dateRead01($this->tblUsersDateBirth, config('app.gSystemConfig.configBackendDateFormat'), 0, config('app.gSystemConfig.configUsersDateBirthType'));
                }

                $this->tblUsersGender = $this->resultsUsersDetails[0]->gender;
                switch ($this->tblUsersGender) {
                    case 0:
                        $this->tblUsersGender_print = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemGender0');
                        break;
                    case 1:
                        $this->tblUsersGender_print = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemGender1');
                        break;
                    case 2:
                        $this->tblUsersGender_print = \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemGender2');
                        break;
                }
                $this->tblUsersDocument = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->document, 'db');

                $this->tblUsersAddressStreet = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->address_street, 'editTextBox=1');
                $this->tblUsersAddressNumber = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->address_number, 'db');
                $this->tblUsersAddressComplement = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->address_complement, 'db');
                $this->tblUsersNeighborhood = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->neighborhood, 'db');
                $this->tblUsersDistrict = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->district, 'db');
                $this->tblUsersCounty = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->county, 'db');
                $this->tblUsersCity = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->city, 'db');
                $this->tblUsersState = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->state, 'db');
                $this->tblUsersCountry = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->country, 'db');
                $this->tblUsersZipCode = $this->resultsUsersDetails[0]->zip_code; // TODO: Data treatment.
                $this->tblUsersZipCode_print = $this->tblUsersZipCode;

                $this->tblUsersPhone1InternationalCode = $this->resultsUsersDetails[0]->phone1_international_code;
                $this->tblUsersPhone1AreaCode = $this->resultsUsersDetails[0]->phone1_area_code;
                $this->tblUsersPhone1 = $this->resultsUsersDetails[0]->phone1;
                $this->tblUsersPhone1_print = $this->tblUsersPhone1;

                $this->tblUsersPhone2InternationalCode = $this->resultsUsersDetails[0]->phone2_international_code;
                $this->tblUsersPhone2AreaCode = $this->resultsUsersDetails[0]->phone2_area_code;
                $this->tblUsersPhone2 = $this->resultsUsersDetails[0]->phone2;
                $this->tblUsersPhone2_print = $this->tblUsersPhone2;

                $this->tblUsersPhone3InternationalCode = $this->resultsUsersDetails[0]->phone3_international_code;
                $this->tblUsersPhone3AreaCode = $this->resultsUsersDetails[0]->phone3_area_code;
                $this->tblUsersPhone3 = $this->resultsUsersDetails[0]->phone3;
                $this->tblUsersPhone3_print = $this->tblUsersPhone3;

                $this->tblUsersUsername = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->username, 'db');
                $this->tblUsersEmail = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->email, 'db');
                $this->tblUsersPassword = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->password, 'db');
                //$this->tblUsersPassword_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->password, 'db'), SS_ENCRYPT_METHOD_DATA);
                   //TODO: test decryption
                $this->tblUsersPasswordHint = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->password_hint, 'db');
                $this->tblUsersPasswordLength = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->password_length, 'db');

                //TODO: test decryption
                if (config('app.gSystemConfig.enableUsersInfo1') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo1FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo1FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo1 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info1, 'db');
                        $this->tblUsersInfo1_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info1, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo1FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo1FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo1 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info1, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo1_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info1, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo2') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo2FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo2FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo2 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info2, 'db');
                        $this->tblUsersInfo2_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info2, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo2FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo2FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo2 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info2, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo2_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info2, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo3') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo3FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo3FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo3 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info3, 'db');
                        $this->tblUsersInfo3_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info3, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo3FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo3FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo3 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info3, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo3_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info3, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo4') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo4FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo4FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo4 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info4, 'db');
                        $this->tblUsersInfo4_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info4, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo4FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo4FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo4 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info4, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo4_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info4, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo5') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo5FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo5FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo5 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info5, 'db');
                        $this->tblUsersInfo5_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info5, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo5FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo5FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo5 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info5, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo5_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info5, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo6') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo6FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo6FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo6 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info6, 'db');
                        $this->tblUsersInfo6_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info6, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo6FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo6FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo6 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info6, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo6_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info6, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo7') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo7FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo7FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo7 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info7, 'db');
                        $this->tblUsersInfo7_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info7, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo7FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo7FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo7 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info7, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo7_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info7, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo8') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo8FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo8FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo8 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info8, 'db');
                        $this->tblUsersInfo8_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info8, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo8FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo8FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo8 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info8, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo8_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info8, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo9') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo9FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo9FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo9 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info9, 'db');
                        $this->tblUsersInfo9_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info9, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo9FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo9FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo9 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info9, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo9_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info9, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }
                if (config('app.gSystemConfig.enableUsersInfo10') === 1) {
                    if (config('app.gSystemConfig.configUsersInfo10FieldType') === SS_FIELD_TYPE_SINGLE_LINE || config('app.gSystemConfig.configUsersInfo10FieldType') === SS_FIELD_TYPE_MULTILINE) {
                        $this->tblUsersInfo10 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info10, 'db');
                        $this->tblUsersInfo10_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info10, 'db');
                    }

                    // Encrypted.
                    if (config('app.gSystemConfig.configUsersInfo10FieldType') === SS_FIELD_TYPE_SINGLE_LINE_ENCRYPTED || config('app.gSystemConfig.configUsersInfo10FieldType') === SS_FIELD_TYPE_MULTILINE_ENCRYPTED) {
                        $this->tblUsersInfo10 = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info10, 'db'), SS_ENCRYPT_METHOD_DATA);
                        $this->tblUsersInfo10_edit = \SyncSystemNS\FunctionsCrypto::decryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->info10, 'db'), SS_ENCRYPT_METHOD_DATA);
                    }
                }

                $this->tblUsersImageMain = (string)$this->resultsUsersDetails[0]->image_main;

                $this->tblUsersActivation = $this->resultsUsersDetails[0]->activation;
                $this->tblUsersActivation_print = $this->tblUsersActivation === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersActivation1 = $this->resultsUsersDetails[0]->activation1;
                $this->tblUsersActivation1_print = $this->tblUsersActivation1 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersActivation2 = $this->resultsUsersDetails[0]->activation2;
                $this->tblUsersActivation2_print = $this->tblUsersActivation2 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersActivation3 = $this->resultsUsersDetails[0]->activation3;
                $this->tblUsersActivation3_print = $this->tblUsersActivation3 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersActivation4 = $this->resultsUsersDetails[0]->activation4;
                $this->tblUsersActivation4_print = $this->tblUsersActivation4 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersActivation5 = $this->resultsUsersDetails[0]->activation5;
                $this->tblUsersActivation5_print = $this->tblUsersActivation5 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblUsersIdStatus = $this->resultsUsersDetails[0]->id_status;
                $this->tblUsersIdStatus_print = $this->tblUsersIdStatus === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemDropDownSelectNone')
                :
                    \SyncSystemNS\FunctionsGeneric::contentMaskRead(\SyncSystemNS\FunctionsDB::genericFieldGet01($this->tblUsersIdStatus, config('app.gSystemConfig.configSystemDBTableFiltersGeneric'), 'title'), 'db')
                ;

                $this->tblUsersNotes = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->notes, 'db');
                $this->tblUsersNotes_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultsUsersDetails[0]->notes, 'db');

                // Build return array.
                $arrReturn['tblUsersID'] = $this->tblUsersID;
                $arrReturn['tblUsersIdParent'] = $this->tblUsersIdParent;

                $arrReturn['tblUsersSortOrder'] = $this->tblUsersSortOrder;
                $arrReturn['tblUsersSortOrder_print'] = $this->tblUsersSortOrder_print;

                $arrReturn['tblUsersDateCreation'] = $this->tblUsersDateCreation;
                $arrReturn['tblUsersDateTimezone'] = $this->tblUsersDateTimezone;
                $arrReturn['tblUsersDateEdit'] = $this->tblUsersDateEdit;

                $arrReturn['tblUsersIdType'] = $this->tblUsersIdType;
                $arrReturn['tblUsersIdType_print'] = $this->tblUsersIdType_print;

                $arrReturn['tblUsersNameTitle'] = $this->tblUsersNameTitle;
                $arrReturn['tblUsersNameFull'] = $this->tblUsersNameFull;
                $arrReturn['tblUsersNameFirst'] = $this->tblUsersNameFirst;
                $arrReturn['tblUsersNameLast'] = $this->tblUsersNameLast;

                $arrReturn['tblUsersDateBirth'] = $this->tblUsersDateBirth;
                $arrReturn['tblUsersDateBirthDateObj'] = $this->tblUsersDateBirthDateObj;
                $arrReturn['tblUsersDateBirthDateYear'] = $this->tblUsersDateBirthDateYear;
                $arrReturn['tblUsersDateBirthDateDay'] = $this->tblUsersDateBirthDateDay;
                $arrReturn['tblUsersDateBirthDateMonth'] = $this->tblUsersDateBirthDateMonth;
                $arrReturn['tblUsersDateBirthDateHour'] = $this->tblUsersDateBirthDateHour;
                $arrReturn['tblUsersDateBirthDateHour_print'] = $this->tblUsersDateBirthDateHour;
                $arrReturn['tblUsersDateBirthDateMinute'] = $this->tblUsersDateBirthDateMinute;
                $arrReturn['tblUsersDateBirthDateMinute_print'] = $this->tblUsersDateBirthDateMinute;
                $arrReturn['tblUsersDateBirthDateSecond'] = $this->tblUsersDateBirthDateSecond;
                $arrReturn['tblUsersDateBirthDateSecond_print'] = $this->tblUsersDateBirthDateSecond;
                $arrReturn['tblUsersDateBirth_print'] = $this->tblUsersDateBirth_print;

                $arrReturn['tblUsersGender'] = $this->tblUsersGender;
                $arrReturn['tblUsersGender_print'] = $this->tblUsersGender_print;
                $arrReturn['tblUsersDocument'] = $this->tblUsersDocument;

                $arrReturn['tblUsersAddressStreet'] = $this->tblUsersAddressStreet;
                $arrReturn['tblUsersAddressNumber'] = $this->tblUsersAddressNumber;
                $arrReturn['tblUsersAddressComplement'] = $this->tblUsersAddressComplement;
                $arrReturn['tblUsersNeighborhood'] = $this->tblUsersNeighborhood;
                $arrReturn['tblUsersDistrict'] = $this->tblUsersDistrict;
                $arrReturn['tblUsersCounty'] = $this->tblUsersCounty;
                $arrReturn['tblUsersCity'] = $this->tblUsersCity;
                $arrReturn['tblUsersState'] = $this->tblUsersState;
                $arrReturn['tblUsersCountry'] = $this->tblUsersCountry;
                $arrReturn['tblUsersZipCode'] = $this->tblUsersZipCode;
                $arrReturn['tblUsersZipCode_print'] = $this->tblUsersZipCode_print;

                $arrReturn['tblUsersPhone1InternationalCode'] = $this->tblUsersPhone1InternationalCode;
                $arrReturn['tblUsersPhone1AreaCode'] = $this->tblUsersPhone1AreaCode;
                $arrReturn['tblUsersPhone1'] = $this->tblUsersPhone1;
                $arrReturn['tblUsersPhone1_print'] = $this->tblUsersPhone1_print;

                $arrReturn['tblUsersPhone2InternationalCode'] = $this->tblUsersPhone2InternationalCode;
                $arrReturn['tblUsersPhone2AreaCode'] = $this->tblUsersPhone2AreaCode;
                $arrReturn['tblUsersPhone2'] = $this->tblUsersPhone2;
                $arrReturn['tblUsersPhone2_print'] = $this->tblUsersPhone2_print;

                $arrReturn['tblUsersPhone3InternationalCode'] = $this->tblUsersPhone3InternationalCode;
                $arrReturn['tblUsersPhone3AreaCode'] = $this->tblUsersPhone3AreaCode;
                $arrReturn['tblUsersPhone3'] = $this->tblUsersPhone3;
                $arrReturn['tblUsersPhone3_print'] = $this->tblUsersPhone3_print;

                $arrReturn['tblUsersUsername'] = $this->tblUsersUsername;
                $arrReturn['tblUsersEmail'] = $this->tblUsersEmail;
                $arrReturn['tblUsersPassword'] = $this->tblUsersPassword;
                $arrReturn['tblUsersPassword_edit'] = $this->tblUsersPassword_edit;
                $arrReturn['tblUsersPasswordHint'] = $this->tblUsersPasswordHint;
                $arrReturn['tblUsersPasswordLength'] = $this->tblUsersPasswordLength;

                $arrReturn['tblUsersInfo1'] = $this->tblUsersInfo1;
                $arrReturn['tblUsersInfo1_edit'] = $this->tblUsersInfo1_edit;
                $arrReturn['tblUsersInfo2'] = $this->tblUsersInfo2;
                $arrReturn['tblUsersInfo2_edit'] = $this->tblUsersInfo2_edit;
                $arrReturn['tblUsersInfo3'] = $this->tblUsersInfo3;
                $arrReturn['tblUsersInfo3_edit'] = $this->tblUsersInfo3_edit;
                $arrReturn['tblUsersInfo4'] = $this->tblUsersInfo4;
                $arrReturn['tblUsersInfo4_edit'] = $this->tblUsersInfo4_edit;
                $arrReturn['tblUsersInfo5'] = $this->tblUsersInfo5;
                $arrReturn['tblUsersInfo5_edit'] = $this->tblUsersInfo5_edit;
                $arrReturn['tblUsersInfo6'] = $this->tblUsersInfo6;
                $arrReturn['tblUsersInfo6_edit'] = $this->tblUsersInfo6_edit;
                $arrReturn['tblUsersInfo7'] = $this->tblUsersInfo7;
                $arrReturn['tblUsersInfo7_edit'] = $this->tblUsersInfo7_edit;
                $arrReturn['tblUsersInfo8'] = $this->tblUsersInfo8;
                $arrReturn['tblUsersInfo8_edit'] = $this->tblUsersInfo8_edit;
                $arrReturn['tblUsersInfo9'] = $this->tblUsersInfo9;
                $arrReturn['tblUsersInfo9_edit'] = $this->tblUsersInfo9_edit;
                $arrReturn['tblUsersInfo10'] = $this->tblUsersInfo10;
                $arrReturn['tblUsersInfo10_edit'] = $this->tblUsersInfo10_edit;

                $arrReturn['tblUsersImageMain'] = $this->tblUsersImageMain;

                $arrReturn['tblUsersActivation'] = $this->tblUsersActivation;
                $arrReturn['tblUsersActivation_print'] = $this->tblUsersActivation_print;
                $arrReturn['tblUsersActivation1'] = $this->tblUsersActivation1;
                $arrReturn['tblUsersActivation1_print'] = $this->tblUsersActivation1_print;
                $arrReturn['tblUsersActivation2'] = $this->tblUsersActivation2;
                $arrReturn['tblUsersActivation2_print'] = $this->tblUsersActivation2_print;
                $arrReturn['tblUsersActivation3'] = $this->tblUsersActivation3;
                $arrReturn['tblUsersActivation3_print'] = $this->tblUsersActivation3_print;
                $arrReturn['tblUsersActivation4'] = $this->tblUsersActivation4;
                $arrReturn['tblUsersActivation4_print'] = $this->tblUsersActivation4_print;
                $arrReturn['tblUsersActivation5'] = $this->tblUsersActivation5;
                $arrReturn['tblUsersActivation5_print'] = $this->tblUsersActivation5_print;

                $arrReturn['tblUsersIdStatus'] = $this->tblUsersIdStatus;
                $arrReturn['tblUsersIdStatus_print'] = $this->tblUsersIdStatus_print;

                $arrReturn['tblUsersNotes'] = $this->tblUsersNotes;
                $arrReturn['tblUsersNotes_edit'] = $this->tblUsersNotes_edit;
            }
        } catch (\Exception $recordDetailsGet) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('recordDetailsGet: ' . $recordDetailsGet->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
