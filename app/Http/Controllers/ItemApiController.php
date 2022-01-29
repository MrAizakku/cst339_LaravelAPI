<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\DTO;

class ItemApiController extends Controller
{
    public function index()
    {
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Get Success: True', 
            'numberOfResults' => Item::all()->count(), 
            'data' => Item::all()
        ]);
        return json_encode($dto);
    }

    public function isolateById(Item $item)
    {
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Get Success: True', 
            'numberOfResults' => '1', 
            'data' => $item
        ]);
        return json_encode($dto);
    }
    
    public function isolateByHhid($hhid)
    {
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Get Success: True', 
            'numberOfResults' => Item::all()->where('households_id', $hhid)->count(), 
            'data' => Item::all()->where('households_id', $hhid)
        ]);
        return json_encode($dto);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'households_id' => 'required'
        ]);
        $data = Item::create([
            'households_id' => request('households_id'),
            'name' => request('name'),
            'description' => request('description'),
            'quantity' => request('quantity')
        ]);
        $dto = new DTO([ 
            'httpCode' => '200',         
            'httpMessage' => 'Post Success: True', 
            'numberOfResults' => '1', 
            'data' => $data
        ]);
        return json_encode($dto);
    }

    public function update(Item $item)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required'
        ]);
        $success = $item->update([
            'name' => request('name'),
            'description' => request('description'),
            'quantity' => request('quantity')
        ]);
        $dto = new DTO([ 
            'httpCode' => $success = 1 ? '200' : '400',         
            'httpMessage' => 'Update Success: ' . $success = 1 ? 'True' : 'False', 
            'numberOfResults' => '1', 
            'data' => $item
        ]);
        return json_encode($dto);
    }

    public function destroy(Item $item) 
    {
        $success = $item->delete();
        $dto = new DTO([ 
            'httpCode' => $success = 1 ? '200' : '400',         
            'httpMessage' => 'Update Success: ' . $success = 1 ? 'True' : 'False', 
            'numberOfResults' => '1', 
            'data' => $item
        ]);
        return json_encode($dto);
    }
}
