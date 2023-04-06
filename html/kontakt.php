<!DOCTYPE html>

<?php
    //Die E-Mail Adresse, an die die Kontaktanfragen gesendet werden
    $empfaenger = "noep@outlook.de";
    if(isset($_REQUEST["submit"])){
        if(empty($_REQUEST["name"]) || empty($_REQUEST["email"]) || empty($_REQUEST["nachricht"])){
            $error = "Bitte f&uuml;llen Sie alle Felder aus";
        }
        else{
            //Text der E-Mail Nachricht
            $mailnachricht="Sie haben eine Anfrage über ihr Kontaktformular erhalten:\n";
            $mailnachricht .= "Name: ".$_REQUEST["name"]."\n".
                      "E-Mail: ".$_REQUEST["email"]."\n".
                      "Datum: ".date("d.m.Y H:i")."\n".
                      "\n\n".$_REQUEST["nachricht"]."\n";            
            //Betreff der E-Mail Nachricht
            $mailbetreff = "Kontaktanfrage ".$_REQUEST["betreff"]." (".$_REQUEST["email"].")";
            //Hier wird die E-Mail versendet
            if(mail($empfaenger, $mailbetreff, $mailnachricht)){
                //Text den der Seiten Besucher nach dem Versand sieht
                $success = "Wir haben Ihre Anfrage erhalten und werden sie so schnell wie möglich bearbeiten. <br>";
            }
            else{
                $error = "Beim Versenden Ihrer Anfrage ist ein Fehler aufgetreten! Versuchen Sie es bitte später nocheinmal.";
            }
        }
    }
?>

<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <meta name="robots" content="index,follow">
    <meta http-equiv="expires" content="60">

    <meta name="author" content="Noé Plain">
    <meta name="copyright" content="Noé Plain">

    <meta name="description" content="Kontaktseite von Piclain.">
    <meta name="keywords" content="Noé Plain, Fotografie, Illustration">
    <link rel="icon" type="image/x-icon" href="../pictures/njp_logo_gross.png">
    <title>Piclain – Kontakt</title>
</head>

<body>
    <header>
        <div class="maxwidth display-flex margineo">
            <a href="../index.html"><img class="header_logo" src="../pictures/njp_logo.svg"
                    alt="Logo von Piclain/NJP"></a>
            <nav>
                <ul>
                    <a href="./fotografie.html">
                        <li>
                            Fotografie
                        </li>
                    </a>
                    <a href="./illustrationen.html">
                        <li>
                            Illustration
                        </li>
                    </a>
                    <a class="activ" href="../index.html">
                        <li>
                            Kontakt
                        </li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>
    <main class="lpink mainmitte">
        <div class="maxwidth paddingt">
            <?php if(isset($success)){
            echo "<div>".$success."</div>"; 
        } 
        else { ?>
            <div class=" display-flex justifycenter">
                <form id="kontaktform" action="" class="display-flex justifycenter" method="post" action="send_email.php">
                    <h1>Kontakt</h1>

                    <input type="text" id="name" name="name" placeholder="Vorname, Nachname" required>
                    
                    <input type="text" id="email" name="email" placeholder="E-Mail" required>
                    
                    <input type="text" id="betreff" name="betreff" placeholder="Betreff" required>
                    
                    <textarea id="nachricht" name="nachricht" rows="10" cols="50" placeholder="Nachricht" required></textarea>

                    <input class="button" type="submit" name="submit">
                </form>
            </div>
            <script>
            function validateForm(){
                var form = document.getElementById("kontaktform");
                return form.checkValidity();
            }
        </script>
        <?php 
        } 
        if(isset($error)){
            echo '<div class="error">'.$error.'</div>'; 
        } ?>
        </div>

    </main>
    <footer>
        <p class="marginbnon">WebPortfolio – Noé Plain</p>
    </footer>
</body>

</html>