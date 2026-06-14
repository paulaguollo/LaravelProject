<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Iniciativa;

class EventoController extends Controller
{
    public function index($iniciativa_id)
    {
        $iniciativa = Iniciativa::findOrFail($iniciativa_id);
        $eventos = Evento::where('iniciativa_id', $iniciativa_id)->get();

        return view('eventos.index', compact('iniciativa', 'eventos'));
    }

    public function create($iniciativa_id)
    {
        $iniciativa = Iniciativa::findOrFail($iniciativa_id);
        return view('eventos.create', compact('iniciativa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'            => 'required|string|max:100',
            'data_realizacao' => 'required|date',
            'imagem'          => 'nullable|image',
            'iniciativa_id'   => 'required|exists:iniciativas,id',
        ]);

        $caminho = null;
        if ($request->hasFile('imagem')) {
            $caminho = $request->file('imagem')->store('eventos', 'public');
        }

        Evento::create([
            'iniciativa_id'   => $request->iniciativa_id,
            'nome'            => $request->nome,
            'data_realizacao' => $request->data_realizacao,
            'imagem'          => $caminho,
        ]);

        return redirect()->route('eventos.index', $request->iniciativa_id)->with('message', 'Evento criado com sucesso!');
    }

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome'            => 'required|string|max:100',
            'data_realizacao' => 'required|date',
            'imagem'          => 'nullable|image',
        ]);

        $evento = Evento::findOrFail($request->id);

        $caminho = $evento->imagem;
        if ($request->hasFile('imagem')) {
            $caminho = $request->file('imagem')->store('eventos', 'public');
        }

        $evento->nome            = $request->nome;
        $evento->data_realizacao = $request->data_realizacao;
        $evento->imagem          = $caminho;
        $evento->save();

        return redirect()->route('eventos.index', $evento->iniciativa_id)->with('message', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $iniciativa_id = $evento->iniciativa_id;
        $evento->delete();

        return redirect()->route('eventos.index', $iniciativa_id)->with('message', 'Evento eliminado.');
    }
}
