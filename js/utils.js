function toggleShort(element) {
    // TODO: Complete
    // Either retrieve full text and show in footer
    // Redirect to page for full post
}

function shorten() {
    var elements = document.getElementsByClassName("short");

    for (var i = 0; i < elements.length; i++) {
        var e = elements[i];
        var chars = elements[i].innerText;
        if (chars.length > 100) {
            e.innerText = chars.slice(0,100);
            e.innerHTML += "... <i id='les-videre' onclick='toggleShort()' style='color: white;'>Les videre</i>";
        }
    }
}