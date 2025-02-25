var map = L.map('maplet').setView([-25.9692, 32.5732], 13); // Maputo, Moçambique

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);


var marker = L.marker([-25.9667, 32.5833]).addTo(mymap); // Adicionando um marcador inicial
var polygon;

var locations = {
    "Maputo": {
        "KaMpfumu": ["KaMpfumu, Maputo", [
            "Alto Maé A", "Alto Maé B", "Central A", "Central B", "Central C", "Coop",
            "Malhangalene A", "Malhangalene B", "Polana-Cimento A", "Polana-Cimento B", "Sommerschield"
        ]],
        "KaNlhamankulu": ["KaNlhamankulu, Maputo", [
            "AeroportoA", "Aeroporto B", "Chamanculo A", "Chamanculo B", "Chamanculo C",
            "ChamanculoD", "Malanga", "Minkadjuine", "Munhuana", "Unidade 7", "Xipamanine"
        ]],
        "KaMaxakeni": ["KaMaxakeni, Maputo", [
            "Mafalala", "Maxaquene A", "Maxaquene B", "Maxaquene C", "Maxaquene D",
            "Polana Caniço A", "Polana Caniço B", "Urbanização"
        ]],
        "KaMavota": ["KaMavota, Maputo", [
            "3 de Fevereiro", "Albazine", "Costa do Sol", "F.P.L.M.", "Ferroviário",
            "Hulene A", "Hulene B", "Laulane", "Mahotas", "Mavalane A", "Mavalane B"
        ]],
        "KaMubukwana": ["KaMubukwana, Maputo", [
            "25 de Junho A", "25 de Junho B", "Bagamoyo", "George Dimitrov", "Inhagóia A",
            "Inhagóia B", "Jardim", "Luis Cabral", "Magoanine A", "Magoanine B", "MagoanineC",
            "Malhazine", "Nsalene", "Zimpeto"
        ]],
        "KaTembe": ["KaTembe, Maputo", [
            "Inguide", "Incassane", "Guachene", "Chali", "Chamissava"
        ]],
        "KaNyaka": ["KaNyaka, Maputo", [
            "Ribzwene", "Inguane", "Nhanquene"
        ]]
    }
};

 // Preencher o select de cidades baseado na província selecionada
 $('#provincia').change(function(){
    var provincia = $(this).val();
    var cidades = Object.keys(locations[provincia] || {});
    
    $('#cidade').empty().append('<option value="">Selecione a Cidade</option>');
    
    cidades.forEach(function(cidade){
        $('#cidade').append('<option value="'+cidade+'">'+cidade+'</option>');
    });
});

// Preencher o select de distritos baseado na cidade selecionada
$('#cidade').change(function(){
    var cidade = $(this).val();
    var distritos = Object.keys(locations["Maputo"]); // Considerando apenas os distritos de Maputo
    
    $('#distrito').empty().append('<option value="">Selecione o Distrito</option>');
    
    distritos.forEach(function(distrito){
        $('#distrito').append('<option value="'+distrito+'">'+distrito+'</option>');
    });
});

// Preencher o select de bairros baseado no distrito selecionado
$('#distrito').change(function(){
    var cidade = $('#cidade').val();
    var distrito = $(this).val();
    
    var bairros = locations[cidade][distrito][1];
    
    $('#bairro').empty().append('<option value="">Selecione o Bairro</option>');
    
    bairros.forEach(function(bairro){
        $('#bairro').append('<option value="'+bairro+'">'+bairro+'</option>');
    });
});

function zoomToLocation() {
    var cidade = $("#cidade").val();
    var distrito = $("#distrito").val();
    var bairro = $("#bairro").val();
    
    var place = bairro + ", " + distrito + ", " + cidade;

    $.getJSON('https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' + place, function(data) {
        if(data && data.length > 0) {
            var lat = data[0].lat;
            var lon = data[0].lon;
            
            mymap.setView([lat, lon], 17);
            marker.setLatLng([lat, lon]); // Atualizando a posição do marcador
                        
        } else {
            alert("Localização não encontrada!");
        }
    });
    }