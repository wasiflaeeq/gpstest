var myApp = angular.module('myApp', []);

myApp.controller('CarsController', ['$scope', '$http', function($scope, $http,$interval) {
  $http.get('index.php/api').success(function(data) {
    $scope.cars = data;


     $scope.cars.forEach(function(car){
        car.selected = false;
        car.distance ="";
      });

     

function UpdateAll(){
	             // finally, send an http request
	             $scope.cars.forEach(function(car){
			        if(car.selected==true)
			        {

			        	$http.get('index.php/api/DistanceTraveled/?tracker='+car.tracker.imei).success(function(data) {

			        		if(car.selected==true) // checking this again because http request may take long time and during that time we may have clicked unselectAll button
			        		{
			        			car.distance="distance:"+data.text;
			        		}
			        	});
			    	}
			      });


	        }


  
	        
	        setInterval(UpdateAll, 5000);
    	
	


  
 $scope.selectAll = function(){
 	
      $scope.cars.forEach(function(car){
        car.selected = true;
      });
     UpdateAll();
    };


$scope.unSelectAll = function(){
 	
      $scope.cars.forEach(function(car){
        car.selected = false;
        car.distance="";
      });
     
    };



    $scope.updateCarsDistance=function(checked,tracker)
	{

		

	    if(checked==true)
	    {
	      //Call to service
	    	$http.get('index.php/api/DistanceTraveled/?tracker='+tracker).success(function(data) {
    		

    		$scope.cars.forEach(function(car){
		        if(car.tracker.imei==tracker)
		        {
		        	car.distance="distance:"+data.text;
		    	}
		      });

	      
	    }
	    
	)}
	    	else
	    {

	    	$scope.cars.forEach(function(car){
		        if(car.tracker.imei==tracker)
		        {
		        	car.distance="";
		    	}
		      });

	    }

}
  });
}]);