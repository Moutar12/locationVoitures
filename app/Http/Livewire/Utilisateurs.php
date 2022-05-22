<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use withPagination;


    protected $paginationTheme = "bootstrap";

    public $isActive = false;

    public  $currentPage = PAGELISTE;

    public $newUser = [];
    public $editUser = [];
    public $rolesPermission = [];


    /// Validationdes champs /---------------------------------------------------------------------------------/

    public function rules(){
        if ($this->currentPage == PAGEEDITUSER){
            return [
                'editUser.prenom' => 'required',
                'editUser.nom' => 'required',
                'editUser.sexe' => 'required',
                'editUser.telephone' => ['required', "numeric", Rule::unique("users", "telephone")->ignore($this->editUser['id'])],
                'editUser.pieceIdentite' => 'required',
                'editUser.numeroPieceIdentite' => 'required',
                'editUser.email' => ['required', "email", Rule::unique("users", "email")->ignore($this->editUser['id'])],
            ];
        }

        return [
            'newUser.prenom' => 'required',
            'newUser.nom' => 'required',
            'newUser.sexe' => 'required',
            'newUser.telephone' => 'required|numeric|unique:users,telephone',
            'newUser.pieceIdentite' => 'required',
            'newUser.numeroPieceIdentite' => 'required',
            'newUser.email' => 'required|email',
        ];
    }

    // View globale des utilisateur ///-----------------------------------------------------------//

    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.utilisateurs.index', [
            "users" => User::latest()->paginate(5)
        ])->extends("layouts.master")->section("contenu");
    }

    // View formulaire de création d'un utilisateur /--------------------------------------------/
    public function goToFormCreaate(){
        $this->currentPage = PAGECREATEUSER;
    }

    // View liste des utilisateurs /--------------------------------------------------------------------------/
    public function goToListUser(){
        $this->currentPage = PAGELISTE;
        $this->editUser = [];
    }

    // View edit utilisateur /------------------------------------------------------------------------------------/
    public function goToEditUser($id){
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITUSER;

        $this->getRolePermission();
    }

    public function  getRolePermission(){

        $this->rolesPermission["roles"] = [];
        $this->rolesPermission["permissions"] = [];

        // Logique pour charger les roles et permission /---------------------------------------------------------------/

        $recupId = function ($value){
            return $value['id'];
        };

        $roleIds = array_map($recupId, User::find($this->editUser["id"])->roles->toArray()); // [1, 2, 4]
        $permissionIds = array_map($recupId, User::find($this->editUser["id"])->permissions->toArray()); // [1, 2, 4]

        foreach(Role::all() as $role){
            if(in_array($role->id, $roleIds)){
                array_push($this->rolesPermission["roles"], ["role_id"=>$role->id, "role_libelle"=>$role->libelle, "active"=>true]);
            }
            else{
                array_push($this->rolesPermission["roles"], ["role_id"=>$role->id, "role_libelle"=>$role->libelle, "active"=>false]);
            }
        }


        foreach(Permission::all() as $permission){
            if(in_array($permission->id, $permissionIds)){
                array_push($this->rolesPermission["permissions"], ["permission_id"=>$permission->id, "permission_libelle"=>$permission->libelle, "active"=>true]);
            }else{
                array_push($this->rolesPermission["permissions"], ["permission_id"=>$permission->id, "permission_libelle"=>$permission->libelle, "active"=>false]);
            }
        }

    }

    public function updateRoleAndPermission(){
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete();

        foreach ($this->rolesPermission["roles"] as $role){
            if ($role["active"]){
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
            }
        }

        foreach ($this->rolesPermission["permissions"] as $permission){
            if ($permission["active"]){
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]);
            }
        }

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Rôle et permission mis à jour avec succès!"]);

    }



    public function addUser(){
        //vérifier si les informations passées dans le formulaire sont valides
        $attributValid = $this->validate();
        $attributValid["newUser"]["password"] = "password";
        User::create($attributValid["newUser"]);
        $this->newUser =[];

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Ulisateur crée"]);
    }

    public function updateUser(){
        // Vérifier que les informations envoyées par le formulaire sont correctes
        $validationAttributes = $this->validate();


        User::find($this->editUser["id"])->update($validationAttributes["editUser"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur mis à jour avec succès!"]);

    }

    public function confirmresetPassword(){
        $this->dispatchBrowserEvent("showConfirmMessage", [
            "message" => [
                "title" => "Ètes vous sûr de continuer",
                "text" => "Vous étes sur le point de réinitialiser le mot de passe cet utilisateur. Voulez-vous continuer?",
                "type" => "warning",
            ]
        ]);
    }

    public function resetPassword(){
        User::find($this->editUser["id"])->update(["password" => Hash::make(DEFAULTPASSWORD)]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Password réintialiser avec succès!"]);
    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", [
            "message" => [
                "title" => "Ètes vous sûr de continuer",
                "text" => "Vous étes sur le point de supprimer $name de la liste des utilisateurs",
                "type" => "warning",
            "data" => [
                "user_id" => $id,
            ]
        ]
        ]);
    }

    public function deleteUser($id){
        User::destroy($id);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message" => "Ulisateur supprimé avec successé"]);
    }

}
