<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json_data = file_get_contents("php://input");
        $hashmap = json_decode($json_data, true);
        $uml = $hashmap["uml"];
        $file_name = $hashmap["file_name"];
        $file_type = $hashmap["file_type"];
        $puml_file_path = "../Temp/".$file_name.".puml";
        $output_file_path = $file_type === "txt" ? "../Temp/".$file_name.".atxt" : "../Temp/".$file_name.".".$file_type;
        $jar_file_path = "../Plantuml/plantuml.jar";

        // 初回ロード時は、前回利用時のファイルが存在する可能性があるため
        // Tempフォルダのファイルをすべて削除する
        if($file_name === "answer" & is_dir("../Temp")){
            $files = glob("../Temp/*");
            
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        // puml形式でファイルを保存する
        file_put_contents($puml_file_path, $uml);

        // file_typeの形式でファイルを保存する
        $command = "java -jar ".$jar_file_path." -t".$file_type." ".$puml_file_path;
        exec($command);

        if(is_file($output_file_path)){
            print("success");
        }
        else{
            print($output_file_path);
        }
    }
?>
