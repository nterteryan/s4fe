<?php

	function uuid() {
		return sprintf (
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}

	function tempId() {
		return '_tmp_' . uuid();
	}

	function getIp() {
		return Request::ip();
	}

	function getAgentName() {
		$browserName = Agent::browser();
		$version = explode('.', Agent::version($browserName));
		$browserVersion = $version[0];
		$browserPlatform = Agent::platform();

		return $browserName . ' ' . $browserVersion . ' ' . '(' . $browserPlatform . ')';
	}

	function getAgent() {
		return getIp() . ' ' . getAgentName();
	}

	function isEthAddress($address) {
		if (preg_match('/^0x[a-fA-F0-9]{40}$/',$address)) {
			return true;
		}
		return false;
	}

	function isChecksumEthAddress($address) {
		$address = str_replace('0x','',$address);
		$addressHash = hash('sha3',strtolower($address));
		$addressArray=str_split($address);
		$addressHashArray=str_split($addressHash);

		for($i = 0; $i < 40; $i++ ) {
			if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) || (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])) {
				return false;
			}
		}

		return true;
	}

	function calculateTransactionGas($gasUsed, $gasPrice) {
		return ((floatval($gasUsed) * floatval($gasPrice)) / pow(10, 18));
	}

	function wei2eth($wei) {
		return bcdiv($wei,'1000000000000000000',18);
	}

	function numberFormat($bigNum) {
		$explrestunits = "" ;

		$bigNum = explode('.', $bigNum);
		$num = $bigNum[0];

		if(strlen($num) > 3) {
			$lastthree = substr($num, strlen($num) - 3, strlen($num));
			$restunits = substr($num, 0, strlen($num) - 3);
			$restunits = (strlen($restunits) % 3 == 1) ? "00" . $restunits:$restunits;
			$expunit = str_split($restunits, 3);
			
			for($i=0; $i<sizeof($expunit); $i++) {
				if($i==0) {
					$explrestunits = (int)$expunit[$i]."'";
				} else {
					$explrestunits .= $expunit[$i]."'";
				}
			}

			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}

		if(isset($bigNum[1])) {
			return $thecash . '.' . $bigNum[1];
		}

		return $thecash;
	}

	function getConfig() {
		return Config::get('safe');
	}

	function getCurrentSale() {
		$config = getConfig();

		return $config['currentSale'];
	}

	function getSaleAddress($type) {
		$config = getConfig();
		$tokenAddresses = $config['tokenAddresses'];

		switch ($type) {
			case SaleType::$PRIVATE_ICO: return $tokenAddresses['privateIcoAddress'];
			case SaleType::$PRE_ICO: return $tokenAddresses['preIcoAddress'];
			case SaleType::$ICO: return $tokenAddresses['icoAddress'];
			default: return $tokenAddresses['defaultAddress'];
		}
	}

	function toDateTime($timestamp, $format = 'D, d M Y H:i:s') {
		return date($format, $timestamp);
	}