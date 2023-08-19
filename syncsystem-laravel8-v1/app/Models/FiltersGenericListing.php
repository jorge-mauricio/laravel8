<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiltersGenericListing extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private array|null $ofglRecordsParameters = null;

    protected $objFiltersGenericListing;
    protected $arrFiltersGenericListing;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $_ofglRecordsParameters
     */
    public function __construct(?array $_ofglRecordsParameters = null)
    {
        if ($_ofglRecordsParameters !== null) {
            $this->ofglRecordsParameters = $_ofglRecordsParameters;
        }
    }
    // **************************************************************************************

    // Build content placeholder body.
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
            // Build object - listing.
            if ($this->ofglRecordsParameters !== null) {
                $ofglRecords = new \SyncSystemNS\ObjectFiltersGenericListing($this->ofglRecordsParameters);
                $arrReturn['ofglRecords'] = $ofglRecords->recordsListingGet(0, 1);

                if ($arrReturn['ofglRecords']['returnStatus'] === true) {
                    $arrReturn['returnStatus'] = true;
                }
            }

            // Debug.
            //echo 'this->_idParent=' . $this->_idParent . '<br />';
            //echo 'this->oclRecordsParameters=<pre>';
            //var_dump($this->oclRecordsParameters);
            //echo '</pre><br />';

            //echo 'oclRecords=<pre>';
            //var_dump($oclRecords);
            //echo '</pre><br />';
        } catch (\Exception $filtersGenericListingModelError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('filtersGenericListingModelError: ' . $filtersGenericListingModelError->getMessage());
            }
        } finally {
            //
        }

        //return 'content inside model: ' . $this->_idParent; // debug.
        return $arrReturn;
    }
    // **************************************************************************************
}
