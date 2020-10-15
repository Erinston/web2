<?php

namespace App\Http\Controllers;

use App\Models\Frase;
use App\Models\Genero;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 

class FraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frases = Frase::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                      ->paginate(3);

        return view('frases.index',compact('frases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::all();
        return view('frases.create',compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'unique:frases', 'max:255'],
            'body' => ['required'],
            'image' => ['mimes:jpeg,png,jpg' , 'dimensions:min_width=200,min_height=200'],
            'generos_id' => ['array']
          ]);

       // dd($validatedData['generos_id']);
        $frase = new Frase($validatedData);
        $frase->user_id = Auth::id();
        $frase->save();
        $frase->generos()->attach($validatedData['generos_id']);

       if($request->hasFile('image') and $request->file('image')->isValid()) 
            {
            //$extension = $request->image->extension();
            //$image_name = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())), 0, 10);

            //$path = $request->image->storeAs('frases',$image_name.".".$extension, 'public');
            $path = $request->file('image')->store('frase');
            $image = new Image();
            $image->frase_id = $frase->id;
            $image->path = $path;
            $image->save();
        }

        return redirect('frases')->with('sucess', 'Frase criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frase  $frase
     * @return \Illuminate\Http\Response
     */
    public function show(Frase $frase)
    {
        return view('frases.show',compact('frase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frase  $frase
     * @return \Illuminate\Http\Response
     */
    public function edit(Frase $frase)
    {
        if($frase->user_id === Auth::id()){
            $generos = Genero::all();
        return view('frases.edit',compact('frase', 'generos'));
      }else{
        return redirect()->route('frases.index')
                         ->with('error',"Você não pode editar a frase porque não é o autor!")
                         ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frase  $frase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frase $frase)
    {
        $validatedData = $request->validate([
            'title' => ['required', Rule::unique('frases')->ignore($frase), 'max:255'],
            'body' => ['required'],
            'image' => ['mimes:jpge,png' , 'dimensions:min_width=200,min_height=200'],
            'generos_id' =>['array'],
          ]);

         if($frase->user_id === Auth::id()){
            $frase->update($request->all());
            $frase->generos()->sync($validatedData['generos_id']);  

            if($request->hasFile('image') and $request->file('image')->isValid()) {
                $frase->image->delete();
                $extension = $request->image->extension();
                $image_name = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())), 0, 10);

                $path = $request->image->storeAs('frases', $image_name.".".$extension, 'public');

                $image = new Image();
                $image->path = $path;
                $image->post_id = $frase->id;
                $image->save();
            }

        return redirect()->route('frases.index')->with('sucess', 'Frase editada com sucesso');
        }else{
            return redirect()->route('frases.index')
                         ->with('error',"Você não pode editar a frase porque não é o autor!")
                         ->withInput();
        } 

       /* Storage::disk('public')->delete($frase->image->path);
        Image::where('id', $frase->image->id)->update(['path' => $request->file('image')->store('frase')]);
        return redirect()->route('frases.index')->with('sucess', 'Frase editada com sucesso');
       */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frase  $frase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frase $frase)
    {
        if ($frase->user_id === Auth::id()) {
           $path = $frase->image->path;
           $frase->delete();
           Storage::disk('public')->delete($path);

           return redirect()->route('frases.index')
                             ->with('sucess', 'Frase apagada com sucesso');
        //}else{
          //  return redirect()->route('frases.index')
          //                   -> with('error', "Você não pode apagar a frase porque não é o autor!")
            //                 ->withInput();
        }
    }
}
