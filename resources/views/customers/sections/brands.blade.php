 <?php
    use App\Models\Admins\Brand;
    $brands = Brand::all();
    ?>

    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($brands as $brand)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('brands/' . $brand->brand_logo) }}">
                                <h5><a href="#">{{ $brand->brand_name }}</a></h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
