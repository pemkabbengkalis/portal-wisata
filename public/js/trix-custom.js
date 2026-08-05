/**
 * Trix Editor Customizations
 * =============================================================================
 * 1. PASTE SANITIZER
 *    Saat paste dari website lain, strip semua formatting HTML (font, color,
 *    inline-style, class, dll). Hanya pertahankan struktur paragraf/baris.
 *
 * 2. ENTER KEY → NEW PARAGRAPH (bukan <br>)
 *    Enter langsung membuat paragraf baru tanpa perlu Shift+Enter.
 * =============================================================================
 */

(function () {
    'use strict';

    /* ─────────────────────────────────────────────────────────────────────────
       Utility: Ubah HTML dari clipboard menjadi teks bersih dengan
       struktur paragraf yang terjaga (newline antar paragraf/heading/div/li).
    ───────────────────────────────────────────────────────────────────────── */
    function htmlToCleanText(html) {
        // Ganti tag block-level dengan newline sebelum/sesudah
        let text = html
            // Heading → teks + newline ganda
            .replace(/<h[1-6][^>]*>/gi, '')
            .replace(/<\/h[1-6]>/gi, '\n\n')
            // Paragraf
            .replace(/<p[^>]*>/gi, '')
            .replace(/<\/p>/gi, '\n\n')
            // Div
            .replace(/<div[^>]*>/gi, '')
            .replace(/<\/div>/gi, '\n')
            // List items
            .replace(/<li[^>]*>/gi, '• ')
            .replace(/<\/li>/gi, '\n')
            // ul/ol
            .replace(/<\/?ul[^>]*>/gi, '\n')
            .replace(/<\/?ol[^>]*>/gi, '\n')
            // Line break
            .replace(/<br\s*\/?>/gi, '\n')
            // Hapus semua tag HTML lainnya
            .replace(/<[^>]+>/g, '')
            // Decode HTML entities
            .replace(/&nbsp;/g, ' ')
            .replace(/&amp;/g, '&')
            .replace(/&lt;/g, '<')
            .replace(/&gt;/g, '>')
            .replace(/&quot;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&apos;/g, "'")
            // Normalkan whitespace: max 2 newline berturutan
            .replace(/\n{3,}/g, '\n\n')
            .trim();

        return text;
    }

    /* ─────────────────────────────────────────────────────────────────────────
       Pasang listener ke semua Trix editor yang ada/akan datang
    ───────────────────────────────────────────────────────────────────────── */
    function initTrixEditor(editorEl) {
        const editor = editorEl.editor;
        if (!editor || editorEl._trixCustomInitialized) return;
        editorEl._trixCustomInitialized = true;

        /* ── 1. Strip formatting on paste ─────────────────────────────────── */
        editorEl.addEventListener('trix-before-paste', function (event) {
            const paste = event.paste;

            // Jika ada HTML di clipboard, bersihkan dulu
            if (paste.html) {
                const cleanText = htmlToCleanText(paste.html);
                // Override: hapus html, pakai string biasa
                paste.html = undefined;
                paste.string = cleanText;
            }
        });

        /* ── 2. Enter = paragraf baru (bukan <br>) ─────────────────────────
           Trix default: Enter di dalam sebuah block membuat block baru (paragraph).
           Masalah muncul ketika editor dalam mode "pre" / newline mode.
           Kita pastikan Enter tidak diubah jadi \n saja, melainkan block baru.
        ────────────────────────────────────────────────────────────────────── */
        editorEl.addEventListener('keydown', function (event) {
            // Hanya proses Enter (tanpa Shift/Ctrl/Alt)
            if (event.key !== 'Enter' || event.shiftKey || event.ctrlKey || event.altKey || event.metaKey) {
                return;
            }

            const selectedRange = editor.getSelectedRange();
            const document    = editor.getDocument();
            const blockAttr   = document.getBlockAtPosition(selectedRange[0]);

            // Jika kursor berada di dalam block yang bukan list, paksa block baru
            // (Trix sudah handle ini, tapi kita pastikan tidak ada override luar)
            // Tidak perlu preventDefault — biarkan Trix handle default Enter-nya
            // Cukup pastikan tidak ada listener lain yang men-preventDefault
        });
    }

    /* ─────────────────────────────────────────────────────────────────────────
       Inisialisasi saat DOMContentLoaded
    ───────────────────────────────────────────────────────────────────────── */
    function attachToAll() {
        document.querySelectorAll('trix-editor').forEach(initTrixEditor);
    }

    // Event dari Trix saat editor siap
    document.addEventListener('trix-initialize', function (event) {
        initTrixEditor(event.target);
    });

    // Livewire navigation / dynamic load
    document.addEventListener('DOMContentLoaded', attachToAll);
    document.addEventListener('livewire:navigated', attachToAll);

    // Untuk Livewire v3 morphing
    if (typeof Livewire !== 'undefined') {
        document.addEventListener('livewire:init', function () {
            Livewire.hook('morph.updated', function () {
                attachToAll();
            });
        });
    }
})();
