<script language="javascript" type="text/javascript">
    function pflichtfelder() {

        var fahrerInput = document.getElementById("fahrerInput");
        var kennezeichenInput = document.getElementById("kennezeichenInput");
        var speditionInput = document.getElementById("speditionInput");

        if (fahrerInput.value == "") {
            fahrerInput.setAttribute("style", "border-color: red;");
        } else {
            fahrerInput.setAttribute("style", "border-color: #ced4da;");
        }


        if (kennezeichenInput.value == "") {
            kennezeichenInput.setAttribute("style", "border-color: red;");
        } else {
            kennezeichenInput.setAttribute("style", "border-color: #ced4da;");
        }

        if (speditionInput.value == "") {
            speditionInput.setAttribute("style", "border-color: red;");
        } else {
            speditionInput.setAttribute("style", "border-color: #ced4da;");
        }

        if (fahrerInput.value != "" && kennezeichenInput.value != "" && speditionInput.value != "") {
            sendform();
        }

    }


    function sendform() {
        console.log("jishfj");


        var form = $("#fahrerdataform")
        var actionUrl = form.attr('action');


        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data) {
                $('#exampleModal').modal('show');
                window.setTimeout("modalclose()", 5000);
            }
        });
    };

    function modalclose() {
        $('#exampleModal').modal('hide');
        zuruecksetzen();
        window.location.reload();
    }

    function hilfeModal() {
        $('#exampleModal2').modal('show');
    }

    window.onload = function() {
        datum();
    };

    window.setInterval("datum()", 10000);

    function datum() {
        let date = new Date();
        var zeit = new Date();
        var stunde = (zeit.getDay() < 10 ? '0' + zeit.getDate() : zeit.getHours());
        var stunde = (zeit.getHours() < 10 ? '0' + zeit.getHours() : zeit.getHours());
        var minute = (zeit.getMinutes() < 10 ? '0' + zeit.getMinutes() : zeit.getMinutes());
        var sekunde = (zeit.getSeconds() < 10 ? '0' + zeit.getSeconds() : zeit.getSeconds());
        document.getElementById("zeit").innerHTML = ' ' + (date.toLocaleDateString()) + ' ' + stunde + ':' + minute;
        document.getElementById("zeitForm").value = ' ' + (date.toLocaleDateString()) + ' ' + stunde + ':' + minute;

    }

    function zuruecksetzen() {
        document.getElementById("kennezeichenInput").value = "";
        document.getElementById("speditionInput").value = "";
        document.getElementById("fahrerInput").value = "";
        document.getElementById("kennezeichenInput").value = "";
        document.getElementById("bologInput").value = "";
        document.getElementById("flexCheckChecked").checked = false;
    };

    function deutsch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Fahreranmeldung</b>";
        document.getElementById("infoText").innerHTML = "Um die Verladung antreten zu können, müssen Sie sich mit dem untenstehenden Formular anmelden. Danach werden Sie zeitnah von uns aufgerufen.";
        document.getElementById("basic-addon1").innerHTML = "<b>Anmeldung Uhrzeit:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Kennzeichen:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Spedition:&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Name Fahrer:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>Referenznummer (BOLOG):</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Sonderfahrt:</b>";
        document.getElementById("buttonHilfe").innerHTML = "Hilfe";
        document.getElementById("buttonAnmelden").innerHTML = "Anmelden";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Zurücksetzen";
        document.getElementById("exampleModalLabel").innerHTML = "Anmeldung bestätigt";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Um die Ware abholen zu können benötigen Sie eine aktuelle Referenznummer (BOLOG NR). <br><br> - Bitte wenden Sie sich an Ihren Arbeitgeber, dieser hat eine gültige Referenznummer von uns erhalten.";
      

    };

    function englisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Driver registration</b>";
        document.getElementById("infoText").innerHTML = "In order to be able to start loading, you must register using the form below. You will be called promptly by us.";
        document.getElementById("basic-addon1").innerHTML = "<b>Registration time:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>License plate:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Shipping agency:&nbsp</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Driver name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>Reference number (BOLOG):</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Special permit:</b>";
        document.getElementById("buttonHilfe").innerHTML = "Help";
        document.getElementById("buttonAnmelden").innerHTML = "Register";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Reset";
        document.getElementById("exampleModalLabel").innerHTML = "Registration confirmed";
        document.getElementById("modalLabelBOLOG").innerHTML = "- In order to be able to pick up the goods, you need a current reference number (BOLOG NR). <br><br> - Please contact your employer, who has received a valid reference number from us.";

    };

    function ungarisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Sofőr regisztráció</b>";
        document.getElementById("infoText").innerHTML = "Ahhoz, hogy elkezdhesse a betöltést, regisztrálnia kell az alábbi űrlapon. Ezután időben fel fogjuk hívni Önt.";
        document.getElementById("basic-addon1").innerHTML = "<b>Regisztráció ideje:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Rendszámtábla:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Hordozó:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Meghajtó neve:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Külön engedély:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>Referenciaszám (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Segítség";
        document.getElementById("buttonAnmelden").innerHTML = "Regisztráció";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Törlés";
        document.getElementById("exampleModalLabel").innerHTML = "Regisztráció megerősítve";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Ahhoz, hogy az árut át ​​tudja venni, szüksége van egy aktuális hivatkozási számra (BOLOG NR). <br><br> - Kérjük, forduljon munkáltatójához, aki érvényes hivatkozási számot kapott tőlünk.";

    };

    function tschechisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Registrace řidiče</b>";
        document.getElementById("infoText").innerHTML = "Abyste mohli začít načítat, musíte se zaregistrovat pomocí formuláře níže. Poté vám budeme obratem zavoláni.";
        document.getElementById("basic-addon1").innerHTML = "<b>Čas registrace:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Poznávací značka:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Dopravu:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Jméno řidiče:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Speciální jízda:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>referenční číslo (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Pomoc";
        document.getElementById("buttonAnmelden").innerHTML = "Register";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Reset";
        document.getElementById("exampleModalLabel").innerHTML = "Registrace potvrzena";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Abyste si mohli zboží vyzvednout, potřebujete aktuální referenční číslo (BOLOG NR). <br><br> - Kontaktujte svého zaměstnavatele, který od nás obdržel platné referenční číslo.";

    };

    function spanisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Registro de conductor</b>";
        document.getElementById("infoText").innerHTML = "Para poder comenzar a cargar, debe registrarse utilizando el formulario a continuación. A continuación, será llamado de inmediato por nosotros.";
        document.getElementById("basic-addon1").innerHTML = "<b>Tiempo de registro:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Placa:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Transportador:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Apellido conductor:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Permiso especial:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>número de referencia (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Ayuda";
        document.getElementById("buttonAnmelden").innerHTML = "Registro";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Borrar ";
        document.getElementById("exampleModalLabel").innerHTML = "Registro confirmado";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Para poder recoger la mercancía, necesita un número de referencia actual (BOLOG NR). <br><br> - Póngase en contacto con su empleador, que ha recibido un número de referencia válido de nosotros.";

    };

    function französisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Inscription le conducteur </b>";
        document.getElementById("infoText").innerHTML = "Afin de pouvoir commencer le chargement, vous devez vous inscrire en utilisant le formulaire ci-dessous. Vous serez alors rapidement appelé par nos soins.";
        document.getElementById("basic-addon1").innerHTML = "<b>Inscription temps:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Plaque d'immatriculation:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Transporteur:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nom d'un conducteur:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Autorisation spéciale:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numéro de réference (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Aider";
        document.getElementById("buttonAnmelden").innerHTML = "Inscription";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Dégager";
        document.getElementById("exampleModalLabel").innerHTML = "Inscription confirmée";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Afin de pouvoir retirer la marchandise, vous avez besoin d'un numéro de référence actuel (BOLOG NR). <br><br> - Veuillez contacter votre employeur, qui a reçu un numéro de référence valide de notre part.";

    };

    function griechisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>εγγραφή αυτοκινητιστής</b>";
        document.getElementById("infoText").innerHTML = "Για να μπορέσετε να ξεκινήσετε τη φόρτωση, πρέπει να εγγραφείτε χρησιμοποιώντας την παρακάτω φόρμα. Στη συνέχεια, θα σας καλέσουμε αμέσως.";
        document.getElementById("basic-addon1").innerHTML = "<b>εγγραφή χρόνος:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>πινακίδα κυκλοφορίας:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>φορέας:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Επώνυμο αυτοκινητιστής:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>ειδική άδεια:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>αριθμός αναφοράς (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Βοήθεια";
        document.getElementById("buttonAnmelden").innerHTML = "εγγραφή";
        document.getElementById("buttonZuruecksetzen").innerHTML = "διαγραφή";
        document.getElementById("exampleModalLabel").innerHTML = "Η εγγραφή επιβεβαιώθηκε";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Για να μπορέσετε να παραλάβετε τα εμπορεύματα, χρειάζεστε έναν τρέχοντα αριθμό αναφοράς (BOLOG NR). <br><br> - Επικοινωνήστε με τον εργοδότη σας, ο οποίος έχει λάβει έναν έγκυρο αριθμό αναφοράς από εμάς.";

    };

    function russisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Регистрация водителя</b>";
        document.getElementById("infoText").innerHTML = "Для того чтобы начать загрузку, необходимо зарегистрироваться, используя форму ниже. После этого мы позвоним вам как можно скорее.";
        document.getElementById("basic-addon1").innerHTML = "<b>Время регистрации</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>имя водителя</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Отметка</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>перевозчик</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>специальное разрешение</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>ссылочный номер (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Помощь";
        document.getElementById("buttonAnmelden").innerHTML = "регистр";
        document.getElementById("buttonZuruecksetzen").innerHTML = "прервать";
        document.getElementById("exampleModalLabel").innerHTML = "Вход подтвержден";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Чтобы иметь возможность забрать товар, вам нужен текущий ссылочный номер (BOLOG NR). <br><br> - Пожалуйста, свяжитесь с вашим работодателем, который получил от нас действительный ссылочный номер.";

    };

    function italienisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Autista Registrazione</b>";
        document.getElementById("infoText").innerHTML = "Per poter iniziare a caricare è necessario registrarsi utilizzando il modulo sottostante. Verrai quindi prontamente chiamato da noi.";
        document.getElementById("basic-addon1").innerHTML = "<b>Registrazione Tempo:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Numero di targa:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Azienda di trasporti:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nome Autista:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Speciale approvato:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numero di riferimento (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Aiuto";
        document.getElementById("buttonAnmelden").innerHTML = "Registrazione";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Cancellare";
        document.getElementById("exampleModalLabel").innerHTML = "Iscrizione confermata";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Per poter ritirare la merce è necessario un numero di riferimento aggiornato (BOLOG NR). <br><br> - Si prega di contattare il proprio datore di lavoro, che ha ricevuto da noi un numero di riferimento valido.";

    };

    function polnisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Rejestracja  kierowca</b>";
        document.getElementById("infoText").innerHTML = "Aby móc rozpocząć ładowanie, należy zarejestrować się za pomocą poniższego formularza. Następnie zostaniesz przez nas niezwłocznie wezwany.";
        document.getElementById("basic-addon1").innerHTML = "<b>Rejestracja Czas:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Tablica rejestracyjna:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Spedycja:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nazwa Kierowca:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Upoważnienie specjalne:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numer referencyjny (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Pomoc";
        document.getElementById("buttonAnmelden").innerHTML = "Rejestracja";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Usuń";
        document.getElementById("exampleModalLabel").innerHTML = "Rejestracja potwierdzona";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Aby móc odebrać towar potrzebny jest aktualny numer referencyjny (BOLOG NR). <br><br> - Skontaktuj się ze swoim pracodawcą, który otrzymał od nas ważny numer referencyjny.";
    };

    function türkisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Sürücü Kayıt</b>";
        document.getElementById("infoText").innerHTML = "Yüklemeye başlayabilmek için aşağıdaki formu kullanarak kayıt olmalısınız. Daha sonra derhal tarafımızca aranacaksınız.";
        document.getElementById("basic-addon1").innerHTML = "<b>Sürücü Zaman:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Numara plakası:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Nakli̇ye şi̇rketi̇:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Isim sürücü:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Özel izin:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>referans numarası (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Yardım";
        document.getElementById("buttonAnmelden").innerHTML = "Kayıt";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Silme";
        document.getElementById("exampleModalLabel").innerHTML = "Kayıt onaylandı";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Malları teslim alabilmek için güncel bir referans numarasına (BOLOG NR) ihtiyacınız vardır. <br><br> - Lütfen bizden geçerli bir referans numarası almış olan işvereninizle iletişime geçin.";

    };

    function rumänisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Înregistrare Șofer</b>";
        document.getElementById("infoText").innerHTML = "Pentru a putea începe încărcarea, trebuie să vă înregistrați folosind formularul de mai jos. Veți fi apoi sunat imediat de noi.";
        document.getElementById("basic-addon1").innerHTML = "<b>Înregistrare Timp:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Număr de înmatriculare auto:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Companie de transport:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nume Șofer:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Aprobare specială:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numar de referinta (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Ajutor";
        document.getElementById("buttonAnmelden").innerHTML = "Autentificare";
        document.getElementById("buttonZuruecksetzen").innerHTML = "șterge";
        document.getElementById("exampleModalLabel").innerHTML = "Înregistrarea confirmată";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Pentru a putea ridica marfa ai nevoie de un numar de referinta actual (BOLOG NR). <br><br> - Vă rugăm să contactați angajatorul dvs., care a primit un număr de referință valid de la noi.";

    };
</script>