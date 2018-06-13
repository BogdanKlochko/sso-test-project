@extends('layouts.app')

@section('content')
    <div class="container">
    <form class="form-horizontal" action="{{route('ACL.update', $user)}}" method="POST">
        <input type="hidden" name="_method" value="PUT">

        @foreach($brokers as $broker)
            <div class="row">
                <div class="col col-lg-8">{{$broker->IP}}</div>
                <div class="col col-lg-4"><input type="checkbox" name="broker[]" value="{{$broker->id}}" @if($userBrokers->contains($broker)) checked @endif></div>
            </div>
        @endforeach

        <hr/>

        <input class="btn btn-primary" type="submit" value="Save">

        {{csrf_field()}}
    </form>
    </div>
@endsection