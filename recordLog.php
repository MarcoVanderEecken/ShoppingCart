<?php
/**
 * The purpose of this class is to keep a record of all the records that have been approved/declined by the
 * moderator/admin since their login.
 */

class RecordLog {
	private $recordID, $username, $sport_id, $sport_type, $record, $approved, $recordDate; //record
	private $loginID; //who is logged in.
	private $recordChange; //when the user changed the record (timestamp)

	/**
	 * recordLog constructor.
	 *
	 * @param $recordID
	 * @param $username
	 * @param $sport_id
	 * @param $sport_type
	 * @param $record
	 * @param $approved
	 * @param $recordDate
	 * @param $loginID
	 */
	public function __construct( $recordID, $username, $sport_id, $sport_type, $record, $approved, $recordDate, $loginID) {
		$this->recordID     = $recordID;
		$this->username     = $username;
		$this->sport_id     = $sport_id;
		$this->sport_type   = $sport_type;
		$this->record       = $record;
		$this->approved     = $approved;
		$this->recordDate   = $recordDate;
		$this->loginID      = $loginID;
		$this->nowRecordChange();
	}

	public function serialize(){
		return serialize([
			$this->recordID,
			$this->usernamem,
			$this->sport_id,
			$this->sport_type,
			$this->record,
			$this->approved,
			$this->recordDate,
			$this->loginID,
			$this->recordChange,
		]);
	}

	public function unserialize($data){
		list(
			$this->recordID,
			$this->usernamem,
			$this->sport_id,
			$this->sport_type,
			$this->record,
			$this->approved,
			$this->recordDate,
			$this->loginID,
			$this->recordChange
			) = unserialize($data);
	}

	/**
	 * @return mixed
	 */
	public function getRecordID() {
		return $this->recordID;
	}

	/**
	 * @param mixed $recordID
	 */
	public function setRecordID( $recordID ) {
		$this->recordID = $recordID;
	}

	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername( $username ) {
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getSportId() {
		return $this->sport_id;
	}

	/**
	 * @param mixed $sport_id
	 */
	public function setSportId( $sport_id ) {
		$this->sport_id = $sport_id;
	}

	/**
	 * @return mixed
	 */
	public function getRecord() {
		return $this->record;
	}

	/**
	 * @param mixed $record
	 */
	public function setRecord( $record ) {
		$this->record = $record;
	}

	/**
	 * @return mixed
	 */
	public function getApproved() {
		return $this->approved;
	}

	/**
	 * @param mixed $approved
	 */
	public function setApproved( $approved ) {
		$this->approved = $approved;
	}

	/**
	 * @return mixed
	 */
	public function getRecordDate() {
		return $this->recordDate;
	}

	/**
	 * @param mixed $recordDate
	 */
	public function setRecordDate( $recordDate ) {
		$this->recordDate = $recordDate;
	}

	/**
	 * @return mixed
	 */
	public function getLoginID() {
		return $this->loginID;
	}

	/**
	 * @param mixed $loginID
	 */
	public function setLoginID( $loginID ) {
		$this->loginID = $loginID;
	}

	/**
	 * @return mixed
	 */
	public function getRecordChange() {
		return $this->recordChange;
	}

	/**
	 * @return mixed
	 */
	public function getSportType() {
		return $this->sport_type;
	}

	/**
	 * @param mixed $sport_type
	 */
	public function setSportType( $sport_type ) {
		$this->sport_type = $sport_type;
	}



	/**
	 * @param mixed $recordChange
	 */
	public function setRecordChange( $recordChange ) {
		$this->recordChange = $recordChange;
	}

	private function nowRecordChange() {
		$this->recordChange = date('m/d/Y h:i:s a', time());
	}


}

