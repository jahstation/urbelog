<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use App\Trip;
use Dingo\Api\Routing\Helpers;
use App\Vehicle;
use App\Ztl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Exceptions\ExceptionHandler;
use Dingo\Api\Exception\ValidationHttpException;
use DateTime;



class TripController extends Controller
{
    //
    use Helpers;

    public function index()
    {
        return Trip::get();
    }

    public function store(Request $request)
    {
        $user_id = JWTAuth::parseToken()->authenticate()->id;
        $request->request->add(['user_id' => $user_id]);
        $rules = [
            'vehicle_id'=> 'required|integer|exists:vehicles,id',
            'ztl_id'=> 'required|integer|exists:ztls,id',
            'user_id' => 'required|integer|exists:users,id',
            'inizio' => 'required|date_format:Y-m-d H:i:s',
            'fine' => 'required|date_format:Y-m-d H:i:s|after:inizio',
            'percorso'=> 'required' //stabilire tipo input
        ];
        $inputs = $request->only
        (
            'vehicle_id', 'ztl_id', 'user_id', 'inizio','fine',
            'percorso'
        );

        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }
        $date1 = new DateTime($request->input('inizio'));
        $date2 = new DateTime($request->input('fine'));

        $diff = date_diff($date2,$date1)->format('%a,%h,%i,%s');
        $request->request->add(['durata' => "2016-10-12 17:41:31"]);  //inserire intervallo formattato correttamente

        // '%i Minute %s Seconds'
        // '%h Hours
        // '%a Days


        $trip = new Trip($request->all());

        if($trip->save()){
            return $this->response->created();
        }else return $this->response->error('could_not_create_trip', 500);

    }

    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        if(! $trip){
            throw new NotFoundHttpException;
        }else  return $trip;
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        if(!$trip){
            throw new NotFoundHttpException;
        }
        $trip->fill($request->all());
        if($trip->save()){
            return $this->response->noContent();
        }else return $this->response->error('could_not_update_trip', 500);

    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        if(!$trip)
            throw new NotFoundHttpException;
        if($trip->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_trip', 500);
    }


}
