<?php$file_url = "./swap/".$_POST['csvFilename']."CSVoutput.csv";$csvOutput = $_POST['csvOutput'];file_put_contents($file_url,$csvOutput);$headerFileName = $_POST['csvFilename']."CSVoutput.csv";header("Content-Description: File Transfer"); header("Content-Type: application/octet-stream"); header("Content-Disposition: attachment; filename=\"".$headerFileName."\""); readfile ($file_url); ?>