<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller{

    public function getAll(){
        $books = Book::all();
        return response() -> json($books, 200);
    }

    public function getById($id){
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Não existe um livro com o id: '. $id . '.'], 404);
        }
        return response()->json($book, 200);
    }

    public function create(Request $request){

        $request->validate([
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'classificacao' => 'required|integer|min:1|max:5',
            'resenha' => 'nullable|string',
        ]);

        $book = new Book([
            'titulo' => $request->input('titulo'),
            'autor' => $request->input('autor'),
            'classificacao' => $request->input('classificacao'),
            'resenha' => $request->input('resenha'),
            'data_adicao' => now(),
        ]);

        $book -> save();
        return response()->json(['message' => 'O livro ' . $book -> titulo . ' foi adiconado com sucesso!'], 201);
    }

    public function updateById(Request $request, $id){
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Não existe um livro com o id: '. $id . '.'], 404);
        }

        $request->validate([
            'titulo' => 'string',
            'autor' => 'string',
            'classificacao' => 'integer|min:1|max:5',
            'resenha' => 'string',
        ]);

        $book->update($request->all());
        return response()->json(['message' => 'Livro atualizado com sucesso!'], 200);
    }

    public function deleteById($id){
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Não existe um livro com o id: '. $id . '.'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Livro com id:'. $id . ' deletado com sucesso!'], 200);
    }


}
