<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>STL: SHARED File Manager</title>
<style>
html,body,div,span,p,pre,a,code,em,img,small,strong,ol,ul,li,form,label,table,tr,th,td{margin:0;padding:0;vertical-align:baseline;outline:none;font-size:100%;background:transparent;border:none;text-decoration:none}
html{overflow-y:scroll}body{padding:0;font:13px/16px Tahoma,Arial,sans-serif;color:#222;background:#efefef}
input,select,textarea,button{font-size:inherit;font-family:inherit}
a{color:#296ea3;text-decoration:none}a:hover{color:#b00}img{vertical-align:middle;border:none}
a img{border:none}span.gray{color:#777}small{font-size:11px;color:#999}p{margin-bottom:10px}
ul{margin-left:2em;margin-bottom:5px}ul{list-style-type:disc;margin-left:2em}ul li{padding:3px 0}
ol{margin-left:2em;margin-bottom:5px}ol{list-style-type:decimal;margin-left:2em}ol li{padding:3px 0}
table{border-collapse:collapse;border-spacing:0;margin-bottom:10px;width:100%}
th,td{padding:4px 7px;text-align:left;vertical-align:top;border:1px solid #ddd;background:#fff;white-space:nowrap}
th,td.gray{background-color:#eee}td.gray span{color:#222}
tr:hover td{background-color:#f5f5f5}tr:hover td.gray{background-color:#eee}
code,pre{display:block;margin-bottom:10px;font:13px/16px Consolas,'Courier New',Courier,monospace;border:1px dashed #ccc;padding:5px;overflow:auto}
pre.with-hljs{padding:0}
pre.with-hljs code{margin:0;border:0;overflow:visible}
code.maxheight,pre.maxheight{max-height:512px}input[type="checkbox"]{margin:0;padding:0}
#wrapper{max-width:1000px;min-width:400px;margin:10px auto}
.path{padding:4px 7px;border:1px solid #ddd;background-color:#fff;margin-bottom:10px}
.right{text-align:right}.center{text-align:center}.float-right{float:right}
.message{padding:4px 7px;border:1px solid #ddd;background-color:#fff}
.message.ok{border-color:green;color:green}
.message.error{border-color:red;color:red}
.message.alert{border-color:orange;color:orange}
.btn{border:0;background:none;padding:0;margin:0;font-weight:bold;color:#296ea3;cursor:pointer}.btn:hover{color:#b00}
.preview-img{max-width:100%;background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC") repeat 0 0}
.preview-video{position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px}.preview-video video{position:absolute;width:100%;height:100%;left:0;top:0;background:#000}
[class*="icon-"]{display:inline-block;width:16px;height:16px;background:url("<?php echo FM_SELF_URL ?>?img=sprites&amp;t=<?php echo $sprites_ver ?>") no-repeat 0 0;vertical-align:bottom}
.icon-document{background-position:-16px 0}.icon-folder{background-position:-32px 0}
.icon-folder_add{background-position:-48px 0}.icon-upload{background-position:-64px 0}
.icon-arrow_up{background-position:-80px 0}.icon-home{background-position:-96px 0}
.icon-separator{background-position:-112px 0}.icon-cross{background-position:-128px 0}
.icon-copy{background-position:-144px 0}.icon-apply{background-position:-160px 0}
.icon-cancel{background-position:-176px 0}.icon-rename{background-position:-192px 0}
.icon-checkbox{background-position:-208px 0}.icon-checkbox_invert{background-position:-224px 0}
.icon-checkbox_uncheck{background-position:-240px 0}.icon-download{background-position:-256px 0}
.icon-goback{background-position:-272px 0}.icon-folder_open{background-position:-288px 0}
.icon-file_application{background-position:0 -16px}.icon-file_code{background-position:-16px -16px}
.icon-file_csv{background-position:-32px -16px}.icon-file_excel{background-position:-48px -16px}
.icon-file_film{background-position:-64px -16px}.icon-file_flash{background-position:-80px -16px}
.icon-file_font{background-position:-96px -16px}.icon-file_html{background-position:-112px -16px}
.icon-file_illustrator{background-position:-128px -16px}.icon-file_image{background-position:-144px -16px}
.icon-file_music{background-position:-160px -16px}.icon-file_outlook{background-position:-176px -16px}
.icon-file_pdf{background-position:-192px -16px}.icon-file_photoshop{background-position:-208px -16px}
.icon-file_php{background-position:-224px -16px}.icon-file_playlist{background-position:-240px -16px}
.icon-file_powerpoint{background-position:-256px -16px}.icon-file_swf{background-position:-272px -16px}
.icon-file_terminal{background-position:-288px -16px}.icon-file_text{background-position:-304px -16px}
.icon-file_word{background-position:-320px -16px}.icon-file_zip{background-position:-336px -16px}
.icon-logout{background-position:-304px 0}.icon-chain{background-position:-320px 0}
.icon-link_folder{background-position:-352px -16px}.icon-link_file{background-position:-368px -16px}
.compact-table{border:0;width:auto}.compact-table td,.compact-table th{width:100px;border:0;text-align:center}.compact-table tr:hover td{background-color:#fff}
.filename{max-width:420px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.break-word{word-wrap:break-word}
</style>
<link rel="icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<link rel="shortcut icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/<?php echo FM_HIGHLIGHTJS_STYLE ?>.min.css">
<?php endif; ?>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=5511939; 
var sc_invisible=1; 
var sc_security="ae1c997c"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="//c.statcounter.com/5511939/0/ae1c997c/1/" alt="web
analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
</head>
<body>
<center><h1><a href="./">STL</a>: SHARED File Manager (SEARCH)</h1></center>

<div id="wrapper">
<div class="path">
<br/>
<br/>
Notes about using the <b>search</b> feature:
<ul>
<li>The search is <b>case-insensitive</b>.</li>
<li>The search is very simple (<b>basic regex</b> in the backend) matching the keyword found in file names.</li>
<li>If the file name is not informative, then you may need to navigate to the folder to find what you're looking for.</li>
<li>Most files uploaded to this repository contain the first author's surname and the title of the paper/book/document.</li>
</ul>
<br/>
<br/>
<form action="" method="get">
<input name="q" style="width: 300px;" type="text">
<input type="submit">
</form>

<br/>

<?php


/** this works fine, lists files and file sizes
$ite=new RecursiveDirectoryIterator("./Books");

$bytestotal=0;
$nbfiles=0;
foreach (new RecursiveIteratorIterator($ite) as $filename=>$cur) {
    $filesize=$cur->getSize();
    $bytestotal+=$filesize;
    $nbfiles++;
    echo "$filename => $filesize <br />";
//     echo "<a href='$dir/$filename'>$filename</a>" . "<br/> \n";
}

$bytestotal=number_format($bytestotal);
echo "Total: $nbfiles files, $bytestotal bytes  <br />";
**/



$folder = "./Papers By Topic";
$q = (isset($_GET['q']))? strtolower($_GET['q']) : ''; 

function stlsearch($folder, $q){

$allowed=array("pdf","txt","ps","html","txt");
$it = new RecursiveDirectoryIterator($folder);

echo "<u><b>Search Results in $folder</b></u>:<br/><br/>";
echo "<ol>";
foreach(new RecursiveIteratorIterator($it) as $file) {

$folder2=substr($folder,strrpos($folder,'/')+1);
$folder2 = str_replace(' ', '+', $folder2); // Replaces all spaces with hyphens.

$filename=basename($file);
$filename = str_replace(' ', '+', $filename); // Replaces all spaces with hyphens.

$foldername=dirname($file);
$foldername=substr($foldername,strrpos($foldername,'/')+1);
$foldername='%2F'.$foldername;
$string=$folder2.$foldername.'&view='.$filename;
	if(in_array(substr($file, strrpos($file, '.') + 1),$allowed)) {
		if(stripos($file,$q) !== false){
// 			echo "String contains: ".$q . "<br/> \n";
			echo "<li><a href='$file' target=\"_blank\">$file</a></li>" . "<br/>";
// 			echo "<li><a href='http://stl.mie.utoronto.ca/internal/SHARED/index.php?p=$string' target=\"_blank\">$file</a></li>" . "<br/>"; // trying to get preview page from URLs 
		}
	
// trying to get preview page from URLs http://stl.mie.utoronto.ca/internal/SHARED/index.php?p=Journals%2FVolume%2001,%20Issues%201-2&view=Generalization-learning-techniques-for-automating-the-_1970_Artificial-Intel.pdf	
// http://stl.mie.utoronto.ca/internal/SHARED/index.php?p=Journals%2FArtificial+Intelligence%2FVolume+01%2C+Issues+1-2&view=Editorial-Board_1970_Artificial-Intelligence.pdf
	}
	if(preg_match('/.*$q.*\.pdf*$/', $file)){		
		echo "<a href='$dir/$file'>$file</a>" . "<br/> \n";
		echo "<a href='?p=$dir/$file'>$file</a>" . "<br/> \n";
	}

}
echo "</ol>";
}

if (empty($q)){
echo "Please enter a keyword to search.";
}
else{
echo "Your keyword query is: <font color='blue'><b>".$q."</b></font><br /><br />";

$folder = "./Books";
stlsearch($folder,$q);

$folder = "./Conference & Workshop Proceedings";
stlsearch($folder,$q);

$folder = "./ISO Standards";
stlsearch($folder,$q);

$folder = "./Journals";
stlsearch($folder,$q);

$folder = "./Papers By Topic";
stlsearch($folder,$q);

$folder = "./Webinars";
stlsearch($folder,$q);

// add additional directories here

}

?>

</div>
</div>
<p class="center">Full Listing of Files: <a href="sitemap.php">Sitemap</a> | Search Files: <a href="search.php">Search</a> | List of Recently Uploaded Files: <a href="latest.php">Latest Files</a></p>
<p class="center"><small>System Time: <?php echo date("Y-m-d h:i:s A");?> (America/Toronto)</small></p>
</div>
<script>
function newfolder(p){var n=prompt('New folder name','folder');if(n!==null&&n!==''){window.location.search='p='+encodeURIComponent(p)+'&new='+encodeURIComponent(n);}}
function rename(p,f){var n=prompt('New name',f);if(n!==null&&n!==''&&n!=f){window.location.search='p='+encodeURIComponent(p)+'&ren='+encodeURIComponent(f)+'&to='+encodeURIComponent(n);}}
function change_checkboxes(l,v){for(var i=l.length-1;i>=0;i--){l[i].checked=(typeof v==='boolean')?v:!l[i].checked;}}
function get_checkboxes(){var i=document.getElementsByName('file[]'),a=[];for(var j=i.length-1;j>=0;j--){if(i[j].type='checkbox'){a.push(i[j]);}}return a;}
function select_all(){var l=get_checkboxes();change_checkboxes(l,true);}
function unselect_all(){var l=get_checkboxes();change_checkboxes(l,false);}
function invert_all(){var l=get_checkboxes();change_checkboxes(l);}
function checkbox_toggle(){var l=get_checkboxes();l.push(this);change_checkboxes(l);}
</script>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=5511939; 
var sc_invisible=1; 
var sc_security="ae1c997c"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="//c.statcounter.com/5511939/0/ae1c997c/1/" alt="web
analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php endif; ?>
</body>
</html>

<?php


/**
 * Get base64-encoded images
 * @return array
 */
function fm_get_images()
{
    return array(
        'favicon' => 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJ
bWFnZVJlYWR5ccllPAAAAZVJREFUeNqkk79Lw0AUx1+uidTQim4Waxfpnl1BcHMR6uLkIF0cpYOI
f4KbOFcRwbGTc0HQSVQQXCqlFIXgFkhIyvWS870LaaPYH9CDy8vdfb+fey930aSUMEvT6VHVzw8x
rKUX3N3Hj/8M+cZ6GcOtBPl6KY5iAA7KJzfVWrfbhUKhALZtQ6myDf1+X5nsuzjLUmUOnpa+v5r1
Z4ZDDfsLiwER45xDEATgOI6KntfDd091GidzC8vZ4vH1QQ09+4MSMAMWRREKPMhmsyr6voYmrnb2
PKEizdEabUaeFCDKCCHAdV0wTVNFznMgpVqGlZ2cipzHGtKSZwCIZJgJwxB38KHT6Sjx21V75Jcn
LXmGAKTRpGVZUx2dAqQzSEqw9kqwuGqONTufPrw37D8lQFxCvjgPXIixANLEGfwuQacMOC4kZz+q
GdhJS550BjpRCdCbAJCMJRkMASEIg+4Bxz4JwAwDSEueAYDLIM+QrOk6GHiRxjXSkJY8KUCvdXZ6
kbuvNx+mOcbN9taGBlpLAWf9nX8EGADoCfqkKWV/cgAAAABJRU5ErkJggg==',
        'sprites' => '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
RK5CYII=',
    );
}


?>