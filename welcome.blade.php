<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    </head>

    <body>
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

            <div id="fastest"></div>
            <div id="closest"></div>
            <div id="average"></div>


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



                            /*for count the no of asteroids in each date*/
                            Object.keys(res.near_earth_objects).forEach(function (key) {
                                $("#count").append("<tr><td>" + key + "</td><td>" + res.near_earth_objects[key].length + "</td></tr>");



                                for (var i = 0; i < res.near_earth_objects[key].length; i++) {

                                    $("#result").append("<tr><td>" + key + "</td><td>" + res.near_earth_objects[key][i].name + "</td></tr>");
                                }


                                var myarray = [];
                                
                                        myarray.push(res.near_earth_objects[key].length);
                                        /*Fastest asteroids*/
                                        //myarray.toString();
                                        for(var j=0;j<myarray.length;j++){

                                          myarray.sort();

                                          $("#fastest").append("<span>"+myarray.length+"</span>");


                                        }

                                        /*end fastest*/

                  /*chart code*/
                                var ctx = document.getElementById("myChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [myarray],
                                datasets: [{
                                    label: 'Asteroids Chart',
                                    data: [myarray],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255,99,132,1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        });
                        /*end chart code*/



                            });
                        }
                    });
                });

            });







    </script>






    </body>
</html>
