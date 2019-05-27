<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<div class="personal__block anim-fadein">

	<h2 class="personal__title">
		<?= Loc::getMessage('PERSONAL_DATA_TITLE'); ?>
	</h2>

	<form class="form personal__form personal__form--data js-validate js-validate-disabled" id="personal-form" action="<?=POST_FORM_ACTION_URI;?>" method="post" autocomplete="off" data-modal-success="personal-success">

		<?=bitrix_sessid_post();?>

		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>" />
		<input type="hidden" name="FLXMD_AJAX" value="Y" />
		<input type="hidden" name="CHECK_EMPTY" value="" />

		<div class="form__message js-error-container"></div>

		<div class="form__row">

			<div class="form__item" id="personal-name-item">
				<label class="form__label" for="personal-name">
					<?= Loc::getMessage('PERSONAL_DATA_NAME'); ?>
				</label>
				<input
					class="input"
					id="personal-name"
					type="text"
					name="personal-name"
					value="<?=$arResult['USER_INFO']['NAME'];?>"
					required
					placeholder="<?=$arResult['USER_INFO']['NAME'];?>"
					data-required-message="<?= Loc::getMessage('PERSONAL_DATA_REQUIRED_FIELD'); ?>"
					data-error-message="<?= Loc::getMessage('PERSONAL_DATA_NAME_ERROR'); ?>"
					data-error-target="#personal-name-item"
				/>
			</div>

			<div class="form__item" id="personal-surname-item">
				<label class="form__label" for="personal-surname">
					<?= Loc::getMessage('PERSONAL_DATA_SURNAME'); ?>
				</label>
				<input
					class="input"
					id="personal-surname"
					type="text"
					name="personal-surname"
					value="<?=$arResult['USER_INFO']['LAST_NAME'];?>"
					required
					placeholder="<?=$arResult['USER_INFO']['LAST_NAME'];?>"
					data-required-message="<?= Loc::getMessage('PERSONAL_DATA_REQUIRED_FIELD'); ?>"
					data-error-message="<?= Loc::getMessage('PERSONAL_DATA_SURNAME_ERROR'); ?>"
					data-error-target="#personal-surname-item"
				/>
			</div>

		</div>

		<div class="form__row">

			<div class="form__item" id="personal-company-item">
				<label class="form__label" for="personal-company">
					<?= Loc::getMessage('PERSONAL_DATA_WORK_COMPANY'); ?>
				</label>
				<input
					class="input"
					id="personal-company"
					type="text"
					name="personal-company"
					value="<?=$arResult['USER_INFO']['WORK_COMPANY'];?>"
					placeholder="<?= Loc::getMessage('PERSONAL_DATA_WORK_COMPANY_PLACEHOLDER'); ?>"
				/>
			</div>

			<div class="form__item" id="personal-position-item">
				<label class="form__label" for="personal-position">
					<?= Loc::getMessage('PERSONAL_DATA_WORK_POSITION'); ?>
				</label>
				<input
					class="input"
					id="personal-position"
					type="text"
					name="personal-position"
					value="<?=$arResult['USER_INFO']['WORK_POSITION'];?>"
					placeholder="<?= Loc::getMessage('PERSONAL_DATA_WORK_POSITION_PLACEHOLDER'); ?>"
				/>
			</div>

		</div>

		<div class="form__row">

			<div class="form__item" id="personal-email-item">
				<label class="form__label" for="personal-email">
					<?= Loc::getMessage('PERSONAL_DATA_EMAIL'); ?>
				</label>
				<input
					class="input"
					id="personal-email"
					type="email"
					name="personal-email"
					required
					value="<?=$arResult['USER_INFO']['EMAIL'];?>"
					placeholder="<?=$arResult['USER_INFO']['EMAIL'];?>"
					data-required-message="<?= Loc::getMessage('PERSONAL_DATA_REQUIRED_FIELD'); ?>"
					data-error-message="<?= Loc::getMessage('PERSONAL_DATA_EMAIL_ERROR'); ?>"
					data-error-target="#personal-email-item"
				/>
			</div>

			<div class="form__item form__item--short" id="personal-tel-item">
				<label class="form__label" for="personal-tel">
					<?= Loc::getMessage('PERSONAL_DATA_PHONE'); ?>
				</label>
				<input
					class="input"
					id="personal-tel"
					type="tel"
					name="personal-tel"
					required
					value="<?=$arResult['USER_INFO']['WORK_PHONE'];?>"
					placeholder="<?=$arResult['USER_INFO']['WORK_PHONE'];?>"
					data-required-message="<?= Loc::getMessage('PERSONAL_DATA_REQUIRED_FIELD'); ?>"
					data-error-message="<?= Loc::getMessage('PERSONAL_DATA_PHONE_ERROR'); ?>"
					data-error-target="#personal-tel-item"
				/>
			</div>

		</div>

		<div class="form__row form__row--end">
			<div class="form__item">
				<button class="btn btn--big form__btn personal__submit" type="submit">
					<?= Loc::getMessage('PERSONAL_DATA_SAVE'); ?>
				</button>
			</div>
		</div>

	</form>
</div>
