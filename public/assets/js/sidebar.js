function toggleNav() {
    var sidebar = document.getElementById("mySidebar");
    var app = document.getElementById("app");
    var openbtn = document.querySelector(".openbtn svg path");
    if (sidebar.style.width === "150px") {
        // Sidebar is open, so close it
        sidebar.style.width = "0";
        app.style.marginLeft = "0";
        openbtn.setAttribute("d", "M4 6h16M4 12h16M4 18h16");
    } else {
        // Sidebar is closed, so open it
        sidebar.style.width = "150px";
        app.style.marginLeft = "150px";
        openbtn.setAttribute("d", "M6 18L18 6M6 6l12 12");
    }
}
