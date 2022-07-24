<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesInsert extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    /**/
    private float|null $tblCategoriesID = null;
    private float $tblCategoriesIdParent = 0;
    private float $tblCategoriesSortOrder = 0;
    private float $tblCategoriesCategoryType = 0; // Review: check categories insert to see if 0 is default value

    private array $arrSQLCategoriesInsertParams = [];
    private mixed $resultsSQLCategoriesInsert;
    
    protected $fillable = [
        '_tblCategoriesID',
    ]; // TODO: double check if this will be needed.
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(array $attributes  = [])
    //public function __construct()
    {
        parent::__construct($attributes);
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
        //$this->categoriesInsertBuildParameters($objParameters);
        //$this->categoriesInsertBuildParameters($attributes);
        
    }
    // **************************************************************************************

    // Build parameters to be inserted.
    // **************************************************************************************
    /**/
    public function buildParameters(array $arrParameters): array
    //public function categoriesInsertBuildParameters(Request $req): void
    {
        // Define values.
        $this->tblCategoriesID = $arrParameters['_tblCategoriesID'];
        $this->tblCategoriesIdParent = $arrParameters['_tblCategoriesIdParent'];
        $this->tblCategoriesSortOrder = $arrParameters['_tblCategoriesSortOrder'];
        $this->tblCategoriesCategoryType = $arrParameters['_tblCategoriesCategoryType'];

        // Build insert parameters.
        $this->arrSQLCategoriesInsertParams['id'] = 123123123;
        $this->arrSQLCategoriesInsertParams['id_parent'] = $this->tblCategoriesIdParent;
        $this->arrSQLCategoriesInsertParams['sort_order'] = $this->tblCategoriesSortOrder;
        $this->arrSQLCategoriesInsertParams['category_type'] = $this->tblCategoriesCategoryType;

        // Debug.
        /*
        echo 'objParameters (inside model)=<pre>';
        var_dump($objParameters);
        echo '</pre><br />';
        */

        //echo 'xxxyyy';

        return [
            'testing return' => $arrParameters,
            'tblCategoriesID' => $this->tblCategoriesID,
            'tblCategoriesIdParent' => $this->tblCategoriesIdParent,
            'tblCategoriesSortOrder' => $this->tblCategoriesSortOrder,
            'tblCategoriesCategoryType' => $this->tblCategoriesCategoryType
        ];
        
    }
    // **************************************************************************************

    // Add record to database.
    // **************************************************************************************
    public function addRecord(): array
    {
        // Variables.
        $arrReturn = [
            'returnStatus' => false, 
            'nRecords' => 0, 
            'idRecordInsert' => null
        ];

        // Logic.
        try {
            //$this->resultsSQLCategoriesInsert = DB::table(env('CONFIG_SYSTEM_DB_TABLE_PREFIX') . $GLOBALS['configSystemDBTableCategories']);

            //$this->resultsSQLCategoriesInsert = $resultsSQLCategoriesInsert->insert($this->arrSQLCategoriesInsertParams);
            //$arrReturn['resultsSQLCategoriesInsert'] = $this->resultsSQLCategoriesInsert;

            //if ($resultsSQLCategoriesInsert === true) {
                $arrReturn = [
                    'returnStatus' => true, 
                    'nRecords' => $this->tblCategoriesID, 
                    //'idRecordInsert' => null
                    'idRecordInsert' => \SyncSystemNS\FunctionsDB::counterUniversalUpdate()
                ];
            //}
        } catch (Error $addRecordError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('addRecordError: ' . $addRecordError->message());
            }
        } finally {

        }

        return $arrReturn;
    }
    // **************************************************************************************

}
