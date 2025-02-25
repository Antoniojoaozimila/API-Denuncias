var mymap = L.map('maplet').setView([-25.9692, 32.5732], 13); // Posição inicial provisória

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(mymap);

var marker;
var circle;

// Função para configurar o mapa na localização atual do usuário
function setLocation(lat, lon) {
    mymap.setView([lat, lon], 17); // Ajusta o zoom conforme necessário
    marker = L.marker([lat, lon]).addTo(mymap);
    
    // Adiciona um círculo com um raio de 4 centímetros
    circle = L.circle([lat, lon], {
        color: 'blue',
        fillColor: '#30f',
        fillOpacity: 0.2,
        radius: 0.04 // Raio em metros (4 cm)
    }).addTo(mymap);
}

// Obtém a localização atual do usuário
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        setLocation(lat, lon);
    }, function(error) {
        console.error('Erro ao obter localização:', error);
        alert('Não foi possível obter a localização atual.');
    });
} else {
    console.error('Geolocalização não é suportada por este navegador.');
    alert('Geolocalização não é suportada por este navegador.');
}

var locations = {
    "Maputo": {
        "KaMpfumu": ["KaMpfumu, Maputo", [
            "Alto Maé A", "Alto Maé B", "Bairro Central A", "Bairro Central B", "Bairro Central C", "Coop",
            "Malhangalene", "Malhangalene B", "Polana-Cimento A", "Polana-Cimento B", "Sommerschield"
        ]],
        "KaNlhamankulu": ["KaNlhamankulu, Maputo", [
            "Aeroporto A", "Aeroporto B", "Chamanculo A", "Chamanculo B", "Chamanculo C",
            "Chamanculo D", "Malanga", "Minkadjuine", "Munhuana", "Unidade 7", "Xipamanine"
        ]],
        "KaMaxakeni": ["KaMaxakeni, Maputo", [
            "Mafalala", "Maxaquene A", "Maxaquene C", "Maxaquene D",
            "Polana Caniço A", "Polana Caniço B", "Urbanização"
        ]],
        "KaMavota": ["KaMavota, Maputo", [
            "3 de Fevereiro", "Albazine", "Costa do Sol", "F.P.L.M.", "Ferroviário",
            "Hulene A", "Hulene B", "Laulane", "Mahotas", "Mavalane A", "Mavalane B"
        ]],
        "KaMubukwana": ["KaMubukwana, Maputo", [
            "25 de Junho A", "25 de Junho B", "Bagamoyo", "George Dimitrov", "Inhagóia A",
            "Inhagóia B", "Jardim", "Luis Cabral", "Magoanine A", "Magoanine B", "Magoanine C",
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

$('#provincia').change(function(){
    var provincia = $(this).val();
    var cidades = Object.keys(locations[provincia] || {});
    
    $('#cidade').empty().append('<option value="">Selecione a Cidade</option>');
    
    cidades.forEach(function(cidade){
        $('#cidade').append('<option value="'+cidade+'">'+cidade+'</option>');
    });
});

$('#cidade').change(function(){
    var cidade = $(this).val();
    var distritos = Object.keys(locations["Maputo"]);
    
    $('#distrito').empty().append('<option value="">Selecione o Distrito</option>');
    
    distritos.forEach(function(distrito){
        $('#distrito').append('<option value="'+distrito+'">'+distrito+'</option>');
    });
});

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
            marker.setLatLng([lat, lon]);
            circle.setLatLng([lat, lon]); // Atualiza a posição do círculo
                        
        } else {
            alert("Localização não encontrada!");
        }
    });
}

mymap.on('click', function (e) {
    var latitude = e.latlng.lat;
    var longitude = e.latlng.lng;

    console.log("Latitude atual:", latitude);
    console.log("Longitude atual:", longitude);

    if (marker) {
        mymap.removeLayer(marker);
    }
    if (circle) {
        mymap.removeLayer(circle);
    }

    marker = L.marker([latitude, longitude]).addTo(mymap);

    // Adiciona um círculo com um raio de 4 centímetros
    circle = L.circle([latitude, longitude], {
        color: 'blue',
        fillColor: '#30f',
        fillOpacity: 0.2,
        radius: 0.04 // Raio em metros (4 cm)
    }).addTo(mymap);

    document.getElementById('latitude').value = latitude;
    document.getElementById('longitude').value = longitude;

    var popup = L.popup()
        .setLatLng(e.latlng)
        .setContent('<p>Deseja usar sua localização atual?</p><button id="useCurrentLocation">Sim</button><button id="cancel">Cancelar</button>')
        .openOn(mymap);

    document.getElementById('useCurrentLocation').onclick = function () {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('localizacao').value = data.display_name;
                mymap.closePopup(popup);
            })
            .catch(error => {
                console.error('Erro ao obter o nome do local:', error);
                document.getElementById('localizacao').value = latitude + ', ' + longitude;
                mymap.closePopup(popup);
            });
    };

    document.getElementById('cancel').onclick = function () {
        mymap.closePopup(popup);
    };
});
