<?php

class Client {

private $_connectionDB;
private $_table_name = "clients";

public $_client_id;
public $_client_nom;
public $_client_prenom;
public $_client_email;
public $_client_telephone;
public $_client_mot_de_pass;
public $_client_date_inscription;
public $_valeurChamp = array();

    function __construct($_db){

        $this->_connectionDB = $_db;
    }

    function createClient(){
        if($this->isNewClient()){
            $query = "INSERT INTO " .$this->_table_name. " SET nom_clients=:nom, prenom_clients=:prenom, email_clients=:email, telephone_clients=:tel, mot_de_pass_clients=:mdp";
            $statement = $this->_connectionDB->prepare($query);
    
            $this->_client_nom = htmlspecialchars(trim($this->_client_nom));
            $this->_client_prenom = htmlspecialchars(trim($this->_client_prenom));
            $this->_client_email = htmlspecialchars(trim( $this->_client_email));
            $this->_client_telephone = htmlspecialchars( trim($this->_client_telephone));
            $this->_client_mot_de_pass = htmlspecialchars(trim($this->_client_mot_de_pass));
        
            $statement->bindValue(":nom", $this->_client_nom);
            $statement->bindValue(":prenom", $this->_client_prenom);
            $statement->bindValue(":email", $this->_client_email);
            $statement->bindValue(":tel", $this->_client_telephone);
            $statement->bindValue(":mdp", $this->_client_mot_de_pass);
            
            if($statement->execute()){
                $statement->closeCursor();
                return true;
            }       
            return false;
        }
    }    

    function isNewClient(){
        $query = "SELECT * FROM " .$this->_table_name. " WHERE email_clients=:email";
        $statement = $this->_connectionDB->prepare($query);
        $this->_client_email = htmlspecialchars(trim($this->_client_email));
        $statement->bindValue(":email", $this->_client_email);
        $statement->execute();
        $verif_user_exists = $statement->rowCount();
        if($verif_user_exists == 0){
            $statement->closeCursor();
            return true;
        } 
        $this->_valeurChamp['desole'] = $verif_user_exists;
        return false;  
    }

    function updateClient(){
        $query = "UPDATE " .$this->_table_name. " SET nom_clients=:nom, prenom_clients=:prenom, email_clients=:email, telephone_clients=:tel, mot_de_pass_clients=:mdp WHERE id_clients=:id";
        $this->_valeurChamp['query'] = $statement = $this->_connectionDB->prepare($query);

        $this->_valeurChamp['nom'] = $this->_client_nom = htmlspecialchars(trim($this->_client_nom));
        $this->_valeurChamp['prenom'] = $this->_client_prenom = htmlspecialchars(trim($this->_client_prenom));
        $this->_valeurChamp['email'] = $this->_client_email = htmlspecialchars(trim( $this->_client_email));
        $this->_valeurChamp['tel'] = $this->_client_telephone = htmlspecialchars( trim($this->_client_telephone));
        $this->_valeurChamp['mdp'] = $this->_client_mot_de_pass = htmlspecialchars(trim($this->_client_mot_de_pass));
        $this->_valeurChamp['id'] = $this->_client_id = htmlspecialchars(trim($this->_client_id));

        $statement->bindValue(":nom", $this->_client_nom);
        $statement->bindValue(":prenom", $this->_client_prenom);
        $statement->bindValue(":email", $this->_client_email);
        $statement->bindValue(":tel", $this->_client_telephone);
        $statement->bindValue(":mdp", $this->_client_mot_de_pass);
        $statement->bindValue(":id", $this->_client_id);
        
        if($statement->execute()){
            $statement->closeCursor();

            return true;
        }       
        return false;
    }

    function deleteClient(){
        $query = "DELETE FROM " .$this->_table_name. " WHERE id_clients=:id";
        $this->_valeurChamp['query'] = $statement = $this->_connectionDB->prepare($query);
        $this->_valeurChamp['id'] = $this->_client_id = htmlspecialchars(trim($this->_client_id));
        $statement->bindValue(":id", $this->_client_id);
        
        if($statement->execute()){
            $statement->closeCursor();

            return true;
        }       
        return false;
    }

    function deleteAllClient(){
        $query = "DELETE FROM " .$this->_table_name;
        $this->_valeurChamp['query'] = $statement = $this->_connectionDB->prepare($query);        
        if($statement->execute()){
            $statement->closeCursor();
            return true;
        }       
        return false;
    }

    function getAllClient(){
        $query = "SELECT * FROM " .$this->_table_name;
        $this->_valeurChamp['query'] = $statement = $this->_connectionDB->prepare($query);
        $statement->execute();
        $get_all_clients = $statement->fetch();
        if(!empty($get_all_clients)){
            $this->_valeurChamp['Client'] = $get_all_clients;
            $statement->closeCursor();
            return true;
        } 
        else if(empty($get_all_clients)){
            $this->_valeurChamp['Client'] = "la base de donnes est vide.";
            return false;
        }      
        return false;
    }

    function getOneClient(){
        $query = "SELECT * FROM " .$this->_table_name." WHERE id_clients=:id";
        $this->_valeurChamp['query'] = $statement = $this->_connectionDB->prepare($query);
        $this->_valeurChamp['id'] = $this->_client_id = htmlspecialchars(trim($this->_client_id));
        $statement->bindValue(":id", $this->_client_id);
        $statement->execute();
        $get_all_clients = $statement->fetch();
        if(!empty($get_all_clients)){
            $this->_valeurChamp['Client'] = $get_all_clients;
            $statement->closeCursor();
            return true;
        }  
        return false;
    }

    function logClient(){
        $query = "SELECT * FROM " .$this->_table_name. " WHERE email_clients=:mail and mot_de_pass_clients=:passw";
        $statement = $this->_connectionDB->prepare($query);
        $this->_client_email = htmlspecialchars(trim($this->_client_email));
        $this->_client_mot_de_pass = htmlspecialchars(trim($this->_client_mot_de_pass));
        $statement->bindValue(":mail", $this->_client_email);
        $statement->bindValue(":passw", $this->_client_mot_de_pass);
        $statement->execute();
        $verif_user_exists = $statement->rowCount();
        if($verif_user_exists == 1){
            $verif_user_exists = $statement->fetch();
            $this->_valeurChamp['idClients'] = $verif_user_exists['id_clients'];
            $this->_valeurChamp['nomlients'] = $verif_user_exists['nom_clients'];
            $this->_valeurChamp['prenomClients'] = $verif_user_exists['prenom_clients'];
            $this->_valeurChamp['emailClients'] = $verif_user_exists['email_clients'];
            $this->_valeurChamp['telephoneClients'] = $verif_user_exists['telephone_clients'];
            $this->_valeurChamp['mot_de_passClients'] = $verif_user_exists['mot_de_pass_clients'];
            $statement->closeCursor();
            return true;
        }
        return false;
    }
    
}