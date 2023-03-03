<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Admins\Blog;
use Image;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function blogView()
    {

        $blogs = Blog::all();
        return view('admin.blogs.blogView', compact('blogs'));
    }
    public function addBlog()
    {
        return view('admin.blogs.add_blog');
    }

    public function storeBlog(BlogRequest $request)
    {
        $validatedData = $request->validated();
        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(389, 216)->save('blogs/' . $name_gen);
        $save_url = 'blogs/' . $name_gen;
        $blog=new Blog();
        $blog->title            =$validatedData['blog_title'];
        $blog->short_blog       =$validatedData['short_blog'];
        $blog->full_blog        =$validatedData['full_blog'];
        $blog->image            =$save_url;
        $blog->save();
        $notification = array('message' => 'Blog recorded', 'alert-type' => 'success');
        return redirect()->route('admin.manage.blogs')->with($notification);
    }

    public function editBlog($id) {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.editBlog', compact('blog'));
    }
    public function updateBlog(BlogRequest $request, $id) {
        $validatedData = $request->validated();

        $blog = Blog::findOrFail($request->id);

        $blog->title = $validatedData['blog_title'];
        $blog->short_blog = $validatedData['short_blog'];
        $blog->full_blog = $validatedData['full_blog'];

        if ($request->hasFile('blog_image')) {
            $oldImagePath = $blog->image;

            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(389, 216)->save('blogs/' . $name_gen);
            $save_url = 'blogs/' . $name_gen;
            $blog->image = $save_url;

            // delete the old image file
            Storage::delete($oldImagePath);
        }
        $blog->save();
        $notification = array('message' => 'Blog updated', 'alert-type' => 'success');
        return redirect()->route('admin.manage.blogs')->with($notification);

    }
}
