<div class="modal fade" id="addArticle"  role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un article</h5>
            </div>
            <form wire:submit.prevent="ajoutArticle">

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
                           <input type="text" wire:model="addArticle.nom"  class="form-control">
                       </div>

                       <div class="form-group">
                           <label for="numeroSerie">N°_Série</label>
                           <input type="text"  wire:model="addArticle.numeroSerie" class="form-control">
                       </div>
                       <div class="form-group">
                           <label for="type">Type</label>
                           <select class="form-control" wire:model="addArticle.type">
                               <option value=""></option>
                               @foreach($typeArticle as $type)
                                   <option value="{{$type->id}}">{{$type->nom}}</option>
                               @endforeach
                           </select>
                       </div>
                        @if($proprietesArticles != null)
                       <div class="">
                            @foreach($proprietesArticles as $propriete)
                               <label for="">{{$propriete->nom}}  @if(!$propriete->estObligatoire) (optionel) @endif </label>

                               @php
                                    $inputF = "addArticle.prop.". $propriete->nom;
                               @endphp

                               <input type="text"  wire:model="{{$inputF}}"  class="form-control">
                           @endforeach
                       </div>
                       @endif

                   </div>

                   <div class="p-4" >
                       <div class="form-group">
                           <input type="file" wire:model="addPhoto" id="{{$resetInputFile}}">
                       </div>
                       <div style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
                           @if ($addPhoto)
                               <img src="{{ $addPhoto->temporaryUrl() }}" style="width: 200px; height: 200px">
                           @endif
                       </div>
                   </div>

               </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" wire:click="closeModal">Fermer</button>
                <button type="submit"  class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>
