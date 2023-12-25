<?php 
    $SUBPAGE = $_REQUEST['subpage'];
		switch($SUBPAGE) {
			case "programok":
			case "enektarak":
			case "zene":
			case "android":
			case "others":
			case "diatar":
			case "korabbi":
				break;
			default:
				$SUBPAGE="diatar";
		}
?>
<div class="LEFT_SIDE">
    <div class="SIDEMENU">
        <div <?php if ($SUBPAGE=="diatar") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=diatar">
                DIATÁR TELJES RENDSZER
            </a>
        </div>
        <div <?php if ($SUBPAGE=="programok") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=programok">
                VERZIÓ FRISSÍTÉS
            </a>
        </div>
        <div <?php if ($SUBPAGE=="korabbi") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=korabbi">
                KORÁBBI VERZIÓK
            </a>
        </div>
        <div <?php if ($SUBPAGE=="enektarak") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=enektarak">
                ÉNEKTÁRAK
            </a>
        </div>
        <div <?php if ($SUBPAGE=="zene") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=zene">
                ZENEKÍSÉRETEK
            </a>
        </div>
        <div <?php if ($SUBPAGE=="android") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=android">
                ANDROID
            </a>
        </div>
        <div <?php if ($SUBPAGE=="others") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=others">
                MINDEN MÁS
            </a>
        </div>   
    </div>
    <div class="COMMENT_BOX">
        <div class="COMMENT_BOX_TITLE">
            A GNU-GPLv3 licenc
        </div>
        <div class="COMMENT_BOX_CONTENT">
            <img src="/graphics/gnu_gpl_logo_small.jpg" class="COMMENT_LOGO" />
            <p>        
                A programra GNU-GPLv3 licenc érvényes azaz szabadon terjeszthető, és szabadon módosítható, de a terjesztései és a módosítások kötelezően szintén GPL licenc alatt kell,
                hogy megjelenjenek, így biztosítva, hogy a szabad tartalmakból készült bármilyen származékos mű is szabad maradjon.
                Lásd:<a target="blank" href="http://www.gnu.org/licenses/licenses.html">http://www.gnu.org/licenses/licenses.html</a>.
            </p>
            <p>
                A teljes forráskód letölthető <a href="./downloads/diatar-source.zip">innen</a>, a csomagban található a COPYING file, mely a GPL licenc pontos szövege.
                Lazarus 1.6.2 verzióval készült, kell még hozzá az <a target="blank" href="http://wiki.lazarus.freepascal.org/lNet">lNet</a> csomag, mely a hálózati kommunikációban segít.
            </p>
        </div>
    </div>
</div>
<div class="RIGHT_SIDE">
    <div class="L2_SUBHEADER">
    <?php
        switch($SUBPAGE)
        {
            case "programok":
                                echo "VERZIÓ FRISSÍTÉS";
                                break;
            case "enektarak":
                                echo "ÉNEKTÁRAK";
                                break;     
						case "korabbi":
																echo "KORÁBBI VERZIÓK";
																break;
            case "zene":
                                echo "ZENEKÍSÉRETEK";
                                break;
			case "android":
																echo "ANDROID VERZIÓ";
																break;
            case "others":
                                echo "MINDEN MÁS";
                                break;
            case "diatar":
            default:
                                echo "DIATÁR TELJES RENDSZER";
        }
    ?>    
    </div>
    
    <div class="L2_CONTENT">
        <?php        
            switch($SUBPAGE)
            {
                case "programok": 
                    ?>
                    <!-- Programfrissites-->
                    <?php
						include("includes/frissites.php");
                    break;
                case "korabbi": 
                    ?>
                    <!-- korábbi verziók -->
                    <?php
						include("includes/oldversions.php");
                    break;
                case "enektarak":
                                    ?>
                     <!-- Enektarak -->
                    <?php
						include("includes/enektarak.php");
                    break;
                case "others":
                    ?>
                   <!--  Minden mas -->
                        <div class="RIGHT_TABLE TABLE_ENTRY_ODD">
                            <div class="RIGHT_TABLE_LEFT">
                                <div class="download_link expanded">
                                    <a href="https://github.com/diatar" target="_blank">Forráskód</a>
                                </div>
                            </div>
                            <div class="RIGHT_TABLE_RIGHT">
                                <div class="TABLE_TEXT expanded">
                                    <p>
                                    A program teljes forráskódja, Elek László SJ jóvoltából a githubon.
                                    </p>
                                </div>
                            </div>
                        </div>

<!-- Mátyásföldi diák -->
                        <div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
                            <div class="RIGHT_TABLE_LEFT">
                                <div class="download_link expanded">
                                    <a href="/downloads/diak.zip">Mátyásföldi diák </a>
                                </div>
                            </div>
                            <div class="RIGHT_TABLE_RIGHT">
                                <div class="TABLE_TEXT expanded">
                                    <p>
                                    Évközi vasárnapok és a főbb ünnepek. Ezek a Mátyásföldi Plébánián használt énekrendek.
                                    Minden különösebb szerkesztés vagy javítás nélkül adjuk közre nem a teljesség igényével,
                                    inkább kiindulási alapul szolgálhat a saját énekrendek kialakításához.
                                    Jól látható belőlük, hogy gyakran több alkalomra való ének van összegyűjtve, és szertartás
                                    közben egyszerűen átugorjuk az éppen nem kellő részeket (pl. Májusi litániák).
                                    Új énekrend kialakításához az "_allando_reszek" nevű fájlból szoktunk kiindulni.
                                    </p>
                                </div>
                            </div>
                        </div>
										<div><br/></div>

<!-- Scrollock segedprogram -->
                    <div class="RIGHT_TABLE TABLE_ENTRY_ODD">
                        <div class="RIGHT_TABLE_LEFT">
                            <div class="download_link expanded">
                                <a href="/downloads/ScrollocEmulSetup.exe">Scroll Lock Emulátor </a>
                            </div>
                        </div>
                        <div class="RIGHT_TABLE_RIGHT">
                            <div class="TABLE_TEXT expanded">
                                <p>
                                    Ott Gergelytől kaptunk egy hasznos segédprogramot azok részére, akiknek a gépéről
                                    hiányzik a Scroll Lock billenyű. Egy rövid, de tartalmas ismertető
                                    <a href="/downloads/ScrollocEmulKezelesi.txt" target="_blank">Innen letölthető!</a>
                                </p>
                            </div>
                        </div>
                    </div>
										<div><br/></div>

<!-- Scrollock segedprogram -->
                    <div class="RIGHT_TABLE TABLE_ENTRY_ODD">
                        <div class="RIGHT_TABLE_LEFT">
                            <div class="download_link expanded">
                                <a href="/downloads/TanuljunkEnekelni.zip">Tanuljunk énekelni! </a>
                            </div>
                        </div>
                        <div class="RIGHT_TABLE_RIGHT">
                            <div class="TABLE_TEXT expanded">
                                <p>
                                    A tartalmas összeállítást Robibácsi készítette és ajánlotta fel terjesztésre (elérhetőség az anyagban).
									Számos különböző egyházi éneket tartalmaz kottával, lejátszható MUS fájlokban
									(a Finale program ingyenes változatával használható).
									A telepítésről, használatról, a tanulás lehetőségéről részletes információk találhatók a csomagban.
									Ha valaki további énekeket lekottáz, szívesen frissítjük az anyagot!
                                </p>
                            </div>
                        </div>
                    </div>
										<div><br/></div>

<!--  Kották -->
                        <?php
                            include ("includes/kottak.php");
						?>

<!-- Beta verziok -->
                        <?php
                            include ("includes/betaverziok.php");                
                        break;

				case "android": 
                    ?>
                    <!-- Android verzio -->
                      <?php
							include ("includes/android.php");
                    break;

					case "zene":
                   ?>
                       
                    <!-- Zenekiseretek -->
						<?php
							include ("includes/zenek.php");
                    break;
					
                case "diatar":
                default:
                        ?>
                        <!-- Program letoltesek (Teljes rendszer) -->
						<?php
							include ("includes/teljesprogram.php");
                                    
            }
        ?>
    </div>
</div>
