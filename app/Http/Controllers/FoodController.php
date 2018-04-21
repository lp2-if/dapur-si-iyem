<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\Ingredient;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function create()
    {
        $url = route('food.store');
        return view('create', compact('url'));
    }

    public function store(Request $request)
    {
        $file = $request->file('file_input');
        $contents = file_get_contents($file, 'public');
        $contents = json_encode($contents);
        $contents = str_replace('"', null, $contents);
        $contents = explode('\n', $contents);

        $ingredients = Ingredient::all();

        $delimiter = ',';
        unset($contents[0]);
        $contents = array_values($contents);
        foreach ($contents as $content) {
            if($content != ""){
                $data = explode($delimiter, $content);
                $name = $data[0];
                $tutorial = $data[1];
                $recipe = $data[2];
                $image = $data[3];
                $food = Food::create([
                    'name' => $name,
                    'tutorial' => $tutorial,
                    'recipe' => $recipe,
                    'image' => $image
                ]);
                foreach ($ingredients as $ingredient) {
                    if (strpos(strtolower($food->recipe),$ingredient->name) !== false) {
                        $ingredient->foods()->attach($food->id);
                    }
                }
            }
        }
        return back();
    }

    public function download($id=0)
    {
        if($id==0){
            $res = Food::select('name','tutorial','recipe')->get();
            $filename = "all_recipes.csv";
        }
        else{
            $res = Food::select('name','tutorial','recipe')->where('id',$id)->first();
            $filename = $res['name'].".csv";
        }
        $str = "name,tutorial,recipe\n";
        foreach ($res as $key) {
            $str .= $key['name'].','.$key['tutorial'].','.$key['recipe']."\n";
        }
        $file = fopen($filename,"w");
        fwrite($file,$str);
        fclose($file);
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
