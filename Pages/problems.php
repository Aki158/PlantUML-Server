<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>UML問題集</title>
        <script src="onload.js"></script>
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
        }

        table {
            border-collapse: collapse;
        }

        .rem0p9 {
            font-size: 0.9rem;
        }

        .pt7 {
            padding-top: 7rem;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .page-clicked-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <script>
        var page_index = 1;

        window.addEventListener("load", (event) => {
            request = load_jsonfile(new XMLHttpRequest(),'../Problems/problems.json','json');
            request.onload = function() {
                window.list = JSON.parse(JSON.stringify(request.response));

                for (var i = 0; i < Object.keys(list).length; i++) {
                    if(i % 5 == 0){
                        render_page_button((i / 5) + 1,list,document.getElementById("page_button_group"));
                    }
                    render_table_cell(i,list,document.getElementById("table_body"));
                }
            }
        });

        function render_page_button(p_index,list,page_button_group){
            const li = document.createElement("li");
            const p = document.createElement("p");

            p.setAttribute("id", "page"+p_index);

            p.innerHTML = p_index;
            if(p_index == 1){
                p.classList.add("page-clicked-link","cursor-pointer");
            }
            else{
                p.classList.add("page-link","cursor-pointer");
            }
            
            p.addEventListener("click", function() {
                page_index = p_index;

                for (var i = 0; i < Object.keys(list).length; i++) {
                    set_display_state(i,document.getElementById("table_content"+(i+1)));
                }
                
                for (var i = 1; i < Math.floor(Object.keys(list).length / 5) + 1; i++) {
                    var page_button = document.getElementById("page"+(i));

                    if(i == page_index & page_button.classList.contains("page-link")){
                            page_button.classList.remove("page-link");
                            page_button.classList.add("page-clicked-link");
                    }
                    else{
                        page_button.classList.remove("page-clicked-link");
                        page_button.classList.add("page-link");
                    }
                }
            });

            li.append(p);
            page_button_group.append(li);
        }

        function render_table_cell(index,list,table_body){
            const row = document.createElement("tr");
            const cell_th_id = document.createElement("th");
            const cell_td_title = document.createElement("td");
            const cell_td_theme = document.createElement("td");

            row.setAttribute("id", "table_content"+(index+1));

            cell_th_id.setAttribute("id", "id"+(index+1));
            cell_td_title.setAttribute("id", "title"+(index+1));
            cell_td_theme.setAttribute("id", "theme"+(index+1));

            cell_th_id.innerHTML = list[index].id;
            cell_td_title.innerHTML = list[index].title;
            cell_td_theme.innerHTML = list[index].theme;

            row.classList.add("cursor-pointer");
            
            set_display_state(index,row);

            row.addEventListener('click', function() {
                localStorage.setItem('problem_data', JSON.stringify(list[index]));
                window.location.href = 'problem.php'+'?id='+cell_th_id.innerHTML;
            });

            row.append(cell_th_id);
            row.append(cell_td_title);
            row.append(cell_td_theme);
            table_body.append(row);
        }

        function set_display_state(index,table_row){
            // page_indexの値からtableへの表示/非表示を設定する
            if((page_index-1) * 5 <= index & index < page_index * 5){
                table_row.style.display = '';
            }
            else{
                table_row.style.display = 'none';
            }
        }
    </script>

    <div class="container pt7">
        <table class="table table-hover rem0p9">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Theme</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <nav>
                    <ul  id="page_button_group" class="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>