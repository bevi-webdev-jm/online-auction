<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\Item;

class DeleteModel extends Component
{
    public $password;
    public $error_message;
    public $model;
    public $name;
    public $model_route;
    public $type;

    protected $listeners = [
        'setDeleteModel' => 'setModel'
    ];

    public function submitForm() {
        $this->error_message = '';

        $this->validate([
            'password' => 'required'
        ]);

        // check password
        if(!Hash::check($this->password, auth()->user()->password)) { // invalid
            $this->error_message = 'incorrect password.';
        } else { // delete function
            $this->model->delete();

            activity('delete')
                ->performedOn($this->model)
                ->withProperties($this->model)
                ->log(':causer.name has deleted '.$this->type.' ['.$this->name.']');

            return redirect()->to($this->model_route)->with([
                'message_success' => $this->type.' ['.$this->name.'] was deleted successfully.'
            ]);
        }
    }

    public function setModel($type, $model_id) {
        $model_id = decrypt($model_id);
        $this->type = $type;
        switch($type) {
            case 'Company':
                $this->model = Company::findOrFail($model_id);
                $this->name = $this->model->name;
                $this->model_route = '/companies';
            break;
            case 'User':
                $this->model = User::findOrFail($model_id);
                $this->name = $this->model->name;
                $this->model_route = '/users';
            break;
            case 'Role':
                $this->model = Role::findOrFail($model_id);
                $this->name = $this->model->name;
                $this->model_route = '/roles';
            break;
            case 'Item':
                $this->model = Item::findOrFail($model_id);
                $this->name = $this->model->name;
                $this->model_route = '/items';
            break;
        }
    }

    public function render()
    {
        return view('livewire.delete-model');
    }
}
