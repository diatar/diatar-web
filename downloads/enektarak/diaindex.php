<?php
	//dia listak

	$key=(isset($_REQUEST['key']) ? $_REQUEST['key'] : 'A');
	if ($key!='others' && (strlen($key)<>1 || $key<'A' || $key>'Z')) $key='A';
	$pageid=(isset($_REQUEST['page']) ? $_REQUEST['page'] : 'firstlines');
	$file=(isset($_REQUEST['file']) ? $_REQUEST['file'] : '');
	$ienek=(isset($_REQUEST['enek']) ? $_REQUEST['enek'] : 0);
	$ivers=(isset($_REQUEST['vers']) ? $_REQUEST['vers'] : 0);

	if ($pageid!='firstlines' && $pageid!='words' && $pageid!='dtxs' && $pageid!='dia')
		$pageid='firstlines';

	class DataRecord {
		public $txt;
		public $fname;
		public $kotet;
		public $enek;
		public $vszak;
		public $ienek;
		public $ivers;
	}

    $replacement_chars = array(
    // Decompositions for Latin-1 Supplement
    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
    chr(195).chr(191) => 'y',
    // Decompositions for Latin Extended-A
    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
    chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
	
	//sajat
	chr(0xC8).chr(0x98) => 'S', 'Ț' => 'T'
    );

	echo '<div class="MAIN_CONTENT_POS1">';

	echo '<p>';
	echo '<a href="?page=dtxs">Énektárak</a>';
	echo '&nbsp;&nbsp;<a href="?page=words">Szószedet</a>';
	echo '&nbsp;&nbsp;<a href="?page=firstlines">Kezdősorok</a>';
	echo '</p><br/>';
	
	echo '<div class="iconed_title">';
	if ($pageid=='words') {
		echo 'Szószedet az összes diából:';
	} else if ($pageid=='dtxs') {
		if ($file<>'')
			echo '"', GetDtxName($file), '" énekei:';
		else
			echo 'Énektárak listája:';
	} else if ($pageid=='dia') {
		echo GetDiaName($file,$ienek,$ivers);
	} else {
		echo 'Összes dia listája a kezdősor szerint:';
	}
	echo '</div>';

	if ($pageid=='dtxs') {
		echo '<div class="DIAINDEX1">';
		if ($file<>'') EnekList($file); else DTXList();
	} else if ($pageid=='dia') {
		echo '<div class="DIAINDEX1">';
		Dia($file,$ienek,$ivers);
	} else {
		for ($ch=ord('A'); $ch<=ord('Z'); $ch++) {
			if ($key==chr($ch)) echo '<strong>';
			echo '<a href="?page=', $pageid, '&key=', chr($ch), '">', chr($ch), '</a>&nbsp;&nbsp;';
			if ($key==chr($ch)) echo '</strong>';
		}
		if ($key=='others') echo '<strong>';
		echo '<a href="?page=', $pageid, '&key=others">*</a></br></br>';
		if ($key=='others') echo '</strong>';

		echo '<div class="DIAINDEX1">';

		$dialst=array();

		$files = scandir('./downloads/enektarak');
		foreach($files as $fname)
			if (strtolower(substr($fname,-4)) == '.dtx')
				ProcessFile($fname);
			
		ksort($dialst, SORT_STRING|SORT_FLAG_CASE);
		foreach($dialst as $places) {
			$first=true;
			$prevf=""; $preve=0; $prevv=0;
			foreach($places as $dia) {
				if ($first) {
					echo "<p>$dia->txt<br/>";
					$first=false;
				}
				if ($dia->fname==$prevf && $dia->ienek==$preve && $dia->ivers==$prevv) continue;
				$prevf=$dia->fname; $preve=$dia->ienek; $prevv=$dia->ivers;
				echo "&nbsp;&nbsp;<a href=\"?page=dia&file=$dia->fname&enek=$dia->ienek&vers=$dia->ivers\">$dia->kotet:$dia->enek$dia->vszak</a>";
			}
			echo "</p>\n";
		}
	}

echo '</div>';	//DIAINDEX1
echo '</div>';	//MAIN_CONTENT_POS1

/////////////////////////////////////////////////////////////////////////////////

function ProcessFile($fname) {
global $dialst, $key, $pageid;
	
	$f = fopen('./downloads/enektarak/'.$fname,'r');
	if (!$f) {
		echo '<p>Error opening "', $fname, '" !!!</p>\n';
		return;
	}

	$rnev = substr($fname,0,strlen($fname)-4);
	$firstline=""; $enekszam=""; $diaszam=""; $ienek=0; $ivers=0;
	while (!feof($f)) {
		$txt=fgets($f);
		if (empty($txt)) continue;
		switch($txt[0]) {
		case 'R':
			$rnev=trim(substr($txt,1));
			continue;
		case '>':
			$ienek++; $ivers=0;
			$enekszam=trim(substr($txt,1));
			$firstline=""; $diaszam="";
			continue;
		case '/':
			$ivers++;
			$diaszam=trim($txt); $firstline="";
			continue;
		case ' ':
			if (empty($enekszam) || !empty($firstline)) continue;
			$firstline=UnEscape($txt);
			if ($pageid=="words") {
				foreach(explode(" ",$firstline) as $txt) {
					if (mb_strlen($txt)<4) continue;
					$txt=CleanTxt($txt);
					if (mb_strlen($txt)>=4) AddDia($txt, $fname, $rnev, $enekszam, $diaszam, $ienek, $ivers);
				}
				$firstline="";
			} else {
				$firstline=CleanTxt($firstline);
				if (!empty($firstline))
					AddDia($firstline, $fname, $rnev, $enekszam, $diaszam, $ienek, $ivers);
			}
		}
	}
	fclose($f);
	
}

function AddDia($txt, $fname, $kotet, $enek, $vszak, $ie, $iv) {
global $dialst, $key;
	$unacc=mb_strtoupper(remove_accents($txt), 'UTF-8');
	$ch0=substr($unacc,0,1);
	if ($ch0==$key || ($key=='others' && ($ch0<'A' || $ch0>'Z'))) {
		if (!isset($dialst[$unacc]))
			$dialst[$unacc]=array();
		$rec = new DataRecord();
		$rec->txt=$txt;
		$rec->fname=$fname;
		$rec->kotet=$kotet;
		$rec->enek=$enek;
		$rec->vszak=$vszak;
		$rec->ienek=$ie;
		$rec->ivers=$iv;
		array_push($dialst[$unacc], $rec);
	}
}

function UnEscape($txt) {
	$res=""; $escmode=0;
	for ($i=0; $i<strlen($txt); $i++) {
		$c=$txt[$i];
		if ($escmode==2) {
			if ($c==';') $escmode=0;
			continue;
		}
		if ($escmode==1) {
			if ($c=='?' || $c=='K' || $c=='G') {
				$escmode=2;
				continue;
			}
			if ($c=='\\' || $c==' ') {
				$res .= $c;
			}
			$escmode=0;
			continue;
		}
		if ($c == '\\') {
			$escmode=1;
			continue;
		}
		$res .= $c;
	}
	
	return $res;
}

function CleanTxt($txt) {
	$p1=0; $p2=mb_strlen($txt);
	while ($p1<$p2 && mb_strpos(' \t-*):.+/…–|’(\"„”“",;!?0123456789', mb_substr($txt,$p1,1))!==false) $p1++;
	while ($p1<$p2 && mb_strpos(' \t-*):.+/…–|’(\"„”“",;!?0123456789', mb_substr($txt,$p2-1,1))!==false) $p2--;
	return mb_substr($txt,$p1,$p2-$p1);
//	$modi=false;
//	do {
//		$modi=false;
//		$ch=mb_substr($res,0,1);
//		if ($ch=='-' || $ch=='*' || $ch==')' || $ch==':' || $ch=='.' || $ch=='+'
//			|| $ch=='/' || $ch=='…' || $ch=='–' || $ch=='|' || $ch=='' || $ch=='’'
//			|| $ch=='(' || $ch=='\"' || $ch=='„' || $ch=='”' || $ch=='“' || $ch==')' || $ch=='"'
//			|| ($ch>='0' && $ch<='9')
//		) {
//			$res=mb_substr($res,1);
//			$modi=true;
//		}
//		$ch=mb_substr($res,-1);
//		if ($ch=='-' || $ch=='*' || $ch==')' || $ch==':' || $ch=='.' || $ch=='+'
//			|| $ch=='/' || $ch=='…' || $ch=='–' || $ch=='|' || $ch=='' || $ch=='’'
//			|| $ch=='(' || $ch=='\"' || $ch=='„' || $ch=='”' || $ch=='“' || $ch==')' || $ch=='"'
//			|| $ch==',' || $ch==';' || $ch=='!' || $ch=='?'
//			|| ($ch>='0' && $ch<='9')
//		) {
//			$res=mb_substr($res,0,-1);
//			$modi=true;
//		}
//	} while($modi);
//	return $res;
}

function remove_accents($txt) {
global $replacement_chars;
    //if ( !preg_match('/[\x80-\xff]/', $txt) )
    //    return $txt;

    return strtr($txt, $replacement_chars);
}

/////////////////////////////////////////////////////////////////////////////////

function DTXList() {
	$dtxs=array();
	$files = scandir('./downloads/enektarak');
	foreach($files as $fname) {
		if (strtolower(substr($fname,-4)) != '.dtx') continue;
		$f = fopen('./downloads/enektarak/'.$fname,'r');
		if (!$f) {
			echo "<p>Error opening '$fname' !!!</p>\n";
			continue;
		}
		$longname=$fname;
		$grp=''; $sorrend="X";
		while (!feof($f)) {
			$txt=fgets($f);
			if ($txt!="") {
				$ch=$txt[0];
				if ($ch=='>' || $ch=='/') break;
				else if ($ch=='N') $longname=substr($txt,1);
				else if ($ch=='C') $grp=substr($txt,1);
				else if ($ch=='S') $sorrend=substr($txt,1);
			}
		}
		fclose($f);
		if (!isset($dtxs[$grp]))
			$dtxs[$grp]=array();
		$rec = new DataRecord();
		$rec->txt=$longname;
		$rec->fname=$fname;
		$dtxs[$grp][$sorrend.remove_accents($longname)]=$rec;
		//array_push($dtxs[$grp], $rec);
	}

	ksort($dtxs, SORT_STRING|SORT_FLAG_CASE);
	
	$idx=0;
	foreach($dtxs as $k => $g) {
		echo "<p>&#8594;&nbsp;&nbsp;<a href=\"#G$idx\">$k</a></p>";
		$idx++;
	}
	echo '<br/>';
	
	$idx=0;
	foreach ($dtxs as $k => $g) {
		echo "<p id=\"G$idx\">[$k]</p>\n";
		$idx++;
		ksort($g, SORT_STRING|SORT_FLAG_CASE);
		foreach ($g as $d) {
			echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href="?page=dtxs&file=', $d->fname, '">', $d->txt, '</a></p>\n';
		}
		echo '<br/>';
	}
}

function EnekList($fname) {
	$f=fopen("./downloads/enektarak/$fname","r");
	if (!$f) return;
	$prevenek=''; $vszak=''; $ie=0; $iv=0;
	while (!feof($f)) {
		$line=fgets($f);
		if (strlen($line)==0) continue;
		$ch=substr($line,0,1); $line=trim(substr($line,1));
		if ($ch==';') continue;
		if ($ch=='>') {
			$ie++; $iv=0;
			if ($prevenek>'') echo "<p>---- $prevenek ----</p>";
			$prevenek=$line; $vszak='';
		} else if ($ch=='/') {
			$iv++;
			if ($prevenek>'') echo "<p>$prevenek</p>";
			$prevenek=''; $vszak=$line;
		} else if ($ch==' ') {
			if ($prevenek>'') {
				echo "<p>$prevenek";
				if ($vszak=='') echo ' <a href="?page=dia&file=', $fname, '&enek=', $ie, '">(', UnEscape($line), ')</a>';
				echo '</p>';
				$prevenek='';
			}
			if ($vszak>'') {
				echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;', $vszak, ' <a href="?page=dia&file=', $fname,
					'&enek=', $ie, '&vers=', $iv, '">(', UnEscape($line), ')</a></p>';
				$vszak='';
			}
		}
	}
	fclose($f);
}

function GetDtxName($fname) {
	$f=fopen("./downloads/enektarak/$fname","r");
	if ($f) {
		while (!feof($f)) {
			$line=fgets($f);
			if (substr($line,0,1)=="N") { fclose($f); return trim(substr($line,1)); }
		}
		fclose($f);
	}
	return 'DTX:'.$fname;
}

/////////////////////////////////////////////////////////////////////////////////

function Dia($fname,$ie,$iv) {
	$f=fopen("./downloads/enektarak/$fname","r");
	if (!$f) return;
	echo '<span style="font-size: 2em; line-height: 1.5em">';

	while (!feof($f)) {
		$line=fgets($f);
		if (empty($line)) continue;
		$ch=substr($line,0,1);
		if ($ch=='>') {
			$ie--;
			if ($ie<0) break;
		} else if ($ch=='/') {
			if ($ie==0) {
				$iv--;
				if ($iv<0) break;
			}
		} else if ($ch==' ') {
			if ($ie==0 && $iv==0) {
				DiaPrint(substr($line,1));
			}
		}
	}
	fclose($f);
	echo '</span>';
}

function GetDiaName($fname,$ie,$iv) {
	$f=fopen("./downloads/enektarak/$fname","r");
	if (!$f) return $fname;
	$nev=''; $enek=''; $vers='';
	while (!feof($f)) {
		$line=fgets($f);
		if (empty($line)) continue;
		$ch=substr($line,0,1);
		if ($ch=='N') {
			if (empty($nev)) $nev=trim(substr($line,1));
		} else if ($ch=='R') {
			$nev=trim(substr($line,1));
		} else if ($ch=='>') {
			$ie--;
			if ($ie<=0) {
				$enek=trim(substr($line,1));
				if ($iv<=0) break;
			}
		} else if ($ch=='/') {
			if ($ie<=0) {
				$iv--;
				if ($iv<=0) {
					$vers=$line;
					break;
				}
			}
		}
	}
	fclose($f);
	if (empty($nev)) return $fname;
	return "<a href=\"?page=dtxs&file=$fname\">$nev</a>: $enek$vers";
}

function DiaPrint($txt) {
	$res=""; $escmode=0; $bd=false; $ul=false; $it=false;
	for ($i=0; $i<strlen($txt); $i++) {
		$c=$txt[$i];
		if ($escmode==2) {
			if ($c==';') $escmode=0;
			continue;
		}
		if ($escmode==1) {
			if ($c=='?' || $c=='K' || $c=='G') {
				$escmode=2;
				continue;
			}
			switch($c) {
			case '\\':
			case ' ':
				$res .= $c;
				break;
			case 'B':
				if (!$bd) $res.='<b>';
				$bd=true;
				break;
			case 'b':
				if ($bd) $res.='</b>';
				$bd=false;
				break;
			case 'U':
				if (!$ul) $res.='<u>';
				$ul=true;
				break;
			case 'u':
				if ($ul) $res.='</u>';
				$ul=false;
				break;
			case 'I':
				if (!$it) $res.='<i>';
				$it=true;
				break;
			case 'i':
				if ($it) $res.='</i>';
				$it=false;
				break;
			}
			$escmode=0;
			continue;
		}
		if ($c == "\\") {
			$escmode=1;
			continue;
		}
		$res .= $c;
	}
	if ($bd) $res.='</b>';
	if ($ul) $res.='</u>';
	if ($it) $res.='</i>';

	echo "<p>$res</p>";
}

?>
