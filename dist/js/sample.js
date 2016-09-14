/********取得搜索框****************/
var search = document.getElementById("search");
/********搜索按钮响应函数**********/
function Search() {
    if (search.value != "") {
      window.location.href = Home + "search/" + search.value;
    }
}
/********搜索框回车响应函数********/
function EnterSearch() {
	if (event.keyCode == 13 && search.value != "") {
	  window.location.href = Home + "search/" + search.value;
	}
}