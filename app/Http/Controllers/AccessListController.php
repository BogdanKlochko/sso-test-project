<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\User;
use Illuminate\Http\Request;

class AccessListController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('ACL.edit', [
            'user' => $user,
            'userBrokers' => $user->brokers()->get(),
            'brokers' => Broker::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $brokers = Broker::all()->pluck('id')->toArray();
        $user->brokers()->detach($brokers);

        if(isset($request->broker)) {
            $user->brokers()->attach($request->broker);
        }

        return redirect()->route('home');
    }
}
