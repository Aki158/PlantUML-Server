
function load_jsonfile(request,url,type){
    request.open('GET', url);
    request.responseType = type;
    request.send();
    return request;
}
