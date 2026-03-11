<?php
use Illuminate\Support\Facades\DB; // Import the DB facade

if (!function_exists('customHelperFunction')) {
    function customHelperFunction()
    {
        // Your custom logic here
        return 'Processed: ' ;
    }
}
/** Get category List */
if (!function_exists('get_category')) {
        
    function get_category($field = 0)
    {
        //return DB::table('employees')->get();
        $get_category_detail = '';
        $opt[''] ='Select Category';
        $get_category_detail = DB::table('category_models')->select('id', 'name')->where('status',1)->get();
        if($get_category_detail)
        {
            foreach($get_category_detail as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}
/** Get Valaya Details */
if (!function_exists('get_valaya')) {
        
    function get_valaya($field = 0)
    {
        //return DB::table('employees')->get();
        $get_valaya_detail = '';
        $opt[''] ='Select Valaya';
        $get_valaya_detail = DB::table('valaya_models')->select('id', 'name')->where('status',1)->get();
        if($get_valaya_detail)
        {
            foreach($get_valaya_detail as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}
/** Get purchase category List */
if (!function_exists('get_purchase_category')) {
        
    function get_purchase_category($field = 0)
    {
        //return DB::table('employees')->get();
        $get_category_detail = '';
        $opt[''] ='Select Purchase Category';
        $get_category_detail = DB::table('purchase_category_models')->select('id', 'name')->where('status',1)->get();
        if($get_category_detail)
        {
            foreach($get_category_detail as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}

/** Get purchase sub category List */
if (!function_exists('get_purchase_sub_category')) {
        
    function get_purchase_sub_category($field = 0)
    {
        //return DB::table('employees')->get();
        $get_sub_category_detail = '';
        $opt[''] ='Select Purchase Category';
        $get_sub_category_detail = DB::table('purchase_subcategory_models')->select('id', 'name')->where('status',1)->get();
        if($get_sub_category_detail)
        {
            foreach($get_sub_category_detail as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}

/** Get purchase category List */
if (!function_exists('get_purchase_by')) {
        
    function get_purchase_by($field = 0)
    {
        //return DB::table('employees')->get();
        $get_category_by = '';
        $opt[''] ='Select Purchase By';
        $get_category_by = DB::table('purchase_by')->select('id', 'name')->get();
        if($get_category_by)
        {
            foreach($get_category_by as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}
/** Get Years --Active Year Display first-- */
if (!function_exists('get_years')) {
        
    function get_years($field = 0)
    {
        //return DB::table('employees')->get();
        $get_years_detail = '';
        $opt=[];
       // $get_years_detail = DB::table('payment_types')->select('id', 'payment_type')->where('status',1)->get();
        $get_years_detail = DB::table('years')
        ->select('id', 'display_year')
        ->orderByRaw("CASE WHEN status = '1' THEN 0 ELSE 1 END")
        ->get();
        if($get_years_detail)
        {
            foreach($get_years_detail as $r){
                $opt[$r->id] = $r->display_year;  
            }
        }
        return $opt;
    }
}

/** Get Payment Types List */
if (!function_exists('get_payment_types')) {
        
    function get_payment_types($field = 0)
    {
        //return DB::table('employees')->get();
        $get_payment_detail = '';
        $opt=[];
        $get_payment_detail = DB::table('payment_types')->select('id', 'payment_type')->where('status',1)->get();
        if($get_payment_detail)
        {
            foreach($get_payment_detail as $r){
                $opt[$r->id] = $r->payment_type;  
            }
        }
        return $opt;
    }
}

if (!function_exists('get_sub_category')) {
        
    function get_sub_category($field = 0)
    {
        //return DB::table('employees')->get();
        $get_subcategory_detail = '';
        $opt[''] ='Select Category';
        $get_subcategory_detail = DB::table('subcategory_models')->select('id', 'name')->where('status',1)->get();
        if($get_subcategory_detail)
        {
            foreach($get_subcategory_detail as $r){
                $opt[$r->id] = $r->name;  
            }
        }
        return $opt;
    }
}

if (!function_exists('gettodaydate')) {
        
    function gettodaydate($field = 0)
    {
        $dates = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        return $formattedDate = $dates->format('m/d/Y'); // Format as day/month/year
    }
}
if (!function_exists('gettodaytime')) {
        
    function gettodaytime($field = 0)
    {
        date_default_timezone_set('Asia/Kolkata');  // Set time Zone
        $currentTime = new DateTime(); // date time formate
       return  $currentTime->format("H:i"); 
    }
}
if (!function_exists('getday')) {
        
    function getday($field = 0)
    {
        date_default_timezone_set('Asia/Kolkata');  // Set time Zone
        $currentDate = new DateTime(); // date time formate
       return  $currentDate->format("d"); 
    }
}
if (!function_exists('getmonth')) {
        
    function getmonth($field = 0)
    {
        date_default_timezone_set('Asia/Kolkata');  // Set time Zone
        $currentDate = new DateTime(); // date time formate
       return  $currentDate->format("m"); 
    }
}
if (!function_exists('getyear')) {
        
    function getyear($field = 0)
    {
        date_default_timezone_set('Asia/Kolkata');  // Set time Zone
        $currentDate = new DateTime(); // date time formate
        return  $currentDate->format("Y"); 
    }
}

if(!function_exists('financial_year_check'))
{
    function financial_year_check()
    {
        $db_id ='';
        $display_year = '';
        date_default_timezone_set('Asia/Kolkata');  // Set time Zone
        $currentDate = new DateTime(); // date time formate
        $current_year = $currentDate->format("Y");  // Retrive Current Year
        $current_day_formated = $currentDate->format('d/m/Y');  // Retrive Current Date

        $financial_year_Date = new DateTime($current_year.'-03-31'); // Financial Year Date
        $financial_year_Date_formated = $financial_year_Date->format('d/m/Y');  // Financial Year Formated Date

        $currentDate_for_previous = new DateTime(); // date time formate
        $previous_year = $currentDate_for_previous->modify('-1 year'); //previous Year
        $previous_year_formated = $previous_year->format("Y");
       

        $currentDate_for_upcoming = new DateTime(); // date time formate
        $upcoming_year = $currentDate_for_upcoming->modify('+1 year'); //Upcoming Year
        $upcoming_year_formated = $upcoming_year->format("Y");
        $res = array();
    
        if($currentDate > $financial_year_Date) //Check Todays Date Greater then financial date
        {
           
           $db_year_compare =  $current_year.'-'.$upcoming_year_formated; //Concate current with upcoming
           $result = DB::table('years')
            ->select('*')
            ->where('display_year', '=', $db_year_compare)
            ->get();
          
            if($result->isNotEmpty())
            {
                $db_id = $result[0]->id;
                $display_year = $result[0]->display_year;
                array_push($res,$db_id);
                array_push($res,$display_year);

            }
            else
            {
                $db_id = DB::table('years')->insertGetId([
                    'display_year' => $db_year_compare,
                    'created_at' => now(),
                ]);
                if($db_id)
                {
                    DB::table('years')
                    ->where('id','<>', $db_id) // Assuming 'id' is the primary key
                    ->update([
                        'status' => '0',
                        //'updated_at' => now(),
                    ]);
                    array_push($res,$db_id);
                    array_push($res,$db_year_compare);
                }
            }
           
        }
        else
        {
            
            $db_year_compare = $previous_year_formated.'-'.$current_year; //Concate current with previous
            $result = DB::table('years')
            ->select('*')
            ->where('display_year', '=', $db_year_compare)
            ->get();
            if($result)
            {
                $db_id = $result[0]->id;
                $display_year = $result[0]->display_year;
                array_push($res,$db_id);
                array_push($res,$display_year);

            }
        }
        return $res;
       
    }
}
?>