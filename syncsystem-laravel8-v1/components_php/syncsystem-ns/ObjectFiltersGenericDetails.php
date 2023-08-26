<?php

declare(strict_types=1);

namespace SyncSystemNS;

class ObjectFiltersGenericDetails
{
    // Properties.
    // ----------------------
    private float|null $idTbFiltersGeneric = null;
    private array|null $arrSearchParameters = [];

    private int $terminal = 0; // terminal: 0 - backend | 1 - frontend
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = [];

    private array|null $resultFiltersGenericDetails = null;

    private float|null $tblFiltersGenericID = null;
    private float $tblFiltersGenericSortOrder = 0;
    private string $tblFiltersGenericSortOrder_print = '0';

    private int $tblFiltersGenericFilterIndex = 0;
    private string $tblFiltersGenericTableName = '';

    private string $tblFiltersGenericTitle = '';
    private string $tblFiltersGenericDescription = '';
    private string $tblFiltersGenericDescription_edit = '';

    private string $tblFiltersGenericURLAlias = '';
    private string $tblFiltersGenericKeywordsTags = '';
    private string $tblFiltersGenericMetaDescription = '';
    private string $tblFiltersGenericMetaDescription_edit = '';
    private string $tblFiltersGenericMetaTitle = '';
    // private string $tblFiltersGenericMetaInfo = '';

    private string $tblFiltersGenericInfoSmall1 = '';
    private string $tblFiltersGenericInfoSmall1_edit = '';
    private string $tblFiltersGenericInfoSmall2 = '';
    private string $tblFiltersGenericInfoSmall2_edit = '';
    private string $tblFiltersGenericInfoSmall3 = '';
    private string $tblFiltersGenericInfoSmall3_edit = '';
    private string $tblFiltersGenericInfoSmall4 = '';
    private string $tblFiltersGenericInfoSmall4_edit = '';
    private string $tblFiltersGenericInfoSmall5 = '';
    private string $tblFiltersGenericInfoSmall5_edit = '';

    private float $tblFiltersGenericNumberSmall1 = 0;
    private string $tblFiltersGenericNumberSmall1_print = '';
    private float $tblFiltersGenericNumberSmall2 = 0;
    private string $tblFiltersGenericNumberSmall2_print = '';
    private float $tblFiltersGenericNumberSmall3 = 0;
    private string $tblFiltersGenericNumberSmall3_print = '';
    private float $tblFiltersGenericNumberSmall4 = 0;
    private string $tblFiltersGenericNumberSmall4_print = '';
    private float $tblFiltersGenericNumberSmall5 = 0;
    private string $tblFiltersGenericNumberSmall5_print = '';

    private string $tblFiltersGenericImageMain = '';

    private int $tblFiltersGenericActivation = 1;
    private string $tblFiltersGenericActivation_print = '';
    private int $tblFiltersGenericActivation1 = 0;
    private string $tblFiltersGenericActivation1_print = '';
    private int $tblFiltersGenericActivation2 = 0;
    private string $tblFiltersGenericActivation2_print = '';
    private int $tblFiltersGenericActivation3 = 0;
    private string $tblFiltersGenericActivation3_print = '';
    private int $tblFiltersGenericActivation4 = 0;
    private string $tblFiltersGenericActivation4_print = '';
    private int $tblFiltersGenericActivation5 = 0;
    private string $tblFiltersGenericActivation5_print = '';

    private string $tblFiltersGenericNotes = '';
    private string $tblFiltersGenericNotes_edit = '';

    private string $ofglRecords;
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
        $this->idTbFiltersGeneric = array_key_exists('_idTbFiltersGeneric', $arrParameters) && $arrParameters['_idTbFiltersGeneric'] !== null ? (float) $arrParameters['_idTbFiltersGeneric'] : $this->idTbFiltersGeneric;
        $this->arrSearchParameters = array_key_exists('_arrSearchParameters', $arrParameters) && $arrParameters['_arrSearchParameters'] !== null ? $arrParameters['_arrSearchParameters'] : $this->arrSearchParameters;

        $this->terminal = array_key_exists('_terminal', $arrParameters) && $arrParameters['_terminal'] !== null ? (int) $arrParameters['_terminal'] : $this->terminal;
        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }

        $this->arrSpecialParameters = array_key_exists('_arrSpecialParameters', $arrParameters) && $arrParameters['_arrSpecialParameters'] !== null ? $arrParameters['_arrSpecialParameters'] : $this->arrSpecialParameters;
        // ----------------------
    }
    // **************************************************************************************

    // Get filters generic details according to search parameters.
    // **************************************************************************************
    /**
     * Get filters generic according to search parameters.
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
            $this->resultFiltersGenericDetails = \SyncSystemNS\FunctionsDB::genericTableGet02(
                config('app.gSystemConfig.configSystemDBTableFiltersGeneric'),
                $this->arrSearchParameters,
                '',
                '',
                \SyncSystemNS\FunctionsGeneric::tableFieldsQueryBuild01(config('app.gSystemConfig.configSystemDBTableFiltersGeneric'), 'all', 'string'),
                1,
                $this->arrSpecialParameters
            );

            // Debug.
            //echo 'resultFiltersGenericDetails=<pre>';
            //var_dump($this->resultFiltersGenericDetails);
            //echo '</pre><br />';

            // if ($this->resultFiltersGenericDetails['returnStatus'] === true) {
            if ($this->resultFiltersGenericDetails['returnStatus'] === true && isset($this->resultFiltersGenericDetails[0])) {
                $arrReturn['returnStatus'] = true;

                // Define values.
                //$this->tblFiltersGenericID = $this->resultFiltersGenericDetails[0]['id'];
                $this->tblFiltersGenericID = $this->resultFiltersGenericDetails[0]->id;

                $this->tblFiltersGenericSortOrder = (float) $this->resultFiltersGenericDetails[0]->sort_order;
                $this->tblFiltersGenericSortOrder_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericSortOrder, config('app.gSystemConfig.configSystemCurrency'), SS_VALUE_TYPE_DECIMAL);

                $this->tblFiltersGenericFilterIndex = $this->resultFiltersGenericDetails[0]->filter_index;
                $this->tblFiltersGenericTableName = $this->resultFiltersGenericDetails[0]->table_name;

                $this->tblFiltersGenericTitle = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->title, 'db');
                $this->tblFiltersGenericDescription = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->description, 'db');
                $this->tblFiltersGenericDescription_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->description, 'editTextBox=' . config('app.gSystemConfig.configBackendTextBox'));
                $this->tblFiltersGenericURLAlias = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->url_alias, 'db');
                $this->tblFiltersGenericKeywordsTags = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->keywords_tags, 'db');
                $this->tblFiltersGenericMetaDescription = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->meta_description, 'db');
                $this->tblFiltersGenericMetaDescription_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->meta_description, 'db');
                $this->tblFiltersGenericMetaTitle = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->meta_title, 'db');
                // $this->tblFiltersGenericMetaInfo = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->meta_info, 'db');

                $this->tblFiltersGenericInfoSmall1 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small1, 'db');
                $this->tblFiltersGenericInfoSmall1_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small1, 'db');
                $this->tblFiltersGenericInfoSmall2 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small2, 'db');
                $this->tblFiltersGenericInfoSmall2_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small2, 'db');
                $this->tblFiltersGenericInfoSmall3 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small3, 'db');
                $this->tblFiltersGenericInfoSmall3_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small3, 'db');
                $this->tblFiltersGenericInfoSmall4 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small4, 'db');
                $this->tblFiltersGenericInfoSmall4_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small4, 'db');
                $this->tblFiltersGenericInfoSmall5 = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small5, 'db');
                $this->tblFiltersGenericInfoSmall5_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->info_small5, 'db');

                $this->tblFiltersGenericNumberSmall1 = (float) $this->resultFiltersGenericDetails[0]->number_small1;
                $this->tblFiltersGenericNumberSmall1_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericNumberSmall1, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configFiltersGenericNumberS1FieldType'));
                $this->tblFiltersGenericNumberSmall2 = (float) $this->resultFiltersGenericDetails[0]->number_small2;
                $this->tblFiltersGenericNumberSmall2_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericNumberSmall2, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configFiltersGenericNumberS2FieldType'));
                $this->tblFiltersGenericNumberSmall3 = (float) $this->resultFiltersGenericDetails[0]->number_small3;
                $this->tblFiltersGenericNumberSmall3_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericNumberSmall3, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configFiltersGenericNumberS3FieldType'));
                $this->tblFiltersGenericNumberSmall4 = (float) $this->resultFiltersGenericDetails[0]->number_small4;
                $this->tblFiltersGenericNumberSmall4_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericNumberSmall4, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configFiltersGenericNumberS4FieldType'));
                $this->tblFiltersGenericNumberSmall5 = (float) $this->resultFiltersGenericDetails[0]->number_small5;
                $this->tblFiltersGenericNumberSmall5_print = (string) \SyncSystemNS\FunctionsGeneric::valueMaskRead($this->tblFiltersGenericNumberSmall5, config('app.gSystemConfig.configSystemCurrency'), config('app.gSystemConfig.configFiltersGenericNumberS5FieldType'));

                $this->tblFiltersGenericImageMain = (string)$this->resultFiltersGenericDetails[0]->image_main;

                $this->tblFiltersGenericActivation = $this->resultFiltersGenericDetails[0]->activation;
                $this->tblFiltersGenericActivation_print = $this->tblFiltersGenericActivation === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericActivation1 = $this->resultFiltersGenericDetails[0]->activation1;
                $this->tblFiltersGenericActivation1_print = $this->tblFiltersGenericActivation1 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericActivation2 = $this->resultFiltersGenericDetails[0]->activation2;
                $this->tblFiltersGenericActivation2_print = $this->tblFiltersGenericActivation2 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericActivation3 = $this->resultFiltersGenericDetails[0]->activation3;
                $this->tblFiltersGenericActivation3_print = $this->tblFiltersGenericActivation3 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericActivation4 = $this->resultFiltersGenericDetails[0]->activation4;
                $this->tblFiltersGenericActivation4_print = $this->tblFiltersGenericActivation4 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericActivation5 = $this->resultFiltersGenericDetails[0]->activation5;
                $this->tblFiltersGenericActivation5_print = $this->tblFiltersGenericActivation5 === 0 ?
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation0')
                :
                    \SyncSystemNS\FunctionsGeneric::appLabelsGet(config('app.gSystemConfig.configLanguageBackend')->appLabels, $this->labelPrefix . 'ItemActivation1')
                ;

                $this->tblFiltersGenericNotes = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->notes, 'db');
                $this->tblFiltersGenericNotes_edit = \SyncSystemNS\FunctionsGeneric::contentMaskRead($this->resultFiltersGenericDetails[0]->notes, 'db');

                // Build return array.
                $arrReturn['tblFiltersGenericID'] = $this->tblFiltersGenericID;

                $arrReturn['tblFiltersGenericSortOrder'] = $this->tblFiltersGenericSortOrder;
                $arrReturn['tblFiltersGenericSortOrder_print'] = $this->tblFiltersGenericSortOrder_print;

                $arrReturn['tblFiltersGenericFilterIndex'] = $this->tblFiltersGenericFilterIndex;
                $arrReturn['tblFiltersGenericTableName'] = $this->tblFiltersGenericTableName;

                $arrReturn['tblFiltersGenericTitle'] = $this->tblFiltersGenericTitle;
                $arrReturn['tblFiltersGenericDescription'] = $this->tblFiltersGenericDescription;
                $arrReturn['tblFiltersGenericDescription_edit'] = $this->tblFiltersGenericDescription_edit;
                $arrReturn['tblFiltersGenericURLAlias'] = $this->tblFiltersGenericURLAlias;
                $arrReturn['tblFiltersGenericKeywordsTags'] = $this->tblFiltersGenericKeywordsTags;
                $arrReturn['tblFiltersGenericMetaDescription'] = $this->tblFiltersGenericMetaDescription;
                $arrReturn['tblFiltersGenericMetaDescription_edit'] = $this->tblFiltersGenericMetaDescription_edit;
                $arrReturn['tblFiltersGenericMetaTitle'] = $this->tblFiltersGenericMetaTitle;
                // $arrReturn['tblFiltersGenericMetaInfo'] = $this->tblFiltersGenericMetaInfo;

                $arrReturn['tblFiltersGenericInfoSmall1'] = $this->tblFiltersGenericInfoSmall1;
                $arrReturn['tblFiltersGenericInfoSmall1_edit'] = $this->tblFiltersGenericInfoSmall1_edit;
                $arrReturn['tblFiltersGenericInfoSmall2'] = $this->tblFiltersGenericInfoSmall2;
                $arrReturn['tblFiltersGenericInfoSmall2_edit'] = $this->tblFiltersGenericInfoSmall2_edit;
                $arrReturn['tblFiltersGenericInfoSmall3'] = $this->tblFiltersGenericInfoSmall3;
                $arrReturn['tblFiltersGenericInfoSmall3_edit'] = $this->tblFiltersGenericInfoSmall3_edit;
                $arrReturn['tblFiltersGenericInfoSmall4'] = $this->tblFiltersGenericInfoSmall4;
                $arrReturn['tblFiltersGenericInfoSmall4_edit'] = $this->tblFiltersGenericInfoSmall4_edit;
                $arrReturn['tblFiltersGenericInfoSmall5'] = $this->tblFiltersGenericInfoSmall5;
                $arrReturn['tblFiltersGenericInfoSmall5_edit'] = $this->tblFiltersGenericInfoSmall5_edit;

                $arrReturn['tblFiltersGenericNumberSmall1'] = $this->tblFiltersGenericNumberSmall1;
                $arrReturn['tblFiltersGenericNumberSmall1_print'] = $this->tblFiltersGenericNumberSmall1_print;
                $arrReturn['tblFiltersGenericNumberSmall2'] = $this->tblFiltersGenericNumberSmall2;
                $arrReturn['tblFiltersGenericNumberSmall2_print'] = $this->tblFiltersGenericNumberSmall2_print;
                $arrReturn['tblFiltersGenericNumberSmall3'] = $this->tblFiltersGenericNumberSmall3;
                $arrReturn['tblFiltersGenericNumberSmall3_print'] = $this->tblFiltersGenericNumberSmall3_print;
                $arrReturn['tblFiltersGenericNumberSmall4'] = $this->tblFiltersGenericNumberSmall4;
                $arrReturn['tblFiltersGenericNumberSmall4_print'] = $this->tblFiltersGenericNumberSmall4_print;
                $arrReturn['tblFiltersGenericNumberSmall5'] = $this->tblFiltersGenericNumberSmall5;
                $arrReturn['tblFiltersGenericNumberSmall5_print'] = $this->tblFiltersGenericNumberSmall5_print;

                $arrReturn['tblFiltersGenericImageMain'] = $this->tblFiltersGenericImageMain;

                $arrReturn['tblFiltersGenericActivation'] = $this->tblFiltersGenericActivation;
                $arrReturn['tblFiltersGenericActivation_print'] = $this->tblFiltersGenericActivation_print;
                $arrReturn['tblFiltersGenericActivation1'] = $this->tblFiltersGenericActivation1;
                $arrReturn['tblFiltersGenericActivation1_print'] = $this->tblFiltersGenericActivation1_print;
                $arrReturn['tblFiltersGenericActivation2'] = $this->tblFiltersGenericActivation2;
                $arrReturn['tblFiltersGenericActivation2_print'] = $this->tblFiltersGenericActivation2_print;
                $arrReturn['tblFiltersGenericActivation3'] = $this->tblFiltersGenericActivation3;
                $arrReturn['tblFiltersGenericActivation3_print'] = $this->tblFiltersGenericActivation3_print;
                $arrReturn['tblFiltersGenericActivation4'] = $this->tblFiltersGenericActivation4;
                $arrReturn['tblFiltersGenericActivation4_print'] = $this->tblFiltersGenericActivation4_print;
                $arrReturn['tblFiltersGenericActivation5'] = $this->tblFiltersGenericActivation5;
                $arrReturn['tblFiltersGenericActivation5_print'] = $this->tblFiltersGenericActivation5_print;

                $arrReturn['tblFiltersGenericNotes'] = $this->tblFiltersGenericNotes;
                $arrReturn['tblFiltersGenericNotes_edit'] = $this->tblFiltersGenericNotes_edit;
            }

            // Debug.
            //echo 'this->resultFiltersGenericDetails=<pre>';
            //var_dump($this->resultFiltersGenericDetails);
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
