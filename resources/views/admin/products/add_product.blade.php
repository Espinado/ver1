@extends('admin.layouts.admin_master')
@section('dashboard')
    <style>
        .images-preview-div img {
            padding: 10px;
            max-width: 100px;
        }
    </style>
    <script src="{{ asset('panel/lib/jquery/jquery.js') }}"></script>

    <script src="{{ asset('panel/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('panel/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('panel/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                previewImages(this, 'div.images-preview-div');
            });
        });
    </script>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="{{ route('admin.dashboard') }}"><i class="icon ion-android-star-outline"></i> starlight</a>
    </div>
    <div class="sl-sideleft">

        <label class="sidebar-label">Navigation</label>
        <div class="sl-sideleft-menu">
            <a href="{{ LaravelLocalization::localizeUrl('/admin/') }}" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label">{{ __('system.dashboard') }}</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <a href="{{ route('admin.admins') }}" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                    <span class="menu-item-label">{{ __('system.admins') }}</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->

            <a href="{{ route('admin.sellers.companies') }}" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                    <span class="menu-item-label">{{ __('system.sellers') }}</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <a href="{{ route('admin.categories') }}" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                    <span class="menu-item-label">{{ __('system.categories') }}</span>
                </div><!-- menu-item -->
                <a href="{{ route('admin.brands') }}" class="sl-menu-link">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                        <span class="menu-item-label">{{ __('system.brands') }}</span>
                    </div><!-- menu-item -->
                </a><!-- sl-menu-link -->
                <a href="#" class="sl-menu-link active">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                        <span class="menu-item-label">{{ __('system.items') }}</span>
                    </div><!-- menu-item -->
                </a><!-- sl-menu-link -->
                <ul class="sl-menu-sub nav flex-column">

                    <li class="nav-item"><a href="{{ route('admin.products') }}"
                            class="nav-link ">{{ __('system.confirmed_items') }}</a></li>
                    <li class="nav-item"><a href="" class="nav-link">{{ __('system.unconfirmed_items') }}</a></li>

                </ul>


        </div><!-- sl-sideleft-menu -->
        </a><!-- sl-menu-link -->

    </div><!-- sl-sideleft-menu -->

    <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('product.store') }}" accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
            <div class="sl-pagebody">
                <div class="sl-page-title">
                    <h5>Product information</h5>
                    <p>New product information form</p>
                </div><!-- sl-page-title -->

                <div class="card pd-50 pd-sm-40">
                    <h6 class="card-body-title">Product information</h6>


                    <div class="form-layout">
                        <div class="row mg-b-25">
                            @foreach (LaravelLocalization::getSupportedLocales() as $key => $value)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label
                                            class="col-sm-4 form-control-label">{{ __('system.name') }}:&nbsp;({{ $value['native'] }})<span
                                                class="tx-danger">&nbsp*</span></label>
                                        <input class="form-control" type="text" name="product_name[{{ $key }}]"
                                            value="{{ old('product_name') }}"/ placeholder="{{ $value['native'] }}">
                                    </div>
                                </div><!-- col-4 -->
                            @endforeach

                        </div><!-- row -->

                        <div class="row mg-t-20">
                            @foreach (LaravelLocalization::getSupportedLocales() as $key => $value)
                                <div class="col-lg">
                                    <label
                                        class="col-sm-5 form-control-label">{{ __('system.description') }}:&nbsp;({{ $value['native'] }})<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <textarea rows="3" class="form-control" placeholder="{{ $value['native'] }}"
                                        name="product_decription[{{ $key }}]"></textarea>
                                </div><!-- col -->
                            @endforeach

                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.ean') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <input class="form-control" type="text" name="product_code"
                                        value="{{ old('product_code') }}"/ placeholder="EAN code">
                                </div>
                            </div>
                            <?php
                            use App\Models\Admins\Brand;
                            $brands = Brand::all();
                            ?>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.brand') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose one" name="product_brand">
                                        <option value="">No brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <?php
                            use App\Models\Admins\Category;
                            $categories = Category::all();
                            ?>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.category') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose one"
                                        name="product_category">
                                        <option value="">No Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.price') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <input class="form-control" type="number" name="product_price"
                                        value="{{ old('product_price') }}" required min="0.00" max="10000.00"
                                        step="0.01" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.quantity') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <input class="form-control" type="number" step="0.01" name="product_quantity"
                                        value="{{ old('product_quantity') }}"/ placeholder="Quantity" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-sm-4 form-control-label">{{ __('system.images') }}:<span
                                            class="tx-danger">&nbsp*</span></label>
                                    <input class="form-control" type="file" name="product_images[]" id="images"
                                        multiple>

                                </div>
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <div class="images-preview-div"> </div>
                        </div>
                    </div>

                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">{{ __('system.submit') }}</button>
                        <button class="btn btn-secondary">{{ __('system.cancel') }}</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </div><!-- card -->
    </div><!-- card -->
    </div><!-- card -->




    <!-- ########## END: MAIN PANEL ########## -->

@endsection
