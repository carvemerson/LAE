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
        $this->validateIp($request, 'unique:machines,ip_address');

        Machine::create($request->all() + ['created_by' => auth()->user()->id]);

        return redirect('/');
    }
    
    /**
     * Validate a IP address
     *
     * @param RegistrationRequest $request
     * @param String $ip_rule
     * @return void
     */
    public function validateIp(RegistrationRequest $request, $ip_rule)
    {
        $this->validate($request, [
            'ip_address' => $ip_rule, 
        ]);
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
    public function edit(Machine $machine)
    {
        $this->authorize('owner', $machine);
         
        $users = User::all();

        return view('machine.edit', compact('machine', 'users'));
    }

    /**
     * Update the specified machine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrationRequest $request, Machine $machine)
    {
        
        $this->validateIp($request, 'unique:machines,ip_address,'.$machine->id);

        $machine->update($request->all());

        return redirect('/');
    }

    /**
     * Remove the specified machine from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machine $machine)
    {
        $this->authorize('owner', $machine);
        
        Machine::find($machine->id)->delete();

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
     * @param Request $request
     * @return success (1) or fail (0)
     */
    public function ping(Request $request)
    {   
        return Machine::updateContact($request->all());
    }
}
