//获取省
$(document).ready(function(){
	$.ajax({
		url: "index.php?controller=Region&method=getProvincesJson",
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					var provinces = document.getElementById ("privince");
					for(var key in result.data){
						// alert(result.data[key]["name"]);
						    var opt = document.createElement ("option");
						    opt.value = result.data[key]["name"];
						    opt.innerText = result.data[key]["name"];
						    opt.id = result.data[key]["id"];
						    provinces.appendChild (opt);
					}
					//同时设置市和县 id 都是1
					commonGetCities(1);
					commonGetCountries(1);
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
});
//获取市
function getCities(){
	$("#city").empty(); 
	$("#country").empty(); 
	var provinceID = $("#privince option:selected").attr("id");
	// var cityID = 0;
	//----------获取市--------------
	$.ajax({
		url: "index.php?controller=Region&method=getCitiesJson&provinceID="+provinceID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					var cityID = result.data[0]["id"];

					//------------获取县----------------
	$.ajax({
		url: "index.php?controller=Region&method=getCountriesJson&cityID="+cityID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					// alert(result.data[0]["name"]);
					// document.getElementById ("city").empty();
					var countries = document.getElementById ("country");
					// cities.empty();
					for(var key in result.data){
						// alert(result.data[key]["id"]);
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    // opt.id = result.data[key]["id"];
					    countries.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});

//-----------------------------





					var cities = document.getElementById ("city");
					for(var key in result.data){
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    opt.id = result.data[key]["id"];
					    cities.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
	// //------------获取县----------------
	// $.ajax({
	// 	url: "/index.php?controller=Region&method=getCountriesJson&cityID="+cityID,
	// 	type: "GET",
	// 	dataType:"json",
	// 	success: function(result,textStatus){
	// 		if(textStatus == "success"){
	// 			if(result.code == 200){
	// 				// alert(result.data[0]["name"]);
	// 				// document.getElementById ("city").empty();
	// 				var countries = document.getElementById ("country");
	// 				// cities.empty();
	// 				for(var key in result.data){
	// 					// alert(result.data[key]["id"]);
	// 				    var opt = document.createElement ("option");
	// 				    opt.value = result.data[key]["name"];
	// 				    opt.innerText = result.data[key]["name"];
	// 				    // opt.id = result.data[key]["id"];
	// 				    countries.appendChild (opt);
	// 				}
	// 			}else{
	// 				alert(result.message);
	// 			}
	// 		}else{
	// 				alert("服务器错误 请重试");
	// 		}
 //  		},
 //  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
 //            alert("服务器错误 请重试"); 
 //        }
	// });

//---------------------






	// var cityID = firstCityID(provinceID);
	// // alert(cityID);
	// commonGetCities(provinceID);
	// // var cityID = firstCityID(provinceID);
	// // getFirstCountryID(cityID);
	// commonGetCountries(cityID);
	// $.ajax({
	// 	url: "/index.php?controller=Region&method=getCitiesJson&provinceID="+provinceID,
	// 	type: "GET",
	// 	dataType:"json",
	// 	success: function(result,textStatus){
	// 		if(textStatus == "success"){
	// 			if(result.code == 200){
	// 				// alert(result.data[0]["name"]);
	// 				// document.getElementById ("city").empty();
	// 				var cities = document.getElementById ("city");
	// 				// cities.empty();
	// 				for(var key in result.data){
	// 					alert(result.data[key]["id"]);
	// 				    var opt = document.createElement ("option");
	// 				    opt.value = result.data[key]["name"];
	// 				    opt.innerText = result.data[key]["name"];
	// 				    opt.id = result.data[key]["id"];
	// 				    cities.appendChild (opt);
	// 				}
	// 			}else{
	// 				alert(result.message);
	// 			}
	// 		}else{
	// 				alert("服务器错误 请重试");
	// 		}
 //  		},
 //  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
 //            alert("服务器错误 请重试"); 
 //        }
	// });
}



function getCountries(){
	$("#country").empty(); 
	var cityID = $("#city option:selected").attr("id");
	commonGetCountries(cityID);
	// $.ajax({
	// 	url: "/index.php?controller=Region&method=getCountries&cityID="+cityID,
	// 	type: "GET",
	// 	dataType:"json",
	// 	success: function(result,textStatus){
	// 		if(textStatus == "success"){
	// 			if(result.code == 200){
	// 				// alert(result.data[0]["name"]);
	// 				// document.getElementById ("city").empty();
	// 				var countries = document.getElementById ("country");
	// 				// cities.empty();
	// 				for(var key in result.data){
	// 					alert(result.data[key]["id"]);
	// 				    var opt = document.createElement ("option");
	// 				    opt.value = result.data[key]["name"];
	// 				    opt.innerText = result.data[key]["name"];
	// 				    // opt.id = result.data[key]["id"];
	// 				    countries.appendChild (opt);
	// 				}
	// 			}else{
	// 				alert(result.message);
	// 			}
	// 		}else{
	// 				alert("服务器错误 请重试");
	// 		}
 //  		},
 //  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
 //            alert("服务器错误 请重试"); 
 //        }
	// });
}

// function firstCityID(provinceID){
// 	$.ajax({
// 		url: "/index.php?controller=Region&method=getFirstCityIDJson&provinceID="+provinceID,
// 		type: "GET",
// 		dataType:"json",
// 		success: function(result,textStatus){
// 			if(textStatus == "success"){
// 				if(result.code == 200){
// 					alert(result.data[0]["name"]);
// 					// return result.data[0]["id"];
// 					// document.getElementById ("city").empty();
// 					// var cities = document.getElementById ("city");
// 					// // cities.empty();
// 					// for(var key in result.data){
// 					// 	alert(result.data[key]["id"]);
// 					//     var opt = document.createElement ("option");
// 					//     opt.value = result.data[key]["name"];
// 					//     opt.innerText = result.data[key]["name"];
// 					//     opt.id = result.data[key]["id"];
// 					//     cities.appendChild (opt);
// 					// }
// 				}else{
// 					alert(result.message);
// 				}
// 			}else{
// 					alert("服务器错误 请重试");
// 			}
//   		},
//   		error: function (XMLHttpRequest, textStatus, errorThrown) { 
//             alert("服务器错误 请重试"); 
//         }
// 	});
// }
// function getFirstCountryID(cityID){
// 	$.ajax({
// 		url: "/index.php?controller=Region&method=getFirstCountryIDJson&cityID="+cityID,
// 		type: "GET",
// 		dataType:"json",
// 		success: function(result,textStatus){
// 			if(textStatus == "success"){
// 				if(result.code == 200){
// 					return result.data[0]["id"];
// 					// alert(result.data[0]["name"]);
// 					// document.getElementById ("city").empty();
// 					// var cities = document.getElementById ("city");
// 					// // cities.empty();
// 					// for(var key in result.data){
// 					// 	alert(result.data[key]["id"]);
// 					//     var opt = document.createElement ("option");
// 					//     opt.value = result.data[key]["name"];
// 					//     opt.innerText = result.data[key]["name"];
// 					//     opt.id = result.data[key]["id"];
// 					//     cities.appendChild (opt);
// 					// }
// 				}else{
// 					alert(result.message);
// 					result null;
// 				}
// 			}else{
// 					alert("服务器错误 请重试");
// 					result null;
// 			}
//   		},
//   		error: function (XMLHttpRequest, textStatus, errorThrown) { 
//             alert("服务器错误 请重试"); 
//         }
// 	});
// }


//-----------------------------------------------------------------
//-----------------------------------------------------------------
function commonGetCities(provinceID){
	$.ajax({
		url: "index.php?controller=Region&method=getCitiesJson&provinceID="+provinceID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					// alert(result.data[0]["name"]);
					// document.getElementById ("city").empty();
					var cities = document.getElementById ("city");
					// cities.empty();
					for(var key in result.data){
						// alert(result.data[key]["id"]);
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    opt.id = result.data[key]["id"];
					    cities.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
}


function commonGetCountries(cityID){
	$.ajax({
		url: "/index.php?controller=Region&method=getCountriesJson&cityID="+cityID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					// alert(result.data[0]["name"]);
					// document.getElementById ("city").empty();
					var countries = document.getElementById ("country");
					// cities.empty();
					for(var key in result.data){
						// alert(result.data[key]["id"]);
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    // opt.id = result.data[key]["id"];
					    countries.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
}