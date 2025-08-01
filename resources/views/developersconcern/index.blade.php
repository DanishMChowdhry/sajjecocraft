@extends('layouts.app')

@section('title')
  Developers Concern
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Developers Concern') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('developersconcern.update',1) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="enableMode" class="form-label">Site Status</label>
                                <select name="enableMode" id="enableMode" class="form-control">
                                    <option value="true" {{ $concern->enableMode === 'true' ? 'selected' : '' }}>Enable</option>
                                    <option value="false" {{ $concern->enableMode === 'false' ? 'selected' : '' }}>Disable</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="msg" class="form-label">Message</label>
                                <input type="text" class="form-control" id="msg" name="msg" value="{{ $concern->msg }}">
                            </div>



                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
