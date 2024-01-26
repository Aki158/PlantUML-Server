<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $json_data = file_get_contents("php://input");
        $hashmap = json_decode($json_data, true);
        $uml = $hashmap["uml"];
        $file_name = $hashmap["file_name"];
        $file_type = $hashmap["file_type"];

        $temp_path = "../Temp";
        $excluded_files = [$temp_path."/answer.puml", $temp_path."/answer.svg"];
        $puml_file_path = $temp_path."/".$file_name.".puml";
        $output_file_path = $file_type === "txt" ? $temp_path."/".$file_name.".atxt" : $temp_path."/".$file_name.".".$file_type;
        $jar_file_path = "../Plantuml/plantuml.jar";

        // 前回利用時のファイルが存在する可能性があるため
        // Tempフォルダのファイルをすべて削除する
        // ただし、monaco-editorを編集中の場合は、answerFileは削除しない
        if(is_dir($temp_path)){
            $files = glob($temp_path."/*");
            foreach ($files as $file) {
                if(is_file($file) && !($file_name === "edit" && in_array($file, $excluded_files))){
                    unlink($file);    
                }
            }
        }

        // puml形式でファイルを保存する
        file_put_contents($puml_file_path, $uml);

        // file_typeの形式でファイルを保存する
        $command = "java -jar ".$jar_file_path." -t".$file_type." ".$puml_file_path;
        exec($command);

        // ファイルが無事保存されている場合は、successをapp_problem.jsに返す
        if(is_file($output_file_path)){
            print("success");
        }
        else{
            print($output_file_path);
        }
    }
