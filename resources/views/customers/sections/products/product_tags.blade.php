@php
    $productTags = App\Models\Admins\Product::groupBy('product_tags')
        ->select('product_tags')
        ->get();

@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($productTags as $tag)
          <a class="item active" title="{{ str_replace(',',' ',$tag->product_tags)  }}" href="{{url('product/tag/'.$tag->product_tags)}}">
	{{ str_replace(',',' ',$tag->product_tags)  }}</a>
            @endforeach

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
