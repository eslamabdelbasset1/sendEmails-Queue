@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send Email To Users') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form action="{{ route('send_emails') }}" method="post">
                            @csrf
                        <div class="form-group">
                            <label for="title" >Title</label>
                            <input  type="text" name="title" value="{{old('title')}}" class="form-control" required>
                            @error('title') <span class="text-danger">{{ $message }}</span>@enderror

                        </div>


                        <div class="form-group">
                            <label for="body" >Body</label>
                            <textarea name="body" class="form-control" required>{{old('body')}}  </textarea>
                            @error('body') <span class="text-danger">{{ $message }}</span>@enderror

                        </div>
                            <div class="form-group mt-3">
                                <button type="submit" name="submit" class="btn btn-primary"> Send Email </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
