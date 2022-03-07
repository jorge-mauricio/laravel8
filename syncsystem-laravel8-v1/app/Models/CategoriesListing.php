<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesListing extends Model
{
    use HasFactory;

    protected $objCategoriesListing;
    protected $arrCategoriesListing;

    public function cphBodyBuild()
    {
        // ref: https://youtu.be/_CjKZ9FwEpQ?list=PLz_YkiqIHesvWMGfavV8JFDQRJycfHUvD&t=239
        // create eloquent fetch

        // ref: https://youtu.be/KKOMJQBkPLE?list=PLz_YkiqIHesvWMGfavV8JFDQRJycfHUvD&t=851
        // select data

        // ref: https://youtu.be/3Uy0KRPHQik?list=PLz_YkiqIHesvWMGfavV8JFDQRJycfHUvD
        // CRUD API

        return 'content inside model';

    }
}
