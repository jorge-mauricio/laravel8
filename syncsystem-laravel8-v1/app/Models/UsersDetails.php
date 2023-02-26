<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private float $idTbUsers = 0;
    private array|null $arrSearchParameters = null;

    private int $terminal = 0; // terminal: 0 - admin | 1 - frontend
    
    private string $labelPrefix = 'backend';

    private array|null $arrSpecialParameters = null;

    private array|null $resultsUsersDetails = null; // TODO: double check - it may be mixed.
    private array|null $oudRecordParameters = null;

    protected mixed $objUsersDetails = null; // TODO: double check - it may be mixed.
    protected array|null $arrUsersListing = null;
    // ----------------------

    // Constructor.
    // TODO: include $terminal as constructor parameter (or some other method).
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $_oudRecordParameters
     */
    public function __construct(?array $_oudRecordParameters = null)
    {
        if ($_oudRecordParameters !== null) {
            $this->oudRecordParameters = $_oudRecordParameters;
        }

        if ($this->terminal === 1) {
            $this->labelPrefix = 'frontend';
        } // TODO: evaluate moving this to a model base (extended).
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
            if ($this->oudRecordParameters !== null) {
                $oudRecord = new \SyncSystemNS\ObjectUsersDetails($this->oudRecordParameters);
                $arrReturn['oudRecord'] = $oudRecord->recordDetailsGet(0, 1);

                if ($arrReturn['oudRecord']['returnStatus'] === true) {
                    $arrReturn['returnStatus'] = true;
                }
            }
        } catch (Error $cphBodyBuildError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('cphBodyBuildError: ' . $cphBodyBuildError->message());
            }
        } finally {
            //
        }
        
        //return 'content inside model: ' . $this->_idParent; // debug.
        return $arrReturn;
    }
    // **************************************************************************************
    

}
