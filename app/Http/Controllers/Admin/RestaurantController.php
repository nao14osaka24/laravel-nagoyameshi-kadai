<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

         if ($keyword !== null) {
            $restaurant = Restaurant::where('name', 'like', "%{$keyword}%")->paginate(15);
            $total = $restautant->total();
         } else {
            $restaurant = Restaurant::paginate(15);
            $total = Restaurant::all()->count();
         }

        return view('admin.restaurants.index', compact('restaurant', 'total', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.restaurants.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->validate([
            'name' => 'required',
            'image' => 'image|max:2048',
            'description' => 'required',
            'lowest_price	' => 'required|numeric|min:0|after_or_equal:highest_price',
            'highest_price' => 'required|numeric|min:0|before_or_equal:lowest_price',
            'postal_code' => 'required|numeric|digits:7',
            'address' => 'required',
            'opening_time' => 'required|before:closing_time',
            'closing_time' => 'required|after:opening_time',
            'seating_capacity' => 'required|numeric|min:0',

        ])

        return view('admin.restaurants.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->validate([
            'name' => 'required',
            'image' => 'image|max:2048',
            'description' => 'required',
            'lowest_price	' => 'required|numeric|min:0|after_or_equal:highest_price',
            'highest_price' => 'required|numeric|min:0|before_or_equal:lowest_price',
            'postal_code' => 'required|numeric|digits:7',
            'address' => 'required',
            'opening_time' => 'required|before:closing_time',
            'closing_time' => 'required|after:opening_time',
            'seating_capacity' => 'required|numeric|min:0',

        ])

        return view('admin.restaurants.update',compact('update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        
        $restaurant->delete();
        return view('admin.restaurants.destroy',compact('delete'));
    }
}
