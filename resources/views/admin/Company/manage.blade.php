@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-wrap bg-light justify-content-center">
        <h2 class="h2 w-100 text-center mb-4">Your companies
        </h2>
        <div class="w-100 d-flex justify-content-center">
                <a class="btn btn-primary"
                   href="{{route("companies.create")}}">Add Company</a>
        </div>

        @foreach($companies as $company)
        <div class="d-flex col-3 d-flex mx-3 mt-4 flex-column text-center justify-content-between">
            <img class="rounded-pill img-fluid mb-3" src="{{asset('storage/'.$company->logo)}}">
            <div>
                <p class="font-weight-bold h3">{{$company->name}}</p>
                <p class="text-monospace">{{$company->email}}</p>
                <p><a href="{{$company->website}}">{{$company->website}}</a></p>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <a class="btn btn-success" href="{{route("companies.edit", $company)}}">Update</a>
                    <form class="d-inline" method="post" action="{{route("companies.destroy", $company)}}">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 d-flex justify-content-end">{{$companies->links()}}</div>
    </div>
@endsection
