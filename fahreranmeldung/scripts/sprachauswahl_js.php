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
        document.getElementById("infoText").innerHTML = "Um die Verladung antreten zu k??nnen, m??ssen Sie sich mit dem untenstehenden Formular anmelden. Danach werden Sie zeitnah von uns aufgerufen.";
        document.getElementById("basic-addon1").innerHTML = "<b>Anmeldung Uhrzeit:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Kennzeichen:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Spedition:&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Name Fahrer:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>Referenznummer (BOLOG):</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Sonderfahrt:</b>";
        document.getElementById("buttonHilfe").innerHTML = "Hilfe";
        document.getElementById("buttonAnmelden").innerHTML = "Anmelden";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Zur??cksetzen";
        document.getElementById("exampleModalLabel").innerHTML = "Anmeldung best??tigt";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Um die Ware abholen zu k??nnen ben??tigen Sie eine aktuelle Referenznummer (BOLOG NR). <br><br> - Bitte wenden Sie sich an Ihren Arbeitgeber, dieser hat eine g??ltige Referenznummer von uns erhalten.";
      

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
        document.getElementById("ueberschrift").innerHTML = "<b>Sof??r regisztr??ci??</b>";
        document.getElementById("infoText").innerHTML = "Ahhoz, hogy elkezdhesse a bet??lt??st, regisztr??lnia kell az al??bbi ??rlapon. Ezut??n id??ben fel fogjuk h??vni ??nt.";
        document.getElementById("basic-addon1").innerHTML = "<b>Regisztr??ci?? ideje:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Rendsz??mt??bla:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Hordoz??:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Meghajt?? neve:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>K??l??n enged??ly:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>Referenciasz??m (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Seg??ts??g";
        document.getElementById("buttonAnmelden").innerHTML = "Regisztr??ci??";
        document.getElementById("buttonZuruecksetzen").innerHTML = "T??rl??s";
        document.getElementById("exampleModalLabel").innerHTML = "Regisztr??ci?? meger??s??tve";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Ahhoz, hogy az ??rut ??t ??????tudja venni, sz??ks??ge van egy aktu??lis hivatkoz??si sz??mra (BOLOG NR). <br><br> - K??rj??k, forduljon munk??ltat??j??hoz, aki ??rv??nyes hivatkoz??si sz??mot kapott t??l??nk.";

    };

    function tschechisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Registrace ??idi??e</b>";
        document.getElementById("infoText").innerHTML = "Abyste mohli za????t na????tat, mus??te se zaregistrovat pomoc?? formul????e n????e. Pot?? v??m budeme obratem zavol??ni.";
        document.getElementById("basic-addon1").innerHTML = "<b>??as registrace:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Pozn??vac?? zna??ka:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Dopravu:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Jm??no ??idi??e:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Speci??ln?? j??zda:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>referen??n?? ????slo (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Pomoc";
        document.getElementById("buttonAnmelden").innerHTML = "Register";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Reset";
        document.getElementById("exampleModalLabel").innerHTML = "Registrace potvrzena";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Abyste si mohli zbo???? vyzvednout, pot??ebujete aktu??ln?? referen??n?? ????slo (BOLOG NR). <br><br> - Kontaktujte sv??ho zam??stnavatele, kter?? od n??s obdr??el platn?? referen??n?? ????slo.";

    };

    function spanisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Registro de conductor</b>";
        document.getElementById("infoText").innerHTML = "Para poder comenzar a cargar, debe registrarse utilizando el formulario a continuaci??n. A continuaci??n, ser?? llamado de inmediato por nosotros.";
        document.getElementById("basic-addon1").innerHTML = "<b>Tiempo de registro:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Placa:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Transportador:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Apellido conductor:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Permiso especial:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>n??mero de referencia (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Ayuda";
        document.getElementById("buttonAnmelden").innerHTML = "Registro";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Borrar ";
        document.getElementById("exampleModalLabel").innerHTML = "Registro confirmado";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Para poder recoger la mercanc??a, necesita un n??mero de referencia actual (BOLOG NR). <br><br> - P??ngase en contacto con su empleador, que ha recibido un n??mero de referencia v??lido de nosotros.";

    };

    function franz??sisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Inscription le conducteur </b>";
        document.getElementById("infoText").innerHTML = "Afin de pouvoir commencer le chargement, vous devez vous inscrire en utilisant le formulaire ci-dessous. Vous serez alors rapidement appel?? par nos soins.";
        document.getElementById("basic-addon1").innerHTML = "<b>Inscription temps:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Plaque d'immatriculation:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Transporteur:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nom d'un conducteur:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Autorisation sp??ciale:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>num??ro de r??ference (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Aider";
        document.getElementById("buttonAnmelden").innerHTML = "Inscription";
        document.getElementById("buttonZuruecksetzen").innerHTML = "D??gager";
        document.getElementById("exampleModalLabel").innerHTML = "Inscription confirm??e";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Afin de pouvoir retirer la marchandise, vous avez besoin d'un num??ro de r??f??rence actuel (BOLOG NR). <br><br> - Veuillez contacter votre employeur, qui a re??u un num??ro de r??f??rence valide de notre part.";

    };

    function griechisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>?????????????? ????????????????????????????</b>";
        document.getElementById("infoText").innerHTML = "?????? ???? ?????????????????? ???? ???????????????????? ???? ??????????????, ???????????? ???? ???????????????????? ?????????????????????????????? ?????? ???????????????? ??????????. ?????? ????????????????, ???? ?????? ?????????????????? ????????????.";
        document.getElementById("basic-addon1").innerHTML = "<b>?????????????? ????????????:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>???????????????? ??????????????????????:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>????????????:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>?????????????? ????????????????????????????:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>???????????? ??????????:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>?????????????? ???????????????? (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "??????????????";
        document.getElementById("buttonAnmelden").innerHTML = "??????????????";
        document.getElementById("buttonZuruecksetzen").innerHTML = "????????????????";
        document.getElementById("exampleModalLabel").innerHTML = "?? ?????????????? ??????????????????????????";
        document.getElementById("modalLabelBOLOG").innerHTML = "- ?????? ???? ?????????????????? ???? ???????????????????? ???? ??????????????????????, ???????????????????? ???????? ???????????????? ???????????? ???????????????? (BOLOG NR). <br><br> - ?????????????????????????? ???? ?????? ???????????????? ??????, ?? ???????????? ???????? ?????????? ???????? ???????????? ???????????? ???????????????? ?????? ????????.";

    };

    function russisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>?????????????????????? ????????????????</b>";
        document.getElementById("infoText").innerHTML = "?????? ???????? ?????????? ???????????? ????????????????, ???????????????????? ????????????????????????????????????, ?????????????????? ?????????? ????????. ?????????? ?????????? ???? ???????????????? ?????? ?????? ?????????? ????????????.";
        document.getElementById("basic-addon1").innerHTML = "<b>?????????? ??????????????????????</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>?????? ????????????????</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>??????????????</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>????????????????????</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>?????????????????????? ????????????????????</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>?????????????????? ?????????? (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "????????????";
        document.getElementById("buttonAnmelden").innerHTML = "??????????????";
        document.getElementById("buttonZuruecksetzen").innerHTML = "????????????????";
        document.getElementById("exampleModalLabel").innerHTML = "???????? ??????????????????????";
        document.getElementById("modalLabelBOLOG").innerHTML = "- ?????????? ?????????? ?????????????????????? ?????????????? ??????????, ?????? ?????????? ?????????????? ?????????????????? ?????????? (BOLOG NR). <br><br> - ????????????????????, ?????????????????? ?? ?????????? ??????????????????????????, ?????????????? ?????????????? ???? ?????? ???????????????????????????? ?????????????????? ??????????.";

    };

    function italienisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Autista Registrazione</b>";
        document.getElementById("infoText").innerHTML = "Per poter iniziare a caricare ?? necessario registrarsi utilizzando il modulo sottostante. Verrai quindi prontamente chiamato da noi.";
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
        document.getElementById("modalLabelBOLOG").innerHTML = "- Per poter ritirare la merce ?? necessario un numero di riferimento aggiornato (BOLOG NR). <br><br> - Si prega di contattare il proprio datore di lavoro, che ha ricevuto da noi un numero di riferimento valido.";

    };

    function polnisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>Rejestracja  kierowca</b>";
        document.getElementById("infoText").innerHTML = "Aby m??c rozpocz???? ??adowanie, nale??y zarejestrowa?? si?? za pomoc?? poni??szego formularza. Nast??pnie zostaniesz przez nas niezw??ocznie wezwany.";
        document.getElementById("basic-addon1").innerHTML = "<b>Rejestracja Czas:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Tablica rejestracyjna:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Spedycja:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nazwa Kierowca:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Upowa??nienie specjalne:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numer referencyjny (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Pomoc";
        document.getElementById("buttonAnmelden").innerHTML = "Rejestracja";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Usu??";
        document.getElementById("exampleModalLabel").innerHTML = "Rejestracja potwierdzona";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Aby m??c odebra?? towar potrzebny jest aktualny numer referencyjny (BOLOG NR). <br><br> - Skontaktuj si?? ze swoim pracodawc??, kt??ry otrzyma?? od nas wa??ny numer referencyjny.";
    };

    function t??rkisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>S??r??c?? Kay??t</b>";
        document.getElementById("infoText").innerHTML = "Y??klemeye ba??layabilmek i??in a??a????daki formu kullanarak kay??t olmal??s??n??z. Daha sonra derhal taraf??m??zca aranacaks??n??z.";
        document.getElementById("basic-addon1").innerHTML = "<b>S??r??c?? Zaman:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Numara plakas??:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Nakli??ye ??i??rketi??:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Isim s??r??c??:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>??zel izin:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>referans numaras?? (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Yard??m";
        document.getElementById("buttonAnmelden").innerHTML = "Kay??t";
        document.getElementById("buttonZuruecksetzen").innerHTML = "Silme";
        document.getElementById("exampleModalLabel").innerHTML = "Kay??t onayland??";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Mallar?? teslim alabilmek i??in g??ncel bir referans numaras??na (BOLOG NR) ihtiyac??n??z vard??r. <br><br> - L??tfen bizden ge??erli bir referans numaras?? alm???? olan i??vereninizle ileti??ime ge??in.";

    };

    function rum??nisch() {
        document.getElementById("ueberschrift").innerHTML = "<b>??nregistrare ??ofer</b>";
        document.getElementById("infoText").innerHTML = "Pentru a putea ??ncepe ??nc??rcarea, trebuie s?? v?? ??nregistra??i folosind formularul de mai jos. Ve??i fi apoi sunat imediat de noi.";
        document.getElementById("basic-addon1").innerHTML = "<b>??nregistrare Timp:</b>";
        document.getElementById("basic-addon2").innerHTML = "<b>Num??r de ??nmatriculare auto:</b>";
        document.getElementById("basic-addon3").innerHTML = "<b>Companie de transport:</b>";
        document.getElementById("basic-addon4").innerHTML = "<b>Nume ??ofer:</b>";
        document.getElementById("basic-addon5").innerHTML = "<b>Aprobare special??:</b>";
        document.getElementById("basic-addon6").innerHTML = "<b>numar de referinta (BOLOG):</b>";
        document.getElementById("buttonHilfe").innerHTML = "Ajutor";
        document.getElementById("buttonAnmelden").innerHTML = "Autentificare";
        document.getElementById("buttonZuruecksetzen").innerHTML = "??terge";
        document.getElementById("exampleModalLabel").innerHTML = "??nregistrarea confirmat??";
        document.getElementById("modalLabelBOLOG").innerHTML = "- Pentru a putea ridica marfa ai nevoie de un numar de referinta actual (BOLOG NR). <br><br> - V?? rug??m s?? contacta??i angajatorul dvs., care a primit un num??r de referin???? valid de la noi.";

    };
</script>