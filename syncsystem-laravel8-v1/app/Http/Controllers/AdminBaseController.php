<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class AdminBaseController extends Controller
{
    public function __construct() {
        // Admin master page select priority.
        $masterPageSelect = 'layout-admin-main';
        if (!empty($_GET['masterPageSelect'])) {
            $masterPageSelect = $_GET['masterPageSelect'];
        } 
        if (!empty($_POST['masterPageSelect'])) {
            $masterPageSelect = $_POST['masterPageSelect'];
        } 

        $pageNumber = '';
        // $messageSuccess = '';
        // $messageError = '';
        // $messageAlert = '';
        
        // Shere between views.
        View::share ( 'masterPageSelect', $masterPageSelect );
        View::share ( 'pageNumber', $pageNumber );
     }  
}
