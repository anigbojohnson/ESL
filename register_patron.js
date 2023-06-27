function capchFunction(){
  let xhttp = new XMLHttpRequest();
  xhttp.open("POST", "capture_value.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
  xhttp.onreadystatechange = function() {
  }
}
function formatNationalId(){

    document.getElementById('documentNumber').value =   document.getElementById('documentNumber').value.replace(/(\d{4})(\d{4})(\d{4})(\d{4})/,"$1 $2 $3 ");
}

var date = new Date();
document.getElementById('todate').innerHTML = date.getFullYear();
function populate(state,city){
var state = document.getElementById(state);
var city = document.getElementById(city);
city.innerHTML = "";
switch(state.value){
  case "Abia":
  var lgaArray = ["|","aba | Aba","aba north l.g.a | Aba North L.G A","aba South | Aba South","arochkwuu | Arochkwuu","bende | Bende","ikwuano | Ikwuano","isiala Ngwa North | Isiala Ngwa North","isiala Ngwa South | Isiala Ngwa South","isukwuat | Isukwuat","obi Ngwa | Obi Ngwa","ohafia | Ohafia","osisioma | Osisioma","ugwunagbo | Ugwunagbo","ukwa East | Ukwa East","ukwa West | Ukwa West","umu Nneochi | Umu Nneochi",
  "umuahia | Umuahia","umuahiaNorth | Umuahia North","umuahiaSouth | UmuahiaSouth"];
  break;
  case "Adamawa":
  var lgaArray = ["|","demsa | Demsa","fufore | Fufore","ganye | Ganye","girei | Girei","gombi | Gombi","guyuk | Guyuk","hong | Hong","jada | Jada","lamurde | Lamurde","madagali | Madagali",
  "maiha | Maiha","mayo-Belwa | Mayo-Belwa","michika | Michika", "mubi North | Mubi North","mubi South | Mubi South", "numan | Numan","shelleng | Shelleng","song | Song","toungo | Toungo","yola |Yola ","jimeta | Jimeta"];
    break;
   case "Akwa Ibom":
   var lgaArray= ["|","abak | abak","Obolo | Eastern Obolo","eket | Eket","esit | Esit-Eket","essien| Essien Udim","ekpo | Etim-Ekpo","etinan | Etinan","ibeno | ibano","ibesikpo | Ibesikpo-Asutan","ibom |Ibiono-Ibom","ika | Ika","ikono|Ikono","abasi |Ikot Abasi",
                  "ekpene |Ikot Ekpene","ini| Ini","itu | Itu","mbo|Mbo","enin | Mkpat-Enin","atai | Nsit-Atai","ibom | Nsit-Ibom","ubium | Nsit-Ubium","obot|Obot-Akara","okobo | Okobo","onna | Onna","oron | Oron","oruk | Oruk Anam","ukanafun | Ukanafun","udung | Udung-Uko","uruan | Uruan(Adadia)" ,"Urue-Offong | Urue-Offong/Oruko",
                  "uyo|Uyo"];
    break;
   case "Anambra":
   var lgaArray= ["|","anambraEast | Anambra East","anambraWest | Anambra West "," ayamelum | Ayamelum "," ogbaru | Ogbaru","onitshaNorth | Onitsha North ","onitshaSouth | Onitsha South ","oyi | Oyi","awkaNorth| Awka North","awkaSouth | Awka South ","anaocha | Anaocha","dunukofia | Dunukofia","idemiliNorth | Idemili North",
              "idemiliSouth | Idemili South","njikoka | Njikoka","aguata | Aguata ","ekwusigo | Ekwusigo","ihiala | Ihiala ","nnewiNorth | Nnewi North","nnewiSouth | Nnewi South","orumbaNorth |Orumba North ","orumbaSouth| Orumba South"];
              break;
   case "Bauchi" :
  var lgaArray=[" | ", "alkaleri | Alkaleri","bauchi | Bauchi" ,"bogoro | Bogoro",  "dambam | Dambam","darazo | Darazo"," dass | Dass"," gamawa | Gamawa","ganjuwa | Ganjuwa",
           "giade | Giade","ItasGadau | Itas Gadau","jama | Jama", "katagum | Katagum", "kirfi | Kirfi","misau | Misau", "ningi | Ningi","Shira | Shira","TafawaBalewa | Tafawa Balewa","toro | Toro","warji | Warji", "zaki | Zaki "];
            break;
  case "Bayelsa":
   var lgaArray= [" | ","brass | Brass", "ekeremor | Ekeremor","kolokumaOpokuma | Kolokuma Opokuma", "nembe | Nembe", "ogbia | Ogbia","sagbama | Sagbama","southernIjaw| Southern Ijaw","yenagoa | Yenagoa"];
           break;
   case "Benue":
   var lgaArray= [" | ", "ado | Ado", "agatu | Agatu", "apa | Apa", "buruku | Buruku ", "gboko | Gboko", "guma| Guma","gwerEatWest | gwer East/West","katsina-Ala | Katsina-Ala","konshisha | Konshisha", "kwande | Kwande","logo | Logo", "makurdi | Makurdi", "obiOju | Obi Oju","ogbadibo | Ogbadibo"," ohimini | Ohimini","oju | Oju ","okpokwu | Okpokwu" ,"otukpo | Otukpo ","takar | Takar" ,"ukum | Ukum ",
            "ushongo | Ushongo" ,"vandeikya | Vandeikya"];
           break;
   case "Borno":
    var lgaArray= [" | ","abadam | Abadam", "uba | Askira Uba","bama | Bama" ,"bayo | Bayo","biu | Biu", "chibok | Chibok","damboa | Damboa" , "dikwa | Dikwa", " gubio| Gubio","Guzamala |Guzamala"," gwoza | Gwoza","hawul | Hawul","jere | Jere","Kaga | kaga","KalaBalge | Kala Balge","konduga | Konduga","Kukawa | Kukawa","KwayaKusar | Kwaya Kusar","mafa | Mafa", "magumeri | Magumeri", "maiduguri | Maiduguri" ,"marte| Marte",
    "mobbar | Mobbar" , "monguno | Monguno" , "ngala | Ngala " , "nganzai | Nganzai ","shani | Shani"];
          break;
  case "Cross River":
  var lgaArray = [" | ", "abi | Abi ", "akamkpa | Akamkpa", "akpabuyo | Akpabuyo","bekwarra | Bekwarra " , "biase | Biase","boki | Boki", "calabarMunicipal |Calabar","calabarSouth | Calabar South","etung | Etung ","ikom | Ikom","obanliku | Obanliku","obubra | Obubra","obudu | Obudu ","odukpani | Odukpani","ogoja | Ogoja","yakurr | Yakurr","yala| Yala"];
         break;
  case "Delta":
  var lgaArray = [" | ","aniochaNorth | Aniocha North" , "aniochaSouth | Aniocha South" ,"bomadi | Bomadi","burutu | Burutu","ethiopeEast| Ethiope East","ethiopeWest| Ethiope West","ikaNorthEast | Ika North East", "ikaSouth | Ika South","isokoNorth | Isoko North","isokoSouth| Isoko South","ndokwaEast | Ndokwa East","ndokwaWest | Ndokwa West","oshimiliNorth | Oshimili North",
              "oshimiliSouth | Oshimili South" , "patani | Patani","sapele | Sapele" ," udu | Udu","ughelliNorth | Ughelli North","ughelliSouth | Ughelli South" , "ukwuanipeople | Ukwuani people","uvwie | Uvwie" , "uvwie | Uvwie" , "warri | Warri" ,"warriNorth| Warri North","warriSouth | Warri South","warriSouthWest| Warri South West"];
  break;
  case "Ebonyi":
  var lgaArray = [" | ","abakaliki | Abakaliki ","afikpoNorth | Afikpo North","afikpoSouth | Afikpo South","ebonyi | Ebonyi","ezzaNorth| Ezza North","ezzaSouth| Ezza South","ikwo | Ikwo","ishielu | Ishielu", "ivo | Ivo","izzi | Izzi","ohaozara | Ohaozara","ohaukwu | Ohaukwu", "onicha | Onicha"];
   break;
   case "Enugu":
   var lgaArray = [" | ", "aninri | Aninri","awgu | Awgu","enuguEast | Enugu East","enuguNorth | Enugu North","enuguSouth | Enugu South", "ezeagu | Ezeagu","igboEtiti | Igbo Etiti","igboEzeNorth| Igbo Eze North", "igboEzeSouth | Igbo Eze South","isiUzo| Isi Uzo","nkanuEast | Nkanu East","nkanuWest| Nkanu West", "nsukka | Nsukka", "ojiRiver | Oji River","udenu | Udenu","udi | Udi","Uzo-Uwani | Uzo-Uwani"];
   break;
  case "Edo":
  var lgaArray = [" | ","akoko-Edo | Akoko-Edo","egor	| Egor","esanCentral	| Esan Central","esanNorthEast| Esan North East","esanSouthEast	| Esan South East","esanWest	| Esan West","EtsakoCentra | Etsako Centra","etsakoEast| Etsako East", "etsakoWest| Etsako West","Igueben	| Igueben","Ikpoba-Okha	| Ikpoba-Okha","oredo	| Oredo","Orhionmwon| Orhionmwon","oviaNorthEast|	Ovia North East","oviaSouthWest	| Ovia South West","owanEast	| Owan East",
  "owanWest| Owan West"	, "uhunmwonde | Uhunmwonde"];
   break;
  case "Ekiti":
   var lgaArray = [" | ","adoEkiti | Ado Ekiti" , "aramoko | Aramoko","efonAlaaye | Efon-Alaaye", "emure| Emure","idoOsi | Ido Osi","igede | Igede", "ijeroEkiti| Ijero-Ekiti","ikereEkiti | Ikere Ekiti", "ikoleEkiti| Ikole Ekiti", "ikole | Ikole","ise | Ise","Omuo | Omuo","oye | Oye" ];
  break;
case "Gombe":
var lgaArray = [" | ","akko | Akko" , "balanga | Balanga", "billiri | Billiri","dukku | Dukku", "funakaye | Funakaye", "gombe | Gombe", "kaltungo | Kaltungo", "kumo | Kumo","kwami | Kwami", "nafada | Nafada", "shongom | Shongom","yamaltuDeba | Yamaltu Deba"];
break;
case "Imo":
var lgaArray = [" | ","aboMbaise	| Abo-Mbaise","ahiazuMbaise	| Ahiazu-Mbaise","ehimeMbano	| Ehime-Mbano	","ezinihitte	| Ezinihitte","ideatoNorth|Ideato North","ideatoSouth| Ideato South",	"ihitteUboma	| Ihitte/Uboma","ikeduru | Ikeduru","isialaMbano	| Isiala-Mbano","isu | Isu","Mbaitoli	| Mbaitoli","ngorOkpala|	Ngor-Okpala","Njaba	| Njaba","nkwerre	| Nkwerre ","Nwangele	| Nwangele",
"obowo | Obowo","Oguta | Oguta", "ohajiEgbema| Ohaji/Egbema","Okigwe | Okigwe",	"orlu	| Orlu","Orsu	| Orsu","oruEast| Oru East"	,"oruWest| Oru West","owerriMunicipal|Owerri Municipal","owerriNorth	| Owerri North","owerriWest| Owerri West"	,"Unuimo | Unuimo"];
break;
case "Jigawa":
var lgaArray =[" | ", "auyo | Auyo","babura | Babura","biriniwa | Biriniwa","birninKudu | Birnin Kudu","buji | Buji", "dutse | Dutse","gagarawa | Gagarawa","garki | Garki","gumel | Gumel","guri | Guri","gwaram | Gwaram", "gwiwa | Gwiwa","hadejia | Hadejia","jahun | Jahun","kafinHausa | Kafin Hausa","kaugama | Kaugama"," kazaure | Kazaure","kiriKasama | Kiri Kasama"," kiyawa | Kiyawa","maigatari | Maigatari",
"malamMadori | Malam Madori","miga | Miga","ringim | Ringim","roni | Roni","suleTankarkar| Sule Tankarkar","taura | Taura","Yankwashi | Yankwashi" ];
break;
case "Kaduna":
var lgaArray = [" | ","birninGwari | Birnin Gwari","chikun | Chikun","giwa | Giwa","igabi | Igabi" ,"ikara | Ikara", "jaba | Jaba","jema | Jema","kachia | Kachia","kadunaNorth| Kaduna North","kadunaSouth | Kaduna South","kaduna | Kaduna","kagarko | Kagarko","kajuru | Kajuru","kaura | Kaura", "kauru | Kauru","kubau | Kubwa","kudan | Kudan"," lere | Lere","makarfi | Makarfi", " sabonGari | Sabon Gari","sanga | Sanga",
"soba | Soba","zangonKataf| Zangon Kataf", "zaria | Zaria"];
break;
case "Kano":
var lgaArray =[" | ","ajingi | Ajingi","albasu | Albasu","bagwai | Bagwai","bebeji | Bagwai","bichi | Bichi","bunkure | Bunkure","dala | Dala","dambatta | Dambatta","dawakinKudu| Dawakin Kudu","dawakinTofa| Dawakin Tofa","doguwa | Daoguwa","fagge | Fagge","gabasawa | Gabasawa","garko | Garko","garunMallam | Garun Mallam","gaya | Gaya","gezawa | Gezawa","gwale | Gwale","gwarzo | Gwarzo","kabo |  Kabo","KankMunicipal | Kano Municipal",
            "karaye | Karaye", "kibiya | Kibiya","kiru | Kiru","kumbotso | Kumbotso","kunchi | Kunchi","kura | Kura","madobi | Madobi","makoda | Makoda","minjibir | Minjibir","nasarawa | Nasarawa","rano | Rano"," riminGado | Rimin Gado","rogo | Rogo", "shanono | Shanono","sumaila | Sumaila","takai | Takai","tarauni | Tarauni","tofa | Tofa","tsanyawa | Tsanyawa","tudunWada | Tudun Wada", "ungogo | Ungogo","warawa | Warawa","wudil| Wudil"];
            break;
case "Katsina":
var lgaArray= [" | ","bakori | Bakori","batagarawa | Batagarawa","batsari | Batsari", "baure | Baure","Bindawa | Baure","charanchi | Charanchi","danMusa | Dan Musa","dandume | Dandume","danja | Danja","daura | Daura","dutsi | Dutsi","dutsinMa | Dutsin Ma","faskari| Faskari","funtua | Funtua","ingawa | Ingawa", "jibia | Jibia","kafur | Kafur","kaita | Kaita","kankara | Kankara","kankia | Kankia","katsina | Katsina",
             "kurfi | Kurfi","kusada | Kusada", "maiAdua| Mai Adua","malumfashi | Malumfashi","mani | Mani","mashi | Mashi","matazu | Matazu","musawa | Musawa","rimi | Rimi","sabuwa | Sabuwa","safana | Safana","sandamuZango| Sandamu Zango"];
             break;
case "Kebbi":
var lgaArray = [ " | ","aleiro | Aleiro","arewaDandi | Arewa Dandi","argungu | Argungu","augie | Augie","bagudo | Bagudo","birninKebbi | Birnin Kebbi","bunza | Bunza","dandi | Dandi ","fakai | Fakai","gwandu | Gwandu","jega | Jega","Kalgo | Kalgo","kokoBesse | Koko Besse",
              "maiyama | Maiyama","ngaski | Ngaski","sakaba |Sakaba","shanga | Shanga","suru | Suru","wasaguDanko| Wasagu Danko","yauri | Yauri","zuru | Zuru"];
             break;
case "Kogi":
var lgaArray = [" | ","adavi | Adavi","ajaokuta | Ajaokuta","ankpa | Ankpa","bassa | Bassa ","dekina | Dekina","ibaji | Ibaji","idah | Idah","igalamelaOdolu | Igalamela Odolu"," ijumu | Ijumu","kabbaBunu | Kabba Bunu","lokoja | Lokoja","mopaMuro | Mopa Muro","ofu | Ofu","okehi | Okehi",
"okene | Okene","olamaboro | Olamaboro","omala | Omala","yagbaEast | Yagba East","yagbaWest| Yagba West"];
break;
case "Kwara":
var lgaArray = [" | ","asa | Asa","baruten | Baruten","Edu | edu","Ekiti | ekiti","ifelodun | Ifelodun","ilorinEast | Ilorin East","ilorinSouth | Ilorin South","ilorinWest| Ilorin West","irepodun | Irepodun","isin | Isin"," kaiama | Kaiama","moro | Moro","offa | Offa","okeEro| Oke Ero","oyun | Oyun","pategi | Pategi"];
break;
case "Lagos":
var lgaArray = [" | ","alimosho | Alimosho","ajeromiIfelodun | Ajeromi Ifelodun","kosofe | Kosofe","mushin | Mushin","oshodiIsolo | Oshodi-Isolo","ojo | Ojo","ikorodu | Ikorodu","surulere | Surulere","agege | Agege","ifakoIjaiye | Ifako-Ijaiye"," somolu | Somolu"," amuwoOdofin | Amuwo Odofin"	,"lagosMainland	| Lagos Mainland",
"Ikeja | Ikeja","etiOsa | Eti-Osa","badagry	 | Badagry	","apapa | Apapa	"," lagosIsland | Lagos Island","epe | Epe","ibejuLekki | Ibeju-Lekki"];
break;
case "Nasarawa":
var lgaArray = [ " | ","Akwanga | Akwanga","doma | Doma","eggon | Eggon","karu | Karu"," keana | Keana"," keffi | Keffi","kokona | Kokona","lafia | Lafia","obi | Obi", "toto | Toto","wamba | Wamba"];
break;
case "Niger":
var lgaArray = [" | ","agaie | Agaie","agwara | Agwara","bida | Bida","borgu | Borgu","bosso | Bosso","chanchaga | Chanchaga","edati | Edati","gbako | Gbako","gurara | Gurara","katcha | Katcha","kontagora | Kontagora","lapai | Lapai","lavun | Lavun","magama | Magama","mariga | Mariga","mashegu | Mashegu"," mokwa | Mokwa"," munya | Munya",
"paikoro | Paikoro","rafi | Rafi","rijau | Rijau","shiroro | Shiroro","suleja | Suleja","tafa | Tafa","wushishi | Wushishi"];
break;
case "Ogun" :
var lgaArray = [" | ","abeokutaNorth | Abeokuta North","abeokutaSouth | Abeokuta South","adoOdoOta | Ado-Odo/Ota","ewekoro | Ewekoro ","ifo | Ifo "," ijebuEast  | Ijebu East ","ijebuNorth | Ijebu North ","IjebuNorthEast | Ijebu North East"," ijebuOde |  Ijebu Ode","ikenne | Ikenne ","imekoAfon | Imeko Afon ","ipokia | Ipokia","obafemiOwode | Obafemi Owode","Odogbolu  | Odogbolu ",
"Odeda | Odeda","ogunWaterside | Ogun Waterside","Remo North | Remo North","Sagamu | Sagamu","yewaNorth | Yewa North","Yewa South" | "Yewa South" ];
break;
case "Ondo":
var lgaArray = [" | ","ose | 0se","AkokoNorthEast | Akoko North-East","AkokoNorthWest| Akoko North-West","AkokoSouthEast | Akoko South-East","AkokoSouthWest| Akoko South-West"," akureNorth | Akure North"," akureSouth| Akure South","eseOdo | Ese Odo"," Idanre | Idanre"," Ifedore | Ifedore","igbaraoke | Igbara-oke","ilaje | Ilaje","ileOlujiOkeigbo | Ile Oluji Okeigbo","irele | Irele","TalkOka | Talk Oka"," OkaAkoko| Oka, Akoko","okitipupa | Okitipupa"," OndoEast| Ondo East",
"Ondo West | Ondo West","ose | Ose","owo | Owo"];
break;
case "Osun":
var lgaArray = [" | ","aiyedaade | Aiyedaade","aiyedire | Aiyedire","atakunmosaEast | Atakunmosa East","atakunmosaWest | Atakunmosa West","Boluwaduro | boluwaduro"," boripe | Boripe","edeNorth | Ede North","edeSouth | Ede South","egbedore | Egbedore","ejigbo | Ejigbo","ifeCentral | Ife Central","ifeEast | Ife East","ifeNorth | Ife North","ifeSouth | Ife South","ifedayo | Ifedayo",
               "ifelodun | Ifelodun","Ila | Ila","ilesaEast | Ilesa East","ilesaWest | Ilesa West","irepodun | Irepodun","irewole | Irewole"," isokan | Isokan","iwo | Iwo","obokun | Obokun","odoOtin | Odo Otin","olaOluwa | Ola Oluwa","olorunda | Olorunda","oriade | Oriade","orolu | Orolu","osogbo | Osogbo"];
               break;
case "Oyo":
var lgaArray = [" | ", " afijio | Afijio"," akinyele | Akinyele","atiba | Atiba","atisbo | Atisbo"," egbeda | Egbeda", "ibadanNorth| Ibadan North","ibadanNorthEast | Ibadan North-East"," ibadanNorthWest | Ibadan North-West","ibadanSouthEast | Ibadan South-East","ibadanSouthWest | Ibadan South-West","ibarapaCentral | Ibarapa Central","ibarapaEast | Ibarapa East","ibarapaNorth | Ibarapa North","ido | Ido",
"irepo | Irepo","iseyin | Iseyin","itesiwaju | Itesiwaju","iwajowa | Iwajowa", " kajola | Kajola", " lagelu | Lagelu","ogbomoshoNorth | Ogbomosho North","ogbomoshoSouth | Ogbomosho South"," ogoOluwa | Ogo Oluwa","olorunsogo | Olorunsogo","oluyole | Oluyole"," Ona Ara | Ona Ara","orelope | Orelope"," Ori Ire | OriIre"," OyoEast | Oyo East"," OyoWest | Oyo West"," sakiEast | Saki East"," sakiWest | Saki West",
"surulere | Surulere"];
break;
case "Plateau":
var lgaArray = [" | ", "BarkinLadi | BarkinLadi","Bassa | bassa","bokkos | Bokkos","josEast | Jos East"," josNorth | Jos North","josSouth | Jos South","kanam | Kanam"," kanke | Kanke"," langtangNorth | Langtang North"," langtangSouth | Langtang South"," mangu | Mangu"," mikang | Mikang",
"pankshin | Pankshin"," QuaanPan | Qua'an Pan", " Riyom | Riyom" ," shendam | Shendam", " wase | Wase"];
break;
case "Rivers":
var lgaArray = [" | ", " abuaOdual | Abua–Odual"," ahoadaEast | Ahoada East"," ahoadaWest | Ahoada West", " akukuToru | Akuku-Toru"," andoni | Andoni","asariToru | Asari-Toru"," bonny | Bonny"," degema | Degema"," eleme | Eleme"," emohua | Emohua","etche | Etche"," gokana | Gokana","ikwerre | Ikwerre","khana | Khana"," obioAkpor | Obio-Akpor"," ogbaEgbemaNdoni | Ogba–Egbema–Ndoni" ," oguBolo | Ogu–Bolo"," Okrika | Okrika",
" Omuma | Omuma"," OpoboNkoro | Opobo–Nkoro", " Oyigbo | Oyigbo", " portHarcourt | Port Harcourt","tai | Tai"];
break;
case "Sokoto":
var lgaArray = [" | ", "binji | Binji"," bodinga | Bodinga", " Dange | Dange"," gada | Gada" , " goronyo | Goronyo"," gudu | Gudu" ," gwadabawa | Gwadabawa"," Illela | Illela"," Isa | Isa "," kebbe | Kebbe"," Kware | Kware "," Rabah | Rabah ", "sabonBirni | Sabon Birni","shagari | Shagari","silame | Silame ","sokoto | Sokoto"," sokotoNorth | Sokoto North"," sokotoSouth | Sokoto South"," tambawal | Tambawal"," Tambawal | Tambawal",
"Tangaza | Tangaza","tureta | Tureta "," wamako | Wamako","wurno | Wurno ","yabo | Yabo" ];
break;
case "Taraba":
var lgaArray = [" | ", "ardoKola | Ardo Kola","bali | Bali","donga | Donga"," gashaka | Gashaka", " gassol | Gassol", "ibi | Ibi"," jalingo | Jalingo", "kurmi| Kurmi "," lau | Lau"," sardauna | Sardauna",
"takum | Takum"," ussa | Ussa", "wukari | Wukari"," yorro | Yorro", "zing | Zing"];
break;
case " Yobe":
var lgaArray = [" | ", "bade | Bade","bursari | Bursari"," damaturu | Damaturu"," fika | Fika"," fune | Fune"," geidam | Geidam"," gujba | Gujba"," gulani | Gulani"," jakusko | Jakusko"," karasuwa | Karasuwa"," machina | Machina"," nangere | Nangere",
"tarmuwa | Tarmuwa"," yunusari | Yunusari"];
break;
case "Zamfara":
var lgaArray = [" | ", "anka | Anka"," bakura | Bakura", " birninMagajiKiyaw | Birnin Magaji Kiyaw"," bukkuyum | Bukkuyum"," bungudu | Bungudu"," chafe | Chafe"," gummi | Gummi"," gusau | Gusau"," kauraNamoda | Kaura Namoda",
"Maradun | Maradun "," maru | Maru","Shinkafi | Shinkafi", " talataMafara | Talata Mafara"," zurmi | Zurmi"];
break;
}
for ( var option in lgaArray){
  var twins= lgaArray[option].split("|");
  var newOption = document.createElement("option");
  newOption.value = twins[0];
  newOption.innerHTML =twins[1];
  city.options.add(newOption);
}
}

function myFunction() {
var x = document.getElementById("password");
if (x.type === "password") {
  x.type = "text";
  document.getElementById('passwordShow').style.display = "block";
  document.getElementById('passwordHide').style.display = "inline-block";

} else {
  x.type = "password";
  document.getElementById('passwordShow').style.display = "inline-block";
  document.getElementById('passwordHide').style.display = "block";
}
}
function myFunctionCon(){
var y = document.getElementById("passCon");
if (y.type === "password") {
y.type = "text";
} else {
y.type = "password";
}
}
let moveUpPage = document.getElementsByClassName('fa fa-arrow-up moveUpPage')[0];
moveUpPage.addEventListener('click',function () {
  window.scrollTo(0, 0);
});

window.addEventListener('scroll',()=> {
if(window.scrollY<390){
 document.getElementsByClassName('fa fa-arrow-up moveUpPage')[0].style.display = "none";
} else{
 document.getElementsByClassName('fa fa-arrow-up moveUpPage')[0].style.display = "block";
}
});
function openAndCloseNavBar() {
    var navbarClass = document.getElementById("navBarAfter");
    if (navbarClass.className === "navBarAfter") {
    navbarClass.className += " openNavbar";
    } else {
    navbarClass.className = "navBarAfter";
    }
}

function displayIdAndExpireDate(val){
  let windowWidth = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;
let userId = document.getElementsByClassName('identification').length;
for(let index=0; index < userId ; index++){
  document.getElementsByClassName('identification')[index].style.display ="none";
}
document.getElementsByClassName('userIdentification')[0].style.display ="block";
document.getElementsByClassName('identification')[val].style.display ="block";
}

function validateDob(){
  let today = new Date();
  today.setFullYear(today.getFullYear() -18);
  let validDate = document.getElementById('dob');
  let maxDate = document.createAttribute("max");
  let year = today.getFullYear();
  let month = today.getMonth()+1;
  let day = today.getDate();
  let newDay = day>=10 ? '0'+day:day;
  let newMonth = month>=10? '0'+month:month;
  let newDate=day+'/'+month+'/'+year;
   maxDate.value = "2003-10-23";
   console.log(newDate);
   validDate.setAttributeNode(maxDate);

  //document.getElementById('sec').innerHTML = newDate;

}
