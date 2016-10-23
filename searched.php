<!DOCTYPE html>
<html>
	<head>
		<title>Results</title>
		<link href="searched.css" type="text/css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Allerta|Nunito" rel="stylesheet">
	</head>
	<body>
		<div class="navbar">
    	<ul>
      	<li><a href="http://localhost:80/index.html">Home</a></li>
     	  <li><a href="#" id="active">Criminal Records</a></li>
      	<li><a href="#">About</a></li>
        <li style="float:right"><a href="http://localhost:80/login.php">Login</a></li>
        <li style="float:right"><a href="http://localhost:80/register.php">Register</a></li>
    	</ul>
  	</div>
  	<?php


require_once('../connect.php');
        
//$id=$_GET['id'];

$id=101;

$query="SELECT criminal_fname,criminal_lname, criminal_gender,year(NOW()-criminal_dob), criminal_image from criminal where criminal_id=".$id;
        
$response = mysqli_query($dbc, $query);

$row=mysqli_fetch_row($response);

$fname=$row[0];
$lname=$row[1]; 
$gender=$row[2];
$age=$row[3];
$image=$row[4];

$query="SELECT criminal_ctype from crime_type where criminal_id=".$id;
        
$response = mysqli_query($dbc, $query);

$ctype= array();

while($row=mysqli_fetch_row($response)){
  $ctype[]=$row[0];
}

  	echo "<div class='result'>
  		<table>
  			<thead>
  				<th>$fname $lname</th>
  				<th><img src='$image' id='image'></th>
  			</thead>
  			<tbody>
  				<tr>
  					<td>ID: </td>
  					<td>$id</td>
  				</tr>
  				<tr>
  					<td>Age: </td>
  					<td>$age</td>
  				</tr>
  				<tr>
  					<td>Gender: </td>
  					<td>$gender</td>
  				</tr>
  				<tr>
  					<td>
              <button class='accordion'>Crime Types</button>
              <div class='panel'>";
                for ($i=0;$i<sizeof($ctype);$i++){
                  echo " <p>".$ctype[$i]."</p>";
                }
             echo "</div> 
            </td>
            <td colspan=2>
              <button class='accordion'>More Information</button>
              <div class='panel'>
                <p>Discription:<br>History:<br>Current whereabouts:</p>
              </div> 
            </td>
          <tr>
  			</tbody>
  		</table>
  	</div>";

    ?>
<script>
var acc = document.getElementsByClassName("accordion");
var i,isActive;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        isActive=(isActive==1)?0:1;
        if(isActive){
          window.setTimeout(myTimer,300);
        }
  }
}
function myTimer(){
  window.scrollBy(0, 500);
}


</script>
	</body>
</html>
