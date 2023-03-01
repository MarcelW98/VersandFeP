<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/storagefep" . "/database/auftrag_service.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/storagefep" . "/database/user_service.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/storagefep" . "/auth/authguard.php");

AuthGuard::getInstance()->protect(UserType::KUNDE);
$loggedInUser = UserService::getInstance()->getLoggedInUser();

$auftragEinlagerungService = AuftragService::getInstance();
$result = $auftragEinlagerungService->findByKostenstelleAndOffen($loggedInUser->id, $loggedInUser->lager_anlieferadresse_id);

?>


<table id="Einlagerauftraege" class="table table-bordered table-hover table-striped pre-wrap" style="table-layout: fluid">
    <thead>
        <tr>
            <th>ID</th>
            <th>Referenznummer</th>
            <th>NT-User<br>Ersteller</th>
            <th>NT-User<br>Auftraggeber</th>
            <th>Bezeichnung</th>
            <th>Lagereinheit</th>
            <th>Bild</th>
            <th>Erstellt am</th>
            <th>Waren-<br>begleitschein</th>
            <th>Beförderungs-<br>auftrag</th>
            <th>Storno</th>
        </tr>
    </thead>

    <?php if (is_array($result)) : ?>
        <?php foreach ($result as &$auftrag) : ?>
            <tr>
                <td><?= $auftrag->id ?></td>
                <td><?= $auftrag->refNr ?></td>
                <td><?= $auftrag->realUser ?></td>
                <td><?= $auftrag->kndUser ?></td>
                <td style="width:15%;"><?php $zusatzinfo = str_replace(array("\r\n", "\n", '"', "'"), " ", $auftrag->information);
                                        if (!empty($auftrag->information)) { ?><a href='javascript:' onclick="openModal({'information': '<?= $zusatzinfo ?>'})"><?= $auftrag->bezeichnung ?></a><?php } else { ?> <span><?= $auftrag->bezeichnung ?></span> <?php } ?></td>
                <td><?= $auftrag->lagereinheit ?></td>
                <td style="width:6%;"><?php if (!empty($auftrag->bild)) { ?><a href='javascript:' onclick="pictureview('<?= $auftrag->bild ?>')">Bild</a><?php } else { ?> <span>Kein Bild</span> <?php } ?></td>
                <td><?= date('d.m.Y - H:i:s', $auftrag->erstellt_am) ?></td>
                <td><a data-toggle="tooltip" title="Warenbegleitschein Einlagerauftrag" href="auftragEinlagerungBegleitschein.php?id=<?= $auftrag->id ?>" target="_blank"><img src="assets/icons/document-pdf.svg" alt="Begleitschein" width="40" height="40"></a></td>
                <?php if (!empty($auftrag->befoerderungsauftrag)) : ?>
                    <td><a data-toggle="tooltip" title="Beförderungsauftrag Einlagerauftrag" href="auftragEinlagerungBefoederung.php?id=<?= $auftrag->id ?>" target="_blank"><img src="assets/icons/document-pdf.svg" alt="Beförderungsauftrag" width="40" height="40"></a></td>
                <?php else : ?>
                    <td></td>
                <?php endif; ?>
                <td><a data-toggle="tooltip" title="Einlagerauftrag stornieren" href="#" onclick="deleteEinlagerungAuftragById(<?= $auftrag->id ?>)"><img src="assets/icons/eraser-red.svg" alt="Stornieren" width="40" height="40"></a></td>
            </tr>
        <?php endforeach ?>
    <?php endif; ?>
</table>