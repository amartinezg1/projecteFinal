$(document).ready(function() {
    $('.mascota').on('click', function() {

        let idPet = $(this).children().eq(0).html();
        $('#sendIdPet').val(idPet);
        $('#formHistory').submit();
    });
});