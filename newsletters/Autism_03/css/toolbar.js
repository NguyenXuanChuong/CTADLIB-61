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

function mainFunction() {	

	if (gNavigation == 0) {  		// check for frameless config so links in page will work
		parent.nav = overrideNav;
		parent.nav.openPage = overrideOpenPage;			
	}
	
	URL_Data = getURLData();  // get URL string
	setPrefFromURL(URL_Data);  
	


	if ((gZoomValue!='')&&(gZoomValue!='0')&&(gZoomValue!='100')) zoom();
	
	if (gShowToolbar != 0 ) {

	   var currentPage = getCurrentPage();
	   var nextPage = getNextPage();
	   var previousPage = getPreviousPage();	   
	   
	   	   document.writeln('<DIV ID="toolbarOBJ" onMouseMove="changeCursor(1)" onMouseOut="changeCursor(0)" onMouseOver="changeCursor(1)" onMouseDown="drag=1;" STYLE=" position:absolute; left:'+gInitialPosX+'; top:'+gInitialPosY+';z-index:100; overflow: hidden;">');
	
		   document.writeln('<table ');
			if (gMaximized==1) document.write('width="100%"');
		   	document.writeln('border="1" cellspacing="0" cellpadding="0">');
		   document.writeln('<tr>');
		   document.writeln('<td width="10" bordercolor="#0F1D79" bgcolor="#0F1D79">'); 
	
		   if (gMinimize) document.writeln('  <a href="JavaScript:void(\'Minimize\')"><img onClick="minimize();"; name="min" src="'+gImagePath+'minimize.gif" align="texttop" alt="Minimize" border="0"></a><br><br><br> ');   
		   else           document.writeln('  <img name="space" src="'+gImagePath+'space.gif" width="5" height="1" border="0">');   
	
		   document.writeln('</td><td nowrap bordercolor="#EDEDE4" bgcolor="#'+gColor+'">');
	
	
		   document.writeln('<table border="0" cellspacing="2" cellpadding="0">');
		   document.writeln('<tr>');
		   document.writeln('<td nowrap valign="top">');
	
		   document.writeln('<table border="0" cellspacing="2" cellpadding="0">');
		   document.writeln('  <tr>');
		   document.writeln('    <td nowrap align="left">');
	
			   document.writeln('<font size="1" face="Verdana, Arial, Helvetica, sans-serif">');
			   
			   	   document.writeln('<a  href="JavaScript:updatePage(\''+previousPage+'\')"><img name="prev" src="'+gImagePath+'prev.gif" align="absmiddle" border="0"></a> ');	   
								   
				   document.writeln('  <input onkeypress="if (window.event.keyCode == 13) {this.value = this.value.replace(\' \', \'\'); updatePage(this.value);}" onFocus="if (this.defaultValue==this.value) this.value = \' \';" name="newPageNum" type="text" ');				   
				   document.writeln('  style="text-decoration: none; color: #0000FF;font-family: Verdana, Arial, Helvetica, sans-serif;top: 0px;font-size: 9px;background-color: #FFFFFF;text-align: center;height: 16px; border: 1px solid #0000FF;"'); 
				   document.writeln('  value="');
				   if (OS != "Mac")	
				   document.writeln(currentPage + ' of ' + gTotalPages  );
				   document.writeln('" size="10" maxlength="10">');   
				   document.writeln('<a href="JavaScript:updatePage(\''+nextPage+'\')"><img name="next" src="'+gImagePath+'next.gif" align="absmiddle" border="0"></a> ');
			   document.writeln('</font>');	   
	
		   document.writeln('  </td>');
		   document.writeln('  <td nowrap>');
	
		   
	
		   document.writeln('  <img name="space" src="'+gImagePath+'space.gif" width="5" height="1" border="0">');   
		   document.writeln('  <img name="sep" src="'+gImagePath+'line.gif" align="absmiddle" border="0">');   
		   		   
		   if (gsHomeURL == "") document.writeln('  <a target="main" href="JavaScript:updatePage(\''+gStartingPage+'\')"><img name="home" src="'+gImagePath+'home.gif" align="absmiddle" alt="Home" border="0"></a>');    
		   else document.writeln('  <a target="_blank" href="'+gsHomeURL+'"><img name="home" src="'+gImagePath+'home.gif" align="absmiddle" alt="Home" border="0"></a>');   		   
		   		   
		   document.writeln('  <a href="JavaScript:void(\'Index\')"><img onClick="thumbwin = window.open(\'thmbnail'+gsExtName+'?gInitialPosX='+getLayerProperty("toolbarOBJ", "left")+'&gInitialPosY='+getLayerProperty("toolbarOBJ", "top")+'\',\'Index\',\'width=200,height=400,toolbar=no, status=no,menubar=no,location=no,directories=no,scrollbars,resizable\');" name="thumb" src="'+gImagePath+'thumb.gif" align="absmiddle" alt="Index" border="0"></a>');   		    
		   
		   if (gNavigation != 3) document.writeln('  <a href="JavaScript:void(\'Bookmarks\')"><img onClick="bookwin = window.open(\''+gsFName+gsBmkName+gsExtName+'\',\'Bookmarks\',\'width=300,height=400,toolbar=no, status=no,menubar=no,location=no,directories=no,scrollbars,resizable\');" name="fav" src="'+gImagePath+'fav.gif" align="absmiddle" alt="Bookmarks" border="0"></a>');   
		   
		   if (gHelp == 1 ) document.writeln('  <a href="JavaScript:void(\'Help\')"><img onClick="helpwin = window.open(\'help_nav'+gsExtName+'\',\'Help\',\'width=600,height=400,toolbar=no, status=no,menubar=no,location=no,directories=no,scrollbars,resizable\');" name="Help" src="'+gImagePath+'help.gif" align="absmiddle" alt="Help" border="0"></a>');   
		   
		   document.writeln('  <img name="sep" src="'+gImagePath+'line.gif" align="absmiddle" border="0">');   
	
		   if (gZoom) {
			   document.writeln('  <a href="JavaScript:newZoomValue(\'-1\')"><img name="zoom1" src="'+gImagePath+'zoomout.gif" align="absmiddle" alt="Zoom Out" border="0"></a>');   
			   
			   document.writeln('   <select style="text-decoration: none; color: #0000FF;font-family: Verdana, Arial, Helvetica, sans-serif;top: 0px;font-size: 9px;background-color: #FFFFFF;text-align: center;height: 16px; border: 1px solid #0000FF;" name="zoommenu" onChange="newZoomValue(this.value)">  '); 
			   document.writeln('   <option value="100">Original'); 
			   document.writeln('   <option value="400"'); if (gZoomValue == '400') document.write(' selected'); document.write('>400%  '); 
			   document.writeln('   <option value="200"'); if (gZoomValue == '200') document.write(' selected'); document.write('>200%  '); 
			   document.writeln('   <option value="150"'); if (gZoomValue == '150') document.write(' selected'); document.write('>150%  '); 
			   document.writeln('   <option value="100"'); if (gZoomValue == '100') document.write(' selected'); document.write('>100%  '); 
			   document.writeln('    <option value="75"'); if (gZoomValue == '75') document.write(' selected'); document.write('>75%  '); 
			   document.writeln('    <option value="50"'); if (gZoomValue == '50') document.write(' selected'); document.write('>50%  '); 
			   document.writeln('    <option value="25"'); if (gZoomValue == '25') document.write(' selected'); document.write('>25%  ');
  			   document.writeln('   </select> ');
  
			   document.writeln('  <a href="JavaScript:newZoomValue(\'1\')"><img name="zoom2" src="'+gImagePath+'zoomin.gif" align="absmiddle" alt="Zoom In" border="0"></a>');   
		   }  
		   
		   
		   	if (gPrint || gFind) document.writeln('  <img name="sep" src="'+gImagePath+'line.gif" align="absmiddle" border="0">');   
			if (gFind)           document.writeln('  <a href="JavaScript:void(\'Search\')"><img onClick="searchwin = window.open(\'search'+gsExtName+'?currentpage='+currentPage+'&totalpages='+gTotalPages+'\',\'Search\',\'width=350,height=110,toolbar=no, status=no,menubar=no,location=no,directories=no,resizable\');" name="find" src="'+gImagePath+'find.gif" align="absmiddle" alt="Find" border="0"></a>');   
			if (gPrint)          document.writeln('  <a href="JavaScript:void(\'Print\')"><img onClick="findwin = window.open(\'print'+gsExtName+'?currentpage='+currentPage+'&totalpages='+gTotalPages+'\',\'Print\',\'width=600,height=200,toolbar=no, status=no,menubar=no,location=no,directories=no,resizable\');" name="print" src="'+gImagePath+'print.gif" align="absmiddle" alt="Print" border="0"></a>');   
		   	
		   
		   if (gsOriginalLink != "") document.writeln('  <a target="_blank" href="'+gsOriginalLink+'"><img name="home" src="'+gImagePath+'save.gif" align="absmiddle" alt="Download Original" border="0"></a>');
		   
		   document.writeln('  <img  name="sep" src="'+gImagePath+'line.gif" align="absmiddle" border="0">');   
		   document.writeln('  <img  name="space" src="'+gImagePath+'space.gif" width="5" height="1" border="0">');   			  
	   
		   if (gsCustomText != "") {
			if (gsCustomLink != "") document.writeln('<a target="_blank" href="'+gsCustomLink+'">');
			document.writeln('<font size="1" face="Verdana, Arial, Helvetica, sans-serif"><span style="text-decoration: none; color: #0000FF;">[');   	
			document.writeln(gsCustomText);   
			document.writeln(']</span></font>');
			if (gsCustomLink != "") document.writeln('</a>'); 
		   }   		   
		   document.writeln('</td>');
		   document.writeln('</tr>');
		   document.writeln('</table>');
	
		   document.writeln('</td>');
		   document.writeln('</tr>'); 
		   document.writeln('<tr>');   
		   document.writeln('<td nowrap valign="top">');
	
		   document.writeln('<font size="1" face="Verdana, Arial, Helvetica, sans-serif">');     
	
		   var indexOffset1 = 0;
		   var indexOffset2 = 0;
		   if (currentPage < (gStartingPage+10)) indexOffset1 = (gStartingPage+10)-currentPage;
		   if (currentPage > gTotalPages-(10)) indexOffset2 = Math.abs(gTotalPages-currentPage-(10));
	
	
		   if ((gTotalPages>(20)) && (currentPage > (gStartingPage+9))) document.write('<a href="JavaScript:updatePage(\''+gStartingPage+'\')"><span style="text-decoration: none; color: #0000FF;"><strong>'+gStartingPage+'</strong></span></a> .. ');
	
		   for (var i = gStartingPage; i<=gTotalPages; i++) {    
			   if ((i != currentPage) && (i > currentPage-(10)-indexOffset2) &&  (i < currentPage+(gStartingPage+11)+indexOffset1)) {
				   if (i<(gStartingPage+10)) document.write('&nbsp;');
				   document.write('<a href="JavaScript:updatePage(\''+i+'\')"><span style="text-decoration: none; color: #0000FF;">'+i+'</span></a>&nbsp;');	 
				   }
			   if (i == currentPage) {
				   if (i<(gStartingPage+10)) document.write('&nbsp;');
				   document.write('<strong>'+i+'</strong> '); 
				   }
		   }
	
		   if ((gTotalPages>(gStartingPage+20)) && (currentPage < gTotalPages-(gStartingPage+10))) document.write(' .. <a href="JavaScript:updatePage(\''+gTotalPages+'\')"><span style="text-decoration: none; color: #0000FF;"><strong>'+gTotalPages+'</strong></span></a> ');
	
	
		   document.writeln(' </font>');
	
		   document.writeln('</td>');
		   document.writeln('</tr>');
		   document.writeln('</table>');	
	    	   
		   document.writeln('</td>');
		   document.writeln('</tr>');
		   document.writeln('</table>');
	
		   document.writeln('</DIV>');
		
		maximize();

		if (gDrag) initilizeDrag(); // if toolbar is draggable
		 
		
	} // show toolbar   

	if ((gNavigation == 1) || (gNavigation == 2) || (gNavigation == 3) )
	parent.nav.location.reload();
}

mainFunction();   
   

//-------------------------------------------------------------------------------
