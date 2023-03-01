<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Admins\Blog;
use Image;

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
    }
}
