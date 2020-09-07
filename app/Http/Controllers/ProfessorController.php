<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Http\Requests\ProfessorRequest;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
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
     retorna a view index com os professores cadastrados
     */
    public function index()
    {
        $profs = Professor::where('user_id',$this->user_id)
        ->paginate(10);
        return view('professor.index',['profs'=>$profs]);
    }


    /*
     insere um professor no banco
     */
    public function store(ProfessorRequest $request)
    {
        $data = $request->validated();
        Professor::create([
            'nome' => $data['nome'],
            'graduacao' => $data['graduacao'],
            'user_id' => $this->user_id,
        ]);
        return redirect()->route('professor.index');
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
     ativa ou desativa o professor com base na situação atual
     */

    public function changeSituacao($id)
    {
        $prof = Professor::find($id);
        if($prof){
            if($prof->situacao === 'ativado'){
                $prof->situacao = 'desativado';
                $prof->save();
            }
            else if ($prof->situacao === 'desativado') {
                $prof->situacao = 'ativado';
                $prof->save();
            }
          
        }
        return redirect()->route('professor.index');
    }


    /*
    atualiza um professor no banco
    */
    public function update(ProfessorRequest $request, $id)
    {
        $prof = Professor::find($id);
        $data = $request->validated();
        if ($prof) {
            $prof->nome = $data['nome'];
            $prof->graduacao = $data['graduacao'];
            $prof->save();
        }
        return redirect()->route('professor.index');
        
    }

    /**
     * Remove um professor do banco de dados
     */
    public function delete($id)
    {
        $prof = Professor::find($id);
        if($prof){
            $prof->delete();
        }
        return redirect()->route('professor.index');
    }
}
