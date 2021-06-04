@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Company</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center"><a href="{{route('employees.create')}}" class="btn btn-primary">Add Employee</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="text-center">{{$employee->firstname}}</td>
                        <td class="text-center">{{$employee->lastname}}</td>
                        <td class="text-center">{{$employee->company->name}}</td>
                        <td class="text-center">{{$employee->email}}</td>
                        <td class="text-center">{{$employee->phone}}</td>
                        <td class="d-flex justify-content-center text-center">
                            <div class="mx-3">
                                <a class="btn btn-success" href="{{route("employees.edit", $employee)}}">Update</a>
                            </div>
                            <div class="mx-3">
                                <form method="post" action="{{route("employees.destroy", $employee)}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-100 d-flex justify-content-end">{{$employees->links()}}</div>
    </div>
@endsection
