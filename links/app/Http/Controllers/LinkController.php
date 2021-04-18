<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     *  The name of the controller corresponding model
     */
    protected $model = Link::class;
    
    /**
     * Add 
     */
    public function add(Request $request, Link $link){
        $data = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|url|max:255',
            'description' => 'required|max:255',
        ]);
        
        $link->title = $data['title'];
        $link->url = $data['url'];
        $link->description = $data['description'];

        // Save the model
        $link->save();

        return redirect('/');
    }
}
