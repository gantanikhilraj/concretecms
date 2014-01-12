<?
/*

if ($_POST['task'] == 'approve_version' && $fp->canEditFileProperties() && (!$previewMode)) {
	$fv->approve();
	exit;
}

if ($_POST['task'] == 'delete_version' && $fp->canEditFileContents() && (!$previewMode)) {
	$fv->delete();
	exit;
}

if ($_POST['task'] == 'update_extended_attribute' && $fp->canEditFileProperties() && (!$previewMode)) {
	$fv = $f->getVersionToModify();
	$fakID = $_REQUEST['fakID'];
	$value = '';
	$ak = FileAttributeKey::get($fakID);
	$ak->saveAttributeForm($fv);
	
	$val = $fv->getAttributeValueObject($ak);
	print $val->getValue('displaySanitized');
	exit;
}

if ($_POST['task'] == 'clear_extended_attribute' && $fp->canEditFileProperties() && (!$previewMode)) {
	$fv = $f->getVersionToModify();
	$fakID = $_REQUEST['fakID'];
	$value = '';
	$ak = FileAttributeKey::get($fakID);
	$fv->clearAttribute($ak);
	
	$val = $fv->getAttributeValueObject($ak);
	print '<div class="ccm-attribute-field-none">' . t('None') . '</div>';
	exit;
}


function printFileAttributeRow($ak, $fv) {
	global $previewMode, $f, $fp;
	$vo = $fv->getAttributeValueObject($ak);
	$value = '';
	if (is_object($vo)) {
		$value = $vo->getValue('displaySanitized');
	}
	
	if ($value == '') {
		$text = '<div class="ccm-attribute-field-none">' . t('None') . '</div>';
	} else {
		$text = $value;
	}
	if ($ak->isAttributeKeyEditable() && $fp->canEditFileProperties() && (!$previewMode)) { 
	$type = $ak->getAttributeType();
	
	$html = '
	<tr class="ccm-attribute-editable-field">
		<td><strong><a href="javascript:void(0)">' . tc('AttributeKeyName', $ak->getAttributeKeyName()) . '</a></strong></td>
		<td width="100%" class="ccm-attribute-editable-field-central"><div class="ccm-attribute-editable-field-text">' . $text . '</div>
		<form method="post" action="' . REL_DIR_FILES_TOOLS_REQUIRED . '/files/properties">
		<input type="hidden" name="fakID" value="' . $ak->getAttributeKeyID() . '" />
		<input type="hidden" name="fID" value="' . $f->getFileID() . '" />
		<input type="hidden" name="task" value="update_extended_attribute" />
		<div class="ccm-attribute-editable-field-form ccm-attribute-editable-field-type-' . strtolower($type->getAttributeTypeHandle()) . '">
		' . $ak->render('form', $vo, true) . '
		</div>
		</form>
		</td>
		<td class="ccm-attribute-editable-field-save"><a href="javascript:void(0)"><img src="' . ASSETS_URL_IMAGES . '/icons/edit_small.png" width="16" height="16" class="ccm-attribute-editable-field-save-button" /></a>
		<a href="javascript:void(0)"><img src="' . ASSETS_URL_IMAGES . '/icons/remove.png" width="16" height="16" class="ccm-attribute-editable-field-clear-button" /></a>
		<img src="' . ASSETS_URL_IMAGES . '/throbber_white_16.gif" width="16" height="16" class="ccm-attribute-editable-field-loading" />
		</td>
	</tr>';
	
	} else {

	$html = '
	<tr>
		<td><strong>' . tc('AttributeKeyName', $ak->getAttributeKeyName()) . '</strong></td>
		<td width="100%" colspan="2">' . $text . '</td>
	</tr>';	
	}
	print $html;
}


if (!isset($_REQUEST['reload'])) { ?>
	<div id="ccm-file-properties-wrapper">
<? } ?>

*/ 
?>








<? 
/*
$attribs = FileAttributeKey::getImporterList($fv);
$ft = $fv->getType();

if (count($attribs) > 0) { ?>

<br/>

<h4><?=t('%s File Properties', $ft)?></h4>
<table border="0" cellspacing="0" cellpadding="0" class="ccm-grid">
<?

foreach($attribs as $at) {

	printFileAttributeRow($at, $fv);

}

?>
</table>
<? } ?>

<? 
$attribs = FileAttributeKey::getUserAddedList();

if (count($attribs) > 0) { ?>

<br/>

<h4><?=t('Other Properties')?></h4>
<table border="0" cellspacing="0" cellpadding="0" class="ccm-grid">
<?

foreach($attribs as $at) {

	printFileAttributeRow($at, $fv);

}

?>
</table>
<? } */ ?>

<br/>

</div>

<h4><?=t('File Preview')?></h4>

<div style="text-align: center">
<?=$fv->getThumbnail(2)?>
</div>

</div>

<? if (!$previewMode) { ?>
	
	<div class="ccm-tab-content" id="ccm-tab-content-versions">
	
		<h3><?=t('File Versions')?></h3>
	
		<table border="0" cellspacing="0" width="100%" id="ccm-file-versions-grid" class="ccm-grid" cellpadding="0">
		<tr>
			<th>&nbsp;</th>
			<th><?=t('Filename')?></th>
			<th><?=t('Title')?></th>
			<th><?=t('Comments')?></th>
			<th><?=t('Creator')?></th>
			<th><?=t('Added On')?></th>
			<? if ($fp->canEditFileContents()) { ?>
				<th>&nbsp;</th>
			<? } ?>
		</tr>
		<?
		$versions = $f->getVersionList();
		foreach($versions as $fvv) { ?>
			<tr fID="<?=$f->getFileID()?>" fvID="<?=$fvv->getFileVersionID()?>" <? if ($fvv->getFileVersionID() == $fv->getFileVersionID()) { ?> class="ccm-file-versions-grid-active" <? } ?>>
				<td style="text-align: center">
					<?=$form->radio('vlfvID', $fvv->getFileVersionID(), $fvv->getFileVersionID() == $fv->getFileVersionID())?>
				</td>
				<td width="100">
					<div style="width: 150px; word-wrap: break-word">
					<a href="<?=REL_DIR_FILES_TOOLS_REQUIRED?>/files/properties?fID=<?=$f->getFileID()?>&fvID=<?=$fvv->getFileVersionID()?>&task=preview_version" dialog-modal="false" dialog-width="630" dialog-height="450" dialog-title="<?=t('Preview File')?>" class="dialog-launch">
						<?=$fvv->getFilename()?>
					</a>
					</div>
				</td>
				<td> 
					<div style="width: 150px; word-wrap: break-word">
						<?=$fvv->getTitle()?>
					</div>
				</td>
				<td><?
					$comments = $fvv->getVersionLogComments();
					if (count($comments) > 0) {
						print t('Updated ');
	
						for ($i = 0; $i < count($comments); $i++) {
							print $comments[$i];
							if (count($comments) > ($i + 1)) {
								print ', ';
							}
						}
						
						print '.';
					}
					?>
					</td>
				<td><?=$fvv->getAuthorName()?></td>
				<td><?=$dateHelper->date(DATE_APP_FILE_VERSIONS, strtotime($fvv->getDateAdded()))?></td>
				<? if ($fp->canEditFileContents()) { ?>
					<? if ($fvv->getFileVersionID() == $fv->getFileVersionID()) { ?>
						<td>&nbsp;</td>
					<? } else { ?>
						<td><a class="ccm-file-versions-remove" href="javascript:void(0)"><?=t('Delete')?></a></td>
					<? } ?>
				<? } ?>
			</tr>	
		
		<? } ?>
		
		</table>
	
	</div>

<? } ?>

<div class="ccm-tab-content" id="ccm-tab-content-statistics">
	
	<?
	$downloadStatistics = $f->getDownloadStatistics();
	?>
	<h4><?=t('Total Downloads: %s', $f->getTotalDownloads())?></h4>
	<p><?=t('Most recent 20 downloads:')?></p>
	<table border="0" cellspacing="0" width="100%" id="ccm-file-versions-grid" class="ccm-grid" cellpadding="0">
		<tr> 
			<th><?=t('User')?></th>
			<th><?=t('Download Time')?></th>
			<th><?=t('File Version ID')?></th>
		</tr>	
		<?
		
		$downloadStatsCounter=0;
		foreach($downloadStatistics as $download){ 
			$downloadStatsCounter++;
			if($downloadStatsCounter>20) break;
			?>
		<tr>
			<td>
				<? 
				$uID=intval($download['uID']);
				if(!$uID){
					echo t('Anonymous');
				}else{ 
					$downloadUI = UserInfo::getById($uID);
					if($downloadUI instanceof UserInfo) {
						echo $downloadUI->getUserName();
					} else {
						echo t('Deleted User');
					}
				} 
				?>
			</td>
			<td><?=$dateHelper->date(DATE_APP_FILE_DOWNLOAD, strtotime($download['timestamp']))?></td>
			<td><?=intval($download['fvID'])?></td>
		</tr>
		<? } ?>
	</table>
</div>

</div>