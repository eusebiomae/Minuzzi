<div class="form-group">
	<div class="col-sm-12">
		<label class="control-label" for="description">Nome do Local*</label>
		<input type="text" id="description" name="description" class="form-control" size="400" maxlength="400" autofocus required>
		<span class="help-block m-b-none">Digite o Nome do Local</span>
	</div>

</div>
<div class="form-group">
	<div class="col-sm-9">
		<label class=" control-label" for="address">Endereço *</label>
		<input type="text" id="address" name="address" class="form-control" size="400" maxlength="400" required>
		<span class="help-block m-b-none">Digite o endereço.</span>
	</div>
	<div class="col-sm-3">
		<label class=" control-label" for="number">Nº *</label>
		<input type="number"  id="number" name="number" class="form-control" required>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-7">
		<label class=" control-label" for="complement">Complemento</label>
		<input type="text" id="complement" name="complement" class="form-control">
		<span class="help-block m-b-none">Digite o complemento.</span>
	</div>
	<div class="col-sm-5">
		<label class=" control-label" for="neighborhood">Bairro *</label>
		<input type="text" id="neighborhood" name="neighborhood" class="form-control" required>
		<span class="help-block m-b-none">Digite o bairro.</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-6">
		<label class=" control-label" for="city">Cidade *</label>
		<input type="text" id="city" name="city" class="form-control" required>
		<span class="help-block m-b-none">Digite a cidade.</span>
	</div>
	<div class="col-sm-6">
		<label class=" control-label" for="uf">UF *</label>
		<select id="uf" name="uf"  class="select2_demo_1 form-control" required>
			<option value="">Selecione a página</option>
			@foreach($listSelectBox->state as $item)
			<option value="{{ $item->id }}">{{ $item->description }}</option>
			@endforeach
		</select>
		<span class="help-block m-b-none">Selecione a UF.</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-7">
		<label class=" control-label" for="cep">CEP *</label>
		<input type="text" id="cep" name="cep" class="form-control" data-mask="99999-999" placeholder="" required>
		<span class="help-block m-b-none">Digite a cidade.</span>
	</div>
	<div class="col-sm-5">
		<label class=" control-label" for="phone">Telefone *</label>
		<input type="text" id="phone" name="phone" class="form-control" data-mask="(99) 9999-9999" placeholder="" required>
		<span class="help-block m-b-none">Digite o telefone principal.</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-7">
		<label class=" control-label" for="cell_phone">Celular</label>
		<input type="text" id="cell_phone" name="cell_phone" class="form-control" data-mask="(99) 9 9999-9999" placeholder="">
		<span class="help-block m-b-none">Digite o celular principal.</span>
	</div>
	<div class="col-sm-5">
		<label class=" control-label" for="email">E-mail</label>
		<input type="email" id="email" name="email" class="form-control" placeholder="exemplo@site.com.br">
		<span class="help-block m-b-none">Digite o e-mail principal.</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-7">
		<label class="control-label" for="responsible">Responsavel</label>
		<input type="text" id="responsible" name="responsible" class="form-control" data-mask="" placeholder="">
		<span class="help-block m-b-none">Digite o nome do Responsavel do Local</span>
	</div>
	<div class="col-sm-5">
		<label class="control-label" for="phone_resp">Telefone Responsavel</label>
		<input type="text" id="phone_resp" name="phone_resp" class="form-control" data-mask="(99) 9 9999-9999">
		<span class="help-block m-b-none">Digite o Telefone do Responsavel</span>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-12">
		<label class=" control-label">Informações da Local</label>
		<textarea name="company_information" class="form-control" rows="10"></textarea>
	</div>
</div>
