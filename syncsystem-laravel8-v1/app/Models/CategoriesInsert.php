<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesInsert extends Model
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

    private array $arrSQLCategoriesInsertParams = [];
    private mixed $resultsSQLCategoriesInsert;

    protected $fillable = [
        '_tblCategoriesID',
    ]; // TODO: double check if this will be needed.
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param array $arrParameters
     */
    public function __construct(array $arrParameters = [])
    {
        //parent::__construct($attributes);
        // Debug.
        /*
        echo 'objParameters (inside model)=<pre>';
        var_dump($objParameters);
        echo '</pre><br />';

        echo 'testing (inside model)=<pre>';
        var_dump($testing);
        echo '</pre><br />';

        echo 'attributes=<pre>';
        var_dump($attributes);
        echo '</pre><br />';
        */

        //echo 'xxxyyy';

        //echo 'testing';
        if (count($arrParameters) > 0) {
            if (!$this->buildParameters($arrParameters)['returnStatus'] === true) {
                // Change flag to error.
            }

            // Debug.
            // $this->buildParameters($arrParameters);
        }
        //$this->categoriesInsertBuildParameters($attributes);
    }
    // **************************************************************************************

    // Build parameters to be inserted.
    // **************************************************************************************
    /**
     * Build parameters to be inserted.
     * @param array $arrParameters
     * @return array
     */
    //public function buildParameters(array $arrParameters): array
    //public function categoriesInsertBuildParameters(Request $req): void
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
        // TODO: put inside a try / catch statement (because of the various functions used).
        $this->tblCategoriesID = isset($arrParameters['_tblCategoriesID']) ? $arrParameters['_tblCategoriesID'] : \SyncSystemNS\FunctionsDB::counterUniversalUpdate();
        $this->tblCategoriesIdParent = isset($arrParameters['_tblCategoriesIdParent']) ? $arrParameters['_tblCategoriesIdParent'] : $this->tblCategoriesIdParent;
        $this->tblCategoriesSortOrder = isset($arrParameters['_tblCategoriesSortOrder']) ? $arrParameters['_tblCategoriesSortOrder'] : $this->tblCategoriesSortOrder;
        $this->tblCategoriesCategoryType = isset($arrParameters['_tblCategoriesCategoryType']) ? $arrParameters['_tblCategoriesCategoryType'] : $this->tblCategoriesCategoryType;

        $this->tblCategoriesDateCreation = isset($arrParameters['_tblCategoriesDateCreation']) ? $arrParameters['_tblCategoriesDateCreation'] : $this->tblCategoriesDateCreation;
        if ($this->tblCategoriesDateCreation === '') {
            $tblCategoriesDateCreation_dateObj = new \DateTime();
            $this->tblCategoriesDateCreation = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblCategoriesDateCreation_dateObj);
        }

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
        //$this->arrSQLCategoriesInsertParams['id'] = 123123123;
        //$this->tblCategoriesID ? $this->arrSQLCategoriesInsertParams['id'] = $this->tblCategoriesID : $this->arrSQLCategoriesInsertParams['id'] = \SyncSystemNS\FunctionsDB::counterUniversalUpdate();
        $this->arrSQLCategoriesInsertParams['id'] = $this->tblCategoriesID;
        $this->arrSQLCategoriesInsertParams['id_parent'] = $this->tblCategoriesIdParent;
        $this->arrSQLCategoriesInsertParams['sort_order'] = $this->tblCategoriesSortOrder;
        $this->arrSQLCategoriesInsertParams['category_type'] = $this->tblCategoriesCategoryType;

        $this->arrSQLCategoriesInsertParams['date_creation'] = $this->tblCategoriesDateCreation;
        $this->arrSQLCategoriesInsertParams['date_timezone'] = $this->tblCategoriesDateTimezone;
        $this->arrSQLCategoriesInsertParams['date_edit'] = $this->tblCategoriesDateEdit;

        $this->arrSQLCategoriesInsertParams['id_register_user'] = $this->tblCategoriesIdRegisterUser;
        $this->arrSQLCategoriesInsertParams['id_register1'] = $this->tblCategoriesIdRegister1;
        $this->arrSQLCategoriesInsertParams['id_register2'] = $this->tblCategoriesIdRegister2;
        $this->arrSQLCategoriesInsertParams['id_register3'] = $this->tblCategoriesIdRegister3;
        $this->arrSQLCategoriesInsertParams['id_register4'] = $this->tblCategoriesIdRegister4;
        $this->arrSQLCategoriesInsertParams['id_register5'] = $this->tblCategoriesIdRegister5;

        $this->arrSQLCategoriesInsertParams['title'] = $this->tblCategoriesTitle;
        $this->arrSQLCategoriesInsertParams['description'] = $this->tblCategoriesDescription;

        $this->arrSQLCategoriesInsertParams['url_alias'] = $this->tblCategoriesURLAlias;
        $this->arrSQLCategoriesInsertParams['keywords_tags'] = $this->tblCategoriesKeywordsTags;
        $this->arrSQLCategoriesInsertParams['meta_description'] = $this->tblCategoriesMetaDescription;
        $this->arrSQLCategoriesInsertParams['meta_title'] = $this->tblCategoriesMetaTitle;
        $this->arrSQLCategoriesInsertParams['meta_info'] = $this->tblCategoriesMetaInfo;

        $this->arrSQLCategoriesInsertParams['info1'] = $this->tblCategoriesInfo1;
        $this->arrSQLCategoriesInsertParams['info2'] = $this->tblCategoriesInfo2;
        $this->arrSQLCategoriesInsertParams['info3'] = $this->tblCategoriesInfo3;
        $this->arrSQLCategoriesInsertParams['info4'] = $this->tblCategoriesInfo4;
        $this->arrSQLCategoriesInsertParams['info5'] = $this->tblCategoriesInfo5;
        $this->arrSQLCategoriesInsertParams['info6'] = $this->tblCategoriesInfo6;
        $this->arrSQLCategoriesInsertParams['info7'] = $this->tblCategoriesInfo7;
        $this->arrSQLCategoriesInsertParams['info8'] = $this->tblCategoriesInfo8;
        $this->arrSQLCategoriesInsertParams['info9'] = $this->tblCategoriesInfo9;
        $this->arrSQLCategoriesInsertParams['info10'] = $this->tblCategoriesInfo10;

        $this->arrSQLCategoriesInsertParams['info_small1'] = $this->tblCategoriesInfoSmall1;
        $this->arrSQLCategoriesInsertParams['info_small2'] = $this->tblCategoriesInfoSmall2;
        $this->arrSQLCategoriesInsertParams['info_small3'] = $this->tblCategoriesInfoSmall3;
        $this->arrSQLCategoriesInsertParams['info_small4'] = $this->tblCategoriesInfoSmall4;
        $this->arrSQLCategoriesInsertParams['info_small5'] = $this->tblCategoriesInfoSmall5;

        $this->arrSQLCategoriesInsertParams['number1'] = $this->tblCategoriesNumber1;
        $this->arrSQLCategoriesInsertParams['number2'] = $this->tblCategoriesNumber2;
        $this->arrSQLCategoriesInsertParams['number3'] = $this->tblCategoriesNumber3;
        $this->arrSQLCategoriesInsertParams['number4'] = $this->tblCategoriesNumber4;
        $this->arrSQLCategoriesInsertParams['number5'] = $this->tblCategoriesNumber5;

        $this->arrSQLCategoriesInsertParams['number_small1'] = $this->tblCategoriesNumberSmall1;
        $this->arrSQLCategoriesInsertParams['number_small2'] = $this->tblCategoriesNumberSmall2;
        $this->arrSQLCategoriesInsertParams['number_small3'] = $this->tblCategoriesNumberSmall3;
        $this->arrSQLCategoriesInsertParams['number_small4'] = $this->tblCategoriesNumberSmall4;
        $this->arrSQLCategoriesInsertParams['number_small5'] = $this->tblCategoriesNumberSmall5;

        $this->arrSQLCategoriesInsertParams['date1'] = $this->tblCategoriesDate1;
        $this->arrSQLCategoriesInsertParams['date2'] = $this->tblCategoriesDate2;
        $this->arrSQLCategoriesInsertParams['date3'] = $this->tblCategoriesDate3;
        $this->arrSQLCategoriesInsertParams['date4'] = $this->tblCategoriesDate4;
        $this->arrSQLCategoriesInsertParams['date5'] = $this->tblCategoriesDate5;

        $this->arrSQLCategoriesInsertParams['activation'] = $this->tblCategoriesActivation;
        $this->arrSQLCategoriesInsertParams['activation1'] = $this->tblCategoriesActivation1;
        $this->arrSQLCategoriesInsertParams['activation2'] = $this->tblCategoriesActivation2;
        $this->arrSQLCategoriesInsertParams['activation3'] = $this->tblCategoriesActivation3;
        $this->arrSQLCategoriesInsertParams['activation4'] = $this->tblCategoriesActivation4;
        $this->arrSQLCategoriesInsertParams['activation5'] = $this->tblCategoriesActivation5;

        $this->arrSQLCategoriesInsertParams['id_status'] = $this->tblCategoriesIdStatus;
        $this->arrSQLCategoriesInsertParams['restricted_access'] = $this->tblCategoriesRestrictedAccess;

        $this->arrSQLCategoriesInsertParams['notes'] = $this->tblCategoriesNotes;
        // ----------------------

        $arrReturn = [
            'returnStatus' => true
        ];


        // Debug.
        /*
        echo 'objParameters (inside model)=<pre>';
        var_dump($objParameters);
        echo '</pre><br />';
        */

        //echo 'objParameters (inside model)=<pre>';
        //var_dump($this->tblCategoriesDateCreation);
        //echo '</pre><br />';
        //exit();


        //echo 'xxxyyy';
        /*
        return [
            'testing return' => $arrParameters,
            //'this->arrSQLCategoriesInsertParams' => $this->arrSQLCategoriesInsertParams, // debug
            'tblCategoriesID' => $this->tblCategoriesID,
            'tblCategoriesIdParent' => $this->tblCategoriesIdParent,
            'tblCategoriesSortOrder' => $this->tblCategoriesSortOrder,
            'tblCategoriesCategoryType' => $this->tblCategoriesCategoryType
        ];
        */

        return $arrReturn;
    }
    // **************************************************************************************

    // Add record to database.
    // **************************************************************************************
    /**
     * Add record to database.
     * @return array
     */
    public function addRecord(): array
    {
        // Variables.
        // ----------------------
        $arrReturn = [
            'returnStatus' => false,
            'nRecords' => 0,
            'idRecordInsert' => null
        ];
        // ----------------------

        // Logic.
        try {
            $this->resultsSQLCategoriesInsert = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . config('app.gSystemConfig.configSystemDBTableCategories'));
            $this->resultsSQLCategoriesInsert = $this->resultsSQLCategoriesInsert->insert($this->arrSQLCategoriesInsertParams);

            if ($this->resultsSQLCategoriesInsert === true) {
                // Record filters generic.
                // TODO (OPTIMIZE): make only one insert with multiple records.
                // Store result in variables and check for errors.

                // Filters generic 1 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric1')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric1 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 101,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 2 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric2')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric2 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 102,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 3 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric3')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric3 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 103,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 4 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric4')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric4 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 104,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 5 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric5')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric5 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 105,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 6 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric6')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric6 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 106,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 7 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric7')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric7 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 107,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 8 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric8')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric8 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 108,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 9 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric9')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric9 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 109,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                // Filters generic 10 - record.
                if (config('app.gSystemConfig.enableCategoriesFilterGeneric10')) {
                    foreach ($this->arrIdsCategoriesFiltersGeneric10 as $indexArrFiltersGeneric => $idFiltersGeneric) {
                        \SyncSystemNS\FunctionsDBInsert::filtersGenericBindingInsert([
                            '_tblFiltersGenericBindingID' => '',
                            '_tblFiltersGenericBindingSortOrder' => '',
                            '_tblFiltersGenericBindingDateCreation' => '',
                            '_tblFiltersGenericBindingDateEdit' => '',
                            '_tblFiltersGenericBindingIdFiltersGeneric' => $idFiltersGeneric,
                            '_tblFiltersGenericBindingIdFilterIndex' => 110,
                            '_tblFiltersGenericBindingIdRecord' => $this->tblCategoriesID,
                            '_tblFiltersGenericBindingNotes' => ''
                        ]);
                    }
                }

                $arrReturn = [
                    'returnStatus' => true,
                    'nRecords' => 1,
                    'idRecordInsert' => $this->arrSQLCategoriesInsertParams['id']
                    // 'idRecordInsert' => \SyncSystemNS\FunctionsDB::counterUniversalUpdate()
                ];
            }
        } catch (\Exception $addRecordError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('addRecordError: ' . $addRecordError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
