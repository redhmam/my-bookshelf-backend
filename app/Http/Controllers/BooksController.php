<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use App\Book;

class BooksController extends Controller
{
    public function create(Request $request)
    {
  
        $this->validate($request, [
            'bid' => 'required|unique:books',
            'title' => 'required',
            'image' => 'required'
        ]);

        $user = Auth::user();

        $result = $user->books()->create([
            'bid' => $request->input('bid'),
            'title' => $request->input('title'),
            'image' => $request->input('image'),
            'is_favorite' => $request->input('is_favorite', 0),
            'list' => $request->input('is_favorite', null)
        ]);
 
        return response()->json([
            'book' => $result->toArray()
        ]);
  
    }

    public function getAll(Request $request)
    {

        return response()->json([
            'books' => Book::where('user_id', Auth::user()->id)->get()->toArray()
        ]);
  
    }

    public function delete(Request $request, $id)
    {

        $response = Book::where('user_id', Auth::user()->id)->where('id', $id)->delete();

        if($response){
            return response()->json([
                'response' => 'Book has been deleted.'
            ]);
        }else{
            return response()->json([
                'response' => 'Something is wrong! Please try again.'
            ], 500);
        }
  
    }
}
