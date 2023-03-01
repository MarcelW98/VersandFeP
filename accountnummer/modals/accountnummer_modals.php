<!-- Modal Eintarg Anlegen  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neuen Eintrag Anlegen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="accountnummer/funktion/insert_accountdata.php" id="accountForm" name="accountForm" method="post">  
      <div class="modal-body">  
      <input class="form-control" maxlength="10"  type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" name="Kundenummer" id="Kundenummer" placeholder="Kundenummer" aria-label="default input example">
     <span id="fehlermeldungKundennummer" style="color: red"></span>
      <br>
      <input class="form-control" list="datalistOptions" id="DienstleisterDataList" placeholder="Dienstleister" name="Dienstleister">
      <datalist id="datalistOptions">
      <option value="Agility">Agility</option>
      <option value="Barsan">Barsan</option>
      <option value="CEVA">CEVA</option>
      <option value="Cosco">Cosco</option>
      <option value="CPD">CPD</option>
      <option value="DHL-Express">DHL-Express</option>
      <option value="DHL-Global">DHL-Global</option>
      <option value="DSV">DSV</option>
      <option value="ERA">ERA</option>
      <option value="FCM">FCM</option>
      <option value="Große Vehne">Große Vehne</option>
      <option value="Hellman">Hellman</option>
      <option value="K&N">K&N</option>
      <option value="KWE">KWE</option>
      <option value="LGI">LGI</option>
      <option value="LKW Walter">LKW Walter</option>
      <option value="Nippon">Nippon</option>
      <option value="Patinter">Patinter</option>
      <option value="Robinson">Robinson</option>
      <option value="Rüdiger">Rüdiger</option>
      <option value="Schenker">Schenker</option>
      <option value="TMC">TMC</option>
      <option value="TNT">TNT</option>
      <option value="UPS">UPS</option>
      <option value="Wackler">Wackler</option>
      </datalist>
      
      <br>
      <input class="form-control" maxlength="10" type="text" name="AccountNummer" placeholder="Account Nummer" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="30" type="text" name="Firma" placeholder="Firma" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="30" type="text" name="Straße" placeholder="Straße" aria-label="default input example">
      <br>
      
      <input class="form-control" list="StadtOptions" id="StadtDataList" placeholder="Stadt (Bundesstaat)" name="Stadt">
      <datalist id="StadtOptions">
      <option value="Accra">Accra</option>
      <option value="Adal-Treto">Adal-Treto</option>
      <option value="Ahmedabad">Ahmedabad</option>
      <option value="Altbach">Altbach</option>
      <option value="Anderson ">Anderson </option>
      <option value="Anderson [direct Import]">Anderson [direct Import]</option>
      <option value="Anderson [indirect Import]">Anderson [indirect Import]</option>
      <option value="Arbon">Arbon</option>
      <option value="Ballerup">Ballerup</option>
      <option value="Balzers">Balzers</option>
      <option value="Bamberg">Bamberg</option>
      <option value="Bangalore">Bangalore</option>
      <option value="Bangkok">Bangkok</option>
      <option value="Basildon">Basildon</option>
      <option value="Batangas">Batangas</option>
      <option value="Bayan Lepas">Bayan Lepas</option>
      <option value="Belgrade">Belgrade</option>
      <option value="Bhiwadi">Bhiwadi</option>
      <option value="Bidadi">Bidadi</option>
      <option value="Bielsko-Biala">Bielsko-Biala</option>
      <option value="Blaj">Blaj </option>
      <option value="Böblingen">Böblingen</option>
      <option value="Brits">Brits</option>
      <option value="Bursa ">Bursa </option>
      <option value="Campinas">Campinas</option>
      <option value="Ceske Budejovice">Ceske Budejovice</option>
      <option value="Changsha">Changsha</option>
      <option value="Changzhou">Changzhou</option>
      <option value="Charleston">Charleston</option>
      <option value="Chennai">Chennai</option>
      <option value="Cleon">Cleon</option>
      <option value="Clyton">Clyton</option>
      <option value="Coimbatore">Coimbatore</option>
      <option value="Coventry">Coventry</option>
      <option value="Curitiba">Curitiba</option>
      <option value="Dagenham">Dagenham</option>
      <option value="Darlington">Darlington</option>
      <option value="Denham">Denham</option>
      <option value="Dharuhera (Haryana)">Dharuhera (Haryana)</option>
      <option value="Farmington Hills">Farmington Hills</option>
      <option value="Gyeonggi">Gyeonggi</option>
      <option value="Györ">Györ</option>
      <option value="Haiphong city">Haiphong city</option>
      <option value="Hallein">Hallein</option>
      <option value="Hatvan">Hatvan</option>
      <option value="Higashimatsuyama-Shi">Higashimatsuyama-Shi</option>
      <option value="Ho Chi Minh City">Ho Chi Minh City</option>
      <option value="Homburg">Homburg</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Immenstadt im Allgäu">Immenstadt im Allgäu</option>
      <option value="Immenstadt im Allgäu (Blaichach)">Immenstadt im Allgäu (Blaichach)</option>
      <option value="Itupeva">Itupeva</option>
      <option value="Jaipur">Jaipur</option>
      <option value="Jiashan, Jiaxing  (Zhejiang)">Jiashan, Jiaxing  (Zhejiang)</option>
      <option value="Jihlava">Jihlava</option>
      <option value="Kandel">Kandel</option>
      <option value="Karlsruhe">Karlsruhe</option>
      <option value="Kaunas">Kaunas</option>
      <option value="Kentwood">Kentwood</option>
      <option value="Khimki">Khimki</option>
      <option value="Kiew">Kiew</option>
      <option value="Kölleda">Kölleda</option>
      <option value="Köln">Köln</option>
      <option value="Koropi">Koropi</option>
      <option value="Kunshan">Kunshan</option>
      <option value="Lagos">Lagos</option>
      <option value="Langhus / Trollåsen">Langhus / Trollåsen</option>
      <option value="Lerma (Laredo)">Lerma (Laredo)</option>
      <option value="Linnavuori">Linnavuori</option>
      <option value="Linz">Linz</option>
      <option value="Lüsslingen">Lüsslingen</option>
      <option value="Maddaloni">Maddaloni</option>
      <option value="Maidstone">Maidstone</option>
      <option value="Mailand">Mailand</option>
      <option value="Mexico City">Mexico City</option>
      <option value="Midrand">Midrand</option>
      <option value="Milano">Milano</option>
      <option value="Modugno">Modugno</option>
      <option value="Moskau">Moskau</option>
      <option value="Moskau">Moskau</option>
      <option value="Naberezhnye Chelny">Naberezhnye Chelny</option>
      <option value="Nanjing">Nanjing</option>
      <option value="Nashik">Nashik</option>
      <option value="North Geelong">North Geelong</option>
      <option value="Nuneaton">Nuneaton</option>
      <option value="Nürnberg">Nürnberg</option>
      <option value="Ojima-Machi">Ojima-Machi</option>
      <option value="Onet le Chateau (Rodez)-Machi">Onet le Chateau (Rodez)</option>
      <option value="Ruesselsheim">Opel Ruesselsheim</option>
      <option value="Österreich">Österreich</option>
      <option value="Penang">Penang</option>
      <option value="Petaling">Petaling</option>
      <option value="Plymouth">Plymouth</option>
      <option value="Polkowice">Polkowice</option>
      <option value="Prilep">Prilep</option>
      <option value="Pune">Pune</option>
      <option value="Rayong">Rayong</option>
      <option value="Reinsberg">Reinsberg</option>
      <option value="Rewari">Rewari</option>
      <option value="Ruhstorf">Ruhstorf</option>
      <option value="Saint Ouen">Saint Ouen</option>
      <option value="Saitama Higashimatsuyama">Saitama Higashimatsuyama</option>
      <option value="Salzgitter">Salzgitter</option>
      <option value="San luis Potosi">San luis Potosi</option>
      <option value="Santa Fe">Santa Fe</option>
      <option value="Sao Pauolo">Sao Pauolo</option>
      <option value="Schwieberdingen">Schwieberdingen</option>
      <option value="Buttikon">Buttikon</option>
      <option value="Settimo Torinese">Settimo Torinese</option>
      <option value="Shanghai">Shanghai</option>
      <option value="Sheung Shui">Sheung Shui</option>
      <option value="Singapore">Singapore</option>
      <option value="Steyr">Steyr</option>
      <option value="Stuttgart">Stuttgart</option>
      <option value="Summerville">Summerville</option>
      <option value="Sunnyvale">ThaSunnyvaleiland</option>
      <option value="Suzhou">Suzhou</option>
      <option value="Swindon">Swindon</option>
      <option value="Szirmabesenyo">Szirmabesenyo</option>
      <option value="Taipai">Taipai</option>
      <option value="Tianjin">Tianjin</option>
      <option value="Urdorf">Urdorf</option>
      <option value="Valladolid">Valladolid</option>
      <option value="Vantaa">Vantaa</option>
      <option value="Russland">Russland</option>
      <option value="Venissieux">Venissieux</option>
      <option value="Wackersdorf">Wackersdorf</option>
      <option value="Warschau">Warschau</option>
      <option value="Weifang">Weifang</option>
      <option value="Weissach">Weissach</option>
      <option value="Wernigerode">Wernigerode</option>
      <option value="Whitley">Whitley</option>
      <option value="Wuxi">Wuxi</option>
      <option value="Wuxi [RBCD]">Wuxi [RBCD]</option>
      <option value="Wuxi [RBCW]">Wuxi [RBCW]</option>
      <option value="Yokohama">Yokohama</option>
      <option value="Yongin-si">Yongin-si</option>
      <option value="Yongin-si, Daejeon">Yongin-si, Daejeon</option>
      </datalist>
      <br>

      <input class="form-control" list="LandOptions" id="LandDataList" placeholder="Land" name="Land">
      <datalist id="LandOptions">
      <option value="Australien">Australien</option>
      <option value="Brasilien">Brasilien</option>
      <option value="China">China</option>
      <option value="Dänemark">Dänemark</option>
      <option value="Deutschland">Deutschland</option>
      <option value="Finnland">Finnland</option>
      <option value="Frankreich">Frankreich</option>
      <option value="Ghana">Ghana</option>
      <option value="Griechenland">Griechenland</option>
      <option value="Großbritannien">Großbritannien</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Indien">Indien</option>
      <option value="Iran">Iran</option>
      <option value="Israel">Israel</option>
      <option value="Italien">Italien</option>
      <option value="Japan">Japan</option>
      <option value="Kanada">Kanada</option>
      <option value="Kolumbien">Kolumbien</option>
      <option value="Korea">Korea</option>
      <option value="Liechtenstein">Liechtenstein</option>
      <option value="Litauen">Litauen </option>
      <option value="Malaysia">Malaysia</option>
      <option value="Mazedonien">Mazedonien</option>
      <option value="Mexiko">Mexiko</option>
      <option value="Nigeria">Nigeria</option>
      <option value="Nord Mazedonien">Nord Mazedonien</option>
      <option value="Norwegen">Norwegen</option>
      <option value="Österreich">Österreich</option>
      <option value="Philippinen">Philippinen</option>
      <option value="Polen">Polen</option>
      <option value="Rumänien">Rumänien</option>
      <option value="Russland">Russland</option>
      <option value="Schweden">Schweden</option>
      <option value="Schweiz">Schweiz</option>
      <option value="Serbien">Serbien</option>
      <option value="Singapur">Singapur</option>
      <option value="Spanien">Spanien</option>
      <option value="Südafrika">Südafrika</option>
      <option value="Taiwan">Taiwan</option>
      <option value="Thailand">Thailand</option>
      <option value="Tschechische Republik">Tschechische Republik</option>
      <option value="Türkei">Türkei</option>
      <option value="Ukraine">Ukraine</option>
      <option value="Ungarn">Ungarn</option>
      <option value="USA">USA</option>
      <option value="Vietnam ">Vietnam </option>
      </datalist>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: grey;">Abbruch</button>
        <button type="button" onclick="kundennuCheck()" class="btn btn-primary" id="buttonSpeichern"  style="background-color: #007bc0;" >Speichern</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Eintrag ohne Kundenummer anlegen. -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
      <h5 class="modal-title" id="exampleModalLabel">Eintrag ohne Kundenummer anlegen?</h5>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal" data-bs-toggle="modal" style="background-color: grey;" data-bs-target="#exampleModal">Zurück</button>
        <button type="button" onclick="neuerEintrag()" class="btn btn-secondary" style="background-color: #007bc0;" data-bs-dismiss="modal">Speichern</button>
       
      </div>
    </div>
  </div>
</div>


<!-- Modal Eintrag bearbeiten -->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eintrag bearbeiten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="accountnummer/funktion/change_accountdata.php" id="accountbearbeiten" name="accountbearbeiten" method="post">  
      <div class="modal-body">  
      <input type='hidden' id='idbearbeiten' name='idbearbeiten' >
      <input class="form-control" maxlength="10"  type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" name="Kundenummerbearbeiten" id="Kundenummerbearbeiten" placeholder="Kundenummer" aria-label="default input example">
      <br>
      <input class="form-control" list="datalistOptions" id="Dienstleisterbearbeiten" placeholder="Dienstleisterbearbeiten" name="Dienstleisterbearbeiten">
      <datalist id="datalistOptions">
      <option value="Agility">Agility</option>
      <option value="Barsan">Barsan</option>
      <option value="CEVA">CEVA</option>
      <option value="Cosco">Cosco</option>
      <option value="CPD">CPD</option>
      <option value="DHL-Express">DHL-Express</option>
      <option value="DHL-Global">DHL-Global</option>
      <option value="DSV">DSV</option>
      <option value="ERA">ERA</option>
      <option value="FCM">FCM</option>
      <option value="Große Vehne">Große Vehne</option>
      <option value="Hellman">Hellman</option>
      <option value="K&N">K&N</option>
      <option value="KWE">KWE</option>
      <option value="LGI">LGI</option>
      <option value="LKW Walter">LKW Walter</option>
      <option value="Nippon">Nippon</option>
      <option value="Patinter">Patinter</option>
      <option value="Robinson">Robinson</option>
      <option value="Rüdiger">Rüdiger</option>
      <option value="Schenker">Schenker</option>
      <option value="TMC">TMC</option>
      <option value="TNT">TNT</option>
      <option value="UPS">UPS</option>
      <option value="Wackler">Wackler</option>
      </datalist>
      
      <br>
      <input class="form-control" maxlength="20" type="text" id="AccNummerbearbeiten" name="AccNummerbearbeiten" placeholder="Account Nummer" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="50" type="text" name="Firmabearbeiten" id="Firmabearbeiten" placeholder="Firma" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="50" type="text" name="Straßebearbeiten" id="Straßebearbeiten" placeholder="Straße" aria-label="default input example">
      <br>
      
      <input class="form-control" list="StadtOptions" id="Stadtbearbeiten" placeholder="Stadt (Bundesstaat)" name="Stadtbearbeiten">
      <datalist id="StadtOptions">
      <option value="Accra">Accra</option>
      <option value="Adal-Treto">Adal-Treto</option>
      <option value="Ahmedabad">Ahmedabad</option>
      <option value="Altbach">Altbach</option>
      <option value="Anderson ">Anderson </option>
      <option value="Anderson [direct Import]">Anderson [direct Import]</option>
      <option value="Anderson [indirect Import]">Anderson [indirect Import]</option>
      <option value="Arbon">Arbon</option>
      <option value="Ballerup">Ballerup</option>
      <option value="Balzers">Balzers</option>
      <option value="Bamberg">Bamberg</option>
      <option value="Bangalore">Bangalore</option>
      <option value="Bangkok">Bangkok</option>
      <option value="Basildon">Basildon</option>
      <option value="Batangas">Batangas</option>
      <option value="Bayan Lepas">Bayan Lepas</option>
      <option value="Belgrade">Belgrade</option>
      <option value="Bhiwadi">Bhiwadi</option>
      <option value="Bidadi">Bidadi</option>
      <option value="Bielsko-Biala">Bielsko-Biala</option>
      <option value="Blaj">Blaj </option>
      <option value="Böblingen">Böblingen</option>
      <option value="Brits">Brits</option>
      <option value="Bursa ">Bursa </option>
      <option value="Campinas">Campinas</option>
      <option value="Ceske Budejovice">Ceske Budejovice</option>
      <option value="Changsha">Changsha</option>
      <option value="Changzhou">Changzhou</option>
      <option value="Charleston">Charleston</option>
      <option value="Chennai">Chennai</option>
      <option value="Cleon">Cleon</option>
      <option value="Clyton">Clyton</option>
      <option value="Coimbatore">Coimbatore</option>
      <option value="Coventry">Coventry</option>
      <option value="Curitiba">Curitiba</option>
      <option value="Dagenham">Dagenham</option>
      <option value="Darlington">Darlington</option>
      <option value="Denham">Denham</option>
      <option value="Dharuhera (Haryana)">Dharuhera (Haryana)</option>
      <option value="Farmington Hills">Farmington Hills</option>
      <option value="Gyeonggi">Gyeonggi</option>
      <option value="Györ">Györ</option>
      <option value="Haiphong city">Haiphong city</option>
      <option value="Hallein">Hallein</option>
      <option value="Hatvan">Hatvan</option>
      <option value="Higashimatsuyama-Shi">Higashimatsuyama-Shi</option>
      <option value="Ho Chi Minh City">Ho Chi Minh City</option>
      <option value="Homburg">Homburg</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Immenstadt im Allgäu">Immenstadt im Allgäu</option>
      <option value="Immenstadt im Allgäu (Blaichach)">Immenstadt im Allgäu (Blaichach)</option>
      <option value="Itupeva">Itupeva</option>
      <option value="Jaipur">Jaipur</option>
      <option value="Jiashan, Jiaxing  (Zhejiang)">Jiashan, Jiaxing  (Zhejiang)</option>
      <option value="Jihlava">Jihlava</option>
      <option value="Kandel">Kandel</option>
      <option value="Karlsruhe">Karlsruhe</option>
      <option value="Kaunas">Kaunas</option>
      <option value="Kentwood">Kentwood</option>
      <option value="Khimki">Khimki</option>
      <option value="Kiew">Kiew</option>
      <option value="Kölleda">Kölleda</option>
      <option value="Köln">Köln</option>
      <option value="Koropi">Koropi</option>
      <option value="Kunshan">Kunshan</option>
      <option value="Lagos">Lagos</option>
      <option value="Langhus / Trollåsen">Langhus / Trollåsen</option>
      <option value="Lerma (Laredo)">Lerma (Laredo)</option>
      <option value="Linnavuori">Linnavuori</option>
      <option value="Linz">Linz</option>
      <option value="Lüsslingen">Lüsslingen</option>
      <option value="Maddaloni">Maddaloni</option>
      <option value="Maidstone">Maidstone</option>
      <option value="Mailand">Mailand</option>
      <option value="Mexico City">Mexico City</option>
      <option value="Midrand">Midrand</option>
      <option value="Milano">Milano</option>
      <option value="Modugno">Modugno</option>
      <option value="Moskau">Moskau</option>
      <option value="Moskau">Moskau</option>
      <option value="Naberezhnye Chelny">Naberezhnye Chelny</option>
      <option value="Nanjing">Nanjing</option>
      <option value="Nashik">Nashik</option>
      <option value="North Geelong">North Geelong</option>
      <option value="Nuneaton">Nuneaton</option>
      <option value="Nürnberg">Nürnberg</option>
      <option value="Ojima-Machi">Ojima-Machi</option>
      <option value="Onet le Chateau (Rodez)-Machi">Onet le Chateau (Rodez)</option>
      <option value="Ruesselsheim">Opel Ruesselsheim</option>
      <option value="Österreich">Österreich</option>
      <option value="Penang">Penang</option>
      <option value="Petaling">Petaling</option>
      <option value="Plymouth">Plymouth</option>
      <option value="Polkowice">Polkowice</option>
      <option value="Prilep">Prilep</option>
      <option value="Pune">Pune</option>
      <option value="Rayong">Rayong</option>
      <option value="Reinsberg">Reinsberg</option>
      <option value="Rewari">Rewari</option>
      <option value="Ruhstorf">Ruhstorf</option>
      <option value="Saint Ouen">Saint Ouen</option>
      <option value="Saitama Higashimatsuyama">Saitama Higashimatsuyama</option>
      <option value="Salzgitter">Salzgitter</option>
      <option value="San luis Potosi">San luis Potosi</option>
      <option value="Santa Fe">Santa Fe</option>
      <option value="Sao Pauolo">Sao Pauolo</option>
      <option value="Schwieberdingen">Schwieberdingen</option>
      <option value="Buttikon">Buttikon</option>
      <option value="Settimo Torinese">Settimo Torinese</option>
      <option value="Shanghai">Shanghai</option>
      <option value="Sheung Shui">Sheung Shui</option>
      <option value="Singapore">Singapore</option>
      <option value="Steyr">Steyr</option>
      <option value="Stuttgart">Stuttgart</option>
      <option value="Summerville">Summerville</option>
      <option value="Sunnyvale">ThaSunnyvaleiland</option>
      <option value="Suzhou">Suzhou</option>
      <option value="Swindon">Swindon</option>
      <option value="Szirmabesenyo">Szirmabesenyo</option>
      <option value="Taipai">Taipai</option>
      <option value="Tianjin">Tianjin</option>
      <option value="Urdorf">Urdorf</option>
      <option value="Valladolid">Valladolid</option>
      <option value="Vantaa">Vantaa</option>
      <option value="Russland">Russland</option>
      <option value="Venissieux">Venissieux</option>
      <option value="Wackersdorf">Wackersdorf</option>
      <option value="Warschau">Warschau</option>
      <option value="Weifang">Weifang</option>
      <option value="Weissach">Weissach</option>
      <option value="Wernigerode">Wernigerode</option>
      <option value="Whitley">Whitley</option>
      <option value="Wuxi">Wuxi</option>
      <option value="Wuxi [RBCD]">Wuxi [RBCD]</option>
      <option value="Wuxi [RBCW]">Wuxi [RBCW]</option>
      <option value="Yokohama">Yokohama</option>
      <option value="Yongin-si">Yongin-si</option>
      <option value="Yongin-si, Daejeon">Yongin-si, Daejeon</option>
      </datalist>
      <br>

      <input class="form-control" list="LandOptions" id="Landbearbeiten" placeholder="Land" name="Landbearbeiten">
      <datalist id="LandOptions">
      <option value="Australien">Australien</option>
      <option value="Brasilien">Brasilien</option>
      <option value="China">China</option>
      <option value="Dänemark">Dänemark</option>
      <option value="Deutschland">Deutschland</option>
      <option value="Finnland">Finnland</option>
      <option value="Frankreich">Frankreich</option>
      <option value="Ghana">Ghana</option>
      <option value="Griechenland">Griechenland</option>
      <option value="Großbritannien">Großbritannien</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Indien">Indien</option>
      <option value="Iran">Iran</option>
      <option value="Israel">Israel</option>
      <option value="Italien">Italien</option>
      <option value="Japan">Japan</option>
      <option value="Kanada">Kanada</option>
      <option value="Kolumbien">Kolumbien</option>
      <option value="Korea">Korea</option>
      <option value="Liechtenstein">Liechtenstein</option>
      <option value="Litauen">Litauen </option>
      <option value="Malaysia">Malaysia</option>
      <option value="Mazedonien">Mazedonien</option>
      <option value="Mexiko">Mexiko</option>
      <option value="Nigeria">Nigeria</option>
      <option value="Nord Mazedonien">Nord Mazedonien</option>
      <option value="Norwegen">Norwegen</option>
      <option value="Österreich">Österreich</option>
      <option value="Philippinen">Philippinen</option>
      <option value="Polen">Polen</option>
      <option value="Rumänien">Rumänien</option>
      <option value="Russland">Russland</option>
      <option value="Schweden">Schweden</option>
      <option value="Schweiz">Schweiz</option>
      <option value="Serbien">Serbien</option>
      <option value="Singapur">Singapur</option>
      <option value="Spanien">Spanien</option>
      <option value="Südafrika">Südafrika</option>
      <option value="Taiwan">Taiwan</option>
      <option value="Thailand">Thailand</option>
      <option value="Tschechische Republik">Tschechische Republik</option>
      <option value="Türkei">Türkei</option>
      <option value="Ukraine">Ukraine</option>
      <option value="Ungarn">Ungarn</option>
      <option value="USA">USA</option>
      <option value="Vietnam ">Vietnam </option>
      </datalist>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: grey;">Abbruch</button>
        <button type="button" onclick="eintragBearbeitenBesteatigen()"class="btn btn-primary" id="buttonSpeichern"  style="background-color: #007bc0;" >Speichern</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Eintrag löschen bestätigen -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
      <h5 class="modal-title" id="exampleModalLabel">Möchten Sie diesen Eintrag wirklich löschen?</h5>
      </div>
      <div class="modal-footer">
          <button class="btn btn-secondary" onclick="eintragLoeschenbestaetigen()" style="background-color: #007bc0;" data-bs-dismiss="modal">Bestätigen</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal für die Statusmeldung "eintrag wurde bearbeitet". -->
<div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
   
      <h4 style="margin-left: 16%;"  id="exampleModalLabel">Eintrag wurde bearbeitet</h4>
      <img  style="margin-left: 50%;"src="assets/icons/checkmark-bold.svg" height="40" width="40">
      
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<!-- Modal für die Statusmeldung "eintrag wurde angelegt". -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
   
      <h4 style="margin-left: 12%;"  id="exampleModalLabel">Neuer Eintrag wurde angelegt</h4>
      <img  style="margin-left: 50%;"src="assets/icons/checkmark-bold.svg" height="40" width="40">
      
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>

<!-- Modal für die Statusmeldung "eintrag wurde gelöscht". -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">  
   
      <h4 style="margin-left: 20%;"  id="exampleModalLabel">Eintrag wurde gelöscht</h4>
      <img  style="margin-left: 50%;"src="assets/icons/checkmark-bold.svg" height="40" width="40">
      
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>


