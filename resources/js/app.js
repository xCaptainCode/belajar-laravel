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
                [{ color: [] }, { background: [] }],
                ['link', 'image', 'video'],
                [{ indent: '-1' }, { indent: '+1' }, { align: [] }],
                [{ list: 'ordered' }, { list: 'bullet' },],
                ['code-block', 'blockquote', 'formula'],
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

// buat floating button untuk id = "floating-button"
const floatingButton = document.getElementById('floating-button');
if (floatingButton) {
    const buttonSize = 40; // ukuran tombol dalam piksel
    const margin = 17; // jarak dari tepi layar dalam piksel

    function updateButtonPosition() {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        floatingButton.style.position = 'fixed';
        floatingButton.style.width = `${buttonSize}px`;
        floatingButton.style.height = `${buttonSize}px`;
        floatingButton.style.bottom = `${margin}px`;
        floatingButton.style.right = `${margin}px`;
    }

    // Panggil fungsi untuk mengatur posisi awal
    updateButtonPosition();

    // Perbarui posisi tombol saat jendela diubah ukurannya
    window.addEventListener('resize', updateButtonPosition);
}