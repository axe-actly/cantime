<?php

// $requete = entree('plateau 3','out');

function entree($tag_plateau,$entree_sortie){
  $database = new mysqli('localhost', 'root', '', 'cantime');
  $sql="SELECT * FROM  `plateaux` WHERE  `tag_nfc_plateau` LIKE  '".$tag_plateau."'";
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $resultat = $requete->fetch_assoc();
  if(isset($resultat["id"])){ // si le plateau existe déjà dans la base de données
    update($resultat["id"],$entree_sortie);
  }else{                      // le plateau n'existe pas => création
    create($tag_plateau,$entree_sortie);
  }
//     echo '<html><h1>test</h1></html>';
  $requete->close(); // seulement si on utilise select
  $database->close();
  historique($tag_plateau,$entree_sortie);  //  sauvegarde du plateau sur la table historique
}

function create($tag_plateau,$entree_sortie){
  $database = new mysqli('localhost', 'root', '', 'cantime');
  $sql = "INSERT INTO  `plateaux` (`id` ,`tag_nfc_plateau` ,`presence`) VALUES (NULL ,  '".$tag_plateau."',  '".$entree_sortie."')";
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $database->close();
  echo 'creation succes';
}

function update($id,$entree_sortie){
  $database = new mysqli('localhost', 'root', '', 'cantime');
  $sql = "UPDATE  `plateaux` SET  `presence` =  '".$entree_sortie."' WHERE  `id` =".$id;
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $database->close();
  echo 'update succes';
}

function compte(){
  $database = new mysqli('localhost', 'root', '', 'cantime');
  $sql = "SELECT COUNT( `id` ) FROM `plateaux` WHERE `presence` = 'in'";
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $database->close();
  return $requete->fetch_row();
}

function historique($tag_plateau,$entree_sortie){
  $database = new mysqli('localhost', 'root', '', 'cantime');
  $sql="SELECT * FROM  `plateaux` WHERE  (`tag_nfc_plateau` LIKE '".$tag_plateau."')";
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $resultat = $requete->fetch_assoc();
  $sql="INSERT INTO  `historique` (`id`, id_plateau ,`date` ,`inout`) VALUES (NULL , '".$resultat['id']."', NULL , '".$entree_sortie."')";
  $requete = $database->query($sql) or trigger_error($mysqli->error."[$sql]");
  $database->close();
  echo 'historique updated'.$sql;
}
