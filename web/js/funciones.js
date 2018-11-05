function controlBorrado($path){
    swal({
        title: "¿Estas seguro/a?",
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

function controlPublicar($path){
    swal({
        title: "¿Estas seguro/a?",
        text: "Si publicas tu posts todos podran verlo!",
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