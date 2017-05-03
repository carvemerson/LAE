<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Machine;
use App\User;
use App\Http\Requests\RegistrationRequest;
use Carbon\Carbon;

class NewMachineController extends Controller
{
    /**
     * Display a listing of the machine.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::all();

        if(auth()->check()){
            return view('machine.index', compact(['machines']));
        }else{
            return view('machine.show', compact(['machines']));
        }
    }

    /**
     * Show the form for creating a new machine.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('machine.create', compact(['users']));
    }

    /**
     * Store a newly created machine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        Machine::create($request->all() + ['created_by' => auth()->user()->id]);

        return redirect('/');
    }

    /**
     * Display the specified machine.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect("/");
    }

    /**
     * Show the form for editing the specified machine.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $machine = Machine::find($id);
        
        if($machine->created_by == auth()->user()->id){
        
            $users = User::all();
            return view('machine.edit', compact('machine', 'users'));
        
        }else{
            return redirect()->home();
        }
    }

    /**
     * Update the specified machine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrationRequest $request, $id)
    {
        Machine::find($id)->update($request->all());

        return redirect('/');
    }

    /**
     * Remove the specified machine from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Machine::where(['id' => $id, 'created_by' => auth()->user()->id])->delete();

        return redirect('/');
    }


    /**
     * Calculate the last ping done by any registered machine
     *
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
        return Machine::statusPing();
    }

     /**
     * Receive ping request from all registered machines
     *
     * @return success (1) or fail (0)
     */
    public function ping(Request $request)
    {   
        return Machine::updateContact($request->all());
    }
}
