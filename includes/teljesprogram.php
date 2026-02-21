<div class="text expanded">
	<p>
		13.1 verzió – A csomagok tartalmazzák a vetítőprogramot - teljes körű leírással,
		az énektárak szerkesztését végző programot, és ennek leírását,
		valamint az eddig elkészült énektárakat (.dtx fájlok)
	</p>
</div>
<div class="text expanded">
	A <a href="?page=forum&f=10">gyakran ismételt kérdésekben</a> további segítséget talál a telepítéshez.
</div>
<div class="green_text expanded">
	Bár a program használata ingyenes és szabad (lásd balra a licenc információkat),
	köszönettel vesszük, ha jelzi, aki terjeszti vagy használja.
	Egy <a href="?page=forum&f=5">fórumbejegyzés</a> is elég.
	Ebből tudhatjuk meg, hogy kik és hol használják a programot.
	A fórum regisztrált tagjai rendszeresen tájékoztatást kapnak a frissítésekről. 
</div>
<div class="green_text expanded">
	A beüzemelésben, használatban felmerülő esetleges gondokra is segítséget adhat a fórum közössége.
</div>
<div class="green_text expanded">
	Aki valami hibát talál, fejlesztési javaslata, kérése, ötlete van, az is bátran írjon a fórumba.
	Köszönettel veszünk minden visszajelzést!.
</div>

<!-- Leirasok -->
<br/><br/>
<div class="iconed_title pdf_icon">
	Leírások
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="../downloads/HasznalatiUtmutato.pdf" target="_blank">HasznalatiUtmutato.pdf</a>
		</div>
		<div class="download_link expanded">
			<a href="../downloads/DiatarEditor.pdf" target="_blank">DiatarEditor.pdf</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				PDF formában olvasható a Diatár illetve a DiaEditor program Windows/Linux változatának teljes leírása.
				Ezek a fájlok az alábbi csomagoknak is részei.<br/>
				(Adobe Acrobat PDF olvasó letölthető
				<a href="https://www.adobe.com/hu/acrobat/pdf-reader.html" target="_blank">innen</a>)<br/>
				További <a href="?page=tutorials">bemutatók</a> is elérhetők a weblapunkon.
			</p>
		</div>
	</div>
</div>

<!-- Windows valtozatok -->
<br/><br/>
<div class="iconed_title windows_icon">
	Windows kompatibilis változat
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar_install-v13.1.win.exe">diatar_install.exe</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				Önkicsomagoló, interaktív telepítőszoftver.
				A választható összetevők nem csak a programot és a dokumentációt, valamint a köteteket tartalmazzák,
				de internet-kapcsolat esetén letölthetők az összeállított mátyásföldi és román diasorok,
				valamint a különböző hangfájlok is. Ezeket a külön megadható könyvtárakba telepíti is.
			</p>
		</div>
	</div>
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_ODD">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar_13.1.3_win.zip">win.zip</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				Hagyományos tömörített csomag. Csak ki kell tömöríteni egy könyvtárba és máris használható.
				Ha printer-portos távkapcsoló-illesztőre van szükség, első alkalommal írási jog kell a
				C:\WINDOWS\SYSTEM32 könyvtárhoz, ahova egy service rutint telepít (ld. a használati útmutatóban).<br/>
				Zsolozsmák letöltéséhez az openssl32 vagy openssl64 könyvtárban levő két DLLt a program mellé kell másolni (attól függ, a 32bites vagy 64bites programváltozatot használja-e).
			</p>
		</div>
	</div>
</div>

<!-- Linux valtozatok -->
<br/><br/>
<div class="iconed_title linux_icon">
	Linux kompatibilis változatok
</div>
<div class="red_text expanded">
	<b><i>32 bites és 64 bites vátozatok külön</i></b>
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar_13.1.3-1_i386.deb">i386.deb</a>
		</div>
		<div class="download_link expanded">
			<a href="./downloads/diatar_13.1.3-1_amd64.deb">amd64.deb</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				<b>FIGYELEM!!!</b> Az új verzió már bármilyen felhasználó nevében telepíthető
																		a "sudo dpkg -i <i>csomag-fájl</i> paranccsal.
				További részleteket ld. a <a href="./downloads/readmereader.php?file=1" target="_blank">README.Debian</a> fájlban.
			</p>
		</div>
	</div>
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_ODD">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar-linux_13.1.3_i386.tar.gz" download>i386.tar.gz</a>
		</div>
		<div class="download_link expanded">
			<a href="./downloads/diatar-linux_13.1.3_x86_64.tar.gz" download>x86_64.tar.gz</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				Egyszerű tömörített állomány. Amennyiben nincs szükség csomagkezelő használatára,
				ezzel a telepítést a felhasználó maga oldhatja meg.
				Tetszőleges könyvtárba kicsomagolható és használható.
				Ha a printer-portra csatlakozó távkapcsolót szeretné használni,
				akkor az <i>ioroutine</i> fájlnak <i>setuid root</i> jogot kell adni
				(ld. a használati útmutatóban).
				További részletek a <a href="./downloads/readmereader.php?file=2" target="_blank">README.LinuxTarGz</a> fájlban.
			</p>
		</div>
	</div>
</div>

<!-- Raspberry Pi valtozatok -->
<br/><br/>
<div class="iconed_title rpi_icon">
	Raspberry Pi változatok
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar_13.1.3-1_armhf.deb">armhf.deb</a>
		</div>
		<div class="download_link expanded">
			<a href="./downloads/diatar_13.1.3-1_arm64.deb">arm64.deb</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				Sikerült megoldani a Raspberry PI telepítő készítését is, így ez is teljes értékűen használható.
				Mivel a "Raspberry Pi OS" (korábban Raspbian néven) valójában egy Linux Debian disztribúció,
				mindenben a Linux szerint települ és működik, részleteket lásd fentebb, a Linux-nál.
			</p>
		</div>
	</div>
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_ODD">
	<div class="RIGHT_TABLE_LEFT">
		<div class="download_link expanded">
			<a href="./downloads/diatar-rpios_13.1.3_armhf.tar.gz" download>32bit_armhf.tar.gz</a>
		</div>
		<div class="download_link expanded">
			<a href="./downloads/diatar-rpios_13.1.3_arm64.tar.gz" download>64bit_arm64.tar.gz</a>
		</div>
	</div>
	<div class="RIGHT_TABLE_RIGHT">
		<div class="TABLE_TEXT expanded">
			<p>
				Csomagkezelő nélkül használható források, az rdiatar32/64 ill. rdiaeditor32/64 a futtatandó binárisok.
				Az eltérő architektúra miatt a printer-port kiegészítés itt nem használható,
				de minden másban a Linux szekcióban leírtak szerint működik.
			</p>
		</div>
	</div>
</div>

<!-- Android valtozatok -->
<br/><br/>
<div class="iconed_title android_icon">
	<div class="text12">
	  <a href="?page=letoltesek&subpage=android">ANDROID VERZIÓ!</a>
	</div>
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="text expanded">
		 <p>
			Android verzió is letölthető
			(<a href="?page=letoltesek&subpage=android">lásd külön lapon: Letöltés/Android</a>),
			okostelefonról vagy tabletről való vezérléshez,
			okostévén (vagy tévéokosító eszközön) való kivetítésre.
		</p>
	</div>
</div>

<!-- SHA256 -->
<br/><br/>
<div class="iconed_title sha_icon">
	SHA256 ellenőrzőösszegek
</div>
<div class="RIGHT_TABLE TABLE_ENTRY_EVEN">
	<div class="text expanded">
		<p>
		A biztonságos letöltés/telepítés érdekében az ellenőrzőösszegek itt találhatók:
		<a href="./downloads/sha256sum.txt" target="_blank">sha256sum.txt</a>
		</p>
	</div>
</div>
