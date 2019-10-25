<?php
    class Commune{
        private $_connectionDB;
        private $_table_name = "communes";

        function __construct($_db){

            $this->_connectionDB = $_db;
        }

        function getAllCommune(){
            $this->_valeurChamp['list_Commune'] = $query = "SELECT * FROM ".$this->_table_name;
            $statement = $this->_connectionDB->prepare($query);
            $statement->execute();
            while($list_commune = $statement->fetchAll()){
                if(!empty($list_commune)){
                    $this->_valeurChamp['list_commune'] = $list_commune;
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