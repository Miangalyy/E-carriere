export function useSwalSuccess(message) {
  Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: message,
    showConfirmButton: false,
    timer: 1800
  });
}

export function useSwalError(message) {
  Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: message,
    showConfirmButton: false,
    timer: 5000
  });
}

export function useSwalConfirm(message, callback) {
  Swal.fire({
    title: 'Are you sure?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#2a2185',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oui, continuer.',
    cancelButtonText: 'Non, fermer.',
  }).then((result) => {
    if (result.isConfirmed) {
      callback()
    } else if (result.isDenied) {
      Swal.close()
    }
  })
}