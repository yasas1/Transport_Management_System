<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Driver;
use App\Models\FundsAllocatedFrom;
use App\Models\Journey;
use App\Models\Vehical;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\CreateJourneyRequest;

class JourneyController extends Controller
{

    protected $client;
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
//        Local Server
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*id : journeys[i].id,
                  start :journeys[i].expected_start_date_time,
                  ends :journeys[i].expected_end_date_time,
                  applicant_id :journeys[i].applicant_id,
                  vehical_id : journeys[i].vehical_id,
                  driver_id : journeys[i].driver_id, */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $journeys = Journey::all();
        $divHeads = Division::all();
        $fundAlFroms = FundsAllocatedFrom::all();
        $drivers = Driver::all()->pluck('fullName','id');
        $vehicles = Vehical::all()->pluck('fullName','id');
        return view('journey.create',compact('fundAlFroms','drivers','vehicles','divHeads','journeys'));
    }

    public function readJourney(){

        $journeys = Journey::all();
        return response($journeys);
    }

    public function readJourneyForConfirmAjax(){
        $id = $_GET['id'];

        $journey = Journey::whereId($id)->first();
        $vehicle = $journey->vehical;
        $driver = $journey->vehical->driver->getFullNameAttribute();
        $applicant = $journey->applicant;
        $applicant_dept = $journey->applicant->division->dept_name;
        $devisional_head = $journey->divisional_head->getFullNameAttribute();
        $approved_by = $journey->approvedBy->getFullNameAttribute();

        $data = json_encode(array(
             $journey , $vehicle ,$driver ,$applicant , $applicant_dept , $devisional_head, $approved_by
            
        ));
        return response($data);
        //return $journeys;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJourneyRequest $request)
    {     

        /*     // check vehicle availability in backend
        $ForCheckjourneys = Journey::all();
        $start_date_time = Carbon::parse($first);
        $end_date_time = Carbon::parse($second);
        
        foreach ($ForCheckjourneys as $journey){
            if($journey->expected_start_date_time->format('Y-m-d') == $start_date_time->format('Y-m-d') ){
                //return redirect()->back()->withErrors(['Cannot create !']);
                if($journey->expected_start_date_time->format('HH:MM') < $start_date_time->format('HH:MM') && $journey->expected_end_date_time->format('HH:MM') < $expected_start_date_time->format('HH:MM') ){
                     return $journey->expected_start_date_time->format('HH:MM');
                }
            }         
            elseif($journey->expected_start_date_time < $expected_start_date_time && $journey->expected_end_date_time < $expected_start_date_time ){
                return "get 2";
            }
            elseif($journey->expected_start_date_time > $expected_start_date_time && $journey->expected_start_date_time < $expected_end_date_time ){
                return "get 3";
            }          
        }*/

        $journey = new Journey;
        $journey->applicant_id = '000004';
       //$journey->applicant_id = Auth::user()->emp_id;

        $journey->vehical_id = $request->vehical_id;
        if ($vehicle = Vehical::whereId($request->vehical_id)->first()){
            $journey->driver_id = $vehicle->driver->id;
        }

        $string=$request->time_range;
        $pos = strrpos($string, ' - ');
        $first = substr($string, 0, $pos);
        $second = substr($string, $pos + 3); 

        if($expected_start_date_time = Carbon::parse($first)){
                $journey->expected_start_date_time = $expected_start_date_time;
        }

        if($expected_end_date_time = Carbon::parse($second)){
            $journey->expected_end_date_time = $expected_end_date_time;
        }  

        $journey->purpose = $request->purpose;
        $journey->places_to_be_visited = $request->places_to_be_visited;
        $journey->number_of_persons = $request->number_of_persons;

        $journey->expected_distance = $request->expected_distance;

        //check long distance
        if($request->expected_distance>=150){
            $journey->is_long_distance = 1;
        }

        $journey->funds_allocated_from_id = $request->funds_allocated_from_id;
        $journey->divisional_head_id = $request->divisional_head_id;

        $journey->save();      

        try{

            if (true) {
                session_start();
                $this->client->setAccessToken($_SESSION['access_token']);
                $service = new Google_Service_Calendar($this->client);
                $event = new Google_Service_Calendar_Event(array(
                    'summary' => 'Google I/O 2015',
                    'location' => '800 Howard St., San Francisco, CA 94103',
                    'description' => 'A chance to hear more about Google\'s developer products.',
                    'start' => array(
                        'dateTime' => $first,
                        'timeZone' => 'Asia/Colombo',
                    ),
                    'end' => array(
                        'dateTime' => $second,
                        'timeZone' => 'Asia/Colombo',
                    ),
                ));

                $calendarId = 'cmb.ac.lk_ccip5rfck0q19ptlgbsii5e3sk@group.calendar.google.com';
                $event = $service->events->insert($calendarId, $event);
            } else {

                $token = Auth::user()->token;
                $this->client->setAccessToken($token);
                $service = new Google_Service_Calendar($this->client);
                $event = new Google_Service_Calendar_Event(array(
                    'summary' => 'Google I/O 2015',
                    'location' => '800 Howard St., San Francisco, CA 94103',
                    'description' => 'A chance to hear more about Google\'s developer products.',
                    'start' => array(
                        'dateTime' => $first,
                        'timeZone' => 'Asia/Colombo',
                    ),
                    'end' => array(
                        'dateTime' => $second,
                        'timeZone' => 'Asia/Colombo',
                    ),
                ));

                $calendarId = 'cmb.ac.lk_ccip5rfck0q19ptlgbsii5e3sk@group.calendar.google.com';
                $event = $service->events->insert($calendarId, $event);
            }

        }catch (Exception $e){
            if($e->getMessage() === 'Undefined index: access_token'){
                return redirect()->back()->withErrors(['Cannot Connect to Google Calender !']);
            }
            return $e;
        }

            return redirect()->back()->with(['success'=>'Journey added successfully !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function requests(){

        $journeys = Journey::notApproved();
        $longDisJourneys = Journey::notApprovedLongDistance();

        return view('journey.requests',compact('journeys','longDisJourneys'));
    }


    public function notConfirmedJourneys(){

        $drivers = Driver::all()->pluck('fullName','id');
        $vehicles = Vehical::all()->pluck('fullName','id');
        $journeys = Journey::notConfirmed();

        return view('journey.confirms',compact('journeys','drivers','vehicles'));
    }

    public function confirmedJourneys(){

        $journeys = Journey::confirmed();

        return view('journey.confirmed',compact('journeys'));
    }

    public function completed(){
        
        $journeys = Journey::completed();

        return view('journey.completed',compact('journeys'));
    }

}
