function showMessage(type, text) {
    console.log("Message: " + text);
    var message = document.createElement("div");
        message.id = "message";
        message.setAttribute("role", "alert");
        message.className = "alert";

    var icon = document.createElement("i");
        icon.setAttribute("aria-hidden", "true");

    var p = document.createElement("span");
        p.innerHTML = text;

    switch (type) {
        case "warning":
            icon.className = "fa fa-exclamation";
            message.className = "alert alert-warning";
            break;
        case "danger":
            icon.className = "fa fa-times-circle-o";
            message.className = "alert alert-danger";
            break;
        case "info":
            icon.className = "fa fa-info";
            message.className = "alert alert-info";
            break;
        case "success":
            icon.className = "fa fa-check";
            message.className = "alert alert-success";
            break;
        default:
            icon.className = "fa fa-anchor";
            message.className = "alert alert-primary";
            break;
    }

    message.appendChild(icon);
    message.innerHTML += "&nbsp;&nbsp;";
    message.appendChild(p);

    return message;
}