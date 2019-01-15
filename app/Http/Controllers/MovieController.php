<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MoviesDB\MoviesDBApi;

class MovieController extends Controller
{
    private $api;

    public function __construct(MoviesDBApi $api)
    {
        $this->api = $api;
    }

    public function getMovie(Request $request, $id)
    {
        if($data = $this->api->getMovie($id)){
            return response()->json([
                'status' => 'success',
                'data'=> $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => ['Cant fetch movie...'],
                'data'=> null
            ], 400);
        }
    }
}
