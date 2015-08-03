


function feedback(feed){
var array = Callfeedback(feed);
var ok = array[0];
var del = array[1];
var glyphs = document.getElementsByTagName("span");
glyphOk = glyphs[ok].getAttribute("id");
glyphok = document.getElementById(glyphOk);
glyphDel = glyphs[del].getAttribute("id");
glyphdel = document.getElementById(glyphDel);
	
	if (feed.value != "" && glyphdel.classList.contains("hidden")){
		feed.parentNode.parentNode.className = "form-group col-sm-6 has-success has-feedback";
		glyphok.classList.remove("hidden");
	} else if (feed.value == "" && glyphok.classList.contains("hidden")) {
		feed.parentNode.parentNode.className = "form-group col-sm-6 has-error has-feedback";
		glyphdel.classList.remove("hidden");
	} else if (feed.value != "" && !glyphdel.classList.contains("hidden")) {
		feed.parentNode.parentNode.className = "form-group col-sm-6 has-success has-feedback ";
		glyphdel.classList.add("hidden");
		glyphok.classList.remove("hidden");
	} else {
		feed.parentNode.parentNode.className = "form-group col-sm-6 has-error has-feedback";
		glyphok.classList.add("hidden");
		glyphdel.classList.remove("hidden");
	}
}
function focusfeedback(feed){
var array = Callfeedback(feed);
var ok = array[0];
var del = array[1];
var glyphs = document.getElementsByTagName("span");
glyphOk = glyphs[ok].getAttribute("id");
glyphok = document.getElementById(glyphOk);
glyphDel = glyphs[del].getAttribute("id");
glyphdel = document.getElementById(glyphDel);
	if (!glyphdel.classList.contains ("hidden")){
		feed.parentNode.parentNode.className = "form-group col-sm-6"
			glyphdel.classList.add ("hidden");
		
	} if (!glyphok.classList.contains ("hidden")){
		feed.parentNode.parentNode.className = "form-group col-sm-6"
			glyphok.classList.add ("hidden");
	}
}
function phonefeedback(feed){
	var val = feed.value;
	
	var res = isNaN(val);
	
	if ((res == false) || (val == "" )){
		feedback(feed);
	} else if (res == true) {
		checkdigit(feed);
		return true
		
	}
}


function checkdigit(accno){
var array = Callfeedback(accno);
var del = array[1];
var glyphs = document.getElementsByTagName("span");
glyphDel = glyphs[del].getAttribute("id");
glyphdel = document.getElementById(glyphDel);
	var errorwarn = document.getElementById("submitwarn");
	if (isNaN(accno.value)) {
		errorwarn.classList.remove("hidden");
		accno.parentNode.parentNode.className = "form-group col-sm-6 has-error has-feedback";
		glyphok.classList.add("hidden");
		glyphdel.classList.remove("hidden");
		
	} else if (!errorwarn.classList.contains ("hidden")) {
		errorwarn.classList.add("hidden");	
		accno.parentNode.parentNode.className = "form-group col-sm-6";
			glyphdel.classList.add ("hidden");
			
	}

}

function SUbmit(info){
	var inputs = document.getElementsByTagName("input");
	var numofinputs = inputs.length;
	var each;
	
	var process = "true";
	for (each in Range(0,numofinputs,1)) {
		var phonestop = "document";
		if (inputs[each].value == ""){
			
			process = "false";
			feedback(inputs[each]);
			
		} 	else if ((inputs[each].getAttribute("id") == "contnumber") && (phonefeedback(inputs[each])== true)){
				process = "false"
				inputs[each].value = "";
				var errorwarn = document.getElementById("submitwarn");
				if (!errorwarn.classList.contains ("hidden")) {
					errorwarn.classList.add("hidden");	
					feedback(inputs[each])
				;
			}
			
		}
	} if (process == "false"){
		alert("Please fill all empty fields");
	}
	else if (process == "true") {
		var results = []
		for (each in Range(0,numofinputs,1)) {
			results. push(inputs[each].value);
		} alert (results);
		insertintodatabase();
		var success = document.getElementById("submitok");	
		success.classList.remove("hidden");
		document.getElementById("submit").classList.add("hidden");
		document.getElementById("moveon").classList.remove("hidden");
		
		
	}
}
function insertintodatabase(){
	$.ajax({
		 
		
	})
	
}
 function Callfeedback(inputname){
	 var results = []
	 var inputparent = inputname.parentNode;
	 var inputprtid = inputparent.getAttribute("id");
	 var getspecspan = document.getElementById(inputprtid).getElementsByTagName("span");
	 var getallspan = document.getElementsByTagName("span");
	 arrayofspanid = getspanids(getallspan);
	 id1 = arrayofspanid.indexOf(getspecspan[0].id);
	 id2 = arrayofspanid.indexOf(getspecspan[1].id);
	 results.push(id1);
	 results.push(id2);
	 
	 return results;
	 
 }

function getspanids(array){
	var each
	var results = []
	for (each in Range(0, array.length, 1)){
		idname = array[each].id;
		results.push(idname);
	}  return results;
}
function Range(start, stop, step) {
	var result = [];
	if (typeof stop == "undefined") {
		stop = start;
		start = 0;
	}
	if (typeof step == "undefined"){
		step = 1;
	}
	if ((step > 0 && start >= step) || (step < 0 && start <= stop)) {
		return result;
	}
	else if (step > 0){
		
		for (var i = 0; i < stop; i+=step) {
			 result.push(i);
	}
	} else if (step < 0){
		for (var i = 0; i > stop; i+=step) {
			result.push(i);
	}
	} return result;

}

function releaseproducts(submitted){
	
	document.getElementById("prodselform").classList.add("hidden");
	document.getElementById("prodselform2").classList.remove("hidden");
}