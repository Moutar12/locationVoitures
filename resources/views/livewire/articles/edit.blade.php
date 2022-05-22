<div class="modal fade" id="editArticle"  role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un article</h5>
            </div>
            <form wire:submit.prevent="updateArticle">

                <div class="modal-body" style="overflow: scroll; height: 400px">
                    <div class="d-flex">
                        <div class="my-4 bg-gray-light p-3 flex-grow-1">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <h5><i class="icon fas fa-ban fas-2x"></i>Erreur de validation !</h5>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" wire:model="editArticle.nom"  class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="numeroSerie">N°_Série</label>
                                <input type="text"  wire:model="editArticle.numeroSerie" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" wire:model="editArticle.type_article_id">
                                    <option value=""></option>

                                        <option value="{{$editArticle["type_article_id"]}}">{{$editArticle["type"]["nom"]}}</option>

                                </select>
                            </div>
                            @if($editArticle["article_proprietes"] != [])
                                <div class="">
                                    @foreach($editArticle["article_proprietes"] as $index => $proprieteArticle)
                                        <label for="">{{$proprieteArticle["propriete"]["nom"]}}  @if(!$proprieteArticle["propriete"]["estObligatoire"]) (optionel) @endif </label>

                                        <input type="text"  wire:model="editArticle.article_proprietes.{{$index}}.valeur"  class="form-control">
                                    @endforeach
                                </div>
                            @endif

                        </div>

                        <div class="p-4" >
                            <div class="form-group">
                                <input type="file" wire:model="editPhoto" id="{{$resetInputFile}}">
                            </div>
                            <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                                @if (isset($editPhoto))
                                    <img src="{{ $editPhoto->temporaryUrl() }}" style="width: 200px; height: 200px">
                                @else
                                    <img src="{{ asset($editArticle["imageUrl"] )}}" style="width: 200px; height: 200px">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-danger" wire:click="closeEditModal">Fermer</button>
                    <button type="submit"  class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
