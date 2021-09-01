<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Pages extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modalId;
    public $slug;
    public $title;
    public $content;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;

    
    /** 
     *The validation rules
     * 
     * @return void
     */
    public function rules() {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages','slug')->ignore($this->modalId)],
            'content' => 'required',
        ];
    }
    
    /**
     * The livewire mount function
     *
     * @return void
     */
    public function mount() {
        // Resets the pagination after reloading the page
        $this->resetPage();
    }
    
    /**
     * runs everytime when the
     * title variable is update
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value) {
        $this->slug = Str::slug($value);
    }


    public function updatedIsSetToDefaultHomePage() {
        $this->isSetToDefaultNotFoundPage = null;
    }

    public function updatedIsSetToDefaultNotFoundPage() {
        $this->isSetToDefaultHomePage = null;
    }
    
    /**
     * Unassigns the default home page in the database table
     *
     * @return void
     */
    private function unassignDefaultHomePage() {
        if ($this->isSetToDefaultHomePage != null) {
            Page::where('is_default_home', true)->update([
                'is_default_home' => false,
            ]);
        }
    }
    
    /**
     * Unassigns the default 404 page in the database table
     *
     * @return void
     */
    private function unassignDefaultNotFoundPage() {
        if ($this->isSetToDefaultNotFoundPage != null) {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }
    
    /**
     * show the form modal
     * of the createShowModal function.
     *
     * @return void
     */
    public function createShowModal() {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }
    
    /**
     * this create function
     *
     * @return void
     */
    public function create() {
        
        $this->validate();

        Page::create($this->modalData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    /**
     * The data for the modal mapped
     * in this component
     *
     * @return void
     */
    public function modalData() {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage,
        ];
    }

    // Reading the Data
    public function read() {
        return Page::paginate(5);
    }

    // Updating data
    public function update() {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        Page::find($this->modalId)->update($this->modalData());
        $this->modalFormVisible = false;
    }

    // Delete Data
    public function delete() {
        Page::destroy($this->modalId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    // Update the data
    public function updateShowModal($id) {
        $this->resetValidation();
        $this->reset();
        $this->modalId = $id;
        // show the form modal 
        $this->modalFormVisible = true;
        $this->loadModal();
    }
    
    /**
     * shows the delete confirmation modal of the delete function
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id) {
        $this->modalId = $id;
        $this->modalConfirmDeleteVisible = true;
    }
    
    /**
     * loads the modal data of the component
     *
     * @return void
     */
    public function loadModal() {
        $data = Page::find($this->modalId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true;
    }
    

    /**
     * The livire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
