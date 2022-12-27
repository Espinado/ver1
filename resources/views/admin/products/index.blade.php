@extends('admin.layouts.admin_master')
@section('page_title')
    Unitas Dashboard
@endsection
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
    <div class="sl-pagebody">
        <div class="sl-mainpanel">
            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>

                <span class="breadcrumb-item active">{{ __('system.products') }}</span>
            </nav>


            <div class="sl-pagebody">
                <div class="sl-page-title">
                    <h5>{{ __('system.products') }}</h5>

                </div><!-- sl-page-title -->

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">{{ __('system.products') }}</h6>
                    <a href="{{ route('product.add') }}" class="btn btn-sm btn-warning">{{ __('system.add_product') }}</a>

                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Product name</th>
                                    <th class="wd-15p">Product code</th>
                                    <th class="wd-15p">Product images</th>
                                    <th class="wd-15p">Product info</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @foreach (json_decode($product->product_name) as $key => $name)
                                                {{ $key }}=>{{ $name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>
                                            @if ($product->trumbnail)
                                                <img src="/products/trumbnails/{{ $product->trumbnail }}" / width="30"
                                                    height="30">
                                            @else
                                                <img src="{{ asset('no_image.jpg') }}" / width="100" height="100">
                                            @endif
                                        </td>
                                        <td><a href="{{ route('product.view', $product->id) }}"
                                                class="btn btn-danger">Details</a>
                                        </td>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div><!-- card -->

            </div><!-- sl-pagebody -->

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->
    @endsection
