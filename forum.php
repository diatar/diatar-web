<div id="letoltes" style="display: block">
    Letöltődés ....
    <img src="/graphics/loading.gif"/>
</div>

<?php

    if(isset($_REQUEST['f']))
    {
        $URL = "/forum/viewforum.php?f=" . $_REQUEST['f'];
    }
    else
    {
        $URL = "/forum";
    }
?>
<div class="MAIN_CONTENT_POS1">

</div>    
<script type="text/javascript" language="javascript">
    var ele = document.getElementById("letoltes");
    function autosize(f)
    {    
        try
        {
            if(f.contentDocument.height)
                f.style.height = f.contentDocument.height + "px";
            else if(f.contentDocument.offsetHeight)
                f.style.height = (f.contentDocument.offsetHeight + 15) + "px";
            else if(f.contentDocument.body.offsetHeight)
                f.style.height = (f.contentDocument.body.offsetHeight + 15) + "px";
                    
        }
        catch(e){} 
        ele.style.display = "none";              
    }
</script>  

<iframe border="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"  id="forum_frame" 
        onload="autosize(this);" src ="<?php echo $URL;?>" style="float:left;width:760px;margin:0px;border:0px;">
         
        Az ön böngészője nem kezeli az iframe-eket, <a href="/forum">ugrás a fórumra</a>     
</iframe> 

 
    <!--
    <center>
        <a href="forum">Megyek a fórumra</a>
    </center>
    <div class="red_text_forum">
        Figyelem !
    </div>
    <div class="text">
        <p>
            Alpvető tudnivalók:
        </p>
        <ul>
              <li>A fórum célja a Diatár program ismertetése, használóinak támogatása és a fejlesztések összefogása.</li>
              <li>A fórum hozzászólásait (témáit/topikjait) bárki olvashatja.</li>
              <li>Hozzászólás írásához, és minden más fórumművelethez regisztráció szükséges.</li>
              <li>
                    <p>A fórum <b>moderált!</b> Egyelőre utólagos moderációt alkalmazunk, minden ide nem illő post-ot azonnal törlük.</p>
                    <p>Súlyos esetben a vétséget elkövető felhasználót ideiglenesen </p>
                     <p>vagy akár véglegesen is kizárjuk a fórumból.</p>
              </li>
              <li> 
                <p>Szükség esetén áttérhetünk a megjelenés előtti moderációra.</p>
                <p>Erről a regisztrált tagokat időben értesíteni fogjuk!</p>
              </li>
        </ul>
        <p>
            A fórumba való regisztrációhoz minden felhasználónak tudomásul kell vennie a fórumszabályzatot (a regisztrációs oldalon olvasható). 
        </p>
        <p>
            A fórum adminisztrátora, és moderátorai mindent megtesznek a fórum tisztántartása érdekében. 
            Kérünk minden felhasználót, törekedjék arra, hogy a fórum tisztaságát megőrizzük, annak céjától el ne térjünk!
        </p>
        <p>
            Esetleges reklamációk elbírálásában a fórum adminisztrátora egyedüli és szuverén jogokkal bír. 
            Döntéseit felülbírálni nem lehet, ellenük jogorvoslatnak helye nincs. 
        </p>
        <p>
            Bármely újonnan induló rendszer javítható. Ez alól a fórumunk sem kivétel. Kérünk minden jószándékú fórumozót, hogy ötletekkel, 
            javaslatokkal, fórumbeírásaival segítsen a fórum üzemeltetőinek a program és a fórum fejlesztésében, bővítésében, jobbá tételében.
        </p>
        <p>
            Köszönjük!
        </p>
    </div>
    <center>
        <a href="forum">Megyek a fórumra</a>
    </center>
    -->