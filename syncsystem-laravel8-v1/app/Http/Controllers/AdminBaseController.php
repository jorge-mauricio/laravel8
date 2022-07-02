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

        // Current date values.
        $dateNow = new \DateTime(); // Y-m-d H:i:s
        $dateNowDay = $dateNow->format('d');
        $dateNowMonth = $dateNow->format('m');
        $dateNowYear = $dateNow->format('Y');
        $dateNowMinute = $dateNow->format('i');
        $dateNowHour = $dateNow->format('H');
        $dateNowSecond = $dateNow->format('s');
            
        // Shere between views.
        View::share ( 'masterPageSelect', $masterPageSelect );
        View::share ( 'pageNumber', $pageNumber );

        View::share ( 'dateNow', $dateNow );
        View::share ( 'dateNowDay', $dateNowDay );
        View::share ( 'dateNowMonth', $dateNowMonth );
        View::share ( 'dateNowYear', $dateNowYear );
        View::share ( 'dateNowMinute', $dateNowMinute );
        View::share ( 'dateNowHour', $dateNowHour );
        View::share ( 'dateNowSecond', $dateNowSecond );
     }  
}
