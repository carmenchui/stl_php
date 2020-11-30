<?php
$pathLen = 0;

function prePad($level)
{
  $ss = "";

  for ($ii = 0;  $ii < $level;  $ii++)
  {
    $ss = $ss . "|&nbsp;&nbsp;";
  }

  return $ss;
}

function myScanDir($dir, $level, $rootLen)
{
  global $pathLen;

  if ($handle = opendir($dir)) {

    $allFiles = array();

    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
        if (is_dir($dir . "/" . $entry))
        {
          $allFiles[] = "D: " . $dir . "/" . $entry;
        }
        else
        {
          $allFiles[] = "F: " . $dir . "/" . $entry;
        }
      }
    }
    closedir($handle);

    natsort($allFiles);

    foreach($allFiles as $value)
    {
//      echo $value;
      $displayName = substr($value, $rootLen + 4);
      $fileName    = substr($value, 3);
      $internal = "internal";
      $shared = "SHARED";
      $linkName    = substr($value, $pathLen + 3);//str_replace(" ", "%20", substr($value, $pathLen + 3));
//      $linkName = "internal/SHARED/".$linkName;

      if (is_dir($fileName)) {
        echo prePad($level) . "<a href=\"" . $fileName . "\" style=\"text-decoration:none;\">" .$displayName . "</a><br>\n";
        myScanDir($fileName, $level + 1, strlen($fileName));
      } else {
        echo prePad($level) . "<a href=\"" . $fileName . "\" style=\"text-decoration:none;\">" . $displayName . "</a><br>\n";
      }
    }
  }
}

?><!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>STL: SHARED Site Map</title>
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
<h1>STL: SHARED Site Map</h1>
The following is a full file listing for this SHARED directory.
<br />
<p style="font-family:'Courier New', Courier, monospace; font-size:small;">
<?php
  $root = '.';

  $pathLen = strlen($root);

  myScanDir($root, 0, strlen($root)); ?>
</p>


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

</body>
</html>
