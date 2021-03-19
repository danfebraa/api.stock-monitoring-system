<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientCrud extends Component
{
    use WithPagination;

    public $clientId = null;
    public $client = [];

    public function submit()
    {
        $valid = $this->validate([
            'client.name' => (!is_null($this->clientId))?'required|unique:clients,name,'.$this->clientId : 'required|unique:clients,name',
            'client.client_code' => (!is_null($this->clientId))?'required|unique:clients,client_code,'.$this->clientId : 'required|unique:clients,client_code',
            'client.email' => (!is_null($this->clientId))?'required|unique:clients,email,'.$this->clientId : 'required|unique:clients,email',
            'client.address'=> 'required',
            'client.contact_no'=> 'required',
            'client.contact_person'=> 'required',
        ]);
        if($valid)
        {
            Client::updateOrCreate(
                ["id" => $this->client['id']],
                $valid
            );
            $this->reset(['client']);
        }
        // Execution doesn't reach here if validation fails.
    }

    public function editRow(Client $client)
    {
        $this->clientId = $client->id;
        $this->client = $client->toArray();
    }

    public function resetForm()
    {
        $this->reset(['client']);
    }

    public function render()
    {
        $clients = Client::paginate(10);
        if(count($this->getErrorBag()->all()) > 0){

            $this->emit('error:example');

        }
        return view('livewire.client-crud', compact('clients'));
    }
}
