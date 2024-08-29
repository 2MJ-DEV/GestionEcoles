<?php    
/*
 * PHP QR Code encoder
 *
 * Exemple d'utilisation
 *
 * PHP QR Code est distribué sous LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * Cette bibliothèque est un logiciel libre ; vous pouvez la redistribuer et/ou
 * la modifier sous les termes de la Licence Publique Générale Réduite GNU telle que publiée par
 * la Free Software Foundation ; soit la version 3 de la licence, soit
 * (à votre discrétion) toute version ultérieure.
 *
 * Cette bibliothèque est distribuée dans l'espoir qu'elle sera utile,
 * mais SANS AUCUNE GARANTIE ; sans même la garantie implicite de
 * QUALITÉ MARCHANDE ou D'ADÉQUATION À UN USAGE PARTICULIER. Voir la
 * Licence Publique Générale Réduite GNU pour plus de détails.
 *
 * Vous devriez avoir reçu une copie de la Licence Publique Générale Réduite GNU
 * avec cette bibliothèque ; sinon, écrivez à la Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    
    echo "<h1>PHP QR Code</h1><hr/>";
    // Affiche un titre et une ligne horizontale dans la page web

    // Définit le répertoire temporaire où les fichiers PNG générés seront stockés
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    // Préfixe de l'emplacement des fichiers PNG dans le code HTML
    $PNG_WEB_DIR = 'temp/';

    // Inclusion de la bibliothèque PHP QR Code
    include "qrlib.php";    
    
    // Vérifie si le répertoire temporaire existe, sinon il le crée
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    // Définit le nom par défaut du fichier PNG généré
    $filename = $PNG_TEMP_DIR.'test.png';
    
    // Traitement des entrées du formulaire
    // N'oubliez pas de valider et de nettoyer les entrées utilisateur dans une solution en production !!!
    
    // Niveau de correction d'erreur par défaut ('L' = plus bas)
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    // Taille de la matrice par défaut (4)
    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    // Si des données sont envoyées via le formulaire ou via GET
    if (isset($_REQUEST['data'])) { 
    
        // Vérifie que les données ne sont pas vides
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            // Affiche un message d'erreur si les données sont vides et termine le script
        
        // Génération du nom de fichier unique basé sur les données utilisateur
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        // Génère le QR Code avec les paramètres donnés et l'enregistre dans un fichier PNG
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        // Si aucune donnée n'est fournie, affiche un message et génère un QR Code par défaut
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
    // Affiche le fichier PNG généré sur la page web
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    // Formulaire de configuration pour générer un QR Code personnalisé
    echo '<form action="index.php" method="post">
        Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';
        
    // Boucle pour créer les options de taille de matrice dans le formulaire
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;
        <input type="submit" value="GENERATE"></form><hr/>';
        // Bouton pour soumettre le formulaire et générer un QR Code
        
    // Affiche un benchmark de performance pour la génération du QR Code
    QRtools::timeBenchmark();    
?>
