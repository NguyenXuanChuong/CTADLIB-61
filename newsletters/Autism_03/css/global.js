//<!-- 
//-------------------------------------------------------------------------------
//
// These pages were generated using BCL Magellan (www.bcltechnologies.com)
//
// This file sets the path & navigation preferences
// You can use Magellan to update these settings, 
// or you can modify this file directly.
//
//
//
//-------------------------------------------------------------------------------

//-------------------------------------------------------------------------------
// file & path options:
//-------------------------------------------------------------------------------

   var gTotalPages =    6;				// total pages in the document
   var gStartingPage =    1;			// starting page number in the document
   var gsFName =        "Autism";			// file name 
   var gsFullName =     "Autism";			// full file name 
   var gsExtName =      ".html";			// extension name 
   var gsBmkName =      "_bmark";			// bookmark file
   var gImagePath =     "../images/";         	// path to images
   var gThumbnailPath = "../thumbnails/";  			// path to thumbnails

   var gsTitle = "Comprehensive Newsletter Winter 03";					// Title of File 

   var gCSSPath = "./Autism/css/";
   var gNN4Path = "./Autism/css/";
//-------------------------------------------------------------------------------
// navigation options:
//-------------------------------------------------------------------------------

   var gNavigation =    1; 				// 0=None 1=Top 2=Left 3=Bookmark Left 
   var gsHomeURL =      "";			// link for HOME icon  
   var gsOriginalLink = "";			// link for DOWNLOAD icon 
   var gsCustomText =   "";			// Custom Link Text 
   var gsCustomLink =   "www.comprehensivenet.com\Austim.html";			// link for Custom Link Text 

//-------------------------------------------------------------------------------
// floating toolbar options: 
//-------------------------------------------------------------------------------

// note: 1=enable; 0=disable 
   var gShowToolbar = 0; 			// show or hide Toolbar 
   var gPrint = 1;					// show or hide Print Icon 
   var gFind = 1;					// show or hide Find Icon 
   var gHelp = 1;					// show or hide Help Icon 
   var gThumbnails = 1;				// show or hide Index Icon 
   var gZoom = 1;   					// show or hide Zoom Icon 
   var gDrag = 1;					// make Toolbar 'Draggable' 
   var gMinimize = 1;				// enable or disable Minimize button 
   var gMaximized = 0;				// right edge of toolbar = width of page 
   var gInitialPosX = 10;			// initial X Position 
   var gInitialPosY = 10;			// initial Y Position 
   var gZoomValue = 100;				// initial zoom value 

//-------------------------------------------------------------------------------
// misc. options: 
//-------------------------------------------------------------------------------

   var gsPgName = "Page";				// label displayed for pages   
   var gColor =   "FEFFDF";			// background color 

   //------------------------------------------------------------------------------- 
   // browser detection  
   //------------------------------------------------------------------------------- 
   var gBrowser = 0;				// note: Please DO NOT change these settings  
   var IE = 1; 
   var NN = 2; 
   var MO = 3; 
   var OP = 4; 

   if (document.all) gBrowser=IE;    
   if (document.layers) gBrowser=NN;    
   if (!document.all && document.getElementById) gBrowser=MO; 
   if (navigator.userAgent.indexOf("Opera")!=-1 && document.getElementById) gBrowser=OP;    

 	var detect = navigator.userAgent.toLowerCase();
     	var OS,browser,version,total,thestring;
     
     	if (checkIt('konqueror'))
     	{
     		browser = "Konqueror";
     		OS = "Linux";
     	}
     	else if (checkIt('safari')) browser = "Safari"
     	else if (checkIt('omniweb')) browser = "OmniWeb"
     	else if (checkIt('opera')) browser = "Opera"
     	else if (checkIt('webtv')) browser = "WebTV";
     	else if (checkIt('icab')) browser = "iCab"
     	else if (checkIt('msie')) browser = "Internet Explorer"
     	else if (!checkIt('compatible'))
     	{
     		browser = "Netscape Navigator"
     		version = detect.charAt(8);
     	}
     	else browser = "An unknown browser";
     
     	if (!version) version = detect.charAt(place + thestring.length);
     
     	if (!OS)
     	{
     		if (checkIt('linux')) OS = "Linux";
     		else if (checkIt('x11')) OS = "Unix";
     		else if (checkIt('mac')) OS = "Mac"
     		else if (checkIt('win')) OS = "Windows"
     		else OS = "an unknown operating system";
     	}
     
     	function checkIt(string)
     	{
     		place = detect.indexOf(string) + 1;
     		thestring = string;
     		return place;
     	}
     	
     	if ( (browser!="Internet Explorer") || (OS != "Windows") ) {
     		gPrint = 0;
        		gFind = 0;
     	}
     	
     	if ( ((gBrowser!=MO) && (gBrowser!=IE)) ||  
     	     ((browser =="Internet Explorer") && ((version == 4) || (version == 3))) ) {	     
     		gPrint = 0;
        		gFind = 0;
        		gZoom = 0;
     	}
     	
     	if (gBrowser!=IE && gBrowser!=MO && gBrowser!=OP) gShowToolbar = 0;
//--> 
