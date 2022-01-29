<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Household;
use App\DTO;

class HouseholdApiController extends Controller
{
    public function index()
    {
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Get Success: True', 
            'numberOfResults' => Household::all()->count(), 
            'data' => Household::all()
        ]);
        return json_encode($dto);
    }

    public function isolate(Household $household)
    {
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Get Success: True', 
            'numberOfResults' => 1, 
            'data' => $household
        ]);
        return json_encode($dto);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required'
        ]);
        $data = Household::create([
            'name' => request('name'),
            'address' => request('address'),
            'description' => request('description')
        ]);
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Post Success: True', 
            'numberOfResults' => '1', 
            'data' => $data
        ]);
        return json_encode($dto);

        
    }

    public function update(Household $household)
    {
        request()->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required'
        ]);
        $success = $household->update([
            'name' => request('name'),
            'address' => request('address'),
            'description' => request('description')
        ]);
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Update Success: ' . $success = 1 ? 'True' : 'False', 
            'numberOfResults' => 1, 
            'data' => $household
        ]);
        return json_encode($dto);
    }

    public function destroy(Household $household) 
    {
        $success = $household->delete();
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Deletion Success: ' . $success = 1 ? 'True' : 'False', 
            'numberOfResults' => 1, 
            'data' => $household
        ]);
        return json_encode($dto);
    }
}