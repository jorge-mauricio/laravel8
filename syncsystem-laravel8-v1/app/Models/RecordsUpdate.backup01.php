<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecordsUpdate extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private string $strTable = '';
    private float|null $idRecord = null;
    private string $strField = '';
    private string|null $recordValue = null;
    private string $patchType = ''; // setValue | toggleValue | fileDelete
    private bool $ajaxFunction = false; // true - using ajax | false - not using ajax (using redirection)
    private string $apiKey = ''; // TODO: double check if this is necessary

    //private array $arrSQLCategoriesInsertParams = [];
    private mixed $resultsSQLRecordsUpdate;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(array $arrParameters = [])
    {
        // Debug.
        //var_dump($req->all());
        //var_dump($req);
        //echo '</pre><br />';
        
        if (count($arrParameters) > 0) {
            if (!$this->buildParameters($arrParameters)['returnStatus'] === true) {
                // Change flag to error.
            }
            
            // Debug.
            // $this->buildParameters($arrParameters);
        }
    }
    // **************************************************************************************

    // Build parameters to be inserted.
    // **************************************************************************************
    private function buildParameters(array $arrParameters): array
    {
        // Variables.
        $arrReturn = [
            'returnStatus' => false
        ];

        // Build update parameters.
        $this->strTable = isset($arrParameters['_strTable']) ? $arrParameters['_strTable'] : $this->strTable;
        $this->idRecord = isset($arrParameters['_idRecord']) ? $arrParameters['_idRecord'] : $this->idRecord;
        $this->strField = isset($arrParameters['_strField']) ? $arrParameters['_strField'] : $this->strField;
        $this->recordValue = isset($arrParameters['_recordValue']) ? $arrParameters['_recordValue'] : $this->recordValue;
        $this->patchType = isset($arrParameters['_patchType']) ? $arrParameters['_patchType'] : $this->patchType;
        $this->ajaxFunction = isset($arrParameters['_ajaxFunction']) ? $arrParameters['_ajaxFunction'] : $this->ajaxFunction;
        $this->apiKey = isset($arrParameters['_apiKey']) ? $arrParameters['_apiKey'] : $this->apiKey;

        $arrReturn = [
            'returnStatus' => true
        ];

        return $arrReturn;
    }
    // **************************************************************************************

    // Update record in database.
    // **************************************************************************************
    public function updateRecord(): array
    {
        // Variables.
        $arrReturn = [
            'returnStatus' => false,
            'nRecords' => 0
        ];


        // Debug.
        $arrReturn = [
            'strTable' => $this->strTable,
            'idRecord' => $this->idRecord,
            'strField' => $this->strField,
            'recordValue' => $this->recordValue,
            'patchType' => $this->patchType,
            'ajaxFunction' => $this->ajaxFunction,
            'apiKey' => $this->strTable
        ];

        return $arrReturn;
    }
    // **************************************************************************************
}
