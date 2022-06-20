<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeController extends Controller
{
    public function edit($id)
    {
        return view('edit-node', [
         'node' => Node::find($id)
        ]);
    }

    public function destroy($id)
    {
        Node::destroy($id);
        return redirect(route('nodes.management'))->with('status','Eliminado con éxito');
    }
}
