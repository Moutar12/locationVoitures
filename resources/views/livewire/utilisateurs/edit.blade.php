<div class="row p-4 p-5 ">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Formulaire d'édition d'un utilisateur</h3>
            </div>


            <form role="form" wire:submit.prevent="updateUser()" method="post">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Prénom</label>
                                <input type="text"  wire:model="editUser.prenom" class="form-control
                                @error("editUser.prenom") is-invalid @enderror">
                                @error("editUser.prenom") <span class="text-danger"> {{$message}} </span> @enderror

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Nom</label>
                                <input type="text" wire:model="editUser.nom"  class="form-control @error("editUser.nom") is-invalid @enderror">
                                @error("editUser.nom") <span class="text-danger"> {{$message}} </span>@enderror
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label >Sexe</label>
                        <select  wire:model="editUser.sexe" class="form-control @error("editUser.sexe") is-invalid @enderror">
                            @error("editUser.sexe") <span class="text-danger"> {{$message}} </span> @enderror
                            <option value="">--------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Adresse e-email</label>
                                <input type="text"  wire:model="editUser.email" class="form-control @error("editUser.email") is-invalid @enderror">
                                @error("editUser.email") <span class="text-danger"> {{$message}} </span>@enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Télephone</label>
                                <input type="text" wire:model="editUser.telephone" class="form-control @error("editUser.telephone") is-invalid @enderror">
                                @error("editUser.telephone") <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Pièce d'identité</label>
                                <select  wire:model="editUser.pieceIdentite" class="form-control @error("editUser.pieceIdentite") is-invalid @enderror">
                                    @error("editUser.pieceIdentite") <span class="text-danger"> {{$message}} </span> @enderror
                                    <option value="">--------------</option>
                                    <option value="CNI">CNI</option>
                                    <option value="PASSPORT">PASSPORT</option>
                                    <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Numéro pièce d'identité</label>
                                <input type="text" wire:model="editUser.numeroPieceIdentite" class="form-control @error("editUser.numeroPieceIdentite") is-invalid @enderror">
                                @error("editUser.numeroPieceIdentite") <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label >Password</label>
                        <input type="text" class="form-control" disabled placeholder="Password">
                    </div>

                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-danger" wire:click="goToListUser()">Retour en arrière</button>
                    <button type="submit" class="btn btn-primary" >Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-key fa-2x"></i>Réinitialiser le mot de passe</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>
                                    <a href="" class="btn btn-link" wire:click.prevent="confirmresetPassword()">Réintialiser le mot de passe</a>
                                    <span>par défaut: password</span>
                                </li>
                            </ul>
                        </div>

                    </div>

            </div>

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i>Rôle et Permission</h3>
                        <button class="btn bg-gradient-success" wire:click.prevent="updateRoleAndPermission()"><i class="fas fa-check"></i>Appliquer les modification</button>
                    </div>

                    <div class="card-body">
                        <div id="accordion">
                            @foreach($rolesPermission["roles"] as $role)
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h1 class="card-title flex-grow-1">
                                        <a href="" data-parent="#accordion" aria-expanded="true">
                                            {{$role["role_libelle"]}}
                                        </a>
                                    </h1>
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch{{$role["role_id"]}}"
                                            @if($role["active"]) checked @endif  wire:model.lazy="rolesPermission.roles.{{$loop->index}}.active">
                                        <label for="customSwitch{{$role["role_id"]}}" class="custom-control-label">{{$role['active']? "Activé" : "Désactivé"}}</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>permission</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                    @foreach($rolesPermission["permissions"] as $permission)
                                        <tr>
                                            <td>{{$permission["permission_libelle"]}}</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchPermission{{$permission["permission_id"]}}"
                                                           @if($role["active"]) checked @endif  wire:model.lazy="rolesPermission.permissions.{{$loop->index}}.active">
                                                    <label for="customSwitchPermission{{$permission["permission_id"]}}" class="custom-control-label">{{$permission['active']? "Activé" : "Désactivé"}}</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>

