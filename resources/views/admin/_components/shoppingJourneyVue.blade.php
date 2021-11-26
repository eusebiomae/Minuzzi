@include('admin.student.formVue')

{{-- formCreditCard --}}
<script type="text/x-template" id="formCreditCard">
	<div id="formCreditCard">
		<div class="row mt-5">
			<div class="col-lg-4">
				<div class="form-group">
					<label>Nome do Titular*</label>
					<input type="text" v-model="dataForm.cardholder" placeholder="" class="gp-w form-control required">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Nº do Cartão*</label>
					<input type="text" v-model="dataForm.number_card" placeholder="" class="gp-w form-control required">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="form-group">
					<label>Cod. de Seg.*</label>
					<input type="text" v-model="dataForm.security_code" placeholder="" class="gp-w form-control required">
				</div>
			</div>
			<div class="col-lg-2">
				<div class="form-group">
					<q-input v-model="dataForm.shelf_life" label="Validade*" mask="##/##" filled outlined dense/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="form-group">
					<label>CPF do Titular*</label>
					<input type="text" v-model="dataForm.cpf" placeholder="" class="gp-w form-control required mask-cpf">
				</div>
			</div>
			<div class="col-lg-4">
				<q-input v-model="dataForm.birth_date" label="Data de Nasc.*" filled dense>
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
			<div class="col-lg-4">
				<div class="form-group">
					<label>Telefone*</label>
					<input type="text" v-model="dataForm.phone" placeholder="" class="gp-w form-control required mask-cellphone">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="form-group">
					<label>E-mail do Titular*</label>
					<input type="text" v-model="dataForm.email" placeholder="E-mail do Titular" class="gp-w form-control required">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>CEP*</label>
					<input type="text" v-model="dataForm.zip_code" placeholder="" class="gp-w form-control required mask-cep">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Nº*</label>
					<input type="text" v-model="dataForm.address_number" placeholder="" class="gp-w form-control required">
				</div>
			</div>
		</div>
	</div>
</script>
<script>
	Vue.component('form-credit-card', {
		template: '#formCreditCard',
		props: {
			dataForm: {
				type: Object,
				required: true
			}
		},
		mounted: function() {
		}
	})
</script>
{{-- / formCreditCard --}}

{{-- formSupervision --}}
<script type="text/x-template" id="formSupervision">
	<form name="formSupervision">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<q-select @input="selectedSupervision" :options="supervisions" option-label="label" label="Supervisão" dense filled outlined clearable use-input />
			</div>
		</div>

		<div class="row" v-if="supervision">
			<div class="col-lg-12 col-sm-12 col-md-12">
				<h4>@{{ supervision.label }}</h4>
				<div>Responsável: <b>@{{ supervision.teacher.name }}</b></div>
				<q-list>
					<q-item><q-radio dense v-model="supervision.valueSelected" val="1" checked :label="'Ex-alunos: R$' + numberWithCommas(supervision.value_1, 2)" />
					<q-item><q-radio dense v-model="supervision.valueSelected" val="2" :label="'Avulso: R$' + numberWithCommas(supervision.value_2, 2)" />
				</q-list>
			</div>

			<div class="col-lg-12 col-sm-12 col-md-12 text-right">
				<q-btn color="primary" label="Avançar" @click="toFormPayment" />
			</div>
		</div>
	</form>
</script>
<script>
	Vue.component('form-supervision', {
		template: '#formSupervision',
		props: {
			dataForm: {
				type: Object,
				required: true
			}
		},
		data: function() {
			return {
				supervision: null,
				supervisions: APP.payload.supervision.map(function(item) {
					var course = item.course.reduce(function(carry, item) {
						carry.push(item.title_pt)

						return carry
					}, []).join(' | ')

					item.label = item.date + ' - ' + course
					item.valueSelected = '1'

					return item
				}),
			}
		},
		methods: {
			selectedSupervision: function(data) {
				this.supervision = data
			},
			toFormPayment: function() {
				this.$emit('toFormPayment', {
					target: 'supervision',
					data: this.supervision,
				})
			},
		}
	})
</script>
{{-- / formSupervision --}}

{{-- formCourse --}}
<script type="text/x-template" id="formCourse">
	<form name="formCourse">
		<div class="row">
			<div class="col-sm-12 col-md-3 col-lg-3">
				<q-select v-model="dataForm.categoryType" @input="onChangefilterCourse('type')" :options="categoryTypes" option-label="title" label="Tipo" dense filled outlined clearable use-input></q-select>
			</div>
			<div class="col-sm-12 col-md-5 col-lg-5">
				<q-select v-model="dataForm.category" @input="onChangefilterCourse('category')" :options="categories" option-label="description_pt" label="Categoria" dense filled outlined clearable use-input></q-select>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4">
				<q-select v-model="dataForm.subCategory" @input="onChangefilterCourse('subcategory')" :options="subCategories" option-label="description_pt" label="Subcategoria" dense filled outlined clearable use-input></q-select>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<q-select v-model="dataForm.course" @input="selectedCourse" :options="courses" option-label="title_pt" option-value="id" label="Curso" dense outlined clearable filled use-input></q-select>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<q-select v-model="dataForm.class" :options="classLists" option-label="name" label="Turma*" dense filled outlined clearable use-input></q-select>
			</div>
		</div>

		<div class="col-12 text-right" v-show="dataForm.class">
			<q-btn color="primary" label="Avançar" @click="toFormPayment" />
		</div>
	</form>
</script>
<script>
	Vue.component('form-course', {
		template: '#formCourse',
		props: {
			dataForm: {
				type: Object,
				required: true
			}
		},
		data: function() {
			return {
				categoryTypes: APP.payload.categoryType,
				categories: APP.payload.category,
				subCategories: APP.payload.subCategory,
				courses: Object.assign([], APP.payload.courses),
				classLists: [],
				course: null,
			}
		},
		methods: {
			onChangefilterCourse: function(key) {

				var type = this.dataForm.categoryType && this.dataForm.categoryType.id
				var category = this.dataForm.category && this.dataForm.category.id
				var subCategory = this.dataForm.subCategory && this.dataForm.subCategory.id

				this.courses.splice(0)

				this.dataForm.course = null
				this.dataForm.class = null
				this.classLists = []

				var courses = APP.payload.courses

				for (var i = 0; i < courses.length; i++) {
					var course =  courses[i]

					if (type && course.course_category_type_id != type) {
						continue
					}

					if (category && course.course_category_id != category) {
						continue
					}

					if (subCategory && course.course_subcategory_id != subCategory) {
						continue
					}

					this.courses.push(course)
				}

			},
			selectedCourse: function(course) {
				this.classLists = course ? course.class : []
				delete this.dataForm.class
			},
			selectedClass: function(idClass) {
				// delete this.dataForm.class
				// console.log(this.dataForm.class);
				// this.dataForm.class = this.classLists.find(function(item) { return item.id == idClass })

				// this.$forceUpdate()
			},
			toFormPayment: function() {
				this.$emit('toFormPayment', {
					target: 'course',
					data: this.dataForm,
				})
			},
		},
		mounted: function() {
			var that = this

			this.$eventBus.$on('selectedCourse', function(data) {
				that.selectedCourse(data)
			})

			this.$eventBus.$on('selectedClass', function(idClass) {
				that.selectedClass(idClass)
			})
		},
	})
</script>
{{-- / formCourse --}}

{{-- formFormPayment --}}
<script type="text/x-template" id="formFormPayment">
	<form name="formFormPayment">
		<div class="row">
			<div class="col-md-7 col-sm-7 col-lg-8">
				<q-select v-model="dataForm.responsible_id" :options="responsibles" option-label="name" label="Responsável pela venda*" required dense filled outlined clearable use-input />
			</div>

			<div class="col-md-3 col-sm-3 col-lg-2 text-right">
				<q-btn @click="specialNegotiationFn" color="secondary">@{{ specialNegotiation.label }}</q-btn>
			</div>

			<div class="col-md-2 col-sm-2 col-lg-2 text-left">
				<q-btn @click="newSpecialNegotiation" color="secondary" v-if="specialNegotiation.is" icon="add_box">
					<q-tooltip>
						Nova Transação
					</q-tooltip>
				</q-btn>
			</div>
		</div>

		<div class="row" v-if="!specialNegotiation.is">
			<div class="col-md-3 col-sm-6">
				<q-select @input="setFormPaymentParcel" v-model="dataForm.formPayment" :options="courseFormPayments" option-label="label" label="Forma de Pagamento" dense filled outlined clearable use-input />
			</div>

			<div class="col-md-3 col-sm-6">
				<q-select @input="changeFormPaymentParcel" v-model="dataForm.courseFormPayment" :options="formPaymentParcel" option-label="label" label="Nº de Parcela" dense filled outlined clearable use-input />
			</div>

			<div class="col-md-3 col-sm-6" title="Selecione o melhor dia para pagamento">
				<q-select v-model="dataForm.expiration_day" :options="expirationDay" label="Dia de vencimento" dense filled outlined use-input />
			</div>

			<div class="col-md-3 col-sm-6">
				<span v-if="order.financial_credit">Crédito financeiro: R$ @{{ numberWithCommas(order.financial_credit, 2) }}</span>
				<h4 class="q-pa-sm">Valor: R$ @{{ calcTFPP(dataForm.courseFormPayment) }}</h4>
			</div>

			<div class="col-md-6 col-sm-12 col-lg-3">
				<q-input type="text" v-model="discount.code" label="Cupom de desconto" dense filled outlined>
					<template v-slot:append>
						<q-btn @click="applyDiscount" color="secondary" dense filled outlined>Aplicar</q-btn>
					</template>
				</q-input>
			</div>

			<div class="col-md-12 col-sm-12" v-if="dataForm.formPayment && dataForm.formPayment.formPayment.flg_type == 'card'">
				<form-credit-card :dataForm="dataForm.creditCard"></form-credit-card>
			</div>
		</div>

		<div class="row bg-red-1" style="margin-top: 10px;" v-if="specialNegotiation.is" v-for="(specialNegotiation_data, specialNegotiation_indx) in dataForm.specialNegotiation">
			<div class="col-lg-12 col-sm-12 col-md-12 text-right" style="padding: 0">
				<q-btn color="negative" size="xs" padding="xs" icon="clear" @click="delSpecialNegotiation(specialNegotiation_indx)" />
			</div>

			<div class="col-lg-3 col-sm-6 q-pa-sm">
				<q-select
					@input="setFormPaymentParcel(specialNegotiation_data)"
					v-model="specialNegotiation_data.formPayment"
					:options="formPayments"
					option-label="description"
					label="Forma de Pagamento"
					dense filled outlined clearable use-input
				/>
			</div>

			<div class="col-lg-3 col-sm-6 q-pa-sm" title="As proximas cobranças serão no mesmo dia nos meses seguintes">
				<q-input v-model="specialNegotiation_data.due_date" label="Selecione o melhor dia para pagamento" filled dense>
					<template v-slot:prepend>
						<q-icon name="event" class="cursor-pointer">
							<q-popup-proxy transition-show="scale" transition-hide="scale">
								<q-date v-model="specialNegotiation_data.due_date" mask="DD/MM/YYYY" :min="new Date()">
									<div class="row items-center justify-end">
										<q-btn v-close-popup label="Close" color="primary" flat />
									</div>
								</q-date>
							</q-popup-proxy>
						</q-icon>
					</template>
				</q-input>
			</div>

			<div class="col-lg-2 col-sm-3 q-pa-sm">
				<q-input type="number" v-model="specialNegotiation_data.parcel" label="Parcelas" dense filled outlined maxlength="5"></q-input>
			</div>

			<div class="col-lg-2 col-sm-3 q-pa-sm">
				<q-input type="tel" v-model="specialNegotiation_data.value" label="Valor da Parcela" dense filled outlined></q-input>
			</div>

			<div class="col-lg-2 col-sm-6 q-pa-sm">
				<h4 class="q-pa-sm">Valor : R$ @{{ calcTFPP(specialNegotiation_data) }}</h4>
			</div>

			<div class="col-lg-12 col-sm-12 col-md-12" v-if="specialNegotiation_data.formPayment && specialNegotiation_data.formPayment.flg_type == 'card'">
				<form-credit-card :dataForm="specialNegotiation_data.creditCard"></form-credit-card>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-12 text-right" v-html="updateDisplayValue()"></div>
		<div class="col-12 text-right">
			<q-btn v-show="!hasConfirmPayment" color="primary" label="Confirmar" @click="confirm" />
		</div>
	</div>

</form>
</script>
<script>
	Vue.component('form-formpayment', {
		template: '#formFormPayment',
		props: {
			order: {
				type: Object,
			},
			courseFormPayments: {
				type: Array,
			},
			hasConfirmPayment: {
				type: Boolean,
			},
		},
		data: function() {
			return {
				dataForm: {
					specialNegotiation: [],
					formPayment: null,
					expiration_day: 5,
					due_date: null,
					creditCard: {},
				},
				responsibles: APP.payload.responsible,
				formPayments: APP.payload.formPayment,
				formPaymentParcel: [],
				expirationDay: [ 5, 10, 15, 20, 25 ],
				specialNegotiation: {
					label: 'Negociação especial',
					is: false,
				},
				discount: {
					code: '',
				},
			}
		},
		methods: {
			calcTFPP: function(courseFormPayment) {
				if (courseFormPayment) {
					return numberWithCommas(courseFormPayment.value * courseFormPayment.parcel, 2)
				}

				return '0.00'
			},
			updateDisplayValue: function() {
				var displayHTML = ''
				var dataForm = this.dataForm
				var order = this.order
				var value = 0

				if (dataForm.specialNegotiation.length) {
					for (var i = 0; i < dataForm.specialNegotiation.length; i++) {
						var specialNegotiation = dataForm.specialNegotiation[i]
						if (specialNegotiation.parcel > 0 && specialNegotiation.value > 0) {
							value += specialNegotiation.parcel * specialNegotiation.value
						}
					}
				} else
				if (dataForm.courseFormPayment) {
					var discount = 0
					var parcel = dataForm.courseFormPayment.parcel
					var value = dataForm.courseFormPayment.value

					if (this.discount.percentage > 0) {
						discount = this.discount.percentage / 100 * value
					} else
					if (this.discount.value > 0) {
						discount = this.discount.value / parcel
					}

					if (discount) {
						displayHTML += 'Com Desconto de R$' + numberWithCommas(discount * parcel, 2)
						value -= discount
					}


					displayHTML += '<h3>x' + parcel + ' R$' + numberWithCommas(value, 2) + '</h3>'
					value = value * parcel
				}

				var valueTotal = numberWithCommas(value < 0 ? 0 : value, 2)

				displayHTML += '<h4>Valor total: R$ '+ valueTotal +'</h4>'
				return displayHTML
			},
			specialNegotiationFn: function() {
				this.specialNegotiation.is = !this.specialNegotiation.is
				this.specialNegotiation.label = this.specialNegotiation.is ? 'Negociação normal' : 'Negociação especial'

				if (this.specialNegotiation.is) {
					this.newSpecialNegotiation()
				} else {
					this.dataForm.specialNegotiation.splice(0)
				}
			},
			setFormPaymentParcel: function(formPayment) {
				delete this.dataForm.courseFormPayment

				if (formPayment) {
					this.formPaymentParcel = formPayment.parcelOpts
				} else {
					this.formPaymentParcel = []
				}
			},
			changeFormPaymentParcel: function(data) {
			},
			newSpecialNegotiation: function() {
				this.dataForm.specialNegotiation.push({
					formPayment: {
						description: '',
						flg_type: null,
					},
					creditCard: {},
					expiration_day: 5,
					due_date: null,
					parcel: null,
					value: null,
				})
			},
			delSpecialNegotiation: function(idx) {
				this.dataForm.specialNegotiation.splice(idx, 1)
			},
			confirm: function() {
				this.$emit('toConfirmPayment', this.dataForm)
			},
			applyDiscount: function() {
				var that = this
				// this.discount

				$.ajax({
					url: '/student_area/api/apply_discount',
					type: 'post',
					data: {
						code: this.discount.code,
						courseId: this.order.course_id,
					},
				}).then(function(resp) {
					if (resp) {
						that.discount = resp
						that.order.course_discount_id = resp.course_discount_id
					} else {
						that.discount = { code: '' }

						swal({
							type: 'warning',
							title: "Esse cupom não é válido",
						})
					}
				})
			}
		},
		mounted: function() {

		}
	})
</script>
{{-- / formFormPayment --}}

{{-- tabsShoppingJourney --}}
<script type="text/x-template" id="tabsShoppingJourney">
	<q-card class="q-gutter-sm">
		<q-tabs
		v-model="tabsShoppingJourney.tab"
		dense
		class="text-grey"
		active-color="primary"
		indicator-color="primary"
		narrow-indicator
		@input="onTabsChange"
		>
		<q-tab name="accessData" label="Dados de Acesso" :disable="tabsShoppingJourney.tabs.accessData.disabled"/>
		<q-tab name="personalData" label="Dados Pessoais" :disable="tabsShoppingJourney.tabs.personalData.disabled"/>
		<q-tab name="supervision" label="Supervisão" :disable="tabsShoppingJourney.tabs.supervision.disabled"/>
		<q-tab name="course" label="Curso" :disable="tabsShoppingJourney.tabs.course.disabled"/>
		<q-tab name="payment" label="Pagamento" :disable="tabsShoppingJourney.tabs.payment.disabled"/>
		<q-tab name="confirmation" label="Confirmação" :disable="tabsShoppingJourney.tabs.confirmation.disabled"/>
	</q-tabs>

	<q-separator />

	<q-tab-panels v-model="tabsShoppingJourney.tab" animated>
		<q-tab-panel name="accessData">
			<div class="row form-group">
				<div class="col-sm-12 col-md-12 col-lg-12">
						<q-select
							filled
							v-model="student"
							clearable
							use-input
							hide-selected
							dense
							fill-input
							input-debounce="0"
							label="Aluno:"
							:options="studentSelected"
							option-value="id"
							@filter="studentSearch"
							@input="onStudentSelected"
						>
						<template v-slot:no-option>
							<q-item>
								<q-item-section class="text-grey">
									Nenhum resultado encontrado <q-btn @click="onStudentSelected()">Efetuar cadastro</q-btn>
								</q-item-section>
							</q-item>
						</template>
					</q-select>
				</div>
			</div>
		</q-tab-panel>

	<q-tab-panel name="personalData">
		<form-student
			:onSubmitForm="onSubmitStudent"
			:dataForm="student"
		></form-student>
	</q-tab-panel>

	<q-tab-panel name="supervision">
		<form-supervision
			:dataForm="student"
			@toFormPayment="toFormPayment"
		></form-supervision>
	</q-tab-panel>

	<q-tab-panel name="course">
		<form-course
			:dataForm="shoppingJourney.course"
			@toFormPayment="toFormPayment"
		></form-course>
	</q-tab-panel>

	<q-tab-panel name="payment">
		<form-formpayment
			@toConfirmPayment="toConfirmPayment"
			:order="order"
			:courseFormPayments="courseFormPayments"
			:hasConfirmPayment="hasConfirmPayment"
		></form-formpayment>
	</q-tab-panel>

	<q-tab-panel name="confirmation">
		<h1 class="mt-5 mt-md-none text-center">Inscrição feita com Sucesso!</h1>

		<div style="text-align: center; margin-top: 30px;" v-for="item in confirmPayment">
			<span v-if="item.payments.billingType == 'BOLETO'">
				<a :href="item.payments.bankSlipUrl" target="_blank"><q-btn label="Clique aqui para imprimir seu boleto!" color="primary" no-caps /></a>
			</span>
		</div>

		<div id="errorPayments" class="hide">
			Houve um erro na API de pagamento, sua inscrição já foi efetuada, e nossa equipe entrará em contato em breve
		</div>
	</q-tab-panel>
</q-tab-panels>
</q-card>
</script>
<script>
	Vue.component('tabs-shopping-journey', {
		template: '#tabsShoppingJourney',
		data: function() {
			return {
				tabsShoppingJourney: {
					tab: 'accessData',
					tabs: {
						accessData: {
							disabled: false,
						},
						personalData: {
							disabled: true,
						},
						supervision: {
							disabled: true,
						},
						course: {
							disabled: true,
						},
						payment: {
							disabled: true,
						},
						confirmation: {
							disabled: true,
						},
					},
				},
				student: {
					label: '',
					psychology_training: false,
					tcc_experience: '0',
				},
				order: {},
				studentSelected: [],
				studentTimeout: null,
				courseFormPayments: [],
				shoppingJourney: {
					course: {
						course: null,
					},
				},
				hasConfirmPayment: false,
				confirmPayment: [],
				queryString: searchToObj(),
			}
		},
		methods: {
			_changeTab: function(tab) {
				this.tabsShoppingJourney.tab = tab
				this.tabsShoppingJourney.tabs[tab].disabled = false
				this.onTabsChange(tab)
			},
			studentSearch: function(val, update, abort) {
				var that = this
				clearTimeout(this.studentTimeout)

				this.studentTimeout = setTimeout(function() {
					$.ajax({
						url: '/admin/prospection/student/getAjax',
						type: 'post',
						data: { name: val },
					})
					.then(function(resp) {
						that.studentSelected = resp.map(function(item) {
							item.label = item.cpf + ' - ' + item.name

							return item
						})

						update()
					})
				}, 500)
			},
			onStudentSelected: function(student) {
				if (student) {
					this.$set(student, 'psychology_training', !!student.formation)

					this.student = student
				} else {
					this.student = {
						label: '',
						psychology_training: false,
						tcc_experience: '0',
					}
				}

				this._changeTab('personalData')
			},
			onSubmitStudent: function(data, form) {
				var that = this

				return form.validate().then(function(valid) {
					return $.ajax({
						url: '/student_area/api/account_data',
						type: 'post',
						data: data,
						async: false,
					}).then(function(resp) {
						that.student = resp

						that._changeTab('supervision')
						that._changeTab('course')

						return resp
					})

				})
			},
			onTabsChange: function(tab) {
				var that = this

				switch (tab) {
					case ' ': {
						/*setTimeout(function() {
							console.log(that.$refs.formStudent.$refs.form.validate())
						}, 500);*/
					}	break;
					case 'payment': {
					} break;
				}
			},
			toFormPayment: function(opts) {
				switch(opts.target) {
					case 'supervision': {
						this.order.supervision_id = opts.data.id
						this.order.course_id = null
						this.order.class_id = null

						var formPayment = APP.payload.formPayment.find(function(item) { return item.flg_type == 'card' })

						var value = opts.data[ 'value_' + opts.data.valueSelected ]

						this.courseFormPayments = [{
							id: formPayment.id,
							label: formPayment.description,
							formPayment: formPayment,
							parcelOpts: [{
								id: null,
								label: "x" + 1 + " R$" + numberWithCommas(value, 2),
								parcel: 1,
								value: value,
								full_value: value,
								supervisionType: opts.data.valueSelected,
							}],
						}]

					} break;
					case 'course': {
						this.order.supervision_id = null
						this.order.course_id = opts.data.course.id
						this.order.class_id = opts.data.class.id

						var order = this.order

						var courseFormPayments = opts.data.course.course_form_payment.reduce(function(carry, item) {
							var formPaymentId = item.form_payment_id

							//verifica se a forma de pagamento já foi mapeada
							if (!carry[formPaymentId]) {
								carry[formPaymentId] = {
									id: item.form_payment_id,
									label: item.form_payment.description,
									formPayment: item.form_payment,
									parcelOpts: []
								}
							}

							if (order.financial_credit) {
								var newValue = item.value - (order.financial_credit / item.parcel)

								item.label = "x" + item.parcel + ('(<s>'+ numberWithCommas(item.value, 2) +'</s>)') + " R$" + numberWithCommas(newValue, 2)

								item.value = newValue
								item.full_value = item.full_value - order.financial_credit
							} else {
								item.label = "x" + item.parcel + " R$" + numberWithCommas(item.value, 2)
							}

							// adiciona a opção de parcelamento
							carry[formPaymentId].parcelOpts.push({
								id: item.id,
								label:  item.label,
								parcel: item.parcel,
								value: item.value,
								full_value: item.full_value,
							})

							return carry
						}, {})

						this.courseFormPayments = Object.values(courseFormPayments)
					} break;
				}

				this._changeTab('payment')
			},
			toConfirmPayment: function(payload) {
				var that = this

				var errors = []

				if (!this.student.id) {
					errors.push('Estudante não selecionado')
				}

				if (!payload.responsible_id) {
					errors.push('Responsável pela venda não selecionado')
				}

				if (payload.specialNegotiation.length == 0 && !payload.formPayment) {
					errors.push('Nº de Parcela não selecionado')
				}

				if (errors.length) {
					showErrorShoppingJouney(errors.join('\n'))
					return
				}

				this.order.student_id = this.student.id
				this.order.responsible_id = payload.responsible_id.id

				if (payload.specialNegotiation.length > 0) {
					this.order.formPayment = payload.specialNegotiation.map(function(item) {
						return Object.assign({
							formPayment: item.formPayment.id,
							expiration_day: item.expiration_day,
							due_date: that.formatDueDate(item.due_date),
							specialNegotiation: {
								parcel: item.parcel,
								value: item.value,
							},
						}, item.creditCard || {} )
					})
				} else {
					this.order.formPayment = [
						Object.assign({
							course_form_payment_id: payload.courseFormPayment.id,
							supervisionType: payload.courseFormPayment.supervisionType || null,
							formPayment: payload.formPayment.formPayment.id,
							expiration_day: payload.expiration_day,
							due_date: that.formatDueDate(payload.due_date),
						}, payload.creditCard || {} ),
					]
				}

				this.hasConfirmPayment = true
				$.ajax({
					url: '/student_area/api/confirm_payment',
					type: 'post',
					data: this.order,
					dataType: 'json',
				})
				.then(function(resp) {
					that.hasConfirmPayment = false

					if (resp.showError) {
						throw showErrorShoppingJouney(resp.showError)
					}

					that.confirmPayment = resp

					that._changeTab('confirmation')
				})
				.catch(function(resp) {
					console.info(resp);
					that.hasConfirmPayment = false
				})
			},
			formatDueDate: function(val) {
				if ((/^\d{2}\/\d{2}\/\d{4}$/).test(val)) {
					return val.replace(/^(\d{2})\/(\d{2})\/(\d{4})$/, '$3-$2-$1')
				}

				return null
			},
			getStudent: function(data) {
				return $.ajax({
					url: '/admin/prospection/student/getAjax',
					type: 'post',
					data: data,
				})
			},
			getOrder: function(data) {
				return $.ajax({
					url: '/admin/make_student_registration/get_order',
					type: 'post',
					data: data,
				})
			},
		},
		mounted: function() {
			var that = this

			if (this.queryString.student) {
				this.getStudent({ id: this.queryString.student }).then(function(resp) {
					that.onStudentSelected(resp[0]);

					that._changeTab('personalData')
					that._changeTab('course')

					if (that.queryString.lastOrder) {
						that.order.transfer_order_id = that.queryString.lastOrder
						that.order.financial_credit = that.queryString.financialCredit

						that.getOrder({
							id: that.queryString.lastOrder,
						}).then(function(resp) {
							if (resp[0]) {
								resp = resp[0]

								that.shoppingJourney.course.course = APP.payload.courses.find(function(item) { return item.id == resp.course_id })
								that.shoppingJourney.course.categoryType = resp.course.course_category_type
								that.shoppingJourney.course.category = resp.course.course_category
								that.shoppingJourney.course.subCategory = resp.course.course_subcategory

								that.$eventBus.$emit('selectedCourse', that.shoppingJourney.course.course)
								that.$eventBus.$emit('selectedClass', resp.class_id)
							}
						})
					}
				})
			}

		}
	});
</script>
{{-- / tabsShoppingJourney --}}
