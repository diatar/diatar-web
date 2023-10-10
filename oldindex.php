<?php
    error_reporting (E_ERROR|E_WARNING|E_PARSE); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="CSS/DESIGN_FRAME.css" />
        <link rel="stylesheet" type="text/css" href="CSS/SIDEMENU.css" />
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
    </head>
    <body>
        <?php include_once("analyticstracking.php") ?>
        <center>
            <div class="FRAME">
                <div class="FRAME_TOP"></div>
                <div class="FRAME_MIDDLE">
                    <div class="CONTENT_POSITIONER">
                        <div class="FLASH_HEADER">
                            <embed src="./imagerotator/imagerotator.swf" width="770" height="200" allowscriptaccess="always" allowfullscreen="true" flashvars="file=./imagerotator/imagerotator.xml&transition=random&overstretch=true&shownavigation=false&usefullscreen=false" />
                        </div>
                        
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
                                $menu["miertis"] = array
                                                (
                                                    "page" => "miertis",
													"txt" => "Miért is?",
                                                    "selected" => false
                                                );
                                $menu["ismerteto"] = array
                                                (
                                                    "page" => "ismerteto",
													"txt" => "Ismertetők",
                                                    "selected" => false
                                                );                
                                $menu["gyik"] = array
                                                (
                                                    "page" => "forum&f=10",
													"txt" => "GYIK (FAQ)-fórum",
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
                        <div class="MAIN_CONTENT">
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
                                    case "uzenetkuldes":
                                                include("uzenetkuldes.php");
                                                break;
                                    default:
                                                include("ujdonsagok.php");
                                }                                
                            ?>
                        </div>
                        <div class="POWEREDBY">
                            <div class="counter_pos" onmouseover="createPopupFromObject(this,'Az eddigi látogatók száma')" 
                                                     onmouseout="delayedMouseoutDestroy(event)">
                                <a href="https://www.mystat.hu/query.php?id=124431" target="_blank">
                                    <script language="JavaScript" type="text/javascript" src="https://stat.mystat.hu/stat.php?h=4&amp;id=124431">
                                    </script>
                                </a>
                                <noscript>
                                    <a href="https://www.mystat.hu/query.php?id=124431" target="_blank">
                                        <img src="https://stat.mystat.hu/collect.php?id=124431&amp;h=4" alt="mystat" border="0" />
                                    </a>
                                </noscript>
                            </div>
                        </div>
                    </div>                                        
                </div>
                <div class="FRAME_BOTTOM">
                    <div class="CPY">
                        Copyright &copy; Diatar 2010
                    </div>
                </div>
            </div>
        </center>
        <!--<a href="index.php?page=letoltesek#DIATAR">Ugorj a diatar-hoz</a>-->
    </body>
</html>
