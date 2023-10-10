<?php
    if(isset($_REQUEST['dir']))
        $DIR = urldecode($_REQUEST['dir']);
    else
        $DIR = "zene";    
    list_dir($DIR);
    
    function list_dir($DIR)
    {
        ?>
            <ul>
                <?php 
                    $h = opendir($DIR);    
                    while($file = readdir($h))
                    {
                        if(($file != "..")&&($file != "."))
                        {
                            if(is_dir($DIR . '/' . $file))
                            {
                                echo '<li>
                                        <b><a href="index.php?page=zene&dir=' . $DIR . urlencode('/') . $file . '">' . $file . '</a></b><br />';
                                echo '</li>';
                            }
                            else
                                echo '<li><a href="' . $DIR . '/' . $file . '">' . $file . '</a></li>';
                        }        
                    }                    
                ?>
            </ul>
        <?php
    }
    
?>
