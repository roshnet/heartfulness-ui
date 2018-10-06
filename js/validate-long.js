
// function idAvailable() {
//checks availability of username (ajax requests) //
	var uname = $("#signup-space form input[name='username']").val();

// 	$("#id-exist").load("../idavailable.php" , {
// 			setusername: uname
// 	});
	// USE ../ OR NOT IN ABOVE FUNCTION //
	// php FILE LOCATION IS WRT jsFILE or THE loaderFILE ? //

// 	if ($("#id-exist").val().length > 0){ 
// 		alert("php messages something");
// 		return false;
// 	}
// 	else {
// 			// alert("Called after loading data from php");
// 			return true;
// 	}
	// Something will be echoed by php in #id-exist if uid is not available // 
	// If nothing is echoed, return true; else false;
// }



function validate(){
	// alert("validate() Called");
// also to check:validity of username (regExp)


	// var pswd = $("#signup-space form input[name='passwd']").val();
	// var verify = $("#signup-space form input[name='passwd-verify']").val();
	// var nm = $("#signup-space form input[name='name']").val().length;
	// var unm = $("#signup-space form input[name='username']").val().length;

	var pswd = $("input[name='passwd']").val();
	var verify = $("input[name='passwd-verify']").val();
	var nm = $("input[name='name']").val().length;
	var unm = $("input[name='username']").val().length;
	if (nm < 4){
		$("#sgp-alert").html("Name too short (4 characters at least)!<br/>");
		return false;
	}

	if (unm < 6) {
		$("#sgp-alert").html("Username should be at least 6 characters!<br/>");
		return false;
	}

	if (pswd != verify){
		$("#sgp-alert").html("Passwords do not match!<br/>");
		return false;
	}
	else if (pswd.length < 6){
		$("#sgp-alert").html("Passwords must be at least 6 characters!<br/>");
		return false;
	}

// 	if ($("#id-exist").val().length > 0){ 
// 		alert("php messages something");
// 		return false;
// 		// alert("false");
// 	}
// 	else {
// 		return true;
// 		alert("true");
// 	}
}

function lowerify(alphabet) {
	alphabet.value = alphabet.value.toLowerCase();
}