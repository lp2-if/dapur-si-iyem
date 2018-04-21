<?php

namespace App\Http\Controllers;

use App\Model\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function create()
    {
        $url = route('ingredient.store');
        return view('create', compact('url'));
    }

    public function store(Request $request)
    {
        $file = $request->file('file_input');
        $contents = file_get_contents($file, 'public');
        $contents = json_encode($contents);
        $contents = str_replace('"', null, $contents);
        $contents = explode('\n', $contents);

        $delimiter = ',';
        unset($contents[0]);
        $contents = array_values($contents);
        foreach ($contents as $content) {
            if($content != ""){
                $data = explode($delimiter, $content);
                $name = $data[0];
                Ingredient::create([
                    'name' => $name
                ]);
            }
        }
        return back();
    }
}
