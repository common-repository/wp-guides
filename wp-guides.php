<?php
/*
Plugin Name: WordPress Guides
Plugin URI: http://www.jaredritchey.com/wp-guides/
Description: <strong>WordPress Guide and Document Distribution Solution</strong>  <p>This tool was developed to provide end users, publishers, webmasters and other WordPress professionals a way of distributing tutorials, documents and company related information in an easy to manage user interface. By default there is only a small selection of tutorials available in the plugin. For additional tutorials please visit the project site. </p>
Author: Jared Ritchey
Version: 0.9.7
Author URI: http://www.jaredritchey.com

	Copyright 10/03/08 - 2009  Jared_Ritchey  (email : jared@jaredritchey.com)
    This program is free software in accordance with the GNU/GPL
	
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/

$wpguides = '0.9.7';

//////////////////////[Designer Support Details]//////////////////////
/* 
@	To edit the details below to reflect your support and or specific
@	criteria please follow the examples exactly as you see for the best
@	results.  What this allows you to do is use this plugin to distribute
@	tutorials specific to you, your clients and or your staff members 
@	while providing you a way to brand the tutorials and this plugin in 
@	a way that helps market you and your services.
*/
//////////////////////////////////////////////////////////////////////
///////////////// EDIT THE FOLLOWING VARIABLES ONLY //////////////////
$wpguides_supporturl ='http://www.jaredritchey.com'; // this link will be in the admin panel
$wpguides_title ='WordPress Instructional Guides'; // what ever you put here will show in the admin panel title
$wpguides_devname ='Jared Ritchey'; // this will be string replaced where ever the devname is.
$wpguides_logourl ='http://www.jaredritchey.com/logo.jpg'; //this will load your company logo 125 x 125
$wpguides_userdefined ='Any alpha numeric item'; // This was added to render its contents below details area.
$wpguides_accessname ='Name on account for professional guides';
$wpguides_accesskey ='The access key required for guide access';
/* PLEASE DO NOT EDIT BELOW THIS LINE AND DO NOT REMOVE PLUGIN DEVELOPER LINK AS PER LICENSE */

////////////////////////////
/* Show main options page */
////////////////////////////

//use the hook so when the admin_menu is loaded, to run some_function
add_action('admin_menu', 'show_wp_guides_option');
function show_wp_guides_option() {
	if (function_exists('add_options_page')) {
		add_options_page("WP Guides Display v{$wpguides} - Main", 
		"WP Guides", 8, "wp-guides-admin", 'wp_guides_admin_options');
	}		
}

function wp_guides_admin_options()
	{
		$template.='<div class="wrap">'. "\n";
		//$template.=''. "\n";
		$template.='<h2>WP Guides</h2>'. "\n";
		//$template.='<fieldset class="options">'. "\n";
		//$template.='<legend>Using WP Guides</legend>'. "\n";
		//$template.='<p><strong>WordPress Blog Guides and Tutorials</strong> can be viewed by selecting one of the following icon types;<br /> <img src="../wp-content/plugins/wp-guides/images/open.gif" alt="mini-icon" width="24" height="18" /> <strong>Load in the same window.</strong><br />  <img src="../wp-content/plugins/wp-guides/images/800.gif" alt="mini-icon" width="24" height="18" /> <strong>Load in 800x600 popup window.</strong><br />  <img src="../wp-content/plugins/wp-guides/images/1024.gif" alt="mini-icon" width="24" height="18" /> <strong>Load in the Smart Window.</strong></p>'. "\n";
		//$template.='</fieldset>'. "\n";
		
		// Begin Outter Most Template
		$template.='<table cellpadding="5" class="wpgwrapper" width="940">'. "\n";
		$number_of_cols=2;
		$i=0;
		$folder="../wp-content/plugins/wp-guides/tutorials/";
		if (is_dir($folder)) 
			{
    			if ($dir = opendir($folder)) 
				{
        			while (($file = readdir($dir)) !== false) 
					{
					if($file=="." || $file=="..")
						continue;
					if($i%$number_of_cols==0)
						if($i!=0)
							{
							$template.='</tr>';
							$template.='<tr>';
							}
						else
							$template.='<tr>';
					$template.='<td valign="top" width="470px">'. "\n";
					$template.=make_div_from_folder($folder.$file."/");
			$template.='</td>';
				$i++;
   				}
				//check to see if we have to close a td tag
				if($i%$number_of_cols!=0)
					$template.='</tr>';
        			closedir($dir);
   				}
			}
		$template.='</table>';
		echo($template);
		include('vendor-include.php');
		echo('</div>');
	}

function make_div_from_folder($folder)
	{
	$extensions=array(
	".doc"=>"doc.gif",
	".phps"=>"php.gif",
	".fla"=>"fla.gif",
	".zip"=>"zip.gif",
	".html"=>"html.gif",
	".pdf"=>"pdf.gif",
	".xls"=>"xls.gif",
	".swf"=>"swf.gif",
	".rtf"=>"rtf.gif",
	".flv"=>"flv.gif",
	".jpg"=>"jpg.gif",
	".gif"=>"img.gif",
	".wav"=>"wav.gif",
	".psd"=>"psd.gif",
	".swf"=>"swf.gif",
	".txt"=>"txt.gif"
	);

	$hypens=array(
	"-"=>" ",
	"_"=>" ",
	);

	$template.='<table class="wpgptable" width="470">'. "\n";
	$template.='<thead>'. "\n";
    $template.='<tr>'. "\n";
    $template.='<th scope="col" width="240">&nbsp;'.basename($folder).'</th>'. "\n";
    $template.='<th scope="col" width="120">Last Updated</th>'. "\n";
    $template.='<th scope="col" width="24">&nbsp;</th>'. "\n";
    $template.='<th scope="col" width="24">&nbsp;</th>'. "\n";
    $template.='<th scope="col" width="24">&nbsp;</th>'. "\n";
    $template.='</tr>'. "\n";
    $template.='</thead>'. "\n";
    $template.='<tfoot>'. "\n";
    $template.='<tr>'. "\n";
    $template.='<td colspan="5">&nbsp;&nbsp;Check for updates here!</td>'. "\n";
    $template.='</tr>'. "\n";
    $template.='</tfoot>'. "\n";
	$template.='<tbody>'. "\n";
	$template.='<tr>'. "\n";
	$template.='<td colspan="5">'. "\n";
	$template.='<div class="wpgscroll">'. "\n";
	$template.='<table class="wpgcinner">'. "\n";

//////////////////////////////////////////////////////
	$number_of_files=0;
	foreach(glob($folder."*.*") as $filename)
		{
		if(basename($filename)=="index.php" || basename($filename)=="index.html" || basename($filename)=="index.htm")
			continue;
		$number_of_files++;
		$template.='<tr>'. "\n";
		$template.='<td width="240"><div class="wpgdoctitle">';	
		$replaced_filename=basename($filename);
		foreach($extensions as $extension=>$extension_file)
			if(strpos(basename($filename), $extension) !==false)
				{
				$template.='<img src="../wp-content/plugins/wp-guides/images/'.$extension_file.'">';
				$replaced_filename=str_replace($extension,"",$replaced_filename);
				}

		foreach($hypens as $k=>$v)
			if(strpos($replaced_filename,$k)!==false)
				$replaced_filename=str_replace($k,$v,$replaced_filename);

		$template.= $replaced_filename.'</div></td>'. "\n";
		$template.='<td width="120"><div class="wpgdate">'.date ("F d y", filemtime($filename)).'</div></td>'. "\n";
		$template.='<td width="24"><a href="'.$filename.'"><img src="../wp-content/plugins/wp-guides/images/open.gif" title="Redirects To Page"></a></td>'. "\n";
		$template.='<td width="24"><a href="'.$filename.'" onclick="NewWindow(this.href,\'WPGuides\',\'800\',\'600\',\'yes\',\'center\');return false" onfocus="this.blur()"><img src="../wp-content/plugins/wp-guides/images/800.gif" title="Open in new window 800x600"></a></td>'. "\n";
		$template.='<td width="24"><a href="'.$filename.'" onclick="return GB_showFullScreen(\' '.$replaced_filename.' \', this.href)"><img src="../wp-content/plugins/wp-guides/images/1024.gif" title="Open in Smart Window"></a></td>'. "\n";
		$template.='</tr>'. "\n";
		}
	$template.='</table>'. "\n";
	$template.='</div>'. "\n";
	$template.='</td>'. "\n";
	$template.='</tr>'. "\n";
	$template.='</tbody>'. "\n";
	$template.='</table>';
	
	//if there aren't any files, say that the folder is empty
	if($number_of_files==0)
		$template='There are no files in the '.basename($folder);
	return $template;		
	}

// Added by Jared on May 22nd so we could add row and box effects.
add_action('admin_head', 'wpguides_add_head');
function wpguides_add_head() {
	echo "\n" . '<script type="text/javascript">var GB_ROOT_DIR = "' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/greybox/";</script>' . "\n";
	echo "\n" . '<script language="JavaScript" src="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/greybox/AJS.js" /></script>' . "\n";
	echo "\n" . '<script language="JavaScript" src="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/greybox/AJS_fx.js" /></script>' . "\n";
	echo "\n" . '<script language="JavaScript" src="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/greybox/gb_scripts.js" /></script>' . "\n";
	echo "\n" . '<script language="JavaScript" src="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/scripts/popupwindow.js" /></script>' . "\n";
	echo "\n" . '<link rel="stylesheet" href="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/wpguides.css" type="text/css" media="screen" />' . "\n";
	echo "\n" . '<link rel="stylesheet" href="' . rtrim(get_settings('siteurl'), '/') . '/wp-content/plugins/wp-guides/greybox/gb_styles.css" type="text/css" media="screen" />' . "\n";
}
?>