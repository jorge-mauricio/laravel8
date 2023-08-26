<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiltersGenericDetails extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float $idTbFiltersGeneric = 0;
    private array|null $arrSearchParameters = null;

    private int $terminal = 0; // terminal: 0 - admin | 1 - frontend

    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = null;

    private array|null $resultsCategoryDetails = null; // TODO: double check - it may be mixed.
    private array|null $ofgdRecordParameters = null;

    protected mixed $objFiltersGenericDetails = null; // TODO: double check - it may be mixed.
    protected array|null $arrFiltersGenericListing = null;
    // ----------------------

    // Constructor.
    // TODO: include $terminal as constructor parameter (or some other method).
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $_ofgdRecordParameters
     */
    public function __construct(?array $_ofgdRecordParameters = null)
    {
        if ($_ofgdRecordParameters !== null) {
            $this->ofgdRecordParameters = $_ofgdRecordParameters;
        }

        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        }
    }
    // **************************************************************************************

    // Build content placeholder body.
    // TODO: evaluate changing name to build() or recordDetailsBuild() or separate - build() dataGet().
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
            if ($this->ofgdRecordParameters !== null) {
                $ofgdRecord = new \SyncSystemNS\ObjectFiltersGenericDetails($this->ofgdRecordParameters);
                $arrReturn['ofgdRecord'] = $ofgdRecord->recordDetailsGet(0, 1);

                if ($arrReturn['ofgdRecord']['returnStatus'] === true) {
                    $arrReturn['returnStatus'] = true;
                }
            }
        } catch (\Exception $cphBodyBuildError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('cphBodyBuildError: ' . $cphBodyBuildError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
