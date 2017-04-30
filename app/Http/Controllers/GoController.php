<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Location;

class GoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adventure = array();
        $indexes   = array();
        $results   = array();

        $position = Location::get();
        $client = new Client();
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyA6M1RfKD3gKGOe53oFAtefDWgBgN7gcf8&location='.$position->latitude.','.$position->longitude.'&radius=16000');

        $results = (json_decode($res->getBody()))->results;
        $indexes = array_rand($results, 5);
        
        foreach ($indexes as $index) {
            $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference='.$results[$index]->photos[0]->photo_reference.'&key=AIzaSyA6M1RfKD3gKGOe53oFAtefDWgBgN7gcf8');

            array_push($adventure, array(
                'image'   => "<img class='rounded mx-auto d-block' alt='Cool Picture' src='data:image/jpg;base64,".base64_encode($res->getBody())."' />",
                'name'    => $results[$index]->name,
                'address' => $results[$index]->vicinity,
                'tag'     => $results[$index]->types[0],
                'rating'  => (isset($results[$index]->rating)) ? $results[$index]->rating : -1,
            ));
        }

        return view('go')->with('events', $adventure);
    }
}
