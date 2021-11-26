<script type="text/x-template" id="formStudent">
	<q-card class="q-gutter-sm q-pa-md">
		<q-form ref="form">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined  v-model="dataForm.name" label="Nome Completo*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input type="email" filled outlined v-model="dataForm.email" label="E-mail*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input v-model="dataForm.cpf" label="CPF*" dense filled outlined required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<label style="display: block">Genero*</label>
					<q-radio dense v-model="dataForm.gender" val="male" label="Masculino" required></q-radio>
					<q-radio dense v-model="dataForm.gender" val="feminine" label="Feminino" required></q-radio>
					<q-radio dense v-model="dataForm.gender" val="other" label="Outro" required></q-radio>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.rg" label="RG*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.zip_code" label="CEP*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.address" label="Endereço*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.n" label="Nº*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.neighborhood" label="Bairro*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.city" label="Cidade*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.phone" label="Estado*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input v-model="dataForm.state_id" label="Telefone*" dense filled outlined required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input filled outlined v-model="dataForm.cell_phone" label="Celular*" dense required></q-input>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<q-input v-model="dataForm.birth_date" label="Data de Nasc." filled dense>
						<template v-slot:prepend>
							<q-icon name="event" class="cursor-pointer">
								<q-popup-proxy transition-show="scale" transition-hide="scale">
									<q-date v-model="dataForm.birth_date" mask="DD/MM/YYYY" default-view="Years">
										<div class="row items-center justify-end">
											<q-btn v-close-popup label="Close" color="primary" flat />
										</div>
									</q-date>
								</q-popup-proxy>
							</q-icon>
						</template>
					</q-input>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
					<q-toggle v-model="dataForm.tcc_experience" label="Exp. com TCC?*" false-value="0" 	true-value="1"></q-toggle>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
					<q-toggle v-model="dataForm.psychology_training" label="Formação em Psicologia?"></q-toggle>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" v-show="dataForm.psychology_training">
					<q-input v-model="dataForm.formation" label="Qual sua Formação?" dense filled outlined></q-input>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<q-input type="textarea" v-model="dataForm.complement" label="Mais Informação" dense filled outlined></q-input>
				</div>
			</div>

			<div class="text-right">
				<q-btn v-show="showBtnSubmit" color="primary" label="Salvar" @click="_onSubmit" />
			</div>

		</q-form>
	</q-card>
</script>

<script>
	Vue.component('form-student', {
		template: '#formStudent',
		props: {
			dataForm: {
				type: Object,
				required: true
			},
			onSubmitForm: {
				type: Function,
				required: true
			},
		},
		data: function() {
			return {
				showBtnSubmit: true,
			}
		},
		methods: {
			_onSubmit: function() {
				var that = this

				this.showBtnSubmit = false

				this.onSubmitForm(this.dataForm, this.$refs.form).then(function() {
					setTimeout(function() {
						that.showBtnSubmit = true
					}, 1000)
				})
			},
		},
		mounted: function() {

		}
	})
</script>
