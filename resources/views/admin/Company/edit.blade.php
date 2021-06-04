@extends('layouts.app')

@section('content')
    <div class="container flex-wrap bg-light">
    <div class="col-5 bg-white shadow rounded p-4 m-auto">
        @if(session('status'))
            <div class="mb-4 text-success text-center">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="{{route("companies.update", $company)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h2 class="text-center h2 mb-4">Edit <span class="font-weight-bold">{{$company->name}}</span></h2>
            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input type="text" value="{{$company->name}}" name="name" class="form-control p-4 rounded  @error('name') border border-danger @enderror" placeholder="Company name">
                @error('name')
                <div class="text-danger mt-2">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="text" value="{{$company->email}}" name="email" class="form-control p-4 rounded  @error('email') border border-danger @enderror" placeholder="Company email">
                @error('email')
                <div class="text-danger mt-2">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="sr-only">Logo</label>
                <input type="file" name="logo" class="form-control px-4 py-1 rounded @error('logo') border border-danger @enderror">
                @error('logo')
                <div class="text-danger mt-2">
                    {{$message}}
                </div>
                @enderror

            </div>
            <div class="mb-4">
                <label for="name" class="sr-only">Website</label>
                <input type="text" value="{{$company->website}}" name="website" placeholder="Company website" class="form-control @error('website') border border-danger @enderror p-4 rounded">
                @error('website')
                <div class="text-danger mt-2">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary w-100">Add Company</button>
            </div>
        </form>
    </div>
    </div>
@endsection
