 <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">
                                @php
                                    $categories = App\Models\Admins\Category::orderBy('category_name', 'asc')->get();
                                @endphp

                                @foreach ($categories as $category)
                                    <li class="dropdown menu-item"> <a href="{{url('/product/category/'.$category->id.'/'.$category->slug)}}" class="dropdown-toggle"
                                            data-toggle="dropdown"><i class="icon fa fa-shopping-bag"
                                                aria-hidden="true"></i>{{ $category->category_name }}</a>
                                        <ul class="dropdown-menu mega-menu">
                                            <li class="yamm-content">
                                                <div class="row">
                                                    @php
                                                        $subcategories = App\Models\Admins\SubCategory::where('category_id', $category->id)
                                                            ->orderBy('subcategory_name', 'asc')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($subcategories as $subcategory)
                                                        <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                            <a href="{{url('/product/subcategory/'.$subcategory->id.'/'.$subcategory->slug)}}"><h2 class="title">{{ $subcategory->subcategory_name }}</h2></a>
                                                            @php
                                                                $subsubcategories = App\Models\Admins\SubSubCategory::where('subcategory_id', $category->id)
                                                                    ->orderBy('subsubcategory_name', 'asc')
                                                                    ->get();
                                                            @endphp
                                                            <ul class="links">
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <li><a
                                                                            href="{{url('/product/subsubcategory/'.$subsubcategory->id.'/'.$subsubcategory->slug)}}">{{ $subsubcategory->subsubcategory_name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                    <!-- /.col -->



                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                        <img class="img-responsive"
                                                            src="{{ asset('customers/assets/images/banners/top-menu-banner.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                                <!-- /.row -->
                                            </li>
                                            <!-- /.yamm-content -->
                                        </ul>
                                        <!-- /.dropdown-menu -->
                                    </li>
                                @endforeach
                                <!-- /.menu-item -->


                                <!-- /.menu-item -->


                            </ul>
                            <!-- /.nav -->
                        </nav>
                        <!-- /.megamenu-horizontal -->
                    </div>
