<!DOCTYPE html>
<html lang="en">
<head>
  <title>Asteroid Neo_stat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>


  <link rel="stylesheet" href="css/style.css">
</head>
<body>


  <nav class="nav navbar-inverse text-center primary">
    <h1 style="color:blue;">Welcome to Asteroid NEO Stat</h1>
  </nav>

  <div class="container">
            <h3 class="alert alert-danger">The Feed date limit is only 7 Days</h3>
            Start date : <input type="date" id="start-date" class="form-control"/><br/>
            End date : <input type="date" id="end-date" class="form-control"/><br/>
            <button id="submit" class="btn btn-info">Submit</button>

            <table id="count" class="table">
                <tr>
                    <th>Date</th>
                    <th>count</th>
                </tr>
            </table>
            <br/>
            <table id="result" class="table">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                </tr>



            </table>


            <canvas id="myChart"></canvas>





        </div>
        <script src="vendor/jquery/jquery.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("#submit").click(function () {
                    var sd = $("#start-date").val();
                    var ed = $("#end-date").val();
                    $.ajax({
                        type: "GET",
                        url: "https://api.nasa.gov/neo/rest/v1/feed?start_date=" + sd + "&end_date=" + ed + "&api_key=1L8SUyJc2it9dkDytzBWQSP6tAW3cafss9hO9Gez",
                        success: function (res) {
                            console.dir(res.near_earth_objects);


                            Object.keys(res.near_earth_objects).forEach(function (key) {
                                $("#count").append("<tr><td>" + key + "</td><td>" + res.near_earth_objects[key].length + "</td></tr>");
                                for (var i = 0; i < res.near_earth_objects[key].length; i++) {

                                    $("#result").append("<tr><td>" + key + "</td><td>" + res.near_earth_objects[key][i].name + "</td></tr>");
                                }








                            });
                        }
                    });
                });

            });






         

        </script>

</body>
</html>
