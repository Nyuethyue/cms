<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use DB;

class FrontPage extends Component
{
    public $title;
    public $content;
    
    /**
     * This is livewirer mount function
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function mount($urlslug = null) {
        $this->retrievecontent($urlslug);
    }
    
    /**
     * Retrives the content of the Page
     *
     * @param  mixed $urlslug
     * @return void
     */
    public function retrieveContent($urlslug) {
        // Get home page if slug is empty
        if (empty($urlslug)) {
            $data = Page::where('is_default_home', true)->first();
        } else {
            // Get the pages according to the slug value
            $data = Page::where('slug', $urlslug)->first();

            // If we can't retrieve anything, Let's get the default 404 not found page
            if (!$data) {
                $data = Page::where('is_default_not_found', true)->first();
            }
        }

        $this->title = $data->title;
        $this->content = $data->content;
    }

    /**
     * gets all the top navigation links
     *
     * @return void
     */
    private function topNavLinks() {
        return DB::table('navigation_menus')
                ->where('type', '=', 'TopNav')
                ->orderBy('sequence', 'asc')
                ->orderBy('created_at','asc')
                ->get();
    }
    
    /**
     * gets all the siebar links
     *
     * @return void
     */
    private function sideBarLinks() {
        return DB::table('navigation_menus')
                ->where('type', '=', 'SidebarNav')
                ->orderBy('sequence', 'asc')
                ->orderBy('created_at','asc')
                ->get();
    }
     
    /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.front-page',[
            'sideBarLinks' => $this->sideBarLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])->layout('layouts.frontpage');
    }
}
