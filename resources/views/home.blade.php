@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-right">Action</th>
                            </thead>

                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route('ACL.edit', $user)}}">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3" class="text-center"><h2>No users found</h2></td>
                            @endforelse
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="3">
                                    <ul class="pagination pull-right">
                                        {{$users->links()}}
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
            </div>
        </div>
    </div>
</div>
@endsection
