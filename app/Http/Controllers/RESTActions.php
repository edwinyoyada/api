<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions
{


    public function all()
    {
        $m = self::MODEL;
        return $this->respond(Response::HTTP_OK, $m::orderBy('name', 'asc')->get()->all());
    }

    public function get($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
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

        if (!is_null($m::find($id))) {
            if ($relation == 'cities') {
                $parent = $m::get(['id', 'name'])->find($id);
                $child = $m::find($id)->$relation()->orderBy('name', 'asc')->get(['id', 'type', 'name']);
            } else if ($m == 'App\City') {
                $parent = $m::get(['id', 'type', 'name'])->find($id);
                $child = $m::find($id)->$relation()->orderBy('name', 'asc')->get(['id', 'name']);
            } else {
                $child = $m::find($id)->$relation()->orderBy('name', 'asc')->get(['id', 'name']);
                $parent = $m::get(['id', 'name'])->find($id);
            }
            $model = $parent;
            $model[$relation] = $child;
            if (is_null($model)) {
                return $this->respond(Response::HTTP_NOT_FOUND);
            }
            return $this->respond(Response::HTTP_OK, $model);
        } else {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }

    }

}
