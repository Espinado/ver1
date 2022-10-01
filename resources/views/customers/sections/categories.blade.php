 <div class="hero__categories__all">
     <i class="fa fa-bars"></i>
     <span>All departments</span>

 </div>
 <ul id="tree1">
     @foreach ($categories as $category)
         <li>
             @foreach (json_decode($category->category_name, true) as $key => $catItem)
             @if(!isset($category->parent_id))
                 @if ($key == LaravelLocalization::GetCurrentLocale())
                     {{-- @if (in_array($key, LaravelLocalization::getSupportedLanguagesKeys())) --}}
                     {{ $catItem }}
                 @endif
                 @endif
             @endforeach
             @if (count($category->children))
                 @include('customers.partials.cat_tree', [
                     'childs' => $category->children,
                 ])
             @endif
         </li>
     @endforeach
 </ul>
