<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersListing extends Model
{
    use HasFactory;

    // Properties.
    // ----------------------
    private array|null $oulRecordsParameters = null;

    protected $objUsersListing;
    protected $arrUsersListing;
    // ----------------------

    // Constructor.
    // **************************************************************************************
    /**
     * Constructor.
     * @param ?array $_oclRecordsParameters
     */
    public function __construct(?array $_oulRecordsParameters = null)
    {
        if ($_oulRecordsParameters !== null) {
            $this->oulRecordsParameters = $_oulRecordsParameters;
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
            if ($this->oulRecordsParameters !== null) {
                // Total records (for pagination).
                if (config('app.gSystemConfig.enableUsersBackendPagination') === 1) {
                    $arrReturn['_pagingTotalRecords'] = \SyncSystemNS\FunctionsDB::genericTableGet02(
                        config('app.gSystemConfig.configSystemDBTableUsers'),
                        $this->oulRecordsParameters['_arrSearchParameters'],
                        config('app.gSystemConfig.configUsersSort'),
                        '',
                        'id,id_parent',
                        3
                    );
                }

                $oulRecords = new \SyncSystemNS\ObjectUsersListing($this->oulRecordsParameters);
                $arrReturn['oulRecords'] = $oulRecords->recordsListingGet(0, 1);

                if ($arrReturn['oulRecords']['returnStatus'] === true) {
                    $arrReturn['returnStatus'] = true;
                }
            }

            // Debug.
            //echo 'this->oulRecordsParameters=<pre>';
            //var_dump($this->oulRecordsParameters);
            //echo '</pre><br />';

            //echo 'oulRecords=<pre>';
            //var_dump($oulRecords);
            //echo '</pre><br />';
        } catch (\Exception $userListingModelError) {
            if (config('app.gSystemConfig.configDebug') === true) {
                throw new \Error('userListingModelError: ' . $userListingModelError->getMessage());
            }
        } finally {
            //
        }

        return $arrReturn;
    }
    // **************************************************************************************
}
