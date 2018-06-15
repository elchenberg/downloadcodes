<?php
require_once('../config.php');
if(isset($_GET)){
	$album_id = $mysqli->real_escape_string($_GET['album']);
	$batch_id = $mysqli->real_escape_string($_GET['batch']);

	if($c = $mysqli->query("select * from config where id = 1")){
		if(!$config = $c->fetch_assoc()){
			printf("<div class=\"alert alert-error\">Error: %s</div>", $mysqli->error);
		}
	}else{
		printf("<div class=\"alert alert-error\">Error: %s</div>", $mysqli->error);	
	}

//	if($result = $mysqli->query("select a.artist as artist, a.album as album, c.code as code from albums a left outer join codes c on c.album = a.id where c.album = ".$album_id." and c.batch = ".$batch_id)){
	if($result = $mysqli->query("select a.artist as artist, a.album as album, c.code as code from albums a left outer join codes c on c.album = a.id where c.album = ".$album_id." and c.batch = ".$batch_id)){
    	header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=codes.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Artist', 'Album', 'Code'));
		while(null !== ($row = $result->fetch_assoc())){
        //while ($row = mysql_fetch_assoc($rows)) {
            fputcsv($output, $row);
            //fwrite($output, "\r\n");
            //fputcsv($output, array($row['artist'], $row['album'], $row['code']));
        }
        fclose($output);
	}
        /*
		$i=0;
		while(null !== ($row = $result->fetch_assoc())){
			echo '<div class="card">';
			echo '<img src="assets/'.$config['code_logo'].'" height="100" />';
			echo $row['artist'].' - <em>'.$row['album'].'</em><br />';
			echo '<span class="code">'.$row['code'].'</span><br />';
			echo $config['url'];
			echo '</div>';
			$i++;
			if($i == 8){
				echo '<div class="page-break"></div>';
				$i=0;
			}
		}

	}else{
		printf("<div class=\"alert alert-error\">Error: %s</div>", $mysqli->error);
	}*/
	mysqli_free_result($result);
}
?>
