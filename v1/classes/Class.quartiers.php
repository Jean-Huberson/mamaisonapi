<?php
    class Quartier{
        private $_connectionDB;
        private $_table_name = "quartiers";

        function __construct($_db){

            $this->_connectionDB = $_db;
        }

        function getAllQuartier(){
            $this->_valeurChamp['list_Quartier'] = $query = "SELECT * FROM ".$this->_table_name;
            $statement = $this->_connectionDB->prepare($query);
            $statement->execute();
            while($list_quartier = $statement->fetchAll()){
                if(!empty($list_quartier)){
                    $this->_valeurChamp['list_quartier'] = $list_quartier;
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