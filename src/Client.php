<?php

namespace AdamJsNet\FootballData;

/**
 * This service class encapsulates football-data.org's RESTful API.
 *
 * @author Daniel Freitag <daniel@football-data.org>
 * @date 04.11.2015 | switched to v2 09.08.2018
 * 
 */
class Client {
    const BASE_URI = "http://api.football-data.org/v2/";

    /** @var string */
    protected $baseUri;
    /** @var array */
    protected $reqPrefs;

    public function __construct(string $authToken) {
        $this->baseUri = self::BASE_URI;
        $this->reqPrefs = [
            'http' => [
                'method' => 'GET',
                'header' => 'X-Auth-Token: ' . $authToken,
            ]
        ];
    }
    
    /**
     * Function returns a particular competition identified by an id.
     * 
     * @param Integer $id
     * @return array
     */
    public function findCompetitionById($id) {
        $resource = 'competitions/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response);
    }
    
    /**
     * Function returns all available matches for a given date range.
     * 
     * @param DateString 'Y-m-d' $start
     * @param DateString 'Y-m-d' $end
     * 
     * @return array of matches
     */
    public function findMatchesForDateRange($start, $end) {
        $resource = 'matches/?dateFrom=' . $start . '&dateTo=' . $end;

        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }
    
    public function findMatchesByCompetitionAndMatchday($c, $m) {
        $resource = 'competitions/' . $c . '/matches/?matchday=' . $m;

        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response);
    }

    public function findStandingsByCompetition($id) {
	    $resource = 'competitions/' . $id . '/standings';
        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    
    public function findHomeMatchesByTeam($teamId) {
        // http://api.football-data.org/v2/teams/62/matches?venue=home
        $resource = 'teams/' . $teamId . '/matches/?venue=HOME';

        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response)->matches;
    }
    
    /**
     * Function returns one unique match identified by a given id.
     * 
     * @param int $id
     * @return stdObject fixture
     */
    public function findMatchById($id) {
        $resource = 'matches/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response);
    }
    
    /**
     * Function returns one unique team identified by a given id.
     * 
     * @param int $id
     * @return stdObject team
     */    
    public function findTeamById($id) {
        $resource = 'teams/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response);
    }
    
    /**
     * Function returns all teams matching a given keyword.
     * 
     * @param string $keyword
     * @return list of team objects
     */
    public function searchTeam($keyword) {
        $resource = 'teams/?name=' . $keyword;
        $response = file_get_contents(
            $this->baseUri . $resource, false,
            stream_context_create($this->reqPrefs)
        );
        
        return json_decode($response);
    }    


}
