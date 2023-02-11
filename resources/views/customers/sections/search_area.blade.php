 <div class="search-area">
     <form>
         <div class="control-group">
             <ul class="categories-filter animate-dropdown">
                 @php
                     $categories = App\Models\Admins\Category::orderBy('category_name', 'asc')->get();
                 @endphp
                 <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Categories <b
                             class="caret"></b></a>
                     <ul class="dropdown-menu" role="menu">
                         {{-- <li class="menu-header">Computer</li> --}}
                         @foreach ($categories as $category)
                             <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">-
                                     {{$category->category_name}}</a>
                             </li>
                         @endforeach

                     </ul>
                 </li>
             </ul>
             <input class="search-field" placeholder="Search here..." />
             <a class="search-button" href="#"></a>
         </div>
     </form>
 </div>
