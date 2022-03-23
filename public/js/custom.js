const remove = function (form) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dipulihkan kembali!",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d64343',
        cancelButtonColor: '#969696',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal!'
    }).then((result) => {
        if (result.value) {
            form.submit();
        }
    });
};