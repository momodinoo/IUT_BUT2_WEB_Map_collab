var map;

async function init(institutionArray) {
    let config = {
        minZoom: 3,
        maxZoom: 13,
        zoomControl: false,
    };
    const zoom = 6;
    const lat = 47.221891;
    const lng = 2.567447;

    map = L.map("map", config).setView([lat, lng], zoom);
    map.options.minZoom = 6;
    map.options.maxZoom = 17;
    L.control.zoom({position: "topright"}).addTo(map);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '© BadiiiX'
    }).addTo(map);

    $('#ajouter').on("click", getAPI); // ajouter un marqueur

    await addInsitutionMarkers(institutionArray, false);
}

async function getAPI() {
    let address = $("#input-text").val();
    const urlAddress = `https://api-adresse.data.gouv.fr/search/?q=${address}`;

    $.ajax({
        url: urlAddress,
        type: 'GET',
        success: function (data) {
            let ad = data?.features[0]?.properties?.name;
            let urlAPI = `https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-annuaire-education&q=adresse_1=${ad}&rows=-1&facet=identifiant_de_l_etablissement&facet=nom_etablissement&facet=code_postal&facet=nom_commune&facet=position`;
            $.ajax({
                url: urlAPI,
                type: 'GET',
                success: function (data2) {
                    const institutionLine = data2?.records[0]?.fields;
                    if (institutionLine) {
                        addMarker(institutionLine)
                    }
                }
            });
        }
    });
}

async function addInsitutionMarkers(institutionsId, addElementToDb = true) {
    for (let dbId of institutionsId) {
        let institutionLine = await getAPIByInstitutionId(dbId);
        institutionLine = institutionLine?.records[0]?.fields;
        if (institutionLine) {
            addMarker(institutionLine, addElementToDb);
        }
    }
}

function addMarker(
    {position,
    nom_etablissement,
    adresse_1,
    code_postal,
    nom_commune,
    identifiant_de_l_etablissement
    }, addElementToDb = true) {
    let [lat, long] = position;
    new L.marker([lat, long])
        .bindPopup(`${nom_etablissement} <br /> ${adresse_1} <br /> ${code_postal} ${nom_commune} <br />(${lat}, ${long})`)
        .addTo(map);

    if (addElementToDb) {
        $.ajax({
            url: 'php/ajoutEtablissement.php',
            type: 'POST',
            data: {
                idEtab: identifiant_de_l_etablissement
            },
            success: function (data) {
                // ajoute l'établissement à la base de données
            }

        })
    }
}

async function getAPIByInstitutionId(id) {
    let urlAPI = `https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-annuaire-education&q=identifiant_de_l_etablissement%3D${id}&rows=-1&facet=identifiant_de_l_etablissement&facet=nom_etablissement&facet=code_postal&facet=nom_commune&facet=position`;

    return $.ajax({
        url: urlAPI,
        success: function (data) {
            return data;
        }
    });

}
