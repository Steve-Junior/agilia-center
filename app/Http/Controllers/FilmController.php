<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Film;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with('categories')->latest()->paginate(10);

        return view('film.index', compact('films'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('film.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'release_year' => 'required',
            'photo' => 'required|max:2048',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }

        $image_url = '';
        if (!empty($request->photo)) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $image_url = 'uploads/'.$filename;
        }

        //TODO check if selected categories exists

        $film = new Film();
        $film->name = $request->input('title');
        $film->year_of_release = (int) date('Y', strtotime($request->input('release_year')));
        $film->cover_image_url = $image_url;
        $film->user_id = auth()->id();

        $film->save();
        $film->categories()->attach($request->get('category_id'));

        return redirect()->route('films.index')
            ->with('success','Film created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('film.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $selectedCategoryIds = $film->categories->pluck('id');
        $unselectedCategories = Category::all()->whereNotIn('id', $selectedCategoryIds->toArray());
        return view('film.edit', compact('film', 'unselectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'release_year' => 'required',
            'photo' => 'required|max:2048',
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }


        if (!empty($request->photo)) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);

            $old_image_path = public_path().'/'.$film->cover_image_url;
            unlink($old_image_path);

            $film->cover_image_url = 'uploads/'.$filename;
        }

        $film->name = $request->input('title');
        $film->year_of_release = $request->input('release_year');

        $film->update();
        $film->categories()->sync($request->get('category_id'));

        return redirect()->route('films.index')
            ->with('success','Film updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->categories()->detach();

        $image_path = public_path().'/'.$film->cover_image_url;
        unlink($image_path);
        $film->delete();

        return redirect()->route('films.index')
            ->with('success','Film deleted successfully');
    }
}
