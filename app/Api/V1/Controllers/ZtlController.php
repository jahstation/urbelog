<?php

namespace Urbelog\Api\V1\Controllers;

use Urbelog\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Urbelog\Http\Requests;
use JWTAuth;
use Urbelog\Ztl;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Storage;






class ZtlController extends Controller
{

    use Helpers;

    public function index()
    {
        return Ztl::latest()->get();
        /*$currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
            ->ztls()
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();*/
    }

    public function store(Request $request)
    {
        $destinationPath="../";
        $currentUser = JWTAuth::parseToken()->authenticate();
        if ($request->hasFile('file')) {
            $ztl = new Ztl;
            $ztl->città = $request->get('città');
            $content=$request->file('file');
            Storage::disk('ztls')->put($content);
            dd();

            if(Storage::disk('ztls')->exists('file.csv')){
            }
            $ztl->file = $exists; //percorso file
        }else return $this->response->error('ztl_file_missing', 500);


        if($currentUser)
        {
            if($ztl->save()){
                return $this->response->created();
            }else return $this->response->error('could_not_create_ztl', 500);

        }else return $this->response->error('could_not_create_ztl_current_user_Error', 500);



    }

    public function show($id)
    {
        //$currentUser = JWTAuth::parseToken()->authenticate();

        $ztl = Ztl::findOrFail($id);

        if(! $ztl)
            throw new NotFoundHttpException;

        return $ztl;
    }

    public function update(Request $request, $id)
    {
        //$currentUser = JWTAuth::parseToken()->authenticate();

        $ztl = Ztl::findOrFail($id);
        if(!$ztl){
            throw new NotFoundHttpException;
        }


        $ztl->fill($request->all());
        if($ztl->save()){
            return $this->response->noContent();

        }else return $this->response->error('could_not_update_zl', 500);

    }



    public function destroy($id)
    {

        $ztl = Ztl::findOrFail($id);

        if(!$ztl)
            throw new NotFoundHttpException;

        if($ztl->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_book', 500);
    }
}
