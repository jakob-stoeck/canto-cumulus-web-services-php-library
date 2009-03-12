<?
/**
 * This is the first version of this class. Since the Canto Cumulus Web Publisher Web Services (WS) have no documentation since today this should help getting things started. I hope it gets a class with all WS functions working soon
 * Note: It is a model for a CakePHP installation, but that should change in one of the next commits.
 * @fixme: replace usage of Cake’s Set::combine
 */
class Cumulus extends AppModel { 
	var $useTable = false;
	
	private $connection = array(
		'server' => '192.168.0.1', // internal IP of Cumulus Server (not the web server)
		'user' => 'user.name',  // your Cumulus Web Publisher Account
		'password' => 'pAssw0rd',
		'serialNumber' => 'xxx-xxx-xxx-xxx-xxx-xxx'
	);

	/**
	 * @todo get those dynamically
	 */
	private $fieldGuid = array(
		'Altitude' => '{b23e86e1-f0fb-11d4-b4f5-0050baeba6c7}',
		'Annotation' => '{af4b2e6c-5f6a-11d2-8f20-0000c0e166dc}',
		'Aperture (String)' => '{c8be2dc5-f341-11d3-901c-0080ad80c556}',
		'Aperture' => '{f07069f3-8447-4938-8c18-23407d76ad92}',
		'Asset Creation Date' => '{af4b2e05-5f6a-11d2-8f20-0000c0e166dc}',
		'Asset Identifier' => '{af4b2e23-5f6a-11d2-8f20-0000c0e166dc}',
		'Asset Modification Date' => '{af4b2e06-5f6a-11d2-8f20-0000c0e166dc}',
		'Asset Modification State Identifier' => '{af4b2e24-5f6a-11d2-8f20-0000c0e166dc}',
		'Asset Name' => '{af4b2e69-5f6a-11d2-8f20-0000c0e166dc}',
		'Asset Reference' => '{af4b2e16-5f6a-11d2-8f20-0000c0e166dc}',
		'Author' => '{af4b2e2b-5f6a-11d2-8f20-0000c0e166dc}',
		'Byline' => '{af4b2e39-5f6a-11d2-8f20-0000c0e166dc}',
		'Byline Title' => '{af4b2e3a-5f6a-11d2-8f20-0000c0e166dc}',
		'Camera ID' => '{745e9161-62c2-11d4-909c-0080ad80c556}',
		'Camera Manufacturer' => '{af4b2e4d-5f6a-11d2-8f20-0000c0e166dc}',
		'Camera Model' => '{af4b2e4e-5f6a-11d2-8f20-0000c0e166dc}',
		'Caption' => '{af4b2e34-5f6a-11d2-8f20-0000c0e166dc}',
		'Caption Writer' => '{af4b2e35-5f6a-11d2-8f20-0000c0e166dc}',
		'Captured Date' => '{af4b2e51-5f6a-11d2-8f20-0000c0e166dc}',
		'Catalog Name' => '{c02adb32-5c2c-4014-b86a-a53cf83f7e6c}',
		'Cataloging User' => '{af4b2e08-5f6a-11d2-8f20-0000c0e166dc}',
		'Categories' => '{af4b2e0c-5f6a-11d2-8f20-0000c0e166dc}',
		'City' => '{af4b2e3e-5f6a-11d2-8f20-0000c0e166dc}',
		'Color Mode' => '{af4b2e0e-5f6a-11d2-8f20-0000c0e166dc}',
		'Color Space' => '{d20d295a-4e62-475e-aa7a-60c3b324f44a}',
		'Contrast' => '{1fb84bdd-f72e-49d2-9a17-b7c19a600d0b}',
		'Copyright Notice' => '{af4b2e2c-5f6a-11d2-8f20-0000c0e166dc}',
		'Country' => '{af4b2e40-5f6a-11d2-8f20-0000c0e166dc}',
		'Country Code' => '{d772f663-9242-11d5-b58c-0050baeba6c7}',
		'Credits' => '{af4b2e3b-5f6a-11d2-8f20-0000c0e166dc}',
		'Custom Rendered' => '{5a608c73-d0b3-4eee-916c-e8ef7fc47df0}',
		'Date Sent' => '{af4b2e42-5f6a-11d2-8f20-0000c0e166dc}',
		'Date Time Digitized' => '{1f97095a-e6a6-4563-b89f-a29bfc1f1a51}',
		'Date Time Original' => '{e174b821-623c-476b-a2bc-173725585e0a}',
		'Digital Zoom Ratio' => '{938322a8-9e83-4d4f-bbec-a3905468134c}',
		'Do Not Delete Record' => '{af4b2e04-5f6a-11d2-8f20-0000c0e166dc}',
		'Edit Status' => '{d772f665-9242-11d5-b58c-0050baeba6c7}',
		'EXIF Version' => '{9219d600-6710-4734-ae6f-761437e652bf}',
		'Exposure Bias' => '{133293b4-f598-11d3-901f-0080ad80c556}',
		'Exposure Mode' => '{c8be2dc8-f341-11d3-901c-0080ad80c556}',
		'Exposure Program' => '{133293b1-f598-11d3-901f-0080ad80c556}',
		'Exposure Time (String)' => '{b78bb348-3cd2-464f-a420-49bfd694fffa}',
		'Exposure Time' => '{af4b2e52-5f6a-11d2-8f20-0000c0e166dc}',
		'F Number (String)' => '{745e9165-62c2-11d4-909c-0080ad80c556}',
		'F Number' => '{af4b2e53-5f6a-11d2-8f20-0000c0e166dc}',
		'File Data Size' => '{af4b2e14-5f6a-11d2-8f20-0000c0e166dc}',
		'File Format' => '{af4b2e0d-5f6a-11d2-8f20-0000c0e166dc}',
		'Fixture Id' => '{d772f662-9242-11d5-b58c-0050baeba6c7}',
		'Flash Mode' => '{c8be2dca-f341-11d3-901c-0080ad80c556}',
		'FlashPix Version' => '{17955d37-7295-46be-8a0e-80fecc3d2c32}',
		'Focal Length 35mm Film [mm]' => '{5a2da212-5967-4cdc-8494-49580e20a3a5}',
		'Focal Length [mm]' => '{af4b2e56-5f6a-11d2-8f20-0000c0e166dc}',
		'Folder Name' => '{af4b2e5e-5f6a-11d2-8f20-0000c0e166dc}',
		'Gain Control' => '{dfda2122-15b8-4ae3-b7e9-5cab3420557b}',
		'Headline' => '{af4b2e36-5f6a-11d2-8f20-0000c0e166dc}',
		'Horizontal Pixels' => '{05f6f3f0-833a-45a0-ade4-8e48542f37ef}',
		'Horizontal Resolution' => '{af4b2e0f-5f6a-11d2-8f20-0000c0e166dc}',
		'ID' => '{c02adb31-5c2c-4014-b86a-a53cf83f7e6c}',
		'Image Height' => '{af4b2e12-5f6a-11d2-8f20-0000c0e166dc}',
		'Image Source' => '{ed58b241-cf37-11d4-b4de-0050baeba6c7}',
		'Image Width' => '{af4b2e11-5f6a-11d2-8f20-0000c0e166dc}',
		'IPTC Category' => '{24ce5040-e5f4-11d3-900e-0080ad80c556}',
		'IPTC Date Created' => '{226e3b01-2d97-11d5-b533-0050baeba6c7}',
		'IPTC Time Created' => '{226e3b02-2d97-11d5-b533-0050baeba6c7}',
		'ISO Speed' => '{c8be2dcd-f341-11d3-901c-0080ad80c556}',
		'Keywords' => '{9a82b761-d5a0-11d4-b4e4-0050baeba6c7}',
		'Label' => '{dcf3a0ee-e89e-41a9-9037-cf1ad5f46973}',
		'Latitude' => '{418a4c91-fe63-11d3-9030-0080ad80c556}',
		'Lens Info' => '{745e9163-62c2-11d4-909c-0080ad80c556}',
		'Light Source' => '{3de69fa1-2af7-11d4-9067-0080ad80c556}',
		'Longitude' => '{418a4c92-fe63-11d3-9030-0080ad80c556}',
		'Manufacturer' => '{119565c1-018a-11d4-9035-0080ad80c556}',
		'Max Aperture (String)' => '{c8be2dce-f341-11d3-901c-0080ad80c556}',
		'Max Aperture' => '{49a36838-262f-46e3-a676-f3cd2665073c}',
		'Meter Mode' => '{c8be2dd0-f341-11d3-901c-0080ad80c556}',
		'Notes' => '{af4b2e0b-5f6a-11d2-8f20-0000c0e166dc}',
		'Object Cycle' => '{d772f664-9242-11d5-b58c-0050baeba6c7}',
		'Object Name' => '{af4b2e3d-5f6a-11d2-8f20-0000c0e166dc}',
		'Org. Trans. Ref.' => '{af4b2e41-5f6a-11d2-8f20-0000c0e166dc}',
		'Originating Program' => '{d772f661-9242-11d5-b58c-0050baeba6c7}',
		'Program Version' => '{d8b73021-9891-11d5-b593-0050baeba6c7}',
		'Province/State' => '{af4b2e3f-5f6a-11d2-8f20-0000c0e166dc}',
		'Rating' => '{1e29ca59-4022-43f3-9448-539a3da4097c}',
		'Record Creation Date' => '{af4b2e01-5f6a-11d2-8f20-0000c0e166dc}',
		'Record Modification Date' => '{af4b2e02-5f6a-11d2-8f20-0000c0e166dc}',
		'Record Name' => '{af4b2e00-5f6a-11d2-8f20-0000c0e166dc}',
		'Reference Date' => '{1658d872-92e1-11d5-b58d-0050baeba6c7}',
		'Reference Number' => '{1658d873-92e1-11d5-b58d-0050baeba6c7}',
		'Reference Service' => '{1658d871-92e1-11d5-b58d-0050baeba6c7}',
		'Related Master Assets' => '{af4b2e72-5f6a-11d2-8f20-0000c0e166dc}',
		'Related Sub Assets' => '{af4b2e71-5f6a-11d2-8f20-0000c0e166dc}',
		'Release Date' => '{d772f666-9242-11d5-b58c-0050baeba6c7}',
		'Release Time' => '{d772f667-9242-11d5-b58c-0050baeba6c7}',
		'Saturation' => '{baf99f08-2cbb-49f4-8330-8d162d79b02b}',
		'Scanner Model' => '{af4b2e50-5f6a-11d2-8f20-0000c0e166dc}',
		'Scene Capture Type' => '{4580c980-77e5-4003-b598-8b8e5c82d2fb}',
		'Scene Type' => '{84a549e7-781f-442b-ad93-8a9b7e56dfe8}',
		'Sensing Method' => '{ecdc56a3-09cf-4e9d-be1d-7d7a160f3c8d}',
		'Serial Number' => '{c8be2dc4-f341-11d3-901c-0080ad80c556}',
		'Server Name' => '{af4b2e6b-5f6a-11d2-8f20-0000c0e166dc}',
		'Service Id' => '{5cada4d3-90df-11d2-8e22-008048fdada5}',
		'Sharpness' => '{633d6f8d-1097-4ed6-8bfa-f1e70d00e485}',
		'Shutter Time [s]' => '{b2373251-f405-11d3-901d-0080ad80c556}',
		'Software' => '{af4b2e09-5f6a-11d2-8f20-0000c0e166dc}',
		'Source' => '{af4b2e3c-5f6a-11d2-8f20-0000c0e166dc}',
		'Special Instructions' => '{af4b2e37-5f6a-11d2-8f20-0000c0e166dc}',
		'Status' => '{af4b2e07-5f6a-11d2-8f20-0000c0e166dc}',
		'Subject Distance' => '{af4b2e55-5f6a-11d2-8f20-0000c0e166dc}',
		'Subject Distance Range' => '{2bf29c20-3a92-4302-9cc7-7334cc265a10}',
		'Supplemental Categories' => '{5cada4d5-90df-11d2-8e22-008048fdada5}',
		'Thumbnail' => '{af4b2e0a-5f6a-11d2-8f20-0000c0e166dc}',
		'Thumbnail Mean Value' => '{af4b2e25-5f6a-11d2-8f20-0000c0e166dc}',
		'Thumbnail Rotation' => '{15dd6c90-f424-4c4c-beef-58c16b24b674}',
		'Thumbnail Standard Deviation' => '{af4b2e26-5f6a-11d2-8f20-0000c0e166dc}',
		'Time Sent' => '{b4bb4cd1-90db-11d2-8e22-008048fdada5}',
		'Unix File Identifier' => '{3f6e4112-31f0-4054-972f-e0ae98159c1c}',
		'Urgency' => '{af4b2e38-5f6a-11d2-8f20-0000c0e166dc}',
		'User Comment' => '{1d3213c4-ce9b-46d5-957b-26e54d5ccd3d}',
		'Vertical Pixels' => '{a89e881e-df7a-4c7c-9bf7-840bf3df707e}',
		'Vertical Resolution' => '{af4b2e10-5f6a-11d2-8f20-0000c0e166dc}',
		'Volume Name' => '{af4b2e6a-5f6a-11d2-8f20-0000c0e166dc}',
		'White Balance Mode' => '{c3bfe021-f352-11d3-901c-0080ad80c556}'
	);

	private $catalogList = array('catalog' => 'Your_Catalog');

	function __construct() {
		ini_set('soap.wsdl_cache_enabled', '1'); // disabling WSDL cache
		$this->c = new SoapClient('http://www.example.org/CumulusWS/services/Cumulus?wsdl'); // add path to WSDL file
	}

	function nameToGuid($fieldNameList) {
		return array_values(array_flip(array_intersect(array_flip($this->fieldGuid), $fieldNameList)));
	}
	
	/**
	 * @param string $query for format see Cumulus Server JavaDoc QueryFormat.html 
	 * @return mixed
	 */
	function findRecords($query = '') {
		if(empty($query)) $query = $this->fieldGuid['Record Modification Date'].' < 2200-01-01'; // finds all records, is there a better way to do this?

		$recordList = $this->c->findRecords(array(
			'connection' => $this->connection,
			'catalogList' => $this->catalogList,
			'query' => $query
		));
		
		$recordList = $this->objectToArray($recordList);
		if(!isset($recordList['recordList']['record'])) {
			return false;
		} else {
			return $recordList['recordList'];
		}
	}
	
	/**
	 * @param string $query for format see Cumulus Server JavaDoc QueryFormat.html 
	 * @return mixed
	 */
	function getRecordData($query = '', $fieldGuidList = array()) {
		if($recordList = $this->findRecords($query)) {
			$fieldGuidList = $this->nameToGuid($fieldGuidList);
		
			$response = $this->c->getRecordData(array(
				'connection' => $this->connection,
				'recordList' => $recordList,
				'fieldGuidList' => array('fieldGuid' => $fieldGuidList)
			));
		
			return $this->recordsObjectToArray($response);
		} else {
			$this->message('warning', 'Keine Record Data gefunden');
			
			return false;
		}

	}

	function getAssets($query = '', $action = '') {
		if($recordList = $this->findRecords($query)) {
			$response = $this->c->getAssets(array(
				'connection' => $this->connection,
				'recordList' => $recordList,
				'action' => $action
			));
		
			return $this->objectToArray($response);
		} else {
			$this->message('warning', 'Keine Assets gefunden');
			
			return false;
		}
		
	}

	/**
	 * Converts an object to an array
	 * 
	 * thanks to ananda dot putra at gmail dot com
	 * http://it.php.net/manual/en/function.get-object-vars.php#62470
	 */
	function objectToArray($obj) {
		$_arr = is_object($obj) ? get_object_vars($obj) : $obj;
		foreach ($_arr as $key => $val) {
			$val = (is_array($val) || is_object($val)) ? $this->objectToArray($val) : $val;
			$arr[$key] = $val;
		}
		return $arr;
	}

	/**
	 * Formats the ugly big object from getRecords to a small array
	 * 
	 * @todo works only with getRecords, should also work with getAssets
	 */
	function recordsObjectToArray($object) {
		$response = $this->objectToArray($object);

		// remove unneccessary deep associations
		$response = $response['recordDataList']['recordData'];
		
		// a single response should also be in an array
		if(!isset($response[0])) $response = array(0 => $response);
		
		foreach($response as &$r) {
			$r['fieldValue'] = $r['fieldValueList']['fieldValue'];
			unset($r['fieldValueList']);

			// replace guids with name and make them array keys
			$fieldGuid = array_flip($this->fieldGuid);
			foreach($r['fieldValue'] as &$fieldValue) {
				$fieldValue['fieldGuid'] = $fieldGuid[$fieldValue['fieldGuid']];
			}
			$r['fieldValue'] = Set::combine($r['fieldValue'], '{n}.fieldGuid', '{n}.value');
		
			if(isset($r['fieldValue']['Categories'])) {
				$r['fieldValue']['Categories'] = $r['fieldValue']['Categories']['category']	;
				
				// a single category should also be in an array
				if(!isset($r['fieldValue']['Categories'][0])) $r['fieldValue']['Categories'] = array(0 => $r['fieldValue']['Categories']);
			}
		}

		return $response;
	}
	
	function getFunctions() {
		var_dump($this->c->__getFunctions());
	}
	
	function getRecordFieldDefinitions() {
		$response = $this->c->getRecordFieldDefinitions(array(
			'connection' => $this->connection,
			'catalog' => $this->catalogList['catalog'],
			'language' => 1
		));
		
		debug(Set::combine($response->fieldDefinitionList->fieldDefinition, ''));
	}
}
?>