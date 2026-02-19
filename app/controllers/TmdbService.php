<?php
    class TmdbService{
        
    public function listaGeneros(){
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwMTAyNmY1MzBmNzk0N2YxMDI2OTY1M2MxYjg2NmQ3NCIsIm5iZiI6MTc3MDgyNjQxNi42MTEsInN1YiI6IjY5OGNhYWIwYTViOTU5NDFkODBlNmIyYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.l5mHrgrh2j3BAtS63eRlsrZyCQlH0CLw03ykUnPoxWU';

        $options = [
            "http" => [
                "method" => "GET",
                "header" => [
                    "Authorization: Bearer $token",
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
    
    }
?>