<?php

namespace App\Http\Controllers;

use App\Mail\NodesMail;
use App\Models\Device;
use App\Models\Node;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;

class DeviceController extends Controller
{

    public function create(Request $request)
    {
        $nodeData = $request->json('data');

        Device::create([
            'name' => $nodeData['name'],
            'ping' => $nodeData['ping'],
            'ip' => $nodeData['ip'],
            'email' => $nodeData['email'],
            'schedule' => implode(':',$nodeData['schedule']),
        ]);
    }

    public function show()
    {
//        Auth::validate();

        $aliveNodes = Node::where('active',1)->get();

        $lnamednodes = [];
        $selectNameNode = $aliveNodes->toArray();

        foreach ($selectNameNode  as $namenode)
        {
            $lnamednodes[] = (string) $namenode['nodename'];
        }

        $strNodes = implode('\',\'', $lnamednodes);
        $strNodes = "'".$strNodes."'";

        $fromDate = Carbon::now()->format('Y-m-d H:i');
        $toDate = Carbon::now()->subMinutes(2)->format('Y-m-d H:i:s');

        $listnodes = DB::table('nodes')
            ->join('devices','nodename','=','name')
            ->whereRaw("nodes.active = 1 and devices.created_at >'".
                $toDate."'")
            ->orderBy('devices.id','desc')->get();

        $allnodes = $listnodes->toArray();

        $oldnode = [];

        /* foreach ( $allnodes as $key => &$lnode) {
            if (in_array($lnode->name, $oldnode)) {
                unset($listnodes[$key]);
            }
        }

        foreach ($listnodes as &$node)
        {
            //$chkTimeStatus = Carbon::createFromFormat('Y-m-d H:i:s', $node->created_at);
            $flipArray = array_flip($lnamednodes);
            if (in_array($node->name, $lnamednodes))
            {
                unset($lnamednodes[$flipArray[$node->name]]);
            }

        } */
        $flipArray = array_flip ($lnamednodes);
        $oldNodes = [];
        $emailnode = [];
        foreach ($listnodes as $key => &$node)
        {
            //$chkTimeStatus = Carbon::createFromFormat('Y-m-d H:i:s', $node->created_at);
            if (in_array ($node->name, $oldNodes)) {
                unset ($listnodes[$key]);
            } else {
                $oldNode[] =$node->name;
            }

            if (in_array ($node->name, $lnamednodes))
            {
                unset ($lnamednodes[$flipArray[$node->name]]);
            }
            if ($node->ping == 1) {

                $gsch = explode (':',$node->schedule);

                $fTime = Carbon::createFromTime($gsch[0][0].$gsch[0][1],0,0, 'Europe/Madrid');
                $tTime = Carbon::createFromTime($gsch[1][0].$gsch[1][1],0,0, 'Europe/Madrid');
                $now = Carbon::now();

                if (!in_array($node->name, $emailnode ) && ($now > $fTime && $now < $tTime) )
                {
                    $lastActivity = DB::table('devices')
                                    ->select('ip','created_at','ping')
                                    ->whereRaw('name = \''.$node->name.'\' AND created_at > \''.
                                        Carbon::createFromFormat('d-m-Y H:i', date('d-m-Y 00:00')).'\'')
                                    ->orderBy('created_at','desc')
                                    ->get();

                    $total = DB::table('devices')
                            ->select('ping')
                            ->whereRaw('name = \''.$node->name.'\' AND ping=1 and created_at > \''.$now->firstOfMonth().'\'')
                            ->get();

                        $details = [
                        'title' => 'Se ha detectado una falla de conectividad con el punto de venta: '.$node->name,
                        'ip' => 'Punto de conectividad: '.$node->ip,
                        'tpv' => 'Punto de venta identificado: '.$node->name,
                        'actv' => $lastActivity->toArray(),
                        'lastMonth' => $total->count()
                    ];

                    Mail::to('juan.vazquezl@gmail.com') //$node->email
                        ->cc('juan.vazquezl@gmail.com')
                        ->send(new NodesMail($details));

                    $emailnode[] = $node->name;
                }

            }

        }


        return view('nodes', [
            'listnodes' => $listnodes,
            'activenodes' => $lnamednodes
        ]);
    }

    public function list()
    {
        Auth::validate();
    }

    public function store(Request $request)
    {
        $datanodes = $request->json();
        Device::create([
            'nodename' => $datanodes->nodename,
        ]);
    }

    public function getlastdata($name)
    {
        $search = DB::table('devices')
            ->orderBy('id', 'desc')
            ->where('name','=', $name)
            ->pluck('id');

            if(empty($search[0])){
                return response()->json([
                    'success' => [
                        0 => [
                            'created_at' => 'Sin registros'
                            ]
                        ]
                        ]);
            }

        $result = DB::table('devices')
            ->where('id', '=', $search[0])
            ->get();
        return response()->json(['success' => $result]);
    }
}
