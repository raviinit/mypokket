<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Models\Mpokket;

class MpokketController extends Controller
{
    /**
     * Q1. Return user attributes in a JSON format. (for a single id and/or multiple ids)
     *
     * Method: returnUserInfoJson()
     * Usage: 
     * http://local.mpokket.com/getuserinfojson?id=1
     * Or
     * http://local.mpokket.com/getuserinfojson?id=1,4
     * 
     * @return object
     * 
     */
    public function returnUserInfoJson()
    {
        $input = $_GET;
        $idVal = (array)explode(',', $input['id']);

        return $idVal;
        
        // With DB facade library returns based on 'id' input value
        // $users = DB::table('tbl_users')->whereIn('id', $idVal)->get() ?? abort(404); 
        // 
        // With model returns all
        // $users = Mpokket::select('*')->get();
        
        // With model returns based on 'id' input value
        //$users = Mpokket::select('*')->whereIn('id', $idVal)->get()->toJson() ?? abort(404);
        //return $users;
        
        $users = Mpokket::select('*')->whereIn('id', $idVal)->get() ?? abort(404);
        // returns the JSON data
        return json_encode($users);
    }
    
    
    /**
     * Q2. If fmt is set, return the data in a comma separated format. (for the given id/ids). This doesn’t have to be a file
     * 
     * Method: returnUserInfoComma()
     * Usage: 
     * http://local.mpokket.com/getuserinfocomma?id=1
     * Or
     * http://local.mpokket.com/getuserinfocomma?id=1,4
     * 
     * @return object
     * 
     */
    public function returnUserInfoComma()
    {
        $input = $_GET;
        $idVal = (array)explode(',', $input['id']);
        
        // With model returns based on 'id' input value
        $users = Mpokket::select('*')->whereIn('id', $idVal)->get() ?? abort(404);
        
        // Returns the comma separated data; JSON data altered and R&D should be done based on requirement
        return substr(json_encode($users), 1, -1);
    }
    
    
}
