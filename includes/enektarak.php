<?php ?>

<?php EnektarakFejlece(); ?>

<div class="L2_SCROLL">

<div class="text">
	<p>
		A templomi vetítő program (DIATAR.EXE; diatar) nem tartalmazza magában
		az énekek diáit, azokat külső, speciális formátumú fájlokban (*.dtx),
		úgynevezett <i>énektárakban (diatárakban)</i> lehet mellé tenni.
		Így a program tetszőleges számú énektárral bővíthető.
		Ezek a tematikus gyűjtemények a programból külön-külön is letilthatóak,
		ha nincs rájuk szükség; illetve saját magunk is bővíthetjük a készletet.
		A DiaEditor program segítségével lehet szerkeszteni ezeket.<br /><br />
	</p>

	<p>
		Semmiképpen nem ajánlatos a meglevő énektárakon (ld. az alábbi felsorolást) módosítani,
		vagy azokhoz hozzáírni saját énekeinket! Ezeket az énektárakat ugyanis (többek segítségével)
		folyamatosan fejlesztjük, a hibákat javítjuk, a hiányokat pótoljuk. Amennyiben saját énekeit
		szeretné felvenni, hozzon létre új énektárat. Plébániánkon mi is (az itt közzétetteken kívül)
		további énektárakat használunk, pl. "Kiegészítés", "Gitáros énekek"; melyek speciálisan saját
		használatunkra alkalmasak. <br /><br />
	</p>

	<p>
		Az alábbi felsorolás tartalmazza a programhoz adott énektárakat, azok teljes nevével
		(zárójelben a vetítéskor megjelenő rövid névvel), valamint az énektár magyarázatát,
		tartalmát, forrását. Az énektárak külön-külön is letölthetőek, de eredetileg a programmal együtt
		letöltődtek ezek is, csak utólagos frissítés, vagy a fájl sérülése esetén van szükség
		külön letöltésre. <br /><br />
	</p>
</div>

 <div class="red_text">
	<p>
		GAZDÁT KERESÜNK! A program nagy értéke a hozzá készült és folyamatosan készülő énektárak bő választéka.
		Segítséget kérünk a szerkesztésben, karbantartásban, javításban és főleg bővítésben.
	</p>
	<p>
		Akinek olyan kötete van, amit publikálna, mások által is vetíthetővé tenne, küldje el.
		De még ennél is fontosabb, hogy ha valamelyik meglévő vagy félkész kötetet fel tudja vállalni,
		hogy gondozza, befejezi, a tördelést és a helyesírást javítja, kérjük, jelentkezzen.
		Nagy szükségünk lenne olyan segítőkre, akik egy-egy kötet gazdájává válva könnyítik ezt a terhet.
	</p>
 </div>
<!-- Enektarak Kezdete --> 
<?php EnektarakListaja(); ?>
<!-- Enektarak vege -->                                                       

</div>

<!-- SEGEDRUTINOK -->                                                       
<?php
function EnektarakFejlece() {
  $file=fopen("enektarak.txt","r") or exit("Fájl megnyitási hiba!");
  $csoportid=0;
	while (!feof($file)) {
		$line=fgets($file);
		if (substr($line,0,1)=="-") {
			$csoportid++;
			echo '<p align="center"><a href="#Grp'.$csoportid.'">'.trim(substr($line,1)).'</a></p>';
		}
	}
	fclose($file);
	echo '<br/>';
}

function EnektarakListaja() {
  $file=fopen("enektarak.txt","r") or exit("Fájl megnyitási hiba!");
  $odd=FALSE;                                               //paros-paratlan jelzo
  $melyikoldal=0;                                           //0=semelyik, 1=bal, 2=jobb
	$csoportid=0;
  while (!feof($file)) {
    $line=fgets($file);                                     //soronkent olvassuk vegig a fajlt
    $c1=substr($line,0,1); $line=trim(substr($line,1));     //elso karakter vezerel
    switch($c1) {
      case ";": break;                                      //megjegyzessor
			case "-": 																						//elvalaszto
        if ($melyikoldal==1) echo '</div></div>';           //elvileg nem jovunk ide baloldal utan, de jatsszunk biztonsagosan!
        if ($melyikoldal==2) echo '</p></div></div></div>'; //lezarjuk az elozo tablasort
        $melyikoldal=0;
				$csoportid++;
			  echo '<div class="RIGHT_TABLE TABLE_ENTRY_HEADER" id="Grp'.$csoportid.'"><br/>'.$line.'</div>';
				break;
      case "#":
      case "!":                                             //uj bejegyzes kezdete
        $odd=!$odd;
        if ($melyikoldal==1) echo '</div></div>';           //elvileg nem jovunk ide baloldal utan, de jatsszunk biztonsagosan!
        if ($melyikoldal==2) echo '</p></div></div></div>'; //lezarjuk az elozo tablasort
        $melyikoldal=0;
        echo '<div class="RIGHT_TABLE TABLE_ENTRY_'.
          ($c1=="!" ? 'HIGHLIGHT_' : '').
          ($odd ? 'ODD' : 'EVEN').
          '">';
        break;
      case ">":                                             //baloldal
        if ($melyikoldal<>1) echo '<div class="RIGHT_TABLE_LEFT">';
        $melyikoldal=1;
        echo '<div class="download_link expanded">';
        echo $line."\n";
        echo '</div>';
        break;
      case " ":                                             //jobboldal
        if (strlen($line)<=0) break;                        //ures sorokat kihagyjuk, nincs allapotvaltas se
        if ($melyikoldal<>2) {
          if ($melyikoldal==1) echo '</div>';               //baloldalt lezarjuk
          echo '<div class="RIGHT_TABLE_RIGHT">';           //jobboldalt megkezdjuk
          echo '<div class="TABLE_TEXT expanded">';
          echo '<p>';
          $melyikoldal=2;
        }
        echo $line."\n";
        break;
    }
  }
  fclose($file);
  if ($melyikoldal==1) echo '</div></div>';           //elvileg nem jovunk ide baloldal utan, de jatsszunk biztonsagosan!
  if ($melyikoldal==2) echo '</p></div></div></div>'; //lezarjuk az elozo tablasort
}
?>
<!--  -->