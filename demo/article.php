<?php

include("inc_php/include.php.inc");

$tmpl->setHtmlName("article.tmpl");

include("inc_php/include_menu.php.inc");


$id_param = "";
if(isset($_GET['id'])) {
	$id_param = $_GET['id'];
}

$query_art = "select c.id, c.title, c.description, a.name as cat, a.id as id_cat, b.name as subcat_name, b.id as id_subcat "
			." from article c, category a, subcategory b where c.id = ".$id_param." and c.id_subcategory = b.id and a.id = b.id_category";
			
$result = mysql_query($query_art);
$row = mysql_fetch_row($result);
$tmpl->param('ID', $row[0]);  
$tmpl->param('TITLE', $row[1]);  
$tmpl->param('DESCRIPTION', $row[2]);  
$tmpl->param('CAT', $row[3]);  
$tmpl->param('ID_CAT', $row[4]);  
$tmpl->param('SUBCAT_NAME', $row[5]);  
$tmpl->param('SUBCAT_NAME_URL', str_replace(" ", "_", $row[5]));  
$tmpl->param('ID_SUBCAT', $row[6]);  

mysql_close($db);

$tmpl->param('HOME', 0);  

$tmpl->output();
?>
