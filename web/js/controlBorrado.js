function controlBorrado($path){
    swal({
        title: "¿Estas seguro?",
        text: "Si eliges continuar no podras recuperar tu post!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.replace($path);
            }
        });
}