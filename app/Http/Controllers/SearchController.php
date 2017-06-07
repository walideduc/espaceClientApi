<?php

namespace App\Http\Controllers;

use Elasticsearch\Client as Elastic;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * @var Elastic
     */
    public $elastic ;

    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;
    }

    public function ClientUserSearch(Request $request)
    {
        $query = $request->query('query');

        $params = [
            'index' => 'app',
            //'type' => 'users',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'multi_match' =>
                                    [
                                        'query' => $query,
                                        'fields' => [
                                            'adress_1',
                                            'ville',
                                            'raison_sociale',
                                            'adress_2'
                                        ]
                                    ]
                            ],
                            [
                                'multi_match' =>
                                    [
                                        'query' => $query,
                                        'fields' => [
                                            'first_name',
                                            'function',
                                            'email',
                                            'last_name'
                                        ]
                                    ]
                            ],
                        ]
                    ]
                ],
                'highlight' => [
                     'pre_tags' => ["<b class='highlight'>"], // not required
                     'post_tags' => ["</b>"], // not required
                    'fields' => [
                        'adress_1"' => new \stdClass(),
                        "ville"=> new \stdClass(),
                        "raison_sociale"=> new \stdClass(),
                        "adress_2"=> new \stdClass(),
                        "first_name"=> new \stdClass(),
                        "function"=> new \stdClass(),
                        "email"=> new \stdClass(),
                        "last_name"=> new \stdClass(),
                    ]
                ]

            ]
        ];

        $response = $this->elastic->search($params);
       //print_r($response);
        if(isset($response['hits']['hits'])){
            return [
                'took' => $response['took'],
                'total' => $response['hits']['total'],
                'max_score' => $response['hits']['max_score'],
                'data' =>  $response['hits']['hits'],

            ];
        }


    }
}
