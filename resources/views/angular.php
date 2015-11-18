
<!doctype html>
<html>
    <head>
        <title>Softdator</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    </head>
    <body ng-app="myApp">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Softdator Cars Distance</a>
                </div>
            </div>
        </nav>

        <div ng-controller = "CarsController" class="container">
            <div ng-repeat="car in cars">
                <label>
                    <input type="checkbox" ng-model="car.selected" ng-change="updateCarsDistance(car.selected,car.tracker.imei)"  value="{{car.manufacturer +" "+ car.model}}" />
                    <span class="cartitle">{{car.manufacturer +" "+ car.model}} </span><span style="margin-left:20px; color:red;"  class="cardistance"> {{car.distance}}</span>

                </label>
            </div>
            <input type="button" ng-click="selectAll()" value="Check ALL">
            <input type="button" ng-click="unSelectAll()" value="Uncheck ALL">
        </div>




    </body>

    <!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
    

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    </html>