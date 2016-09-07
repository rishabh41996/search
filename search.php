<!DOCTYPE html>
<html>
<head>
<title> Search Engine - Search</title>
</head>
<body>
<center>
<h1> Search Engine </h1>

<form action="search.php">
     <input type='text' name ='k' size='50' value='<?php echo $_GET['k']; ?>'/>
     <input type='submit' value='search'>

</form>
</center>
<hr />
<?php
$i=0;
$k = $_GET['k'];

$terms = explode(" ",$k);
$query = "SELECT * FROM search WHERE ";

foreach ($terms as $each){
 $i++;
 if($i ==1)
   $query .="keywords LIKE '%$each%' ";
   else
       $query .=" OR keywords LIKE '%$each%' ";

}
//connect to database now
mysql_connect("localhost" , "root" , "");
mysql_select_db("webcrawl");
$query =mysql_query($query);
$numrows =mysql_num_rows($query);
if($numrows >0)
{
while($row= mysql_fetch_assoc($query)){
$id =$row['id'];
$title = $row['title'];
$description =$row['description'];
$keywords=$row['keywords'];
$link=$row['link'];
echo "<h2> $keywords</h2>
$id <br /><br />";
echo "<h2> <a href='$link'>$title</a></h2>
$description <br /><br />";
}
}
else
echo "No results found for \"<b> $k</b>\"";


// disconnect
mysql_close();

?>

</body>
</html>