
const tamano = ["Chico", "Mediano", "Grande"];
const tipoCaso = ["Perdido", "Robado"];
const sexo = ["Macho", "Hembra"];
const animal = ["Perros", "Gatos", "Otros"];
const raza = ["Pitbull Terrier", "Border Collie", "Golden Retriever", "Mestizo", "Schnowzer Mini", "Boxer", "BullDog Frances", "Cocker", "Caniche", "Labrador Retriever",
    "Balinés", "Bengal", "Bosque de Noruega", "Britanico", "Cornish Rex", "Devon Rex", "Exótico", "Maine Coon", "Común Europeo (mestizo)", "Abisinio", "Otro"
];
let paginaActual = 1;
let filasPorPagina = 25;

(function ($, Drupal) {
    Drupal.behaviors.myModuleBehavior = {
      attach: function (context, settings) {

        //Esto va a ser ejecutado Onload

        console.log("HOLA A TODIS")
        let form = $('#formMascotas');
        form.on('submit', function(ev) {
            ev.preventDefault();
            filtrar();
        });
    
        function filtrar() {
            var input, table, tr, td, i;
            tipoMascota = $("#tipoMascota").val().toUpperCase();
            razaMascota = $("#razaMascota").val().toUpperCase();
            sexoMascota = $("#sexoMascota").val().toUpperCase();
            console.log(tipoMascota);
            console.log(razaMascota);
            console.log(sexoMascota);
            table = document.getElementById("tablaMascota");
            tr = table.getElementsByTagName("tr");
    
            for (let i = 1; i < tr.length; i++) {
                tipoVal = tr[i].children[3].textContent.toUpperCase();
                razaVal = tr[i].children[4].textContent.toUpperCase();
                sexoVal = tr[i].children[5].textContent.toUpperCase();
    
    
                if (tipoVal.toUpperCase().indexOf(tipoMascota) > -1 || tipoMascota == "ALL") {
                    if (razaVal.toUpperCase().indexOf(razaMascota) > -1 || razaMascota == "ALL") {
                        if (sexoVal.toUpperCase().indexOf(sexoMascota) > -1 || sexoMascota == "ALL") {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
    
                    } else {
                        tr[i].style.display = "none";
                    }
    
                } else {
                    tr[i].style.display = "none";
                }
    
    
    
            }
            /* for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            } */
        }
    
        $("#tipoMascota").change(e => {
            let tipoMascota = $("#tipoMascota").val().toUpperCase();
            switch (tipoMascota) {
                case "PERRO":
    
                    let razaPerro = ["Pitbull Terrier", "Border Collie", "Golden Retriever",
                        "Mestizo", "Schnowzer Mini", , "Boxer", "BullDog Frances", "Cocker", "Caniche",
                        "Labrador Retriever"
                    ];
                    razaPerro.sort();
                    $('#razaMascota').empty();
                    $('#razaMascota').append($('<option>', {
                        value: "all",
                        selected: "selected",
                        text: "- Todas -"
                    }))
                    razaPerro.forEach(item => {
                        $('#razaMascota').append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                    break;
    
                case "GATO":
    
                    let razaGato = ["Balinés", "Bengal", "Bosque de Noruega", "Britanico", "Cornish Rex", "Devon Rex",
                        "Exótico", "Maine Coon", "Común Europeo (mestizo)", "Abisinio", "Otro"
                    ];
                    razaGato.sort();
                    $('#razaMascota').empty();
                    $('#razaMascota').append($('<option>', {
                        value: "all",
                        selected: "selected",
                        text: "- Todas -",
                    }))
                    razaGato.forEach(item => {
                        $('#razaMascota').append($('<option>', {
                            value: item,
                            text: item,
                        }));
                    });
                    break;
    
                default:
                    $('#razaMascota').empty();
                    $('#razaMascota').append($('<option>', {
                        value: "all",
                        selected: "selected",
                        text: "- Todas -",
                    }))
                    break;
            }
        });
      }
    };
  }(jQuery, Drupal, drupalSettings));
  
