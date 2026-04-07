import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import { Placeholder } from "@tiptap/extensions";
import Paragraph from "@tiptap/extension-paragraph";
import Bold from "@tiptap/extension-bold";
import Underline from "@tiptap/extension-underline";
import Link from "@tiptap/extension-link";
import BulletList from "@tiptap/extension-bullet-list";
import OrderedList from "@tiptap/extension-ordered-list";
import ListItem from "@tiptap/extension-list-item";
import axios from "axios";
import Swal from "sweetalert2";

function initEditor(content: string): Editor {
    const editor = new Editor({
        element: document.querySelector("#csr-editor [data-hs-editor-field]") as HTMLElement,
        editorProps: {
            attributes: {
                class: "tiptap relative min-h-48 p-3 text-sm text-foreground",
            },
        },
        extensions: [
            StarterKit.configure(),
            Placeholder.configure({
                placeholder: "Describe the CSR activity in detail…",
                emptyNodeClass: "before:text-muted-foreground-1",
            }),
            Paragraph.configure({
                HTMLAttributes: { class: "text-sm text-foreground" },
            }),
            Bold.configure({
                HTMLAttributes: { class: "font-bold" },
            }),
            Underline,
            Link.configure({
                HTMLAttributes: {
                    class:
                        "inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-white",
                },
            }),
            BulletList.configure({
                HTMLAttributes: { class: "list-disc list-inside text-foreground" },
            }),
            OrderedList.configure({
                HTMLAttributes: { class: "list-decimal list-inside text-foreground" },
            }),
            ListItem.configure({
                HTMLAttributes: { class: "marker:text-sm" },
            }),
        ],
    });

    // Sync editor content into Alpine's form.csr_content on every update
    editor.on("update", () => {
        const alpineEl = document.querySelector("[x-data]") as any;
        if (alpineEl) {
            content = editor.getHTML();
        }
    });

    // Expose globally so Alpine can call getHTML() during validate()
    (window as any).__csrEditor = editor;

    const toolbarActions: { sel: string; fn: () => void }[] = [
        { sel: "[data-hs-editor-bold]", fn: () => editor.chain().focus().toggleBold().run() },
        { sel: "[data-hs-editor-italic]", fn: () => editor.chain().focus().toggleItalic().run() },
        { sel: "[data-hs-editor-underline]", fn: () => editor.chain().focus().toggleUnderline().run() },
        { sel: "[data-hs-editor-strike]", fn: () => editor.chain().focus().toggleStrike().run() },
        {
            sel: "[data-hs-editor-link]",
            fn: () => {
                const url = window.prompt("Enter URL:");
                if (url) editor.chain().focus().extendMarkRange("link").setLink({ href: url }).run();
            },
        },
        { sel: "[data-hs-editor-ol]", fn: () => editor.chain().focus().toggleOrderedList().run() },
        { sel: "[data-hs-editor-ul]", fn: () => editor.chain().focus().toggleBulletList().run() },
        { sel: "[data-hs-editor-blockquote]", fn: () => editor.chain().focus().toggleBlockquote().run() },
        { sel: "[data-hs-editor-code]", fn: () => editor.chain().focus().toggleCode().run() },
    ];

    toolbarActions.forEach(({ sel, fn }) => {
        document.querySelector(`#csr-editor ${sel}`)?.addEventListener("click", fn);
    });

    return editor;
}

export default function CsrFormPage() {
    Alpine.data("csrForm", (csrf_token: string) => ({
        csrf_token,
        editor: null as Editor | null,
        submitting: false,
        imagePreview: null as string | null,
        imageFile: null as File | null,

        form: {
            csr_title: "",
            csr_content: "",
            csr_date: "",
            csr_active: true,
        },

        errors: {
            csr_title: "",
            csr_content: "",
            csr_date: "",
            csr_image: "",
        },

        init() {
            this.editor = initEditor(this.form.csr_content);
        },

        validate(): boolean {
            let valid = true;
            this.errors = {
                csr_title: "",
                csr_content: "",
                csr_date: "",
                csr_image: "",
            };

            if (!this.form.csr_title.trim()) {
                this.errors.csr_title = "Title is required.";
                valid = false;
            }

            const editor = (window as any).__csrEditor as Editor | undefined;
            if (editor) {
                this.form.csr_content = editor.getHTML();
            }

            if (!this.form.csr_content || this.form.csr_content === "<p></p>") {
                this.errors.csr_content = "Content is required.";
                valid = false;
            }

            if (!this.form.csr_date) {
                this.errors.csr_date = "Activity date is required.";
                valid = false;
            }

            return valid;
        },

        async submit() {
            if (!this.validate()) return;

            this.submitting = true;

            try {
                const { data } = await axios.post("/api/csr", {
                    csrf_token: this.csrf_token,
                    csr_title: this.form.csr_title,
                    csr_content: this.form.csr_content,
                    csr_date: this.form.csr_date,
                });

                if (data.csrf_token) this.csrf_token = data.csrf_token;

                this.form.csr_date = '';
                this.form.csr_title = '';
                this.editor?.destroy()
                this.init();

                Swal.fire({
                    title: 'Successful',
                    text: data.message,
                    icon: 'success'
                })
            } catch (err) {
                console.error("Submit error:", err);
            } finally {
                this.submitting = false;
            }
        },
    }));
}