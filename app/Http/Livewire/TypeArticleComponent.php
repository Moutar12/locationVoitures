<?php

namespace App\Http\Livewire;

use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TypeArticleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $isBoolean = false;
    public $typeArticleName = "";
    public $newValue = "";
    public $selectTypeArticle;
    public $newPropriete = [];
    public $editPropriete = [];

    public $search = "";

    public function render()
    {
        Carbon::setLocale("fr");
        $searchCritera = "%".$this->search. "%";
        $data = [
          "typeArticle" => TypeArticle::where("nom", "like", $searchCritera)->latest()->paginate(5),
            "propiteArticle" => ProprieteArticle::where("type_article_id", optional($this->selectTypeArticle)->id)->get()
        ];
        return view('livewire.typesArticles.index', $data)
            ->extends("layouts.master")->section("contenu");
    }

    public function toggleShowForm(){
        if ($this->isBoolean){
            $this->isBoolean = false;
            $this->typeArticleName ="";
            $this->resetErrorBag(["typeArticleName"]);
        }else{
            $this->isBoolean = true;
        }
    }

    public function addNewTypeArticle(){

        $validates = $this->validate([
            "typeArticleName" => "required|max:50|unique:type_articles,nom"
        ]);
        TypeArticle::create([ "nom" => $validates["typeArticleName"]]);
        $this->toggleShowForm();
    }

    public function editTypeArticle($id){
        $edit = TypeArticle::find($id);
        $this->dispatchBrowserEvent("showEdit", ["typeArticleName"=>$edit]);
    }

    public function updateTypeArticle($id, $formValueJs){
        $this->newValue = $formValueJs;
        $validates = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("type_articles", "nom")->ignore($id)]
        ]);

        TypeArticle::find($id)->update(["nom" => $validates["newValue"]]);
    }

    public function confirmDelete($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", [
            "message" => [
                "title" => "Ètes vous sûr de continuer",
                "text" => "Vous étes sur le point de supprimer $name de la liste des types d'articles",
                "type" => "warning",
                "data" => [
                    "type_article_id" => $id,
                ]
            ]
        ]);
    }

    public function deleteTypeArticle(TypeArticle $typeArticle){
        $typeArticle->delete();
    }


    public function addPropriete(){

        $validates = $this->validate([
            "newPropriete.nom" => ["required", Rule::unique("propriete_articles", "nom")->where("type_article_id",$this->selectTypeArticle->id)],
            "newPropriete.estObligatoire" => "required"
        ]);

        ProprieteArticle::create([
            "nom" => $this->newPropriete["nom"],
            "estObligatoire" => (int) $this->newPropriete["estObligatoire"],
            "type_article_id" => $this->selectTypeArticle->id
        ]);
        $this->newPropriete = [];
        $this->resetErrorBag();

        $this->dispatchBrowserEvent("showMessage", ["message" => "Propriété ajouté avec succès"]);
    }


    public function showConfirmDeleteProp($name, $id){
        $this->dispatchBrowserEvent("showConfirmMessage", [
            "message" => [
                "title"=> "Ètes vous sûr de continuer",
                "text" => "Vous étes sur le point de supprimer '$name' de la liste des Propriétés",
                "type" => "warning",
                "data" => [
                    "propriete_id" => $id
                ]
            ]
        ]);
    }

    public function showDeleteProp(ProprieteArticle $article){
        $article->delete();
        $this->dispatchBrowserEvent("showMessage", ["message" => "Propriété supprimée avec succès"]);
    }



    public function showProp(TypeArticle $typeArticle){
        $this->selectTypeArticle = $typeArticle;
        $this->dispatchBrowserEvent("showModal", []);
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal", []);
    }

    public function editProp(ProprieteArticle $proprieteArticle){
        $this->editPropriete["nom"] = $proprieteArticle->nom;
        $this->editPropriete["estObligatoire"] = $proprieteArticle->estObligatoire;
        $this->editPropriete["id"] = $proprieteArticle->id;

        $this->dispatchBrowserEvent("showEditModal", []);
    }

    public function updateProp(){
        $this->validate([
            "editPropriete.nom" => ["required", Rule::unique("propriete_articles", "nom")->ignore($this->editPropriete["id"])],
            "editPropriete.estObligatoire" => "required"
        ]);

        ProprieteArticle::find($this->editPropriete["id"])->update([
            "nom" => $this->editPropriete["nom"],
            "estObligatoire" => $this->editPropriete["estObligatoire"]
        ]);

        $this->dispatchBrowserEvent("showMessage", ["message" => "Propriété modifié avec succès"]);
        $this->closeEditModal();
    }

    public function closeEditModal(){
        $this->editPropriete = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditModal", []);
    }
}
