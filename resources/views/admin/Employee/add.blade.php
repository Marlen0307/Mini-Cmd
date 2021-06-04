@extends('layouts.app')
@section('content')
    <div class="container flex flex-column">

        <div class="col-5 bg-white shadow rounded p-4 m-auto">
            @if(session('status'))
                <div class="mb-4 text-success text-center">
                    {{session('status')}}
                </div>
            @endif
            <form method="post" action="{{route("employees.store")}}">
                @csrf
                <h2 class="text-center h2 mb-4">Add an employee</h2>
                <div class="mb-4">
                    <label for="name" class="sr-only">First Name</label>
                    <input type="text" name="firstname" value="{{old('firstname')}}"
                           class="form-control p-4 rounded  @error('firstname') border border-danger @enderror"
                           placeholder="First name">
                    @error('firstname')
                    <div class="text-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="sr-only">Last Name</label>
                    <input type="text" name="lastname" value="{{old('lastname')}}"
                           class="form-control p-4 rounded  @error('lastname') border border-danger @enderror"
                           placeholder="Last name">
                    @error('lastname')
                    <div class="text-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="sr-only">Company</label>
                    <select name="company" class="form-control px-4 py-2 rounded @error('company') border border-danger @enderror">
                        <option value="">Choose employee's company</option>
                        @foreach($companies as $company )
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                    @error('company')
                    <div class="text-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror

                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" value="{{old('email')}}" name="email"
                           class="form-control p-4 rounded  @error('email') border border-danger @enderror"
                           placeholder="Email">
                    @error('email')
                    <div class="text-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="name" class="sr-only">Phone</label>
                    <input type="text" value="{{old('phone')}}" name="phone" placeholder="Phone"
                           class="form-control @error('phone') border border-danger @enderror p-4 rounded">
                    @error('phone')
                    <div class="text-danger mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-100">Add Employee</button>
                </div>
            </form>
        </div>
    </div>
@endsection
