    function confirmarEliminar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí colocarías la lógica para eliminar el usuario
                Swal.fire('Eliminado', 'El usuario ha sido eliminado correctamente.', 'success');
            } else {
                Swal.fire('Cancelado', 'Eliminación cancelada.', 'info');
            }
        });
    }