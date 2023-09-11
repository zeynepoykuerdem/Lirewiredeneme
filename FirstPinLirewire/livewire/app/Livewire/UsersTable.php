<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Ignition\Tests\TestClasses\Models\Car;

class UsersTable extends Component
{
    use WithPagination;
    public $search='';
    public $perPage=15;
    public $sortField='id';
    public $sortAsc=true;
    public $name;
    public $email;
    public $password;
    public function render()
    {
        return view('livewire.users-table',[
            'users'=>User::search($this->search)
            ->orderBy($this->sortField,$this->sortAsc ? 'asc':'desc')
            ->simplePaginate($this->perPage)
        ]);
    }
    public function add(){
        $user=new User();
        $user->name=$this->name;
        $user->email=$this->email;
        $user->password=$this->password;

        $user->save();
    }
  public function delete(){
       if (isset($this->name)&&!empty($this->name)){
           $deletedRows=DB::delete('delete from users where name=?',[$this->name]);
           if ($deletedRows>0){
               return "User with name '$this->name' has been deleted";
           }
           else {
               return "User with name '$this->name' not found or could not be deleted.";
           }

       }
       else {
           return "Invalid name provided.";
       }
  }
    public function updatedSearch(){
        $this->resetPage();
    }

}
