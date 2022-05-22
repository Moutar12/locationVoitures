<div class="modal fade" id="editModalPop" style="z-index: 1900" role="dialog" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Propriété article</h5>
            </div>

            <div class="modal-body">
                <div class="d-flex my-4 bg-gray-light p-3">
                    <div class="d-flex flex-grow-1 mr-2">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" placeholder="Nom" wire:model="editPropriete.nom" class="form-control @error("editPropriete.nom") is-invalid @enderror">
                            @error("editPropriete.nom")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="flex-grow-1">
                            <select class="form-control @error("editPropriete.estObligatoire") is-invalid @enderror" wire:model="editPropriete.estObligatoire">
                                <option value="">--Champ obligatoire--</option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" wire:click="updateProp()">Valider</button>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" wire:click="closeEditModal()">Fermer</button>
            </div>
        </div>
    </div>
</div>
