<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use Intervention\Image\Facades\Image;
//use App\multi_image;
//
//class MultipleUploadController extends Controller
//{
//    function index()
//    {
//        return view('multiple_file_upload');
//    }
//
//    function upload(Request $request)
//    {
//        if($request->hasFile('img'))
//        {
//            $image = $request->file('img');
//            $image_ext = $image->getClientOriginalExtension();
//            $new_image_name = rand().".".$image_ext;
//            $destination_path = public_path('/images');
//            $image->move($destination_path, $new_image_name);
//
//            $multi_image = new multi_image;
//            $multi_image->post_id = 2;
//            $multi_image->image = $new_image_name;
//
//            if($multi_image->save())
//            {
//                return back()->with('msg', 'Success!');
//            }
//        }
//        else
//        {
//            return back()->with('msg', 'Please upload image');
//        }
//
//    }
//}


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultipleUploadController extends Controller
{
    function index()
    {
        return view('multiple_file_upload');
    }

    function upload(Request $request)
    {
        $image_code = '';
        $image = $request->file('file');
//        foreach ($images as $image) {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/images/' . $new_name . '" class="img-thumbnail" /></div>';
//        }

        $output = array(
            'success' => 'Images uploaded successfully',
            'image' => $image_code
        );

//        return response()->json($output);
        return redirect("multiple-file-upload/upload")->with('image');
    }
}
