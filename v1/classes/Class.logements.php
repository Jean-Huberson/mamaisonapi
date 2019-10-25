<?php
class Logement {

    private $_connectionDB;
    private $_table_name = "V_logements";
    private $_formule_vente = "vente";
    private $_formule_location = "Location";
    private $_formule_residence = 'Residence';
    
    public $_id_logements;
    public $_adresse_logements;
    public $_superficie_logements;
    public $_prix_logements;
    public $_nombres_de_pieces_logments;
    public $_nombre_de_chambres_logments;
    public $_description_logements;
    public $_description_quartier;
    public $_description_commune;
    public $_description_types_offres;
    public $_description_types_logements;
    public $_reference_medias;
    public $_valeurChamp = array();
    
    function __construct($_db){

        $this->_connectionDB = $_db;
    }

    function getAllSales(){
        $this->_valeurChamp['list_Log'] =  $query = "SELECT * FROM ".$this->_table_name. " WHERE (description_type_offres = '$this->_formule_vente')";
        $statement = $this->_connectionDB->prepare($query);
        $statement->execute();
        while($list_loge = $statement->fetchAll()){
            if(!empty($list_loge)){
                $this->_valeurChamp['list_Log'] = $list_loge;
                return true;
            }
            else{
                $this->_valeurChamp['list_Log'] = "Aucun logement trouvé";
                return false;
            }
                
        }

    }

    function getAllLocations(){
        $query = "SELECT * FROM ".$this->_table_name. " WHERE (description_type_offres = '$this->_formule_location')";
        $statement = $this->_connectionDB->prepare($query);
        $statement->execute();
        while($list_loge = $statement->fetchAll()){
            if(!empty($list_loge)){
                $this->_valeurChamp['list_Location'] = $list_loge;
                return true;
            }
            else{
                $this->_valeurChamp['list_Log'] = "Aucun logement trouvé";
                return false;
            }                
        }
    }

    function getAllResidences(){
        $this->_valeurChamp['list_Log'] = $query = "SELECT * FROM ".$this->_table_name. " WHERE (description_type_offres = '$this->_formule_residence')";
        $statement = $this->_connectionDB->prepare($query);
        $statement->execute();
        while($list_loge = $statement->fetchAll()){
            if(!empty($list_loge)){
                $this->_valeurChamp['list_Residence'] = $list_loge;
                return true;
            }
            else{
                $this->_valeurChamp['error'] = "Aucun logement trouvé";
                return false;
            }
                
        }

        $this->_valeurChamp['error'] = "on n'est pas entré";
        return false;

    }

    
}
