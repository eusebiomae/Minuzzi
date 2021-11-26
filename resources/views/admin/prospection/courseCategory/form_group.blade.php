{{ csrf_field() }}
<input name="id" type="hidden" value="">
<div class="col-lg-12">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nome da Categoria</label>
		<div class="col-sm-10">
			<input type="text" id="description_pt" name="description_pt" class="form-control" value="">
			<span class="help-block m-b-none">Digite o nome da categoria.</span>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="form-group">
		<label class="col-sm-2 control-label">Cor Oficial</label>
		<div class="col-sm-2">
			<input type="color" id="color" name="color" class="form-control" value="#a9a9a9" /> {{-- Manda o valor em Hexadecial --}}
		</div>

		<label class="col-sm-2 control-label">Ocultar Categoria</label>
		<div class="col-sm-2">
			<div class="switch">
				<div class="onoffswitch m-sm">
					<input type="checkbox" name="invisible" class="onoffswitch-checkbox" id="invisible" value="1" onchange = "makeInvisible()" />
					<label class="onoffswitch-label" for="invisible">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			</div>
		</div>

		<label class="col-sm-2 control-label divCourseConnected">Ocultar os cursos e bolsas desta categoria</label>
		<div class="col-sm-2 divCourseConnected">
			<div class="switch">
				<div class="onoffswitch m-sm">
					<input type="checkbox" name="invisible_connected" class="onoffswitch-checkbox" id="invisible_connected" value="1"/>
					<label class="onoffswitch-label" for="invisible_connected">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="form-group">
		<label class="col-sm-2 control-label">Imagem em destaque*</label>
		<div class="col-sm-10">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" id="fileImage" name="fileImage" value="">
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
			<div id="img" class="img"></div>
		</div>
	</div>
</div>
