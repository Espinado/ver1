 <ul>
    @foreach ($subcategories as $subcategory)
        <li>
            <a href="#" class="btn btn-sm btn-warning passingID" style="float: right;" data-toggle="modal"
                data-target="#modaldemo3" data-id="{{ $subcategory->id }}"
                @foreach (json_decode($subcategory->category_name, true) as $key=>$t )
                                                    @if ($key==LaravelLocalization::GetCurrentLocale())
                                                     data-val="{{$t}}"
                                                        @endif
                                                    @endforeach

                >{{ __('system.add_category') }}</a>
            <a href="{{ url('admin/product/add/' . $subcategory->id) }}" class="btn btn-sm btn-info catID"  style="float: right;" data-id= >{{ __('system.add_product') }}</a>
                        @foreach (json_decode($subcategory->category_name, true) as $a => $k)
                   {{$a}} => {{ $k }} <br>
            @endforeach
            </a>
        </li>
        @if (count($subcategory->children))
            @include('admin.categories.partials.subcategories',['subcategories' => $subcategory->children])
        @endif
    @endforeach
</ul>
