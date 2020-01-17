function getNewsPostModal(data) {
    var modal = document.createElement("div");
    modal.id = (data != undefined) ? "update-news-modal" : "create-news-modal";
    modal.className = "modal";
    modal.setAttribute("role", "dialog");
    modal.setAttribute("tabIndex", "-1");
    modal.role = "dialog";

    var modal_dialog = document.createElement("div");
    modal_dialog.className = "modal-dialog";
    modal_dialog.setAttribute("role", "document");

    var modal_content = document.createElement("div");
    modal_content.className = "modal-content";
    modal_content.id = "modal-box";

    var modal_header = document.createElement("div");
    modal_header.className = "modal-header";
    var modal_title = document.createElement("h5");
    modal_title.clasName = "modal-title";
    modal_title.innerText = (data != undefined) ? "Endre innlegg" : "Skriv nytt innlegg";

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
    save_btn.innerText = "Lagre";
    save_btn.setAttribute("type", "submit");
    if (data != undefined) {
        save_btn.setAttribute("form", "update-news-form");
    } else {
        save_btn.setAttribute("form", "create-news-form");
    }

    var close_btn = document.createElement("button");
    close_btn.className = "btn btn-secondary";
    close_btn.setAttribute("data-dismiss", "modal");
    close_btn.innerText = "Lukk";

    // put it together
    modal.appendChild(modal_dialog);
    modal_dialog.appendChild(modal_content);
    modal_content.appendChild(modal_header);
    modal_header.appendChild(modal_title);
    modal_header.appendChild(m_close_btn);
    m_close_btn.appendChild(m_close_btn_span);
    modal_content.appendChild(modal_body);

    // modal_body.appendChild(modal_body_text);
    modal_body.appendChild(getCreateNewsForm(data));

    modal_content.appendChild(modal_footer);
    modal_footer.appendChild(save_btn);
    modal_footer.appendChild(close_btn);

    m_close_btn.addEventListener("click", removeModalsFromDOM);
    close_btn.addEventListener("click", removeModalsFromDOM);

    return modal;
}

function removeModalsFromDOM() {
    var modals = document.getElementsByClassName("modal");
    while(modals[0]) {
        modals[0].parentNode.removeChild(modals[0]);
    }
    tinymce.remove();
}

function getCreateNewsForm(data) {
    var form = document.createElement("form");
    if (data != undefined) {
        form.setAttribute("action", "./helpers/update-post.php");
        form.id = "update-news-form";
    } else {
        form.setAttribute("action", "./helpers/create-post.php");
        form.id = "create-news-form";
    }
    form.setAttribute("method", "post");
    
    var title_form_group = document.createElement("div");
    title_form_group.className = "form-group";

    var label_title = document.createElement("label");
    label_title.setAttribute("for", "news-title");
    label_title.innerText = "Overskrift";

    var title_input = document.createElement("input");
    title_input.className = "form-control";
    title_input.type = "text";
    title_input.name = "title";
    title_input.id = "news-title";
    title_input.minLength = "4";
    title_input.maxLength = "60";
    title_input.required = true;

    var content_form_group = document.createElement("div");
    content_form_group.className = "form-group";

    var label_content = document.createElement("label");
    label_content.setAttribute("for", "content-text-area");
    label_content.innerText = "Innhold";

    var content_text_area = document.createElement("textarea");
    content_text_area.className = "form-control";
    content_text_area.type = "text";
    content_text_area.name = "content";
    content_text_area.id = "content-text-area";
    content_text_area.rows = 3;

    if (data != undefined) {
        content_text_area.setAttribute("form", "update-news-form");
    } else {
        content_text_area.setAttribute("form", "create-news-form");
    }
    
    if (data != undefined) {
        title_input.value = data.title;
        // content_text_area.value = data.content;

        // make hidden input to pass the id of the post
        var post_id = document.createElement("input");
        post_id.setAttribute("type", "hidden");
        post_id.setAttribute("value", data.id);
        post_id.setAttribute("name", "id");
    }

    // var file_form_group = document.createElement("div");
    // file_form_group.className = "form-group";

    // var label_file_input = document.createElement("label");
    // label_file_input.setAttribute("for", "file-input");
    // label_file_input.innerText = "Last opp fil";

    // var file_input = document.createElement("input");
    // file_input.type = "file";
    // file_input.className = "form-control-file";
    // file_input.id = "file-input";
    // file_input.disabled = true;

    // put it together
    form.appendChild(title_form_group);
    title_form_group.appendChild(label_title);
    title_form_group.appendChild(title_input);
    
    if (data != undefined) {
        title_form_group.appendChild(post_id);
    }

    form.appendChild(content_form_group);
    content_form_group.appendChild(label_content);
    content_form_group.appendChild(content_text_area);

    // form.appendChild(file_form_group);
    // file_form_group.appendChild(label_file_input);
    // file_form_group.appendChild(file_input);
    // TODO: Gallery and file upload
    return form;
}

/**
 * adds a HTML btn to every post,
 * adds event listener to every btn,
 * onclick() remove from DB and refresh page
 */
function generatePostDeleteButtons() {
    var posts = document.getElementsByClassName("post-header-btn-row");
    // iterate through posts adding delete buttons
    for (var i = 0; i < posts.length; i++) {
        var delBtn = document.createElement("button");
        delBtn.classList.add("btn", "delete-post-btn", "c-btn");
        delBtn.setAttribute("data-toggle", "tooltip");
        delBtn.setAttribute("data-placement", "right");
        delBtn.setAttribute("title", "Slett inlegg");
        var icon = document.createElement("i");
        icon.className = "fa fa-trash";
        icon.setAttribute("aria-hidden", "true");
        delBtn.appendChild(icon);
        posts[i].appendChild(delBtn);

        delBtn.addEventListener("click", function() {
            var post_id = this.parentElement.parentElement.id;
            deletePost(post_id);
        });
    }

    // In the starting state, the event listener leads to generating the buttons.
    // Now after it is clicked (buttons generated), we remove that event listener function.
    document.getElementById("delete-news").removeEventListener("click", generatePostDeleteButtons);
    // Instead, we add an event listener to remove all these 'delete' buttons on the next click
    document.getElementById("delete-news").addEventListener("click", removePostDeleteButtons);

    // delete all button
    var deleteAllBtn = document.createElement("button");
        deleteAllBtn.className = "btn btn-danger";
        deleteAllBtn.id = "delete-all-posts-btn";
        deleteAllBtn.setAttribute("data-toggle", "tooltip");
        deleteAllBtn.setAttribute("data-placement", "bottom");
        deleteAllBtn.setAttribute("title", "Slett alle innlegg.");

    deleteAllBtn.addEventListener("click", deleteAllWithConfirm);

    var globe_icon = document.createElement("i");
        globe_icon.className = "fa fa-globe";
        globe_icon.setAttribute("aria-hidden", "true");
    deleteAllBtn.appendChild(globe_icon);
    document.getElementById("news-advanced-functions").appendChild(deleteAllBtn);
}

function removePostDeleteButtons() {
    var deleteBtns = document.getElementsByClassName("delete-post-btn");
    var deleteAllBtn = document.getElementById("delete-all-posts-btn");
    while(deleteBtns[0]) {
        deleteBtns[0].parentNode.removeChild(deleteBtns[0]);
    }
    
    document.getElementById("delete-news").addEventListener("click", generatePostDeleteButtons);
    if (deleteAllBtn != null) {
        document.getElementById("news-advanced-functions").removeChild(deleteAllBtn);
    }
}

function deletePost(id) {
    $.ajax({
        type: "POST",
        url: './helpers/delete-post.php',
        data: {
            action: 'delete',
            post_id: id
        },
        success: function(html) {
            // window.location.reload();
            removePostFromDOM(id);
        }
    });
}

function removePostFromDOM(id) {
    var post_to_remove = document.getElementById(id);
    post_to_remove.parentElement.removeChild(post_to_remove);

}

function deleteAllWithConfirm() {
    if (confirm('Er du sikker på at du vil slette alle innlegg?')) {
        // go ahead..
            $.ajax({
                type: "POST",
                url: './helpers/delete-post.php',
                data: {
                    action: 'delete-all'
                },
                success: function(html) {
                    window.location.reload();
                }
            });
    } else {
        return false;
    }
}

function generatePostEditButtons() {
    var posts = document.getElementsByClassName("post-header-btn-row");
    // iterate through posts adding delete buttons
    for (var i = 0; i < posts.length; i++) {
        var editBtn = document.createElement("button");
        editBtn.classList.add("edit-post-btn", "btn", "c-btn");
        editBtn.setAttribute("data-toggle", "tooltip");
        editBtn.setAttribute("data-placement", "right");
        editBtn.setAttribute("title", "Endre innlegg");
        var icon = document.createElement("i");
        icon.className = "fa fa-pencil";
        icon.setAttribute("aria-hidden", "true");
        editBtn.appendChild(icon);
        posts[i].appendChild(editBtn);

        editBtn.addEventListener("click", editPost);
    }

    document.getElementById("update-news").removeEventListener("click", generatePostEditButtons);
    document.getElementById("update-news").addEventListener("click", removePostEditButtons);
}

function editPost() {
    // Open modal with current content already in place.
    var post = this.parentElement.parentElement;
    var id = post.id;
    var title = post.querySelector("#title").innerText;
    var content = post.querySelector("#post-content").innerText;
    var data = {
        id: id,
        title: title,
        content: content
    };
    var editNewsPostModal = getNewsPostModal(data);
    document.body.appendChild(editNewsPostModal);
    $('#update-news-modal').modal({backdrop: 'static', keyboard: false});
    $('#update-news-modal').modal('show');
    
    var post_html = post.cloneNode(true);
    // removing superfluous html elements
    post_html.removeChild(post_html.children[0]);
    post_html.removeChild(post_html.children[0]);
    post_html.removeChild(post_html.children[0]);
    post_html.removeChild(post_html.children[0]);
    post_html.removeChild(post_html.children[0]);

    tinymce.init({
        selector:'#content-text-area',
        plugins: "code,pagebreak,fullpage,table,fullscreen,paste,spellchecker",
        toolbar: 'undo redo | styleselect | bold italic |' + 
                    'alignleft aligncenter alignright alignjustify |' + 
                    'bullist numlist outdent indent | fullscreen',
                    height: "400"
    });
    setTimeout(function() {
        tinymce.activeEditor.setContent(post_html.innerHTML);
    }, 300);
}

function removePostEditButtons() {
    var editBts = document.getElementsByClassName("edit-post-btn");
    while(editBts[0]) {
        editBts[0].removeEventListener("click", editPost);
        editBts[0].parentNode.removeChild(editBts[0]);
    }
 
    // Reset event handler
    document.getElementById("update-news").addEventListener("click", generatePostEditButtons);
}