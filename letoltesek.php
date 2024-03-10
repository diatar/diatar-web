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
                DIATÁR WIN/LINUX
            </a>
        </div>
        <div <?php if ($SUBPAGE=="programok") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=programok">
                &nbsp;&nbsp;VERZIÓ FRISSÍTÉS
            </a>
        </div>
        <div <?php if ($SUBPAGE=="android") echo 'class="SIDEMENU_TAB_HIGHLIGHT"'; else echo 'class="SIDEMENU_TAB"'; ?> >
            <a class="SIDEMENU_LINK" href="?page=letoltesek&subpage=android">
                ANDROID VÁLTOZAT
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
                Lásd:<a target="blank" href="https://www.gnu.org/licenses/licenses.html">https://www.gnu.org/licenses/licenses.html</a>.
            </p>
            <p>
                A teljes forráskód letölthető <a href="https://github.com/diatar" target=_blank>a githubról</a>, a csomagban található a COPYING file, mely a GPL licenc pontos szövege.
                Lazarus 1.6.2 verzióval készült, kell még hozzá az <a target="blank" href="https://wiki.lazarus.freepascal.org/lNet">lNet</a> csomag, mely a hálózati kommunikációban segít.
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
				   <?php
					include("includes/letolt_mindenmas.php");
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
