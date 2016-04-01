<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions
{


    public function all()
    {
        $m = self::MODEL;
        return $this->respond(Response::HTTP_OK, $m::all());
    }

    public function get($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);//->;
        if (is_null($model)) {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function add(Request $request)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
    }

    public function put(Request $request, $id)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $model = $m::find($id);
        if (is_null($model)) {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $model->update($request->all());
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function remove($id)
    {
        $m = self::MODEL;
        if (is_null($m::find($id))) {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $m::destroy($id);
        return $this->respond(Response::HTTP_NO_CONTENT);
    }

    protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }

    public function getRelationship($relation, $id)
    {
        $m = self::MODEL;
//        print_r($m);
        if (!is_null($m::find($id))) {
            if ($relation == 'cities') {
                $child = $m::get(['id', 'name'])->find($id);
                $parent = $m::find($id)->$relation()->get(['id', 'type', 'name']);
            } else if ($m == 'App\City') {
                $child = $m::get(['id', 'type', 'name'])->find($id);
                $parent = $m::find($id)->$relation()->get(['id', 'name']);
            } else {
                $parent = $m::find($id)->$relation()->get(['id', 'name']);
                $child = $m::get(['id', 'name'])->find($id);
            }

            $model = $child;
            $model[$relation] = $parent;
            if (is_null($model)) {
                return $this->respond(Response::HTTP_NOT_FOUND);
            }
            return $this->respond(Response::HTTP_OK, $model);
        } else {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }

    }

}
