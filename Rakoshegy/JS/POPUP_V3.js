var POPUP_DIV = document.createElement("DIV");
var ODL_DRAGGING = null;
POPUP_DIV.style.zIndex = "1000";
POPUP_DIV.noob = true;
var EXPIRED_CONTENT = 0;
var MOUSEOUT_DESTROY=false;

function destroyPopup()
{
 	if(EXPIRED_CONTENT != 0)
	{
		POPUP_DIV.removeChild(EXPIRED_CONTENT);
		EXPIRED_CONTENT.style.display="none";
		document.body.appendChild(EXPIRED_CONTENT);		
		EXPIRED_CONTENT = 0;	
	}
	else
	{
		removeTextPopupFormatting();	
		POPUP_DIV.innerHTML="";
	}
	
	POPUP_DIV.style.display = "none";
}
function createPopup()
{
	if(POPUP_DIV.noob == true)
	{
		document.body.appendChild(POPUP_DIV);
		POPUP_DIV.noob=false;
	}
	POPUP_DIV.style.display = "block";
	POPUP_DIV.style.position = "absolute";
}
function makePopupDraggableBy(dragger_id)
{
 	if(ODL_DRAGGING != null)
 	{
		delete ODL_DRAGGING;
	}
	new Draggable(POPUP_DIV,{revert: false, handle:dragger_id});
}
function MouseOutDestroy(event)
{
 	var obj = null;
	
	try
	{
		if(event.toElement)
		{				
			obj = event.toElement;	
		}
		else
		{ 
			if(event.relatedTarget)
			{				
				obj = event.relatedTarget;		
			}
		}
	}catch(e){}
	
	if((obj != null)&&(!is_child_of(POPUP_DIV,obj)))
	{	 
		destroyPopup();
	}
}
function MouseOutDestroyOnce(event)
{
 	var obj = null;
	if(MOUSEOUT_DESTROY)
	{
		try
		{
			if(event.toElement)
			{				
				obj = event.toElement;	
			}
			else
			{ 
				if(event.relatedTarget)
				{				
					obj = event.relatedTarget;		
				}
			}
		}catch(e){}
		
		if((obj != null)&&(!is_child_of(POPUP_DIV,obj)))
		{	 
			destroyPopup();
			MOUSEOUT_DESTROY=false;
		}		
	}
}
function initPopupForMouseoutDisengage()
{
 	var browser=navigator.appName;	
	if((browser == "Netscape")||(browser == "Opera"))
	{
	 	POPUP_DIV.setAttribute('onmouseout',"MouseOutDestroy(event)");
	}
	else
	{
		POPUP_DIV.attachEvent('onmouseout',MouseOutDestroy);
	}
}
function initPopupForSingleMouseoutDisengage()
{
 	MOUSEOUT_DESTROY=true;
	var browser=navigator.appName;	
	
	if((browser == "Netscape")||(browser == "Opera"))
	{
	 	POPUP_DIV.setAttribute('onmouseout',"MouseOutDestroyOnce(event)");
	}
	else
	{
		POPUP_DIV.attachEvent('onmouseout',MouseOutDestroyOnce);
	}	
}
function destroyPopupIfNotMouseoverEvent(event)
{
	var obj = getRelatedTargetFromEvent(event);
	if((obj != POPUP_DIV)&&(!is_child_of(POPUP_DIV,obj)))
		destroyPopup();
}
 

function createPopupFromCursor(event,offsX,offsY,text)
{ 
 	if(event.pageX)
 	{
		x = event.pageX;
		y = event.pageY;
	}
	else		//IE
	{
		x = event.clientX + document.body.scrollLeft;
		y = event.clientY + document.body.scrollTop;	
	}
	x-= offsX;
	y-= offsY;
		 
	createPopupFromPosition(x,y,text)	
}
function createPopupFromObject(obj,text)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0] + obj.offsetWidth;
	var CornerRightBottomY = pos[1] + obj.offsetHeight;	
	createPopupFromPosition(CornerRightBottomX,CornerRightBottomY,text)	
}
function createPopupFromObjectOverlapped(obj,text)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0];
	var CornerRightBottomY = pos[1];	
	createPopupFromPosition(CornerRightBottomX,CornerRightBottomY,text)	
}
function createPopupFromPosition(x,y,text)
{
 	destroyPopup();
 	
	doTextPopupFormatting();
	
	POPUP_DIV.style.top = y + "px";	
	POPUP_DIV.style.left = x + "px";	
	POPUP_DIV.innerHTML = text;			
	createPopup();
}
function doTextPopupFormatting()
{
	POPUP_DIV.style.padding = "2px";
	POPUP_DIV.style.backgroundColor = "rgb(255,255,225)";
	POPUP_DIV.style.border = "1px solid black";
	POPUP_DIV.style.overflow = "hidden";
	POPUP_DIV.style.fontFamily = "arial, verdana, tahoma";
	POPUP_DIV.style.fontSize = "11px";
}
function removeTextPopupFormatting()
{
	POPUP_DIV.style.padding = "0px";
	POPUP_DIV.style.backgroundColor = "transparent";
	POPUP_DIV.style.border = "0px";
	POPUP_DIV.style.overflow = "hidden";
	POPUP_DIV.style.fontFamily = "times new roman, verdana, tahoma";
	POPUP_DIV.style.fontSize = "12px";	
}
function createObjectSourcedPopupFromObject(what,obj)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0] + obj.offsetWidth;
	var CornerRightBottomY = pos[1] + obj.offsetHeight;	
	createObjectSourcedPopupFromPosition(CornerRightBottomX,CornerRightBottomY,what)
}
function createObjectSourcedPopupFromObjectOverlapped(what,obj)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0];
	var CornerRightBottomY = pos[1];	
	createObjectSourcedPopupFromPosition(CornerRightBottomX,CornerRightBottomY,what)
}
function createObjectSourcedPopupFromPosition(x,y,obj)
{
	destroyPopup();
	EXPIRED_CONTENT = obj;	
	 	
	POPUP_DIV.appendChild(obj);
	obj.style.display="block";	

	POPUP_DIV.style.position = "absolute";
	POPUP_DIV.style.top = y + "px";	
	POPUP_DIV.style.left = x + "px";
	POPUP_DIV.style.overflow = "hidden";
	POPUP_DIV.appendChild(obj);	
	createPopup();
}
function createIdSourcedPopupFromObject(id,obj)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0] + obj.offsetWidth;
	var CornerRightBottomY = pos[1] + obj.offsetHeight;	
	createIdSourcedPopupFromPosition(CornerRightBottomX,CornerRightBottomY,id)
}
function createIdSourcedPopupFromObjectOverlapped(id,obj,x,y)
{
	var pos = findPos(obj);
	var CornerRightBottomX = pos[0] - x;
	var CornerRightBottomY = pos[1] - y;	
	createIdSourcedPopupFromPosition(CornerRightBottomX,CornerRightBottomY,id)
}
function createIdSourcedPopupFromPosition(x,y,id)
{
 	var obj = document.getElementById(id);
	createObjectSourcedPopupFromPosition(x,y,obj)
}

function createIdSourcedPopupFromCursorOverlapped(obj,id,event,offsX,offsY)
{ 
 	if(event.pageX)
 	{
		x = event.pageX;
		y = event.pageY;
	}
	else		//IE
	{
		x = event.clientX;
		y = event.clientY + document.body.scrollTop;	
	}
	x-= offsX;
	y-= offsY;
		 
	var obj2 = document.getElementById(id); 
	if(obj2)	
		createObjectSourcedPopupFromPosition(x,y,obj2);
}