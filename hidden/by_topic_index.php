<!DOCTYPE html>
<html>
<body>


<?php
function listFolderFiles($dir)
{

    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true) ]);
    unset($ffs[array_search('..', $ffs, true) ]);

    // prevent empty ordered elements
    if (count($ffs) < 1) return;

    echo '<ol>';
    foreach ($ffs as $ff)
    {

        if (is_dir($dir . '/' . $ff)); //listFolderFiles($dir.'/'.$ff);
        if ($ff != "index.php")
        {
            echo '<li>'; //.$ff;
            echo "<a href='$dir/$ff'>$ff</a><br />";
            echo '</li>';
        }

    }
    echo '</ol>';
}

function getCurrentDirectory()
{
    $path = dirname($_SERVER['PHP_SELF']);
    $position = strrpos($path, '/') + 1;
    return substr($path, $position);
}

$currentdir = getCurrentDirectory();
echo ("<title>STL: $currentdir</title>");

echo "Go Up A Directory: <a href='../'>Up</a>";
echo " | ";
echo "Current Directory: <a href='../$currentdir'>$currentdir</a>";
echo "<br />";
echo "<br />";

$files = array();
$dir = opendir('.'); // open the cwd..also do an err check.
while (false != ($file = readdir($dir)))
{
    if (($file != ".") and ($file != "..") and ($file != "index.php") and ($file != "indextest.php") and ($file != "topic.php") and ($file != ".htaccess"))
    {
        $files[] = $file; // put in array.
        
    }
}

natsort($files); // sort.
echo "Sub-Directories:";
echo "<br />";
echo '<ol>';
foreach ($files as $file)
{
    echo '<li>';
    echo ("<a href='$file'>$file</a> <br />\n");
    echo '</li>';
}
echo '</ol>';

echo "<hr>";
echo "<br />";
echo "Full Listing:";
echo "<br />";
echo '<ol>';
foreach ($files as $file)
{
    echo '<li>';
    echo ("<a href='$file'>$file</a> <br />\n");
    listFolderFiles($file);
    echo '</li>';
}
echo '</ol>';


/***
echo "<br />";
echo "<br />";
echo "Here are our papers by topic:<br /><br />";
$path = ".";
$dh = opendir($path);
$i=1;
while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin" && $file!="topic.php") {
        echo "<a href='$path/$file'>$file</a><br /><br />";
        listFolderFiles($file);
        $i++;
    }
}

closedir($dh);
**/

//listFolderFiles('Ontology');

?> 

<?php 
echo '
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-cly1{text-align:left;vertical-align:middle}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-wa1i{font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-nrix{text-align:center;vertical-align:middle}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
';
echo '
<table class="tg">
<thead>
  <tr>
    <th class="tg-1wig"><span style="font-weight:bold">Folder</span></th>
    <th class="tg-1wig"><span style="font-weight:bold">Folder(s)/File(s)</span></th>
  </tr>
</thead>
<tbody>
  <tr>
';
foreach ($files as $file)
{
echo '<td class="tg-0lax">';
echo "<a href='$file'>$file</a> <br />\n";
echo '</td>';
echo '<td class="tg-0lax">';
listFolderFiles($file);
echo '</td>';
echo '</tr>';
}
echo '</tbody></table>';
?>


<!--?php
header("Pragma: public");
header("Cache-Control: private");
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=age-of-files.csv");

$rdi = new RecursiveDirectoryIterator("."); // The directory here
$rii = new RecursiveIteratorIterator($rdi);

foreach ($rii as $filename=>$cur) {
    echo $cur.', '.date('m-d-Y', $cur->getATime() ).', '.date('H:i:s', $cur->getATime() )."\r\n";
}
?-->

<!--
<?php
$path = realpath('.');
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
{
        echo "<a href='$filename'>$filename</a></br>";
}
?>
-->

<?php
$it = new RecursiveTreeIterator(new RecursiveDirectoryIterator('.', RecursiveDirectoryIterator::SKIP_DOTS));
foreach($it as $path) {
  echo $path."<br>";
}
?>



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
<script type="text/javascript">
//Enter list of banned ips, each separated with a comma:
var bannedips=["109.63.140.186", "188.32.139.59", "79.111.94.163", "5.228.118.17","95.28.205.220","176.193.229.167","188.32.240.199","95.221.58.133","109.63.129.239","95.28.228.205","176.193.239.89"]

var ip = '<!--#echo var="REMOTE_ADDR"-->'

var handleips=bannedips.join("|")
handleips=new RegExp(handleips, "i")

if (ip.search(handleips)!=-1){ 
alert("Redirecting...")
window.location.replace("http://www.google.com")
}

</script>
</body>
</html>
