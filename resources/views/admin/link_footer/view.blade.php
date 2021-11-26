@extends('layouts.app')

@section('title', 'Currículos')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
      <h2>Visualizar Currículum</h2>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/admin') }}">Home</a>
        </li>
        <li>
          <a href="{{ url('/admin/work') }}">Trabalhe Conosco</a>
        </li>
        <li class="active">
          <strong>Ver Currículo</strong>
        </li>
      </ol>
    </div>
    <div class="col-lg-2">

    </div>
  </div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="col-lg-12 animated fadeInRight">
    <div class="mail-box-header">
      <div class="pull-right tooltip-demo">
          <a href="mailto:{{ $data->email1 }}?subject=Trabalhe Conosco - BeeHappy&body=Olá {{ $data->name }} {{ $data->last_name }}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i></a>
          <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></a>
          <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i></a>
      </div>
      <h2>{{ $data->name }} {{ $data->last_name }}</h2>
      <div class="mail-tools tooltip-demo m-t-md">
				<h3>
				    <span class="font-normal">Formação: </span>{{ $data->profession }}.
				</h3>
				<h5>
				    <span class="pull-right font-normal">Data do cadastro: {{ $data->created_at }}.</span>
				    <span class="font-normal">E-mail: </span>{{ $data->email1 }}
				     - <span class="font-normal">Telefone: </span>{{ $data->phone1 }}
				     - <span class="font-normal">Celular: </span>{{ $data->cell_phone1 }}
				</h5>
      </div>
    </div>
    <div class="mail-box">
      <div class="mail-body">
          <h3>Dados do Candidato</h3>
          <br>

          <h5>Nome Completo: <span class="font-normal">{{ $data->name }} {{ $data->last_name }}</span></h5>
          <h5>Gênero: <span class="font-normal">{{ $data->genre }}</span></h5>
          <h5>Data de Nascimento: <span class="font-normal">{{ $data->date_birth }}</span><span class="font-normal"> - (00 anos)</span></h5>
          <h5>Graduação: <span class="font-normal">{{ $data->graduation_id }}</span></h5>
          <h5>Profissão: <span class="font-normal">{{ $data->profession }}</span></h5>
          <h5>Função: <span class="font-normal">{{ $data->function_id }}</span></h5>
          <h5>Nível de Inglês: <span class="font-normal">{{ $data->english_level_id }}</span></h5>
          <h5>Telefone Principal: <span class="font-normal">{{ $data->phone1 }}</span></h5>
          <h5>Telefone Secundário: <span class="font-normal">{{ $data->phone2 }}</span></h5>
          <h5>Telefone Celular: <span class="font-normal">{{ $data->cell_phone1 }}</span></h5>
          <h5>Celular Secundário: <span class="font-normal">{{ $data->cell_phone2 }}</span></h5>
          <h5>E-mail Principal: <span class="font-normal">{{ $data->email1 }}</span></h5>
          <h5>E-mail secundário: <span class="font-normal">{{ $data->email2 }}</span></h5>
          <h5>Endereço: <span class="font-normal">{{ $data->address }}</span>, <span class="font-normal">{{ $data->number }}</span> - <span class="font-normal">{{ $data->complement }}</span></h5>
          <h5>
          	Bairro: <span class="font-normal">{{ $data->neighborhood }}</span> -
          	Cidade: <span class="font-normal">{{ $data->city }}</span> -
          	UF: <span class="font-normal">{{ $data->uf }}</span>
          </h5>
          <h5>CEP: <span class="font-normal">{{ $data->cep }}</span></h5>
          <h5>Porque gostaria de trabalhar conosco?</h5>
          <h5><span class="font-normal">{{ $data->text_pt }}</span></h5>
          <h5>Why would you like to work with us?</h5>
          <h5><span class="font-normal">{{ $data->text_en }}</span></h5>
      </div>
	    <div class="mail-attachment">
        <p>
          <span><i class="fa fa-paperclip"></i> Anexos </span>
        </p>

        <div class="attachment">
          <div class="file-box">
            @if($data->curriculum )
            <div class="file">
              <a href="{!! asset('storage/work/curriculun/' . $data->curriculum ) !!}">
                <span class="corner"></span>

                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                <div class="file-name">
                    {{ $data->curriculum }}
                    <br/>
                    <small>Add: {{ $data->created_at }}</small>
                </div>
              </a>
            </div>
            @endif
          </div>
          <div class="file-box">
            @if($data->video )
            <div class="file">
              <a href="{!! asset('storage/work/video/' . $data->video ) !!}">
                <span class="corner"></span>

                <div class="icon">
                    <i class="fa fa-video-camera"></i>
                </div>
                <div class="file-name">
                    {{ $data->video }}
                    <br/>
                    <small>Add: {{ $data->created_at }}</small>
                </div>
              </a>
            </div>
            @endif

          </div>
          <div class="clearfix"></div>
	      </div>
	    </div>
      <div class="mail-body text-right tooltip-demo">
        <a class="btn btn-sm btn-white" href="mailto:{{ $data->email1 }}?subject=Trabalhe Conosco - BeeHappy&body=Olá {{ $data->name }} {{ $data->last_name }}"><i class="fa fa-reply"></i> Responder</a>
        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Imprimir</button>
        <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remover</button>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection

@section('scripts')


@endsection
