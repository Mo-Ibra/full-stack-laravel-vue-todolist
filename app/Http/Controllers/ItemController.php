<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'completed' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $newItem = Item::create($request->all());
        return $newItem;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exsitsItem = Item::find($id);
        
        if ($exsitsItem) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'completed' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $exsitsItem->update($request->all());

            return $exsitsItem;

        } else {
            return response()->json(["error" => "No Item with that ID"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exsitsItem = Item::find($id);

        if ($exsitsItem) {
            $exsitsItem->delete();
            return response()->json(["message" => "Item Has been deleted"]);
        } else {
            return response()->json(["message" => "No Item With that ID"]);
        }
    }
}
