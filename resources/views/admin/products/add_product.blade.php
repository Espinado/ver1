@extends('admin.layouts.admin_master')
@section('dashboard')

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
        <form method="post" action="{{ route('seller.register.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="sl-pagebody">
                <div class="sl-page-title">
                    <h5>Product information</h5>
                    <p>New product information form</p>
                </div><!-- sl-page-title -->

                <div class="card pd-50 pd-sm-40">
                    <h6 class="card-body-title">Product information</h6>


                    <div class="form-layout">
                        <div class="row mg-b-35">


                            @foreach (LaravelLocalization::getSupportedLocales() as $key => $value)
                                        <div class="row row-xs">
                                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>
                                               Product name {{ $value['native'] }}</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control"
                                                    name="product_name[{{ $key }}]" value="{{ old('product_name') }}">
                                            </div>
                                        </div><!-- row -->
                                    @endforeach





                        </div><!-- col-3 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label">VAT number: <span class="tx-danger">*</span></label>
                                <div class="d-md-flex pd-y-20 pd-md-y-0">

                                    <input class="form-control" type="text" id="company_vat_number"
                                        name="seller_company_vat_number" placeholder="Enter VAT number" required
                                        value="{{ old('seller_company_vat_number') }}">
                                </div>
                            </div>
                        </div><!-- col-3 -->

                    </div><!-- row -->
                </div><!-- form-layout -->
            </div><!-- card -->

            <div class="card pd-20 pd-sm-40 mg-t-50">
                <h6 class="card-body-title">Company Legal information</h6>
                <p class="mg-b-20 mg-sm-b-30">A form with a label on top of each form control.</p>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">

                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="seller_company_legal_country"
                                id="seller_company_legal_country" disabled value="No country selected">
                        </div>
                    </div><!-- col-3-->
                    <div class="col-lg-2">

                    </div>
                    <div class="col-lg-2">
                        <label class="form-control-label">Company Admin name: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="seller_admin_name"
                            placeholder="Enter admin name" required value="{{ old('seller_admin_name') }}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control-label">Company Admin surname: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="seller_admin_surname"
                            placeholder="Enter admin surname" required value="{{ old('seller_admin_surname') }}">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control-label">Company Admin email: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="email" name="seller_admin_email"
                            placeholder="Enter admin email" required value="{{ old('seller_admin_email') }}">
                    </div>
                </div><!-- col-3 -->
            </div><!-- row -->

            <div class="row">
                <div class="col-lg-2">
                    <label class="form-control-label">Company Legal City: <span class="tx-danger">*</span></label>


                    <select class="form-control select2" data-placeholder="Choose city" name="seller_company_legal_city"
                        id="seller_company_legal_city" required>
                        <option label="No country selected"></option>
                    </select>

                </div><!-- col-3 -->
                <div class="col-lg-2">
                    <label class="form-control-label">Company Legal street: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose city"
                        name="seller_company_legal_street" id="seller_company_legal_street" required>
                        <option label="No city selected"></option>
                    </select>
                </div><!-- col-3 -->
                <div class="col-lg-2">
                    <label class="form-control-label">Company Legal house: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="seller_company_legal_house"
                        placeholder="Enter house" required value="{{ old('seller_company_legal_house') }}">
                </div><!-- col-3 -->
                <div class="col-lg-2">
                    <label class="form-control-label">Company Legal room: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="seller_company_legal_room" placeholder="Enter room"
                        required value="{{ old('seller_company_legal_room') }}">
                </div><!-- col-3 -->
                <div class="col-lg-3">
                    <label class="form-control-label">Company legal post code: <span class="tx-danger">*</span></label>
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                        <input class="col-lg-2" type="text" id="seller_company_legal_postcode_prefix"
                            name="seller_legal_postcode_prefix" disabled>
                        <select class="form-control select2" data-placeholder="Choose index"
                            name="seller_company_legal_postcode" id="seller_company_legal_postcode" required>
                            <option label="No street selected"></option>
                        </select>
                    </div>
                </div><!-- col-3 -->
            </div><!-- row -->



    </div><!-- card -->

    <div class="card pd-20 pd-sm-40 mg-t-50">
        <h6 class="card-body-title">Company location information</h6>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group mg-b-10-force">

                    <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose country"
                        name="seller_company_phys_country" required>
                        <option label="Choose country"></option>
                        @foreach (Config::get('countries.name') as $key => $value)
                            <option value="{{ $key }}" data-array="{{ $value['country_code'] }}">
                                {{ $value['country_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div><!-- col-3-->
            <div class="col-lg-2">

            </div>

        </div><!-- col-3 -->
    </div><!-- row -->

    <div class="row">
        <div class="col-lg-2">
            <label class="form-control-label">Company Location City: <span class="tx-danger">*</span></label>


            <select class="form-control select2" data-placeholder="Choose city" name="seller_company_phys_city"
                id="seller_company_phys_city" required>
                <option label="No country selected"></option>
            </select>

        </div><!-- col-3 -->
        <div class="col-lg-2">
            <label class="form-control-label">Company Location street: <span class="tx-danger">*</span></label>
            <select class="form-control select2" data-placeholder="Choose city" name="seller_company_phys_street"
                id="seller_company_phys_street" required>
                <option label="No city selected"></option>
            </select>
        </div><!-- col-3 -->
        <div class="col-lg-2">
            <label class="form-control-label">Company Location house: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="seller_company_phys_house" placeholder="Enter house"
                required value="{{ old('seller_company_phys_house') }}">
        </div><!-- col-3 -->
        <div class="col-lg-2">
            <label class="form-control-label">Company Location room: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="seller_company_phys_room" placeholder="Enter room" required
                value="{{ old('seller_company_phys_room') }}">
        </div><!-- col-3 -->
        <div class="col-lg-3">
            <label class="form-control-label">Company Location postcode: <span class="tx-danger">*</span></label>
            <div class="d-md-flex pd-y-20 pd-md-y-0">
                <input class="col-lg-2" type="text" id="seller_company_phys_postcode_prefix"
                    name="seller_company_phys_postcode_prefix" disabled>
                <select class="form-control select2" data-placeholder="Choose index" name="seller_company_phys_postcode"
                    id="seller_company_phys_postcode" required>
                    <option label="No street selected"></option>
                </select>
            </div>
        </div><!-- col-3 -->
    </div><!-- row -->



    </div><!-- card -->

    <div class="card pd-20 pd-sm-40 mg-t-20">
        <h6 class="card-body-title">Form Alignment</h6>
        <p class="mg-b-20 mg-sm-b-30">An inline form that is centered align and right aligned.</p>

        <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
            <div class="d-md-flex pd-y-20 pd-md-y-0">
                <button class="btn btn-info mg-r-5">Submit Form</button>
                <button class="btn btn-secondary">Cancel</button>
            </div>
        </div><!-- d-flex -->
        </form>



    </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
