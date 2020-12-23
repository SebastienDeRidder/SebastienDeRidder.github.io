    <?php
    function create_image() {
        // maak lege CAPTCHA box aan van 250x75 pixels groot
        $afbeelding = imagecreatetruecolor(250, 75);
        $kleur_achtergrond = imagecolorallocate($afbeelding, 255, 255, 255 );
        imagefilledrectangle($afbeelding,0,0,250,75,$kleur_achtergrond);
        // teken willeurige strepen op CAPTCHA
        $line_color = imagecolorallocate($afbeelding, 64,64,64); 
        for($i=0;$i<20;$i++) {
        imageline($afbeelding,0,rand()%75,250,rand()%75,$line_color);
        }
        // teken willekeurige puntjes op CAPTCHA
        $pixel_color = imagecolorallocate($afbeelding, 0,0,255);
        for($i=0;$i<2000;$i++) {
        imagesetpixel($afbeelding,rand()%250,rand()%75,$pixel_color);
        } 
        // teken willekeurige karakters op CAPTCHA
        $karakters = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz1234567890?&@#%';
        $len = strlen($karakters);
        $text_color = imagecolorallocate($afbeelding, 0,0,0);
        $woord = "";
        for ($i = 0; $i< 5;$i++) {
            $karakter = $karakters[rand(0, $len-1)];
            $woord.=$karakter;
            $font = "layout/font.ttf";
            imagettftext($afbeelding , 25 , rand(0,75) , 25+($i*50), 50, $text_color , $font , $karakter );
        }
        $_SESSION['captcha_string'] = $woord;        
        $afbeeldingen = glob("*.png");
        foreach($afbeeldingen as $del_afb){
            unlink($del_afb);      
        }
        imagepng($afbeelding, "images/captcha.png");
    }
    ?>