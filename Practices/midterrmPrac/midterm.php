<?php
//$q = intval($_GET['q']);

$con = mysqli_connect('localhost','irismanriquezc','','midterm1');

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="SELECT Lastname,Age FROM Persons ORDER BY Lastname";

if ($result=mysqli_query($con,$sql))
{
// Get field information for all fields
while ($fieldinfo=mysqli_fetch_field($result))
{
printf("Name: %s\n",$fieldinfo->name);
printf("Table: %s\n",$fieldinfo->table);
printf("max. Len: %d\n",$fieldinfo->max_length);
}
// Free result set
mysqli_free_result($result);
}

mysqli_close($con);
?>