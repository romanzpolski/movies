<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MoviesDB\MoviesDBApi;

class GenreController extends Controller
{

    private $api;

    public function __construct(MoviesDBApi $api)
    {
        $this->api = $api;
    }

    /**
     *  Get genres for genres drop down
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getGenres(Request $request)
    {
        if($data = $this->api->getGenres()){
            return response()->json([
                'status' => 'success',
                'data'=> $data->genres
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'errros' => ['Cant fetch genres..'],
                'data' => null
            ], 400);
        }
    }
}
