const problem_data = JSON.parse(localStorage.getItem("problem_data"));
const answer_file_path = "../Temp/answer.svg";
const edit_file_path = "../Temp/edit.svg";

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
            
            fetch("generateToFile.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                if(data === "success"){
                    document.getElementById("edit_img").src = edit_file_path+"?time=" + new Date().getTime();
                }
                else{
                    document.getElementById("edit_img").src = "";
                }
            })
            .catch(error => {
                console.error("Error:", error);
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
    const hashmap = {
        uml : editor.getValue(),
        file_name : "edit",
        file_type : "png"
    }

    fetch("generateToFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(hashmap)
    })
    .then(response => response.text())
    .then(data => {
        if(data === "success"){
            var download_link = document.createElement("a");
            download_link.href = "../Temp/edit.png";
            download_link.download = "converted.png";
            download_link.click();
        }
        else{
            document.getElementById("download_warning").classList.add("text-red");
        }                    
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function click_download_svg(){
    const hashmap = {
        uml : editor.getValue(),
        file_name : "edit",
        file_type : "svg"
    }

    fetch("generateToFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(hashmap)
    })
    .then(response => response.text())
    .then(data => {
        if(data === "success"){
            var download_link = document.createElement("a");
            download_link.href = edit_file_path;
            download_link.download = "converted.svg";
            download_link.click();
        }
        else{
            document.getElementById("download_warning").classList.add("text-red");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function click_download_txt(){
    const hashmap = {
        uml : editor.getValue(),
        file_name : "edit",
        file_type : "txt"
    }

    fetch("generateToFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(hashmap)
    })
    .then(response => response.text())
    .then(data => {
        if(data === "success"){
            var download_link = document.createElement("a");
            download_link.href = "../Temp/edit.atxt";
            download_link.download = "converted.atxt";
            download_link.click();
        }
        else{
            document.getElementById("download_warning").classList.add("text-red");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function generate_answer_file(hashmap){
    fetch("generateToFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(hashmap)
    })
    .then(response => response.text())
    .then(data => {
        set_answer_img_src(answer_file_path);
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function set_answer_img_src(url){
    const img = document.getElementById("answer_img");
    img.src = url;

    document.getElementById("answer_code").innerHTML = "";
}
