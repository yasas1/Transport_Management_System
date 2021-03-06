<?php
namespace App\Http\Controllers;
use App\Models\Division;
use App\Models\Driver;
use App\Models\FundsAllocatedFrom;
use App\Models\Journey;
use App\Models\ExternalVehicle;
use App\Models\JourneyStatus;
use App\Models\Vehical;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\CreateJourneyRequest;
use Session;
use View;

use Mail;
use App\Mail\JourneyRequestMail;

class JourneyController extends Controller
{
    protected $client;
    
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
            //Local Server
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
     //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(){

        if(Auth::user()->canRequestJourney()){
            $journeys = Journey::all();
            $divHeads = Division::all();
            $fundAlFroms = FundsAllocatedFrom::all();
            $drivers = Driver::all()->pluck('fullName','id');
            $vehicles = Vehical::all()->pluck('fullName','id');
            $vehiclesButton = Vehical::all();
            return view('journey.create',compact('fundAlFroms','drivers','vehicles','divHeads','journeys','vehiclesButton'));

        }
        return redirect('home');
    } 

    public function readJourney(){ 
            // for create journey calender view database2.table2 as db2'
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->get();
        
        return response($journeys);
    }
    public function readExternal(){ 
            // for create journey calender view 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',NULL)
        ->get();
        
        return response($journeys);
    }
    public function readExternalCompleted(){ 
            // for completed journey calender view ' 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',NULL)->where('journey_status_id','=','6')
        ->get();
        
        return response($journeys);
    }
    public function readVehicleColor(){   
        //$vehicles = Vehical::all()->select('journey_color')->get();
        $vehicles = DB::table('vehical')->select('id','journey_color')->get();
            
        return response($vehicles);
    }
    public function ForConfirmationByVehicle(){ 
        $vid = $_GET['id'];
        //$journeys = Journey::journeyByVehicleNotConfirmed($vid); 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',$vid)->where('journey_status_id','=','2')
        ->get();
        return response($journeys);
    }
    public function ForCompletedByVehicle(){ // for history
        $vid = $_GET['id'];
        //$journeys = Journey::journeyByVehicleCompleted($vid); 
        $userlogid = Auth::user()->emp_id;  

        if(Auth::user()->role_id == 4){

            $driverId = Driver::where('emp_id','=',$userlogid)->first()->id;

            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('vehical_id','=',$vid)->where('journey_status_id','=','6')
            ->where('driver_id','=',$driverId)
            ->get();
            return response($journeys);
        }
        else if(Auth::user()->role_id == 2){ // fo divissional head

            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('vehical_id','=',$vid)->where('journey_status_id','=','6')
            ->where('divisional_head_id','=',$userlogid)
            ->get();
            return response($journeys);

        }
        else{

            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('vehical_id','=',$vid)->where('journey_status_id','=','6')
            ->get();
            return response($journeys);
        }
    }
    public function ForCreateByVehicle(){ 
        $vid = $_GET['id'];
        //$journeys = Journey::journeyByVehicle($vid); 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',$vid)
        ->get();
        return response($journeys);
    }

    public function confirmationJourneys(){
            // for Confirmation journey calender view
        //$journeys = Journey::notConfirmed();
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('journey_status_id','=','2')
        ->get();
        return response($journeys);
        
    }

    public function readcompletedJourney(){
            // for Completed journey calender view URL -> /journey/readCompleted
        //$journeys = Journey::completed();
        $userlogid = Auth::user()->emp_id;  

        if(Auth::user()->role_id == 4){

            $driverId = Driver::where('emp_id','=',$userlogid)->first()->id;

            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('journey_status_id','=','6')
            ->where('driver_id','=',$driverId)
            ->get();
            return response($journeys);
        }
        else if(Auth::user()->role_id == 2){ // fo divissional head

            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('journey_status_id','=','6')
            ->where('divisional_head_id','=',$userlogid)
            ->get();
            return response($journeys);


        }
        else{
            $journeys = DB::table('journey')
            ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
            ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
            ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
            ->where('journey_status_id','=','6')
            ->get();
            return response($journeys);
        }
        
    }

    public function ForOngingView(){ 
        $journeyid = $_GET['id'];
        //$journeys = Journey::journeyByVehicle($vid); 
        $journey = Journey::whereId($journeyid)->first();
        if($journey->vehical_id==NULL){
            $vehicle_num = NULL;
            $vehicle_name = NULL;
            $driver = NULL;
            $external = $journey->externalVehicle;
        }
        else{
            $vehicle_num = $journey->vehical->registration_no;
            $vehicle_name = $journey->vehical->name;
            $driver = $journey->driver->getFullNameAttribute();
            $external = NULL;
        }
        $applicant_name = $journey->applicant->getFullNameAttribute();
        $applicant_dept = $journey->applicant->division->dept_name;
        $applicant_email = $journey->applicant->emp_email;
        $devisional_head = $journey->divisional_head->getFullNameAttribute();
        $approved_by = $journey->approvedBy->getFullNameAttribute();
        $approved_at = $journey->approved_at->toDayDateTimeString();
        $exp_start = $journey->expected_start_date_time->toDayDateTimeString();
        $exp_end = $journey->expected_end_date_time->toDayDateTimeString();
        $confirmed_by = $journey->confirmedBy->getFullNameAttribute();
        $confirmed_at = $journey->confirmed_at->toDayDateTimeString();
        $confirmed_start = $journey->confirmed_start_date_time->toDayDateTimeString();
        $confirmed_end = $journey->confirmed_end_date_time->toDayDateTimeString();  
        $data = json_encode(array(
            $journey , $vehicle_num ,$vehicle_name,$driver, $applicant_name , $applicant_dept, $applicant_email, $devisional_head, 
            $approved_by, $approved_at, $exp_start,$exp_end, $confirmed_by, $confirmed_at ,$confirmed_start,$confirmed_end,
            $external
            
        ));
        return response($data);
    }

    public function readJourneyForCreate(){
        $id = $_GET['id'];
        $journey = Journey::whereId($id)->first(); 
        
        // $journey->confirmed_at->toDayDateTimeString();
        if($journey->vehical_id==NULL){
            $vehicle_num = "External";
            $vehicle_name = NULL;
            $driver = "External";
        }
        else{
            $vehicle_num = $journey->vehical->registration_no;
            $vehicle_name = $journey->vehical->name;
            $driver = $journey->driver->getFullNameAttribute();
           
        }

        if($journey->expected_start_date_time == NULL){
            $exp_start = $journey->real_start_date_time->toDayDateTimeString();
            $exp_end = $journey->real_end_date_time->toDayDateTimeString();
        }
        else{
            $exp_start = $journey->expected_start_date_time->toDayDateTimeString();
            $exp_end = $journey->expected_end_date_time->toDayDateTimeString();
        }
        
        $applicant_name = $journey->applicant->getFullNameAttribute();
        $applicant_dept = $journey->applicant->division->dept_name;
        $applicant_email = $journey->applicant->emp_email;
        $devisional_head = $journey->divisional_head->getFullNameAttribute();
        
        $data = json_encode(array(
            $journey , $vehicle_num ,$vehicle_name ,$driver ,$applicant_name , $applicant_dept, $applicant_email, $devisional_head,
            $exp_start,$exp_end
            
        ));
        return response($data);
        
    }
          /*  For journey confirmation form details  */
    public function readJourneyForConfirmAjax(){
        $id = $_GET['id'];
        $journey = Journey::whereId($id)->first(); 
        
        // $journey->confirmed_at->toDayDateTimeString();
        $purpose = $journey->purpose ;
        $vehicle_num = $journey->vehical->registration_no;
        $vehicle_name = $journey->vehical->name;
        $driver = $journey->driver->getFullNameAttribute();
        $applicant_name = $journey->applicant->getFullNameAttribute();
        $applicant_dept = $journey->applicant->division->dept_name;
        $applicant_email = $journey->applicant->emp_email;
        $devisional_head = $journey->divisional_head->getFullNameAttribute();
        $approved_by = $journey->approvedBy->getFullNameAttribute();
        $approved_at = $journey->approved_at->toDayDateTimeString();
        $exp_start = $journey->expected_start_date_time->toDayDateTimeString();
        $exp_end = $journey->expected_end_date_time->toDayDateTimeString();

        $data = json_encode(array(
            $journey , $vehicle_num ,$vehicle_name ,$driver ,$applicant_name , $applicant_dept, $applicant_email, $devisional_head,
            $approved_by,$approved_at,$exp_start,$exp_end
            
        ));
        return response($data);
        
    }
            /*  For Completed journey form details -- URL->/journey/readCompleted/{id} */
    public function readJourneyForCompletedAjax(){

        $id = $_GET['id'];
        $journey = Journey::whereId($id)->first();

        if($journey->vehical_id==NULL){
            $vehicle_num = NULL;
            $vehicle_name = NULL;
            $driver = NULL;
            $external = $journey->externalVehicle;

            if($journey->driver_completed_at==NULL){
                $driver_completed = NULL;
            }
            else{
                $driver_completed = $journey->driver_completed_at->toDayDateTimeString();
            }
        }
        else{
            $vehicle_num = $journey->vehical->registration_no;
            $vehicle_name = $journey->vehical->name;
            $driver = $journey->driver->getFullNameAttribute();
            $external = NULL;
            if($journey->driver_completed_at==NULL){
                $driver_completed = NULL;
            }
            else{
                $driver_completed = $journey->driver_completed_at->toDayDateTimeString();
            }
           
        }

        $applicant_name = $journey->applicant->getFullNameAttribute();
        $applicant_dept = $journey->applicant->division->dept_name;
        $applicant_email = $journey->applicant->emp_email;

        $devisional_head = $journey->divisional_head->getFullNameAttribute();
        
        $approved_by = $journey->approvedBy->getFullNameAttribute();

        if($journey->approved_at != NULL){
            $approved_at = $journey->approved_at->toDayDateTimeString();
        }
        else{
            $approved_at = NULL;
        }

        if($journey->expected_start_date_time != NULL){
            $exp_start = $journey->expected_start_date_time->toDayDateTimeString();
            $exp_end = $journey->expected_end_date_time->toDayDateTimeString();
        }
        else{
            $exp_start = NULL;
            $exp_end = NULL;
        }

        if($journey->confirmed_by != NULL){
            $confirmed_by = $journey->confirmedBy->getFullNameAttribute();
            $confirmed_at = $journey->confirmed_at->toDayDateTimeString();
            $confirmed_start = $journey->confirmed_start_date_time->toDayDateTimeString();
            $confirmed_end = $journey->confirmed_end_date_time->toDayDateTimeString();
        }
        else{
            $confirmed_by = NULL;
            $confirmed_at = NULL;
            $confirmed_start = NULL;
            $confirmed_end = NULL;
        }      

        $real_start = $journey->real_start_date_time->toDayDateTimeString(); 
        $real_end = $journey->real_end_date_time->toDayDateTimeString(); 
        
        $data = json_encode(array(
            $journey , $vehicle_num ,$vehicle_name ,$driver ,$applicant_name , $applicant_dept, $applicant_email, $devisional_head, 
            $approved_by, $approved_at, $exp_start,$exp_end, $confirmed_by, $confirmed_at ,$confirmed_start,$confirmed_end,
            $real_start,$real_end ,$driver_completed , $external
            
        ));
        return response($data);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJourneyRequest $request)
    {     
        $journey = new Journey;
        //$journey->applicant_id = '000004';
        $journey->applicant_id = Auth::user()->emp_id;
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
            
            /* check long distance */
        if($request->expected_distance>=150){
            $journey->is_long_distance = 1;
        }

        // if(Auth::user()->role_id == 1){ // for director level approve already
        //     $journey->journey_status_id = 2;
        //     $journey->approved_at = Carbon::now();
        //     $journey->approved_by = Auth::user()->emp_id;
        // }

        $journey->funds_allocated_from_id = $request->funds_allocated_from_id;
        $journey->divisional_head_id = $request->divisional_head_id;

        $journey->save();   

        $devHead_id =$request->divisional_head_id;

            /*  Divisional head Email */
        $emailAddress = Employee::where('r_id','=',$devHead_id)->first()->emp_email.'@ucsc.cmb.ac.lk';
        //$emailAddress= 'ranawaka.y@gmail.com'; //test

        $place= 'PLACE --  '.$journey->places_to_be_visited;
        $start= 'START --  '.$journey->expected_start_date_time->toDayDateTimeString();
        $end=' END --  '.$journey->expected_end_date_time->toDayDateTimeString();
        $applicant= 'APPLICANT -- '.$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname;

        //Mail::send(new JourneyRequestMail($emailAddress,$place,$start,$end,$applicant));

        return redirect()->back()->with(['success'=>'Journey added successfully !']);
    }

    public function cancel(Request $request){
        $id = $request->id ;
        
        if($journey = Journey::whereId($id)->first()){
            $journey->journey_status_id = "7";
            $journey->update();
            //return $journey;
            return redirect()->back()->with(['success'=>'Journey request Canceled successfully !']);     
        }
    }
    public function changeOngoing(Request $request)
    {  
        $id = $request->id ;
        if( $journey = Journey::find($id) ){
            
            if($request->vehical_id ==0 ){
                    /*update details if this journey has already selected external vehicle */
                if($journey->vehical_id == NULL && $externalExis = ExternalVehicle::where('journey_id','=',$id)->first()){
                    $forUpdate = FALSE;
                    if($request->company_name != Null){
                        $externalExis->company_name = $request->company_name ;
                        $forUpdate = TRUE;
                    }
                    if($request->cost != Null){
                        $externalExis->cost = $request->cost ;
                        $forUpdate = TRUE;
                    }   
                    if($forUpdate){
                        $externalExis->update();
                        return redirect()->back()->with(['success'=>'Ongoing Journey Details Changing successfully !']);  
                    }
                    else {
                                               
                        return redirect()->back()->with(['success'=>'There is nothing details to change Ongoing Journey !']); 
                    }
                }
                else{
                    
                    $journey->vehical_id = Null;
                    $journey->driver_id = NULL;
                    $journey->update();
                    
                    $externalNew = new ExternalVehicle;
                    $externalNew->company_name = $request->company_name ;
                    $externalNew->cost = $request->cost ;
                    $externalNew->journey_id = $id;
                    $externalNew->save();  
                     
                    return redirect()->back()->with(['success'=>'Ongoing Journey Details Changing successfully !']); 
                }
            }
            else{
                    /*delete if this journey has selected external vehicle */
                if($journey->vehical_id == NULL && $externalOld = ExternalVehicle::where('journey_id','=',$id)->first()){
                    $externalOld->delete(); 
                }
                if($request->vehical_id != NULL &&  $journey->vehical_id != $request->vehical_id){
                    $journey->vehical_id = $request->vehical_id;
                }
                if($request->driver_id != NULL && $journey->driver_id != $request->driver_id){
                    $journey->driver_id = $request->driver_id;
                }
                if($request->driver_id == NULL && $vehicle = Vehical::whereId($request->vehical_id)->first()){
                    $journey->driver_id = $vehicle->driver->id;  
                }
                $journey->update();
                //return $journey;
                return redirect()->back()->with(['success'=>'Ongoing Journey Details Changing successfully !']);  
            }
        } 
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
            
        $userlogid = Auth::user()->emp_id;   
        
        if(Auth::user()->canApproveJourney()){

            if(Auth::user()->role_id == 1){
                $journeys = Journey::where('journey_status_id','=','1')->where('is_long_distance', '=', '0')->get();
                if(Journey::where('journey_status_id','=','1')->where('is_long_distance', '=', '1')->first()){
                    $longDisJourneys = Journey::notApprovedLongDistance();
                }
                else{
                    $longDisJourneys = NULL;
                }
                //$longDisJourneys = Journey::notApprovedLongDistance();
                $otherDivHeadsJourneys = NULL;
                return view('journey.requests',compact('journeys','longDisJourneys','otherDivHeadsJourneys'));
            }
            else if(Auth::user()->role_id == 2){
                    // Code for particular divissional head requests for approve
    
                $journeys = Journey::where('divisional_head_id','=',$userlogid)
                    ->where('journey_status_id','=','1')
                    ->where('is_long_distance', '=', '0')->get();
    
                $longDisJourneys = NULL;
    
                $divHeads=Division::where('head', '!=', '' )->pluck('head'); 
    
                $otherDivHeadsJourneys = Journey::where('applicant_id','!=',$userlogid)
                ->whereIn('applicant_id', $divHeads)
                ->where('journey_status_id','=','1')
                ->where('is_long_distance', '=', '0')->get();
    
                //return $otherDivHeadsJourneys;
    
                return view('journey.requests',compact('journeys','longDisJourneys','otherDivHeadsJourneys'));       
            }    
            // return Auth::user();
            
            $journeys = Journey::notApproved(); 
            $longDisJourneys = NULL;
            $otherDivHeadsJourneys = NULL;
            return view('journey.requests',compact('journeys','longDisJourneys','otherDivHeadsJourneys'));    

        }

        return redirect('home');
        
        //$userlogid = "000538"; //000140 for test
           /*         
        if($this->isDirector($userlogid)){  // Code for Director for approve
            $journeys = Journey::notApproved(); 
            $longDisJourneys = Journey::notApprovedLongDistance();
            return view('journey.requests',compact('journeys','longDisJourneys'));
        }                 
        else if($this->isDivisionalHead($userlogid)){
                    // Code for particular divissional head requests for approve
            $journeys = Journey::where('divisional_head_id','=',$userlogid)
                ->where('journey_status_id','=','1')
                ->where('is_long_distance', '=', '0')->get();
            $longDisJourneys = NULL;
            return view('journey.requests',compact('journeys','longDisJourneys'));
        }
          */
    }

    public function notConfirmedJourneys(){ // view journey confirms view

        if(Auth::user()->canConfirmJourney()){

            $drivers = Driver::all()->pluck('fullName','id');
            $vehicles = Vehical::all()->pluck('fullName','id');
            $vehicless = Vehical::all();
            $vehiclesForColor = Vehical::all(); // for vehicle color button {delete}
            $journeys = Journey::notConfirmed();
            return view('journey.confirms',compact('journeys','drivers','vehicles','vehicless','vehiclesForColor'));
        }
        return redirect('home');
    }

    public function confirmedJourneys(){  // view Ongoing Journeys

        if(Auth::user()->canViewOngoingJourneys()){

            $userlogid = Auth::user()->emp_id;  

            $drivers = Driver::all()->pluck('fullName','id');
            //$vehicles = Vehical::all()->pluck('fullName','id');
            $vehicles = Vehical::all();

            if(Auth::user()->role_id == 2){ // for devissional head

                $journeys = Journey::where('journey_status_id','=','4')
                ->where('divisional_head_id','=',$userlogid)
                ->get();
            }
            else{
                $journeys = Journey::confirmed();
            }

            
            
            return view('journey.confirmed',compact('journeys','drivers','vehicles'));
        }
        return redirect('home');
    }

    public function completed(){ // view Journey History {Completed journeys}

        if(Auth::user()->canViewCompletedJourneys()){
            
            $vehicles = Vehical::all();
            $userlogid = Auth::user()->emp_id;  

            if(Auth::user()->role_id == 4){ // fo driver

                $email = Auth::user()->email;

                $driverId = Driver::where('email','=',$email)->first()->id; // driver id
                
                $journeys = Journey::where('journey_status_id','=','6')
                ->where('driver_id','=',$driverId)
                ->get();
    
                 // for vehicle color button {delete}
                return view('journey.completed',compact('journeys','vehicles'));
            }
            else if(Auth::user()->role_id == 2){ // fo divissional head
                $journeys = Journey::where('journey_status_id','=','6')
                ->where('divisional_head_id','=',$userlogid)
                ->get();
            }
            else{
                $journeys = Journey::completed();
                
            }
            return view('journey.completed',compact('journeys','vehicles'));
        }
        return redirect('home');
        
    }

    public function cancelledJourney(){
        
        $journeys = Journey::cancelled();
        $DeniedJourneys = Journey::denied();
    
        return view('journey.cancelled',compact('journeys','DeniedJourneys'));
    }

    public function isDivisionalHead($id){
        
        if($divHeads=Division::where('head', '=', $id )->get()){
            if($divHeads->count() != 0){
                return true;
            }
            else{
                return false;
            }
        }
        
    }
    public function isDirector($id){
        if($div=Division::where('head', '=', $id )->where('dept_name', '=', 'Office of the Director' )->get()){
            if($div->count() != 0){
                return true;
            }
            else{
                return false;
            }
        }
        
    }
}