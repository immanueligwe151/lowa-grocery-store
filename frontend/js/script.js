function loadTemplate(page) {
    fetch(`backend/fetch_template.php?template=${page}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById("content").innerHTML = html;
        })
        .catch(error => console.error("Error loading template:", error));
}