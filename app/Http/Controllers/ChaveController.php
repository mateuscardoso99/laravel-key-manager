<?php

namespace App\Http\Controllers;

use App\Models\Chave;
use App\Models\Porteiro;
use App\Models\Professor;
use App\Models\Aluno;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AulaController;

class ChaveController extends Controller
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
        $chaves = Chave::where('user_id',$this->user_id)->with('porteiro')->get();
        return view('chave.index',['chaves'=>$chaves]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $porteiros = Porteiro::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        return view('chave.create',['porteiros'=>$porteiros]);
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
        Chave::create([
            'sala' => $data['sala'],
            'id_porteiro' => $data['sel_porteiros'],
            'user_id' => $this->user_id,
        ]);
        return redirect()->route('chave.index');
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
        $chave = Chave::find($id);
        if($chave){
            if($chave->situacao === 'ativado'){
                $chave->situacao = 'desativado';
                $chave->save();
            }
            else if ($chave->situacao === 'desativado') {
                $chave->situacao = 'ativado';
                $chave->save();
            }
          
        }
        return redirect()->route('chave.index');
    }



    public function edit($id)
    {
        $chave = Chave::find($id);
        $porteiros = Porteiro::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        if($chave){
            return view('chave.update',
                ['chave'=>$chave,'porteiros'=>$porteiros]
            );
        }
        return redirect()->route('chave.index');
    }


    public function update(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();
        if ($chave) {
            $chave->sala = $data['sala'];
            $chave->id_porteiro = $data['sel_porteiros'];
            $chave->save();
        }
        return redirect()->route('chave.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $chave = Chave::find($id);
        if($chave){
            $chave->delete();
        }
        return redirect()->route('chave.index');
    }


    public function managerChave($id)
    {
        $chave = Chave::find($id);

        if($chave){

            if ($chave->situacao === 'liberada') {
                $porteiros = Porteiro::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();

                $professores = Professor::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();

                $alunos = Aluno::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();
        
                return view('chave.liberar',
                    [
                        'chave'=>$chave,
                        'porteiros'=>$porteiros,
                        'professores'=>$professores,
                        'alunos'=>$alunos
                    ]
                );
            }
            else{
                return view('chave.devolver',['chave'=>$chave]);
            }
            
        }

        return redirect()->route('chave.index');
    }


    public function iniciarAula(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();

        if ($chave) {
            DB::transaction(function() use($data, $chave){
                $aula = app()->call('App\Http\Controllers\AulaController@store',['chave_id'=>$chave->id,'data'=>$data,'user_id'=>$this->user_id]);

                $chave->situacao = 'ocupada';
                $chave->save();
            });
        }
        return redirect()->route('chave.index');
    }


    public function encerrarAula(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();

        if ($chave) {
            DB::transaction(function() use($data, $chave){
                $aula = app()->call('App\Http\Controllers\AulaController@update',['chave_id'=>$chave->id,'data'=>$data,'user_id'=>$this->user_id]);

                $chave->situacao = 'liberada';
                $chave->save();
            
            });
        }
        return redirect()->route('chave.index');
    }
}
