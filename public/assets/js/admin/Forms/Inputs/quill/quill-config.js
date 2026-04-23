document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="editor-"]').forEach(div => {
        const id = div.id.replace('editor-', '');

        const quill = new Quill(`#editor-${id}`, {
            theme: 'snow',
            placeholder: 'Escriba aquí...',
            modules: {
                toolbar: [
                    [{ size: ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline'],
                    [{ color: [] }, { background: [] }],
                    [{ align: [] }],
                    ['link', 'image', 'video'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['blockquote'],
                    ['clean']
                ]
            }
        });

        const hiddenField = document.getElementById(id);

        if (hiddenField) {
            quill.on('text-change', function () {
                const content = quill.root.innerHTML;
                hiddenField.value = content;

                validateContent(content);
            });

            const initialContent = hiddenField.value;
            if (initialContent) {
                quill.root.innerHTML = initialContent;
            }
        }

        const MAX_SIZE_MB = 10;
        const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;
        const MAX_CHARACTERS = 500000;

        let contentExceedsLimit = false;
        function validateContent(content) {
            const contentBlob = new Blob([content], { type: 'text/html' });

            if (contentBlob.size > MAX_SIZE_BYTES || content.replace(/<\/?[^>]+(>|$)/g, "").length > MAX_CHARACTERS) {
                if (!contentExceedsLimit) {
                    iziToast.warning({
                        title: 'Advertencia',
                        message: `El contenido excede el tamaño. Se limitaran algunas opciones`,
                        position: 'topRight'
                    });
                    contentExceedsLimit = true; 
                    disableAddingContent(); 
                }
            } else {
                if (contentExceedsLimit) {
                    contentExceedsLimit = false;
                    enableAddingContent();  
                }
            }
        }

        function disableAddingContent() {
            const toolbar = quill.getModule('toolbar');
            const buttons = toolbar.container.querySelectorAll('.ql-image, .ql-link, .ql-video, .ql-bold, .ql-italic, .ql-underline, .ql-list, .ql-indent, .ql-blockquote');
            buttons.forEach(button => button.disabled = true);
        }

        function enableAddingContent() {
            const toolbar = quill.getModule('toolbar');
            const buttons = toolbar.container.querySelectorAll('.ql-image, .ql-link, .ql-video, .ql-bold, .ql-italic, .ql-underline, .ql-list, .ql-indent, .ql-blockquote');
            buttons.forEach(button => button.disabled = false);
        }
    });
});
