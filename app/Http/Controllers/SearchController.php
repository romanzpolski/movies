<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\MoviesDB\MoviesDBApi;

class SearchController extends Controller
{

    private $api;

    public function __construct(MoviesDBApi $api)
    {
        $this->api = $api;
    }

    /**
     * query params decoded:
     * mode = 0 : return default best rated over 100 votes
     * mode = 1 : search by string,
     * mode = 2 : search by genre
     * genre
     * title
     * page
     *
     * @param Request $request
     * @param $query
     * @return \Illuminate\Http\JsonResponse
     */

    public function search(Request $request, $query)
    {
        $errors = [];
        if($params = json_decode(base64_decode($query))){
            if($movies = $this->api->searchMovies($params)){
                return response()->json([
                    'status' => 'success',
                    'data'=> $movies
                ]);
            } else {
                $errors[].= 'Movies API failed to fetch movies';
            }
        } else {

        }

        return response()->json([
            'status' => 'error',
            'errors' => $errors,
            'data'=> $params
        ], 400);
    }
}
