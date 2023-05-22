@extends('admin.layouts.admin_master')
@section('title')
    Dashboard
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
                    <h4 class="box-title">Edit Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row">
                                            <!-- start 1st row  -->
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select
                                                                Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}"
                                                                    {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                                    {{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select
                                                                Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $products->category_id ? 'selected' : '' }}>
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select
                                                                SubCategory</option>

                                                            @foreach ($subcategory as $sub)
                                                                <option value="{{ $sub->id }}"
                                                                    {{ $sub->id == $products->subcategory_id ? 'selected' : '' }}>
                                                                    {{ $sub->subcategory_name }}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subsubcategory_id" class="form-control"
                                                            required="">
                                                            <option value="" selected="" disabled="">Select
                                                                SubSubCategory</option>

                                                            @foreach ($subsubcategory as $subsub)
                                                                <option value="{{ $subsub->id }}"
                                                                    {{ $subsub->id == $products->subsubcategory_id ? 'selected' : '' }}>
                                                                    {{ $subsub->subsubcategory_name }}</option>
                                                            @endforeach

                                                        </select>
                                                        @error('subsubcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 1st row  -->
                                        <div class="row">
                                             @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product name-{{ $locale['native'] }} <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_name[{{ $key }}]"
                                                                class="form-control" id="product_name"
                                                                value="{{$products->getTranslation('product_name', $key)}}">
                                                            @error("product_name.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ $products->product_code }}">
                                                    </div>
                                                    @error('product_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control"
                                                            value="{{ $products->product_qty }}">
                                                    </div>
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $products->id }}">





                                        <div class="row">
                                            <!-- start 1st row  -->
                                             @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product tags-{{ $locale['native'] }} <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_tags[{{ $key }}]"
                                                                class="form-control" id="product_name"
                                                                value="{{$products->getTranslation('product_tags', $key)}}">
                                                            @error("product_tags.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product size <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size" class="form-control"
                                                            value="{{ $products->product_size }}" data-role="tagsinput">
                                                        @error('product_size')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                             @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Product colors-{{ $locale['native'] }} <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_color[{{ $key }}]"
                                                                class="form-control" id="product_color"
                                                                value="{{$products->getTranslation('product_color_en', $key)}}">
                                                            @error("product_color.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product selling price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling price" class="form-control"
                                                            value="{{ $products->selling_price }}">
                                                    </div>
                                                    @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product discount price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount price" class="form-control"
                                                            value="{{ $products->discount_price }}">
                                                    </div>
                                                    @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Main Thambnail <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="product_thambnail"
                                                            class="form-control" id="product_trambnail"  value="{{ old('product_thambnail') }}">
                                                        @error('product_thambnail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Main Thambnail preview</h5>
                                                    <div class="widget-user-image">
                                                        <img class="rounded-circle"
                                                            src="{{ $products->product_thambnail ? asset($products->product_thambnail) : url('no_image.jpg') }}"
                                                            style="width:100px; height:70px;" alt="User Avatar"
                                                            id="product_trambnail_preview">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                             @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Short Description-{{ $locale['native'] }} <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">

                                                        <textarea name="short_descp[{{ $key }}]" id="textarea"
                                                         class="form-control" required
                                                         placeholder="Textarea text">{{$products->getTranslation('short_description', $key)}}</textarea>
                                                            @error("short_descp.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="row">
                                             @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Long Description-{{ $locale['native'] }} <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">

                                                        <textarea name="long_descp[{{ $key }}]" id="editor{{ $loop->iteration }}" rows="10" cols="100"
                                                         class="form-control" required
                                                         placeholder="Textarea text">{{$products->getTranslation('long_description', $key)}}</textarea>
                                                            @error("long_descp.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            {{-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5>Long Description<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor" name="long_descp" rows="10" cols="100">{!! $products->long_description !!}</textarea>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>

                                                            <input type="checkbox" name="hot_deals" id="hot_deals"
                                                                value="1"{{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                                            <label for="hot_deals">Hot deals</label>
                                                        </fieldset>
                                                        <fieldset>

                                                            <input type="checkbox" id="featured" name="featured"
                                                                value="1"
                                                                {{ $products->featured == 1 ? 'checked' : '' }}>
                                                            <label for="featured">Featured</label>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="special_offer"
                                                                name="special_offer" value="1"
                                                                {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                                            <label for="special_offer">Special offer</label>
                                                        </fieldset>
                                                        <fieldset>

                                                            <input type="checkbox" id="Special deals"
                                                                name="special deals" value="1"
                                                                {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                                            <label for="Special deals">Special deals</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                            value="Update Product">
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

        </section>
        <!-- /.content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                        </div>


                        <form method="POST" action="{{ route('admin.update.product.image') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row row-sm">
                                @foreach ($multiImgs as $img)
                                    <div class="col-md-3">

                                        <div class="card">
                                            <img src="{{ asset($img->photo_name) }}" class="card-img-top"
                                                style="height: 200px; width: 280px;">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{route('admin.delete.product.image', $img->id)}}" class="btn btn-sm btn-danger" id="delete"
                                                        title="Delete Data"><i class="fa fa-trash"></i> </a>
                                                </h5>
                                                <p class="card-text">
                                                <div class="form-group">
                                                    <label class="form-control-label">Change Image <span
                                                            class="tx-danger">*</span></label>
                                                    <input class="form-control" type="file"
                                                        name="multi_img[ {{$img->id }}]" value="{{$img->photo_name}}">
                                                </div>
                                                </p>

                                            </div>
                                        </div>

                                    </div><!--  end col md 3		 -->
                                @endforeach

                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                            </div>
                            <br><br>



                        </form>





                    </div>
                </div>



            </div> <!-- // end row  -->

        </section>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_trambnail').change(function(e) {
                $('#product_trambnail_preview').html('');
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#product_trambnail_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });


            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $('select[name="subcategory_id"]').append(
                                '<option value="">Select it</option>');
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
            $('select[name="subcategory_id"]').on('change', function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/subsubcategory/ajax') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subsubcategory_name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });


        });

        $('#multiImg').on('change', function() { //on file input change

            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                $('#images_preview').html('');

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target
                                        .result).width(80)
                                    .height(80); //create image element
                                $('#images_preview').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    </script>
@endsection
