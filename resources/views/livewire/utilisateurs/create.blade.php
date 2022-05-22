<div class="row p-4 p-5 justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Formulaire de création de nouvel utilisateur</h3>
            </div>


            <form role="form" wire:submit.prevent="addUser()" method="post">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Prénom</label>
                                <input type="text"  wire:model="newUser.prenom" class="form-control
                                @error("newUser.prenom") is-invalid @enderror">
                                @error("newUser.prenom") <span class="text-danger"> {{$message}} </span> @enderror

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Nom</label>
                                <input type="text" wire:model="newUser.nom"  class="form-control @error("newUser.nom") is-invalid @enderror">
                                @error("newUser.nom") <span class="text-danger"> {{$message}} </span>@enderror
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label >Sexe</label>
                        <select  wire:model="newUser.sexe" class="form-control @error("newUser.sexe") is-invalid @enderror">
                        @error("newUser.sexe") <span class="text-danger"> {{$message}} </span> @enderror
                            <option value="">--------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Adresse e-email</label>
                                <input type="text"  wire:model="newUser.email" class="form-control @error("newUser.email") is-invalid @enderror">
                                @error("newUser.email") <span class="text-danger"> {{$message}} </span>@enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label >Télephone</label>
                                <input type="text" wire:model="newUser.telephone" class="form-control @error("newUser.telephone") is-invalid @enderror">
                                @error("newUser.telephone") <span class="text-danger"> {{$message}} </span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label >Pièce d'identité</label>
                                <select  wire:model="newUser.pieceIdentite" class="form-control @error("newUser.pieceIdentite") is-invalid @enderror">
                                @error("newUser.pieceIdentite") <span class="text-danger"> {{$message}} </span> @enderror
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
                                <input type="text" wire:model="newUser.numeroPieceIdentite" class="form-control @error("newUser.numeroPieceIdentite") is-invalid @enderror">
                                @error("newUser.numeroPieceIdentite") <span class="text-danger"> {{$message}} </span> @enderror
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
</div>


