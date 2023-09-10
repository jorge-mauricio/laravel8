<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesUpdate extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float|null $tblCategoriesID = null;
    private float $tblCategoriesIdParent = 0;
    private float $tblCategoriesSortOrder = 0;
    private int $tblCategoriesCategoryType = 0; // Review: check categories insert to see if 0 is default value

    private string $tblCategoriesDateCreation = '';
    private string $tblCategoriesDateTimezone = '';
    private string $tblCategoriesDateEdit = '';

    private float $tblCategoriesIdRegisterUser = 0;
    private float $tblCategoriesIdRegister1 = 0;
    private float $tblCategoriesIdRegister2 = 0;
    private float $tblCategoriesIdRegister3 = 0;
    private float $tblCategoriesIdRegister4 = 0;
    private float $tblCategoriesIdRegister5 = 0;

    private string $tblCategoriesTitle = '';
    private string $tblCategoriesDescription = '';

    private string $tblCategoriesURLAlias = '';
    private string $tblCategoriesKeywordsTags = '';
    private string $tblCategoriesMetaDescription = '';
    private string $tblCategoriesMetaTitle = '';
    private string $tblCategoriesMetaInfo = '';

    private string $tblCategoriesInfo1 = '';
    private string $tblCategoriesInfo2 = '';
    private string $tblCategoriesInfo3 = '';
    private string $tblCategoriesInfo4 = '';
    private string $tblCategoriesInfo5 = '';
    private string $tblCategoriesInfo6 = '';
    private string $tblCategoriesInfo7 = '';
    private string $tblCategoriesInfo8 = '';
    private string $tblCategoriesInfo9 = '';
    private string $tblCategoriesInfo10 = '';

    private string $tblCategoriesInfoSmall1 = '';
    private string $tblCategoriesInfoSmall2 = '';
    private string $tblCategoriesInfoSmall3 = '';
    private string $tblCategoriesInfoSmall4 = '';
    private string $tblCategoriesInfoSmall5 = '';

    private float $tblCategoriesNumber1 = 0;
    private float $tblCategoriesNumber2 = 0;
    private float $tblCategoriesNumber3 = 0;
    private float $tblCategoriesNumber4 = 0;
    private float $tblCategoriesNumber5 = 0;

    private float $tblCategoriesNumberSmall1 = 0;
    private float $tblCategoriesNumberSmall2 = 0;
    private float $tblCategoriesNumberSmall3 = 0;
    private float $tblCategoriesNumberSmall4 = 0;
    private float $tblCategoriesNumberSmall5 = 0;

    private string|null $tblCategoriesDate1 = null; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string|null $tblCategoriesDate2 = null; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string|null $tblCategoriesDate3 = null; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string|null $tblCategoriesDate4 = null; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd
    private string|null $tblCategoriesDate5 = null; // format: yyyy-mm-dd hh:MM:ss or yyyy-mm-dd

    private int $tblCategoriesActivation = 1;
    private int $tblCategoriesActivation1 = 0;
    private int $tblCategoriesActivation2 = 0;
    private int $tblCategoriesActivation3 = 0;
    private int $tblCategoriesActivation4 = 0;
    private int $tblCategoriesActivation5 = 0;

    private float $tblCategoriesIdStatus = 0;
    private int $tblCategoriesRestrictedAccess = 0;

    private string $tblCategoriesNotes = '';


    private array $arrFiltersGenericSearchParameters = [];
    private \SyncSystemNS\ObjectFiltersGenericListing|null $ofglRecords = null;
    private $ofglRecordsParameters = [];

    private array $resultsCategoriesFiltersGeneric1Listing = [];
    private array $resultsCategoriesFiltersGeneric2Listing = [];
    private array $resultsCategoriesFiltersGeneric3Listing = [];
    private array $resultsCategoriesFiltersGeneric4Listing = [];
    private array $resultsCategoriesFiltersGeneric5Listing = [];
    private array $resultsCategoriesFiltersGeneric6Listing = [];
    private array $resultsCategoriesFiltersGeneric7Listing = [];
    private array $resultsCategoriesFiltersGeneric8Listing = [];
    private array $resultsCategoriesFiltersGeneric9Listing = [];
    private array $resultsCategoriesFiltersGeneric10Listing = [];

    private array|null $arrIdsCategoriesFiltersGenericBinding = null;

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

    private array $arrSQLCategoriesUpdateParams = [];
    private mixed $resultsSQLCategoriesUpdate;

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param array $arrParameters
     */
    public function __construct(array $arrParameters = [])
    {
        if (count($arrParameters) > 0) {
            if (!$this->buildParameters($arrParameters)['returnStatus'] === true) {
                // Change flag to error.
            }
        }
    }
    // **************************************************************************************

    // Build parameters to be inserted.
    // **************************************************************************************
    /**
     * Build parameters to be inserted.
     * @param array $arrParameters
     * @return array
     */
    private function buildParameters(array $arrParameters): array
    {
        // Variables.
        // ----------------------
        $arrReturn = [
            'returnStatus' => false
        ];
        // ----------------------

        // Define values.
        // ----------------------
        // $this->tblCategoriesID = isset($arrParameters['_tblCategoriesID']) ? $arrParameters['_tblCategoriesID'] : \SyncSystemNS\FunctionsDB::counterUniversalUpdate();
        $this->tblCategoriesID = $arrParameters['_tblCategoriesID'];
        $this->tblCategoriesIdParent = isset($arrParameters['_tblCategoriesIdParent']) ? $arrParameters['_tblCategoriesIdParent'] : $this->tblCategoriesIdParent;
        $this->tblCategoriesSortOrder = isset($arrParameters['_tblCategoriesSortOrder']) ? $arrParameters['_tblCategoriesSortOrder'] : $this->tblCategoriesSortOrder;
        $this->tblCategoriesCategoryType = isset($arrParameters['_tblCategoriesCategoryType']) ? $arrParameters['_tblCategoriesCategoryType'] : $this->tblCategoriesCategoryType;

        /*
        $this->tblCategoriesDateCreation = isset($arrParameters['_tblCategoriesDateCreation']) ? $arrParameters['_tblCategoriesDateCreation'] : $this->tblCategoriesDateCreation;
        if ($this->tblCategoriesDateCreation === '') {
            $tblCategoriesDateCreation_dateObj = new \DateTime();
            $this->tblCategoriesDateCreation = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblCategoriesDateCreation_dateObj);
        }
        */

        $this->tblCategoriesDateTimezone = isset($arrParameters['_tblCategoriesDateTimezone']) ? $arrParameters['_tblCategoriesDateTimezone'] : $this->tblCategoriesDateTimezone;

        $this->tblCategoriesDateEdit = isset($arrParameters['_tblCategoriesDateEdit']) ? $arrParameters['_tblCategoriesDateEdit'] : $this->tblCategoriesDateEdit;
        if ($this->tblCategoriesDateEdit === '') {
            $tblCategoriesDateEdit_dateObj = new \DateTime();
            $this->tblCategoriesDateEdit = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblCategoriesDateEdit_dateObj);
        }

        $this->tblCategoriesIdRegisterUser = (isset($arrParameters['_tblCategoriesIdRegisterUser']) && $arrParameters['_tblCategoriesIdRegisterUser'] !== null) ? $arrParameters['_tblCategoriesIdRegisterUser'] : $this->tblCategoriesIdRegisterUser;
        $this->tblCategoriesIdRegister1 = (isset($arrParameters['_tblCategoriesIdRegister1']) && $arrParameters['_tblCategoriesIdRegister1'] !== null) ? $arrParameters['_tblCategoriesIdRegister1'] : $this->tblCategoriesIdRegister1;
        $this->tblCategoriesIdRegister2 = (isset($arrParameters['_tblCategoriesIdRegister2']) && $arrParameters['_tblCategoriesIdRegister2'] !== null) ? $arrParameters['_tblCategoriesIdRegister2'] : $this->tblCategoriesIdRegister2;
        $this->tblCategoriesIdRegister3 = (isset($arrParameters['_tblCategoriesIdRegister3']) && $arrParameters['_tblCategoriesIdRegister3'] !== null) ? $arrParameters['_tblCategoriesIdRegister3'] : $this->tblCategoriesIdRegister3;
        $this->tblCategoriesIdRegister4 = (isset($arrParameters['_tblCategoriesIdRegister4']) && $arrParameters['_tblCategoriesIdRegister4'] !== null) ? $arrParameters['_tblCategoriesIdRegister4'] : $this->tblCategoriesIdRegister4;
        $this->tblCategoriesIdRegister5 = (isset($arrParameters['_tblCategoriesIdRegister5']) && $arrParameters['_tblCategoriesIdRegister5'] !== null) ? $arrParameters['_tblCategoriesIdRegister5'] : $this->tblCategoriesIdRegister5;

        $this->tblCategoriesTitle = isset($arrParameters['_tblCategoriesTitle']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesTitle'], 'db_write_text') : $this->tblCategoriesTitle;
        $this->tblCategoriesDescription = isset($arrParameters['_tblCategoriesDescription']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesDescription'], 'db_write_text') : $this->tblCategoriesDescription;

        $this->tblCategoriesURLAlias = isset($arrParameters['_tblCategoriesURLAlias']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesURLAlias'], 'db_write_text') : $this->tblCategoriesURLAlias;
        $this->tblCategoriesKeywordsTags = isset($arrParameters['_tblCategoriesKeywordsTags']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesKeywordsTags'], 'db_write_text') : $this->tblCategoriesKeywordsTags;
        $this->tblCategoriesMetaDescription = isset($arrParameters['_tblCategoriesMetaDescription']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesMetaDescription'], 'db_write_text') : $this->tblCategoriesMetaDescription;
        $this->tblCategoriesMetaTitle = isset($arrParameters['_tblCategoriesMetaTitle']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesMetaTitle'], 'db_write_text') : $this->tblCategoriesMetaTitle;
        $this->tblCategoriesMetaInfo = isset($arrParameters['_tblCategoriesMetaInfo']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesMetaInfo'], 'db_write_text') : $this->tblCategoriesMetaInfo;

        if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo1FieldType') === 2) {
            $this->tblCategoriesInfo1 = isset($arrParameters['_tblCategoriesInfo1']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo1'], 'db_write_text') : $this->tblCategoriesInfo1;
        }
        if (config('app.gSystemConfig.configCategoriesInfo1FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo1FieldType') === 22) {
            $this->tblCategoriesInfo1 = isset($arrParameters['_tblCategoriesInfo1']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo1'], 'db_write_text'), 2) : $this->tblCategoriesInfo1;
        }

        if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo2FieldType') === 2) {
            $this->tblCategoriesInfo2 = isset($arrParameters['_tblCategoriesInfo2']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo2'], 'db_write_text') : $this->tblCategoriesInfo2;
        }
        if (config('app.gSystemConfig.configCategoriesInfo2FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo2FieldType') === 22) {
            $this->tblCategoriesInfo2 = isset($arrParameters['_tblCategoriesInfo2']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo2'], 'db_write_text'), 2) : $this->tblCategoriesInfo2;
        }

        if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo3FieldType') === 2) {
            $this->tblCategoriesInfo3 = isset($arrParameters['_tblCategoriesInfo3']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo3'], 'db_write_text') : $this->tblCategoriesInfo3;
        }
        if (config('app.gSystemConfig.configCategoriesInfo3FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo3FieldType') === 22) {
            $this->tblCategoriesInfo3 = isset($arrParameters['_tblCategoriesInfo3']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo3'], 'db_write_text'), 2) : $this->tblCategoriesInfo3;
        }

        if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo4FieldType') === 2) {
            $this->tblCategoriesInfo4 = isset($arrParameters['_tblCategoriesInfo4']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo4'], 'db_write_text') : $this->tblCategoriesInfo4;
        }
        if (config('app.gSystemConfig.configCategoriesInfo4FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo4FieldType') === 22) {
            $this->tblCategoriesInfo4 = isset($arrParameters['_tblCategoriesInfo4']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo4'], 'db_write_text'), 2) : $this->tblCategoriesInfo4;
        }

        if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo5FieldType') === 2) {
            $this->tblCategoriesInfo5 = isset($arrParameters['_tblCategoriesInfo5']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo5'], 'db_write_text') : $this->tblCategoriesInfo5;
        }
        if (config('app.gSystemConfig.configCategoriesInfo5FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo5FieldType') === 22) {
            $this->tblCategoriesInfo5 = isset($arrParameters['_tblCategoriesInfo5']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo5'], 'db_write_text'), 2) : $this->tblCategoriesInfo5;
        }

        if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo6FieldType') === 2) {
            $this->tblCategoriesInfo6 = isset($arrParameters['_tblCategoriesInfo6']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo6'], 'db_write_text') : $this->tblCategoriesInfo6;
        }
        if (config('app.gSystemConfig.configCategoriesInfo6FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo6FieldType') === 22) {
            $this->tblCategoriesInfo6 = isset($arrParameters['_tblCategoriesInfo6']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo6'], 'db_write_text'), 2) : $this->tblCategoriesInfo6;
        }

        if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo7FieldType') === 2) {
            $this->tblCategoriesInfo7 = isset($arrParameters['_tblCategoriesInfo7']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo7'], 'db_write_text') : $this->tblCategoriesInfo7;
        }
        if (config('app.gSystemConfig.configCategoriesInfo7FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo7FieldType') === 22) {
            $this->tblCategoriesInfo7 = isset($arrParameters['_tblCategoriesInfo7']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo7'], 'db_write_text'), 2) : $this->tblCategoriesInfo7;
        }

        if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo8FieldType') === 2) {
            $this->tblCategoriesInfo8 = isset($arrParameters['_tblCategoriesInfo8']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo8'], 'db_write_text') : $this->tblCategoriesInfo8;
        }
        if (config('app.gSystemConfig.configCategoriesInfo8FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo8FieldType') === 22) {
            $this->tblCategoriesInfo8 = isset($arrParameters['_tblCategoriesInfo8']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo8'], 'db_write_text'), 2) : $this->tblCategoriesInfo8;
        }

        if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo9FieldType') === 2) {
            $this->tblCategoriesInfo9 = isset($arrParameters['_tblCategoriesInfo9']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo9'], 'db_write_text') : $this->tblCategoriesInfo9;
        }
        if (config('app.gSystemConfig.configCategoriesInfo9FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo9FieldType') === 22) {
            $this->tblCategoriesInfo9 = isset($arrParameters['_tblCategoriesInfo9']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo9'], 'db_write_text'), 2) : $this->tblCategoriesInfo9;
        }

        if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 1 || config('app.gSystemConfig.configCategoriesInfo10FieldType') === 2) {
            $this->tblCategoriesInfo10 = isset($arrParameters['_tblCategoriesInfo10']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo10'], 'db_write_text') : $this->tblCategoriesInfo10;
        }
        if (config('app.gSystemConfig.configCategoriesInfo10FieldType') === 11 || config('app.gSystemConfig.configCategoriesInfo10FieldType') === 22) {
            $this->tblCategoriesInfo10 = isset($arrParameters['_tblCategoriesInfo10']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfo10'], 'db_write_text'), 2) : $this->tblCategoriesInfo10;
        }

        $this->tblCategoriesInfoSmall1 = isset($arrParameters['_tblCategoriesInfoSmall1']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfoSmall1'], 'db_write_text') : $this->tblCategoriesInfoSmall1;
        $this->tblCategoriesInfoSmall2 = isset($arrParameters['_tblCategoriesInfoSmall2']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfoSmall2'], 'db_write_text') : $this->tblCategoriesInfoSmall2;
        $this->tblCategoriesInfoSmall3 = isset($arrParameters['_tblCategoriesInfoSmall3']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfoSmall3'], 'db_write_text') : $this->tblCategoriesInfoSmall3;
        $this->tblCategoriesInfoSmall4 = isset($arrParameters['_tblCategoriesInfoSmall4']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfoSmall4'], 'db_write_text') : $this->tblCategoriesInfoSmall4;
        $this->tblCategoriesInfoSmall5 = isset($arrParameters['_tblCategoriesInfoSmall5']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesInfoSmall5'], 'db_write_text') : $this->tblCategoriesInfoSmall5;

        $this->tblCategoriesNumber1 = (isset($arrParameters['_tblCategoriesNumber1']) && $arrParameters['_tblCategoriesNumber1'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumber1'], config('app.gSystemConfig.configCategoriesNumber1FieldType')) : $this->tblCategoriesNumber1;
        $this->tblCategoriesNumber2 = (isset($arrParameters['_tblCategoriesNumber2']) && $arrParameters['_tblCategoriesNumber2'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumber2'], config('app.gSystemConfig.configCategoriesNumber2FieldType')) : $this->tblCategoriesNumber2;
        $this->tblCategoriesNumber3 = (isset($arrParameters['_tblCategoriesNumber3']) && $arrParameters['_tblCategoriesNumber3'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumber3'], config('app.gSystemConfig.configCategoriesNumber3FieldType')) : $this->tblCategoriesNumber3;
        $this->tblCategoriesNumber4 = (isset($arrParameters['_tblCategoriesNumber4']) && $arrParameters['_tblCategoriesNumber4'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumber4'], config('app.gSystemConfig.configCategoriesNumber4FieldType')) : $this->tblCategoriesNumber4;
        $this->tblCategoriesNumber5 = (isset($arrParameters['_tblCategoriesNumber5']) && $arrParameters['_tblCategoriesNumber5'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumber5'], config('app.gSystemConfig.configCategoriesNumber5FieldType')) : $this->tblCategoriesNumber5;
        //TODO: double check if needs outer parenthesis.

        $this->tblCategoriesNumberSmall1 = (isset($arrParameters['_tblCategoriesNumberSmall1']) && $arrParameters['_tblCategoriesNumberSmall1'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumberSmall1'], config('app.gSystemConfig.configCategoriesNumberS1FieldType')) : $this->tblCategoriesNumberSmall1;
        $this->tblCategoriesNumberSmall2 = (isset($arrParameters['_tblCategoriesNumberSmall2']) && $arrParameters['_tblCategoriesNumberSmall2'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumberSmall2'], config('app.gSystemConfig.configCategoriesNumberS1FieldType')) : $this->tblCategoriesNumberSmall2;
        $this->tblCategoriesNumberSmall3 = (isset($arrParameters['_tblCategoriesNumberSmall3']) && $arrParameters['_tblCategoriesNumberSmall3'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumberSmall3'], config('app.gSystemConfig.configCategoriesNumberS1FieldType')) : $this->tblCategoriesNumberSmall3;
        $this->tblCategoriesNumberSmall4 = (isset($arrParameters['_tblCategoriesNumberSmall4']) && $arrParameters['_tblCategoriesNumberSmall4'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumberSmall4'], config('app.gSystemConfig.configCategoriesNumberS1FieldType')) : $this->tblCategoriesNumberSmall4;
        $this->tblCategoriesNumberSmall5 = (isset($arrParameters['_tblCategoriesNumberSmall5']) && $arrParameters['_tblCategoriesNumberSmall5'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblCategoriesNumberSmall5'], config('app.gSystemConfig.configCategoriesNumberS1FieldType')) : $this->tblCategoriesNumberSmall5;

        $this->tblCategoriesDate1 = (isset($arrParameters['_tblCategoriesDate1']) && $arrParameters['_tblCategoriesDate1']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblCategoriesDate1'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblCategoriesDate1;
        $this->tblCategoriesDate2 = (isset($arrParameters['_tblCategoriesDate2']) && $arrParameters['_tblCategoriesDate2']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblCategoriesDate2'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblCategoriesDate2;
        $this->tblCategoriesDate3 = (isset($arrParameters['_tblCategoriesDate3']) && $arrParameters['_tblCategoriesDate3']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblCategoriesDate3'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblCategoriesDate3;
        $this->tblCategoriesDate4 = (isset($arrParameters['_tblCategoriesDate4']) && $arrParameters['_tblCategoriesDate4']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblCategoriesDate4'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblCategoriesDate4;
        $this->tblCategoriesDate5 = (isset($arrParameters['_tblCategoriesDate5']) && $arrParameters['_tblCategoriesDate5']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblCategoriesDate5'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblCategoriesDate5;

        $this->tblCategoriesActivation = (isset($arrParameters['_tblCategoriesActivation']) && $arrParameters['_tblCategoriesActivation'] !== null) ? $arrParameters['_tblCategoriesActivation'] : $this->tblCategoriesActivation;
        $this->tblCategoriesActivation1 = (isset($arrParameters['_tblCategoriesActivation1']) && $arrParameters['_tblCategoriesActivation1'] !== null) ? $arrParameters['_tblCategoriesActivation1'] : $this->tblCategoriesActivation1;
        $this->tblCategoriesActivation2 = (isset($arrParameters['_tblCategoriesActivation2']) && $arrParameters['_tblCategoriesActivation2'] !== null) ? $arrParameters['_tblCategoriesActivation2'] : $this->tblCategoriesActivation2;
        $this->tblCategoriesActivation3 = (isset($arrParameters['_tblCategoriesActivation3']) && $arrParameters['_tblCategoriesActivation3'] !== null) ? $arrParameters['_tblCategoriesActivation3'] : $this->tblCategoriesActivation3;
        $this->tblCategoriesActivation4 = (isset($arrParameters['_tblCategoriesActivation4']) && $arrParameters['_tblCategoriesActivation4'] !== null) ? $arrParameters['_tblCategoriesActivation4'] : $this->tblCategoriesActivation4;
        $this->tblCategoriesActivation5 = (isset($arrParameters['_tblCategoriesActivation5']) && $arrParameters['_tblCategoriesActivation5'] !== null) ? $arrParameters['_tblCategoriesActivation5'] : $this->tblCategoriesActivation5;

        $this->tblCategoriesIdStatus = (isset($arrParameters['_tblCategoriesIdStatus']) && $arrParameters['_tblCategoriesIdStatus'] !== null) ? $arrParameters['_tblCategoriesIdStatus'] : $this->tblCategoriesIdStatus;
        $this->tblCategoriesRestrictedAccess = (isset($arrParameters['_tblCategoriesRestrictedAccess']) && $arrParameters['_tblCategoriesRestrictedAccess'] !== null) ? $arrParameters['_tblCategoriesRestrictedAccess'] : $this->tblCategoriesRestrictedAccess;

        $this->tblCategoriesNotes = isset($arrParameters['_tblCategoriesNotes']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblCategoriesNotes'], 'db_write_text') : $this->tblCategoriesNotes;

        $this->arrIdsCategoriesFiltersGeneric1 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric1']) && $arrParameters['_arrIdsCategoriesFiltersGeneric1'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric1'] : $this->arrIdsCategoriesFiltersGeneric1;
        $this->arrIdsCategoriesFiltersGeneric2 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric2']) && $arrParameters['_arrIdsCategoriesFiltersGeneric2'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric2'] : $this->arrIdsCategoriesFiltersGeneric2;
        $this->arrIdsCategoriesFiltersGeneric3 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric3']) && $arrParameters['_arrIdsCategoriesFiltersGeneric3'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric3'] : $this->arrIdsCategoriesFiltersGeneric3;
        $this->arrIdsCategoriesFiltersGeneric4 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric4']) && $arrParameters['_arrIdsCategoriesFiltersGeneric4'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric4'] : $this->arrIdsCategoriesFiltersGeneric4;
        $this->arrIdsCategoriesFiltersGeneric5 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric5']) && $arrParameters['_arrIdsCategoriesFiltersGeneric5'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric5'] : $this->arrIdsCategoriesFiltersGeneric5;
        $this->arrIdsCategoriesFiltersGeneric6 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric6']) && $arrParameters['_arrIdsCategoriesFiltersGeneric6'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric6'] : $this->arrIdsCategoriesFiltersGeneric6;
        $this->arrIdsCategoriesFiltersGeneric7 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric7']) && $arrParameters['_arrIdsCategoriesFiltersGeneric7'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric7'] : $this->arrIdsCategoriesFiltersGeneric7;
        $this->arrIdsCategoriesFiltersGeneric8 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric8']) && $arrParameters['_arrIdsCategoriesFiltersGeneric8'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric8'] : $this->arrIdsCategoriesFiltersGeneric8;
        $this->arrIdsCategoriesFiltersGeneric9 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric9']) && $arrParameters['_arrIdsCategoriesFiltersGeneric9'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric9'] : $this->arrIdsCategoriesFiltersGeneric9;
        $this->arrIdsCategoriesFiltersGeneric10 = (isset($arrParameters['_arrIdsCategoriesFiltersGeneric10']) && $arrParameters['_arrIdsCategoriesFiltersGeneric10'] !== null) ? $arrParameters['_arrIdsCategoriesFiltersGeneric10'] : $this->arrIdsCategoriesFiltersGeneric10;
        // ----------------------

        // Build insert parameters.
        // ----------------------
        $this->arrSQLCategoriesUpdateParams['id'] = $this->tblCategoriesID;
        $this->arrSQLCategoriesUpdateParams['id_parent'] = $this->tblCategoriesIdParent;
        $this->arrSQLCategoriesUpdateParams['sort_order'] = $this->tblCategoriesSortOrder;
        $this->arrSQLCategoriesUpdateParams['category_type'] = $this->tblCategoriesCategoryType;

        // $this->arrSQLCategoriesUpdateParams['date_creation'] = $this->tblCategoriesDateCreation;
        $this->arrSQLCategoriesUpdateParams['date_timezone'] = $this->tblCategoriesDateTimezone;
        $this->arrSQLCategoriesUpdateParams['date_edit'] = $this->tblCategoriesDateEdit;

        $this->arrSQLCategoriesUpdateParams['id_register_user'] = $this->tblCategoriesIdRegisterUser;
        $this->arrSQLCategoriesUpdateParams['id_register1'] = $this->tblCategoriesIdRegister1;
        $this->arrSQLCategoriesUpdateParams['id_register2'] = $this->tblCategoriesIdRegister2;
        $this->arrSQLCategoriesUpdateParams['id_register3'] = $this->tblCategoriesIdRegister3;
        $this->arrSQLCategoriesUpdateParams['id_register4'] = $this->tblCategoriesIdRegister4;
        $this->arrSQLCategoriesUpdateParams['id_register5'] = $this->tblCategoriesIdRegister5;

        $this->arrSQLCategoriesUpdateParams['title'] = $this->tblCategoriesTitle;
        $this->arrSQLCategoriesUpdateParams['description'] = $this->tblCategoriesDescription;

        $this->arrSQLCategoriesUpdateParams['url_alias'] = $this->tblCategoriesURLAlias;
        $this->arrSQLCategoriesUpdateParams['keywords_tags'] = $this->tblCategoriesKeywordsTags;
        $this->arrSQLCategoriesUpdateParams['meta_description'] = $this->tblCategoriesMetaDescription;
        $this->arrSQLCategoriesUpdateParams['meta_title'] = $this->tblCategoriesMetaTitle;
        $this->arrSQLCategoriesUpdateParams['meta_info'] = $this->tblCategoriesMetaInfo;

        $this->arrSQLCategoriesUpdateParams['info1'] = $this->tblCategoriesInfo1;
        $this->arrSQLCategoriesUpdateParams['info2'] = $this->tblCategoriesInfo2;
        $this->arrSQLCategoriesUpdateParams['info3'] = $this->tblCategoriesInfo3;
        $this->arrSQLCategoriesUpdateParams['info4'] = $this->tblCategoriesInfo4;
        $this->arrSQLCategoriesUpdateParams['info5'] = $this->tblCategoriesInfo5;
        $this->arrSQLCategoriesUpdateParams['info6'] = $this->tblCategoriesInfo6;
        $this->arrSQLCategoriesUpdateParams['info7'] = $this->tblCategoriesInfo7;
        $this->arrSQLCategoriesUpdateParams['info8'] = $this->tblCategoriesInfo8;
        $this->arrSQLCategoriesUpdateParams['info9'] = $this->tblCategoriesInfo9;
        $this->arrSQLCategoriesUpdateParams['info10'] = $this->tblCategoriesInfo10;

        $this->arrSQLCategoriesUpdateParams['info_small1'] = $this->tblCategoriesInfoSmall1;
        $this->arrSQLCategoriesUpdateParams['info_small2'] = $this->tblCategoriesInfoSmall2;
        $this->arrSQLCategoriesUpdateParams['info_small3'] = $this->tblCategoriesInfoSmall3;
        $this->arrSQLCategoriesUpdateParams['info_small4'] = $this->tblCategoriesInfoSmall4;
        $this->arrSQLCategoriesUpdateParams['info_small5'] = $this->tblCategoriesInfoSmall5;

        $this->arrSQLCategoriesUpdateParams['number1'] = $this->tblCategoriesNumber1;
        $this->arrSQLCategoriesUpdateParams['number2'] = $this->tblCategoriesNumber2;
        $this->arrSQLCategoriesUpdateParams['number3'] = $this->tblCategoriesNumber3;
        $this->arrSQLCategoriesUpdateParams['number4'] = $this->tblCategoriesNumber4;
        $this->arrSQLCategoriesUpdateParams['number5'] = $this->tblCategoriesNumber5;

        $this->arrSQLCategoriesUpdateParams['number_small1'] = $this->tblCategoriesNumberSmall1;
        $this->arrSQLCategoriesUpdateParams['number_small2'] = $this->tblCategoriesNumberSmall2;
        $this->arrSQLCategoriesUpdateParams['number_small3'] = $this->tblCategoriesNumberSmall3;
        $this->arrSQLCategoriesUpdateParams['number_small4'] = $this->tblCategoriesNumberSmall4;
        $this->arrSQLCategoriesUpdateParams['number_small5'] = $this->tblCategoriesNumberSmall5;

        $this->arrSQLCategoriesUpdateParams['date1'] = $this->tblCategoriesDate1;
        $this->arrSQLCategoriesUpdateParams['date2'] = $this->tblCategoriesDate2;
        $this->arrSQLCategoriesUpdateParams['date3'] = $this->tblCategoriesDate3;
        $this->arrSQLCategoriesUpdateParams['date4'] = $this->tblCategoriesDate4;
        $this->arrSQLCategoriesUpdateParams['date5'] = $this->tblCategoriesDate5;

        $this->arrSQLCategoriesUpdateParams['activation'] = $this->tblCategoriesActivation;
        $this->arrSQLCategoriesUpdateParams['activation1'] = $this->tblCategoriesActivation1;
        $this->arrSQLCategoriesUpdateParams['activation2'] = $this->tblCategoriesActivation2;
        $this->arrSQLCategoriesUpdateParams['activation3'] = $this->tblCategoriesActivation3;
        $this->arrSQLCategoriesUpdateParams['activation4'] = $this->tblCategoriesActivation4;
        $this->arrSQLCategoriesUpdateParams['activation5'] = $this->tblCategoriesActivation5;

        $this->arrSQLCategoriesUpdateParams['id_status'] = $this->tblCategoriesIdStatus;
        $this->arrSQLCategoriesUpdateParams['restricted_access'] = $this->tblCategoriesRestrictedAccess;

        $this->arrSQLCategoriesUpdateParams['notes'] = $this->tblCategoriesNotes;
        // ----------------------

        $arrReturn = [
            'returnStatus' => true
        ];

        return $arrReturn;
    }
    // **************************************************************************************

    // Update record to database.
    // **************************************************************************************
    /**
     * Update record to database.
     * @return array
     */
    public function updateRecord(): array
    {
        // Variables.
        // ----------------------
        $arrReturn = [
            'returnStatus' => false,
            'nRecords' => 0,
            'idRecordUpdate' => null
        ];
        // ----------------------

        // Logic.
        try {
            $this->resultsSQLCategoriesUpdate = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . config('app.gSystemConfig.configSystemDBTableCategories'));
            $this->resultsSQLCategoriesUpdate = $this->resultsSQLCategoriesUpdate->where('id', '=', \SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $this->arrSQLCategoriesUpdateParams['id'], 'db_sanitize'));
            $this->resultsSQLCategoriesUpdate = $this->resultsSQLCategoriesUpdate->update($this->arrSQLCategoriesUpdateParams);

            // Debug.
            /*
            echo 'this->resultsSQLCategoriesUpdate=<pre>';
            var_dump($this->resultsSQLCategoriesUpdate);
            echo '</pre><br />';
            */
            // exit();

            // if ($this->resultsSQLCategoriesUpdate === true) {
            if ($this->resultsSQLCategoriesUpdate > 0) {
                // Parameters build - listing.
                array_push($this->arrFiltersGenericSearchParameters, 'table_name;' . config('app.gSystemConfig.configSystemDBTableCategories') . ';s'); // debug: categories
                $this->ofglRecordsParameters = [
                    '_arrSearchParameters' => $this->arrFiltersGenericSearchParameters,
                    '_configSortOrder' => config('app.gSystemConfig.configFiltersGenericSort'),
                    '_strNRecords' => '',
                    '_arrSpecialParameters' => [
                        'returnType' => 1,
                        //'pageNumber' => $this->pageNumber,
                        //'pagingNRecords' => $this->pagingNRecords
                    ],
                ];

                // Object build.
                $this->ofglRecords = new \SyncSystemNS\ObjectFiltersGenericListing($this->ofglRecordsParameters);
                $resultsFiltersGenericListing = $this->ofglRecords->recordsListingGet(0, 1);

                if (isset($resultsFiltersGenericListing['returnStatus']) && $resultsFiltersGenericListing['returnStatus'] === true) {
                    // Strip arrays that has string as keys.
                    $resultsFiltersGenericListing = array_filter($resultsFiltersGenericListing, function ($value, $key) {
                        return !is_string($key);
                    }, ARRAY_FILTER_USE_BOTH);
                    $resultsFiltersGenericListing = json_decode(json_encode($resultsFiltersGenericListing), true); // Force converting to array.

                    // Bindings search.
                    $this->arrIdsCategoriesFiltersGenericBinding = \SyncSystemNS\FunctionsDB::genericTableGet02(
                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                        ['id_record;' . $this->tblCategoriesID . ';i'], // TODO: swap for $this->tblCategoriesID (and sync with other versions).
                        '',
                        '',
                        \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'), 'all', 'string'),
                        1,
                        ['returnType' => 1]
                    );
                    // Strip arrays that has string as keys.
                    $this->arrIdsCategoriesFiltersGenericBinding = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($value, $key) {
                        return !is_string($key);
                    }, ARRAY_FILTER_USE_BOTH);
                    $this->arrIdsCategoriesFiltersGenericBinding = json_decode(json_encode($this->arrIdsCategoriesFiltersGenericBinding), true); // Force converting to array.

                    // Filter results according to filter_index.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') !== 0) {
                        $this->resultsCategoriesFiltersGeneric1Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 101;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric1Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric1Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') !== 0) {
                        $this->resultsCategoriesFiltersGeneric2Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 102;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric2Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric2Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') !== 0) {
                        $this->resultsCategoriesFiltersGeneric3Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 103;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric3Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric3Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') !== 0) {
                        $this->resultsCategoriesFiltersGeneric4Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 104;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric4Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric4Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') !== 0) {
                        $this->resultsCategoriesFiltersGeneric5Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 105;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric5Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric5Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') !== 0) {
                        $this->resultsCategoriesFiltersGeneric6Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 106;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric6Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric6Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') !== 0) {
                        $this->resultsCategoriesFiltersGeneric7Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 107;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric7Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric7Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') !== 0) {
                        $this->resultsCategoriesFiltersGeneric8Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 108;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric8Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric8Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') !== 0) {
                        $this->resultsCategoriesFiltersGeneric9Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 109;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric9Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric9Listing), true); // Force converting to array.

                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') !== 0) {
                        $this->resultsCategoriesFiltersGeneric10Listing = array_filter($resultsFiltersGenericListing, function ($arr) {
                            return $arr['filter_index'] === 110;
                        });
                    }
                    // $this->resultsCategoriesFiltersGeneric10Listing = json_decode(json_encode($this->resultsCategoriesFiltersGeneric10Listing), true); // Force converting to array.

                    // Filters generic 1 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric1') !== 0) {
                        //if (count($this->arrIdsCategoriesFiltersGeneric1)) { // Maybe delete this check.
                        // foreach ($this->arrIdsCategoriesFiltersGeneric1 as $indexFiltersGeneric => $idFiltersGeneric) {
                        foreach ($this->resultsCategoriesFiltersGeneric1Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            //$categoriesFiltersGenericCheck = array_search($item['id'], $this->arrIdsCategoriesFiltersGeneric1)
                            // $categoriesFiltersGenericCheck = in_array($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1);
                            // categoriesFiltersGenericCheck = objIdsCategoriesFiltersGenericBinding.filter((obj) => {
                            //     return obj.id_filters_generic == resultsCategoriesFiltersGeneric1Listing[countArray].id.toString() && obj.id_filter_index == 101;
                            // });
                            // $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                // Debug.
                                // \SyncSystemNS\FunctionsLog::logLaravel('arr=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($arr);
                                // \SyncSystemNS\FunctionsLog::logLaravel('id_filters_generic=' . $arr['id_filters_generic']); // offset error
                                // \SyncSystemNS\FunctionsLog::logLaravel('id_filter_index' . $arr['id_filter_index']);
                                // \SyncSystemNS\FunctionsLog::logLaravel('itemFiltersGeneric=' . $itemFiltersGeneric['id']);

                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 101);
                            });
                            // Debug.
                            // \SyncSystemNS\FunctionsLog::logLaravel('categoriesFiltersGenericCheck=');
                            // \SyncSystemNS\FunctionsLog::logLaravel($categoriesFiltersGenericCheck);

                            // if ($categoriesFiltersGenericCheck) {
                            if (count($categoriesFiltersGenericCheck)) {
                                // Debug.
                                // \SyncSystemNS\FunctionsLog::logLaravel('itemFiltersGeneric=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($itemFiltersGeneric['id']);

                                // \SyncSystemNS\FunctionsLog::logLaravel('this->arrIdsCategoriesFiltersGeneric1=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($this->arrIdsCategoriesFiltersGeneric1);

                                // \SyncSystemNS\FunctionsLog::logLaravel('array_search=');
                                // \SyncSystemNS\FunctionsLog::logLaravel(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1));
                                // \SyncSystemNS\FunctionsLog::logLaravel('array_search (condition)=');
                                // \SyncSystemNS\FunctionsLog::logLaravel(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1) !== false);
                                // \SyncSystemNS\FunctionsLog::logLaravel('is_numeric (condition)=');
                                // \SyncSystemNS\FunctionsLog::logLaravel(is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1)));
                                // \SyncSystemNS\FunctionsLog::logLaravel('END OF LOOP');

                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1) !== false) {
                                // if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1))) {
                                    // check if selected filters has registered bindings
                                    // Update record with additional information or leave as it is.
                                    // TODO: update.
                                    //if (count($categoriesFiltersGenericCheck)) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                    //}
                                } else {
                                    // if (count($categoriesFiltersGenericCheck)) {
                                        \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                            config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                            ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                        );
                                    // }
                                }

                                // Debug.
                                // \SyncSystemNS\FunctionsLog::logLaravel('flagCategoriesFiltersGenericInsert=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($flagCategoriesFiltersGenericInsert);


                                // $categoriesFiltersGenericCheckKeyMatch = array_search($itemFiltersGeneric['id'], array_column($categoriesFiltersGenericCheck, 'id_filters_generic'));
                                //     // Not outputing the correct array key.

                                // // Debug.
                                // \SyncSystemNS\FunctionsLog::logLaravel('itemFiltersGeneric=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($itemFiltersGeneric['id']);

                                // \SyncSystemNS\FunctionsLog::logLaravel('array_column(categoriesFiltersGenericCheck=');
                                // \SyncSystemNS\FunctionsLog::logLaravel(array_column($categoriesFiltersGenericCheck, 'id_filters_generic'));

                                // \SyncSystemNS\FunctionsLog::logLaravel('categoriesFiltersGenericCheckKeyMatch=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($categoriesFiltersGenericCheckKeyMatch);
                                // //exit();

                                // // if ($categoriesFiltersGenericCheckKeyMatch !== false) {
                                // if ($categoriesFiltersGenericCheckKeyMatch !== null) {
                                //     if (in_array($categoriesFiltersGenericCheck[$categoriesFiltersGenericCheckKeyMatch]['id_filters_generic'], $this->arrIdsCategoriesFiltersGeneric1)) {
                                //         // check if selected filters has registered bindings
                                //         // Update record with additional information or leave as it is.
                                //         // TODO: update.
                                //         $flagCategoriesFiltersGenericInsert === false;
                                //     } else {
                                //         \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                //             config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                //             ['id;' . $categoriesFiltersGenericCheck[$categoriesFiltersGenericCheckKeyMatch]['id'] . ';i']
                                //         );
                                //     }
                                // }

                                // // Debug.
                                // \SyncSystemNS\FunctionsLog::logLaravel('flagCategoriesFiltersGenericInsert=');
                                // \SyncSystemNS\FunctionsLog::logLaravel($flagCategoriesFiltersGenericInsert);

                                // if (in_array($categoriesFiltersGenericCheck[0]['id_filters_generic'], $this->arrIdsCategoriesFiltersGeneric1) === true) {
                                //     // check if selected filters has registered bindings
                                //     // Update record with additional information or leave as it is.
                                //     // TODO: update.
                                //     $flagCategoriesFiltersGenericInsert === false; // Error causing problem in logic.
                                //     $flagCategoriesFiltersGenericInsert = false; // Correct statement.
                                // } else {
                                //     \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                //         config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                //         ['id;' . $categoriesFiltersGenericCheck[0]['id'] . ';i']
                                //     );
                                // }
                            // } else {
                            //     \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                            //         config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                            //         ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                            //     );
                            }
                            // Debug.
                            // \SyncSystemNS\FunctionsLog::logLaravel('flagCategoriesFiltersGenericInsert=');
                            // \SyncSystemNS\FunctionsLog::logLaravel($flagCategoriesFiltersGenericInsert);

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric1))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 101,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                        //}
                    }

                    // Filters generic 2 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric2') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric2Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 102);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric2) !== false) {
                                //if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric2))) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric2))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 102,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 3 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric3') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric3Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 103);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric3) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric3))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 103,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 4 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric4') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric4Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 104);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric4) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric4))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 104,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 5 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric5') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric5Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 105);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric5) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric5))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 105,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 6 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric6') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric6Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 106);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric6) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric6))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 106,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 7 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric7') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric7Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 107);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric7) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric7))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 107,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 8 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric8') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric8Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 108);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric8) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric8))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 108,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 9 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric9') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric9Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 109);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric9) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric9))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 109,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }

                    // Filters generic 10 - update.
                    if (config('app.gSystemConfig.enableCategoriesFilterGeneric10') !== 0) {
                        foreach ($this->resultsCategoriesFiltersGeneric10Listing as $indexFiltersGeneric => $itemFiltersGeneric) {
                            // Variables.
                            $categoriesFiltersGenericCheck = null;
                            $flagCategoriesFiltersGenericInsert = true;

                            // Check records already selected.
                            $categoriesFiltersGenericCheck = array_filter($this->arrIdsCategoriesFiltersGenericBinding, function ($arr) use ($itemFiltersGeneric) {
                                return ($arr['id_filters_generic'] === $itemFiltersGeneric['id'] && $arr['id_filter_index'] === 104);
                            });

                            if (count($categoriesFiltersGenericCheck)) {
                                if (array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric10) !== false) {
                                        $flagCategoriesFiltersGenericInsert = false;
                                } else {
                                    \SyncSystemNS\FunctionsDBDelete::deleteRecordsGeneric10(
                                        config('app.gSystemConfig.configSystemDBTableFiltersGenericBinding'),
                                        ['id;' . $categoriesFiltersGenericCheck[array_key_first($categoriesFiltersGenericCheck)]['id'] . ';i']
                                    );
                                }
                            }

                            // Insert new binding.
                            if (is_numeric(array_search($itemFiltersGeneric['id'], $this->arrIdsCategoriesFiltersGeneric10))) {
                                if ($flagCategoriesFiltersGenericInsert === true) {
                                    \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                                        '_tblFiltersGenericBindingID' => '',
                                        '_tblFiltersGenericBindingSortOrder' => '',
                                        '_tblFiltersGenericBindingDateCreation' => '',
                                        '_tblFiltersGenericBindingDateEdit' => '',
                                        '_tblFiltersGenericBindingIdFiltersGeneric' => $itemFiltersGeneric['id'],
                                        '_tblFiltersGenericBindingIdFilterIndex' => 104,
                                        '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                                        '_tblFiltersGenericBindingNotes' => ''
                                    ]);
                                }
                            }
                        }
                    }
                }

                $arrReturn = [
                    // 'debug' => [
                    //     'resultsFiltersGenericListing' => $resultsFiltersGenericListing,
                    //     'resultsCategoriesFiltersGeneric1Listing' => $this->resultsCategoriesFiltersGeneric1Listing
                    // ],
                    'returnStatus' => true,
                    // 'nRecords' => 1,
                    'nRecords' => $this->resultsSQLCategoriesUpdate,
                    'idRecordUpdate' => $this->arrSQLCategoriesUpdateParams['id']
                ];
            }
        } catch (\Exception $updateRecordError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('updateRecordError: ' . $updateRecordError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
