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
    
    public function filmesPopulares($page = 1, $adult = 'false', $order = 'desc'){
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
        $idioma = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en-US';

        $response = file_get_contents(
            "https://api.themoviedb.org/3/discover/movie?include_adult={$adult}&include_video=false&language={$idioma}&page={$page}&sort_by=popularity.{$order}",
            false,
            $context
        );

        $data = json_decode($response, true);

        return $data;

    }

    public function futurosLancamentos($page = 1, $adult = 'false', $order = 'desc'){
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
        $idioma = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en-US';

        $response = file_get_contents(
            "https://api.themoviedb.org/3/movie/upcoming?include_adult={$adult}&language={$idioma}&page={$page}",
            false,
            $context
        );

        $data = json_decode($response, true);

        return $data;

    }

    public function buscaFilmes($query){
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
        $idioma = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en-US';

        $response = file_get_contents(
            "https://api.themoviedb.org/3/search/movie?query={$query}&include_adult=false&language={$idioma}",
            false,
            $context
        );

        $data = json_decode($response, true);
        return $data;
    }

    public function ondeAssistir($filmeId){

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
        "https://api.themoviedb.org/3/movie/{$filmeId}/watch/providers",
        false,
        $context
    );

    if (!$response) return 'Não disponível';

    $data = json_decode($response, true);

    $paisUsuario = "BR";

    if (!isset($data['results'][$paisUsuario])) {
        return 'Não disponível no seu país';
    }

    $dadosPais = $data['results'][$paisUsuario];

    $nomes = [];

    foreach (['flatrate','rent','buy'] as $tipo) {
        if (isset($dadosPais[$tipo])) {
            foreach ($dadosPais[$tipo] as $provider) {
                $nomes[] = $provider['provider_name'];
            }
        }
    }

    $nomes = array_unique($nomes);

    return !empty($nomes)
        ? implode(', ', $nomes)
        : 'Não disponível';
}
}
?>