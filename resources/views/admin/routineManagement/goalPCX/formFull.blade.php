@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />

@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel-body">
								<form name="formGoalPCX" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data"
								class="form-horizontal">
								{{ csrf_field() }}
								<input name="id" type="hidden">
								@include('admin.routineManagement.goalPCX.formGoalPCXFull')
								<div class="col-lg-12">
									<div class="col-lg-10"></div>
									<div class="col-lg-2">
										<div class="form-group">
											<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@include('admin.prospection.leads.phoneContact', [
	'url_page' => 'admin/routine_management/goal_pcx/full',
	'data_target_modal' => 'myModal',
])
@endsection

@section('scripts')
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/typehead/bootstrap3-typeahead.min.js') !!}" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		try {
			APP = {
				scope: {
					goalPCX: <?= isset($data) ? json_encode($data) : 'null' ?>,
					listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
					listPCX: <?= isset($listPCX) ? json_encode($listPCX) : '[]' ?>,
					listActivities: <?= isset($listActivities) ? json_encode($listActivities) : '[]' ?>
				}
			};

			if (APP.scope.listSelectBox.sellers) {
				populateSelectBox({
					list: APP.scope.listSelectBox.sellers,
					target: document.forms.formGoalPCX.user_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.leadsStatus) {
				populateSelectBox({
					list: APP.scope.listSelectBox.leadsStatus,
					target: document.forms.formPhoneContact.leads_status_id,
					columnValue: "id",
					columnLabel: "description_pt",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.goalPCX) {
				if (!APP.scope.goalPCX.date) {
					APP.scope.goalPCX.date = new Date(new Date().getTime() + (1000*60*60*24)).toLocaleDateString();
				}

				populate(document.forms.formGoalPCX, APP.scope.goalPCX);
			}
		} catch (error) {
			console.warn(error);
		}

		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, {
			color: '#1AB394'
		});

		var typeahead = function(selector, data, afterSelect) {
			$(selector).typeahead({
				source: data,
				autoSelect: false,
				displayText: function(item) {
					return item.full_name || item.description;
				},
				afterSelect: afterSelect
			});
		};

		var typeaheadSelected = function(options) {
			return function(data) {
				try {
					this.$element.val('');
					setTmplInsertAdjacentHTML({
						data: {
							id: '',
							fk: data.id,
							label: data.full_name || data.description,
							type: options.key,
							executed: '',
							key: "z" + generateUniqueKey()
						},
						tmpl: 'tmplTypeaHead',
						toTmpl: options.toTmpl,
					});
				} catch (error) {

				}
			};
		};

		var mapToTmplPCX = {
			'P': 'toTmplProspect',
			'C': 'toTmplClient',
			'X': 'toTmplFormerClient'
		}

		$.get('/admin/prospection/prospect/json', function(data) {
			typeahead('.typeahead_prospect', data, typeaheadSelected({
				key: 'P',
				toTmpl: mapToTmplPCX.P,
				column: 'full_name',
			}));

			$.get('/admin/prospection/client/json', function(data) {
				typeahead('.typeahead_client', data, typeaheadSelected({
					key: 'C',
					toTmpl: mapToTmplPCX.C,
					column: 'full_name',
				}));

				$.get('/admin/prospection/former_client/json', function(data) {
					typeahead('.typeahead_former_client', data, typeaheadSelected({
						key: 'X',
						toTmpl: mapToTmplPCX.X,
						column: 'full_name',
					}));

					$.get('/admin/routine_management/activities/json', function(data) {
						typeahead('.typeahead_activities', data, typeaheadSelected({
							key: 'activities',
							toTmpl: 'toTmplActivities',
							column: 'description',
						}));
					});
				});
			});
		});

		var listPCX = APP.scope.listPCX;
		for (var i = 0; i < listPCX.length; i++) {
			var data = listPCX[i];

			setTmplInsertAdjacentHTML({
				data: {
					id: data.id,
					fk: data.fk,
					label: data.full_name,
					type: data.flg_type,
					executed: data.executed,
					key: "a" + generateUniqueKey()
				},
				tmpl: 'tmplTypeaHead',
				toTmpl: mapToTmplPCX[data.flg_type],
			});
		}

		var listPCX = APP.scope.listActivities;
		for (var i = 0; i < listPCX.length; i++) {
			var data = listPCX[i];

			setTmplInsertAdjacentHTML({
				data: {
					id: data.id,
					fk: data.fk,
					label: data.description,
					type: 'activities',
					executed: data.executed,
					key: "a" + generateUniqueKey()
				},
				tmpl: 'tmplTypeaHead',
				toTmpl: 'toTmplActivities',
			});
		}

		readonlyValid(APP.scope.goalPCX.isEdited);

		window.removePCXA = function(type, id) {
			$.get('/admin/routine_management/goal_pcx/full/remove/' + type + '/' + id);
		};

		window.checkPCXA = function(elem, isChecked, type, id, fk) {
			if (isChecked && ["P", "C", "X"].includes(type)) {
				var pcx = APP.scope.listPCX.filter(function(item) {
					return item.fk == fk;
				});

				if (pcx.length && (pcx = pcx[0])) {
					$('#myModal').modal('show');
					populate(document.forms.formPhoneContact, {
						leads_id: pcx.fk,
						contact_name: pcx.full_name,
						phone_contact: pcx.phone_contact,
					});
				}
			}
		}
	});
</script>
@endsection
