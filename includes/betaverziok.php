<div class="BETA_CONTAINER">
    <div class="TABLE_TEXT expanded">
        Az utolsó "stabil" verziót követő, fejlesztési (Windows) változatok közül tölthető le innen néhány.
        FIGYELEM!!! Ezek fejlesztés közbeni állapotú, esetleges hibákkal terhelt programok,
        ezért kifejezetten <b>csak</b> tesztelési célból javasoljuk a letöltésüket, használatukat, semmiképpen sem "éles üzemben".<br />
        Ha viszont kedve, ideje van, próbálja ki, és jelezze
        (<a href="mailto:info@diatar.eu">email-ben</a>, vagy a <a href="?page=forum&f=11">fórumon</a>),
        ha valami rendellenességet, működési hibát talál. Előre is köszönjük!
		<br/>
		Az innen letölthető fájlok általában Windows végrehajtható (exe) állományok - esetenként Linux binárisok.
		Mindig tartalmazzák a verziószámot (ami a következő, majdan kiadandó végleges verziója lesz), és a béta sorszámát.
		Ezeket a fájlokat érdemes átnevezés nélkül bemásolni a program futtatási (telepítési) könyvtárába, az eredeti exe-k/binárisok mellé.
		A stabil, működő programot nem célszerű felülírni, amíg ki nem derül a béta verzió minden esetleges rejtett hibája.
		<br/><p>&nbsp</p>
    </div>

    <!-- paratlan sor -->
    <div class="BETA_CONTAINER_INT TABLE_ENTRY_ODD">
        <div class="BETA_VERSION">
            <b>&nbsp 2024.09.26 - Raspberry PI változatok</b>
            <hr />
        </div>                                                
        <div class="BETA_LEFT">
            <div class="download_link expanded">                                                                                                        
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar_12.7.2-3_armhf.deb');?>"><img style="border: none;" src="graphics/raspi.jpg"/> diatar_12.7.2-3_armhf.deb</a><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar_12.7.2-3_arm64.deb');?>"><img style="border: none;" src="graphics/raspi.jpg"/> diatar_12.7.2-3_arm64.deb</a><br/><br/>
            </div>
        </div>
        <div class="BETA_RIGHT">
            <div class="TABLE_TEXT expanded">
              <ul class="BETA_DOTTED">
                <li>
					Sikerült végre új RPI binárisokat előállítani, méghozzá külön 32/64 bites oprendszerre.
					A mellékelt telepítő a linuxos átirata, de az op.rendszerek hasonlósága miatt teljesértékűen működik.
					Lehet, hogy a menüből ("Hang és Videó" kategóriában) való futtatáshoz újra kell indítani a rendszert.
					<br/>
					Leírás a debian csomag telepítéséhez: <a href="https://diatar.eu/downloads/readmereader.php?file=1">README.Debian</a>
					Aki nem akar csomagot, csak a futtatható binárisok külön ezek:<br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/rdiatar');?>"><img style="border: none;" src="graphics/raspi.jpg"/>rdiatar</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/rdiatar64');?>"><img style="border: none;" src="graphics/raspi.jpg"/>rdiatar64</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/rdiaeditor');?>"><img style="border: none;" src="graphics/raspi.jpg"/>rdiaeditor</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/rdiaeditor64');?>"><img style="border: none;" src="graphics/raspi.jpg"/>rdiaeditor64</a><br/><br/>
                </li>
              </ul>
            </div>                                                    
        </div>                                                
    </div>

 
    <!-- paros sor -->
    <div class="BETA_CONTAINER_INT TABLE_ENTRY_EVEN">
        <div class="BETA_VERSION">
            <b>&nbsp 2024.05.12 - Zsolozsmázás újra</b>
            <hr />
        </div>                                                
        <div class="BETA_LEFT">
            <div class="download_link expanded">                                                                                                        
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar-v13.0-b2.exe');?>"><img style="border: none;" src="graphics/Diatar.ico"/> diatar.exe</a><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar64-v13.0-b2.exe');?>"><img style="border: none;" src="graphics/Diatar.ico"/> diatar64.exe</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/libeay32.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> libeay.dll</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/ssleay32.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> ssleay32.dll</a><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/libssl-1_1-x64.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> libssl-1_1-x64.dll</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/libcrypto-1_1-x64.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> libcrypto-1_1-x64.dll</a><br/>
            </div>
        </div>
        <div class="BETA_RIGHT">
            <div class="TABLE_TEXT expanded">
              <ul class="BETA_DOTTED">
                <li>
					A webes hozzáférés újra lett gondolva az előző béta verzió nehézségei miatt.
					Az egyszer már letöltött éveket megjegyzi, a fájlok a DTX-ek könyvtárába kerülnek,
					ami a diatar.ini-ben átírható egy új "BerviarDir=..." bejegyzéssel.
					Ez azt is lehetővé teszi, hogy "off-line" gépen (azaz internet-elérés nélkül)
					is lehessen a zsolozsmázást használni: kézzel letöltve a megfelelő fájlokat
					(<a href="https://breviar.sk/hu/download/main.htm" target=_blank>https://breviar.sk/hu/download/main.htm</a> címről az év-hu-plain ZIP változata kell).<br/>
					A webeléréshez OpenSSL 1.1 szükséges, a mellékelt DLL fájlokkal (az EXE mellé másolva) működik.
                </li>
              </ul>
            </div>                                                    
        </div>                                                
    </div>

    <!-- paratlan sor -->
    <div class="BETA_CONTAINER_INT TABLE_ENTRY_ODD">
        <div class="BETA_VERSION">
            <b>&nbsp 2024.04.13 - Zsolozsmázás</b>
            <hr />
        </div>                                                
        <div class="BETA_LEFT">
            <div class="download_link expanded">                                                                                                        
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar-v13.0-b1.exe');?>"><img style="border: none;" src="graphics/Diatar.ico"/> diatar.exe</a><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/diatar64-v13.0-b1.exe');?>"><img style="border: none;" src="graphics/Diatar.ico"/> diatar64.exe</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/libeay32.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> libeay.dll</a><br/><br/>
                <a href="letoltes.php?letoltes=<?php echo urlencode('/beta/ssleay32.dll');?>"><img style="border: none;" src="graphics/openssl.ico"/> ssleay32.dll</a><br/>
            </div>
        </div>
        <div class="BETA_RIGHT">
            <div class="TABLE_TEXT expanded">
              <ul class="BETA_DOTTED">
                <li>
					A webről, a zsolozsma.katolikus.hu (valójában breviar.sk) oldalról,
					az éves összeállításból próbálom letölteni az anyagot.<br/>
					Figyelem! A webeléréshez a mellékelt két DLL fájlra is szükség van!
					A [Betöltés] lenyíló listájában található a "Zsolozsma" menüpont.
					Minden segítséget, hibajelzést, javaslatot szívesen veszünk!
                </li>
              </ul>
            </div>                                                    
        </div>                                                
    </div>

 
    <!-- vege -->

</div>
