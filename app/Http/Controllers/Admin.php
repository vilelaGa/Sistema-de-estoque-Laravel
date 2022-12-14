<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produto;
use App\Models\Requisicoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class Admin extends Controller
{
    public function login()
    {
        return view('admin');
    }

    public function auth(Request $request)
    {

        $this->validate(
            $request,
            [
                'email' => ['required', 'email'],
                'senha' => 'required'
            ],
            [
                'email.required' => 'Email é obrigatório',
                'senha.required' => 'Senha é obrigatório',
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            return redirect('/admin/home');
        } else {
            return redirect()->back()->with('danger', 'Senha ou email inválidos');
        }
    }

    public function home()
    {

        if (Auth::check()) {

            $requisicoes = Requisicoe::where('status', '0')->get();
            return view('admin.index', ['requisicoes' => $requisicoes]);
        } else {
            return view('admin');
        }
    }

    public function registrar()
    {
        if (Auth::check()) {
            return view('admin.registrar');
        } else {
            return view('admin');
        }
    }


    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required',
                'email' => ['required', 'email'],
                'senha' => 'required'
            ],
            [
                'nome.required' => 'Nome é obrigatório',
                'email.required' => 'Email é obrigatório',
                'senha.required' => 'Senha é obrigatório',
            ]
        );


        $senha = Hash::make($request->senha);


        $User = new User();

        $User->name = $request->nome;
        $User->email = $request->email;
        $User->password = $senha;

        $User->save();

        return redirect('/admin/home');
    }

    public function requisicao()
    {
        if (Auth::check()) {
            return view('admin.requisicao');
        } else {
            return view('admin');
        }
    }

    public function requisicao_store(Request $request)
    {
        $this->validate(
            $request,
            [
                'data' => ['required', 'date'],
                'lista' => 'required',
                'tipo' => 'required',
            ],
            [
                'data.required' => 'Data é obrigatório',
                'lista.required' => 'Lista é obrigatório',
                'tipo.required' => 'Tipo de requisição é obrigatório',
                'data.date' => 'Data inválida',
            ]
        );



        // dd($request);
        // die();

        $Requisicoe = new Requisicoe();

        $Requisicoe->nome_criador = $request->criador;
        $Requisicoe->data_prazo = $request->data;
        $Requisicoe->listagem_produtos = $request->lista;
        $Requisicoe->tipo = $request->tipo;
        $Requisicoe->status = '0';

        $Requisicoe->save();

        return redirect('/admin/home');
    }

    public function requisicao_update($id)
    {
        // dd($id);

        $data = [
            'status' => '1',
        ];

        Requisicoe::where('id', $id)->update($data);

        return redirect('admin/home');
    }

    public function produto_simples_create()
    {
        if (Auth::check()) {
            $produtos = Produto::all();
            return view('admin.produto_simples', ['produtos' => $produtos]);
        } else {
            return view('admin');
        }
    }

    public function produto_simples_store(Request $request)
    {

        $this->validate(
            $request,
            [
                'nome' => 'required',
                'preco_custo' => ['required'],
                'preco_venda' => ['required'],
                'num_unidades' => ['required', 'numeric'],
            ],
            [
                'nome.required' => 'Nome é obrigatório',
                'preco_custo.required' => 'Preço de custo é obrigatório',
                'preco_venda.required' => 'Preço de venda é obrigatório',
                'num_unidades.required' => 'Número de unidades é obrigatório',
                'num_unidades.numeric' => 'Número de unidades não aceito',
            ]
        );

        $status = $request->num_unidades > 0 ? 'EMestoque' : 'EMfalta';
        $tipo = $request->num_unidades > 0 ? 'INSERCAO' : 'REMOCAO';

        $preco_custo = str_replace([','], '', $request->preco_custo);
        $preco_venda = str_replace([','], '', $request->preco_venda);

        $Produto = new Produto();

        $Produto->nome = $request->nome;
        $Produto->preco_custo = $preco_custo;
        $Produto->preco_venda = $preco_venda;
        $Produto->num_unidades = $request->num_unidades;
        $Produto->status = $status;
        $Produto->tipo = $tipo;
        $Produto->data_ = date('y-m-d');

        $Produto->save();


        return redirect('admin/produto-simples');

        // dd($request);
    }

    public function produto_simples_update($id)
    {
        // dd($id);

        $data = [
            'status' => 'EMfalta',
            'num_unidades' => 0,
            'tipo' => 'REMOCAO',
            'data_' => date('y-m-d')
        ];

        Produto::where('id', $id)->update($data);

        return redirect('admin/produto-simples');
    }

    public function produto_simples_delete($id)
    {
        Produto::where('id', $id)->delete();
        return redirect('admin/produto-simples');
    }


    public function produto_simples_att($id)
    {
        if (Auth::check()) {
            $produtos = Produto::findOrFail($id);
            return view('admin.attproduto', ['produtos' => $produtos]);
        } else {
            return view('admin');
        }
    }

    public function produto_simples_update_dados(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required',
                'preco_custo' => ['required'],
                'preco_venda' => ['required'],
                'num_unidades' => ['required', 'numeric'],
            ],
            [
                'nome.required' => 'Nome é obrigatório',
                'preco_custo.required' => 'Preço de custo é obrigatório',
                'preco_venda.required' => 'Preço de venda é obrigatório',
                'num_unidades.required' => 'Número de unidades é obrigatório',
                'num_unidades.numeric' => 'Número de unidades não aceito',
            ]
        );

        $preco_custo = str_replace([','], '', $request->preco_custo);
        $preco_venda = str_replace([','], '', $request->preco_venda);

        $status = $request->num_unidades > 0 ? 'EMestoque' : 'EMfalta';
        $tipo = $request->num_unidades > 0 ? 'INSERCAO' : 'REMOCAO';


        $data = [
            'nome' => $request->nome,
            'preco_custo' => $preco_custo,
            'preco_venda' => $preco_venda,
            'num_unidades' => $request->num_unidades,
            'status' => $status,
            'tipo' => $tipo,
            'data_' => date('y-m-d')
        ];

        Produto::where('id', $id)->update($data);

        return redirect('admin/produto-simples');
    }

    public function admin_relatorios()
    {
        if (Auth::check()) {
            return view('admin.relatorios');
        } else {
            return view('admin');
        }
    }

    public function admin_relatorio_pdf(Request $request)
    {
        $this->validate(
            $request,
            [
                'dataIni' => ['required', 'date'],
                'dataFim' => ['required', 'date'],
                'tipo' => 'required',

            ],
            [
                'dataIni.required' => 'Data inicial é obrigatório',
                'dataFim.required' => 'Data final é obrigatório',
                'dataIni.date' => 'Data inicial inválida',
                'dataFim.date' => 'Data final inválida',
                'tipo.required' => 'Tipo é obrigatório',
            ]
        );

        // dd($request);

        $from = $request->dataIni;
        $to = $request->dataFim;

        $explode_data_i = explode('-', $from);
        $explode_data_f = explode('-', $to);

        $dataIformatada = $explode_data_i['2'] . '/' . $explode_data_i['1'] . '/' . $explode_data_i['0'];
        $dataFformatada = $explode_data_f['2'] . '/' . $explode_data_f['1'] . '/' . $explode_data_f['0'];


        $produtos_soma = Produto::whereBetween('data_', [$from, $to])->where('tipo', $request->tipo)->sum('num_unidades');
        $produtos_get = Produto::whereBetween('data_', [$from, $to])->where('tipo', $request->tipo)->get();


        $pdf = Pdf::loadView('admin.pdf', ['produtos_soma' => $produtos_soma, 'dataI' => $dataIformatada, 'dataF' => $dataFformatada, 'request' => $request->tipo, 'produtos_get' => $produtos_get])->setPaper('a4', 'landscap');
        // return $pdf->download('relatorio.pdf');
        return $pdf->stream();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
