<?php

namespace Urbelog\Api\V1\Controllers;

use Urbelog\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Urbelog\Http\Requests;
use JWTAuth;
use Urbelog\Vehicle;
use Dingo\Api\Routing\Helpers;

class VehicleController extends Controller
{
    //

    use Helpers;

    public function index()
    {
        return Vehicle::get();
    }

    public function store(Request $request)
    {
        //controllare se veicolo esiste prima con la targa!!!!!!
        if(Vehicle::where('targa', '=', $request->targa)->count() >= 1){
            $this->response->error('could_not_create_vehicle_targa_presente', 500);
        }else{
            $currentUser = JWTAuth::parseToken()->authenticate();
            $vehicle = new Vehicle($request->all());
            if($currentUser)
            {
                if($vehicle->save()){
                    return $this->response->created();
                }else return $this->response->error('could_not_create_vehicle', 500);
            }else return $this->response->error('could_not_create_vehicle_current_user_Error', 500);
        }

    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if(! $vehicle)
            throw new NotFoundHttpException;
        return $vehicle;
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if(!$vehicle){
            throw new NotFoundHttpException;
        }
        $vehicle->fill($request->all());
        if($vehicle->save()){
            return $this->response->noContent();
        }else return $this->response->error('could_not_update_vehicle', 500);

    }



    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if(!$vehicle)
            throw new NotFoundHttpException;
        if($vehicle->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_vehicle', 500);
    }
}
