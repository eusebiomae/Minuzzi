@section('css')
@parent

@endsection

@section('scripts')
@parent

@endsection

<div class="form-group">
	@if ($fieldPageConfig->show('description'))
	<div class="col-sm-12">
		<label class="control-label">Nome do Local*</label>
		<input type="text" id="description" name="description" class="form-control" size="400" maxlength="400" autofocus {!! $fieldPageConfig->attr('description') !!}>
		<span class="help-block m-b-none">Digite o Nome do Local</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('address'))
	<div class="col-sm-9">
		<label class=" control-label">Endereço *</label>
		<input type="text" id="address" name="address" class="form-control" size="400" maxlength="400" {!! $fieldPageConfig->attr('address') !!}>
		<span class="help-block m-b-none">Digite o endereço.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('number'))
	<div class="col-sm-3">
		<label class=" control-label">Nº *</label>
		<input type="number"  id="number" name="number" class="form-control" {!! $fieldPageConfig->attr('number') !!}>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('complement'))
	<div class="col-sm-7">
		<label class=" control-label">Complemento</label>
		<input type="text" id="complement" name="complement" class="form-control" {!! $fieldPageConfig->attr('complement') !!}>
		<span class="help-block m-b-none">Digite o complemento.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('neighborhood'))
	<div class="col-sm-5">
		<label class=" control-label">Bairro *</label>
		<input type="text" id="neighborhood" name="neighborhood" class="form-control" {!! $fieldPageConfig->attr('neighborhood') !!}>
		<span class="help-block m-b-none">Digite o bairro.</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('city'))
	<div class="col-sm-6">
		<label class=" control-label">Cidade *</label>
		<input type="text" id="city" name="city" class="form-control" {!! $fieldPageConfig->attr('city') !!}>
		<span class="help-block m-b-none">Digite a cidade.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('uf'))
	<div class="col-sm-6">
		<label class=" control-label">UF *</label>
		<select id="uf" name="uf"  class="select2_demo_1 form-control" {!! $fieldPageConfig->attr('uf') !!}>
			<option value="">Selecione a página</option>
			@foreach($listSelectBox->state as $item)
			<option value="{{ $item->id }}">{{ $item->description }}</option>
			@endforeach
		</select>
		<span class="help-block m-b-none">Selecione a UF.</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('cep'))
	<div class="col-sm-7">
		<label class=" control-label">CEP *</label>
		<input type="text" id="cep" name="cep" class="form-control" data-mask="99999-999" placeholder="" {!! $fieldPageConfig->attr('cep') !!}>
		<span class="help-block m-b-none">Digite a cidade.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('phone'))
	<div class="col-sm-5">
		<label class=" control-label">Telefone *</label>
		<input type="text" id="phone" name="phone" class="form-control" data-mask="(99) 9999-9999" placeholder="" {!! $fieldPageConfig->attr('phone') !!}>
		<span class="help-block m-b-none">Digite o telefone principal.</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('cell_phone'))
	<div class="col-sm-7">
		<label class=" control-label">Celular</label>
		<input type="text" id="cell_phone" name="cell_phone" class="form-control" data-mask="(99) 9 9999-9999" placeholder="" {!! $fieldPageConfig->attr('cell_phone') !!}>
		<span class="help-block m-b-none">Digite o celular principal.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('email'))
	<div class="col-sm-5">
		<label class=" control-label">E-mail</label>
		<input type="email" id="email" name="email" class="form-control" placeholder="exemplo@site.com.br"> {!! $fieldPageConfig->attr('email') !!}
		<span class="help-block m-b-none">Digite o e-mail principal.</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('responsible'))
	<div class="col-sm-7">
		<label class="control-label">Responsavel</label>
		<input type="text" id="responsible" name="responsible" class="form-control" data-mask="" placeholder="" {!! $fieldPageConfig->attr('responsible') !!}>
		<span class="help-block m-b-none">Digite o nome do Responsavel do Local</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('phone_resp'))
	<div class="col-sm-5">
		<label class="control-label">Telefone Responsavel</label>
		<input type="text" id="phone_resp" name="phone_resp" class="form-control" data-mask="(99) 9 9999-9999" {!! $fieldPageConfig->attr('phone_resp') !!}>
		<span class="help-block m-b-none">Digite o Telefone do Responsavel</span>
	</div>
	@endif
</div>
<div class="form-group">
	@if ($fieldPageConfig->show('company_information'))
	<div class="col-sm-12">
		<label class=" control-label">Informações da Local</label>
		<textarea name="company_information" class="form-control" rows="10" {!! $fieldPageConfig->attr('company_information') !!}></textarea>
	</div>
	@endif
</div>
