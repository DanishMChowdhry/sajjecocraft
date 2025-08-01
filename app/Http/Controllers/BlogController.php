<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Blogs;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->content = $request->content;
        if ($request->hasFile('main_image')) {
            $main_image_path = ImageHelper::uploadImage($request->file('main_image'), 'images/blogs/main_image');
            $blog->main_image = $main_image_path;
        }
        $blog->slug = Str::slug($request->title);
        $blog->save();
        return redirect()->route('blogs.index')->with('status', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blogs::find($id);
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blogs::find($id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        if ($request->hasFile('main_image')) {
            $main_image_path = ImageHelper::uploadImage($request->file('main_image'), 'images/blogs/main_image');
            $blog->main_image = $main_image_path;
        }
        $blog->slug = Str::slug($request->title);
        $blog->save();
        return redirect()->route('blogs.index')->with('status', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blogs::find($id);
        $blog->delete();
        return redirect()->route('blogs.index')->with('status', 'Blog deleted successfully.');
    }


    public function uploadImage(Request $request)
    {
        // Validate the incoming file
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');

            // Handle the image upload using your ImageHelper
            try {
                $uploadPath = ImageHelper::uploadImage($image, 'images/upload');
                return response()->json([
                    'url' => asset($uploadPath),
                    'message' => 'Image uploaded successfully'
                ], 200);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Image upload failed: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'message' => 'No file uploaded.'
        ], 400);
    }
}
