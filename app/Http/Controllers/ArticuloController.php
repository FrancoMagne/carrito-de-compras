<?php

namespace App\Http\Controllers;

use App\Exports\ArticulosExport;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ArticuloController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:articulos');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('enabled', auth()->user());

        $articulos = Articulo::all()
                    ->where('user_id', auth()->user()->id)
                    ->where('enabled', '=', '1');

        if (!Storage::exists('public/usuarios/'.auth()->user()->email)) {
            Storage::makeDirectory('public/usuarios/'.auth()->user()->email);
        }

        $contador = 0;

        return view('vendedor.articulo.index', compact('articulos', 'contador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('enabled', auth()->user());
        $categorias = Categoria::all();
        return view('vendedor.articulo.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->authorize('enabled', auth()->user());

        $request->validate([
            'file' => 'required|image'
        ]);
        
        $date = idate('h') . idate('i') . idate('s');
        
        $articulo = new Articulo();

        $articulo->user_id = auth()->user()->id;
        $articulo->category_id = $request->get('combo');
        $articulo->name = $request->get('name');
        $articulo->quantity = $request->get('quantity');
        $articulo->price = $request->get('price');
        $articulo->slug = $request->get('slug') . '-' . $date;
        if($request->get('check')) {
            $articulo->visible = 1;
        } else {
            $articulo->visible = 0;
        }

        if($request->file('file') != NULL){
            //$articulo->image = Storage::url($request->file('file')->store('public/usuarios/'.auth()->user()->email));
            $image = $request->file('file');
            $extension = $image->getClientOriginalExtension();
            $last_article = Articulo::all()->last();
            $id = $last_article->id + 1;
            $name_image = 'articulo_'.$id.'.'.$extension;
            $path = storage_path().'\app\public\usuarios/'.auth()->user()->email;
            $image->move($path, $name_image);
            $articulo->image = 'storage/usuarios/'.auth()->user()->email.'/'.$name_image;
        }
        
        $articulo->save();

        return redirect('/articulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {   
        $this->authorize('enabled', auth()->user());
        $categorias = Categoria::all();
        return view('vendedor.articulo.edit', compact('categorias'))->with('articulo', $articulo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo) {
        
        $this->authorize('enabled', auth()->user());
        
        $request->validate([
            'file' => "image"
        ]);

        $date = idate('h') . idate('i') . idate('s');
        
        $articulo->user_id = auth()->user()->id;
        $articulo->category_id = $request->get('combo');
        $articulo->name = $request->get('name');
        $articulo->quantity = $request->get('quantity');
        $articulo->price = $request->get('price');
        $articulo->slug = $request->get('slug') .'-'.$date;
        if($request->get('check')) {
            $articulo->visible = 1;
        } else {
            $articulo->visible = 0;
        }
        
        if($request->file('file') != NULL) {
            /*if(!empty($articulo->image)) {
                unlink(public_path($articulo->image));
            }*/
            //$articulo->image = Storage::url($request->file('file')->store('public/usuarios/'.auth()->user()->email));
            $image = $request->file('file');
            $extension = $image->getClientOriginalExtension();
            $name_image = 'articulo_'.$articulo->id.'.'.$extension;
            $path = storage_path().'\app\public\usuarios/'.auth()->user()->email;
            $image->move($path, $name_image);
            $articulo->image = 'storage/usuarios/'.auth()->user()->email.'/'.$name_image;
        }

        $articulo->update();
        
        return redirect('/articulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('enabled', auth()->user());
        $articulo = Articulo::find($id);
        $articulo->enabled = 0;

        /*if($articulo->image != ''){
            unlink(public_path($articulo->image));
        }*/

        $articulo->update();

        return redirect('/articulos')->with('eliminar', 'ok');
    }

    public function exportExcel()
    {
        $this->authorize('enabled', auth()->user());
        return Excel::download(new ArticulosExport, 'articulos_'.auth()->user()->name.'.xlsx');
    }

}
