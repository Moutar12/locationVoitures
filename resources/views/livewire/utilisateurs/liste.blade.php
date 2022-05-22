<div class="row p-4 p-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Liste des utilisateurs</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white d-block" wire:click.prevent="goToFormCreaate()"><i class="fas fa-user-plus"></i>Nouvel utilisateur</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th style="width:5%; ">Avatar</th>
                        <th style="width:5%; ">Sexe</th>
                        <th style="width:15%; ">Utilisateur</th>
                        <th style="width:10%; ">Rôles</th>
                        <th style="width:10%; " class="text-center">Ajoutée</th>
                        <th style="width:20%; " class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="data:image/jpeg;base64, {{$user->photo}}  )"/>;
                            </td>
                            <td>{{$user->sexe}}</td>
                            <td>{{ $user->prenom }} {{$user->nom}}</td>
                            <td>{{$user->AllRoleNames}}</td>
                            <td class="text-center"><span class="tag tag-success">{{ $user->created_at->diffForHumans()}}</span></td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="goToEditUser({{$user->id}})"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link"  wire:click="confirmDelete('{{ $user->prenom }} {{ $user->nom }}', {{$user->id}})"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


