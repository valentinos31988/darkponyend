<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::latest()->get();
            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a class="btn btn-info" href="'.route('posts.edit',$row->id).'">Edit</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('posts.list');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $request->validate([
            'title' => 'required',
            'wysiwyg_text' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($image = $request->file('image')) {
            $imagename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $data['img_location'] = public_path('images') . "/" . $imagename;
        }

        Post::create($data);
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');

        //
    }


    public function changetatus(Request $request)
    {

        $id = $request->input('id');
        $post = Post::findOrFail($id);
        if ($post->status) {
            $post->status=0;
        }else
            {
                $post->status=1;
            }
        $post->save();
        return redirect()->route('posts.index')
            ->with('success', 'Status updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $request->validate([
            'title' => 'required',
            'wysiwyg_text' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($image = $request->file('image')) {
            $imagename = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $data['img_location'] = public_path('images') . "/" . $imagename;
        }
        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post Updated successfully.');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }
    public function api_find($id)
    {

        return Post::findOrFail($id);
    }
    public function api_destroy($id)
    {

        $response=Post::findOrFail($id)->delete();


        return 204;
    }
    public function api_add(Request $request)
    {
        return Post::create($request->all);
    }

    public function api_update(Request $request,$id)
    {   $post=Post::findOrFail($id);
        $post->update($request->all());
        return $post;
    }

}
