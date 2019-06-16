<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Post;
use App\User;
use DB;

class PostsController extends Controller
{
    public function index() {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->simplePaginate(6);
        return view('photos.index', compact('posts'));
    }

    public function upload() {
        return view('photos.upload');
    }

    public function search() {
        $q = Input::get ( 'byAuthor' );
        $q2 = Input::get ( 'byCategory' );

        if(empty($q) && empty($q2)) return view('photos.search');

        if(empty($q2)) {
            $posts = DB::table('posts')->where('uploaded_by','LIKE','%'.$q.'%')->get();
        } else if(empty($q1)) {
            $posts = DB::table('posts')->where('category','LIKE','%'.$q2.'%')->get();
        } else {
            $posts = DB::table('posts')->where('uploaded_by','LIKE','%'.$q.'%')->andWhere('category','LIKE','%'.$q2.'%')->get();
        }
     
        return view('photos.search', compact('posts'));
    }
    

    public function viewAll() {
       $posts = DB::table('posts')->simplePaginate(6); 
       return view('photos.all', compact('posts'));
    }
    
    public function viewImg($id) {
        $filepath = DB::table('posts')->where('id', $id)->pluck('filename');
        $name = DB::table('posts')->where('id', $id)->pluck('title');
        $description = DB::table('posts')->where('id', $id)->pluck('description');

        /*
         * Dont mind this
         * Just some probably awful practice to parse the db response
         */

        $skips = ["[","]","\"", "\\"];

        $filepath = str_replace($skips, '', $filepath);
        $filepath = str_replace(' ', '', $filepath);
        $name = str_replace($skips, '', $name);
        $description = str_replace($skips, '', $description);
    

        return view('photos.photo')->with(['filepath'=>'../images/'.$filepath, 'name'=>$name, 'description'=>$description]);
        
    }

    public function store()
    {

        // Check for valid file
        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // To do: resize image

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        $name = request()->name;
        $description = request()->description;
        $category = request()->category;
        $id = Auth::user()->id;
        $currentuser = User::find($id);

        // Create model instance
        $post = new Post();
        $post->filename = $imageName;
        $post->filepath = 'images'.'/'.$imageName;
        $post->uploaded_by = $currentuser->name;
        $post->title = $name;
        $post->description = $description;
        $post->category = $category;

        // Save to the database and the local file system 
        $post->save();

        request()->image->move(public_path('images'), $imageName);


        return back()
        ->with('success','You have uploaded an image.')  
        
        ->with('image',$imageName);

    }
}
