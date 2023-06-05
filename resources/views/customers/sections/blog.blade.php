<section class="section latest-blog outer-bottom-vs wow fadeInUp">
                    <h3 class="section-title">{{ __('system.blog') }}</h3>
                    @php
                        use App\Models\Admins\Blog;
                         use Carbon\Carbon;
                        $blogs=Blog::all();
                    @endphp
                    <div class="blog-slider-container outer-top-xs">
                        <div class="owl-carousel blog-slider custom-carousel">
                           @foreach($blogs as $blog)
                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="{{ url('/read/blog/' . $blog->id )}}"><img src="{{asset($blog->image)}}" alt=""></a> </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="{{ url('/read/blog/' . $blog->id )}}">{!!$blog->title!!}</a></h3>
                                        <span class="info">By Administrator &nbsp;|&nbsp; {{Carbon::parse($blog->created_at)->format('d F Y')}} </span>
                                        <p class="text">{!!$blog->short_blog!!}</p>
                                        <a href="{{ url('/read/blog/' . $blog->id )}}" class="lnk btn btn-primary">{{ __('system.read_more') }}</a> </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            @endforeach
                            <!-- /.item -->




                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                    <!-- /.blog-slider-container -->
                </section>
