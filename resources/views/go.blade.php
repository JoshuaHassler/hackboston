@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Adventure</div>
                <div class="panel-body">
                    <ul id="event-list">
                        @foreach($events as $k => $v)
                        <li> 
                            <div class="row vertical-align">
                                <div class="col-xs-3">
                                    {!! $v['image'] !!}
                                </div>
                                <div class="col-xs-4">
                                    <p>{{ $v['name'] }}</p>
                                    <p>{{ $v['address'] }}</p>
                                    <p>{{ $v['tag'] }} {{ $v['rating'] }}</p>
                                </div>
                                <div class="col-xs-3">
                                    <button>Different Event</button>
                                </div>
                                <div class="col-xs-2">
                                    <i class="js-remove">x</i>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">
                    <button>Add Event</button>
                    <button onclick="location.href='/go';">Regen Adventure</button>
                    <button id="go-btn" class="go-btn">Lets Go!</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
