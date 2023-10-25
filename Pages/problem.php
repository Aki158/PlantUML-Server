<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <title id="problem_title"></title>
        <script src="onload.js"></script>
    <style>
        .urm_display_area {
            width: 400px;
            height: 600px;
            overflow-y: scroll;
            border: 1px solid grey;
        }

        .answer_textbox {
            width: 400px;
            height: 600px;
            overflow-y: scroll;
            border: 1px solid grey;
        }

        .flex-container {
            display: flex;
        }

        .flex-item {
            flex: 1;
            margin: 10px;
        }

        .margin {
            margin: 5px;
        }
    </style>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <script>
        const param_id = getQueryParam('id');
        const answer_file_path = '../Outputs/answer.svg';
        const edit_file_path = '../Outputs/edit.svg';

        require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs" }});
        require(["vs/editor/editor.main"], function() {
            window.editor = monaco.editor.create(document.getElementById("editor"), {
                value:  "' ここから記述してください\n",
                language: "markdown"
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
                            file_name : "edit"
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
            document.getElementById("editor").addEventListener('keyup', debounce(generateToFile, 300));
        });

        // 現在のURLからクエリパラメータを取得する関数
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const problem_data = JSON.parse(localStorage.getItem('problem_data'));

        window.addEventListener("load", (event) => {
               
            // titleの表示設定
            document.getElementById("problem_title").innerHTML = "ID:"+problem_data.id+" "+problem_data.title;
            document.getElementById("problem_sub_title").innerHTML = "ID:"+problem_data.id+" "+problem_data.title;

            const hashmap = {
                uml : problem_data.uml,
                file_name : "answer"
            }

            // answer.pumlとanswer.svgを生成する
            generate_answer_file(hashmap);
        });

        // window.addEventListener("load", (event) => {
        //     request = load_jsonfile(new XMLHttpRequest(),'../Problems/'+param_id+'.json','json');
        //     request.onload = function() {
        //         window.list = JSON.parse(JSON.stringify(request.response));

        //         // titleの表示設定
        //         document.getElementById("problem_title").innerHTML = "ID:"+list.id+" "+list.title;
        //         document.getElementById("problem_sub_title").innerHTML = "ID:"+list.id+" "+list.title;

        //         const hashmap = {
        //             uml : list.uml,
        //             file_name : "answer"
        //         }

        //         // answer.pumlとanswer.svgを生成する
        //         generate_answer_file(hashmap);
        //     }
        // });

        function click_answer_uml(){
            set_answer_img_src(answer_file_path);
        };

        function click_answer_code(){
            const img = document.getElementById("answer_img");
            img.src = "";

            document.getElementById("answer_code").innerHTML = "<pre>"+problem_data.uml+"</pre>";
        }

        function generate_answer_file(hashmap){
            console.log("debug_start");

            fetch('generateToFile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                console.log("debug_end1");
                set_answer_img_src(answer_file_path);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function set_answer_img_src(url){
            const img = document.getElementById("answer_img");
            img.src = url;
            console.log("debug_end2");
            document.getElementById("answer_code").innerHTML = "";
        }
    </script>

    <h1 id="problem_sub_title"></h1>
    <div class="flex-container">
        <div class="row">
            <div class="col px-0">
                <div id="editor" style="width:400px;height:600px;border:1px solid grey"></div>
            </div>
            <div class="col px-0">
                <div class="urm_display_area">
                    <p class="my-0">■Download</p>
                    <div class="">
                        <button class="margin" id="download_png_button" type="button" name="Preview" onclick="click_download_png();">png</button>
                        <button class="margin" id="download_svg_button" type="button" name="HTML" onclick="click_download_svg();">svg</button>
                        <button class="margin" id="download_txt__button" type="button" name="HTML" onclick="click_download_txt();">txt</button>
                    </div>
                    <p class="my-0">■Preview</p>
                    <img id="edit_img" src="" alt="No image.">
                    <p id="edit_debug" ></p>
                </div>
            </div>
            <div class="col px-0">
                <div class="answer_textbox">
                    <button class="margin" id="preview_button" type="button" name="Preview" onclick="click_answer_uml();">Answer UML</button>
                    <button class="margin" id="html_button" type="button" name="HTML" onclick="click_answer_code();">Answer Code</button>
                    <div id="answer_display_area">
                        <img id="answer_img" src="">
                        <div id="answer_code"></div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <a href="problems.php" class="btn btn-light margin" role="button">戻る</a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>