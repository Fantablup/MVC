function rgb2hex(rgb) {
	'use strict';
	
    var rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		function hex(x) {
			return ("0" + parseInt(x).toString(16)).slice(-2);
		}
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function isJson(str) {
	
	if (str && typeof str === "object") {
		return true;
    }
	else{
		return false;
	}
	
}

function removeParam(parameter)
{
	var url=document.location.href;
	var urlparts= url.split('?');

		if (urlparts.length>=2)
		{
			var urlBase=urlparts.shift(); 
			var queryString=urlparts.join("?"); 
			var prefix = encodeURIComponent(parameter)+'=';
			var pars = queryString.split(/[&;]/g);
				for (var i= pars.length; i-->0;) 
  
				if (pars[i].lastIndexOf(prefix, 0)!==-1)   
					pars.splice(i, 1);
		  
			url = urlBase+'?'+pars.join('&');
			window.history.pushState('',document.title,url); // added this line to push the new url directly to url bar .
		}
		
	return url;
}

(function(SUSSY_TABLEVIEW){
	'use strict';
	
	function loadData(){
		var hr = new XMLHttpRequest();
		var url = "index.php";
		var vars = "action=tableview"+"&loadtable=1";
		var modalBox = document.querySelector(".modalBox");
		var modalText = document.querySelector(".modalText");
		modalText.innerHTML += 'Connecting...';
		modalBox.style.display="flex";
		hr.open("POST", url, true);
		// Set content type header information for sending url encoded variables in the request
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
						try{
							var dataResult = JSON.parse(hr.responseText);
				
								if (!isJson(dataResult)){
									modalText.innerHTML += hr.responseText;
									//modalBox.style.display="none";
									return false;
								}
					
						}catch(e){
							modalText.innerHTML = hr.responseText;
								setTimeout(function(){ 
									modalBox.style.display="none";
								}, 5000);
							return false;
						}
					var ul = document.getElementById("tableDBList");
					var i = 0;
						for (i = 0; i <= dataResult.length - 1; i++) {
							var li = document.createElement('li');     // create li element.
							li.innerHTML += '<div>'+dataResult[i].name+'</div>';
							li.innerHTML += '<div>'+dataResult[i].weight+'</div>';
							li.innerHTML += '<div style="background-color:'+dataResult[i].color+'"></div>';
							li.innerHTML += '<div>'+dataResult[i].shippingcost+'</div>';
							li.setAttribute('class', 'defaultRow');    // remove the bullets.
							ul.appendChild(li);     // append li to ul.
						}
					modalBox.style.display="none";
				}
			}
		// Send the data to PHP now... and wait for response to update the status div
		hr.send(vars); // Actually execute the request
	}	
	SUSSY_TABLEVIEW.loadData = loadData;

}(window.SUSSY_TABLEVIEW = window.SUSSY_TABLEVIEW || {}));

(function(SUSSY_ADDBOX) {
	'use strict';

	function openColors()
	{
		var cValue = window.getComputedStyle(document.getElementById('addBoxColor')).getPropertyValue("background-color");
		cValue = rgb2hex(cValue);
		document.getElementById("c").focus();
		document.getElementById("c").value = cValue;
		document.getElementById("c").click();
	}
	SUSSY_ADDBOX.openColors = openColors;
	
	function changeColor(color)
	{
			if (color == null) return false;
		document.getElementById("addBoxColor").style.backgroundColor = color;
		document.getElementById("colorvalue").value = color;
	}
	SUSSY_ADDBOX.changeColor = changeColor;
	/* Done as an async function for you to see the await function(without the exception). */
	async function saveData(params){
		return new Promise((resolve, reject) => {
			var hr = new XMLHttpRequest();
			var url = "index.php";
			var vars = "action=addbox"+"&savedata=1";
			var saved = false;
			var modalBox = document.querySelector(".modalBox");
			var modalText = document.querySelector(".modalText");
			modalText.innerHTML += 'Connecting...';
			modalBox.style.display="flex";
			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
				hr.onreadystatechange = function() {
					var addInfoBbox = document.getElementById("addInfoBbox");
					var addBoxColor = document.getElementById("addBoxColor");
					var infoClass = "idle";
						if(hr.readyState == 4 && hr.status == 200) {
								try{
									var dataResult = JSON.parse(hr.responseText);
						
										if (!isJson(dataResult)){
											dataResult = hr.responseText;
											infoClass = "error";
											addInfoBbox.classList.remove("error");
											addInfoBbox.classList.remove("ok");
											addInfoBbox.classList.remove("idle");
											addInfoBbox.classList.add(infoClass);
											addInfoBbox.innerHTML += dataResult;
											modalText.innerHTML = hr.responseText;
												setTimeout(function(){ 
													modalBox.style.display="none";
												}, 5000);
									        resolve(false);
											return false;
										}
							
									saved = true;
									infoClass = "ok";
									addInfoBbox.innerHTML += "Data is saved. Last id is "+dataResult[0]+"<br>Look in the table view.";
									/* Removing parameters from the search bar, so it can't be saved again */
									removeParam('color');
									removeParam('submittype');
									removeParam('countries');
									removeParam('weight');
									removeParam('name');
									document.getElementById('addBoxname').value = '';
									document.getElementById('addBoxweight').value = '';
									document.getElementById('addBoxcountries').value = '1';
                                    changeColor("");
								}catch(e){
									infoClass = "error";
									dataResult = hr.responseText;
									modalText.innerHTML = hr.responseText;
										setTimeout(function(){ 
											modalBox.style.display="none";
										}, 5000);
								}
					
								if (!saved)
									addInfoBbox.innerHTML += dataResult;
						
							addInfoBbox.classList.remove("error");
							addInfoBbox.classList.remove("ok");
							addInfoBbox.classList.remove("idle");
							addInfoBbox.classList.add(infoClass);
				
								if (!saved)
								{
									setTimeout(function(){ 
										modalText.innerHTML = "Could not save data!";
										modalBox.style.display="none";
									}, 5000);
									resolve(false);
								}else{
									modalBox.style.display="none";
									resolve(true);
								}
								
						}
				}
			// Send the data to PHP now... and wait for response to update the status div
			hr.send("postdata=" + encodeURIComponent(JSON.stringify(params))); ; // Actually execute the request
		});
	}	
	SUSSY_ADDBOX.saveData = saveData;	
}(window.SUSSY_ADDBOX = window.SUSSY_ADDBOX || {}));
