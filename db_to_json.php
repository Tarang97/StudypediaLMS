<?php
include("functions/db.php");
include("functions/functions.php");
$data_type = "notes";
if(isset($_REQUEST['data_type']))       $data_type = $_REQUEST['data_type'];
$data_json = array();

if($data_type == "notes")
{
    $notes_sql = "SELECT * FROM notes";
    $notes_result = query($notes_sql);   
    foreach ($notes_result as $temp) {
        array_push($data_json, array("title"=>$temp['title'], "subject"=>$temp['subject'], "field"=>$temp['field'],"topics"=>$temp['topics']));
    }
}
elseif ($data_type == "cem") {
    $cem_sql = "SELECT * FROM competitive_exam";
    $cem_result = query($cem_sql);   
    foreach ($cem_result as $temp) {
        array_push($data_json, array("cem_name"=>$temp['cem_name'], "cem_authors"=>$temp['cem_authors'],"cem_topics"=>$temp['cem_topics']));
    }
}
elseif($data_type == "ebook"){
    $ebook_sql = "SELECT * FROM ebooks";
    $ebook_result = query($ebook_sql);   
    foreach ($ebook_result as $temp) {
        array_push($data_json, array("ebook_name"=>$temp['ebook_name'], "ebook_authors"=>$temp['ebook_authors'], "field"=>$temp['field'],"topics"=>$temp['topics']));
    }   
}
$output = json_encode($data_json);
echo $output;