document.addEventListener('DOMContentLoaded', function() {
    const passagerRadio = document.getElementById('passagerRadio');
    const chauffeurRadio = document.querySelector('input[value="chauffeur"]');
    const chauffeurFields = document.getElementById('chauffeurFields');
    const voitureFields = document.getElementById('voitureFields');
    const formulaire = document.getElementById('formulaire');
    const userType = document.getElementById('userType');
    disableFormFields();

    passagerRadio.addEventListener('change', toggleFormFields);
    chauffeurRadio.addEventListener('change', toggleFormFields);
    passagerRadio.addEventListener('change', function() {
        userType.value = 'passager';
    });
    
    chauffeurRadio.addEventListener('change', function() {
        userType.value = 'chauffeur';
    });

    function toggleFormFields() {
        if (passagerRadio.checked) {
            disableChauffeurFields();
            disablevoitureFields();
            enableFormFields();
            chauffeurFields.querySelectorAll('input[required], select[required]').forEach(function(element) {
                element.removeAttribute('required');
            });
            voitureFields.querySelectorAll('input[required], select[required]').forEach(function(element) {
                element.removeAttribute('required');
            });
            chauffeurFields.style.display = 'none';
            voitureFields.style.display = 'none';
        } else if (chauffeurRadio.checked) {
            enableFormFields();
            chauffeurFields.style.display = 'block';
            voitureFields.style.display = 'block';
        }
    }

    function enableFormFields() {
        formulaire.querySelectorAll('input, select').forEach(function(element) {
            element.removeAttribute('disabled');
        });
    }

    function disableFormFields() {
        formulaire.querySelectorAll('input, select').forEach(function(element) {
            element.setAttribute('disabled', 'disabled');
        });
       
    }
    function disableChauffeurFields() {
           
        chauffeurFields.querySelectorAll('input, select').forEach(function(element) {
            element.setAttribute('disabled', 'disabled');
        });
    }
    function disablevoitureFields() {
           
        voitureFields.querySelectorAll('input, select').forEach(function(element) {
            element.setAttribute('disabled', 'disabled');
        });
    }
        
    });
