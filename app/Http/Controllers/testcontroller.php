<?php

namespace App\Http\Controllers;

use App\multi_image;
use App\Post;
use DB;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function upload(Request $request, Post $post)
    {

        if($request->hasFile('img'))
        {
            $image_array = $request->file('img');

            $array_len = count($image_array);
            for($i=0; $i<$array_len; $i++)
            {
                $image_ext = $image_array[$i]->getClientOriginalExtension();

                $new_image_name = rand().".".$image_ext;
                $destination_path = public_path('/images');

                $image_array[$i]->move($destination_path, $new_image_name);

                $multi_image = new multi_image;
                $multi_image->post_id = $last_id;
                $multi_image->image = $new_image_name;
                $multi_image->save();
            }
            return redirect()->back()->with('msg', 'all done');
        }
        else
        {
            return back()->with('msg','Please');
        }
    }
}
