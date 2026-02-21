<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv="Content-Language" content="hu">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Diatár: bemutató</title>
    <link rel="stylesheet" type="text/css" href="../CSS/DESIGN_TUTOR.css"/>
    <link rel="stylesheet" type="text/css" href="../CSS/DESIGN_FRAME.css"/>
</head>


<div class="TUTOR_FRAME">
    <div class="title16">
        <p>
         Vetítő rendszer kialakítása Mohácson, a Magyarok Nagyasszonya templomban
        </p>
		<br/>
        <p>
         Örömmel mutatjuk be, hogy a 2018. adventi és karácsonyi időszak alkalmával
		 áttértünk a Diatár program megoldásaira Mohácson a Magyarok Nagyasszonya templomban.
        </p>
    </div>
    <center>
		<a title="1. ábra: Vetítővászon Mohácson" href="/images/mohacs1.jpg" target="_blank">
			<img border="0" src="/images/mohacs1.jpg" width="400" alt="vetítővászon" />
		</a>
		<br/>
    </center>
    
    <div class="text">
        <p> 
			A legfőbb indok, amiért a Diatárat választottuk: a hálózati távvezérlés,
			a kivetített kép átméretezése és globális formázási stílus beállítások lehetősége.
			Eddig külön szolgálattevők kellettek a vetítés irányításához,
			mert csak egy PowerPoint prezentációban voltak meg az énekek, és "számlázható" úton is drága egy presenter vásárlása,
			sőt elég kicsi távolságban működnek (a templomban elég nagyok a távlatok), ezért volt eddig megvalósíthatatlan a távvezérlés.
			A PowerPoint prezentációkkal a legnagyobb hátrány, hogy nem "stílussokkal" készítették, azért
			ha át kellett állítani a kép méretét vagy a betűk méretét, akkor diánként kellett végig mennünk.
        </p> 
        <p>
			Én magam már régóta tudtam a program létezéséről, de nemrég jutottam el addig, hogy javasoljam a kántorunknak is.
			Azután összegyűjtöttem a szükséges összetevőket, amik nálam már szükségtelenek voltak,
			vagy már a plébánia tulajdonában voltak, én a meglévő projektor + laptop kombóhoz felajánlottam saját tulajdonomból
			egy régi HP laptopot és a USB-s vezérlő egységet (bővebben lent).
			A plébánia tulajdonából egy régi router-t szereztem.
		</p>
		<br/>
        <hr />
		<br/>
    </div>
    <div>
        <p>
		<a title="2. ábra: Laptop az orgona szélén" href="/images/mohacs2.jpg" target="_blank">
            <img src="/images/mohacs2.jpg" width="400" style="float:left; margin-right:10px;"/>
		</a>
		</p>
		<p>
			<b>A rendszer specifikációi:</b><br/>
			Kivetítés (laptop és projektor): nincs különösebb megoldás rajtuk.
			Egy Win7-es laptopon fut a "kivetítő" programrész, amit 16:9 képaranyú projektor vetít ki.
			Ott helyezkedik el a router is.
        </p>
		<br/>
		<p>
			Vezérlés (laptop és USB vezérlő): egy régi 4:3-as képarányú laptopot használunk,
			mivel kényelmesen odafér az orgonához és könnyen állítható a kijelzője.
			A gyorsabb üzem érdekében Debian operációs rendszert telepítettem rá,
			a másik ok a szkriptelés lehetősége, így megoldottam, hogy a Diatár és az USB vezérlő programja rendszer indításkor elinduljon.
			A távsegítség érdekében, ha a kántor elakadna valamiben, akkor lentről SSH vagy TeamViewer segítségével avatkozom a dolgokba.
			A laptopok WIFI-n keresztül csatlakoznak.
		</p>
		<br/>
         <p>   
			Az USB "vezérlő" alapját egy kevesebb mint 1000 Ft értékű játék vezérlő elektronikája adja,
			az egységet egy kötődobozba építettem, amire 5 gombot építettem (vetítés és diák, ének léptetés).
			A gombokat az elektronika megfelelő helyére forrasztottam. Szoftveresen az "Antimicro"
			elnevezésű program fordítja billentyű leütésekké. Eredetileg csak demo verziónak szántam,
			nem akartam és egyelőre nem is fogom beépíteni az orgonába, mert az előttünk álló felújítás miatt kérdéses az orgona helyzete.
		</p> 
	</div>
	<div>
        <p>
		<a title="Léptető nyomógombok" href="/images/mohacs3.jpg" target="_blank">
            <img src="/images/mohacs3.jpg" width="400"  style="float:left; margin-right:10px;"/>
		</a>
        </p>
        <p>
			Önmagában jelen állapotában is meg vagyunk elégedve a programmal és a rendszerrel,
			én is, ha valamit tudok, akkor tökéletesítek a rendszerben.
			Amit talán hiányolok: egy külön kezelő felület a „kivetítő” módhoz és a több kivetítő program használata.
			(De ezekre nekünk még nincs szükségünk). Összességében, mióta használjuk a programot,
			megkönnyítette mindenki számára az éneklés lehetőségét: mivel eddig a SzVU! szerint énekeltünk,
			nemrég elkezdtük bevezetni az Éneklő Egyház énekeit is, a szöveg vetítés nagy segítség azok számára,
			akik nem ismerik (sokan mindig a Hozsannában keresik az ÉE-s énekeket), különösen nagy segítség a kotta vetítés a graduáléknál.
        </p>
		<br/>
	</div>
		<hr/>
	<div>
        <p>
			Talán van mit még elmondanom, de nem jutott eszembe vagy lényegtelennek tartottam,
			de ha lesz lehetőségünk, akkor a többi templomban is bevezetjük.
			Akkor, ammenyiben én vitelezem ki, akkor majd egy újabb kis tájékoztatót írok.
			Sok megvalósítási ötletem van, de annak szerintem nincs itt helye. 
		</p>
		<br/>
	</div>
	<center>    
		<a title="4. ábra: Kotta vetítése" href="/images/mohacs4.jpg" target="_blank">
			<img border="0" src="/images/mohacs4.jpg" width="400" alt="kottavetítés" />
		</a>
		<br/>
	</center>
	<div>
		<br/>
		<p>
			Köszönettel és tisztelettel, Szücs Barna, templomi szolgálattevő.
		</p>
   </div>            
  
</div>