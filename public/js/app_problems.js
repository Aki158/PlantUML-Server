var clicked_page_index = 1;

window.addEventListener("load", (event) => {
    request = new XMLHttpRequest();
    request.open("GET", "../Problems/problems.json");
    request.responseType = "json";
    request.send();
    request.onload = function() {
        const problems_hashmap_arr = JSON.parse(JSON.stringify(request.response));

        for (var i = 0; i < Object.keys(problems_hashmap_arr).length; i++) {
            if(i % 5 == 0){
                render_page_button((i / 5) + 1,problems_hashmap_arr,document.getElementById("page_button_group"));
            }
            render_table_cell(i,problems_hashmap_arr,document.getElementById("table_body"));
        }
    }
});

function render_page_button(page_index,problems_hashmap_arr,page_button_group){
    const li = document.createElement("li");
    const p = document.createElement("p");

    p.setAttribute("id", "page"+page_index);

    p.innerHTML = page_index;
    if(page_index == 1){
        p.classList.add("page-clicked-link","cursor-pointer");
    }
    else{
        p.classList.add("page-link","cursor-pointer");
    }
    
    p.addEventListener("click", function() {
        clicked_page_index = page_index;

        for (var i = 0; i < Object.keys(problems_hashmap_arr).length; i++) {
            set_display_state(i,document.getElementById("table_content"+(i+1)));
        }
        
        for (var i = 1; i < Math.floor(Object.keys(problems_hashmap_arr).length / 5) + 1; i++) {
            const page_button = document.getElementById("page"+(i));

            if(i == clicked_page_index & page_button.classList.contains("page-link")){
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

function render_table_cell(index,problems_hashmap_arr,table_body){
    const row = document.createElement("tr");
    const cell_th_id = document.createElement("th");
    const cell_td_title = document.createElement("td");
    const cell_td_theme = document.createElement("td");

    row.setAttribute("id", "table_content"+(index+1));

    cell_th_id.setAttribute("id", "id"+(index+1));
    cell_td_title.setAttribute("id", "title"+(index+1));
    cell_td_theme.setAttribute("id", "theme"+(index+1));

    cell_th_id.innerHTML = problems_hashmap_arr[index].id;
    cell_td_title.innerHTML = problems_hashmap_arr[index].title;
    cell_td_theme.innerHTML = problems_hashmap_arr[index].theme;

    row.classList.add("cursor-pointer");
    
    set_display_state(index,row);

    row.addEventListener("click", function() {
        localStorage.setItem("problem_data", JSON.stringify(problems_hashmap_arr[index]));
        window.location.href = "problem.php"+"?id="+cell_th_id.innerHTML;
    });

    row.append(cell_th_id);
    row.append(cell_td_title);
    row.append(cell_td_theme);
    table_body.append(row);
}

function set_display_state(index,table_row){
    // page_indexの値からtableへの表示/非表示を設定する
    if((clicked_page_index-1) * 5 <= index & index < clicked_page_index * 5){
        table_row.style.display = "";
    }
    else{
        table_row.style.display = "none";
    }
}
