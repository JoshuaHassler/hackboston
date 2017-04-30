<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Location;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

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
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?&radius=500&types=restaurant|park|art_gallery&key=AIzaSyA6M1RfKD3gKGOe53oFAtefDWgBgN7gcf8&location=-33.8670522,151.1957362&radius=16000');
        $results = (json_decode($res->getBody()))->results;
        $indexes = array_rand($results, 5);
        
        foreach ($indexes as $index) {
            $url = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&key=AIzaSyA6M1RfKD3gKGOe53oFAtefDWgBgN7gcf8&photoreference=';
            if (isset($results[$index]->photos[0]->photo_reference)) {
                $url .= $results[$index]->photos[0]->photo_reference;
            } else {
                $url .= 'CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU';
            }

            $res = $client->request('GET', $url);

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

    public function start()
    {
        DB::table('adventures')
            ->where('user_id', Auth::id())
            ->update(['active' => 0]);

        DB::table('adventures')->insert(
            ['active' => 1, 'name' => 'Cool Adventure', 'user_id' => Auth::id()]
        );

        return DB::table('adventures')->select('id')->where('user_id', Auth::id())->orderBy('id', 'desc')->pluck('id');
    }

    public function addEvent($id) {
        $time_interval = 10;

        $count = DB::table('events')
            ->where('adventure_id', $id)
            ->select('id')->count();

        $time_interval += 120 * $count;
            

        $date = new \DateTime();
        $date->add(new \DateInterval('PT'.$time_interval.'M'));
        
        $end = $date;
        $time_interval = 10 + (120 * ($count+ 1));
        $end->add(new \DateInterval('PT'.$time_interval.'M'));


        DB::table('events')
            ->insert([
                'adventure_id' => $id,
                'start_time'   => $date->format('Y-m-d H:i:s'),
                'end_time'     => $end->format('Y-m-d H:i:s'),
                'started'      => 0,
                'completed'    => 0,
                'destination_id' => 0
            ]);
    }

}
