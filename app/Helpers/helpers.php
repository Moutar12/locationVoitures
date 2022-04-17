<?php

        function userFullName(){
            return auth()->user()->prenom . " " . auth()->user()->nom;
        }

        function getRoleName(){
            $roleName= "";
            $i = 0;
            foreach (auth()->user()->roles as $role){
                $roleName .= $role->libelle;
                if ($i < sizeof(auth()->user()->roles) - 1){
                    $roleName .= ",";
                }
                $i++;
            }
            return $roleName;
        }

