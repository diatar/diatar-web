<?php
    error_reporting (E_ERROR|E_WARNING|E_PARSE); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="CSS/DESIGN_FRAME.css" />
        <link rel="stylesheet" type="text/css" href="CSS/SIDEMENU.css" />
		<link rel="stylesheet" type="text/css" href="CSS/ROTATOR.css" />
        <link rel="stylesheet" type="text/css" href="CSS/LAYOUT_2_SIDES.css" />
        <link rel="stylesheet" type="text/css" href="CSS/contact.css" />
        <title>Diatar - Templomi énekvetítő rendszer</title>
        
        <link rel="shortcut icon" href="../graphics/Diatar.ico"/>
        
        <script language="javascript" type="text/javascript" src="JS/POPUP_V9.js"></script>
        <script language="javascript" type="text/javascript" src="JS/GENERAL.js"></script>
        <script language="javascript" type="text/javascript" src="JS/contact.js"></script>
        <script src="JS/lib/prototype.js" language="javascript" type="text/javascript"></script>
        <script src="JS/src/scriptaculous.js?load=effects,builder" language="javascript" type="text/javascript"></script>
        <script src="JS/src/unittest.js" language="javascript" type="text/javascript"></script>

        

        <meta name="title" content="Diatar" />
        <meta name="keywords" content="Diatár, diatar, Diatar, énekvetítés, enekvetites, liturgikus szövegek vetítése, szovegvetites,
                templom, imaház, gyülekezet, támogat, támogatja, enekrend, énekrend, 
                Templomi enekvetites, enekvetites, énekvetítési megoldások, diavetítés, Diavatites a templomban, Diavetítés a templomban,
                Énekvetítés a templomban, népénektár, Szent vagy Uram, SzVU, Dícsérjétek az Urat, DU, Taize, Kék könyv, Sárga könyv, Éneklő Egyház,
                Keresztút, Zöld könyv, Szentkúti énekek, Erdélyi gyűjtés, Harmatozzatok, Imaórák,
				Adventista, Metodista, Baptista, protestáns,
                Diaprojection, Church lirics, Worship" />
        <meta name="description" lang="" content="Digitális énekvetítési megoldás templomoknak, gyülekezeteknek, énekvetítő program, templom,  
                    énekvetítés" />
        <meta name="robots" content="index, follow" />

<script type="text/javascript">
 
function waitMsg()
{
	var bg = document.getElementById('waitdiv').style.background;
	document.getElementById('waitdiv').style.background='gray';
	var t=setTimeout("document.getElementById('waitdiv').style.background='" + bg + "';",3000);
}
 
</script>

    </head>
    <body>
        <center>
            <div class="FRAME">
                <div class="FRAME_TOP"></div>
                <div class="FRAME_MIDDLE">
                    <div class="CONTENT_POSITIONER">
						<?php include("rotator.php") ?>
                        
                        <div class="menu_cont">                                                 
                            <?php
                                $PAGE = $_REQUEST['page'];
                                $menu = array();
                                $menu["missio"] = array
                                                (
                                                    "page" => "missio",
													"txt" => "Misszió",
                                                    "selected" => false
                                                );
                                $menu["miisez"] = array
                                                (
                                                    "page" => "miisez",
													"txt" => "Mi is ez?",
                                                    "selected" => false
                                                );
                                //$menu["miertis"] = array
                                //                (
                                //                    "page" => "miertis",
								//					"txt" => "Miért is?",
                                //                    "selected" => false
                                //                );
								$menu["dtxs"] = array
												(
													"page" => "dtxs",
													"txt" => "Énektárak",
													"selected" => false
												);
                                $menu["ismerteto"] = array
                                                (
                                                    "page" => "ismerteto",
													"txt" => "Ismertetők",
                                                    "selected" => false
                                                );                
                                //$menu["gyik"] = array
                                //                (
                                //                    "page" => "forum&f=10",
								//					"txt" => "GYIK (FAQ)-fórum",
                                //                    "selected" => false
                                //                );
								$menu["gdpr"] = array
												(
													"page" => "gdpr",
													"txt" => "Adatvédelem",
													"selected" => false
												);
                                $menu["english"] = array
                                                (
                                                    "page" => "english",
													"txt" => '<img src="/graphics/english_flag.gif" class="flag"/>English',
                                                    "selected" => false
                                                );
                                $menu["ujdonsagok"] = array
                                                (
                                                    "page" => "ujdonsagok",
													"txt" => "Újdonságok",
                                                    "selected" => false
                                                ); 
                                                                
                                $menu["letoltesek"] = array
                                                (
                                                    "page" => "letoltesek",
													"txt" => "Letöltés",
                                                    "selected" => false
                                                );                
                                                                 
                                $menu["segitene"] = array
                                                (
                                                    "page" => "segitene",
													"txt" => "Segítene?",
                                                    "selected" => false
                                                );
                                
                                $menu["tutorials"] = array
                                                (
                                                    "page" => "tutorials",
													"txt" => "Bemutatók (tutorials)",
                                                    "selected" => false
                                                );
                                                
                                $menu["impressum"] = array
                                                (
                                                    "page" => "impressum",
													"txt" => "Impressum/Linkek",
                                                    "selected" => false
                                                );
                                                                                
                                $menu["forum"] = array
                                                (
                                                    "page" => "forum",
													"txt" => "Fórum",
                                                    "selected" => false
                                                );
                               if(isset($PAGE))
                               {
                                    if(isset($menu[$PAGE]))
                                        $menu[$PAGE]["selected"] = true;
                               }
                               else
                               {
                                    $menu['ujdonsagok']["selected"] = true;
                               }

                               foreach($menu as $tag => $cont)
                               {
									echo '<div class=' . ( $cont['selected'] ? "menu_tab_sel" : "menu_tab" ) . '>';
										echo '<a href="?page=' . $cont['page'] . '" class="menulink">' . $cont['txt'] . '</a>';
									echo '</div>';
                               }
                            ?>                        
                            
                        </div>
                        <div class="MAIN_CONTENT" id="waitdiv">
                            <?php
                                switch($PAGE)
                                {
                                    case "letoltesek":
                                                include("letoltesek.php");
                                                break;
                                    case "forum":
                                                include("forum.php");
                                                break;
                                    case "segitene":
                                                include("segitene.php");
                                                break;
                                    case "english":
                                                include("english.php");
                                                break; 
                                    case "fejlesztesmenet":
                                                include("fejlesztesmenet.php");
                                                break; 
                                    case "miisez":
                                                include("miisez.php");
                                                break; 
                                    case "miertis":
                                                include("miertis.php");
                                                break;
                                    case "diatar_templom":
                                                include("diatar_templom.php");
                                                break;  
                                    case "ismerteto":
                                                include("ismerteto.php");
                                                break; 
                                    case "tutorials":
                                                include("tutorials.php");
                                                break; 
                                    case "segitok":
                                                include("segitok.php");
                                                break;  
                                    case "zene":
                                                include("zene.php");
                                                break;
                                     case "impressum":
                                                include("Impressum.php");
                                                break;
                                     case "missio":
                                                include("missio.php");
                                                break;
									case "gdpr":
												include("gdpr.php");
												break;
                                    case "uzenetkuldes":
                                                include("uzenetkuldes.php");
                                                break;
									case "firstlines":
									case "words":
									case "dtxs":
									case "dia":
												include("diaindex.php");
												break;
                                    default:
											if (isset($_REQUEST['subpage']))
												include("regisegek.php");
											else
                                                include("ujdonsagok.php");
                                }                                
                            ?>
                        </div>
                    </div>                                        
                </div>
                <div class="FRAME_BOTTOM">
                    <div class="CPY">
                        Copyright &copy; Diatar 2010-2024
						<a href="?page=gdpr">Adatvédelem</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </center>
    </body>
	
</html>
