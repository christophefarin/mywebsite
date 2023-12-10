<?php
/**
*  FICHIER : class_cart.php
*  https://codes-sources.commentcamarche.net/source/102874-php-panier-caddi-virtuel-en-session
*/

class cart{
  
  /**
  * Constructeur de la class
  */
  function __construct(){
    // Démarrage des sessions si pas déjà démarrées
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Initialisation du panier si pas déjà créé
    if(!isset($_SESSION['panier'])){
    $this->initCart();
    }
  }
  
  /**
  *Initialisation du panier
  */
  public function initCart(){
    $_SESSION['panier'] = array(); 
  }
  
  /**
  * Retourne le contenu du panier
  */
  public function getList(){
    return !empty($_SESSION['panier']) ? $_SESSION['panier'] : NULL;
  }
  
  /**
  * Ajout d'un produit au panier
  */
  public function addProduct($id_produit,$libelle_produit,$diam_ext_produit,$poids_produit,$section_utile_produit,$qte=1){
    if($qte > 0 ){
      $_SESSION['panier'][$id_produit] = array('id'=>$id_produit
                                                ,'produit'=>$libelle_produit
                                                ,'diametre'=>$diam_ext_produit //calculer la somme par produit en fonction de la quantité
                                                ,'poids'=>$poids_produit //calculer la somme par produit en fonction de la quantité
                                                ,'section'=>$section_utile_produit //calculer la somme par produit en fonction de la quantité
                                                ,'nombre'=>$qte
                                                ); 
      $this->updateSumOfProduct($id_produit);
    }else{
      return "ERREUR : Vous ne pouvez pas ajouter un produit sans quantité..."; 
    }
  }
  
  private function updateSumOfProduct($id_produit){
    if(isset($_SESSION['panier'][$id_produit])){
      $_SESSION['panier'][$id_produit]['diametre_Sum'] = $_SESSION['panier'][$id_produit]['nombre'] * $_SESSION['panier'][$id_produit]['diametre'];
      $_SESSION['panier'][$id_produit]['poids_Sum'] = $_SESSION['panier'][$id_produit]['nombre'] * $_SESSION['panier'][$id_produit]['poids'];
      $_SESSION['panier'][$id_produit]['section_Sum'] = $_SESSION['panier'][$id_produit]['nombre'] * $_SESSION['panier'][$id_produit]['section'];
    }
  }
  
  /**
  * Modifie la quantité d'un produit du panier
  */
  public function updateQteProduct($id_produit,$qte=0){
    if(isset($_SESSION['panier'][$id_produit])){
      if ($qte==0){$this->removeProduct($id_produit);}
      else{
      $_SESSION['panier'][$id_produit]['nombre'] = $qte;
      $this->updateSumOfProduct($id_produit);}
    }else{
      return "ERREUR : produit non présent dans le panier"; 
    }
  }
  
  /**
  * Supprime un produit du panier
  */
  public function removeProduct($id_produit){
    if(isset($_SESSION['panier'][$id_produit])){
      unset($_SESSION['panier'][$id_produit]);
    }
  }
  
  /**
  * Retourne le nombre de produits du panier
  */
  public function getNbProductsInCart(){
    $nb = 0;
    $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
    if(!empty($panier)){
      foreach($panier as $P){ 
        $nb += $P['nombre'];
      }
    }
    return $nb;
  }

  /**
  * Retourne le nombre de produits différents du panier
  * Ajout au code source (info nécessaire au plugin dataTables)
  */
  public function getNbIdProductsInCart(){
    $nbyId = 0;
    $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
    if(!empty($panier)){
        $nbyId = count($panier);
    }
    return $nbyId;
  }
  
  /**
  * Retourne les sommes (diamètres, poids et sections) et le diametre max des produits du panier
  */
  public function getSumsInCart(){
    $totaldiam = 0;
    $totalpoids = 0;
    $totalsection = 0;
    $maxdiam = 0;
    $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
    if(!empty($panier)){
      foreach($panier as $P){ 
        $totaldiam += $P['diametre_Sum'];
        $totalpoids += $P['poids_Sum'];
        $totalsection += $P['section_Sum'];
        $maxdiam = max($maxdiam,$P['diametre']);
      }
    }
    
    $totaldiamroud = number_format($totaldiam,2,'.',''); //Conversion au format numérique à 2 digits après la virgule
    $totalpoidsroud = number_format($totalpoids,2,'.','');
    $totalsectionroud = number_format($totalsection,2,'.','');
    $maxdiamroud = number_format($maxdiam,2,'.','');

    return [$totaldiamroud, $totalpoidsroud, $totalsectionroud, $maxdiamroud];
    /** pour exploiter les valeurs de résultats de la fonction : 
    * [$a, $b, $c, $d] = destructingFunction();
    * echo $a; //output: $maxdiam
    * echo $b; //output: $totaldiam
    * echo $c; //output: $totalpoids
    * echo $d; //output: $totalsection
    */
  }
  
}