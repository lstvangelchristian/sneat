<script>
  document.addEventListener('DOMContentLoaded', () => {
    $(() => {
      const makeBlogFieldResize = () => {
        $('#blog-content').on("focus", function () {
          $(this).attr("rows", 5);
        });

        $('#blog-content').on("blur", function () {
          if ($(this).val()) return;
          $(this).attr("rows", 1);
        });
      }

      makeBlogFieldResize()

      const disableCreateButton = (newBlog) => {
        if (newBlog.content !== '' && newBlog.content.length >= 10) {
          $('#create-blog-form')
            .find('button[type="submit"]')
            .prop("disabled", true);
        }
      }

      const enableCreateButton = () => {
        $('#create-blog-form')
          .find('button[type="submit"]')
          .prop("disabled", false);
      }

      const createBlog = () => {
        $('#create-blog-form').on('submit', (e) => {
          e.preventDefault();

          const createBlogFormData = new FormData($('#create-blog-form')[0]);

          const newBlog = { content: createBlogFormData.get('blog-content') };

          disableCreateButton(newBlog)

          $.ajax({
            url: '{{ route('create-blog') }}',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(newBlog),
            success: function (response) {
              enableCreateButton()

              $('#blog-content').attr('rows', 1).val('');
              $('#create-blog-form')[0].reset();

              showResult({success: true})
            },
            error: function (xhr) {
              if (xhr.status === 422) {
                showResult(xhr.responseJSON.errors.content[0]);
                return;
              }
              showResult(xhr.error);
            }
          })
        })
      }

      createBlog()

      const showResult = (result) => {
        if (result.success) {
          Swal.fire({
            title: "Your blog has been posted successfully",
            text: "Click the button to close",
            icon: "success"
          });

          return;
        }

        Swal.fire({
          title: result,
          text: "Click the button to close",
          icon: "error"
        });
      }
    })
  })
</script>
