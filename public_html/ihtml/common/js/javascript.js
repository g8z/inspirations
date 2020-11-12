// JavaScript Document

/* Functions that handle preload. */
function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	 var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	 if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
	var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
	var p,i,x;	if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
	var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	 if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function popup(location){
	 window.open(location,'','height=250,width=300,toolbar=0, titlebar=0, location=0, directories=0, status=0,menubar=0,scrollbars=0, dependent=0, noresize,top=200,left=400');
}

function launch(url, options) { 
	 remote = open(url, "remote", options);
}

function MM_reloadPage(init) {	//reloads the window if Nav4 resized
	if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);


// Return the coordinate string to center the window on screen using DHTML
function CenterParams(width, height) {
 	LeftPosition = (screen.width) ? (screen.width - width) / 2 : 0;
	TopPosition = (screen.height) ? (screen.height - height) / 2 : 0;
	return 'height=' + height + ',width=' + width + ',top=' + TopPosition + ',left=' + LeftPosition;
}

// Window opening functions
function MakeSubcategory(id) {
	settings = CenterParams(350, 150);
	var subcategoryWindow=window.open('index.php?cmd=12','makeSubcategory',settings);
	if(subcategoryWindow.window.focus)
		subcategoryWindow.window.focus();
	subcategoryWindow.location.href = 'index.php?cmd=12&ID='+id;
	if (!subcategoryWindow.opener)
		subcategoryWindow.opener = self;
}

function SendEmail(id) {
	settings = CenterParams(380, 250) + ",resizable=0,status=0";
	var emailWindow=window.open('index.php?cmd=16','sendEmail',settings);
	if(emailWindow.window.focus)
		emailWindow.window.focus();
	emailWindow.location.href = 'index.php?cmd=16&ID='+id;
	if (!emailWindow.opener)
		emailWindow.opener = self;
}

function Vote(id) {
	settings = CenterParams(300, 250);
	var voteWindow=window.open('index.php?cmd=17','count',settings);
	if(voteWindow.window.focus)
		voteWindow.window.focus();
	voteWindow.location.href = 'index.php?cmd=17&ID='+id;
	if (!voteWindow.opener)
		voteWindow.opener = self;
}

function ShowCodes() {
	settings = CenterParams(640, 480) + ",scrollbars=1,resizable";
	var codesWindow=window.open('show_codes.php','showCodes',settings);
	if(codesWindow.window.focus){codesWindow.window.focus();}
			//codesWindow.location.href = 'show_codes.php?ID='+id;
		
	if (!codesWindow.opener)
		codesWindow.opener = self;
}

function submitForm(name) {
	for (i =0; i < document.forms.length; i++)
	{
		if (document.forms[i].name == name)
		{
			document.forms[i].submit();
		}
	}
}

function SetFormVariable(formname, varname, value) {
	for (i =0; i < document.forms.length; i++)
	{
		if (document.forms[i].name == formname)
		{
			for (j = 0; j < document.forms[i].elements.length; j++)
			{
				if (document.forms[i].elements[j].name == varname)
				{
					document.forms[i].elements[j].value = value;
				}
			}
		}
	}
	return false;
}