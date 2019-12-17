<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/mini.css/v3.0.1/dist/mini-default.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logoMini.jpg"/>
    <title>Adam's Odyssey</title>
</head>
<body>
<header>
        <a href="index.html" class="logo"><img id="logoImg" src="logo.jpg"></a>
        <a href="cities/newyork.html" class="button cities" style="background-color: #EACD65; position: absolute; top: 1.3em;left: 12.5em; background-color: #E54142;color: white; font-size: 1em;font-family:Georgia; height: 3em; text-transform:none; padding-top: 0.2em;">New York</a>
        <a href="cities/washington.html" class="button" style="background-color: #EACD65; position: absolute; top: 1.3em;left: 20em; background-color: #E54142;color: white; font-size: 1em;font-family:Georgia; height: 3em; text-transform:none; padding-top: 0.2em;">Washington D.C.</a>
        <a href="cities/losangeles.html" class="button" style="background-color: #EACD65; position: absolute; top: 1.3em;left: 31em; background-color: #E54142;color: white; font-size: 1em;font-family:Georgia; height: 3em; text-transform:none; padding-top: 0.2em;">San Diego</a>
        <a href="cities/losangeles.html" class="button" style="background-color: #EACD65; position: absolute; top: 1.3em;left: 39em; background-color: #E54142;color: white; font-size: 1em;font-family:Georgia; height: 3em; text-transform:none; padding-top: 0.2em;">Los Angeles</a>
        <a href="cities/portland.html" class="button" style="background-color: #EACD65; position: absolute; top: 1.3em;left: 48em; background-color: #E54142;color: white; font-size: 1em;font-family:Georgia; height: 3em; text-transform:none; padding-top: 0.2em;">Portland</a>
     </header>
      <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h1>Choose your itinerary</h1>
                <form action="index.php" method="POST">
                    <p>From: </p> <select name="from"> 
                        <option value="New York">New York</option>
                        <option value="Washington D.C.">Washington D.C.</option>
                        <option value="San Diego">San Diego</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Portland">Portland</option>
                    </select>
                    <p>To: </p> <select name="to"> 
                        <option value="New York">New York</option>
                        <option value="Washington D.C.">Washington D.C.</option>
                        <option value="San Diego">San Diego</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Portland">Portland</option>
                    </select>
                    <p>Means of transport:</p>
                    <input type="checkbox" name="bus" value="bus" checked>Bus <input type="radio" name="pathPreference" value="time" checked>Fastest <br>
                    <input type="checkbox" name="train" value="train" checked>Train <input type="radio" name="pathPreference" value="distance">Shortest <br>
                    <input type="checkbox" name="airplane" value="airplane" checked>Airplane <input type="radio" name="pathPreference" value="cost">Cheapest <br>
                    <input type="submit" value="Calculate">
                </form>
            </div>
            <div class="col-sm"><hr></div>
            <div class="col-sm-8">
                <h1>Your itinerary</h1>
                <?php include('script.php') ?>
            </div>
        </div>
      </div>
    
</body>
</html>