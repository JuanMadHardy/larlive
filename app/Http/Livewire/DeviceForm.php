<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeviceForm extends Component
{



    public $nodename;
    public $active;
    public $manifesto;

    protected $rules = [
        'nodename' => 'required|min:8|max:30|unique:nodes',
        'manifesto' => 'max:100'
    ];
    protected $validationAttributes = [

        'nodename' => 'Nombre',
        'manifesto' => 'Observaciones'

    ];

    protected $messages = [
        'nodename.unique' => 'El nombre de nodo ya está en uso. Indique otro.'
    ];

    public function render()
    {
        return view('livewire.device-form');
    }

    public function storeNode()
    {
        $validateData = $this->validate();

        DB::table('nodes')->updateOrInsert([
            'nodename' => $this->nodename,
            'manifesto' => $this->manifesto,
            'active' => $this->active,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->to(route('nodes.management'))->with('status','Creado con éxito');
    }

}
