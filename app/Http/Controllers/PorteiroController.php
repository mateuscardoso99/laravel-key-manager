<?php

namespace App\Http\Controllers;

use App\Models\Porteiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PorteiroController extends Controller
{
    protected $user_id;

    /* pegando o id do usuário logado */

    public function __construct(){
        $this->middleware('auth');

        $this->middleware(function($request,$next){
            $this->user_id = Auth::id();
            return $next($request);
        });
    }
    
    /*
     retorna a view index com os porteiros cadastrados
     */
    public function index()
    {
        $porteiros = Porteiro::where('user_id',$this->user_id)
        ->paginate(10);
        return view('porteiro.index',['porteiros'=>$porteiros]);
    }


    /*
     insere um porteiro no banco
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


    /*
     ativa ou desativa o porteiro com base na situação atual
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


    /*
    atualiza um porteiro no banco
    */
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
     * Remove um porteiro do banco de dados
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
