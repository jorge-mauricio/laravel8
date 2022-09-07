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

        $messageSuccess = '';
        isset($_GET['messageSuccess']) ? $messageSuccess = $_GET['messageSuccess'] : $messageSuccess = '';
        $messageError = '';
        $messageAlert = '';

        // Current date values.
        $dateNow = new \DateTime(); // Y-m-d H:i:s
        $dateNowYear = $dateNow->format('Y');
        $dateNowMonth = $dateNow->format('m');
        $dateNowDay = $dateNow->format('d');
        
        $dateNowHour = $dateNow->format('H');
        $dateNowMinute = $dateNow->format('i');
        $dateNowSecond = $dateNow->format('s');
            
        // Shere between views.
        View::share('masterPageSelect', $masterPageSelect);
        View::share('pageNumber', $pageNumber);

        View::share('messageSuccess', $messageSuccess);
        View::share('messageError', $messageError);
        View::share('messageAlert', $messageAlert);

        View::share('dateNow', $dateNow);
        View::share('dateNowDay', $dateNowDay);
        View::share('dateNowMonth', $dateNowMonth);
        View::share('dateNowYear', $dateNowYear);
        View::share('dateNowMinute', $dateNowMinute);
        View::share('dateNowHour', $dateNowHour);
        View::share('dateNowSecond', $dateNowSecond);
     }  
}
