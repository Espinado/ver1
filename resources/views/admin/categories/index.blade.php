@extends('admin.layouts.admin_master')
@section('dashboard')
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="{{ route('admin.dashboard') }}"><i class="icon ion-android-star-outline"></i>
            starlight</a></div>
    <div class="sl-sideleft">
        {{-- {{LaravelLocalization::getSupportedLocales()}} --}}
        <label class="sidebar-label">Navigation</label>
        <div class="sl-sideleft-menu">
            <a href="{{ LaravelLocalization::localizeUrl('/admin/') }}" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label">{{ __('system.dashboard') }}</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <a href="{{ route('admin.admins') }}" class="sl-menu-link active">
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
            </a><!-- sl-menu-link -->
            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                    <span class="menu-item-label">{{ __('system.items') }}</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">

                <li class="nav-item"><a href="form-elements.html"
                        class="nav-link">{{ __('system.confirmed_items') }}</a></li>
                <li class="nav-item"><a href="form-layouts.html"
                        class="nav-link">{{ __('system.unconfirmed_items') }}</a></li>

            </ul>


        </div><!-- sl-sideleft-menu -->

        <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-pagebody">
        <div class="sl-mainpanel">
            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{ __('system.dashboard') }}</a>

                <span class="breadcrumb-item active">{{ __('system.categories') }}</span>
            </nav>
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <div class="sl-pagebody">
                <div class="sl-page-title">
                    <h5>{{ __('system.categories') }}</h5>

                </div><!-- sl-page-title -->

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">{{ __('system.categories') }}</h6><a href="" data-toggle="modal"
                        data-target="#modaldemo3" class="btn btn-sm btn-warning"
                        style="float: right;">{{ __('system.add_new') }}</a>


                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">{{ __('system.item_name') }}</th>

                                    <th class="wd-20p">{{ __('system.active') }}</th>
                                    <th class="wd-15p">{{ __('system.created_at') }}</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                                 @foreach (json_decode($category->category_name) as  $key=>$name)
                                                  {{$key}}=>&nbsp;&nbsp;{{$name}}<br>
                                            @endforeach
                                            </td>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="sl-menu-link">
                                            <div class="sl-menu-item">
                                                <span class="menu-item-label">Charts</span>
                                                <i class="menu-item-arrow fa fa-angle-down"></i>
                                            </div><!-- menu-item -->
                                        </a><!-- sl-menu-link -->
                                        <ul class="sl-menu-sub nav flex-column">
                                            <li class="nav-item"><a href="chart-morris.html"
                                                    class="nav-link">Morris Charts</a></li>
                                            <li class="nav-item"><a href="chart-flot.html" class="nav-link">Flot
                                                    Charts</a></li>
                                            <li class="nav-item"><a href="chart-chartjs.html"
                                                    class="nav-link">Chart JS</a></li>
                                            <li class="nav-item"><a href="chart-rickshaw.html"
                                                    class="nav-link">Rickshaw</a></li>
                                            <li class="nav-item"><a href="chart-sparkline.html"
                                                    class="nav-link">Sparkline</a></li>
                                        </ul>
                                    </td>
                                    <td>System Architect</td>
                                    <td>2011/04/25</td>
                                </tr>

                                {{-- @foreach ($sellerCompanies as $seller)
               <tr>
               <td>{{$seller->seller_company_name}}</td>
               <td>{{Config::get('company_legal_status.legal_status.'.$seller->seller_company_profile->seller_company_legal_country.'.status.'.$seller->seller_company_legal_status)}}</td>
               <td>{{Config::get('countries.name.'.$seller->seller_company_profile->seller_company_phys_country.'.country_name')}}</td>
                 @if ($seller->tax_payer == true)
                    <td><span class="badge badge-success">Taxpayer</span></td>
                 @else
                    <td><span class="badge badge-danger">Not Taxpayer</span></td>

               @endif
               @if ($seller->is_active == true)
                    <td><span class="badge badge-success">Active</span></td>
                 @else
                    <td><span class="badge badge-danger">Disactive</span></td>

               @endif
               @if ($seller->is_banned == true)
               <td><span class="badge badge-danger">Banned</span></td>
            @else
               <td><span class="badge badge-success">Not available</span></td>

          @endif
               <td><a href="{{ route('seller.company.view', $seller->id) }}" class="btn btn-danger">Details</a></td>
               </tr>
               @endforeach --}}
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div><!-- card -->

            </div><!-- sl-pagebody -->


        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{ __('system.add_category') }}</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body pd-10">
                        <div class="col-xl-35 mg-t-35 mg-xl-t-0">
                            <div class="card pd-30 pd-sm-50 form-layout form-layout-5">
                                <form method="post" action="{{ route('admin.category.store') }}">
                                    @csrf
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $value)
                                        <div class="row row-xs">
                                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>
                                                {{ $value['native'] }}</label>
                                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                                <input type="text" class="form-control"
                                                    name="category_name[{{ $key }}]" placeholder="Enter name">
                                            </div>
                                        </div><!-- row -->
                                    @endforeach
                                    <div class="row row-xs mg-t-20">
                                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>
                                            {{ __('system.select_from_list') }}:</label>
                                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">

                                            <select class="form-control select2-show-search"
                                                data-placeholder="Choose one (with searchbox)" name="parent_id">
                                                <option label="----"></option>
                                                @foreach ($categories as $category)
                                                    <option label="{{ json_decode($category->category_name)->$locale }}">
                                                        {{ $category->id }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                            </div>
                            <!-- card -->
                        </div><!-- col-6 -->

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pd-x-20" value="Add"></button>

                        <button type="button" class="btn btn-danger pd-x-20" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    @endsection
