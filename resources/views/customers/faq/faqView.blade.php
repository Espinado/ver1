@extends('customers.layouts.app')
@section('content')
@section('title')
    FAQ
@endsection
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{route('index')}}">Home</a></li>
                <li class='active'>FAQ</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box faq-page">
            <div class="row">

                <div class="col-md-12">
                    <h2 class="heading-title">Frequently Asked Questions</h2>
                    <span class="title-tag">Last Updated on {{$last_created_date}}</span>
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->


                        <!-- checkout-step-03  -->
                        @foreach ($faqs as $faq)
                        <div class="panel panel-default checkout-step-{{ $loop->iteration }}">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion"
                                        href="#collapse{{ $loop->iteration }}">
                                        <span>{{ $loop->iteration }}</span>{{$faq->question}}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {!!$faq->answer!!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- checkout-step-03  -->
                         <!-- checkout-step-03  -->


                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
