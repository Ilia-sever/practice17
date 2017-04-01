<?php

header('Content-type: text/html; charset=utf-8');

$mysqli = new mysqli('localhost', 'root', '', 'pract17');
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8');
$reses = array(array ());
$result=0;

if (isset($_POST["fnd"])) {
	if  (!empty($_POST["f"]))
	{
		$f=$_POST["f"];
		$result=$mysqli->query("SELECT head,text,date,tag FROM  `news` where `head` like '%$f%' or `text` like '%$f%';");
	}
}
else {
	for ($i=2;$i<11;$i++)
	{
		$sch="b"."$i";
		if (isset($_POST["$sch"])) $tg="#".$_POST["$sch"];
	}
$result=$mysqli->query("SELECT head,text,date,tag FROM  `news` where `tag`='$tg';");
}


$rows = $result->num_rows;
for ($j = 0 ; $j < $rows; ++$j)
{
$result->data_seek($j);
$reses[$j][0]=mb_strtoupper($result->fetch_object()->head,'utf8');
$result->data_seek($j);
$reses[$j][1]=$result->fetch_object()->text;
$result->data_seek($j);
$reses[$j][2]=$result->fetch_object()->date;
$result->data_seek($j);
$reses[$j][3]=$result->fetch_object()->tag;
}
for ($i=$rows;$i<3;++$i)
{
	for ($j=0;$j<4;$j++)
	$reses[$i][$j]="";

}

require_once('index.html');
$mysqli->close();













