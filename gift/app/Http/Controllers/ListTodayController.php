<?php

namespace App\Http\Controllers;

use App\Models\listToday;
use App\Http\Requests\StorelistTodayRequest;
use App\Http\Requests\UpdatelistTodayRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ListTodayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelistTodayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'=>'required|numeric',
            'albaqara' => 'required|boolean',
            'alanam' => 'required|boolean',
            'yaseen' => 'required|boolean',
            'prayed_qiyam' => 'required|boolean',
            'fasting' => 'required|boolean',
            'day' => 'required|string', // أو date حسب النوع المستخدم
        ]);
    
        listToday::create($data);
    
        return response()->json(['message' => 'تم الحفظ بنجاح']);
    }

public function index()
{
    $students = User::with('listToday')->get();

    $result = $students->map(function ($user) {
        $totalPoints = $user->listToday->sum(function ($activity) {
            return
                ($activity->albaqara ? 1 : 0) +
                ($activity->alanam ? 1 : 0) +
                ($activity->yaseen ? 1 : 0) +
                ($activity->prayed_qiyam ? 1 : 0) +
                ($activity->fasting ? 1 : 0);
        });

        return [
            'student_name' => $user->name,
            'points' => $totalPoints,
            'activities' => $user->listToday,
        ];
    });

    return response()->json($result);
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\listToday  $listToday
     * @return \Illuminate\Http\Response
     */
    public function show(listToday $listToday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\listToday  $listToday
     * @return \Illuminate\Http\Response
     */
    public function edit(listToday $listToday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelistTodayRequest  $request
     * @param  \App\Models\listToday  $listToday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelistTodayRequest $request, listToday $listToday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\listToday  $listToday
     * @return \Illuminate\Http\Response
     */
    public function destroy(listToday $listToday)
    {
        //
    }
    
}
