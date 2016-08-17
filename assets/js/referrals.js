var $j = jQuery.noConflict();
var c = 1;
$j(function(){

    $j("#more").click(function(){
        c++;
         html = '<div>'+
                    '<div class="row separate">'+
                        '<hr>'+
                        '<div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Nombre del contacto" title="Nombre del contacto" name="Name[]" value="" required></div>'+
                        '<div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Telefonos: +58 0416-1234567, +58 412-8910112" title="Telefonos: +58 0416-1234567, +58 412-8910112" name="Phones[]" value=""></div>'+
                        '<div class="col-md-4 col-sm-4 col-xs-12"><input class="form-control" type="text" placeholder="Email: jose@gmail.com, josema@hotmail.com" title="Email: jose@gmail.com, josema@hotmail.com" name="Emails[]" value=""></div>'+
                    '</div>'+
                    '<div class="row separate">'+
                        '<div class="col-md-8 col-sm-8 col-xs-12"><input class="form-control" type="text" placeholder="Redes Sociales: https://www.facebook.com/tunewebinfo, https://instagram.com/tunewebinfo" title="Redes Sociales: https://www.facebook.com/tunewebinfo, https://instagram.com/tunewebinfo" name="social_netwoks[]" value=""></div>'+
                        '<div class="col-md-3 col-sm-3 col-xs-12">'+
                            '<select class="form-control" name="country[]" required>'+
                                '<option value="" selected data-default="">Pais de Origen</option>';
                                for(var i in countries)
                                {
                                    html += '<option value="'+ countries[i].PaisCodigo +'">'+ countries[i].PaisNombre +'</option>';
                                };
                    html += '</select>'+
                        '</div>'+
                        '<div class="col-md-1 col-sm-1 col-xs-12"> <button class="btn btn-danger btn-block remove" type="button">x</button> </div>'+
                    '</div>'+
                '</div>';
        $j("#contenedor").append(html);
    });
    $j( document ).on( "click", ".remove", function() {
        $j( this ).parent().parent().parent().remove();
    });
});