@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Adventure</div>
                <div class="panel-body">
                    <ul id="event-list">
                        <li> 
                            <div class="row vertical-align">
                                <div class="col-xs-2">
                                    <img src="http://i.imgur.com/dkY1gph.jpg" alt="..." class="img-thumbnail">
                                </div>
                                <div class="col-xs-5">
                                    <p>Fuck off Point</p>
                                    <p>123 Ass street</p>
                                    <p>Pub Rating:*****</p>
                                </div>
                                <div class="col-xs-3">
                                    <button>Different Event</button>
                                </div>
                                <div class="col-xs-2">
                                    <i class="js-remove">x</i>
                                </div>
                            </div>
                        </li>
                        <li> 
                            <div class="row vertical-align">
                                <div class="col-xs-2">
                                    <img src="http://i.imgur.com/dkY1gph.jpg" alt="..." class="img-thumbnail">
                                </div>
                                <div class="col-xs-5">
                                    <p>FuckPoint</p>
                                    <p>123 Ass street</p>
                                    <p>Pub Rating:*****</p>
                                </div>
                                <div class="col-xs-3">
                                    <button>Different Event</button>
                                </div>
                                <div class="col-xs-2">
                                    <i class="js-remove">x</i>
                                </div>
                            </div>
                        </li>
                        <li> 
                            <div class="row vertical-align">
                                <div class="col-xs-2">
                                    <img src="http://i.imgur.com/dkY1gph.jpg" alt="..." class="img-thumbnail">
                                </div>
                                <div class="col-xs-5">
                                    <p> off Point</p>
                                    <p>123 Ass street</p>
                                    <p>Pub Rating:*****</p>
                                </div>
                                <div class="col-xs-3">
                                    <button>Different Event</button>
                                </div>
                                <div class="col-xs-2">
                                    <i class="js-remove">x</i>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
