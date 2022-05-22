



<div class="row p-4 p-5">

    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex align-items-center">
                <h3 class="card-title flex-grow-1"><i class="fas fa-list fa-2x"></i>Liste des articles</h3>
                <div class="card-tools d-flex align-items-center">
                    <a class="btn btn-link text-white d-block" id="btn" wire:click="showArticleModal"><i class="fas fa-user-plus"></i>Ajouter article</a>
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

            <div class="card-body table-responsive p-0 table-striped" >
               <div class="d-flex justify-content-end p-4 bg-gray-light">
                   <div class="form-group mr-2">
                       <label for="filtreType">Filtrer par type</label>
                       <select id="filtreType" class="form-control" wire:model="filtreType">
                           <option value=""></option>
                           @foreach($typeArticle as $type)
                           <option value="{{$type->id}}">{{$type->nom}}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group">
                       <label for="filtreEtat">Filtrer par Etat</label>
                       <select id="filtreEtat" class="form-control" wire:model="filtreEtat">
                           <option value=""></option>
                           <option value="1">Disponible</option>
                           <option value="0">Indisponible</option>
                       </select>
                   </div>
               </div>
                <div style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th class="text-center">Article</th>
                        <th class="text-center">N°_série</th>
                        <th class="text-center">Type d'article</th>
                        <th class="text-center">Etat</th>
                        <th class="text-center">Ajoutée</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    @forelse($articles as $article)
                        <tr>
                            <td>
                                    <img src="{{ asset($article->imageUrl) }}" alt="" style="width: 60px", height="60px">
                            </td>
                            <td class="text-center">{{$article->nom}}</td>
                            <td class="text-center">{{$article->numeroSerie}}</td>
                            <td class="text-center">{{$article->type->nom}}</td>
                            <td class="text-center">
                                @if($article->estDisponible)
                                    <span class="badge badge-success">Disponible</span>
                                @else
                                    <span class="badge badge-danger">Indisponible</span>
                                @endif
                            </td>
                            <td class="text-center">{{ optional($article->created_at)->diffForHumans() }}</td>

                            <td class="text-center">
                                <button class="btn btn-link" wire:click="editArticle({{$article->id}})"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link"  wire:click="confirmDelete('{{$article->nom}}', {{$article->id}})"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger">
                                    <h5><i class="icon fas fa-ban fas-2x"></i>Information !</h5>
                                    Aucune information par rapport à cette recherche.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>




