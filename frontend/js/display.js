function checkboxed(objName){
    var objNameList=document.getElementsByName(objName);
	var btn = document.getElementById("btn");
	if(btn.getAttribute('title') == '2'){
		for(var j=0;j<objNameList.length;j++){
				objNameList[j].checked=false;
		}
		btn.setAttribute('title','1');
	}
	else{
		for(var j=0;j<objNameList.length;j++){
			objNameList[j].checked="checked";
		}
		btn.setAttribute('title','2');
	}
}