export const showResult = result => {
  Swal.fire({
    title: result.title,
    text: result.text,
    icon: result.icon
  });
};

export const confirmDeletion = async deleteData => {
  Swal.fire({
    title: `Are you sure you want to delete this ${deleteData.title}?`,
    text: 'This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(async result => {
    if (result.isConfirmed) {
      try {
        await deleteData.onConfirmDelete();
        await Swal.fire({
          title: 'Deleted!',
          text: `Your ${deleteData.title} has been deleted.`,
          icon: 'success'
        });
      } catch (err) {
        await Swal.fire({
          title: 'Error!',
          text: `Failed to delete ${deleteData.title}.`,
          icon: 'error'
        });
      }
    }
  });
};
