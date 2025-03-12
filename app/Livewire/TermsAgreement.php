<?php

namespace App\Livewire;

use Livewire\Component;

class TermsAgreement extends Component
{
    public $auctions;

    public function Accept() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 1
        ]);
    }

    public function Decline() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 2
        ]);
    }

    public function ReadAgain() {
        auth()->user()->update([
            'accepts_terms_and_conditions' => 0
        ]);
    }

    public function render()
    {
        return view('livewire.terms-agreement');
    }
}
