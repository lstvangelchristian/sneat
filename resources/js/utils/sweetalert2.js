export const showResult = result => {
  Swal.fire({
    title: result.title,
    text: result.text,
    icon: result.icon
  });
};
