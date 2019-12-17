<?php
    $mappa =     [
        "San Diego" =>
            [
                "Los Angeles" =>
                    [
                        "bus" => ["costo"=>11,"distanza"=>194, "tempo" => 118],
                        "train" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999],
                        "airplane" => ["costo"=>142,"distanza"=>194, "tempo" => 89]
                    ]
            ],
        "Los Angeles" =>
            [
                "San Diego" =>
                    [
                        "bus" => ["costo"=>11,"distanza"=>194, "tempo" => 118],
                        "train" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999],
                        "airplane" => ["costo"=>142,"distanza"=>194, "tempo" => 89]
                    ]
                ,
                "Portland" =>
                    [
                        "bus" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999],
                        "train" => ["costo"=>152,"distanza"=>1360, "tempo" => 618],
                        "airplane" => ["costo"=>276,"distanza"=>1360, "tempo" => 194]
                    ],
                "Washington D.C." =>
                    [
                        "bus" => ["costo"=>160,"distanza"=>3750, "tempo" => 1918],
                        "train" => ["costo"=>127,"distanza"=>3750, "tempo" => 1405],
                        "airplane" => ["costo"=>350,"distanza"=>3750, "tempo" => 375]
                    ]
            ],
        "Portland" =>
            [
                "Los Angeles" =>
                    [
                        "bus" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999],
                        "train" => ["costo"=>152,"distanza"=>1360, "tempo" => 618],
                        "airplane" => ["costo"=>276,"distanza"=>1360, "tempo" => 194]
                    ],
                "New York" =>
                    [
                        "bus" => ["costo"=>188,"distanza"=>3949, "tempo" => 2618],
                        "train" => ["costo"=>290,"distanza"=>3949, "tempo" => 1620],
                        "airplane" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999]
                    ]
            ],
        "New York" =>
            [
                 "Portland" =>
                    [
                        "bus" => ["costo"=>188,"distanza"=>3949, "tempo" => 2618],
                        "train" => ["costo"=>290,"distanza"=>3949, "tempo" => 1620],
                        "airplane" => ["costo"=>99999,"distanza"=>999999, "tempo" => 99999]
                    ],
                 "Washington D.C." =>
                    [
                        "bus" => ["costo"=>47,"distanza"=>328, "tempo" => 224],
                        "train" => ["costo"=>24,"distanza"=>328, "tempo" => 322],
                        "airplane" => ["costo"=>150,"distanza"=>328, "tempo" => 112]
                    ]
            ],
        "Washington D.C." =>
            [
                "New York" =>
                    [
                        "bus" => ["costo"=>47,"distanza"=>328, "tempo" => 224],
                        "train" => ["costo"=>24,"distanza"=>328, "tempo" => 322],
                        "airplane" => ["costo"=>150,"distanza"=>328, "tempo" => 112]
                    ],
                 "Los Angeles" =>
                    [
                        "bus" => ["costo"=>160,"distanza"=>3750, "tempo" => 1918],
                        "train" => ["costo"=>127,"distanza"=>3750, "tempo" => 1405],
                        "airplane" => ["costo"=>350,"distanza"=>3750, "tempo" => 375]
                    ]
            ]
    ];

    function dijkstra($start,$finish,$mean,$path_preference){
        
    }

    $from = "New York";
    $to = "Los Angeles";
    $pathPreference = "tempo";
    $notPreference = ["costo","distanza"];
    $notMeans = ["bus"];
    $means = ["train","airplane"];
    foreach($mappa as $from => $toArray){
        //from = città di partenza, toArray = array cità d'arrivo
             foreach($toArray as $to => $meansArray){
                //to = città d'arrivo, meansArray = array mezzi di trasporto
                foreach($notMeans as $m)
                    unset($mappa[$from][$to][$m]);
                $minore = 9999;
                $typeMean = "";
                foreach($means as $m){
                    if($mappa[$from][$to][$m][$pathPreference] < $minore){
                        $minore = $mappa[$from][$to][$m][$pathPreference];
                        $typeMean = $m;
                    }
                }
                foreach($meansArray as $m =>$temp){
                    if($m != $typeMean)
                        unset($mappa[$from][$to][$m]);
                }
                foreach($meansArray as $mean => $weightsArray){
                    //mean = mezzo di strasporto, weightsArray = array pesi arco
                    unset($mappa[$from][$to][$mean][$notPreference[0]]);
                    unset($mappa[$from][$to][$mean][$notPreference[1]]);
                }
             }              
    }
    //unset($mappa["San Diego"]["Los Angeles"]["bus"]);
    var_dump($mappa);
    echo "<p>You chose to go from " . $from . " to " . $to . "</p>";
    /* foreach($routes_temp as $cityStart => $cityEnd) {
		foreach($cityEnd as $cityName => $mezzi) {
			//var_dump($mezzi);
			foreach($mezzi as $mezzo => $value) {
				// var_dump($value);
				// TODO: delete empty arrays
				$g->addedge($cityStart, $cityName, $value[$usr_important]);
				$g->addedge($cityName, $cityStart, $value[$usr_important]);
			}
		}
	}

	echo "<p>Per andare da " . $start . " a " . $end . ":</p>";
	list($distances, $prev) = $g->paths_from($start);
	$path = $g->paths_to($prev, $end);
	echo "Soluzione: ";
	echo "<br><pre>";
	print_r($path);
    echo "</pre>";
    */
?>
