<?php

namespace App\Console\Jobs;

use App\Model\api\AppConfModel;
use App\Model\api\OrderModel;
use App\Model\api\OrderParcelModel;

class CronAsaasPayments {
	public static function run() {
		$appConf = AppConfModel::first();

		$date = $appConf->cron_asaas_payments;
		$currentDate = date('Y-m-d');
		$offset = 0;
		$limit = 100;
		$isRepeat = false;
		$dataResult = [];

		do {
			try {
				$asaas = asaas(
					['path' => "payments?limit={$limit}&offset={$offset}&paymentDate%5Bge%5D={$date}&paymentDate%5Ble%5D={$currentDate}", ]
				);

				if (isset($asaas->data)) {
					$data = $asaas->data;
					$dataResult[] = $data;

					for ($i = count($data) - 1; $i > -1; $i--) {
						$item = $data[$i];

						$orderParcel = OrderParcelModel::where('asaas_code', $item->id)->first();

						if ($orderParcel) {
							$dataToSave = [
								'asaas_json' => json_encode($item),
								'payday' => $item->paymentDate,
							];

							$dataToSave['value_paid'] = $item->value;

							$orderParcel->fill($dataToSave)->save();

							$orderModel = OrderModel::find($orderParcel->order_id);

							if ($orderModel) {
								$orderModel->fill([ 'status' => 'AP' ])->save();
							}
						}
					}

					$isRepeat = $asaas->hasMore;
					$offset += $limit;
				}

				$appConf->fill([
					'cron_asaas_payments' => \Carbon\Carbon::now(),
				])->save();
			} catch (\Throwable $th) {
				throw $th;
			}

		} while ($isRepeat);

		return $dataResult;
	}
}
