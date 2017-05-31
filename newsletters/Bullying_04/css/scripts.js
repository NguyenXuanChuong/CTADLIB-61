//<!--
//-------------------------------------------------------------------------------
///////////////////////////////////////////////////
//
//         Magellan Navigation Script 6.5
// 
//          Copyright BCL Technologies 
//             All Rights Reserved
//
//     This Code May Not Be Duplicated Without
//  The Express Written Consent of BCL Technologies
//
///////////////////////////////////////////////////
//-------------------------------------------------------------------------------
// variables
//-------------------------------------------------------------------------------

 	var drag = 0;
	var originalLeft = 0;
	var originalTop = 0;
	var minimized = 0;
	var ActiveXObj;
	var n = 0;
	var gCurrentPage = 0;
	
	// if toolbar is max, move to top of page   
   	if (gMaximized == 1) {
   		gDrag = 0;
   		gInitialPosX = 0;
   		gInitialPosY = 0;
   	} 
   	
   	// check if frames exist:
   	if (parent.main == null) gNavigation =0;

//-------------------------------------------------------------------------------
// print properties check
//-------------------------------------------------------------------------------

function SetPrintProperties() {
     alert('Selecting Page Setup from the File menu using AcitveX...');
     ActiveXObj = new ActiveXObject("WScript.Shell")
     ActiveXObj.SendKeys("+(%fu)");
}


//-------------------------------------------------------------------------------
// parse the URL and insert values into array
//-------------------------------------------------------------------------------

function getURLData() { 

  URL_Data = new Object();
  separator = ',';

  // FRAME CHECK:
  
//   if ((window.opener != null)  && (window.opener.parent.main != null) &&
//       (typeof(window.opener) != 'undefined')  && (typeof(window.opener.parent.main) != 'undefined')) {
   
//        query = '' + window.opener.parent.main.location;
        
//  } else { 

	  if ((gNavigation != 0) && (typeof parent.main != 'undefined') )
		query = '' + parent.main.window.location;
	  else 
		query = '' + this.location;
  
//  }	

  qu = query
  query = query.substring((query.indexOf('?')) + 1);

  if (query.length < 1) { return false; }

  keys = new Object();
  name_value = 1;

  while (query.indexOf('&') > -1) {
    keys[name_value] = query.substring(0,query.indexOf('&'));
    query = query.substring((query.indexOf('&')) + 1);
    name_value++;
  }

  keys[name_value] = query;

  for (i in keys) {
    keyName = keys[i].substring(0,keys[i].indexOf('='));
    keyValue = keys[i].substring((keys[i].indexOf('=')) + 1);
    while (keyValue.indexOf('+') > -1) {
      keyValue = keyValue.substring(0,keyValue.indexOf('+')) + ' ' + keyValue.substring(keyValue.indexOf('+') + 1);
    }

    keyValue = unescape(keyValue);

    if (URL_Data[keyName]) {
      URL_Data[keyName] = URL_Data[keyName] + separator + keyValue;
    } else {
      URL_Data[keyName] = keyValue;
    }
  }

  return URL_Data;
}


function setPrefFromURL(URL_Data) {
	if (URL_Data['gInitialPosX'] != null)
	   gInitialPosX = URL_Data['gInitialPosX'];

	if (URL_Data['gInitialPosY'] != null)
	   gInitialPosY = URL_Data['gInitialPosY'];

	if (URL_Data['gShowToolbar'] != null)
	   gShowToolbar = URL_Data['gShowToolbar'];

	if (URL_Data['gZoomValue'] != null)
	   gZoomValue = URL_Data['gZoomValue'];
	   
	gCurrentPage = URL_Data['currentpage'];
	
	//alert(gCurrentPage);

}





//-------------------------------------------------------------------------------
// page navigation
//-------------------------------------------------------------------------------

function getCurrentPage()
{
  	var page_num;
  	
  	// FRAME CHECK:
	if ((gNavigation !=0) && (parent.main != null) && (parent.main.window.location != null))
	
		page_num = parent.main.window.location + "";
	else	
		page_num = window.location + "";	
	
	page_num = page_num.substring(page_num.lastIndexOf("_")+1,page_num.lastIndexOf("."));
	return parseInt(page_num);
}


function getNextPage()
{
	if (getCurrentPage()==gTotalPages) {
		return gStartingPage;
	} else {
		return getCurrentPage() + 1;
	}
}

function getPreviousPage()
{
	if (getCurrentPage()==gStartingPage) {
		return gTotalPages;
	} else {
		return getCurrentPage() - 1;
	}
}

function updatePage(pageNum)
{
	// FRAME CHECK:
	if (gNavigation !=0)  {	
		if ((gShowToolbar !=0 ) && (gBrowser == OP || gBrowser == IE || gBrowser == MO)) parent.main.window.location = gsFName + "_" + pageNum + gsExtName + "?gInitialPosX="+getLayerProperty('toolbarOBJ', 'left')+"&gInitialPosY="+getLayerProperty('toolbarOBJ', 'top')+"&gZoomValue="+gZoomValue;
		else if (gBrowser == OP || gBrowser == IE || gBrowser == MO) parent.main.window.location = gsFName + "_" + pageNum + gsExtName + "?gInitialPosX=0&gInitialPosY=0&gZoomValue="+gZoomValue;
		else window.location = gsFName + "_" + pageNum + gsExtName;
	} else {
		if ((gShowToolbar !=0 ) && (gBrowser == OP || gBrowser == IE || gBrowser == MO)) window.location = gsFName + "_" + pageNum + gsExtName + "?gInitialPosX="+getLayerProperty('toolbarOBJ', 'left')+"&gInitialPosY="+getLayerProperty('toolbarOBJ', 'top')+"&gZoomValue="+gZoomValue;	
		else window.location = gsFName + "_" + pageNum + gsExtName;
	}
}


function openPage(pageNum) // back compatible function
{
	if (gBrowser == OP || gBrowser == IE || gBrowser == MO) parent.main.window.location = gsFName + "_" + pageNum + gsExtName + "?gInitialPosX="+0+"&gInitialPosY="+0;
	else parent.main.window.location = gsFName + "_" + pageNum + gsExtName;
}


function reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {
	  if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.pgW=innerWidth; document.pgH=innerHeight; onresize=reloadPage;
	  }
  }
  else if (innerWidth!=document.pgW || innerHeight!=document.pgH) location.reload();
}


//-------------------------------------------------------------------------------
// functions to override frameless config
//-------------------------------------------------------------------------------

function overrideNav() {
} 

function overrideOpenPage(pageNum) {

	if (gBrowser == OP || gBrowser == IE || gBrowser == MO) parent.main.window.location = gsFName + "_" + pageNum + gsExtName + "?gInitialPosX="+0+"&gInitialPosY="+0;
	else parent.main.window.location = gsFName + "_" + pageNum + gsExtName;
} 


//-------------------------------------------------------------------------------
// zoom
//-------------------------------------------------------------------------------


function newZoomValue(zoomVal)
{
	if ((zoomVal != '1') && (zoomVal != '-1')) {
		gZoomValue = zoomVal;

	} else {

		if ((gZoomValue == '200') && (zoomVal == '1')) gZoomValue = '400';
		if ((gZoomValue == '150') && (zoomVal == '1')) gZoomValue = '200';
		if ((gZoomValue == '100') && (zoomVal == '1')) gZoomValue = '150';
		if ((gZoomValue == '75') && (zoomVal == '1')) gZoomValue = '100';
		if ((gZoomValue == '50') && (zoomVal == '1')) gZoomValue = '75';
		if ((gZoomValue == '25') && (zoomVal == '1')) gZoomValue = '50';

		if ((gZoomValue == '50') && (zoomVal == '-1')) gZoomValue = '25';
		if ((gZoomValue == '75') && (zoomVal == '-1')) gZoomValue = '50';
		if ((gZoomValue == '100') && (zoomVal == '-1')) gZoomValue = '75';
		if ((gZoomValue == '150') && (zoomVal == '-1')) gZoomValue = '100';
		if ((gZoomValue == '200') && (zoomVal == '-1')) gZoomValue = '150';
		if ((gZoomValue == '400') && (zoomVal == '-1')) gZoomValue = '200';

	}

	updatePage(getCurrentPage());
}


function zoom()
{
    var number;
    var el;
    var zoomVal = gZoomValue / 100;
    var mycss = new Array();
    var imgarr;
    
        // FRAME CHECK:
	if (gNavigation !=0) {
		if (!parent.main.document.styleSheets) return;
		
   	        if (parent.main.document.styleSheets[0].cssRules)      // MO
	   	    mycss = parent.main.document.styleSheets[0].cssRules;
	        else
	    	    mycss = parent.main.document.styleSheets[0].rules;  // IE

		
	} else {
		if (!document.styleSheets) return;
		
   	        if (document.styleSheets[0].cssRules)      // MO
	   	    mycss = document.styleSheets[0].cssRules;
	        else
	    	    mycss = document.styleSheets[0].rules;  // IE
	}    
    

    for(x=0;x<mycss.length;x++){
	    if (mycss[x].style.left != '') mycss[x].style.left = (parseFloat(mycss[x].style.left) * zoomVal) + 'px';
	    if (mycss[x].style.width != '') mycss[x].style.width = (parseFloat(mycss[x].style.width) * zoomVal) + 'px';
	    if (mycss[x].style.top != '') mycss[x].style.top = (parseFloat(mycss[x].style.top) * zoomVal) + 'px';
	    if (mycss[x].style.fontSize != '')  mycss[x].style.fontSize = (parseFloat(mycss[x].style.fontSize) * zoomVal+0.5) + 'px';
    }

	// FRAME CHECK:
	if (gNavigation !=0) imgarr = parent.main.document.getElementsByTagName("IMG");
	else imgarr = document.getElementsByTagName("IMG");
	      
      for (var i = 0; i < imgarr.length; i++) {
        if (imgarr[i].name == "") {
        imgarr[i].height = imgarr[i].height * zoomVal;
        imgarr[i].width = imgarr[i].width * zoomVal;
        }
      }
}



//-------------------------------------------------------------------------------
// Minimize / Maximize
//-------------------------------------------------------------------------------

function minimize(){
	if (minimized) {
		setLayerProperty("toolbarOBJ", "width", "700px");
		maximize();
	}
	else
		setLayerProperty("toolbarOBJ", "width", "13px");		
	minimized = !minimized;		
	
}

function maximize(){

	if (gMaximized) setLayerProperty("toolbarOBJ", "width", "100%");	
	
}


//-------------------------------------------------------------------------------
// Layer Functions
//-------------------------------------------------------------------------------

function getLayerProperty(id, property){
  var propertyValue = 0;
  
  // FRAME CHECK:
  if (gNavigation !=0) {	
	  if (gBrowser==IE) eval("propertyValue = parent.main.document.all." + id + ".style." + property);
	  if (gBrowser==NN) eval("propertyValue = parent.main.document." + id + "."+property);
	  if (gBrowser==MO || gBrowser==OP) eval("propertyValue = parent.main.document.getElementById('" + id + "').style."+property);
  } else {
	  if (gBrowser==IE) eval("propertyValue = document.all." + id + ".style." + property);
	  if (gBrowser==NN) eval("propertyValue = document." + id + "."+property);
	  if (gBrowser==MO || gBrowser==OP) eval("propertyValue = document.getElementById('" + id + "').style."+property);
  }
  return propertyValue;
}

function setLayerProperty(id, property, propertyValue){
	// FRAME CHECK:
	if (gNavigation !=0) {
	  if (gBrowser==IE) eval("parent.main.document.all." + id + ".style." + property + "=propertyValue");
	  if (gBrowser==NN) eval("parent.main.document." + id + "."+property+ "=propertyValue");
	  if (gBrowser==MO || gBrowser==OP) eval("parent.main.document.getElementById('" + id + "').style."+property+ "=propertyValue");
   	} else {
	  if (gBrowser==IE) eval("document.all." + id + ".style." + property + "=propertyValue");
	  if (gBrowser==NN) eval("document." + id + "."+property+ "=propertyValue");
	  if (gBrowser==MO || gBrowser==OP) eval("document.getElementById('" + id + "').style."+property+ "=propertyValue");
	}
}

//-------------------------------------------------------------------------------
// Dynamic HTML
//-------------------------------------------------------------------------------

function initilizeDrag(){

    if ((gBrowser==IE) || (gBrowser==OP)) {
	window.document.onmousemove = mouseMove;
	window.document.onmousedown = mouseDown;
	window.document.onmouseup = mouseUp;
	window.document.ondragstart = mouseStop;
    }
    if (gBrowser==MO) {	    
	document.getElementById("toolbarOBJ").addEventListener("mousedown",beginDrag, false);
	document.getElementById("toolbarOBJ").addEventListener("mouseover",cursorMO, false);
    }
	
}

// IE:

	function mouseStop() {
		window.event.returnValue = false;
	}
	function mouseDown() {	
		originalLeft = window.event.x - parseInt(toolbarOBJ.style.left);
		originalTop = window.event.y - parseInt(toolbarOBJ.style.top);	
		if (Math.abs( window.event.x - parseInt(toolbarOBJ.style.left) + document.body.scrollLeft)  > 13 )
		    drag = 0;
	}
	function mouseMove() {
		if (drag) {	
			toolbarOBJ.style.pixelLeft  = window.event.x - originalLeft;
			toolbarOBJ.style.pixelTop  = window.event.y - originalTop;
		}
	}
	function mouseUp() {
		drag = 0;
	}

// MO:

	function doDrag(e) {
		var difX=e.clientX-window.lastX;
		var difY=e.clientY-window.lastY;

		var newX1 = parseInt(document.getElementById("toolbarOBJ").style.left)+difX;
		var newY1 = parseInt(document.getElementById("toolbarOBJ").style.top)+difY;

		document.getElementById("toolbarOBJ").style.left=newX1+"px";
		document.getElementById("toolbarOBJ").style.top=newY1+"px";

		window.lastX=e.clientX;
		window.lastY=e.clientY;
	}
	function beginDrag(e) {
	
	
		e.preventDefault();
		window.lastX=e.clientX;
		window.lastY=e.clientY;
		if (Math.abs( e.clientX - parseInt(document.getElementById("toolbarOBJ").style.left) + e.clientY-window.lastY)  < 13 )
		window.onmousemove=doDrag;		
		window.onmouseup=endDrag;		
		dd_mode="drag";			
	}
	function endDrag(e) {
		window.onmousemove=null;
	}


function cursorMO(e){

	if (Math.abs( e.clientX - parseInt(document.getElementById("toolbarOBJ").style.left) )  < 13 )
		document.body.style.cursor='move';	
}
	
	
function changeCursor(style)	{
        
	if (gDrag) {	
	   if ((gBrowser==IE)||(gBrowser==OP)) {			
		if (Math.abs( window.event.x - parseInt(toolbarOBJ.style.left) + document.body.scrollLeft)  < 13 )
		    document.body.style.cursor='move';							
		if (style==0) document.body.style.cursor='default';			
			
	    } 
	    if (gBrowser==MO) {					
		if (style==0) document.body.style.cursor='default';			
	    }
	}
}



//-------------------------------------------------------------------------------
//-->