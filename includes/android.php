<div class="text expanded">
	<p>
		<b>v6.5 Android vezérlő és vetítő - Android alapú kivetítő applikációk okoskészülékekre</b>
	</p>
	<br/>
	<div class="iconed_title android_icon">
		<p><b>Letöltés a Google Play áruházból:</b></p>
	</div>
	<div class="text12">
		<center>
			<a target="_blank" href="https://play.google.com/store/apps/details?id=diatar.eu">Diatar</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a target="_blank" href="https://play.google.com/store/apps/details?id=com.polyjoe.DiaVetito">DiaVetito</a>
		</center>
	</div>
	<br/>

	<div class="iconed_title android_icon">
		<p><b>Közvetlen letöltés:</b></p>
	</div>
	<div class="text12">
	  <center>
		<a href="./downloads/android/Diatar.apk">Diatar.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito.apk">DiaVetito.apk</a>
		&nbsp;&nbsp;
		<a href="https://github.com/diatar/diatar-android" target="_blank">forráskód</a>
		<br/><br/>
	    <p><a href="#KORABBI">Korábbi verziók</a> a lap alján.</p>
		<p>Újabban a Play áruház AAB (bundle) formátumú telepítő csomagot követel meg.
		Amíg a fejlesztőkörnyezet lehetővé teszi, itt elérhető a közvetlenül telepíthető APK forma.</p>
		<p>A forráskód Elek László SJ jóvoltából már a githubon található.</p>
	  </center>
	</div>
	<br/><br/>

	<p>
		<a target="_blank" href="Android/androidkutyu.html">Leírás az androidos vetítés lehetőségeiről</a>
	</p>
	<br/>
	
	<p>
		Az új Google elvárásoknak megfelelve már nem APK, hanem AAB (bundle) fájlba van csomagolva a program.
		Az AAB fájlt nem lehet közvetlen telepítésre használni, ezért itt fentebb az APK típusú csomagot is közzétesszük.
		Természetesen elsősorban az Áruházból kell megpróbálni telepíteni, csak végső próba legyen az APK letöltése!
		Ezt magán az eszközön kell megnyitni, elindítani
		(közvetlen letöltésnél engedélyezni kell az áruházon kívüli telepítést).<br/>
		Mivel egyre több az Android alapú okostelefon, tablet, valamint kivetítő, smart-TV stb.,
		nő az igény arra, hogy a vezérlés, illetve a vetítés ilyen készülékeken lehetséges legyen.
		Az első applikáció (Diatar) az okostelefonra vagy tabletre alkalmas "vezérlő",
		amely képes a távoli kivetítést irányítani WiFi hálózaton keresztül,
		a DiaVetito pedig smart-TV-kbe való, csak vetítésre szolgál.
		A két applikáció megfelel a PC-s Diatar program /VEZERLO és /VETITO funkciójának
		(ld. a kétgépes vetítést a dokumentációban!).
	</p>
	<p>
		A 3.2 verziótól kezdve a verziószámozás egységes a két applikációra.
		Ezzel együtt mindkét alkalmazás együttműködik PCs (akár Windowsos, akár Linuxos) ellenoldallal is,
		tehát "vegyes", PC + okoskészülék összeállítás is készíthető.
	</p>
	<br/>
	<p>
		<b>Diatar</b>
		Első használatkor üres, de egyenesen az internetről letölti az énektárakat.
		(Ha nem tölti le önállóan, a Beállítások/Letöltés ablakában bármikor frissítés kérhető.)
		Összeállított énekrendeket is be lehet tölteni, sőt, kezdetleges összeállításra és .DIA mentésére is van már lehetőség.
	</p>
	<p>
		<b>DiaVetito</b>
		Képet és szöveget tud megjeleníteni, szövegméret, pozíció, szín stb. sokmindent tud már, folyamatos fejlesztés alatt.
		A képernyőt megérintve látható az IP cím és megadható a port.
	</p>

	<ul class="dotted">
		<li>
			6.5 verzió: az új Android OS korlátozza a közös könyvtárakhoz való hozzáférést, így a saját DTXeket másképp kell kezelni:
			a Beállítások/Program menüpont ablakában van egy DTX import nyomógomb, ezzel be lehet másolni egy fájlt,
			ami attól kezdve megjelenik a programban.
		</li>
		<li>
			6.4 verzió: dupla diák kezelése<br/>
			Egymás utáni két diát össze lehet kapcsolni egy képre, ha rövidek a szövegek.
			A szerkesztő ablakban egy kis zöldes kockára kell koppintani. A funkció kompatibilis a Win/Linux változatokkal.
		</li>
		<li>
			6.3 verzió: új Android policy szerinti fájlhozzáférés elkezdése
		</li>
		<li>
			6.2 verzió: Túl hosszú szó kilógásának javítása.<br/>
			Távoli gép leállítása. Ez a funkció PCs változatnál már régóta létezik, mostantól Androidon is működik.
			A vezérlő gépen egy új "Leáll" menüpont alatt a távoli vetítő programot vagy akár az eszközt le lehet állítani.
			A DiaVetito kepernyojere koppintva elojon a beallitas, ott is van leállítás és újraindítás gomb.
			Azt azonban tudni kell, hogy az Android op.rendszer biztonsági beállításai miatt
			ezeket a funkciókat csak úgynevezett "root"-olt készüléken lehet működtetni.
		</li>
		<li>
			6.1 verzió: Margók beállítása. PCs változatban a vezérlő gép küldi a vetítési margókat, de Android
			készüléken logikusabb, ha a vetítőn állítjuk be. Választható az opció a DiaVetítőben.
			A "minden szöveg vastagon szedett" opció is megjelenítésre kerül.
		</li>
		<li>
			6.0 verzió: Vetített kép tükrözése, forgatása. Ez a funkció a PCs változatban régóta elérhető,
			mostantól itt is elérhető az állítva és/vagy hátulról vetítő projektorokhoz szükséges támogatás.
			A DiaVetito képernyőjére koppintva előjön a beállító ablak, melyben a tükrözés és a 0-90-180-270
			fokos forgatás szabadon megadható.
		</li>
		<li>
			5.5 verzió: Triolák és pentolák megjelenítési lehetősége.
			Mivel kotta-szerkesztés egyelőre nincs az Andriod változatban,
			ezért a PCs v12.5 ß3 verziót kell használni arra,
			hogy az énektárakba vagy .DIA fájlokba az új ritmusokat elhelyezzük.
			Az így készült kottákat viszont már ez az Android változat megjeleníti.
		</li>
		<li>
			5.4 verzió: Teljes képernyős mód a Diatárban
			A képernyőre koppintva a vetítés ki-be kapcsolható, ez megfelel a piros gombnak.
			Az viszont új tulajdonság, hogy felfelé húzva a képet át lehet váltani teljes képernyős módba,
			amikor a kezelőszervek eltűnnek, és az énekszöveg is csak akkor látszik, ha aktív a vetítés.
			Ez főleg akkor hasznos, ha közvetlenül a tablet képét akarjuk kivetíteni, második "DiaVetítő" gép nélkül.
		</li>
		<li>
			5.3 verzió: Kötőívek ábrázolása, mind a szövegben, mind a kottákban
		</li>
		<li>
			5.2 verzió: Folyamatosan bekapcsolt képernyő Diatárban
			A DiaVetítő eddig is megakadályozta a képernyő zárolását, illetve képernyővédő aktivizálódását.
			Mostantól ez a Diatár alkalmazásban is beállítható a Beállít/Program ablakban.
			Javítás: méretezési probléma és kotta vonalvastagság
		</li>
		<li>
			5.1 verzió: Kottasor és Akkordfeliratok méretezése, átlátszó háttér
			Mindeddig az akkordfeliratok a szövegsorral egyforma helyet foglaltak, míg a kottasor két szövegsornyi méretű volt.
			Mostantól ezek külön-külön méretezhetők 10..200% az eredeti arányában. Mivel ez új funkció,
			a PCs program v12.5 verziója kell hozzá, a ß1 bétaváltozattól kezdve kompatibilisek.<br/>
			Újdonság a háttér átlátszósága is - ez csak a PCs változatban értelmezhető, de vezérelni innen is lehet.
		</li>
		<li>
			5.0 verzió: Kottakirajzolás.
			Mostantól a vezérlő és a vetítő is képes megjeleníteni a szöveghez a kottát.
			A vezérlő Diatár appban Beállít/Vetítés menüpont alatt az akkordokhoz hasonlóan ki/be kapcsolható.
			A kötőíveken kívül minden PCs kottajelet kirajzol.
		</li>
		<li>
			4.6 verzió: Szókiemelés, amely segíti a szöveg pontosabb követését.
			A funkciót a PC-s változatok már évek óta tudják,
			a siketek és nagyothallók számára rendezett miséken évek óta használják.
			Figyelem! Az android/PC vegyes használathoz a PC változatból a béta verziók legfrissebbjét kell letölteni.
		</li>
		<li>
			4.5 verzió: a vetítőben beállítható fekete keret, mint a Windows/Linux változatban.
			Ennek célja, hogy projektoros vetítésnél az Android természetes felbontásától eltérő vászonra (falra) lehessen vetíteni.
			Ismétlődő "EADDRINUSE" hálózati hibák kivédése.
		</li>
		<li>
			4.4 verzió: Fejlesztések a fájlkezelő ablakon, a listaelemek hosszú érintésére helyi menü jelenik meg.<br/>
			Fájl és könyvtár átnevezés, új létrehozása.
			Fájl vagy akár többszintű könyvtárstruktúra kivágása/másolása és beillesztése máshová.
		</li>
		<li>
			4.3 verzió: Másodlagos DTX könyvtár adható meg; egyedi diaparaméterek szerkeszthetők.<br/>
			Androidon az app saját tárhelye nem publikus (például /data/data/diatar.eu/files).
			Saját DTX fájlok mostantól a Documents/diatar könyvtárba tehetők - a könyvtár helye megadható
			a Beállít/Letöltés menüponton keresztül.
		</li>
		<li>
			4.2 verzió: Háttérkép a kikapcsolt vetítés idejére
			Ugyanúgy, ahogy a PCs verziónál már régóta: amikor nem vetítünk énekszöveget egy háttérkép jeleníthető meg.
			A Beállítások/Vetítés menüpont alatt megadható a fájl és a kitöltési mód.
		</li>
		<li>
			4.1 verzió: Képek megjelenítése és szerkesztése
			Az énekrendben képek is megjelenhetnek, a szerkesztéskor is be lehet válogatni, elmenteni, visszatölteni.
		</li>
		<li>
			4.0 verzió: Énekrend összeállítási és mentési (.DIA fájl) lehetőség!
			Egyelőre csak létező éneket és elválasztót lehet beszúrni/törölni, de a funkcionalitás folyamatosan ki fog teljesedni.
		</li>
		<li>
			3.2 verzió: egységes számozás a vezérlő és vetítő applikációra, kézzel beírt saját szöveget
			(PCn kell az énekrend összeállításakor a "+Szöveg" gombot lenyomni és beírni) is megnyit DIA fájlból.
		</li>
		<li>
			3.1 verzió: csatlakozási lehetőség egyszerre több kivetítőhöz!
			A Diatárban megjelenítés is mostantól követi a vetítési paramétereket (sortörés, igazítás stb).
		</li>
		<li>
			A 3.0 verzió újdonsága a hálózati kapcsolat. Képes /VETITO üzemmódú PCs Diatarat vezérelni,
			vagy akár az androidos DiaVetito működtethető vele. Így tabletről - vagy akár okostelefonról
			irányítható a vetítés.
		</li>
		<li>
			A 2.0 DIA fájlokat is be tud olvasni. Mivel szerkeszteni még nem lehet,
			PC-n készített összeállításokat kell átmásolni egy tetszőleges könyvtárba - célszerűen a közös Dokumentumok mappába.
			A meglevő énektárak diáit tudja megjeleníteni és az elválasztókat.
		</li>
		<li>
			Beállítható inernet-ellenőrzési gyakoriság.
			Mivel a weblap csak évente két-három alkalommal frissül, nem érdemes sűrű frissítést beállítani.
		</li>
		<li>
			Beállítható a szövegszín és a háttér színe.
		</li>
		<li>
			A szöveget jobbra-balra "söpörve" is léphetünk az előző, következő diára.
		</li>
		<li>
			Az egyszerűbb formázások (aláhúzás, dőlt, elválasztás) is megjelennek.
		</li>
		<li>
			1.2 verzió: a sortörési algoritmus javítása, méretezési hiba javítása
		</li>
		<li>
			1.1 verzió: sok hibajavítás. Új dolog a sortörési javaslatok használata és akkordok megjelenítése
		</li>
	</ul>

	<div class="iconed_title android_icon" id="KORABBI">
		<p><b>Korábbi verziók:</b></p>
	</div>
	<div class="text12">
	  <center>
		<a href="./downloads/android/Diatar63.apk">Diatar63.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito63.apk">DiaVetito63.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar62.apk">Diatar62.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito62.apk">DiaVetito62.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar61.apk">Diatar61.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito61.apk">DiaVetito61.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar60.apk">Diatar60.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito60.apk">DiaVetito60.apk</a>
	  </center>
	  <br/>
	  <center>
		<a href="./downloads/android/Diatar55.apk">Diatar55.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito55.apk">DiaVetito55.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar54.apk">Diatar54.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito54.apk">DiaVetito54.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar53.apk">Diatar53.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito53.apk">DiaVetito53.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar52.apk">Diatar52.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito52.apk">DiaVetito52.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar51.apk">Diatar51.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito51.apk">DiaVetito51.apk</a>
	  </center>
	  <center>
		<a href="./downloads/android/Diatar50.apk">Diatar50.apk</a>
		&nbsp;&nbsp;
		<a href="./downloads/android/DiaVetito50.apk">DiaVetito50.apk</a>
	  </center>
	</div>
</div>
