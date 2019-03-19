<?php
    require_once('menu.php');
?>
<div class="footer text-center">
    Sistema administrativo UMI Clínica la paz&copy; 2017 (todos los derechos reservados). 
</div>    
</div>
<script src="../public/js/jquery.js"></script>
<script src="../public/jquery-ui/jquery-ui.min.js"></script>
<script src="../public/js/datepicker-es.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
<script src="../public/fullcalendar/lib/moment.min.js"></script>
<script src="../public/fullcalendar/fullcalendar.js"></script>
<script src="../public/fullcalendar/locale-all.js"></script>
<script src="../public/js/sweetalert2.min.js"></script>
<script src="../public/js/d3.v3.min.js"></script>
<script src="../public/c3-0.4.18/c3.min.js"></script>
<script src="../public/js/pagelca-scripts.js"></script>
<script src="../public/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabla').addClass('table-bordered');
        $('#tabla').DataTable({
            "language": {
                "lengthMenu": "Registros por pagina: _MENU_",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay Registros disponibles",
                "infoFiltered": "(filtrada de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "<i class='fa fa-search'></i>",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "next": "<i class='fa fa-angle-double-right'></i>",
                    "previous": "<i class='fa fa-angle-double-left'></i>"
                },
            }

        });
    });

</script>
<script>
    $('.side-menu .submenu').hover(function(){
       $(this).parent().find('a').css('text-decoration','none'); 
    });
    
    $(document).ready(function() {

        if($('#wrapper.LgTemplate').lenght = 1){
            $('#wrapper .bread-content').find('.container').addClass('container-fluid');
            $('#wrapper .bread-content').find('.container-fluid').removeClass('container');
        }
        
        $('.preloader-lca').fadeOut();
        
        $('.btn-responsive').click(function(){
            $(this).find('i').toggleClass('fa-caret-left');
            $(this).find('i').toggleClass('fa-caret-right');
            $('#wrapper').toggleClass('LgTemplate');
           if($('#wrapper.LgTemplate').lenght = 1){
                $('#wrapper .bread-content').find('.container').addClass('container-fluid');
                $('#wrapper .bread-content').find('.container-fluid').removeClass('container');
           }else{
                 $('#wrapper .bread-content').find('.container-fluid').addClass('container');
                 $('#wrapper .bread-content').find('.container').removeClass('container-fluid');
           }
        });
    });

</script>
<script type="text/javascript">
     $(document).ready(function() {

        $.get('citas/getcitas.php',function(data)
{
    var myevents = JSON.parse(data);
    var calendar = $('#calendar').fullCalendar({
        locale: 'es',
        editable: true,
        header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
            },
        events : myevents,
        });
        }

    ); 
  

});
 </script>
 <script>
            $(document).ready(function(){
               
               var date=new Date();
               var dia=date.getDate();
               var mes=date.getMonth()+1;
               var yyy=date.getFullYear();
               var fecha= dia + " " + "/" + " " + mes+ " "+"/"+" "+ yyy;
               $('#fecha').html(fecha); 
             });
        </script>
</body>

</html>
