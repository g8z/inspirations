// $Id: form.js,v 1.0 2000/10/19 13:47:00

function Trim (text) {
		ndx = 0;
		lgth = text.length;
		while ((ndx < lgth) && (text.charAt(ndx) == ' ')) ++ndx;
		while ((lgth > ndx) && (text.charAt(lgth - 1) == ' ')) --lgth;
	return text.substring (ndx, lgth);
}

function RemoveWhitespace(text) {
	ind = 0;
	lgth = text.length;
	result = "";
	while (ind < lgth)
	{
		if (text.charAt(ind) != ' ')
			result += text.charAt(ind);
		ind++;
	}
	return result;
}

function IsNumber(ch) {
	if ((ch < '0') || (ch > '9'))
		return false;
	return true;
}

function IsAlphabetic(ch) {
		if ( ((ch < 'A') || (ch > 'Z'))
		&& ((ch < 'a') || (ch > 'z')) )
		return false;
	return true;
}

function IsNumeric (num) {
	ndx = 0;
		lgth = num.length;
	
	while (ndx < lgth) {
				if ( !IsNumber(num.charAt(ndx)) )
			return false;
		++ndx;
	}
	
	return true;
}

function IsAlphaNumeric(num) {
	ndx = 0;
		lgth = num.length;
	
	while (ndx < lgth) {
				if ( !IsNumber(num.charAt(ndx)) 
			&& !IsAlphabetic(num.charAt(ndx)) )
			return false;
		++ndx;
	}
	
	return true;
}

function IsAmount (num) {
	ndx = 0;
	dec = 0;
		lgth = num.length;
	
	while (ndx < lgth) {
				if ((num.charAt(ndx) < '0') || (num.charAt(ndx) > '9')) {
			if ((num.charAt(ndx) == '.') && (dec == 0)) {
				dec++;
				ndx++;
				continue;
			}

			return false;
		}
		++ndx;
	}
	
	return true;
}

function FormError (obj, message) {
	alert (message);
		obj.focus ();
	return false;
}

function EditRequired (obj, msg) {
	obj.value = Trim(obj.value);
	if (obj.value.length == 0) {
		return FormError (obj, msg);
	}
	return true;
}

function FormatText (obj)	{ obj.value = Trim (obj.value); }
function FormatUpper (obj)	{ obj.value = Trim (obj.value.toUpperCase()); }

function FormatNum (obj) {
	obj.value = Trim (obj.value);
	
	if (!IsNumeric (obj.value))
		return FormError (obj, "The value entered must be numeric");
		
	return true;
}

function FormatAmt (obj) {
	obj.value = Trim (obj.value);
	
	if (!IsAmount (obj.value))
		return FormError (obj, "The value entered must be an amount");
		
	return true;
}

function FormatPhone (obj) {
	obj.value = Trim (obj.value);
	if (obj.value.length > 0)
		return EditPhoneNum (obj);
		
	return true;		
}

// YYYY-MM-DD
function FormatDate(obj) {
	obj.value = RemoveWhitespace (obj.value);
	if (obj.value.length != 10)
		return DateError (obj);
	year = obj.value.substring(0, 4);
	month = obj.value.substring(5, 7);
	day = obj.value.substring(8, 10);
	if (!IsNumeric(year)
		|| !IsNumeric(month)
		|| !IsNumeric(day)
		|| obj.value.charAt(4) != '-'
		|| obj.value.charAt(7) != '-')
		return DateError (obj);
	return true;
}

function DateError (obj) {
		return FormError (obj, '"' + obj.value + '" is not a valid date format.\n' +
							'Please use the form		YYYY-MM-DD	 only.\n');
}

// HH:MM
function FormatTime(obj) {
	obj.value = RemoveWhitespace (obj.value);
	if (obj.value.length != 5)
		return TimeError (obj);
	hour = obj.value.substring(0, 2);
	minute = obj.value.substring(3, 5);
	if (!IsNumeric(hour)
		|| !IsNumeric(minute)
		|| obj.value.charAt(2) != ':')
		return TimeError (obj);
	return true;
}

function TimeError (obj) {
		return FormError (obj, '"' + obj.value + '" is not a valid time format.\n' +
							'Please use the form		HH:MM	 only.\n');
}

function FormatProv (prov,country)	{ 
	canprov_codes = new Array ('BC', 'AB', 'MB', 'SK', 'ON', 'QC', 'NF', 'NB', 'NS', 'PE', 'YT', 'NT','NU');
	if (prov.options[prov.selectedIndex].value.charAt(0) == '-') 
		return FormError(prov, "Please select a province or state code");
	for (ndx = 0; ndx < canprov_codes.length; ndx++) {
		if (canprov_codes[ndx] == prov.options[prov.selectedIndex].value) {
			country.value = 'Canada';
			return true;
		}
	}	
	country.value = 'USA';
	if (prov.options[prov.selectedIndex].value .charAt(0) == 'x') {
		country.value='X';
		return true;
	}
	return true;
}

function FormatProvince (prov,country,provx)	{ 
	canprov_codes = new Array ('BC', 'AB', 'MB', 'SK', 'ON', 'QC', 'NF', 'NB', 'NS', 'PE', 'YT', 'NT','NU');
	if ((prov.options[prov.selectedIndex].value.charAt(0) == '-') &&(provx.value==''))
		return FormError(prov, "Please select a province or state code");
	for (ndx = 0; ndx < canprov_codes.length; ndx++) {
		if (canprov_codes[ndx] == prov.options[prov.selectedIndex].value) {
			country.value = 'Canada';
			provx.value='';
			return true;
		}
	}	
	country.value = 'USA';
	if (prov.options[prov.selectedIndex].value .charAt(0) == 'x') {
			country.value='';
			return true;
	}
	provx.value ='' ;
	return true ;
}

function FormatPostal (obj) {
	FormatUpper(obj);
	if ((obj.value.length == 6) && (obj.value.charAt(0) >= 'A') && (obj.value.charAt(0) <="Z"))
		obj.value = obj.value.substring(0, 3) + ' ' + obj.value.substring(3, 6);
}

function FormatPostalCanadian(prov, obj) {
	canprov_codes = new Array ('BC', 'AB', 'MB', 'SK', 'ON', 'QC', 'NF', 'NB', 'NS', 'PE', 'YT', 'NT','NU');
	flag = false;
	for (ndx = 0; ndx < canprov_codes.length; ndx++) {
		if (canprov_codes[ndx] == prov.options[prov.selectedIndex].value) {
			flag = true;
		}
	}	
	obj.value = RemoveWhitespace(obj.value);
	if (!IsAlphaNumeric(obj.value))
		return FormError (obj, "Postal / Zip Code should contain only alphanumeric characters .");
	FormatUpper(obj);

	if (flag) // Inside Canada
	{
		if (obj.value.length != 6)
			return FormError (obj, "Canadian Postal Code should contain exactly 6 characters.");

		if (!IsAlphabetic(obj.value.charAt(0))
			|| !IsNumber(obj.value.charAt(1))
			|| !IsAlphabetic(obj.value.charAt(2))
			|| !IsNumber(obj.value.charAt(3))
			|| !IsAlphabetic(obj.value.charAt(4))
			|| !IsNumber(obj.value.charAt(5)) )
			return FormError (obj, "Invalid Canadian Postal Code input:\n proper format is ANA NAN, where N is a digid and A is alphabetic character.");

		obj.value = obj.value.substring(0, 3) + ' ' + obj.value.substring(3, 6);
	}
	return true;
}

function PhoneError (obj) {
	return FormError (obj, '"' + obj.value + '" is not a valid telephone number.\n' +
							'North American numbers must include the area code.\n' +
							'International numbers must must begin with "+".');
}

function EditPhoneNum (obj) {
	ndx = 0;
	num = obj.value;
	
	if (num.charAt(0) == '+') {
		ndx = 2;
		while (ndx < obj.value.length) {
			if ( ((num.charAt(ndx) < '0') || (num.charAt(ndx) > '9')) &&
				(num.charAt(ndx) != ' ') && 
				(num.charAt(ndx) != '-') &&
				(num.charAt(ndx) != '.') )
				return PhoneError (obj);
			++ndx;
		}
		
		return true;
	}		
		
	if ((num.charAt(0) == '(') && (num.charAt(4) == ')')) {
		area = num.substring(1, 4);
		num = Trim (num.substring(5));
	} else {
		area = num.substring (0, 3);
		if ((num.charAt(3) == '-') || (num.charAt(3) == '.'))
			num = Trim (num.substring(4));
		else
			num = Trim (num.substring(3));
	}
	
	xchg = num.substring (0,3);
	if ((num.charAt(3) == '-') || (num.charAt(3) == '.'))
		num = Trim (num.substring(4));
	else
		num = Trim (num.substring(3));
		
	if (num.length > 4) {
		if ((num.charAt(4) == '-') || (num.charAt(4) == '.'))
			ext = Trim (num.substring(5));
		else
			ext = Trim (num.substring (4));
			
		num = Trim (num.substring (0, 4));
	}
	else
		ext = '';
		
	for (ndx = 0; ndx < ext.length; ndx++) {
		if ((ext.charAt(ndx) >= '0') && (ext.charAt(ndx) <= '9'))
			break;
	}
	
	ext = Trim (ext.substring (ndx));
		
	if (ext.length > 0)
		ext = 'X' + ext;

	if ((area.length != 3) || !IsNumeric(area) ||
		(xchg.length != 3) || !IsNumeric(xchg) ||
		(num.length	!= 4) || !IsNumeric(num) ||
		(area.charAt(0) == '0') || (area.charAt(0) == '1') ||
		(xchg.charAt(0) == '0') || (xchg.charAt(0) == '1')) {
		return PhoneError (obj);
	}
		
	obj.value = Trim ('(' + area + ') ' + xchg + '-' + num + ' ' + ext);
	return true;
}

function EmailError (obj) {
	return FormError (obj, '"' + obj.value + '" is not a valid email address.');
}

function FormatEmail (obj) {
	obj.value = Trim (obj.value);

	if (obj.value.length == 0)
		return true; // it is acceptable to have no e-mail submitted
			
	ndx = 1;
	atsign = false;
	dot = false;
	
	while (ndx < obj.value.length) {
		if (obj.value.charAt(ndx) == ' ')
			return EmailError (obj);
			
		if (obj.value.charAt(ndx) == '@') {
			atsign = true;
			++ndx;
			break;
		}
		
		++ndx;
	}

	if (!atsign) return EmailError (obj);
	
	++ndx;
	while (ndx < obj.value.length) {
		if (obj.value.charAt(ndx) == ' ')
			return EmailError (obj);
			
		if (obj.value.charAt(ndx) == '.') {
			dot = true;
			++ndx;
			break;
		}
		
		++ndx;
	}	
	
	if (ndx >= obj.value.length) return EmailError (obj);
	if (!dot) return EmailError (obj);
	
	return true;
}


function FormatPassword (password, confirm_password) {
//	if (trim(password.value) != trim(confirm_password.value)) {
	if (password.value != confirm_password.value) {
		return FormError(password, "The password and verification password do not match.");
	}
	return true ;
}

function FormatSalutation(salutation) {
	if (salutation.options[salutation.selectedIndex].value.charAt(0) == '-') 
		return FormError(salutation, "Please let us know how to address you.");
	return true ;
}

function FormatCCType(cctype) {
	if (cctype.selectedIndex == 0) 
		return FormError(cctype, "Please select a Credit Card Type.");
	return true ;
}

function EditAddress2 (addr1, addr2) { 
	addr1.value = Trim (addr1.value);
	addr2.value = Trim (addr2.value);
	
	if (addr1.value == "") {
		addr1.value = addr2.value;
		addr2.value = "";
	}
	
	return EditRequired (addr1, "Please enter your company address.");
}

function EditCountry (obj) { 
	if (!EditRequired (obj, "Please enter your country."))
		return false;
		
	return true;	
}


function EditPhone (obj) {
	if (!EditRequired (obj, "Please enter your telephone number."))	
		return false;
		
	return EditPhoneNum (obj);
}

function EditEmail (obj) {
	if (!EditRequired (obj, "Please enter a valid email address- it is required to send you a registration code."))
		return false;
	return true;
}

function EditFirstName (obj) 	{ return EditRequired (obj, "Please enter your first name."); }

function EditLastName (obj) 	{ return EditRequired (obj, "Please enter your last name."); }

function EditOrganizationName (obj) 	{ return EditRequired (obj, "Please enter the name of your organization."); }

function EditEventTitle(obj) { return	EditRequired (obj, "Please enter the title of event."); }

function EditEventLocation(obj) { return	EditRequired (obj, "Please enter the location of event (or its street address, if any)"); }

function EditEventDescription(obj) { return	EditRequired (obj, "Please enter the description of event"); }

function EditNumParticipants(obj) { 
	if (!EditRequired (obj, "Please enter the number of participants"))
		return false;
	return	FormatNum (obj); 
}

function EditDate(obj) { 
	if (!EditRequired (obj, "Please enter the date"))
		return false;
	return	FormatDate (obj); 
}

function EditTime(obj) { 
	if (!EditRequired (obj, "Please enter the time"))
		return false;
	return	FormatTime (obj); 
}

function EditCCName (obj) 	{ return EditRequired (obj, "Please enter the Credit Card holder's name."); }

function EditHintQ (obj) 	{ return EditRequired (obj, "Please enter a question for us to help you with in case you forget your password."); }

function EditHintA (obj) 	{ return EditRequired (obj, "Please enter an answer for your question."); }

function EditCompany (obj) 	{ return EditRequired (obj, "Please enter your company name."); }

function EditAddress (obj)	{ return EditRequired (obj, "Your must enter your address."); }

function EditCity (obj)		{ return EditRequired (obj, "Please enter your city."); }

function EditProv (prov,provx) { 
		tmp = Trim (prov.value) + Trim (provx.value);
		if ((tmp =="") ||(tmp =="-")||(tmp =="x")) 
	return FormError(prov,"Please enter your state/province.") ;
		else
	return true ;
			
}

function EditPassword (obj) { return EditRequired (obj, "Please set a password for yourself.");}

function EditLoginPassword (obj) { return EditRequired (obj, "Please enter your password.");}

function EditPostal (obj)	{ return EditRequired (obj, "Please enter your postal or zip code.");}

function EditPostalCanadian (prov, obj) {
	if (!EditRequired (obj, "Please enter the postal code"))
		return false;
	return	FormatPostalCanadian (prov, obj); 
}

function EditComment (obj) 	{ return EditRequired (obj, "Please enter your query or comment."); }

function EditPassword2 (password1,password2) { 
	if (!EditRequired(password2)) {
		return EditRequired (password2, "Please confirm your password.");
	}else{
		if (password1 != password2) {

			return FormError(password1,"The two passwords you provide must be exactly the same.") ;
		}
	return true ;
	}
}
	
function EditCCNum (obj) {
	if (!EditRequired (obj, "Please enter the a valid Credit Card Number."))
		return false;
	if (!IsValidCC(obj.value))
		return FormError (obj, obj.value + " is not a valid Credit Card Number.");
	return true;
}

function FormatCCNum (obj) {
	if (!IsValidCC(obj.value))
		return FormError (obj, obj.value + " is not a valid Credit Card Number.");
	return true;
}

function EditValidationCCNum (obj) {
	if (!EditRequired (obj, "Please enter the last block of 3 or 4 digits on the signature strip on the back of your Credit Card."))
		return false;
	if (!IsNumeric(obj.value))
		return FormError(obj,obj.value+" is not a proper validation code.") ;
	if ((obj.value.length < 3)||(obj.value.length > 4))
		return FormError(obj, " The validation code is the last block of 3 or 4 digits on the signature strip on the back of your Credit Card.") ;
	return true;
}

function EditSelected (obj, msg) {
	if (obj.selectedIndex > 0 && obj.options[obj.selectedIndex].value.charAt(0) != '-') return true;
	
	return FormError (obj, msg);
}

function EditRadio (obj, msg) {
		for (ndx = 0; ndx < obj.length; ndx++) {
				if (obj[ndx].checked)
			return true;
	}
	
	return FormError (obj[0], msg);
}

function FormatProvx(prov,country) {
		prov.value='x' ;	 
		country.value='';
}
