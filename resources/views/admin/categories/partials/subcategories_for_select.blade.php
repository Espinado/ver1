@foreach ($subcategories as $subcategory)

        <option label="{{ json_decode($subcategory->category_name)->$locale }} ">
            {{ $subcategory->id }}</option>
        @if ($subcategory->children)
            @include(
                'admin.categories.partials.subcategories_for_select',
                ['subcategories' => $subcategory->children]
            )
        @endif

@endforeach
