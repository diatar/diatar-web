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
        <div id="szoveg" <?php if(isset($_REQUEST['oldal'])) echo ('style="display:none;"')?> >
            <div class="expanded" >               
                <p>
                    Az angol "tutorials" legjobb magyar megfelelőjének a jelen helyzetben a "bemutatók" szót találtuk. Az a célja, hogy 
                    ne kelljen az egyre terjedelmesebb Használati Útmutatót böngészni, hanem a főbb tulajdonságok egy-egy rövid bemutatóból érthetővé váljanak.
                </p>
                <p>
                Ez a rész csak első kezdemény, ha beválik, bővíteni fogjuk. Egyben kérjük, akinek van ideje-energiája, 
                <a href="?page=segitene">segítsen</a>
                hasonló bemutatók elkészítésével. Nagyon szívesen közzétesszük!
                </p>
            </div>

            <div class="tutor_img">
				<p>
					&nbsp;<br/>
					Mosolygó Attila több videót is készített, melyek az alábbi linken tekinthetők meg (nagyon köszönjük!):<br/>
					<a href="https://www.youtube.com/watch?v=do3NCWrMxc4&list=PLx4SCXCWhL-WNGFfFP4ALf74KnAawyJOh" target=_BLANK>
						https://www.youtube.com/watch?v=do3NCWrMxc4&list=PLx4SCXCWhL-WNGFfFP4ALf74KnAawyJOh
					</a><br/>&nbsp;<br/>
				</p>
                <p>
					Az énekrendek kezeléséről videóban: <a href="https://youtu.be/wgjApWpr7ls" target=_BLANK>
					https://youtu.be/wgjApWpr7ls
					</a>
                </p>
            </div>
			<br/>&nbsp;<br/>
           <div class="dotted_text">
               <ul>
                    <li> <a href="javascript:open_slideshow('tutors/internet/t1.html',1200)">Internetes vetítés</a></li>

                    <li> <a href ="javascript:open_slideshow('tutors/enekrendlista/t1.html',850)">Az éneklisták titkai</a> </li>

                    <li> <a href ="javascript:open_slideshow('tutors/datumra/t1.html',750)">Hogyan kell egy adott napon automatikusan 
                            betöltődő énekrendet készíteni</a></li>

                    <li> <a href="javascript:open_slideshow('tutors/szovegszerkeszto/t1.html', 800)">A szövegszerkesztõ ablak használata</a> </li>

                    <li> <a href="javascript:open_slideshow('tutors/hangok/t1.html',900)">Hangfájlok lejátszása</a> </li>

                    <li> <a href="javascript:open_slideshow('tutors/vetitesbeallitas/t1.html',900)">Vetítés beállításai</a></li>

                    <li> <a href="javascript:open_slideshow('tutors/uzemmodok/t1.html',1200)">Üzemmódok (egy és két gépes vetítés) lehetőségei</a></li>

                    <li> <a href="javascript:open_slideshow('tutors/korusmod/t1.html',1100)">Kórus vetítési mód</a></li>

                    <li> <a href="javascript:open_slideshow('tutors/akkord/t1.html',2100)">Gitárakkordok használata</a></li>

                    <li> <a href="javascript:open_slideshow('tutors/kottaeditor/t1.html',1500)">Kotta-editor használata</a></li>
                </ul>    
            </div>
        </div>  
   <!-- Gyakorlatilag itt van vege az oldalnak. Ami ezutan jon, azok a rutinok --> 


    <div id="slideshow" class="slide_show">
            <center>  
            <div id="vege" <?php if(!isset($_REQUEST['oldal'])) echo ('style="display:none;"')?> >
              <a href ="javascript:close_slideshow()"> Vége </a>
            </div>
            </center>
            <iframe border="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"  id="tutor_frame" 
            src ="<?php echo $URL;?>"  style="float:left;width:760px; height:<?php echo $magas."px";?>; margin:0px;border:0px;">
            
            Az ön böngészője nem kezeli az iframe-eket/Your browswer doesn't support IFRAMES, <a href="/forum">ugrás a fórumra/Jump to forum</a>     
            </iframe>
    </div> 
    <script language="javascript" type="text/javascript">
                var frame = document.getElementById("tutor_frame");                 
                var ele = document.getElementById("vege");
                var ele1 = document.getElementById("szoveg");

                function open_slideshow(src,height)
                {      
                   frame.src = src;
                   frame.style.height = height + "px";     
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



