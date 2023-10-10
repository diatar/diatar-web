<?php


    if(isset($_REQUEST['oldal']))
    {
        $URL=urldecode($_REQUEST['oldal']);
        
        $magas=urldecode($_REQUEST['magassag']);
                
    }
    else
    {
        $magas="0";
    }
?>


<div class="text">
    <div id="szoveg"  <?php if(isset($_REQUEST['oldal'])) echo ('style="display:none;"')?> >
        <div class="expanded">   
            <p>
            <a href="Diatar.pps">Itt letölthető és megnézhető</a> egy kis ismertető a  programról (PowerPoint 2003 bemutató).
            </p>
        </div>
        
        <div class="expanded" style="display: block" >
            Ha nem szeretné vagy nem tudja letölteni, vagy nincs PowerPoint megjelenítő (PowerPoint Viewer) a gépén, képként közvetlenül 
            <a href ="javascript:open_slideshow('pps/p1.html',600)">itt is megnézheti</a>
        </div>
        
        <div class="expanded" style="display: block; text-indent: 0;">
        <ul>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>ANDROID</mark></strong>
                <a target="blank" href="Android/androidkutyu.html">Így működhet az Android-alapú vetítés</a>. 'afo'-nak köszönjük a leírást!
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>BLUETOOTH</mark></strong>
				<a target="blank" href ="Bluetooth_vez/Diatár vezérlése okostelefonról.htm">Almásy András bluetooth-alapú távvezérlést készített.</a>
				Ezzel egy mobiltelefonnal és egy mikrovezérlővel bluetooth kapcsolaton keresztül lehet léptetni a Windows-os Diatár programot.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>BAJA</mark></strong>
				<a href ="javascript:open_slideshow('BajaBaratok/p1.html',600)">Baján egészen összetett rendszer készült: </a>
				Youtube közvetítés keverőjébe is be van kötve a Diatár.
				Vinkó Zoli szívesen segít, válaszol a felmerülő kérdésekre is (elérhetőségek az ismertetőben).
            </p>
            </li>
			<li>
            <p style="margin-bottom: 4px;">    
				<strong><mark>ÜRÖM</mark></strong>
                 2019-ben az <b>ürömi Szent György vértanú</b> templomban
                is kiépült a vetítés, elküldték a működő rendszer
                <a target="_self" href="Urom/urom.php">ismertetőjét</a>,
                amelyet nagy örömmel és köszönettel teszünk közzé.
            </p>
			</li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>MÁTYÁSFÖLD</mark></strong>
                <a href="javascript:open_slideshow('diatar_templom.php',1520)"> Tekintse meg itt</a>, 
                 hogyan fejlesztettük ki a rendszert Budapesten a <b> Mátyásföldi Szent József </b> templomban.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">    
				<strong><mark>NAGYBÁNYA</mark></strong>
                Krucz János a <b>nagybányai Krisztus Király</b> plébániáról elsőként készítette el saját rendszerük ismertetőjét mások okulására és segítségére.
                <a target="_self" href="Veresviz/Veresviz_J.html">Itt olvasható</a> a képekkel és sok hasznos információval tűzdelt leírás.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>MOHÁCS</mark></strong>
                <a href="javascript:open_slideshow('diatar_mohacs.php',1820)"> Itt megnézhető</a>
                 a Mohácson, a <b> Magyarok Nagyasszonya </b> templomban kialakított rendszer, Szűcs Barna jóvoltából.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>ALBERTIRSA ÉS CEGLÉDBERCEL</mark></strong>
                Elkészült az <b>Albertirsán és Ceglédbercelen</b> üzembeállított rendszer bemutatója is sok képpel. 
                Két eltérő környezet, két eltérő megvalósítás. <a target="blank" href="Albertirsa/Albertirsa.html">Itt megnézhető</a>.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">    
				<strong><mark>TISZABERCEL</mark></strong>
                <b>Tiszabercel</b> kántorától, Natkó Zoltántól is kaptunk egy értékes ismertetőt. Köszönet érte.
                Az általuk kiépített rendszer bemutatását, szíves engedelmével 
                <a target="_self" href="Tiszabercel/Tiszabercel.html">itt is közzétesszük</a>.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">    
				<strong><mark>FELSŐGÖD</mark></strong>
                 Veres Mihálytól, a <b>felsőgödi Jézus Szíve Plébánia</b> mellett működő 
                "Bozóky Gyula Alapítvány" Kuratóriumi elnökétől is kaptunk egy érdekes beszámolót, amit szíves engedelmével
                <a target="_self" href="Felsogod/Felsogod.html">közzéteszünk</a>. 
                Ez is egy mevalósítási változat, reméljük másoknak is tanulságos, segíthet kialakítani egy saját renndszert.
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">    
				<strong><mark>BUDAPEST RÁKOSHEGY</mark></strong>
                 Sajó Józseftől kaptunk egy érdekes leírást (nem most kezdték, de mostanra alakult ki a végső megoldás).<br />
                 A rákoshegyi (Budapest) <b>"Lisieux-i Szent Teréz"</b> plébánián kialakított rendszert mutatja be.
                 Nem kevés erőfeszítésbe került a kialakítás. <br />
                 Nem használnak vetítővásznat, hanem egyenesen a falra vetítenek.
                 Gondot jelentett az is, hogy csak egy gépet használnak, és a videójelet nagy távolságra kellett eljuttatni.
                 De erre is találtak megoldást.<br />
                 VGA-UTP átalakító segítségével, UTP kábelen át viszik el a jelet a vetítőhöz.<br /> 
                 Gyakorlatilag a műszaki megoldásokból semmi sem látszik. Minden rejtve van, a hívek csak a kivetített képet élvezik.<br />
                 Briliáns megvalósítás.<br />                            
                <a target="_self" href="Rakoshegy/Rakoshegy.html">Itt megnézhető</a>. a megoldás. 
                Nem kis munka volt. Köszönjük, hogy megosztotta velünk az ötleteket. Talán másoknak is használható ötleteket tehetünk így közzé! 
            </p>
            </li>
            <li>
            <p style="margin-bottom: 4px;">
				<strong><mark>BRASSÓ-BOLONYA</mark></strong>
                Adi Istvántól, a Brassó-bolonyai (Románia)<b>"Jézus Szentséges Szive"</b> plébánián kialakított rendszeről kaptuk az alábbi bemutatót.
                Köszönjük.
                Korlátozott lehetőségeik ellenére, sikerült működő rendszert összeállítaniuk.
                Vetítővásznat ők sem használnak, a falra vetítenek.
                <a target="_self" href="Brasso/Brasso_Hu.html">A magyar nyelvü leírás itt olvasható</a>.<br />
                Szintén István munkája a <a target="_blank" href="./letoltes.php?letoltes=./downloads/enektarak/Roman.zip">
                    teljes román nyelvű énektár</a> elkészítése. Külön köszönet érte! <br />
               <i>
                Adi Ștefan, de la parohia <b>"Preasfânta Inimă a lui Isus"</b> din Brașov – Blumăna ne-a trimis următoarea prezentare.
                Mulțumim.
                În pofida posibilităților limitate au reușit să construiască un sistem funcțional.
                Nu folosesc ecran, proiecția se realizează direct pe peretele din stânga altarului.
                <a target="_self" href="Brasso/Brasso_Ro.html">Puteți citi prezentarea în limba româna aici.</a>.<br />
                De asemenea <a target="_blank" href="./letoltes.php?letoltes=./downloads/enektarak/Roman.zip">
                    întreaga colecție a cântecelor în limba româna</a> este opera lui Ștefan. Mulțumim!
               </i>
            </p>
            </li>
        </ul>  
        </div>
    </div>

    <div id="slideshow" class="slide_show">
        <center>  
        <div id="vege" style="display: none;"><a href ="javascript:close_slideshow()"> Vége </a></div>
		<br/>
        </center>
        <iframe border="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="yes"  id="tutor_frame" 
		src=<?php echo $URL; ?>
        style="float:left;width:760px;height: <?php echo $magas; ?>px; margin:0px;border:0px;">
        
        Az ön böngészője nem kezeli az iframe-eket, <a href="/forum">ugrás a fórumra</a>     
        </iframe>
    </div>
    
            <script language="javascript" type="text/javascript">
                var frame = document.getElementById("tutor_frame");                 
                   var ele = document.getElementById("vege");
                   var ele1 = document.getElementById("szoveg");
                   var ele2 = document.getElementById("szoveg1")
                   var ele3 = document.getElementById("szoveg3")
                   //ele1.style.display = "none"; 
                            
                function open_slideshow (src,height)
                {                 
				   frame.src=src;
				   frame.height=height;
				   frame.width="760px";
                   document.getElementById("slideshow").appendChild(frame); 
                   ele.style.display = "block"; 
                   ele1.style.display = "none"; 
                }
                function close_slideshow()
                {
                    document.getElementById("slideshow").removeChild(frame);
                    ele.style.display = "none";
                    ele1.style.display = "block";
                   
                }
            </script>               
</div>
<!--  Eredeti
    <div class="text">
    <div id="szoveg" class="expanded" style="display: block" >   
        <p>
        <a href="Diatar.pps">Itt letölthető és megnézhető</a> egy kis ismertető a  programról (PowerPoint 2003 bemutató).
        </p>
    </div>
    
    <div id="szoveg1"  class="expanded" style="display: block" >
        Ha nem szeretné vagy nem tudja letölteni, vagy nincs PowerPoint megjelenítő (PowerPoint Viewer) a gépén, képként közvetlenül 
        <a href ="javascript:open_slideshow('pps/p1.html',600)">itt is megnézheti</a>
    </div>
    <div id="slideshow">
            <center>  
            <div id="vege" style="display: none;"><a href ="javascript:close_slideshow()">  Vege  </a></div>
            </center>
    </div>
    
    <div id="szoveg3"  class="expanded" style="display: block;">
        <p style="margin-bottom: 4px;">
            <a href="?page=diatar_templom"> Tekintse meg itt</a>, saját plébániánkon hogyan fejlesztettük ki a rendszert.
        </p>

        <p style="margin-bottom: 4px;">    
            Krucz János a nagybányai Krisztus Király plébániáról elsőként készítette el saját rendszerük ismertetőjét mások okulására és segítségére.
            <a target="_self" href="Veresviz/Veresviz_J.html">Itt olvasható</a> a képekkel és sok hasznos információval tűzdelt leírás.
        </p>
        <p style="margin-bottom: 4px;">
            Elkészült az Albertirsán és Ceglédbercelen üzembeállított rendszer bemutatója is sok képpel. 
            Két eltérő környezet, két eltérő megvalósítás<a target="blank" href="Albertirsa/Albertirsa.html">itt megnézhetõ</a>.
        </p>
    </div>
    
            <script language="javascript" type="text/javascript">
                var frame = document.createElement("IFRAME");
                   frame.border="0";
                   frame.frameborder="0";
                   frame.marginheight="0";
                   frame.marginwidth="0";
                   
                   frame.scrolling="no";
                   frame.marginwidth="0";
                   frame.marginwidth="0";
                   frame.src="pps/p1.html";     
                   frame.style.width="760px";
                   frame.style.height="600px";
                   frame.style.margin="0px";
                   frame.style.border="0px";
                   frame.style.cssFloat="left";
                   frame.style.zoom="100%";
                   
                   var ele = document.getElementById("vege");
                   var ele1 = document.getElementById("szoveg");
                   var ele2 = document.getElementById("szoveg1")
                   var ele3 = document.getElementById("szoveg3")
                function open_slideshow (src,height)
                {                 
                   document.getElementById("slideshow").appendChild(frame); 
                   ele.style.display = "block"; 
                   ele1.style.display = "none"; 
                   ele2.style.display = "none";  
                   ele3.style.display = "none";         
                }
                function close_slideshow()
                {
                    document.getElementById("slideshow").removeChild(frame);
                    ele.style.display = "none";
                    ele1.style.display = "block";
                    ele2.style.display = "block";
                    ele3.style.display = "block";
                }
            </script>               
</div>
-->
