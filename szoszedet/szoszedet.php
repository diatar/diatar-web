<?php ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
</head>
<body>

<ul id="myUL">

<?php
  $file=fopen("szoszedet.txt","r") or exit("Fájl megnyitási hiba!");
  $level=0;
  while (!feof($file)) {
    $line=fgets($file);                                     //soronkent olvassuk vegig a fajlt
    $c1=substr($line,0,1); $line=trim(substr($line,1));     //elso karakter vezerel
    switch($c1) {
      case ";": break;                                      //megjegyzessor
	  case " ":												//normal szoveg
		echo "<li>".$line."</li>\n";
		break;
	  case "1":
	  case "2":
	  case "3":												//header
	    echo "<h".$c1.">".$line."</h".$c1.">\n";
		break;
	  case ">":												//alpont
	    echo '</br><li><span class="caret">'.$line.'</span>'."\n";
		echo '<ul class="nested">'."\n";
		$level++;
		break;
	  case ".":												//alpont vege
		if ($level<=0) break;
		echo '</ul> </li>'."\n";
		$level--;
	}
  }
  fclose($file);
  while ($level--) echo '</ul> </li>\n';
?>

</ul>

<!--
<h2>Tree View</h2>
<p>A tree view represents a hierarchical view of information, where each item can have a number of subitems.</p>
<p>Click on the arrow(s) to open or close the tree branches.</p>

  <li><span class="caret">Beverages</span>
    <ul class="nested">
      <li>Water</li>
      <li>Coffee</li>
      <li><span class="caret">Tea</span>
        <ul class="nested">
          <li>Black Tea</li>
          <li>White Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha<br/>
              Gyokuro</li>
              <li>Matcha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>  
    </ul>
  </li>
</ul>
-->

<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>

</body>
</html>
