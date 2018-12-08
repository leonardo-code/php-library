<?php

include("inc_php/include.php.inc");

$tmpl->setHtmlName("cat.tmpl");

include("inc_php/include_menu.php.inc");

$id_param = "";
if(isset($_GET['id'])) {
	$id_param = $_GET['id'];
}

$query_cat = "select name from category where id = ".$id_param;
$result = mysql_query($query_cat);
$row = mysql_fetch_row($result);
$name_cat = $row[0];  
$tmpl->param('CAT', $name_cat);  


$tmpl->param('LOOP_SUBCAT', 0);  

if ($id_param) {
	$query_sub = "select * from subcategory where id_category = ".$id_param;
	$result = mysql_query($query_sub);

	$loop_subcat = array();
	for ($i=0; $row = mysql_fetch_array($result); $i++){
	  $loop_subcat['id'][$i]=$row['id'];
	  $loop_subcat['name'][$i]=$row['name'];
	  $loop_subcat['name_url'][$i]=str_replace(" ", "_", $row['name']);
	  $loop_subcat['name_cat'][$i]=$name_cat;

	}
	$tmpl->param('LOOP_SUBCAT', $loop_subcat);  
}

$tmpl->param('HOME', 0);  

mysql_close($db);

$tmpl->output();
?>
