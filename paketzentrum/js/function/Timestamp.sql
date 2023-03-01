SELECT AVG(DATEDIFF(STR_TO_DATE(Datum_Versendung, '%d.%m.%Y'), STR_TO_DATE(Datum_Wareneingang, '%d.%m.%Y'))) FROM versendungen WHERE STR_TO_DATE(Datum_Wareneingang, '%d.%m.%Y') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND Status_Versendung = '1' AND Status_Wareneingang = '1'; 


SELECT AVG(DATEDIFF(STR_TO_DATE(Datum_Versendung, '%d.%m.%Y'), STR_TO_DATE(Datum_Wareneingang, '%d.%m.%Y'))) FROM versendungen WHERE Status_Versendung = '1' AND Status_Wareneingang = '1'; 

SELECT referenznr, STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s') FROM versendungen;

SELECT DATEDIFF(STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s')) FROM versendungen WHERE Status_Versendung = '1' AND Status_Wareneingang = '1'; 

SELECT CONCAT(Datum_Versendung, Zeit_Versendung), CONCAT(Datum_Wareneingang, Zeit_Wareneingang), DATEDIFF(STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s')) FROM versendungen WHERE Status_Versendung = '1' AND Status_Wareneingang = '1'; 

SELECT CONCAT(Datum_Versendung, Zeit_Versendung), CONCAT(Datum_Wareneingang, Zeit_Wareneingang), TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s')) FROM versendungen WHERE Status_Versendung = '1' AND Status_Wareneingang = '1'; 

SELECT CONCAT(Datum_Versendung, Zeit_Versendung), CONCAT(Datum_Wareneingang, Zeit_Wareneingang), TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s'))/86400 FROM versendungen WHERE Status_Versendung = '1' AND Status_Wareneingang = '1'; 
STR_TO_DATE(Datum_Wareneingang, '%d.%m.%Y') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND Status_Versendung = '1' AND Status_Wareneingang = '1';

SELECT CONCAT(Datum_Versendung, Zeit_Versendung), CONCAT(Datum_Wareneingang, Zeit_Wareneingang), TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s'))/86400 FROM versendungen WHERE STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND Status_Versendung = '1' AND Status_Wareneingang = '1';

SELECT AVG(TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s')))/86400 FROM versendungen WHERE STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s') BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND Status_Versendung = '1' AND Status_Wareneingang = '1';