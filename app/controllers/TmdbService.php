<?php
    class TmdbService{

    private $token;

     public function __construct() {
        $this->token = $_ENV['TMDB_API_TOKEN'] ?? '';
    }
        
    public function listaGeneros(){

        $options = [
            "http" => [
                "method" => "GET",
                "header" => [
                    "Authorization: Bearer $this->token",
                    "Accept: application/json"
                ]
            ]
        ];

        $context = stream_context_create($options);

        $response = file_get_contents(
            "https://api.themoviedb.org/3/genre/movie/list?language=pt-br",
            false,
            $context
        );

        $data = json_decode($response, true);

        $lista = [];
        foreach($data['genres'] as $gen){
            $lista[] = [
                'id' => $gen['id'],
                'nome' => $gen['name']
            ];
        }

        return $lista;
    }
    
    public function filmesPopulares(){


    }

    }
?>