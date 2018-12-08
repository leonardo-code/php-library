<?php

// demo: 2 loop levels example
$query_menu = "select * from category";
$query_menu_sub = "select * from subcategory where id_category = ";

$result_menu = mysql_query($query_menu);
if (!$result_menu) {
    die('Invalid query: ' . mysql_error());
}

$loop_menu = array();
for ($i=0; $row_menu = mysql_fetch_array($result_menu); $i++){
  $loop_menu['id'][$i]=$row_menu['id'];
  $loop_menu['name'][$i]=$row_menu['name'];

  $result_menu_sub = mysql_query($query_menu_sub.$row_menu['id']);
  $loop_menu_sub=array();
  for ($j=0; $row_menu_sub = mysql_fetch_array($result_menu_sub); $j++){
	  $loop_menu_sub['id_sub'][$j]=$row_menu_sub['id'];  
	  $loop_menu_sub['name'][$j]=$row_menu['name']; 
	  $loop_menu_sub['name_sub'][$j]=$row_menu_sub['name']; 
	  $loop_menu_sub['name_sub_url'][$j]=str_replace(" ", "_", $row_menu_sub['name']); 
  }
  $loop_menu['LOOP_MENU_SUB'][$i]=$loop_menu_sub;
}  
$tmpl->param('LOOP_MENU_CAT', $loop_menu);  

?>
