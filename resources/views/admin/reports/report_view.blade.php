@extends('admin.layouts.admin_master')
@section('title')
    Reports
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search by date</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('search_by_date') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" class="form-control" id="brand_name">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                 <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search by month</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('search_by_month') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Select month <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="month" class="form-control">
                                                <option label="Choose one"></option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>

                                            </select>
                                            @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="form-group">
                                             <h5>Select year <span class="text-danger">*</span></h5>
                                             <div class="controls">
                                            <select name="year_name" class="form-control">
                                                <option label="Choose one"></option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>

                                            </select>
                                             @error('year_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            </div>
                                        </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                 <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search by date</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post" action="{{ route('search_by_month') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Search by year <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                          <select name="year" class="form-control">
                                                <option label="Choose one"></option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2024">2024</option>

                                            </select>
                                            @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

@endsection
