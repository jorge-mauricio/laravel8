<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesDetails extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float $idTbCategories = 0;
    private array|null $arrSearchParameters = null;

    private int $terminal = 0; // terminal: 0 - admin | 1 - frontend
    
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = null;

    private array|null $resultsCategoryDetails = null; // TODO: double check - it may be mixed.
    private array|null $ocdRecordParameters = null;

    protected mixed $objCategoriesDetails = null; // TODO: double check - it may be mixed.
    protected array|null $arrCategoriesListing = null;

    /*
    private float|null $tblCategoriesID = null;
    private float|null $tblCategoriesIdParent = 0;
    private float|null $tblCategoriesSortOrder = 0;
    private float|null $tblCategoriesSortOrder_print = 0;
    private int|null $tblCategoriesCategoryType = 0; // Review: check categories insert to see if 0 is default value

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
    */
    /*
    $tblCategoriesDate1 = null;
    $tblCategoriesDate1_print = '';
    $tblCategoriesDate1DateObj = new Date();
    $tblCategoriesDate1DateYear, $tblCategoriesDate1DateDay, $tblCategoriesDate1DateMonth;
    $tblCategoriesDate1DateHour, $tblCategoriesDate1DateHour_print, $tblCategoriesDate1DateMinute, $tblCategoriesDate1DateMinute_print, $tblCategoriesDate1DateSecond, $tblCategoriesDate1DateSecond_print;

    $tblCategoriesDate2 = null;
    $tblCategoriesDate2_print = '';
    $tblCategoriesDate2DateObj = new Date();
    $tblCategoriesDate2DateYear, $tblCategoriesDate2DateDay, $tblCategoriesDate2DateMonth;
    $tblCategoriesDate2DateHour, $tblCategoriesDate2DateHour_print, $tblCategoriesDate2DateMinute, $tblCategoriesDate2DateMinute_print, $tblCategoriesDate2DateSecond, $tblCategoriesDate2DateSecond_print;

    $tblCategoriesDate3 = null;
    $tblCategoriesDate3_print = '';
    $tblCategoriesDate3DateObj = new Date();
    $tblCategoriesDate3DateYear, $tblCategoriesDate3DateDay, $tblCategoriesDate3DateMonth;
    $tblCategoriesDate3DateHour, $tblCategoriesDate3DateHour_print, $tblCategoriesDate3DateMinute, $tblCategoriesDate3DateMinute_print, $tblCategoriesDate3DateSecond, $tblCategoriesDate3DateSecond_print;

    $tblCategoriesDate4 = null;
    $tblCategoriesDate4_print = '';
    $tblCategoriesDate4DateObj = new Date();
    $tblCategoriesDate4DateYear, $tblCategoriesDate4DateDay, $tblCategoriesDate4DateMonth;
    $tblCategoriesDate4DateHour, $tblCategoriesDate4DateHour_print, $tblCategoriesDate4DateMinute, $tblCategoriesDate4DateMinute_print, $tblCategoriesDate4DateSecond, $tblCategoriesDate4DateSecond_print;

    $tblCategoriesDate5 = null;
    $tblCategoriesDate5_print = '';
    $tblCategoriesDate5DateObj = new Date();
    $tblCategoriesDate5DateYear, $tblCategoriesDate5DateDay, $tblCategoriesDate5DateMonth;
    $tblCategoriesDate5DateHour, $tblCategoriesDate5DateHour_print, $tblCategoriesDate5DateMinute, $tblCategoriesDate5DateMinute_print, $tblCategoriesDate5DateSecond, $tblCategoriesDate5DateSecond_print;
    */
    /*
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

    private float $tblCategoriesRestrictedAccess = 0;
    private string $tblCategoriesRestrictedAccess_print = '';

    private string $tblCategoriesNotes = '';
    private string $tblCategoriesNotes_edit = '';

    private array|null $ofglRecords = null; // TODO: double check if is mixed.

    private array|null $arrIdsCategoriesFiltersGeneric1 = []; // TODO: either = null or change to private array
    private array|null $arrIdsCategoriesFiltersGeneric2 = [];
    private array|null $arrIdsCategoriesFiltersGeneric3 = [];
    private array|null $arrIdsCategoriesFiltersGeneric4 = [];
    private array|null $arrIdsCategoriesFiltersGeneric5 = [];
    private array|null $arrIdsCategoriesFiltersGeneric6 = [];
    private array|null $arrIdsCategoriesFiltersGeneric7 = [];
    private array|null $arrIdsCategoriesFiltersGeneric8 = [];
    private array|null $arrIdsCategoriesFiltersGeneric9 = [];
    private array|null $arrIdsCategoriesFiltersGeneric10 = [];

    private array|null $objIdsCategoriesFiltersGenericBinding;

    private array|null $objIdsCategoriesFiltersGeneric1Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric2Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric3Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric4Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric5Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric6Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric7Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric8Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric9Binding = null;
    private array|null $objIdsCategoriesFiltersGeneric10Binding = null;

    private string $objCategoriesFiltersGeneric1Binding_print = '';
    private string $objCategoriesFiltersGeneric2Binding_print = '';
    private string $objCategoriesFiltersGeneric3Binding_print = '';
    private string $objCategoriesFiltersGeneric4Binding_print = '';
    private string $objCategoriesFiltersGeneric5Binding_print = '';
    private string $objCategoriesFiltersGeneric6Binding_print = '';
    private string $objCategoriesFiltersGeneric7Binding_print = '';
    private string $objCategoriesFiltersGeneric8Binding_print = '';
    private string $objCategoriesFiltersGeneric9Binding_print = '';
    private string $objCategoriesFiltersGeneric10Binding_print = '';

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
    */
    // ----------------------

    
    // Constructor.
    // TODO: include $terminal as constructor parameter (or some other method).
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $_ocdRecordParameters
     */
    public function __construct(?array $_ocdRecordParameters = null)
    {
        if ($_ocdRecordParameters !== null) {
            $this->ocdRecordParameters = $_ocdRecordParameters;
        }

        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }
    }
    // **************************************************************************************

    // Build content placeholder body.
    // TODO: eveluate changing name to build().
    // **************************************************************************************
    /**
     * Build content placeholder body.
     * @return array
     */
    public function cphBodyBuild(): array
    {
        // Variables.
        // ----------------------
        $arrReturn = ['returnStatus' => false];
        // ----------------------

        // Logic.
        try {
            // Build object - details.
            if ($this->ocdRecordParameters !== null) {
                $ocdRecord = new \SyncSystemNS\ObjectCategoriesDetails($this->ocdRecordParameters);
                $arrReturn['ocdRecord'] = $ocdRecord->recordDetailsGet(0, 1);
            }
        } catch (Error $cphBodyBuildError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('cphBodyBuildError: ' . $cphBodyBuildError->message());
            }
        } finally {

        }
        
        //return 'content inside model: ' . $this->_idParent; // debug.
        return $arrReturn;
    }
    // **************************************************************************************
    
}
