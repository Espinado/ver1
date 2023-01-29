    <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Colors</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    @foreach($product_colors as $color)
                                    <li><a href="#">{!! str_replace(',','</li><li>',$color->product_color_en) !!}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div>
