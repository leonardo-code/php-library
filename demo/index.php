<?php

include("inc_php/include.php.inc");

$tmpl->setHtmlName("index.tmpl");

include("inc_php/include_menu.php.inc");

function short_text ($str_dev){
	
	$result_short = "";
	
	// changed	
	/*if (strlen($str_dev) > 400) {
		  $result_short = substr ($str_dev, 0, 400)."...";
	  } else {
		  $result_short = $str_dev;
	  }
  */
  $result_short = $str_dev;

	return $result_short;
}

function set_data($gin){
	date_default_timezone_set('Europe/Rome');
	
	return date("m/d/Y G:i", strtotime($gin));
}

$query_art = "select c.id, c.title, c.description, c.created_time, b.id as id_cat, b.name as name_cat, a.id as id_subcat, a.name as name_subcat "
			." from article c, category b, subcategory a where c.id_subcategory = a.id and a.id_category = b.id order by created_time desc limit 3";
$result = mysql_query($query_art);

$loop_art = array();
for ($i=0; $row = mysql_fetch_array($result); $i++){
  $loop_art['id'][$i]=$row['id'];
  $loop_art['title'][$i]=$row['title'];
  $loop_art['title_url'][$i]=str_replace(" ", "_", $row['title']);
  $loop_art['description'][$i]=$row['description'];
  $loop_art['desc_short'][$i]=short_text($row['description']);
  $loop_art['created_time'][$i]=set_data($row['created_time']);
  $loop_art['id_cat'][$i]=$row['id_cat'];
  $loop_art['name_cat'][$i]=$row['name_cat'];
  $loop_art['id_subcat'][$i]=$row['id_subcat'];
  $loop_art['name_subcat'][$i]=$row['name_subcat'];
  $loop_art['name_subcat_url'][$i]=str_replace(" ", "_", $row['name_subcat']);
}
$tmpl->param('LOOP_ART', $loop_art);  

$tmpl->param('HOME', 1);  

mysql_close($db);

$tmpl->output();
?>

?>
