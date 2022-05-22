<div>
@include("livewire.typesArticles.listTypeArticle")



@include("livewire.typesArticles.addProp")



@include("livewire.typesArticles.editProp")


</div>









<script>
    window.addEventListener("showEdit", function (e){
        Swal.fire({
            title: 'Modifier type article',
            input: 'text',
            inputValue: e.detail.typeArticleName.nom,
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Ce champ est obligatoire'
                }

                @this.updateTypeArticle(e.detail.typeArticleName.id, value)
            }
        })
    });




    window.addEventListener("showConfirmMessage", event => {
        Swal.fire({
            title: event.detail.message.title,
            text: event.detail.message.text,
            icon: event.detail.message.type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer !',
            cancelButtonText: 'Annuler !'
        }).then((result) => {
            if (result.isConfirmed) {
                if(event.detail.message.data.type_article_id){
                    @this.deleteTypeArticle(event.detail.message.data.type_article_id)
                }
                if(event.detail.message.data.propriete_id){
                    @this.showDeleteProp(event.detail.message.data.propriete_id)
                }

            }

        })

    });

</script>

<script>
    window.addEventListener("showMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title: event.detail.message || "Opération effectuée avec succès!",
                showConfirmButton: false,
                timer: 5000
            }
        )
    })
</script>


<script>
    window.addEventListener("showModal", event=>{
        $("#modalProp").modal("show")
    })

    window.addEventListener("closeModal", event=>{
        $("#modalProp").modal("hide")
    })

    window.addEventListener("showEditModal", event=>{
        $("#editModalPop").modal("show")
    })
    window.addEventListener("closeEditModal", event=>{
        $("#editModalPop").modal("hide")
    })
</script>

