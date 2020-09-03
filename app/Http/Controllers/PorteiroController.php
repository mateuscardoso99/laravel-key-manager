<?php

namespace App\Http\Controllers;

use App\Models\Porteiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PorteiroController extends Controller
{
    protected $user_id;

    public function __construct(){
        $this->middleware('auth');

        $this->middleware(function($request,$next){
            $this->user_id = Auth::id();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $porteiros = Porteiro::where('user_id',$this->user_id)->get();
        return view('porteiro.index',['porteiros'=>$porteiros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('porteiro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Porteiro::create([
            'nome' => $data['nome'],
            'user_id' => $this->user_id,
        ]);
        return redirect()->route('porteiro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changeSituacao($id)
    {
        $porteiro = Porteiro::find($id);
        if($porteiro){
            if($porteiro->situacao === 'ativado'){
                $porteiro->situacao = 'desativado';
                $porteiro->save();
            }
            else if ($porteiro->situacao === 'desativado') {
                $porteiro->situacao = 'ativado';
                $porteiro->save();
            }
            
        }
        return redirect()->route('porteiro.index');
    }



    public function edit($id)
    {
        $porteiro = Porteiro::find($id);
        if($porteiro){
            return view('porteiro.update',['porteiro'=>$porteiro]);
        }
        return redirect()->route('porteiro.index');
    }


    public function update(Request $request, $id)
    {
        $porteiro = Porteiro::find($id);
        $data = $request->all();
        if ($porteiro) {
            $porteiro->nome = $data['nome'];
            $porteiro->save();
        }
        return redirect()->route('porteiro.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $porteiro = Porteiro::find($id);
        if($porteiro){
            $porteiro->delete();
        }
        return redirect()->route('porteiro.index');
    }
}
