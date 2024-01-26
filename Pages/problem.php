<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <title id="problem_title"></title>
</head>
<body>
    <h1 id="problem_sub_title"></h1>
    <div class="d-flex">
            <div id="editor" class="col px-0 editor-box"></div>
            <div id="urm_display_area" class="display_area col px-0">
                <p class="my-0">■Download</p>
                <p id="download_warning" class="my-0">※Preview が No image. の場合は、出力できません！</p>
                <div>
                    <button id="download_png_button" class="m-1" type="button" name="Preview" onclick="click_download_png();">png</button>
                    <button id="download_svg_button" class="m-1" type="button" name="HTML" onclick="click_download_svg();">svg</button>
                    <button id="download_txt__button" class="m-1" type="button" name="HTML" onclick="click_download_txt();">txt</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
    <script src="/public/js/app_problem.js"></script>
</body>
