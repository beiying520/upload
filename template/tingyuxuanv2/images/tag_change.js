function selectTag(showContent,selfObj){
	// 操作标签
	var tag = document.getElementById("tags").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.parentNode.className = "selectTag";
	// 操作内容
	for(i=0; j=document.getElementById("tagContent"+i); i++){
		j.style.display = "none";
	}
	document.getElementById(showContent).style.display = "block";
}

function iboxActive(id, key, num, max) {
var menu = document.getElementById(id + "menu");
(menu.getElementsByTagName("INPUT")[0]||{}).value = key;
var main = menu.parentNode;
var applyfilter;
var menudivs = menu.getElementsByTagName("DIV");
for (var i = 0; i < menudivs.length; i ++) {
menudivs[i].className = id+"menuoff";
(menudivs[i].getElementsByTagName("A")[0]||{}).className = "";
}
menudivs[num].className = id+"menuon"+(num % max);
(menudivs[num].getElementsByTagName("A")[0]||{}).className = "active";
try {
applyfilter = main.filters && main.filters[0];
if (applyfilter) {
main.filters[0].apply();
}
} catch(e) {}
var parent = menu.parentNode;
var childs = parent.childNodes;
var divs = [];
for (var i = 0, c = childs.length; i < c; i ++) {
if (childs[i].tagName == 'DIV') {
if (divs.length) childs[i].style.display = 'none';
divs[divs.length] = childs[i];
}
}
divs[num+1].style.display = 'block';
try {
if (applyfilter) {
main.filters[0].play();
}
} catch(e) {}
}