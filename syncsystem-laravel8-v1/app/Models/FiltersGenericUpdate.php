<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FiltersGenericUpdate extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float|null $tblFiltersGenericID = null;
    private float $tblFiltersGenericSortOrder = 0;

    private int $tblFiltersGenericFilterIndex = 0;
    private string $tblFiltersGenericTableName = '';

    private string $tblFiltersGenericTitle = '';
    private string $tblFiltersGenericDescription = '';

    private string $tblFiltersGenericURLAlias = '';
    private string $tblFiltersGenericKeywordsTags = '';
    private string $tblFiltersGenericMetaDescription = '';
    private string $tblFiltersGenericMetaTitle = '';
    // private string $tblFiltersGenericMetaInfo = '';

    private string $tblFiltersGenericInfoSmall1 = '';
    private string $tblFiltersGenericInfoSmall2 = '';
    private string $tblFiltersGenericInfoSmall3 = '';
    private string $tblFiltersGenericInfoSmall4 = '';
    private string $tblFiltersGenericInfoSmall5 = '';

    private float $tblFiltersGenericNumberSmall1 = 0;
    private float $tblFiltersGenericNumberSmall2 = 0;
    private float $tblFiltersGenericNumberSmall3 = 0;
    private float $tblFiltersGenericNumberSmall4 = 0;
    private float $tblFiltersGenericNumberSmall5 = 0;

    private int $tblFiltersGenericActivation = 1;
    private int $tblFiltersGenericActivation1 = 0;
    private int $tblFiltersGenericActivation2 = 0;
    private int $tblFiltersGenericActivation3 = 0;
    private int $tblFiltersGenericActivation4 = 0;
    private int $tblFiltersGenericActivation5 = 0;

    private string $tblFiltersGenericNotes = '';

    private array $arrSQLFiltersGenericUpdateParams = [];
    private mixed $resultsSQLFiltersGenericUpdate;

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
        // $this->tblFiltersGenericID = isset($arrParameters['_tblFiltersGenericID']) ? $arrParameters['_tblFiltersGenericID'] : \SyncSystemNS\FunctionsDB::counterUniversalUpdate();
        $this->tblFiltersGenericID = $arrParameters['_tblFiltersGenericID'];
        $this->tblFiltersGenericSortOrder = isset($arrParameters['_tblFiltersGenericSortOrder']) ? $arrParameters['_tblFiltersGenericSortOrder'] : $this->tblFiltersGenericSortOrder;

        $this->tblFiltersGenericFilterIndex = isset($arrParameters['_tblFiltersGenericFilterIndex']) ? (int) $arrParameters['_tblFiltersGenericFilterIndex'] : $this->tblFiltersGenericFilterIndex;
        $this->tblFiltersGenericTableName = isset($arrParameters['_tblFiltersGenericTableName']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericTableName'], 'db_write_text') : $this->tblFiltersGenericTableName;

        $this->tblFiltersGenericTitle = isset($arrParameters['_tblFiltersGenericTitle']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericTitle'], 'db_write_text') : $this->tblFiltersGenericTitle;
        $this->tblFiltersGenericDescription = isset($arrParameters['_tblFiltersGenericDescription']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericDescription'], 'db_write_text') : $this->tblFiltersGenericDescription;

        $this->tblFiltersGenericURLAlias = isset($arrParameters['_tblFiltersGenericURLAlias']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericURLAlias'], 'db_write_text') : $this->tblFiltersGenericURLAlias;
        $this->tblFiltersGenericKeywordsTags = isset($arrParameters['_tblFiltersGenericKeywordsTags']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericKeywordsTags'], 'db_write_text') : $this->tblFiltersGenericKeywordsTags;
        $this->tblFiltersGenericMetaDescription = isset($arrParameters['_tblFiltersGenericMetaDescription']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericMetaDescription'], 'db_write_text') : $this->tblFiltersGenericMetaDescription;
        $this->tblFiltersGenericMetaTitle = isset($arrParameters['_tblFiltersGenericMetaTitle']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericMetaTitle'], 'db_write_text') : $this->tblFiltersGenericMetaTitle;
        // $this->tblFiltersGenericMetaInfo = isset($arrParameters['_tblFiltersGenericMetaInfo']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericMetaInfo'], 'db_write_text') : $this->tblFiltersGenericMetaInfo;

        $this->tblFiltersGenericInfoSmall1 = isset($arrParameters['_tblFiltersGenericInfoSmall1']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericInfoSmall1'], 'db_write_text') : $this->tblFiltersGenericInfoSmall1;
        $this->tblFiltersGenericInfoSmall2 = isset($arrParameters['_tblFiltersGenericInfoSmall2']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericInfoSmall2'], 'db_write_text') : $this->tblFiltersGenericInfoSmall2;
        $this->tblFiltersGenericInfoSmall3 = isset($arrParameters['_tblFiltersGenericInfoSmall3']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericInfoSmall3'], 'db_write_text') : $this->tblFiltersGenericInfoSmall3;
        $this->tblFiltersGenericInfoSmall4 = isset($arrParameters['_tblFiltersGenericInfoSmall4']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericInfoSmall4'], 'db_write_text') : $this->tblFiltersGenericInfoSmall4;
        $this->tblFiltersGenericInfoSmall5 = isset($arrParameters['_tblFiltersGenericInfoSmall5']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericInfoSmall5'], 'db_write_text') : $this->tblFiltersGenericInfoSmall5;

        //TODO: double check if needs outer parenthesis.
        $this->tblFiltersGenericNumberSmall1 = (isset($arrParameters['_tblFiltersGenericNumberSmall1']) && $arrParameters['_tblFiltersGenericNumberSmall1'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblFiltersGenericNumberSmall1'], config('app.gSystemConfig.configFiltersGenericNumberS1FieldType')) : $this->tblFiltersGenericNumberSmall1;
        $this->tblFiltersGenericNumberSmall2 = (isset($arrParameters['_tblFiltersGenericNumberSmall2']) && $arrParameters['_tblFiltersGenericNumberSmall2'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblFiltersGenericNumberSmall2'], config('app.gSystemConfig.configFiltersGenericNumberS1FieldType')) : $this->tblFiltersGenericNumberSmall2;
        $this->tblFiltersGenericNumberSmall3 = (isset($arrParameters['_tblFiltersGenericNumberSmall3']) && $arrParameters['_tblFiltersGenericNumberSmall3'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblFiltersGenericNumberSmall3'], config('app.gSystemConfig.configFiltersGenericNumberS1FieldType')) : $this->tblFiltersGenericNumberSmall3;
        $this->tblFiltersGenericNumberSmall4 = (isset($arrParameters['_tblFiltersGenericNumberSmall4']) && $arrParameters['_tblFiltersGenericNumberSmall4'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblFiltersGenericNumberSmall4'], config('app.gSystemConfig.configFiltersGenericNumberS1FieldType')) : $this->tblFiltersGenericNumberSmall4;
        $this->tblFiltersGenericNumberSmall5 = (isset($arrParameters['_tblFiltersGenericNumberSmall5']) && $arrParameters['_tblFiltersGenericNumberSmall5'] !== null) ? (float) \SyncSystemNS\FunctionsGeneric::valueMaskWrite($arrParameters['_tblFiltersGenericNumberSmall5'], config('app.gSystemConfig.configFiltersGenericNumberS1FieldType')) : $this->tblFiltersGenericNumberSmall5;

        $this->tblFiltersGenericActivation = (isset($arrParameters['_tblFiltersGenericActivation']) && $arrParameters['_tblFiltersGenericActivation'] !== null) ? $arrParameters['_tblFiltersGenericActivation'] : $this->tblFiltersGenericActivation;
        $this->tblFiltersGenericActivation1 = (isset($arrParameters['_tblFiltersGenericActivation1']) && $arrParameters['_tblFiltersGenericActivation1'] !== null) ? $arrParameters['_tblFiltersGenericActivation1'] : $this->tblFiltersGenericActivation1;
        $this->tblFiltersGenericActivation2 = (isset($arrParameters['_tblFiltersGenericActivation2']) && $arrParameters['_tblFiltersGenericActivation2'] !== null) ? $arrParameters['_tblFiltersGenericActivation2'] : $this->tblFiltersGenericActivation2;
        $this->tblFiltersGenericActivation3 = (isset($arrParameters['_tblFiltersGenericActivation3']) && $arrParameters['_tblFiltersGenericActivation3'] !== null) ? $arrParameters['_tblFiltersGenericActivation3'] : $this->tblFiltersGenericActivation3;
        $this->tblFiltersGenericActivation4 = (isset($arrParameters['_tblFiltersGenericActivation4']) && $arrParameters['_tblFiltersGenericActivation4'] !== null) ? $arrParameters['_tblFiltersGenericActivation4'] : $this->tblFiltersGenericActivation4;
        $this->tblFiltersGenericActivation5 = (isset($arrParameters['_tblFiltersGenericActivation5']) && $arrParameters['_tblFiltersGenericActivation5'] !== null) ? $arrParameters['_tblFiltersGenericActivation5'] : $this->tblFiltersGenericActivation5;

        $this->tblFiltersGenericNotes = isset($arrParameters['_tblFiltersGenericNotes']) ? \SyncSystemNS\FunctionsGeneric::contentMaskWrite($arrParameters['_tblFiltersGenericNotes'], 'db_write_text') : $this->tblFiltersGenericNotes;
        // ----------------------

        // Build insert parameters.
        // ----------------------
        $this->arrSQLFiltersGenericUpdateParams['id'] = $this->tblFiltersGenericID;
        $this->arrSQLFiltersGenericUpdateParams['sort_order'] = $this->tblFiltersGenericSortOrder;

        $this->arrSQLFiltersGenericUpdateParams['filter_index'] = $this->tblFiltersGenericFilterIndex;
        $this->arrSQLFiltersGenericUpdateParams['table_name'] = $this->tblFiltersGenericTableName;

        $this->arrSQLFiltersGenericUpdateParams['title'] = $this->tblFiltersGenericTitle;
        $this->arrSQLFiltersGenericUpdateParams['description'] = $this->tblFiltersGenericDescription;

        $this->arrSQLFiltersGenericUpdateParams['url_alias'] = $this->tblFiltersGenericURLAlias;
        $this->arrSQLFiltersGenericUpdateParams['keywords_tags'] = $this->tblFiltersGenericKeywordsTags;
        $this->arrSQLFiltersGenericUpdateParams['meta_description'] = $this->tblFiltersGenericMetaDescription;
        $this->arrSQLFiltersGenericUpdateParams['meta_title'] = $this->tblFiltersGenericMetaTitle;
        // $this->arrSQLFiltersGenericUpdateParams['meta_info'] = $this->tblFiltersGenericMetaInfo;

        $this->arrSQLFiltersGenericUpdateParams['info_small1'] = $this->tblFiltersGenericInfoSmall1;
        $this->arrSQLFiltersGenericUpdateParams['info_small2'] = $this->tblFiltersGenericInfoSmall2;
        $this->arrSQLFiltersGenericUpdateParams['info_small3'] = $this->tblFiltersGenericInfoSmall3;
        $this->arrSQLFiltersGenericUpdateParams['info_small4'] = $this->tblFiltersGenericInfoSmall4;
        $this->arrSQLFiltersGenericUpdateParams['info_small5'] = $this->tblFiltersGenericInfoSmall5;

        $this->arrSQLFiltersGenericUpdateParams['number_small1'] = $this->tblFiltersGenericNumberSmall1;
        $this->arrSQLFiltersGenericUpdateParams['number_small2'] = $this->tblFiltersGenericNumberSmall2;
        $this->arrSQLFiltersGenericUpdateParams['number_small3'] = $this->tblFiltersGenericNumberSmall3;
        $this->arrSQLFiltersGenericUpdateParams['number_small4'] = $this->tblFiltersGenericNumberSmall4;
        $this->arrSQLFiltersGenericUpdateParams['number_small5'] = $this->tblFiltersGenericNumberSmall5;

        $this->arrSQLFiltersGenericUpdateParams['activation'] = $this->tblFiltersGenericActivation;
        $this->arrSQLFiltersGenericUpdateParams['activation1'] = $this->tblFiltersGenericActivation1;
        $this->arrSQLFiltersGenericUpdateParams['activation2'] = $this->tblFiltersGenericActivation2;
        $this->arrSQLFiltersGenericUpdateParams['activation3'] = $this->tblFiltersGenericActivation3;
        $this->arrSQLFiltersGenericUpdateParams['activation4'] = $this->tblFiltersGenericActivation4;
        $this->arrSQLFiltersGenericUpdateParams['activation5'] = $this->tblFiltersGenericActivation5;

        $this->arrSQLFiltersGenericUpdateParams['notes'] = $this->tblFiltersGenericNotes;
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
            $this->resultsSQLFiltersGenericUpdate = DB::table(config('app.gSystemConfig.configSystemDBTablePrefix') . config('app.gSystemConfig.configSystemDBTableFiltersGeneric'));
            $this->resultsSQLFiltersGenericUpdate = $this->resultsSQLFiltersGenericUpdate->where('id', '=', \SyncSystemNS\FunctionsGeneric::contentMaskWrite((string) $this->arrSQLFiltersGenericUpdateParams['id'], 'db_sanitize'));
            $this->resultsSQLFiltersGenericUpdate = $this->resultsSQLFiltersGenericUpdate->update($this->arrSQLFiltersGenericUpdateParams);

            // Debug.
            /*
            echo 'this->resultsSQLFiltersGenericUpdate=<pre>';
            var_dump($this->resultsSQLFiltersGenericUpdate);
            echo '</pre><br />';
            */
            // exit();

            // if ($this->resultsSQLFiltersGenericUpdate === true) {
            if ($this->resultsSQLFiltersGenericUpdate > 0) {
                $arrReturn = [
                    'returnStatus' => true,
                    // 'nRecords' => 1,
                    'nRecords' => $this->resultsSQLFiltersGenericUpdate,
                    'idRecordUpdate' => $this->arrSQLFiltersGenericUpdateParams['id']
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
