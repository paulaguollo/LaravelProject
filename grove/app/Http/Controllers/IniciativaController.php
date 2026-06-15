<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iniciativa;
use Illuminate\Support\Facades\Storage;

class IniciativaController extends Controller
{
    public function index(Request $request)
    {
        $query = Iniciativa::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        $iniciativas = $query->with('eventos')->get();

        return view('iniciativas.index', compact('iniciativas'));
    }

    public function create()
    {
        return view('iniciativas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:100',
            'categoria' => 'required|string',
            'descricao' => 'required',
            'imagem'    => 'nullable|image',
        ]);

        $caminho = null;
        if ($request->hasFile('imagem')) {
$caminho = Storage::disk('public')->putFile('iniciativas', $request->file('imagem'));
        }

        Iniciativa::create([
            'nome'      => $request->nome,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao,
            'imagem'    => $caminho,
        ]);

        return redirect()->route('iniciativas.index')->with('message', 'Iniciativa criada com sucesso!');
    }

    public function edit($id)
    {
        $iniciativa = Iniciativa::findOrFail($id);
        return view('iniciativas.edit', compact('iniciativa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:100',
            'categoria' => 'required|string',
            'descricao' => 'required',
            'imagem'    => 'nullable|image',
        ]);

        $iniciativa = Iniciativa::findOrFail($request->id);

        $caminho = $iniciativa->imagem;
        if ($request->hasFile('imagem')) {
            $caminho = Storage::putFile('iniciativas', $request->file('imagem'));
        }

        $iniciativa->nome      = $request->nome;
        $iniciativa->categoria = $request->categoria;
        $iniciativa->descricao = $request->descricao;
        $iniciativa->imagem    = $caminho;
        $iniciativa->save();

        return redirect()->route('iniciativas.index')->with('message', 'Iniciativa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $iniciativa = Iniciativa::findOrFail($id);
        $iniciativa->delete();

        return redirect()->route('iniciativas.index')->with('message', 'Iniciativa eliminada.');
    }
}
