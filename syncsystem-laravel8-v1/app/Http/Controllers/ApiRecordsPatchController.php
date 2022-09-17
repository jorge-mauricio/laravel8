<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiRecordsPatchController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = ['returnStatus' => false];
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {
        //
    }
    // **************************************************************************************

    // Handle record edit and return data.
    // **************************************************************************************
    public function patchRecords(Request $req): mixed
    {
        // Logic.
        try {

        } catch (Error $patchRecordsError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('patchRecordsError: ' . $patchRecordsError->message());
            }
        } finally {
            //
        }


        return $this->arrReturn;
    }
    // **************************************************************************************
}
