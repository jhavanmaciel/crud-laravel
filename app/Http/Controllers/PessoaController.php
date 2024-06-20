<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Pessoa;
use Yajra\DataTables\DataTables;
use Validator;

 
class PessoaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pessoa::select('id','nome','email','telefone')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-custom btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bi bi-pencil-fill"></i></button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Apagar"> <i class="bi bi-trash3-fill"></i></button>';
                    return $button;
                })
                ->make(true);
        }
 
        return view('crud');
    }
 
    public function store(Request $request)
    {
        $rules = array(
            'nome'    =>  'required',
            'email'     =>  'required',
            'telefone'     =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
 
        $form_data = array(
            'nome'        =>  $request->nome,
            'email'         =>  $request->email,
            'telefone'         =>  $request->telefone,
        );
 
        Pessoa::create($form_data);
 
        return response()->json(['success' => 'Data Added successfully.']);
    }
 
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Pessoa::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
 
    public function update(Request $request)
    {
        $rules = array(
            'nome'        =>  'required',
            'email'         =>  'required',
            'telefone'          => 'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
 
        $form_data = array(
            'nome'    =>  $request->nome,
            'email'     =>  $request->email,
            'telefone'     =>  $request->telefone
        );
 
        Pessoa::whereId($request->hidden_id)->update($form_data);
 
        return response()->json(['success' => 'Data is successfully updated']);
    }
 
    public function destroy($id)
    {
        $data = Pessoa::findOrFail($id);
        $data->delete();
    }
}