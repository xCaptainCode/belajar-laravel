import 'flowbite';
import './bootstrap';

import Quill from 'quill';
import 'quill/dist/quill.snow.css';

// Global init function biar gampang dipanggil di Blade
window.initQuill = function (selector, hiddenInputId) {
    const quill = new Quill(selector, {
        theme: 'snow',
        placeholder: 'Tulis artikelmu di sini...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'blockquote', 'code-block', 'image'],
                ['clean']
            ]
        }
    });

    // Sinkronisasi isi editor ke hidden input
    const hiddenInput = document.getElementById(hiddenInputId);
    quill.on('text-change', function () {
        hiddenInput.value = quill.root.innerHTML;
    });

    return quill;
}