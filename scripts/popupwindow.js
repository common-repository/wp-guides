// JavaScript Document
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.availWidth)?Math.floor(Math.random()*(screen.availWidth-w)):50;TopPosition=(screen.availHeight)?Math.floor(Math.random()*((screen.availHeight-h)-75)):50;}
if(pos=="center"){LeftPosition=(screen.availWidth)?(screen.availWidth-w)/2:50;TopPosition=(screen.availHeight)?(screen.availHeight-h)/2:50;}
if(pos=="default"){LeftPosition=50;TopPosition=50}
else if((pos!="center" && pos!="random" && pos!="default") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
win=window.open(mypage,myname,settings);
if(win.focus){win.focus();}}
function CloseNewWin(){if(win!=null && win.open)win.close()}
window.onfocus=CloseNewWin;