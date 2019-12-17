<?php
    $mappa =     [
        "San Diego" =>
            [
                "Los Angeles" =>
                    [
                        "bus" => ["cost"=>11,"distance"=>194, "time" => 118],
                        "train" => ["cost"=>99999,"distance"=>99999, "time" => 99999],
                        "airplane" => ["cost"=>142,"distance"=>194, "time" => 89]
                    ]
            ],
        "Los Angeles" =>
            [
                "San Diego" =>
                    [
                        "bus" => ["cost"=>11,"distance"=>194, "time" => 118],
                        "train" => ["cost"=>99999,"distance"=>99999, "time" => 99999],
                        "airplane" => ["cost"=>142,"distance"=>194, "time" => 89]
                    ]
                ,
                "Portland" =>
                    [
                        "bus" => ["cost"=>99999,"distance"=>99999, "time" => 99999],
                        "train" => ["cost"=>152,"distance"=>1360, "time" => 618],
                        "airplane" => ["cost"=>276,"distance"=>1360, "time" => 194]
                    ],
                "Washington D.C." =>
                    [
                        "bus" => ["cost"=>160,"distance"=>3750, "time" => 1918],
                        "train" => ["cost"=>127,"distance"=>3750, "time" => 1405],
                        "airplane" => ["cost"=>350,"distance"=>3750, "time" => 375]
                    ]
            ],
        "Portland" =>
            [
                "Los Angeles" =>
                    [
                        "bus" => ["cost"=>99999,"distance"=>99999, "time" => 99999],
                        "train" => ["cost"=>152,"distance"=>1360, "time" => 618],
                        "airplane" => ["cost"=>276,"distance"=>1360, "time" => 194]
                    ],
                "New York" =>
                    [
                        "bus" => ["cost"=>188,"distance"=>3949, "time" => 2618],
                        "train" => ["cost"=>290,"distance"=>3949, "time" => 1620],
                        "airplane" => ["cost"=>99999,"distance"=>99999, "time" => 99999]
                    ]
            ],
        "New York" =>
            [
                 "Portland" =>
                    [
                        "bus" => ["cost"=>188,"distance"=>3949, "time" => 2618],
                        "train" => ["cost"=>290,"distance"=>3949, "time" => 1620],
                        "airplane" => ["cost"=>99999,"distance"=>99999, "time" => 99999]
                    ],
                 "Washington D.C." =>
                    [
                        "bus" => ["cost"=>47,"distance"=>328, "time" => 224],
                        "train" => ["cost"=>24,"distance"=>328, "time" => 322],
                        "airplane" => ["cost"=>150,"distance"=>328, "time" => 112]
                    ]
            ],
        "Washington D.C." =>
            [
                "New York" =>
                    [
                        "bus" => ["cost"=>47,"distance"=>328, "time" => 224],
                        "train" => ["cost"=>24,"distance"=>328, "time" => 322],
                        "airplane" => ["cost"=>150,"distance"=>328, "time" => 112]
                    ],
                 "Los Angeles" =>
                    [
                        "bus" => ["cost"=>160,"distance"=>3750, "time" => 1918],
                        "train" => ["cost"=>127,"distance"=>3750, "time" => 1405],
                        "airplane" => ["cost"=>350,"distance"=>3750, "time" => 375]
                    ]
            ]
    ];
    $pathPreference = $_POST["pathPreference"];
    $notMeans = array();
    $means = array();
    $cityFrom = $_POST["from"];
    $cityTo = $_POST["to"];
    echo "<p>You chose to go from <mark class=\"tag\">$cityFrom</mark> to <mark class=\"tag\">$cityTo</mark></p>";
    if(isset($_POST["bus"]))
        $means[] = "bus";
    else
        $notMeans[] = "bus";
    if(isset($_POST["train"]))
        $means[] = "train";
    else
        $notMeans[] = "train";
    if(isset($_POST["airplane"]))
        $means[] = "airplane";
    else
        $notMeans[] = "airplane";
    if($cityFrom == $cityTo){
        echo "<p>You can go with your own feet, it's free!</p>";
    }
    else if(count($means) == 0){
        echo"<p>But first please chose at least one means of transport if you don't want to walk.</p>";
    }
    else if($cityFrom == "San Diego" && $cityTo == "Los Angeles" && in_array("train",$means) && count($means) == 1){
        echo "<p>There is no way to reach the destination with the selected means of transport.</p>";
    }
    else{
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
                    
                 }              
        }
        require("lib/Dijkstra.php");
        $g = new Graph();
         foreach($mappa as $start => $end) {
            foreach($end as $name => $means) {
                foreach($means as $mean => $value) {
                        $g->addedge($start, $name, $value[$pathPreference]);
                        $g->addedge($name, $start, $value[$pathPreference]);
                }
            }
        }
        //
        list($distances, $prev) = $g->paths_from($cityFrom);
        $path = $g->paths_to($prev, $cityTo);
        if(count($path) == 0){
            echo "<p>There is no way to reach the destination with the selected means of transport.</p>";
        }
        else{
            if($pathPreference == "time")
                echo "<p>Fastest itinerary:</p>";
            else if($pathPreference == "distance")
                echo "<p>Shortest itinerary:</p>";
            else
                echo "<p>Cheapest itinerary:</p>";
            $costo = 0; $tempo = 0; $miglia = 0;
            $c1 = $path[0];
            $c2 = $path[1];
            foreach($mappa[$c1][$c2] as $mean => $values){
                echo '<div class="box">'.'<p><img class="meanLogo" src="'.$mean.'.svg">'.$c1.' to '.$c2.' by '.$mean.': '. $values["cost"] . '$, '.$values["time"].' minutes</p></div> <br>';;
                $costo += $values["cost"];
                $tempo += $values["time"];
                $miglia += $values["distance"];
            }
            for($i = 1; $i < count($path)-1;$i++){
                $c1 = $path[$i];
                $c2 = $path[$i+1];
                foreach($mappa[$c1][$c2] as $mean => $values){
                    echo '<div class="box">'.'<p><img class="meanLogo" src="'.$mean.'.svg">'.$c1.' to '.$c2.' by '.$mean.': '. $values["cost"] . '$, '.$values["time"].' minutes</p></div><br>';
                    $costo += $values["cost"];
                    $tempo += $values["time"];
                    $miglia += $values["distance"];
                }
            }
            echo "<p><mark class=\"tag\">Total</mark> $costo$, $tempo minutes.</p>";
        }
        
    }
    
?>
