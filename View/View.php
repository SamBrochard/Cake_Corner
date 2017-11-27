<?php

class View {

    // Nom du fichier associé à la vue
    private $file;

    public function __construct($action) {
        // Détermination du nom du fichier vue à partir de l'action
        $this->file = "View/view" . $action . ".phtml";
    }

    // Génère et affiche la vue
    public function create($data) {
        // creation de la vue
        $content = $this->createFile($this->file, $data);
        //creation du template
        $view = $this->createFile('View/Template.phtml',array('content' => $content));
        // Renvoi de la vue au navigateur
        echo $view;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function createFile($file, $data) {
        if (file_exists($file)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
           extract($data);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $file;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$file' introuvable");
        }
    }
}