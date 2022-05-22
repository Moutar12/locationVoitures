<div class="modal fade" id="modalProp"  role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion des caractèristique de "{{ optional($selectTypeArticle)->nom }}"</h5>
            </div>

            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom" wire:model="newPropriete.nom" class="form-control @error("newPropriete.nom") is-invalid @enderror">
                            @error("newPropriete.nom")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control @error("newPropriete.estObligatoire") is-invalid @enderror" wire:model="newPropriete.estObligatoire">
                                <option value="">--Champ obligatoire--</option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click="addPropriete()">Ajouter</button>
                    </div>

                </div>
                <table class="table table-bordered">
                    <thead class="bg-primary">
                    <tr>
                        <th>Nom</th>
                        <th>Obligatoire</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($propiteArticle as $prop)
                        <tr>
                            <td>{{$prop->nom}}</td>
                            <td>{{$prop->estObligatoire == 1 ? "OUI" : "NON"}}</td>
                            <td>
                                <button class="btn btn-link" wire:click="editProp({{$prop->id}})"><i class="far fa-edit"></i></button>
                                    <button class="btn btn-link" wire:click="showConfirmDeleteProp('{{$prop->nom}}', {{$prop->id}})"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <span class="text-info">Cette propiété n'existe pas</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" wire:click="closeModal">Fermer</button>
            </div>
        </div>
    </div>
</div>
