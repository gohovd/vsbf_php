function getNewsPostModal() {
    var modal = document.createElement("div");
    modal.id = "create-news-modal";
    modal.className = "modal";
    modal.setAttribute("role", "dialog");
    modal.setAttribute("tabIndex", "-1");
    modal.role = "dialog";

    var modal_dialog = document.createElement("div");
    modal_dialog.className = "modal-dialog";
    modal_dialog.setAttribute("role", "document");

    var modal_content = document.createElement("div");
    modal_content.className = "modal-content";

    var modal_header = document.createElement("div");
    modal_header.className = "modal-header";
    var modal_title = document.createElement("h5");
    modal_title.clasName = "modal-title";
    modal_title.innerText = "Create news post";

    var m_close_btn = document.createElement("button");
    m_close_btn.className = "close";
    m_close_btn.setAttribute("data-dismiss", "modal");
    m_close_btn.setAttribute("aria-label", "Close");

    var m_close_btn_span = document.createElement("span");
    m_close_btn_span.setAttribute("aria-hidden", "true");
    m_close_btn_span.innerHTML = "&times;"

    var modal_body = document.createElement("div");
    modal_body.className = "modal-body";

    var modal_footer = document.createElement("div");
    modal_footer.className = "modal-footer";

    var save_btn = document.createElement("button");
    save_btn.id = "create-news-btn";
    save_btn.className = "btn btn-primary";
    save_btn.innerText = "Save changes";
    save_btn.setAttribute("type", "submit");
    save_btn.setAttribute("form", "create-news-form");

    var close_btn = document.createElement("button");
    close_btn.className = "btn btn-secondary";
    close_btn.setAttribute("data-dismiss", "modal");
    close_btn.innerText = "Close";

    // put it together
    modal.appendChild(modal_dialog);
    modal_dialog.appendChild(modal_content);
    modal_content.appendChild(modal_header);
    modal_header.appendChild(modal_title);
    modal_header.appendChild(m_close_btn);
    m_close_btn.appendChild(m_close_btn_span);
    modal_content.appendChild(modal_body);

    // modal_body.appendChild(modal_body_text);
    modal_body.appendChild(getCreateNewsForm());

    modal_content.appendChild(modal_footer);
    modal_footer.appendChild(save_btn);
    modal_footer.appendChild(close_btn);

    return modal;
}

function getCreateNewsForm() {
    var form = document.createElement("form");
    form.setAttribute("action", "./helpers/news-crud.php");
    form.setAttribute("method", "post");
    form.id = "create-news-form";

    var title_form_group = document.createElement("div");
    title_form_group.className = "form-group";

    var label_title = document.createElement("label");
    label_title.setAttribute("for", "news-title");
    label_title.innerText = "Title";

    var title_input = document.createElement("input");
    title_input.className = "form-control";
    title_input.type = "text";
    title_input.name = "title";
    title_input.id = "news-title";

    var content_form_group = document.createElement("div");
    content_form_group.className = "form-group";

    var label_content = document.createElement("label");
    label_content.setAttribute("for", "content-text-area");
    label_content.innerText = "Content";

    var content_text_area = document.createElement("textarea");
    content_text_area.className = "form-control";
    content_text_area.type = "text";
    content_text_area.name = "content";
    content_text_area.id = "content-text-area";
    content_text_area.rows = 3;
    content_text_area.setAttribute("form", "create-news-form");

    var file_form_group = document.createElement("div");
    file_form_group.className = "form-group";

    var label_file_input = document.createElement("label");
    label_file_input.setAttribute("for", "file-input");
    label_file_input.innerText = "Upload image";

    var file_input = document.createElement("input");
    file_input.type = "file";
    file_input.className = "form-control-file";
    file_input.id = "file-input";

    // put it together
    form.appendChild(title_form_group);
    title_form_group.appendChild(label_title);
    title_form_group.appendChild(title_input);

    form.appendChild(content_form_group);
    content_form_group.appendChild(label_content);
    content_form_group.appendChild(content_text_area);

    form.appendChild(file_form_group);
    file_form_group.appendChild(label_file_input);
    file_form_group.appendChild(file_input);

    // TODO: Form validation

    return form;
}