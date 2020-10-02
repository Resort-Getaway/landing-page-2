$("body").css({"overflow":"hidden",'position':'fixed'});


function validateEmail(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( email ) || email.length == 0 ) {
	    return false;
	} else {
	    return true;
	}
}

function validPhoneNumber(){
	if ( $("#phone-number").hasClass("has-error") ) {
		return false;
	}
	else{
		return true;
	}
}
