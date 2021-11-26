<?php

use App\Model\api\SchoolInformationModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

function adminSession() {
	if (Auth::guard('admin')->check()) {
		if (!Session::has('company')) {
			$company = schoolInformation();
			Session::put('company', $company);
		}

		if (!Session::has('configParameters')) {
			$idUser = Auth::guard('admin')->user()->id;

			Session::put('configParameters', getConfigParameters([
				'idUser' => $idUser,
			]));
		}
	}
}

function schoolInformation() {
	return \App\Model\api\SchoolInformationModel::whereNotNull('flg_main')->with('state')->first();
}

function normalizeColunsToViewOld($columns) {
	$ret = new stdClass();

	$ret->id = null;
	for ($i = count($columns) - 1; $i > -1; $i--) {
		$ret->{$columns[$i]} = null;
	}

	return $ret;
}

function normalizeColunsToView($columns) {
	$newColumnsValues = [];

	$fn = function ($columns, $isInner = false) use (&$newColumnsValues) {
		foreach ($columns as $key => $value) {
			if (is_array($value)) {
				if ($isInner === false) {
					$newColumnsValues[$key] = $value;
				}

				$this($value, true);
			} else {
				if (!isset($newColumnsValues[$key])) {
					$newColumnsValues[$key] = $value;
				}
			}
		}
	};

	$fn($columns, false);

	return $newColumnsValues;
}

function internation($data, $label) {
	$lang = App::getLocale();

	if (!in_array($lang, ['pt', 'en', 'es'])) {
		$lang = 'pt';
	}

	return $data->{"{$label}_{$lang}"};
}

function removeAccents($str, $utf8 = true) {
	$str = (string) $str;
	if (is_null($utf8)) {
		if (!function_exists('mb_detect_encoding')) {
			$utf8 = (strtolower(mb_detect_encoding($str)) == 'utf-8');
		} else {
			$length = strlen($str);
			$utf8 = true;
			for ($i = 0; $i < $length; $i++) {
				$c = ord($str[$i]);
				if ($c < 0x80) $n = 0; # 0bbbbbbb
				elseif (($c & 0xE0) == 0xC0) $n = 1; # 110bbbbb
				elseif (($c & 0xF0) == 0xE0) $n = 2; # 1110bbbb
				elseif (($c & 0xF8) == 0xF0) $n = 3; # 11110bbb
				elseif (($c & 0xFC) == 0xF8) $n = 4; # 111110bb
				elseif (($c & 0xFE) == 0xFC) $n = 5; # 1111110b
				else return false; # Does not match any model
				for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
					if ((++$i == $length)
						|| ((ord($str[$i]) & 0xC0) != 0x80)
					) {
						$utf8 = false;
						break;
					}
				}
			}
		}
	}

	if (!$utf8) {
		$str = utf8_encode($str);
	}

	$transliteration = array(
		'Ĳ' => 'I', 'Ö' => 'O', 'Œ' => 'O', 'Ü' => 'U', 'ä' => 'a', 'æ' => 'a',
		'ĳ' => 'i', 'ö' => 'o', 'œ' => 'o', 'ü' => 'u', 'ß' => 's', 'ſ' => 's',
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
		'Æ' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'ã' => 'a', 'Ã' => 'a', 'Ç' => 'C', 'Ć' => 'C',
		'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'c', 'Ď' => 'D', 'Đ' => 'D', 'È' => 'E',
		'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ě' => 'E',
		'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G',
		'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I', 'İ' => 'I', 'Ĵ' => 'J',
		'Ķ' => 'K', 'Ľ' => 'K', 'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ł' => 'L',
		'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O',
		'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O',
		'Ŏ' => 'O', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Ş' => 'S',
		'Ŝ' => 'S', 'Ș' => 'S', 'Š' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
		'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ū' => 'U', 'Ů' => 'U',
		'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U', 'Ŵ' => 'W', 'Ŷ' => 'Y',
		'Ÿ' => 'Y', 'Ý' => 'Y', 'Ź' => 'Z', 'Ż' => 'Z', 'Ž' => 'Z', 'à' => 'a',
		'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
		'å' => 'a', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
		'ď' => 'd', 'đ' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
		'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ƒ' => 'f',
		'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h', 'ħ' => 'h',
		'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i', 'ĩ' => 'i',
		'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĵ' => 'j', 'ķ' => 'k', 'ĸ' => 'k',
		'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l', 'ŀ' => 'l', 'ñ' => 'n',
		'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n', 'ŋ' => 'n', 'ò' => 'o',
		'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o',
		'ŏ' => 'o', 'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'ś' => 's', 'š' => 's',
		'ť' => 't', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ū' => 'u', 'ů' => 'u',
		'ű' => 'u', 'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ÿ' => 'y',
		'ý' => 'y', 'ŷ' => 'y', 'ż' => 'z', 'ź' => 'z', 'ž' => 'z', 'Α' => 'A',
		'Ά' => 'A', 'Ἀ' => 'A', 'Ἁ' => 'A', 'Ἂ' => 'A', 'Ἃ' => 'A', 'Ἄ' => 'A',
		'Ἅ' => 'A', 'Ἆ' => 'A', 'Ἇ' => 'A', 'ᾈ' => 'A', 'ᾉ' => 'A', 'ᾊ' => 'A',
		'ᾋ' => 'A', 'ᾌ' => 'A', 'ᾍ' => 'A', 'ᾎ' => 'A', 'ᾏ' => 'A', 'Ᾰ' => 'A',
		'Ᾱ' => 'A', 'Ὰ' => 'A', 'ᾼ' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D',
		'Ε' => 'E', 'Έ' => 'E', 'Ἐ' => 'E', 'Ἑ' => 'E', 'Ἒ' => 'E', 'Ἓ' => 'E',
		'Ἔ' => 'E', 'Ἕ' => 'E', 'Ὲ' => 'E', 'Ζ' => 'Z', 'Η' => 'I', 'Ή' => 'I',
		'Ἠ' => 'I', 'Ἡ' => 'I', 'Ἢ' => 'I', 'Ἣ' => 'I', 'Ἤ' => 'I', 'Ἥ' => 'I',
		'Ἦ' => 'I', 'Ἧ' => 'I', 'ᾘ' => 'I', 'ᾙ' => 'I', 'ᾚ' => 'I', 'ᾛ' => 'I',
		'ᾜ' => 'I', 'ᾝ' => 'I', 'ᾞ' => 'I', 'ᾟ' => 'I', 'Ὴ' => 'I', 'ῌ' => 'I',
		'Θ' => 'T', 'Ι' => 'I', 'Ί' => 'I', 'Ϊ' => 'I', 'Ἰ' => 'I', 'Ἱ' => 'I',
		'Ἲ' => 'I', 'Ἳ' => 'I', 'Ἴ' => 'I', 'Ἵ' => 'I', 'Ἶ' => 'I', 'Ἷ' => 'I',
		'Ῐ' => 'I', 'Ῑ' => 'I', 'Ὶ' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M',
		'Ν' => 'N', 'Ξ' => 'K', 'Ο' => 'O', 'Ό' => 'O', 'Ὀ' => 'O', 'Ὁ' => 'O',
		'Ὂ' => 'O', 'Ὃ' => 'O', 'Ὄ' => 'O', 'Ὅ' => 'O', 'Ὸ' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Ῥ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Ύ' => 'Y',
		'Ϋ' => 'Y', 'Ὑ' => 'Y', 'Ὓ' => 'Y', 'Ὕ' => 'Y', 'Ὗ' => 'Y', 'Ῠ' => 'Y',
		'Ῡ' => 'Y', 'Ὺ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'P', 'Ω' => 'O',
		'Ώ' => 'O', 'Ὠ' => 'O', 'Ὡ' => 'O', 'Ὢ' => 'O', 'Ὣ' => 'O', 'Ὤ' => 'O',
		'Ὥ' => 'O', 'Ὦ' => 'O', 'Ὧ' => 'O', 'ᾨ' => 'O', 'ᾩ' => 'O', 'ᾪ' => 'O',
		'ᾫ' => 'O', 'ᾬ' => 'O', 'ᾭ' => 'O', 'ᾮ' => 'O', 'ᾯ' => 'O', 'Ὼ' => 'O',
		'ῼ' => 'O', 'α' => 'a', 'ά' => 'a', 'ἀ' => 'a', 'ἁ' => 'a', 'ἂ' => 'a',
		'ἃ' => 'a', 'ἄ' => 'a', 'ἅ' => 'a', 'ἆ' => 'a', 'ἇ' => 'a', 'ᾀ' => 'a',
		'ᾁ' => 'a', 'ᾂ' => 'a', 'ᾃ' => 'a', 'ᾄ' => 'a', 'ᾅ' => 'a', 'ᾆ' => 'a',
		'ᾇ' => 'a', 'ὰ' => 'a', 'ᾰ' => 'a', 'ᾱ' => 'a', 'ᾲ' => 'a', 'ᾳ' => 'a',
		'ᾴ' => 'a', 'ᾶ' => 'a', 'ᾷ' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd',
		'ε' => 'e', 'έ' => 'e', 'ἐ' => 'e', 'ἑ' => 'e', 'ἒ' => 'e', 'ἓ' => 'e',
		'ἔ' => 'e', 'ἕ' => 'e', 'ὲ' => 'e', 'ζ' => 'z', 'η' => 'i', 'ή' => 'i',
		'ἠ' => 'i', 'ἡ' => 'i', 'ἢ' => 'i', 'ἣ' => 'i', 'ἤ' => 'i', 'ἥ' => 'i',
		'ἦ' => 'i', 'ἧ' => 'i', 'ᾐ' => 'i', 'ᾑ' => 'i', 'ᾒ' => 'i', 'ᾓ' => 'i',
		'ᾔ' => 'i', 'ᾕ' => 'i', 'ᾖ' => 'i', 'ᾗ' => 'i', 'ὴ' => 'i', 'ῂ' => 'i',
		'ῃ' => 'i', 'ῄ' => 'i', 'ῆ' => 'i', 'ῇ' => 'i', 'θ' => 't', 'ι' => 'i',
		'ί' => 'i', 'ϊ' => 'i', 'ΐ' => 'i', 'ἰ' => 'i', 'ἱ' => 'i', 'ἲ' => 'i',
		'ἳ' => 'i', 'ἴ' => 'i', 'ἵ' => 'i', 'ἶ' => 'i', 'ἷ' => 'i', 'ὶ' => 'i',
		'ῐ' => 'i', 'ῑ' => 'i', 'ῒ' => 'i', 'ῖ' => 'i', 'ῗ' => 'i', 'κ' => 'k',
		'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => 'k', 'ο' => 'o', 'ό' => 'o',
		'ὀ' => 'o', 'ὁ' => 'o', 'ὂ' => 'o', 'ὃ' => 'o', 'ὄ' => 'o', 'ὅ' => 'o',
		'ὸ' => 'o', 'π' => 'p', 'ρ' => 'r', 'ῤ' => 'r', 'ῥ' => 'r', 'σ' => 's',
		'ς' => 's', 'τ' => 't', 'υ' => 'y', 'ύ' => 'y', 'ϋ' => 'y', 'ΰ' => 'y',
		'ὐ' => 'y', 'ὑ' => 'y', 'ὒ' => 'y', 'ὓ' => 'y', 'ὔ' => 'y', 'ὕ' => 'y',
		'ὖ' => 'y', 'ὗ' => 'y', 'ὺ' => 'y', 'ῠ' => 'y', 'ῡ' => 'y', 'ῢ' => 'y',
		'ῦ' => 'y', 'ῧ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'p', 'ω' => 'o',
		'ώ' => 'o', 'ὠ' => 'o', 'ὡ' => 'o', 'ὢ' => 'o', 'ὣ' => 'o', 'ὤ' => 'o',
		'ὥ' => 'o', 'ὦ' => 'o', 'ὧ' => 'o', 'ᾠ' => 'o', 'ᾡ' => 'o', 'ᾢ' => 'o',
		'ᾣ' => 'o', 'ᾤ' => 'o', 'ᾥ' => 'o', 'ᾦ' => 'o', 'ᾧ' => 'o', 'ὼ' => 'o',
		'ῲ' => 'o', 'ῳ' => 'o', 'ῴ' => 'o', 'ῶ' => 'o', 'ῷ' => 'o', 'А' => 'A',
		'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E',
		'Ж' => 'Z', 'З' => 'Z', 'И' => 'I', 'Й' => 'I', 'К' => 'K', 'Л' => 'L',
		'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S',
		'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'K', 'Ц' => 'T', 'Ч' => 'C',
		'Ш' => 'S', 'Щ' => 'S', 'Ы' => 'Y', 'Э' => 'E', 'Ю' => 'Y', 'Я' => 'Y',
		'а' => 'A', 'б' => 'B', 'в' => 'V', 'г' => 'G', 'д' => 'D', 'е' => 'E',
		'ё' => 'E', 'ж' => 'Z', 'з' => 'Z', 'и' => 'I', 'й' => 'I', 'к' => 'K',
		'л' => 'L', 'м' => 'M', 'н' => 'N', 'о' => 'O', 'п' => 'P', 'р' => 'R',
		'с' => 'S', 'т' => 'T', 'у' => 'U', 'ф' => 'F', 'х' => 'K', 'ц' => 'T',
		'ч' => 'C', 'ш' => 'S', 'щ' => 'S', 'ы' => 'Y', 'э' => 'E', 'ю' => 'Y',
		'я' => 'Y', 'ð' => 'd', 'Ð' => 'D', 'þ' => 't', 'Þ' => 'T', 'ა' => 'a',
		'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v', 'ზ' => 'z',
		'თ' => 't', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm', 'ნ' => 'n',
		'ო' => 'o', 'პ' => 'p', 'ჟ' => 'z', 'რ' => 'r', 'ს' => 's', 'ტ' => 't',
		'უ' => 'u', 'ფ' => 'p', 'ქ' => 'k', 'ღ' => 'g', 'ყ' => 'q', 'შ' => 's',
		'ჩ' => 'c', 'ც' => 't', 'ძ' => 'd', 'წ' => 't', 'ჭ' => 'c', 'ხ' => 'k',
		'ჯ' => 'j', 'ჰ' => 'h',
	);
	$str = str_replace(array_keys($transliteration), array_values($transliteration), $str);
	return $str;
}

function getNameMonth($month) {
	$arr = [
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro',
	];

	return $arr[$month];
}

function getMonths() {
	return [
		[
			'key' => '01',
			'label' => 'Janeiro',
		],
		[
			'key' => '02',
			'label' => 'Fevereiro',
		],
		[
			'key' => '03',
			'label' => 'Março',
		],
		[
			'key' => '04',
			'label' => 'Abril',
		],
		[
			'key' => '05',
			'label' => 'Maio',
		],
		[
			'key' => '06',
			'label' => 'Junho',
		],
		[
			'key' => '07',
			'label' => 'Julho',
		],
		[
			'key' => '08',
			'label' => 'Agosto',
		],
		[
			'key' => '09',
			'label' => 'Setembro',
		],
		[
			'key' => '10',
			'label' => 'Outubro',
		],
		[
			'key' => '11',
			'label' => 'Novembro',
		],
		[
			'key' => '12',
			'label' => 'Dezembro',
		],
	];
}

function formatNameFile($nameFile) {
	return preg_replace('/[ ]+/', '_', removeAccents($nameFile));
}

function formatDateEng($val) {
	return empty($val) ? null : preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $val);
}

function getValueByColumn($data, $column) {
	$columns = explode('.', $column);

	if (is_array($data)) {
		for ($i = 0, $ii = count($columns); $i < $ii; $i++) {
			$data = isset($data[$columns[$i]]) ? $data[$columns[$i]] : null;
		}
	} else {
		for ($i = 0, $ii = count($columns); $i < $ii; $i++) {
			$data = isset($data->{$columns[$i]}) ? $data->{$columns[$i]} : null;
		}
	}


	return $data;
}

function toNumberFormat($val) {
	$source  = array('.', ',', '_');
	$replace = array('', '.', '0');
	$value = str_replace($source, $replace, $val);

	$value = preg_replace('/^\D+(?=(\.))|^\D+/', '', $value);

	return floatval($value);
}

function formatNumber($val = 0, $dec = 2) {
	return number_format($val, $dec, ',', '.');
}

function utf8_fopen_read($fileName) {
	$fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName));
	$handle = fopen("php://memory", "rw");
	fwrite($handle, $fc);
	fseek($handle, 0);
	return $handle;
}

function detectDelimiter($fh) {
	$delimiters = [',', ';', "\t", '|', ':', ' ', '~'];
	$data_1 = [];
	$data_2 = [];
	$delimiter = $delimiters[0];
	foreach ($delimiters as $d) {
		$data_1 = fgetcsv($fh, 4096, $d);
		if (count($data_1) > count($data_2)) {
			$delimiter = $d;
			$data_2 = $data_1;
		}
		rewind($fh);
	}

	return $delimiter;
}

function normalizeDataSpreadsheet($file) {

	$extension = ucfirst($file->getClientOriginalExtension());
	$filePath = $file->path();

	if ($extension === 'Csv') {
		$fileHandler = utf8_fopen_read($filePath, 'r');

		$delimiter = detectDelimiter($fileHandler);

		$schdeules = [];

		while ($row = fgetcsv($fileHandler, 1048576, $delimiter, '"')) {
			$schdeules[] = array_map(function ($item) {
				$item = preg_replace('/\0/', '', $item);

				preg_match('/^"(.+)"$/', $item, $match);

				return isset($match[1]) ? $match[1] : $item;
			}, $row);
		}

		if ($last = array_pop($schdeules)) {
			if (count($last) === count($schdeules[0])) {
				$schdeules[] = $last;
			}
		}

		fclose($fileHandler);
	} else {
		try {
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($extension);
			$schdeules = $reader->load($filePath)->getActiveSheet()->toArray();
		} catch (\Throwable $th) {
			file_put_contents($filePath, preg_replace('/(<?xml version="1.0".+?>)/', '$1<?mso-application progid="Excel.Sheet"?>', file_get_contents($filePath)));
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml;
			$schdeules = $reader->load($filePath)->getActiveSheet()->toArray();
		}
	}

	$header = array_shift($schdeules);

	$result = [
		'header' => [],
		'rows' => [],
	];

	for ($i = 0, $ii = count($header); $i < $ii; $i++) {
		$item = trim($header[$i]);

		if (!empty($item)) {
			$result['header'][$i] = $item;
		}
	}

	for ($i = 0, $ii = count($schdeules); $i < $ii; $i++) {
		$row = $schdeules[$i];
		$columns = [];

		foreach ($result['header'] as $key => $column) {
			$columns[$key] = trim($row[$key]);
		}

		$result['rows'][] = $columns;
	}

	return $result;
}

function getShowListFields($options) {
	return (new \App\Model\ConfigAppModel())->getShowListFields($options['table'], $options['idUser']);
}

function getShowFormFields($options) {
	return (new \App\Model\ConfigAppModel())->getShowFormFields($options['table'], $options['idUser'], $options['fillable']);
}

function getConfigParameters($options) {
	return (new \App\Model\ParametersAppModel)->get($options['idUser']);
}

function toObject($data) {
	return json_decode(json_encode($data));
}

function getWeekday($val) {
	$weekdays = [
		'dom' => 'Dom.',
		'seg' => 'Seg.',
		'ter' => 'Ter.',
		'qua' => 'Qua.',
		'qui' => 'Qui.',
		'sex' => 'Sex.',
		'sab' => 'Sab.',
	];

	return isset($weekdays[$val]) ? $weekdays[$val]: '';
}

function generate_uuid() {
	return sprintf('%04x%04x-%04x%04x-%04x%04x-%04x%04x',
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff),
		mt_rand(0, 0xffffff)
	);
}

function asaas($options) {
	$curl = curl_init();

	$opt = [
		'CURLOPT_CUSTOMREQUEST' => 'GET',
		'CURLOPT_POSTFIELDS' => '',
	];

	if (isset($options['payload'])) {
		$opt['CURLOPT_CUSTOMREQUEST'] = 'POST';
		$opt['CURLOPT_POSTFIELDS'] = json_encode($options['payload']);
	}

	$company = SchoolInformationModel::first();

	$optArray = [
		CURLOPT_URL => $company->asaas_url . $options['path'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => $opt['CURLOPT_CUSTOMREQUEST'],
		CURLOPT_POSTFIELDS => $opt['CURLOPT_POSTFIELDS'],
		CURLOPT_HTTPHEADER => [
			'Accept: */*',
			'Content-Type: application/json',
			'Accept-Encoding: gzip, deflate',
			'Cache-Control: no-cache',
			'Connection: keep-alive',
			'access_token: ' . $company->asaas_token,
			'cache-control: no-cache'
		],
	];

	curl_setopt_array($curl, $optArray);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
		die($err);
	}

	return json_decode($response);
}

function numberByExtense($val, $currency = false) {
	if (is_null($val)) {
		return 'Informe um numeral.';
	} else if (!is_numeric($val) || $val <= 0) {
		return 'O numeral deve ser maior que zero.';
	}

	$singular = array('', '', 'mil', 'milhão', 'bilhão', 'trilhão', 'quatrilhão');
	$plural = array('', '', 'mil', 'milhões', 'bilhões', 'trilhões','quatrilhões');
	$c = array('', 'cem', 'duzentos', 'trezentos', 'quatrocentos','quinhentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos');
	$d = array('', 'dez', 'vinte', 'trinta', 'quarenta', 'cinquenta','sessenta', 'setenta', 'oitenta', 'noventa');
	$d10 = array('dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze','dezesseis', 'dezesete', 'dezoito', 'dezenove');
	$u = array('', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis','sete', 'oito', 'nove');

	if ($currency) {
		$singular[0] = 'centavo';
		$singular[1] = 'real';
		$plural[0] = 'centavos';
		$plural[1] = 'reais';
	}

	$z = 0;
	$val = number_format($val, 2, '.', '.');
	$inteiro = explode('.', $val);
	$count = count($inteiro);
	$rt = '';

	for ($i = 0; $i < $count; $i++) {
		for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++) {
			$inteiro[$i] = '0' . $inteiro[$i];
		}
	}

	$fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);

	for ($i = 0; $i < count($inteiro); $i++) {
		$val = $inteiro[$i];

		$rc = (($val > 100) && ($val < 200)) ? 'cento' : $c[$val[0]];

		$rd = ($val[1] < 2) ? '' : $d[$val[1]];

		$ru = ($val > 0) ? (($val[1] == 1) ? $d10[$val[2]] : $u[$val[2]]) : '';

		$r = $rc . (($rc && ($rd || $ru)) ? ' e ' : '') . $rd . (($rd && $ru) ? ' e ' : '') . $ru;

		$t = count($inteiro) - 1 - $i;

		$r .= $r ? ' ' . ($val > 1 ? $plural[$t] : $singular[$t]) : '';

		if ($val == '000') {
			$z++;
		} elseif ($z > 0) {
			$z--;
		}

		if (($t == 1) && ($z > 0) && ($inteiro[0] > 0)) {
			$r .= (($z > 1) ? ' de ' : ' ') . $plural[$t];
		}

		if ($r) {
			$rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ', ' : ' e ') : '') . $r;
		}
	}

	return($rt ? trim($rt) : 'zero');
}

function formatValue($val, $maskKey) {
  $val = preg_replace('/\D/', '', $val);

	$mapMask = [
		'zipCode' => ['/(\d{5})(\d{3})/', '$1-$2'],
		'cnpjCpf' => function($val) {
			return (strlen($val) === 11) ? ['/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4'] : ['/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5'];
		},
		'phone' => function($val) {
			switch (strlen($val)) {
				case 8: return [ '/(\d{4})(\d{4})/', '$1-$2' ];
				case 9: return [ '/(\d{1})(\d{4})(\d{4})/', '$1 $2-$3' ];
				case 10: return [ '/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3' ];
				case 11: return [ '/(\d{2})(\d{1})(\d{4})(\d{4})/', '($1) $2 $3-$4' ];
				default: return ['/(.+)/', '$1'];
			}
		},
	];

	$mask = is_callable($mapMask[$maskKey]) ? $mapMask[$maskKey]($val) : $mapMask[$maskKey];

	return preg_replace($mask[0], $mask[1], $val);
}

function firstLastName($val) {
	$arr = explode(' ', $val);

	return array_shift($arr) . ' ' . array_pop($arr);
}
