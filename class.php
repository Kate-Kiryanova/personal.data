<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\Localization\Loc;

class FlxMDEditPersonalData extends CBitrixComponent
{

	private $arRequest = [];

	private $bCheckFields = false;
	private $personalDataUpdate = false;
	private $nUserID;
	private $objUser;
	private $arResponse = [];

	public function executeComponent()
	{
		Loc::loadMessages(__FILE__);

		$this->arResult["PARAMS_HASH"] = md5(serialize($this->arParams).$this->GetTemplateName());

		$this->arRequest = Application::getInstance()->getContext()->getRequest();

		$this->getPersonalData();

		if (
			$this->arRequest->isAjaxRequest() &&
			$this->arRequest->getPost('FLXMD_AJAX') === 'Y' &&
			$this->arRequest->getPost('PARAMS_HASH') === $this->arResult["PARAMS_HASH"]
		) {
			$this->checkFields();

			if ($this->bCheckFields)
				$this->updatePersonalData();

			if ($this->personalDataUpdate)
				$this->sendEmail();

			$this->sendResponseAjax();

		} else {

			$this->IncludeComponentTemplate();
		}
	}

	public function getPersonalData()
	{
		global $USER;

		$this->nUserID = $USER->GetID();
		$this->objUser = $USER;

		$this->arResult['USER_INFO'] = CUser::GetByID($this->nUserID)->Fetch();
	}

	public function checkFields()
	{
		if (
			$this->arRequest->getPost('PARAMS_HASH') === $this->arResult["PARAMS_HASH"] &&
			empty($this->arRequest->getPost('CHECK_EMPTY')) &&
			!empty($this->arRequest->getPost('personal-name')) &&
			!empty($this->arRequest->getPost('personal-surname')) &&
			!empty($this->arRequest->getPost('personal-email')) &&
			!empty($this->arRequest->getPost('personal-tel')) &&
			check_email($this->arRequest->getPost('personal-email')) &&
			check_bitrix_sessid()
		) {

			$this->bCheckFields = true;

		} else {

			$this->arResponse = ['STATUS' => 'ERROR', 'MESSAGE' => Loc::getMessage("FLXMD_PERSONAL_DATA_FIELDS_ERROR")];
			$this->bCheckFields = false;

		}
	}

	public function updatePersonalData()
	{
		if ( $this->objUser->Update($this->nUserID, array(
					'NAME' => htmlspecialchars($this->arRequest->getPost('personal-name')),
					'LAST_NAME' => htmlspecialchars($this->arRequest->getPost('personal-surname')),
					'WORK_COMPANY' => htmlspecialchars($this->arRequest->getPost('personal-company')),
					'WORK_POSITION' => htmlspecialchars($this->arRequest->getPost('personal-position')),
					'EMAIL' => htmlspecialchars($this->arRequest->getPost('personal-email')),
					'WORK_PHONE' => htmlspecialchars($this->arRequest->getPost('personal-tel'))
				)
			)
		)
			$this->personalDataUpdate = true;
	}

	public function sendEmail()
	{
		$arFields = array(
			'USER_ID' => $this->nUserID,
			'NAME' => htmlspecialchars($this->arRequest->getPost('personal-name')),
			'LAST_NAME' => htmlspecialchars($this->arRequest->getPost('personal-surname')),
			'WORK_COMPANY' => htmlspecialchars($this->arRequest->getPost('personal-company')),
			'WORK_POSITION' => htmlspecialchars($this->arRequest->getPost('personal-position')),
			'EMAIL' => htmlspecialchars($this->arRequest->getPost('personal-email')),
			'WORK_PHONE' => htmlspecialchars($this->arRequest->getPost('personal-tel'))
		);

		if (CEvent::Send("USER_UPDATE_PERSONAL_DATA", SITE_ID, $arFields)) {
			$this->arResponse = ['STATUS' => 'SUCCESS'];
		} else {
			$this->arResponse = ['STATUS' => 'ERROR', 'MESSAGE' => Loc::getMessage("FLXMD_PERSONAL_DATA_MAIL_ERROR")];
		}
	}

	public function sendResponseAjax() {

		global $APPLICATION;

		$APPLICATION->RestartBuffer();

		echo json_encode($this->arResponse);

		die();

	}

}
