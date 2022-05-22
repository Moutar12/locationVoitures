<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticlePropriete;
use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArticleComponent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = "bootstrap";


    public $search = "";
    public $filtreType = "", $filtreEtat = "";
    public $addArticle = [];
    public $proprietesArticles = null;
    public $addPhoto = null;
    public $resetInputFile = 0;
    public $editArticle = [];
    public $editPhoto = null;



    protected $rules = [
        'editArticle.nom' => 'required',
        'editArticle.numeroSerie' => 'required',
        'editArticle.type_article_id' => 'required',
        'editArticle.article_proprietes.*.valeur' => 'required|string|max:500',
    ];



    public function render()
    {
        Carbon::setLocale("fr");

        $querySelect = Article::query();

        if ($this->search != ""){
            $querySelect->where("nom", "LIKE", "%" .$this->search. "%")
                ->orWhere("numeroSerie", "LIKE", "%" .$this->search. "%");
        }
        if ($this->filtreType != ""){
            $querySelect->where("type_article_id",  $this->filtreType);
        }
        if ($this->filtreEtat != ""){
            $querySelect->where("estDisponible", $this->filtreEtat);
        }

        $data = [
            "articles" => $querySelect->latest()->paginate(3),
            "typeArticle" => TypeArticle::orderBy("nom", "ASC")->get()
        ];
        return view('livewire.articles.index', $data)->extends("layouts.master")->section("contenu");
    }

    public function updated($property){
        if ($property == "addArticle.type"){
            $this->proprietesArticles = optional(TypeArticle::find($this->addArticle["type"]))->proprietes;
        }
    }

    public function ajoutArticle(){

        $messageErros = [];
        $proprietesArticleId = [];
        $imagePath = "";


        $validateTabs = [
            "addArticle.nom" => "string|min:3|required",
            "addArticle.numeroSerie" => "string|max:50|min:3|required",
            "addArticle.type" => "required",
            "addPhoto" => "image:max:10240"
        ];

        foreach ($this->proprietesArticles?: [] as $proprietesArticle){
            $validateName = "addArticle.prop." .$proprietesArticle->nom;
            $proprietesArticleId["$proprietesArticle->nom"] = $proprietesArticle->id;

            if ($proprietesArticle->estObligatoire == 1){
                $validateTabs[$validateName] = "required";
                $messageErros["$validateName.required"] = "Ce champ <<".$proprietesArticle->nom.">> est obligatoire";
            }else{
                $validateTabs[$validateName] = "nullable";
            }
        }

        if ($this->addPhoto != null){
            $path = $this->addPhoto->store('upload', 'public');
            $imagePath = "storage/".$path;

            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();

        }

        $validateForm = $this->validate($validateTabs, $messageErros);

        $newArticle = Article::create([
         "nom" => $validateForm["addArticle"]["nom"],
         "numeroSerie" => $validateForm["addArticle"]["numeroSerie"],
         "type_article_id" => $validateForm["addArticle"]["type"],
         "imageUrl" => $imagePath,
        ]);

        foreach ($validateForm["addArticle"]["prop"]? : [] as $key=> $itemProp){

            ArticlePropriete::create([
                "article_id" => $newArticle->id,
                "propriete_article_id" => $proprietesArticleId[$key],
                "valeur" => $itemProp
            ]);
        }
        $this->dispatchBrowserEvent("showMessage", ["message" => "Article ajouté avec succès"]);
        $this->closeModal();
    }


    public function showArticleModal(){
        $this->resetValidation();
        $this->addArticle = [];
        $this->proprietesArticles = [];
        $this->addPhoto = null;
        $this->resetInputFile++;
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal", []);
    }


    public function editArticle($editArticleId){
        $this->editArticle = Article::with("article_proprietes", "article_proprietes.propriete", "type")->find($editArticleId)->toArray();

       //dd($this->editArticle);
        //$this->editPhoto = null;
        $this->dispatchBrowserEvent("showEditModal");
    }

    public function updateArticle(){

    }

    public function closeEditModal(){

        $this->dispatchBrowserEvent("closeEditModal", []);
    }





    // cette function supprime les fichiers uploadé aprés 5 seconde
    protected function cleanupOldUploads()
    {
        $storage = Storage::disk("local");

        foreach ($storage->allFiles("livewire-tmp") as $pathFileName){
            if (! $storage->exists($pathFileName)) continue;

            $fiveSecond = now()->subSecond(5)->timestamp;

            if ($fiveSecond > $storage->lastModified($pathFileName)){
                $storage->delete($pathFileName);
            }
        }
    }
}
