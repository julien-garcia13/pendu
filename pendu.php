<?php

class Pendu{

    public $played;
    // Retirer les accents
    public function retirerAccents($mot)
	{
			$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
			$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

			$newmot = str_replace($search, $replace, $mot);
			return strtoupper($newmot); 
	}
    // Accueil
    public function Accueil(){
        if(!empty($_SESSION['victoires'])){
            echo "<p class='bienvenue'> Bienvenue sur le jeu du Pendu faites une partie :</p>";
            // Met une image d'acceuille le s 
            echo "<img src=''>";
            echo "<a class='continuer' href='index.php?etat=jouer'>Continuer</a>"."<br>";
            echo "<a class='nouvelleP' href='nouvellepartit.php'>Nouvelle partie</a>";  
        }
        else{
            // rajoute image de bienvenu
            echo "<p class='bienvenue'> Bienvenue sur le jeu du Pendu faites une partie :</p>";
            echo "<img class='img-bienvenue' src=''>";
            echo "<a class='nouvelleP' href='nouvellepartit.php'>Nouvelle partie</a>";  
        }
    }

    // Rajoute photo pendu
    // Quand le joueur à perdu
    public function partiePerdue($mot)
    {
        echo "<div class='msg'> Vous avez perdu ... Le mot était <br><span class='mot'> $mot </span> </div><a class='recommencer' href='recommencer.php'>Recommencer</a>";
        echo "<img src=''>"; 
        exit();
    }
    // Quand le joueur à gagné
    public function partieGagne($mot)
    {
        echo "<div class='msg'> Vous avez gagné !! Le mot était bien <br> $mot </div><a class='recommencer' href='recommencer.php'>Nouveau Mot</a>";
        $_SESSION['victoires']++;
        echo "$_SESSION[victoires]";
        exit();
    }
    // Le choix des mots
    public function choixMot($fichier)
    {
        if(!isset($_SESSION['mot'])){
            $_SESSION['mot'] = rtrim($fichier[array_rand($fichier)]);
        }
    }
    // Pour le stockage des lettres
    public function stockagedesLettres()
    {
        $pletter = $_POST["lettre"];
        $_SESSION['played'][]=$pletter;
    }
    // Quand c'est la mauvaise lettres
    public function mauvaisesLettres($mot)
    {
        $played = $_SESSION['played'];
        $this->played = $played;
                
            for($k=0; isset($played[$k]); $k++){
                if(!in_array($played[$k], str_split($mot))){
                    $_SESSION['false']++;
                }
            }
    }
    // L'affichage de l'alphabet
    public function affichageInput($alphabet)
    {
        for($i=0; isset($alphabet[$i]); $i++ )
            {

                if(!empty($this->played) && in_array($alphabet[$i], $this->played ))
                {
                    echo "";
                }
                else
                {
                    echo '<input type="submit" name="'."lettre".'" value="'.$alphabet[$i].'">';
                }
            }
    }
    // L'affichage des lettres dans les tirets
    public function affichageLettres($mot)
    {
        for ($j=0; isset($mot[$j]); $j++) {
            if(!empty($this->played) && in_array($mot[$j], $this->played)){
                $_SESSION['true']++;
                echo "$mot[$j]";
            }
            else{
                echo "<span class='tirets'>_ </span>";
            }      
        }
    }

}