<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\Ingredient;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        $foods = Food::all();

        $delimiter = ',';
        unset($contents[0]);
        $contents = array_values($contents);
        foreach ($contents as $content) {
            if($content != ""){
                $data = explode($delimiter, $content);
                $name = $data[0];
                $name = strtolower($name);
                $ingredient = Ingredient::create([
                    'name' => $name
                ]);
                foreach ($foods as $food) {
                    if (strpos(strtolower($food->recipe),$name) !== false) {
                        $food->ingredients()->attach($ingredient->id);
                    }
                }
            }
        }
        return back();
    }

    public function download()
    {
        $ingredients = Ingredient::all();
        $filename = "ingredients.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('id', 'name', 'image'));

        foreach ($ingredients as $ingredient)
        {
            fputcsv($handle, array($ingredient['id'],$ingredient['name'],$ingredient['image']));
        }

        fclose($handle);

        $headers = array('Content-Type' => 'text/csv',);

        return response()->download($filename, 'ingredients.csv', $headers);
    }
}
