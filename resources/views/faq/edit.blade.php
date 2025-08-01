@extends('layouts.app')

@section('title')
    Edit FAQ
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Brand') }}</div>

                <div class="card-body">
                    @include('partial.alert')

                    <form action="{{ route('faq.update',$faq->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question"  name="question" value="{{ $faq->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="Answer" class="form-label">Answer</label>
                            <input type="text" class="form-control" id="answer" name="answer" value="{{ $faq->content }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
