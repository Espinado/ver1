@extends('admin.layouts.admin_master')
@section('title')
    {{ __('system.edit_faq') }}
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{ __('system.update_faq') }} </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ route('admin.faq.update', $faq->id) }}">
                                @csrf
                                <div class="row">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $key => $locale)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Question-{{ $locale['native'] }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="controls">
                                                    <input type="text" name="question[{{ $key }}]"
                                                        class="form-control" value="{!!$faq->getTranslation('question', $key)!!}">
                                                    @error("question.{$key}")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <h5>Answer-{{ $locale['native'] }}<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="blog_editor{{ $loop->iteration }}" name="answer[{{ $key }}]" rows="10" cols="100">
                                                 {!!$faq->getTranslation('answer', $key)!!}
                                                    </textarea>
                                                    @error('answer.' . $key)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update faq" title="Update blog">
                    </div>
                    </form>


                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
