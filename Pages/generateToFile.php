<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json_data = file_get_contents('php://input');
        $hashmap = json_decode($json_data, true);
        $uml = $hashmap['uml'];
        $file_name = $hashmap['file_name'];

        $puml_file_path = "../Outputs/".$file_name.".puml";
        $output_file_path = "../Outputs/".$file_name.".svg";
        $jar_file_path = "../Plantuml/plantuml.jar";

        // puml形式でファイルを保存する
        file_put_contents($puml_file_path, $uml);

        if ($file_name == "edit" & file_exists($output_file_path)) {
            unlink($output_file_path);
        }            
        // svg形式でファイルを保存する
        $command = "java -jar ".$jar_file_path." -tsvg ".$puml_file_path;
        exec($command);

        echo $uml;
    }
?>
