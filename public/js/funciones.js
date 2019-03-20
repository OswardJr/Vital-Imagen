function validar(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
//patron =/[A-Za-z\s]/; // 4
patron =/[A-Za-z]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}

function validar_string(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
//patron =/[A-Za-z\s]/; // 4
patron =/[A-Za-z\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}

function validar_username(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
//patron =/[A-Za-z\s]/; // 4
patron =/[A-Za-z1-9]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}

function validar_imc() { // 1
    var altura=parseFloat($('#altura').val());
    var peso=parseFloat($('#peso').val());
    var imc=peso/(altura*altura);
    $('#imc').val(imc).toFixed(2);;
}

function validar_saltos(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
//patron =/[A-Za-z\s]/; // 4
patron =/[A-Za-z\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}