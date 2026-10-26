<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();

        return view('artist.index', [
            'artists' => $artists,
            'resource' => 'artistes',
        ]);
    }

    public function create()
    {
        return view('artist.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        $artist = new Artist();

        $artist->firstname = $validated['firstname'];
        $artist->lastname = $validated['lastname'];

        $artist->save();

        return redirect()->route('artist.index');
    }

    public function show($id)
    {
        $artist = Artist::find($id);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    public function edit($id)
    {
        $artist = Artist::find($id);

        return view('artist.edit', [
            'artist' => $artist,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        $artist = Artist::find($id);

        $artist->update($validated);

        return view('artist.show', [
            'artist' => $artist,
        ]);
    }

    public function destroy($id)
    {
        Artist::destroy($id);

        return redirect()->route('artist.index');
    }
}