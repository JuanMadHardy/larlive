<?php

namespace App\Http\Livewire;

use App\Models\Node;
use Livewire\Component;
use Livewire\WithPagination;

class NodesManagement extends Component
{
    use WithPagination;
    
    public $search;

    public function render()
    {
        return view('livewire.nodes-management', [
            'nodos' => Node::where('nodename', 'LIKE', '%'.$this->search.'%')
                ->orderBy('active','desc')
                ->orderBy('id','asc')
                ->paginate(8),
        ] );
    }
}
