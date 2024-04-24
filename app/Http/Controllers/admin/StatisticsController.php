<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    CONST MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    CONST ATTRIBUTES = ['General', 'EV', 'Disability'];

    public function showStatistics(){
        $registrationDataByDefault = $this->showUserRegistration();
        return view('admin.statistics.show',['registrationDataByDefault' => $registrationDataByDefault]);
    }

    public function showUserRegistration(){
        $months = self::MONTHS;
        $attributes = self::ATTRIBUTES;
    
        // Generate sample statistical data
        $statisticalData = [];
        foreach ($attributes as $attribute) {
            foreach ($months as $month) {
                $statisticalData[$attribute][$month] = rand(50, 100);
            }
        }
    
        return ['months' => $months, 'attributes' => $attributes, 'statisticalData' => $statisticalData];
    }
}
