 <ul>
    @foreach ($subcategories as $subcategory)
        <li>
            <a href="#" class="btn btn-sm btn-warning passingID" style="float: right;" data-toggle="modal"
                data-target="#modaldemo3" data-id="{{ $subcategory->id }}">Add Category here</a>
            <a href="{{ url('admin/product/add/' . $subcategory->id) }}" class="btn btn-sm btn-info catID"  style="float: right;" data-id= >Add Product here</a>
            {{-- @foreach (config('locale.languages') as $key => $lang) --}}
                @foreach (json_decode($subcategory->category_name, true) as $a => $k)
                    {{-- <strong> {{ $lang[3] }} </strong> --}}
                   {{$a}} => {{ $k }} <br>
                {{-- @endforeach --}}
            @endforeach
            </a>
        </li>
        @if (count($subcategory->children))
            @include('admin.categories.partials.subcategories',['subcategories' => $subcategory->children])
        @endif
    @endforeach
</ul>
