@extends('admin.layouts.admin_master')
@section('title')
    Edit blog
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Update blog </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Blog title-{{ $locale['native'] }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="controls">
                                                    <input type="text" name="blog_title[{{ $key }}]"
                                                        class="form-control" id="blog_title"
                                                        value="{!!$blog->getTranslation('title', $key)!!}">
                                                    @error("blog_title.{$key}")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Blog image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="blog_image" class="form-control"
                                                    id="blog_image" value={{$blog->image}}>
                                                @error('blog_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Blog image preview</h5>
                                            <div class="widget-user-image">
                                                <img class="rounded-circle"
                                                    src="{{asset($blog->image)}}"
                                                    style="width:100px; height:70px;" alt="User Avatar"
                                                    id="blog_image_preview">

                                            </div>
                                        </div>
                                    </div>
                                </div>




                                @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Short blog-{{ $locale['native'] }}<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor{{ $loop->iteration }}" name="short_blog[{{ $key }}]" rows="10" cols="100">
                                                 {!!$blog->getTranslation('short_blog', $key)!!}
                                                    </textarea>
                                                    @error('short_blog.' . $key)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                <hr>
                                 @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Full blog-{{ $locale['native'] }}<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="blog_editor{{ $loop->iteration }}" name="full_blog[{{ $key }}]" rows="10" cols="100">
                                                 {!!$blog->getTranslation('full_blog', $key)!!}
                                                    </textarea>
                                                    @error('full_blog.' . $key)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach


                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update blog" title="Update blog">
                        </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#blog_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blog_image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        })
        </script>
@endsection
