<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersUpdate extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float|null $tblUsersID = null;
    private float $tblUsersIdParent = 0;
    private float $tblUsersSortOrder = 0;

    private string $tblUsersDateCreation = '';
    private string $tblUsersDateTimezone = '';
    private string $tblUsersDateEdit = '';

    private int $tblUsersIdType = 0;
    private string $tblUsersNameTitle = '';
    private string $tblUsersNameFull = '';
    private string $tblUsersNameFirst = '';
    private string $tblUsersNameLast = '';

    private string|null $tblUsersDateBirth = null;
    /*
      tblUsersDateBirthHour = '',
      tblUsersDateBirthMinute = '',
      tblUsersDateBirthSeconds = '',
      tblUsersDateBirthDay = '',
      tblUsersDateBirthMonth = '',
      tblUsersDateBirthYear = '';
    */
    private int $tblUsersGender = 0;
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

    private string $tblUsersPhone1InternationalCode = '';
    private string $tblUsersPhone1AreaCode = '';
    private string $tblUsersPhone1 = '';

    private string $tblUsersPhone2InternationalCode = '';
    private string $tblUsersPhone2AreaCode = '';
    private string $tblUsersPhone2 = '';

    private string $tblUsersPhone3InternationalCode = '';
    private string $tblUsersPhone3AreaCode = '';
    private string $tblUsersPhone3 = '';

    private string $tblUsersUsername = '';
    private string $tblUsersEmail = '';
    private string $tblUsersPassword = '';
    private string $tblUsersPasswordHint = '';
    private string $tblUsersPasswordLength = '';

    private string $tblUsersInfo1 = '';
    private string $tblUsersInfo2 = '';
    private string $tblUsersInfo3 = '';
    private string $tblUsersInfo4 = '';
    private string $tblUsersInfo5 = '';
    private string $tblUsersInfo6 = '';
    private string $tblUsersInfo7 = '';
    private string $tblUsersInfo8 = '';
    private string $tblUsersInfo9 = '';
    private string $tblUsersInfo10 = '';

    private string $tblUsersImageMain = '';

    private int $tblUsersActivation = 1;
    private int $tblUsersActivation1 = 0;
    private int $tblUsersActivation2 = 0;
    private int $tblUsersActivation3 = 0;
    private int $tblUsersActivation4 = 0;
    private int $tblUsersActivation5 = 0;

    private float $tblUsersIdStatus = 0;
    private string $tblUsersNotes = '';

    private array $arrSQLUsersUpdateParams = [];
    private mixed $resultsSQLUsersUpdate;
    // ----------------------

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
        $this->tblUsersID = $arrParameters['_tblUsersID'];
        $this->tblUsersIdParent = isset($arrParameters['_tblUsersIdParent']) ? $arrParameters['_tblUsersIdParent'] : $this->tblUsersIdParent;
        $this->tblUsersSortOrder = isset($arrParameters['_tblUsersSortOrder']) ? $arrParameters['_tblUsersSortOrder'] : $this->tblUsersSortOrder;

        /*
        $this->tblUsersDateCreation = isset($arrParameters['_tblUsersDateCreation']) ? $arrParameters['_tblUsersDateCreation'] : $this->tblUsersDateCreation;
        if ($this->tblUsersDateCreation === '') {
            $tblUsersDateCreation_dateObj = new \DateTime();
            $this->tblUsersDateCreation = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblUsersDateCreation_dateObj);
        }
        */

        $this->tblUsersDateTimezone = isset($arrParameters['_tblUsersDateTimezone']) ? $arrParameters['_tblUsersDateTimezone'] : $this->tblUsersDateTimezone;

        $this->tblUsersDateEdit = isset($arrParameters['_tblUsersDateEdit']) ? $arrParameters['_tblUsersDateEdit'] : $this->tblUsersDateEdit;
        if ($this->tblUsersDateEdit === '') {
            $tblUsersDateEdit_dateObj = new \DateTime();
            $this->tblUsersDateEdit = \SyncSystemNS\FunctionsGeneric::dateSQLWrite($tblUsersDateEdit_dateObj);
        }

        $this->tblUsersIdType = isset($arrParameters['_tblUsersIdType']) ? $arrParameters['_tblUsersIdType'] : $this->tblUsersIdType;

        $this->tblUsersNameTitle = isset($arrParameters['_tblUsersNameTitle']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNameTitle'], 'db_write_text') : $this->tblUsersNameTitle;
        $this->tblUsersNameFull = isset($arrParameters['_tblUsersNameFull']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNameFull'], 'db_write_text') : $this->tblUsersNameFull;
        $this->tblUsersNameFirst = isset($arrParameters['_tblUsersNameFirst']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNameFirst'], 'db_write_text') : $this->tblUsersNameFirst;
        $this->tblUsersNameLast = isset($arrParameters['_tblUsersNameLast']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNameLast'], 'db_write_text') : $this->tblUsersNameLast;

        $this->tblUsersDateBirth = (isset($arrParameters['_tblUsersDateBirth']) && $arrParameters['_tblUsersDateBirth']) ? \SyncSystemNS\FunctionsGeneric::dateSQLWrite($arrParameters['_tblUsersDateBirth'], config('app.gSystemConfig.configBackendDateFormat')) : $this->tblUsersDateBirth;
        $this->tblUsersGender = isset($arrParameters['_tblUsersGender']) ? $arrParameters['_tblUsersGender'] : $this->tblUsersGender;
        $this->tblUsersDocument = isset($arrParameters['_tblUsersDocument']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersDocument'], 'db_write_text') : $this->tblUsersDocument;

        $this->tblUsersAddressStreet = isset($arrParameters['_tblUsersAddressStreet']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersAddressStreet'], 'db_write_text') : $this->tblUsersAddressStreet;
        $this->tblUsersAddressNumber = isset($arrParameters['_tblUsersAddressNumber']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersAddressNumber'], 'db_write_text') : $this->tblUsersAddressNumber;
        $this->tblUsersAddressComplement = isset($arrParameters['_tblUsersAddressComplement']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersAddressComplement'], 'db_write_text') : $this->tblUsersAddressComplement;
        $this->tblUsersNeighborhood = isset($arrParameters['_tblUsersNeighborhood']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNeighborhood'], 'db_write_text') : $this->tblUsersNeighborhood;
        $this->tblUsersDistrict = isset($arrParameters['_tblUsersDistrict']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersDistrict'], 'db_write_text') : $this->tblUsersDistrict;
        $this->tblUsersCounty = isset($arrParameters['_tblUsersCounty']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersCounty'], 'db_write_text') : $this->tblUsersCounty;
        $this->tblUsersCity = isset($arrParameters['_tblUsersCity']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersCity'], 'db_write_text') : $this->tblUsersCity;
        $this->tblUsersState = isset($arrParameters['_tblUsersState']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersState'], 'db_write_text') : $this->tblUsersState;
        $this->tblUsersCountry = isset($arrParameters['_tblUsersCountry']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersCountry'], 'db_write_text') : $this->tblUsersCountry;
        $this->tblUsersZipCode = isset($arrParameters['_tblUsersZipCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersZipCode'], 'db_write_text') : $this->tblUsersZipCode;

        $this->tblUsersPhone1InternationalCode = isset($arrParameters['_tblUsersPhone1InternationalCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone1InternationalCode'], 'db_write_text') : $this->tblUsersPhone1InternationalCode;
        $this->tblUsersPhone1AreaCode = isset($arrParameters['_tblUsersPhone1AreaCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone1AreaCode'], 'db_write_text') : $this->tblUsersPhone1AreaCode;
        $this->tblUsersPhone1 = isset($arrParameters['_tblUsersPhone1']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone1'], 'db_write_text') : $this->tblUsersPhone1;

        $this->tblUsersPhone2InternationalCode = isset($arrParameters['_tblUsersPhone2InternationalCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone2InternationalCode'], 'db_write_text') : $this->tblUsersPhone2InternationalCode;
        $this->tblUsersPhone2AreaCode = isset($arrParameters['_tblUsersPhone2AreaCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone2AreaCode'], 'db_write_text') : $this->tblUsersPhone2AreaCode;
        $this->tblUsersPhone2 = isset($arrParameters['_tblUsersPhone2']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone2'], 'db_write_text') : $this->tblUsersPhone2;

        $this->tblUsersPhone3InternationalCode = isset($arrParameters['_tblUsersPhone3InternationalCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone3InternationalCode'], 'db_write_text') : $this->tblUsersPhone3InternationalCode;
        $this->tblUsersPhone3AreaCode = isset($arrParameters['_tblUsersPhone3AreaCode']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone3AreaCode'], 'db_write_text') : $this->tblUsersPhone3AreaCode;
        $this->tblUsersPhone3 = isset($arrParameters['_tblUsersPhone3']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPhone3'], 'db_write_text') : $this->tblUsersPhone3;

        $this->tblUsersUsername = isset($arrParameters['_tblUsersUsername']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersUsername'], 'db_write_text') : $this->tblUsersUsername;
        $this->tblUsersEmail = isset($arrParameters['_tblUsersEmail']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersEmail'], 'db_write_text') : $this->tblUsersEmail;
        $this->tblUsersPassword = isset($arrParameters['_tblUsersPassword']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPassword'], 'db_write_text'), 2) : $this->tblUsersPassword;
            // TODO: replace with constant.
        $this->tblUsersPasswordHint = isset($arrParameters['_tblUsersPasswordHint']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPasswordHint'], 'db_write_text') : $this->tblUsersPasswordHint;
        $this->tblUsersPasswordLength = isset($arrParameters['_tblUsersPasswordLength']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersPasswordLength'], 'db_write_text') : $this->tblUsersPasswordLength;

        if (config('app.gSystemConfig.configUsersInfo1FieldType') === 1 || config('app.gSystemConfig.configUsersInfo1FieldType') === 2) {
            $this->tblUsersInfo1 = isset($arrParameters['_tblUsersInfo1']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo1'], 'db_write_text') : $this->tblUsersInfo1;
        }
        if (config('app.gSystemConfig.configUsersInfo1FieldType') === 11 || config('app.gSystemConfig.configUsersInfo1FieldType') === 22) {
            $this->tblUsersInfo1 = isset($arrParameters['_tblUsersInfo1']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo1'], 'db_write_text'), 2) : $this->tblUsersInfo1;
        }

        if (config('app.gSystemConfig.configUsersInfo2FieldType') === 1 || config('app.gSystemConfig.configUsersInfo2FieldType') === 2) {
            $this->tblUsersInfo2 = isset($arrParameters['_tblUsersInfo2']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo2'], 'db_write_text') : $this->tblUsersInfo2;
        }
        if (config('app.gSystemConfig.configUsersInfo2FieldType') === 11 || config('app.gSystemConfig.configUsersInfo2FieldType') === 22) {
            $this->tblUsersInfo2 = isset($arrParameters['_tblUsersInfo2']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo2'], 'db_write_text'), 2) : $this->tblUsersInfo2;
        }

        if (config('app.gSystemConfig.configUsersInfo3FieldType') === 1 || config('app.gSystemConfig.configUsersInfo3FieldType') === 2) {
            $this->tblUsersInfo3 = isset($arrParameters['_tblUsersInfo3']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo3'], 'db_write_text') : $this->tblUsersInfo3;
        }
        if (config('app.gSystemConfig.configUsersInfo3FieldType') === 11 || config('app.gSystemConfig.configUsersInfo3FieldType') === 22) {
            $this->tblUsersInfo3 = isset($arrParameters['_tblUsersInfo3']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo3'], 'db_write_text'), 2) : $this->tblUsersInfo3;
        }

        if (config('app.gSystemConfig.configUsersInfo4FieldType') === 1 || config('app.gSystemConfig.configUsersInfo4FieldType') === 2) {
            $this->tblUsersInfo4 = isset($arrParameters['_tblUsersInfo4']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo4'], 'db_write_text') : $this->tblUsersInfo4;
        }
        if (config('app.gSystemConfig.configUsersInfo4FieldType') === 11 || config('app.gSystemConfig.configUsersInfo4FieldType') === 22) {
            $this->tblUsersInfo4 = isset($arrParameters['_tblUsersInfo4']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo4'], 'db_write_text'), 2) : $this->tblUsersInfo4;
        }

        if (config('app.gSystemConfig.configUsersInfo5FieldType') === 1 || config('app.gSystemConfig.configUsersInfo5FieldType') === 2) {
            $this->tblUsersInfo5 = isset($arrParameters['_tblUsersInfo5']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo5'], 'db_write_text') : $this->tblUsersInfo5;
        }
        if (config('app.gSystemConfig.configUsersInfo5FieldType') === 11 || config('app.gSystemConfig.configUsersInfo5FieldType') === 22) {
            $this->tblUsersInfo5 = isset($arrParameters['_tblUsersInfo5']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo5'], 'db_write_text'), 2) : $this->tblUsersInfo5;
        }

        if (config('app.gSystemConfig.configUsersInfo6FieldType') === 1 || config('app.gSystemConfig.configUsersInfo6FieldType') === 2) {
            $this->tblUsersInfo6 = isset($arrParameters['_tblUsersInfo6']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo6'], 'db_write_text') : $this->tblUsersInfo6;
        }
        if (config('app.gSystemConfig.configUsersInfo6FieldType') === 11 || config('app.gSystemConfig.configUsersInfo6FieldType') === 22) {
            $this->tblUsersInfo6 = isset($arrParameters['_tblUsersInfo6']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo6'], 'db_write_text'), 2) : $this->tblUsersInfo6;
        }

        if (config('app.gSystemConfig.configUsersInfo7FieldType') === 1 || config('app.gSystemConfig.configUsersInfo7FieldType') === 2) {
            $this->tblUsersInfo7 = isset($arrParameters['_tblUsersInfo7']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo7'], 'db_write_text') : $this->tblUsersInfo7;
        }
        if (config('app.gSystemConfig.configUsersInfo7FieldType') === 11 || config('app.gSystemConfig.configUsersInfo7FieldType') === 22) {
            $this->tblUsersInfo7 = isset($arrParameters['_tblUsersInfo7']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo7'], 'db_write_text'), 2) : $this->tblUsersInfo7;
        }

        if (config('app.gSystemConfig.configUsersInfo8FieldType') === 1 || config('app.gSystemConfig.configUsersInfo8FieldType') === 2) {
            $this->tblUsersInfo8 = isset($arrParameters['_tblUsersInfo8']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo8'], 'db_write_text') : $this->tblUsersInfo8;
        }
        if (config('app.gSystemConfig.configUsersInfo8FieldType') === 11 || config('app.gSystemConfig.configUsersInfo8FieldType') === 22) {
            $this->tblUsersInfo8 = isset($arrParameters['_tblUsersInfo8']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo8'], 'db_write_text'), 2) : $this->tblUsersInfo8;
        }

        if (config('app.gSystemConfig.configUsersInfo9FieldType') === 1 || config('app.gSystemConfig.configUsersInfo9FieldType') === 2) {
            $this->tblUsersInfo9 = isset($arrParameters['_tblUsersInfo9']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo9'], 'db_write_text') : $this->tblUsersInfo9;
        }
        if (config('app.gSystemConfig.configUsersInfo9FieldType') === 11 || config('app.gSystemConfig.configUsersInfo9FieldType') === 22) {
            $this->tblUsersInfo9 = isset($arrParameters['_tblUsersInfo9']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo9'], 'db_write_text'), 2) : $this->tblUsersInfo9;
        }

        if (config('app.gSystemConfig.configUsersInfo10FieldType') === 1 || config('app.gSystemConfig.configUsersInfo10FieldType') === 2) {
            $this->tblUsersInfo10 = isset($arrParameters['_tblUsersInfo10']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo10'], 'db_write_text') : $this->tblUsersInfo10;
        }
        if (config('app.gSystemConfig.configUsersInfo10FieldType') === 11 || config('app.gSystemConfig.configUsersInfo10FieldType') === 22) {
            $this->tblUsersInfo10 = isset($arrParameters['_tblUsersInfo10']) ? \SyncSystemNS\FunctionsCrypto::encryptValue(\SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersInfo10'], 'db_write_text'), 2) : $this->tblUsersInfo10;
        }

        $this->tblUsersActivation = (isset($arrParameters['_tblUsersActivation']) && $arrParameters['_tblUsersActivation'] !== null) ? $arrParameters['_tblUsersActivation'] : $this->tblUsersActivation;
        $this->tblUsersActivation1 = (isset($arrParameters['_tblUsersActivation1']) && $arrParameters['_tblUsersActivation1'] !== null) ? $arrParameters['_tblUsersActivation1'] : $this->tblUsersActivation1;
        $this->tblUsersActivation2 = (isset($arrParameters['_tblUsersActivation2']) && $arrParameters['_tblUsersActivation2'] !== null) ? $arrParameters['_tblUsersActivation2'] : $this->tblUsersActivation2;
        $this->tblUsersActivation3 = (isset($arrParameters['_tblUsersActivation3']) && $arrParameters['_tblUsersActivation3'] !== null) ? $arrParameters['_tblUsersActivation3'] : $this->tblUsersActivation3;
        $this->tblUsersActivation4 = (isset($arrParameters['_tblUsersActivation4']) && $arrParameters['_tblUsersActivation4'] !== null) ? $arrParameters['_tblUsersActivation4'] : $this->tblUsersActivation4;
        $this->tblUsersActivation5 = (isset($arrParameters['_tblUsersActivation5']) && $arrParameters['_tblUsersActivation5'] !== null) ? $arrParameters['_tblUsersActivation5'] : $this->tblUsersActivation5;

        $this->tblUsersIdStatus = (isset($arrParameters['_tblUsersIdStatus']) && $arrParameters['_tblUsersIdStatus'] !== null) ? $arrParameters['_tblUsersIdStatus'] : $this->tblUsersIdStatus;
        $this->tblUsersNotes = isset($arrParameters['_tblUsersNotes']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblUsersNotes'], 'db_write_text') : $this->tblUsersNotes;
        // ----------------------

        // Build insert parameters.
        // ----------------------
        $this->arrSQLUsersUpdateParams['id'] = $this->tblUsersID;
        $this->arrSQLUsersUpdateParams['id_parent'] = $this->tblUsersIdParent;
        $this->arrSQLUsersUpdateParams['sort_order'] = $this->tblUsersSortOrder;

        // $this->arrSQLUsersUpdateParams['date_creation'] = $this->tblUsersDateCreation;
        $this->arrSQLUsersUpdateParams['date_timezone'] = $this->tblUsersDateTimezone;
        $this->arrSQLUsersUpdateParams['date_edit'] = $this->tblUsersDateEdit;

        $this->arrSQLUsersUpdateParams['id_type'] = $this->tblUsersIdType;
        $this->arrSQLUsersUpdateParams['name_title'] = $this->tblUsersNameTitle;
        $this->arrSQLUsersUpdateParams['name_full'] = $this->tblUsersNameFull;
        $this->arrSQLUsersUpdateParams['name_first'] = $this->tblUsersNameFirst;
        $this->arrSQLUsersUpdateParams['name_last'] = $this->tblUsersNameLast;

        $this->arrSQLUsersUpdateParams['date_birth'] = $this->tblUsersDateBirth;
        $this->arrSQLUsersUpdateParams['gender'] = $this->tblUsersGender;
        $this->arrSQLUsersUpdateParams['document'] = $this->tblUsersDocument;

        $this->arrSQLUsersUpdateParams['address_street'] = $this->tblUsersAddressStreet;
        $this->arrSQLUsersUpdateParams['address_number'] = $this->tblUsersAddressNumber;
        $this->arrSQLUsersUpdateParams['address_complement'] = $this->tblUsersAddressComplement;
        $this->arrSQLUsersUpdateParams['neighborhood'] = $this->tblUsersNeighborhood;
        $this->arrSQLUsersUpdateParams['district'] = $this->tblUsersDistrict;
        $this->arrSQLUsersUpdateParams['county'] = $this->tblUsersCounty;
        $this->arrSQLUsersUpdateParams['city'] = $this->tblUsersCity;
        $this->arrSQLUsersUpdateParams['state'] = $this->tblUsersState;
        $this->arrSQLUsersUpdateParams['country'] = $this->tblUsersCountry;
        $this->arrSQLUsersUpdateParams['zip_code'] = $this->tblUsersZipCode;

        $this->arrSQLUsersUpdateParams['phone1_international_code'] = $this->tblUsersPhone1InternationalCode;
        $this->arrSQLUsersUpdateParams['phone1_area_code'] = $this->tblUsersPhone1AreaCode;
        $this->arrSQLUsersUpdateParams['phone1'] = $this->tblUsersPhone1;

        $this->arrSQLUsersUpdateParams['phone2_international_code'] = $this->tblUsersPhone2InternationalCode;
        $this->arrSQLUsersUpdateParams['phone2_area_code'] = $this->tblUsersPhone2AreaCode;
        $this->arrSQLUsersUpdateParams['phone2'] = $this->tblUsersPhone2;

        $this->arrSQLUsersUpdateParams['phone3_international_code'] = $this->tblUsersPhone3InternationalCode;
        $this->arrSQLUsersUpdateParams['phone3_area_code'] = $this->tblUsersPhone3AreaCode;
        $this->arrSQLUsersUpdateParams['phone3'] = $this->tblUsersPhone3;

        $this->arrSQLUsersUpdateParams['username'] = $this->tblUsersUsername;
        $this->arrSQLUsersUpdateParams['email'] = $this->tblUsersEmail;
        $this->arrSQLUsersUpdateParams['password'] = $this->tblUsersPassword;
        $this->arrSQLUsersUpdateParams['password_hint'] = $this->tblUsersPasswordHint;
        $this->arrSQLUsersUpdateParams['password_length'] = $this->tblUsersPasswordLength;

        $this->arrSQLUsersUpdateParams['info1'] = $this->tblUsersInfo1;
        $this->arrSQLUsersUpdateParams['info2'] = $this->tblUsersInfo2;
        $this->arrSQLUsersUpdateParams['info3'] = $this->tblUsersInfo3;
        $this->arrSQLUsersUpdateParams['info4'] = $this->tblUsersInfo4;
        $this->arrSQLUsersUpdateParams['info5'] = $this->tblUsersInfo5;
        $this->arrSQLUsersUpdateParams['info6'] = $this->tblUsersInfo6;
        $this->arrSQLUsersUpdateParams['info7'] = $this->tblUsersInfo7;
        $this->arrSQLUsersUpdateParams['info8'] = $this->tblUsersInfo8;
        $this->arrSQLUsersUpdateParams['info9'] = $this->tblUsersInfo9;
        $this->arrSQLUsersUpdateParams['info10'] = $this->tblUsersInfo10;

        $this->arrSQLUsersUpdateParams['image_main'] = $this->tblUsersImageMain;
        $this->arrSQLUsersUpdateParams['activation'] = $this->tblUsersActivation;
        $this->arrSQLUsersUpdateParams['activation1'] = $this->tblUsersActivation1;
        $this->arrSQLUsersUpdateParams['activation2'] = $this->tblUsersActivation2;
        $this->arrSQLUsersUpdateParams['activation3'] = $this->tblUsersActivation3;
        $this->arrSQLUsersUpdateParams['activation4'] = $this->tblUsersActivation4;
        $this->arrSQLUsersUpdateParams['activation5'] = $this->tblUsersActivation5;

        $this->arrSQLUsersUpdateParams['id_status'] = $this->tblUsersIdStatus;
        $this->arrSQLUsersUpdateParams['notes'] = $this->tblUsersNotes;
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
            $this->resultsSQLUsersUpdate = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . config('app.gSystemConfig.configSystemDBTableUsers'));
            $this->resultsSQLUsersUpdate = $this->resultsSQLUsersUpdate->where('id', '=', \SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $this->arrSQLUsersUpdateParams['id'], 'db_sanitize'));
            $this->resultsSQLUsersUpdate = $this->resultsSQLUsersUpdate->update($this->arrSQLUsersUpdateParams);

            // Debug.
            /*
            echo 'this->resultsSQLUsersUpdate=<pre>';
            var_dump($this->resultsSQLUsersUpdate);
            echo '</pre><br />';
            */
            // exit();

            // if ($this->resultsSQLUsersUpdate === true) {
            if ($this->resultsSQLUsersUpdate > 0) {
                $arrReturn = [
                    'returnStatus' => true,
                    // 'nRecords' => 1,
                    'nRecords' => $this->resultsSQLUsersUpdate,
                    'idRecordUpdate' => $this->arrSQLUsersUpdateParams['id']
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
