



<div class="row p-4 p-5">

    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-list fa-2x"></i>Liste des types d'article</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white d-block"  wire:click="toggleShowForm()"><i class="fas fa-user-plus"></i>Nouveau type d'article</a>
                    <div class="input-group input-group-md" style="width: 250px;">
                        <input type="text" name="table_search" wire:model.debounce.500ms="search" class="form-control float-right" placeholder="Search">
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
                        <th style="width:50%; ">Type d'article</th>
                        <th style="width:20%; " class="text-center">Ajoutée</th>
                        <th style="width:30%; " class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($isBoolean)
                        <tr>
                            <td colspan="2">
                                <input type="text" class="form-control @error("typeArticleName") is-invalid @enderror" wire:model="typeArticleName">
                                @error("typeArticleName")
                                <span class="text-danger"> {{$message}} </span>
                                @enderror
                            </td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click="addNewTypeArticle()"><i class="fa fa-check">Valider</i></button>
                                <button class="btn btn-link"  ><i class="far fa-trash-alt" wire:click="toggleShowForm()">Annuler</i></button>
                            </td>
                        </tr>
                    @endif
                    @foreach($typeArticle as $type)
                        <tr>
                            <td>{{$type->nom}}</td>
                            <td class="text-center">{{ optional($type->created_at)->diffForHumans() }}</td>

                            <td class="text-center">
                                <button class="btn btn-link" wire:click="editTypeArticle({{$type->id}})"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link" wire:click="showProp({{$type->id}})"><i class="fa fa-list"></i>Propriété</button>
                                @if(count($type->articles) == 0)
                                <button class="btn btn-link"  wire:click="confirmDelete('{{$type->nom}}', {{$type->id}})"><i class="far fa-trash-alt"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $typeArticle->links() }}
                </div>
            </div>
        </div>
    </div>
</div>




