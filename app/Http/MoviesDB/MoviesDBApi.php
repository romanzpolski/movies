<?php
namespace App\Http\MoviesDB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class MoviesDBApi
{
    private $apiKey;
    private $client;



    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('MOVIES_DB_API_KEY', 'no_api_key');
    }

    /**
     * https://developers.themoviedb.org/3/movies/get-movie-details
     *
     * @param $id
     * @return bool|mixed
     */

    public function getMovie($id)
    {
        $url = 'https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$this->apiKey;
        return $this->apiRequest($url);
    }

    /**
     * @return bool|mixed
     */

    public function getGenres()
    {
        $url = 'https://api.themoviedb.org/3/genre/movie/list?api_key='.$this->apiKey;
        return $this->apiRequest($url);
    }

    /**
     * @param $params
     * @return bool|mixed
     */

    public function searchMovies($params)
    {
        $url = $this->buildSearchQuery($params);
        return $this->apiRequest($url);
    }

    /**
     * @param $url
     * @return bool|mixed
     */

    private function apiRequest($url){
        try {
            $request = $this->client->get($url);
            return json_decode($request->getBody());
        } catch (GuzzleException $e) {
            Log::error($e);
        }
        return false;
    }

    /**
     * query params:
     * mode = 0 : return default best avg rated & gte 100 votes
     * mode = 1 : search by string,
     * mode = 2 : search by genre
     * genre : number, genreId
     * title : string
     * page : number
     *
     * Available TheMovieDB query params:
     *
     * https://developers.themoviedb.org/3/discover/movie-discover
     *
     * https://developers.themoviedb.org/3/search/search-movies
     *
     * @param $params
     * @return string
     */

    private function buildSearchQuery($params)
    {
        $discoverUrl = 'https://api.themoviedb.org/3/discover/movie/?';
        $searchUrl = 'https://api.themoviedb.org/3/search/movie?';

        $baseUrl = null;
        $query = [];

        $query['api_key'] = $this->apiKey;
        $query['page'] = $params->page;

        switch ($params->mode) {
            case 1:
                $baseUrl = $searchUrl;
                $query['query'] = $params->title;
                break;
            case 2:
                $baseUrl = $discoverUrl;
                $query['with_genres'] = $params->genre;
                break;
            default:
                $baseUrl = $discoverUrl;
                $query['certification_country'] = 'US';
                $query['certification'] = 'R';
                $query['sort_by'] = 'vote_average.desc';
                $query['vote_count.gte'] = 100;
        }

        $queryEncoded = http_build_query($query);

        return $baseUrl.$queryEncoded;
    }
}
