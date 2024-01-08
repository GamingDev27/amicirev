function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
function arrayBufferToBase64String( buffer) {
	let binaryString = ''
	var bytes = new Uint8Array(buffer);
	for (var i = 0; i < bytes.byteLength; i++) {
		binaryString += String.fromCharCode(bytes[i]);
	}

	return window.btoa(binaryString);
}

function setProvince(slct){
	provinceid = slct.value;
	if(provinceid){
		var xmlhttp = new XMLHttpRequest();
		var url = "/address/get_cities/"+provinceid;

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var cities = JSON.parse(this.responseText);
				if(cities.cities != undefined){
					options = "";
					for(cityid in cities.cities){
						options += "<option value="+cityid+">"+cities.cities[cityid]+"</option>";
					}
					document.getElementById("city_id").innerHTML = options;
				}
				if(cities.barangays != undefined){
					options = "";
					for(barangayid in cities.barangays){
						options += "<option value="+barangayid+">"+cities.barangays[barangayid]+"</option>";
					}
					document.getElementById("barangay_id").innerHTML = options;
				}
			}
		};
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
	}
}

function setCity(slct){
	cityid = slct.value;
	if(cityid){
		var xmlhttp = new XMLHttpRequest();
		var url = "/address/get_barangays/"+cityid;

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var barangays = JSON.parse(this.responseText);
				options = "";
				for(barangayid in barangays){
					options += "<option value="+barangayid+">"+barangays[barangayid]+"</option>";
				}
				document.getElementById("barangay_id").innerHTML = options;
			}
		};
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
	}
}