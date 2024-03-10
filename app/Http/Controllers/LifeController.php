<?php

namespace App\Http\Controllers;

use App\Models\Life;
use Illuminate\Http\Request;

class LifeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
     // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('life.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);

        $validated['user_id'] = auth()->id();

        $life = Life::create($validated);
        $request->session()->flash('message', '保存しました');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Life $life)
    {
        return view('life.show', compact('life'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Life $life)
    {
        return view('life.edit', compact('life'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Life $life)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);
            $validated['user_id'] = auth()->id();
            $life->update($validated);
            $request->session()->flash('message', '更新しました' );
            return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Life $life)
    {
        $life->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('life.index');
    }
}
