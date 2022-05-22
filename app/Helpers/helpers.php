<?php

use Illuminate\Support\Str;

define("PAGELISTE", "liste");
define("PAGECREATEUSER", "create");
define("PAGEEDITUSER", "edit");
define("DEFAULTPASSWORD", "password");


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


function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}
