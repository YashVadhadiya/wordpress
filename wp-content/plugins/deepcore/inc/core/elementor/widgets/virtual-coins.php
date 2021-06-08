<?php
namespace Elementor;
class Webnus_Element_Widgets_Virtual_Coins extends \Elementor\Widget_Base {

	/**
	 * Retrieve Virtual_Coins widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'vitual_coins';
		
	}

	/**
	 * Retrieve Virtual_Coins widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Webnus Virtual_Coins', 'deep' );

	}

	/**
	 * Retrieve Virtual_Coins widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'eicon-alert';

	}

	/**
	 * Set widget category.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget category.
	 */
	public function get_categories() {

		return [ 'webnus' ];

	}

	/**
	 * widget styles.
	 *
	 * @since 4.2.0
	 * @access public
	 *
	 */
	public function get_style_depends() {

		return [ 'wn-deep-full-card' ];

	}

	/**
	 * Currency
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function wn_currency() {

		return array(

			'BTC' 	=> 'Bitcoin',
			'USD' 	=> 'US Dollar',
			'EUR' 	=> 'Eurozone Euro',
			'GBP' 	=> 'Pound Sterling' ,
			'JPY' 	=> 'Japanese Yen',
			'CAD' 	=> 'Canadian Dollar',
			'AUD' 	=> 'Australian Dollar',
			'CNY' 	=> 'Chinese Yuan',
			'CHF' 	=> 'Swiss Franc' ,
			'SEK' 	=> 'Swedish Krona',
			'NZD' 	=> 'New Zealand Dollar',
			'KRW' 	=> 'South Korean Won',
			'BCH' 	=> 'Bitcoin Cash',
			'AED' 	=> 'UAE Dirham',
			'AFN' 	=> 'Afghan Afghani',
			'ALL' 	=> 'Allion',
			'AMD' 	=> 'Armenian Dram',
			'ANG' 	=> 'Netherlands Antillean Guilder',
			'AOA' 	=> 'Angolan Kwanza',
			'ARS' 	=> 'Argentine Peso',
			'AWG' 	=> 'Aruban Florin',
			'AZN' 	=> 'Azerbaijani Manat',
			'BAM' 	=> 'Bosnia-Herzegovina Convertible Mark',
			'BBD' 	=> 'Barbadian Dollar',
			'BDT' 	=> 'Bangladeshi Taka',
			'BGN' 	=> 'Bulgarian Lev',
			'BHD' 	=> 'Bahraini Dinar',
			'BIF' 	=> 'Burundian Franc',
			'BMD' 	=> 'Bermudan Dollar',
			'BND' 	=> 'Brunei Dollar',
			'BOB' 	=> 'Bolivian Boliviano',
			'BRL' 	=> 'Brazilian Real',
			'BSD' 	=> 'BitSend',
			'BTN' 	=> 'Bhutanese Ngultrum',
			'BWP' 	=> 'Botswanan Pula',
			'BZD' 	=> 'Belize Dollar',
			'CDF' 	=> 'Congolese Franc',
			'CLF' 	=> 'Chilean Unit of Account (UF)',
			'CLP' 	=> 'Chilean Peso',
			'COP' 	=> 'Colombian Peso',
			'CRC' 	=> 'CrowdCoin',
			'CUP' 	=> 'Cuban Peso',
			'CVE' 	=> 'Cape Verdean Escudo',
			'CZK' 	=> 'Czech Koruna',
			'DJF' 	=> 'Djiboutian Franc',
			'DKK' 	=> 'Danish Krone',
			'DOP' 	=> 'Dominican Peso',
			'DZD' 	=> 'Algerian Dinar',
			'EGP' 	=> 'Egyptian Pound',
			'ETB' 	=> 'Ethiopian Birr',
			'FJD' 	=> 'Fijian Dollar',
			'FKP' 	=> 'Falkland Islands Pound',
			'GEL' 	=> 'Georgian Lari',
			'GHS' 	=> 'Ghanaian Cedi',
			'GIP' 	=> 'Gibraltar Pound',
			'GMD' 	=> 'Gambian Dalasi',
			'GNF' 	=> 'Guinean Franc',
			'GTQ' 	=> 'Guatemalan Quetzal',
			'GYD' 	=> 'Guyanaese Dollar',
			'HKD' 	=> 'Hong Kong Dollar',
			'HNL' 	=> 'Honduran Lempira',
			'HRK' 	=> 'Croatian Kuna',
			'HTG' 	=> 'Haitian Gourde',
			'HUF' 	=> 'Hungarian Forint',
			'IDR' 	=> 'Indonesian Rupiah',
			'ILS' 	=> 'Israeli Shekel',
			'INR' 	=> 'Indian Rupee',
			'IQD' 	=> 'Iraqi Dinar',
			'IRR' 	=> 'Iranian Rial',
			'ISK' 	=> 'Icelandic Króna',
			'JEP' 	=> 'Jersey Pound',
			'JMD' 	=> 'Jamaican Dollar',
			'JOD' 	=> 'Jordanian Dinar',
			'KES' 	=> 'Kenyan Shilling',
			'KGS' 	=> 'Kyrgystani Som',
			'KHR' 	=> 'Cambodian Riel',
			'KMF' 	=> 'Comorian Franc',
			'KPW' 	=> 'North Korean Won',
			'KWD' 	=> 'Kuwaiti Dinar',
			'KYD' 	=> 'Cayman Islands Dollar',
			'KZT' 	=> 'Kazakhstani Tenge',
			'LAK' 	=> 'Laotian Kip',
			'LBP' 	=> 'Lebanese Pound',
			'LKR' 	=> 'Sri Lankan Rupee',
			'LRD' 	=> 'Liberian Dollar',
			'LSL' 	=> 'Lesotho Loti',
			'LYD' 	=> 'Libyan Dinar',
			'MAD' 	=> 'SatoshiMadness',
			'MDL' 	=> 'Moldovan Leu',
			'MGA' 	=> 'Malagasy Ariary',
			'MKD' 	=> 'Macedonian Denar',
			'MMK' 	=> 'Myanma Kyat',
			'MNT' 	=> 'Mongolian Tugrik',
			'MOP' 	=> 'Macanese Pataca',
			'MRO' 	=> 'Mauritanian Ouguiya',
			'MUR' 	=> 'Mauritian Rupee',
			'MVR' 	=> 'Maldivian Rufiyaa',
			'MWK' 	=> 'Malawian Kwacha',
			'MXN' 	=> 'Mexican Peso',
			'MYR' 	=> 'Malaysian Ringgit',
			'MZN' 	=> 'Mozambican Metical',
			'NAD' 	=> 'Namibian Dollar',
			'NGN' 	=> 'Nigerian Naira',
			'NIO' 	=> 'Autonio',
			'NOK' 	=> 'Norwegian Krone',
			'NPR' 	=> 'Nepalese Rupee',
			'OMR' 	=> 'Omani Rial',
			'PAB' 	=> 'Panamanian Balboa',
			'PEN' 	=> 'Peruvian Nuevo Sol',
			'PGK' 	=> 'Papua New Guinean Kina',
			'PHP' 	=> 'Philippine Peso',
			'PKR' 	=> 'Pakistani Rupee',
			'PLN' 	=> 'Polish Zloty',
			'PYG' 	=> 'Paraguayan Guarani',
			'QAR' 	=> 'Qatari Rial',
			'RON' 	=> 'Romanian Leu',
			'RSD' 	=> 'Serbian Dinar',
			'RUB' 	=> 'Russian Ruble',
			'RWF' 	=> 'Rwandan Franc',
			'SAR' 	=> 'Saudi Riyal',
			'SBD' 	=> 'Steem Dollars',
			'SCR' 	=> 'Seychellois Rupee',
			'SDG' 	=> 'Sudanese Pound',
			'SGD' 	=> 'Singapore Dollar',
			'SHP' 	=> 'Saint Helena Pound',
			'SLL' 	=> 'Sierra Leonean Leone',
			'SOS' 	=> 'Somali Shilling',
			'SRD' 	=> 'Surinamese Dollar',
			'STD' 	=> 'São Tomé and Príncipe Dobra',
			'SVC' 	=> 'Salvadoran Colón',
			'SYP' 	=> 'Syrian Pound',
			'SZL' 	=> 'Swazi Lilangeni',
			'THB' 	=> 'Thai Baht',
			'TJS' 	=> 'Tajikistani Somoni',
			'TMT' 	=> 'Turkmenistani Manat',
			'TND' 	=> 'Tunisian Dinar',
			'TOP' 	=> 'TopCoin',
			'TRY' 	=> 'Turkish Lira',
			'TTD' 	=> 'Trinidad and Tobago Dollar',
			'TWD' 	=> 'New Taiwan Dollar',
			'TZS' 	=> 'Tanzanian Shilling',
			'UAH' 	=> 'Ukrainian Hryvnia',
			'UGX' 	=> 'Ugandan Shilling',
			'UYU' 	=> 'Uruguayan Peso',
			'UZS' 	=> 'Uzbekistan Som',
			'VEF' 	=> 'Venezuelan Bolívar Fuerte',
			'VND' 	=> 'Vietnamese Dong',
			'VUV' 	=> 'Vanuatu Vatu',
			'WST' 	=> 'Samoan Tala',
			'XAF' 	=> 'CFA Franc BEAC',
			'XCD' 	=> 'East Caribbean Dollar',
			'XOF' 	=> 'CFA Franc BCEAO',
			'XPF' 	=> 'CFP Franc',
			'YER' 	=> 'Yemeni Rial',
			'ZAR' 	=> 'South African Rand',
			'ZMW' 	=> 'Zambian Kwacha',
			'ZWL' 	=> 'Zimbabwean Dollar',
			'XAG' 	=> 'Silver (troy ounce)',
			'XAU' 	=> 'Xaucoin',
			'ETH' 	=> 'Ethereum',
			'XRP' 	=> 'Ripple',
			'LTC' 	=> 'Litecoin',
			'NEO' 	=> 'NEO',
			'ADA' 	=> 'Cardano',
			'XLM' 	=> 'Stellar',
			'EOS' 	=> 'EOS',
			'XMR' 	=> 'Monero',
			'MIOTA' => 'IOTA',
			'DASH' 	=> 'Dash',
			'XEM' 	=> 'NEM',
			'TRX' 	=> 'TRON',
			'ETC' 	=> 'Ethereum Classic',
			'USDT' 	=> 'Tether',
			'VEN' 	=> 'VeChain',
			'NANO' 	=> 'Nano',
			'LSK' 	=> 'Lisk',
			'QTUM' 	=> 'Qtum',
			'BTG' 	=> 'Bitgem',
			'OMG' 	=> 'OmiseGO',
			'ICX' 	=> 'ICON',
			'ZEC' 	=> 'Zcash',
			'DGD' 	=> 'DigixDAO',
			'BNB' 	=> 'Binance Coin',
			'STEEM' => 'Steem',
			'XVG' 	=> 'Verge',
			'STRAT' => 'Stratis',
			'BCN' 	=> 'Bytecoin',
			'PPT' 	=> 'Populous',
			'WAVES' => 'Waves',
			'SC' 	=> 'Siacoin',
			'RHOC' 	=> 'RChain',
			'MKR' 	=> 'Maker',
			'DOGE' 	=> 'Dogecoin',
			'BTS' 	=> 'BitShares',
			'SNT' 	=> 'Status',
			'DCR' 	=> 'Decred',
			'AE' 	=> 'Aeternity',
			'REP' 	=> 'Augur',
			'WTC' 	=> 'Waltonchain',
			'ZRX' 	=> '0x',
			'ETN' 	=> 'Electroneum',
			'KMD' 	=> 'Komodo',
			'VERI' 	=> 'Veritaseum',
			'ARK' 	=> 'Ark',
			'HSR' 	=> 'Hshare',
			'ARDR' 	=> 'Ardor',
			'BTM' 	=> 'Bitmark',
			'BAT' 	=> 'BatCoin',
			'ETHOS' => 'Ethos',
			'KCS' 	=> 'KuCoin Shares',
			'DRGN' 	=> 'Dragonchain',
			'SYS' 	=> 'Syscoin',
			'GAS' 	=> 'Gas',
			'CNX' 	=> 'Cryptonex',
			'GNT' 	=> 'Golem',
			'PIVX' 	=> 'PIVX',
			'DGB' 	=> 'DigiByte',
			'ZIL' 	=> 'Zilliqa',
			'MONA' 	=> 'MonaCoin',
			'ELF' 	=> 'aelf',
			'R' 	=> 'Revain',
			'AION' 	=> 'Aion',
			'FCT' 	=> 'Factom',
			'LRC' 	=> 'Loopring',
			'FUN' 	=> 'FunFair',
			'GBYTE' => 'Byteball Bytes',
			'NAS' 	=> 'Nebulas',
			'QASH' 	=> 'QASH',
			'PART' 	=> 'Particl',
			'RDD' 	=> 'ReddCoin',
			'KNC' 	=> 'KingN Coin',
			'GXS' 	=> 'GXShares',
			'IOST' 	=> 'IOStoken',
			'XZC' 	=> 'ZCoin',
			'SALT' 	=> 'SALT',
			'LINK' 	=> 'ChainLink',
			'POWR' 	=> 'Power Ledger',
			'DENT' 	=> 'Dent',
			'NEBL' 	=> 'Neblio',
			'DCN' 	=> 'Dentacoin',
			'ICN' 	=> 'iCoin',
			'KIN' 	=> 'Kin',
			'POLY' 	=> 'Polymath',
			'BNT' 	=> 'Bancor',
			'NXT' 	=> 'Nxt',
			'ENG' 	=> 'Enigma',
			'BTX' 	=> 'Bitcore',
			'CND' 	=> 'Cindicator',
			'PAY' 	=> 'TenX',
			'SMART' => 'SmartCash',
			'BLOCK' => 'Blocknet',
			'REQ' 	=> 'Request Network',
			'PLR' 	=> 'Pillar',
			'MAID' 	=> 'MaidSafeCoin',
			'VTC' 	=> 'Vertcoin',
			'AGI' 	=> 'SingularityNET',
			'GNO' 	=> 'Gnosis',
			'EMC' 	=> 'Emercoin',
			'NXS' 	=> 'Nexus',
			'WAX' 	=> 'WAX',
			'STORJ' => 'Storj',
			'BTCD' 	=> 'BitcoinDark',
			'GAME' 	=> 'GameCredits',
			'QSP' 	=> 'Quantstamp',
			'GVT' 	=> 'Genesis Vision',
			'ENJ' 	=> 'Enjin Coin',
			'UNITY' => 'SuperNET',
			'RDN' 	=> 'Raiden Network Token',
			'SAN' 	=> 'Santiment Network Token',
			'IGNIS' => 'Ignis',
			'ZEN' 	=> 'ZenCash',
			'THETA' => 'Theta Token',
			'CVC' 	=> 'Civic',
			'MCO' 	=> 'Monaco',
			'POE' 	=> 'Po.et',
			'SUB' 	=> 'Substratum',
			'XDN' 	=> 'DigitalNote',
			'NAV' 	=> 'NAV Coin',
			'SKY' 	=> 'Skycoin',
			'MANA' 	=> 'Decentraland',
			'STORM' => 'Storm',
			'ANT' 	=> 'Aragon',
			'TNB' 	=> 'Time New Bank',
			'MDS' 	=> 'MediShares',
			'RLC' 	=> 'iExec RLC',
			'HPB' 	=> 'High Performance Blockchain',
			'XPA' 	=> 'XPA',
			'ACT' 	=> 'Achain',
			'UBQ' 	=> 'Ubiq',
			'VEE' 	=> 'BLOCKv',
			'PURA' 	=> 'Pura',
			'DTR' 	=> 'Dynamic Trading Rights',
			'PPP' 	=> 'PayP', 
			'SPHTX' => 'Sophia', 
			'MTL' 	=> 'Metal',
			'MED' 	=> 'MediBloc',
			'LEND' 	=> 'ETHLend',
			'BCO' 	=> 'BridgeCoin',
			'RPX' 	=> 'Red Pulse',
			'XP' 	=> 'Experience Points',
			'ADX' 	=> 'AdEx',
			'PRL' 	=> 'Oyster',
			'XAS' 	=> 'Asch',
			'MNX' 	=> 'MinexCoin',
			'ITC' 	=> 'IoT Chain',
			'BLZ' 	=> 'BlazeCoin',
			'POA' 	=> 'POA Network',
			'TEL' 	=> 'Telcoin',
			'NULS' 	=> 'Nuls',
			'DEW' 	=> 'DEW',
			'VIBE' 	=> 'VIBE',
			'AMB' 	=> 'Ambrosus',
			'OST' 	=> 'Simple Token',
			'BAY' 	=> 'BitBay',
			'EDG' 	=> 'Edgeless',
			'C20' 	=> 'CRYPTO20', 
			'QRL' 	=> 'Quantum Resistant Ledger',
			'WPR' 	=> 'WePower',
			'PPC' 	=> 'Peercoin',
			'INK' 	=> 'Ink',
			'DTA' 	=> 'DATA',
			'SPANK' => 'SpankChain',
			'DBC' 	=> 'DeepBrain Chain',
			'BURST' => 'Burst',
			'BIX' 	=> 'Bibox Token',
			'MLN' 	=> 'Melon',
			'EDO' 	=> 'Eidoo',
			'SNM' 	=> 'SONM',
			'ION' 	=> 'ION',
			'WINGS' => 'Wings',
			'JNT' 	=> 'Jibrel Network',
			'WGR' 	=> 'Wagerr',
			'AST' 	=> 'AirSwap',
			'LBC' 	=> 'LBRY Credits',
			'SLS' 	=> 'SaluS',
			'RCN' 	=> 'Rcoin',
			'APPC' 	=> 'AppCoins',
			'AGRS' 	=> 'Agoras Tokens',
			'SNGLS' => 'SingularDTV',
			'CLOAK' => 'CloakCoin',
			'WABI' 	=> 'WaBi',
			'DATA' 	=> 'Streamr DATAcoin',
			'EMC2' 	=> 'Einsteinium',
			'XBY' 	=> 'XTRABYTES',
			'MGO' 	=> 'MobileGo',
			'GTO' 	=> 'Gifto',
			'COB' 	=> 'Cobinhood',
			'ETP' 	=> 'Metaverse ETP',
			'CMT' 	=> 'Comet',
			'INS' 	=> 'INS Ecosystem',
			'BRD' 	=> 'Bread',
			'SRN' 	=> 'SIRIN LABS Token',
			'FTC' 	=> 'Feathercoin',
			'HTML' 	=> 'HTMLCOIN',
			'VIA' 	=> 'Viacoin',
			'NLG' 	=> 'Gulden',
			'XCP' 	=> 'Counterparty',
			'MOBI' 	=> 'Mobius',
			'DNT' 	=> 'district0x',
			'ADT' 	=> 'adToken',
			'FUEL' 	=> 'Etherparty',
			'DPY' 	=> 'Delphy',
			'UTK' 	=> 'UTRUST',
			'TAAS' 	=> 'TaaS',
			'TRAC' 	=> 'OriginTrail',
			'CPC' 	=> 'Capricoin',
			'HST' 	=> 'Decision Token',
			'MOD' 	=> 'Modum',
			'NGC' 	=> 'NAGA',
			'RISE' 	=> 'Rise',
			'UKG' 	=> 'Unikoin Gold',
			'UCASH' => 'U.CASH',
			'BCPT' 	=> 'BlockMason Credit Protocol',
			'AEON' 	=> 'Aeon',
			'BTO' 	=> 'Bottos',
			'TNC' 	=> 'Trinity Network Credit',
			'CDT' 	=> 'CoinDash',
			'CRW' 	=> 'Crown',
			'GRS' 	=> 'Groestlcoin',
			'QLC' 	=> 'QLINK',
			'LUN' 	=> 'Lunyr',
			'CTR' 	=> 'Centra',
			'TNT' 	=> 'Tierion',
			'DCT' 	=> 'DECENT',
			'MTN' 	=> 'Medicalchain',
			'TRIG' 	=> 'Triggers',
			'VIB' 	=> 'Viberate',
			'STK' 	=> 'STK',
			'SHIFT' => 'Shift',
			'ECC' 	=> 'ECC',
			'SNC' 	=> 'SunContract',
			'SIB' 	=> 'SIBCoin',
			'SAFEX' => 'Safe Exchange Coin',
			'ATM' 	=> 'ATMChain',
			'SXDT' 	=> 'Spectre.ai Dividend Token',
			'HMQ' 	=> 'Humaniq',
			'NMC' 	=> 'Namecoin',
			'PEPECASH' => 'Pepe Cash',
			'IOC' => 'I/O Coin',
			'FLASH' => 'Flash',
			'NET' => 'NetCoin',
			'COSS' => 'COSS',
			'TKN' => 'TokenCard',
			'ART' => 'Maecenas',
			'CAPP' => 'Cappasity',
			'HVN' => 'Hive Project',
			'DAT' => 'Datum',
			'POT' => 'PotCoin',
			'EVX' => 'Everex',
			'CFI' => 'Cofound.it',                              
			'PRE' => 'Presearch',
			'BITCNY' => 'bitCNY',
			'IDH' => 'indaHash',
			'DMD' => 'Diamond',
			'LKK' => 'Lykke',
			'COLX' => 'ColossusCoinXT',
			'ZCL' => 'ZClassic',
			'BPT' => 'Blockport',
			'OCN' => 'Odyssey',
			'ONION' => 'DeepOnion',
			'VRC' => 'VeriCoin',
			'DIME' => 'Dimecoin',
			'BITB' => 'Bean Cash',
			'MER' => 'Mercury',
			'XWC' => 'WhiteCoin',
			'SOC' => 'All Sports',
			'UNO' => 'Unobtanium',
			'SOAR' => 'Soarcoin',
			'FAIR' => 'FairGame',
			'BLK' => 'BlackCoin',                               
			'VOX' => 'Voxels',
			'TRST' => 'WeTrust',
			'SWM' => 'Swarm',
			'AMP' => 'Synereo',
			'DADI' => 'DADI',
			'TAU' => 'Lamden',
			'NLC2' => 'NoLimitCoin',
			'INT' => 'Internet Node Token',
			'MINT' => 'Mintcoin',
			'MTH' => 'Monetha',
			'YOYOW' => 'YOYOW',
			'GUP' => 'Matchpool',
			'ZSC' => 'Zeusshield',
			'NMR' => 'Numeraire',
			'XEL' => 'Elastic',
			'ARN' => 'Aeron',
			'1ST' => 'FirstBlood',
			'TSL' => 'Energo',
			'TIX' => 'Blocktix',
			'SWFTC' => 'SwftCoin',
			'DLT' => 'Agrello',
			'MSP' => 'Mothership',
			'BLT' => 'Bloom',
			'LEO' => 'LEOcoin',
			'ZPT' => 'Zeepin',
			'BCC' => 'BitConnect',
			'EXP' => 'Expanse',
			'AURA' => 'Aurora DAO',
			'THC' => 'HempCoin',
			'CHSB' => 'SwissBorg',
			'GRID' => 'Grid+',
			'MOON' => 'Mooncoin',
			'GTC' => 'Global Tour Coin',
			'PASC' => 'Pascal Coin',
			'QBT' => 'Cubits',
			'TIO' => 'Trade Token',
			'GRC' => 'GridCoin',
			'QUN' => 'QunQun',
			'OMNI' => 'Omni',
			'DNA' => 'EncrypGen',
			'KEY' => 'Selfkey',
			'UQC' => 'Uquid Coin',
			'ZOI' => 'Zoin',
			'ECA' => 'Electra',
			'ALQO' => 'ALQO',
			'MDA' => 'Moeda Loyalty Points',
			'MOT' => 'Olympus Labs',
			'COV' => 'Covesting',
			'ORME' => 'Ormeus Coin',
			'OK' => 'OKCash',
			'CV' => 'carVertical',
			'CAN' => 'Content and AD Network',
			'XTO' => 'Tao',
			'OAX' => 'OAX',
			'KICK' => 'KickCoin',
			'CAT' => 'Catcoin',
			'LA' => 'LATOKEN',
			'RADS' => 'Radium',
			'DTB' => 'Databits',
			'WCT' => 'Waves Community Token',
			'BMC' => 'Blackmoon',
			'POSW' => 'PoSW Coin',
			'MUE' => 'MonetaryUnit',
			'SLR' => 'SolarCoin',
			'PRO' => 'Propy',
			'IPL' => 'InsurePal',
			'PHR' => 'Phore',
			'DAI' => 'Dai',
			'AIR' => 'AirToken',
			'XPM' => 'Primecoin',
			'EDR' => 'E-Dinar Coin',
			'HAC' => 'Hackspace Capital',
			'EVR' => 'Everus',
			'DRT' => 'DomRaider',
			'DIVX' => 'Divi',
			'TIPS' => 'FedoraCoin',
			'NEU' => 'Neumark',
			'RBY' => 'Rubycoin',
			'XSH' => 'SHIELD',
			'ALIS' => 'ALIS',
			'SWT' => 'Swarm City',
			'NYC' => 'NewYorkCoin',
			'BDG' => 'BitDegree',
			'TIME' => 'Chronobank',
			'MUSIC' => 'Musicoin',
			'UNIT' => 'Universal Currency',
			'IXT' => 'iXledger',
			'RVT' => 'Rivetz',
			'NXC' => 'Nexium',
			'XMY' => 'Myriad',
			'ENRG' => 'Energycoin',
			'GOLOS' => 'Golos',
			'AUR' => 'Auroracoin',
			'LMC' => 'LoMoCoin',
			'XSPEC' => 'Spectrecoin',
			'DBET' => 'DecentBet',
			'HBT' => 'Hubii Network',
			'ICOS' => 'ICOS',
			'TOA' => 'ToaCoin',
			'NEOS' => 'NeosCoin',
			'TGT' => 'Target Coin',
			'HKN' => 'Hacken',
			'BOT' => 'Bodhi',
			'PPY' => 'Peerplays',
			'OTN' => 'Open Trading Network',
			'ATB' => 'ATBCoin',
			'PUT' => 'PutinCoin',
			'CLAM' => 'Clams',
			'FLO' => 'FlorinCoin',
			'PST' => 'Primas',
			'IFT' => 'InvestFeed',
			'PRG' => 'Paragon',
			'CSNO' => 'BitDice',
			'NTRN' => 'Neutron',
			'BBR' => 'Boolberry',
			'DICE' => 'Etheroll',
			'STX' => 'Stox',
			'SYNX' => 'Syndicate',
			'GET' => 'GET Protocol',
			'PLBT' => 'Polybius',
			'GAM' => 'Gambit',
			'TIE' => 'Ties.DB',
			'PRA' => 'ProChain',
			'SNOV' => 'Snovio',
			'QAU' => 'Quantum',
			'GCR' => 'Global Currency Reserve',
			'INCNT' => 'Incent',
			'BIS' => 'Bismuth',
			'BITUSD' => 'bitUSD',
			'RNT' => 'OneRoot Network',
			'HDG' => 'Hedge',
			'DBIX' => 'DubaiCoin',
			'WRC' => 'Worldcore',
			'PTOY' => 'Patientory',
			'XUC' => 'Exchange Union',
			'PARETO' => 'Pareto Network',
			'DYN' => 'Dynamic',
			'XLR' => 'Solaris',
			'PZM' => 'PRIZM',
			'LUX' => 'LUXCoin',
			'OCT' => 'OracleChain',
			'EAC' => 'EarthCoin',
			'ESP' => 'Espers',
			'BQ' => 'bitqy',
			'PND' => 'Pandacoin',
			'ECN' => 'E-coin',
			'COVAL' => 'Circuits of Value',
			'XAUR' => 'Xaurum',
			'FLDC' => 'FoldingCoin',
			'HOT' => 'Hydro Protocol',
			'TX' => 'TransferCoin',
			'AXP' => 'aXpire',
			'NVST' => 'NVO',
			'CHIPS' => 'CHIPS',                             
			'PLU' => 'Pluton',
			'BNTY' => 'Bounty0x',
			'COFI' => 'CoinFi',
			'MYST' => 'Mysterium',
			'CXO' => 'CargoX',
			'BLUE' => 'BLUE',
			'PINK' => 'PinkCoin',
			'B2B' => 'B2BX',
			'LOC' => 'LockChain',
			'DRP' => 'DCORP',
			'LEV' => 'Leverj',
			'KORE' => 'Kore',
			'TCC' => 'The ChampCoin',
			'MEE' => 'CoinMeet',
			'RMC' => 'Remicoin',
			'CVCOIN' => 'CVCoin',
			'MYB' => 'MyBit Token',
			'IOP' => 'Internet of People',
			'HORSE' => 'Ethorse',
			'OXY' => 'Oxycoin',
			'CURE' => 'Curecoin',
			'MDT' => 'Measurable Data Token',
			'PFR' => 'Payfair',
			'AVT' => 'Aventus',
			'PKT' => 'Playkey',
			'POLIS' => 'Polis'  , 
			'SPF' => 'SportyCo',
			'REBL' => 'Rebellious',
			'LINDA' => 'Linda',
			'BCY' => 'Bitcrystals',
			'BTCZ' => 'BitcoinZ',
			'XST' => 'Stealthcoin',
			'GBX' => 'GoByte',
			'OBITS' => 'OBITS',
			'USNBT' => 'NuBits',
			'SPHR' => 'Sphere',
			'CREDO' => 'Credo',
			'SXUT' => 'Spectre.ai Utility Token',
			'POLL' => 'ClearPoll',
			'NVC' => 'Novacoin',
			'LOCI' => 'LOCIcoin',
			'FLIXX' => 'Flixxo',
			'ELIX' => 'Elixir',
			'PIRL' => 'Pirl',
			'EVE' => 'Devery',
			'SEQ' => 'Sequence',
			'KRM' => 'Karma',
			'ABY' => 'ArtByte',
			'XVC' => 'Vcash',
			'VOISE' => 'Voise',
			'ZLA' => 'Zilla',
			'ATMS' => 'Atmos',
			'AID' => 'AidCoin',
			'AIT' => 'AICHAIN',
			'BRX' => 'Breakout Stake',
			'HEAT' => 'HEAT',
			'HYP' => 'HyperStake',
			'ERO' => 'Eroscoin',
			'RMT' => 'SureRemit',
			'ARY' => 'Block Array',
			'DOPE' => 'DopeCoin',
			'CAG' => 'Change',
			'GAT' => 'Gatcoin',
			'EBTC' => 'eBitcoin',
			'HGT' => 'HelloGold',
			'QWARK' => 'Qwark',
			'VTR' => 'vTorrent',
			'SNRG' => 'Synergy',
			'ERC' => 'EuropeCoin',
			'ZEIT' => 'Zeitcoin',
			'MEME' => 'Memetic / PepeCoin',
			'PLAY' => 'HEROcoin',
			'EKO' => 'EchoLink',
			'SUMO' => 'Sumokoin',
			'RC' => 'RussiaCoin',
			'BUN' => 'BunnyCoin',
			'VRM' => 'VeriumReserve',
			'DNR' => 'Denarius',
			'PIX' => 'Lampix',
			'EMV' => 'Ethereum Movie Venture',
			'1337' => 'Elite',
			'TFL' => 'TrueFlip',
			'PTC' => 'Pesetacoin',
			'XBC' => 'Bitcoin Plus',
			'TRF' => 'Travelflex',
			'GLD' => 'GoldCoin',
			'SSS' => 'Sharechain',
			'ING' => 'Iungo',
			'AIX' => 'Aigang',
			'GCN' => 'GCN Coin',
			'ZRC' => 'ZrCoin',
			'HUSH' => 'Hush',
			'GMT' => 'Mercury Protocol',
			'APX' => 'APX',
			'ADB' => 'adbank',
			'VIU' => 'Viuly',
			'BRK' => 'Breakout',
			'DOT' => 'Dotcoin',
			'MONK' => 'Monkey Project',
			'UFO' => 'Uniform Fiscal Object',
			'PBL' => 'Publica',
			'SCL' => 'Sociall',
			'BWK' => 'Bulwark',
			'2GIVE' => '2GIVE',
			'CRB' => 'Creditbit',
			'ADST' => 'AdShares',
			'FRD' => 'Farad',
			'XMCC' => 'Monoeci',
			'BET' => 'BetaCoin',
			'BPL' => 'Blockpool',
			'EXCL' => 'ExclusiveCoin',
			'DOVU' => 'Dovu',
			'SPRTS' => 'Sprouts',
			'BASH' => 'LuckChain',
			'CRED' => 'Verify',
			'OPT' => 'Opus',
			'FLIK' => 'FLiK',
			'BELA' => 'Bela',
			'MCAP' => 'MCAP',
			'WISH' => 'MyWish',
			'BLITZ' => 'Blitzcash',
			'YOC' => 'Yocoin',
			'DGPT' => 'DigiPulse',
			'GJC' => 'Global Jobcoin',
			'INXT' => 'Internxt',
			'TKS' => 'Tokes',
			'CREA' => 'Creativecoin',
			'PBT' => 'Primalbase Token',
			'MZC' => 'MAZA',
			'ADC' => 'AudioCoin',
			'NOTE' => 'DNotes',
			'BON' => 'Bonpay',
			'BTDX' => 'Bitcloud',
			'RIC' => 'Riecoin',
			'ALT' => 'Altcoin',
			'CANN' => 'CannabisCoin',
			'PDC' => 'Project Decorum',
			'WILD' => 'Wild Crypto',
			'MTNC' => 'Masternodecoin',
			'TES' => 'TeslaCoin',
			'XGOX' => 'XGOX',
			'HUC' => 'HunterCoin',
			'HAT' => 'Hawala.Today',
			'MNTP' => 'GoldMint',
			'EVC' => 'EventChain',
			'VSX' => 'Vsync',
			'ODN' => 'Obsidian',
			'REX' => 'REX',
			'KRB' => 'Karbo',
			'TRUST' => 'TrustPlus',
			'TZC' => 'TrezarCoin',
			'ZER' => 'Zero',
			'EGC' => 'EverGreenCoin',
			'SPR' => 'SpreadCoin',
			'TRCT' => 'Tracto',
			'NSR' => 'NuShares',
			'LIFE' => 'LIFE',
			'SEND' => 'Social Send',
			'SWIFT' => 'Bitswift',
			'ATL' => 'ATLANT',
			'HWC' => 'HollyWoodCoin',
			'PRIX' => 'Privatix',
			'ZNY' => 'Bitzeny',
			'VSL' => 'vSlice',
			'AHT' => 'Bowhead',
			'UFR' => 'Upfiring',
			'GOOD' => 'Goodomy',
			'FYP' => 'FlypMe',
			'SXC' => 'Sexcoin',
			'CL' => 'Coinlancer',
			'CHC' => 'ChainCoin',
			'EFL' => 'e-Gulden',
			'TRC' => 'Terracoin',
			'BUZZ' => 'BuzzCoin',
			'START' => 'Startcoin',
			'QVT' => 'Qvolta',
			'XMG' => 'Magi',
			'EFYT' => 'Ergo',
			'REC' => 'Regalcoin',
			'BLU' => 'BlueCoin',
			'WTT' => 'Giga Watt Token',
			'ZEPH' => 'Zephyr',
			'QRK' => 'Quark',
			'ELLA' => 'Ellaism',
			'IND' => 'Indorse Token',
			'MBRS' => 'Embers',
			'MRJA' => 'GanjaCoin',
			'INN' => 'Innova',
			'DFT' => 'DraftCoin',
			'AMM' => 'MicroMoney',
			'SMS' => 'Speed Mining Service',
			'IC' => 'Ignition',
			'PKB' => 'ParkByte',
			'MAG' => 'Maggie',
			'DAR' => 'Darcrus',
			'ITNS' => 'IntenseCoin',
			'RAIN' => 'Condensate',
			'RUP' => 'Rupee',
			'JC' => 'Jesus Coin',
			'STU' => 'bitJob',
			'LDOGE' => 'LiteDoge',
			'SLT' => 'Smartlands',
			'EBST' => 'eBoost',
			'HOLD' => 'Interstellar Holdings',
			'CMPCO' => 'CampusCoin',
			'OCL' => 'Oceanlab',
			'PIPL' => 'PiplCoin',
			'CBX' => 'Crypto Bullion',
			'SMLY' => 'SmileyCoin',
			'NKA' => 'IncaKoin',
			'STAK' => 'STRAKS',
			'PROC' => 'ProCurrency',
			'FOR' => 'FORCE',
			'ETBS' => 'Ethbits',
			'ONG' => 'onG.social',
			'LCT' => 'LendConnect',
			'GRE' => 'Greencoin',
			'GCC' => 'GuccioneCoin',
			'DAY' => 'Chronologic',
			'ADZ' => 'Adzcoin',
			'BDL' => 'Bitdeal',
			'HXX' => 'Hexx',
			'MAGE' => 'MagicCoin',
			'EQT' => 'EquiTrader',
			'PYLNT' => 'Pylon Network',
			'ACC' => 'ACChain',
			'ELTCOIN' => 'ELTCOIN',
			'AI' => 'POLY AI',
			'PING' => 'CryptoPing',
			'UNB' => 'UnbreakableCoin',
			'FYN' => 'FundYourselfNow',
			'LINX' => 'Linx',
			'OPC' => 'OP Coin',
			'DP' => 'DigitalPrice',
			'ORB' => 'Orbitcoin',
			'UNIFY' => 'Unify',
			'PLC' => 'Polcoin',
			'42' => '42-coin',
			'XFT' => 'Footy Cash',
			'BYC' => 'Bytecent',
			'Miners MRT' => ' Reward Token',
			'SKIN' => 'SkinCoin',
			'IFLT' => 'InflationCoin',
			'CRM' => 'Cream',
			'RNS' => 'Renos',
			'NOBL' => 'NobleCoin',
			'KEK' => 'KekCoin',
			'PHO' => 'Photon',
			'GRWI' => 'Growers International',
			'UNY' => 'Unity Ingot',
			'ARCT' => 'ArbitrageCT',
			'CDN' => 'Canada eCoin',
			'PURE' => 'Pure',
			'FST' => 'Fastcoin',
			'UNI' => 'Universe',
			'DCY' => 'Dinastycoin',
			'MOIN' => 'Moin',
			'SHORTY' => 'Shorty',
			'LGD' => 'Legends Room',
			'ARC' => 'ArcticCoin',
			'ZENI' => 'Zennies',
			'FJC' => 'FujiCoin',
			'LOG' => 'Woodcoin',
			'UIS' => 'Unitus',
			'INSN' => 'InsaneCoin',
			'RIYA' => 'Etheriya',
			'XPD' => 'PetroDollar',
			'BTA' => 'Bata',
			'ICOO' => 'ICO OpenLedger',
			'ZET' => 'Zetacoin',
			'EPY' => 'Emphy',
			'KLC' => 'KiloCoin',
			'POP' => 'PopularCoin',
			'ABJ' => 'Abjcoin',
			'VIVO' => 'VIVO',
			'HODL' => 'HOdlcoin',
			'BRO' => 'Bitradio',
			'XLC' => 'LeviarCoin',
			'ERA' => 'ERA',
			'BTB' => 'BitBar',
			'MAC' => 'Machinecoin',
			'ITT' => 'Intelligent Trading Tech',
			'SKC' => 'Skeincoin',
			'KLN' => 'Kolion',
			'PIGGY' => 'Piggycoin',
			'BBP' => 'BiblePay',
			'JET' => 'Jetcoin',
			'XCPO' => 'Copico',
			'GUN' => 'Guncoin',
			'RLT' => 'RouletteToken',
			'CNT' => 'Centurion',
			'ECASH' => 'Ethereum Cash',
			'KBR' => 'Kubera Coin',
			'SUR' => 'Suretly',
			'CCRB' => 'CryptoCarbon',
			'BTCS' => 'Bitcoin Scrypt',
			'DGC' => 'Digitalcoin',
			'RUPX' => 'Rupaya [OLD]',
			'SCT' => 'Soma',
			'MBI' => 'Monster Byte',
			'WAND' => 'WandX',
			'CUBE' => 'DigiCube',
			'Q2C' => 'QubitCoin',
			'EL' => 'Elcoin',
			'SCORE' => 'Scorecoin',
			'MEC' => 'Megacoin',
			'ACE' => 'Ace',
			'BRIT' => 'BritCoin',
			'FUCK' => 'FuckToken',
			'GRIM' => 'Grimcoin',
			'ATS' => 'Authorship',
			'SMC' => 'SmartCoin',
			'DEM' => 'Deutsche eMark',
			'WHL' => 'WhaleCoin',
			'SGR' => 'Sugar Exchange',
			'CJ' => 'Cryptojacks',
			'TTC' => 'TittieCoin',
			'EQL' => 'Equal',
			'ELE' => 'Elementrem',
			'HPC' => 'Happycoin',
			'LANA' => 'LanaCoin',
			'FRST' => 'FirstCoin',
			'HERO' => 'Sovereign Hero',
			'DFS' => 'DFSCoin',
			'INFX' => 'Influxcoin',
			'TRI' => 'Triangles',
			'GLS' => 'GlassCoin',
			'ERC20' => 'ERC20',
			'BTWTY' => 'Bit20',
			'KURT' => 'Kurrent',
			'MNE' => 'Minereum',
			'WGO' => 'WavesGo',
			'BXT' => 'BitTokens',
			'NYAN' => 'Nyancoin',
			'XBL' => 'Billionaire Token',
			'NETKO' => 'Netko',
			'MOJO' => 'MojoCoin',
			'RKC' => 'Royal Kingdom Coin',
			'TRUMP' => 'TrumpCoin',
			'RBT' => 'Rimbit',
			'CTX' => 'CarTaxi Token',
			'BTCRED' => 'Bitcoin Red',
			'AMMO' => 'Ammo Reloaded',
			'AMS' => 'AmsterdamCoin',
			'TIT' => 'Titcoin',
			'SRC' => 'SecureCoin',
			'TRK' => 'Truckcoin',
			'DRXNE' => 'DROXNE',
			'PAK' => 'Pakcoin',
			'XCN' => 'Cryptonite',
			'ETG' => 'Ethereum Gold',
			'STN' => 'Steneum Coin',
			'ENT' => 'ENTCash',
			'GAP' => 'Gapcoin',
			'PXC' => 'Phoenixcoin',
			'OTX' => 'Octanox',
			'IETH' => 'iEthereum',
			'PCOIN' => 'Pioneer Coin',
			'TKR' => 'CryptoInsight',
			'MOTO' => 'Motocoin',
			'XJO' => 'Joulecoin',
			'BUCKS' => 'SwagBucks',
			'HBC' => 'HomeBlockCoin',
			'BITBTC' => 'bitBTC',
			'DAXX' => 'DaxxCoin',
			'MARS' => 'Marscoin',
			'EBCH' => 'eBitcoinCash',
			'XHI' => 'HiCoin',
			'DSR' => 'Desire',
			'VISIO' => 'Visio',
			'GRLC' => 'Garlicoin',
			'LCP' => 'Litecoin Plus',
			'TAG' => 'TagCoin',
			'XCXT' => 'CoinonatX',
			'TOKC' => 'TOKYO',
			'CYP' => 'Cypher',
			'PR' => 'Prototanium',
			'808' => '808Coin',
			'NEWB' => 'Newbium',
			'NTO' => 'Fujinto',
			'BITSILVER' => 'bitSilver',
			'AIB' => 'Advanced Internet Blocks',
			'ZZC' => 'ZoZoCoin',
			'CFD' => 'Confido',
			'CCT' => 'Crystal Clear ',
			'CHAN' => 'ChanCoin',
			'HNC' => 'Huncoin',
			'POST' => 'PostCoin',
			'BOLI' => 'Bolivarcoin',
			'ROOFS' => 'Roofs',
			'MCRN' => 'MACRON',
			'CCN' => 'CannaCoin',
			'ATOM' => 'Atomic Coin',
			'ETHD' => 'Ethereum Dark',
			'MAO' => 'Mao Zedong',
			'ECO' => 'EcoCoin',
			'BIP' => 'BipCoin',
			'SHDW' => 'Shadow Token',
			'PASL' => 'Pascal Lite',
			'KAYI' => 'Kayicoin',
			'SAGA' => 'SagaCoin',
			'LEA' => 'LeaCoin',
			'ONX' => 'Onix',
			'XCT' => 'C-Bit',
			'RED' => 'RedCoin',
			'BERN' => 'BERNcash',
			'LTB' => 'LiteBar',
			'HONEY' => 'Honey',
			'DLC' => 'Dollarcoin',
			'SPACE' => 'SpaceCoin',
			'COAL' => 'BitCoal',
			'EOT' => 'EOT Token',
			'QBC' => 'Quebecoin',
			'SOON' => 'SoonCoin',
			'BSTY' => 'GlobalBoost-Y',
			'GLT' => 'GlobalToken',
			'BCF' => 'Bitcoin Fast',
			'DALC' => 'Dalecoin',
			'SDRN' => 'Senderon',
			'BRAT' => 'BROTHER',
			'VOT' => 'VoteCoin',
			'VLT' => 'Veltor',
			'QBIC' => 'Qbic',
			'611' => 'SixEleven',
			'LBTC' => 'Lightning Bitcoin [Futures]',
			'POS' => 'PoSToken',
			'EAGLE' => 'EagleCoin',
			'ASAFE2' => 'AllSafe',
			'CASH' => 'Cashcoin',
			'CACH' => 'CacheCoin',
			'REE' => 'ReeCoin',
			'SCS' => 'Speedcash',
			'LUNA' => 'Luna Coin',
			'YTN' => 'YENTEN',
			'FNC' => 'FinCoin',
			'ICOB' => 'ICOBID',
			'GPL' => 'Gold Pressed Latinum',
			'CNNC' => 'Cannation',
			'DIX' => 'Dix Asset',
			'MDC' => 'Madcoin',
			'SPT' => 'Spots',
			'GPU' => 'GPU Coin',
			'XCO' => 'X-Coin',
			'ZCG' => 'Zlancer',
			'HMP' => 'HempCoin',
			'GP' => 'GoldPieces',
			'JS' => 'JavaScript Token',
			'ERY' => 'Eryllium',
			'KRONE' => 'Kronecoin',
			'BENJI' => 'BenjiRolls',
			'FUZZ' => 'FuzzBalls',
			'NRO' => 'Neuro',
			'MSCN' => 'Master Swiscoin',
			'LTCU' => 'LiteCoin Ultra',
			'WOMEN' => 'WomenCoin',
			'ALTCOM' => 'SONO',
			'VPRC' => 'VapersCoin',
			'SANDG' => 'Save and Gain',
			'WBB' => 'Wild Beast Block',
			'QCN' => 'QuazarCoin',
			'WORM' => 'HealthyWormCoin',
			'ICON' => 'Iconic',
			'ACP' => 'AnarchistsPrime',
			'GEERT' => 'GeertCoin',
			'XRC' => 'Rawcoin',
			'RSGP' => 'RSGPcoin',
			'VOLT' => 'Bitvolt',
			'GBC' => 'GBCGoldCoin',
			'VRS' => 'Veros',
			'COUPE' => 'Coupecoin',
			'CREVA' => 'CrevaCoin',
			'PRC' => 'PRCoin',
			'AERM' => 'Aerium',
			'VLTC' => 'Vault Coin',
			'NANOX' => 'Project-X',
			'EXRN' => 'EXRNchain',
			'CALC' => 'CaliphCoin',                             
			'HMC' => 'Hi Mutual Society',
			'DIBC' => 'DIBCOIN',
			'DMB' => 'Digital Money Bits',
			'PAC' => 'PACcoin',
			'XRL' => 'Rialto',
			'ECOB' => 'Ecobit',
			'XNN' => 'Xenon',
			'PGL' => 'Prospectors Gold',
			'STAR' => 'Starbase',
			'AC' => 'AsiaCoin',
			'CPAY' => 'Cryptopay',
			'VTA' => 'Virtacoin',
			'BBT' => 'BitBoost',
			'REAL' => 'REAL',
			'STA' => 'Starta',
			'ETT' => 'EncryptoTel [ETH]',
			'IXC' => 'Ixcoin',
			'YASH' => 'YashCoin',
			'MXT' => 'MarteXcoin',
			'ANC' => 'Anoncoin',
			'CARBON' => 'Carboncoin',
			'FIMK' => 'FIMKrypto',
			'V' => 'Version',
			'LEAF' => 'LeafCoin',
			'AU' => 'AurumCoin',
			'STRC' => 'StarCredits',
			'BPC' => 'Bitpark Coin',
			'SDC' => 'ShadowCash',
			'FLT' => 'FlutterCoin',
			'WDC' => 'WorldCoin',
			'INPAY' => 'InPay',
			'I0C' => 'I0Coin',
			'METAL' => 'MetalCoin',
			'CDX' => 'Commodity Ad Network',
			'MAX' => 'MaxCoin',
			'NDC' => 'NEVERDIE',
			'FCN' => 'Fantomcoin',
			'XPTX' => 'PlatinumBAR',
			'HTC' => 'HitCoin',
			'EBET' => 'EthBet',
			'ARI' => 'Aricoin',
			'TROLL' => 'Trollcoin',
			'ITI' => 'iTicoin',
			'KOBO' => 'Kobocoin',
			'RUSTBITS' => 'Rustbits',
			'LNK' => 'Link Platform',
			'HBN' => 'HoboNickels',
			'DTC' => 'Datacoin',
			'UNIC' => 'UniCoin',
			'USC' => 'Ultimate Secure Cash',
			'BITS' => 'Bitstar',
			'CFT' => 'CryptoForecast',
			'BTCR' => 'Bitcurrency',
			'FC2' => 'FuelCoin',
			'OPAL' => 'Opal',
			'HAL' => 'Halcyon',
			'TALK' => 'BTCtalkcoin',
			'UTC' => 'UltraCoin',
			'GAIA' => 'GAIA',
			'XPY' => 'PayCoin',
			'ARG' => 'Argentum',
			'WAY' => 'WayGuide',
			'XGR' => 'GoldReserve',
			'VAL' => 'Valorbit',
			'VIDZ' => 'PureVidz',
			'SIGT' => 'Signatum',
			'FLY' => 'Flycoin',
			'MANNA' => 'Manna',
			'MNM' => 'Mineum',
			'GB' => 'GoldBlocks',
			'TGC' => 'Tigercoin',
			'BLC' => 'Blakecoin',
			'DDF' => 'DigitalDevelopersFund',
			'SAC' => 'SACoin',
			'8BIT' => '8Bit',
			'SLG' => 'Sterlingcoin',
			'TSE' => 'Tattoocoin (Standard Edition)',
			'BLOCKPAY' => 'BlockPay',
			'CV2' => 'Colossuscoin V2',
			'SUPER' => 'SuperCoin',
			'C2' => 'Coin2.1',
			'ARCO' => 'AquariusCoin',
			'CHESS' => 'ChessCoin',
			'CNO' => 'Coin(O)',
			'VUC' => 'Virta Unique Coin',
			'KUSH' => 'KushCoin',
			'GLC' => 'GlobalCoin',
			'CRX' => 'Chronos',
			'FUNC' => 'FUNCoin',
			'BITZ' => 'Bitz',
			'BIGUP' => 'BigUp',
			'EMD' => 'Emerald Crypto',
			'SWING' => 'Swing',
			'CCO' => 'Ccore',                               
			'888' => 'OctoCoin',
			'PX' => 'PX',
			'DSH' => 'Dashcoin',
			'EVIL' => 'Evil Coin',
			'XVP' => 'Virtacoinplus',
			'RBIES' => 'Rubies',
			'XRA' => 'Ratecoin',
			'VC' => 'VirtualCoin',
			'PXI' => 'Prime-XI',
			'AMBER' => 'AmberCoin',
			'J' => 'Joincoin',
			'FRC' => 'Freicoin',
			'XRE' => 'RevolverCoin',
			'STV' => 'Sativacoin',
			'PHS' => 'Philosopher Stones',
			'BITGOLD' => 'bitGold',
			'NEVA' => 'NevaCoin',
			'TEK' => 'TEKcoin',
			'B@' => 'Bankcoin',
			'IMS' => 'Independent Money System',
			'SPEX' => 'SproutsExtreme',
			'XIOS' => 'Xios',
			'BUMBA' => 'BumbaCoin',
			'UNITS' => 'GameUnits',
			'JIN' => 'Jin Coin',
			'EUC' => 'Eurocoin',
			'SCRT' => 'SecretCoin',
			'ISL' => 'IslaCoin',
			'DUO' => 'ParallelCoin',
			'NUKO' => 'Nekonium',
			'QTL' => 'Quatloo',
			'BOST' => 'BoostCoin',
			'YAC' => 'Yacoin',
			'RPC' => 'RonPaulCoin',
			'STARS' => 'StarCash Network',
			'MST' => 'MustangCoin',
			'BRIA' => 'BriaCoin',
			'XBTS' => 'Beatcoin',
			'KED' => 'Darsek',
			'XNG' => 'Enigma',
			'XBTC21' => 'Bitcoin 21',
			'EVO' => 'Evotion',
			'CON' => 'PayCon',
			'ACOIN' => 'Acoin',
			'ZUR' => 'Zurcoin',
			'BTPL' => 'Bitcoin Planet',
			'ADCN' => 'Asiadigicoin',
			'MNC' => 'Mincoin',
			'TAJ' => 'TajCoin',
			'$$$' => 'Mon',
			'XCRE' => 'Creatio',
			'FLAX' => 'Flaxscript',
			'FRK' => 'Franko',
			'OFF' => 'Cthulhu Offerings',
			'300' => '300 Token',
			'IMX' => 'Impact',
			'SOIL' => 'SOILcoin',
			'CTO' => 'Crypto',
			'FIRE' => 'Firecoin',
			'DBTC' => 'Debitcoin',
			'CPN' => 'CompuCoin',
			'ANTI' => 'AntiBitcoin',
			'BLN' => 'Bolenum',
			'BXC' => 'Bitcedi',
			'ELC' => 'Elacoin',
			'BITEUR' => 'bitEUR',
			'BTQ' => 'BitQuark',
			'BNX' => 'BnrtxCoin',
			'RBX' => 'Ripto Bux',
			'BAS' => 'BitAsean',
			'CXT' => 'Coinonat',
			'MAR' => 'Marijuanacoin',
			'DRS' => 'Digital Rupees',
			'TRDT' => 'Trident Group',
			'CF' => 'Californium',
			'VIP' => 'VIP Tokens',
			'SONG' => 'SongCoin',
			'LTCR' => 'Litecred',
			'VEC2' => 'VectorAI',
			'WARP' => 'WARP',
			'SLEVIN' => 'Slevin',
			'NTWK' => 'Network Token',
			'MTLMC3' => 'Metal Music Coin',
			'URO' => 'Uro',
			'PRX' => 'Printerium',
			'ATX' => 'Artex Coin',
			'BLRY' => 'BillaryCoin',
			'DLISK' => 'DAPPSTER',
			'MILO' => 'MiloCoin',
			'MAY' => 'Theresa May Coin',
			'SH' => 'Shilling',
			'JWL' => 'Jewels',
			'ICE' => 'iDice',
			'SOJ' => 'Sojourn',
			'MND' => 'MindCoin',
			'RIDE' => 'Ride My Car',
			'PONZI' => 'PonziCoin',
			'CAB' => 'Cabbage',
			'URC' => 'Unrealcoin',
			'ZYD' => 'Zayedcoin',
			'JOBS' => 'JobsCoin',
			'ARB' => 'ARbit',
			'BSTAR' => 'Blackstar',
			'BRAIN' => 'Braincoin',
			'TAGR' => 'TAGRcoin',
			'ZMC' => 'ZetaMicron',
			'EGO' => 'EGO',
			'UET' => 'Useless Ethereum Token',
			'DRM' => 'Dreamcoin',
			'PEX' => 'PosEx',
			'CESC' => 'CryptoEscudo',
			'PULSE' => 'Pulse',
			'CWXT' => 'CryptoWorldX Token',
			'SFC' => 'Solarflarecoin',
			'PIE' => 'PIECoin',
			'ORLY' => 'Orlycoin',
			'EXN' => 'ExchangeN',
			'G3N' => 'G3N',
			'XOC' => 'Xonecoin',
			'STEPS' => 'Steps',
			'BSC' => 'BowsCoin',
			'IMPS' => 'ImpulseCoin',
			'OS76' => 'OsmiumCoin',
			'HVCO' => 'High Voltage',
			'PLACO' => 'PlayerCoin',
			'DES' => 'Destiny',
			'BOAT' => 'BOAT',
			'LIR' => 'LetItRide',
			'BIOS' => 'BiosCrypto',
			'PLNC' => 'PLNcoin',
			'CRT' => 'CRTCoin',
			'COXST' => 'CoExistCoin',
			'CRDNC' => 'Credence Coin',
			'ZNE' => 'Zonecoin',
			'IBANK' => 'iBank',
			'TYCHO' => 'Tychocoin',
			'AGLC' => 'AgrolifeCoin',
			'DOLLAR' => 'Dollar Online',
			'BIOB' => 'BioBar',
			'TOR' => 'Torcoin',
			'SDP' => 'SydPak',
			'ARGUS' => 'Argus',
			'ELS' => 'Elysium',
			'CTIC3' => 'Coimatic 3.0',
			'P7C' => 'P7Coin',
			'SOCC' => 'SocialCoin',
			'ULA' => 'Ulatech',
			'ALTC' => 'Antilitecoin',
			'NODC' => 'NodeCoin',
			'FXE' => 'FuturXe',
			'CONX' => 'Concoin',
			'SLFI' => 'Selfiecoin',
			'MGM' => 'Magnum',
			'CTIC2' => 'Coimatic 2.0',
			'GSR' => 'GeyserCoin',
			'LVPS' => 'LevoPlus',
			'PIZZA' => 'PizzaCoin',
			'TSTR' => 'Tristar Coin',
			'CCM100' => 'CCMiner',
			'DGCS' => 'Digital Credits',
			'ABN' => 'Abncoin',
			'EBT' => 'Ebittree Coin',
			'HT' => 'Huobi Token',
			'ATMC' => 'ATMCoin',
			'ABT' => 'Arcblock',
			'TRUE' => 'True Chain',
			'ELA' => 'Elastos',
			'EKT' => 'EDUCare',
			'NCASH' => 'Nucleus Vision',
			'AUTO' => 'Cube',
			'RUFF' => 'Ruff',
			'BCD' => 'Bitcoin Diamond',
			'EXY' => 'Experty',
			'OF' => 'OFCOIN',
			'LET' => 'LinkEye',
			'EPC' => 'Electronic PK Chain',
			'AIDOC' => 'AI Doctor',
			'OC' => 'OceanChain',
			'AVH' => 'Animation Vision Cash',
			'TOPC' => 'TopChain',
			'CS' => 'Credits',
			'AAC' => 'Acute Angle Cloud',
			'MTX' => 'Matryx',
			'GNX' => 'Genaro Network',
			'WIC' => 'Wi Coin',
			'IHT' => 'IHT Real Estate Protocol',
			'CHAT' => 'ChatCoin',
			'LIGHT' => 'LightChain',
			'W3C' => 'W3Coin',
			'SMT' => 'SmartMesh',
			'PXS' => 'Pundi X',
			'RFR' => 'Refereum',
			'CFUN' => 'CFun',
			'RKT' => 'Rock',
			'LCC' => 'Litecoin Cash',
			'HLC' => 'HalalChain',
			'NKC' => 'Nework',
			'SHOW' => 'Show',
			'STC' => 'StarChain',
			'HPY' => 'Hyper Pay',
			'UBTC' => 'United Bitcoin',
			'YEE' => 'Yee',
			'MLM' => 'MktCoin',
			'BKX' => 'Bankex',
			'RCT' => 'RealChain',
			'TKY' => 'THEKEY',
			'BEE' => 'Bee Token',
			'MGC' => 'MergeCoin',
			'UGT' => 'UG Token',
			'FRGC' => 'Fargocoin',
			'BOS' => 'BOScoin',
			'TCT' => 'TokenClub',
			'GEM' => 'Gems ',
			'MAN' => 'Matrix AI Network',
			'AWR' => 'AWARE',
			'CMS' => 'COMSA [XEM]',
			'BCX' => 'BitcoinX',
			'KCASH' => 'Kcash',
			'BSR' => 'BitSoar',
			'INF' => 'InfChain',
			'DDD' => 'Scry.info',
			'SPC' => 'SpaceChain',
			'SEXC' => 'ShareX',
			'VLC' => 'ValueChain',
			'SBTC' => 'Super Bitcoin',
			'REN' => 'Republic Protocol',
			'READ' => 'Read',
			'PRS' => 'PressOne',
			'FSN' => 'Fusion',
			'MOF' => 'Molecular Future',
			'IQT' => 'iQuant',
			'XTZ' => 'Tezos (Pre-Launch)',
			'INSTAR' => 'Insights Network',
			'REF' => 'RefToken',
			'EVN' => 'Envion',
			'ATN' => 'ATN',
			'REM' => 'Remme',
			'XIN' => 'Infinity Economics',
			'SSC' => 'SelfSell',
			'FIL' => 'Filecoin [Futures]',
			'SIC' => 'Swisscoin',
			'MWAT' => 'Restart Energy MWAT',
			'UTNP' => 'Universa',
			'LYM' => 'Lympo',
			'UGC' => 'ugChain',
			'DMT' => 'DMarket',
			'TDX' => 'Tidex Token',
			'MOAC' => 'MOAC',
			'BAR' => 'Titanium Blockchain',
			'UIP' => 'UnlimitedIP',
			'ADK' => 'Aidos Kuneen',
			'BIG' => 'BigONE Token',
			'CLUB' => 'ClubCoin',
			'XNK' => 'Ink Protocol',
			'QUBE' => 'Qube',
			'XID' => 'International Diamond',
			'FOTA' => 'Fortuna',
			'B2X' => 'SegWit2x',
			'ZENGOLD' => 'ZenGold',
			'IPC' => 'IPChain',
			'MSD' => 'MSD',
			'MVC' => 'Maverick Chain',
			'CANDY' => 'Candy',
			'SETH' => 'Sether',
			'GEO' => 'GeoCoin',
			'BTW' => 'Bitcoin White',
			'NTK' => 'Neurotoken',
			'ECH' => 'Etherecash',
			'CRPT' => 'Crypterium',
			'ACAT' => 'Alphacat',
			'DTH' => 'Dether',
			'IDT' => 'InvestDigital',
			'WETH' => 'WETH',
			'SBC' => 'StrikeBitClub',
			'FDX' => 'FidentiaX',
			'NMS' => 'Numus',
			'TMC' => 'TimesCoin',
			'SHND' => 'StrongHands',
			'WC' => 'WINCOIN',
			'TBX' => 'Tokenbox',
			'VASH' => 'VPNCoin',
			'EDRC' => 'EDRCoin',
			'BCDN' => 'BlockCDN',
			'CAS' => 'Cashaa',
			'CPY' => 'Copytrack',
			'CSC' => 'CasinoCoin',
			'ZAP' => 'Zap',
			'IFC' => 'Infinitecoin',
			'TIG' => 'Tigereum',
			'TOK' => 'Tokugawa',
			'DXT' => 'Datawallet',
			'BTCA' => 'Bitair',
			'BEZ' => 'Bezop',
			'JEW' => 'Shekel',
			'JIYO' => 'Jiyo',
			'SWTC' => 'Jingtum Tech',
			'KB3' => 'B3Coin',
			'EAG' => 'EA Coin',
			'GOLF' => 'Golfcoin',
			'MUSE' => 'MUSE',
			'CEFS' => 'CryptopiaFeeShares',
			'GRX' => 'GOLD Reward Token',
			'DRPU' => 'DRP Utility',
			'SUP' => 'Superior Coin',
			'TOKEN' => 'SwapToken',
			'DIM' => 'DIMCOIN',
			'THS' => 'TechShares',
			'GBG' => 'Golos Gold',
			'WA' => 'WA Space',
			'CRAVE' => 'Crave',
			'KZC' => 'Kzcash',
			'BT2' => 'BT2 [CST]',
			'AV' => 'AvatarCoin',
			'ESC' => 'Escroco',
			'CYDER' => 'Cyder',
			'GLA' => 'Gladius Token',
			'XMRG' => 'Monero Gold',
			'XOT' => 'Internet of Things',
			'DAV' => 'DavorCoin',
			'SND' => 'Sand Coin',
			'CME' => 'Cashme',
			'BIO' => 'BioCoin',
			'GCS' => 'GameChain System',
			'XRY' => 'Royalties',
			'DMC' => 'DynamicCoin',
			'PRES' => 'President Trump',
			'ABC' => 'Alphabit',
			'UTT' => 'United Traders Token',
			'ANI' => 'Animecoin',
			'SIGMA' => 'SIGMAcoin',
			'MCR' => 'Macro',
			'GAY' => 'GAY Money',
			'TESLA' => 'TeslaCoilCoin',
			'SPK' => 'Sparks',
			'PCN' => 'PeepCoin',
			'PNX' => 'Phantomx',
			'GOD' => 'Bitcoin God',
			'TER' => 'TerraNova',
			'ESZ' => 'EtherSportz',
			'ORE' => 'Galactrum',
			'SHA' => 'SHACoin',
			'VZT' => 'Vezt',
			'BTE' => 'BitSerial',
			'GARY' => 'President Johnson',
			'LDCN' => 'LandCoin',
			'HC' => 'Harvest Masternode Coin',
			'PDG' => 'PinkDog',
			'CLD' => 'Cloud',
			'IRL' => 'IrishCoin',
			'TRIA' => 'Triaconta',
			'GDC' => 'GrandCoin',
			'BITCF' => 'First Bitcoin Capital',
			'ELITE' => 'Ethereum Lite',
			'IDXM' => 'IDEX Membership',
			'APC' => 'AlpaCoin',
			'STEX' => 'STEX',
			'LEPEN' => 'LePen',
			'OX' => 'OX Fina',
			'VULC' => 'Vulcano',
			'SJCX' => 'Storjcoin X',
			'ZSE' => 'ZSEcoin',
			'BCA' => 'Bitcoin Atom',
			'WSX' => 'WeAreSatoshi',
			'GMX' => 'GoldMaxCoin',
			'FLAP' => 'FlappyCoin',
			'INDI' => 'Indicoin',
			'XSTC' => 'Safe Trade Coin',
			'BTCM' => 'BTCMoon',
			'TURBO' => 'TurboCoin',
			'NUMUS' => 'NumusCash',
			'SKR' => 'Sakuracoin',
			'UNRC' => 'UniversalRoyalCoin',
			'DEUS' => 'DeusCoin',
			'PRN' => 'Protean',
			'ACN' => 'Avoncoin',
			'BSN' => 'Bastonet',
			'FRN' => 'Francs',
			'TELL' => 'Tellurion',
			'NEOG' => 'NEO GOLD',
			'HTML5' => 'HTML5COIN',
			'XQN' => 'Quotient',
			'BIT' => 'First Bitcoin',
			'NOX' => 'Nitro',
			'PRIMU' => 'Primulon',
			'NAMO' => 'NamoCoin',
			'DUTCH' => 'Dutch Coin',
			'NBIT' => 'netBit',
			'BLAZR' => 'BlazerCoin',
			'ZBC' => 'Zilbercoin',
			'KDC' => 'KlondikeCoin',
			'SISA' => 'SISA',
			'LKC' => 'LinkedCoin',
			'SJW' => 'SJWCoin',
			'PLX' => 'PlexCoin',
			'FONZ' => 'Fonziecoin',
			'CFC' => 'CoffeeCoin',
			'RBBT' => 'RabbitCoin',
			'SLOTH' => 'Slothcoin',
			'HALLO' => 'Halloween Coin',
			'WOW' => 'Wowcoin',
			'RICHX' => 'RichCoin',
			'ROYAL' => 'RoyalCoin',
			'AKY' => 'Akuya Coin',
			'SENSE' => 'Sense',
			'SNAKE' => 'SnakeEyes',
			'COR' => 'CORION',
			'SAK' => 'Sharkcoin',
			'MARX' => 'MarxCoin',
			'INDIA' => 'India Coin',
			'ACES' => 'Aces',
			'DON' => 'Donationcoin',
			'MONEY' => 'MoneyCoin',
			'MINEX' => 'Minex',
			'LEVO' => 'Levocoin',
			'CHEAP' => 'Cheapcoin',
			'WINK' => 'Wink',
			'RUNNERS' => 'Runners',
			'TEAM' => 'TeamUp',
			'OMC' => 'Omicron',
			'MBL' => 'MobileCash',
			'HDLB' => 'HODL Bucks',
			'POKE' => 'PokeCoin',
			'BEST' => 'BestChain',
			'UR' => 'UR',
			'MAGN' => 'Magnetcoin',
			'SFE' => 'SafeCoin',
			'DBG' => 'Digital Bullion Gold',
			'BTBc' => 'Bitbase',
			'NTC' => 'Natcoin',
			'CMP' => 'Compcoin',
			'QORA' => 'Qora',
			'TOPAZ' => 'Topaz Coin',
			'DASHS' => 'Dashs',
			'EGOLD' => 'eGold',
			'FAZZ' => 'Fazzcoin',
			'FFC' => 'FireFlyCoin',
			'OPES' => 'Opescoin',
			'RHFC' => 'RHFCoin',
			'SKULL' => 'Pirate Blocks',
			'LAZ' => 'Lazaruscoin',
			'DISK' => 'DarkLisk',
			'ANTX' => 'Antimatter',
			'GUESS' => 'Peerguess',
			'UNC' => 'UNCoin',
			'FAP' => 'FAPcoin',
			'RYZ' => 'ANRYZE',
			'BIRDS' => 'Birds',
			'SPORT' => 'SportsCoin',
			'XTD' => 'XTD Coin',
			'SHELL' => 'ShellCoin',
			'TCOIN' => 'T-coin',
			'GAIN' => 'UGAIN',
			'EGG' => 'EggCoin',
			'GRN' => 'Granite',
			'KARMA' => 'Karmacoin',
			'VOYA' => 'Voyacoin',
			'PAYP' => 'PayPeer',
			'KASHH' => 'KashhCoin',
			'RUBIT' => 'RubleBit',
			'TCR' => 'TheCreed',
			'TODAY' => 'TodayCoin',
			'MMXVI' => 'MMXVI',
			'HIGH' => 'High Gain',
			'HCC' => 'Happy Creator Coin',
			'MCI' => 'Musiconomi',
			'X2' => 'X2',
			'BITOK' => 'Bitok',
			'CC' => 'CyberCoin',
			'GML' => 'GameLeagueCoin',
			'CYC' => 'Cycling Coin',
			'HYPER' => 'Hyper',
			'AXIOM' => 'Axiom',
			'BAC' => 'BitAlphaCoin',
			'XVE' => 'The Vegan Initiative',
			'SMOKE' => 'Smoke',
			'DCRE' => 'DeltaCredits',
			'DUB' => 'Dubstep',
			'YES' => 'Yescoin',
			'FUTC' => 'FutCoin',
			'FRWC' => 'FrankyWillCoin',
			'TLE' => 'Tattoocoin (Limited Edition)',
			'ASN' => 'Aseancoin',
			'REGA' => 'Regacoin',
			'BUB' => 'Bubble',
			'MONETA' => 'Moneta',
			'PSY' => 'Psilocybin',
			'PRM' => 'PrismChain',
			'TRICK' => 'TrickyCoin',
			'IVZ' => 'InvisibleCoin',
			'OP' => 'Operand',
			'LTH' => 'LAthaan',
			'PCS' => 'Pabyosi Coin (Special)',
			'FID' => 'BITFID',
			'LLT' => 'LLToken',
			'OCOW' => 'OCOW',
			'FRCT' => 'Farstcoin',

		);

	}

	/**
	 * Register Virtual_Coins widget controls.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

        // Content Tab
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'General', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		// Select Type Section
		$this->add_control(
			'type', //param_name
			[
				'label' 	=> __( 'Select Type', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '1',
				'options' 	=> [
					'1'  => __( 'Convertor', 'deep' ),
					'2'  => __( 'Full Card', 'deep' ),
				],
			]
		);

		$this->add_control(
			'symbol_1', //param_name
			[
				'label' 	=> __( 'Symbol #1', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'type' 	=> [
						'1'
					],
				],
			]
		);

		$this->add_control(
			'symbol_2', //param_name
			[
				'label' 	=> __( 'Symbol #2', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'type' 	=> [
						'1'
					],
				],
			]
		);

		$this->add_control(
			'columns', //param_name
			[
				'label' 	=> __( 'Columns', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> '',
				'options' 	=> [
					'1'  => __( '1', 'deep' ),
					'2'  => __( '2', 'deep' ),
					'3'  => __( '3', 'deep' ),
					'4'  => __( '4', 'deep' ),
					'5'  => __( '5', 'deep' ),
				],
				'condition' 	=> [ //dependency
					'type' 	=> [
						'2'
					],
				],
			]
		);
		
		$this->add_control(
			'img_f1', //param_name
			[
				'label' 	=> __( 'Symbol #1', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'1', '2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'symbol_f1', //param_name
			[
				'label' 	=> __( 'Symbol #1', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'1', '2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'currency_f1', //param_name
			[
				'label' 	=> __( 'Symbol #1', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'1', '2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'img_f2', //param_name
			[
				'label' 	=> __( 'Symbol #2', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'symbol_f2', //param_name
			[
				'label' 	=> __( 'Symbol #2', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'currency_f2', //param_name
			[
				'label' 	=> __( 'Symbol #2', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'2', '3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'img_f3', //param_name
			[
				'label' 	=> __( 'Symbol #3', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'symbol_f3', //param_name
			[
				'label' 	=> __( 'Symbol #3', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'currency_f3', //param_name
			[
				'label' 	=> __( 'Symbol #3', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'3', '4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'img_f4', //param_name
			[
				'label' 	=> __( 'Symbol #4', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'symbol_f4', //param_name
			[
				'label' 	=> __( 'Symbol #4', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'currency_f4', //param_name
			[
				'label' 	=> __( 'Symbol #4', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'4', '5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);
		
		
		$this->add_control(
			'img_f5', //param_name
			[
				'label' 	=> __( 'Symbol #5', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::MEDIA, //type
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'symbol_f5', //param_name
			[
				'label' 	=> __( 'Symbol #5', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'BTC',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->add_control(
			'currency_f5', //param_name
			[
				'label' 	=> __( 'Symbol #5', 'deep' ), //heading
				'type' 		=> \Elementor\Controls_Manager::SELECT, //type
				'default' 	=> 'USD',
				'options' 	=> $this->wn_currency(),
				'condition' 	=> [ //dependency
					'columns' 	=> [
						'5'
					],
					'type' 	=> [
						'2'
					],
				],
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
			'classid_section',
			[
				'label' => __( 'Class & ID', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
		);

		$this->add_control(
			'shortcodeid', //param_name
			[
				'label' 		=> __( 'Custom ID', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->add_control(
			'shortcodeclass', //param_name
			[
				'label' 		=> __( 'Custom Class', 'deep' ), //heading
				'type' 			=> \Elementor\Controls_Manager::TEXT, //type
			]
		);

		$this->end_controls_section();

		// Custom css tab
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label' => __( 'Custom CSS', 'deep' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'show_label' => true,
			]
		);

		$this->end_controls_section();


	}

	/**
	 * Render Virtual_Coins widget output on the frontend.
	 *
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();				
		$shortcodeclass		= $settings['shortcodeclass'] ? $settings['shortcodeclass'] : '';
		$shortcodeid		= $settings['shortcodeid'] ? ' id="' . $settings['shortcodeid'] . '"' : '';

		$img_f1 = !empty( $settings['img_f1']['url'] ) ? $settings['img_f1']['url'] : '';
		$img_f2 = !empty( $settings['img_f2']['url'] ) ? $settings['img_f2']['url'] : '';
		$img_f3 = !empty( $settings['img_f3']['url'] ) ? $settings['img_f3']['url'] : '';
		$img_f4 = !empty( $settings['img_f4']['url'] ) ? $settings['img_f4']['url'] : '';
		$img_f5 = !empty( $settings['img_f5']['url'] ) ? $settings['img_f5']['url'] : '';

		$symbol_1 = !empty( $settings['symbol_1'] ) ? $settings['symbol_1'] : '';
		$symbol_2 = !empty( $settings['symbol_2'] ) ? $settings['symbol_2'] : '';
		$symbol_3 = !empty( $settings['symbol_3'] ) ? $settings['symbol_3'] : '';
		$symbol_4 = !empty( $settings['symbol_4'] ) ? $settings['symbol_4'] : '';
		$symbol_5 = !empty( $settings['symbol_5'] ) ? $settings['symbol_5'] : '';

		if ( $settings['type'] == '1' ) {

			$out = do_shortcode( '[vcw-converter symbol1="' . $symbol_1 . '" symbol2="' . $symbol_2 . '"]' );

		} elseif ( $settings['type'] == '2' ) {

			$out = '<div class="row vcw-wrapper ' . $shortcodeclass . '"  ' . $shortcodeid . '>' ;
			$image_f1 = !empty( $img_f1 ) ? '<figure class="symbol-icon"><img src="' . esc_url( $img_f1 ) . '" alt="' . $symbol_f1 . '"></figure>' : '' ;
			$image_f2 = !empty( $img_f2 ) ? '<figure class="symbol-icon"><img src="' . esc_url( $img_f2 ) . '" alt="' . $symbol_f2 . '"></figure>' : '' ;
			$image_f3 = !empty( $img_f3 ) ? '<figure class="symbol-icon"><img src="' . esc_url( $img_f3 ) . '" alt="' . $symbol_f3 . '"></figure>' : '' ;
			$image_f4 = !empty( $img_f4 ) ? '<figure class="symbol-icon"><img src="' . esc_url( $img_f4 ) . '" alt="' . $symbol_f4 . '"></figure>' : '' ;
			$image_f5 = !empty( $img_f5 ) ? '<figure class="symbol-icon"><img src="' . esc_url( $img_f5 ) . '" alt="' . $symbol_f5 . '"></figure>' : '' ;

			switch ($settings['columns']) {
				case '1':
					$out .= '<div class="col-md-12 last-column">' . $image_f1;
					$out .= do_shortcode( '[vcw-full-card symbol="' . $symbol_f1 . '" currency1="' . $currency_f1 . '" show_logo="no"]' );
					$out .= '</div>';
					break;
				case '2':
					$out .= '<div class="col-md-6">' . $image_f1 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f1 . '" currency1="' . $currency_f1 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-6 last-column ">' . $image_f2 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f2 . '" currency1="' . $currency_f2 . '" show_logo="no"]' ) . '</div>';
					break;
				case '3':
					$out .= '<div class="col-md-4">' . $image_f1 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f1 . '" currency1="' . $currency_f1 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-4">' . $image_f2 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f2 . '" currency1="' . $currency_f2 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-4 last-column">' . $image_f3 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f3 . '" currency1="' . $currency_f3 . '" show_logo="no"]' ) . '</div>';			
					break;
				case '4':
					$out .= '<div class="col-md-3">' . $image_f1 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f1 . '" currency1="' . $currency_f1 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-3">' . $image_f2 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f2 . '" currency1="' . $currency_f2 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-3">' . $image_f3 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f3 . '" currency1="' . $currency_f3 . '" show_logo="no"]' ) . '</div>';	
					$out .= '<div class="col-md-3 last-column">' . $image_f4 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f4 . '" currency1="' . $currency_f4 . '" show_logo="no"]' ) . '</div>';	
					break;
				case '5':
					$out .= '<div class="col-md-5th">' . $image_f1 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f1 . '" currency1="' . $currency_f1 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-5th">' . $image_f2 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f2 . '" currency1="' . $currency_f2 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-5th">' . $image_f3 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f3 . '" currency1="' . $currency_f3 . '" show_logo="no"]' ) . '</div>';	
					$out .= '<div class="col-md-5th">' . $image_f4 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f4 . '" currency1="' . $currency_f4 . '" show_logo="no"]' ) . '</div>';
					$out .= '<div class="col-md-5th last-column">' . $image_f5 . do_shortcode( '[vcw-full-card symbol="' . $symbol_f5 . '" currency1="' . $currency_f5 . '" show_logo="no"]' ) . '</div>';				
					break;
			}

			$out .= '</div>';

		}
		$custom_css = $settings['custom_css'];

		if ( $custom_css != '' ) {
			echo '<style>'. $custom_css .'</style>';
        }
		echo $out;

	}

}