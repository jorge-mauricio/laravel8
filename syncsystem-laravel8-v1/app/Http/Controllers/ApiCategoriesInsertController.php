<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Custom models.

class ApiCategoriesInsertController extends Controller
{
    // Properties.
    // ----------------------
    private array|null $arrReturn = array('returnStatus' => false);
    private string $configAPIKey = '';

    private float|null $terminal = 0;
    private string $apiKey = '';
    // ----------------------

    // Constructor.
    // **************************************************************************************
    public function __construct(Request $req)
    {

    }
    // **************************************************************************************

    public function insertCategories(Request $req): array
    {
        // Variables.

        // Logic.
        try {

            // Debug.
            //echo 'req->all() (inside api categories insert controller=<pre>';
            //var_dump($req->all());
            //echo '</pre><br />';

            $this->arrReturn['debug'] = $req->all();

            //exit();
        } catch (Error $insertCategoriesError) {
            if ($GLOBALS['configDebug'] === true) {
                throw new Error('insertCategoriesError: ' . $insertCategoriesError->message());
            }
        } finally {
            // Redirect
            // return redirect('/admin/categories/781')->with('status','Student Added Successfully');
        }

        return $this->arrReturn;
    }
}
