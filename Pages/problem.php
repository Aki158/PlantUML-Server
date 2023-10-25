<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <title id="problem_title"></title>
    <style>
        .display_area {
            height: 600px;
            overflow-y: scroll;
            border: 1px solid grey;
        }

        .text-red {
            color: red;
        }
    </style>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <script>
        const problem_data = JSON.parse(localStorage.getItem('problem_data'));
        const answer_file_path = '../Temp/answer.svg';
        const edit_file_path = '../Temp/edit.svg';

        require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs" }});
        require(["vs/editor/editor.main"], function() {
            window.editor = monaco.editor.create(document.getElementById("editor"), {
                value:  "' ここから記述してください\n",
                language: "plaintext"
            });

            function debounce(func, wait) {
                var timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            const generateToFile = () => {
                    const hashmap = {
                            uml : editor.getValue(),
                            file_name : "edit",
                            file_type : "svg"
                        }
                    
                    fetch('generateToFile.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(hashmap)
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("edit_img").src = edit_file_path+"?time=" + new Date().getTime();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                });
            };

            // エディタの変更を監視し、debounce関数を使用して呼び出しを遅延させる
            editor.getModel().onDidChangeContent(debounce(generateToFile, 300));
        });

        window.addEventListener("load", (event) => {
            // titleの表示設定
            document.getElementById("problem_title").innerHTML = "ID:"+problem_data.id+" "+problem_data.title;
            document.getElementById("problem_sub_title").innerHTML = "ID:"+problem_data.id+" "+problem_data.title;

            const hashmap = {
                uml : problem_data.uml,
                file_name : "answer",
                file_type : "svg"
            }

            // answer.pumlとanswer.svgを生成する
            generate_answer_file(hashmap);
        });

        function click_answer_uml(){
            set_answer_img_src(answer_file_path);
        };

        function click_answer_code(){
            const img = document.getElementById("answer_img");
            img.src = "";

            document.getElementById("answer_code").innerHTML = "<pre>"+problem_data.uml+"</pre>";
        }

        function click_download_png(){
            if(editor.getValue() === "' ここから記述してください\n"){
                document.getElementById("download_warning").classList.add("text-red");
            }
            else{
                const hashmap = {
                    uml : editor.getValue(),
                    file_name : "edit",
                    file_type : "png"
                }

                fetch('generateToFile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(hashmap)
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);

                    if(data === "success"){
                        var download_link = document.createElement('a');
                        download_link.href = '../Temp/edit.png';
                        download_link.download = 'converted.png';
                        download_link.click();
                    }
                    else{
                        document.getElementById("download_warning").classList.add("text-red");
                    }                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        function click_download_svg(){
            const hashmap = {
                uml : editor.getValue(),
                file_name : "edit",
                file_type : "svg"
            }

            fetch('generateToFile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);

                if(data === "success"){
                    var download_link = document.createElement('a');
                    download_link.href = edit_file_path;
                    download_link.download = 'converted.png';
                    download_link.click();
                }
                else{
                    document.getElementById("download_warning").classList.add("text-red");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function click_download_txt(){
            const hashmap = {
                uml : editor.getValue(),
                file_name : "edit",
                file_type : "txt"
            }

            fetch('generateToFile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);

                if(data === "success"){
                    var download_link = document.createElement('a');
                    download_link.href = '../Temp/edit.atxt';
                    download_link.download = 'converted.atxt';
                    download_link.click();
                }
                else{
                    document.getElementById("download_warning").classList.add("text-red");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function generate_answer_file(hashmap){
            fetch('generateToFile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                set_answer_img_src(answer_file_path);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function set_answer_img_src(url){
            const img = document.getElementById("answer_img");
            img.src = url;

            document.getElementById("answer_code").innerHTML = "";
        }
    </script>

    <h1 id="problem_sub_title"></h1>
    <div class="d-flex">
            <div id="editor" class="col px-0" style="height:600px;border:1px solid grey"></div>
            <div id="urm_display_area" class="display_area col px-0">
                <p class="my-0">■Download</p>
                <p id="download_warning" class="my-0">※Preview が No image. の場合は、出力できません！</p>
                <div>
                    <button class="m-1" id="download_png_button" type="button" name="Preview" onclick="click_download_png();">png</button>
                    <button class="m-1" id="download_svg_button" type="button" name="HTML" onclick="click_download_svg();">svg</button>
                    <button class="m-1" id="download_txt__button" type="button" name="HTML" onclick="click_download_txt();">txt</button>
                </div>
                <p class="my-0">■Preview</p>
                <img id="edit_img" src="" alt="No image.">
            </div>
            <div id="answer_display_area" class="display_area col px-0">
                <button id="preview_button" class="m-1" type="button" name="Preview" onclick="click_answer_uml();">Answer UML</button>
                <button id="html_button" class="m-1" type="button" name="HTML" onclick="click_answer_code();">Answer Code</button>
                <div>
                    <img id="answer_img" src="">
                    <div id="answer_code"></div>
                </div>
            </div>
        </div>
    </div>
    <a href="problems.php" class="btn btn-light m-1" role="button">戻る</a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>