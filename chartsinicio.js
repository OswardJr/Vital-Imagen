$(document).ready(function(){
    
   Morris.Donut({
  element: 'paciente',
  data: [
    {label: "Pacientes Registrados", value: pacientes}
  ],
       labelColor: 'gray',
        colors: [
        '#1ca8dd',
        '#1ca',
        ],
       resize:true
}); 
    
Morris.Donut({
  element: 'inventario',
  data: [
    {label: "Productos disponibles", value: productos},
    {label: "Categorias registradas", value: categorias},
    {label: "Numero de proveedores", value: proveedores}
  ],
       labelColor: 'gray',
        colors: [
        '#1ca8dd',
        '#1ca',
        'chocolate'    
        ],
       resize:true
});    
    
Morris.Donut({
  element: 'otracosa',
  data: [
    {label: "Especialidades", value: especialidad},
    {label: "Doctores registrados", value: doctores}
  ],
       labelColor: 'gray',
        colors: [
        '#1ca8dd',
        '#1ca'
        ],
       resize:true
}); 
});