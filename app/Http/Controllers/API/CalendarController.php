<?php

namespace App\Http\Controllers\API;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    public function getAllCalendars() {
        $calendars = Calendar::all();

        return response(['status' => 'success', 'status_code' => 200, 'message' => 'Calendar data get', 'data' => $calendars]);
    }

    public function getCalendar(Request $request, $id) {
        $calendar = Calendar::find($id);
        if ($calendar) {
            return response(['status' => 'success', 'status_code' => 200, 'message' => 'Calendar data get', 'data' => $calendar]);
        } else {
            return response(['status' => 'fail', 'status_code' => 402, 'message' => 'No calendar found', 'data' => []]);
        }

    }

    public function createCalendar(Request $request) {
        $rules = array(
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required'
        );

        $validator=Validator::make($request->all(),$rules);
        if (isset($validator) && $validator->fails()) {
            return response(['status' => 'error', 'status_code' => 400, 'message' => 'Missing data', 'data' => '']);
        }else{
            $calendar = Calendar::create(['user_id' => $request->input('user_id'), 'name' => $request->input('name'),'description' => $request->input('description')]);
            return response(['status' => 'success', 'status_code' => 200, 'message' => 'Calendar created successfully.', 'data' => $calendar]);
        }
    }
}
