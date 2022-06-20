<?php

namespace App\Http\Livewire;

use App\Models\Node;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class EditNodeForm extends Component
{
    public $nodename;
    public $active;
    public $manifesto;

    public $nodeData;

    public function mount($id)
    {
        $this->nodeData = Node::find($id);
        $this->nodename = $this->nodeData->nodename;
        $this->active = $this->nodeData->active;
        $this->manifesto = $this->nodeData->manifesto;
    }

    public function render()
    {
        return view('livewire.edit-node' , [
            'node' => $this->nodeData
        ]);
    }

    public function store(Request $request)
    {
        DB::table('nodes')
            ->where('id', $this->nodeData->id)
            ->update([
            'manifesto' => $this->manifesto,
            'active' => $this->active == true
                            ? 1
                            : 0,
            'updated_at' => Carbon::now()
        ]);

        return redirect(route('nodes.management'))->with('status', 'Modificado con éxito');
    }
}
