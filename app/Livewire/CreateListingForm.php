<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Models\Listing;
use App\Models\ListingImages;

class CreateListingForm extends Component
{
    use WithFileUploads;

   // #[Rule('required')]
    public $guest_number = '';

    
    public $bed_number = '';

   // #[Rule('required')]
    public $bathroom_number = '';

   // #[Rule('required')]
    public $listing_title = '';

   // #[Rule('required')]
    public $listing_description = '';

   // #[Rule('required')]
    public $full_day_price_set_by_user= '';

   // #[Rule('required')]
    public $listing_address = '';

   // #[Rule('required')]
    public $zip_code = '';

   // #[Rule('required')]
    public $district = '';

    //#[Rule('required')]
    public $town = '';

   // #[Rule('required')]

   

    public $allow_short_stay=true ;

   // #[Rule('required')]
    public $describe_peaceful =true;

   // #[Rule('required')]
    public $describe_unique =false;

   // #[Rule('required')]
    public $describe_familyfriendly = false;

   // #[Rule('required')]
    public $describe_stylish =false;

   // #[Rule('required')]
    public $describe_central =false;

   // #[Rule('required')]
    public $describe_spacious =false;

   // #[Rule('required')]
    public $private_bathroom =false;

   // #[Rule('required')]
    public $breakfast_included =false ;

   // #[Rule('required')]
    public $door_lock=false ;

   // #[Rule('required')]
    public $unknown_guest_entry =false;

   // #[Rule('required')]
    public $listing_type = '';

  //  #[Rule(['photos.*' => 'image|max:1024'])]
   // public $listing_photos = [];



    public function save(){
       // $this->validate();
        
        Listing::create(
            $this->only(['guest_number', 'bed_number', 'bathroom_number', 'listing_title', 'listing_description', 
                         'listing_address', 'zip_code', 'district', 'town', 'full_day_price_set_by_user',
                         'allow_short_stay', 'describe_peaceful', 'describe_unique', 'describe_familyfriendly', 'describe_stylish', 'describe_central', 'describe_spacious',
                         'private_bathroom', 'breakfast_included', 'door_lock', 'unknown_guest_entry', 'listing_type'
                        ])
                );
            return $this->redirect('/admin/add-listing');
    
            
            
        
        
        }




    public function render()
    {
        return view('livewire.create-listing-form');
    }
}
