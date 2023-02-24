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
                    <h4 class="box-title">Add Product </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row">
                                            <!-- start 1st row  -->
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select
                                                                Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}
                                                                </option>
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
                                                        <select name="category_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select
                                                                Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
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
                                                        <select name="subcategory_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select
                                                                SubCategory</option>

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
                                                        <select name="subsubcategory_id" class="form-control">
                                                            <option value="" selected="" disabled="">Select
                                                                SubSubCategory</option>

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
                                                                value="{{ old('product_name.' . $key) }}">
                                                            @error("product_name.{$key}")
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div class="row">
                                        <hr>
                                        <div class="row">


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product code <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            value="{{ old('product_code') }}">
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
                                                            value="{{ old('product_qty') }}">
                                                    </div>
                                                    @error('product_qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <!-- start 1st row  -->
                                        @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tags-{{ $locale['native'] }} <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags[{{ $key }}]"
                                                            class="form-control" value="{{ old('product_tags.' . $key) }}"
                                                            data-role="tagsinput">
                                                        @error('product_tags.' . $key)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product size <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_size" class="form-control"
                                                    value="X, XL" data-role="tagsinput">
                                                @error('product_size')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product color -{{ $locale['native'] }}<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color[{{ $key }}]"
                                                        class="form-control" value="{{ old('product_color.' . $key) }}"
                                                        data-role="tagsinput">
                                                    @error('product_color.' . $key)
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
                                                    value="{{ old('selling_price') }}">
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
                                                    value="{{ old('discount_price') }}">
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
                                                <input type="file" name="product_thambnail" class="form-control"
                                                    id="product_trambnail">
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
                                                <img class="rounded-circle" src="{{ url('no_image.jpg') }}"
                                                    style="width:100px; height:70px;" alt="User Avatar"
                                                    id="product_trambnail_preview">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <h5>Multiple Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="multi_img[]" class="form-control"
                                                    multiple="" id="multiImg">
                                                @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Images preview</h5>
                                            <div class="widget-user-image" id="images_preview">


                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short Description -{{ $locale['native'] }}<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp[{{ $key }}]" id="textarea" class="form-control"
                                                        placeholder="{{ $locale['native'] }}" value="{{ old('short_descp.' . $key) }}">

                                                    </textarea>
                                                    @error('short_descp.' . $key)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 6 -->
                                    @endforeach
                                </div>

                                @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Long Description-{{ $locale['native'] }}<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor{{ $loop->iteration }}" name="long_descp[{{ $key }}]" rows="10" cols="100">
                                                 {{ old('long_descp.' . $key) }}
                                                    </textarea>
                                                    @error('long_descp.' . $key)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" name="hot_deals" id="hot_deals"
                                                        value="1">
                                                    <label for="hot_deals">Hot deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="featured" name="featured"
                                                        value="1">
                                                    <label for="featured">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="special_offer" name="special_offer"
                                                        value="1">
                                                    <label for="special_offer">Special offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="Special deals" name="special deals"
                                                        value="1">
                                                    <label for="Special deals">Special deals</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                        </div>


                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
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
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_trambnail').change(function(e) {
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
                        url: '/admin/category/subcategory/ajax/' + category_id,
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
                        url: '/admin/category/subsubcategory/ajax/' + subcategory_id,
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
