<div>

    @if($editArticle != [])
        @include("livewire.articles.edit")
    @endif

    @include("livewire.articles.liste")



    @include("livewire.articles.add")






</div>









<script>
    window.addEventListener("showEdit", function (e){

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

                }
                if(event.detail.message.data.propriete_id){

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
    window.addEventListener("showModal", event=> {
            $("#addArticle").modal("show")


    })

    window.addEventListener("closeModal", event=>{
        $("#addArticle").modal("hide")
    })

    window.addEventListener("showEditModal", event=>{
        $("#editArticle").modal("show")
    })
    window.addEventListener("closeEditModal", event=>{
        $("#editArticle").modal("hide")
    })
</script>

