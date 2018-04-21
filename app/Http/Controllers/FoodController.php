<?php

namespace App\Http\Controllers;

use App\Model\Food;
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

        $delimiter = ',';
        unset($contents[0]);
        $contents = array_values($contents);
        foreach ($contents as $content) {
            if($content != ""){
                $data = explode($delimiter, $content);
                $name = $data[0];
                $tutorial = $data[1];
                $recipe = $data[2];
                Food::create([
                    'name' => $name,
                    'tutorial' => $tutorial,
                    'recipe' => $recipe
                ]);
            }
        }
        return back();
    }
}
